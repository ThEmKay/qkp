<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    </head>
    <body>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <style>
        
        html { 
              background: url(<?php echo base_url(); ?>img/bg1.jpg) no-repeat center center fixed; 
              -webkit-background-size: cover;
              -moz-background-size: cover;
              -o-background-size: cover;
              background-size: cover;
            }
            
            body{
                background: transparent;
                padding-top: 5px
            }
            
            .card{
                opacity: .9
            }
            
            .jumbotron{
              color: #fff;
              padding: 2rem 2rem;
              background-image: url('<?php echo base_url(); ?>/img/announcement.jpg');
              background-position: 50% 50%;
              opacity: .9;
              background-size: cover
            }
                    
        </style>
        
        <div class="container">
            <div class="jumbotron">
              <h1 class="display-5">Semper Fidelis Raid-Punkteverwaltung</h1>
              <p class="lead">Folgende Gilden sind Teil des aktuellen Raidb&uuml;ndnisses:
              <p><b>&raquo; Geheime Zuflucht</b></p>
              <p><b>&raquo; Arms of Lordaeron</b></p>
              <hr class="my-4">
              <p>Wir spielen gemeinsam auf dem WoW-Classic Server <i>Nefarian</i>.</p>
              <p class="lead">
                <a class="btn btn-dark btn-lg" href="<?php echo site_url(); ?>/punkte" role="button">Punkte aller Teilnehmer ansehen</a>
                <a class="btn btn-dark btn-lg" href="http://heteria.de/eqdkp" role="button">Raidplaner aufrufen</a>
              </p>
            </div>
            {msg}{text}{/msg}
            <form name="frmStart" action="<?php echo site_url(); ?>" method="POST">
              <div class="row">
                <div class="col-sm">
                  <div class="card">
                    <img class="card-img-top" src="<?php echo base_url(); ?>/img/card1.jpg" alt="Card image cap">
                    <div class="card-body">
                      <h5 class="card-title">Raid aufrufen</h5>
                      <p class="card-text">Einen bereits begonnenen Raid mithilfe der Id wieder &ouml;ffnen, um diesen weiter zu bearbeiten.</p>
                      <input placeholder="Raid-Id" class="form-control" type="text" name="raidId" />
                      <input placeholder="Schl&uuml;ssel" class="form-control" style="margin-top:3px" type="password" name="key" />
                      <input class="form-control btn btn-primary" style="margin-top:3px" type="submit" name="oldRaid" value="Aufrufen" />
                    </div>
                  </div>
                </div>
                <div class="col-sm">
                  <div class="card">
                    <img class="card-img-top" src="<?php echo base_url(); ?>/img/card2.jpg" alt="Card image cap">
                    <div class="card-body">
                      <h5 class="card-title">Neuer Raid</h5>
                      <p class="card-text">Eine neue Raid-Id anlegen.</p>
                      <input placeholder="Schl&uuml;ssel" class="form-control" style="margin-top:3px" type="password" name="masterkey" />
                      <input class="form-control btn btn-primary" style="margin-top:3px" name="newRaid" type="submit" value="Starten" />
                    </div>
                  </div>
                </div>
                <div class="col-sm">
                  <div class="card">
                    <img class="card-img-top" src="<?php echo base_url(); ?>/img/card3.jpg" alt="Card image cap">
                    <div class="card-body">
                      <h5 class="card-title">Historie</h5>
                      <p class="card-text">Beute und Bonuspunkte der letzten Raids ansehen.</p>
                      {history}
                      <a href="<?php echo site_url('live'); ?>/index/{raidid}">{timestamp}</a>
                      {/history}
                    </div>
                  </div>
                </div>                                
              </div>
           </form>           
        </div>
    </body>
</html>