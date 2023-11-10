$('.checkAll').on('click', function () {
    $(this).parents('.card-box').find('.checkbox_childrent').prop('checked', $(this).prop('checked'));
});
$('.checkall').on('click', function(){
    $(this).parents().find('.checkbox_childrent,.checkbox_wrapper').prop('checked', $(this).prop('checked'));
});