showSpinner = ->
  $('#send-dorm').addClass('hidden')
  $('.spinner-wrap').removeClass('hidden')
  return
hideSpinner = ->
  $('#send-dorm').removeClass('hidden')
  $('.spinner-wrap').addClass('hidden')
  return
showSpinnerNormal = ->
  $('.spinner-wrap').removeClass('hidden')
  $('#pick-dorm').addClass('hidden')
  return
hideSpinnerNormal = ->
  $('.spinner-wrap').addClass('hidden')
  $('#pick-dorm').removeClass('hidden')
  return

removeInvalidClasses = ->
  $('#dorm-name').removeClass 'invalid'
  $('#dorm-code').removeClass 'invalid'
$ ->

  $('#send-dorm').click (e) ->
    e.preventDefault()
    removeInvalidClasses()
    showSpinner()
    name = $('#dorm-name').val()
    code = $('#dorm-code').val()
    description = $('#dorm-description').val()
    token = $('[name="_token"]').val()

    if name.trim() == ""
      $('#dorm-name').addClass 'invalid'
      toastr.error("Unul sau mai multe câmpuri sunt goale sau conțin erori!")
      hideSpinner()
      return
    if code.trim() == ""
      $('#dorm-code').addClass 'invalid'
      toastr.error("Unul sau mai multe câmpuri sunt goale sau conțin erori!")
      hideSpinner()
      return

    $.post '/dorms', {_token: token, name: name, code: code, description: description}, (json) ->
      if !json.success
        toastr.error(json.message)
        hideSpinner()
        return
      else
        toastr.success(json.message)
        hideSpinner()
        $('#send-dorm').addClass('hidden')
      return
    return

  $('#pick-dorm').click (e) ->
    e.preventDefault()
    showSpinnerNormal()
    token = $('[name="_token"]').val()
    dorm = $('#dorm-select').val()
    $.post '/select-dorm', {_token: token, dorm:dorm}, (json) ->
      if !json.success
        toastr.error(json.message)
        hideSpinnerNormal()
        return
      else
        window.location.href = '/select-dorm'
      return
    return