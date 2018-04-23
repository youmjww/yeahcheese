
<h2>イベント編集</h2>
{form ethna_action="editEvent" enctype="file" name="editEvent"}
<div class=".input-field">
  <div class="row">
    <div class="input-field col s12 m6 offset-m3">
      <input disabled value="{$app.eventInfo.0.auth_key}" id="authKey" type="text" class="validate">
      <label for="authKeu">認証キー</label>
    </div>
  </div>
  <div class="row">
    <div class="input-field col s12 m6 offset-m3">
      <input id="eventName" type="text" name="eventName" value="{$app.eventInfo.0.event_name}" required>
      <label for="eventName">イベント名</label>
    </div>
  </div>
  <div class="row">
    <div class="input-field col s12 m3 offset-m3">
      <input type="date" name="openDay" id="eventOpenDay" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" value="{$app.eventInfo.0.open_day}" required>
      <label for="eventName">イベント開始日</label>
    </div>
    <div class="input-field col s12 m3">
      <input type="date" name="endDay" id="eventEndDay" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" value="{$app.eventInfo.0.end_day}" required>
      <label for="eventName">イベント終了日</label>
    </div>
    <div class="row">
      <div class="input-field col s12 m6 offset-m3">
        <div class="file-field input-field">
          <div class="btn">
            <span>写真選択</span>
            <input type="file" name="photos[]" id="uploadFiles" accept=".jpg,.jpeg,image/jpeg" multiple>
          </div>
          <div class="file-path-wrapper">
            <input class="file-path validate" type="text">
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="input-field">
      <input class="waves-effect waves-light btn-large col s12 m6 offset-m3" type="submit" name="action_updateEvent" value="イベント情報を更新">
    </div>
  </div>
  <div class="row">
    {foreach from=$app.eventPhoto item=photo}
    <div class="col s12 m5 l4">
      <label>
        <input type="checkbox" class="red darken-2" name="photos[]" value="{$photo.id}" />
        <span>
          <img src="/sherImage/{$photo.name}" width="250" height="250">
        </span>
      </label>
    </div>
    {/foreach}
  </div>
  <input type="hidden" name="eventId" value="{$app.eventInfo.0.id}">
  <div class="row">
    <div class="input-field ">
      <input class="waves-effect waves-light btn-large #b71c1c red darken-2 col s12 m6 offset-m3" type="submit" name="action_delete" value="選択した写真を削除">
    </div>
  </div>
  <div class="row">
    <a class="btn-floating btn-large" href="#"><i class="large material-icons #fff59d yellow darken-1">open_in_browser</i></a>
  </div>
  {/form}
