showSpinner = ->
  $('#change-password').addClass('hidden')
  $('.spinner-wrap').removeClass('hidden')
  return
hideSpinner = ->
  $('#change-password').removeClass('hidden')
  $('.spinner-wrap').addClass('hidden')
  return

$ ->
  $('#change-password').click (e) ->
    e.preventDefault();
    $('#password').removeClass 'invalid'
    token = $('[name="_token"]').val()
    showSpinner()

    password = $('#password').val()
    if password.trim() == ""
      $('#password').addClass 'invalid'
      toastr.error("Unul sau mai multe câmpuri sunt goale sau conțin erori!")
      hideSpinner()
      return

    password_repeat = $('#repeat-password').val()
    if password_repeat.trim() == ""
      $('#repeat-password').addClass 'invalid'
      toastr.error("Unul sau mai multe câmpuri sunt goale sau conțin erori!")
      hideSpinner()
      return

    if password.trim() != password_repeat.trim()
      $('#password').addClass 'invalid'
      $('#repeat-password').addClass 'invalid'
      toastr.error("Parolele nu conincid!")
      hideSpinner()
      return
    $.post '/change-password', {_token: token, password: password} , (json) ->
      if !json.success
        toastr.error(json.message)
        hideSpinner()
        return
      else
        window.location.href = json.url
      return
    return