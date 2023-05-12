How to install:
(Windows)
1. Install WSL and Docker
2. Clone repository (make sure you are using WSL root directory)

- add alias (if need)
alias sail='vendor/bin/sail'

- composer install

- php artisan sail:install or php artisan vendor/bin/sail: install

- sail up
- sail up -d

- sail npm i && sail npm run dev

Additional:
- you can use for fast testing
- sail artisan db:seed --class=UserSeeder