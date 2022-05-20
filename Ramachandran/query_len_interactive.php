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
shell_exec("rm output_plotly*");
if (empty($_POST)){
   exit;
} else {
        $all_name = $_POST['min'].'+'.$_POST['max'].'+'.$_POST['type'];
        shell_exec("python3 /home/khangle/Downloads/RNANet/read_many_files_interactive.py $all_name 2> er.log");

echo "<iframe src='output_plotly.html' width='800' height='800' scrolling = 'no'></iframe>";
echo "<iframe src='output_plotly2.html' width='800' height='800' scrolling = 'no'></iframe>";
echo "<iframe src='output_plotly3.html' width='800' height='800' scrolling = 'no'></iframe>";

}
?>

</html>

