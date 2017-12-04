<h1 align="center">PHP MVC Framework</h1>
Work in progress

Folder Structure
```bash
root/ -- App/ -- Controllers/ -- Auth
      |      |__ Models/ -- Auth
      |      |__ Views/ -- Auth
      |      |__ Config.php
      |
      |_ Bootstrap/-- bootstrap.php
      |
      |_ Core/-- Auth.php
      |      |__ Controller.php
      |      |__ Error.php
      |      |__ Flash.php
      |      |__ Mail.php
      |      |__ Model.php
      |      |__ QueryBuilder.php
      |      |__ Router.php
      |      |__ Token.php
      |      |__ View.php
      |
      |_ public/ -- index.php
      |        |__ assets
      |_ Routes/ -- routes.php
      |_ composer.json
      |_ db.sql
      |_ README.md
```

## Set Up
The example application that comes with the fraemwork will help get you started in understanding how it works.

1. import or run the /db.sql file in your database to set up the default app.
2. Change the database configurations in the 'App/Config.php' file.
3. Run Composer 
```bash
~ composer install
```

## Documentation
1. [Routing](https://github.com/lvstross/mvc-framework/tree/master/routes)
2. [Controllers](https://github.com/lvstross/mvc-framework/tree/master/app/controllers)
3. [Resources](https://github.com/lvstross/mvc-framework/tree/master/resources)