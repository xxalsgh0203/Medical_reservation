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
 
INSERT INTO OFFICE(Office_id, Address, City, State, Phone_number, Open_time, Close_time) VALUES
(1, '123 Main st.', 'Houston', 'Texas', 3867295732, '9:00', '17:00'),
(2, '456 UH st.', 'Houston', 'Texas', 1025968745, '9:00', '17:00'),
(3, '423 UH Avenue.', 'Austin', 'Texas', 4658972048, '9:00', '17:00');
 
CREATE TABLE ADMIN (
    Admin_id             INT AUTO_INCREMENT,
    Office_id            INT,
    Name                 VARCHAR(20),
    Password             VARCHAR(255) NOT NULL,
    Phone_number         CHAR(10) UNIQUE,
    Email                VARCHAR(30) UNIQUE,
    Appointment_Approval BOOLEAN,
    PRIMARY KEY (Admin_id),
    FOREIGN KEY (Office_id) REFERENCES OFFICE(Office_id) ON DELETE SET NULL
);
 
INSERT INTO ADMIN(Office_id, Name, Password, Phone_number, Email) VALUES
(1, "Alice", "Password", 3053024627, "alice@yahoo.com"),
(1, "Bob", "Password", 4169462054, "bob@ygoogle.com"),
(1, "Charlie", "Password", 4984514871, "charlie@uh.edu"),
(2, "Admin", "Password", 8481610612, "admin@medical.com"),
(2, "Marianne", "Password", 3404540459, "Marianne@yahoo.com"),
(3, "Lindsey", "Password", 4221010530, "Lindsey@ygoogle.com"),
(3, "Tiffany", "Password", 2344703282, "Tiffany@uh.edu"),
(3, "Bridget", "Password", 1554544861, "Bridget@medical.com");
 
CREATE TABLE DOCTOR (
    Doctor_id      INT AUTO_INCREMENT,
    Office_id      INT,
    Speciality     VARCHAR(30),
    Name           VARCHAR(20),
    Password       VARCHAR(255) NOT NULL,
    Phone_number   CHAR(10) UNIQUE,
    PRIMARY KEY (Doctor_id),
    FOREIGN KEY (Office_id) REFERENCES OFFICE(Office_id) ON DELETE SET NULL
);
 
INSERT INTO DOCTOR(Office_id, Speciality, Name, Password, Phone_number) VALUES
(1, null, "Greg", "Password", 708931280),
(1, null, "Doctor", "Password", 9834553805),
(2, null, "Samual", "Password", 8737868610),
(1, "Anesthesiology", "Lucy", "Password", 6167134561),
(1, "Anesthesiology", "Faye", "Password", 5182329656),
(1, "Anesthesiology", "Jesus", "Password", 5334299670),
(2, "Anesthesiology", "Darrin", "Password", 2669082899),
(2, "Anesthesiology", "Debra", "Password", 1720352865),
(2, "Anesthesiology", "Geraldine", "Password", 0097366468),
(2, "Anesthesiology", "Cody", "Password", 3390998394),
(3, "Anesthesiology", "Carolyn", "Password", 6032973490),
(1, "Eye Doctor", "Nettie", "Password", 2603591341), 
(2, "Eye Doctor", "Ian", "Password", 4469566959), 
(3, "Eye Doctor", "Malcolm", "Password", 4659913080), 
(2, "Orthodontist", "Kanet", "Password", 2935098364), 
(2, "Orthodontist", "Lynne", "Password", 1795469519),
(1, "Dermatologist", "Raymond", "Password", 5009979186), 
(2, "Dermatologist", "Taylor", "Password", 1719474661), 
(2, "Gynecologist", "Jodi", "Password", 4935152982), 
(2, "Cardiologist", "Garret", "Password", 2601269476), 
(1, "Oncology", "Randolph", "Password", 5317207202), 
(2, "Oncology", "Elbert", "Password", 0724180264), 
(2, "Oncology", "Preston", "Password", 1066260096), 
(3, "Oncology", "Lynn", "Password", 2589763169), 
(1, "Gastroenterologist", "Claudia", "Password", 1832256952);

 
CREATE TABLE WORK_INFO (
    Doctor_id  INT NOT NULL,
    Office_id  INT NOT NULL,
    Weekday    VARCHAR(10) CHECK(Weekday IN('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')),
    Start_time TIME NOT NULL,
    End_time   TIME NOT NULL,
    PRIMARY    KEY (Doctor_id, Weekday),
    FOREIGN    KEY (Doctor_id) REFERENCES DOCTOR(Doctor_id) ON DELETE CASCADE
);
 
INSERT INTO WORK_INFO(Doctor_id, Office_id, Weekday, Start_time, End_time) VALUES
(5, 1, 'Monday', '9:00', "15:00"),
(5, 1, 'Tuesday', '10:00', "14:00"),
(5, 1, 'Wednesday', '12:00', "18:00"),
(5, 2, 'Thursday', '7:00', "12:00"),
(5, 2, 'Friday', '9:00', "15:00");
 
CREATE TABLE PATIENT (
    Patient_id           INT AUTO_INCREMENT,
    Primary_physician_id INT,
    Specialist_approved  BOOLEAN,
    Specialist_check VARCHAR(8) NOT NULL DEFAULT "NA",
    Name                 VARCHAR(20) NOT NULL,
    Password             VARCHAR(255) NOT NULL,
    Phone_number         CHAR(10) UNIQUE NOT NULL,
    Email                VARCHAR(254) UNIQUE,
    Age                  INT,
    Medical_allergy      BOOLEAN NOT NULL DEFAULT false,
    Medical_Al_Description VARCHAR(100),
    PRIMARY KEY (Patient_id),
    FOREIGN KEY (Primary_physician_id) REFERENCES DOCTOR(Doctor_id) ON DELETE SET NULL
);
 
INSERT INTO PATIENT(Primary_physician_id, Specialist_approved, Name, Password, Phone_number, Email, Age, Medical_allergy) VALUES
(1, 0, "Wade", "password", 2222222222, "Wade@gmail.com", 5, true),
(2, 0, "Loren", "password", 3333333333, "Loren@yahoo.com", 10, true),
(3, 0, "Elsa", "password", 4444444444, "Elsa@hotmail.com", 20, false),
(4, 0, "Richard", "password", 5555555555, "Richard@yahoo.com", 50, true),
(5, 0, "Patient", "Password", 6666666666, "Patient@medical.com", 100, false),
(1, 0, "Andy", "password", 9999999999, "Andy@gmail.com", 36, true);
 
CREATE TABLE APPOINTMENT (
    Appointment_id        INT AUTO_INCREMENT,
    Patient_id            INT,
    Doctor_id             INT NOT NULL,
    Office_id             INT NOT NULL,
    Appointment_status_id INT NOT NULL DEFAULT 0,
    Appointment_status    VARCHAR(12) NOT NULL,
    Date                  DATE NOT NULL,
    Slotted_time          TIME NOT NULL,
    Specialist_status     BOOLEAN NOT NULL,
    PRIMARY KEY (Appointment_id),
    FOREIGN KEY (Patient_id) REFERENCES PATIENT(Patient_id) ON DELETE CASCADE,
    FOREIGN KEY (Doctor_id) REFERENCES DOCTOR(Doctor_id) ON DELETE CASCADE,
    FOREIGN KEY (Office_id) REFERENCES OFFICE(Office_id) ON DELETE CASCADE
);
 
INSERT INTO APPOINTMENT(Patient_id, Doctor_id, Office_id, Appointment_status, Date, Slotted_time, Specialist_status) VALUES
(1, 1, 1, "pending", "2022-04-20", "9:00", 0),
(1, 5, 2, "approved", "2022-04-21", "15:00", 0),
(2, 3, 1, "pending", "2022-04-21", "7:00", 0),
(2, 4, 2, "canceled", "2022-04-22", "1:00", 0),
(2, 5, 1, "approved", "2022-04-22", "3:00", 0),
(3, 1, 1, "rejected", "2022-04-22", "2:30", 0),
(4, 2, 1, "canceled", "2022-04-23", "16:00", 0),
(4, 5, 1, "approved", "2022-04-25", "11:00", 0),
(5, 5, 2, "pending", "2022-04-20", "2:00", 0),
(5, 1, 1, "approved", "2022-04-25", "12:00", 0);
 
DELIMITER $$
CREATE TRIGGER SAPPROVE
BEFORE INSERT
ON APPOINTMENT
FOR EACH ROW
BEGIN
    IF  ((
        SELECT COUNT(*)
        FROM PATIENT
        INNER JOIN APPOINTMENT ON PATIENT.Patient_id = APPOINTMENT.Patient_id
        WHERE PATIENT.Patient_id = NEW.Patient_id
        AND PATIENT.Specialist_approved = 0) >=1 && NEW.Specialist_status = 1 ) THEN
		SIGNAL SQLSTATE '77777'
		SET MESSAGE_TEXT = 'Warning, You do NOT have Specialist approval!';
    END IF;
END; $$
DELIMITER ;
 
DELIMITER $$
CREATE TRIGGER CONFLICT
BEFORE INSERT
ON APPOINTMENT
FOR EACH ROW
BEGIN
    IF (
        SELECT COUNT(*)
        FROM APPOINTMENT
        WHERE Doctor_id = NEW.Doctor_id
        AND Slotted_time = NEW.Slotted_time
        AND APPOINTMENT.Date = NEW.Date
    ) >= 1 THEN
        SIGNAL SQLSTATE '88888'
        SET MESSAGE_TEXT = 'Warning: An appointment with this time and doctor already exists!';
    END IF;
END;$$
DELIMITER ;
 
 
CREATE TABLE PRESCRIPTION (
    Patient_id        INT NOT NULL,
    Medication        VARCHAR(64) NOT NULL,
    Test              VARCHAR(64),
    Prescription_date DATE NOT NULL,
    PRIMARY KEY (Patient_id, Medication, Prescription_date),
    FOREIGN KEY (Patient_id) REFERENCES PATIENT(Patient_id) ON DELETE CASCADE
);
 
INSERT INTO PRESCRIPTION(Patient_id, Medication, Test, Prescription_date) VALUES
(2, "Medication string", "Test string", "2020/01/02"),
(2, "Medication string", "Test string", "2020/01/01"),
(2, "Medication string", "Test string", "2020/01/03"),
(2, "Medication string", "Test string", "2020/01/04"),
(2, "Medication string", "Test string", "2020/01/05");