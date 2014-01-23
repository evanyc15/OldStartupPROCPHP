	<?php
	
	// Get user id from logged in user
	$user_id = $_SESSION['id'];
	
	$birthdate = $row['Birthdate'];
	$dateArray = explode("-",$birthdate);
	
	if(isset($dateArray[1]))
	{//if theres some date shit that exists, only then set the date
		$birthdate = $dateArray[1].$dateArray[2].$dateArray[0];
	}
	
	else
	{//then set to null, if birthdate is empty
		$birthdate = "";
		
	}
	
	$gender = array();// Represents what the gender of the session user is
	if ($row['Gender'] == 'M')
	{
		$gender[0] = "checked";
		$gender[1] = "";
	}
	else 
	{
		$gender[0] = "";
		$gender[1] = "checked";
	}
		
	
	// State autofill implementation fr Select2
	$states = array(
			"AL","AK","AZ","AR","CA","CO","CT","DE","FL","GA",
			"HI","ID","IL","IN","IA","KS","KY","LA","ME","MD",
			"MA","MI","MN","MS","MO","MT","NE","NV","NH","NJ",
			"NM","NY","NC","ND","OH","OK","OR","PA","RI","SC",
			"SD","TN","TX","UT","VT","VA","WA","WV","WI","WY",
	);
	
	$not_selected = array(
			"<option value='AL'>Alabama</option>",
			"<option value='AK'>Alaska</option>",
			"<option value='AZ'>Arizona</option>",
			"<option value='AR'>Arkansas</option>",
			"<option value='CA'>California</option>",
			"<option value='CO'>Colorado</option>",
			"<option value='CT'>Connecticut</option>",
			"<option value='DE'>Delaware</option>",
			"<option value='FL'>Florida</option>",
			"<option value='GA'>Georgia</option>",
			"<option value='HI'>Hawaii</option>",
			"<option value='ID'>Idaho</option>",
			"<option value='IL'>Illinois</option>",
			"<option value='IN'>Indiana</option>",
			"<option value='IA'>Iowa</option>",
			"<option value='KS'>Kansas</option>",
			"<option value='KY'>Kentucky</option>",
			"<option value='LA'>Louisiana</option>",
			"<option value='ME'>Maine</option>",
			"<option value='MD'>Maryland</option>",
			"<option value='MA'>Massachusettes</option>",
			"<option value='MI'>Michigan</option>",
			"<option value='MN'>Minnesota</option>",
			"<option value='MS'>Mississippi</option>",
			"<option value='MO'>Missouri</option>",
			"<option value='MT'>Montana</option>",
			"<option value='NE'>Nebraska</option>",
			"<option value='NV'>Nevada</option>",
			"<option value='NH'>New Hampshire</option>",
			"<option value='NJ'>New Jersey</option>",
			"<option value='NM'>New Mexico</option>",
			"<option value='NY'>New York</option>",
			"<option value='NC'>North Carolina</option>",
			"<option value='ND'>North Dakota</option>",
			"<option value='OH'>Ohio</option>",
			"<option value='OK'>Oklahoma</option>",
			"<option value='OR'>Oregon</option>",
			"<option value='PA'>Pennsylvania</option>",
			"<option value='RI'>Rhode Island</option>",
			"<option value='SC'>South Carolina</option>",
			"<option value='SD'>South Dakota</option>",
			"<option value='TN'>Tennessee</option>",
			"<option value='TX'>Texas</option>",
			"<option value='UT'>Utah</option>",
			"<option value='VT'>Vermont</option>",
			"<option value='VA'>Virginia</option>",
			"<option value='WA'>Washington</option>",
			"<option value='WV'>West Virginia</option>",
			"<option value='WI'>Wisconsin</option>",
			"<option value='WY'>Wyoming</option>",
	);
	
	$selected = array(
			"<option selected='selected' value='AL'>Alabama</option>",
			"<option selected='selected' value='AK'>Alaska</option>",
			"<option selected='selected' value='AZ'>Arizona</option>",
			"<option selected='selected' value='AR'>Arkansas</option>",
			"<option selected='selected' value='CA'>California</option>",
			"<option selected='selected' value='CO'>Colorado</option>",
			"<option selected='selected' value='CT'>Connecticut</option>",
			"<option selected='selected' value='DE'>Delaware</option>",
			"<option selected='selected' value='FL'>Florida</option>",
			"<option selected='selected' value='GA'>Georgia</option>",
			"<option selected='selected' selected='selected' value='HI'>Hawaii</option>",
			"<option selected='selected' value='ID'>Idaho</option>",
			"<option selected='selected' value='IL'>Illinois</option>",
			"<option selected='selected' value='IN'>Indiana</option>",
			"<option selected='selected' value='IA'>Iowa</option>",
			"<option selected='selected' value='KS'>Kansas</option>",
			"<option selected='selected' value='KY'>Kentucky</option>",
			"<option selected='selected' value='LA'>Louisiana</option>",
			"<option selected='selected' value='ME'>Maine</option>",
			"<option selected='selected' value='MD'>Maryland</option>",
			"<option selected='selected' value='MA'>Massachusettes</option>",
			"<option selected='selected' value='MI'>Michigan</option>",
			"<option selected='selected' value='MN'>Minnesota</option>",
			"<option selected='selected' value='MS'>Mississippi</option>",
			"<option selected='selected' value='MO'>Missouri</option>",
			"<option selected='selected' value='MT'>Montana</option>",
			"<option selected='selected' value='NE'>Nebraska</option>",
			"<option selected='selected' value='NV'>Nevada</option>",
			"<option selected='selected' value='NH'>New Hampshire</option>",
			"<option selected='selected' value='NJ'>New Jersey</option>",
			"<option selected='selected' value='NM'>New Mexico</option>",
			"<option selected='selected' value='NY'>New York</option>",
			"<option selected='selected' value='NC'>North Carolina</option>",
			"<option selected='selected' value='ND'>North Dakota</option>",
			"<option selected='selected' value='OH'>Ohio</option>",
			"<option selected='selected' value='OK'>Oklahoma</option>",
			"<option selected='selected' value='OR'>Oregon</option>",
			"<option selected='selected' value='PA'>Pennsylvania</option>",
			"<option selected='selected' value='RI'>Rhode Island</option>",
			"<option selected='selected' value='SC'>South Carolina</option>",
			"<option selected='selected' value='SD'>South Dakota</option>",
			"<option selected='selected' value='TN'>Tennessee</option>",
			"<option selected='selected' value='TX'>Texas</option>",
			"<option selected='selected' value='UT'>Utah</option>",
			"<option selected='selected' value='VT'>Vermont</option>",
			"<option selected='selected' value='VA'>Virginia</option>",
			"<option selected='selected' value='WA'>Washington</option>",
			"<option selected='selected' value='WV'>West Virginia</option>",
			"<option selected='selected' value='WI'>Wisconsin</option>",
			"<option selected='selected' value='WY'>Wyoming</option>",
	);
	
	?>