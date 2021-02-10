create database api_senjani_kitchen;

create table pelanggan(
    pelanggan_id int(10) primary key auto_increment unsigned,
    email varchar(50),
    password varchar(50),
    salt text,
    nama_lengkap varchar(50),
    alamat varchar(100),
    no_hp_wa varchar(20),
    alergi_makanan varchar(150),
    created_by int(11),
    created_date datetime,
    updated_by int(11),
    updated_date datetime
)ENGINE=INNODB;

insert into pelanggan(
    email, 
    password, 
    salt,
    nama_lengkap, 
    alamat, 
    no_hp_wa, 
    alergi_makanan,) values
('bariq123@gmail.com', 
'bariq123', 
'Baariq Fairuuz Azhar', 
'Jl. Candi 2C No.557 (Kos Rahman 99), Karangbesuki, Kec. Sukun, Kota Malang, Jawa Timur 65149',
'087738210702',
'-')

insert into pelanggan(email, password, namaLengkap, alamat, noHpWa, alergiMakanan) values
('zain123@gmail.com', 
'zain123', 
'Zainuri Mahmud', 
'Jalan Kadaka no 25, Malang, Indonesia',
'0812345678',
'tidak mau sayur pahit')