CREATE TABLE users (
    id         INT UNSIGNED    NOT NULL AUTO_INCREMENT,
    email      VARCHAR(255)    NOT NULL,
    phone      VARCHAR(32)     NOT NULL,
    password   VARCHAR(50)     NOT NULL,
    created_at INT UNSIGNED    NOT NULL DEFAULT UNIX_TIMESTAMP(),
    updated_at INT UNSIGNED    NOT NULL DEFAULT UNIX_TIMESTAMP(),

    PRIMARY KEY (`id`),
    UNIQUE KEY `users_phone_uidx` (`phone`),
    UNIQUE KEY `users_email_uidx` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO users (email, phone, password) VALUES ('admin@basuracero.com', '5491155554444', 'password');
