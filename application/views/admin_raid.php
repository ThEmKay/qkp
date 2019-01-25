<style>
  #sortable1, #sortable2 {
    border: 1px solid #eee;
    width: 50%;
    min-height: 20px;
    height: 400px;
    overflow-y: scroll;
    list-style-type: none;
    margin: 0;
    padding: 5px 0 0 0;
    float: left;
    z-index: 9999
  }
  #sortable1 li, #sortable2 li {
    margin: 0 5px 5px 5px;
    padding: 5px;
    font-size: 1.2em;
    border: 1px solid
  }
</style>
<script>
	const url = "<?php echo site_url('ajax/getpunkterest'); ?>";
</script>
{magic}
<div style="position:absolute;top:5px;right:5px;z-index:9999">
	<img src="<?php echo base_url('img'); ?>/nef.png" />
</div>
<div class="col-12">{msg}</div>
<div class="col-3 col-lg-3 col-sm-6 col-xs-6 col-md-6">
	<div class="card">
		<div class="card-body">
	  		<h4 class="card-title">Raiddaten</h4>
			{raid}
			<table class="table">
				<tr>
					<td>
						<b>Status</b>
					</td>
					<td>
						{status}
					</td>
				</tr>
				<tr>
					<td>
						<b>ID</b>
					</td>
					<td>
						<span id="raidid">{raidid}</span>
					</td>
				</tr>
				<tr>
					<td>
						<b>Konto</b>
					</td>
					<td>
						<span id="raidkonto">{konto}</span>
					</td>
				</tr>
				<tr>
					<td>
						<b>Punktemodus</b>
					</td>
					<td>
						{punktemodus}
					</td>
				</tr>
				<tr>
					<td>
						<b>Erstellt</b>
					</td>
					<td>
						{timestamp}
					</td>
				</tr>
			</table>	
			{/raid}
			<h4 class="card-title">Bonuspunkte</h4>
			<table class="table">
				<tr>
					<td>
						<b>Punkte pro Raid*</b>
					</td>
					<td style="text-align:right">
						{punkteproraid}
					</td>
				</tr>
				<tr>
					<td>
						<b>Loot erhalten</b>
					</td>
					<td style="text-align:right">
						{lootfuer} Personen
					</td>
				</tr>
				<tr>
					<td>
						<b>Bonus bei Abschluss f&uuml;r</b>	
					</td>
					<td style="text-align:right">
						{bonusfuer} Personen
					</td>
				</tr>
			</table>
			<h4 class="card-title">Aktionen</h4>
			<form method="post" action="<?php echo current_url(); ?>">
				<table class="table">
					<tr>
						<td>
							{aktionen}	
						</td>
					</tr>
				</table>	
			</form>
			<span style="font-size:0.8em">* Gemä&szlig; Punktemodus</span>		
		</div>
	</div>	
</div>
<div class="col-3 col-lg-3 col-sm-6 col-xs-6 col-md-6">
	<div class="card">
		<div class="card-body">
	  		<h4 class="card-title" style="text-align:center">Spielerpool <i class="fas fa-arrows-alt-h"></i> Teilnehmende</h4>
			<div class="input-group" style="margin-bottom:3px">
				<div class="input-group-prepend">
				<div class="input-group-text">
					<i class="fas fa-search"></i>
				</div>
			</div>
				<input type="text" class="form-control" id="search" style="width:50%">
			</div>
			<div style="text-align:right;font-size:0.8em">{teiln_anz} Teilnehmende</div>	  		
			<ul id="sortable1" class="connectedSortable">
			  {pool}
			  <li data-row="{suchstring}" class="ui-state-default list-group-item-warning">
			  	 <img style="width:18px" src="<?php echo base_url('img'); ?>/class_{klasse}.jpg" />
			  	 {name}
			  	 <input type="hidden" name="teilnehmer[]" value="{name}" />
			  </li>
			  {/pool}
			</ul>
			<form action="<?php echo current_url(); ?>" method="post">
				<ul id="sortable2" class="connectedSortable" style="margin-bottom:5px">
				  {teilnehmer}
				  <li class="ui-state-highlight list-group-item-success" data-spieler="{spieler}" data-main="{main}">
				  	 <img style="width:18px" src="<?php echo base_url('img'); ?>/class_{klasse}.jpg" />
				  	 {spieler}
				     <input type="hidden" name="teilnehmer[]" value="{spieler}" />
				  </li>
				  {/teilnehmer}
				</ul>
				<button type="submit" name="sbmteilnehmer" class="btn btn-success"><i class="fas fa-check"></i> Speichern</button>
			</form>			
		</div>
	</div>
</div>
<div class="col-6 col-lg-6 col-sm-12 col-xs-12 col-md-12">
	<div class="card">
		<div class="card-body">
			<h4 class="card-title"> Beute erfassen</h4>
			<form class="form-inline" action="<?php echo current_url(); ?>" method="post">
				<input type="text" readonly id="beuteneuspieler" name="beuteneuspieler" placeholder="Lootempf&auml;nger" class="form-control" />&nbsp;
			    <div class="input-group">
				    <div class="input-group-prepend">
				      <div class="input-group-text"><i class="fas fa-coins"></i></div>
				    </div>
				    <input type="text" readonly class="form-control" id="bonuspunkterest" size="1">&nbsp;
			    </div>				
				<input type="text" id="beuteneuitem" name="beuteneuitem" disabled class="form-control" placeholder="Gegenstand" />&nbsp;
				<input type="text" id="beuteneuwert" name="beuteneuwert" disabled class="form-control" placeholder="Wert" maxlength="3" size="3" />&nbsp;
				<button type="submit" disabled id="beuteneusubmit" name="beuteneusubmit" class="btn btn-success"><i class="fas fa-file-upload"></i> Erfassen</button>
			</form>
			<form action="<?php echo current_url(); ?>" method="post">
			<table class="table">
				{beute}
				<tr>
					<td>{spieler}</td>
					<td>{gegenstand}</td>
					<td style="text-align:right">{wert}</td>
					<td style="text-align:right">
						<input class="form-check-input" type="checkbox" name="lootentfernen[]" value="{lootid}" />
					</td>
				</tr>
				{/beute}
				<tr>
					<td colspan="4" style="text-align:right">
						{beuteentfernen}	
					</td>
				</tr>
			</table>
			</form>
		</div>
	</div>
</div>