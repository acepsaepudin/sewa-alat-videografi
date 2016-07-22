create table customer(
	id int(11) not null auto_increment,
	email varchar(200),
	password varchar(200),
	nama varchar(200),
	alamat varchar(200),
	status int(11),
	primary key(id)
);

create table pegawai(
	id int(11) not null auto_increment,
	nama varchar(200),
	jabatan int(1),
	email varchar(200),
	password varchar(200),
	alamat varchar(200),
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

create table sewa(
	id int(11) not null auto_increment,
	tanggal_input datetime,
	total_harga varchar(200),
	customer_id int(11),
	primary key(id)
);

create table sewa_detail(
	id int(11) not null auto_increment,
	sewa_id int(11),
	alat_id int(11),
	tgl_sewa datetime,
	total_hari int(11),
	jumlah int(11),
	status int(11),
	primary key(id)
);