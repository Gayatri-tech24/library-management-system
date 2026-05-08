create database library_db;
use library_db;

create table student
( 
usn varchar(50) primary key,
name varchar(50) not null,
class varchar(3),
branch varchar(20),
year int,
email varchar(100) unique
);

create table books
( bookid int primary key,
name varchar(50),
author varchar(50),
available_status enum('yes','no') default 'yes'
);

create table librarian
(
id int primary key,
name varchar(25)
);

create table borrow
(
borrow_id int primary key auto_increment,
usn varchar(50),
bookid int ,
librarian_id int,
issue_date date not null,
return_date date,
fine decimal(10,2) default 0,

foreign key (usn) references student(usn),
foreign key (bookid) references books(bookid),
foreign key (librarian_id) references librarian(id)
);
