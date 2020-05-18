# Foyer des Jeunes Travailleurs Colombier Website

![](https://github.com/Heldeenn/orleans-php-2003-project-fjt/blob/dev/FJT.gif)

## Steps
**You will need [Composer](https://getcomposer.org/) to run this repository.**

1. Clone the repo from Github.
2. Run `composer install`.
3. Create *config/db.php* from *config/db.php.dist* file and add your DB parameters. Don't delete the *.dist* file, it must be kept.
```php
define('APP_DB_HOST', 'your_db_host');
define('APP_DB_NAME', 'your_db_name');
define('APP_DB_USER', 'your_db_user_wich_is_not_root');
define('APP_DB_PWD', 'your_db_password');
```
4. Create a Database and import [table.sql](https://drive.google.com/file/d/1GvmdxdPzO3BBfydsdAPNKx2zumcvlsLf/view?usp=sharing) in the project
5. Run the internal PHP webserver with `php -S localhost:8000 -t public/`. The option `-t` with `public` as parameter means your localhost will target the `/public` folder.
6. Go to `localhost:8000` with your favorite browser.

### Windows Users

If you develop on Windows, you should edit you git configuration to change your end of line rules with this command :

`git config --global core.autocrlf true`

## URLs availables

### Visitor
* Home page at [localhost:8000/](localhost:8000/)
* Prestations (services and animations list) at [localhost:8000/services/index](localhost:8000/service/index)
* Tarifs page (prices table, rooms list and pre-admission form) [localhost:8000/price/index](localhost:8000/price/index)

### Administrator
* Admin index [localhost:8000/admin/index](localhost:8000/admin/index)

Mailbox
* Mailbox from contact [localhost:8000/adminContact/index](localhost:8000/adminContact/index)
* Mail details [localhost:8000/adminContact/show/:id](localhost:8000/adminContact/show/2)
* Mail deletion [localhost:8000/adminContact/delete/:id](localhost:8000/adminContact/delete/2)

Room
* Index [localhost:8000/adminRoom/index](localhost:8000/adminRoom/index)
* Add [localhost:8000/adminRoom/addRoom](localhost:8000/adminRoom/addRoom)
* Edit [localhost:8000/adminRoom/editRoom/:id](localhost:8000/adminRoom/editRoom/2)
* Deletion [localhost:8000/adminRoom/deleteRoom/:id](localhost:8000/adminRoom/deleteRoom/2)

Address
* Add [localhost:8000/adminAddress/addAddress](localhost:8000/adminAddress/addAddress)
* Edit [localhost:8000/adminAddress/editAddress/:id](localhost:8000/adminAddress/editAddress/2)
* Deletion [localhost:8000/adminRoom/deleteAddress/:id](localhost:8000/adminRoom/deleteAddress/2)

Animation
* Animation index [localhost:8000/adminAnimation/index](localhost:8000/adminAnimation/index)
* Animation add [localhost:8000/adminAnimation/add](localhost:8000/adminAnimation/add)
* Animation edit [localhost:8000/adminAnimation/edit/:id](localhost:8000/adminAnimation/edit/2)
* Animation deletion [localhost:8000/adminAnimation/delete/:id](localhost:8000/adminRoom/delete/2)
* Animation highlight [localhost:8000/adminAnimation/highlightAnimation/:id](localhost:8000/adminAnimation/highlightAnimation/2)

Pre-admission
* Index [localhost:8000/adminAdmission/index](localhost:8000/adminAdmission/index)
* Pending requests [localhost:8000/adminAdmission/allWaiting](localhost:8000/adminAdmission/allWaiting)
* Validate requests [localhost:8000/adminAdmission/allValidate](localhost:8000/adminAdmission/allValidate)
* File details [localhost:8000/adminAdmission/show/:id](localhost:8000/adminAdmission/show/2)
* Request deletion [localhost:8000/adminAdmission/delete/:id](localhost:8000/adminAdmission/delete/2)

## Contributors
* [Anthony Berduck](https://github.com/AnthonyBerduck)
* [Julien Gault](https://github.com/JuGault)
* [Yannice Maladin](https://github.com/malyadev)
* [Amandine Helene](https://github.com/Heldeenn)
