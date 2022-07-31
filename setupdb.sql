# CREATE USER 'qset'@'localhost' IDENTIFIED BY 'space120';
# GRANT ALL PRIVILEGES ON * . * TO 'qset'@'localhost';

CREATE DATABASE inventory;

USE inventory;

CREATE TABLE inventory.part_source
(
    part_number           varchar(100)   not null,
    source                varchar(100)   not null,
    price_per_unit        decimal(10, 2) not null,
    number_purchased      int            not null,
    purchase_order_number varchar(100)   not null,
    purchase_date         DATE           not null,
    owner                 varchar(20)    not null,
    project_no            varchar(20)    not null,
    primary key (part_number, project_no, purchase_order_number, number_purchased)
);

CREATE TABLE inventory.items
(
    part_number varchar(100) not null ,
    quantity    int          not null,
    location    varchar(100) not null ,
    owner       varchar(20)  not null,
    project_no  varchar(20)  not null,
    description varchar(1000) not null,
    primary key (part_number, project_no, owner, location)
);

CREATE TABLE inventory.transactions
(
    transaction_id int not null auto_increment primary key ,
    part_number varchar(100) not null,
    quantity int not null,
    purchase_order_number varchar(100),
    transaction_date DATE not null,
    person varchar(20) not null
);

insert into part_list (part_number, description)
values ("TEST_PART", "TEST_PART DESCRIPTION");

insert into part_list (part_number, description)
values ("TEST_PART1", "TEST_PART DESCRIPTION1");

insert into part_list (part_number, description)
values ("PART_TEST1", "PART_TEST DESCRIPTION1");

insert into items (part_number, quantity, location, owner, project_no, required)
VALUES ("TEST_PART", 5, "Red Shelf", "OWEN HOOPER", "ECE-5", false);

insert into items (part_number, quantity, location, owner, project_no, required)
VALUES ("TEST_PART1", 3, "Blue Shelf", "OWEN HOOPER", "ECE-5", false);

insert into items (part_number, quantity, location, owner, project_no, required)
VALUES ("PART_TEST1", 5, "Blue Shelf", "LILY DE LOE", "SCI-1", false);

insert into items (part_number, quantity, location, owner, project_no, required)
VALUES ("PART_TEST1", 5, "Red Shelf", "LILY DE LOE", "SCI-2", false);

insert into part_source (part_number, source, price_per_unit, number_purchased, purchase_order_number, purchase_date,
                         owner, project_no)
values ("TEST_PART", "DIGIKEY", 25.45, 56, 'A2SDEBSD' ,DATE('2021-06-23'), 'OWEN HOOPER', 'ECE-5');

insert into part_source (part_number, source, price_per_unit, number_purchased, purchase_order_number, purchase_date,
                         owner, project_no)
values ("TEST_PART", "DIGIKEY", 25.45, 56, 'A2SDEBSD' ,DATE('2021-06-24'), 'OWEN HOOPER', 'ECE-5');

insert into part_source (part_number, source, price_per_unit, number_purchased, purchase_order_number, purchase_date,
                         owner, project_no)
values ("TEST_PART", "DIGIKEY", 25.45, 56, 'THESDSD' ,DATE('2021-06-23'), 'OWEN HOOPER', 'ECE-5');
