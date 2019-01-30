<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    </head>
    <body>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <style>
        html{ 
          background: url(<?php echo base_url(); ?>img/bg1.jpg) no-repeat center center fixed; 
          -webkit-background-size: cover;
          -moz-background-size: cover;
          -o-background-size: cover;
          background-size: cover;
        }    
        body{
          background: transparent;
          padding-top: 5px;
          padding-left: 10%;
          padding-right: 10%;
          padding-bottom: 10%
        }
        .card{
          opacity: .9;
          margin-top: 3px
        }
        select{
          margin-bottom: 2px
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
        <script>
        
        var konto = "AQ20";
        var klasse = "druide";
        
        $(function () {
              $('[data-toggle="tooltip"]').tooltip();
              
              getData();
                            
              $("#selKonto").bind("change", function(){
                konto = $(this).val();
                getData();
              });
              
              $("#selKlasse").bind("change", function(){
                klasse = $(this).val();
                getData();              
              });              
        });
        
        function getLoot(s){
            $("#loot").load("<?php echo site_url(); ?>/punkte/loot/"+s+"/"+konto, {}, function(d){       
              $("#loot").html(d);
              $("#info-title").html("Loot von <u>"+s+"</u> in <u>"+konto+"</u>");
              $("#lootinfo").modal("toggle");    
            });
        }
        
        function getData(){
          $("#punkte").html("<div style=\"margin-top:10px;text-align:center\"><img src=\"<?php echo base_url('img/477.gif'); ?>\" /></div>");
          setTimeout(function(){
            $("#punkte").load("<?php echo site_url(); ?>/punkte/index/"+konto+"/"+klasse+"", {}, function(){       
              $(".spieler").each(function(){
                $(this).bind("click", function(){
                  getLoot($(this).attr("data-main").trim());
                });
              });  
            });
          }, 1000); 
        }
  
        </script>
        <nav class="nav justify-content-end nav-pills">
            <!--<button type="button" class="btn btn-outline-danger" style="margin:.5em">made with &#9825;</button>-->
            <button type="button" class="btn btn-outline-warning" data-toggle="modal" data-target="#disclaimer" style="margin:.5em">Disclaimer</button>
        </nav>
        <div class="modal fade" id="disclaimer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Disclaimer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                World of Warcraft&trade; and Blizzard Entertainment&reg; are 
              	all trademarks or registered trademarks of Blizzard 
              	Entertainment in the United States and/or other 
              	countries. These terms and all related materials, 
              	logos, and images are copyright &copy; Blizzard 
              	Entertainment. This site is in no way associated with 
              	or endorsed by Blizzard Entertainment&reg;.
                <hr />
                Alle verwendeten Icons kommen hierher: https://fontawesome.com/license - thX!
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="lootinfo" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="info-title">Lootinformation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body" id="loot">
                &nbsp;
              </div>
            </div>
          </div>
        </div>                       
        <div class="container-fluid">
            <div class="jumbotron">
              <h1 class="display-6">Raidb&uuml;ndnis "Wir wipen" - Punkteverwaltung</h1>
              <p class="lead">Folgende Gilden sind Teil des aktuellen B&uuml;ndnisses:
              <p><b>&raquo; Geheime Zuflucht</b></p>
              <p><b>&raquo; Arms of Lordaeron</b></p>
              <p><b>&raquo; Semper Fidelis</b></p>
              <hr class="my-4">
              <p>Wir spielen gemeinsam auf dem WoW-Classic Server <i>Nefarian</i>: <a href="http://classic-wow.org" target="blank">Link <i class="fas fa-external-link-alt"></i></a>.</p>
              <p class="lead">
                <a class="btn btn-dark btn-lg" href="http://heteria.de/eqdkp" role="button"><i class="far fa-calendar-alt"></i> Raidplaner aufrufen</a>
              </p>
            </div>
            {msg}{text}{/msg}
            <?php echo validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <form name="frmStart" action="<?php echo site_url(); ?>" method="POST">
              <div class="row">
                <div class="col-sm-6 col-md-3">
                  <div class="card">
                    <img class="card-img-top" src="<?php echo base_url(); ?>/img/Circle-of-Light.jpg" alt="Card image cap">
                    <div class="card-body">
                      <h5 class="card-title">Termine</h5>
                      <ul class="list-group list-group-flush">
                        <li class="list-group-item" data-toggle="tooltip" data-placement="left" title="Zul'Gurub"><img style="width:35px" src="<?php echo base_url(); ?>/img/zg.png" /> So. 19:30 bis 22:00 Uhr</li>
                        <li class="list-group-item" data-toggle="tooltip" data-placement="left" title="Geschmolzener Kern"><img style="width:35px" src="<?php echo base_url(); ?>/img/mc.png" /> Mo. 19:30 bis 21:15 Uhr</li>
                        <li class="list-group-item" data-toggle="tooltip" data-placement="left" title="Onyxias Hort"><img style="width:35px" src="<?php echo base_url(); ?>/img/ony.png" /> Mo. 21:25 bis 22:00 Uhr</li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-md-3">
                  <div class="card">
                    <img class="card-img-top" src="<?php echo base_url(); ?>/img/card3.jpg" alt="Card image cap">
                    <div class="card-body">
                      <h5 class="card-title">Historie</h5>
                      <p class="card-text">Beute und Bonuspunkte der letzten Raids ansehen.</p>
                      <ul>
                        {history}
                        <li>
                          <a href="<?php echo site_url('live'); ?>/index/{raidid}">{timestamp}</a>
                        </li>
                        {/history}
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-md-6">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">Bonuspunkte</h5>
                      <select name="selKonto" class="form-control form-inline" id="selKonto">
                        {kontofilter}
                          <option value="{kurz}" {selected}>{name}</option>
                        {/kontofilter}
                      </select>
                      <select name="selKlasse" id="selKlasse" class="form-control form-inline">
                        {klassenfilter}
                        <option value="{value}" {selected}>{klasse}</option>
                        {/klassenfilter}
                      </select>
                      <div id="punkte" >
                        &nbsp;
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">                               
                <div class="col-sm-3">
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
                <div class="col-sm-3">
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
              </div>
           </form>           
        </div>
    </body>
</html>