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
/jenkins
    ┗ jenkins マウント先
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

# Jenkins 構築

1. jenkinsをdokcer-composeでコンテナ構築
1. localhost:8081 アクセス 
1. /jenkins/secrets/initialAdminPasswordにあるパスワード文字でログイン
1. 推奨jenkinsプラグイン インストール(gradleなどインストールされるので時間かかる)
1. ID:admin,password:zaq12wsxのユーザー作成
1. GitHub SSH接続のために jenkinsのコンテナ上のssh作成

## Docker コンテナでの ssh作成 for jenkins
[参考](https://takerpg.hatenablog.jp/entry/20140914/1410692046)

> ssh-keygen -t rsa -C "your.address@hoge.com"

1. ↑ のコマンドで 鍵 作成
1. 作成された .ssh/id_rsa.pubをgithubに登録
1. ssh -T git@github.com で一回接続を登録しておく
1. ↑ で jenkinsから 接続できるようになった


## JOBの作成

1. [参考から GitHubからDockerの内容を持ってくるだあけの JOB作成](https://blog.e2info.co.jp/2017/05/10/laravel_and_jenkins/)
1. ビルド実行 → workspaceに git cloneされた
1. TODO:ビルド laravel (pipeline?)
