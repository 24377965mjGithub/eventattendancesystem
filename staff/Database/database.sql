CREATE DATABASE sitoda;

CREATE TABLE users(
    id int (100) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    fullname varchar(100) NOT NULL,
    age varchar(100) NOT NULL,
    gender varchar(100) NOT NULL,
    address varchar(100) NOT NULL,
    phonenumber varchar(100) NOT NULL,
    email varchar(100) NOT NULL,
    password varchar(100) NOT NULL,
    profilepic varchar(100) NOT NULL,
    created_at TIMESTAMP NOT NULL
);

INSERT INTO users (id, fullname, age, gender, address, phonenumber, email, password, profilepic)
VALUES (0, 'Admin', 23, '---', '---', '09978972884', 'admin@gmail.com', '$2y$10$/hSSN1kxx3WZipuxXOXld.ImCq/pv1kIyiNByuI.pw39DzqnHChti', 'profile.jpg');

CREATE TABLE reservation(
    id int (100) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    client int(100) NOT NULL,
    type varchar(100) NOT NULL,
    quantity int(100) NOT NULL,
    current_location varchar(100) NOT NULL,
    destination_location varchar(100) NOT NULL,
    date_time_created varchar(100) NOT NULL,
    date varchar(100) NOT NULL,
    time varchar(100) NOT NULL,
    fare varchar(100) NOT NULL,
    approval varchar(100) NOT NULL,
    seen_status varchar(100) NOT NULL,
    driver varchar(100) NOT NULL,
    plate_number varchar(100) NOT NULL,
    created_at TIMESTAMP NOT NULL
);

CREATE TABLE admin_updates(
    id int(100) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    date varchar(100) NOT NULL,
    title varchar(100) NOT NULL,
    updates LONGTEXT NOT NULL,
    created_at TIMESTAMP NOT NULL
);

CREATE TABLE drivers(
    id int (100) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    fullname varchar(100) NOT NULL,
    age varchar(100) NOT NULL,
    address varchar(100) NOT NULL,
    phonenumber varchar(100) NOT NULL,
    plate_number varchar(100) NOT NULL,
    availability varchar(100) NOT NULL,
    created_at TIMESTAMP NOT NULL
);