# IN SOUND 🎧

**IN SOUND** es una aplicación web creada para la gestión de eventos y servicios musicales de la empresa IN SOUND. El sistema permite a los usuarios registrarse, iniciar sesión (con correo o con cuenta de Google), ver información sobre los servicios, realizar reservas y contactar a la empresa. Por otro lado, los administradores pueden gestionar usuarios, servicios y reservas a través de un panel de control.

---

## 📌 Índice

- [Características](#características)
- [Tecnologías](#tecnologías)
- [Requisitos](#requisitos)
- [Instalación](#instalación)
- [Estructura del Proyecto](#estructura-del-proyecto)
- [Base de Datos](#base-de-datos)
- [Seguridad](#seguridad)
- [Pruebas Realizadas](#pruebas-realizadas)
- [Pendientes](#pendientes)
- [Autor](#autor)
- [Licencia](#licencia)

---

## 🎯 Características

- Registro e inicio de sesión de usuarios.
- Autenticación con Google usando OAuth 2.0.
- Gestión de reservas: crear, modificar o cancelar.
- Panel administrativo con control total sobre usuarios y reservas.
- Visualización de servicios ofrecidos por la empresa.
- Diseño responsivo con Tailwind CSS.
- Validaciones de formulario en cliente y servidor.
- Integración con redes sociales.
- Conexión a base de datos MySQL.
- Código organizado y modular.

---

## 🛠️ Tecnologías

### Frontend
- HTML5
- CSS3 (TailwindCSS)
- JavaScript

### Backend
- PHP 8.x
- MySQL
- Librería Google API (OAuth 2.0)
- Composer (para autoload)

### Herramientas
- Visual Studio Code
- XAMPP (Apache + MySQL)
- Git y GitHub

---

## 📋 Requisitos

- PHP 7.4 o superior
- MySQL/MariaDB
- Composer
- Servidor Apache (XAMPP, WAMP o similar)
- Cuenta en Google Cloud Console (para usar OAuth)
- Navegador web actualizado

---

## ⚙️ Instalación

1. **Clona el repositorio:**

```bash
git clone https://github.com/tuusuario/APPWEB-PROJECT-INSOUND.git
```

2. **Coloca el proyecto en el servidor local:**

Copia la carpeta `APPWEB-PROJECT-INSOUND` dentro de `htdocs` si usas XAMPP.

3. **Instala dependencias (librería de Google):**

```bash
composer install
```

4. **Importa la base de datos:**

- Abre `phpMyAdmin`.
- Crea una base de datos llamada `registros`.
- Importa el archivo `registros.sql` desde la carpeta `/database`.

5. **Configura el archivo `config/confiig.php`:**

Asegúrate de colocar:

- Datos correctos de conexión a la base de datos (`localhost`, `root`, etc).
- Client ID y Client Secret del proyecto en Google Cloud Console.
- URI de redirección, que debe ser algo como:
  ```
  http://localhost/APPWEB-PROJECT-INSOUND/config/logi.php
  ```

6. **Inicia Apache y MySQL en XAMPP.**

7. **Abre tu navegador en:**

```
http://localhost/APPWEB-PROJECT-INSOUND/pages/index.php
```

---

## 📁 Estructura del Proyecto

```
APPWEB-PROJECT-INSOUND/
│
├── config/
│   ├── confiig.php
│   └── logi.php
│
├── pages/
│   ├── index.php
│   ├── login.php
│   ├── dashboard.php
│   ├── reserva.php
│   ├── servicios.php
│   └── logout.php
│
├── css/
│   └── estilos.css
│
├── js/
│   └── funciones.js
│
├── database/
│   └── registros.sql
│
├── vendor/
│
├── .gitignore
├── README.md
└── composer.json
```

---

## 🗃️ Base de Datos

La base de datos `registros` contiene tablas como:

- `usuarios`: id, nombre, email, contraseña, tipo (normal/admin).
- `reservas`: id, usuario_id, fecha_evento, tipo_evento, estado.
- `servicios`: id, nombre, descripción, precio.

---

## 🔒 Seguridad

- Validación de formularios en frontend y backend.
- Escapado de datos para evitar inyecciones SQL.
- Autenticación segura con sesiones PHP.
- Implementación de OAuth 2.0 con Google.

---

## ✅ Pruebas Realizadas

- Prueba de conexión y operaciones CRUD en la base de datos.
- Login con cuenta tradicional.
- Login y logout con Google.
- Registro de nuevos usuarios.
- Reservas desde el panel de usuario.
- Panel de administración.
- Compatibilidad en navegadores (Chrome, Firefox, Edge).
- Responsividad.

---

## 📌 Pendientes

- Verificación de correo electrónico.
- Recuperación de contraseña.
- Notificaciones por correo.
- Reportes PDF.
- Migración a app móvil con React Native.

---

## 👨‍💻 Autor

**Nombre:** Tu Nombre Aquí  
**Correo:** tunombre@correo.com  
**GitHub:** [@tuusuario](https://github.com/tuusuario)  

---

## 📄 Licencia

Este proyecto fue desarrollado como parte de una actividad educativa.  
Se encuentra bajo una licencia de uso académico, sin fines comerciales.

