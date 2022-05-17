<!DOCTYPE HTML>
<html>

<script>
        function validateAndSend() {
            if (document.
getElementById("a1").value == '') {
                alert('You have to put your sequence');
		event.preventDefault();
                return false;
            }
            else {
                myForm.submit();
            }
        }
    </script>


<form  action="output_pred_2d3d.php" id="form_submit" method="POST" name="myForm">
	<p> Put your sequence here:<br><textarea  rows="4" cols="50" id="a1" name="seq" ></textarea>
	<input type="submit" value="Submit" onclick ="validateAndSend()"> </p>

</form>

</html>
