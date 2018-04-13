<script type="text/javascript" src="https://momentjs.com/downloads/moment.js"></script>
<script
  src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
  integrity="sha256-3edrmyuQ0w65f8gfBsqowzjJe2iM6n0nKciPUp8y+7E="
  crossorigin="anonymous"></script>
<script type="text/javascript" src="/js/createEvent.js"></script>

<h1>イベント作成</h1>
<form action="." method="post" enctype="multipart/form-data">
  {if count($errors)}
    <ul>
      {foreach from=$errors item=error}
        <li>{$error}</li>
      {/foreach}
    </ul>
  {/if}
  <table border="0">
    <tr>
      <td>イベント名</td>
      <td><input type="text" name="eventName" required></td>
    </tr>
    <tr>
      <td>イベント開始日</td>
      <td><input type="date" name="openDay" id="eventOpenDay" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" value="" required></td>
    </tr>
    <tr>
      <td>イベント終了日</td>
      <td><input type="date" name="endDay" id="eventEndDay" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" value="" required></td>
    </tr>
    <tr>
      <td>写真</td>
      <td><input type="file" name="photos[]" required multiple></td>
    </tr>
  </table>
  <p>
    <input type="submit" name="action_createEvent_do" value="イベント作成">
  </p>
</form>
