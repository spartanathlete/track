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
    day_id int not null
);

drop table exercices;

create table exrs_info(
	id int primary key auto_increment,
    reps int not null,
    sets int not null,
    weight int not null,
    day_id int not null,
    ex_id int not null,
    date date not null
);

drop table exrs_info;

select * from exercices;
select * from exrs_info;

# From 'Days' table we'll print 'exercices.name' & 'exrs_info.reps.sets.weight'
select * from days where id=1;
select * from exercices where day_id=1;
select * from exrs_info where day_id=1;

select e.name as Exercice, ex.reps as Reps, ex.sets as Sets, ex.weight as Weight
from exercices e inner join exrs_info ex on e.day_id = ex.day_id
where e.day_id=1;