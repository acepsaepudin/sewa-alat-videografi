$(function() {
  $(".navbar-expand-toggle").click(function() {
    $(".app-container").toggleClass("expanded");
    return $(".navbar-expand-toggle").toggleClass("fa-rotate-90");
  });
  return $(".navbar-right-expand-toggle").click(function() {
    $(".navbar-right").toggleClass("expanded");
    return $(".navbar-right-expand-toggle").toggleClass("fa-rotate-90");
  });
});

$(function() {
  return $('select').select2();
});

$(function() {
  return $('.toggle-checkbox').bootstrapSwitch({
    size: "small"
  });
});

$(function() {
  return $('.match-height').matchHeight();
});

$(function() {
  return $('.datatable').DataTable({
    "dom": '<"top"fl<"clear">>rt<"bottom"ip<"clear">>'
  });
});

$(function() {
  return $(".side-menu .nav .dropdown").on('show.bs.collapse', function() {
    return $(".side-menu .nav .dropdown .collapse").collapse('hide');
  });
});

//sewa item_add
$(function(){
  //datepicker init
  $('#datepicker').datepicker({
    todayHighlight: true,
    keyboardNavigation: false,
    startDate: "now",
    autoclose: true,
    format: "dd-mm-yyyy"
  });
  $('#datepicker-pembayaran').datepicker({
    todayHighlight: true,
    keyboardNavigation: false,
    // startDate: "now",.
    autoclose: true,
    format: "dd-mm-yyyy"
  });
  //ajax request add item
  $('.add_item_alat').on('submit', function(e){
    // e.preventDefault();
    clearError();
    $.ajax({
      type: 'POST',
      url: $(this).attr('action'),
      dataType: 'json',
      data: $(this).serialize(),
      success: function(data){
        if (data.error == 1) {
          $.each(data.datas,function(index,value){
            if (value.length>0) {
              $('.form-'+index).addClass('has-error');
            }
          });
        }
        if (data.error == 2) {
          window.location.href = data.url;
        }
      }
    });
    return false;
  });
});
function item_add(id) {
  //clear input error flag
  clearError();
  $('#alat_id').empty().val(id);
  $('#modalSuccess').modal();
}

function clearError() {
  $('.form-jumlah').removeClass('has-error');
  $('.form-start').removeClass('has-error');
  $('.form-end').removeClass('has-error');
  // $('.form-total_hari').removeClass('has-error');
}
