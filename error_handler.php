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


class handleError{
	
	
public function PostSite($url,$post) {

	//open connection
	$ch = curl_init();
	//set the url, number of POST vars, POST data
	curl_setopt($ch,CURLOPT_URL, $url);
	curl_setopt($ch,CURLOPT_POST, count($post));
	curl_setopt($ch,CURLOPT_POSTFIELDS, implode("&",$post));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	
	//execute post
	$result = curl_exec($ch);

	//close connection
	curl_close($ch);
	return $result; 
}	
	

public function apiError( $error, $description, $file, $line, $context ) {
        global $capi;


        if ( $error != E_NOTICE && $error != E_USER_NOTICE ) {
            switch ( $error ) {
                case E_USER_ERROR :
                    $type = "Error";
                    break;
                case E_WARNING :
                case E_USER_WARNING :
                    $type = "Warning";
                    break;
                case E_NOTICE :
                case E_USER_NOTICE :
                    $type = "Notice";
                    break;
                default :
                    $type = "Other Error";
            }
			
            $timedate = gmdate( "h:i A l F dS, Y" );
            $classname = "";
            $parentclass = "";
			
            if ( isset( $context['this'] ) && is_object( $context['this'] ) ) {
                $classname = get_class( $context['this'] );
                $parentclass = get_parent_class( $context['this'] );
                $errorstring .= "<p>Object/Class: '".$classname."', Parent Class: '{$parentclass}'.</p>\n";
            }
			
            $postfield = array( "page=error_report", "server=".$capi->domain, "softid=PLX", "version=6.0", "build=".$capi->build, "license=".$capi->license, "email=".$capi->webmaster, "php_version=".PHP_VERSION, "os=".PHP_OS, "error_panel=apanel", "error_line=".$line, "error_file=".$file, "error_msg=".$description, "error_type=".$type, "error_classname=".$classname, "error_parentclass=".$parentclass );
			
           
		
		$errorInfo =   handleError::PostSite("http://www.madplex.com/smartsoft/",$postfield);
		
		
		
		echo "<html>\r\n<head>\r\n<title>ERROR!</title>\r\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">\r\n";
		
		echo "\r\n</head>\r\n<body bgcolor=\"#FFFFFF\">\r\n<table width=\"554\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"2\">\r\n  <tr>\r\n    <td><font size=\"2\" face=\"Verdana\" color=\"#FF0000\">[ <strong>ERROR</strong> ]</font> - <font size=\"2\" face=\"Verdana\" color=\"#000000\">Sorry, an error occurred while processing your request.</font></td>\r\n  </tr>\r\n</table>\r\n<hr align=\"center\" size=\"1\" noshade width=\"554\" color=\"#000000\">\r\n<table width=\"554\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"2\" bgcolor=\"#EFEFEF\">\r\n  <tr bgcolor=\"#FBFBFB\">\r\n    <td width=\"90\"><font size=\"1\" face=\"Verdana\" color=\"#000000\"><b>Error Time:</b></font></td>\r\n    <td><font size=\"1\" face=\"Verdana\" color=\"#000000\">";
		echo $timedate;
		echo " GMT</font></td>\r\n  </tr>\r\n  <tr bgcolor=\"#FBFBFB\">\r\n    <td width=\"90\" valign=\"top\"><font size=\"1\" face=\"Verdana\" color=\"#000000\"><b>Error Details:</b></font></td>\r\n    <td><font size=\"1\" face=\"Verdana\" color=\"#000000\">";
		echo $description;
		echo "</font></td>\r\n  </tr>\r\n  <tr bgcolor=\"#FBFBFB\">\r\n    <td width=\"90\" valign=\"top\"><font size=\"1\" face=\"Verdana\" color=\"#000000\"><b>Script Path:</b></font></td>\r\n    <td><font size=\"1\" face=\"Verdana\" color=\"#000000\">";
		echo $file;
		echo "</font></td>\r\n  </tr>\r\n  <tr bgcolor=\"#FBFBFB\">\r\n    <td width=\"90\"><font size=\"1\" face=\"Verdana\" color=\"#000000\"><b>Line No.:</b></font></td>\r\n    <td><font size=\"1\" face=\"Verdana\" color=\"#000000\">";
		echo $line;
		echo "</font></td>\r\n  </tr>\r\n  ";
		echo $contentCell;
		echo "\r\n</table>\r\n<hr align=\"center\" size=\"1\" noshade width=\"554\" color=\"#000000\">\r\n<table width=\"554\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"2\" >\r\n  <tr>\r\n    <td><font size=\"2\" face=\"Verdana\" color=\"#000000\">A copy of this error message has been sent to MadPlex&reg; SmartSoft Service for a possible fix. To also inform the administrator of this site about this error message, please email <a href=\"mailto:";
		echo $capi->webmaster;
		echo "\">";
		echo $capi->webmaster;
		echo "</a>.<br><br>Thank you for your cooperation,<br>MadPlex&reg; Affiliate Software</font></td>\r\n  </tr>\r\n</table>\r\n</body>\r\n</html>";
		flush( );
		exit( );
		
	}
} 

public function webError( $error, $description, $file, $line, $context ) {
        global $capi;


        if ( $error != E_NOTICE && $error != E_USER_NOTICE ) {
            switch ( $error ) {
                case E_USER_ERROR :
                    $type = "Error";
                    break;
                case E_WARNING :
                case E_USER_WARNING :
                    $type = "Warning";
                    break;
                case E_NOTICE :
                case E_USER_NOTICE :
                    $type = "Notice";
                    break;
                default :
                    $type = "Other Error";
            }
			
            $timedate = gmdate( "h:i A l F dS, Y" );
            $classname = "";
            $parentclass = "";
			
            if ( isset( $context['this'] ) && is_object( $context['this'] ) ) {
                $classname = get_class( $context['this'] );
                $parentclass = get_parent_class( $context['this'] );
                $errorstring .= "<p>Object/Class: '".$classname."', Parent Class: '{$parentclass}'.</p>\n";
            }
			
            $postfield = array( "page=error_report", "server=".$capi->domain, "softid=PLX", "version=6.0", "build=".$capi->build, "license=".$capi->license, "email=".$capi->webmaster, "php_version=".PHP_VERSION, "os=".PHP_OS, "error_panel=apanel", "error_line=".$line, "error_file=".$file, "error_msg=".$description, "error_type=".$type, "error_classname=".$classname, "error_parentclass=".$parentclass );
			
           
		
		$errorInfo =   handleError::PostSite("http://www.madplex.com/smartsoft/",$postfield);
		
		
		
		echo "<html>\r\n<head>\r\n<title>ERROR!</title>\r\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">\r\n";
		
		echo "\r\n</head>\r\n<body bgcolor=\"#FFFFFF\">\r\n<table width=\"554\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"2\">\r\n  <tr>\r\n    <td><font size=\"2\" face=\"Verdana\" color=\"#FF0000\">[ <strong>ERROR</strong> ]</font> - <font size=\"2\" face=\"Verdana\" color=\"#000000\">Sorry, an error occurred while processing your request.</font></td>\r\n  </tr>\r\n</table>\r\n<hr align=\"center\" size=\"1\" noshade width=\"554\" color=\"#000000\">\r\n<table width=\"554\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"2\" bgcolor=\"#EFEFEF\">\r\n  <tr bgcolor=\"#FBFBFB\">\r\n    <td width=\"90\"><font size=\"1\" face=\"Verdana\" color=\"#000000\"><b>Error Time:</b></font></td>\r\n    <td><font size=\"1\" face=\"Verdana\" color=\"#000000\">";
		echo $timedate;
		echo " GMT</font></td>\r\n  </tr>\r\n  <tr bgcolor=\"#FBFBFB\">\r\n    <td width=\"90\" valign=\"top\"><font size=\"1\" face=\"Verdana\" color=\"#000000\"><b>Error Details:</b></font></td>\r\n    <td><font size=\"1\" face=\"Verdana\" color=\"#000000\">";
		echo $description;
		echo "</font></td>\r\n  </tr>\r\n  <tr bgcolor=\"#FBFBFB\">\r\n    <td width=\"90\" valign=\"top\"><font size=\"1\" face=\"Verdana\" color=\"#000000\"><b>Script Path:</b></font></td>\r\n    <td><font size=\"1\" face=\"Verdana\" color=\"#000000\">";
		echo $file;
		echo "</font></td>\r\n  </tr>\r\n  <tr bgcolor=\"#FBFBFB\">\r\n    <td width=\"90\"><font size=\"1\" face=\"Verdana\" color=\"#000000\"><b>Line No.:</b></font></td>\r\n    <td><font size=\"1\" face=\"Verdana\" color=\"#000000\">";
		echo $line;
		echo "</font></td>\r\n  </tr>\r\n  ";
		echo $contentCell;
		echo "\r\n</table>\r\n<hr align=\"center\" size=\"1\" noshade width=\"554\" color=\"#000000\">\r\n<table width=\"554\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"2\" >\r\n  <tr>\r\n    <td><font size=\"2\" face=\"Verdana\" color=\"#000000\">A copy of this error message has been sent to MadPlex&reg; SmartSoft Service for a possible fix. To also inform the administrator of this site about this error message, please email <a href=\"mailto:";
		echo $capi->webmaster;
		echo "\">";
		echo $capi->webmaster;
		echo "</a>.<br><br>Thank you for your cooperation,<br>MadPlex&reg; Affiliate Software</font></td>\r\n  </tr>\r\n</table>\r\n</body>\r\n</html>";
		flush( );
		exit( );
		
	}
}

// user defined error handling function
public function userErrorHandler($errno, $errmsg, $filename, $linenum, $vars){
    // timestamp for the error entry
    $dt = date("Y-m-d H:i:s (T)");

    // define an assoc array of error string
    // in reality the only entries we should
    // consider are E_WARNING, E_NOTICE, E_USER_ERROR,
    // E_USER_WARNING and E_USER_NOTICE
    $errortype = array (
                E_ERROR              => 'Error',
                E_WARNING            => 'Warning',
                E_PARSE              => 'Parsing Error',
                E_NOTICE             => 'Notice',
                E_CORE_ERROR         => 'Core Error',
                E_CORE_WARNING       => 'Core Warning',
                E_COMPILE_ERROR      => 'Compile Error',
                E_COMPILE_WARNING    => 'Compile Warning',
                E_USER_ERROR         => 'User Error',
                E_USER_WARNING       => 'User Warning',
                E_USER_NOTICE        => 'User Notice',
                E_STRICT             => 'Runtime Notice',
                E_RECOVERABLE_ERROR  => 'Catchable Fatal Error'
                );
    // set of errors for which a var trace will be saved
    $user_errors = array(E_USER_ERROR, E_USER_WARNING, E_USER_NOTICE);
    
    $err = "<errorentry>\n";
    $err .= "\t<datetime>" . $dt . "</datetime>\n";
    $err .= "\t<errornum>" . $errno . "</errornum>\n";
    $err .= "\t<errortype>" . $errortype[$errno] . "</errortype>\n";
    $err .= "\t<errormsg>" . $errmsg . "</errormsg>\n";
    $err .= "\t<scriptname>" . $filename . "</scriptname>\n";
    $err .= "\t<scriptlinenum>" . $linenum . "</scriptlinenum>\n";

    if (in_array($errno, $user_errors)) {
        $err .= "\t<vartrace>" . wddx_serialize_value($vars, "Variables") . "</vartrace>\n";
    }
    $err .= "</errorentry>\n\n";
    
    // for testing
    // echo $err;

    // save to the error log, and e-mail me if there is a critical user error
    error_log($err, 3, "/usr/local/php4/error.log");
    if ($errno == E_USER_ERROR) {
        mail("phpdev@madmaverickmedia.com", "Critical User Error", $err);
    }
}












#### End Class
}

