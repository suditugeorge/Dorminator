showSpinner = ->
  $('#send-institution').addClass('hidden')
  $('.spinner-wrap').removeClass('hidden')
  return
hideSpinner = ->
  $('#send-institution').removeClass('hidden')
  $('.spinner-wrap').addClass('hidden')
  return

removeInvalidClasses = ->
  $('#institution-name').removeClass 'invalid'
  $('#institution-code').removeClass 'invalid'
  $('#institution-description').removeClass 'invalid'
$ ->

  $('#send-institution').click (e) ->
    e.preventDefault()
    removeInvalidClasses()
    showSpinner()
    name = $('#institution-name').val()
    code = $('#institution-code').val()
    description = $('#institution-description').val()
    token = $('[name="_token"]').val()

    if name.trim() == ""
      $('#institution-name').addClass 'invalid'
      toastr.error("Unul sau mai multe câmpuri sunt goale sau conțin erori!")
      hideSpinner()
      return
    if code.trim() == ""
      $('#institution-code').addClass 'invalid'
      toastr.error("Unul sau mai multe câmpuri sunt goale sau conțin erori!")
      hideSpinner()
      return
    if description.trim() == ""
      $('#institution-description').addClass 'invalid'
      toastr.error("Unul sau mai multe câmpuri sunt goale sau conțin erori!")
      hideSpinner()
      return

    $.post '/add-institution', {_token: token, name: name, code: code, description: description}, (json) ->
      if !json.success
        toastr.error(json.message)
        hideSpinner()
        return
      else
        toastr.success(json.message)
        hideSpinner()
        $('#send-institution').addClass('hidden')
    return
  return