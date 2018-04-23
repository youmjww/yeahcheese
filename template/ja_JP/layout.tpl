<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
    <link rel="stylesheet" href="/css/materialize.min.css" type="text/css" media="screen,projection"/>
    <link rel="stylesheet" href="/css/error.css" type="text/css"/>
    <script src="/js/blockRightClick.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>yeahcheese</title>
  </head>
  <body class="#fffde7 yellow lighten-5">
    <div class="header">
      <nav class="#fff59d yellow darken-1">
        <a href="/" class="brand-logo center">yeahcheese</a>
        <a href="#" data-target="linkList" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        <ul id="nav-mobile" class="left hide-on-med-and-down">
          {if $session}
          {include file='afterLoginHeader.tpl'}
          {else}
          {include file='beforLoginHeader.tpl'}
          {/if}
        </ul>
      </nav>
      <ul class="sidenav" id="linkList">
        {if $session}
        {include file='afterLoginHeader.tpl'}
        {else}
        {include file='beforLoginHeader.tpl'}
        {/if}
      </ul>
    </div>
    <div class="center-align">
      {$content}
    </div>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script>
      M.AutoInit();
    </script>
  </body>
</html>
