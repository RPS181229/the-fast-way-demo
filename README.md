<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://www.gitbook.com/cdn-cgi/image/width=40,dpr=2,height=40,fit=contain,format=auto/https%3A%2F%2F3934654202-files.gitbook.io%2F~%2Ffiles%2Fv0%2Fb%2Fgitbook-x-prod.appspot.com%2Fo%2Fspaces%252Fid6RwASuk2b1d3wDIdi4%252Ficon%252FTBcCOrWh3qTzdo91BEC4%252F637af5a4d79e11b19ef97611_guOK7KD4G8_G0qowoB8b_GvsCtgPUuE-4Was3A2sFj0.webp%3Falt%3Dmedia%26token%3D35d29626-a8e7-4cdf-9e7c-5f2874f8ff9c" width="400" alt="CoinGecko Logo"></a></p>


## About CoinGecko API

[CoinGecko API](https://apiguide.coingecko.com/getting-started/introduction) provides the most comprehensive & reliable crypto data through RESTful JSON endpoints. Thousands of forward-thinking projects, Web3 developers, researchers, institutions, and enterprises use our API to obtain price feeds, market data, metadata, and historical data of crypto assets, NFTs, and exchanges.

## About Project
This project is created for the demo purpose. I used https://api.coingecko.com/api/v3/coins/list?include_platform=true API to fetch coins data and stored in database using Laravel command.


## Steps to Run this Project
- Clone this repo [The Fast Way Demo](https://github.com/RPS181229/the-fast-way-demo.git)
- Install dependencies using following command
```bash
composer install
```
- Copy file from .env.example to .env
- Setup database credentials
- Run DB migration using following command
```bash
php artisan migrate
```
- Once the database structure is ready, run following command to fetch the conins records from API
```bash
php artisan app:fetch-coins
```