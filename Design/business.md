# Business Logic

All the logic

## Terms

1. *generic timeslot*  
    A timeslot that includes day of week and time, e.g., `Tue 08:00:00`.
1. *specific timeslot*  
    A timeslot that includes date and time, e.g., `2023-10-31 08:00:00`.

## Course Creation and Enrollment

> **View online here**: [mermaidchart.com](https://www.mermaidchart.com/raw/7d0eb959-dbbf-4d38-822f-5882321e7f74?version=v0.1&theme=light&format=svg)  

```mermaid
flowchart LR

    subgraph staffCreateCourse[Staff create course and timeslots]
        direction TB

        courseCreate[Create course] --> courseTeacherAssign[Assign teacher to the course] --> timeslotSpecificCreate[Link then populate specific timeslots]
    end

    subgraph studentEnrollCourse[Student submit course enrollment request]
        direction TB

        timeslotGenericSelect[Select generic timeslot, ultimately enrolling a course]

        timeslotGenericSelect ---> enrollmentDetails[Show enrollment details]

        enrollmentDetails ---> confirmEnrollment{Confirm enrollment}
        confirmEnrollment -- No --> timeslotGenericSelect
        confirmEnrollment -- Yes --> paymentDetails

        paymentDetails[Show payment details]

        subgraph uploadPaymentSlipInterval[Predefined payment interval]
            direction TB

            uploadPaymentSlip[Upload payment slip]
            uploadPaymentSlip --> confirmUpload{Confirm upload}
            confirmUpload -- Yes --> submitEnrollmentRequest[Submit enrollment request]
            confirmUpload -- No/cancel --> abortEnrollment[Abort enrollment]
        end

        paymentDetails --> uploadPaymentSlipInterval{Upload payment slip}
    end

    subgraph staffConfirmEnrollment[Staff review enrollment requests]
        direction TB
    
        reviewPaymentSlip[Review payment slip] --> confirmPaymentSlip{Payment success}
        confirmPaymentSlip -- Yes --> enrollSuccess[Commit enrollment]
        confirmPaymentSlip -- No --> enrollFailure[Reject enrollment]
    end

    start([Start]) --> staffCreateCourse
    staffCreateCourse --> studentEnrollCourse
    studentEnrollCourse --> staffConfirmEnrollment
    
    staffConfirmEnrollment --> stop([Stop])
```

- Predefined payment interval: short 5min?
