CREATE DATABASE production_machines;

CREATE TABLE(
	ServerName varchar(40),
	Application varchar(40),
	Version int(40),
	PreviousUpdate date
	
);

INSERT INTO production_servers (ServerName, 
	Application, Version, PreviousUpdate) VALUES 
	('prearchiver02-02.usw', 'Java', '4.5.2', '2015-06-07'), 
	('c05-escold02-02.sv4', 'Python', '8.6.4', '2016-05-04')
	('c05-escold02-03.sv4', 'Java', '6.7.8', '2017-08-24' )
	('prearchiver01-usw2','PHP',' 6.7.2 ','2014-09-25 ')
	('prearchiver02-usw2 ','PHP ','7.8.3 ','2015-03-22 ')
	('prearchiver04-usw2 ','MySql',' 5.3.2 ','2015-09-15')
	('c07-escold06-02.sv4',' Python ','8.1.2 ','2015-09-01')
	('c07-escold06-01.sv4' ,'Python' ,'5.6.3' ,'2015-02-02')
	('c05-swriter01.sv4' ,'PHP' ,'4.5.2' ,'2016-05-09')
	('c05-escold04-02.sv4','Java', '7.1.2', '2017-06-13')
;

