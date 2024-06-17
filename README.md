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

### 7. Install project dependencies
Access the workspace container:
```bash
docker compose exec --user=laradock workspace bash
```

Inside the container, install the Composer dependencies
```bash
composer install
```

### 8. Configure the Laravel environment file
Copy the .env.example file to .env:
```bash
cp .env.example .env
```

### 9. Generate the application key
Run the command to generate the application key:
```bash
php artisan key:generate
```

### 10. Run migrations and seeders
To set up the database, run the migrations and seeders:
```bash
php artisan migrate --seed
```

### 11. Access the application
Open your browser and access the application at http://localhost.

## Tests
To run the tests, use the following command inside the workspace container:
```bash
php artisan test
```

## License
This project is licensed under the terms of the MIT License.

Made with :heart: by Bruno Possiedi