# Prueba técnica

Este proyecto sigue una arquitectura en capas, separando la lógica de negocio, la capa de datos y la presentación para mejorar la mantenibilidad y escalabilidad del código.

## Características  

- **Uso de dotenv**  
  - Permite gestionar variables de entorno de manera segura y flexible.  

- **Middleware de autenticación por token**  
  - Implementa un sistema de autenticación basado en tokens.  
  - Se genera un token que debe ser compartido con quienes deban acceder a la API.  

- **Arquitectura en capas**  
  - Separa la aplicación en distintas capas:  
    - **Controladores:** Manejan las solicitudes y respuestas.  
    - **Servicios:** Contienen la lógica de negocio.  
    - **Repositorios:** Se encargan de la interacción con la base de datos. 

- **Base de datos SQLite**  
  - Ligera y sin necesidad de configuraciones adicionales.  
  - Permite un almacenamiento de datos simple y eficiente.  

- **Ejecución con Docker**  
  - Facilita la instalación y ejecución sin conflictos de dependencias.  
  - Garantiza un entorno uniforme en cualquier sistema.  
  - Permite una ejecución más rápida y reproducible del proyecto.  

## Requisitos previos

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

## Probar la API en Postman
```bash
http://localhost:8080/users
```
