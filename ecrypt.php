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

//$code = new ecrypt();
//
//if(strlen($_REQUEST['token']) > 8){
//	echo $code->Decode($_REQUEST['token'],1);
//} else {
//	//echo $code->Encode("token|SecretAPICode|expires|",1);
//	echo $code->Encode("0123456789",1);
//}



class ecrypt {
	private $code=array();
	
public function __construct(){
	///// This is our Private Code
	$this->code[0] = array(
	"1"=>"lLsd","2"=>"Zeal","3"=>"GtUs","4"=>"gqes","5"=>"XomH","6"=>"cWtl","7"=>"RLPL","8"=>"WzFj","9"=>"FfBT",
	"0"=>"CDOd","a"=>"NfCa","b"=>"zUOb","c"=>"kgEs","d"=>"hcYb","e"=>"Zvzp","f"=>"ApCJ","g"=>"MJGT","h"=>"mRpe",
	"i"=>"YhBt","j"=>"XZPl","k"=>"rZNO","l"=>"lCQw","m"=>"MMiH","n"=>"DJYq","o"=>"bjtl","p"=>"APHC","q"=>"ZDXE",
	"r"=>"faaN","s"=>"JWCc","t"=>"TXQq","u"=>"UBtK","v"=>"JuMh","w"=>"JfuG","x"=>"JceS","y"=>"kNLm","z"=>"nQbg",
	"A"=>"dhnA","B"=>"XNvr","C"=>"Xexc","D"=>"Jbqj","E"=>"TwUm","F"=>"SPaY","G"=>"eyGH","H"=>"YGYa","I"=>"ESNr",
	"J"=>"PZgz","K"=>"uuhj","L"=>"TfWj","M"=>"rfUo","N"=>"FwOf","O"=>"EXve","P"=>"vyAe","Q"=>"odDD","R"=>"AhDD",
	"S"=>"WVuz","T"=>"OMHl","U"=>"gtWb","V"=>"OrET","W"=>"rtLZ","X"=>"VlaN","Y"=>"EOLG","Z"=>"NAlK","|"=>"fSuF"
	);
	
	$this->code[1] = array(
	"1"=>"Ls","2"=>"ea","3"=>"tU","4"=>"qE","5"=>"om","6"=>"Wt","7"=>"LP","8"=>"Fj","9"=>"fT",
	"0"=>"Dd","a"=>"fa","b"=>"Ub","c"=>"gs","d"=>"cY","e"=>"vz","f"=>"pC","g"=>"JG","h"=>"Rp",
	"i"=>"Yh","j"=>"XZ","k"=>"rZ","l"=>"lC","m"=>"MM","n"=>"DJ","o"=>"bj","p"=>"AP","q"=>"ZD",
	"r"=>"fa","s"=>"JW","t"=>"TX","u"=>"UB","v"=>"Ju","w"=>"Jf","x"=>"Jc","y"=>"kN","z"=>"nQ",
	"A"=>"dh","B"=>"XN","C"=>"Xe","D"=>"Jb","E"=>"Tw","F"=>"SP","G"=>"ey","H"=>"YG","I"=>"ES",
	"J"=>"PZ","K"=>"uu","L"=>"Tf","M"=>"rf","N"=>"Fw","O"=>"EX","P"=>"vy","Q"=>"od","R"=>"Ah",
	"S"=>"WV","T"=>"OM","U"=>"gt","V"=>"Or","W"=>"rt","X"=>"Vl","Y"=>"EO","Z"=>"NA","|"=>"fS"
	);
	
	
	
	

}


###### This Function Encodes a String So its not Easily found 
public function Encode($str,$opt =0){
	$block = str_split($str, 1);
	if(count($block) <1){
		return false;
	}
	
	$newcode ="";
	foreach($block as $k=>$s){
		$newcode .=$this->code[$opt][$s];	
	}
	
	return $newcode;
}

public function Decode($str,$opt =0){
	if($opt ==0){
	$block = str_split($str, 4);
	}elseif($opt ==1){
	$block = str_split($str, 2);	
	}
	if(count($block) <1){
		return false;
	}
		
	
	foreach($block as $k=>$s){
	$deco .= array_search($s, $this->code[$opt]);	
	}


	return $deco;
	
}

### End Class
}