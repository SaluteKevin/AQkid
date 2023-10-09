# Page Flow

> **View online here**: [mermaidchart.com](https://www.mermaidchart.com/raw/7d0eb959-dbbf-4d38-822f-5882321e7f74?version=v0.1&theme=light&format=svg)  

All the pages

## Staff

```mermaid
flowchart TD

    start[Landing] --> staffLogin[Login] --> staffHome[Home]

    staffHome --> courseRequestIndex[Course Requests] -- Select --> courseRequestShow[Review Request]

    staffHome --> scheduleEdit[Manage Schedule]

    staffHome --> teacherIndex[Teacher List]

    teacherIndex --> teacherCreate[Create Teacher]
    teacherIndex --> teacherEdit[Edit Teacher]

    staffHome --> studentIndex[Student List]
```

- Home
    - Index schedule
- Home > Manage Schedule
    - Edit schedule pane
    - Create schedule pane


## Teacher

```mermaid
flowchart TD

    start[Landing] --> teacherLogin[Login] --> teacherHome[Home]

    teacherHome --> teacherProfileShow[Profile] --> teacherProfileEdit[Edit Profile]
```

- Home
    - Index schedule
        - Calendar pane
        - Agenda pane
            - Student attendance pop-up

        ![outlook-calendar-view-annotated.png](../images/outlook-calendar-view-annotated.png)


## Student

```mermaid
flowchart TD

    start[Landing]
    studentLogin[Login]
    studentRegister[Register]
    studentHome[Home]

    start --> studentLogin --> studentHome
    start --> studentRegister --> studentHome

    studentHome[Home]
    
    studentHome --> studentProfileShow[Profile]
    studentProfileShow --> studentProfileEdit[Edit Profile]

    studentHome --> courseEnroll[Enroll Course] --> courseEnrollDetails[Confirm Course Enrollment Details] --> paymentDetails[Payment Details]
```

- Home
    - No classes
    - Enroll status -- progress bar
    - Course progress -- time table
- Home > Profile
    - Personal info pane
    - History & Certificates pane
- Home > Enroll Course
    - Course constraint filters -- full/half
    - Generic timeslots
- Home > Payment Details
    - Show payment details
    - Submit payment slip
