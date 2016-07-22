create table customer(
	id int(11) not null auto_increment,
	email varchar(200),
	password varchar(200),
	nama varchar(200),
	alamat varchar(200),
	status int(11),
	primary key(id)
);

create table alat(
	id int(11) not null auto_increment,
	nama varchar(200),
	deskripsi varchar(200),
	stok varchar(200),
	harga_harian varchar(200),
	primary key(id)
);