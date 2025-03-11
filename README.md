# Prueba técnica

Este proyecto sigue una arquitectura en capas, separando la lógica de negocio, la capa de datos y la presentación para mejorar la mantenibilidad y escalabilidad del código.

## Clonar el repositorio

Para ejecutar esta aplicación, es necesario tener Docker instalado en tu sistema.

## Clonar el repositorio

```bash
git clone https://github.com/nol4lej/dsolutions-backend
cd dsolutions-backend
```

## Descargar dependencias Slim Framework

```bash
docker run --rm -v $(pwd):/app composer/composer require slim/slim "^4.0" vlucas/phpdotenv
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
