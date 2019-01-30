{live}
<span style="color:green;font-weight:bold">LIVE:</span> <img style="width:25px" src="<?php echo base_url('img/raidicons'); ?>/{icon}" /> {name}
<div class="dropdown" style="display:inline" data-raidid="{raidid}">
  <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="far fa-eye"></i> Punkte verfolgen
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    {verfolgen}
    <a class="dropdown-item" data-spieler="{spieler}" data-klasse="{klasse}" data-konto="{konto}" href="#">
    	<img style="width:25px" src="<?php echo base_url('img'); ?>/class_{klasse}.jpg" />&nbsp;{spieler}
    </a>
    {/verfolgen}
  </div>
</div>
<span id="followshow" style="display:none">
	-&nbsp;<img style="width:25px" id="followklasse" src="" />&nbsp;<span id="follow" style="font-weight:bold"></span>
	<span class="badge badge-warning"><i class="fas fa-coins"></i>&nbsp;<span id="dkp">0</span>&nbsp;DKP</span>
	<span class="badge badge-info"><i class="fas fa-spinner fa-pulse"></i>&nbsp;<span id="countdown">20</span></span>
</span>	
{/live}
<script>

var interv;
var follow;
var kont;
var kla;
var rid;
var t;

const cd = 30;

function countdown(){
	if(parseInt($('#countdown').text()) > 0){
		$('#countdown').text(parseInt($('#countdown').text())-1);	
	}
}
function timer(){
	$('#countdown').text(cd);
	t = setInterval(countdown, 1000);
}
	
		
function refresh(){
	clearInterval(t);
	$.ajax({url: "<?php echo site_url('ajax/getpunkterest'); ?>/"+follow+"/"+kont+"/"+rid+"/"}).done(function(data){				
		$('#follow').text(follow);
		$('#dkp').text(data);
		timer();
	});
}


jQuery( function() {
	jQuery('.dropdown-item').bind('click', function(){
		follow = $(this).attr('data-spieler');
		kont = $(this).attr('data-konto');
		kla = $(this).attr('data-klasse');
		rid = $('.dropdown').attr('data-raidid');
		
		$.ajax({url: "<?php echo site_url('ajax/getpunkterest'); ?>/"+follow+"/"+kont+"/"+rid+"/"}).done(function(data){				
			$('.dropdown').hide();
			$('#followshow').show();
			$('#follow').text(follow);
			$('#dkp').text(data);
			$('#followklasse').attr('src', '<?php echo base_url('img'); ?>/class_'+kla+'.jpg');
		});
		
		timer();
		interv = setInterval(refresh, cd*1000);
	});
});
</script>

