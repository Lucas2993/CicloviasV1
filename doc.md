#Base de datos

# A continuación vamos a crear la tabla de migraciones. En la siguiente sección veremos en detalle que es esto, de momento solo decir que Laravel utiliza las migraciones para poder definir y crear las tablas de la base de datos desde código, y de esta manera tener un control de las versiones de las mismas.

php artisan migrate:install

# tenemos que lanzar la migración con el siguiente comando:
php artisan migrate

# Si queremos deshacer todas las migraciones
php artisan migrate:reset

# Posteriormente en caso de que queramos deshacer los últimos cambios podremos ejecutar:
php artisan migrate:rollback

#Deshará todos los cambios y volver a aplicar las migraciones:
php artisan migrate:refresh

#Además si queremos comprobar el estado de las migraciones, para ver las que ya están instaladas y las que quedan pendientes, podemos ejecutar:
php artisan migrate:status

# para crear el fichero de inicialización de la tabla de usuarios haríamos:
php artisan make:seeder UsersTableSeeder

#Una vez definidos los ficheros de semillas, cuando queramos ejecutarlos para rellenar de datos la base de datos tendremos que usar el siguiente comando de Artisan:
php artisan db:seed

# Si lanza el error [ReflectionException] Class Database\Seeds\ZoneSeeder does not exist, entonces borrar el seeder y crearlo manualmente, claro salvando su contenido                             

# Si lanza la excepcion "[ReflectionException]  Class TripSeeder does not exist", al ejecutar "php artisan db:seed", entonces ejecutar :
composer dump-autoload
## Hacer pelota la BD - "ejecutando en phpMyAdmin"
DROP TABLE `geo_point_journey`, `geo_point_trip`, `geo_point_zone`, `zones`,`journeys`, `trips`, `geo_points`,`centralities`,`users` , `migrations`, `password_resets`;
## luego
php artisan migrate:install
php artisan migrate
php artisan db:seed
