## Sites Parser
Used Laravel Framework
________________________________
Install steps

- composer install
- Set database credentials
- php artisan migrate
- php artisan parse:laravelnews
- See parse results in Page model
- Pages that have an error while parsing are stored in FailedParse model

Functionality tests
- php artisan test
