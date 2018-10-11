<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Raid extends CI_Controller{
    
        public function index(){
          
            // Session ID vergeben? -> Falls nicht, redirect!
            if(!$this->session->has_userdata('raidid')){
                redirect('start');
            }
            
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

                    if($this->input->post('teilnehmer') == null){
                        $teiln = array();
                    }else{
                        $teiln = $this->input->post('teilnehmer');  
                    }
                    
                    $remove = array_diff($exists, $teiln);

                    if(!empty($remove)){
                      $this->db->where('raidid', $this->session->userdata('raidid'));
                      $this->db->where_in('spieler', $remove);
                      $this->db->delete('raids_spieler');
                    }

                    if(!empty($teiln)){
                        foreach($teiln as $teilnehmer){
                            if(!in_array($teilnehmer, $exists)){
                            $this->db->insert('raids_spieler', array('raidid' => $this->session->userdata('raidid'),
                                                                     'spieler' => $teilnehmer));
                            }
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
            
            // Raid-Session beenden    
            }elseif($this->input->post('sbmEnd') != null){
                
                foreach($this->input->post('hidPunkteSchreiben') as $spieler => $neu){
                    $this->db->set('wert', $neu);
                    $this->db->where('spieler', $spieler);
                    $this->db->where('konto', $this->session->userdata('konto'));
                    $this->db->update('bonus');
                }
                
                $this->db->set('active', false);
                $this->db->where('raidid', $this->session->userdata('raidid'));
                $this->db->update('raids');
                                
            $this->session->unset_userdata('raidid');
            $this->session->unset_userdata('konto');
            $this->session->unset_userdata('schluessel');
                redirect(site_url());
            
            // Neuen Charakter anlegen    
            }elseif($this->input->post('sbmCharakterNeu') != null){
            
                $this->load->library('form_validation');
                $this->form_validation->set_rules('txtCharakterNeu', 'Charakter', 'required|trim|is_unique[spieler.name]');
                $this->form_validation->set_rules('selCharakterKlasse', 'Klasse', 'required|trim');
                $this->form_validation->set_rules('intBonus', 'Bonus', 'required|trim');
                $this->form_validation->set_rules('selTwink', 'Twink', 'required');
                                
                if($this->form_validation->run()){
                    
                    if($this->input->post('selTwink') != 'no'){
                        $this->db->insert('spieler', array('name' => $this->input->post('txtCharakterNeu'),
                                                           'klasse' => $this->input->post('selCharakterKlasse'),
                                                           'parent' => $this->input->post('selTwink')));
                    }else{
                        $this->db->insert('spieler', array('name' => $this->input->post('txtCharakterNeu'),
                                                           'klasse' => $this->input->post('selCharakterKlasse')));
                                                           
                        $this->db->insert('bonus', array('spieler' => $this->input->post('txtCharakterNeu'),
                                                         'konto' => $this->session->userdata('konto'),
                                                         'wert' => $this->input->post('intBonus')));
                        
                                                            
                    } 
                }
            }elseif($this->input->post('sbmDeleteRaid') != null){
            
                $this->db->where('raidid', $this->session->userdata('raidid'));
                $this->db->delete('raids');
                
                $this->db->where('raidid', $this->session->userdata('raidid'));
                $this->db->delete('beute');
                
                $this->db->where('raidid', $this->session->userdata('raidid'));
                $this->db->delete('raids_spieler');
                
            $this->session->unset_userdata('raidid');
            $this->session->unset_userdata('konto');
            $this->session->unset_userdata('schluessel');
                redirect(site_url());
                                                          
            }elseif($this->input->post('sbmParcRaid') != null){
            
                $this->session->unset_userdata('raidid');
                $this->session->unset_userdata('konto');
                $this->session->unset_userdata('schluessel');
                redirect(site_url());
            }
            
            $vars['raidid'] = $this->session->userdata('raidid');
            $vars['schluessel'] = $this->session->userdata('schluessel'); 
        
            ############ BLOCK TEILNEHMER
            // Alle Spieler + Info der Teilnahme am Raid aus der Datenbank holen. 
            $query = $this->db->query("SELECT * FROM spieler
                                       LEFT JOIN raids_spieler ON raids_spieler.spieler = spieler.name
                                                               AND raids_spieler.raidid = ".$this->session->userdata('raidid')."
                                       LEFT JOIN bonus ON spieler.name = bonus.spieler
                                       WHERE parent IS NULL
                                       AND konto = '".$this->session->userdata('konto')."';");
                        
            // Result verarbeiten
            $teilnehmer = array();
            $alle = array();
            if(!empty($query->result_array())){
            
                $vars['alle'] = $query->result_array();
            
                foreach($query->result_array() as $key => $row){
                
                    $vars['klasse'][$row['klasse']]['klasse'] = $row['klasse'];
                    
                    if($row['raidid'] != null){
                        $vars['klasse'][$row['klasse']]['spieler'][$key]['checked'] = 'checked';
                        $teilnehmer[] = $row['name'];
                        $bonuspunkte[$row['name']] = $row['wert'];
                    }
                    
                    $vars['klasse'][$row['klasse']]['spieler'][$key]['name'] = $row['name'];
                    $vars['klasse'][$row['klasse']]['spieler'][$key]['klasse'] = $row['klasse'];
                                        
                    $this->db->select('name, klasse')->from('spieler')->where('parent', $row['name']);
                    $query2 = $this->db->get();
                    
                    $vars['klasse'][$row['klasse']]['spieler'][$key]['alt'] = $query2->result_array();
                    
                                           
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
            $vars['live'][0]['bonus'] = '-';
            if(!empty($teilnehmer)){
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
            $vars['sum'] = array();
            if(!empty($bonuspunkte)){
                foreach($bonuspunkte as $spieler => $bonus){
                  if(isset($ausgegeben[$spieler])){
                      $vars['sum'][0]['punktestand'][$i]['spieler'] = $spieler;
                      $vars['sum'][0]['punktestand'][$i]['bonus_alt'] = intval($bonus);
                      
                      if($ausgegeben[$spieler] > 100){
                        $vars['sum'][0]['punktestand'][$i]['bonus_neu'] = intval($bonus)+100-$ausgegeben[$spieler];
                      }else{
                        $vars['sum'][0]['punktestand'][$i]['bonus_neu'] = intval($bonus);
                      }
                      $vars['sum'][0]['punktestand'][$i]['highlight'] = '';
                  }else{
                      $vars['sum'][0]['punktestand'][$i]['spieler'] = $spieler;
                      $vars['sum'][0]['punktestand'][$i]['bonus_alt'] = intval($bonus);
                      $vars['sum'][0]['punktestand'][$i]['bonus_neu'] = intval($bonus)+1;
                      $vars['sum'][0]['punktestand'][$i]['highlight'] = 'bold';    
                  }
                  $i++;
                }
            }
        
            $vars['acc_active'] = $acc_active;
        
            $this->parser->parse('raid', $vars);
        }

            
    }

?>