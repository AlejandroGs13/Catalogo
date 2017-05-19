<?php
function dbCreate(){
	$conectar = Conecter();
	$resultado=mysqli_query($conectar,$bd);
	$bd="Create Database if not exists Catalogo;";
	$resultado=mysqli_query($conectar,$bd);

	if ($resultado) {
		echo "Se ha creado la base de datos correctamente";
	}
	else{
		echo "No se ha podida crear la base de datos";
	}
}

function Conecter(){
	$conectar = mysqli_connect("localhost","Cain","ghahfah16");
	if($conectar){
		echo "Se ha conectado correctamente al servidor ";
		return $conectar;
		}
	else{
		echo "No se pudo conectar al servidor";
		return null;
	}
}

function TableContac(){
		$conectar = Conecter();
		mysqli_select_db($conectar,"Catalogo");
		$tabla = "Create Table if not exists Contactos";
		$tabla.="(ID int NOT NULL  AUTO_INCREMENT, ";
		$tabla.="nombre varchar(50), ";
		$tabla.="telefono varchar(50), ";
		$tabla.="domicilio varchar(50), ";
		$tabla.="correo varchar(30), ";
		$tabla.="face varchar(30), ";
		$tabla.="Primary key(ID)) ";
		$General=mysqli_query($conectar,$tabla);
		if ($General) {
			echo "Se ha creado la tabla correctamente";
		}
		else {
		    echo "No se pudo crear la tabla <br>";
		}
	}
function TableMovie(){
		$conectar = Conecter();
		mysqli_select_db($conectar,"Catalogo");
		$tabla = "Create Table if not exists Peliculas";
		$tabla.="(ID int NOT NULL  AUTO_INCREMENT, ";
		$tabla.="titulo varchar(100), ";
		$tabla.="year varchar(100), ";
		$tabla.="genero varchar(100), ";
		$tabla.="duracion varchar(100), ";
		$tabla.="idioma varchar(100), ";
		$tabla.="pais varchar(100), ";
		$tabla.="direccion varchar(100), ";
		$tabla.="guion varchar(100), ";
		$tabla.="especiales varchar(100), ";
		$tabla.="reparto text, ";
		$tabla.="ruta text, ";
		$tabla.="Primary key(ID)) ";
		$General=mysqli_query($conectar,$tabla);
		if ($General) {
			echo "Se ha creado la tabla correctamente";
		}
		else {
		    echo "No se pudo crear la tabla <br>";
		}
	}



function addContac(){
	dbCreate();
	TableContac();
	$nombre = $_POST['nombre'];
	$domicilio = $_POST['domicilio'];
	$telefono = $_POST['telefono'];
	$face = $_POST['fb'];
	$correo = $_POST['correo'];
	$conexion = Conecter();
	mysqli_select_db($conexion,"Catalogo");

	$datos="INSERT INTO `Contactos`(`nombre`,`telefono`,`domicilio`,`correo`,`face`)
	VALUES ('$nombre','$telefono','$domicilio','$correo','$face')";
	$insertar=mysqli_query($conexion,$datos);
	if (!$insertar){
		echo 'error al insertar los datos, la Sentencia SQL' .mysql_error();
	}
		else {
			header('location:../index.php');
		}
		mysqli_close($conexion);
}

function addMovie(){
	$titulo = $_POST['titulo'];
	$year = $_POST['year'];
	$genero = $_POST['genero'];
	$duracion = $_POST['duracion'];
	$idioma = $_POST['idioma'];
	$pais = $_POST['pais'];
	$direccion = $_POST['direccion'];
	$guion = $_POST['guion'];
	$ee = $_POST['ee'];
	$reparto = $_POST['reparto'];
	$ruta = $_POST['ruta'];
	$conexion = Conecter();
	mysqli_select_db($conexion,"Catalogo");

	$insert= "INSERT INTO `Peliculas`(`titulo`,`year`,`genero`,`duracion`,`idioma`,`pais`,`direccion`,`guion`,`especiales`,`reparto`,`ruta`) VALUES('$titulo','$year','$genero','$duracion','$idioma','$pais','$direccion','$guion','$ee','$reparto','$ruta')";
	$insertar=mysqli_query($conexion,$insert);
	if (!$insertar){
		echo 'error al insertar los datos, la Sentencia SQL' .mysql_error();
	}
		else {
			header('location:../index.php');
		}
		mysqli_close($conexion);
}

function getContas(){
	$arr = array();
	$conectar = Conecter();
	mysqli_select_db($conectar,"Catalogo");
	$consulta="Select * From Contactos;";
	$resultado=mysqli_query($conectar,$consulta);
	$registros=mysqli_num_rows($resultado);
	for ($i=0; $i < $registros ; $i++) {
		$row = mysqli_fetch_assoc($resultado); 
		//$elemento=mysql_result($resultado, $i,"nombre");
		$elemento = $row['nombre'];
		
		array_push($arr,$elemento);
		//$elemento=mysql_result($resultado, $i,"telefono");
		$elemento = $row['telefono'];
		
		array_push($arr,$elemento);
		//$elemento=mysql_result($resultado, $i,"domicilio");
		
		$elemento = $row['domicilio'];
		array_push($arr,$elemento);
		//$elemento=mysql_result($resultado, $i,"correo");
		$elemento = $row['correo'];
		array_push($arr,$elemento);
		//$elemento=mysql_result($resultado, $i,"face");
		$elemento = $row['face'];
		array_push($arr,$elemento);
	}
	mysqli_close($conectar);
	return $arr;
}

function update(){
	$nombre = $_POST['nombre'];
	$domicilio = $_POST['domicilio'];
	$telefono = $_POST['telefono'];
	$face = $_POST['fb'];
	$id = $_GET["contacto"];
	$correo = $_POST['correo'];
	$conectar = mysqli_connect("localhost","Cain","ghahfah16");
	mysqli_select_db($conectar,"Catalogo");
	$modificar="update Contactos set nombre='".$nombre."', telefono= '".$telefono."', domicilio= '".$domicilio."', correo= '".$correo."', face= '".$face."' where ID='".$id."';";
	$resultado=mysqli_query($conectar,$modificar);

	if ($resultado) {
			header('location:../index.php');
		}else {
			echo "No se pudo modificar el registro de la base de datos <br>";
		}
	}
	
	function updatePeliculas(){
	$id = $_GET['id'];
	$titulo = $_POST['titulo'];
	$year = $_POST['year'];
	$genero = $_POST['genero'];
	$duracion = $_POST['duracion'];
	$idioma = $_POST['idioma'];
	$pais = $_POST['pais'];
	$direccion = $_POST['direccion'];
	$guion = $_POST['guion'];
	$ee = $_POST['ee'];
	$reparto = $_POST['reparto'];
	$ruta = $_POST['ruta'];
	$conectar = mysqli_connect("localhost","Cain","ghahfah16");
	mysqli_select_db($conectar,"Catalogo");
	$modificar="UPDATE `Peliculas` SET `titulo` = '".$titulo."', `year` = '".$year."', `genero` = '".$genero."', `duracion` = '".$duracion."', `idioma` = '".$idioma."', `pais` = '".$pais."', `direccion` = '".$direccion."', `guion` = '".$guion."', `especiales` = '".$ee."', `reparto` = '".$reparto."', `ruta` = '".$ruta."' WHERE `Peliculas`.`ID` = ".$id.";";
	$resultado=mysqli_query($conectar,$modificar);

	if ($resultado) {
			header('location:../index.php');
		}else {
			echo "No se pudo modificar el registro de la base de datos <br>".mysqli_error();
		}
	}
	

	function delete(){
	$conectar = Conecter();
	mysqli_select_db($conectar,"Catalogo");
	$modificar="delete from Peliculas where ID = '".$_GET["id"]."' ";
	$resultado=mysqli_query($conectar,$modificar);

	if ($resultado) {
			header('location:../index.php');
		}else {
			echo "No se pudo modificar el registro de la base de datos <br>";
		}
	}

	function datos(){
	$conectar = Conecter();
	mysqli_select_db($conectar,"Catalogo");
	$insert= "insert into Peliculas(titulo,year,genero,duracion,idioma,pais,direccion,guion,especiales,reparto,ruta) values('XXX','1','1','1','1','1','1','1','1','1','http://localhost/Unidad4/Peliculas/Image/10.jpg');";
	$epale=mysqli_query($conectar,$insert);
		if ($epale) {
			echo "Se ha insertado elementos la tabla correctamente";
		}
		else {
		    echo "No se pudo insertar elementos la tabla <br>";
		}

	$insert= "insert into Peliculas(titulo,year,genero,duracion,idioma,pais,direccion,guion,especiales,reparto,ruta) values('The longest ride','1','1','1','1','1','1','1','1','1','http://localhost/Unidad4/Peliculas/Image/1.jpg');";
	$epale=mysqli_query($conectar,$insert);
		if ($epale) {
			echo "Se ha insertado elementos la tabla correctamente";
		}
		else {
		    echo "No se pudo insertar elementos la tabla <br>";
		}
		$insert= "insert into Peliculas(titulo,year,genero,duracion,idioma,pais,direccion,guion,especiales,reparto,ruta) values('Avengers','1','1','1','1','1','1','1','1','1','http://localhost/Unidad4/Peliculas/Image/2.jpg');";
	$epale=mysqli_query($conectar,$insert);
		if ($epale) {
			echo "Se ha insertado elementos la tabla correctamente";
		}
		else {
		    echo "No se pudo insertar elementos la tabla <br>";
		}
		$insert= "insert into Peliculas(titulo,year,genero,duracion,idioma,pais,direccion,guion,especiales,reparto,ruta) values('Dirty grandpa','1','1','1','1','1','1','1','1','1','http://localhost/Unidad4/Peliculas/Image/3.jpg');";
	$epale=mysqli_query($conectar,$insert);
		if ($epale) {
			echo "Se ha insertado elementos la tabla correctamente";
		}
		else {
		    echo "No se pudo insertar elementos la tabla <br>";
		}
		$insert= "insert into Peliculas(titulo,year,genero,duracion,idioma,pais,direccion,guion,especiales,reparto,ruta) values('crepusculo','1','1','1','1','1','1','1','1','1','http://localhost/Unidad4/Peliculas/Image/4.jpg');";
	$epale=mysqli_query($conectar,$insert);
		if ($epale) {
			echo "Se ha insertado elementos la tabla correctamente";
		}
		else {
		    echo "No se pudo insertar elementos la tabla <br>";
		}
		$insert= "insert into Peliculas(titulo,year,genero,duracion,idioma,pais,direccion,guion,especiales,reparto,ruta) values('spirit','1','1','1','1','1','1','1','1','1','http://localhost/Unidad4/Peliculas/Image/5.jpg');";
	$epale=mysqli_query($conectar,$insert);
		if ($epale) {
			echo "Se ha insertado elementos la tabla correctamente";
		}
		else {
		    echo "No se pudo insertar elementos la tabla <br>";
		}
		$insert= "insert into Peliculas(titulo,year,genero,duracion,idioma,pais,direccion,guion,especiales,reparto,ruta) values('Live for love','1','1','1','1','1','1','1','1','1','http://localhost/Unidad4/Peliculas/Image/6.jpg');";
	$epale=mysqli_query($conectar,$insert);
		if ($epale) {
			echo "Se ha insertado elementos la tabla correctamente";
		}
		else {
		    echo "No se pudo insertar elementos la tabla <br>";
		}

		$insert= "insert into Peliculas(titulo,year,genero,duracion,idioma,pais,direccion,guion,especiales,reparto,ruta) values('mascotas','1','1','1','1','1','1','1','1','1','http://localhost/Unidad4/Peliculas/Image/8.jpg');";
	$epale=mysqli_query($conectar,$insert);
		if ($epale) {
			echo "Se ha insertado elementos la tabla correctamente";
		}
		else {
		    echo "No se pudo insertar elementos la tabla <br>";
		}
		}
	
	

?>