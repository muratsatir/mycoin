<?php
class db_connection {
	private static $current_instance;
	public static function connection($data=null) {
		/** Statik Definition */
		$db_hostname = "localhost";
		$db_name = 'mycoin';
		$db_username = 'root';
		$db_password= '';

	  if(isset($data->db_hostname)) $db_hostname=$data->db_hostname;
	  if(isset($data->db_name)) $db_name = $data->db_name;
	  if(isset($data->username)) $db_username = $data->username;
	  if(isset($data->password)) $db_password= $db_password;

		if (!isset(self::$current_instance)) {
			try {
				self::$current_instance = new PDO("mysql:host=".$db_hostname.";dbname=".$db_name, $db_username, $db_password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
				self::$current_instance->exec("SET NAMES 'UTF8'");
			} catch (Exception $e) {
				exit($e->getMessage());
			}
		}
		return self::$current_instance;
	}
}