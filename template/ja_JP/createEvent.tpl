<h1>イベント作成</h1>
<form action="." method="post">
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
      <td><input type="date" name="openDay" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" required></td>
    </tr>
    <tr>
      <td>イベント終了日</td>
      <td><input type="date" name="endDay" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" required></td>

    </tr>
    <tr>
      <td>写真</td>
      <td><input type="file" name="photos" required></td>
    </tr>
  </table>
  <p>
    <input type="submit" name="action_login_do" value="イベント作成">
  </p>
</form>
