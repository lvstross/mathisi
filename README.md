<h1 align="center">Máthisi</h1>
<h2 align="center">PHP MVC Framework</h2>
<hr />

## What does this framework come with?

As of the most recent commit this framework comes with the following perks:
1. Symphony Twig Support
2. Full MVC Pattern
3. Regex Routing
4. Query Builder
5. Authentication System
6. CSRF Protection
7. Basic Middleware
8. Flash Notifications
9. PhpMailer Support
10. Full assets compilation with Laravel Mix
11. Reactjs
12. Boostrap
13. jQuery
14. Axios for ajax requests
15. Error logging

This framework is a work in progress. Feel free to fork it and make any improvments.

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