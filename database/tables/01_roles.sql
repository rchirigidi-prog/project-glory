/*
=========================================================
Table : roles
Description : User Roles
=========================================================
*/

CREATE TABLE IF NOT EXISTS roles (

    id INT AUTO_INCREMENT PRIMARY KEY,

    name VARCHAR(100) NOT NULL UNIQUE,

    description TEXT,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

);

INSERT INTO roles (name, description)
VALUES

('Super Admin','Complete access'),

('Administrator','Administrative access'),

('Editor','Website content management'),

('Music Manager','Albums and Songs'),

('Radio Manager','Radio Station Management');