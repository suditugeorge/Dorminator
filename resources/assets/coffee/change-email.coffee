showSpinner = ->
  $('#change-email').addClass('hidden')
  $('.spinner-wrap').removeClass('hidden')
  return
hideSpinner = ->
  $('#change-email').removeClass('hidden')
  $('.spinner-wrap').addClass('hidden')
  return

$ ->
  $('#change-email').click (e) ->
    e.preventDefault();
    $('#email').removeClass 'invalid'
    token = $('[name="_token"]').val()
    showSpinner()

    email = $('#email').val()
    emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
    if email.trim() == "" or !emailRegex.test(email)
      $('#email').addClass 'invalid'
      toastr.error("Unul sau mai multe câmpuri sunt goale sau conțin erori!")
      hideSpinner()
      return

    $.post('/change-email', {_token: token, email: email} , (json) ->
      if !json.success
        toastr.error(json.message)
        hideSpinner()
        return
      else
        window.location.href = json.url
      return
    ).fail ->
      toastr.error('A intervenit o problemă care nu ține de noi')
      hideSpinner()
      return
    return