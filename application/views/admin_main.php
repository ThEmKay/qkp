<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    </head>
    <body style="padding-bottom:25px">
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script
  src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
  integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
  crossorigin="anonymous"></script>
        <style>
        html{ 
          background: url(<?php echo base_url(); ?>img/bg1.jpg) no-repeat center center fixed; 
          -webkit-background-size: cover;
          -moz-background-size: cover;
          -o-background-size: cover;
          background-size: cover;
        }    
        body{
          background: #fff;
          padding-top: 5px;
        }
        .card{
          opacity: .9;
          margin-top: 3px
        }
        select{
          margin-bottom: 2px
        }
        header{
        	background-color: purple;
			padding: 1em;
			margin-top: 1em;
			margin-bottom: 1em;
			color: #fff
        } 
        nav{
        	margin-bottom: 1em;
        }
        .fa-plus-square{
        	cursor: pointer
        }           
        .fa-save{
        	cursor: pointer
        }
        a:hover{
        	text-decoration: none
        }
        .nav-link{
        	font-size: 1.5em
        }
        </style>
        <script>
          
        </script>
		<header>
        	<h1>Semper Fidelis DKP-Backend</h1>
        </header>
        <div class="container-fluid">
			<nav class="navbar navbar-expand-lg navbar-light">
			  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
			    <span class="navbar-toggler-icon"></span>
			  </button>
			  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
			    <div class="navbar-nav">
			      <a class="nav-item nav-link {spieler_active}" href="<?php echo site_url('admin/index/'); ?>"><i class="fas fa-users"></i> Spieler</a>&nbsp;
			      <a class="nav-item nav-link {raids_active}" href="<?php echo site_url('admin/raids/'); ?>"><i class="fab fa-gripfire"></i> Raids</a>&nbsp;
			      <a class="nav-item nav-link {konten_active}" href="<?php echo site_url('admin/konten/'); ?>"><i class="fas fa-coins"></i> Konten</a>&nbsp;
			      <a class="nav-item nav-link {einstellungen_active}" href="<?php echo site_url('admin/einstellungen/'); ?>"><i class="fas fa-cogs"></i> Einstellungen</a>&nbsp;
			    </div>
			  </div>
			</nav>        	
          <div class="row">
			{content}
          </div>
        </div>
        <div style="border-top:1px solid #f4f4f4;text-align:center;position:fixed;width:100%;bottom:0px;background-color:purple;color:#f4f4f4;padding:3px">Made with &hearts; by Basti</div>
    </body>
</html>