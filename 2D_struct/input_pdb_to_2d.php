<!DOCTYPE HTML>
<html>

<script>
        function validateAndSend() {
            if (document.getElementById("a1").value == '' or document.getElementById("a2").value == '') {
                alert('You have to put your pdb');
		event.preventDefault();
                return false;
            }
            else {
                myForm.submit();
            }
        }
    </script>


<form  action="output_pdb_to_2d.php" id="form_submit" method="post">
	<p> Put your pdb code:<br><input type="textbox" rows="4" cols="50" id="a1" name="pdb"></br>
	<p> Put your chain name:<br><input type="textbox" rows="4" cols="50" id="a2" name="chain"></br>
	<input type="submit" value="Submit" onclick ="validateAndSend()"> </p>
</form>
</html>
