# Proprli

Proprli is a property management system that helps organize tasks, comments, and buildings. This project is built using Laravel and utilizes Laradock for the development environment with Docker.

## Prerequisites

Before you begin, make sure you have the following software installed on your machine:

- [Git](https://git-scm.com/)
- [Docker](https://www.docker.com/)

## Installation

Follow the steps below to set up the project in your local environment.

### 1. Clone the repository

Open your terminal and run the command below to clone the project repository:

```bash
git clone https://github.com/brunooaps/proprli.git
```

### 2. Navigate to the project directory
```bash
cd proprli
```

### 3. Configure Laradock
Clone the Laradock repository inside the project directory:
```bash
git clone https://github.com/Laradock/laradock.git
```

### 4. Copy the example Laradock configuration file
Navigate to the Laradock directory and copy the .env.example file to .env:
```bash
cd laradock
cp .env.example .env
```

### 5. Configure environment variables
Open the Laradock .env file and configure the following variables as needed:
```bash
PHP_VERSION=8.2
POSTGRES_VERSION=14
```

### 6. Start the Docker containers
With Docker installed and configured, start the necessary containers:
```bash
docker compose up -d nginx php-fpm postgres workspace
```

### 7. Copy the postgres Ip address
```bash
docker inspect laradock-postgres-1
```
- Will return something similar to this, find the "IpAddress" and copy it:

```json
"Networks": {
    "laradock_backend": {
        "IPAMConfig": null,
        "Links": null,
        "Aliases": [
            "laradock-postgres-1",
            "postgres"
        ],
        "MacAddress": "02:42:c0:a8:e0:03",
        "NetworkID": "eb7c5f658d2ba6bdcc07b188b0c59d451acd4065a645c4cce4a50ab1b0f82ce7",
        "EndpointID": "6b037ca01a2e8731d37a3dd0315e14dcba5b7685fb58e6227c028732893c08e4",
        "Gateway": "192.168.224.1",
        "IPAddress": "192.168.224.3",  <-----------
        "IPPrefixLen": 20,
        "IPv6Gateway": "",
        "GlobalIPv6Address": "",
        "GlobalIPv6PrefixLen": 0,
        "DriverOpts": null,
        "DNSNames": [
            "laradock-postgres-1",
            "postgres",
            "ab9c1ee9e2ac"
        ]
    }
}
```

- Paste it inside your projects .env.example file
```bash
DB_CONNECTION=pgsql
DB_HOST=192.168.224.3
DB_PORT=5432
DB_DATABASE=default
DB_USERNAME=default
DB_PASSWORD=secret
```

### 8. Install project dependencies
Access the workspace container:
```bash
docker compose exec --user=laradock workspace bash
```

Inside the container, install the Composer dependencies
```bash
composer install
```

### 9. Configure the Laravel environment file
Copy the .env.example file to .env:
```bash
cp .env.example .env
```

### 10. Generate the application key
Run the command to generate the application key:
```bash
php artisan key:generate
```

### 11. Run migrations and seeders
To set up the database, run the migrations and seeders:
```bash
php artisan migrate --seed
```

### 12. Access the application
Open your browser and access the application at http://localhost.

## Tests
To run the tests, use the following command inside the workspace container:
```bash
php artisan test
```

## License
This project is licensed under the terms of the MIT License.

Made with :heart: by Bruno Possiedi