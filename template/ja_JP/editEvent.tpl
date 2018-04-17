<h2>イベント編集</h2>
  <div>
    <div>イベント名: <input type="text" value="{$app.eventInfo.0.event_name}"></div>
    <div>
      公開開始日: <input type="date" value="{$app.eventInfo.0.open_day}">
      公開終了日:  <input type="date" value="{$app.eventInfo.0.end_day}">
    </div>
    <div>
      認証キー: {$app.eventInfo.0.auth_key}
    </div>
    <div>
      *注:削除する写真を選択していた場合、選択された写真は削除されます。<input type="submit" value="更新">
    </div>
    <div>
      写真の追加: <input type="file" name="addPhoto">
    </div>
  </div>

<div>
  <div>
    {foreach from=$app.eventPhoto item=photo}
      <img src="/sherImage/{$photo.name}">
    {/foreach}
  </div>
</div>
