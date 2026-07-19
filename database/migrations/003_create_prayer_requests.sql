CREATE TABLE IF NOT EXISTS prayer_requests (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,

    name VARCHAR(150) NOT NULL,

    email VARCHAR(255) DEFAULT NULL,

    title VARCHAR(255) NOT NULL,

    request LONGTEXT NOT NULL,

    category VARCHAR(100) NOT NULL DEFAULT 'General',

    status ENUM(
        'pending',
        'approved',
        'answered'
    ) NOT NULL DEFAULT 'pending',

    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    PRIMARY KEY (id),

    KEY idx_status (status),

    KEY idx_category (category),

    KEY idx_created_at (created_at)

) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_uca1400_ai_ci;
