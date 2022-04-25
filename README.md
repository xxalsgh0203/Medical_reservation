# Medical-Clinic-Database

## About the project
This website was created as a group project for COSC3380, and is meant to be used by a small medical clinic to further help them execute several of their operations. There are three different user types that can use this website: Patients, Doctors, and Administratos. Each user type has the ability to login in, but only Patients are allowed to use the sign up. Once logged in, each user is automatically redirected to the main page for their user type. For each user type, the first information is the personal information of the logged in user. Then, we display other relevant information and features to each user type depending. Also, all users have access to the navbar at the top of the page, which easily allowsthem to access the main page for the medical clinic, presents a welcome message, allowed them to logout, and then allows them to manage their appointments. This last buttons takes each user to its main page.

## File structure

### Patient Pages
The key information displayed is: Personal information, upcomming appointments, then prescriptions. Patients are also given the option to Make an Appointment, which redirects them to the requestAppointment pages, and they are also able to cancel their appointments. This is a series of pages that prompts the logged in user with questions needed to schedule their appointment. The information from some pages determines the display of others. For example, depending on the doctor type chosen, different doctors will be available on the next page. Once a patient reaches the last page and presses the "Submit" button, their appointment request will either pass or fail. If passed, they will see a message stating that their appointment was requested. If failed, they will a message specifying why the appointment request page. In either case, the logged in user will be presented with a link to take them back to their main user page.

The appointment request can fail for one of two reasons:

1. The doctor is unavailable becuase they have a conflicting appointment
2. A Patient which has not been authorized to schedule with a specialist attempted to schedule an appointment with a specialist.

### Doctor Pages
The key information displayed is: 

### Admin Pages


## installing/running the project