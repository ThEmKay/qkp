<html>
  <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
          <form class="form-inline" action="<?php echo current_url(); ?>" method="post" name="frmPunkte">
          <label>
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
          <table class="table table-striped table-sm table-hover table-bordered" style="background-color:#fff">
            <tr>
              <th>
                Spieler
              </th>
              <th>
                Bonuspunkte
              </th>                            
            </tr>
            {punktestand}
            <tr>
              <td><img src="<?php echo base_url('img') ?>/class_{klasse}.jpg" /> {spieler}</td>
              <td style="text-align:right;padding-right:10px">{wert}</td>
            </tr>
            {/punktestand}
          </table>  
        </div>
        <div class="col-md-2"></div>
      </div>
    </div>
  </body>
</html>