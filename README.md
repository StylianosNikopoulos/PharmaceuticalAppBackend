# PharmaceuticalAppBackEnd


**Endpoints**

| Method | Endpoint               | Description                      |
|--------|------------------------|----------------------------------|
| GET    | `/api/products`               | Fetches a list of porduct          |
| GET    | `/api/products/{id}`          | Fetches a specific product by ID    |
| POST   | `/api/products`               | Creates a new product               |
| PUT    | `/api/products/{id}`          | Updates product information         |
| DELETE | `/api/products/{id}`          | Deletes a product                   |

**Example Request (POST, PUT)**
```
{
    "name": "Celebrex",
    "category": "Capsule",
    "active_ingredients":"Silicon Dioxide, Gelatin",
    "batch_number": "7316345212",
    "manufacturing_date": "2024-10-01",
    "expiration_date": "2025-10-01",  
    "status": "under development"  
}
```

**Example Response (GET.POST, PUT)**
```
{
  "message": "Product created successfully",
  "product": {
    "id": 12,
    "name": "Celebrex",
    "category": "Capsule",
    "active_ingredients": "Silicon Dioxide, Gelatin",
    "batch_number": "7316345212",
    "status": "under development",
    "manufacturing_date": "2024-10-01",
    "expiration_date": "2025-10-01",
    "created_at": "2024-10-18T16:59:14.000000Z",
    "updated_at": "2024-10-18T17:39:14.000000Z"
  }
}
```
## Requirements

Before starting, ensure you have the following tools installed:

- [PHP 8.x](https://www.php.net/downloads)
- [Composer](https://getcomposer.org/)
- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/)

## Installation Steps

1. **Clone the repository:**

   ```bash
   git clone https://github.com/StylianosNikopoulos/PharmaceuticalAppBackend.git
   composer install
   docker-compose up -d
   ./vendor/bin/sail shell
   cp .env.example .env
   php artisan key:generate
   php artisan migrate

