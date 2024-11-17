# **News Aggregator API**

The **News Aggregator API** is a Laravel-based backend service that fetches news articles from multiple sources,
provides user authentication, allows users to manage preferences, and delivers a personalized news feed. This project is
fully containerized using **Docker** to simplify setup and development.

---

## **Features**

- **User Authentication**: Register, login, logout, and password reset using API tokens (Laravel Sanctum).
- **Article Management**: Fetch articles, search, filter, and retrieve detailed article data.
- **User Preferences**: Save preferences for sources, categories, and authors to get a personalized feed.
- **Data Aggregation**: Automatically fetch articles from multiple news APIs.
- **Scheduler**: News fetching runs every 5 minutes, or you can fetch manually.
- **API Documentation**: Comprehensive documentation for all endpoints (Swagger/OpenAPI).

---

## **Project Structure**

Key directories and files:

```
news-aggregator-api/
├── docker/
│   ├── .env.example                     # Docker environment variables
│   ├── docker-compose.yml               # Main Docker configuration
│   ├── docker-compose.override.yml.example # Optional services configuration
│   ├── .envs/
│   │   ├── app.env.example              # App environment variables
│   │   ├── mysql.env.example            # MySQL environment variables
│   │   ├── redis.env.example            # Redis environment variables
│   └── nginx/
│       └── default.conf                 # NGINX configuration
├── src/
│   ├── app/                             # Laravel application core
│   ├── database/                        # Migrations and seeders
│   ├── routes/                          # API routes
│   ├── storage/                         # Logs and compiled files
│   ├── tests/                           # Unit and feature tests
│   ├── artisan                          # Artisan CLI
│   ├── composer.json                    # Dependencies
│   ├── README.md                        # Documentation
```

<sub>**File location**: `src/` contains Laravel project core files. & `docker/` contains Docker</sub>

---

## **Getting Started**

### **Prerequisites**

1. Install **Docker** and **Docker Compose**.
2. Clone this repository:
   ```bash
   git clone https://gitlab.com/md.sakir/news-aggregator-api
   cd news-aggregator-api
   ```

---

### **Setup**

Follow these steps to set up the project:

1. **Configure Environment Files**:
    - Navigate to the `docker` directory:
      ```bash
      cd docker
      ```
    - Copy the example `.env` file:
      ```bash
      cp .env.example .env && \
      cp .envs/app.env.example .envs/app.env && \
      cp .envs/mysql.env.example .envs/mysql.env && \
      cp .envs/redis.env.example .envs/redis.env && \
      cp docker-compose.override.yml.example docker-compose.override.yml
      ```
    - (optional) Edit `docker/.env` and set up port numbers:
       ```bash
       nano .env
       ```
    - (optional) If you want to change ports set available ports & composer files in `.env` file :
       ```env
      COMPOSE_PROJECT_NAME="news-aggregator"
      
      #Use ; for windows and : for linux os
      COMPOSE_FILE="docker-compose.yml:docker-compose.override.yml"
        
      NGINX_HTTP_PORT=8101
      REDIS_INSIGHT=8102
      PHP_MYADMIN_PORT=8103
       ```
        - **Required**: Set the `NGINX_HTTP_PORT` for accessing the application from your browser or api client like
          postman.


2. **Build and Start Services**:
    - Build Docker containers:
      ```bash
      docker-compose build
      ```
    - Start all services:
      ```bash
      docker-compose up -d
      ```
      - **Note**: If you found docker-compose not found related issue use `docker compose` inside of `docker-compose`

   
5. **Run Database Migrations**:
    - Access the PHP container:
      ```bash
      docker-compose exec php bash
      ```
    - Install Dependencies and Seed Database:
      ```bash
      composer install && php artisan migrate:fresh --seed
      ```
    - **Optional**: Fetch news manually:
      ```bash
      php artisan app:fetch-news
      ```
    - Exit the container:
      ```bash
      exit
      ```

---

## **Accessing the Application**

- Open your browser and navigate to:
- **App**: `http://localhost:<NGINX_HTTP_PORT>` [localhost:8101](http://localhost:8101)
- **API Docs**: `http://localhost:<NGINX_HTTP_PORT>/api/documentation` [localhost:8101/api/documentation](http://localhost:8101/api/documentation)
- **phpMyAdmin**: `http://localhost:<PHP_MYADMIN_PORT>` [localhost:8103](http://localhost:8103)
- **RedisInsight**: `http://localhost:<REDIS_INSIGHT_PORT>` [localhost:8102](http://localhost:8102) (put `redis` host input field, rest of fields as is)

If you change ports in `.env` replace `<NGINX_HTTP_PORT>`, `<PHP_MYADMIN_PORT>` and `<REDIS_INSIGHT_PORT>`, with the
port you configured in `docker/.env`.

---

## **How It Works**

### **Automatic News Fetching**

- The system fetches news automatically every 5 minutes via Laravel's scheduler.
- Logs are saved in:
    - `storage/logs/connector/<date-time>.log`
    - `storage/logs/laravel.log`

  <sub>**File location**: `storage/logs/` in `src/`</sub>

### **Manual News Fetching**

- Fetch news manually by running:
  ```bash
  docker-compose exec php bash
  php artisan:fetch-news
  exit
  ```

---

## **Swagger API Documentation**

- Access the API documentation at:
  ```
  http://localhost:<NGINX_HTTP_PORT>/api/documentation
  ```
  - [localhost:8101/api/documentation](http://localhost:8101/api/documentation)

---

## **Stopping Services**

 - To stop all services, use:
    ```bash
     docker-compose down
    ```

---

## **Troubleshooting**

### **Permission Issues**
 - If you encounter issues with `storage` or `bootstrap` permissions:
 ```bash
    docker-compose exec php bash -c "chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache"
   ```

### **View Logs**
- Read log without enter php container:
   ```bash
    docker-compose exec php tail -f /var/www/storage/logs/laravel.log
     ```
