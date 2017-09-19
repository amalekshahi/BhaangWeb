
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
	return UTCDateTime();
}

function UTCDateTime(){
    var d = new Date();
    return moment(d).utc().format("YYYY-MM-DD[T]hh:mm:ss[Z]");
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


