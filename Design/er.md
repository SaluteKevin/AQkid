# ER Diagram

> **View online here**: [mermaidchart.com](https://www.mermaidchart.com/raw/930a80f8-a45b-40eb-9f5e-878a44120805?version=v0.1&theme=light&format=svg)

```mermaid
erDiagram
    users {
        INT id PK "NOT NULL, AUTO_INCREMENT"
        VARCHAR username "UNIQUE, NOT NULL"
        VARCHAR password "NOT NULL"
        ENUM role "NOT NULL"
        VARCHAR first_name "NOT NULL"
        VARCHAR middle_name
        VARCHAR last_name "NOT NULL"
        DATE birthdate "NOT NULL"
        VARCHAR phone_number "NOT NULL"
        VARCHAR email
        VARCHAR profile_image_path "NOT NULL"
        TIMESTAMP created_at "NOT NULL"
        TIMESTAMP updated_at "NOT NULL"
    }

    courses {
        INT id PK "NOT NULL, AUTO_INCREMENT"
        INT teacher_id FK
        VARCHAR title "NOT NULL"
        DATETIME opens_until
        DATETIME start_datetime "NOT NULL"
        INT quota "NOT NULL"
        INT capacity "NOT NULL"
        INT min_age "DEFAULT 0"
        INT max_age
        ENUM status "NOT NULL"
        TIMESTAMP created_at "NOT NULL"
        TIMESTAMP updated_at "NOT NULL"
    }

    enrollments {
        INT id PK "NOT NULL, AUTO_INCREMENT"
        INT course_id FK "NOT NULL"
        INT student_id FK "NOT NULL"
        ENUM status "NOT NULL"
        TIMESTAMP created_at "NOT NULL"
        TIMESTAMP updated_at "NOT NULL"
    }

    receipts {
        INT id PK "NOT NULL, AUTO_INCREMENT"
        INT enrollment_id FK "NOT NULL"
        TIMESTAMP payment_date "NOT NULL"
        TIMESTAMP receipt_date "NOT NULL"
        VARCHAR description "NOT NULL"
        FLOAT amount "NOT NULL"
        FLOAT subtotal "NOT NULL"
        FLOAT total "NOT NULL"
        TIMESTAMP created_at "NOT NULL"
        TIMESTAMP updated_at "NOT NULL"
    }

    timeslots {
        INT id PK "NOT NULL, AUTO_INCREMENT"
        INT course_id FK "NOT NULL"
        DATETIME datetime "NOT NULL"
        TIMESTAMP created_at "NOT NULL"
        TIMESTAMP updated_at "NOT NULL"
    }

    student_attendances {
        INT timeslot_id FK "NOT NULL"
        INT student_id FK "NOT NULL"
        ENUM attended "NOT NULL"
    }

    teacher_attendances {
        INT timeslot_id FK "NOT NULL"
        INT teacher_id FK "NOT NULL"
    }

    users ||--o{ enrollments : enrolls
    enrollments }o--|| courses : issues
    enrollments ||--|| receipts : issues
    courses ||--o{ timeslots : allocates

    users ||--o{ student_attendances  : attends
    student_attendances }o--|| timeslots : attends

    users ||--o{ teacher_attendances  : attends
    teacher_attendances }o--|| timeslots : attends
```

## Notes

- Teachers list course members by

        SELECT * FROM `enrollments` WHERE `course_id` = '<COURSE_ID>' AND `status` = 'SUCCESS';

- Teachers list timeslot members for attendance checking by

        SELECT * FROM `student_attendances` WHERE `timeslot_id` = '<TIMESLOT_ID>';

    To check a student's attendance

        UPDATE `student_attendances` SET `attended` = 'TRUE' WHERE `student_id` = '<STUDENT_ID>';
