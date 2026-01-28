CREATE TABLE users (
    id             INT UNSIGNED    NOT NULL AUTO_INCREMENT,
    name           VARCHAR(50)     NOT NULL,
    surname        VARCHAR(50)     NOT NULL,
    phone          VARCHAR(32)     NOT NULL,
    document       VARCHAR(32)     NOT NULL,
    address        VARCHAR(32)     NOT NULL,
    floor          VARCHAR(4)      NOT NULL,
    password       VARCHAR(64)     NOT NULL,
    created_at INT UNSIGNED    NOT NULL DEFAULT UNIX_TIMESTAMP(),
    updated_at INT UNSIGNED    NOT NULL DEFAULT UNIX_TIMESTAMP(),

    PRIMARY KEY (`id`)
);