(function() {
  var hideSpinner, removeInvalidClasses, showSpinner;

  showSpinner = function() {
    $('#send-student').addClass('hidden');
    $('.spinner-wrap').removeClass('hidden');
  };

  hideSpinner = function() {
    $('#send-student').removeClass('hidden');
    $('.spinner-wrap').addClass('hidden');
  };

  removeInvalidClasses = function() {
    $('#student-name').removeClass('invalid');
    $('#student-code').removeClass('invalid');
    return $('#student-description').removeClass('invalid');
  };

  $(function() {
    $('#send-student').click(function(e) {
      var cnp, code, data, email, female, grade, male, name, phone, phone_regex, sex, token;
      e.preventDefault();
      name = $('#student-name').val();
      grade = parseFloat($('#student-grade').val());
      cnp = $('#student-cnp').val();
      phone = $('#student-phone').val();
      email = $('#student-email').val();
      code = $('#student-code').val();
      female = $('#student-female:checked').val();
      male = $('#student-male:checked').val();
      token = $('[name="_token"]').val();
      sex = 'M';
      if (female) {
        sex = 'F';
      }
      data = {
        name: name,
        grade: grade,
        cnp: cnp,
        phone: phone,
        email: email,
        code: code,
        sex: sex,
        _token: token
      };
      phone_regex = /^[0-9]+$/;
      if (data.name.trim() === "") {
        $('#student-name').addClass('invalid');
        toastr.error("Unul sau mai multe câmpuri sunt goale sau conțin erori!");
        hideSpinner();
        return;
      }
      if (data.grade === (0/0) || data.grade > 10.00) {
        $('#student-phone').addClass('invalid');
        toastr.error("Unul sau mai multe câmpuri sunt goale sau conțin erori!");
        hideSpinner();
        return;
      }
      if (data.code.trim() === "") {
        $('#student-code').addClass('invalid');
        toastr.error("Unul sau mai multe câmpuri sunt goale sau conțin erori!");
        hideSpinner();
        return;
      }
      if (data.phone.trim() !== "" && !phone_regex.test(data.phone)) {
        $('#student-phone').addClass('invalid');
        toastr.error("Unul sau mai multe câmpuri sunt goale sau conțin erori!");
        hideSpinner();
        return;
      }
      $.post('/add-students', data, function(json) {
        if (!json.success) {
          toastr.error(json.message);
          hideSpinner();
        } else {
          toastr.success(json.message);
          hideSpinner();
          return $('#send-student').addClass('hidden');
        }
      });
    });
  });

}).call(this);

//# sourceMappingURL=student.js.map
