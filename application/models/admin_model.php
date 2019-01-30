<?php

class Admin_model extends CI_Model{

public function getMains(){

	$this->db->select('*')->from('spieler')->where('parent IS NULL');
	$query = $this->db->get();
	return $query->result_array();
}

public function getSpieler($spieler){
	
	if(strlen(trim($spieler)) > 2){
		
		$this->db->select('*')->from('spieler')->where('name = "'.$spieler.'" OR parent = "'.$spieler.'"');
		$q = $this->db->get();
		
		return $q->result_array();
	}
	return array();
}

public function getKonto($spieler){
	
	if(strlen(trim($spieler)) > 2){
		
		$this->db->select('*')->from('bonus b')->join('konten k', 'b.konto = k.kurz')->where('spieler = "'.$spieler.'"');
		$q = $this->db->get();
		
		return $q->result_array();
	}
	return array();	
	
}

public function getClasses(){
	$query = $this->db->get();

}

public function getRaids(){
	$this->db->order_by('timestamp', 'DESC');
	$this->db->join('konten k', 'k.kurz = r.konto', 'inner');
	$q = $this->db->get('raids r');
	return $q->result_array();
}

public function getRaid($raidid){
	
	
	$q = $this->db->query("SELECT r.raidid, r.konto, r.active, r.timestamp, k.modus, k.bonuspunkte FROM raids r INNER JOIN konten k ON r.konto = k.kurz WHERE r.raidid = ".intval($raidid));
	//$this->db->where('raidid', $raidid);
	//$q = $this->db->get('raids');
	return $q->result_array();
}

public function getTeilnehmer($raidid){
	$q = $this->db->query("SELECT s.name AS spieler, s.klasse, s.parent AS main FROM raids_spieler r INNER JOIN spieler s ON r.spieler = s.name WHERE r.raidid = ".$raidid);
	//$this->db->where('raidid', $raidid);
	//$q = $this->db->get('raids_spieler');
	return $q->result_array();
}

public function getPool($raidid){
	$q = $this->db->query("SELECT name, klasse, parent AS main FROM spieler WHERE name NOT IN(SELECT spieler FROM raids_spieler WHERE raidid = ".intval($raidid).");");
	return $q->result_array();
}

public function getBeute($raidid){
	$this->db->where('raidid', intval($raidid));
	$q = $this->db->get('beute');
	return $q->result_array();
}

public function getKonten(){
	$q = $this->db->get('konten');
	return $q->result_array();
}

public function getKontenFrei(){
	$q = $this->db->query('SELECT name, kurz FROM konten WHERE kurz NOT IN (SELECT DISTINCT konto FROM raids WHERE active = 1)');
	return $q->result_array();
}










}

?>