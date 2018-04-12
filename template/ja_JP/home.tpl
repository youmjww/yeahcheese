<link rel="stylesheet" type="text/css" href="/css/home.css">
<div class="top">
  <h1>ホーム</h1>
  <h3>{$session.userInfo.mailaddress}</h3>
</div>
<div>
  <ul>
    <li><a href="/?action_createEvent=true">イベント作成</a></li>
    <li><a href="/?action_listEvent=true">イベント一覧</a></li>
    <li><a href="/?action_accountConfig=true">アカウント設定</a></li>
    <li><a href="/?action_logout=true">ログアウト</a></li>
  </ul>
</div>
