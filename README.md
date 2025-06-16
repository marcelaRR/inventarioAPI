--Proyecto: inventarioAPI--
Aplicación Laravel para gestionar productos, movimientos y categorías en un sistema de inventario.

--Requisitos del sistema--
Antes de comenzar asegúrate de tener instalado:
- PHP 8.1 o superior
- Composer
- MySQL o SQLite
- Node.js (opcional)
- Extensiones PHP requeridas:
  - ext-gd
  - ext-zip
- Laravel 10 o superior

--Instalación paso a paso--
 1. Clona el repositorio

```bash
git clone https://github.com/marcelaRR/inventarioAPI.git
cd inventarioAPI

--instala las dependencias--
composer install

--Crea y configura tu archivo .env--
cp .env.example .env

--Abre el archivo .env y edita los valores de la base de datos, por ejemplo:--
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inventario
DB_USERNAME=root
DB_PASSWORD=

--Genera la clave de la app--
php artisan key:generate

--Ejecuta las migraciones y seeders--
(Esto crea las tablas necesarias y carga algunos datos iniciales (por ejemplo, categorías)

php artisan migrate --seed

--Levanta el servidor local--
http://127.0.0.1:8000


Endpoints de API
| Metodos | Ruta                      | Acción              |
| ------ | ------------------------- | ------------------- |
| GET    | /api/productos          | Listar productos    |
| POST   | /api/productos         | Crear producto      |
| GET    | /api/productos/{codigo}| Ver producto        |
| PUT    | /api/productos/{codigo} | Actualizar producto |
| DELETE | /api/productos/{codigo}| Eliminar producto   |


Ejemplos de uso (JSON)
Crear producto

POST /api/productos
{
  "codigo": "HP001",
  "nombre": "Laptop HP",
  "categoria_id": 1,
  "precio_unitario": 699.99,
  "cantidad": 5
}

Registrar movimiento

POST /api/movimientos

{
  "producto_id": 1,
  "tipo": "entrada",
  "cantidad": 3
}


