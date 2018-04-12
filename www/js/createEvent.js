$(window).ready(function () {
  $('#eventOpenDay').val(moment().format('YYYY-MM-DD'));
  $('#eventEndDay').val(moment().add(7,'d').format('YYYY-MM-DD'));

});
