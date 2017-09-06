(function() {
  var hideSpinner, removeInvalidClasses, showSpinner;

  showSpinner = function() {
    $('#send-dorm').addClass('hidden');
    $('.spinner-wrap').removeClass('hidden');
  };

  hideSpinner = function() {
    $('#send-dorm').removeClass('hidden');
    $('.spinner-wrap').addClass('hidden');
  };

  removeInvalidClasses = function() {
    $('#dorm-name').removeClass('invalid');
    return $('#dorm-code').removeClass('invalid');
  };

  $(function() {
    $('#send-dorm').click(function(e) {
      var code, description, name, token;
      e.preventDefault();
      removeInvalidClasses();
      showSpinner();
      name = $('#dorm-name').val();
      code = $('#dorm-code').val();
      description = $('#dorm-description').val();
      token = $('[name="_token"]').val();
      if (name.trim() === "") {
        $('#dorm-name').addClass('invalid');
        toastr.error("Unul sau mai multe câmpuri sunt goale sau conțin erori!");
        hideSpinner();
        return;
      }
      if (code.trim() === "") {
        $('#dorm-code').addClass('invalid');
        toastr.error("Unul sau mai multe câmpuri sunt goale sau conțin erori!");
        hideSpinner();
        return;
      }
      $.post('/dorms', {
        _token: token,
        name: name,
        code: code,
        description: description
      }, function(json) {
        if (!json.success) {
          toastr.error(json.message);
          hideSpinner();
        } else {
          toastr.success(json.message);
          hideSpinner();
          return $('#send-dorm').addClass('hidden');
        }
      });
    });
  });

}).call(this);

//# sourceMappingURL=dorm.js.map
