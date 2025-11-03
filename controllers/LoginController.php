<?php 
namespace Controllers;
use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController {
    public static function login(Router $router) {
        $alertas = [];

        $auth = new Usuario();
        
        if ($_SERVER['REQUEST_METHOD']=== 'POST') {
            $auth = new Usuario($_POST);
            
            $alertas = $auth->validarLogin();

            if (empty($alertas)) {
                // Verificar que el usuario existe
                /** 
                 * @var Usuario $usuario 
                 * Ayuda al IDE a entender que la variable $usuario será una instancia de la clase Usuario.
                 * */
                $usuario = Usuario::where('email', $auth->email);
                
                if ($usuario) {
                    // Verificamos que el usuario esté confirmado
                    if ($usuario->comprobarPasswordAndConfirmado($auth->password)) {
                        // Autenticamos al usuario
                        //session_start();
                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre . ' ' . $usuario->apellido;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;

                        // Redireccionamos al usuario si es admin o no
                        if ($usuario->admin === '1') {
                            $_SESSION['admin'] = $usuario->admin ?? null;
                            header('Location: ' . BASE_URL . '/admin');
                        }else {
                            header('Location: ' . BASE_URL . '/cita');
                        }

                        // debuguear($_SESSION);
                    }
                }else{
                    Usuario::setAlerta('error', 'El usuario no existe con este correo');
                }
            }
        }

        // Obtenemos las alertas
        $alertas = Usuario::getAlertas();

        $router->render('auth/login', [
            'alertas' => $alertas,
            'auth' => $auth
        ]);
    }

    public static function logout() {
        // Borramos la sesion
        $_SESSION = [];

        header('Location: ' . BASE_URL);
    }
    
    public static function restablecer_contrasenia(Router $router) {

        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth = new Usuario($_POST);
            //debuguear($auth);
            $alertas = $auth->validarEmail();

            if(empty($alertas)) {
                /** @var Usuario $usuario */
                // Buscar el usuario por email
                $usuario = Usuario::where('email', $auth->email);
                
                if($usuario && $usuario->confirmado === '1') {
                    // Generar un nuevo token
                    $usuario->crearToken();
                    $usuario->guardar();

                    // Enviar el email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarInstrucciones();

                    // Agremos una alerta de exito
                    Usuario::setAlerta('exito', 'Hemos enviado las instrucciones a tu correo');
                }else{
                    Usuario::setAlerta('error', 'El usuario no existe o no está confirmado');
                }
            }
        }

        // Obtenemos las alertas
        $alertas = Usuario::getAlertas();

        $router->render('auth/restablecer-contrasenia', [
            'alertas' => $alertas
        ]);
        
    }

    public static function recuperar_contrasenia(Router $router) {
        $alertas = [];
        $token = s($_GET['token']);
        $error = false;

        /** @var Usuario $usuario */
        // Buscar el usuario por token
        $usuario = Usuario::where('token', $token);

        // Si no existe el usuario o el token es inválido
        if (empty($usuario)) {
            Usuario::setAlerta('error', 'Token no válido');
            $error = true;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$error) {
            // Guardar la nueva contraseña
            $password = new Usuario($_POST);
            
            $alertas = $password->validarContrasenia();

            if (empty($alertas)) {
                // anulamos la antigua contraseña
                $usuario->password = null;

                // Asignamos la nueva contraseña
                $usuario->password = $password->password;
                $usuario->hashPassword();

                // Anulamos el token
                $usuario->token = null;

                // Guardamos el usuario
                $resultado = $usuario->guardar();
                if ($resultado) {
                    // Redireccionamos al usuario
                    Usuario::setAlerta('exito', 'Contraseña restablecida correctamente');
                    // header('Location:' . BASE_URL . '/');
                }
            }
        }


        $alertas = Usuario::getAlertas();

        $router->render('auth/recuperar-contrasenia', [
            'alertas' => $alertas,
            'error' => $error
        ]);
    }

    public static function crear_cuenta(Router $router) {

        // Crear una nueva instacia
        $usuario = new Usuario();

        // Alertas 
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') 
        {

            // Sincronizar el objeto con los datos del formulario
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();

            // Verificar que no haya errores
            if ( empty($alertas) ) 
            {

                // Verificar que el usuario no exista
                $resultado = $usuario->usuarioExistente();

                if ($resultado->num_rows) {
                    $alertas = Usuario::getAlertas();
                }else{
                    // Hashear la contraseña
                    $usuario->hashPassword();

                    // Generar Token
                    $usuario->crearToken();

                    // Enviar el email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);

                    $email->enviarConfirmacion();

                    // Crear el usuario
                    $resultado = $usuario->guardar();

                    if ($resultado) {
                        header('Location: ' . BASE_URL . '/mensaje-cuenta');
                    }

                 }
            }

        }

        $router->render('auth/crear-cuenta', [
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);

    }

    public static function confirmar_cuenta(Router $router) {
        $alertas = [];
        $token = s($_GET['token']);
        
        /** @var Usuario $usuario */
        $usuario = Usuario::where('token', $token);
        
        if (empty($usuario)) {
            Usuario::setAlerta('error', 'Token no válido');
        }else{
            // Cambiar el estado del usuario a confirmado
            $usuario->confirmado = "1";
            $usuario->token = null;
            $usuario->guardar();
            
            Usuario::setAlerta('exito', 'Cuenta confirmada correctamente');
        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/confirmar-cuenta', [
            'alertas' => $alertas
        ]);
    }

    public static function mensaje_cuenta (Router $router){
        $router->render('auth/mensaje-cuenta');
    }

}