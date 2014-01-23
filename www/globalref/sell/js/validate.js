
function validateForm_sell()
{
	var subjectText = $('#subject-input').val();
	var descriptionText = $('#description-input').val();

	var dollarSignTest = subjectText.split('$');
	var spacebarDelimit;
	
	if(!subjectText || !descriptionText) //Check if they put in a title and description
	{
		$("#title-error").html("Your post must have a Title and Description");
		return false;
	}
	else if(dollarSignTest.length > 2) //Check if they put more one dollar sign
	{
		$("#title-error").html("Too many dollar signs! '$$$$'");
		return false;
	} //if
	else if(dollarSignTest.length < 2) //Check if they didn't put any dollar signs
	{
		$("#title-error").html("Put a dollar sign for your price! Like this: $600");
		return false;
	} //else if
	
	else
	{
		var i = 0;
		var numbers = false; //we assume that there are no numbers after your dollar sign
		
		for(i = 0; i < dollarSignTest.length; ++i)
		{
			if($.isNumeric(dollarSignTest[i][0]) )
			{
				numbers = true; //there are numbers after the '$' sign
				break;
			} //if
		} //for
		
		if(numbers) //there are numbers after the '$' sign
		{
			spacebarDelimit = dollarSignTest[i].split(' ');
			var j = 0;
			for(j = 0; j < spacebarDelimit[0].length; ++j)
			{
				if( !($.isNumeric(spacebarDelimit[0][j])) )
				{
					$("#title-error").html("There is an unwanted character in your price!  Try something like this: $600");
					return false;
				} //if
			} //for
		} //if
		else
		{
			$("#title-error").html("There are no numbers after your dollar sign!  Try something like this: $600");
			return false;
		} //else
	} //else
	
	/* ----------------------------------------------- CHECK VALID LOCATION --------------------------------------------- */
	
	var location = $('#sellerAddress').val();
	var locationArray = location.split(',');
	var city = locationArray[0];
	var state = locationArray[1].replace(' ', '');
	var statesArray = [
			"Alabama",
			"Alaska",
			"Arizona",
			"Arkansas",
			"California",
			"Colorado",
			"Connecticut",
			"Delaware",
			"Florida",
			"Georgia",
			"Hawaii",
			"Idaho",
			"Illinois",
			"Indiana",
			"Iowa",
			"Kansas",
			"Kentucky",
			"Louisiana",
			"Maine",
			"Maryland",
			"Massachusetts",
			"Michigan",
			"Minnesota",
			"Mississippi",
			"Missouri",
			"Montana",
			"Nebraska",
			"Nevada",
			"New Hampshire",
			"New Jersey",
			"New Mexico",
			"New York",
			"North Carolina",
			"North Dakota",
			"Ohio",
			"Oklahoma",
			"Oregon",
			"Pennsylvania",
			"Rhode Island",
			"South Carolina",
			"South Dakota",
			"Tennessee",
			"Texas",
			"Utah",
			"Vermont",
			"Virginia",
			"Washington",
			"West Virginia",
			"Wisconsin",
			"Wyoming" //Real spelling
		];
	
	var statesAbbrev = [
			"AL",
			"AK",
			"AZ",
			"AR",
			"CA",
			"CO",
			"CT",
			"DE",
			"FL",
			"GA",
			"HI",
			"ID",
			"IL",
			"IN",
			"IA",
			"KS",
			"KY",
			"LA",
			"ME",
			"MD",
			"MA",
			"MI",
			"MN",
			"MS",
			"MO",
			"MT",
			"NE",
			"NV",
			"NH",
			"NJ",
			"NM",
			"NY",
			"NC",
			"ND",
			"OH",
			"OK",
			"OR",
			"PA",
			"RI",
			"SC",
			"SD",
			"TN",
			"TX",
			"UT",
			"VT",
			"VA",
			"WA",
			"WV",
			"WI",
			"WY" //Abbreviation
		];
	
	if( $.inArray(state, statesArray) == -1 && $.inArray(state, statesAbbrev) == -1 )
	{
		$("#location-error").html("Please enter a valid state!  Like this: CA or California");
		return false;
	} //if

	return true; //Calls the upload_sell.php file	
	
} //function

//****************************************************************************************************************************/
