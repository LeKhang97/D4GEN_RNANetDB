<!DOCTYPE HTML>
<html>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="Site_packages/fornac.css" media="screen" />

<body onload="forna()">
<?php

$txt = trim($_POST['seq']);

$myfile = fopen("input.txt", "w") or die("Unable to open file!");
fwrite($myfile, $txt);
fclose($myfile);

$output = shell_exec('RNAfold -i input.txt');
$output2 = explode("\n",$output)[1];

$struct = explode(" ", $output2)[0];

$row2 = explode(" ", $output2);
$len_row2 = count($row2);
$len = strlen($txt);

$MFE = substr($row2[$len_row2 - 1],0,-1);

echo "Your sequence: $txt<br>";
echo "Length of your sequence: $len<br>";
echo "The predicted structure: $struct<br>";
echo "The MFE of predicted structure: $MFE<br><br><br>";
shell_exec('rm input.txt');

?>

<div id='rna_ss'> </div> <br><br>

	<script type='text/javascript' src='Site_packages/jquery.js'></script>
	<script type='text/javascript' src='Site_packages/d3.js'></script>
	<script type='text/javascript' src='Site_packages/fornac.js'></script>
    	<script type='text/javascript'>
        function forna(){
                var container = new FornaContainer("#rna_ss", {'applyForce': true});
                var struct =  "<?php echo $struct?>";
		var seq = "<?php echo $txt?>";
                var options = {'structure': struct,
                                'sequence': seq};

                container.addRNA(options.structure, options);
        }

</script>

  <script type="text/javascript" src="Site_packages/molart.js"></script>
  <script type="text/javascript" src="Site_packages/5uig_a.js"></script>


<p> <div id="pluginContainer"></div></p>

<script>
  const molart = new MolArt({
     uniprotId: 'Q13158',
    alwaysLoadPredicted: true,
    containerId: 'pluginContainer',
});

</script>

</body>
</html>
