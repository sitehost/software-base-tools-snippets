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

                                                 

class capi {
	public $role;
	public $username;
	public $secret;
	
	
public function __construct(){
	## base

	######### MYSQLi Database
	$this->db_hostname = "127.0.0.1";
	$this->db_name="";
	$this->db_username="";
	$this->db_password="";
	$this->db_prefix ="";
	
	######### Software
	$this->ShowDebug =true;  ## Shows System Info for debug
	$this->softpath =$_SERVER['DOCUMENT_ROOT']."/";
	$this->sessionpath  =$this->softpath."/sessions";
	$this->webmaster ="team@domain.com";
	$this->license ="MikeG";
	$this->build = "v1.0";
	
	$this->domain ="domain.com";
	$this->softbase ="http://domain.com"; ## Domain name with Sub no trailing slash
	$this->scriptfile ="index.php";
	$this->Ascriptfile ="admin.php";
	$this->api ="api/api.php";
	$this->template ="default"; ### This is the name of the Folder that contains the template.php to user
	$this->sess_name ="madplexPlatform";
	$this->sess_cookie_lifetime ="9000"; ## in Seconds 10 mins = 600 seconds
	$this->logoutTime = "30"; # This is how many mins of no action or movement that the users is logged out.
	$this->api_secret="";
	$this->recordsLimit = 1000; // this is how many records to show at a time
	
	######## User
	$this->stall = "1"; ## MINUTES - This is the Mins a User can stay loged in and not do anything before timeout
	$this->loginAttpemts = "4"; ## Number of times a Person can Try to login with Wrong Password.
	
	$this->output="";	
}




public function ob_make($output,$name) {
	return sprintf('<script>console.log( \''.$name.': \'+unescape("%s"));</script>',rawurlencode($output));
}

public function debug( $data,$name ="DEBUG" ) {
	if($this->ShowDebug == false){ return;}
	if ( is_array( $data ) || is_object($data) ){
		$this->ob_make($output,$name);
		$data = json_decode(json_encode($data),true);
		ob_start();
		print_r($data);
		$contents = ob_get_contents();
		ob_end_clean();	
		
		$this->output .= $this->ob_make($contents,$name);
	}else{
		$this->output .= "<script>console.log( 'Debug Objects: " . $data . "' );</script>\n\n";
	}
	
	
}



## end class	
}