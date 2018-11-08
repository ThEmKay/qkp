<?php

class Live extends CI_Controller{

    public function index($raidid){
        
        $vars['msg'] = '';
        $vars['live'] = array();
        $vars['final'] = array();
        $vars['datum'] = '';
        $vars['active'] = '';
                
        // Prüfen, ob ein Raid mit dieser ID existiert
        $query = $this->db->select('*')->from('raids')->where('raidid', intval($raidid));
        $result = $this->db->get();
        
        // Falls der Raid existiert
        if(!empty($result->result_array())){
            $infos = $result->result_array();     
            $datetime = explode('-', $infos[0]['timestamp']);
            $vars['datum'] = 'Raid <b>'.$raidid.'</b> am <b>'.substr($datetime[2], 0, 2).'.'.$datetime[1].'.'.$datetime[0].'</b>';
            $vars['konto'] = $infos[0]['konto'];
            
            if($infos[0]['active'] == true){
                $vars['active'] = '<div class="alert alert-success" role="alert">Dieser Raid ist noch nicht abgeschlossen.</div>';
            }else{
                $vars['active'] = '<div class="alert alert-warning" role="alert">Raid abgeschlossen! Bonuspunkte wurden bereits verbucht.</div>';    
            }
        
            $query = $this->db->query("SELECT raids_spieler.raidid, raids_spieler.spieler, spieler.klasse, bonus.wert AS bonus, SUM(beute.wert) AS ausgegeben
                              FROM raids_spieler
                              left join beute ON beute.spieler = raids_spieler.spieler and beute.raidid = ".intval($raidid)."
                              left join raids ON raids.raidid = raids_spieler.raidid
                              left join bonus ON bonus.spieler = raids_spieler.spieler and bonus.konto = raids.konto 
                              left join spieler ON spieler.name = raids_spieler.spieler
                              where raids_spieler.raidid = ".intval($raidid)."
                              GROUP BY raids_spieler.raidid, raids_spieler.spieler, spieler.klasse, bonus.wert
                              ORDER BY ausgegeben");
                              
            $result = $query->result_array();
                        
            if(!empty($result)){
                foreach($result as $key => &$ref){
                    if($key % 2 == 1){
                        $ref['color'] = '#c0c0c0';
                    }else{
                        $ref['color'] = '#D6E1FC';
                    }
                    
                    $ref['ausgegeben'] = intval($ref['ausgegeben']);
                    $ref['rest'] = intval($ref['bonus']+100-$ref['ausgegeben']);
                    if($ref['ausgegeben'] == 0){
                        $ref['spieler'] = '<b>'.$ref['spieler'].'</b>';
                    }    
                }
                                
                // Loot auslesen
                $loot = array();
                $this->db->select('*')->from('beute')->join('spieler', 'spieler.name = beute.spieler', 'left')->where('raidid', $raidid);
                $query = $this->db->get();
                if(!empty($query->result_array())){
                    $loot = $query->result_array();
                    
                    foreach($loot as $key => &$ref){
                      if($key % 2 == 1){
                          $ref['color'] = '#c0c0c0';
                      }else{
                          $ref['color'] = '#D6E1FC';
                      }
                    }   
                }                
                
                if($infos[0]['active']){
                  $vars['live'][0]['punktestand'] = $result;
                  $vars['live'][0]['loot'] = $loot;
                }else{
                  $vars['final'][0]['punktestand'] = $result;
                  $vars['final'][0]['loot'] = $loot;
                }
            }else{
                $vars['msg'] = '<br /><div class="alert alert-info" role="alert">Bisher wurden noch keine Teilnehmer best&auml;tigt.</div>';
            }
        }else{
            $vars['msg'] = '<br /><div class="alert alert-danger" role="alert"><strong>Sorry!</strong> Kein Raid mit dieser Id ('.$raidid.') gefunden.</div>';
        }
      
        $this->parser->parse('live', $vars);
    }

}
?>