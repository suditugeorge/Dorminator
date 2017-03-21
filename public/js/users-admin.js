(function() {
  $(function() {});

  $('#add-admins').click(function(e) {
    var emailRegex, emails, token, verified_emails;
    e.preventDefault();
    $('#error-box-users').addClass('hidden');
    token = $('[name="_token"]').val();
    emails = $('#emails').val().split("\n");
    verified_emails = "";
    emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    $.each(emails, function(k) {
      if (!emailRegex.test(emails[k])) {
        $('#error-message-users').html("Adresa de email " + emails[k] + " nu este validă!");
        $('#error-box-users').removeClass('hidden');
        return;
      }
      return verified_emails = verified_emails + "\n" + emails[k];
    });
    $.post('/add-admins', {
      _token: token,
      emails: verified_emails
    }, function(json) {
      if (!json.success) {
        toastr.error(json.message);
        return;
      } else {
        toastr.success(json.message);
      }
    });
  });

}).call(this);

//# sourceMappingURL=users-admin.js.map
