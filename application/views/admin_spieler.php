<script>

var progress = false;
var main = "<?php echo $this->uri->segment(3); ?>";

$(document).ready(function(){
	$('.spieler-save').bind('click', function(){
		if(!progress){
			if(confirm("really?")){
				var spieler = $(this).parent().parent().attr("id");
				var newname = $(this).parent().parent().find('input').val();
				var newclass = $(this).parent().parent().find('select').val();
				var element = $(this);
				
				$(this).addClass('fa-spin');
				$(this).addClass('fa-sync');
				$(this).removeClass('fa-save');
				
				progress = true;
				
				$.ajax({url: "<?php echo site_url('ajax/savespieler'); ?>/"+spieler+"/"+newname+"/"+newclass}).done(function(){				
					setTimeout(function(){
						$('#char-success').fadeIn().delay(2500).fadeOut();
						element.addClass('fa-save');
						element.removeClass('fa-sync');
						element.removeClass('fa-spin');
						progress = false;
						if(main == spieler){
							alert("Die Daten des Maincharakters wurden angepasst. Um Inkonsistenzen zu vermeiden, erfolgt eine Weiterleitung auf die Startseite.");
							location.href = "<?php echo site_url('admin'); ?>";	
						}						
					}, 2000);			    
				});
			}
		}
	});
	
	$('.konto-save').bind('click', function(){
		if(!progress){
			if(confirm("really?")){
				var konto = $(this).parent().parent().attr("id");
				var newwert = $(this).parent().parent().find('input').val();
				var element = $(this);

				if(isNaN(parseInt(newwert))){
					alert("Es wurde keine Nummer eingegeben.");
				}else if(parseInt(newwert) < 0){
					alert("Negative Werte sind nicht erlaubt.");
				}else{
					$(this).addClass('fa-spin');
					$(this).addClass('fa-sync');
					$(this).removeClass('fa-save');
									
					progress = true;
					
					$.ajax({url: "<?php echo site_url('ajax/savekonto'); ?>/"+main+"/"+konto+"/"+newwert}).done(function(){
						setTimeout(function(){
							$('#konto-success').fadeIn().delay(2500).fadeOut();
							element.addClass('fa-save');
							element.removeClass('fa-sync');
							element.removeClass('fa-spin');
							progress = false;
						}, 2000);			    
					});	
				}
			}
		}
	});
	
	$('.fa-plus-square').bind('click', function(){
		$('#charneu').toggle();
	});
	
	$('.charneu-save').bind('click', function(){
		if(!progress){
			if(confirm("really?")){
								
				var spieler = $(this).parent().parent().attr("id");
				var charneuname = $(this).parent().parent().find('input').val();
				
				if(charneuname.length > 2){
				
					var charneuklasse = $(this).parent().parent().find('select').val();
					var element = $(this);
									
					$(this).addClass('fa-spin');
					$(this).addClass('fa-sync');
					$(this).removeClass('fa-save');
					
					progress = true;
					
					$.ajax({url: "<?php echo site_url('ajax/charneu'); ?>/"+main+"/"+charneuname+"/"+charneuklasse}).done(function(){				
						setTimeout(function(){
								$('#char-success').fadeIn().delay(2500).fadeOut();
								element.addClass('fa-save');
								element.removeClass('fa-sync');
								element.removeClass('fa-spin');
								progress = false;
								alert("Neuer Charakter wurde angelegt. Die Seite wird neu geladen.");
								location.href = "<?php echo current_url(); ?>";	
						}, 2000);			    
					});

				}else{
					
					alert("Charaktername ist zu kurz (mind. 3 Zeichen).");
				}
			}
		}
	});
	
	$('.fa-trash').bind('click', function(){
		if(!progress){
			if(confirm("really?")){
								
				var spieler = $(this).parent().parent().attr("id");
				var element = $(this);
								
				$(this).addClass('fa-spin');
				$(this).addClass('fa-sync');
				$(this).removeClass('fa-trash');
				progress = true;
				
				$.ajax({url: "<?php echo site_url('ajax/charloeschen'); ?>/"+spieler}).done(function(){				
					setTimeout(function(){
							$('#char-success').fadeIn().delay(2500).fadeOut();
							element.addClass('fa-trash');
							element.removeClass('fa-sync');
							element.removeClass('fa-spin');
							element.parent().parent().remove();
							progress = false;
					}, 2000);			    
				});

				
			}
		}
	});		
	
		
});
</script>
<div style="position:absolute;top:5px;right:5px;z-index:9999">
	<img src="<?php echo base_url('img'); ?>/{main-klasse}_crest.png" />
</div>
<div class="col-12">
	<h2>Spieler bearbeiten: <?php echo $this->uri->segment(3); ?></h2>
</div>
<div class="col-sm-8">
	<div class="card">
		<div class="card-body">
	  		<h4 class="card-title">Charaktere</h4>
			<div class="alert alert-success" id="char-success" role="alert" style="display:none">
			  <strong>&Auml;nderungen erfolgreich gespeichert.</strong>
			</div>	  		
  			<table class="table table-dark">
  				{chars}
  				<tr id="{name}">
  					<td style="width:60%">
  						<input class="form-control" value="{name}" />	
  					</td>
  					<td style="width:20%">
  						{class}
  					</td>
  					<td>
						{options}
  					</td>
  				</tr>
  				{/chars}
  				<tr>
  					<td colspan="3">
  						<i class="far fa-plus-square fa-2x"></i>
  					</td>
  				</tr>
  				<tbody id="charneu" style="display:none">
  				<tr>
  					<td>
  						<input class="form-control" />
  					</td>
  					<td>
  						{klasseneu}
  					</td>
  					<td>
  						<i class="fas fa-save fa-2x charneu-save"></i>
  					</td>
  				</tr>
  				</tbody>
  			</table>	
		</div>
	</div>		
</div>
<div class="col-sm-4">
	<div class="card">
		<div class="card-body">
	  		<h4 class="card-title">Bonuspunkte / Konten</h4>
			<div class="alert alert-success" id="konto-success" role="alert" style="display:none">
			  <strong>&Auml;nderungen erfolgreich gespeichert.</strong>
			</div>	  		
  			<table class="table table-dark">
  				{konten}
  				<tr id="{kurz}">
  					<td>
  						{name} ({kurz})
  					</td>
  					<td>
  						<input class="form-control" value="{wert}" />
  					</td>
  					<td>
						<i class="fas fa-save fa-2x konto-save"></i>
  					</td>
  				</tr>
  				{/konten}
  			</table>	  		
		</div>
	</div>		
</div>