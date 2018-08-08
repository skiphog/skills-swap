;(function () {
  let send;
  const inputs = $('input.uk-input');

  $('.ss-auth').on('click', function (e) {
    e.preventDefault();
    UIkit.switcher('#auth-switch').show(+$(this).data('index'));
    UIkit.modal('#auth').show();
  });

  $('.uk-switcher').on('beforeshow', function () {
    inputs.each(function (key, input) {
      clearErrors($(input));
    });
  });

  function clearErrors (o) {
    if (o.hasClass('uk-form-danger')) {
      o.removeClass('uk-form-danger').
        prev().
        removeClass('uk-text-danger').
        parent().
        next().
        text('');
    }
  }

  inputs.on('input', function () {
    clearErrors($(this));
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
      error: function (jqXHR) {
        if (jqXHR.status !== 422) {
          return alert('Forbidden!');
        }

        $.each(jqXHR['responseJSON']['errors'], function (key, value) {
          $(`input[name=${key}]`).
            addClass('uk-form-danger').
            prev().
            addClass('uk-text-danger').
            parent().
            next().
            text(value);
        });

      },
      success: function (json) {
        callBack.generalCallback(json, form, form.data('callback'));
      }
    });
  });

  const callBack = {
    form: null,
    generalCallback (json, form, action) {
      if (json.status === 1) {
        this.form = form;
        callBack[action]();
      }
    },
    authLogin () {
      window.location.replace('/');
    },
    authConfirm () {
      window.location.replace('/');
    },
    authRepass () {
      this.setStatusToForm('На ваш адрес выслано письмо для восстановления доступа');
    },
    authRegistration () {
      this.setStatusToForm('На ваш адрес выслано письмо с подтверждением регистрации');
    },
    setStatusToForm (value) {
      this.form.html(
        `<div><span uk-icon="mail" class="uk-text-success"></span> <span class="uk-text-middle uk-text-primary">${value}</span></div>`);
    }
  };
})();