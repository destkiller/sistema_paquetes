# Sistema de Entrega de Paquetes

Proyecto PHP + MySQL para gestión de entregas con roles de administrador, repartidor y cliente.

## Características

- Panel administrativo con dashboard y cards
- Sidebar moderno y responsive con Material Design
- Gestión de usuarios (admin, repartidor, cliente)
- Gestión de paquetes y estados
- Asignación de paquetes a repartidores
- Ganancias por entrega
- Vistas separadas por rol
- Panel repartidor con detalle de paquetes y cambio de estados (Recepcionado, En Despacho, Entregado)
- Reporte semanal de entregas con descarga en PDF
- Mapa de Google Maps con distancia y ruta en detalle de paquete
- Geolocalización del repartidor con distancia al destino
- Código organizado para producción
- Interfaz con Material Design usando MDBootstrap

## Instalación

1. Copia el proyecto en `c:\wamp64\www\entregas`.
2. Crea la base de datos e importa el script SQL desde phpMyAdmin o la terminal MySQL:

```sql
SOURCE c:/wamp64/www/entregas/init.sql;
```

3. Ajusta los datos de conexión en `config.php` si tu usuario o contraseña MySQL son distintos.
4. Obtén una API key de Google Maps desde https://console.developers.google.com/ y reemplaza `YOUR_GOOGLE_MAPS_API_KEY` en `repartidor/package_detail.php`.
5. Para geolocalización, accede vía HTTPS (recomendado) o localhost.
6. Accede a `http://localhost/entregas/`.

## Credenciales iniciales

- Admin: `admin@entregas.local` / `Admin123`
- Repartidor: `repartidor@entregas.local` / `Repartidor123`
- Cliente: `cliente@entregas.local` / `Cliente123`

> Al iniciar sesión por primera vez con las credenciales iniciales, el sistema actualizará la contraseña para usar hashing seguro.

## Archivos clave

- `index.php` — login
- `logout.php` — cerrar sesión
- `admin/` — panel administrativo
- `repartidor/` — panel de repartidor
- `cliente/` — panel de cliente
- `includes/` — funciones compartidas, header, footer, sidebar
- `init.sql` — script de base de datos inicial
