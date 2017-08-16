$ ->

$('#change-user-profile').click (e) ->
	e.preventDefault()
	$('#error-box-profile').addClass 'hidden'
	email = $('#email').val()
	token = $('[name="_token"]').val()
	name = $('#name').val()
	phone = $('#phone').val()
	sex = $('input[name=gender]:checked').attr('id')

	formHasErrors = false
	emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
	if !emailRegex.test(email)
		$('#email').addClass('invalid')
		formHasErrors = true
	phoneRegex = /^[0-9]+$/
	if !phoneRegex.test(phone)
		$('#phone').addClass('invalid')
		formHasErrors = true
	if formHasErrors
		toastr.error("Unul sau mai multe câmpuri sunt goale sau conțin erori!")
		return
	$.post '/change-user-profile', {
		_token: token, 
		email: email,
		sex: sex,
		phone: phone
		} , (json) ->
		if !json.success
			toastr.error("Unul sau mai multe câmpuri sunt goale sau conțin erori!")
			return
		else
			location.reload()
		return
	return
