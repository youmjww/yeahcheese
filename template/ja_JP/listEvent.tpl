<h2>イベントリスト</h2>
<div class="row">
  {foreach from=$app.events item=event}
  {$eventPeriod}
  {include file='eventCard.tpl' event=$event}
  {/foreach}
</div>
