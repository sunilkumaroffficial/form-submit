<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About FormSubmit Project
This is a simple user form submission application developed using PHP and Laravel for the backend, with custom CSS/SASS and JavaScript handling the frontend logic to provide a modern UI experience.

## Steps to run the project
To set up the project and explore its features, follow these steps:

1. Clone this public repository to your local machine.
2. Run the following command to install all PHP dependencies: **composer install**
3. Execute the database migrations to set up the necessary tables: **php artisan migrate**
4. Seed the database with initial user roles data by running the seeders: **php artisan db:seed --class=RolesSeeder**
5. If the storage directory is not available in the public folder, create a symbolic link by running: **php artisan storage:link**
6. Use the following command to compile Sass files and start the Vite development server: **npm run dev**
7. Start the Laravel development server and ensure your MySQL server is running: **php artisan serve**
8. Now you can access the application, explore its frontend, and submit data to test the backend functionality.
9. Test the frontend and backend functionality.

## License

The FormSubmit application is open-sourced software licensed under the @sunilkumaroffficial
