<?php

$host="localhost";
$usuario="root";
$password="";
$basededatos="api";


$conexion= new mysqli($host,$usuario,$password,$basededatos);

if($conexion->connect_error){
    die("conexion no establecida". $conexion->connect_error);

}


header("Content-Type: application/json");

$metodo = $_SERVER['REQUEST_METHOD'];




switch ($metodo){

    //consulta SELECT
    case 'GET' :
        consultaSelect($conexion);
        break;
    //INSERT
    case 'POST':
        insertar($conexion);
        break;
    //UPDATE
    case 'PUT':
        echo "edicion de registros - PUT";
        break;
    //DELETE
    case 'DELETE':
        echo "borrado de registros - DELETE";
        break;
    default:
        echo "Metodo no permitido";
        break;

}

function consultaSelect($conexion){
    $sql= "SELECT * FROM usuaris";
    $resultado= $conexion->query($sql);

    if($resultado){
        $datos=array();
        while($fila=$resultado->fetch_assoc()){
            $datos[] = $fila;

        }
        echo json_encode($datos);

    }

}
function insertar($conexion){

    $dato=json_decode(file_get_contents('php//input'),true);
    $nombre = $dato['nombre'];
    print_r($nombre);
    $sql= "INSERT INTO * FROM usuaris(nombre) VALUES ('nombre')";
    $resultado= $conexion -> query($sql);

    if($resultado){
        $$dato['id']= $conexion->insert_id;
        echo json_encode($dato);

    }else{
        echo json_encode(array('error'=>'error al crear usuario'));
    }

    $resultado= $conexion->query($sql);
}


?>