
***UGE Teledec***


UGE Teledec is a web application that allows users to ...

    PHP 7.2.9 or higher
    PDO-MySql PHP extension enabled;
    and the usual Symfony application requirements.


***Installation***


Download source code from git:https://gitlab.com/DhiaEddi/vertigeo_uge_teledec.git
Download and install composer on your computer(server) and then run these command:
Go to the downloaded folder, open a terminal and run:

```
cd uge_teledec
composer install
```


Now it's time to create the database, after configuring the .env file with the paramaters of your mysql server:


DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=5.7"  (put your own db_user, db_password and db_name ,by default they are set to "root")
Once it's done run the corresponding commands:

For Database creation: `php bin/console doctrine:database:create `

#This should only be used when you're working on local because it will delete the existing database with the same name, on production you should only run the migrations command below

For Migrations from Objects entities to tables:`php bin/console doctrine:migrations:migrate` (if you see an error while executing this command ignore it and continue)
Note:On the current version of the website, no entities has been yet created!


And that's it! Now you can start the local server by running:`php bin/console server:run` or `php -S localhost:8000 -t public`

Then access the application in your browser at the given URL (https://localhost:8000 by default).


***Data Model***


***Application architecture***

Our application , as all Symfony applications,use the three level Model Vue Controller architecture


***Technologies***

Our application isn't entirely php and twig file, in it's core it's a dynamic app JS and Jquery has been used to 
You can find JS files in the following folder: public/JS
You can find CSS files in the following folder: public/css
You can find visual content such as images and icons in the following folder: public


***Services***
images gallery built using js and jquery file: jsSlider.js main function getImages takes to arguments folder 
containing images to add and the html container id.

Translation: check translation folder, changeLocale Controller method and EventSubscriber folder for further info 
we highly recommand to read the documentation on symfony website.

The use of index.html.twig file as a base template and container 
highly facilitate the add of new chapters(pages) all thanks to twig include functionality.

***Technical limitations***
- ...
***Legal mentions:***


2021 Copyright ©  Vertigéo.All rights reserved.

***Contributors:***


This application has been developped by:
- *Dhia Eddine Maghraoui*
