<html>
  <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <style>
      html { 
        background: url(<?php echo base_url(); ?>img/darkportal.jpg) no-repeat center center fixed; 
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
      }
      
      body{
          background: transparent;
      }
      
      span{
        color: #fff;
        font-weight: bold
      }
                  
    </style>
  </head>
  <body>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>  

    
    <script>
    
    function holen(){
                  
                  alert(123);
                  
      $.get( "https://classicdb.ch/ajax.php?item=16827", function( data ) {

          alert(data);
        });
    
    
    }
    
    
    </script>
    
    <div class="container-fluid">
    
      <a href="http://classicdb.ch/?item=16827"><span>asdasda</span></a>
      
      <span onclick="holen();">asdasdjkasdjkalsdjkl</span>
      
      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
          <p><a href="<?php echo site_url(); ?>" type="button" class="btn btn-dark"><i class="fas fa-arrow-circle-left"></i> zur&uuml;ck</a></p>
          <form class="form-inline" action="<?php echo current_url(); ?>" method="post" name="frmPunkte">
            <span>Punktekonto:</span>&nbsp;
          </label>
          <select name="selKonto" class="form-control form-inline" onchange="frmPunkte.submit()">
            {kontofilter}
              <option value="{kurz}" {selected}>{name}</option>
            {/kontofilter}
          </select>
          &nbsp;
          <label>
            <span>Klasse:</span>&nbsp;
          </label>
          <select name="selKlasse" class="form-control form-inline" onchange="frmPunkte.submit()">
            {klassenfilter}
            <option value="{value}" {selected}>{klasse}</option>
            {/klassenfilter}
          </select>
          </form>
  
        </div>
        <div class="col-md-2"></div>
      </div>
    </div>
  </body>
</html>