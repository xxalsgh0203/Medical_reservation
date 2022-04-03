DROP DATABASE IF EXISTS medical_clinic;
CREATE DATABASE medical_clinic;

USE medical_clinic;

CREATE TABLE OFFICE (
	Office_id    INT AUTO_INCREMENT,
    Address      VARCHAR(30),
    City         VARCHAR(15),
    State        VARCHAR(15),
    Phone_number INT UNIQUE,
    Open_time    TIME NOT NULL,
    Close_time   TIME NOT NULL,
    PRIMARY KEY  (Office_id)
);

INSERT INTO OFFICE
VALUES (1, '123 Main st.', 'Houston', 'Texas', 1234567890, '9:00', '17:00');

CREATE TABLE ADMIN (
	Admin_id             INT AUTO_INCREMENT,
    Office_id            INT,
    Name                 VARCHAR(20),
    Phone_number         INT UNIQUE,
    Email                VARCHAR(30) UNIQUE,
    Appointment_Approval BOOLEAN,
    PRIMARY KEY (Admin_id),
    FOREIGN KEY (Office_id) REFERENCES OFFICE(Office_id)
);

CREATE TABLE DOCTOR (
	Doctor_id      INT AUTO_INCREMENT,
    Office_id      INT,
    Days_in_office VARCHAR(10) CHECK(Days_in_office IN('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')),
    Speciality     VARCHAR(30),
    Name           VARCHAR(20),
    Phone_number   INT UNIQUE,
    PRIMARY KEY (Doctor_id),
    FOREIGN KEY (Office_id) REFERENCES OFFICE(Office_id)
);

INSERT INTO DOCTOR
VALUES (1, 1, 'Monday', null, "Alice", 1234567890);

CREATE TABLE PATIENT (
	Patient_id           INT AUTO_INCREMENT,
    Primary_physician_id INT,
    Specialist_approved  BOOLEAN,
    Name                 VARCHAR(20) NOT NULL,
    Password             VARCHAR(255) NOT NULL,
    Phone_number         INT UNIQUE NOT NULL,
    Email                VARCHAR(254) UNIQUE,
    Age                  INT,
    Medical_allergy      BOOLEAN NOT NULL,
    PRIMARY KEY (Patient_id),
    FOREIGN KEY (Primary_physician_id) REFERENCES DOCTOR(Doctor_id)
);

INSERT INTO PATIENT
VALUES (1, 1, false, "Bob", "password",1234567890, "bob@hotmail.com", 20, false);

CREATE TABLE APPOINTMENT (
	Appointment_id        INT AUTO_INCREMENT,
    Patient_id            INT,
    Doctor_id             INT NOT NULL,
    Office_id             INT NOT NULL,
    Appointment_status_id INT NOT NULL,
    Slotted_time          TIME NOT NULL,
    PRIMARY KEY (Appointment_id),
    FOREIGN KEY (Patient_id) REFERENCES PATIENT(Patient_id),
    FOREIGN KEY (Doctor_id) REFERENCES DOCTOR(Doctor_id),
    FOREIGN KEY (Office_id) REFERENCES OFFICE(Office_id)
);


CREATE TABLE PRESCRIPTION (
    Patient_id        INT NOT NULL,
    Medication        VARCHAR(64) NOT NULL,
    Test              VARCHAR(64),
    Prescription_date DATE NOT NULL,
    PRIMARY KEY (Patient_id, Medication, Prescription_date),
    FOREIGN KEY (Patient_id) REFERENCES PATIENT(Patient_id)
);

CREATE TABLE PATIENT_APPOINTMENTS (
	Patient_id     INT NOT NULL,
    Appointment_id INT NOT NULL,
    PRIMARY KEY (Patient_id, Appointment_id),
    FOREIGN KEY (Patient_id) REFERENCES PATIENT(Patient_id),
    FOREIGN KEY (Appointment_id) REFERENCES APPOINTMENT(Appointment_id)
);

CREATE TABLE TREATS (
	Doctor_id  INT NOT NULL,
    Patient_id INT NOT NULL,
    PRIMARY KEY (Doctor_id, Patient_id),
    FOREIGN KEY (Doctor_id) REFERENCES DOCTOR(Doctor_id),
    FOREIGN KEY (Patient_id) REFERENCES PATIENT(Patient_id)
);

CREATE TABLE DOCTOR_APPOINTMENTS (
	Doctor_id      INT NOT NULL,
    Appointment_id INT NOT NULL,
    PRIMARY KEY (Doctor_id, Appointment_id),
    FOREIGN KEY (Doctor_id) REFERENCES DOCTOR(Doctor_id),
    FOREIGN KEY (Appointment_id) REFERENCES APPOINTMENT(Appointment_id)
);

CREATE TABLE OFFER (
	Office_id      INT NOT NULL,
    Appointment_id INT NOT NULL,
    PRIMARY KEY (Office_id, Appointment_id),
    FOREIGN KEY (Office_id) REFERENCES OFFICE(Office_id),
    FOREIGN KEY (Appointment_id) REFERENCES APPOINTMENT(Appointment_id)
);

CREATE TABLE WORKS_IN (
	Doctor_id INT NOT NULL,
    Office_id INT NOT NULL,
    PRIMARY KEY (Doctor_id, Office_id),
    FOREIGN KEY (Doctor_id) REFERENCES DOCTOR(Doctor_id),
    FOREIGN KEY (Office_id) REFERENCES OFFICE(Office_id)
);

CREATE TABLE APPROVES (
	Admin_id       INT NOT NULL,
    Appointment_id INT NOT NULL,
    PRIMARY KEY (Admin_id, Appointment_id),
    FOREIGN KEY (Admin_id) REFERENCES ADMIN(Admin_id),
    FOREIGN KEY (Appointment_id) REFERENCES APPOINTMENT(Appointment_id)
);

CREATE TABLE MANAGES (
	Admin_id  INT NOT NULL,
    Office_id INT NOT NULL,
    PRIMARY KEY (Admin_id, Office_id),
    FOREIGN KEY (Admin_id) REFERENCES ADMIN(Admin_id),
    FOREIGN KEY (Office_id) REFERENCES OFFICE(Office_id)
);
