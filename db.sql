CREATE TABLE urls (
    code VARCHAR(255) PRIMARY KEY,
    long_url VARCHAR(255) NOT NULL,
    visit_counter BIGINT NOT NULL DEFAULT 0,
    user_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) UNIQUE,
    pwd_hash CHAR(64) NOT NULL,
    username TEXT NOT NULL,
    credit DECIMAL(19,4) DEFAULT 0,
    plan INT,
    FOREIGN KEY (plan) REFERENCES plans(id)
);

CREATE TABLE plans (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    description VARCHAR(255),
    price INT DEFAULT 0,
    code_length INT,
    max_codes INT
);