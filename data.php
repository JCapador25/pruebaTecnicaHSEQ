<?php

header('Content-Type: application/json');

//Variables de coonexión a la base de datos

try {

    $conexion = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $user,
        $password
    );

    $conexion->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $infoAdicional = $_POST['infoAdicional'];
    $pais = $_POST['pais'];
    $profesion = $_POST['profesion'];
    $area = $_POST['area'];
    $jornada = $_POST['jornada'];

    $sql = "INSERT INTO usuario
            (nombre, apellido, telefono, correo, infoAdicional, pais, profesion, area, jornada)
            VALUES
            (:nombre, :apellido, :telefono, :correo, :infoAdicional, :pais, :profesion, :area, :jornada)";

    $sentencia = $conexion->prepare($sql);

    $sentencia->execute([
        ':nombre' => $nombre,
        ':apellido' => $apellido,
        ':telefono' => $telefono,
        ':correo' => $correo,
        ':infoAdicional' => $infoAdicional,
        ':pais' => $pais,
        ':profesion' => $profesion,
        ':area' => $area,
        ':jornada' => $jornada
    ]);

    echo json_encode([
        "success" => true,
        "message" => "Información guardada correctamente.",
        "usuario" => [
            "nombre" => $nombre,
            "apellido" => $apellido,
            "telefono" => $telefono,
            "correo" => $correo,
            "infoAdicional" => $infoAdicional,
            "pais" => $pais,
            "profesion" => $profesion,
            "area" => $area,
            "jornada" => $jornada
        ]
    ]);

} catch (PDOException $e) {

    if ($e->errorInfo[1] == 1062) {
        echo json_encode([
            "success" => false,
            "message" => "El correo electrónico ya está registrado."
        ]);
    } else {
        echo json_encode([
            "success" => false,
            "message" => "Error al guardar la información."
        ]);
    }
}