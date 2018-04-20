<h2>ログイン</h2>
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
      <td><input type="password" name="password" value=""></td>
    </tr>
  </table>
  <p>
    <input type="submit" name="action_login_do" value="ログイン">
  </p>
</form>
