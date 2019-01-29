<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Start extends CI_Controller {
	
	
	private $wochentage = array(1 => 'Montags',
								2 => 'Dienstags',
								3 => 'Mittwochs',
								4 => 'Donnerstags',
								5 => 'Freitags',
								6 => 'Samstags',
								7 => 'Sonntags');
	
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
  	 public function portal(){
  	 	
		
		$this->db->order_by('wochentag');
		$q = $this->db->get('termine');
		$r = $q->result_array();
		if(!empty($r)){
			foreach($r as &$res){
				$res['wochentag'] = $this->wochentage[$res['wochentag']];
			}
		}
		$position1 = "";
		$position1 = $this->parser->parse('widgets/termine_widget', array('termine' => $r), true);
		
		
		$q = $this->db->query("SELECT k.name, r.timestamp, r.raidid, r.konto, k.icon FROM raids r INNER JOIN konten k ON r.konto = k.kurz WHERE r.active = 0 ORDER BY r.timestamp DESC LIMIT 10");
		$r = $q->result_array();
		if(!empty($r)){
			foreach($r as &$res){
				$date = explode('-', substr($res['timestamp'], 0, 10));
				$res['timestamp'] = $date[2].".".$date[1].".".$date[0];
			}
		}	
		$position2 = $this->parser->parse('widgets/raidhistorie_widget', array('history' => $r), true);
		
		
		$position4 = $this->parser->parse('widgets/liveraid_widget', array(), true);
		
		
		
		$this->parser->parse('portal_view', array('position1' => $position1,
												  'position2' => $position2,
												  'position4' => $position4));
		
  	 }
  	 
  	 
  	public function index()
  	{        
        $this->load->helper('date');
        $this->load->library('form_validation');
        
        if(!isset($_SESSION['raidid'])){
          $vars['msg'] = Array();        
          if(!empty($_POST)){
              if(isset($_POST['newRaid'])){                                     // Neuen Raid anlegen
                  // Masterkey g�ltig?
                  if($this->input->post('masterkey') == 'asdf123'){
                      $raidId = mt_rand(10000, 99999);                          // Raid-ID generieren (unique)
                      $key = random_string('alnum', 5);
                      $this->db->insert('raids', array('raidid' => $raidId, 'schluessel' => $key));   // Datensatz in der Datenbank anlegen
                      $this->setRaidId($raidId, $key);                          // Weiter ...
                  }else{
                      $vars['msg'][0]['text'] = '<div class="alert alert-danger" role="alert">Master-Key ist ung&uuml;ltig.</div>';
                  }
                  
              }elseif(isset($_POST['oldRaid'])){                                              // Alten Raid aufrufen
                  
                  $this->form_validation->set_rules('raidId', 'Raid Id', 'required|trim|exact_length[5]');
                  $this->form_validation->set_rules('key', 'Schl&uuml;ssel', 'required|trim|exact_length[5]');
                  if($this->form_validation->run()){
                  
                      $this->db->select('*')->from('raids')->where('raidid', $this->input->post('raidId'))
                                                           ->where('schluessel', $this->input->post('key'));
                      $query = $this->db->get();
                      $result = $query->result();
                      
                      // Existiert der Raid?
                      if(!empty($result)){
                          // Raid aktiv?
                          if(intval($result[0]->active)){    
                              $this->setRaidId($result[0]->raidid, $result[0]->schluessel, $result[0]->konto);
                          // Raid beendet?
                          }else{
                              redirect(site_url('live/index/'.$raidId));
                          }
                      // Fehlermeldung (Raid nicht gefunden)
                      }else{
                          $vars['msg'][0]['text'] = '<div class="alert alert-warning" role="alert">Diese Raid-ID existiert nicht.</div>';   
                      }
                  }       
              }   
          }
      		
       }else{
          redirect('raid');
       }
       
       $vars['history'] = array();
       
       $this->db->select('*')->from('raids')->where('active', false)->order_by('timestamp', 'DESC')->limit(10);
       $query = $this->db->get();
       if(!empty($query->result_array())){
             $result= $query->result_array();
             foreach($result as &$res){
                $date = explode('-', $res['timestamp']);
                $res['timestamp'] = $res['konto'].' - '.substr($date[2], 0, 2).'.'.$date[1].'.'.$date[0]; 
             }
       
            $vars['history'] = $result;
       }
       
        // Auswahlliste Konten
        $query = $this->db->query("SELECT name, kurz FROM konten");
        $result = $query->result_array();
        
        if(!empty($result)){
          foreach($result as &$res){
            if($this->input->post('selKonto') == $res['kurz']){
              $res['selected'] = 'selected';
            }else{
              $res['selected'] = '';
            } 
          }        
        }
        $vars['kontofilter'] = $result;
        unset($res);
        
        $query = $this->db->query("SELECT DISTINCT klasse AS value FROM spieler ORDER BY klasse ASC");
        $result = $query->result_array();

        foreach($result as $key => $res){
            $klasse[$key]['klasse'] = ucfirst($res['value']);
            $klasse[$key]['value'] = $res['value'];
        }
        $vars['klassenfilter'] = $klasse;        

        $this->parser->parse('start', $vars);          
  	}
  
  private function setRaidId($i, $s, $k = 'ZG'){
      $_SESSION['raidid'] = $i;                               // Session Raid-Id vergeben
      $_SESSION['schluessel'] = $s;                           // Schl�ssel setzen
      $_SESSION['konto'] = $k;                                // Standardkonto setzen
      redirect('raid');                                       // Weiterleitung zur �bersichtsseite 
  }
  
}