<p align="center">Power by<a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>


## How to start

1. This project run on docker ==> download and install docker, docker compose

    Go to project folder and run <br/>
    `make up`
2. Ssh to docker <br/>
    `make ssh`
3. Go to folder source code in docker <br/>
    `cd /app/www`
4. Migrate database <br/>
    `php artisan migrate`
   
5. import db seed
    `php artisan db:seed`
   
6. Go to link <br/> 
   http://localhost:8068/admin
   add/edit/delete product
   
7. Go to link http://localhost:8068 view product
