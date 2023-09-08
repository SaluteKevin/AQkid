### branch นี้เป็น branch example code เฉย ๆ

##  คำสั่งที่ใช้ในการ install dependencies
```
docker run --rm \
-u "$(id -u):$(id -g)" \
-v "$(pwd):/var/www/html" \
-w /var/www/html \
laravelsail/php82-composer:latest \
composer install --ignore-platform-reqs

cp .env.example .env

sail up -d
sail artisan key:generate

sail yarn install
sail yarn dev
```

สามารถสั่ง run ได้จาก bash โดยการ cd มาที่ laravel แล้ว run ด้วยคำสั่ง
```
make
```

## .env ที่ใช้ใน project เป็น example
```
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:t6K8GnzgLDL7Dt/TR9sdKfXm0ton5i4hr6ZCWtLAGnQ=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=src
DB_USERNAME=sail
DB_PASSWORD=password

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=ingfosbreak65@gmail.com
MAIL_PASSWORD=nvnsxghvasobwzwn
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="PoolService@gmail.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=mt1

VITE_APP_NAME="${APP_NAME}"
VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
VITE_PUSHER_HOST="${PUSHER_HOST}"
VITE_PUSHER_PORT="${PUSHER_PORT}"
VITE_PUSHER_SCHEME="${PUSHER_SCHEME}"
VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

WWWGROUP=1000
WWWUSER=1000
```

## เปิด storage link
```
sail artisan storage:link
```

## ลง job queue
```
sail artisan queue:table
 
sail artisan migrate
```
จากนั้นจะเปิดใช้งานใช้
```
sail artisan queue:work
```

## สั่งใช้งาน schedule
```
sail artisan schedule:work
```


## ลง dependencie เสริมตัว agent (OPTIONAL)

<https://phattarachai.dev/laravel-mobile-detect>

สามารถลองลงและมาเขียนตาม model migration ที่มีอยู่แล้วได้


## คำสั่งเปิดดู dockerfile เผื่ออยากลอง
```
sail artisan sail:publish
```


