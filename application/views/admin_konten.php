<script>
$(document).ready(function(){
	$('.fa-plus-square').bind('click', function(){
		$('#kontoneu').toggle();
	});	
});
</script>
<div style="position:absolute;top:5px;right:5px;z-index:9999">
	<img src="<?php echo base_url('img'); ?>/chest.png" />
</div>
<div class="modal fade" id="kontoneu" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="fas fa-coins"></i> Neues Konto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo current_url(); ?>" method="post">
      <div class="modal-body">
      	<div class="form-group">
      		<input type="text" placeholder="Kontoname" class="form-control" value="<?php echo set_value('kontoneuname'); ?>" name="kontoneuname" />
        </div>
      	<div class="form-group">
      		<input type="text" placeholder="K&uuml;rzel (max. 4 Zeichen)" class="form-control" size="4" maxlength="4" value="<?php echo set_value('kontoneukurz'); ?>" name="kontoneukurz" />
      	</div>
      	<div class="form-group">
	      	<div class="form-check form-check-inline">
			  <input class="form-check-input" type="radio" name="kontoneumodus" id="101er" value="0">
			  <label class="form-check-label" for="101er">
			  	101er System
			  </label>
			</div>
	      	<div class="form-check form-check-inline">
			  <input class="form-check-input" type="radio" name="kontoneumodus" id="fortlaufend" value="1">
			  <label class="form-check-label" for="fortlaufend">
			  	Fortlaufend
			  </label>
			</div>			
      	</div>      	
      	<div class="form-group">
      		<input type="text" class="form-control" name="kontoneubonus" placeholder="Bonuspunkte pro Raid" value="<?php echo set_value('kontoneubonus'); ?>" />
      	</div>
      	<div class="form-group">
      		<input type="text" class="form-control" name="kontoneuinit" value="<?php echo set_value('kontoneuinit'); ?>" placeholder="Initialwert f&uuml;r alle Spieler/innen" />
      	</div>
      	<div class="form-group">
	      	{icons}
			<div class="form-check form-check-inline">
			  <input class="form-check-input" type="radio" name="kontoneuicon" id="{icon}" value="{icon}">
			  <label class="form-check-label" for="{icon}">
			  	<img style="width:30px" src="<?php echo base_url('img/raidicons'); ?>/{icon}" />
			  </label>
			</div>
			{/icons}
		</div>
      </div>
      <div class="modal-footer">
      	<button type="submit" name="kontoneusubmit" value="1" class="btn btn-primary"><i class="fas fa-unlock-alt"></i> Konto anlegen</button>
      </div>
      </form>
    </div>
  </div>
</div>
<div class="col-12">
	<?php echo validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>
	<form class="form-inline">
		<button type="button" data-toggle="modal" data-target="#kontoneu" class="btn btn-primary form-inline"><i class="fas fa-coins"></i> Neues Konto</button>
	</form>	
	<table class="table table-striped table-dark">
		<tr>
			<th style="width:20%">K&uuml;rzel</th>
			<th style="width:30%">Bezeichnung</th>
			<th style="width:25%">Modus</th>
			<th style="width:25%">Bonuspunkte pro Raid</th>
		</tr>
		{konto}
		<tr>
			<td>{kurz}</td>		
			<td><span style="line-height:31px">{name}</span></td>
			<td>{modus}</td>
			<td>{bonuspunkte}</td>
		</tr>
		{/konto}
	</table>	
	
</div>