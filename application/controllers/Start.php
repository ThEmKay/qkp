<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Start extends CI_Controller {

  	/**
  	 * Index Page for this controller.
  	 *
  	 * Maps to the following URL
  	 * 		http://example.com/index.php/welcome
  	 *	- or -
  	 * 		http://example.com/index.php/welcome/index
  	 *	- or -
  	 * Since this controller is set as the default controller in
  	 * config/routes.php, it's displayed at http://example.com/
  	 *
  	 * So any other public methods not prefixed with an underscore will
  	 * map to /index.php/welcome/<method_name>
  	 * @see https://codeigniter.com/user_guide/general/urls.html
  	 */
  	public function index()
  	{        
        if(!$this->session->has_userdata('raidid')){
          $vars['msg'] = Array();        
          if(!empty($_POST)){
              if(isset($_POST['newRaid'])){                                     // Neuen Raid anlegen
                  // Masterkey gültig?
                  if($this->input->post('masterkey') == 'asdf123'){
                      $raidId = mt_rand(10000, 99999);                          // Raid-ID generieren (unique)
                      $key = random_string('alnum', 5);
                      $this->db->insert('raids', array('raidid' => $raidId, 'schluessel' => $key));   // Datensatz in der Datenbank anlegen
                      $this->setRaidId($raidId, $key);                          // Weiter ...
                  }else{
                      $vars['msg'][0]['text'] = '<div class="alert alert-danger" role="alert">Master-Key ist ung&uuml;ltig.</div>';
                  }
                  
              }elseif(isset($_POST['oldRaid'])){                                              // Alten Raid aufrufen
                  if(isset($_POST['raidId']) && strlen(trim(intval($_POST['raidId']))) == 5){ // Raid-ID eingegeben?
                      $raidId = trim(intval($_POST['raidId']));
                      
                      $this->db->select('*')->from('raids')->where('raidid', $raidId);
                      $query = $this->db->get();
                      $result = $query->result();
                      
                      // Existiert der Raid?
                      if(!empty($result)){
                          // Raid aktiv?
                          if(intval($result[0]->active)){    
                              $this->setRaidId($raidId, $result[0]->schluessel);
                          // Raid beendet?
                          }else{
                              redirect(site_url('live/index/'.$raidId));
                          }
                      // Fehlermeldung (Raid nicht gefunden)
                      }else{
                          $vars['msg'][0]['text'] = '<div class="alert alert-warning" role="alert">Diese Raid-ID existiert nicht.</div>';   
                      }
                  }else{
                      $vars['msg'][0]['text'] = '<div class="alert alert-warning" role="alert">Bitte eine korrekte Raid-ID eingeben (5-stellig).</div>';  // Ungültige ID    
                  }        
              }   
          }
      		
       }else{
          redirect('raid');
       }
       
       $vars['history'] = array();
       
       $this->db->select('*')->from('raids')->where('active', false)->order_by('timestamp')->limit(3);
       $query = $this->db->get();
       if(!empty($query->result_array())){
            $vars['history'] = $query->result_array();
       }
       
       $this->parser->parse('start', $vars);          
  	}
  
  private function setRaidId($i, $s){

      $this->session->set_userdata('raidid', $i);                               // Session Raid-Id vergeben
      $this->session->set_userdata('schluessel', $s);                           // Schlüssel setzen
      $this->session->set_userdata('konto', 'ZG');                              // Standardkonto setzen
      redirect('raid');                                                         // Weiterleitung zur Übersichtsseite 
  }
  
  
}