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
    `status` ENUM('OPEN', 'ACTIVE', 'ENDED') NOT NULL,
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
