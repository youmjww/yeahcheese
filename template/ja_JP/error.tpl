<h1>error!!!</h1>

{if count($errors)}
  <ul>
    {foreach from=$errors item=error}
      <li>{$error}</li>
    {/foreach}
  </ul>
{/if}
<p>１つ前の画面に戻ってやり直してください</p>
