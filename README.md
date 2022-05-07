IneVirtual
==========

Proyecto final para la materia de seguridad web de la UPIIZ en el ciclo escolas 22-2.

Uso de composer
===============

En esta sección se muestran algunos de los comandos que podrian ser usados para el desarrollo del proyecto. Se supondrá que el alumno ya tiene instalado Composer en su computadora.

Cada uno de los comandos de composer debe ejecutarse desde la raiz del pryecto.

Actualización de paquetes
-------------------------
-------------------------

Cada que se descarguen nuevos cambios del repositorio es recomendable actualizar las dependencias del proyecto. Si en algun momento el sistema arroja un error que involucre la carpeta **/vendor/** actualizar los paquetes podría solicionar el problema.

```bash
composer update
```

Intalación de dependencias
--------------------------
--------------------------

Es posible que a lo largo del proyecto se necesiten instalar nuevas dependencias que ayuden a su desarrollo. El siguiente comando actualiza el archivo de dependencias e instala los paquetes necesarios, puede instalar más de una dependencia al mismo tiempo

```bash
composer require <desarrollador>/<paquete> ...
```

Desinstalacion de dependencias
------------------------------
------------------------------

Si por algun motivo, se identifica una dependencia si utilizar o se decide dejar de usar alguna es posible desistalarla. Esto puede hacerse removiendo la dependencia del archivo **packaje.json** y actualizando las dependencias o ejecutando el siguiente comando:

```bash
composer remove <desarrollador>/<paquete> ...
```

Iniciar el servidor
-------------------
-------------------

Si bien es posible visualizar el avance del desarrollo desde un serviddor de apache, es necesario iniciar el proyecto desde una consola de comandos para el funcionamiento de las rutas, de otro modo, todas las rutas retornarán un error 404. Para iniciar el servidor php ejecutar:

```bash
php -S <host_ip>:<port> -t public/
```

Estandares de desarrollo
========================

Controladores
-------------
-------------

Dentro del patrón de diseño Modelo Vista Controlador (mvc), el controlador se encarga de hacer todas las tareas de proceso de datos. Cada funcionalidad debe de ser procesada por un controlador y todos los controladores deberán mantenerse en el mismo direectorio para su localización.

El enrutador esta configurado para buscar todos los controladores dentro de la carpeta **app/Controllers**, además cada archivo de controlador y su clase deben llevar el mismo nombre y comenzar con una mayúscula, de lo contrario el enrutador no será capaz de encontrarlo.

Por último, todos los controladores deben de tener el mismo espacio de nombre (namespace) para que el enrutador pueda encontrarlos.

```php
<?php
// archivo app/Controllers/Foo.php
namespace App\Controllers;

class Foo {
    // funciones del controlador aqui
}
```

Decalración de funciones en los controladores
---------------------------------------------
---------------------------------------------

Las funciones de los controladores serán declaradas com cualquier otra fucnión de php.

```php
<?php
// archivo app/Controllers/Foo.php
namespace App\Controlleers;

class Foo {
    public function index() {
        // funcionalidad aqui
    }

    public function foo($param) {
        // funcionalidad aqui
    }
}
```

Carga de vistas desde el controlador
------------------------------------
------------------------------------

Para acceder a una vista dentro del sistema, esta tiene que ser retornada desde el controlador, para esto, el controlador hará uso de la función ***View*** la cuál está diseñada para realizar este trabajo.
 
Esta función recibe dos parámetros:
    
1. view: el nombre de la vista en formato string y sin la extención de archivo. Si el archivo está en un subdirectorio, este se añade en el parámetro
2. arguments: arreglo asociativo con el formato **'clave' => valor** que contiene los datos u objetos que se usarán en la vista retornada. Este parametro puede omitirse si la vista no va a mostrar ningún dato del controlador.

```php
<?php
// archivo app/Controllers/Foo.php

// ... definiciones de la clase ...

    public function index() {
        // retorna la vista /src/views/login.html
        return View('login');
    }

    public function foo($param) {
        // ... procesamiento de datos
        $array = [
            'value1' => $value1,
            'value2' => $value2,
        ];

        // retorna la vista /src/views/foo/home.html
        return View('foo/home', $array);
    }
```

Rutas
-----
-----

Ya sea para acceder a una vista o para ejecutar una función de algún controlador, el usos de rutas será necesario. Las rutas del sistema ayudan a que el usuario no conozca la ubicación de los achivos que se están ejecutando a travez de la url.

Las rutas se declaran en archvos *.yml* dentro de la carpera **routes/**, además toadas se buscan desde el mismo archivo *index.yml*. No es necesario poner todas las rutas dentro de este archivo (y de hecho, no es recomendable) sino que pueden colocarse cada una en un archivo yml separado para cada controlador y luego importarse en el principal.

```yml
# archvo /routes/index.yml
home:
    path: /
    defaults:
        _controller: Foo::index

foo_routes:
    prefix: /foo
    resource: foo.yml
```

Cada ruta debe apuntar a un controlador y a una funcióm, estas se declaran en la propiedad *_controller* del "objeto" *defaults* con el formato **Controllador::función**, cuando el enrutador encuentre una dirección conicidente con una de las rutas declaradas automaticamente buscará el controlador indicado y ejecutara la función.

Se pueden enviar parametros en la ruta y pasarlos a una función, para ello los parametros tienen que ser declarados en la ruta haciendo uso de llaves al declarar la ruta y al declarar la funcion en el controlador. Es importante destacar que los parametros deben tener el mismo nombre tanto en la función dentro del controlador como en la ruta declarada.

```yml
# archivo /routes/foo.yml
example_1:
    path: /example/{count}
    defaults:
        _controller: Foo::example1
```

```php
<?php
// archivo /app/Controllers/Foo.php

//... declaración de clase y namespace ...
    public function example1($count) {
        // ...
    }
```


Vistas
------
------