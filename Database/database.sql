CREATE TABLE students(
    id int (100) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    student_id varchar(100) NOT NULL,
    firstname varchar(100) NOT NULL,
    lastname varchar(100) NOT NULL,
    course varchar(100) NOT NULL,
    level varchar(100) NOT NULL,
    address varchar(100) NOT NULL,
    phonenumber varchar(100) NOT NULL,
    email varchar(100) NOT NULL,
    profilepic varchar(100) NOT NULL,
    status varchar(100) NOT NULL,
    created_at TIMESTAMP NOT NULL
);


CREATE TABLE events(
    id int (100) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    event_name varchar(100) NOT NULL,
    date varchar(100) NOT NULL,
    eventdesc LONGTEXT NOT NULL,
    status varchar(100) NOT NULL,
    timeago varchar(100) NOT NULL,
    created_at TIMESTAMP NOT NULL
);

CREATE TABLE staff(
    id int (100) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    fullname varchar(100) NOT NULL,
    email varchar(100) NOT NULL,
    phonenumber varchar(100) NOT NULL,
    status varchar(100) NOT NULL,
    created_at TIMESTAMP NOT NULL
);

CREATE TABLE admin(
    id int (100) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    email varchar(100) NOT NULL,
    password varchar(100) NOT NULL,
    created_at TIMESTAMP NOT NULL
);

CREATE TABLE ongoing_events(
    id int (100) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    event_id varchar(100) NOT NULL,
    student_id varchar(100) NOT NULL,
    date varchar(100) NOT NULL,
    timein varchar(100) NOT NULL,
    timeout varchar(100) NOT NULL,
    timeago varchar(100) NOT NULL,
    created_at TIMESTAMP NOT NULL
);

INSERT INTO `admin` (`id`, `email`, `password`, `created_at`) VALUES (1, 'app.admin@gmail.com', '$2y$10$25joPVhJbt8E5v/GPkNgt.YozYTGC1q76LSQ5koDaxzDGo7FTpYxG', current_timestamp());