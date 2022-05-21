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
if (empty($_POST)){
   exit;
} else {
	$all_name = $_POST['min'].'+'.$_POST['max'].'+'.$_POST['type'];
	shell_exec("python3 /home/khangle/Downloads/process_len.py $all_name");
	$image =  '/home/khangle/Downloads/RNANet/plot.png';
}
?>
<img   src= 'plot.png' ; style = 'position:fixed;right:30%;bottom:30%;width:50%;height:50%'>


<?php shell_exec('sudo rm plot.png'); ?>
</html>
