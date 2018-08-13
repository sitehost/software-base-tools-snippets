Software Base Tools & Snippets

#1. CAPI - Capi is the config for all software.
	include($base."capi.php");
	$capi = new capi();


#2. SQL - This Class is shortcut for MySQLi 

	include($base."/classes/sql.php");
	$sql= new mysql();
	
	It gets its DATABSE info from CAPI
	
	2a. Fetch Query
		$sql->query("QUERY HERE");
	
	2b. Fetch Assoc Array
		$sql->fetchAssoc("QUERY HERE");	
	
	2c. Fetch Array
		$q = $sql->query("Query");	
		while($data = $sql->fetchArray($q)){
			print_r($data);
		}
		
	2d. Get Last ID
		$id = $sql->lastid();
		