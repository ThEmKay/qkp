<script>
$(document).ready(function(){
	$('#search').bind('keyup', function(){
		var s = $(this).val();
		if(s.length == 0){
			$('.table').find('tr').show();	
		}else{
			$('.table').find('tr').hide();
			$("[data-row*='"+s.toLowerCase()+"']").show();	
		}
	});
	
	$('#spielerneusubmit').hide();
	$('#spielerneuname').css('border-color', 'red');
	
	$('.fa-times').css('color', 'red');
	
	$('#spielerneuname').bind('keyup', function(){
		var element = $(this); 
		if(element.val().length > 2){
			$.ajax({url: "<?php echo site_url('ajax/charexists'); ?>/"+$(this).val()}).done(function(data){				
				if(parseInt(data) == 0){
					element.css('border-color', 'green');
					$('.fa-times').addClass('fa-check');
					$('.fa-times').css('color', 'green');
					$('.fa-times').removeClass('fa-times');
					$('#spielerneusubmit').show();
				}else{
					element.css('border-color', 'red');
					$('.fa-check').addClass('fa-times');
					$('.fa-check').css('color', 'red');
					$('.fa-check').removeClass('fa-check');
					$('#spielerneusubmit').hide();
				}
			});
		}else{
			$('#spielerneusubmit').hide();
			$(this).css('border-color', 'red');
		}
	});
	
	$('#spielerneusubmit').bind('click', function(){
		frmspielerneu.submit();
	});
	
});	
</script>
<div style="position:absolute;top:5px;right:5px;z-index:9999">
	<img src="<?php echo base_url('img'); ?>/Alliance_Crest.png" />
</div>
<div class="col-12">
	{msg}
	<form class="form-inline">
		<button data-target="#neuerspieler" data-toggle="modal" type="button" class="btn btn-primary"><i class="far fa-address-book"></i> Neue/r Spieler/in</button>&nbsp;
		<div class="input-group">
			<div class="input-group-prepend">
				<div class="input-group-text">
					<i class="fas fa-search"></i>
				</div>
			</div>
			<input type="text" class="form-control" id="search">
		</div>
	</form>
	<table class="table table-dark">
		{chars}
		<tr data-row="{suchstring}">
			<td style="width:1%">
				<a href="<?php echo site_url('admin/index'); ?>/{name}"<i class="far fa-2x fa-edit"></i></a>
			</td>			
			<td style="width:1%">
				<img src="<?php echo base_url('img'); ?>/class_{klasse}.jpg" />
			</td>		
			<td><span style="line-height:31px">{name}</span></td>
		</tr>
		{/chars}
	</table>
</div>
<div class="modal fade" id="neuerspieler" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Neue/n  Spieler/in anlegen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Schließen">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form name="frmspielerneu" action="<?php echo current_url(); ?>" method="post">
			<div class="input-group">
				<div class="input-group-prepend">
					<div class="input-group-text">
						<i class="fas fa-times"></i>
					</div>
				</div>
				<input type="text" class="form-control" placeholder="Name" name="spielerneuname" id="spielerneuname" style="border: 2px solid" />
				{klassenauswahl}
			</div>        	
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Schlie&szlig;en</button>
        <button type="button" class="btn btn-success" id="spielerneusubmit">Speichern</button>
      </div>
    </div>
  </div>
</div>