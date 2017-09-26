var dbEndPoint = "couchdb.php"

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
    return moment(d).utc().format("YYYY-MM-DD[T]HH:mm:ss[Z]"); // WHO WROTE THIS?  You're the ghost in the machine!  Should be HH not hh
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

function documentConpare(obj1, obj2) {
    if(typeof obj1 == "undefined"){
        return false;
    }
    if(typeof obj2 == "undefined"){
        return false;
    }
	//Loop through properties in object 1
	for (var p in obj1) {
		switch (typeof (obj1[p])) {
			//Deep compare objects
			case 'object':
                if(typeof obj2[p] == "undefined"){
                    console.log("object differ " + p);
                    return false;
                }
				if (!documentConpare(obj1[p], obj2[p])) {
                    console.log("object differ " + p);
                    return false;
                }
				break;
			//Compare function code
			case 'function':
                continue;
			//Compare values
			default:
                if(typeof obj2[p] == "undefined"){
                    console.log("prop differ " + p);
                    return false;
                }
				if (obj1[p] != obj2[p]) {
                    console.log("prop differ " + p);
                    return false;
                }
		}
	}
	return true;
};

