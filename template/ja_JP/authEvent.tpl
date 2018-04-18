<h2>認証キー入力</h2>
{if count($errors)}
  <ul>
  {foreach from=$errors item=error}
   <li>{$error}</li>
  {/foreach}
  </ul>
{/if}
<form action="." method="post">
  <input type="text" name="authKey" maxlength="9">
  <input type="submit" name="action_authEvent_do">
</form>
