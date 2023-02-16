# portfolio

```
docker-compose up -d --build

docker-compose run composer install

docker-compose exec mysql bash

mysql -u root -p
(上記入力後にpasswordと入力してmysqlにログイン)

ALTER USER 'root'@'%' IDENTIFIED WITH mysql_native_password BY 'password';

exit

exit

docker-compose exec app bash

cp -p .env.example .env

php artisan key:generate

php artisan migrate

php artisan db:seed

php artisan config:clear

php artisan config:cache

exit

docker-compose run node npm install

docker-compose run node npm run dev
```

本プロジェクトのルートにてターミナルで上記実行後に下記URLでアクセスできます。 その後はdocker-compose up -dのみで問題ありません。

ローカルサイト

http://localhost:8883

メールボックス

http://localhost:3555


##開発メモ

vue.jsのライブラリを色々使ってみたくてまずはマークダウンエディタでも使ってみるかと思ったのが発端です。

Laravel × Vue.jsというプロジェクトでinertia.jsを利用してドッキングしているものを見て面白そうなので導入してみました。

CSSがあまり得意ではないので、SASSで書こうとせず素直にbootstrapなどフレームワークに頼ればよかったと思っています(笑)

### Inertia.js

laravelとvue.jsのパイプになってくれるライブラリです。

所感としては普通のlaravelを書きながらbladeをvueに置き換えているという感覚で

laravelをメインで利用していた私にとっては書きやすいので良いと思います。

### mavon editor

利用したマークダウンエディタです。特に弄ってないですが高機能で良いですね。

画像処理などはプログラム弄って画像選択時にLaravelにアップロードしてプロジェクト内に取り込んだ後、

プロジェクト内の画像を参照するようにしています。

CSSを何やらしてオリジナルなデザインに変えたいですね。。。

### 今後の展開

サービスのようなコンセプトを持つというよりvue.jsで色々試すプロジェクトとして開発していこうかと思います。

とりあえず、ユーザープロフィールやコメント機能などを作っていきたい所存。