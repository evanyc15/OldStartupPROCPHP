function getPosition()
{

	if(navigator.geolocation)
	{
			navigator.geolocation.getCurrentPosition(success,failure);
	}
		else
	{
		alert("Your browser doesn't support geolocation!");
	}
}

function success(location)
{

	var address = new google.maps.LatLng(location.coords.latitude,location.coords.longitude);
	geocode(address);
}

function failure(error)
{
	alert("Could not find your location!");
}

function geocode(latLng)
{
	var geocoder = new google.maps.Geocoder();
	geocoder.geocode({
	"location": latLng
	},
	function(results,status)
	{
		if(status == google.maps.GeocoderStatus.OK)
		{
			if(results[0])
			{
				var state = "";
				var city = "";

				for(var i=0;i < results[0].address_components.length;i++)
				{
					var addr = results[0].address_components[i];

					if(addr.types[0] == ['administrative_area_level_1'])
					{
						state = addr.long_name;
					}
					else if(addr.types[0] == ['locality'])
					{
						city = addr.long_name;
					}
				}
				document.getElementById("address").innerHTML = city + ', ' + state;
				document.getElementById("sellerAddress").value = city + ', ' + state;
			}
		}
		else
		{
			document.getElementById("location").innerHTML = "N/A";
		}
	});
}