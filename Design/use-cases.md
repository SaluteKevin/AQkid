# Use Cases

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
CREATE DATABASE IF NOT EXISTS aqkids;
USE aqkids;
SELECT DATABASE();
```

#### Create Tables

```sql
CREATE TABLE IF NOT EXISTS `users` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(32) UNIQUE NOT NULL,
    `password` VARCHAR(256) NOT NULL,
    `role` ENUM('STAFF', 'TEACHER', 'STUDENT') NOT NULL,
    `first_name` VARCHAR(32) NOT NULL,
    `middle_name` VARCHAR(32),
    `last_name` VARCHAR(32) NOT NULL,
    `birthdate` DATE NOT NULL,
    `phone_number` VARCHAR(16) NOT NULL,
    `email` VARCHAR(320),
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
    `status` ENUM('PENDING', 'OPEN', 'FULL', 'ACTIVE', 'ENDED') NOT NULL,
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


CREATE TABLE IF NOT EXISTS `timeslots` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `course_id` INT NOT NULL,
    `datetime` DATETIME NOT NULL,
    `created_at` TIMESTAMP NOT NULL,
    `updated_at` TIMESTAMP NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`)
);


CREATE TABLE IF NOT EXISTS `student_attendances` (
    `timeslot_id` INT NOT NULL,
    `student_id` INT NOT NULL,
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
+----+------------+------------------+---------+------------+-------------+-----------------+------------+--------------+---------------------------------------+-------------+-------------+
| id | username   | password         | role    | first_name | middle_name | last_name       | birthdate  | phone_number | email                                 | created_at  | updated_at  |
+----+------------+------------------+---------+------------+-------------+-----------------+------------+--------------+---------------------------------------+-------------+-------------+
|  1 | staff_01   | staff_password   | STAFF   | Salute     | NULL        | Khumyunn        | 1998-09-22 | 0998765432   | salute.k@staff.aqkids.example.com     | <TIMESTAMP> | <TIMESTAMP> |
|  2 | teacher_01 | teacher_password | TEACHER | Potsawat   | NULL        | Thinkanwatthana | 2000-01-01 | 0987654321   | potsawat.t@teacher.aqkids.example.com | <TIMESTAMP> | <TIMESTAMP> |
|  3 | teacher_02 | teacher_password | TEACHER | Jonathan   | NULL        | Thinkanwatthana | 2001-01-01 | 0987654321   | jonathan.t@teacher.aqkids.example.com | <TIMESTAMP> | <TIMESTAMP> |
|  4 | j.doe      | password         | STUDENT | John       | Linus       | Doe             | 2014-05-01 | 0123456789   | j.doe@example.com                     | <TIMESTAMP> | <TIMESTAMP> |
|  5 | a.seed     | password         | STUDENT | Apple      | NULL        | Seed            | 2014-08-21 | 0123456789   | a.seed@example.com                    | <TIMESTAMP> | <TIMESTAMP> |
|  6 | b.bird     | password         | STUDENT | Burden     | NULL        | Bird            | 1997-01-16 | 0987654321   | b.bird@example.com                    | <TIMESTAMP> | <TIMESTAMP> |
+----+------------+------------------+---------+------------+-------------+-----------------+------------+--------------+---------------------------------------+-------------+-------------+


SELECT * FROM `courses`;
+----+------------+----------+-------+----------+---------+---------+---------+-------------+-------------+
| id | teacher_id | title    | quota | capacity | min_age | max_age | status  | created_at  | updated_at  |
+----+------------+----------+-------+----------+---------+---------+---------+-------------+-------------+
|  1 |          2 | Tue 10am |    10 |        4 |       0 |       6 | PENDING | <TIMESTAMP> | <TIMESTAMP> |
|  2 |          3 | Wed 10am |    10 |        4 |       6 |      12 | OPEN    | <TIMESTAMP> | <TIMESTAMP> |
|  3 |          2 | Wed 16pm |    10 |        4 |      12 |      24 | OPEN    | <TIMESTAMP> | <TIMESTAMP> |
|  4 |       NULL | Thu 16pm |    10 |        4 |      12 |      24 | PENDING | <TIMESTAMP> | <TIMESTAMP> |
+----+------------+----------+-------+----------+---------+---------+---------+-------------+-------------+


SELECT * FROM `enrollments`;
+----+-----------+------------+---------+-------------+-------------+
| id | course_id | student_id | status  | created_at  | updated_at  |
+----+-----------+------------+---------+-------------+-------------+
|  1 |         2 |          4 | PENDING | <TIMESTAMP> | <TIMESTAMP> |
|  2 |         2 |          6 | PENDING | <TIMESTAMP> | <TIMESTAMP> |
+----+-----------+------------+---------+-------------+-------------+


SELECT * FROM `timeslots`;
+----+-----------+---------------------+-------------+-------------+
| id | course_id | datetime            | created_at  | updated_at  |
+----+-----------+---------------------+-------------+-------------+
|  1 |         2 | 2024-01-02 10:00:00 | <TIMESTAMP> | <TIMESTAMP> |
|  2 |         2 | 2024-01-09 10:00:00 | <TIMESTAMP> | <TIMESTAMP> |
|  3 |         2 | 2024-01-16 10:00:00 | <TIMESTAMP> | <TIMESTAMP> |
|  4 |         2 | 2024-01-23 10:00:00 | <TIMESTAMP> | <TIMESTAMP> |
|  5 |         2 | 2024-01-30 10:00:00 | <TIMESTAMP> | <TIMESTAMP> |
|  6 |         2 | 2024-02-06 10:00:00 | <TIMESTAMP> | <TIMESTAMP> |
|  7 |         2 | 2024-02-13 10:00:00 | <TIMESTAMP> | <TIMESTAMP> |
|  8 |         2 | 2024-02-20 10:00:00 | <TIMESTAMP> | <TIMESTAMP> |
|  9 |         2 | 2024-02-27 10:00:00 | <TIMESTAMP> | <TIMESTAMP> |
| 10 |         2 | 2024-03-05 10:00:00 | <TIMESTAMP> | <TIMESTAMP> |
+----+-----------+---------------------+-------------+-------------+


SELECT * FROM `teacher_attendances`;
+-------------+------------+
| timeslot_id | teacher_id |
+-------------+------------+
|           1 |          2 |
|           2 |          2 |
+-------------+------------+


SELECT * FROM `student_attendances`;
+-------------+------------+
| timeslot_id | student_id |
+-------------+------------+
|           1 |          4 |
|           1 |          6 |
|           2 |          4 |
|           2 |          6 |
+-------------+------------+
```

```sql
INSERT INTO `users` (`username`, `password`, `role`, `first_name`, `middle_name`, `last_name`, `birthdate`, `phone_number`, `email`, `created_at`, `updated_at`) VALUES
    ('staff_01', 'staff_password', 'STAFF', 'Salute', NULL, 'Khumyunn', '1998-09-22', '0998765432', 'salute.k@staff.aqkids.example.com', NOW(), NOW()),
    ('teacher_01', 'teacher_password', 'TEACHER', 'Potsawat', NULL, 'Thinkanwatthana', '2000-01-01', '0987654321', 'potsawat.t@teacher.aqkids.example.com', NOW(), NOW()),
    ('teacher_02', 'teacher_password', 'TEACHER', 'Jonathan', NULL, 'Thinkanwatthana', '2001-01-01', '0987654321', 'jonathan.t@teacher.aqkids.example.com', NOW(), NOW()),
    ('j.doe', 'password', 'STUDENT', 'John', 'Linus', 'Doe', '2014-05-01', '0123456789', 'j.doe@example.com', NOW(), NOW()),
    ('a.seed', 'password', 'STUDENT', 'Apple', NULL, 'Seed', '2014-08-21', '0123456789', 'a.seed@example.com', NOW(), NOW()),
    ('b.bird', 'password', 'STUDENT', 'Burden', NULL, 'Bird', '1997-01-16', '0987654321', 'b.bird@example.com', NOW(), NOW());


-- Teacher-assigned courses
INSERT INTO `courses` (`teacher_id`, `title`, `quota`, `capacity`, `min_age`, `max_age`, `status`, `created_at`, `updated_at`) VALUES
    (2, 'Tue 10am', 10, 4, 0, 6, 'PENDING', NOW(), NOW()),
    (3, 'Wed 10am', 10, 4, 6, 12, 'OPEN', NOW(), NOW()),
    (2, 'Wed 16pm', 10, 4, 12, 24, 'OPEN', NOW(), NOW());


-- Unassigned courses
INSERT INTO `courses` (`title`, `quota`, `capacity`, `min_age`, `max_age`, `status`, `created_at`, `updated_at`) VALUES
    ('Thu 16pm', 10, 4, 12, 24, 'PENDING', NOW(), NOW());


INSERT INTO `enrollments` (`course_id`, `student_id`, `status`, `created_at`, `updated_at`) VALUES
    (2, 4, 'PENDING', NOW(), NOW()),
    (2, 6, 'PENDING', NOW(), NOW());


INSERT INTO `timeslots` (`course_id`, `datetime`, `created_at`, `updated_at`) VALUES
    (2, '2024-01-02 10:00:00', NOW(), NOW()),
    (2, '2024-01-09 10:00:00', NOW(), NOW()),
    (2, '2024-01-16 10:00:00', NOW(), NOW()),
    (2, '2024-01-23 10:00:00', NOW(), NOW()),
    (2, '2024-01-30 10:00:00', NOW(), NOW()),
    (2, '2024-02-06 10:00:00', NOW(), NOW()),
    (2, '2024-02-13 10:00:00', NOW(), NOW()),
    (2, '2024-02-20 10:00:00', NOW(), NOW()),
    (2, '2024-02-27 10:00:00', NOW(), NOW()),
    (2, '2024-03-05 10:00:00', NOW(), NOW());


INSERT INTO `teacher_attendances` (`timeslot_id`, `teacher_id`) VALUES
    (1, 2),
    (2, 2);


INSERT INTO `student_attendances` (`timeslot_id`, `student_id`) VALUES
    (1, 4),
    (1, 6),
    (2, 4),
    (2, 6);
```

### Use-cases

1. สมัครเรียน

    > ข้อมูล:
    >
    >     SELECT `users`.*, `enrollments`.`id` AS `enrollment_id`, `enrollments`.`course_id`, `enrollments`.`status`, `enrollments`.`created_at`, `enrollments`.`updated_at` FROM `users` JOIN `enrollments` ON `users`.`id` = `enrollments`.`student_id` WHERE `username` = 'a.doe'\G
    >     *************************** 1. row ***************************
    >                  id: 7
    >            username: a.doe
    >            password: password
    >                role: STUDENT
    >          first_name: Alice
    >         middle_name: Linus
    >           last_name: Doe
    >           birthdate: 2016-05-02
    >        phone_number: 0123456789
    >               email: a.doe@example.com
    >          created_at: <CREATE_USER_TIMESTAMP>
    >          updated_at: <CREATE_USER_TIMESTAMP>
    >     enrollment_id: 4
    >           course_id: 3
    >              status: PENDING
    >          created_at: <enrollment_TIMESTAMP>
    >          updated_at: <enrollment_TIMESTAMP>

    ```sql
    INSERT INTO `users` (`username`, `password`, `role`, `first_name`, `middle_name`, `last_name`, `birthdate`, `phone_number`, `email`, `created_at`, `updated_at`) VALUES
        ('a.doe', 'password', 'STUDENT', 'Alice', 'Linus', 'Doe', '2016-05-02', '0123456789', 'a.doe@example.com', NOW(), NOW());

    INSERT INTO `enrollments` (`course_id`, `student_id`, `status`, `created_at`, `updated_at`)
        SELECT
            3 AS `course_id`,
            `id` AS `student_id`,
            'PENDING' AS `status`,
            NOW() AS `created_at`,
            NOW() AS `updated_at`
        FROM `users`
        WHERE `username` = 'a.doe';
    ```

1. สมัครสอน

    > ข้อมูล:
    > 
    >       SELECT * FROM `users` WHERE `username` = 'ingfosbreak'\G
    >       *************************** 1. row ***************************
    >                 id: 8
    >           username: ingfosbreak
    >           password: password
    >               role: TEACHER
    >         first_name: Panachai
    >        middle_name: NULL
    >          last_name: Kotchagason
    >          birthdate: 2000-10-10
    >       phone_number: 0123456789
    >              email: panachai.k@example.com
    >         created_at: <CREATE_USER_TIMESTAMP>
    >         updated_at: <CREATE_USER_TIMESTAMP>

    ```sql
    INSERT INTO `users` (`username`, `password`, `role`, `first_name`, `middle_name`, `last_name`, `birthdate`, `phone_number`, `email`, `created_at`, `updated_at`) VALUES
        ('ingfosbreak', 'password', 'TEACHER', 'Panachai', NULL, 'Kotchagason', '2000-10-10', '0123456789', 'panachai.k@example.com', NOW(), NOW());
    ```

1. จัดคาบเรียน

    ```sql
    INSERT INTO `timeslots` (`course_id`, `datetime`, `created_at`, `updated_at`) VALUES
        (2, '2024-01-02 16:00:00', NOW(), NOW()),
        (2, '2024-01-09 16:00:00', NOW(), NOW()),
        (2, '2024-01-16 16:00:00', NOW(), NOW()),
        (2, '2024-01-23 16:00:00', NOW(), NOW()),
        (2, '2024-01-30 16:00:00', NOW(), NOW()),
        (2, '2024-02-06 16:00:00', NOW(), NOW()),
        (2, '2024-02-13 16:00:00', NOW(), NOW()),
        (2, '2024-02-20 16:00:00', NOW(), NOW()),
        (2, '2024-02-27 16:00:00', NOW(), NOW()),
        (2, '2024-03-05 16:00:00', NOW(), NOW());
    ```

1. รับผิดชอบ

    > ข้อมูล:
    > 
    >       SELECT `courses`.*, `users`.`username`, `users`.`first_name`, `users`.`middle_name`, `users`.`last_name` FROM `courses` JOIN `users` ON `courses`.`teacher_id` = `users`.`id` WHERE `courses`.`id` = 4\G
    >       *************************** 1. row ***************************
    >                id: 4
    >        teacher_id: 2
    >             title: Thu 16pm
    >             quota: 10
    >          capacity: 4
    >           min_age: 12
    >           max_age: 24
    >            status: PENDING
    >        created_at: 2023-10-02 15:12:55
    >        updated_at: 2023-10-02 16:07:20
    >          username: teacher_01
    >        first_name: Potsawat
    >       middle_name: NULL
    >         last_name: Thinkanwatthana

    ```sql
    UPDATE `courses`
    SET
        `teacher_id` = 2,
        `updated_at` = NOW()
    WHERE `id` = 4
        AND `teacher_id` IS NULL;
    ```

1. เข้าเรียน

    ```sql
    INSERT INTO `student_attendances` (`timeslot_id`, `student_id`) VALUES
        (10, 7);
    ```

1. เข้าสอน

    ```sql
    INSERT INTO `teacher_attendances` (`timeslot_id`, `teacher_id`) VALUES
        (10, 3);
    ```

1. จัดคาบเรียนเสริม

    ```sql
    INSERT INTO `timeslots` (`course_id`, `datetime`, `created_at`, `updated_at`) VALUES
        (3, '2024-03-12 16:00:00', NOW(), NOW());
    ```

1. ปิดคอร์ส

    ```sql
    UPDATE `courses` SET `status` = 'ENDED' WHERE `id` = 2;
    ```
