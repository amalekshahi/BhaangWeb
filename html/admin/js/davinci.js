
/* remove [] */
function prettyStudioErrorMessage(str)
{
    str = str.replace("[i]", ""); 
    return str;
}


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
	/*var d = new Date();
	var m = d.getMonth()+1;
	var dd = d.getDate();
	var date = d.getFullYear()+'-'+(m<=9 ? '0' + m : m)+'-'+(dd<=9 ? '0' + dd : dd);
	var h = d.getHours();
	var mm = d.getMinutes();
	var s = d.getSeconds();
	var time = (h<=9 ? '0' + h : h) + ":" + (mm<=9 ? '0' + mm : mm) + ":" + (s<=9 ? '0' + s : s);
	return date+' '+time;*/
	return UTCDateTime();
}

function UTCDateTime(){
    var d = new Date();
    return d.toUTCString();
}

/*
    Remove JSONP Style Call back data
    (xxxxxxxx) -> xxxxxxx
*/
function clearCallBack(data){
    var len = data.length;
    if(data.charAt(0) == '('){
        return data.substring(1, len-1); 
    }else{
        return data;
    }
};

String.prototype.startsWith = function(needle)
{
    return(this.indexOf(needle) == 0);
};

String.prototype.endsWith = function(suffix) {
    return this.indexOf(suffix, this.length - suffix.length) !== -1;
};

function Render(template,data){
    var reg = /\{{(.*?)\}}/;
    var html = template;
    while (match = reg.exec(html)) {
        // first shows the match: <h1>,h1
        // then shows the match: </h1>,/h1
        var slugPattern = match[0];
        var slug = match[1];
        var renderRaw = false;
        if(slug.startsWith("RAW ")){
            renderRaw = true;
            slug = slug.substring(4);
        }
        html = html.replace(slugPattern,data[slug]);
        console.log(slug);
    }
    return html;
} 

function dbgClick(from){
    if(from == 'DBView'){
        window.open("http://web2xmm.com:5984/_utils/document.html?" + dbName + "/" + campaignID, '_blank');
    }
    if(from == 'Issue'){
        window.open("https://github.com/coa0329/Bhaang/issues", '_blank');
    }
}


