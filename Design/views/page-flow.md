# Page Flow

All the pages

## Unauthorized

```mermaid
flowchart TD

    start[Landing]
    
    start --> login[Login] --> home[Home]
    start --> register[Register] --> home[["Home (by Roles)"]]
```

## Staff

```mermaid
flowchart TD

    staffHome[Home]

    staffHome --> courseRequestIndex[Course Requests] -- Select --> courseRequestShow[Review Request]

    staffHome --> scheduleEdit[Manage Schedule]

    staffHome --> teacherIndex[Teacher List]

    teacherIndex --> teacherCreate[Create Teacher]

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

    teacherHome[Home]

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
