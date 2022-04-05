DROP DATABASE IF EXISTS medical_clinic;
CREATE DATABASE medical_clinic;

USE medical_clinic;

CREATE TABLE OFFICE (
	Office_id    INT AUTO_INCREMENT,
    Address      VARCHAR(30),
    City         VARCHAR(15),
    State        VARCHAR(15),
    Phone_number CHAR(10) UNIQUE,
    Open_time    TIME NOT NULL,
    Close_time   TIME NOT NULL,
    PRIMARY KEY  (Office_id)
);

INSERT INTO OFFICE(Address, City, State, Phone_number, Open_time, Close_time) VALUES
('123 Main st.', 'Houston', 'Texas', 1234567890, '9:00', '17:00'),
('456 UH st.', 'Houston', 'Texas', 0987654321, '9:00', '17:00');

CREATE TABLE ADMIN (
	Admin_id             INT AUTO_INCREMENT,
    Office_id            INT,
    Name                 VARCHAR(20),
    Password             VARCHAR(255) NOT NULL,
    Phone_number         CHAR(10) UNIQUE,
    Email                VARCHAR(30) UNIQUE,
    Appointment_Approval BOOLEAN,
    PRIMARY KEY (Admin_id),
    FOREIGN KEY (Office_id) REFERENCES OFFICE(Office_id)
);

INSERT INTO ADMIN(Office_id, Name, Password, Phone_number, Email) VALUES
(1, "Alice", "Password", 1111111111, "alice@yahoo.com"),
(1, "Bob", "Password", 2222222222, "bob@ygoogle.com"),
(1, "Charlie", "Password", 3333333333, "charlie@uh.edu"),
(1, "Drake", "Password", 4444444444, "drake@hotmail.com");

CREATE TABLE DOCTOR (
	Doctor_id      INT AUTO_INCREMENT,
    Office_id      INT,
    Days_in_office VARCHAR(10) CHECK(Days_in_office IN('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')),
    Speciality     VARCHAR(30),
    Name           VARCHAR(20),
    Password       VARCHAR(255) NOT NULL,
    Phone_number   CHAR(10) UNIQUE,
    PRIMARY KEY (Doctor_id),
    FOREIGN KEY (Office_id) REFERENCES OFFICE(Office_id)
);

INSERT INTO DOCTOR(Office_id, Days_in_office, Speciality, Name, Password, Phone_number) VALUES
(1, 'Monday', null, "Greg", "Password", 1111111111),
(1, 'Tuesday', "Anesthesiology", "Miranda", "Password", 2222222222),
(1, 'Wednesday', "Oncology", "Noah", "Password", 3333333333),
(2, 'Thursday', null, "Marshall", "Password", 4444444444),
(2, 'Friday', null, "Lydia", "Password", 5555555555);

CREATE TABLE PATIENT (
	Patient_id           INT AUTO_INCREMENT,
    Primary_physician_id INT,
    Specialist_approved  BOOLEAN,
    Name                 VARCHAR(20) NOT NULL,
    Password             VARCHAR(255) NOT NULL,
    Phone_number         CHAR(10) UNIQUE NOT NULL,
    Email                VARCHAR(254) UNIQUE,
    Age                  INT,
    Medical_allergy      BOOLEAN NOT NULL,
    PRIMARY KEY (Patient_id),
    FOREIGN KEY (Primary_physician_id) REFERENCES DOCTOR(Doctor_id)
);

INSERT INTO PATIENT(Primary_physician_id, Specialist_approved, Name, Password, Phone_number, Email, Age, Medical_allergy) VALUES
(1, false, "Wade", "password", 2222222222, "Wade@gmail.com", 5, true),
(2, false, "Loren", "password", 3333333333, "Loren@yahoo.com", 10, true),
(3, false, "Elsa", "password", 4444444444, "Elsa@hotmail.com", 20, false),
(4, false, "Richard", "password", 5555555555, "Richard@yahoo.com", 50, true),
(5, false, "Salvador", "password", 6666666666, "Salvador@yahoo.com", 100, false);

CREATE TABLE APPOINTMENT (
	Appointment_id        INT AUTO_INCREMENT,
    Patient_id            INT,
    Doctor_id             INT NOT NULL,
    Office_id             INT NOT NULL,
    Appointment_status_id INT NOT NULL,
    Slotted_time          TIME NOT NULL,
    Specialist_status     BOOLEAN NOT NULL, /*If it is a specialist appointment */
    PRIMARY KEY (Appointment_id),
    FOREIGN KEY (Patient_id) REFERENCES PATIENT(Patient_id),
    FOREIGN KEY (Doctor_id) REFERENCES DOCTOR(Doctor_id),
    FOREIGN KEY (Office_id) REFERENCES OFFICE(Office_id)
);

DELIMITER $$
CREATE TRIGGER SAPPROVE
AFTER INSERT
ON APPOINTMENT
FOR EACH ROW
BEGIN
	IF EXISTS (
		SELECT *
		FROM PATIENT
		INNER JOIN APPOINTMENT ON PATIENT.Patient_id = APPOINTMENT.Patient_id
		WHERE PATIENT.Specialist_approved = FALSE
		AND APPOINTMENT.Specialist_status = TRUE
	)
    THEN
		PRINT 'You do NOT have Approval'
		ROLLBACK TRANSACTION;
	END IF;
END
DELIMITER ;

DELIMITER $$
CREATE TRIGGER CONFLICT
AFTER INSERT
ON APPOINTMENT
FOR EACH ROW
BEGIN
	IF EXISTS (
		SELECT *
		FROM APPOINTMENTS
		WHERE Doctor_id = NEW.Doctor_id
		AND Slotted_time = NEW.Slotted_time
	)
	THEN
		PRINT 'Time is Taken'
		ROLLBACK TRANSACTION;
	END IF;
END
DELIMITER ;

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
