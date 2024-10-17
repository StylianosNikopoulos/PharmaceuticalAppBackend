# PharmaceuticalAppBackEnd-Laravel

This project is a RESTful API built with Laravel, designed for managing research products. It provides endpoints for adding, retrieving, updating, and deleting research products in the system. The API is intended to work seamlessly with a frontend application built with Vue.js.

## Features

- **Add a New Research Product**: 
  - **Endpoint**: `POST /api/products`
  - Adds a new research product to the system.

- **Retrieve All Research Products**: 
  - **Endpoint**: `GET /api/products`
  - Retrieves a list of all research products.

- **Retrieve a Specific Product**: 
  - **Endpoint**: `GET /api/products/{id}`
  - Retrieves detailed information of a specific product by its ID.

- **Update a Research Product**: 
  - **Endpoint**: `PUT /api/products/{id}`
  - Updates the details of an existing research product.

- **Remove a Product**: 
  - **Endpoint**: `DELETE /api/products/{id}`
  - Removes a product from the system.

## Technologies Used

- Laravel
- PHP
- Docker
- Docker Compose

## Prerequisites

- [Docker](https://www.docker.com/get-started) installed on your machine.
- [Docker Compose](https://docs.docker.com/compose/install/) installed.

## Installation

1. **Clone the Repository**:

   ```bash
   git clone https://github.com/StylianosNikopoulos/PharmaceuticalAppBackEnd-Laravel.git

## Networking

Both the frontend and backend services are set up to communicate with each other through an external Docker network. Ensure both `docker-compose.yml` files are configured to use the same network.

### Creating an External Docker Network

To create an external Docker network, use the following command:

```bash
docker network create my-network


networks:
  my-network:
    external: true
