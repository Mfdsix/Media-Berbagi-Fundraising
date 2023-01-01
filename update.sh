git fetch --all --tags && git reset --hard origin/main
export COMPOSER_HOME="$HOME/.config/composer";
yes | composer install
yes | php artisan migrate
yes | php artisan db:seed --class=ConfigSeeder