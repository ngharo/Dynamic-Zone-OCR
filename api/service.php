<?
if($_POST){
	$con = mysql_connect("localhost","root","qwerty12");
	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db("buildhealth", $con);
	switch($_POST['op']){
	case 'add_view':
		$name = htmlentities(mysql_real_escape_string($_POST['name']));
		$access = htmlentities(mysql_real_escape_string($_POST['access']));
		$add_sql = "insert into forms (name, access) values ('".$name."', '".$access."')";
		$res = mysql_query($add_sql);
		if(!$res){
			throw new Exception("Failed to add record");
		}else{
			echo json_encode(array("res" => "OK", "formid" => mysql_insert_id(), "name" => $name));
		}
		break;
	case 'add_field':
		$formId = htmlentities(mysql_real_escape_string($_POST['form_id']));
		$name = htmlentities(mysql_real_escape_string($_POST['name']));
		$type = htmlentities(mysql_real_escape_string($_POST['type']));
		$value = htmlentities(mysql_real_escape_string($_POST['value']));
		$priority = htmlentities(mysql_real_escape_string($_POST['priority']));
		$access = htmlentities(mysql_real_escape_string($_POST['access']));
		$sql = "insert into fields (form_id, name, type, value, priority, access) value ('".$formId."', '".$name."', '".$type."', '".$value."', '".$priority."', '".$access."')";
		$res = mysql_query($sql);
		if(!$res){
			throw new Exception("Failed to add field");
		}else{
			echo json_encode(array("res" => "OK", "fieldid" => mysql_insert_id()));
		}
		break;
	case 'map':
		$templateId = htmlentities(mysql_real_escape_string($_POST['template_id']));
		$name = htmlentities(mysql_real_escape_string($_POST['name']));
		$coords = mysql_real_escape_string($_POST['coords']);
		$sql = "insert into mapping (template_id, fragment_id, name, coords) value ('".$templateId."', UUID(), '".$name."', '".$coords."')";
		$res = mysql_query($sql);
		if(!$res){
			throw new Exception("Failed to add map");
		}else{
			echo json_encode(array("res" => "OK", "id" => mysql_insert_id()));
		}
		break;

	case 'get_map':
		$template_id = $_POST['template_id'];
		$q = mysql_query("SELECT id,fragment_id,name,coords FROM mapping WHERE template_id = '{$template_id}'");
		$rows = array();
		while($r = mysql_fetch_array($q, MYSQL_ASSOC)) {
			$rows[] = $r;
		}
		echo json_encode($rows);
		break;

	case 'update_fragment':
		$fragment_id = $_POST['fragment_id'];
		$coords = mysql_real_escape_string($_POST['coords']);
		$name = htmlentities(mysql_real_escape_string($_POST['name']));
		$q = mysql_query("UPDATE mapping SET coords = '{$coords}', name = '{$name}' WHERE fragment_id = '{$fragment_id}'");

		if($q) {
			echo json_encode(array('res' => 'OK'));
		} else {
			throw new Exception('fffffffffffffffffff');
		}
		break;

	case 'get_forms':
		$q = mysql_query("SELECT * FROM forms");
		$rows = array();
		while($r = mysql_fetch_array($q, MYSQL_ASSOC)) {
			$rows[] = $r;
		}
		echo json_encode($rows);
		break;

	case 'get_templates':
		$q = mysql_query("SELECT distinct(template_id),id AS upload_id FROM forms");
		$rows = array();
		while($r = mysql_fetch_array($q, MYSQL_ASSOC)) {
			$rows[] = $r;
		}
		echo json_encode($rows);
		break;

	case 'save_form':
		$upload_uuid = $_POST['upload_id'];
		$template_uuid = $_POST['template_id'];

		$q = mysql_query("INSERT INTO forms (id, template_id) VALUES('{$upload_uuid}', '{$template_uuid}')");
		if($q) {
			echo json_encode(array('res' => 'OK'));
		} else {
			throw new Exception(mysql_error());
		}
		break;

	default:
		throw new Exception("No op given");
	}
	mysql_close($con);
}
?>

