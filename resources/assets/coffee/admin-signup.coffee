$ ->

$('#signup').click (e) ->
	email = $('#email').val()
	token = $('[name="_token"]').val()
	emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/

	if !emailRegex.test(email)
		$('#email').addClass 'invalid'
		toastr.error("Adresa de email nu este validă")
		return
	
	name = $('#name').val()
	if name.trim() == ""
		$('#name').addClass 'invalid'
		toastr.error("Numele nu este completat")
		return

	phone = $('#phone').val()
	if phone.trim().match(/\d/g).length != 10
		$('#phone').addClass 'invalid'
		toastr.error("Numărul de telefon este invalid")
		return

	password = $('#password').val()
	if password.trim().length < 6
		$('#password').addClass 'invalid'
		toastr.error("Parola trebuie să aibe minim 6 caractere")
		return
	object = {_token: token, email: email, password: password, phone:phone, name: name}

	$.post '/admin-sign-up', {_token: token, email: email, password: password, phone:phone, name: name} , (json) ->
		if !json.success
			toastr.error(json.message)
			if(typeof json.field != 'undefined')
				$('#'+json.field).addClass 'invalid'
			return
		else
			window.location.href = "/"
		return
	return
