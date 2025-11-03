<?php 

namespace Controllers;

use Model\Servicio;
use Model\Cita;
use Model\CitaServicio;

class APIController {
    public static function index(){
        $servicios = Servicio::all();

        // Imprime el JSON con todos los servicios para consumirlo en la API
        echo json_encode($servicios);
    }


    // Metodo para guardar la reserva de la cita
    public static function reservar() {

        // Se guardan los datos en la bbdd y devuelve el Id
        $cita = new Cita($_POST);
        $resultado = $cita->guardar();

        // debuguear($resultado);

        // Me retorna de ActiveRecord el id de la cita guardada
        $citaId = $resultado['id'];

        // Almacena los servicios con el id de la cita
        $idServicios = explode(',', $_POST['servicios']);
        foreach($idServicios as $idServicio ){
            $args = [
                'citaId' => $citaId,
                'servicioId' => $idServicio
            ];

            $citaServicio = new CitaServicio($args);
            $citaServicio-> guardar();
        }

        // Imprime la respuesta de lo que retorna el método guardar de ActiveRecord
        echo json_encode($resultado);
    }



    // Metodo para eliminar citas desde el admin
    public static function eliminar () {
        
        //debuguear($_POST);

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];

            // Instanciamos el modelo de cita para eliminar 
            $cita = Cita::find($id);

            // Eliminamos la cita
            $cita->eliminar();

            // Redireccionamos a la página que estamos
            header('Location: ' . $_SERVER["HTTP_REFERER"]);
        }
    }
}