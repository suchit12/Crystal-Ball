CREATE DATABASE production_machines;

CREATE TABLE(
	ServerName varchar(40),
	Application varchar(40),
	Version int(40),
	PreviousUpdate date
	
);

INSERT INTO production_servers (ServerName, 
	Application, Version, PreviousUpdate) VALUES 
	'prearchiver02-02.usw', 'Java', '4.5.2', '2015-06-07' );