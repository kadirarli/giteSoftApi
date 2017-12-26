# Api Installation

- Clone or download this repository.
- Create a database schema for project.
- Open .env file and change database connection configuration.
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=[databaseName]
DB_USERNAME=[databaseUserName]
DB_PASSWORD=[databasePassword]
```
- Run below codes at project folder.

```
$ php artisan migrate
```
```
$ php artisan db:seed
```

- I used Intervention for managing image 
- if you want to use imagick driver. To use, look <http://ralbatross204.blogspot.sk/2013/11/getting-imagemagick-to-work-in-xampp-on.html>
- if you want to use gd driver (dafault), you should uncomment below code in App\Http\Controllers\ApiControllers\MovieController

```
Image::configure(array('driver' => 'imagick'));
```
```
$ php artisan serve
```

Laravel development api server url: <http://127.0.0.1:8000>