(function() {
  var hideSpinner, removeInvalidClasses, showSpinner;

  showSpinner = function() {
    $('#send-institution').addClass('hidden');
    $('.spinner-wrap').removeClass('hidden');
  };

  hideSpinner = function() {
    $('#send-institution').removeClass('hidden');
    $('.spinner-wrap').addClass('hidden');
  };

  removeInvalidClasses = function() {
    $('#institution-name').removeClass('invalid');
    $('#institution-code').removeClass('invalid');
    return $('#institution-description').removeClass('invalid');
  };

  $(function() {
    $('#send-institution').click(function(e) {
      var code, description, name, token;
      e.preventDefault();
      removeInvalidClasses();
      showSpinner();
      name = $('#institution-name').val();
      code = $('#institution-code').val();
      description = $('#institution-description').val();
      token = $('[name="_token"]').val();
      if (name.trim() === "") {
        $('#institution-name').addClass('invalid');
        toastr.error("Unul sau mai multe câmpuri sunt goale sau conțin erori!");
        hideSpinner();
        return;
      }
      if (code.trim() === "") {
        $('#institution-code').addClass('invalid');
        toastr.error("Unul sau mai multe câmpuri sunt goale sau conțin erori!");
        hideSpinner();
        return;
      }
      if (description.trim() === "") {
        $('#institution-description').addClass('invalid');
        toastr.error("Unul sau mai multe câmpuri sunt goale sau conțin erori!");
        hideSpinner();
        return;
      }
      $.post('/add-institution', {
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
          return $('#send-institution').addClass('hidden');
        }
      });
    });
  });

}).call(this);

//# sourceMappingURL=institution.js.map
