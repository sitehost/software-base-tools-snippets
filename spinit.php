<?php
error_reporting(0);
$spin= new spinit();




class spinit {
	public $tableHead;
	public $tableFoot;
	
public function __construct(){
	
	switch($_REQUEST['cmd']){
	case 'dospin':
		$this->dorotate();
		$this->page();
	break;

	default:
		$this->page();
	break;	
	}
}
	
public function page(){
?>
<script type="text/javascript">
    var textBox = document.getElementById("spun");
    textBox.onfocus = function() {
        textBox.select();

        // Work around Chrome's little problem
        textBox.onmouseup = function() {
            // Prevent further mouseup intervention
            textBox.onmouseup = null;
            return false;
        };
    };
</script>
<span>Content to Spin:</span>
 <form action="" method="post"><input name="cmd" type="hidden" value="dospin" />
 
 <textarea name="message" cols="65" rows="15"><?php echo $_REQUEST['message'];?></textarea>
 <input type="submit" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Do Spin and Show New Content&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" />
</form>   
     <div><span style="font-family:Arial, Helvetica, sans-serif; font-size:12px;">* Create Varations like <b  style="font-family:Arial, Helvetica, sans-serif; font-size:16px;">{This Spinner rocks|kicks but|is great}</b> and <b  style="font-family:Arial, Helvetica, sans-serif; font-size:16px;">{green|yellow|blue}</b> or use long phrases <b style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">{Answer to your Prayers|What you have been looking for|Your Prayers have been answered}</b></span></div>   
<?php
}

public function dorotate(){
	
   echo "<b>Your Spun Content here:</b><br /><textarea  cols=\"65\" rows=\"10\" id=\"spun\">".$this->spinit($_REQUEST['message'])."</textarea><hr />";
   return;
}

public function spinit($message){
		# Finds {this|that|other} and randomly choose one
	preg_match_all("/{(.*?)}/ime", $message, $match);
	
	foreach($match[1] as $id => $value){
		$options = explode("|",$value);
		## Randomly Choose Phrase
		array_reverse($options);
		shuffle($options);
		shuffle($options);
		array_reverse($options);
		shuffle($options);
		
		$rand_phrase = array_rand($options);
		$phrase = trim($options[$rand_phrase]);
		$message = str_replace($match[0][$id], $phrase, $message);
	}
	
	return $message;
}





	
	
### End of Class	
}