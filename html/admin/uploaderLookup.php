<?php
date_default_timezone_set('America/Los_Angeles');

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Upload Mail File :: NSM Leads</title>
<link rel="stylesheet" type="text/css" href="admin.css">
<link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<script type="text/javascript">
function validation() {
	if( document.getElementById('fileUpload').value == '' ) {
		alert('Please select a file to upload.');
		return false;	
	}
	/*
	var fileext = document.getElementById('fileUpload').value.substr(-4).toLowerCase();
	if(( fileext != '.csv' ) && ( fileext != '.txt' )) {
		alert('The file must be in the CSV or TXT format.');
		return false;
	}
	*/
	$('#submitButton').hide();
	$('#onSubmitMessage1').show();	
	return true;
}
</script>
</head>

<body>

<div class="frame">

    <form name="form1" enctype="multipart/form-data" method="post" action="importLookupFile.php" onsubmit="return validation();">
        
        <p><b>Add New Logic or Find & Replace Existing Logic</b></p>

		<div id='productionDiv' style="DISPLAY: none;">
			<p>Step 1. Please load your updated logic lookup table to "Staging" and test before loading to "Production".<br>
				<label><input id="Staging" type="radio" name="uploadType" value="Staging" checked="checked">Staging for Testing</label> &nbsp;<br>
				<label><input id="Production" type="radio" name="uploadType" value="Production">Production</label>&nbsp;<br>
			</p>
        </div>

		<div id='stagingDiv' style="DISPLAY: none;">
			<p>Step 1. Please load your updated logic lookup table to "Staging".<br>
				<label><input id="Staging" type="radio" name="uploadType" value="Staging" checked="checked">Staging for Testing</label> &nbsp;<br>
			</p>
        </div>
        
        <p>Step 2. What database do you want to update?<br>
        	<label><input id="Incoming" type="radio" name="listType" value="Incoming" checked="checked">Incoming Call List Lookup Table</label> &nbsp;<br>            
        </p>
        
        <p>Step 3. Select the mail file on your computer:<br><input type="file" name="fileUpload" id="fileUpload"></p>

        <p id="submitButton">Step 4. Begin your Upload/Find & Replace.<input name="submitButton" type="submit" value="Upload..."></p>
        
        <p id="onSubmitMessage" style="text-align:center; font-weight:bold; display:none;">Depending on the size of the list, this may take awhile. Please be patient.</p>

		<div id="onSubmitMessage1" style="text-align:center; font-weight:bold; color:red; display:none;">Your file is being uploaded to the server. This can take up to several minutes. Do not close this window. Please wait...</div>
        
        <fieldset style="margin:30px 0px 10px 0px"><legend><strong>Requirements</strong></legend>
            &bull; Data file must contain correct header columns in first row.<br>
            &bull; Files must be under 50MB.<br>
            &bull; Only &quot;.csv&quot; or &quot;.txt&quot; files (tab or comma delimited) are accepted.<br>
			&bull; Avoid special characters by checking in Notepad ++ under &quot;Encode in UTF-8.&quot;
        </fieldset>
        
    </form>

</div>

<script src="https://code.jquery.com/jquery-1.9.1.js"></script>
<script type="text/javascript">
$(document).ready(function(e) {
		
		$("#productionDiv").hide();
		$("#stagingDiv").hide();
		var production = '<?php echo @$_SESSION['production']; ?>';
		if (production == "y") {
			$("#productionDiv").show();
		} else {
			$("#stagingDiv").show();
		}
	});

</script>

</body>
</html>
