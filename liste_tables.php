
<form method="post">
         <legend>Nouvelle table: </legend>
        <input type="text" name="table_name" id="nb_col" placeholder="nom de la table" required>
        <input type="number" name="nb_col" id="nb__col" placeholder="nombre de colonnes" required>
        <input type="submit" name="add" value="Exécuter">
 </form>

<?php 

$db = new PDO('mysql:host=localhost;dbname=' . $_GET["dbname"] . ';', 'root', 'root');
//partie php qui affiche et gére l'ajout d'un table et ses champs 
	$nb_col = $_POST['nb_col'];
	$table_name = $_POST['table_name'];
if(isset($table_name)) 
{
	 echo '<p> nom de la table :'.$table_name.'</p>';
	for($i = 1; $i <= $nb_col; $i++) {
		echo '<input type="text" name="table_name".$i id="nb_col" placeholder="nom du champ" required> <SELECT name="var" size="1">
			<OPTION>Int
			<OPTION>Varchar
			<OPTION>Text
			<OPTION>Date
			</SELECT></br>'; 
	} 

	$sql = "CREATE table $table_name(
     ID INT( 11 ) AUTO_INCREMENT PRIMARY KEY);";

	$req = $db->exec($sql);
	
	if ($req === false)
    echo 'ERREUR : ', print_r($db->errorInfo());
	else
    echo 'table creer';
}

?>
<?php

//permet de lister les tables 
	$db = new PDO('mysql:host=localhost;dbname=' . $_GET["dbname"] . ';', 'root', 'root');
	//$db = new PDO('mysql:host=localhost;dbname=' . $_GET["dbname"] . ';', 'root', '');

	$req = $db->query("SHOW TABLES");

	echo '<ul>';

	while ($donnees = $req->fetch()) {
		echo '<form action="supp_table.php" method="post"><li><a href="dashboard.php?dbname=' . $_GET["dbname"] . '&tablename=' . $donnees[$count] . '">' . $donnees[$count] .  '</a><input type="hidden" name="$donnees[$count]"/><input type="submit" value="Supprimer"></li></form>';
	}

	echo '</ul>';

	$req->closeCursor();
?>



