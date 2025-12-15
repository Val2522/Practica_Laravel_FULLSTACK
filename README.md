# Práctica Full Stack con Laravel

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="300" alt="Laravel Logo"></a></p>

---

## 📋 Descripción del Proyecto

Esta es una **práctica de desarrollo Full Stack con Laravel**, que implementa una aplicación web completa con autenticación de usuarios, gestión de artículos (CRUD) y un sistema de perfil de usuario. El proyecto demuestra el uso de las características más importantes de Laravel, incluyendo rutas, controladores, modelos, migraciones, autenticación y vistas con componentes reutilizables.

## 🎯 Objetivo de la Práctica

El objetivo es aprender y practicar:
- Creación de una aplicación Laravel desde cero
- Implementación de autenticación y autorización de usuarios
- Operaciones CRUD (Crear, Leer, Actualizar, Eliminar) con una base de datos
- Uso de migraciones y seeders
- Desarrollo de vistas con Blade Template Engine
- Estilos con Tailwind CSS
- Gestión de la arquitectura MVC

## 🏗️ Estructura del Proyecto

```
mi-app/
├── app/
│   ├── Http/
│   │   ├── Controllers/      # Controladores de la aplicación
│   │   └── Requests/         # Form Requests para validación
│   ├── Models/               # Modelos Eloquent
│   └── Providers/            # Service Providers
├── database/
│   ├── migrations/           # Migraciones de la BD
│   ├── factories/            # Factory para testing
│   └── seeders/              # Seeders para datos iniciales
├── resources/
│   ├── css/                  # Estilos (Tailwind CSS)
│   ├── js/                   # JavaScript
│   └── views/                # Vistas Blade
├── routes/                   # Definición de rutas
├── tests/                    # Tests automatizados
└── config/                   # Configuraciones
```

## ✨ Funcionalidades Principales

### 1. **Autenticación de Usuarios**
- Registro de nuevos usuarios
- Login y logout
- Confirmación de email (opcional)
- Recuperación de contraseña
- Cambio de contraseña
- Gestión de perfil de usuario

### 2. **Sistema de Artículos (CRUD)**
- **Crear**: Formulario para crear nuevos artículos
- **Leer**: Listado de artículos con detalles
- **Actualizar**: Editar artículos existentes
- **Eliminar**: Borrar artículos
- Solo usuarios autenticados pueden gestionar artículos

### 3. **Gestión de Perfil**
- Editar información del perfil
- Cambiar contraseña
- Eliminar cuenta

## 🛠️ Tecnologías Utilizadas

| Tecnología | Versión | Propósito |
|-----------|---------|----------|
| **Laravel** | 11.x | Framework backend |
| **PHP** | 8.2+ | Lenguaje de programación |
| **MySQL** | 8.0+ | Base de datos |
| **Blade** | - | Motor de plantillas |
| **Tailwind CSS** | 3.x | Framework de estilos |
| **Vite** | 5.x | Empaquetador de módulos |
| **Composer** | - | Gestor de dependencias PHP |

## 🚀 Instalación y Configuración

### Requisitos Previos
- PHP >= 8.2
- Composer
- MySQL o SQLite
- Node.js y npm

### Pasos de Instalación

1. **Clonar el repositorio**
```bash
git clone https://github.com/Val2522/Practica_Laravel_FULLSTACK.git
cd mi-app
```

2. **Instalar dependencias PHP**
```bash
composer install
```

3. **Instalar dependencias JavaScript**
```bash
npm install
```

4. **Configurar archivo .env**
```bash
cp .env.example .env
php artisan key:generate
```

5. **Configurar la base de datos** (editar .env con tus credenciales)
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_practice
DB_USERNAME=root
DB_PASSWORD=
```

6. **Ejecutar migraciones**
```bash
php artisan migrate
```

7. **Ejecutar seeders (opcional)**
```bash
php artisan db:seed
```

8. **Compilar assets**
```bash
npm run dev
```

9. **Iniciar el servidor**
```bash
php artisan serve
```

La aplicación estará disponible en `http://localhost:8000`

## 📁 Archivos Importantes

### Controladores
- **ArticlesController.php** - Gestión de artículos
- **Auth/** - Controladores de autenticación
- **ProfileController.php** - Gestión de perfil de usuario

### Modelos
- **User.php** - Modelo de usuario con autenticación
- **Article.php** - Modelo de artículos

### Rutas
- **routes/web.php** - Rutas de la aplicación web
- **routes/auth.php** - Rutas de autenticación

### Vistas
- **resources/views/articles/** - Vistas de artículos
- **resources/views/auth/** - Vistas de autenticación
- **resources/views/profile/** - Vistas de perfil

## 📊 Base de Datos

### Tabla Users
```sql
- id (INT, PK, AI)
- name (VARCHAR)
- email (VARCHAR, UNIQUE)
- email_verified_at (TIMESTAMP)
- password (VARCHAR)
- remember_token (VARCHAR)
- timestamps
```

### Tabla Articles
```sql
- id (INT, PK, AI)
- user_id (INT, FK)
- title (VARCHAR)
- content (LONGTEXT)
- timestamps
```

## 🧪 Testing

Ejecutar tests:
```bash
php artisan test
```

## 🔐 Seguridad

El proyecto implementa:
- Autenticación segura con Laravel Fortify
- CSRF protection
- Password hashing
- Autorización basada en usuario
- Validación de formularios

## 📝 Características Avanzadas Aplicadas

- ✅ Componentes Blade reutilizables
- ✅ Validación de formularios con Form Requests
- ✅ Migraciones versionadas
- ✅ Seeders para datos iniciales
- ✅ Middleware de autenticación
- ✅ Relaciones Eloquent (User -> Articles)
- ✅ Frontend con Tailwind CSS
- ✅ Build tool Vite

## 📚 Recursos de Aprendizaje

- [Documentación oficial de Laravel](https://laravel.com/docs)
- [Laravel Blade Templates](https://laravel.com/docs/blade)
- [Eloquent ORM](https://laravel.com/docs/eloquent)
- [Migraciones](https://laravel.com/docs/migrations)

## 👤 Autor

**Valentina** - Práctica de Full Stack Development

## 📄 Licencia

Este proyecto está bajo la licencia MIT. Ver [LICENSE](LICENSE) para más detalles.

## 🤝 Contribuciones

Las contribuciones son bienvenidas. Para cambios importantes, por favor abre un issue primero para discutir los cambios propuestos.

---

**Última actualización:** Diciembre 2025
