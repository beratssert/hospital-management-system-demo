# Simple Hospital Management System

## Introduction

This project is a web-based hospital management system demo developed for CSE 204_Database System course focusing on database design. It demonstrates the process of designing a relational database schema (progressing from UNF to 3NF conceptually) and building a functional user interface with PHP and MySQL to interact with the database. The system allows different user roles (Patient, Doctor, Admin) to manage appointments and related medical information.

## Purpose

The main goals of this project were:

- To design and implement a relational database schema for a basic hospital management scenario.
- To interact with a MySQL/MariaDB database for data storage and retrieval.
- To create distinct user interfaces and functionalities based on user roles (Patient, Doctor, Admin).

## Features

The system currently implements the following features:

**General:**

- User Login (Patient, Doctor, Admin)
- User Logout
- Patient Self-Registration

**Patient Role:**

- View Dashboard
- Book New Appointment (Select Clinic -> Select Doctor -> Select Available Date/Time Slot)
- View Appointment History
- Cancel Upcoming Appointments
- Edit Date/Time for Upcoming Appointments (Select Available Date/Time Slot)
- Book Follow-up Appointments (based on previous appointments)
- View Prescriptions (Medicines and Dosages)
- View Diagnoses
- View Tests & Results

**Doctor Role:**

- View Dashboard
- View Today's & Upcoming Appointments
- Manage Specific Appointment:
  - View Patient Details
  - View existing Diagnoses, Tests, Treatments, Prescriptions for the appointment
  - Add New Diagnosis
  - Assign New Test (Result defaults to 'Pending')
  - Add New Treatment
  - Add Medicine to Prescription (Creates prescription record if none exists)

**Admin Role:**

- View Dashboard
- Add New Doctor (Managed by the logged-in Admin)
- Add New Nurse (Managed by the logged-in Admin)
- Add New Patient (Using TCKN as Patient_ID)
- List Doctors associated with a specific Patient
- List All Patients and Their Appointments (Last Year)
- Manage All Appointments (View List)
- Edit Date/Time for Scheduled Appointments (Select Available Date/Time Slot)
- Delete Any Appointment (Removes the record permanently)

## Database Schema

The application uses a MySQL/MariaDB relational database. The schema consists of 15 tables designed based on normalization principles (conceptually 3NF). Key tables include `PATIENT`, `DOCTOR`, `NURSE`, `ADMIN`, `CLINIC`, `APPOINTMENT`, `DIAGNOSIS`, `TEST`, `MEDICAL_TREATMENT`, `MEDICINE`, `PRESCRIPTION`, and various junction tables (`Appointment_Diagnosis`, `Appointment_Test`, etc.).

The complete database structure and initial data can be set up using the provided `database_setup.sql` file.

## Technologies Used

- **Backend:** PHP
- **Database:** MySQL / MariaDB
- **Frontend:** HTML, CSS, JavaScript (for AJAX time slot fetching)
- **Server Environment:** XAMPP (Apache, MySQL, PHP)

## Local Setup Instructions

To run this project locally, follow these steps:

1.  **Prerequisites:**

    - Install [XAMPP](https://www.apachefriends.org/index.html) (or a similar local server environment like WAMP, MAMP).
    - Start the **Apache** and **MySQL** services from the XAMPP Control Panel.

2.  **Clone Repository:**

    - Clone this repository to your local machine using Git:
      ```bash
      git clone <repository_url> your_project_folder_name
      ```
    - Alternatively, download the project files as a ZIP and extract them.

3.  **Place Project Files:**

    - Move the entire project folder (`your_project_folder_name`) into the `htdocs` directory within your XAMPP installation folder. (e.g., `C:\xampp\htdocs\` on Windows, `/Applications/XAMPP/xamppfiles/htdocs/` on macOS).

4.  **Database Setup:**

    - Open your web browser and navigate to `http://localhost/phpmyadmin`.
    - Create a new database. The name should match the one specified in the connection file (e.g., `Hospital_3NF`). Click "Create".
    - Select the newly created database from the left-hand sidebar.
    - Click on the "Import" tab.
    - Click "Choose File" / "Browse..." and select the `database_setup.sql` file provided in this repository.
    - Scroll down and click "Go" / "Import". This will create all the tables and insert the initial data.

5.  **Database Connection:**

    - Open the `includes/db_connect.php` file within your project folder.
    - Verify that the `$servername`, `$username`, `$password`, and especially `$dbname` variables match your local MySQL setup. (Default XAMPP usually uses `localhost`, `root`, empty password). Ensure `$dbname` is set to the name you created in phpMyAdmin (e.g., `Hospital_3NF`).

6.  **Access the Application:**
    - Open your web browser and navigate to: `http://localhost/your_project_folder_name/`
    - (Replace `your_project_folder_name` with the actual name of the folder you placed in `htdocs`, e.g., `http://localhost/hospital_management/`)
    - You should see the login page.

## Usage

- **Registration:** New patients can register using the "Register here" link on the login page. Use a valid 11-digit TC Kimlik No as the Patient ID.
- **Login:** Log in using the credentials for different roles. Sample credentials based on the initial data:
  - **Patient:** ID `43543543565`, Password `murat123`
  - **Doctor:** Email `nilüfer@email.com`, Password `nilüfer123`
  - **Admin:** Email `joseph@email.com`, Password `joseph123`
- **Navigation:** Use the sidebar menu within each user's dashboard to access different features.

**!!! Security Warning !!!**
Please be aware that this is a demo/educational project. **Passwords are currently stored as plain text in the database**, which is highly insecure. In a real-world application, passwords must always be securely hashed using functions like `password_hash()` and verified using `password_verify()` in PHP.
