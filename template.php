<?php
require_once('uuid.php');
if(isset($_GET['id'])) {
	$template_id = $_GET['id'];
} else {
	$template_id = gen_uuid();
}

if(!isset($_GET['upload_id'])) {
	die('no');
}

$upload_file = $_GET['upload_id'] . '.jpg';
?>
<!doctype html>
<html>
	<head>
		<title>Form OCR</title>
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
		<script type="text/javascript" src="http://code.jquery.com/ui/jquery-ui-git.js"></script>
		<script type="text/javascript" src="scripts/jcrop/js/jquery.Jcrop.min.js"></script>
		<script type="text/javascript" src="scripts/jquery.ba-resize.min.js"></script>
		<script type="text/javascript" src="canvas.js"></script>
		<link rel="stylesheet" href="http://code.jquery.com/ui/jquery-ui-git.css" type="text/css" media="all" />
		<link rel="stylesheet" type="text/css" media="screen" href="scripts/jcrop/css/jquery.Jcrop.css" />
		<style type="text/css">
			#crop-preview-ocr {
				font-style: italic;
			}
			#crop-preview {
				margin-bottom: 10px;
			}
			#mapName {
				width: 100%;
			}
			.fragment-box {
				position: absolute;
				border: 1px dotted #1a8cce;
				background-color: rgba(24,140,206,.75);
				z-index: 1001;
				cursor: pointer;
				text-align: center;
			}
			#scan-img {
				position: absolute;
				z-index: 1000;
			}
			body {
				padding: 0; margin: 0;
			}
			.fragment-box-label {
				font-size: 2em;
				font-weight: bold;
				color: rgb(252, 155, 0);
			}
		</style>
	</head>
	<body data-template_id="<?=$template_id?>">
	<img src="files/<?=$upload_file?>" id="scan-img" />
		<div id="mapzone-dialog" class="ui-helper-hidden">
			<div id="crop-preview"></div>
			OCR Preview <br />
				<span id="crop-preview-ocr"></span>
			<hr />
			<input type="text" placeholder="Name" id="mapName" /><br />
		</div>
	</body>
</html>
