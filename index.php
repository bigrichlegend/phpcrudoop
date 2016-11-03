<?php
require_once( 'MySqlDb.php' );
$Db      = new MySqlDb( 'localhost', 'root', 'root', 'records' );
$results = $Db->query( 'SELECT * FROM players' );
//echo "<pre>",print_r($results),"</pre>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>PHP CRUD OOP</title>
	<meta http-equiv="content-type" content="text/html charset=utf-8">
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<table id="players">
	<thead>
	<th>ID</th>
	<th>First Name</th>
	<th>Last Name</th>
	<th>Edit</th>
	<th>Delete</th>
	</thead>
	<?php
	foreach ( $results as $result ) {
		echo "<tr>";
		echo "<td>" . $result['id'] . "</td>";
		echo "<td>" . $result['firstname'] . "</td>";
		echo "<td>" . $result['lastname'] . "</td>";
		echo "<td><a href='" . $result['id'] . "'>Edit</a></td>";
		echo "<td><a href='" . $result['id'] . "'>X</a></td>";
		echo "</tr>";
	}
	?>
</table>
</body>
</html>
