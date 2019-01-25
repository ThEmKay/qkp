<?php

class punkte extends CI_Controller{

    public function index($konto = 'AQ20', $klasse = 'krieger', $sort = "ASC"){
    
        if(!$this->input->is_ajax_request()) {
          exit('No direct script access allowed');
        }
    
        $a = "SELECT
                klasse,
                COALESCE(parent, name) AS parent,
                COALESCE(parent, '-') AS main,
                name AS spieler,
                CASE WHEN parent IS NULL THEN (SELECT wert FROM bonus WHERE spieler = name AND konto = '".$konto."')
                                        ELSE (SELECT wert FROM bonus WHERE spieler = parent AND konto = '".$konto."')
                                        END AS wert
              FROM spieler
              WHERE klasse = '".$klasse."'";
        
        $query = $this->db->query($a);
        
        $result = $query->result_array();
        
       
        $vars['punktestand'] = $query->result_array();
        
        $this->parser->parse('punkteliste', $vars);
        
    }
    
    
    public function loot($spieler = 'Ryf', $konto = 'AQ20'){
        
        if(!$this->input->is_ajax_request()) {
          exit('No direct script access allowed');
        }
        
        $q = $this->db->query("SELECT
                                b.spieler,
                                b.gegenstand,
                                b.wert,
                                r.timestamp,
                                DATE_FORMAT(r.timestamp, '%d.%c.%Y') AS datum
                               FROM beute b
                               INNER JOIN raids r ON b.raidid = r.raidid
                               WHERE b.spieler = \"".$spieler."\" AND b.konto = \"".$konto."\"
                               ORDER BY timestamp DESC;");
                               
        $r = $q->result_array();
        if(!empty($r)){
            $vars['loot'] = $r;
            $this->parser->parse('lootinfo', $vars);
        }else{
            echo '<div class="alert alert-warning" role="alert"><strong>Schade!</strong> Noch keinen Loot bekommen.</div>';
        }
   
    }

}

?>