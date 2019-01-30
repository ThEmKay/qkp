<div class="modal fade" id="lootinfo" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="info-title">Lootinformation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="loot">
        &nbsp;
      </div>
    </div>
  </div>
</div>
        
  <h4 class="card-title"><i class="fas fa-coins"></i> Bonuspunkte</h4>
  <select name="selKonto" class="form-control form-inline" id="selKonto">
{kontofilter}
  <option value="{kurz}" {selected}>{name}</option>
    {/kontofilter}
  </select>
  <select name="selKlasse" id="selKlasse" class="form-control form-inline">
{klassenfilter}
<option value="{value}" {selected}>{klasse}</option>
    {/klassenfilter}
  </select>
  <div id="punkte" >
    &nbsp;
  </div>