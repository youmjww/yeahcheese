<link rel="stylesheet" type="text/css" href="css/editEvent.css">

<h2>イベント編集</h2>
{form ethna_action="editEvent" enctype="file" name="editEvent"}
  <div class="infobox">
    <div>イベント名: <input type="text" name="eventName" value="{$app.eventInfo.0.event_name}"></div>
    <div>
      公開開始日: <input type="date" name="openDay" value="{$app.eventInfo.0.open_day}">
      公開終了日:  <input type="date" name="endDay" value="{$app.eventInfo.0.end_day}">
    </div>
    <div>
      認証キー: {$app.eventInfo.0.auth_key}
    </div>
    <div>
      写真の追加: <input type="file" name="photos[]" accept=".jpg,.jpeg,image/jpeg" multiple>
    </div>

    <div>
      <input type="submit" name="action_delete" value="削除">
      <input type="submit" name="action_updateEvent" value="更新">
    </div>
  </div>
  <div class="photos">
    {foreach from=$app.eventPhoto item=photo}
      <div class="photo">
        <input type="checkbox" name="photos[]" value="{$photo.id}">
        <img src="/sherImage/{$photo.name}" width="250" height="250">
      </div>
    {/foreach}
  </div>
  <input type="hidden" name="eventId" value="{$app.eventInfo.0.id}">
{/form}
