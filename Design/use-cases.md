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
    `teacher_id` INT NOT NULL,
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


CREATE TABLE IF NOT EXISTS `registrations` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `course_id` INT NOT NULL,
    `student_id` INT NOT NULL,
    `status` ENUM('PENDING', 'APPROVED', 'REJECTED') NOT NULL,
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


CREATE TABLE IF NOT EXISTS `attendances` (
    `timeslot_id` INT NOT NULL,
    `student_id` INT NOT NULL,
    FOREIGN KEY (`timeslot_id`) REFERENCES `timeslots` (`id`),
    FOREIGN KEY (`student_id`) REFERENCES `users` (`id`)
);
```


### Seeding

```sql
INSERT INTO `users` (`username`, `password`, `role`, `first_name`, `middle_name`, `last_name`, `birthdate`, `phone_number`, `email`, `created_at`, `updated_at`) VALUES
    ('staff_01', 'staff_password', 'STAFF', 'Salute', NULL, 'Khumyunn', '1998-09-22', '0998765432', 'salute.k@staff.aqkids.example.com', '2023-09-24 19:22:31', '2023-09-24 19:22:31'),
    ('teacher_01', 'teacher_password', 'TEACHER', 'Potsawat', NULL, 'Thinkanwatthana', '2000-01-01', '0987654321', 'potsawat.t@teacher.aqkids.example.com', '2023-09-25 20:36:12', '2023-09-25 20:36:12'),
    ('teacher_02', 'teacher_password', 'TEACHER', 'Jonathan', NULL, 'Thinkanwatthana', '2001-01-01', '0987654321', 'jonathan.t@teacher.aqkids.example.com', '2023-09-26 15:33:44', '2023-09-26 15:33:44'),
    ('j.doe', 'password', 'STUDENT', 'John', 'Linus', 'Doe', '2014-05-01', '0123456789', 'j.doe@example.com', '2023-09-26 11:48:55', '2023-09-26 11:48:55'),
    ('a.seed', 'password', 'STUDENT', 'Apple', NULL, 'Seed', '2014-08-21', '0123456789', 'a.seed@example.com', '2023-09-27 11:48:55', '2023-09-27 11:48:55'),
    ('b.bird', 'password', 'STUDENT', 'Burden', NULL, 'Bird', '1997-01-16', '0987654321', 'b.bird@example.com', '2023-10-31 11:48:55', '2023-10-31 11:48:55');


INSERT INTO `courses` (`teacher_id`, `title`, `quota`, `capacity`, `min_age`, `max_age`, `status`, `created_at`, `updated_at`) VALUES
    (2, 'Tue 10am', 10, 4, 0, 6, 'PENDING', '2023-09-26 15:31:33', '2023-09-26 15:31:33'),
    (3, 'Wed 10am', 10, 4, 6, 12, 'OPEN', '2023-09-26 15:41:00', '2023-09-26 15:41:00'),
    (2, 'Wed 16pm', 10, 4, 12, 24, 'OPEN', '2023-09-26 16:06:43', '2023-09-26 16:06:43');


INSERT INTO `registrations` (`course_id`, `student_id`, `status`, `created_at`, `updated_at`) VALUES
    (2, 4, 'PENDING', '2023-09-26 15:50:00', '2023-09-26 15:50:00'),
    (2, 6, 'PENDING', '2023-09-26 16:23:00', '2023-09-26 16:23:00');


INSERT INTO `timeslots` (`course_id`, `datetime`, `created_at`, `updated_at`) VALUES
    (2, '2024-01-02 10:00:00', '2023-09-26 15:41:00', '2023-09-26 15:41:00'),
    (2, '2024-01-09 10:00:00', '2023-09-26 15:41:00', '2023-09-26 15:41:00'),
    (2, '2024-01-16 10:00:00', '2023-09-26 15:41:00', '2023-09-26 15:41:00'),
    (2, '2024-01-23 10:00:00', '2023-09-26 15:41:00', '2023-09-26 15:41:00'),
    (2, '2024-01-30 10:00:00', '2023-09-26 15:41:00', '2023-09-26 15:41:00'),
    (2, '2024-02-06 10:00:00', '2023-09-26 15:41:00', '2023-09-26 15:41:00'),
    (2, '2024-02-13 10:00:00', '2023-09-26 15:41:00', '2023-09-26 15:41:00'),
    (2, '2024-02-20 10:00:00', '2023-09-26 15:41:00', '2023-09-26 15:41:00'),
    (2, '2024-02-27 10:00:00', '2023-09-26 15:41:00', '2023-09-26 15:41:00'),
    (2, '2024-03-05 10:00:00', '2023-09-26 15:41:00', '2023-09-26 15:41:00');


INSERT INTO `attendances` (`timeslot_id`, `student_id`) VALUES
    (1, 4),
    (1, 6),
    (2, 4),
    (2, 6);
```


### Use-cases


1. สมัครเรียน

    ```sql
    INSERT INTO `users` (`username`, `password`, `role`, `first_name`, `middle_name`, `last_name`, `birthdate`, `phone_number`, `email`, `created_at`, `updated_at`) VALUES
        ('a.doe', 'password', 'STUDENT', 'Alice', 'Linus', 'Doe', '2016-05-02', '0123456789', 'a.doe@example.com', '2023-09-26 11:59:51', '2023-09-26 11:59:51');

    INSERT INTO `registrations` (`course_id`, `student_id`, `status`, `created_at`, `updated_at`) VALUES
        (3, 4, 'PENDING', '2023-09-26 15:50:00', '2023-09-26 15:50:00');
    ```

1. สมัครสอน

    ```sql
    INSERT INTO `users` (`username`, `password`, `role`, `first_name`, `middle_name`, `last_name`, `birthdate`, `phone_number`, `email`, `created_at`, `updated_at`) VALUES
        ('ingfosbreak', 'password', 'TEACHER', 'Panachai', NULL, 'Kotchagason', '2000-10-10', '0123456789', 'panachai.k@example.com', '2023-09-26 13:25:48', '2023-09-26 13:25:48');
    ```

1. จัดคาบเรียน

    ```sql
    INSERT INTO `timeslots` (`course_id`, `datetime`, `created_at`, `updated_at`) VALUES
        (2, '2024-01-02 16:00:00', '2023-09-26 15:41:00', '2023-09-26 15:41:00'),
        (2, '2024-01-09 16:00:00', '2023-09-26 15:41:00', '2023-09-26 15:41:00'),
        (2, '2024-01-16 16:00:00', '2023-09-26 15:41:00', '2023-09-26 15:41:00'),
        (2, '2024-01-23 16:00:00', '2023-09-26 15:41:00', '2023-09-26 15:41:00'),
        (2, '2024-01-30 16:00:00', '2023-09-26 15:41:00', '2023-09-26 15:41:00'),
        (2, '2024-02-06 16:00:00', '2023-09-26 15:41:00', '2023-09-26 15:41:00'),
        (2, '2024-02-13 16:00:00', '2023-09-26 15:41:00', '2023-09-26 15:41:00'),
        (2, '2024-02-20 16:00:00', '2023-09-26 15:41:00', '2023-09-26 15:41:00'),
        (2, '2024-02-27 16:00:00', '2023-09-26 15:41:00', '2023-09-26 15:41:00'),
        (2, '2024-03-05 16:00:00', '2023-09-26 15:41:00', '2023-09-26 15:41:00');
    ```

1. รับผิดชอบ

    ```sql
    ```

1. เข้าเรียน

    ```sql
    INSERT INTO `attendances` (`timeslot_id`, `student_id`) VALUES
        (11, 7);
    ```

1. เข้าสอน

    ```sql
    ```

1. จัดคาบเรียนเสริม

    ```sql
    INSERT INTO `timeslots` (`course_id`, `datetime`, `created_at`, `updated_at`) VALUES
        (3, '2024-03-12 16:00:00', '2023-09-26 15:41:00', '2023-09-26 15:41:00');
    ```

1. ปิดคอร์ส

    ```sql
    UPDATE `courses` SET `status` = 'ENDED' WHERE `id` = 2;
    ```
