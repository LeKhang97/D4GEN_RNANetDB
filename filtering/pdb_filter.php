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
    $lignes=$lines-1; //sequence length = nb de lines of current file - 1(header)
    
    if (($lignes >= $taille_min_seq) && ($lignes <= $taille_max_seq)){
    //echo substr($fichier,0,4) . "   Le nombre de lignes est ". $lignes . "<br>";
    array_push($pdbs_csv, substr($fichier,0,4));
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
           $result = $dbconn->query("SELECT pdb_id FROM structure");
        }
        $pdb_sql = array();
        while ($row = $result->fetchArray()) {
            //echo $row['pdb_id'] . "<br>";   // afficher dans le html les valeurs d'une ou plusieurs colonnes 
            array_push($pdb_sql, $row['pdb_id']);
        }
    //print_r($pdb_sql);
    //echo "<br><br>";
    } else {
        print "Connection to database failed!\n";  // If not connected
    }

    $all_result = array_intersect($pdb_sql, $pdb_csv); // 'pdb_id' present in the 2 lists (SQLite and csv)
//print_r($all_result);
    foreach ($all_result as $rows){
        $my_table = $dbconn->query("SELECT * FROM structure WHERE pdb_id == $row");
        echo $row['pdb_id']." | ".$row['pdb_model']." | ".$row['date']." | ".$row['exp_method']." | ".$row['resolution']
        echo "<br>"
        /*echo $rows;
	echo "<br>";*/
    }
 
?>


</body>

</html>
