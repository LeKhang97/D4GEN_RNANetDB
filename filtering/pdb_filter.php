<!doctype html>
<html>
<head>
<meta charset="utf-8" />
<title> Comptage de lignes </title>
</head>
<body>

<?php
   
   $taille_min_seq = $_GET['taille_min_seq'];
   $taille_max_seq = $_GET['taille_max_seq'];

   if ($taille_min_seq == ""){$taille_min_seq = 0;}
   if ($taille_max_seq == ""){$taille_max_seq = 10000;}
   
   $nom_dossier = '/nhome/siniac/fgastrin/Bureau/RNANet/flat_RNANet/csv_files'; // pathway of flat files
   $dossier = opendir($nom_dossier);

   $pdbs_csv = array();

   while($fichier = readdir($dossier))
  {
    $lines = count(file($nom_dossier."/".$fichier));
    $lignes=$lines-1; //sequence length = nb of lines of current file - 1(header)
    
    if (($lignes >= $taille_min_seq) && ($lignes <= $taille_max_seq)){
    array_push($pdbs_csv, substr($fichier,0,4));  // Stock 'pdb_id' of flat files 
  }
}
   closedir($dossier);
$pdb_csv = array_unique($pdbs_csv);
//print_r($pdb_csv);
//echo "<br><br>";

    $nb_resol = $_GET['resolution'];

    $dbconn = new SQLite3('/nhome/siniac/fgastrin/Bureau/RNANet/RNANet.db');   // Connection sqlite3 -> use file .db (pathway to the file)

    if ($dbconn) {  // Check connection  
        if ($nb_resol != ""){
           $result = $dbconn->query("SELECT pdb_id FROM structure WHERE resolution <= $nb_resol"); // SQLite3's Query
        } else {
           $result = $dbconn->query("SELECT pdb_id FROM structure");  // If 'resolution' is not specified
        }
        $pdb_sql = array();
        while ($row = $result->fetchArray()) { 
            array_push($pdb_sql, $row['pdb_id']);  // Stock 'pdb_id' of SQLite database
        }
    } else {
        print "Connection to database failed!\n";  // If not connected
    }

    $all_result = array_intersect($pdb_sql, $pdb_csv); // Comparison of the 2 arrays : 'pdb_id' present in the 2 lists (SQLite and csv)

    $fichier = fopen('/nhome/siniac/fgastrin/Bureau/RNANet/exemple.txt', 'w+b');  // Pathway and name of the file to stock 'pdb_id' present in flat files and SQLite database
    
    foreach ($all_result as $rows){
        $request = "SELECT * FROM structure WHERE pdb_id == '".$row."'";
        $my_table = $dbconn->query($request)->fetchArray();
        fwrite($fichier, $my_table['pdb_id']."|".$my_table['pdb_model']."|".$my_table['date']."|".$my_table['exp_method']."|".$my_table['resolution']."\n");    // Write all informations of the 'structure' table, for each id found, in the file 
    }
 
?>


</body>

</html>
