# Fit Manager

A comprehensive fitness management system for managing courses, equipment, and users with role-based access control.

##  Table of Contents

- [Features](#features)
- [Tech Stack](#tech-stack)
- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
- [Project Structure](#project-structure)
- [Database Schema](#database-schema)
- [User Roles](#user-roles)
- [API Endpoints](#api-endpoints)
- [Development](#development)
- [Troubleshooting](#troubleshooting)

##  Features

- **User Authentication**: Secure login and registration system
- **Role-Based Access Control**: Three user roles (Admin, Trainer, Member) with different permissions
- **Course Management**: Create, read, update, and delete fitness courses
- **Equipment Management**: Track and manage gym equipment with types and states
- **Course-Equipment Linking**: Associate equipment with specific courses
- **Dashboard**: Overview of courses, equipment, and upcoming events
- **Responsive UI**: Modern interface built with Tailwind CSS

##  Tech Stack

- **Backend**: PHP 8.2
- **Web Server**: Apache
- **Database**: MySQL 8.0
- **Frontend**: Tailwind CSS 4
- **Containerization**: Docker & Docker Compose
- **Database Management**: phpMyAdmin

##  Prerequisites

Before you begin, ensure you have the following installed:

- [Docker](https://www.docker.com/get-started) (version 20.10 or higher)
- [Docker Compose](https://docs.docker.com/compose/install/) (version 1.29 or higher)
- [Node.js](https://nodejs.org/) (for Tailwind CSS compilation, if needed)

##  Installation

### 1. Clone the Repository

```bash
git clone <repository-url>
cd fit-manager
```

### 2. Install Dependencies

```bash
npm install
```

### 3. Build and Start Docker Containers

```bash
docker-compose up -d --build
```

This will start three containers:
- **PHP-Apache**: Web server on port `8080`
- **MySQL**: Database server on port `3307`
- **phpMyAdmin**: Database management on port `8081`

### 4. Initialize Database

The database will be automatically initialized when the MySQL container starts for the first time using the `docker/mysql/init.sql` script.

Alternatively, you can manually import the database schema:

```bash
docker exec -i fitmanager-mysql mysql -ufituser -ppassword fit_manager < fit_manager.sql
```

### 5. Access the Application

- **Web Application**: http://localhost:8080
- **phpMyAdmin**: http://localhost:8081
  - Server: `mysql`
  - Username: `root`
  - Password: `root`

##  Configuration

### Database Configuration

The database connection is configured in `db.php`. The application automatically detects if it's running in Docker and uses the appropriate credentials:

**Docker Environment:**
- Host: `mysql`
- User: `fituser`
- Password: `password`
- Database: `fit_manager`

**Local Environment:**
- Host: `127.0.0.1`
- User: `root`
- Password: `Sa@123456` (update this in `db.php` for your local setup)
- Database: `fit_manager`

### Port Configuration

You can modify the ports in `docker-compose.yml` if the default ports are already in use:

- PHP-Apache: `8080:80`
- MySQL: `3307:3306`
- phpMyAdmin: `8081:80`

##  Usage

### First Time Setup

1. Access the application at http://localhost:8080
2. Register a new user account
3. The first user should be assigned the Admin role (role_id = 1) manually via database or phpMyAdmin

### User Roles

- **Admin (role_id = 1)**: Full access to all features including course-equipment linking
- **Trainer (role_id = 2)**: Can manage courses and view equipment
- **Member (role_id = 3)**: Limited access (view-only)

### Managing Courses

1. Navigate to the Courses page
2. Create new courses with details:
   - Name
   - Category
   - Date and Time
   - Duration
   - Maximum Participants

### Managing Equipment

1. Navigate to the Equipments page
2. Add equipment with:
   - Name
   - Type
   - Quantity
   - State (Available, Maintenance, etc.)

### Linking Courses and Equipment

1. From the Dashboard, use the "Add New Course - Equipment Link" form (Admin only)
2. Select a course and equipment to create an association

##  Project Structure

```
fit-manager/
├── app/
│   └── auth/              # Authentication files
│       ├── auth_session.php
│       ├── login.php
│       ├── logout.php
│       └── register.php
├── includes/              # PHP includes and business logic
│   ├── config.php
│   ├── functions_data/    # Data access functions
│   │   ├── functions_auth.php
│   │   ├── functions_courses.php
│   │   ├── functions_equip.php
│   │   └── functions_course_equipment.php
│   ├── add_course.php
│   ├── add_equipment.php
│   ├── add_course_equipment.php
│   ├── update_course.php
│   ├── update_equipment.php
│   ├── delete_course.php
│   └── delete_equipment.php
├── public/                # Public-facing files
│   ├── index.php          # Dashboard
│   ├── courses.php
│   ├── equipments.php
│   ├── login.php
│   ├── register.php
│   ├── unauthorized.php
│   ├── js/                # JavaScript files
│   │   ├── courses.js
│   │   └── equipments.js
│   └── src/               # CSS files
│       ├── input.css
│       ├── output.css
│       └── style.css
├── docker/
│   └── mysql/
│       └── init.sql       # Database initialization script
├── db.php                 # Database connection
├── docker-compose.yml     # Docker configuration
├── Dockerfile             # PHP-Apache image configuration
├── fit_manager.sql        # Database schema
├── package.json           # Node.js dependencies
└── README.md              # This file
```

##  Database Schema

### Main Tables

- **users**: User accounts with role assignments
- **roles**: User roles (admin, trainer, member)
- **courses**: Fitness courses with scheduling information
- **categories**: Course categories
- **equipments**: Gym equipment inventory
- **equipment_types**: Types of equipment
- **equipment_states**: Equipment status (Available, Maintenance, etc.)
- **course_equipment**: Many-to-many relationship between courses and equipment

### Relationships

- Users → Roles (Many-to-One)
- Courses → Categories (Many-to-One)
- Equipments → Equipment Types (Many-to-One)
- Equipments → Equipment States (Many-to-One)
- Courses ↔ Equipments (Many-to-Many via course_equipment)

##  User Roles

| Role ID | Role Name | Permissions |
|---------|-----------|-------------|
| 1 | Admin | Full access to all features |
| 2 | Trainer | Manage courses, view equipment |
| 3 | Member | View-only access |

## 🔌 API Endpoints

### Authentication
- `POST /app/auth/register.php` - User registration
- `POST /app/auth/login.php` - User login
- `GET /app/auth/logout.php` - User logout

### Courses
- `GET /includes/get_course.php` - Get course details
- `POST /includes/add_course.php` - Create new course
- `POST /includes/update_course.php` - Update course
- `POST /includes/delete_course.php` - Delete course

### Equipment
- `GET /includes/get_equipment.php` - Get equipment details
- `POST /includes/add_equipment.php` - Add new equipment
- `POST /includes/update_equipment.php` - Update equipment
- `POST /includes/delete_equipment.php` - Delete equipment

### Course-Equipment Links
- `POST /includes/add_course_equipment.php` - Link course with equipment

##  Development

### Running in Development Mode

1. Start the containers:
   ```bash
   docker-compose up -d
   ```

2. View logs:
   ```bash
   docker-compose logs -f
   ```

3. Stop containers:
   ```bash
   docker-compose down
   ```

4. Stop and remove volumes ( This will delete database data):
   ```bash
   docker-compose down -v
   ```

### Tailwind CSS Development

If you need to rebuild Tailwind CSS:

```bash
npx tailwindcss -i ./public/src/input.css -o ./public/src/output.css --watch
```

### Database Access

**Via phpMyAdmin:**
- URL: http://localhost:8081
- Server: `mysql`
- Username: `root`
- Password: `root`

**Via Command Line:**
```bash
docker exec -it fitmanager-mysql mysql -ufituser -ppassword fit_manager
```

##  Troubleshooting

### Port Already in Use

If you get port conflicts, modify the ports in `docker-compose.yml`:

```yaml
ports:
  - "8080:80"  # Change 8080 to another port
```

### Database Connection Issues

1. Ensure MySQL container is running:
   ```bash
   docker ps
   ```

2. Check database credentials in `db.php`

3. Verify database exists:
   ```bash
   docker exec -it fitmanager-mysql mysql -uroot -proot -e "SHOW DATABASES;"
   ```

### Permission Denied Errors

On Linux/Mac, you may need to adjust file permissions:

```bash
chmod -R 755 public/
chmod -R 755 includes/
```

### Session Issues

Ensure the `app/auth/auth_session.php` file is properly included in pages that require authentication.

##  License

[MIT License](LICENSE).

##  Author

hamza.lafsioui@gmail.com

##  Contributing

Contributions, issues, and feature requests are welcome! -)

---


