Sample App
========================

This steps assume you are working on an up to date lamp enviroment.

0) Symfony Documentation
----------------------------------
http://symfony.com/doc/current/book/index.html

1) Cloning the app
----------------------------------

Clone the repo to your local machine. This should be done inside your localhost root.

    clone https://github.com/1000i1/sampleApp.git

This command will create the folde sampleApp inside the folder where you execute this command.

After this all the commands in this doc assume you're inside the sampleApp folder

2) Install Symfony vendors
----------------------------------

    php composer.phar update

This will populate the folder /vendor

This step might require to install the php-composer package

3) Create the database
----------------------------------
The default user is root with an empty password. To change this params modify /app/config/parameters.yml

    php app/console doctrine:database:create
    php app/console doctrine:schema:create
    php app/console doctrine:fixtures:load

4) Change permissions
----------------------------------
    sudo chmod -R 777 app/cache
    sudo chmod -R 777 app/logs

5) Start the app
----------------------------------
    http://localhost/sampleApp/web/app_dev.php