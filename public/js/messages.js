(function() {
  var hideSpinner, removeInvalidClasses, showSpinner;

  showSpinner = function() {
    $('#send-message').addClass('hidden');
    $('.spinner-wrap').removeClass('hidden');
  };

  hideSpinner = function() {
    $('#send-message').removeClass('hidden');
    $('.spinner-wrap').addClass('hidden');
  };

  removeInvalidClasses = function() {
    $('#username').removeClass('invalid');
    $('#subject').removeClass('invalid');
    return $('#message').removeClass('invalid');
  };

  $(function() {
    $('#send-message').click(function(e) {
      var message, subject, token, username;
      e.preventDefault();
      removeInvalidClasses();
      showSpinner();
      username = $('#username').val();
      subject = $('#subject').val();
      message = $('#message').val();
      token = $('[name="_token"]').val();
      if (username.trim() === "") {
        $('#username').addClass('invalid');
        toastr.error("Unul sau mai multe câmpuri sunt goale sau conțin erori!");
        hideSpinner();
        return;
      }
      if (subject.trim() === "") {
        $('#subject').addClass('invalid');
        toastr.error("Unul sau mai multe câmpuri sunt goale sau conțin erori!");
        hideSpinner();
        return;
      }
      if (message.trim() === "") {
        $('#message').addClass('invalid');
        toastr.error("Unul sau mai multe câmpuri sunt goale sau conțin erori!");
        hideSpinner();
        return;
      }
      $.post('/new-message', {
        _token: token,
        username: username,
        subject: subject,
        message: message
      }, function(json) {
        if (!json.success) {
          toastr.error(json.message);
          hideSpinner();
        } else {
          toastr.success(json.message);
          hideSpinner();
          return $('#send-message').addClass('hidden');
        }
      });
    });
  });

}).call(this);

//# sourceMappingURL=messages.js.map
