


# Affinity Invoice  System

## Installation

Follow these steps to install and run the application on your local machine:

```
git clone https://github.com/Logic-Barn/Affinityv2.git
cd Affinityv2
```

## Install Dependencies

composer install
```

```
npm install
```

or if you use yarn

```
 yarn install
```

## Setting Up Environment Variables

copy .env.example to .env

```
Open the .env file in your favorite text editor and replace the database, email, and other configuration values to match your local setup.

```

## Generate Key
And run this command to generate key

```
php artisan key:generate
```

Create a mysql database using phpmyadmin or anyother client and configure those details in your env file

```
DB_USERNAME=YOUR_DATABASE_USERNAME
```

## **Running Migrations**

After setting up the environment variables, run the following command to create the tables in the database:

```
php artisan migrate
```

## ** Seeding fake data**

```
php artisan db:seed --class=VoyagerDatabaseSeeder
```


## ** Braintree command**

```
php artisan braintree:plans
```

## **Compiling Assets**

Run the following command to compile the assets:

```
npm run dev
```

## **Starting the Application**

To start the Laravel server, run the following command:

```
php artisan serve
```

## ** Admin, candidate, employer test Login details**

## Admin

```
email => admin@admin.com
password => password

```

<!-- ## Candidate

```
email => candidate@humujob.com
password => password

```

## employer

```
email => employer@humujob.com
password => password

``` -->

