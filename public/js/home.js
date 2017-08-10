(function() {
  $(function() {});

  $(document).keypress(function(e) {
    if (e.which === 13) {
      $('#login').click();
    }
  });

  $('#login').click(function(e) {
    var password, remember, token, username;
    $('#username').removeClass('invalid');
    $('#password').removeClass('invalid');
    username = $('#username').val();
    token = $('[name="_token"]').val();
    remember = $('#remember').is(':checked');
    if (username.trim() === "") {
      $('#username').addClass('invalid');
      toastr.error("Unul sau mai multe câmpuri sunt goale sau conțin erori!");
      return;
    }
    password = $('#password').val();
    if (password.trim() === "") {
      $('#password').addClass('invalid');
      toastr.error("Unul sau mai multe câmpuri sunt goale sau conțin erori!");
      return;
    }
    $.post('/login', {
      _token: token,
      username: username,
      password: password,
      remember: remember
    }, function(json) {
      if (!json.success) {
        if (typeof json.url !== void 0) {
          window.location.href = json.url;
          return;
        }
        if (typeof json.field !== 'undefined') {
          $('#' + json.field).addClass('invalid');
        }
        toastr.error(json.message);
      } else {
        return window.location.href = "/dashboard";
      }
    });
    return;
  });

}).call(this);

//# sourceMappingURL=home.js.map
