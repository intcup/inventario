<?php
session_start();
if ( $_POST["user"] != ''){
	$_SESSION["user"] = $_POST["user"];
	$_SESSION["pass"] = $_POST["pass"];
	header("Location: inventario.php");
}
?>
<link rel="stylesheet" href="styles.css">

<form class="login" method="post">
<input name="user"/>
<input type="password" name="pass"/>
<input type="submit" value="Entrar"/>
</form>

