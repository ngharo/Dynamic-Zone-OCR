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
		default:
			throw new Exception("No op given");
        }
	mysql_close($con);
}
?>

