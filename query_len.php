<html>



<form method="POST" >
        <p style="font-size: 18px"> Max length <input type="text" name = 'max' required="required"></p>
	<p style="font-size: 18px"> Min length <input type="text" name = 'min' required="required"></p>  
	<p> A,U,G,C only:
	<select name ="type">
        <option value="yes">Yes</option>
        <option value="no">No</option>
        </select>
	</p>
	<input type = "submit" value = "Search"/> </p>	
</form>


<?php
$fileList = glob('/home/khangle/Downloads/RNANET_datapoints_latest/*');
foreach($fileList as $filename){
    if(strpos($filename, 'RF') == false){
	$seq = '';

	$lines = file($filename);
	$data = array();
	foreach($lines as $line)
	{
    		$data[] = str_getcsv($line);
	}
	$len = 0;
	for($i = 1;$i <= count($data);$i++){
        	if($_POST["type"] == "yes"){
			$t = [$data[$i][6],$data[$i][7],$data[$i][8],$data[$i][9]];
	        } else { $t = [1];}
		if(in_array(1,$t)){
		$len ++;
		$seq = $seq.$data[$i][4];
	 }
	}
	if($len <= $_POST["max"] and $len >= $_POST["min"]){
		echo explode("/",$filename)[5]. '<br>'; 
		echo "sequence's length is: ".$len."</br>";
		echo $seq."</br>"."</br>";
	}
    }
}
?>

</html>
