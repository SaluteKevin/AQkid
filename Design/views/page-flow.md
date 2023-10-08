# Page Flow

All the pages


## Student

```mermaid
flowchart TD
    landing --> loginRegister --> home

    home --> selectCourse

    home --> profile

    profile <--> profileEdit

    profile <--> historyCertificates

```

- Home


## Staff

```mermaid
flowchart TD
    landing --> login --> home

    home --> courseRequestIndex -- Select --> courseRequestShow

    home --> scheduleEdit

    home --> teacherIndex
    teacherIndex --> teacherCreate
    teacherIndex --> teacherEdit

    home --> studentIndex
```

- Home
    - Schedule index


## Teacher

```mermaid
flowchart TD
    landing --> login --> home

    home --> studentAttendances
```

- Home
    - Schedule index panes
        - Calendar pane
        - Agenda pane

        ![outlook-calendar-view-annotated.png](../images/outlook-calendar-view-annotated.png)
