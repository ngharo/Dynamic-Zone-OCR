<!doctype html>
<html>
<head>
<title>orcz</title>
  <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
  <script type="text/javascript" src="http://code.jquery.com/ui/jquery-ui-git.js"></script>
	<link rel="stylesheet" href="http://code.jquery.com/ui/jquery-ui-git.css" type="text/css" media="all" />
	<script type="text/javascript" src="uploader/client/fileuploader.js"></script>
	<link rel="stylesheet" href="uploader/client/fileuploader.css" type="text/css" media="all" />
	<script type="text/javascript" src="list.js"></script>
	<style type="text/css">
	#select-template-button {
	}
	</style>
</head>
<body>
	<div id="nav-container">
		<button id="new-form-button">Upload New Form</button>
	</div>

	<div id="list-container">
	</div>

	<div id="newform-dialog" class="ui-helper-hidden">
		<div id="newform-loading" class="ui-helper-hidden">
			Loading ...
		</div>

		<div id="upload-step1" class="upload-step">
			<div id="file-uploader">       
					<noscript>          
							<p>Please enable JavaScript to use file uploader.</p>
							<!-- or put a simple form for upload here -->
					</noscript>         
			</div>
		</div>

		<div id="upload-step2" class="ui-helper-hidden upload-step">
			Choose an existing template <br />
			<div id="template-select-list">
				<button id="select-template-button" disabled>Select</button>
			</div>
			<br />
			OR
			<br />
			<button id="new-template-button">Create New</button>
		</div>
	</div>
</body>
</html>
