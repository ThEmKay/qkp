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
          background: url(<?php echo base_url(); ?>img/darkportal.jpg) no-repeat center center fixed; 
          -webkit-background-size: cover;
          -moz-background-size: cover;
          -o-background-size: cover;
          background-size: cover;
        }    
        body{
          background: transparent;
          padding-bottom: 20px;
          padding-left: 5%;
          padding-right: 5%
        }
        .card{
          opacity: .8;
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
        
        .position1, .position2, .position3{
       		height: 500px
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
        <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-lock"></i> Admin Control Panel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="<?php echo current_url(); ?>" method="post">
              <div class="modal-body">
				<input type="text" name="adminpasswort" placeholder="Admin-Passwort" class="form-control" />
              </div>
              <div class="modal-footer">
              	<button type="submit" class="btn btn-primary"><i class="fas fa-unlock-alt"></i> Log In</button>
              </div>
              </form>
            </div>
          </div>
        </div> 
        
        
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
		  <a class="navbar-brand" href="#">QuickKP</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>
		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
			<div class="mr-auto">{admincp}</div>
			
			    <span class="navbar-text">
      {position5}
    </span>
			
			
		  </div>
		</nav>                    
        <div class="container-fluid">
          <div>&nbsp;</div>
          <div class="jumbotron">
          	asd
          </div>
          <div class="row">
            <div class="col-sm-6 col-md-3">
              <div class="card position1">	
                <div class="card-body">
                  {position1}
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-md-3">
              <div class="card position2">
              	<div class="card-body" style="overflow-y:scroll"> 
				  {position2}
				</div>
              </div>
            </div>
            <div class="col-sm-6 col-md-6">
              <div class="card position3" style="overflow-y:scroll">
                <div class="card-body">
					{position3}
                </div>
              </div>
            </div>
          </div>
          <div>&nbsp;</div>
          <div class="row">
            <div class="col-12 col-sm-12 col-md-12">
              <div class="card position4">	
                <div class="card-body">
                  {position4}
                </div>
              </div>
            </div>
          </div>         
        </div>

      
    </body>
</html>