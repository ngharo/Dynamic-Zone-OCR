<!doctype html>
<html>
<head>
	<title>DB Admin</title>
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/ui/jquery-ui-git.js"></script>
	<script type="text/javascript" src="../scripts/all.js"></script>
	<link rel="stylesheet" href="http://code.jquery.com/ui/jquery-ui-git.css" type="text/css" media="all" />
	<link rel="stylesheet" href="../styles/main.css" type="text/css" media="all" />
</head>
<body>
	<div id="navigation">
		<button id="new-form-button" disabled>New Form</button>
		<button id="save-form-button">Save Form</button>
	</div>

	<div id="field-creation-container">
		<fieldset>
			<legend>New Field</legend>
		
			<table cellpadding="0" cellspacing="0" id="new-form-table">
				<thead class="ui-widget-header">
					<tr>
						<td>Label</td>
						<td>Type</td>
						<td>Value</td>
						<td>Priority</td>
					</tr>
				</thead>
				<tbody>
					<tr class="ui-widget-content">
						<td><input type="text" name="label" /></td>
						<td>
							<select name="type">
								<option value="text" selected>Text</option>
								<option value="textarea">Textarea</option>
								<option value="select">Select</option>
							</select>
						</td>
						<td><input type="text" name="default_value" /></td>
						<td><input type="text" name="priority" /></td>
					</tr>
				</tbody>
			</table>

			<button id="save-field-button">Save Field</button>
		</fieldset>
	</div>	

	<div id="content-container">
		<!-- form list -->
	</div>

	
</body>
</html>
