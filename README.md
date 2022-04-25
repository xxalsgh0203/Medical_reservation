# Medical-Clinic-Database

## About the project
This website was created as a group project for COSC3380, and is meant to be used by a small medical clinic to further help them execute several of their operations. There are three different user types that can use this website: Patients, Doctors, and Administratos. Each user type has the ability to login in, but only Patients are allowed to use the sign up. Once logged in, each user is automatically redirected to the main page for their user type. For each user type, the first information is the personal information of the logged in user. Then, we display other relevant information and features to each user type depending. Also, all users have access to the navbar at the top of the page, which easily allowsthem to access the main page for the medical clinic, presents a welcome message, allowed them to logout, and then allows them to manage their appointments. This last buttons takes each user to its main page.

## File structure

### Patient Pages
The key information displayed is: Personal information, appointments, then prescriptions. Patients are also given the option to Make an Appointment, which redirects them to the requestAppointment pages, and they are also able to cancel their appointments. This is a series of pages that prompts the logged in user with questions needed to schedule their appointment. The information from some pages determines the display of others. For example, depending on the doctor type chosen, different doctors will be available on the next page. Once a patient reaches the last page and presses the "Submit" button, their appointment request will either pass or fail. If passed, they will see a message stating that their appointment was requested. If failed, they will a message specifying why the appointment request page. In either case, the logged in user will be presented with a link to take them back to their main user page.

The appointment request can fail for one of two reasons:

1. The doctor is unavailable becuase they have a conflicting appointment
2. A Patient which has not been authorized to schedule with a specialist attempted to schedule an appointment with a specialist.

### Doctor Pages
The key information displayed is: Personal information, assigned patients, appointments, and their schedule. The only feature given to the doctor user is the ability to cancel their appointments.

### Admin Pages
The key information displayed is: Personal information, appointments, then the other administrators and doctors in the clinic. On the left admins also have another menu which allows them to naviage between several pages. First there are four data entry pages, which allows the admin to add, edit, and delete informtion for Doctors, Admins, Patients, and Offices respectively.

Next there is the Report Form page. This page contains all of the data reports for the project. The admin can look at reports for prescriptions, specialists, appointments, and employees.

- **Prescription Report**: Displays all of the prescriptions given out by the clinic. Uses a left join on patients with the weak entity prescription.
- **Specialist Report**: Displays the number of each type of specialist in each office. First does a left join on doctors with offices, and then groups by specialist therby counting the number of each specialist in each office.
- **Appointments Report**: Displays all of the scheduled appointments in the clinic. Uses a left join on Appointments with Patients, Doctors, and Offices to display patient information, doctor information, and office information for each appointment.
- **Employees Report**: Displays the contact information for each employee in the clinic. Uses a union of both Doctor and Admin, each which were joined with office to get further information for each employee.


## Installing/running the project
To view the hosted project: go here: ___
To run the project locally (with XAMPP): first download all the files into the C:\xampp\htdocs folder. Then open the XAMPP controll panel, start the Apache server, and open 'http://localhost/cosc3380/' in a web browser.