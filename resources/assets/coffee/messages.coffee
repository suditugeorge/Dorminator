showSpinner = ->
  $('#send-message').addClass('hidden')
  $('.spinner-wrap').removeClass('hidden')
  return
hideSpinner = ->
  $('#send-message').removeClass('hidden')
  $('.spinner-wrap').addClass('hidden')
  return

removeInvalidClasses = ->
  $('#username').removeClass 'invalid'
  $('#subject').removeClass 'invalid'
  $('#message').removeClass 'invalid'
$ ->

  $('#send-message').click (e) ->
    e.preventDefault()
    removeInvalidClasses()
    showSpinner()
    username = $('#username').val()
    subject = $('#subject').val()
    message = $('#message').val()
    token = $('[name="_token"]').val()

    if username.trim() == ""
      $('#username').addClass 'invalid'
      toastr.error("Unul sau mai multe câmpuri sunt goale sau conțin erori!")
      hideSpinner()
      return
    if subject.trim() == ""
      $('#subject').addClass 'invalid'
      toastr.error("Unul sau mai multe câmpuri sunt goale sau conțin erori!")
      hideSpinner()
      return
    if message.trim() == ""
      $('#message').addClass 'invalid'
      toastr.error("Unul sau mai multe câmpuri sunt goale sau conțin erori!")
      hideSpinner()
      return

    $.post '/new-message', {_token: token, username: username, subject: subject, message: message}, (json) ->
      if !json.success
        toastr.error(json.message)
        hideSpinner()
        return
      else
        toastr.success(json.message)
        hideSpinner()
        $('#send-message').addClass('hidden')
    return
  return