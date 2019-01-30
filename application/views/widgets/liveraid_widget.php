<h4 class="card-title"><i class="fas fa-broadcast-tower"></i> Live-Raid</h4>

  <div class="list-group">
  	<ul class="list-group list-group-flush">
  {live}
  
    
<li class="list-group-item">
  <img style="width:35px" src="<?php echo base_url('img/raidicons'); ?>/{icon}" />
   {name}
  </li>
  <li class="list-group-item">
  	
   <div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="far fa-eye"></i> Punkte verfolgen
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    {verfolgen}
    <a class="dropdown-item" href="#">{spieler}</a>
    {/verfolgen}
  </div>
</div>
</li>
{/live}
  </ul>
</div>

