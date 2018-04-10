
<h1>ユーザ登録</h1>
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
      <td>メールアドレス</td>
      <td><input type="email" pattern=".+@.+\..+" name="mailaddress" value="{$form.mailaddress}" title="メールアドレスは、aaa@example.comのような形式で入力してください。"></td>
    </tr>
    <tr>
      <td>パスワード</td>
      <td><input type="password" name="password1" value=""></td>
    </tr>
    <tr>
      <td>パスワード2</td>
      <td><input type="password" name="password2" value=""></td>
    </tr>
  </table>
  <p>
  <input type="submit" name="action_registuser_do" value="登録">
  </p>
</form>
