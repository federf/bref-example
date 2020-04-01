# Guía de inicio

## Pasos

Correr los siguientes comandos en orden:

```
make init
```

```
make up
```

```
make composer-install
```

```
make key
```

Luego conectarse por el browser a:

- http://localhost:8484/

## Conexión a base de datos

Para conectarse al motor de base de datos utilizando MySQL deben utilizar los siguiente parámetros:

- Host: 127.0.0.1
- Port: 3310
- Username: homestead
- Password: secret

Para conectarse con el usuario root:

- Host: 127.0.0.1
- Port: 3310
- Username: root
- Password: root

## Comandos útiles

Para conectarse al container utilizar:

```
make srv
```

Para correr las migraciones:

```
make migrate
```

Para crear nuevas migraciones:

```
make new-migration MG="migration-name"
```


Incluir nuevo paquete con composer

```
make require PKG="package-name"
```

## Iniciar aplicación

Correr los siguientes comandos en orden:

```
make up
```

Luego conectarse por el browser a:

- http://localhost:8484/


## Troubleshooting

### Para hacer downgrade de la versión de MySQL y rebuild de imagen.

Si se inicio docker previo a cambios de MySQL version 5.7, se debe eliminar la siguiente carpeta:

```
sudo rm -fr ~/.laradock/data/mysql
```

Y luego correr lo siguientes comandos:

1. Si se tiene corriendo el container:
```
make down
```

2. Si se tiene corriendo el container, eliminar db's:
```
make down-db
```

3. Correr este comando para utilizar MySQL 5.7
```
make rebuild-db
```

4. Inicializar nuevamente el container
```
make up
```

Y si es necesario dirigirse a la sección de los pasos nuevamente.

### Permisos de lectura en storage - Error 500 en browser

Se debe ejecutar:

```
sudo chmod -R 777 bref/storage
```
