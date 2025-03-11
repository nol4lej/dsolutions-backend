# Prueba técnica

Debes tener instalado Docker para ejecutar.

Sigue estas instrucciones para clonar y ejecutar la aplicación localmente.

## Clonar el repositorio

```bash
git clone https://github.com/nol4lej/dsolutions-backend
cd dsolutions-backend
```

## Descargar dependencias Slim Framework

```bash
docker run --rm -v $(pwd):/app composer/composer require slim/slim "^4.0"
```

## Enviroment
Cambiar de nombre al archivo `.env.example` a `.env` y añadir un token a gusto.

```bash
API_TOKEN=1234
```

## Ejecutar
```bash
docker compose up --build
```

## Probar en Postman
```bash
http://localhost:8080/users
```
