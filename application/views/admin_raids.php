<div style="position:absolute;top:5px;right:5px;z-index:9999">
	<img src="<?php echo base_url('img'); ?>/onyxia.png" />
</div>
<div class="col-12">
	{msg}
	<form class="form-inline">
		<button data-target="#neuerraid" data-toggle="modal" type="button" class="btn btn-primary form-inline"><i class="far fa-calendar-plus"></i> Neuer Raid</button>
	</form>
	<table class="table table-striped table-dark">
		{raid}
		<tr>
			<td style="width:1%">
				<a href="<?php echo site_url('admin/raids'); ?>/{raidid}"<i class="far fa-2x fa-edit"></i></a>
			</td>			
			<td style="width:1%">
				<img style="width:36px" src="<?php echo base_url(); ?>img/raidicons/{icon}" />
			</td>
			<td style="line-height:31px">
				{raidid}
			</td>			
			<td style="line-height:31px">
				{konto}
			</td>
			<td style="line-height:31px">
				{timestamp}
			</td>
			<td style="line-height:31px">
				{status}
			</td>
		</tr>
		{/raid}
	</table>
</div>
<div class="modal fade" id="neuerraid" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Neuer Raid</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Schließen">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form name="frmraidneu" action="<?php echo current_url(); ?>" method="post">
      <div class="modal-body">
      	<i>Ein neuer Raid kann nur angelegt werden, wenn <b>keine</b> weiteren dieses Kontotyps offen sind.</i>
		<div class="input-group">
			<div class="input-group-prepend">
				<div class="input-group-text">
					<i class="fas fa-list-ul"></i>
				</div>
			</div>
			{kontoauswahl}
		</div>        	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Schlie&szlig;en</button>
        <button type="submit" class="btn btn-success" name="raidneusubmit" id="raidneusubmit">Speichern</button>
      </div>
      </form>
    </div>
  </div>
</div>