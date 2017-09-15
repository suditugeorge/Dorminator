(function() {
  $(function() {
    $('#start-sort').click(function(e) {
      var token;
      e.preventDefault();
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
    $('#stop-dorminator').click(function(e) {
      var token;
      e.preventDefault();
      token = $('[name="_token"]').val();
      $.post('/stop-dorminator', {
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
    $('#start-dorminator').click(function(e) {
      var token;
      e.preventDefault();
      token = $('[name="_token"]').val();
      $.post('/start-dorminator', {
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
    $('#algorithm-preference').click(function(e) {
      var token;
      e.preventDefault();
      token = $('[name="_token"]').val();
      $.post('/algorithm/preference', {
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
    return $('#algorithm-cascade').click(function(e) {
      var token;
      e.preventDefault();
      token = $('[name="_token"]').val();
      $.post('/algorithm/cascade', {
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
