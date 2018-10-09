<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    </head>
    <body>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <style>
        .card{
            margin: 1rem
        }
        
        html { 
              background: url(<?php echo base_url(); ?>img/bg1.jpg) no-repeat center center fixed; 
              -webkit-background-size: cover;
              -moz-background-size: cover;
              -o-background-size: cover;
              background-size: cover;
            }
            
            body{
                background: transparent
            }
            
            .card{
                opacity: .8
            }
                    
        </style>
        
        <div class="container">
            {msg}Fehlermeldung: {text}{/msg}
            <form name="frmStart" action="<?php echo site_url(); ?>" method="POST">
              <div class="row">
                <div class="card" style="width: 18rem;">
                  <img style="width:286px" class="card-img-top" src="<?php echo base_url(); ?>/img/card1.jpg" alt="Card image cap">
                  <div class="card-body">
                    <h5 class="card-title">Raid aufrufen</h5>
                    <p class="card-text">Einen bereits begonnenen Raid mithilfe der Id wieder &ouml;ffnen, um diesen weiter zu bearbeiten.</p>
                    <input placeholder="Raid-Id" class="form-control" type="text" name="raidId" />
                    <input placeholder="Schl&uuml;ssel" class="form-control" style="margin-top:3px" type="text" name="key" />
                    <input class="form-control btn btn-primary" style="margin-top:3px" type="submit" name="oldRaid" value="Aufrufen" />
                  </div>
                </div>
                <div class="card" style="width: 18rem;">
                  <img style="width:286px" class="card-img-top" src="<?php echo base_url(); ?>/img/card2.jpg" alt="Card image cap">
                  <div class="card-body">
                    <h5 class="card-title">Neuer Raid</h5>
                    <p class="card-text">Eine neue Raid-Id anlegen.</p>
                    <input placeholder="Schl&uuml;ssel" class="form-control" style="margin-top:3px" type="text" name="masterkey" />
                    <input class="form-control btn btn-primary" style="margin-top:3px" name="newRaid" type="submit" value="Starten" />
                  </div>
                </div>
                <div class="card" style="width: 18rem;">
                  <img style="width:286px" class="card-img-top" src="<?php echo base_url(); ?>/img/card3.jpg" alt="Card image cap">
                  <div class="card-body">
                    <h5 class="card-title">Historie</h5>
                    <p class="card-text">Beute und Bonuspunkte der letzten Raids ansehen.</p>
                    {history}
                    <a href="<?php echo site_url('live'); ?>/index/{raidid}">{timestamp}</a>
                    {/history}
                  </div>
                </div>                                
              </div>
           </form>           
        </div>
    </body>
</html>