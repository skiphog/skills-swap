;(function () {
  let send;

  $('.ss-auth').on('click', function (e) {
    e.preventDefault();
    UIkit.switcher('#auth-switch').show(+$(this).data('index'));
    UIkit.modal('#auth').show();
  });

  $('.auth').on('submit', '.auth-form', function (e) {
    e.preventDefault();
    if (send) {
      return;
    }

    const form = $(this);
    let spinner = $('[uk-spinner]');

    send = $.ajax({
      url: form.attr('action'),
      type: 'post',
      dataType: 'json',
      data: form.serialize(),
      abortOnRetry: true,
      beforeSend: function () {
        spinner.removeClass('uk-hidden');
      },
      complete: function () {
        send = null;
        spinner.addClass('uk-hidden');
      },
      error: function (json) {

      },
      success: function (json) {
        callBack[form.data('callback')](json, form);
      }
    });
  });

  const callBack = {
    authLogin (json, form) {
      if (json.status === 1) {
        window.location.replace('/');
      }
    },
    authConfirm (json, form) {
      if (json.status === 1) {
        window.location.replace('/');
      }
    },
    authRegistration (json, form) {
      if (json.status === 1) {
        form.html(
          '<div><span uk-icon="mail" class="uk-text-success"></span> <span class="uk-text-middle uk-text-primary">На ваш адрес выслано письмо с подтверждением регистрации.</span></div>');
      }
    }
  };
})();