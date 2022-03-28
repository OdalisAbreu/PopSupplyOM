## <p>Sistema de Pedidos Online</p>


**Descripción:**
Sistema web para gestión de pedidos en línea

**Tecnologías empleadas:**
* Laravel 5.5
* ORM Eloquent
* MySQL
* Bootstrap 3
* Material kit

**Contenidos del proyecto:**
* Registro de usuarios
* Acceso por perfiles
* Gestión de categorias
* Gestión de productos
* Gestión de imágenes
* Gestión de órdenes de pedidos
* Integración con API
* Buscador predictivo de artículos
* Carrito de compras


**Instalación:**
* git clone https://github.com/OdalisAbreu/sendiupedidos
* Composer update
* Crear base de datos MySQL
* Renombrar el archivo .env.example a .env y configurar la conexión a MySQL
* Configurar en .env los datos para la gestión de envío de correos: MAIL_DRIVER=smtp MAIL_HOST=smtp.gmail.com MAIL_PORT=587 MAIL_USERNAME=tu email MAIL_PASSWORD=tu clave MAIL_ENCRYPTION=tls
* apt install composer
* php artisan migrate:installphp
* php artisan migrate:refresh
* php artisan db:seed
* php artisan key:generate
* En caso de no generar los seed registrar un usuario y setearlo directamente en la tabla como Admin para la administración

**Para enviar correos desde una cuenta gmail**
* Es necesario activar: Allow less secure apps: YES
