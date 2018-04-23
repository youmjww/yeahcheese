<h2>イベントリスト</h2>
<div class="row">
  {foreach from=$app.events item=event}
  {$eventPeriod}
  {include file='eventCard.tpl' event=$event}
  {/foreach}
</div>
<div class="row">
  <a class="btn-floating btn-large" href="#"><i class="large material-icons #fff59d yellow darken-1">open_in_browser</i></a>
</div>
