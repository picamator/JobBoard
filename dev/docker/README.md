Docker
======

Application environment has several containers:

* jobboard-web - [Apache2.4](https://www.apache.org/), [PHP 7.0](http://php.net/manual/en/migration70.new-features.php), [OpenSSH](https://www.openssh.com/), [Supervised](http://supervisord.org/)
* jobboard-mysql - [official MySQL docker](https://hub.docker.com/_/mysql/)
* jobboard-rabbitmq - [official RabbitMQ docker](https://hub.docker.com/_/rabbitmq/)
* jobboard-memcached - [official Memcached docker](https://hub.docker.com/_/memcached/)

Pre installation
----------------
Before start please be sure that was installed:

1. [Docker](https://docs.docker.com/engine/installation/)
2. [Compose](https://docs.docker.com/compose/install/)

Installation
------------
1. Set environment variable `HOST_IP` with your host machine IP, e.g. `export host_ip=192.168.0.104`
2. Run in application root `sudo docker-compose -f dev/docker/docker-compose.yml up`
3. Check containers `sudo docker-compose ps`

Containers
----------

### jobboard-web

#### SSH
SSH credentials:

1. user: `root`
2. password: `screencast`
3. ip: 0.0.0.0
4. port: 2228

To make connection via console simple run `ssh root@0.0.0.0 -p 2228`.

#### Apache
Please configure `host` in you host machine:

1. Add line `job-board.dev 0.0.0.0`
2. Open `http://job-board.dev:8081` in your browser

### jobboard-mysql
For configuration MySQL connection inside linked `jobboard-web`` use:

* host: jobboard-mysql
* port: 8306
* username: 'root'
* password: 'root'

To get access from hosted machine please use:

* ip: 0.0.0.0
* port: 8306
* username: 'root'
* password: 'root'

### jobboard-rabbitmq
To configurate connection to RabbitMQ inside 'jobboard-web' use:

* host: jobboard-rabbitmq
* port: 15672
* username: 'guest'
* password: 'guest'

### jobboard-memcached
To configurate connection to RabbitMQ inside 'jobboard-web' use:

* host: jobboard-memcached
* port: 11211

Usefull commands
----------------

* go to shell inside container `sudo docker-compose -f ./dev/docker/docker-compose.yml exec {{container-name}} bash`
* build container `sudo docker-compose -f ./dev/docker/docker-compose.yml build {{container-name}}`
* build container without caching `sudo docker-compose -f ./dev/docker/docker-compose.yml build --no-cache {{container-name}}`

_Note_: please substitute all `{{container-name}}` by `jobboard-web `, `jobboard-mysql` or `jobboard-rabbitmq`.

For more information please visit [Docker Compose Command-line Reference](https://docs.docker.com/compose/reference/).

Configuration IDE (PhpStorm)
---------------------------- 
### Remote interpreter
1. Use ssh connection to set php interpreter
2. Set "Path mappings": `host machine project root->/var/www/JobBoard`

More information is [here](https://confluence.jetbrains.com/display/PhpStorm/Working+with+Remote+PHP+Interpreters+in+PhpStorm).

### UnitTests
1. Configure UnitTest using remote interpreter. 
2. Choose "Use Composer autoload"
3. Set "Path to script": `/var/www/JobBoard/vendor/autoload.php`
4. Set "Default configuration file": `/var/www/JobBoard/phpunit.xml.dist`

More information is [here](https://confluence.jetbrains.com/display/PhpStorm/Running+PHPUnit+tests+over+SSH+on+a+remote+server+with+PhpStorm).
