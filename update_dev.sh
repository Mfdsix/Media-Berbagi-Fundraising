git fetch --all --tags && git reset --hard origin/development
yes | composer install
yes | php artisan migrate
yes | php artisan db:seed --class=ConfigSeeder