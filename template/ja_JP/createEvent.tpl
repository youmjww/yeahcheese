<script type="text/javascript" src="https://momentjs.com/downloads/moment.js"></script>
<script
                               src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
                               integrity="sha256-3edrmyuQ0w65f8gfBsqowzjJe2iM6n0nKciPUp8y+7E="
                               crossorigin="anonymous"></script>
<script type="text/javascript" src="/js/createEvent.js"></script>

<h2>イベント作成</h2>
<form action="." method="post" enctype="multipart/form-data">
  <ul>
    <p id="sizeError"></p>
  </ul>
  {if count($errors)}
  <ul class="error">
    {foreach from=$errors item=error}
    <li>{$error}</li>
    {/foreach}
  </ul>
  {/if}
  <div class=".input-field">
    <div class="row">
      <div class="input-field col s12 m6 offset-m3">
        <input id="eventName" type="text" name="eventName" value="{$form.eventName}" required>
        <label for="eventName">イベント名</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12 m3 offset-m3">
        <input type="date" name="openDay" id="eventOpenDay" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" value="" required>
        <label for="eventName">イベント開始日</label>
      </div>
      <div class="input-field col s12 m3">
        <input type="date" name="endDay" id="eventEndDay" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" value="" required>
        <label for="eventName">イベント終了日</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12 m6 offset-m3">
        <div class="file-field input-field">
          <div class="btn">
            <span>写真選択</span>
            <input type="file" name="photos[]" id="uploadFiles" accept=".jpg,.jpeg,image/jpeg" required multiple>
          </div>
          <div class="file-path-wrapper">
            <input class="file-path validate" type="text">
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <input class="btn waves-effect waves-light col m4 offset-m4 #ffeb3b yellow" type="submit" name="action_createEvent_do" value="イベント作成">
  </div>
</form>
