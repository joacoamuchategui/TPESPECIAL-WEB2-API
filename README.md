# TPESPECIAL-WEB2-API

Integrantes: 
- Amuchategui Joaquin
- Diniz Mariano

## Tienda Celulares

Pagina Web de venta de Celulares la cual cuenta con una base de datos con una tabla de Articulos y de Marcas relacionadas entre si.

Diagrama:

![Diagrama Base de Datos](https://github.com/user-attachments/assets/59f0bf4d-06e2-4fea-a2dc-8bcca965ca5e)


## Importar DB:

Importar el archivo tienda_celulares.sql dentro de PHPMYADMIN para tener la Base de Datos completa

## Inicio de Sesion:

Usuario: webadmin

Contraseña: admin


## ENDPOINTS

### CELULARES

```http
  GET tiendacelulares/api/celulares
```
Devuelve todos los celulares cargados en la base de datos. Se pueden aplicar filtros y ordenar por campo.

- Filtrado

    - Nombre
    - Marca
    - Pantalla
    - Memoria
    - Camara
    - Precio
    - Stock

Ejemplo de filtrado: Obtener todos los celulares que tengan de nombre "MOTOROLA"

```http
  GET tiendacelulares/api/celulares?filtro=nombre&valor=MOTOROLA
```

- Ordenamiento

    - Nombre
    - Marca
    - Pantalla
    - Memoria
    - Camara
    - Precio
    - Stock

Se utiliza orderBy para seleccionar el campo y order para la direccion (Ascendente o Descendente)

Ejemplo de ordenamiento: Ordenar todos los celulares por marca en orden descendente

```http
  GET tiendacelulares/api/celulares?orderBy=marca&orden=DESC
```
- Paginacion
Se utiliza pagina (num de pagina) y limite (cantidad de elementos a mostrar)
Ejemplo de paginacion

```http
  GET tiendacelulares/api/celulares?pagina=1&limite=2
```

#### GET por ID
Devuelve un celular con determinada ID
 

```http
 GET tiendacelulares/api/celulares/:id
```


#### POST 
```http
 POST tiendacelulares/api/celulares
```

Agrega un nuevo celular con los datos ingresados en formato JSON
 
- Campos requeridos

  - Nombre
  - Marca
  - Pantalla
  - Memoria
  - Camara
  - Precio
  - Stock
  - URL de la imagen

  EJEMPLO del POST

  ```http
  {
    "nombre": "Xiaomi Redmi 13",
    "marca": 12,
    "memoria": "64",
    "pantalla": "7",
    "camara": "80",
    "precio": 7000000,
    "stock": 7,
    "img": "URL"
  }
    
  ```
#### PUT 

```http
 PUT tiendacelulares/api/celulares/:id
```

Modifica el celular con el id ingresado.

- Campos a modificar

  - Nombre
  - Marca
  - Pantalla
  - Memoria
  - Camara
  - Precio
  - Stock
  - URL de la imagen


#### DELETE

```http
 DELETE tiendacelulares/api/celulares/:id
```

Elimina el celular con la ID ingresada.



### MARCAS

```http
  GET tiendacelulares/api/marcas
```
Devuelve todas las marcas cargadas en la base de datos. Se pueden aplicar filtros y ordenar por campo.

#### GET por ID
Devuelve una marca con determinada ID
 
```http
 GET tiendacelulares/api/marcas/:id
```

#### POST 
```http
 POST tiendacelulares/api/marcas
```

Agrega una nueva marca con los datos ingresados en formato JSON
 

#### PUT 

```http
 PUT tiendacelulares/api/marcas/:id
```

Modifica la marca con el id ingresado.

#### DELETE

```http
 DELETE tiendacelulares/api/marcas/:id
```

Elimina al marca con la ID ingresada

