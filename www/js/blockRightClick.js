$(document).ready(function(){
  var img = $('img');
  img.on('contextmenu', function(){
    alert('右クリックは禁止されています。');
    return false
  });
});
