# MR. BARBER 💈

**MR. BARBER** es una aplicación web desarrollada para la gestión de reservas en un salón de peluquería y barbería.  
Los usuarios pueden **registrarse, confirmar su cuenta por correo, iniciar sesión, restablecer su contraseña y reservar citas** seleccionando los servicios disponibles.  
Incluye además un **panel administrativo** para gestionar los servicios ofrecidos y visualizar las citas reservadas.

<img width="2560" height="1600" alt="mrbarber free nf_(Nest Hub Max)" src="https://github.com/user-attachments/assets/01b53e0f-a5dd-47b7-bb3f-486ec974062b" />

## 🚀 Características principales

- **Registro de usuarios** con validación de campos y envío de correo de confirmación con token (vía *Mailtrap + PHPMailer*).  
- **Inicio de sesión**, únicamente para usuarios con cuenta confirmada.  
- **Restablecimiento de contraseña** mediante token de seguridad enviado al correo.  
- **Panel de usuario** para reservar citas seleccionando fecha, hora y servicios disponibles.  
- **Panel de Administrador** con CRUD de servicios y gestión de citas.  
- **Consumo de API REST** mediante *Fetch API* para mostrar los servicios en el frontend.  
- **Alertas dinámicas** con *SweetAlert* para mejorar la experiencia del usuario.  
- **Arquitectura MVC (Model-View-Controller)**, desarrollada desde cero sin frameworks.
- **Responsive**, adapatado a móviles, tablets y ordenadores


## 🛠️ Tecnologías Utilizadas

- **Backend:** PHP con MySQL.
- **Frontend:** HTML, CSS, SASS, JavaScript (Fetch API, SweetAlert)  
- **Entorno:** XAMPP y phpMyAdmin


## 🔗 API REST

La aplicación tiene varios endpoints para interactuar con los datos desde el frontend:

| Método | Endpoint | Descripción |
|--------|-----------|-------------|
| `GET`  | `/api/servicios` | Devuelve la lista de servicios disponibles |
| `POST` | `/api/citas` | Crea una nueva cita con los servicios seleccionados |
| `POST` | `/api/eliminar` | Elimina una cita (rol admin) |

## 🗄️ Estructura de base de datos

- **usuarios** → (id, nombre, apellido, email, password, telefono, admin, confirmado, token)

-  **servicios** → (id, nombre, precio)

- **citas** → (id, fecha, hora, usuarioId)

- **citas_servicios** → (id, citaId, servicioId)

## ⚙️ Variables de entorno

El proyecto utiliza un archivo .env (no incluido en el repositorio) para definir credenciales y rutas:

```sh
DB_HOST = localhost
DB_USER = root
DB_PASS =
DB_NAME = appsalon_mvc

EMAIL_HOST = smtp.mailtrap.io
EMAIL_PORT = 2525
EMAIL_USER = usuario_mailtrap
EMAIL_PASS = clave_mailtrap

BASE_URL = http://localhost/appsalon/public

```


## 💡 Sobre el proyecto

Este proyecto forma parte de mi proceso de aprendizaje en el curso **“Desarrollo Web Completo”** de [Juan Pablo De la torre](https://github.com/codigoconjuan) en UDEMY, en el cual he reforzado conceptos de:

- Arquitectura MVC en PHP sin frameworks.

- Consumo de APIs REST desde el frontend.

Le di un toque personal a la interfaz (colores, tipografía y logo) para modernizar la estética original del curso.


## 💻 Demo
Puedes visualizar e interactuar con este proyecto en el siguiente enlace : [mrbarber.free.nf](https://mrbarber.free.nf/)

Puedes acceder con estas credenciales:

Correo:
```sh
usuario@demo.com
```
Contraseña:
```sh
userdemo
```

