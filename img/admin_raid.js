  $( function() {
    $( "#sortable1, #sortable2" ).sortable({
      connectWith: ".connectedSortable"
    }).disableSelection();
  } );
  
var selectedBefore = 0;  
$(function(){
	
	$('#beuteneuwert').tooltip();
	
	$('#sortable2 li').bind('dblclick', function(){
		if(selectedBefore != 0){
			selectedBefore.removeClass('list-group-item-primary');
			selectedBefore.addClass('list-group-item-success');
		}
		
		$('#beuteneuspieler').val($(this).attr('data-spieler'));
		
		element = $(this);
		if(element.attr('data-main').length > 0){
			var spieler = element.attr('data-main');				
		}else{
			var spieler = element.attr('data-spieler');
		}
		
		$.ajax({url: url+"/"+spieler+"/"+$('#raidkonto').text()+"/"+$('#raidid').text()}).done(function(data){				
			$('#bonuspunkterest').attr('value', parseInt(data));
		});		
		
		$('#beuteneuitem').attr('disabled', false);
		
		$(this).removeClass('list-group-item-success');
		$(this).addClass('list-group-item-primary');
		selectedBefore = $(this);
	});
	
	$('#search').bind('keyup', function(){
		var s = $(this).val();
		if(s.length == 0){
			$('#sortable1').find('li').show();	
		}else{
			$('#sortable1').find('li').hide();
			$("[data-row*='"+s.toLowerCase()+"']").show();	
		}
	});
	
	$('#beuteneuitem').bind('keyup', function(){
		if($(this).val().length > 3){
			$('#beuteneuwert').attr('disabled', false);	
		}else{
			$('#beuteneuwert').attr('disabled', true);
		}
	});
	
	$('#beuteneuwert').bind('keyup', function(){
		var ele = $(this);
		var val = parseInt($(this).val());
		
		if(val < 0){
			ele.attr('value', 0);
			$('#beuteneusubmit').attr('disabled', true);
		}else if(val > parseInt($('#bonuspunkterest').val())){
			$('#beuteneusubmit').attr('disabled', true);
			$('#beuteneuwert').css('border', '2px solid red');
		}else{
			$('#beuteneusubmit').attr('disabled', false);
			$('#beuteneuwert').css('border', '2px solid green');
		}
	});
		
});