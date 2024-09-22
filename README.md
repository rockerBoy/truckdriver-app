<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://www.truckdriver.com.ua/wp-content/uploads/2021/03/logo-768x769.png" width="200"></a></p>

## TruckDriver

### Installation steps

- Install Docker + Docker-Compose
- Install the Database migrations
- Run command php artisan ciphersweet:generate-key
- Run command php artisan ciphersweet:encode "<ENTITY>" <GENERATED_CODE>`

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.


## Comments

All the sensetive data should be encrypted with using the Chipersweet library
https://rias.be/blog/encrypting-laravel-eloquent-models-with-ciphersweet

You should store the encryption key at the .env file
- Generate key: php artisan ciphersweet:generate-key
- CIPHERSWEET_KEY=<YOUR-KEY>

The project uses the Fortify package
https://www.redfern.dev/articles/authentication-laravel-sanctum-fortify-for-an-spa/
