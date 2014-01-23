
function validateForm_offer()
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