# PiA 2.0

## SYSTEM REQUIREMENTS

PHP >= 7.1.3  
MySQL  
NodeJS  

install composer  
install laravel  
npm install gulp -g  

## DEVELOPMENT MODE

#### FIRST START - Run after clone code

**_Install libraries_**  
composer install  
npm install  

**_Create app keys_**  
php artisan key:generate  

**_Build assets_**  
npm run dev  

**_Prepare database_**  
php artisan migrate  
php artisan db:seed  

**_Create passport keys_**  
php artisan passport:keys  
php artisan passport:client --password  

**_Start web_**  
php artisan serve  

#### SECOND START - Run after pull new commits

**_Update libraries_**  
composer install  
npm install  

**_Build assets_**  
npm run dev  

**_Update database_**  
php artisan migrate  
php artisan db:seed (optional)  

**_Start web_**  
php artisan serve  

#### LINTER - Run before commit code

./vendor/bin/phplint  
php artisan blade:lint  


## PRODUCTION BUILD

#### COPY DISTRIBUTION

composer install  
npm install  
npm run prod  
gulp  

#### UPDATE DISTRIBUTION

cd ../pr  
composer dump-autoload  
