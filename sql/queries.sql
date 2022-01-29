create database track_demo;
use track_demo;

create table days(
	id int primary key auto_increment,
    name varchar(25) not null,
    description varchar(125) not null,
    date date not null
);

create table exercices(
	id int primary key auto_increment,
    name varchar(30) not null,
    description varchar(125) not null,
    date date not null
);

create table exrs_info(
	id int primary key auto_increment,
    reps int not null,
    sets int not null,
    weight int not null,
    exr_id int not null,
    date date not null
);