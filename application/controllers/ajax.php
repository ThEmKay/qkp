<?php

class ajax extends CI_Controller{
		
		
	public function savespieler($spieler, $nameneu, $klasseneu){
		$this->db->where('name', $spieler);
		$this->db->update('spieler', array('name' => $nameneu,
										   'klasse' => $klasseneu));
										   
		$this->db->where('parent', $spieler);
		$this->db->update('spieler', array('parent' => $nameneu));
		
		$this->db->where('spieler', $spieler);
		$this->db->update('bonus', array('spieler' => $nameneu));											   		
	}	
	
	public function savekonto($spieler, $konto, $wertneu){
		$this->db->where('spieler', $spieler);
		$this->db->where('konto', $konto);
		$this->db->update('bonus', array('wert' => $wertneu));										   		
	}
	
	public function charneu($main, $charneu, $klasseneu){
		$this->db->insert('spieler', array('name' => urldecode(trim(ucfirst(strtolower($charneu)))),
										   'klasse' => urldecode(trim($klasseneu)),
										   'parent' => urldecode(trim(ucfirst(strtolower($main))))));
	}
	
	public function charloeschen($spieler){
		$this->db->where('name', urldecode(trim(ucfirst(strtolower($spieler)))));
		$this->db->delete('spieler');
	}
	
	public function charexists($name){
		$this->db->where('name', $name);
		$q = $this->db->get('spieler');
		$r = $q->result_array();
		
		if(!empty($r)){
			echo 1;
		}else{
			echo 0;	
		}
	}
	
	public function getpunkterest($name, $konto, $raidid){
			
		$q = $this->db->query("SELECT k.modus,
							     	  b.wert-(SELECT ifnull(sum(wert), 0) FROM beute WHERE raidid = ".intval($raidid)." AND spieler = '".$name."') AS punkte
						  	   FROM bonus b
						  	   INNER JOIN konten k ON k.kurz = b.konto
						  	   WHERE
							   	  b.spieler = '".$name."'
						  	   AND
								  b.konto = '".$konto."';");
			
		$r = $q->result_array();
		if(!empty($r)){
			if($r[0]['modus'] == 0){
				echo intval($r[0]['punkte'])+100;	
			}else{
				echo $r[0]['punkte'];
			}			
		}else{
			echo 0;	
		}
	}	
}
?>
	