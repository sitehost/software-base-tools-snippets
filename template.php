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

class template {
	public $template;
	public $navMain;
	public $_head;
	public $description;
	public $title;
	public $keywords;
	public $_membersTop;
	public $current_page;
	public $message ="";
	public $debug;
	public $error;
	
	
public function __construct(){
	global $capi,$sql,$funct;
	$capi->debug("Template|construct()" );

	$this->_head=array("script"=>array(),"text"=>array(),"style"=>array());
	

	/// all the change of Template on the fly. 
	if(isset($_REQUEST['tmpl']) && strlen($_REQUEST['tmpl']) > 1 ){
		$capi->template=strtolower(addslashes($_REQUEST['tmpl']));
	}
	

	
}

public function page($page){
		global $capi,$sql,$funct;
		$capi->debug("Template|page( ".$page." )" );
		if($capi->role == "login" || $capi->role == "logout"){ return; }
	
	ob_start();
		if(file_exists($capi->softpath."/templates/".$capi->template."/pages/".strtolower($page).".page.php")){
			include($capi->softpath."/templates/".$capi->template."/pages/".strtolower($page).".page.php");
		} else {
			include($capi->softpath."/templates/default/pages/home.page.php");	
		}
	$contents = ob_get_contents();
	ob_end_clean();	
	return $contents;
}



public function loadFile($file){
	global $capi,$sql,$funct;
	$capi->debug("Template|loadFile( ".$file." )" );
	ob_start();
	include($file);
	
	$contents = ob_get_contents();
	ob_end_clean();	
	return $contents;
}


public function addScript($url){
	$this->_head['script'][]=$url;
	return;
}

public function addHead($head){
	$this->_head['text'][]=$head;
}

public function addStyle($url){
	$this->_head['style'][]=$url;
	return;
}

public function head(){
 $_head ="";
 if(isset($this->_head['script']) || isset($this->_head['style'])){
	 foreach($this->_head as $type=>$scripts){
		foreach($scripts as $k=>$script){
			switch($type){
				case'script':
					$_head .='<script type="text/javascript" src="'.$script.'"></script>'."\n\r";
				break;
				case'style':
					$_head .='<link rel="stylesheet" href="'.$script.'" type="text/css" media="screen" />'."\n\r";
				break;	
				case'text':
					$_head .=$script."\n\r";
				break;	
			}
		}
	 }
 }
 
 return $_head;	
}
public function render($component){
	global $capi,$sql,$funct;
	$capi->debug("Template|render()" );
	### Set the Template	
	if(file_exists($capi->softpath."/templates/".$capi->template."/".$capi->role.".tmp.php")){
		$this->template = $this->loadFile($capi->softpath."/templates/".$capi->template."/".$capi->role.".tmp.php");
	}  else {
		$this->template = $this->loadFile($capi->softpath."/templates/default/".$capi->role.".tmp.php");
	}
		
			
	$this->component = $component;
	$this->parseTemplate();
	
	#### Add a Provision that if Javascript is passed it will respond in JAVA
	if($_REQUEST['javascript']==true){
		ob_start(array($this, 'ob_makejavascripthandler'));
	}
	if($_REQUEST['json']==true){
		$this->template= preg_replace("/href=\"index.php\?page=(.+)\">/im",'href="javascript:loadPage(\'$1\');">',$this->template);
		echo json_encode(array("content"=>trim($this->template)));
	} else {
		echo $this->template;
	}
	// reset the Message
	$this->message ="";
	//echo $component;
	$capi->debug( $capi,"CAPI" );
$capi->debug( $_REQUEST,"REQUEST" );
$capi->debug( $_SESSION ,"SESSION");
if($capi->ShowDebug == true){
		echo $capi->output;
}
	exit;
}

public function ob_makejavascripthandler($output) {
	return sprintf('document.write(unescape("%s"));',
	rawurlencode($output));
}

public function parseTemplate(){
	global $capi,$sql,$funct;
	$matches = array();

	if (preg_match_all('#<doc:include type="([^"]+)" (.*)\/>#iU', $this->template, $matches)){
		$template_tags_first = array();
		$template_tags_last = array();

	
		#### If Admin Add Admin Features
	
	

	
		// Step through the jdocs in reverse order.
		for ($i = count($matches[0]) - 1; $i >= 0; $i--){
			switch($matches[1][$i]){
				case'admin':
					if($user->profile['role'] == "admin"){			
						ob_start();
						$this->navAdmin();
						$admin = ob_get_contents();
						ob_end_clean();
					} else {
						$admin ="";	
					}
					$this->template = str_ireplace($matches[0][$i], $admin,$this->template);
				break;
				case'head':
					$this->template = str_ireplace($matches[0][$i], $this->head(),$this->template);
				break;
				
				case'title':
				$this->template = str_ireplace($matches[0][$i], "<title>{$this->title}</title>",$this->template);
				break;
				
				case'description':
				$this->template = str_ireplace($matches[0][$i], "<meta name=\"description\" content=\"{$this->description}\">",$this->template);
				break;
				
				case'keywords':
					$this->template = str_ireplace($matches[0][$i], "<meta name=\"keywords\" content=\"{$this->keywords}\">",$this->template);
				break;
				
				default:
					$this->template = str_ireplace($matches[0][$i], $this->$matches[1][$i],$this->template);
				break;
			}
			

		}
		
		// Reverse the last array so the docs are in forward order.
		//$template_tags_last = array_reverse($template_tags_last);
		//$this->_template_tags = $template_tags_first + $template_tags_last;
	}
	
	return;
}
	
#end Class
}
