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

function UTCDateTimeMDT(){
    var d = new Date();
    return moment(d).utc().format("MM/DD/YYYY"); 
}

function ShowScheduleDateTime(datetime) {
	var a = moment(datetime);
    datetime = a.format('dddd MMMM DD YYYY [at] h:mm a');
    return  datetime;
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
        var slugPattern = match[0];
        var slug = match[1];
        var renderRaw = false;
        if(slug.startsWith("RAW ")){
            renderRaw = true;
            slug = slug.substring(4);
        }
        if(slug.startsWith("SUMMERNOTE(")){
            slug = slug.substring(11);
            slug = slug.replace(")", ""); 
        }
        if(slug.startsWith("SUMMERNOTETEXT(")){
            slug = slug.substring(15);
            slug = slug.replace(")", "");
        }
        html = html.replace(slugPattern,data[slug]);
        console.log(slug);
    }
    html = RenderSharpSharp(html,data['accountID']);
    return html;
} 

function RenderSharpSharp(template,acctID){
    var s3URL = "##URL SRC=\"https://bkktest.s3.amazonaws.com/tmp/{{ACCTID}}-{{FIELDNAME}}.html\"##";
    var reg = /##(def[^#]+)##/;
    var html = template;
    while (match = reg.exec(html)) {
        var slugPattern = match[0];
        var slug = match[1];
        var sharpsharpData = s3URL.replace("{{ACCTID}}",acctID);
        sharpsharpData = sharpsharpData.replace("{{FIELDNAME}}",slug);
        html = html.replace(slugPattern,sharpsharpData);
        console.log(sharpsharpData);
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

function getEmailName(emailName,mode,campaignType) {
	if (mode == 'long') {
		if (campaignType == 'PromoteBlog') {		
			if (emailName == 'Email1') {
				emailName = 'Email #1: Sent to Everyone';
			} else if (emailName == 'Email2') {
				emailName = 'Email #2: Sent to Non-Openers';
			} else if (emailName == 'Email3') {
				emailName = 'Email #3: Sent to Non-Clickers';
			}
		} else {
			if (emailName == 'Email1') {
				emailName = 'Email #1: Sent to Everyone Who Downloads';
			} else if (emailName == 'Email2') {
				emailName = 'Email #2: Sent to Everyone Who Downloads';
			}
		}
	} else if (mode == 'short') {
		if (emailName == 'Email1') {
			emailName = 'Email #1';
		} else if (emailName == 'Email2') {
			emailName = 'Email #2';
		} else if (emailName == 'Email3') {
			emailName = 'Email #3';
		}
	}
	return emailName;
}


function addDays(theDate, days) {
	return new Date(theDate.getTime() + days * 24 * 60 * 60 * 1000);
}

function toDate(dateStr) {
	var parts1 = dateStr.split(" ");

	var parts2 = parts1[0].split("/");

	return new Date(parts2[2], parts2[0] - 1, parts2[1]);
}

function formatDateMDY(date) {
	var year = date.getFullYear();
	month = date.getMonth() + 1; // months are zero indexed
	day = date.getDate();


	return str_pad(month) + "/" + str_pad(day) + "/" + year;
}

function str_pad(n) {
	return String("0" + n).slice(-2);
}

function removeChar(s,r) {
	s = (s.length && s[0] == r) ? s.slice(1) : s;
	return s;
}