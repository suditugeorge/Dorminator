(function() {
  $(function() {
    return $('#start-sort').click(function(e) {
      var token;
      e.preventDefault();
      console.log('cacat');
      token = $('[name="_token"]').val();
      $.post('/start-sort', {
        _token: token
      }, function(json) {
        if (!json.success) {
          toastr.error(json.message);
          return;
        } else {
          toastr.success(json.message);
        }
      });
    });
  });

}).call(this);

//# sourceMappingURL=main.js.map
