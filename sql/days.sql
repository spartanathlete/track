select * from days where id=1;

insert into days (name, description, date) values 
	('Push', 'Shoulders, Chest and Triceps', '2022-01-29'),
    ('Pull', 'Back and Biceps', '2022-01-30'),
    ('Legs', 'Quads, Hams and Calves', '2022-01-31');
    
select d.name as name, d.description as description, d.date as date, e.name as e_name, e.reps as reps, e.sets as sets, e.weight as weight
from days d, exercices e
where id=1 and date="2022-01-29";