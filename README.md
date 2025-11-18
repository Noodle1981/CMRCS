<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

# Despliegue en Producción

## Requisitos
- PHP >= 8.2
- Composer
- Node.js y npm
- Extensiones PHP: pdo, mbstring, openssl, tokenizer, xml, ctype, json, sqlite (o el driver de tu base de datos)
- Servidor web: Apache, Nginx o similar

## Instalación

1. **Clonar el repositorio**
   ```bash
   git clone https://github.com/Noodle1981/CMRCS.git
   cd CMRCS/conexion-syso
   ```

2. **Instalar dependencias**
   ```bash
   composer install --optimize-autoloader --no-dev
   npm install
   npm run build
   ```

3. **Configurar variables de entorno**
   - Copia `.env.example` a `.env` y edita los valores:
     - `APP_KEY` (genera uno con `php artisan key:generate`)
     - Configura la base de datos (`DB_CONNECTION`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`)
     - Configura el correo si lo necesitas
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Migrar la base de datos**
   ```bash
   php artisan migrate --force
   ```

5. **Opcional: Seeders y permisos**
   ```bash
   php artisan db:seed --force
   php artisan storage:link
   ```

6. **Configurar permisos de carpetas**
   - El servidor web debe tener permisos de escritura en:
     - `storage`
     - `bootstrap/cache`

7. **Configurar cola (si usas jobs)**
   - En `.env` pon `QUEUE_CONNECTION=database`
   - Ejecuta el worker en background:
   ```bash
   php artisan queue:work --daemon --stop-when-empty
   ```

8. **Configurar virtual host (Apache/Nginx)**
   - Apunta el DocumentRoot a `public/`
   - Configura HTTPS si es posible

9. **Optimizar para producción**
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

---

Para dudas o problemas, revisa los logs en `storage/logs/laravel.log` y asegúrate de que los permisos y variables estén correctamente configurados.

## Uso del Sistema

Este CRM permite gestionar prospectos, compañías y proveedores, con carga masiva de datos por archivo CSV y roles diferenciados.

### Roles principales
- **Super Admin:** Acceso total, puede crear usuarios, asignar roles y ver métricas internas.
- **Usuario estándar:** Acceso a sus prospectos, compañías y proveedores asignados.

### Flujo de carga de archivos CSV
1. **Navegación:**
   - Desde la vista de proveedores o compañías, encontrarás un botón para cargar datos por CSV.
   - El botón te lleva a un formulario específico para la entidad (proveedores o compañías).

2. **Carga contextual:**
   - El formulario solo permite cargar el tipo de entidad correspondiente (no se mezclan datos).
   - Selecciona el archivo CSV y envíalo.

3. **Procesamiento:**
   - El archivo se procesa en segundo plano mediante un Job (cola de Laravel).
   - Los datos se insertan directamente en la tabla correspondiente, respetando los campos del CSV.

4. **Visualización:**
   - Una vez procesados, los datos aparecen en la tabla de la vista correspondiente.
   - Si una columna tiene demasiada información (ejemplo: Keywords), se muestra truncada con el resto accesible en un tooltip.

### Recomendaciones para la carga
- El archivo CSV debe tener los encabezados correctos y coincidir con los campos del sistema.
- Si la cola está activa (`QUEUE_CONNECTION=database`), el procesamiento será asíncrono y escalable.
- Revisa los mensajes de éxito o error tras la carga para confirmar el resultado.

---

Para dudas sobre el flujo, roles o carga de archivos, consulta la documentación interna o contacta al administrador del sistema.

# Documentación del sistema CRMCS

## 1. Estructura y funcionalidades principales

- **Gestión de proveedores y compañías**: Carga masiva por CSV, visualización y navegación por vistas separadas.
- **Servicios y keywords**: Los servicios se extraen automáticamente de los keywords de cada proveedor y se agrupan por categorías usando sinónimos.
- **Relaciones**: Proveedores y servicios se relacionan mediante la tabla pivote `provider_service`. Cada servicio puede pertenecer a una categoría (`service_category`).
- **Búsqueda inteligente**: Desde el dashboard, puedes buscar proveedores por servicio y ubicación (priorizando por estado y ciudad).
- **Edición manual de categorías**: Puedes editar y asociar servicios a categorías desde el panel de administración.

## 2. Flujo de trabajo

1. **Carga de datos**
   - Sube el CSV de proveedores o compañías desde la vista correspondiente.
   - Los datos se procesan y se insertan en la base de datos.

2. **Sincronización de servicios y categorías**
   - Ejecuta el comando:
     ```bash
     php artisan providers:sync-services-categories
     ```
   - Esto extrae los keywords, crea servicios únicos y los agrupa automáticamente en categorías según sinónimos.

3. **Visualización y edición**
   - Accede a `/servicios` para ver el catálogo de servicios y la cantidad de proveedores asociados.
   - Accede a `/service-categories` para ver y editar las categorías y sus servicios.
   - Desde la edición de categorías puedes modificar el nombre y los servicios asociados manualmente.

4. **Búsqueda inteligente de proveedores**
   - Desde el dashboard, accede a "Buscar proveedores por servicio".
   - Selecciona el servicio, estado y ciudad para priorizar los resultados.
   - El sistema muestra los proveedores que ofrecen el servicio, ordenados por cercanía.

## 3. Tablas principales

- **providers**: Información de cada proveedor.
- **services**: Servicios únicos extraídos de los keywords.
- **service_categories**: Categorías estándar para agrupar servicios similares.
- **provider_service**: Relación muchos a muchos entre proveedores y servicios.

## 4. Comandos útiles

- Sincronizar servicios y categorías:
  ```bash
  php artisan providers:sync-services-categories
  ```
- Sincronizar solo servicios:
  ```bash
  php artisan providers:sync-services
  ```

## 5. Personalización

- Puedes agregar más sinónimos y categorías en el comando de sincronización para mejorar la agrupación automática.
- La edición manual permite corregir y afinar las agrupaciones desde el panel.

## 6. Recomendaciones

- Ejecuta las migraciones antes de sincronizar servicios y categorías:
  ```bash
  php artisan migrate
  ```
- Revisa y edita las categorías periódicamente para mantener la agrupación relevante.
- Usa los filtros y buscadores para optimizar la gestión y asignación de proveedores.

---

Para dudas, mejoras o nuevas funcionalidades, consulta la documentación interna o contacta al administrador del sistema.
