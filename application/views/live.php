<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    </head>
    <body>                                                                                                                                                                                                        
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
        <style>
        html { 
              background: url(<?php echo base_url(); ?>img/World-of-Warcraft-Art.jpg) no-repeat center center fixed; 
              -webkit-background-size: cover;
              -moz-background-size: cover;
              -o-background-size: cover;
              background-size: cover;
            }
            
            body{
                background: transparent;
                padding-bottom: 20px
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
                  
            .ui-widget-content{
              opacity: .9
            }
             
            .col{
              min-height: 200px
            }
            td img{
              width: 20px
            }
                              
        </style>   
             
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    {msg}
                    {datum}
                    {active}
                    {live}
                    <div id="accordion">
                      <h3>Punktestand</h3>
                      <div>
                        <div class="alert alert-info" role="alert">
                          F&uuml;r Bonuspunkte qualifizierte Spieler werden <strong>hervorgehoben</strong>.
                        </div>
                        <table class="table table-striped table-sm table-hover table-bordered">
                          <tr>
                            <th>
                              Spieler
                            </th>
                            <th>
                              Startpunkte
                            </th>
                            <th>
                              Ausgegeben
                            </th>
                            <th>
                              Rest
                            </th>                            
                          </tr>
                          {punktestand}
                          <tr>
                            <td><img src="<?php echo base_url('img') ?>/class_{klasse}.jpg" /> {spieler}</td>
                            <td style="text-align:right;padding-right:10px">{wert}</td>
                            <td style="text-align:right;padding-right:10px">{ausgegeben}</td>
                            <td style="text-align:right;padding-right:10px"><b>{rest}</b></td>
                          </tr>
                          {/punktestand}
                        </table>
                      </div>
                      <h3>Beute</h3>
                      <div>
                        <table class="table table-striped table-sm table-hover table-bordered">
                          <tr>
                            <th>
                              Spieler
                            </th>
                            <th>
                              Gegenstand
                            </th>
                            <th>
                              Wert
                            </th>                           
                          </tr>                      
                          {loot}
                          <tr style="background-color:{color}">
                            <td><img src="<?php echo base_url('img') ?>/class_{klasse}.jpg" /> {spieler}</td>
                            <td>{gegenstand}</td>
                            <td style="text-align:right;padding-right:10px">{wert}</td>
                          </tr>
                          {/loot}
                        </table>
                      </div>
                    </div>
                    {/live}
                    {final}
                    <div id="accordion">
                      <h3>Punktestand</h3>
                      <div>
                        <div class="alert alert-info" role="alert">
                          F&uuml;r Bonuspunkte qualifizierte Spieler werden <strong>hervorgehoben</strong>.
                        </div>                      
                        <table class="table table-sm table-striped table-hover table-bordered">
                          <tr>
                            <th>
                              Spieler
                            </th>
                            <th>
                              Ausgegeben
                            </th>                           
                          </tr>
                          {punktestand}
                          <tr>
                            <td><img src="<?php echo base_url('img') ?>/class_{klasse}.jpg" /> {spieler}</td>
                            <td style="text-align:right;padding-right:10px">{ausgegeben}</td>
                          </tr>
                          {/punktestand}
                        </table>
                      </div>
                      <h3>Beute</h3>
                      <div>
                        <table class="table table-sm table-striped table-hover table">
                          <tr>
                            <th>
                              Spieler
                            </th>
                            <th>
                              Gegenstand
                            </th>
                            <th>
                              Wert
                            </th>                           
                          </tr>                      
                          {loot}
                          <tr>
                            <td><img src="<?php echo base_url('img') ?>/class_{klasse}.jpg" /> {spieler}</td>
                            <td>{gegenstand}</td>
                            <td style="text-align:right;padding-right:10px">{wert}</td>
                          </tr>
                          {/loot}
                        </table>
                      </div>
                    </div>
                    {/final}                    
                </div>
            </div>       
        </div>
        
  <script>
  $( function() {
    $( "#accordion" ).accordion({collapsible: false, heightStyle: "content", active: 0});
  } );
  </script>
        
    </body>
</html>