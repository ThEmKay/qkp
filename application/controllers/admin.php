<?php

class admin extends CI_Controller{
		
	private $modus = array(0 => '101er',
						   1 => 'Fortlaufend');

	private $klassen = array('druide' => 'Druide',
							 'hexenmeister' => 'Hexenmeister',
							 'jaeger' => 'J&auml;ger',
							 'krieger' => 'Krieger',
							 'magier' => 'Magier',
							 'paladin' => 'Paladin',
							 'priester' => 'Priester',
							 'schurke' => 'Schurke');
							 
	private $status = array(0 => '<span style="color:green"><i class="fas fa-check"></i> Abgeschlossen</span>',
							1 => '<span style="color:orange"><i class="fas fa-lock-open"></i> Offen</span>');

    public function index($spieler = ""){

	     // Session ID vergeben? -> Falls nicht, redirect!
        if(!isset($_SESSION['sessid'])){
            redirect('start');
        } 
		
		$this->load->helper('form');
		if(strlen($spieler) > 0){
			
			$this->load->model('admin_model');
			$r1 = $this->admin_model->getSpieler($spieler);
			$r2 = $this->admin_model->getKonto($spieler);
			
			if(!empty($r1)){
				foreach($r1 as &$result){
					$result['class'] = form_dropdown($result['name'], $this->klassen, $result['klasse'], 'class="form-control"');
					if($result['parent'] == NULL){
						$mainklasse = $result['klasse'];	
					}
					$result['options'] = '<i class="fas fa-save fa-2x spieler-save"></i>';
					if($result['name'] != $spieler){
						$result['options'] .= '&nbsp;<i class="fas fa-trash fa-2x"></i>';
					}	
				}
			}

			$c = $this->parser->parse('admin_spieler', array('main-klasse' => $mainklasse,
															 'chars' => $r1,
															 'konten' => $r2,
															 'klasseneu' => form_dropdown('klasseneu', $this->klassen, '', 'class="form-control"')), true);
		}else{
			$msg = '';
			if(!empty($_POST)){
				$this->db->insert('spieler', array('name' => ucfirst(strtolower($this->input->post('spielerneuname'))),
												   'klasse' => $this->input->post('spielerneuklasse')));
				$this->db->query('INSERT INTO bonus (konto, spieler, wert) SELECT kurz, "'.ucfirst(strtolower($this->input->post('spielerneuname'))).'", 0 FROM konten;');												   
				$msg = '<div class="alert alert-success" role="alert">Neue/r Spieler/in angelegt.</div>';
			}
									
			$this->load->model('admin_model');
			$r = $this->admin_model->getMains();
			if(!empty($r)){
				foreach($r as &$result){
					$result['suchstring'] = strtolower($result['name'].$result['klasse']);
				}
			}else{
				$msg = '<div class="alert alert-warning" role="alert">Noch kein/e Spieler/in angelegt.</div>';
			}
			
			$c = $this->parser->parse('admin_chars', array('msg' => $msg,
														   'klassenauswahl' => form_dropdown('spielerneuklasse', $this->klassen, '', 'class="form-control"'),
														   'chars' => $r), true);	
		}	
        $this->parser->parse('admin_main', array('spieler_active' => 'active',
        										 'content' => $c));
    }
	
	
	
	public function raids($raidid = 0){
	     // Session ID vergeben? -> Falls nicht, redirect!
	    if(!isset($_SESSION['sessid'])){
	        redirect('start');
	    }
		
		// BEARBEITUNG EINES RAIDS
		$this->load->model('admin_model');
		if(intval($raidid) > 0){
			
			// LOOT ENTFERNEN
			if(isset($_POST['sbmlootentfernen'])){
				foreach($_POST['lootentfernen'] as $lootid){
					$this->db->where('lootid', $lootid);
					$this->db->delete('beute');
				}
			}
			
			// RAID VERWERFEN
			if(isset($_POST['raidverwerfen'])){
				$this->db->where('raidid', $raidid);
				$this->db->delete('raids');	
				redirect(site_url('admin/raids'));
			}
			
			// TEILNEHMER HINZUFÜGEN
			if(isset($_POST['sbmteilnehmer'])){
				if(!empty($_POST['teilnehmer'])){
					$this->db->where_not_in('spieler', array_values($_POST['teilnehmer']));
					$this->db->where('raidid', intval($raidid));
					$this->db->delete('raids_spieler');
					
					foreach($_POST['teilnehmer'] as $spieler){
						$this->db->insert('raids_spieler', array('raidid' => intval($raidid),
																 'spieler' => $spieler));	
					}
				}else{
					$this->db->where('raidid', intval($raidid));
					$this->db->delete('raids_spieler');	
				}
			}
			
			// DATEN DES RAIDS AUS DER DB HOLEN			
			$r1 = $this->admin_model->getRaid(intval($raidid));

			// LOOT ERFASSEN
			if(isset($_POST['beuteneusubmit'])){

				$this->db->insert('beute', array('gegenstand' => $this->input->post('beuteneuitem'),
												 'konto' => $r1[0]['konto'],
												 'raidid' => intval($raidid),
												 'spieler' => $this->input->post('beuteneuspieler'),
												 'wert' => $this->input->post('beuteneuwert')));
			}
						
			
			
			$r2 = $this->admin_model->getTeilnehmer(intval($raidid));
			$r3 = $this->admin_model->getPool(intval($raidid));	
			$r4 = $this->admin_model->getBeute(intval($raidid));
			
			$b = array();
			if(!empty($r4)){
				$j = 0;
				foreach($r4 as $beute){
					if(!in_array($beute['spieler'], $b)){
						$b[$j++] = $beute['spieler'];
					}
				}
			}
			
						
			$bonusberechtigt = array();
			if(!empty($r2)){
				$i = 0;
				foreach($r2 as $teilnehmer){
					if(!in_array($teilnehmer['spieler'], $b) && $r1[0]['modus'] == 0){
						if($teilnehmer['main'] == NULL){
							$bonusberechtigt[$i] = $teilnehmer['spieler'];	
						}else{
							$bonusberechtigt[$i] = $teilnehmer['main'];	
						}
					}elseif($r1[0]['modus'] == 1){
						if($teilnehmer['main'] == NULL){
							$bonusberechtigt[$i] = $teilnehmer['spieler'];	
						}else{
							$bonusberechtigt[$i] = $teilnehmer['main'];	
						}
					}
					$i++;
				}
			}

			$msg = '';
			// RAID ERÖFFNEN
			if(isset($_POST['raidoeffnen'])){
				// Punkte zurücksetzen, falls Modus 101er
				if($r1[0]['modus'] == 0){
					$this->db->query("UPDATE bonus SET wert = wert-".intval($r1[0]['bonuspunkte'])."
									  WHERE konto = '".$r1[0]['konto']."' AND
									  		spieler IN(SELECT
									   				   		ifnull(s.parent, s.name) AS main
													   FROM 
									   						raids_spieler rs
													   INNER JOIN spieler s ON rs.spieler = s.name 
													   WHERE raidid = ".intval($raidid)." AND spieler NOT IN(SELECT DISTINCT spieler FROM beute b WHERE raidid = ".intval($raidid)."))");
				// Punkte zurücksetzen, falls Modus fortlaufend				
				}elseif($r1[0]['modus'] == 1){
					$this->db->query("UPDATE bonus SET wert = wert-".intval($r1[0]['bonuspunkte'])."
									  WHERE konto = '".$r1[0]['konto']."' AND
									  		spieler IN(SELECT
									   				   		ifnull(s.parent, s.name) AS main
													   FROM 
									   						raids_spieler rs
													   INNER JOIN spieler s ON rs.spieler = s.name 
													   WHERE raidid = ".intval($raidid).")");
				}
				// Raid wieder aktivieren								   
				$this->db->where('raidid', $raidid);
				$this->db->set('active', 1);
				$this->db->update('raids');
				// DATEN DES RAIDS ERNEUT AUS DER DB HOLEN			
				$r1 = $this->admin_model->getRaid(intval($raidid));
				
				$msg = '<div class="alert alert-success" role="alert">Bonuspunkte wurden zur&uuml;ckgesetzt.</div>';
			}


			// RAID ABSCHLIEßEN
			if(isset($_POST['raidabschliessen'])){
				// Abschluss beim 101er System
				if($r1[0]['modus'] == 0){
					$this->db->where('konto', $r1[0]['konto']);
					$this->db->where_in('spieler', $bonusberechtigt);
					$this->db->set('wert', 'wert+'.intval($r1[0]['bonuspunkte']), false);
					$this->db->update('bonus');		
				
				// Abschluss bei fortlaufendem System	
				}elseif($r1[0]['modus'] == 1){
					if(!empty($bonusberechtigt)){
						foreach($bonusberechtigt as $spieler){
							$this->db->where('konto', $r1[0]['konto']);
							$this->db->where('spieler', $spieler);
							$this->db->set('wert', 'wert+'.intval($r1[0]['bonuspunkte']).'-(SELECT ifnull(sum(wert), 0) FROM beute WHERE raidid = '.intval($raidid).' AND spieler = "'.$spieler.'")', false);
							$this->db->update('bonus');
						}	
					}
				}
				
				// Raid auf beendet setzen
				$this->db->where('raidid', intval($raidid));
				$this->db->set('active', 0);
				$this->db->update('raids');
			
				// DATEN DES RAIDS ERNEUT AUS DER DB HOLEN			
				$r1 = $this->admin_model->getRaid(intval($raidid));
				
				$msg = '<div class="alert alert-success" role="alert">Raid erfolgreich abgeschlossen</div>'; 
			}
	
	
			// IST DER RAID AKTIV, WIRD DIE JS-FUNKTION GELADEN
			if($r1[0]['active'] == 1){
				$magic = '<script src="'.base_url('img/admin_raid.js').'"></script>';
				if(!empty($r2)){
					$aktionen = '<button name="raidabschliessen" type="submit" class="btn btn-success"><i class="fas fa-check"></i> Raid abschlie&szlig;en</button><br />
								 <i>Um den Raid verwerfen zu k&ouml;nnen, d&uuml;rfen keine Teilnehmenden zugeordnet sein.</i>';
				}else{
					$aktionen = '<button name="raidverwerfen" type="submit" class="btn btn-warning"><i class="far fa-trash-alt"></i> Raid verwerfen</button>';
				}					
			}else{
				$magic = '';
				$aktionen = '<button name="raidoeffnen" type="submit" class="btn btn-warning"><i class="fas fa-redo"></i> Raid &ouml;ffnen</button><br />
							 <i>Gebuchte Bonuspunkte werden beim erneuten &Ouml;ffnen eines Raids wieder zur&uuml;ckgesetzt.</i>';
			}
			
			
			if(!empty($r3)){
				foreach($r3 as &$result){
					$result['suchstring'] = strtolower($result['name']).$result['klasse'];
				}
			}

			if(!empty($r4)){
				$beuteentfernen = '<button type="submit" name="sbmlootentfernen" class="btn btn-danger"><i class="fas fa-file-trash"></i> Markierte Beute l&ouml;schen</button>';
			}else{
				$beuteentfernen = '';
			}

			$c = $this->parser->parse('admin_raid', array('magic' => $magic,
														  'msg' => $msg,
														  'status' => $this->status[$r1[0]['active']],
														  'punktemodus' => $this->modus[$r1[0]['modus']],
														  'aktionen' => $aktionen,
														  'raid' => $r1,
														  'pool' => $r3,
														  'beute' => $r4,
														  'punkteproraid' => $r1[0]['bonuspunkte'],
														  'beuteentfernen' => $beuteentfernen,
														  'lootfuer' => count($b),
														  'bonusfuer' => count($bonusberechtigt),
														  'teiln_anz' => count($r2),
														  'teilnehmer' => $r2), true);
		// ÜBERSICHTSSEITE DER RAIDS
		}else{
			
			if(isset($_POST['raidneusubmit'])){
			
				$this->db->insert('raids', array('raidid' => mt_rand(10000, 99999),
												 'schluessel' => '12345',
												 'konto' => $this->input->post('raidneukonto')));
												 
				$msg = '<div class="alert alert-success" role="alert">Neuer Raid ('.$this->input->post('raidneukonto').') wurde angelegt.</div>';
			}
			
			
			$konten[0] = "Konto wählen ...";	
			$r = $this->admin_model->getKontenFrei();
			if(!empty($r)){
				foreach($r as $it){
					$konten[$it['kurz']] = $it['name'];
				}
			}
						
			$r = $this->admin_model->getRaids();
			if(!empty($r)){
				foreach($r as &$result){
					$result['konto'] = strtolower($result['konto']);
					$result['status'] = $this->status[$result['active']];
					$date = explode("-", substr($result['timestamp'], 0, 10));
					$result['timestamp'] = $date[2].".".$date[1].".".$date[0];
				}
			}else{
				$msg = '<div class="alert alert-warning" role="alert">Noch keine Raids angelegt.</div>';
			}
			
			$this->load->helper('form');
			$c = $this->parser->parse('admin_raids', array('msg' => $msg,
														   'kontoauswahl' => form_dropdown('raidneukonto', $konten, '', 'class="form-control"'),
														   'raid' => $r), true);			
		}
		
		$this->parser->parse('admin_main', array('raids_active' => 'active',
												 'content' => $c));
	}
	
	
	
	public function konten(){
	     // Session ID vergeben? -> Falls nicht, redirect!
	    if(!isset($_SESSION['sessid'])){
	        redirect('start');
	    }
		
		// Neues Konto speichern
		if($this->input->post('kontoneusubmit')){
			$this->load->library('form_validation');	
			$this->form_validation->set_rules('kontoneuname', 'kontoneuname', 'required|trim');
			$this->form_validation->set_rules('kontoneukurz', 'kontoneukurz', 'required|trim|max_length[4]');
			$this->form_validation->set_rules('kontoneumodus', 'kontoneumodus', 'required');
			$this->form_validation->set_rules('kontoneubonus', 'kontoneubonus', 'required|trim|integer|greater_than[-1]');
			$this->form_validation->set_rules('kontoneuinit', 'kontoneuinit', 'required|trim|integer|greater_than[-1]');
			$this->form_validation->set_rules('kontoneuicon', 'kontoneuicon', 'required|trim');
			
			if($this->form_validation->run()){

				$this->db->insert('konten', array('name' => $this->input->post('kontoneuname'),
												  'kurz' => $this->input->post('kontoneukurz'),
												  'modus' => $this->input->post('kontoneumodus'),
												  'bonuspunkte' => $this->input->post('kontoneubonus'),
												  'icon' => $this->input->post('kontoneuicon')));			
				
				$this->db->query('INSERT INTO bonus (konto, spieler, wert) SELECT "'.$this->input->post('kontoneukurz').'", name, '.$this->input->post('kontoneuinit').' FROM spieler WHERE parent IS NULL;');
					
			}	
		}
		

		// Alle Konten abrufen
		$this->load->model('admin_model');
		$r = $this->admin_model->getKonten();
		if(!empty($r)){
			foreach($r as &$result){
				$result['modus'] = $this->modus[$result['modus']];
			}
		}
		
		// Ordner mit den Raidicons
		$this->load->helper('directory');
		$map = directory_map('./img/raidicons');
		foreach($map as $m){
			$icons[]['icon'] = $m;
		}
		
		$this->load->helper('form');
		$c = $this->parser->parse('admin_konten', array('icons' => $icons,
														'neumodus' => form_dropdown('kontoneumodus', $this->modus, '', 'class="form-control"'),
														'konto' => $r), true);
																													
														
																
		$this->parser->parse('admin_main', array('konten_active' => 'active',
												 'content' => $c));
	}
	
	
	
	public function einstellungen(){
		
		$c = $this->parser->parse('admin_einstellungen', array(), true);
																
		$this->parser->parse('admin_main', array('einstellungen_active' => 'active',
												 'content' => $c));		
		
	}
	
	

}

?>