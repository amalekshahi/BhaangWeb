<!-- Google Tag Manager -->
<script>
	(function(w, d, s, l, i) {
		w[l] = w[l] || [];
		w[l].push({
			'gtm.start': new Date().getTime(),
			event: 'gtm.js'
		});
		var f = d.getElementsByTagName(s)[0],
			j = d.createElement(s),
			dl = l != 'dataLayer' ? '&l=' + l : '';
		j.async = true;
		j.src =
			'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
		f.parentNode.insertBefore(j, f);
	})(window, document, 'script', 'dataLayer', 'GTM-KWJ66T');
</script>


<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="cache-control" content="max-age=0" />
<meta http-equiv="cache-control" content="no-cache" />
<meta http-equiv="expires" content="0" />
<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
<meta http-equiv="pragma" content="no-cache" />
<title>Da Vinci:
	<?php echo $USERNAME;?> in
	<?php echo $accountName;?> on page
	<?php echo basename($_SERVER[REQUEST_URI]);?>
</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="font-awesome/css/font-awesome.css" rel="stylesheet">
<link href="css/animate.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link rel="icon" href="https://s3.amazonaws.com/mindfiredavinci/img/DV-logo.png" type="image/x-icon" />
<link href="css/plugins/summernote/summernote.css" rel="stylesheet">
<link href="css/plugins/summernote/summernote-bs3.css" rel="stylesheet">
<link href="css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">
<link href="css/plugins/clockpicker/clockpicker.css" rel="stylesheet">
<link href="css/plugins/datapicker/datepicker3.css" rel="stylesheet">
<link rel="stylesheet" href="https://websemantics.github.io/Image-Select/src/chosen/chosen.css">
<link rel="stylesheet" href="https://websemantics.github.io/Image-Select/src/ImageSelect.css">
<link href="css/plugins/chosen/bootstrap-chosen.css" rel="stylesheet">

<!-- x-editable (bootstrap version) -->
<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.4.6/bootstrap-editable/css/bootstrap-editable.css" rel="stylesheet" />

<!-- Sweet alert -->
<link rel="stylesheet" href="css/sweet/sweetalert.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.7.0/sweetalert2.css" rel="stylesheet">

<!-- TouchSpin -->
<link href="css/plugins/touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet">

<!-- FooTable -->
<link href="css/plugins/footable/footable.core.css" rel="stylesheet">

<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.1.1/min/dropzone.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.js"></script>

<!-- Angular -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/angular-xeditable/0.8.0/css/xeditable.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-animate.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-aria.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-messages.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angular_material/1.1.4/angular-material.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-xeditable/0.8.0/js/xeditable.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/danialfarid-angular-file-upload/12.2.13/ng-file-upload-all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-summernote/0.8.1/angular-summernote.js"></script>
<!--<script src="js/welcome.js"></script>-->

<!-- ui-switch -->
<link rel="stylesheet" href="js/angular-ui-switch.min.css" />
<script src="js/angular-ui-switch.js"></script>
<script src="js/angular-davinci.js"></script>

<script src="https://cdn.jsdelivr.net/angular.moment/1.0.1/angular-moment.min.js"></script>
<script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="js/inspinia.js"></script>
<script src="js/plugins/pace/pace.min.js"></script>
<script src="js/davinci.js"></script>

<style class="cp-pen-styles">
	/*@charset "UTF-8";*/
	/* 2015 Johannes Jakob
	     Made with <3 in Germany */

	.window {
		background: #fff;
		width: 700px;
		margin: auto;
		margin-top: .5vh;
		border: 1px solid #acacac;
		border-radius: 6px;
		box-shadow: 0px 0px 20px #acacac;
	}

	.titlebar {
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0, #ebebeb, color-stop(1, #d5d5d5)));
		background: -webkit-linear-gradient(top, #ebebeb, #d5d5d5);
		background: -moz-linear-gradient(top, #ebebeb, #d5d5d5);
		background: -ms-linear-gradient(top, #ebebeb, #d5d5d5);
		background: -o-linear-gradient(top, #ebebeb, #d5d5d5);
		background: linear-gradient(top, #ebebeb, #d5d5d5);
		color: #4d494d;
		font-size: 11pt;
		line-height: 20px;
		text-align: center;
		width: 100%;
		height: 20px;
		border-top: 1px solid #f3f1f3;
		border-bottom: 1px solid #b1aeb1;
		border-top-left-radius: 6px;
		border-top-right-radius: 6px;
		user-select: none;
		-webkit-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		-o-user-select: none;
		cursor: default;
	}

	.buttons {
		padding-left: 8px;
		padding-top: 3px;
		float: left;
		line-height: 0px;
	}

	.buttons:hover a {
		visibility: visible;
	}

	.close {
		background: #ff5c5c;
		font-size: 9pt;
		width: 11px;
		height: 11px;
		border: 1px solid #e33e41;
		border-radius: 50%;
		display: inline-block;
	}

	.close:active {
		background: #c14645;
		border: 1px solid #b03537;
	}

	.close:active .closebutton {
		color: #4e0002;
	}

	.closebutton {
		color: #820005;
		visibility: hidden;
		cursor: default;
	}

	.minimize {
		background: #ffbd4c;
		font-size: 9pt;
		line-height: 11px;
		margin-left: 4px;
		width: 11px;
		height: 11px;
		border: 1px solid #e09e3e;
		border-radius: 50%;
		display: inline-block;
	}

	.minimize:active {
		background: #c08e38;
		border: 1px solid #af7c33;
	}

	.minimize:active .minimizebutton {
		color: #5a2607;
	}

	.minimizebutton {
		color: #9a5518;
		visibility: hidden;
		cursor: default;
	}

	.zoom {
		background: #00ca56;
		font-size: 9pt;
		line-height: 11px;
		margin-right: 4px;
		width: 11px;
		height: 11px;
		border: 1px solid #14ae46;
		border-radius: 50%;
		display: inline-block;
	}

	.zoom:active {
		background: #029740;
		border: 1px solid #128435;
	}

	.zoom:active .zoombutton {
		color: #003107;
	}

	.zoombutton {
		color: #006519;
		visibility: hidden;
		cursor: default;
	}

	.content {
		padding: 10px;
	}
	/* window END */
	/* content BEGIN */

	h3 {
		margin-top: 0px;
	}
	/* content END */

	.hover {
		border: 2px solid transparent;
	}

	.hover:hover {
		text-shadow: 2px 2px 20px red;
		border: 2px dashed red;
	}

	.glyphicon.spinning {
		animation: spin 1s infinite linear;
		-webkit-animation: spin2 1s infinite linear;
	}

	@keyframes spin {
		from {
			transform: scale(1) rotate(0deg);
		}
		to {
			transform: scale(1) rotate(360deg);
		}
	}

	@-webkit-keyframes spin2 {
		from {
			-webkit-transform: rotate(0deg);
		}
		to {
			-webkit-transform: rotate(360deg);
		}
	}

	[ng-click] {
		cursor: pointer;
	}
</style>
	
<script src="js/date.format.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
<script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.js"></script>
<link data-require="chosen@*" data-semver="1.0.0" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.0/chosen.min.css" />
<script src="js/plugins/chosen/chosen-add-option.js"></script>
<script data-require="chosen@*" data-semver="1.0.0" src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.0/chosen.jquery.min.js"></script>
<script data-require="chosen@*" data-semver="1.0.0" src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.0/chosen.proto.min.js"></script>
<script src="https://rawgit.com/leocaseiro/angular-chosen/master/dist/angular-chosen.min.js"></script>