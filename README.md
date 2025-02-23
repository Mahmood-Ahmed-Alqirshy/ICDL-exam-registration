old project from 2023.
# ICDL Exam Registration System

## Introduction
The ICDL Exam Registration System allows users to register for an ICDL course or directly for an exam session. Admins can create and manage exam sessions. This system is built using Laravel.

## Laravel Installation Steps
To set up the project locally, follow these steps:

1. **Clone the Repository**
   ```sh
   git clone <repository_url>
   cd <project_directory>
   ```

2. **Install Dependencies**
   ```sh
   composer install
   npm install
   ```

3. **Set Up Environment**
   - Copy the `.env.example` file and rename it to `.env`:
     ```sh
     cp .env.example .env
     ```
   - Update the `.env` file with your database credentials.

4. **Generate Application Key**
   ```sh
   php artisan key:generate
   ```

5. **Run Migrations and Seed Database**
   ```sh
   php artisan migrate --seed
   ```

6. **Run the Development Server**
   ```sh
   php artisan serve
   ```
   The application will be available at `http://127.0.0.1:8000`.

## Features

- **ICDL Course Registration**: Users can register for ICDL courses.
- **Exam Session Registration**: Users can register for available exam sessions.
- **Admin control**: Admins can create and manage exam sessions.

## User Roles
- **Admin**: Manages exam sessions, approves registrations, and oversees the system.
- **User**: Registers for ICDL courses or exam sessions.

## Usage
1. **User Registration**: Sign up and log in.
2. **Course Enrollment**: Select and register for an ICDL course.
3. **Exam Session Registration**: Choose an available exam session and register.
4. **Admin Management**: Create, edit, or delete exam sessions.

## License
This project is licensed under the MIT License.

## Contributing
Feel free to submit issues and pull requests for improvements.

