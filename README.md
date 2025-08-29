## Proyecto CRUD Alumnos & Cursos (CodeIgniter 4 + Materialize)

Implementación de un pequeño sistema académico. Para esta entrega subo **todo** el contenido de la carpeta del proyecto.

Features principales:

-   CRUD completo de Alumnos.
-   CRUD completo de Cursos.
-   Relación muchos-a-muchos mediante tabla `alumnos_cursos`.
-   Asignación y visualización de cursos por alumno vía modales (AJAX + JSON).
-   Navbar para navegar entre Alumnos y Cursos.
-   Indicadores visuales (iconos coloreados) según si el alumno tiene cursos asignados.

### Requisitos / Entorno usado

-   PHP 8.1+ (proporcionado por XAMPP instalado localmente)
-   Apache (XAMPP)
-   MySQL (Última versión. También se puede usar el incluido en XAMPP)
-   Herramienta para ejecutar el script SQL (se usó DBeaver; puede ser phpMyAdmin u otra)
-   NO se utilizó Composer adicionalmente (el proyecto ya venía con el framework incluido).

### Puesta en marcha (modo entrega)

1. Clonar o copiar el proyecto dentro de la carpeta `htdocs` de XAMPP (o llamar al php.exe de XAMPP desde la consola).
2. Iniciar Apache el panel de XAMPP.
3. Importar `script.sql` en la base de datos (crea BD `umg` y tablas).
4. Revisar/ajustar credenciales en `app/Config/Database.php` (usuario/password locales) y en `.env`.
5. Acceder usando `php spark serve` en la terminal de Visual Studio Code, e ingresar a `http://localhost:8080/alumnos`

### Uso rápido

-   Crear cursos primero (para poder asignarlos a alumnos).
-   En la lista de alumnos:
    -   Icono "note_add": abre modal para asignar/quitar cursos.
    -   Icono "list": muestra cursos ya asignados.
    -   Colores gris/teal/amber indican estado de asignaciones.

### Estructura de tablas clave

-   `alumnos (alumno, nombre, ...)`
-   `cursos (curso, nombre, ...)`
-   `alumnos_cursos (id, alumno, curso, fecha_asignacion)` con UNIQUE(alumno,curso).

### Documentación visual

Las capturas y diagrama de la BD se encuentran en `public/docs/`

### Notas

-   El borrado de un alumno o curso elimina asignaciones (ON DELETE CASCADE).
-   Endpoints JSON: `/alumnos/{id}/cursos`, `/alumnos/{id}/cursos/all`, `/alumnos/{id}/cursos/asignar`.
