$(window).ready(function () {
  $('#eventOpenDay').val(moment().format('YYYY-MM-DD'));
  $('#eventEndDay').val(moment().add(7,'d').format('YYYY-MM-DD'));

  $('#uploadFiles').on('change', function() {
    $.each(this.files, function(index, photo){
      if (photo.size > 5000000) {
        $('#sizeError').text('各画像サイズは5MB未満にしてください。');
        $('#create').attr('disabled', 'disabled');
        return false;
      } else {
        $('#sizeError').empty();
        $('#create').removeAttr('disabled');
      }
    });
  });
});
