  <h4 class="card-title"><i class="far fa-calendar-alt"></i> Termine</h4>
  <div class="list-group">
  {termine}
  <a href="#" class="list-group-item list-group-item-action">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">
      	<img style="width:25px" src="<?php echo base_url('/img/raidicons'); ?>/{icon}" /> {titel}
      </h5>
      <small>{wochentag}</small>
    </div>
    <p class="mb-1">{freitext}</p>
    <small><i class="far fa-clock"></i> {von} bis {bis} Uhr</small>
  </a>
  {/termine}
</div>