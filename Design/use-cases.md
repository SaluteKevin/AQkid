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


### Seeding

```sql
INSERT INTO `users` (`username`, `password`, `role`, `first_name`, `middle_name`, `last_name`, `birthdate`, `phone_number`, `email`, `created_at`, `updated_at`) VALUES
    ('staff_01', 'staff_password', 'STAFF', 'Salute', NULL, 'Khumyunn', '1998-09-22', '0998765432', 'salute.k@staff.aqkids.example.com', '2023-09-24 19:22:31', '2023-09-24 19:22:31'),
    ('teacher_01', 'teacher_password', 'TEACHER', 'Potsawat', NULL, 'Thinkanwatthana', '2000-01-01', '0987654321', 'potsawat.t@teacher.aqkids.example.com', '2023-09-25 20:36:12', '2023-09-25 20:36:12'),
    ('j.doe', 'password', 'STUDENT', 'John', 'Linus', 'Doe', '2014-05-01', '0123456789', 'j.doe@example.com', '2023-09-26 11:48:55', '2023-09-26 11:48:55');
```
