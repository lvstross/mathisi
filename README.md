<h1 align="center">Máthisi</h1>
<h2 align="center">PHP MVC Framework</h2>
<hr />
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
      |_ Resources/ --_globals.php
      |           |_ views
      |           |_ assets/ - js/
      |                    |_ sass/
      |_ Routes/ -- routes.php
      |_ composer.json
      |_ db.sql
      |_ package.json
      |_ README.md
      |_ webpack.mix.js
```

## Set Up
1. import or run the /db.sql file in your database to set up the default app.
2. Change the database configurations in the 'App/Config.php' file.
3. Run Composer 
```bash
~ composer install
~ npm install
```

## Documentation
1. [Routing](https://github.com/lvstross/mvc-framework/tree/master/Routes)
2. [Controllers](https://github.com/lvstross/mvc-framework/tree/master/App/Controllers)
3. [Resources](https://github.com/lvstross/mvc-framework/tree/master/Resources)