# Scandiweb test
## Description
* Uses **HTML**, **Sass**, **JavaScript**, **PHP**, **MySQL**
* Uses **MVC** pattern to separate concerns of application
* Uses **EAV** pattern for attribute system
* Uses **Composer** to generate auto loader
* Does not use **Bootstrap**, **JQuery**
* Has feature to update **products**
* Has additional page to manage **product types**, **attribute groups** and **attributes** to test attribute system
## Dependencies
* Composer
## Usage
1. `git clone https://github.com/strombergs-denniss/scandiweb-test.git` or download the repository
2. `cd scandiweb-test`
3. `composer update`
4. start mysql host
5. paste code from database.sql into mysql console
6. `php -S localhost:8000 -t public`
7. go to http://localhost:8000
