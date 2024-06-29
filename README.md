------
**Buckhill-Petshop Task** 
to satisfy the needs of the FE team for them to be able to build the UI.

- Olarewaju Mojeed: **[github.com/Lowkey1729](https://github.com/Lowkey1729)**

## Table of Contents

- [Clone Repository](#clone-repository)
- [Run Code Locally](#run-code-locally)
- [Manage Migrations](#manage-migrations)



## Clone Repository

Clone the repository into you your local environment

```bash
git clone  https://github.com/Lowkey1729/buckhill-test-petshop.git
cd buckhill-test-petshop
```
Update the .env from the .env.example.
Update the .env.testing from the .env.testing.example.


## Run Code Locally

Ensure that the latest version of docker desktop is installed on your local machine. This will also install docker compose alongside automatically. Follow this link to install docker docker installation.

Then run the following command from the root of the application

```bash
docker compose up --build
```

## Manage Migrations

```
docker compose run --rm artisan migrate
```
