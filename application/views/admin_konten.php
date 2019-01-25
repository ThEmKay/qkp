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
<div class="col-12">
	<form class="form-inline">
		<button type="button" class="btn btn-primary form-inline"><i class="fas fa-coins"></i> Neues Konto</button>
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
		<tr>
			<td colspan="4">
				<i class="far fa-plus-square fa-2x"></i>
			</td>
		</tr>
		<tbody id="kontoneu" style="display:none">
		<tr>
			<td>
				<input type="text" class="form-control" placeholder="Kürzel" />
			</td>
			<td>
				<input type="text" class="form-control" placeholder="Bezeichnung" />
			</td>
			<td>
				{neumodus}
			</td>
			<td>
				<input type="text" class="form-control" placeholder="Bonuspunkte pro Raid" />
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<input class="form-check-input" type="radio" />
			</td>
			<td style="text-align:right;line-height:31px">
				Startpunkte 
			</td>
			<td>
				<input type="text" class="form-control" placeholder="Startpunkte" />
			</td>
		</tr>
		<tr>
			<td colspan="4" style="text-align:right;line-height:31px">
				<i class="fas fa-save fa-2x kontoneu-save"></i> 
			</td>
		</tr>		
		</tbody>		
	</table>	
	
</div>