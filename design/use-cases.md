# Use Cases

> **View here**: [drive.google.com](https://drive.google.com/file/d/1-V1iuZ-0zowCvWPI4HrAgITMV52NFIK2/view?usp=sharing)

1. สมัครเรียน
1. สมัครสอน
1. จัดคาบเรียน
1. รับผิดชอบ
1. เข้าเรียน
1. เข้าสอน
1. จัดคาบเรียนเสริม
1. ปิดคอร์ส

## Queries

MySQL queries for initializing and manipulating data

`TIMESTAMP` type format `$ date "+%Y-%m-%d %H:%M:%S"`

### Initialization

#### Create Database

```sql
CREATE DATABASE IF NOT EXISTS `aqkids`;
USE `aqkids`;
SELECT DATABASE();
```

#### Create Tables

```sql
CREATE TABLE IF NOT EXISTS `users` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(255) UNIQUE NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `role` ENUM('STAFF', 'TEACHER', 'STUDENT') NOT NULL,
    `first_name` VARCHAR(255) NOT NULL,
    `middle_name` VARCHAR(255),
    `last_name` VARCHAR(255) NOT NULL,
    `birthdate` DATE NOT NULL,
    `phone_number` VARCHAR(16) NOT NULL,
    `email` VARCHAR(320),
    `email_verified_at` TIMESTAMP NULL DEFAULT NULL,
    `profile_image_path` VARCHAR(260) NOT NULL,
    `remember_token` VARCHAR(100) DEFAULT NULL,
    `created_at` TIMESTAMP NOT NULL,
    `updated_at` TIMESTAMP NOT NULL,
    PRIMARY KEY (`id`)
);


CREATE TABLE IF NOT EXISTS `courses` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `teacher_id` INT,
    `title` VARCHAR(128) NOT NULL,
    `quota` INT NOT NULL,
    `capacity` INT NOT NULL,
    `min_age` INT DEFAULT 0,
    `max_age` INT,
    `duration` INT NOT NULL DEFAULT 60,
    `opens_until` DATETIME NOT NULL,
    `start_datetime` DATETIME NOT NULL,
    `status` ENUM('PENDING', 'OPEN', 'FULL', 'ACTIVE', 'ENDED', 'CANCELLED') NOT NULL,
    `price` FLOAT NOT NULL,
    `created_at` TIMESTAMP NOT NULL,
    `updated_at` TIMESTAMP NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`)
);


CREATE TABLE IF NOT EXISTS `enrollments` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `course_id` INT NOT NULL,
    `student_id` INT NOT NULL,
    `status` ENUM('PENDING', 'SUCCESS', 'FAILED') NOT NULL,
    `created_at` TIMESTAMP NOT NULL,
    `updated_at` TIMESTAMP NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
    FOREIGN KEY (`student_id`) REFERENCES `users` (`id`)
);


CREATE TABLE IF NOT EXISTS `receipts` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `enrollment_id` INT,
    `payment_timestamp` TIMESTAMP NOT NULL,
    `receipt_timestamp` TIMESTAMP NOT NULL,
    `description` VARCHAR(1000) NOT NULL,
    `amount` FLOAT NOT NULL,
    `subtotal` FLOAT NOT NULL,
    `total` FLOAT NOT NULL,
    `created_at` TIMESTAMP NOT NULL,
    `updated_at` TIMESTAMP NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`enrollment_id`) REFERENCES `enrollments` (`id`)
);


CREATE TABLE IF NOT EXISTS `timeslots` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `course_id` INT NOT NULL,
    `datetime` DATETIME NOT NULL,
    `type` ENUM('REGULAR', 'MAKEUP', 'UNDEFINED') NOT NULL DEFAULT 'UNDEFINED',
    `created_at` TIMESTAMP NOT NULL,
    `updated_at` TIMESTAMP NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`)
);


CREATE TABLE IF NOT EXISTS `student_attendances` (
    `timeslot_id` INT NOT NULL,
    `student_id` INT NOT NULL,
    `has_attended` ENUM('TRUE', 'FALSE') NOT NULL DEFAULT 'FALSE',
    FOREIGN KEY (`timeslot_id`) REFERENCES `timeslots` (`id`),
    FOREIGN KEY (`student_id`) REFERENCES `users` (`id`)
);


CREATE TABLE IF NOT EXISTS `teacher_attendances` (
    `timeslot_id` INT NOT NULL,
    `teacher_id` INT NOT NULL,
    FOREIGN KEY (`timeslot_id`) REFERENCES `timeslots` (`id`),
    FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`)
);
```

#### Seeding

The following queries initializes tables with demo records.

##### Tables

```txt
SELECT * FROM `user`;
+----+------------+--------------------------------------------------------------+---------+------------+-------------+-----------------+------------+--------------+-------------------------------------+-------+-------------------+----------------+---------------------+---------------------+
| id | username   | password                                                     | role    | first_name | middle_name | last_name       | birthdate  | phone_number | profile_image_path                  | email | email_verified_at | remember_token | created_at          | updated_at          |
+----+------------+--------------------------------------------------------------+---------+------------+-------------+-----------------+------------+--------------+-------------------------------------+-------+-------------------+----------------+---------------------+---------------------+
|  1 | staff_01   | <HASH_OF "staff_password">                                   | STAFF   | Salute     | NULL        | Khumyunn        | 1998-09-22 | 0988765432   | assets/_defaults/profile_image.png  | NULL  | NULL              | NULL           | 2022-11-28 08:00:00 | 2022-11-28 08:00:00 |
|  2 | teacher_01 | <HASH_OF "teacher_password">                                 | TEACHER | Potsawat   | NULL        | Thinkanwatthana | 2000-01-01 | 0987654321   | assets/teacher_01/profile_image.png | NULL  | NULL              | NULL           | 2022-11-29 08:00:00 | 2022-11-29 08:00:00 |
|  3 | teacher_02 | <HASH_OF "teacher_password">                                 | TEACHER | Jonathan   | NULL        | Thinkanwatthana | 2001-01-01 | 0897654321   | assets/teacher_02/profile_image.png | NULL  | NULL              | NULL           | 2022-11-29 09:00:00 | 2022-11-29 09:00:00 |
|  4 | j.doe      | <HASH_OF "password">                                         | STUDENT | John       | Linus       | Doe             | 2014-05-01 | 0123456789   | assets/j.doe/profile_image.png      | NULL  | NULL              | NULL           | 2022-12-07 09:00:00 | 2022-12-07 09:00:00 |
|  5 | a.seed     | <HASH_OF "password">                                         | STUDENT | Apple      | NULL        | Seed            | 2014-08-21 | 0123457689   | assets/a.seed/profile_image.png     | NULL  | NULL              | NULL           | 2022-12-07 09:40:00 | 2022-12-07 09:40:00 |
|  6 | b.bird     | <HASH_OF "password">                                         | STUDENT | Burden     | NULL        | Bird            | 1997-01-16 | 0123457698   | assets/b.bird/profile_image.png     | NULL  | NULL              | NULL           | 2022-12-07 09:55:00 | 2022-12-07 09:55:00 |
+----+------------+--------------------------------------------------------------+---------+------------+-------------+-----------------+------------+--------------+-------------------------------------+-------+-------------------+----------------+---------------------+---------------------+


SELECT * FROM `courses`;
+----+------------+----------+-------+----------+---------+---------+----------+---------------------+---------------------+-----------+-------+---------------------+---------------------+
| id | teacher_id | title    | quota | capacity | min_age | max_age | duration | opens_until         | start_datetime      | status    | price | created_at          | updated_at          |
+----+------------+----------+-------+----------+---------+---------+----------+---------------------+---------------------+-----------+-------+---------------------+---------------------+
|  1 |          2 | Tue 10am |    10 |        4 |       0 |       6 |       60 | 2023-01-03 10:00:00 | 2023-01-03 10:00:00 | CANCELLED |  7500 | 2022-12-05 08:00:00 | 2023-01-03 10:00:00 |
|  2 |          3 | Wed 10am |    10 |        4 |       6 |      12 |       60 | 2023-01-04 10:00:00 | 2023-01-04 10:00:00 | ENDED     |  7500 | 2022-12-05 08:05:00 | 2023-03-08 11:00:00 |
|  3 |          2 | Wed 4pm  |    10 |        4 |      12 |      24 |       60 | 2024-01-03 16:00:00 | 2024-01-03 16:00:00 | OPEN      |  7500 | 2023-10-02 08:10:00 | 2023-10-02 08:10:00 |
+----+------------+----------+-------+----------+---------+---------+----------+---------------------+---------------------+-----------+-------+---------------------+---------------------+


SELECT * FROM `enrollments`;
+----+-----------+------------+---------+---------------------+---------------------+
| id | course_id | student_id | status  | created_at          | updated_at          |
+----+-----------+------------+---------+---------------------+---------------------+
|  1 |         2 |          4 | SUCCESS | 2022-12-07 09:10:00 | 2022-12-08 09:00:00 |
|  2 |         2 |          6 | SUCCESS | 2022-12-07 10:05:00 | 2022-12-08 09:02:00 |
+----+-----------+------------+---------+---------------------+---------------------+


SELECT * FROM `receipts`;
+----+---------------+---------------------+---------------------+-------------+--------+----------+-------+---------------------+---------------------+
| id | enrollment_id | payment_timestamp   | receipt_timestamp   | description | amount | subtotal | total | created_at          | updated_at          |
+----+---------------+---------------------+---------------------+-------------+--------+----------+-------+---------------------+---------------------+
|  1 |             1 | 2022-12-07 09:10:00 | 2022-12-08 09:00:00 | Course fee  |   7500 |     7500 |  7500 | 2022-12-08 09:00:00 | 2022-12-08 09:00:00 |
|  2 |             2 | 2022-12-07 10:05:00 | 2022-12-08 09:02:00 | Course fee  |   7500 |     7500 |  7500 | 2022-12-08 09:02:00 | 2022-12-08 09:02:00 |
+----+---------------+---------------------+---------------------+-------------+--------+----------+-------+---------------------+---------------------+


SELECT * FROM `timeslots`;
+----+-----------+---------------------+---------+---------------------+---------------------+
| id | course_id | datetime            | type    | created_at          | updated_at          |
+----+-----------+---------------------+---------+---------------------+---------------------+
|  1 |         2 | 2023-01-04 10:00:00 | REGULAR | 2022-12-05 08:05:00 | 2022-12-05 08:05:00 |
|  2 |         2 | 2023-01-11 10:00:00 | REGULAR | 2022-12-05 08:05:00 | 2022-12-05 08:05:00 |
|  3 |         2 | 2023-01-18 10:00:00 | REGULAR | 2022-12-05 08:05:00 | 2022-12-05 08:05:00 |
|  4 |         2 | 2023-01-25 10:00:00 | REGULAR | 2022-12-05 08:05:00 | 2022-12-05 08:05:00 |
|  5 |         2 | 2023-02-01 10:00:00 | REGULAR | 2022-12-05 08:05:00 | 2022-12-05 08:05:00 |
|  6 |         2 | 2023-02-08 10:00:00 | REGULAR | 2022-12-05 08:05:00 | 2022-12-05 08:05:00 |
|  7 |         2 | 2023-02-15 10:00:00 | REGULAR | 2022-12-05 08:05:00 | 2022-12-05 08:05:00 |
|  8 |         2 | 2023-02-22 10:00:00 | REGULAR | 2022-12-05 08:05:00 | 2022-12-05 08:05:00 |
|  9 |         2 | 2023-03-01 10:00:00 | REGULAR | 2022-12-05 08:05:00 | 2022-12-05 08:05:00 |
| 10 |         2 | 2023-03-08 10:00:00 | REGULAR | 2022-12-05 08:05:00 | 2022-12-05 08:05:00 |
| 11 |         2 | 2023-03-15 10:00:00 | MAKEUP  | 2023-03-01 10:00:00 | 2023-03-01 10:00:00 |
| 12 |         3 | 2024-01-03 16:00:00 | REGULAR | 2023-10-02 08:10:00 | 2023-10-02 08:10:00 |
| 13 |         3 | 2024-01-10 16:00:00 | REGULAR | 2023-10-02 08:10:00 | 2023-10-02 08:10:00 |
| 14 |         3 | 2024-01-17 16:00:00 | REGULAR | 2023-10-02 08:10:00 | 2023-10-02 08:10:00 |
| 15 |         3 | 2024-01-24 16:00:00 | REGULAR | 2023-10-02 08:10:00 | 2023-10-02 08:10:00 |
| 16 |         3 | 2024-01-31 16:00:00 | REGULAR | 2023-10-02 08:10:00 | 2023-10-02 08:10:00 |
| 17 |         3 | 2024-02-07 16:00:00 | REGULAR | 2023-10-02 08:10:00 | 2023-10-02 08:10:00 |
| 18 |         3 | 2024-02-14 16:00:00 | REGULAR | 2023-10-02 08:10:00 | 2023-10-02 08:10:00 |
| 19 |         3 | 2024-02-21 16:00:00 | REGULAR | 2023-10-02 08:10:00 | 2023-10-02 08:10:00 |
| 20 |         3 | 2024-02-28 16:00:00 | REGULAR | 2023-10-02 08:10:00 | 2023-10-02 08:10:00 |
| 21 |         3 | 2024-03-06 16:00:00 | REGULAR | 2023-10-02 08:10:00 | 2023-10-02 08:10:00 |
+----+-----------+---------------------+---------+---------------------+---------------------+


SELECT * FROM `teacher_attendances`;
+-------------+------------+
| timeslot_id | teacher_id |
+-------------+------------+
|           1 |          2 |
|           2 |          2 |
|           3 |          2 |
|           4 |          2 |
|           5 |          2 |
|           6 |          2 |
|           7 |          2 |
|           8 |          2 |
|           9 |          2 |
|          10 |          2 |
|          11 |          2 |
+-------------+------------+


SELECT * FROM `student_attendances`;
+-------------+------------+--------------+
| timeslot_id | student_id | has_attended |
+-------------+------------+--------------+
|           1 |          4 | TRUE         |
|           1 |          6 | TRUE         |
|           2 |          4 | TRUE         |
|           2 |          6 | TRUE         |
|           3 |          4 | TRUE         |
|           3 |          6 | TRUE         |
|           4 |          4 | TRUE         |
|           4 |          6 | TRUE         |
|           5 |          4 | TRUE         |
|           5 |          6 | TRUE         |
|           6 |          4 | TRUE         |
|           6 |          6 | TRUE         |
|           7 |          4 | TRUE         |
|           7 |          6 | TRUE         |
|           8 |          4 | TRUE         |
|           8 |          6 | TRUE         |
|           9 |          4 | TRUE         |
|           9 |          6 | TRUE         |
|          10 |          4 | FALSE        |
|          10 |          6 | TRUE         |
|          11 |          4 | TRUE         |
+-------------+------------+--------------+
```

```sql
INSERT INTO `users` (`username`, `password`, `role`, `first_name`, `middle_name`, `last_name`, `birthdate`, `phone_number`, `email`, `profile_image_path`, `created_at`, `updated_at`) VALUES
    ('staff_01', 'staff_password', 'STAFF', 'Salute', NULL, 'Khumyunn', '1998-09-22', '0998765432', 'salute.k@staff.aqkids.example.com', 'assets/staff_01/profile_image.png', '2022-11-28 08:00:00','2022-11-28 08:00:00'),
    ('teacher_01', 'teacher_password', 'TEACHER', 'Potsawat', NULL, 'Thinkanwatthana', '2000-01-01', '0987654321', 'potsawat.t@teacher.aqkids.example.com', 'assets/teacher_01/profile_image.png', '2022-11-29 08:00:00','2022-11-29 08:00:00'),
    ('teacher_02', 'teacher_password', 'TEACHER', 'Jonathan', NULL, 'Thinkanwatthana', '2001-01-01', '0987654321', 'jonathan.t@teacher.aqkids.example.com', 'assets/teacher_02/profile_image.png', '2022-11-29 09:00:00','2022-11-29 09:00:00'),
    ('j.doe', 'password', 'STUDENT', 'John', 'Linus', 'Doe', '2014-05-01', '0123456789', 'j.doe@example.com', 'assets/j.doe/profile_image.png', '2022-12-07 09:00:00','2022-12-07 09:00:00'),
    ('a.seed', 'password', 'STUDENT', 'Apple', NULL, 'Seed', '2014-08-21', '0123456789', 'a.seed@example.com', 'assets/a.seed/profile_image.png', '2022-12-07 09:40:00','2022-12-07 09:40:00'),
    ('b.bird', 'password', 'STUDENT', 'Burden', NULL, 'Bird', '1997-01-16', '0987654321', 'b.bird@example.com', 'assets/b.bird/profile_image.png', '2022-12-07 09:55:00','2022-12-07 09:55:00');


INSERT INTO `courses` (`teacher_id`, `title`, `quota`, `capacity`, `min_age`, `max_age`, `duration`, `opens_until`, `start_datetime`, `status`, `price`, `created_at`, `updated_at`) VALUES
    (2, 'Tue 10am', 10, 4, 0, 6, 60, '2023-01-03 10:00:00', '2023-01-03 10:00:00', 'CANCELLED', 7500.00, '2022-12-05 08:00:00', '2023-01-03 10:00:00'),
    (3, 'Wed 10am', 10, 4, 6, 12, 60, '2023-01-04 10:00:00', '2023-01-04 10:00:00', 'ENDED', 7500.00, '2022-12-05 08:05:00', '2023-03-08 11:00:00'),
    (2, 'Wed 4pm', 10, 4, 12, 24, 60, '2024-01-03 16:00:00', '2024-01-03 16:00:00', 'OPEN', 7500.00, '2023-10-02 08:10:00', '2023-10-02 08:10:00');


INSERT INTO `enrollments` (`course_id`, `student_id`, `status`, `created_at`, `updated_at`) VALUES
    (2, 4, 'SUCCESS', '2022-12-07 09:10:00', '2022-12-08 09:00:00'),
    (2, 6, 'SUCCESS', '2022-12-07 10:05:00', '2022-12-08 09:02:00');


INSERT INTO `receipts` (`enrollment_id`, `payment_timestamp`, `receipt_timestamp`, `description`, `amount`, `subtotal`, `total`, `created_at`, `updated_at`) VALUES
    (1, '2022-12-07 09:10:00', '2022-12-08 09:00:00', 'Course fee', 7500.00, 7500.00, 7500.00, '2022-12-08 09:00:00', '2022-12-08 09:00:00'),
    (2, '2022-12-07 10:05:00', '2022-12-08 09:02:00', 'Course fee', 7500.00, 7500.00, 7500.00, '2022-12-08 09:02:00', '2022-12-08 09:02:00');


INSERT INTO `timeslots` (`course_id`, `datetime`, `type`, `created_at`, `updated_at`) VALUES
    (2, '2023-01-04 10:00:00', 'REGULAR', '2022-12-05 08:05:00', '2022-12-05 08:05:00'),
    (2, '2023-01-11 10:00:00', 'REGULAR', '2022-12-05 08:05:00', '2022-12-05 08:05:00'),
    (2, '2023-01-18 10:00:00', 'REGULAR', '2022-12-05 08:05:00', '2022-12-05 08:05:00'),
    (2, '2023-01-25 10:00:00', 'REGULAR', '2022-12-05 08:05:00', '2022-12-05 08:05:00'),
    (2, '2023-02-01 10:00:00', 'REGULAR', '2022-12-05 08:05:00', '2022-12-05 08:05:00'),
    (2, '2023-02-08 10:00:00', 'REGULAR', '2022-12-05 08:05:00', '2022-12-05 08:05:00'),
    (2, '2023-02-15 10:00:00', 'REGULAR', '2022-12-05 08:05:00', '2022-12-05 08:05:00'),
    (2, '2023-02-22 10:00:00', 'REGULAR', '2022-12-05 08:05:00', '2022-12-05 08:05:00'),
    (2, '2023-03-01 10:00:00', 'REGULAR', '2022-12-05 08:05:00', '2022-12-05 08:05:00'),
    (2, '2023-03-08 10:00:00', 'REGULAR', '2022-12-05 08:05:00', '2022-12-05 08:05:00'),
    (2, '2023-03-15 10:00:00', 'MAKEUP', '2023-03-01 10:00:00', '2023-03-01 10:00:00'),
    (3, '2024-01-03 16:00:00', 'REGULAR', '2023-10-02 08:10:00', '2023-10-02 08:10:00'),
    (3, '2024-01-10 16:00:00', 'REGULAR', '2023-10-02 08:10:00', '2023-10-02 08:10:00'),
    (3, '2024-01-17 16:00:00', 'REGULAR', '2023-10-02 08:10:00', '2023-10-02 08:10:00'),
    (3, '2024-01-24 16:00:00', 'REGULAR', '2023-10-02 08:10:00', '2023-10-02 08:10:00'),
    (3, '2024-01-31 16:00:00', 'REGULAR', '2023-10-02 08:10:00', '2023-10-02 08:10:00'),
    (3, '2024-02-07 16:00:00', 'REGULAR', '2023-10-02 08:10:00', '2023-10-02 08:10:00'),
    (3, '2024-02-14 16:00:00', 'REGULAR', '2023-10-02 08:10:00', '2023-10-02 08:10:00'),
    (3, '2024-02-21 16:00:00', 'REGULAR', '2023-10-02 08:10:00', '2023-10-02 08:10:00'),
    (3, '2024-02-28 16:00:00', 'REGULAR', '2023-10-02 08:10:00', '2023-10-02 08:10:00'),
    (3, '2024-03-06 16:00:00', 'REGULAR', '2023-10-02 08:10:00', '2023-10-02 08:10:00');


INSERT INTO `teacher_attendances` (`timeslot_id`, `teacher_id`) VALUES
    (1, 2),
    (2, 2);


INSERT INTO `student_attendances` (`timeslot_id`, `student_id`, `has_attended`) VALUES
    (1, 4, 'TRUE'),
    (1, 6, 'TRUE'),
    (2, 4, 'TRUE'),
    (2, 6, 'TRUE'),
    (3, 4, 'TRUE'),
    (3, 6, 'TRUE'),
    (4, 4, 'TRUE'),
    (4, 6, 'TRUE'),
    (5, 4, 'TRUE'),
    (5, 6, 'TRUE'),
    (6, 4, 'TRUE'),
    (6, 6, 'TRUE'),
    (7, 4, 'TRUE'),
    (7, 6, 'TRUE'),
    (8, 4, 'TRUE'),
    (8, 6, 'TRUE'),
    (9, 4, 'TRUE'),
    (9, 6, 'TRUE'),
    (10, 4, 'FALSE'),
    (10, 6, 'TRUE'),
    (11, 4, 'TRUE');
```

### Use-cases

1. สมัครเรียน
    ```sql
    INSERT INTO `users` (`username`, `password`, `role`, `first_name`, `middle_name`, `last_name`, `birthdate`, `phone_number`, `email`, `profile_image_path`, `created_at`, `updated_at`) VALUES
        ('a.doe', 'password', 'STUDENT', 'Alice', 'Linus', 'Doe', '2016-05-02', '0123456789', 'a.doe@example.com', 'assets/a.doe/profile_image.png','2023-11-02 10:10:00','2023-11-02 10:10:00');

    INSERT INTO `enrollments` (`course_id`, `student_id`, `status`, `created_at`, `updated_at`)
        SELECT
            3 AS `course_id`,
            `id` AS `student_id`,
            'PENDING' AS `status`,
            '2023-11-02 10:10:00' AS `created_at`,
            '2023-11-02 10:10:00' AS `updated_at`
        FROM `users`
        WHERE `username` = 'a.doe';
    ```

1. สมัครสอน
    ```sql
    INSERT INTO `users` (`username`, `password`, `role`, `first_name`, `middle_name`, `last_name`, `birthdate`, `phone_number`, `email`, `profile_image_path`, `created_at`, `updated_at`) VALUES
        ('ingfosbreak', 'password', 'TEACHER', 'Panachai', NULL, 'Kotchagason', '2000-10-10', '0123456789', 'panachai.k@example.com', 'assets/ingfosbreak/profile_image.png', NOW(), NOW());
    ```

1. จัดคาบเรียน

    ```sql
    INSERT INTO `timeslots` (`course_id`, `datetime`, `type`, `created_at`, `updated_at`) VALUES
        (3, '2024-01-03 16:00:00', 'REGULAR', NOW(), NOW()),
        (3, '2024-01-10 16:00:00', 'REGULAR', NOW(), NOW()),
        (3, '2024-01-17 16:00:00', 'REGULAR', NOW(), NOW()),
        (3, '2024-01-24 16:00:00', 'REGULAR', NOW(), NOW()),
        (3, '2024-01-31 16:00:00', 'REGULAR', NOW(), NOW()),
        (3, '2024-02-07 16:00:00', 'REGULAR', NOW(), NOW()),
        (3, '2024-02-14 16:00:00', 'REGULAR', NOW(), NOW()),
        (3, '2024-02-21 16:00:00', 'REGULAR', NOW(), NOW()),
        (3, '2024-02-28 16:00:00', 'REGULAR', NOW(), NOW()),
        (3, '2024-03-06 16:00:00', 'REGULAR', NOW(), NOW());

    ```

1. รับผิดชอบ

    ```sql
    UPDATE `courses`
    SET
        `teacher_id` = 2,
        `updated_at` = NOW()
    WHERE `id` = 3
        AND `teacher_id` IS NULL;
    ```

1. เข้าเรียน

    ```sql
    UPDATE `student_attendances`
    SET `has_attended` = 'TRUE'
    WHERE `timeslot_id` = 11
        AND `student_id` = 4;
    ```

1. เข้าสอน

    ```sql
    INSERT INTO `teacher_attendances` (`timeslot_id`, `teacher_id`) VALUES
        (10, 3);
    ```

1. จัดคาบเรียนเสริม

    ```sql
    INSERT INTO `timeslots` (`course_id`, `datetime`, `type`, `created_at`, `updated_at`) VALUES
        (3, '2024-03-13 16:00:00', 'MAKEUP', NOW(), NOW());
    ```

1. ปิดคอร์ส

    ```sql
    UPDATE `courses`
    SET `status` = 'CANCELLED'
    WHERE `id` = 3;
    ```
