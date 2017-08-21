function getParameterByName_old(name){
  name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
  var regexS = "[\\?&]" + name + "=([^&#]*)";
  var regex = new RegExp(regexS);
  var results = regex.exec(window.location.search);
  if(results == null)
	return "";
  else
	return decodeURIComponent(results[1].replace(/\+/g, " "));
}
function getCurrentDateTime() {
	var d = new Date();
	var m = d.getMonth()+1;
	var dd = d.getDate();
	var date = d.getFullYear()+'-'+(m<=9 ? '0' + m : m)+'-'+(dd<=9 ? '0' + dd : dd);
	var h = d.getHours();
	var mm = d.getMinutes();
	var s = d.getSeconds();
	var time = (h<=9 ? '0' + h : h) + ":" + (mm<=9 ? '0' + mm : mm) + ":" + (s<=9 ? '0' + s : s);
	return date+' '+time;
}