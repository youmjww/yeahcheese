<h2>認証キー入力</h2>
{if count($errors)}
<ul>
  {foreach from=$errors item=error}
  <li>{$error}</li>
  {/foreach}
</ul>
{/if}
<form action="." method="post">
  <div class=".input-field">
    <div class="row ">
      <div class="input-field col s12 m2 offset-m5">
        <input id="authKey" type="text" name="authKey" maxlength="9">
        <label for="authKey">認証キー</label>
      </div>
    </div>
    <div class="row">
      <input class="btn waves-effect waves-light col m2 offset-m5 #ffeb3b yellow" type="submit" name="action_authEvent_do" value="登録">
    </div>
  </div>
</form>
