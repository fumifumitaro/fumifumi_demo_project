# portfolio

docker-compose up -d --build

docker-compose run composer install

docker-compose run app sh

cp -p .env.example .env

php artisan key:generate

php artisan migrate

php artisan db:seed

php artisan config:clear

php artisan config:cache

exit

docker-compose run node npm install

docker-compose run node npm run dev

本プロジェクトのルートにてターミナルで上記実行後に下記URLでアクセスできます。 その後はdocker-compose up -dのみで問題ありません。

http://localhost:8883