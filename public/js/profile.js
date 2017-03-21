(function() {
  $(function() {});

  $('#change-user-profile').click(function(e) {
    var degree, email, gender, name, phone, token, year_of_study;
    e.preventDefault();
    $('#error-box-profile').addClass('hidden');
    email = $('#email').val();
    token = $('[name="_token"]').val();
    name = $('#name').val();
    degree = $('#degree').val();
    year_of_study = $('#year-of-study').val();
    phone = $('#phone').val();
    gender = $('input[name=gender]:checked').attr('id');
    if (name.trim() === "") {
      $('#name').addClass('invalid');
      $('#error-box').removeClass('hidden');
      return;
    }
    $.post('/change-user-profile', {
      _token: token,
      email: email,
      name: name,
      degree: degree,
      year_of_study: year_of_study,
      gender: gender,
      phone: phone
    }, function(json) {
      if (!json.success) {
        $('#error-message-profile').html(json.message);
        $('#error-box-profile').removeClass('hidden');
        return;
      } else {
        location.reload();
      }
    });
  });

}).call(this);

//# sourceMappingURL=profile.js.map
