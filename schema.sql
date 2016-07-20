create table customer(
	id int(11) not null auto_increment,
	email varchar(200),
	password varchar(200),
	nama varchar(200),
	alamat varchar(200),
	status int(11),
	primary key(id)
);