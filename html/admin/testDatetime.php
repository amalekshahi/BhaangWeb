<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
 <head>
  <title> New Document </title>
  <meta name="Generator" content="EditPlus">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css"
    rel="stylesheet" type="text/css" />

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
  <script src="js/date.format.js"></script>
 </head>

 <body>
	<input type="text" name="date" id="date" value="09/01/2017">
	<input type="text" name="time" id="time" value="05:30PM">
	<input type="text" name="timezone" id="timezone" value="PDT">
	<input type="button" value="Test" onclick="checkdate();">
	<script>
		function checkdate(){
			var date1 = $('#date').val();
			var time1 = $('#time').val();
			var timezone = $('#timezone').val();

			time1 = convert_to_24h(convertTimeFormat(time1));
			
			// Create date from input value
			var d1 = new Date(date1+' '+time1+' '+timezone);
			var inputDate= dateFormat(d1, "yyyy-mm-dd HH:MM:ss",true);
			alert(inputDate);

			// Get today's date
			var d2 = new Date();
			var todaysDate= dateFormat(d2, "yyyy-mm-dd HH:MM:ss",true);
			alert(todaysDate);

			if (inputDate < todaysDate) {
				alert('past date');
			} else {
				alert('ok');
			}
		}

		function convertTimeFormat(timeString) {
			timeString = timeString.replace("PM", ":00 PM");
			timeString = timeString.replace("AM", ":00 AM");
			return timeString;
		}

		function convert_to_24h(time_str) {
			// Convert a string like 10:05:23 PM to 24h format, returns like [22,5,23]
			var time = time_str.match(/(\d+):(\d+):(\d+) (\w)/);
			var hours = Number(time[1]);
			var minutes = Number(time[2]);
			var seconds = Number(time[3]);
			var meridian = time[4].toLowerCase();

			if (meridian == 'p' && hours < 12) {
			  hours += 12;
			}
			else if (meridian == 'a' && hours == 12) {
			  hours -= 12;
			}
			return str_pad(hours)+':'+str_pad(minutes)+':'+str_pad(seconds);
	  };

	  function str_pad(n) {
			return String("0" + n).slice(-2);
	  }

		

	</script>
	</body>
</html>
