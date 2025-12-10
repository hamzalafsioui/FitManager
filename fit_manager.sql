CREATE DATABASE IF NOT EXISTS fit_manager;
USE fit_manager;

select * from courses;

-- TABLE ROLES
CREATE TABLE roles(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

-- TABLE USERS
DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    role_id INT NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    gender CHAR(1),
    age INT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    is_active TINYINT(1) DEFAULT 1,
    FOREIGN KEY (role_id) REFERENCES roles(id)
);


-- TABLE COURSES
CREATE TABLE courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    category_id INT NOT NULL,
    course_date DATE NOT NULL,
    course_time TIME NOT NULL,
    duration INT NOT NULL,
    max_participants INT NOT NULL,
    FOREIGN KEY (category_id) REFERENCES categories(id)
);
-- TABLE CATEGORIES (Course Categories)
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);


-- TABLE EQUIPMENT TYPES
CREATE TABLE equipment_types (
    id INT AUTO_INCREMENT PRIMARY KEY,
    type_name VARCHAR(100) NOT NULL
);

-- TABLE EQUIPMENT STATES
CREATE TABLE equipment_states (
    id INT AUTO_INCREMENT PRIMARY KEY,
    state_name VARCHAR(50) NOT NULL
);

-- TABLE EQUIPMENT
CREATE TABLE equipments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    type_id INT NOT NULL,
    quantity INT DEFAULT 1,
    state_id INT NOT NULL,
    FOREIGN KEY (type_id) REFERENCES equipment_types(id),
    FOREIGN KEY (state_id) REFERENCES equipment_states(id)
);

-- TABLE ASSOCIATIVE (COURSE - EQUIPMENT)
CREATE TABLE course_equipment (
    course_id INT NOT NULL,
    equipment_id INT NOT NULL,
    PRIMARY KEY (course_id, equipment_id),
    FOREIGN KEY (course_id) REFERENCES courses(id),
    FOREIGN KEY (equipment_id) REFERENCES equipments(id)
);

INSERT INTO roles (name) VALUES 
('admin'),
('trainer'),
('member');


SHOW TABLES FROM fit_manager;
select * from courses


SELECT 
    c.*, 
    cat.name AS category_name
FROM courses c
JOIN categories cat ON c.category_id = cat.id
WHERE c.id = 1;
