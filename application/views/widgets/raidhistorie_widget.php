  <h4 class="card-title"><i class="fas fa-history"></i> Historie</h4>
  <p class="card-text">Beute und Bonuspunkte der letzten Raids ansehen.</p>
  <ul class="list-group list-group-flush">
{history}
<li class="list-group-item">
  <img style="width:35px" src="<?php echo base_url('img/raidicons'); ?>/{icon}" />
  <a href="<?php echo site_url('live'); ?>/index/{raidid}">{timestamp} - {name}</a>
</li>
{/history}
</ul>
