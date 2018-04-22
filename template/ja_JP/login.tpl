<h2>ログイン</h2>
<form action="." method="post">
  {if count($errors)}
    <ul>
      {foreach from=$errors item=error}
      <li>{$error}</li>
      {/foreach}
    </ul>
  {/if}
  <div class=".input-field">
    <div class="row ">
      <div class="input-field col s12 m6 offset-m3">
        <input type="email" class="validate" id="email" pattern=".+@.+\..+" name="mailaddress" value="{$form.mailaddress}" title="メールアドレスは、aaa@example.comのような形式で入力してください。">
        <label for="email">Email</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12 m6 offset-m3">
        <input id="password" type="password" class="validate" name="password">
        <label for="password">Password</label>
      </div>
    </div>
    <div class="row">
      <input class="btn waves-effect waves-light col m4 offset-m4 #ffeb3b yellow" type="submit" name="action_login_do" value="ログイン">
    </div>
  </div>
</form>
