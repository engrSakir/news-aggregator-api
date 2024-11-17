#!/bin/sh
set -e  # Exit on any error

echo "Starting container with role: $CONTAINER_ROLE"
echo "Environment: $APP_ENV"

# Function to run Composer install
run_composer_install() {
  if [ ! -d "vendor" ]; then
    echo "Vendor directory not found. Running composer install..."
    if [ "$APP_ENV" = "dev" ]; then
      echo "Installing development dependencies..."
      composer install
    else
      echo "Installing production dependencies..."
      composer install --no-dev --optimize-autoloader
    fi
  else
    echo "Vendor directory exists. Skipping composer install."
  fi
}

# Function to clear and cache Laravel configurations
clear_and_cache() {
  if [ "$APP_ENV" != "dev" ]; then
    echo "Clearing and caching configurations..."
    php artisan config:clear
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
  else
    echo "Skipping cache clear and optimization in development environment."
  fi
}

# Function to set appropriate permissions
set_permissions() {
  echo "Setting permissions for storage and cache directories..."
  chown -R www-data:www-data storage bootstrap/cache
  chmod -R 775 storage bootstrap/cache
}

# Function to check database connection and create database if it doesn't exist
check_and_create_db() {
  echo "Checking database connection..."
  until php -r "try { new PDO('mysql:host=$DB_HOST;port=$DB_PORT', '$DB_USERNAME', '$DB_PASSWORD'); exit(0); } catch (PDOException \$e) { exit(1); }"; do
    echo "Database is unavailable - waiting..."
    sleep 2
  done

  echo "Database is available."

  echo "Checking if database '$DB_DATABASE' exists..."
  if ! php -r "try { new PDO('mysql:host=$DB_HOST;port=$DB_PORT;dbname=$DB_DATABASE', '$DB_USERNAME', '$DB_PASSWORD'); exit(0); } catch (PDOException \$e) { if (str_contains(\$e->getMessage(), 'Unknown database')) { exit(1); } else { exit(0); } }"; then
    echo "Database '$DB_DATABASE' does not exist. Creating..."
    mysql -h"$DB_HOST" -u"$DB_USERNAME" -p"$DB_PASSWORD" -e "CREATE DATABASE $DB_DATABASE;"
    echo "Database '$DB_DATABASE' created successfully."
  else
    echo "Database '$DB_DATABASE' already exists."
  fi
}

# Function to run migrations and seeds if tables are not found
run_migrations_and_seeds() {
  echo "Checking if migrations need to be run..."
  if php artisan migrate:status --no-ansi | grep -q "No migrations found"; then
    echo "No tables found. Running migrations and seeds..."
    php artisan migrate --force
    php artisan db:seed --force
  else
    echo "Tables exist. Skipping migrations."
  fi
}

# Main case logic based on container role
case "$CONTAINER_ROLE" in
  "app")
    echo "Starting application container..."

    # Run Composer install
    run_composer_install

    # Clear and cache configurations for production
    clear_and_cache

    # Set permissions for Laravel directories
    set_permissions

    # Check database and create if necessary
    check_and_create_db

    # Run migrations and seeds if necessary
    run_migrations_and_seeds

    # Run Composer dump-autoload
    echo "Generating Composer autoload files..."
    composer dump-autoload --optimize
    ;;

  "queue")
    echo "Starting queue worker container..."
    php artisan queue:work --verbose --tries=3 --timeout=90
    ;;

  "scheduler")
    echo "Starting scheduler container..."
    while true; do
      php artisan schedule:run --verbose --no-interaction
      sleep 60
    done
    ;;

  *)
    echo "Error: Unknown or unsupported container role '$CONTAINER_ROLE'."
    exit 1
    ;;
esac

# Start the main application process
echo "Starting application process..."
exec "$@"
