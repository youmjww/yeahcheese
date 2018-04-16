<div>
  <h4>イベント名: {$event.event_name}</h4>
  <p>掲載期間: {"`$event.open_day` - `$event.end_day`"}</p>
  <p>写真枚数: {$event.photo_count}</p>
  <p>認証キー: {$event.auth_key}</p>
  <a href="/?action_editEvent=true&id={$event.id}">イベントを編集</a>
</div>
