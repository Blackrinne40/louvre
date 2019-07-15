[![Codacy Badge](https://api.codacy.com/project/badge/Grade/56195da3986f443fadca7911f3b1094f)](https://www.codacy.com/app/Blackrinne40/louvre?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=Blackrinne40/louvre&amp;utm_campaign=Badge_Grade)

<h1>Ticketing for Louvre Museum</h1>

Project started on May, the 21st of 2019

<h2>Technologies</h2>
<br/>
<ul>
    <li>Symfony 4.2</li>
    <li>Php 7.1.3 minimum</li>
    <li>MySQL</li>
    <li>Bootstrap 4.3</li>
    <li>Stripe</li>
    <li>Webpack-encore 1.5 minimum</li>
    <li>SASS loader 7.1</li>
    <li>Node SASS 4.12</li>
</ul>

<h2>Install</h2>
Clone project:
<pre>
$ git clone https://github.com/Blackrinne40/louvre
</pre>
Install project & database:
<pre>
$ composer install
$ bin/console doctrine database:create
$ bin/console doctrine migration:migrate
</pre>
Duplicate .env file into .env.local and set your parameters (mail, database...). 

You can use your IDE server to preview the site with the command : 
<pre>
$ bin/console server:run
</pre>

<h2>Usage</h2>
This project is reusable only by its end user. Thank you  not copying it.

<h2>Tests</h2>
Execute these commands to run tests:

<pre>
$ bin/phpunit 
</pre>






