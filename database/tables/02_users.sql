/*
=========================================================
Table : users
=========================================================
*/

CREATE TABLE IF NOT EXISTS users (

    id INT AUTO_INCREMENT PRIMARY KEY,

    role_id INT NOT NULL,

    name VARCHAR(150) NOT NULL,

    email VARCHAR(255) UNIQUE NOT NULL,

    password VARCHAR(255) NOT NULL,

    avatar VARCHAR(255),

    status ENUM('Active','Inactive')
        DEFAULT 'Active',

    last_login DATETIME NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_users_role

        FOREIGN KEY (role_id)

        REFERENCES roles(id)

);