------
**Buckhill-Petshop Task** 
to satisfy the needs of the FE team for them to be able to build the UI.

- Olarewaju Mojeed: **[github.com/Lowkey1729](https://github.com/Lowkey1729)**

## Table of Contents



## Clone Repository

Clone the repository intoyour local environment

```bash
git clone  https://github.com/Lowkey1729/bukhill-test-pestshop.git
cd bukhill-test-pestshop
```
## Update the .env from the .env.example.

```bash
cp .env.example .env
```
Update the .env.testing from the .env.testing.example.

```bash
cp .env.testing.example .env.testing
```


## Run Code Locally

Ensure that the latest version of docker desktop is installed on your local machine. This will also install docker compose alongside automatically. Follow this link to install docker docker installation.

Then run the following command from the root of the application

```bash
docker compose up --build
```

## Manage Migrations

```bash
docker compose exec api  php artisan migrate --seed
```

```bash
docker compose exec api  php artisan migrate --seed --env=testing
```

## Run test cases

```
docker compose exec api  ./vendor/bin/pest
```

## Run static analysis check on the Domain directory

```
./vendor/bin/phpstan analyse --memory-limit=2G src/Domain

```

## Run static analysis check on the full app directory

```
./vendor/bin/phpstan analyse --memory-limit=2G app
```

## Visit the swagger documentation age
http://localhost:7001/api/doc

