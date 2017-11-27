<h1 align="center">PHP MVC Framework</h1>
Work in progress

Folder Structure
```bash
root/ -- App/ -- Controllers/ -- Auth
      |      |__ Models/
      |      |__ Views/ -- Auth
      |      |__ Config.php
      |
      |_ Bootstrap/-- bootstrap.php
      |
      |_ Core/-- Controller.php
      |      |__ Auth.php
      |      |__ Error.php
      |      |__ Mail.php
      |      |__ Config.php
      |      |__ Model.php
      |      |__ QueryBuilder.php
      |      |__ Router.php
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

<h1 align="center">Documentation</h1>
1. [Routing](https://github.com/lvstross/mvc-framework/tree/master/Routes)