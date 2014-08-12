<!DOCTYPE html>

<html>
	
	 <head>
	    
	    <meta charset="utf-8">
	
     <link href="css/estilo_ingresar.css" rel="stylesheet" type="text/css">
	 </head>
	
     <body>
		 
		 <h2>Ingresar nuevo Automovil</h2>

	  <!-- creo los campos del formulario  -->

	    <form method="post" action="listado.php">
		  
         <label>Marca:</label><input type="Text" name="marca"><br>
         <label>Modelo:</label><input type="Text" name="modelo"><br>
         <label>Km:</label><input type="Text" name="km"><br>
         <label>Año:</label><input type="Text" name="año"><br>
         <label>Precio:</label><input type="Text" name="precio"><br>
         <!-- creo el select para elegir la concesionaria -->
         <label>Concesionaria:</label><select name="conces">
           
             <?php
                     $sql ="SELECT * FROM concesionarias";
                     $tabla = mysqli_query($conexion, $sql) or die ("problema con cadena de conexion<br><b>" . mysqli_error()."</b>");

             //Hago el bucle para sacar los datos
             while($registro=mysqli_fetch_array($tabla))
              echo "<option  value='".$registro["Concesionaria"]."'>".$registro["Concesionaria"]."</option>"; 

                ?>

         </select>
         <p class="ingres"><input type="Submit" name="enviar" value="Ingresar"></p>
         
        </form> 

 <?php 
        if(isset($_POST['marca']) && !empty($_POST['modelo']) &&
       isset($_POST['km']) && !empty($_POST['año'])  && !empty($_POST['precio']) && !empty($_POST['conces'])) {

        // Si entramos es que todo se ha realizado correctamente

       $link = mysqli_connect("localhost","root","ricardoputo");
        mysqli_select_db($link,"autos");

       // insertaremos los datos en la base de datos de marcas de autos
       mysqli_query($link,"INSERT INTO consulta_marcas(`Concesionaria`,`Marca`, `Modelo`, `Km`, `Anio`, `Precio`)
       VALUES ('{$_POST['conces']}','{$_POST['marca']}','{$_POST['modelo']}','{$_POST['km']}','{$_POST['año']}','{$_POST['precio']}')");
       
       

       // comprobamos que todo ha sido correcto
       $my_error = mysqli_error($link);
       

       if(!empty($my_error)) {

        echo "Ha habido un error al insertar los valores. $my_error";

       } else {

          echo "auto agregado";

       }

        } 
 
?>

<!-- creo nuevas concesionarias-->

<h2>Ingresar nueva concesionaria</h2>

<form action="listado.php" method="post">
         <label>Concesionaria:</label><input type="Text" name="concesionaria"><br>
         <label>Ciudad:</label><input type="Text" name="ciudad"><br>
         <label>Dirección:</label><input type="Text" name="direccion"><br>
         <label>Teléfono:</label><input type="Text" name="telefono"><br>
         <p class="ingres"><input type="Submit" name="enviar" value="Ingresar"></p>
</form>


<?php 
        if(isset($_POST['concesionaria']) && !empty($_POST['ciudad']) 
       && !empty($_POST['direccion']) && !empty($_POST['telefono'])) {

        // Si entramos es que todo se ha realizado correctamente

       $link = mysqli_connect("localhost","root","ricardoputo");
        mysqli_select_db($link,"autos");

         
       // insertaremos los datos en la base de datos de concesionarias
        
       mysqli_query($link, "INSERT INTO `concesionarias`(`Concesionaria`, `Ciudad`, `Direccion`, `Telefono`)
       VALUES ('{$_POST['concesionaria']}','{$_POST['ciudad']}','{$_POST['direccion']}','{$_POST['telefono']}')");

       // comprobamos que todo ha sido correcto
       $my_error = mysqli_error($link);
       

       if(!empty($my_error)) {

        echo "Ha habido un error al insertar los valores. $my_error";

       } else {

         echo "concesionaria agregada";

       }

        } 
 
?>
 
   
 

</body>
</html> 


