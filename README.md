# AQKids

A swimming academy management web application built with Laravel 10 and Nuxt 3.

This is a term project.  
- 01418442 – Web Technology and Web Services
- 01418321 – System Analysis and System Design

> **Note**
> This project was developed and tested on Unix or Unix-like environments.
> We recommend using WSL if you are installing and running the project on a Windows machine.

## Installation

1. Make sure you have these tools installed:
    - [Docker](https://www.docker.com/)
    - [WSL2](https://learn.microsoft.com/en-us/windows/wsl/install) – required to run the backend server on Windows machines
    - [Node.js](https://nodejs.org/en/) – version 18 (LTS)
1. Set up the backend server
    1. With Docker running, change to `Backend/` directory in this project
    1. Install dependencies and configure the server by executing the following commands:

            $ docker run --rm \
                -u "$(id -u):$(id -g)" \
                -v "`pwd`:/var/www/html" \
                -w /var/www/html \
                laravelsail/php82-composer:latest \
                composer install --ignore-platform-reqs \
              && cp .env.example .env \
              && ./vendor/bin/sail up -d \
              && ./vendor/bin/sail artisan key:generate \
              && ./vendor/bin/sail artisan jwt:secret \
              && ./vendor/bin/sail down

        Or, if you have GNU Make installed, simply execute:

            $ make

1. Set up the frontend server
    1. Change to `Frontend/` directory in this project
    1. Install dependencies by executing this command:

            $ npm install

## Usage

1. Start the backend server:

    1. With Docker running, execute this command in `Backend/` directory:

            $ ./vendor/bin/sail up

        You may append `-d` or `--detach` to the command to run the server in detached mode, a.k.a. run in background.
    1. Then initialize the database:

            $ ./vendor/bin/sail artisan migrate --seed

1. Start the frontend server:

    Execute this command in `Frontend/` directory:

        $ npm run dev

1. By default, the frontend server is accessible at [`http://localhost:3000`](http://localhost:3000), and the backend server at [`http://localhost:80`](http://localhost:80).

    If the default ports are unavailable,
    check the effective port numbers in the outputs from previous steps.

## The iHereVanz Team (a.k.a. The 8th Team)

| #  | Name                         | Student ID | Email                |
| -- | :--------------------------- | :--------: | :------------------- |
| 1. | Salute Khumyunn              | 6410450273 | salute.k@ku.th       |
| 2. | Tanapat Bumrungthaiworakul   | 6410451016 | tanapat.bum@ku.th    |
| 3. | Panachai Kotchagason         | 6410450176 | panachai.ko@ku.th    |
| 4. | Witthawat Praphanwong        | 6410450265 | witthawat.pr@ku.th   |
| 5. | Thanadon Kritveeranant       | 6410450974 | thanadon.kr@ku.th    |
| 6. | Potsawat Thinkanwatthana     | 6410451199 | potsawat.t@ku.th     |
