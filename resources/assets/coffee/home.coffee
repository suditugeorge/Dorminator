$ ->
#On enter login
$(document).keypress (e) ->
  if e.which == 13
    $('#login').click()
  return

$('#login').click (e) ->
  $('#username').removeClass 'invalid'
  $('#password').removeClass 'invalid'
  username = $('#username').val()
  token = $('[name="_token"]').val()
  remember = $('#remember').is(':checked')

  if username.trim() == ""
    $('#username').addClass 'invalid'
    toastr.error("Unul sau mai multe câmpuri sunt goale sau conțin erori!")
    return
  password = $('#password').val()
  if password.trim() == ""
    $('#password').addClass 'invalid'
    toastr.error("Unul sau mai multe câmpuri sunt goale sau conțin erori!")
    return
  $.post '/login', {_token: token, username: username, password: password, remember: remember}, (json) ->
      if !json.success
        if typeof json.url != 'undefined'
          window.location.href = json.url
          return
        if typeof json.field != 'undefined'
          $('#' + json.field).addClass 'invalid'
        toastr.error(json.message)
        return
      else
        window.location.href = "/profile"
    return
  return
