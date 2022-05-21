<!DOCTYPE HTML>
<html>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="htdocs/css/fornac.css" media="screen" />

<body onload="forna()">

<?php 

$input =  $_POST["pdb"]."_".$_POST["chain"] ;

echo $input.'</br>';
shell_exec("python3 2d_from_pdb.py $input");

$f = fopen('out_file','r');
$seq = fread($f, filesize('out_file'));

echo $seq.'</br>';

$output = shell_exec('RNAfold -i out_file');


$output2 = explode("\n",$output)[1];

$struct = explode(" ", $output2)[0];
echo $struct.'</br>';

shell_exec("rm out_file");
?>

<div id='rna_ss'> </div> <br><br>

	<script type='text/javascript' src='htdocs/js/jquery.js'></script>
	<script type='text/javascript' src='htdocs/js/d3.js'></script>
	<script type='text/javascript' src='htdocs/js/fornac.js'></script>
    	<script type='text/javascript'>
        function forna(){
                var container = new FornaContainer("#rna_ss", {'applyForce': true});
                var struct =  "<?php echo $struct?>";
		var seq = "<?php echo $seq?>";
                var options = {'structure': struct,
                                'sequence': seq};

                container.addRNA(options.structure, options);
        }

</script>

</body>

</html>
