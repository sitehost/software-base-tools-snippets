<?php

class cache {
	
public function __construct(){
	
############# Brets CACHE HACK OVERIDE
	$cache ="/home/";
	 // define the path and name of cached file
	$cachefile = $cache.'/'.base64_encode($_SERVER['REQUEST_URI']).'.php';
     // define how long we want to keep the file in seconds.
    $cachetime = 2600000;// keep for 30 days
    // Check if the cached file is still fresh. If it is, serve it up and exit.
    if (file_exists($cachefile) && time() - $cachetime< filemtime($cachefile)) {
    include($cachefile);
       // exit;
    } else{
	ob_start();
	
	///// THE SITE PAGES HERE
	
	// This is the site/page
	
	
	////////// get page and cache it.
	$page = ob_get_contents();
	$fp = fopen($cachefile, 'w');
	fwrite($fp, $page);
	fclose($fp);
	// finally send browser output
	ob_end_flush();
		
	}

	
	
}




	
### End Class	
}