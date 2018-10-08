<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class raid extends CI_Controller{
    
        public function index(){
                        
            // Session ID vergeben? -> Falls nicht, redirect!
            if(!$this->session->has_userdata('raidid')){
                redirect('start');
            }
            
            $this->session->set_userdata('konto', 'ZG');
          
            /// POST
            
            $acc_active = 0;
            
            
            
            // Punktekonto wechseln
            if($this->input->post('selKonto') != null){
                $this->session->set_userdata('konto', $this->input->post('selKonto'));
                
                $acc_active = 0;
                
            // Teilnehmer hinzufügen/entfernen
            }elseif($this->input->post('sbmTeilnehmer') != null){
                if(!empty($this->input->post('teilnehmer')))
                
                    $this->db->select('spieler')->from('raids_spieler')->where('raidid', $this->session->userdata('raidid'));
                    $query = $this->db->get();
                    $result = $query->result_array();
                    $exists = array();
                    if(!empty($result)){
                        foreach($result as $res){
                            $exists[] = $res['spieler'];
                        }
                    }

                    $remove = array_diff($exists, $this->input->post('teilnehmer'));
                    if(!empty($remove)){
                      $this->db->where('raidid', $this->session->userdata('raidid'));
                      $this->db->where_in('spieler', $remove);
                      $this->db->delete('raids_spieler');
                    }

                    foreach($this->input->post('teilnehmer') as $teilnehmer){
                        if(!in_array($teilnehmer, $exists)){
                        $this->db->insert('raids_spieler', array('raidid' => $this->session->userdata('raidid'),
                                                                 'spieler' => $teilnehmer));
                        }
                    }
                    
                $acc_active = 1;
                           
            // Loot hinzufügen        
            }elseif($this->input->post('sbmLoot') != null){
                $this->load->library('form_validation');
                $this->form_validation->set_rules('txtGegenstand', 'Gegenstand', 'required');
                $this->form_validation->set_rules('intWert', 'Wert', 'required');
                if($this->form_validation->run()){
                    $this->db->insert('beute', array('raidid' => $this->session->userdata('raidid'),
                                                     'spieler' => $this->input->post('selSpieler'),
                                                     'gegenstand' => $this->input->post('txtGegenstand'),
                                                     'wert' => $this->input->post('intWert'),
                                                     'konto' => 'ZG'));
                }
                
                $acc_active = 1;
                
            // Loot entfernen
            }elseif($this->input->post('rmvLoot') != null){
                $remove = $this->input->post('chkLoot');
                if(!empty($remove)){
                    $this->db->where_in('lootid', $remove);
                    $this->db->delete('beute');
                }
                
                $acc_active = 1;
                
            }elseif($this->input->post('sbmEnd') != null){
                $this->session->sess_destroy();
                redirect(site_url());
            }
            
            //$this->db->insert('raids_spieler', array);
            
          
          
            
            
            
            
            // Konten auslesen
            $query = $this->db->get('konten');
            $konten = $query->result_array();
            if(!empty($konten)){
              foreach($konten as &$konto){
                  if($konto['kurz'] == $this->session->userdata('konto')){
                    $konto['checked'] = "selected";
                  }else{
                    $konto['checked'] = "";
                  }
              }
            }
            $vars['konten'] = $konten;
            
            $vars['raidid'] = $this->session->userdata('raidid'); 
        
        
        
        
        
            ############ BLOCK TEILNEHMER
            
            // Alle Spieler + Info der Teilnahme am Raid aus der Datenbank holen. 
            $query = $this->db->query("SELECT * FROM spieler
                                       LEFT JOIN raids_spieler ON raids_spieler.spieler = spieler.name
                                                               AND raids_spieler.raidid = ".$this->session->userdata('raidid')."
                                       LEFT JOIN bonus ON spieler.name = bonus.spieler;");
                                       //WHERE konto = '".$this->session->userdata('konto')."';");
                        
            // Result verarbeiten
            $teilnehmer = array();
            
            if(!empty($query->result_array())){
            
                foreach($query->result_array() as $key => $row){
                
                    $vars['klasse'][$row['klasse']]['klasse'] = $row['klasse'];
                    
                    if($row['raidid'] != null){
                        $vars['klasse'][$row['klasse']]['spieler'][$key]['checked'] = 'checked';
                        $teilnehmer[] = $row['name'];
                        $bonuspunkte[$row['name']] = $row['wert'];
                    }
                    
                    if($row['parent'] != null){
                        
                        
                        $vars['klasse'][$row['klasse']]['spieler'][$key]['name'] = $row['name'];
                        
                        
                            
                    }
                    else{
                        $vars['klasse'][$row['klasse']]['spieler'][$key]['name'] = $row['name'];
                    }
                    
                    $vars['klasse'][$row['klasse']]['spieler'][$key]['klasse'] = $row['klasse'];
                }
            }
            
            ############ BLOCK BEUTE         
                       
            //
            $vars['beute'][0]['msg'] = array();
            $vars['beute'][0]['loot'] = array();
            if(!empty($teilnehmer)){
              
              $vars['beute'][0]['msg'] = array();

              foreach($teilnehmer as $name){
                  $vars['beute'][0]['loothinzu'][0]['spielerliste'][]['name'] = $name;
              }
              
              // Beuteliste
              $this->db->select('*')->from('beute');
              $this->db->where('raidid', intval($this->session->userdata('raidid')));
              $query = $this->db->get();
              $result = $query->result_array();
              $bekommen = array();
              $ausgegeben = array();
              if(!empty($result)){
              
                  $vars['beute'][0]['beuteliste'] = $result;
                  
                  foreach($result as $res){
                      $bekommen[$res['spieler']] = $res['spieler'];
                      
                      if(!isset($ausgegeben[$res['spieler']])){
                        $ausgegeben[$res['spieler']] = 0;  
                      }
                      
                      $ausgegeben[$res['spieler']] += intval($res['wert']);   
                  }   
              }else{
                  $vars['beute'][0]['beuteliste'] = array();
              }
              
            }else{
              $vars['beute'][0]['beuteliste'] = array();
              $vars['beute'][0]['loothinzu'] = array();
              $vars['beute'][0]['msg'][0]['text'] = "Noch keine Teilnehmer festgelegt.";
            }
            
            
            ############ BLOCK Zusammenfassung
            // Teilnehmer zählen
            $vars['live'][0]['anzahl_teilnehmer'] = count($teilnehmer);
            
            // Bonus-DKP String bauen
            if(!empty($teilnehmer) && !empty($bekommen)){
              $vars['live'][0]['bonus'] = implode(', ', array_diff($teilnehmer, $bekommen));
            }
                        
            // Anzeige der Livepunkte
            $vars['live'][0]['dkpstand'] = array();
            if(!empty($ausgegeben)){
                $i = 0;
                foreach($ausgegeben as $spieler => $wert){
                    $vars['live'][0]['dkpstand'][$i]['spieler'] = $spieler;
                    $vars['live'][0]['dkpstand'][$i]['wert'] = $wert;
                    $vars['live'][0]['dkpstand'][$i]['gesamt'] = $bonuspunkte[$spieler]+100;
                    $vars['live'][0]['dkpstand'][$i]['rest'] = $bonuspunkte[$spieler]+100-$wert;
                    $i++; 
                }
            }
               
          
            $i = 0;
            foreach($bonuspunkte as $spieler => $bonus){

              if(isset($ausgegeben[$spieler])){
                  $vars['sum'][0]['punktestand'][$i]['spieler'] = $spieler;
                  $vars['sum'][0]['punktestand'][$i]['bonus_alt'] = intval($bonus);
                  $vars['sum'][0]['punktestand'][$i]['bonus_neu'] = intval($bonus);
              }else{
                  $vars['sum'][0]['punktestand'][$i]['spieler'] = $spieler;
                  $vars['sum'][0]['punktestand'][$i]['bonus_alt'] = intval($bonus);
                  $vars['sum'][0]['punktestand'][$i]['bonus_neu'] = intval($bonus)+1;    
              }
              $i++;
            
            }
        
                
        
            $vars['acc_active'] = $acc_active;
        
            $this->parser->parse('raid', $vars);
        
        }    
    
    }

?>