$(document).ready(function(e) {  					
		var canLogin = readCookie("canLogin");
		//alert("Can Login = "+canLogin);
		if (canLogin != "Yes") {
				 location.href = 'login.html';
		}
});