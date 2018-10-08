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
                  $raidId = mt_rand(10000, 99999);                              // Raid-ID generieren (unique)
                  $this->db->insert('raids', array('raidid' => $raidId));        // Datensatz in der Datenbank anlegen
                  $this->setRaidId($raidId);                                    // Weiter ...
                  
              }elseif(isset($_POST['oldRaid'])){                                      // Alten Raid aufrufen
                  if(isset($_POST['raidId']) && strlen(trim(intval($_POST['raidId']))) == 5){ // Raid-ID eingegeben?
                      $raidId = trim(intval($_POST['raidId']));
                      
                      $this->db->select('*')->from('raids')->where('raidid', $raidId);
                      $query = $this->db->get();
                      $result = $query->result();
                      
                      if(!empty($result)){
                          $this->setRaidId($raidId);
                                                                    // Existiert der Raid?        // Weiter im Text ...
                      }else{
                          $vars['msg'][0]['text'] = "Diese Raid-ID existiert nicht!";   // Fehlermeldung (Raid nicht gefunden)
                      }
                  }else{
                      $vars['msg'][0]['text'] = "Bitte eine korrekte Raid-ID eingeben (5-stellig).";  // Ungültige ID    
                  }        
              }   
          }
      		
       }else{
          redirect('raid');
       }
       
       $this->parser->parse('start', $vars);          
  	}
  
  private function setRaidId($i){
      echo $i;
      $this->session->set_userdata('raidid', $i);                               // Session Raid-Id vergeben
      redirect('raid');                                               // Weiterleitung zur Übersichtsseite 
  }
  
  
}