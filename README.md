# Task and Letter Modules
This Laravel project comprises two main modules, Task and Letter, with the following key features and configurations:

* API Authentication: Laravel Passport is employed for API authentication, providing a secure and convenient way to authenticate users in the application.

* Queue Management: Laravel Horizon is integrated for monitoring and managing queues efficiently, ensuring the smooth execution of background tasks and jobs.

* Dockerization: The project is Dockerized for easy deployment and scalability. The docker-compose.yml file includes services for Nginx, PHP, MySQL, MySQL for testing, and Redis. The containers are connected to a custom network (app_network) for seamless communication.

### Installation

1. Clone the repository:

   ```bash
   git clone git@github.com:mohammadsalehnia/task-letter-manager.git

2. Navigate to the project directory:
   ```bash
   cd path/to/your/project

3. Build and Start Docker Containers:
   ```bash
   docker-compose up -d --build

4. Install dependencies:
   ```bash
   docker-compose exec php_app composer install

5. Generate .env file:
   ```bash
   cp .env.example .env
   php artisan key:generate
   
6. Run migrations:
   ```bash
   docker-compose exec php_app php artisan migrate --seed

7. Run passport:install for Laravel Passport configuration:
   ```bash
   php artisan passport:install

### Task Module
* The Task module provides functionality related to tasks in application.
* Explore the Task module controllers, models, and tests within the Modules/Task directory.

### Letter Module

* The Letter module provides functionality related to letters in application.
* Explore the Letter module controllers, models, and tests within the Modules/Letter directory.

### Authentication Module
* There is an Authentication module to for users authentication.
* Explore the Letter module controllers, models, and tests within the Modules/Letter directory.

### Laravel Breeze & Laravel Horizon
I used Laravel Breeze package for generate login and register pages for secure Laravel Horizon dashboard



### Tests
Run this command for tests:
   ```bash
   php artisan test
   ```

### Postman API Collection

You can download Postman collection from [here](https://drive.google.com/drive/folders/14lVOEwf5nK9EPSgyeICk1zwYr4OgzBOv?usp=sharing) and import it on your Postman application and using APIs. 

Postman Collection Link: https://drive.google.com/drive/folders/14lVOEwf5nK9EPSgyeICk1zwYr4OgzBOv?usp=sharing
