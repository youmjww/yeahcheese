
<h2>ユーザ登録</h2>
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
        <input id="password1" type="password" class="validate" name="password1">
        <label for="password1">パスワード</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12 m6 offset-m3">
        <input id="password2" type="password" class="validate" name="password2">
        <label for="password2">パスワード2</label>
      </div>
    </div>
    <div class="row">
      <input class="btn waves-effect waves-light col m4 offset-m4 #ffeb3b yellow" type="submit" name="action_registuser_do" value="登録">
    </div>
  </div>
</form>
