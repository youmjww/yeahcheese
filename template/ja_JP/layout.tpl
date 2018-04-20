<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="/css/materialize.min.css" type="text/css" media="screen,projection"/>

    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>yeahcheese</title>

  </head>
  <body class="#fffde7 yellow lighten-5">
    <div class="header">
      <nav class="#fff59d yellow darken-1">
        <a href="/" class="brand-logo center">yeahcheese</a>
        <ul id="nav-mobile" class="left hide-on-med-and-down">
          {if $session}
            {include file='afterLoginHeader.tpl'}
          {else}
            {include file='beforLoginHeader.tpl'}
          {/if}
        </ul>
      </nav>
    </div>
    <div class="center-align">
      {$content}
    </div>
    <script type="text/javascript" src="js/materialize.min.js"></script>
  </body>
</html>
