# rec-task

PHP version: 8.1 \
Symfony version: 5.4 \
Database: MySQL 8.0.32

## REMEMBER TO SET ENVIRONMENT VARIABLES IN .env OR .env.local FILE, RUN composer install AND RUN MIGRATION
DATABASE_HOST - server domain name or ip address \
DATABASE_USER - database user \
DATABASE_PASSWORD - database user's password \
DATABASE_DBNAME - database name

# Endpoints
- /exchange/values (POST): inserts parameters to db; requires 2 parameters: 
  - first (int), 
  - second (int)
- /exchange/values/get (GET, POST): lists all records from db; allows 4 parameters:
  - page (int): number of page,
  - limit (int): limit of listed records,
  - sortBy (string): sort by key,
  - sortDirection (string): sort direction; allowed ASC (ascending) and DESC (descending),