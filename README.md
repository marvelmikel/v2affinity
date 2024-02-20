


## Installation Guide

Follow these steps to install and run the application on your local machine or deploy online server:

```
git clone https://github.com/Logic-Barn/Affinityv2.git
cd Affinityv2
```

## Install Dependencies

```
composer install
```

```
npm install
```

## or if you use yarn

```
 yarn install
```

## Setting Up Environment Variables

```
copy .env.example to .env
```
## Open the .env file in your favorite text editor and replace the database, email, and other configuration values to match your local setup.


## Generate Key
And run this command to generate key

```
php artisan key:generate
```

## Create a mysql database using phpmyadmin or anyother client and configure those details in your env file

```
DB_USERNAME=YOUR_DATABASE_USERNAME
```

## Running Migrations

After setting up the environment variables, run the following command to create the tables in the database:

```
php artisan migrate
```

## Seeding fake data

```
php artisan db:seed --class=VoyagerDatabaseSeeder
```


## Braintree commands

```
php artisan braintree:plans
```


```
php artisan braintree:discounts
```


```
php artisan braintree:subscriptions
```

## Compiling Assets

Run the following command to compile the assets:

```
npm run dev or npm run build
```


## Users Roles and Permissions Setup before logging 

For All Users with Role Name e.g Company Admin , Store Manager and Sales been Able to loging kindly login to the admin navigate to roles and do setup for all roles below;

```
Note: All Admin Permissions is checked at default and all must be checked.
- Company Admin :  Only Check = Browse Admin and  Check All = Products , Stores, Invoices, Companies, Employees.
- Store Manager : Only Check = Browse Admin and Check All = Products, Invoices, Companies, Employees.
- Sales Person : Only Check = Browse Admin and Invoices, Companies, Employees.

```



## Starting the Application

To start the Laravel server, run the following command:

```
php artisan serve
```

## Admin, candidate, employer test Login details

Admin

```
email => dev@logicbarn.com
password => password

```


## NOTE: Before pushing to Dev, run 'npm run build' to push any new assets.
