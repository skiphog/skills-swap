$('.ss-auth').on('click', function (e) {
  e.preventDefault();
  UIkit.switcher('#auth-switch').show(+$(this).data('index'));
  UIkit.modal('#auth').show();
});