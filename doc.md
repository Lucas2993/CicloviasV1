# Se clona el proyecto:

	git clone https://github.com/LucasAbella29/CicloviasV1.git

Nos metemos a la carpeta del proyecto clonado y actualizamos las dependencias:

	sudo composer update

Luego se cambian los permisos de las carpetas "storage" y "bootstrap/cache" tal y como indica la documentación de Laravel. Yo use:

	sudo chmod -R 777 storage
	sudo chmod -R 777 bootstrap/cache

Por ser la primera vez, se debe crear el archivo .env que es ignorado por el git. Para eso hay que duplicar el archivo que se llama ".env.example" y renombrarlo como .env. Luego se ejecuta el comando:

	php artisan key:generate

Luego:

	php artisan config:clear

y listo, deberia funcionar bien.

Base de datos

#A continuación vamos a crear la tabla de migraciones. En la siguiente sección veremos en detalle que es esto, de momento solo decir que Laravel utiliza las migraciones para poder definir y crear las tablas de la base de datos desde código, y de esta manera tener un control de las versiones de las mismas.

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
