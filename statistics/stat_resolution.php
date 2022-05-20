<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <title> Résolution histogramme </title>
</head>
<body>

<?php

    $dbconn = new SQLite3('/home/d4gen/Desktop/RNANet/RNANet.db');   // Connection sqlite3 -> use file .db (pathway to the file)

    $file_out = fopen('/home/d4gen/Desktop/RNANet/stat_resol.txt', 'w+b');
    fwrite($file_out, "0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19\n"); // Range of resolution

    if ($dbconn) {  // Check connection  
        for ($resol = 0; $resol <= 19; $resol++){
           $result = $dbconn->query("SELECT pdb_id FROM structure WHERE resolution >= $resol AND resolution <= $resol+1"); // SQLite3's Query
           $cout = 0;
           while ($row = $result->fetchArray()) {
               $cout +=1;}
           if ($resol < 19){
               fwrite($file_out, $cout.",");
           } else { fwrite($file_out, $cout);}  // Save the number of PDB for each range of resolution
        }    
    } else {
        print "Connection to database failed!\n";  // If not connected
    }
    
    fclose($file_out);
    
    // Run python script to generate the interactive plot (create file 'resolution_stat.html')
    shell_exec('python3 /home/d4gen/Desktop/RNANet/stat_resolution.py /home/d4gen/Desktop/RNANet/stat_resol.txt');

?>

<iframe src="/home/d4gen/Desktop/RNANet/resolution_stat.html"></iframe> 
 
</body>
</html>
