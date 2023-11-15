# Purchase Pro

# <p align="center">Local Testing/Development</p>

**This Project is using Laravel Sail for Docker**

1. Clone the repository.
2. Duplicate the  *.env.example* file on the root folder and setup the smtp.

3. Run the following command: 

```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs 
```

4. After that, run this command to start docker: 

```
./vendor/bin/sail up
```

5. Then install composer, npm, and run npm

```
./vendor/bin/sail composer install && ./vendor/bin/sail npm install && ./vendor/bin/sail 
```
(Or you could just follow the documentations here to setup the Docker and Laravel Sail: https://laravel.com/docs/10.x/sail)

6. Run the following command for database and sample products:
 ```
./vendor/bin/sail artisan migrate && ./vendor/bin/sail artisan db:seed --class=SampleSeeder
```
7. Run queue as it uses queue for emailing after checkout:
 ```
./vendor/bin/sail artisan queue:listen
```


# <p align="center">Project Description</p>
  
This project is using the Laravel Breeze Starter kit, Vuetify, Tailwind, Pinia as storage, and smtp as emailing service. I chose those tech stack to complete this exam faster with a presentable UI.