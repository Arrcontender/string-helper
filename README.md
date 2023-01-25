# String Helper

The application is used to determine the language of the entered string (rus/eng) and highlight characters that are not included in the alphabet of the given string's language. The entered lines are saved in the history, from which they can be deleted later.

Backend framework: Laravel

Frontend framework: Vue.js

ORM for PostgreSQL (Eloquent ORM)

### 🤗 Requirements

    *  PHP >= 8.0.2
    *  PostgeSQL
    *  Laravel >= 9.2
    *  Composer

### 👏 Installation:
    
    composer install

    npm install

    cp .env.example .env

    # Database Connection on .env

    php artisan cache:clear

    php artisan key:generate

    # First Time
    php artisan migrate:fresh --seed

    # After first time migration
    php artisan migrate

    php artisan db:seed

    mkdir public/storage && cp .storage/** public/storage -r

    php artisan storage:link

    # Run Backend Server by Terminal
    php artisan serve

    # Run Frontend Server by Terminal
    npm run dev
    
