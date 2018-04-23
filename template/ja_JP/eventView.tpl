<link rel="stylesheet" type="text/css" href="css/editEvent.css">



<h2>イベント閲覧</h2>
<div class="infobox">
  <div>イベント名: {$app.eventName}</div>
</div>
<div class="photos">
  {foreach from=$app.eventPhoto item=photo}
  <div class="photo">
    <img src="/sherImage/{$photo.name}" width="250" height="250" class="materialboxed">
  </div>
  {/foreach}
</div>
<div class="row">
  <a class="btn-floating btn-large" href="#"><i class="large material-icons #fff59d yellow darken-1">open_in_browser</i></a>
</div>
