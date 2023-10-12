CREATE DATABASE IF NOT EXISTS `aqkids`;
USE `aqkids`;
SELECT DATABASE();

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
