<?php

namespace Model;

class Usuario extends ActiveRecord {
    // Base de datos
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'email', 'password', 'telefono', 'admin', 'confirmado', 'token'];

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $telefono;
    public $admin;
    public $confirmado;
    public $token;


    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->admin = $args['admin'] ?? '0';
        $this->confirmado = $args['confirmado'] ?? '0';
        $this->token = $args['token'] ?? '';
    }

    // Mensajes de validación para crear cuenta
    public function validarNuevaCuenta () {
        if (!$this->nombre) {
            // El primer arreglo es el tipo de alerta y el segundo es el mensaje
            self::$alertas['error'][] = 'El nombre es obligatorio';
        }

        if (!$this->apellido) {
            self::$alertas['error'][] = 'El apellido es obligatorio';
        }

        if (!$this->telefono) {
            self::$alertas['error'][] = 'El teléfono es obligatorio';
        }

        if (!preg_match('/^[0-9]{9}$/', $this->telefono)) {
            self::$alertas['error'][] = 'El teléfono no es válido';
        }

        if (!$this->email) {
            self::$alertas['error'][] = 'El correo es obligatorio';
        }

        if (!$this->password) {
            self::$alertas['error'][] = 'La contraseña es obligatoria';
        }

        if (strlen($this->password) < 6) {
            self::$alertas['error'][] = 'La contraseña debe tener al menos 6 caracteres';
        }


        return self::$alertas;
    }

    // Validar el login
    public function validarLogin() {
        if (!$this->email) {
            self::$alertas['error'][] = 'El correo es obligatorio';
        }

        if (!$this->password) {
            self::$alertas['error'][] = 'La contraseña es obligatoria';
        }

        return self::$alertas;
    }

    // Validar el email
    public function validarEmail() {
        if (!$this->email) {
            self::$alertas['error'][] = 'El correo es obligatorio';
        }

        return self::$alertas;
    }

    // Validar el cambio de contraseña
    public function validarContrasenia() {
        if (!$this->password) {
            self::$alertas['error'][] = 'La contraseña es obligatoria';
        }

        if (strlen($this->password) < 6) {
            self::$alertas['error'][] = 'La contraseña debe tener al menos 6 caracteres';
        }


        return self::$alertas;
    }

    // Verficiar que el usuario no exista
    public function usuarioExistente() 
    {
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1" ;

        $resultado = self::$db->query($query);

        if ($resultado->num_rows){
            self::$alertas['error'][] = 'El usuario ya existe con este correo';
        }

        return $resultado;
    }

    // Hashear la contraseña
    public function hashPassword() 
    {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    // Generar token para confirmar cuenta
    public function crearToken()
    {
        $this->token = uniqid();
    }

    // Comprobar contraseña de usuario confirmado
    public function comprobarPasswordAndConfirmado($password) 
    {
        $resultado = password_verify($password, $this->password);

        if (!$resultado) {
            self::$alertas['error'][] = 'La contraseña es incorrecta';
            return false;
        }

        if ($this->confirmado !== "1") {
            self::$alertas['error'][] = 'Tu cuenta no ha sido confirmada';
            return false;
        }

        return true;
    }

}