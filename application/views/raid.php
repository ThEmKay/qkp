<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">      
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    </head>
    <body>                                                                                                                                                                                                        
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
        <script>
          $(function () {
            $('[data-toggle="tooltip"]').tooltip()
          })
          
          $(document).ready(function(){
            $( "#accordion" ).accordion({collapsible: false, heightStyle: "content", active: {acc_active}});
            $("[name='selTwink']").on("change", function(){
              if($(this).val() == "no"){
                $("[name='bonus']").show();  
              }else{
                $("[name='bonus']").hide();
              }
            });
          });         
        </script>
        <style>
        
          body{
              background-color: #f4f4f4;
          }
        
          ul{   border: 1px solid #eee;
              width: 142px;
              min-height: 20px;
              list-style-type: none;
              margin: 0;
              padding: 5px 0 0 0;
              float: left;
              margin-right: 10px;}
              
              li{ 
                  margin: 0 5px 5px 5px;
                  padding: 5px;
                  font-size: 1em;
                  width: 120px;
                }
                  
                  
                  .col{
                    min-height: 200px
                  }
                  
                  table{
                    width: 100%
                  }
                  
                  .druide{
                      color: #FF7D0A
                  }
                  .jaeger{
                      color: #ABD473
                  }
                  .magier{
                      color: #69CCF0
                  }
                  .paladin{
                      color: #f58cba
                  }
                  .priester{
                      color: #fff
                  }
                  .schurke{
                      color: #fff569
                  }
                  .krieger{
                      color: #c79c6e
                  }
                  .hexenmeister{
                      color: #9482C9
                  }
     
        </style>   
             
        <nav class="navbar navbar-expand-lg navbar-light bg-dark">
            <form class="form-inline" name="frmKonto" method="POST" action="<?php echo current_url(); ?>" style="margin:0">
                <span style="color:#fff"><b>Raid-ID:</b> {raidid}&nbsp;-&nbsp;<b>Schl&uuml;ssel:</b> {schluessel}&nbsp;-&nbsp;
                <b>Live-Link:</b>&nbsp;<a target="blank" href="<?php echo site_url('live'); ?>/index/{raidid}"><i class="fas fa-external-link-alt"></i></a>&nbsp;-&nbsp;<b>Konto:</b>&nbsp;</span>
                <select class="custom-select mr-sm-5" style="margin-right:0 !important" name="selKonto" onchange="frmKonto.submit();">
                    {konten}
                    <option {checked} value="{kurz}">{name}</option>
                    {/konten}
                </select>
                &nbsp;
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#charakterModal">
                  <i class="fas fa-user" title="Neuer Charakter" data-toggle="tooltip" data-placement="bottom">
                    <i class="fas fa-plus"></i>
                  </i>&nbsp;
                </button>
                &nbsp;
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#kontoModal">
                  <i class="fas fa-coins" title="Neues Punktekonto" data-toggle="tooltip" data-placement="bottom"></i>
                  <i class="fas fa-plus"></i>
                </button>
            </form>
        </nav>
        <div class="modal fade" id="charakterModal" tabindex="-1" role="dialog" aria-labelledby="charakterModal" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Charakter hinzuf&uuml;gen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="<?php echo current_url(); ?>" method="POST">
                  <div class="form-group">
                    <label>Name</label>
                    <input class="form-control" type="text" placeholder="Name" name="txtCharakterNeu" />
                  </div>
                  <div class="form-group">
                    <label>Klasse</label>
                    <select class="form-control" name="selCharakterKlasse">
                      <option value="druide">Druide</option>
                      <option value="hexenmeister">Hexenmeister</option>
                      <option value="jaeger">J&auml;ger</option>
                      <option value="krieger">Krieger</option>
                      <option value="magier">Magier</option>
                      <option value="paladin">Paladin</option>
                      <option value="priester">Priester</option>
                      <option value="schurke">Schurke</option>
                    </select> 
                  </div>
                  <div class="form-group">                  
                    <label>Twink?</label>
                    <select class="form-control" name="selTwink">
                      <option value="no">Nein</option>
                      {alle}
                      <option value="{name}">
                        {name}
                      </option>
                      {/alle}
                    </select>
                  </div>                  
                  <div class="form-group" name="bonus">
                    <label>Startbonus</label>
                    {konten2}
                      <input placeholder="{kurz}" class="form-control" type="text" name="intBonus[{kurz}]" size="2" style="margin-bottom:3px" />
                    {/konten2}
                  </div>
              </div>
              <input type="submit" name="sbmCharakterNeu" class="btn btn-success" value="Speichern" />
              <div>&nbsp;</div>
              </form>
            </div>
          </div>
        </div>
        <div class="modal fade" id="kontoModal" tabindex="-1" role="dialog" aria-labelledby="kontoModal" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Neues Punktekonto anlegen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="<?php echo current_url(); ?>" method="POST">
                  <div class="form-group">
                    <label>Name</label>
                    <input class="form-control" type="text" placeholder="Name" name="txtKontoNeu" />
                  </div>
                  <div class="form-group">
                    <label>K&uuml;rzel</label>
                    <input class="form-control" type="text" placeholder="Name" name="txtKontoNeuKurz" />
                  </div>
              </div>
              <input type="submit" name="sbmKontoNeu" class="btn btn-success" value="Speichern" />
              <div>&nbsp;</div>
              </form>
            </div>
          </div>
        </div>        
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div id="accordion">
                    <h3>Teilnehmer</h3>
                    <div style="background-position: 0% 100%; background-image:url(<?php echo base_url('img/ironforge.jpg') ?>);">
                        <form action="<?php echo site_url('raid'); ?>" method="POST">
                          <div class="row" style="background-color:#333;opacity:.7;padding:3px;margin-bottom:3px">
                            {klasse}
                            <div class="col {klasse}">
                              <div style="margin-bottom:5px">
                                <img src="<?php echo base_url(); ?>img/class_{klasse}.jpg" />
                              </div>
                              {spieler}
                              <div class="form-check">
                                <input class="form-check-input" name="teilnehmer[]" type="checkbox" {checked} value="{name}" id="{name}">
                                <label class="form-check-label" for="{name}" style="margin-bottom:3px">
                                  {name}
                                  {alt}<div class="{alt_klasse}"><img style="width:15px" src="<?php echo base_url(); ?>img/class_{alt_klasse}.jpg" />{alt_name}</div>{/alt}                                 
                                </label>
                                &nbsp;
                              </div>
                              {/spieler}
                            </div>
                            {/klasse}
                          </div>
                          <input class="btn btn-success" type="submit" name="sbmTeilnehmer" value="Speichern" />                
                        </form>                         
                    </div>
                    <h3>Beute</h3>
                    <div style="background-position: 0% 100%; background-image:url(<?php echo base_url('img/gryphon.jpg') ?>);">
                      {beute}
                        {msg}
                          <div class="alert alert-warning" role="alert">{text}</div>
                        {/msg}
                        {loothinzu}
                        <form class="form-inline" action="<?php echo site_url('raid'); ?>" method="POST">
                            <input name="txtGegenstand" class="form-control" type="text" placeholder="Gegenstand" />&nbsp;
                            <select name="selSpieler" class="custom-select">
                            {spielerliste}
                                <option value="{name}">{name}</option>
                            {/spielerliste}
                            </select>
                            &nbsp;<input name="intWert" class="form-control" size="3" type="text" placeholder="Wert" />
                            &nbsp;<input type="submit" class="btn btn-success" name="sbmLoot" value="Speichern" />
                        </form>
                        <hr />
                        {/loothinzu}
                        <form action="<?php echo site_url('raid'); ?>" method="POST">
                        <table class="table-sm table-striped table-hover table-light">
                          <thead class="thead-dark">
                          <tr>
                            <th style="width:5%"">
                              &nbsp;
                            </th>
                            <th style="width:10%">
                              Punkte
                            </th>
                            <th style="width:20%">
                              Spieler
                            </th>
                            <th style="width:65%">
                              Gegenstand
                            </th>
                          </tr>
                          </thead>
                        {beuteliste}
                          <tr>
                            <td><input name="chkLoot[]" value="{lootid}" type="checkbox" /></td><td>{wert}</td><td>{spieler}</td><td>{gegenstand}</td>
                          </tr>
                        {/beuteliste}
                        </table>
                        <div>&nbsp;</div>
                        <input type="submit" class="btn btn-danger" name="rmvLoot" value="Loot entfernen" />
                        </form>
                      {/beute}
                    </div>
                    <h3>Live-Daten</h3>
                    <div style="background-position: 0% 100%; background-image:url(<?php echo base_url('img/darkportal.jpg') ?>);">
                      {live}
                        <div style="padding:5px;color:#fff">
                          <b>Teilnehmer:</b> {anzahl_teilnehmer}
                        </div>
                        <div style="padding:5px;color:#fff">
                          <b>Bonuspunkte:</b> {bonus}
                        </div>
                        <div style="padding:5px;color:#fff">
                          <b>Punktestand:</b>
                        </div>
                        <table class="table-sm table-striped table-hover table-light">
                            <thead class="thead-dark">
                            <tr>
                              <th style="width:40%"">
                                Spieler
                              </th>
                              <th style="width:20%">
                                Punkte ausgegeben
                              </th>
                              <th style="width:20%">
                                Punkte gesamt
                              </th>
                              <th style="width:20%">
                                Punkte Rest
                              </th>
                            </tr>
                            </thead>                        
                            {dkpstand}
                            <tr>
                              <td>
                                {spieler}
                              </td>
                              <td>
                                {wert}
                              </td>
                              <td>
                                {gesamt}
                              </td>
                              <td>
                                {rest}
                              </td>
                            </tr>
                            {/dkpstand}
                        </table>
                      {/live}
                    </div>
                    <h3>Abschluss</h3>
                    <div style="padding-bottom:100px;background-position: 0% 100%; background-image:url(<?php echo base_url('img/announcement.jpg') ?>);">
                      <span style="color:#fff">Voraussichtliche Bonuspunkte nach dem Raid:</span>
                      {sum}
                        <form action="<?php echo current_url(); ?>" method="POST">
                          <table class="table table-sm table-striped table-hover table-light">
                          <thead class="thead-dark">
                          <tr>
                            <th>
                                Spieler
                            </th>
                            <th>
                                Alt
                            </th>
                            <th>
                                Neu
                            </th>
                          </tr>
                          </thead>
                          {punktestand}
                          <tr style="font-weight:{highlight}">
                              <td>
                                {spieler}
                              </td><td>{bonus_alt}</td><td>{bonus_neu}</td>
                          </tr>
                          {/punktestand}
                          </table>
                        <input type="submit" name="sbmEnd" class="btn btn-warning" value="Raid beenden und Punkte schreiben" />
                      </form>
                      {/sum}
                    </div>
                    <h3>Danger-Zone</h3>
                    <div>
                        <form action="<?php echo current_url(); ?>" method="POST">
                            <input type="submit" name="sbmDeleteRaid" class="btn btn-danger" value="Raid verwerfen" />
                            <input type="submit" name="sbmParcRaid" class="btn btn-warning" value="Raid parken" />
                            <input type="submit" name="sbmBackup" class="btn btn-warning" value="Punktestand sichern" />
                        </form>
                    </div>
                  </div>
                </div>
            </div>       
        </div>    
    </body>
</html>