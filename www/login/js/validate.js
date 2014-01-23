function validateForm_login()
{
	var email = $('#email').val();
	var password = $('#password').val();
	var validate;
	
	var error_count = 0;
	
	var emailTest = email.split('@');
	
	$('#email-error').css({"display": "none"});
	$('#password-error').css({"display": "none"});
	
	if(emailTest.length > 2 || emailTest.length < 2) //email
	{
		$('#email-error').css({"display": "inline-block"});
		++error_count;
	} //if
	
	/*if(emailTest2.length > 2 || emailTest2.length < 2) //email
	{
		$('#email-error').css({"display": "inline-block"});
		++error_count;
	} //if */
	
	if(!password) //password
	{
		$('#password-error').css({"display": "inline-block"});
		++error_count;
	} //if
	
	if(validate == "failed")
	{
		$('#user-password-error').css({"display": "inline-block"});
		++error_count;
	} //if
	
	if(error_count > 0)
	{
		return false;
	} //if
	
	
	if(error_count == 0)
	{
		return true;
	} //if

	
}

function validateForm_forgot()
{
	var email = $('#email').val();
	var error_count = 0;

	var emailTest = email.split('@');
//	var emailTest2 = email.split('.');
	
	$('#email-error').css({"display": "none"});
	
	if(emailTest.length > 2 || emailTest.length < 2) //email
	{
		$('#email-error').css({"display": "inline-block"});
		++error_count;
	} //if
	
	/*if(emailTest2.length > 2 || emailTest2.length < 2) //email
	{
		$('#email-error').css({"display": "inline-block"});
		++error_count;
	} //if*/
	
	if(error_count > 0)
	{
		return false;
	} //if
	
	if(error_count == 0)
	{
		return true;
	} //if

	
}


function validateForm_signup()
{
	var firstname = $('#firstname').val();
	var lastname = $('#lastname').val();
	var city = $('#city').val();
	var state = $('#state').val();
	var email = $('#email').val();
	var password = $('#password').val();
	var rpassword = $('#re-type-password').val();
	var checkbox_status = $('#checkbox').attr('checked');

	var error_count = 0;
	
	var emailTest = email.split('@');
	//var emailTest2 = email.split('.');
	
	$('#firstname-error').css({"display": "none"});
	$('#lastname-error').css({"display": "none"});
	$('#city-error').css({"display": "none"});
	$('#state-error').css({"display": "none"});
	$('#email-error').css({"display": "none"});
	$('#password-error').css({"display": "none"});
	$('#re-password-error').css({"display": "none"});
	$('#re-password-approve').css({"display": "none"});
	$('#checkbox-error').css({"display": "none"});

	
	if(!firstname) //firstname
	{
		$('#firstname-error').css({"display": "inline-block"});
		++error_count;
	} //if
	
	if(!lastname) //lastname
	{
		$('#lastname-error').css({"display": "inline-block"});
		++error_count;
	} //if
	
	if(!city) //city
	{
		$('#city-error').css({"display": "inline-block"});
		++error_count;
	} //if
	
	if(!state) //state?
	{
		$('#state-error').css({"display": "inline-block"});
		++error_count;
	} //if
	
	if(emailTest.length > 2 || emailTest.length < 2) //email
	{
		$('#email-error').css({"display": "inline-block"});
		++error_count;
	} //if
	
	/*if(emailTest2.length > 2 || emailTest2.length < 2) //email
	{
		$('#email-error').css({"display": "inline-block"});
		++error_count;
	} //if*/
	
	if(!password) //password
	{
		$('#password-error').css({"display": "inline-block"});
		++error_count;
	} //if
	
	if(!rpassword) //rpassword
	{
		$('#re-password-error').css({"display": "inline-block"});
		++error_count;
	} //if
	
	if(!checkbox_status)
	{
		$('#checkbox-error').css({"display": "inline-block"});
		++error_count;
	} //if
	
	if(password != rpassword)
	{
		$('#re-password-error').css({"display": "inline-block"});
		++error_count;
	} //if
	
	
	if(error_count > 0)
	{
		return false;
	} //if
	
	
	if(error_count == 0 && (password == rpassword))
	{
		return true;
	} //if

	
}