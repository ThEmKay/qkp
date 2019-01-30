<table class="table table-striped table-sm table-hover table-bordered" style="background-color:#fff">
  <tr>
    <th>
      Spieler
    </th>
    <th>
      Hauptcharakter
    </th>
    <th>
      Bonuspunkte
    </th>                            
  </tr>
  {punktestand}
  <tr>
    <td>
      <img class="spieler" data-main="{parent}" style="cursor:pointer;width:30px" src="<?php echo base_url('img') ?>/icons8-about-48.png" />
      <img src="<?php echo base_url('img') ?>/class_{klasse}.jpg" /> {spieler}</td>
    <td class="main" style="line-height:30px">{main}</td>
    <td style="text-align:right;padding-right:10px;line-height:30px">{wert}</td>
  </tr>
  {/punktestand}
</table>