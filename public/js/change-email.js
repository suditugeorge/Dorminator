(function() {
  var hideSpinner, showSpinner;

  showSpinner = function() {
    $('#change-email').addClass('hidden');
    $('.spinner-wrap').removeClass('hidden');
  };

  hideSpinner = function() {
    $('#change-email').removeClass('hidden');
    $('.spinner-wrap').addClass('hidden');
  };

  $(function() {
    return $('#change-email').click(function(e) {
      var email, emailRegex, token;
      e.preventDefault();
      $('#email').removeClass('invalid');
      token = $('[name="_token"]').val();
      showSpinner();
      email = $('#email').val();
      emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
      if (email.trim() === "" || !emailRegex.test(email)) {
        $('#email').addClass('invalid');
        toastr.error("Unul sau mai multe câmpuri sunt goale sau conțin erori!");
        hideSpinner();
        return;
      }
      $.post('/change-email', {
        _token: token,
        email: email
      }, function(json) {
        if (!json.success) {
          toastr.error(json.message);
          hideSpinner();
          return;
        } else {
          window.location.href = json.url;
        }
      }).fail(function() {
        toastr.error('A intervenit o problemă care nu ține de noi');
        hideSpinner();
      });
    });
  });

}).call(this);

//# sourceMappingURL=change-email.js.map
