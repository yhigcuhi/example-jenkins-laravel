# example-jenkins-laravel
jenkinsで Laravelの資材をCDするようなサンプル

# 目的
jenkins で Laravel資材をデプロイ(資材最新化、migration、seeder、npm・composerなどの資材管理)する CDのお試し

# 資材構成
/docker
    ┗ Docker Fileなど
/www
    ┗ デプロイ先として 試すための仮想的なリリース先(WEBサーバー for リリースのマウント先)
/db
    ┗ DBマウント先
/laravel
    ┗ Laravel資材と動作確認のマウント先
## Docker構成

- app(phpのみ)
- web(laravelローカル開発のWEBサーバー /laravel)
- db(postgres)
- www(仮想リリース先のnginx /wwwのやつ)

# Jenkins JOB のゴール

1. githubなどから Laravel資材落とす(一旦 laravel/のもの)
1. webサーバーに反映 (wwww/ へ)
1. migration、seeder実行（毎回実行ではなく、必要な場合だけ実行を目指す:最新化したgitの資材のdiffなど？）
1. npm・composer installやビルド
1. 起動確認 (topページ への通信200だけ一旦)

# お試し laravel

- composer require laravel/breeze --dev
- php artisan breeze:install vue --typescript

DBとnpmとcomposerが必要になる感じ