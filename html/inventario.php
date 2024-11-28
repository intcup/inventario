<?php

session_start();

$id =  $_GET["id"];

$databaseHost = 'db:3306';
$databaseUsername = $_SESSION["user"];
$databasePassword = $_SESSION["pass"];
$databaseName = 'inventario';

// Connect to the database
$mysqli = new mysqli($databaseHost, $databaseUsername, $databasePassword, $databaseName);

if ($mysqli->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}


$cat = $_POST["cat_name"];
if ($cat) {
	$mysqli->query("INSERT INTO Categorias(nombre) VALUES('$cat')");
}

$act = $_GET["act"];

$id_art = $_POST["id_art"];
$nom_art = $_POST["nombre_art"];
$cat_art = $_POST["cat_art"];
$cant_art = $_POST["cant_art"];
if ( $id_art ) {
	$mysqli->query("UPDATE Articulos SET nombre='$nom_art', categoria=$cat_art, cantidad=$cant_art WHERE id=$id_art");
	header("Location: " . $_SERVER['PHP_SELF']);
}
if ($_GET['id']) {
	if ($act == 'e') {
		$result = $mysqli->query("SELECT * FROM Articulos WHERE id=" . $_GET['id']);
		$row = $result->fetch_assoc();
		$nom_art = $row["nombre"];
		$cat_art = $row["categoria"];
		$cant_art = $row["cantidad"];
	}
	if ( $act == 'd') {
		$mysqli->query("DELETE FROM Articulos WHERE id=" . $_GET['id']);
		header("Location: " . $_SERVER['PHP_SELF']);
	}
}else {
	if ($nom_art) {
		$mysqli->query("INSERT INTO Articulos(nombre, categoria, cantidad) VALUES('$nom_art', $cat_art, $cant_art)");
		header("Location: " . $_SERVER['PHP_SELF']);
	}
}

$categorias = $mysqli->query("SELECT * FROM Categorias");
$articulos = $mysqli->query("SELECT * FROM Articulos");
?>
<link rel="stylesheet" href="styles.css">

<form method="post">
	<input type="number" name="id_art" value="<?= $id ?>" hidden>
	Nombre Articulo:
	<input type="text" name="nombre_art" value="<?= $nom_art ?>">
	Cantidad:
	<input type="number" name="cant_art" value="<?= $cant_art ?>">
	Categoria:
	<select name="cat_art" value="<?= $cat_art ?>">
	<?php
		while ($row = $categorias->fetch_assoc()) {
?>
	<option value="<?= $row["id"] ?>"><?= $row["nombre"]?></option>
<?php
		}
?>
	</select>
	<input type="submit" value="Guardar">
</form>

<form method="post">
	Nombre de categoria:
	<input type="text" name="cat_name">
	<input type="submit" value="Agregar Categoria">
</form>


<table>
<thead>
	<th>ID</th>
	<th>Articulo</th>
	<th>Cantidad</th>
</thead>
	<?php
		while ($row = $articulos->fetch_assoc()) {
?>
	<tr>
		<td><?= $row["id"] ?></td>
		<td><?= $row["nombre"] ?></td>
		<td><?= $row["cantidad"] ?></td>
		<td><a href="?id=<?= $row["id"]?>&act=e">Editar</a><a href="?id=<?= $row["id"]?>&act=d">Eliminar</a>
	</tr>
<?php
		}
?>

</table>
