# PHP start

php ことはじめのお勉強

## 環境構築

`docker` と `docker-compose` が導入されている事が前提条件。

```console
$ docker-compose build
$ docker-compose up -d
```

その後 `docker ps` で php-tutorial-web, php-tutorial-db が動いていることを確認

```bash

nyker ~/projects/php-tutorial
$ docker-compose up -d
Starting php-tutorial-database ...
Starting php-tutorial-database ... done
Starting php-tutorial-web ...
Starting php-tutorial-web ... done

nyker ~/projects/php-tutorial
$ docker ps
CONTAINER ID        IMAGE               COMMAND                  CREATED             STATUS              PORTS                                          NAMES
6600cae10a45        phptutorial_web     "docker-php-entryp..."   2 days ago          Up 2 seconds        0.0.0.0:3000->3000/tcp, 0.0.0.0:8000->80/tcp   php-tutorial-web
993ec80d54c6        mysql:5.7           "docker-entrypoint..."   2 days ago          Up 3 seconds        0.0.0.0:33333->3306/tcp                        php-tutorial-databas
```

database に接続できるか確認

sequel-pro で以下を入力して接続

* host: 0.0.0.0
* user: root
* password: hoge
* port: 33333