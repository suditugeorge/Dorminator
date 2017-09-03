showSpinner = ->
  $('#send-student').addClass('hidden')
  $('.spinner-wrap').removeClass('hidden')
  return
hideSpinner = ->
  $('#send-student').removeClass('hidden')
  $('.spinner-wrap').addClass('hidden')
  return

removeInvalidClasses = ->
  $('#student-name').removeClass 'invalid'
  $('#student-code').removeClass 'invalid'
  $('#student-description').removeClass 'invalid'
$ ->

  $('#send-student').click (e) ->
    e.preventDefault()
    #removeInvalidClasses()
    #showSpinner()
    name = $('#student-name').val()
    grade = parseFloat($('#student-grade').val())
    cnp = $('#student-cnp').val()
    phone = $('#student-phone').val()
    email = $('#student-email').val()
    code = $('#student-code').val()
    female = $('#student-female:checked').val()
    male = $('#student-male:checked').val()
    token = $('[name="_token"]').val()
    sex = 'M'
    if female
      sex = 'F'
    data = {
      name: name,
      grade: grade,
      cnp: cnp,
      phone: phone,
      email: email,
      code: code,
      sex: sex,
      _token: token
    }
    phone_regex = /^[0-9]+$/
    if data.name.trim() == ""
      $('#student-name').addClass 'invalid'
      toastr.error("Unul sau mai multe câmpuri sunt goale sau conțin erori!")
      hideSpinner()
      return
    if data.grade == NaN or data.grade > 10.00
      $('#student-phone').addClass 'invalid'
      toastr.error("Unul sau mai multe câmpuri sunt goale sau conțin erori!")
      hideSpinner()
      return
    if data.code.trim() == ""
      $('#student-code').addClass 'invalid'
      toastr.error("Unul sau mai multe câmpuri sunt goale sau conțin erori!")
      hideSpinner()
      return
    if data.phone.trim() != "" and !phone_regex.test(data.phone)
      $('#student-phone').addClass 'invalid'
      toastr.error("Unul sau mai multe câmpuri sunt goale sau conțin erori!")
      hideSpinner()
      return

    $.post '/add-students', data, (json) ->
      if !json.success
        toastr.error(json.message)
        hideSpinner()
        return
      else
        toastr.success(json.message)
        hideSpinner()
        $('#send-student').addClass('hidden')
    return
  return