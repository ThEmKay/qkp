<?php

class punkte extends CI_Controller{

    public function index(){
    
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
    
        // Auswahlliste Klassen
        $query = $this->db->query("SELECT DISTINCT klasse AS value FROM spieler ORDER BY klasse ASC");
        $result = $query->result_array();

        $klasse[0]['klasse'] = 'alle';
        $klasse[0]['value'] = 'alle';

        foreach($result as $key => $res){
        
            $klasse[$key+1]['klasse'] = ucfirst($res['value']);
            $klasse[$key+1]['value'] = $res['value'];
          
            if($res['value'] == $this->input->post('selKlasse')){
              $klasse[$key+1]['selected'] = 'selected'; 
            }else{
              $klasse[$key+1]['selected'] = '';
            } 
        }
        $vars['klassenfilter'] = $klasse;
        
        // Start Query Bonusliste holen
        $this->db->select('*')->from('bonus')->join('spieler', 'spieler.name = bonus.spieler', 'left');
        
        if($this->input->post('selKonto') != null){
          $this->db->where('konto', $this->input->post('selKonto'));
        }else{
          $this->db->where('konto', $vars['kontofilter'][0]['kurz']);
        }
        
        if($this->input->post('selKlasse') != null){
          if($this->input->post('selKlasse') != "alle"){
            $this->db->where('klasse', $this->input->post('selKlasse'));                    
          }
        }
        
        if($this->input->post('selOrder') != null){
          switch($this->input->post('selOrder')){
            case 'name': $ascdesc = 'asc'; break;
            case 'wert': $ascdesc = 'desc'; break;
            default: $ascdesc = 'asc'; break;
          }
          $this->db->order_by($this->input->post('selOrder'), $ascdesc);
        }else{
          $this->db->order_by('name', 'asc');
        }
        
        
        
        $query = $this->db->get();
        
        
        $vars['punktestand'] = $query->result_array();
        
        $this->parser->parse('punkte', $vars);
    
    }










}


?>