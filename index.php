<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Peliculas</title>
	<link rel="stylesheet" type="text/css" href="../css/materialize.min.css" media="screen,projection">
	<link rel="stylesheet" type="text/css" href="css/style.css" >
	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body class="black">
	


	<!---Encabezado-->
	<header>
		<nav>
			<div class="nav-wrapper #424242 grey darken-3">
			  <a href="#" class="brand-logo center">Cine-red</a>
			  <ul id="nav-mobile" class="left hide-on-med-and-down">
			  </ul>
			</div>
		</nav>
	</header>
	<!---Encabezado-->
	<br>
	<br>
	<br>
	 
	
	
	<div class="not-fullscreen2 background parallax" style="background-image:url('Image/plane.jpg');" data-img-width="1600" data-img-height="1064" data-diff="100">
	    
	</div>
	<!---Buscador-->
	<div class="nav-wrapper container">
      <form>
        <div class="input-field">
          <input input type="search" class="light-table-filter" data-table="order-table" placeholder="Filtro" required>
          <label class="label-icon" for="search"><i class="material-icons">search</i></label>
          <i class="material-icons">close</i>
        </div>
      </form>
    </div>
  </nav>
  <!---Buscador-->
  <br>
  <br>
  <br>
  <br>
  

  	<!---Coleccion-->
  	
  

  		<div id="contac" class="container">
  			<?php
  			$arr = array(); //declaramos una arry donde guardaremos los datos
			$conectar = mysqli_connect("localhost","Cain","ghahfah16");
			mysqli_select_db($conectar,"Catalogo");
			$consulta="Select * From Peliculas;";   //consulta a la base de datos
			$resultado=mysqli_query($conectar,$consulta); //Ejecutas la cunsulta de datos y guardas los resutados
			$registros=mysqli_num_rows($resultado); // vemos el numero de filas que tiene el resultado
			for ($i=0; $i < $registros ; $i++) {//for recorriendo todas las filas
				$row = mysqli_fetch_assoc($resultado); // guardamos la primer fila en la variable row, con el ciclo tambien va cambiando de fila
				
				$elemento = $row['ID'];//declaramos una variable elemento y la igualamos a una columna de la fila 
				//$['nombre de la columna']
				array_push($arr,$elemento);//con este metodo metemos el elemento al arry
				//repetimos los pasos con las columnas que tengas
				$elemento = $row['titulo'];
				
				array_push($arr,$elemento);
				
				$elemento = $row['year'];
				
				array_push($arr,$elemento);
				
				
				$elemento = $row['genero'];
				array_push($arr,$elemento);
				
				$elemento = $row['duracion'];
				array_push($arr,$elemento);

				$elemento = $row['idioma'];
				array_push($arr,$elemento);

				$elemento = $row['pais'];
				array_push($arr,$elemento);

				$elemento = $row['direccion'];
				array_push($arr,$elemento);

				$elemento = $row['guion'];
				array_push($arr,$elemento);

				$elemento = $row['especiales'];
				array_push($arr,$elemento);

				$elemento = $row['reparto'];
				array_push($arr,$elemento);
					

				$elemento = $row['ruta'];
				array_push($arr,$elemento);
					
				}
				
				mysqli_close($conectar);
				
  			?>

			<!--Con codigo javascript ontendremos la variable de php con los datos de la tabla-->
		  	<script type="text/javascript">
		  		var arrayJS=<?php echo json_encode($arr);?>;	//esta es la linea donde igualamos un arry de javascript con el de php 
			    var div='';//usaremos esta variable para generar codigo 
			    div+="<div class='datagrid '><table class='order-table table'><tbody>";//a generar en html
		        for (var i=1;i<arrayJS.length;i+=12){ //ciclo del tamaño del arry
			           var cont=i+1;
			           div+="<tr><td ><div class='col s12 m'><div class='card horizontal grey'><div class='card-image'><img src='"+arrayJS[i+10]+"'></div><div class='card-stacked'><div class='card-content #424242 grey darken-3 white-text'><p><h1>\t"+arrayJS[i]+"</h1></p><p><h7>Genero:"+arrayJS[i+2]+".--Duracion:\t"+arrayJS[i+3]+"</h7></p><p><h5>Año:"+arrayJS[i+1]+"</h5></p><p><h5>Idioma:"+arrayJS[i+4]+"</h5><p><h5>Pais:"+arrayJS[i+5]+"</h5></p></p><p><h5>Direccion:"+arrayJS[i+6]+"</h5></p><p><h5>Guion:"+arrayJS[i+7]+"</h5></p><p><h5>Efectos Especiales:"+arrayJS[i+8]+"</h5></p><p><h5>Reparto:"+arrayJS[i+9]+"</h5></p></div><div class='card-action'><div class='col s4 '><a class='waves-effect waves-light btn red' href=#modificar"+i+"><i class='material-icons left'>replay</i>Modificar</a></div><br><div class='col s4 '><a class='waves-effect waves-light btn red' href='#eliminar"+i+"'><i class='material-icons left'>delete_forever</i>Eliminar</a></div></div></div></div></div></td></tr><div id='eliminar"+i+"' class='modal'><div class='modal-content'><center><h4>Eliminar pelicula</h4><p>Seguro que quiere eliminar la pelicula:"+arrayJS[i]+"</p></center></div><div class='modal-footer'><a href='PHP/eliminar.php?id="+arrayJS[i-1]+"'' class='modal-action modal-close waves-effect waves-green btn-flat'>Aceptar</a></div></div>";
				   //con este codigo se genera una cardview con cada elemento de la base de datos
			      }
			      div+="</tbody></table></div>";
			      document.getElementById("contac").innerHTML=div;//insertamos el codigo en el html 
			     
			</script>
			
  		</div>
  <!---Coleccion-->
  	<div id="contac2" class="container">
  	</div>
			<script type="text/javascript">
		  		var arrayJS=<?php echo json_encode($arr);?>;	
			    var dia='';
			    
		        for (var i=1;i<arrayJS.length;i+=12){ 
			           var cont=i+1;
			           dia+=" <div id='modificar"+i+"' class='modal'><div class='modal-content'><center><h4>Modificar Pelicula</h4><form action='PHP/modificar.php?id="+arrayJS[i-1]+"' method='post' name='frm'><div class='row'><form class='col s12'><div class='row'><div class='input-field col s6'><i class='material-icons prefix'>title</i><input id='icon_prefix' type='text' class='validate' name='titulo' value='"+arrayJS[i]+"'><label for='icon_prefix'>Titulo</label></div><div class='input-field col s6'><i class='material-icons prefix'>date_range</i><input id='icon_telephone' type='tel' class='validate' name='year' value='"+arrayJS[i+1]+"'><label for='icon_telephone'>Año</label></div></div><div class='row'><div class='input-field col s6'><i class='material-icons prefix'>event_seat</i><input id='icon_prefix' type='text' class='validate' name='genero' value='"+arrayJS[i+2]+"'><label for='icon_prefix'>Genero</label></div><div class='input-field col s6'><i class='material-icons prefix'>alarm</i><input id='icon_telephone' type='tel' class='validate' name='duracion' value='"+arrayJS[i+3]+"'><label for='icon_telephone'>Duracion</label></div></div><div class='row'><div class='input-field col s6'><i class='material-icons prefix'>language</i><input id='icon_prefix' type='text' class='validate' name='idioma' value='"+arrayJS[i+4]+"'><label for='icon_prefix'>Idioma</label></div><div class='input-field col s6'><i class='material-icons prefix'>home</i><input id='icon_telephone' type='tel' class='validate' name='pais' value='"+arrayJS[i+5]+"'><label for='icon_telephone'>Pais</label></div></div><div class='row'><div class='input-field col s6'><i class='material-icons prefix'>accessibility</i><input id='icon_prefix' type='text' class='validate' name='direccion' value='"+arrayJS[i+6]+"'><label for='icon_prefix'>Direccion</label></div><div class='input-field col s6'><i class='material-icons prefix'>textsms</i><input id='icon_telephone' type='tel' class='validate' name='guion' value='"+arrayJS[i+7]+"'><label for='icon_telephone'>Guion</label></div></div><div class='row'><div class='input-field col s6'><i class='material-icons prefix'>extension</i><input id='icon_prefix' type='text' class='validate' name='ee' value='"+arrayJS[i+8]+"'><label for='icon_prefix'>Efectos Especiales</label></div><div class='input-field col s6'><i class='material-icons prefix'>compare_arrows</i><input id='icon_telephone' type='tel' class='validate' name='reparto' value='"+arrayJS[i+9]+"'><label for='icon_telephone'>Reparto</label></div></div><div class='row'><div class='input-field col s6'><i class='material-icons prefix'>add_a_photo</i><input id='icon_prefix' type='text' class='validate' name='ruta' value='"+arrayJS[i+10]+"'><label for='icon_prefix'>Ruta de la imagen</label></div></div><div class='row' type='submit' ><div class='col s5 push-s4' type='submit' value='Modificar datos' ><input type='submit' value='Guardar datos'></div></div></form></div></form></center></div></div>";
			         
			      }
			      document.getElementById("contac2").innerHTML=dia;
			     
			</script>
  <!---FAB-->
   <div class="fixed-action-btn ">
	    <a href="#contacto" class="btn-floating btn-large #757575 grey darken-1">
	      <i class="large material-icons">add</i>
	    </a>
  </div>
  <!---FAB-->
  <br>
  <br>
	<div class="parallax-container">
      <div class="parallax"><img src="Image/ga.jpg">
		<div class="content-b container ">
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<div class="row">
      			<h1 class="col s6 offset-s6">Unidad 4</h1>
      			<p class="col s6 offset-s6">Practica final</p>
      		</div>
      </div>
      </div>
    </div>
  	<script type="text/javascript">
(function(document) {
  'use strict';

  var LightTableFilter = (function(Arr) {

    var _input;

    function _onInputEvent(e) {
      _input = e.target;
      var tables = document.getElementsByClassName(_input.getAttribute('data-table'));
      Arr.forEach.call(tables, function(table) {
        Arr.forEach.call(table.tBodies, function(tbody) {
          Arr.forEach.call(tbody.rows, _filter);
        });
      });
    }

    function _filter(row) {
      var text = row.textContent.toLowerCase(), val = _input.value.toLowerCase();
      row.style.display = text.indexOf(val) === -1 ? 'none' : 'table-row';
    }

    return {
      init: function() {
        var inputs = document.getElementsByClassName('light-table-filter');
        Arr.forEach.call(inputs, function(input) {
          input.oninput = _onInputEvent;
        });
      }
    };
  })(Array.prototype);

  document.addEventListener('readystatechange', function() {
    if (document.readyState === 'complete') {
      LightTableFilter.init();
    }
  });

})(document);
</script>	
    <script src="js/jquery-1.10.2.min.js"></script>
	<script src="js/javajava.js"></script>
	<script src="../js/materialize.min.js"></script>
	<script>
	    $(document).ready(function(){
	      $(".parallax").parallax();
	    });
    </script>
	<script>
    	$( document ).ready(function(){
    		$(".button-collapse").sideNav();
    	});
    </script>

    <script type="text/javascript">
    	$(document).ready(function(){
    	$('.modal').modal();
  		});     
    </script>
    
<footer class="page-footer #ff9800 orange">

          <div class="container ">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="white-text">Programacion web</h5>
                <p class="grey-text text-lighten-4">David Alejandro García Sánchez 14630117</p>
              </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
            © 2017 Copyright Text
            </div>
          </div>
</footer>
        <!--Modelo de agregar contacto-->
  <div id="contacto" class="modal">
    <div class="modal-content">
    	<center>
      <h4>Agregar Pelicula</h4>
            <form action="PHP/AddMovie.php" method="post" name="frm">
		       <div class="row">
			    <form class="col s12">
			      <div class="row">
			        <div class="input-field col s6">
			          <i class="material-icons prefix">title</i>
			          <input id="icon_prefix" type="text" class="validate" name="titulo">
			          <label for="icon_prefix">Titulo</label>
			        </div>
			        <div class="input-field col s6">
			          <i class="material-icons prefix">date_range</i>
			          <input id="icon_telephone" type="tel" class="validate" name="year">
			          <label for="icon_telephone">Año</label>
			        </div>
			      </div>
			      <div class="row">
			        <div class="input-field col s6">
			          <i class="material-icons prefix">event_seat</i>
			          <input id="icon_prefix" type="text" class="validate" name="genero">
			          <label for="icon_prefix">Genero</label>
			        </div>
			        <div class="input-field col s6">
			          <i class="material-icons prefix">alarm</i>
			          <input id="icon_telephone" type="tel" class="validate" name="duracion">
			          <label for="icon_telephone">Duracion</label>
			        </div>
			      </div>
			      <div class="row">
			        <div class="input-field col s6">
			          <i class="material-icons prefix">language</i>
			          <input id="icon_prefix" type="text" class="validate" name="idioma">
			          <label for="icon_prefix">Idioma</label>
			        </div>
			        <div class="input-field col s6">
			          <i class="material-icons prefix">home</i>
			          <input id="icon_telephone" type="tel" class="validate" name="pais">
			          <label for="icon_telephone">Pais</label>
			        </div>
			      </div>
			      <div class="row">
			        <div class="input-field col s6">
			          <i class="material-icons prefix">accessibility</i>
			          <input id="icon_prefix" type="text" class="validate" name="direccion">
			          <label for="icon_prefix">Direccion</label>
			        </div>
			        <div class="input-field col s6">
			          <i class="material-icons prefix">textsms</i>
			          <input id="icon_telephone" type="tel" class="validate" name="guion">
			          <label for="icon_telephone">Guion</label>
			        </div>
			      </div>
			      <div class="row">
			        <div class="input-field col s6">
			          <i class="material-icons prefix">extension</i>
			          <input id="icon_prefix" type="text" class="validate" name="ee">
			          <label for="icon_prefix">Efectos Especiales</label>
			        </div>
			        <div class="input-field col s6">
			          <i class="material-icons prefix">compare_arrows</i>
			          <input id="icon_telephone" type="tel" class="validate" name="reparto">
			          <label for="icon_telephone">Reparto</label>
			        </div>
			      </div>
			      <div class="row">
			        <div class="input-field col s6">
			          <i class="material-icons prefix">add_a_photo</i>
			          <input id="icon_prefix" type="text" class="validate" name="ruta">
			          <label for="icon_prefix">Ruta de la imagen</label>
			        </div>
			      </div>
			      <div class="row" type="submit">
			      	<div class="col s5 push-s4" type="submit" value="Guardar datos">
			         	<input type="submit" value="Guardar datos">
			        </div>
			      </div>
			    </form>
			  </div>
		    </form>
  		</center>
    </div>
  </div>
 <script type="text/javascript">
        function FindNext () {
            var str = document.getElementById ("findInput").value;
            if (str == "") {
               
                return;
            }
            
            if (window.find) { 
                   // Firefox, Google Chrome, Safari
                var found = window.find (str);
                if (!found) {
                    alert ("No se encronto:\n" + str);
                }
            }
            else {
                alert ("Your browser does not support this example!");
            }
        }
    </script>

</body>


</html>
