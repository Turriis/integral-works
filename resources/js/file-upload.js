(function($) {
  'use strict';
  $(function() {
    $('.file-upload-browse').on('click', function() {
      var file = $(this).parent().parent().parent().find('.file-upload-default');
      file.trigger('click');
    });
    $('.file-upload-default').on('change', function() {
      $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
    });

    $('.readXml').on('change', function() {
      readXml();
    });

    $('.readXmlEdit').on('change', function() {
      readXmlEdit();
    });
  });

  $( function() {
    $(".dateField").datepicker({dateFormat: 'yy-mm-dd'});
  } );
})(jQuery);