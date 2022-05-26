## Configuración

El archivo .env de cada entorno consta de las siguientes variables:

- **DOMAIN_NAME:** Ha de ser el nombre del dominio sin la extensión, por ejemplo si configuramos mars-rover-mission, aqui deberiamos poner mars-rover-mission.
- **DOMAIN:** El nombre del dominio con su extensión, es decir, mars-rover-mission.com
- **INSECURE_PORT:** Puerto que será mapeado al puerto 80, es importante revisar que no esté siendo utilizado.
- **SECURE_PORT:** Puerto que será mapeado al puerto 443, es importante revisar que no esté siendo utilizado y nos servirá la aplicacion mediante https.
- **MYSQL_PORT:** Puerto que le asignaremos al servicio MYSQL.
- **PROJECT_FOLDER:** Nombre de la carpeta de la aplicación.

## Setup 

Antes de ejecutar el script para arrancar el proyecto, debemos instalar mkcert para poder automatizar la instalación de los certificados en local.
En caso de no tenerlo instalado, puedes ver las instrucciones [aquí](https://github.com/FiloSottile/mkcert#installation).

Seguidamente desde el directorio raiz del proyecto ejecutamos las siguientes línias.

```bash
chmod +xr deploy.sh
./deploy.sh
```
En el caso de que no os funcione, se puede ajecutar de la siguiente manera.

```
bash deploy.sh
```

Este comando te pedirá las siguientes variables: 

```bash
DOMAIN_NAME | mars-rover-mission
DOMAIN | mars-rover-mission
INSECURE_PORT | 8081
SECURE_PORT | 8082
MYSQL_PORT | 33063
PROJECT_FOLDER | laravel/public
```

Este creará el .env del entorno que se haya escogido, ademas generará los certificados.

Posteriormente instalaremos desde dentro del contenedor las dependencias de composer.

Por último en nuestro archivo hosts, añadiremos el registro del dominio que hayamos escogido precedido de dev-.

```bash
127.0.0.1      dev-mars-rover-mission.com
```

Una vez tengamos los contenedores funcionando desde dentro del contenedor, deberás instalar los vendors mediatne **composer install**. Una vez instalados ejecutaremos: 

```bash
php artisan migrate:fresh
php artisan db:seed
```
