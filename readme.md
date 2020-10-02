
## Requirements

- Docker.
- Docker Compose.

## Setup

- clone repo. 
- run: docker-compose up --build
- run: sudo docker exec -it [CONTAINER_NAME] composer install
- run: sudo docker exec -it [CONTAINER_NAME] cp .env.example .env
- run: sudo docker exec -it [CONTAINER_NAME] php artisan key:generate
- go to http://localhost:8080/api/v1/users to use the endpoint.

## Usage

- Two DataProviders (DataProviderX,DataProviderY).
- You can use and combine filters :
  - List users in ProviderX with some filters http://localhost:8080/api/v1/users?provider=DataProviderX&status=authorised&balanceMin=200.
  - List all users from all providers with some filters http://localhost:8080/api/v1/users?provider=DataProviderX&status=refunded&balanceMax=200.
  - Filters are (provider,status,currency,balanceMin,balanceMax)
- Run Tests: sudo docker exec -it [CONTAINER_NAME]  ./vendor/bin/phpunit --filter=ListUsersTest
- Ability to add new provider classes by implementing ProviderInterface and Defining Class Name in DataProvidersEnum
