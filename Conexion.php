<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplo de ingreso de datos en base de datos MySQL</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
  body {
            font-family: 'Pacifico', cursive;
            background-color: #FFD5E9;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            color: #333;
        }
        h1 {
             text-shadow: 2px 2px 4px rgba(228, 66, 101, 0.5); /* Sombra rosa oscuro */
             background-color: #FFA6B1; /* Fondo rosa claro */
             padding: 10px; /* Espaciado interno para el fondo */
            border-radius: 20px; /* Bordes redondeados */
        }

        header {
            text-align: center;
            margin-bottom: 20px;
        }

        nav {
            margin-bottom: 20px;
        }

        nav a {
            text-decoration: none;
            color: #E44265;
            font-weight: bold;
            margin: 0 10px;
            transition: color 0.3s;
        }

        nav a:hover {
            color: #FFA500;
        }

        form {
            background-color: #FFA6B1;/* Color para los cuadros*/
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            margin-bottom: 20px;
            width: 100%;
            max-width: 600px;
            text-align: center;
        }
        form input {
            width: 100%;
            box-sizing: border-box;
            margin-bottom: 10px;
            padding: 8px;
            font-size: 16px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        img {
        border-radius: 100% 50%; /* 50% para el radio horizontal, 20% para el radio vertical */
        }

        table, th, td {
            border: 2px solid #E44265;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #FFA6B1;
            color: #FFFFFF;
            font-weight: bold;
            text-align: center;
            padding: 12px;
        }

        tr:nth-child(even) {
            background-color: #FFE2E5;
        }

        a {
            text-decoration: none;
            color: #E44265;
            font-weight: bold;
            text-align: center;
            display: inline-block;
            margin: 4px;
            padding: 4px 8px;
            background-color: #FFFFFF;
            border: 0.5px solid #E44265;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Agrega sombra a los botones */
        }

        a:hover {
            background-color: #FFA6B1;
            color: #FFFFFF;
        }

        

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        /* Estilo adicional para la página de inicio */
        #inicio {
            font-family: 'Pacifico', cursive;
            background: url('http://www.solofondos.com/wp-content/uploads/2015/11/fondos-para-paginas-web-profesionales-grandes-1024x643.jpg') center/cover;;
            font-weight: bold;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            margin-bottom: 20px;
            width: 100%;
            max-width: 600px;
            text-align: center;
            color: #FFFFFF;
            /* Aplicar la animación de desvanecimiento */
            animation: fadeIn 3s ease;
            transition: background-color 0.3s; /* Agrega una transición de color de fondo */
        }
    
    </style>
</head>
<body>
    <header>
        <h1>¡Horario de un alumno de 7mo en el ITO!</h1>
        <br>
        <nav>
             <a href="?section=clientes">Ver mi horario</a>
        </nav>
        <img src="http://4.bp.blogspot.com/-8w9iUDPQ8As/Uz7Mk1T3mwI/AAAAAAAAAQs/SvfYWkeUsW8/s1600/imagen.gif" width="300" height="200">
    </header>
    <?php
    // Configuración de la base de datos y función de conexión
    $host = "localhost";
    $puerto = "3306";
    $usuario = "root";
    $contrasena = "";
    $baseDeDatos = "prueba";
    $tabla = "clientes";

    // Función para conectarse a la base de datos
    function Conectarse() {
        global $host, $puerto, $usuario, $contrasena, $baseDeDatos, $tabla;
        $link = mysqli_connect($host, $usuario, $contrasena, $baseDeDatos);

        if (!$link) {
            die("Error al conectar a la base de datos: " . mysqli_connect_error());
        }

        return $link;
    }
    

    $link = Conectarse();
    $section = isset($_GET['section']) ? $_GET['section'] : 'inicio';

    if ($section == 'clientes') {
        if ($_POST && !isset($_POST['actualizar'])) {
            // Procesar el formulario de inserción de datos
            $nombre = $_POST['NombreForm'];
            $telefono = $_POST['TelefonoForm'];
            $horario = $_POST['HorarioForm'];
            $dias = $_POST['DiasForm'];
            $genero = $_POST['GeneroForm'];
            $queryInsert = "INSERT INTO $tabla (nombre, telefono,horario,dias, genero) VALUES ('$nombre', '$telefono','$horario','$dias', '$genero')";
            $resultInsert = mysqli_query($link, $queryInsert);

            if ($resultInsert) {
                echo "<strong>Se ingresaron los registros con éxito</strong>. <br>";
            } else {
                echo "No se ingresaron los registros. <br>";
            }
        }

        if (isset($_GET['eliminar'])) {
            // Procesar la eliminación de registros
            $id = $_GET['eliminar'];
            $queryDelete = "DELETE FROM $tabla WHERE id = $id";
            $resultDelete = mysqli_query($link, $queryDelete);
            if ($resultDelete) {
                echo "El registro se eliminó con éxito.<br>";
            } else {
                echo "No se pudo eliminar el registro.<br>";
            }
        }

        if (isset($_POST['actualizar'])) {
            // Procesar la actualización de registros
            $id = $_POST['actualizar_id'];
            $nombre = $_POST['actualizar_nombre'];
            $telefono = $_POST['actualizar_telefono'];
            $horario = $_POST['actualizar_horario'];
            $dias = $_POST['actualizar_dias'];
            $genero = $_POST['actualizar_genero'];
            $queryUpdate = "UPDATE $tabla SET nombre = '$nombre', telefono = '$telefono',horario = '$horario', dias = '$dias', genero = '$genero' WHERE id = $id";
            $resultUpdate = mysqli_query($link, $queryUpdate);
            if ($resultUpdate) {
                echo "El registro fue actualizado con éxito.<br>";
            } else {
                echo "No pudimos actualizar el registro.<br>";
            }
        }

        // Realizar la consulta SQL
        $query = "SELECT id, nombre, telefono, genero,horario,dias FROM $tabla";
        $result = mysqli_query($link, $query);

        if (!$result) {
            die("Error en la consulta: " . mysqli_error($link));
        }

        // Mostrar la tabla y el formulario
        ?>
        <hr>
        <form action="?section=clientes" method="post">
            <label for="NombreForm">Nombre de la materia:</label>
            <input type="text" name="NombreForm" id="NombreForm" required><br><br>
            <label for="TelefonoForm">Profesor encargado de la materia:</label>
            <input type="text" name="TelefonoForm" id="TelefonoForm" required><br><br>
            <label for="GeneroForm">Creditos que otorga:</label>
            <input type="text" name="GeneroForm" id="GeneroForm" required><br><br>
            <label for="HorarioForm">Horario:</label>
            <input type="text" name="HorarioForm" id="HorarioForm" required><br><br>
            <label for="DiasForm">Dias:</label>
            <input type="text" name="DiasForm" id="DiasForm" required><br><br>
            <input type="submit" name="guardar" value="Guardar">
        </form>
        <table>
            <tr>
                <th>Imagen</th>
                <th>Nombre de la materia</th>
                <th>Horario</th>
                <th>Días establecidos</th>
                <th>Profesor encargado de la materia</th>
                <th>Creditos que otorga</th>               
                <th>Eliminar</th>
                <th>Actualizar</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo '<td><img src="https://image.freepik.com/vector-gratis/libros-dibujos-animados-educacion_76844-526.jpg" width="50" height="50"></td>';
                echo "<td>" . $row['nombre'] . "</td>";
                echo "<td>" . $row['horario'] . "</td>";
                echo "<td>" . $row['dias'] . "</td>";
                echo "<td>" . $row['telefono'] . "</td>";
                echo "<td>" . $row['genero'] . "</td>";
                echo '<td><a href="?section=clientes&eliminar=' . $row['id'] . '">Eliminar</a></td>';
                echo '<td><a href="?section=clientes&actualizar=' . $row['id'] . '">Actualizar</a></td>';
                echo "</tr>";
                
                // Formulario de actualización para cada fila
                if (isset($_GET['actualizar']) && $_GET['actualizar'] == $row['id']) {
                    echo '<tr>';
                    echo '<td colspan="3"></td>';
                    echo '<td>';
                    echo '<form action="?section=clientes" method="post">';
                    echo '<input type="hidden" name="actualizar_id" value="' . $row['id'] . '">';
                    echo '<label for="actualizar_nombre">Nombre:</label>';
                    echo '<input type="text" name="actualizar_nombre" id="actualizar_nombre" value="' . $row['nombre'] . '" required><br><br>';
                    echo '<label for="actualizar_horario">Horario:</label>';
                    echo '<input type="text" name="actualizar_horario" id="actualizar_horario" value="' . $row['telefono'] . '" required><br><br>';

                    echo '<label for="actualizar_dias">Dias:</label>';
                    echo '<input type="text" name="actualizar_dias" id="actualizar_horario" value="' . $row['dias'] . '" required><br><br>';

                    echo '<label for="actualizar_telefono">Teléfono:</label>';
                    echo '<input type="text" name="actualizar_telefono" id="actualizar_telefono" value="' . $row['telefono'] . '" required><br><br>';
                    echo '<label for="actualizar_genero">Genero:</label>';
                    echo '<input type="text" name="actualizar_genero" id="actualizar_genero" value="' . $row['genero'] . '" required><br><br>';
                    echo '<input type="submit" name="actualizar" value="Guardar actualización">';
                    echo '</form>';
                    echo '</td>';
                    echo '<td></td>';
                    echo '</tr>';
                }
            }
            ?>
        </table>
        <?php
    } elseif ($section == 'inicio') {
        // Contenido de la sección "Inicio"
        echo '<section id="inicio">
                <p>Gracias por visitar mi primer pagina en PHP. Haz clic en el enlace para ir a la tabla y ver tu horario.</p>
              </section>';
    }
    
    ?>
   
    <footer>
        <p>&copy; 2023 Ximena Trujillo Jauregui</a></p>
    </footer>
</body>
</html>



