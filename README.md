# Simple CMS (Content Management System)

## Project Overview

This project is a simple Content Management System (CMS) built using PHP 7.4+, Laravel (v8), Livewire, MySQL, NPM, Composer, GIT, MVC Pattern, and ORMs. The CMS allows users to create pages with a nested structure and provides a controller to display the content of these pages.


## Installation

1. Clone the repository:

    ```bash
    git clone https://github.com/dev-mitesh-lr/simple-cms-livewire.git
    ```

2. Change into the project directory:

    ```bash
    cd simple-cms
    ```

3. Install PHP dependencies:

    ```bash
    composer install
    ```

4. Install NPM dependencies:

    ```bash
    npm install && npm run dev
    ```

5. Copy the `.env.example` file and configure the database settings:

    ```bash
    cp .env.example .env
    ```
6. Change below **.env** variable 

    ```sh
    DB_HOST=<DB_HOST>
    DB_DATABASE=<DB_DATABASENAME>
    DB_USERNAME=<DB_USERNAME>
    DB_PASSWORD=<DB_PASSWORD>
    ```

7. Generate application key:

    ```bash
    php artisan key:generate
    ```

8. Migrate the database:

    ```bash
    php artisan migrate --seed
    ```
    
9. Run Testcase: need to create new testing db `cms_testing_db`

    ```bash
    php artisan test
    ```

## Usage

To run the application locally, use the following command:

```bash
php artisan serve 
```

For admin to create page
```bash
http://127.0.0.1:8000/admin/pages
```


For listing page
```bash
http://127.0.0.1:8000/page
```

Admin User Login Credential
```bash
http://127.0.0.1:8000/login

Email    :  admin@malinator.com
password :  Admin@123
```
