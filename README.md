<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

<h1 align="center">LectuMania10</h1>
<p align="center">Un sistema de gestión de libros y usuarios desarrollado con Laravel.</p>

---

## 📖 Descripción

**LectuMania10** es una aplicación web desarrollada con Laravel que permite gestionar libros, usuarios y carritos de compras. Incluye autenticación con Google mediante Laravel Socialite, un diseño amigable y funcionalidades clave para la administración de usuarios y libros.

---

## 🚀 Características

- **Gestión de usuarios**: Crear, editar y eliminar usuarios.
- **Gestión de libros**: Visualizar, agregar y administrar libros.
- **Carrito de compras**: Agregar libros al carrito y gestionar la selección.
- **Autenticación con Google**: Inicio de sesión mediante OAuth 2.0 con Google.
- **Interfaz amigable**: Diseño responsivo y fácil de usar.
- **Soporte para múltiples roles**: Administración y usuarios regulares.

---

## 🛠️ Tecnologías utilizadas

- **Framework**: [Laravel](https://laravel.com) (PHP)
- **Frontend**: Blade Templates, TailwindCSS
- **Base de datos**: MySQL
- **Autenticación**: [Laravel Socialite](https://laravel.com/docs/socialite)
- **Servidor local**: `php artisan serve`

---

## 📦 Instalación

Sigue estos pasos para configurar el proyecto en tu entorno local:

1. Clona el repositorio:
   ```bash
   git clone https://github.com/tu-usuario/lectumania10.git
   cd lectumania10
   ```

2. Instala las dependencias de PHP:
   ```bash
   composer install
   ```

3. Instala las dependencias de Node.js:
   ```bash
   npm install
   npm run dev
   ```

4. Configura el archivo `.env`:
   - Copia el archivo `.env.example` y renómbralo como `.env`.
   - Configura las variables de entorno, incluyendo la base de datos y las credenciales de Google OAuth:
     ```env
     DB_DATABASE=lectumania10
     DB_USERNAME=root
     DB_PASSWORD=

     GOOGLE_CLIENT_ID=tu-google-client-id
     GOOGLE_CLIENT_SECRET=tu-google-client-secret
     GOOGLE_REDIRECT_URL=http://127.0.0.1:8000/login/google/callback

     GITHUB_CLIENT_ID=tu-client-id
     GITHUB_CLIENT_SECRET=tu-client-secret
     GITHUB_REDIRECT_URL=http://127.0.0.1:8000/login/github/callback
     ```

5. Genera la clave de la aplicación:
   ```bash
   php artisan key:generate
   ```

6. Ejecuta las migraciones:
   ```bash
   php artisan migrate
   ```

7. Inicia el servidor local:
   ```bash
   php artisan serve
   ```

---

## 🌟 Uso

### Autenticación
- Accede a `/login` para iniciar sesión.
- Usa el botón de Google para autenticarte con tu cuenta de Google.

### Gestión de libros
- Navega a `/libros` para ver la lista de libros disponibles.
- Agrega libros al carrito y gestiona tu selección.

### Gestión de usuarios
- Accede a `/usuarios` para administrar usuarios (crear, editar, eliminar).

---

## 📷 Capturas de pantalla

### Pantalla de inicio de sesión
![Pantalla de inicio de sesión](https://via.placeholder.com/800x400?text=Captura+de+Inicio+de+Sesión)

### Gestión de libros
![Gestión de libros](https://via.placeholder.com/800x400?text=Captura+de+Gestión+de+Libros)

---

## 🤝 Contribuciones

¡Las contribuciones son bienvenidas! Si deseas contribuir, sigue estos pasos:

1. Haz un fork del repositorio.
2. Crea una rama para tu funcionalidad (`git checkout -b feature/nueva-funcionalidad`).
3. Realiza tus cambios y haz un commit (`git commit -m 'Agrega nueva funcionalidad'`).
4. Haz un push a tu rama (`git push origin feature/nueva-funcionalidad`).
5. Abre un Pull Request.

---

## 🛡️ Licencia

Este proyecto está licenciado bajo la [MIT License](https://opensource.org/licenses/MIT).

---

## 📧 Contacto

Si tienes preguntas o sugerencias, no dudes en contactarme:

- **Correo**: tu-email@example.com
- **GitHub**: [tu-usuario](https://github.com/tu-usuario)

---

¡Gracias por usar **LectuMania10**! 📚✨
```