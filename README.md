# Procedural PHP
This is an example of PHP application in procedural approach. There is no single class. It uses PDO MySQL (hmmm, it's still OOP ;-)). For the client-side, it uses jQuery and Bootstrap 3.3.7 and uses Fetch API, instead of AJAX.

# How To Run
Clone:

Linux
```
$ git clone https://github.com/julianjupiter/procedural-php.git
```
Windows
```
> git clone https://github.com/julianjupiter/procedural-php.git
```
Or download and extract the zipped file.

Go to the directory:

Linux
```
$ cd procedural-php
```
Windows
```
> cd procedural-php
```
Login to your MySQL Server, either via CLI or any GUI tool, copy and run the contents of **proceduralphp.sql**.
```
CREATE SCHEMA proceduralphp;
USE proceduralphp;
CREATE TABLE IF NOT EXISTS student (
    id INT(11) NOT NULL AUTO_INCREMENT,
    last_name VARCHAR(255) NOT NULL,
    first_name VARCHAR(255) NOT NULL,
    date_of_birth DATE NOT NULL,
    address VARCHAR(255) NOT NULL,
    date_created DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(id)
);
```
Execute:

Linux
```
$ ./bin/start.sh
PHP 7.0.22-0ubuntu0.16.04.1 Development Server started at Fri Dec 29 21:23:42 2017
Listening on http://127.0.0.1:3000
Document root is /home/julez/Workspace/github/procedural-php/public
Press Ctrl-C to quit.
```
Windows
```
$ .\bin\start.bat
```
Open http://localhost:3000 on browser.


Note: On Windows, make sure the php.exe is added to Environment Variables's Path. See my [tutorial](http://julianjupiter.github.io/blog/installation-of-php-7-on-windows-10/).

Message me on [Facebook](https://www.facebook.com/julianjupiter) if you've got a problem or if you have questions.