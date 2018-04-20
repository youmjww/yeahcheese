<div class="col s12 m3">
  <div class="card">
    <div class="card-image">
      {if $event.thumbnail}
      <img src="sherImage/{$event.thumbnail}" width="150" height="200">
      {else}
      <img src="images/image-not-found.jpg" width="150" height="200">
      {/if}
    </div>
    <div class="card-content">
      <span class="card-title"> {$event.event_name}</span>
      <p>掲載期間: {"`$event.open_day` - `$event.end_day`"}</p>
      <p>写真枚数: {$event.photo_count}</p>
    </div>
    <div class="card-action">
      <a href="/?action_editEvent=true&id={$event.id}">イベントを編集</a>
    </div>
  </div>
</div>
