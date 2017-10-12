<?php
date_default_timezone_set('UTC');
session_start();
require_once 'commonUtil.php';

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
 <head>
  <title> New Document </title>
  <meta name="Generator" content="EditPlus">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <script src="js/jquery-3.1.1.min.js"></script>
 </head>

 <body>
  <form method="post" id="idForm">
	First Name : <input type="text" name="firstname" id="firstname"><br>
	Last Name : <input type="text" name="lastname" id="lastname"><br>
	Email : <input type="text" name="email" id="email"><br>
	<input type="button" value="Register" onclick="Register();">
  </form>
  <script>
	function Register() {
			var importName = $('#importName').val();
			if (importName == '') {
				alert('Please enter import name.');
				return false;
			}

			//$('#idForm').submit();


			var form_data = $("#idForm").serialize();   
						
			
			$.ajax({
				url: 'registerContact.php', // point to server-side PHP script 
				dataType: 'json',  // what to expect back from the PHP script, if anything
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,                         
				type: 'get',
				success: function(json){
					
					if (json.success) {
						alert('Register successfully.');	
						location.reload();
					} else {
						alert('Register failed.');	
					}
				}
			 });

		}
  </script>
 </body>
</html>
