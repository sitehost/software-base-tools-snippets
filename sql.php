<?php
/*########################################################################################

	  _             ____           _     _      _ _   _   _       __ _      _     _ 
	 | |           |  _ \         | |   | |    (_) | | | | |     / _(_)    | |   | |
	 | |__  _   _  | |_) |_ __ ___| |_  | |     _| |_| |_| | ___| |_ _  ___| | __| |
	 | '_ \| | | | |  _ <| '__/ _ \ __| | |    | | __| __| |/ _ \  _| |/ _ \ |/ _` |
	 | |_) | |_| | | |_) | | |  __/ |_  | |____| | |_| |_| |  __/ | | |  __/ | (_| |
	 |_.__/ \__, | |____/|_|  \___|\__| |______|_|\__|\__|_|\___|_| |_|\___|_|\__,_|
			 __/ |                                                                  
			|___/                                                                   
	
		
	 _                                   ______    _____  ____  _____                     
	| |                          ____   |___  /   |____ |/ ___||  ___|                    
	| |_ ___  __ _ _ __ ___     / __ \     / /_____   / / /___ |___ \  ___ ___  _ __ ___  
	| __/ _ \/ _` | '_ ` _ \   / / _` |   / /______|  \ \ ___ \    \ \/ __/ _ \| '_ ` _ \ 
	| ||  __/ (_| | | | | | | | | (_| | ./ /      .___/ / \_/ |/\__/ / (_| (_) | | | | | |
	 \__\___|\__,_|_| |_| |_|  \ \__,_| \_/       \____/\_____/\____(_)___\___/|_| |_| |_|
								\____/   
								

		@ Version No.: 1.0
		@ Build No.: 1.0.0
		@ Copyright 2015 by Bret Littlefield
		@ Copyright 2015 by Adventure 74 Inc
		@ Created: Thu Oct 01, 2015
		@ Updated:
	   
	   Before any modification to this script, please read the complete
	   terms and conditions at: http://www.madplex.com/terms
   
########################################################################################*/

                                                
                                                                                      

class mysql {
	/// MySqli
	private $dbhandle = null;

public function __construct(){
	global $capi;
					 
	$this->dbhandle = mysqli_connect($capi->db_hostname, $capi->db_username, $capi->db_password, $capi->db_name);

			return;

}
	
public function prefix($q){
		global $capi;
		$q = str_ireplace("#__",$capi->db_prefix,$q);
		return $q;
}
	
public function query($statement, $funcName ="NOT SET"){

		$statement = $this->prefix($statement);
		if (!$query = mysqli_query( $this->dbhandle,"" . $statement)){ trigger_error("<b>MySQLi server generate error:</b> " . mysqli_error ($this->dbhandle) . "<br><br><b>Query:</b> " . htmlspecialchars($statement) . ("<br><br><b>Location:</b> " . $funcName), E_USER_WARNING); }
			return $query;
}


public function fetchAssoc($statement, $funcName ="NOT SET"){
	$statement = $this->prefix($statement);
	if (!$query = mysqli_query( $this->dbhandle,"" . $statement)){ trigger_error("<b>MySQL server generate error:</b> " . mysqli_error ($this->dbhandle) . "<br><br><b>Query:</b> " . htmlspecialchars($statement) . ("<br><br><b>Location:</b> " . $funcName), E_USER_WARNING); }
		$result = mysqli_fetch_assoc($query);
		 mysqli_free_result($query);
		return $result;
}

public function numRows($statement, $funcName ="NOT SET"){
	$statement = $this->prefix($statement);
	if (!$query =  mysqli_query( $this->dbhandle,"" . $statement)){ trigger_error("<b>MySQL server generate error:</b> " . mysqli_error ($this->dbhandle) . "<br><br><b>Query:</b> " . htmlspecialchars($statement) . ("<br><br><b>Location:</b> " . $funcName), E_USER_WARNING); }
		$result = mysqli_num_rows($query);
		 mysqli_free_result($query);
		return $result;
}

public function fetchArray($query){
		return mysqli_fetch_array($query,true);
}

public function affectedRows($query){
		return mysqli_stmt_affected_rows($query);
}

public function freeResult($query){
		 mysqli_free_result($query);
		return;
}

public function real_escape_string($query){
		return mysqli_real_escape_string($this->dbhandle,$query );
}

public function close(){
		mysqli_close($this->dbhandle);
		return;
}
	
public function lastid(){
		return mysqli_insert_id($this->dbhandle);
}
		
### end Class
}