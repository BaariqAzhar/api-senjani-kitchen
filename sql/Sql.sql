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
) ENGINE = INNODB;
insert into pelanggan(
        email,
        password,
        salt,
        nama_lengkap,
        alamat,
        no_hp_wa,
        alergi_makanan,
    )
values (
        "bariq123@gmail.com",
        "bariq123",
        "Baariq Fairuuz Azhar",
        "Jl. Candi 2C No.557 (Kos Rahman 99), Karangbesuki, Kec. Sukun, Kota Malang, Jawa Timur 65149",
        "087738210702",
        "-"
    )
ALTER TABLE pelanggan DROP COLUMN salt;
create TABLE menu(
    menu_id int(10) PRIMARY key AUTO_INCREMENT,
    tanggal_menu datetime,
    waktu_menu ENUM("pagi", "siang", "sore"),
    nama_menu varchar(100),
    keterangan_menu varchar(200),
    foto_menu varchar(50),
    created_by int(11),
    created_date datetime,
    updated_by int(11),
    updated_date datetime
) engine = innodb;
ALTER TABLE pelanggan
    RENAME COLUMN pelanggan_id TO id_pelanggan;
ALTER TABLE pelanggan CHANGE COLUMN pelanggan_id TO id_pelanggan;
create TABLE paket_kupon(
    id_paket_kupon INT(10) primary KEY auto_increment,
    kode_paket_kupon varchar(50),
    jenis_paket_kupon enum(
        "basic_meal_box",
        "reusable_meal_box",
        "deluxe_meal_box",
        "couple_pack",
        "family_pack"
    ),
    jumlah_kupon int(5),
    jenis_nasi enum(
        "nasi_merah",
        "nasi_putih",
        "tanpa_nasi"
    ),
    jumlah_nasi int(5),
    lauk_tambahan varchar(50),
    harga int(20),
    created_by int(11),
    created_date datetime,
    updated_by int(11),
    updated_date datetime
) engine = innodb;
create TABLE kupon_pelanggan(
    id_kupon_pelanggan INT(10) primary KEY auto_increment,
    kode_kupon_pelanggan varchar(50),
    id_paket_kupon INT(10),
    id_pelanggan int(10),
    tanggal_pembelian_kupon date,
    tanggal_kedaluwarsa date,
    jumlah_kupon_tersisa int(10),
    status_kupon enum(
        "belum_dibayar",
        "menunggu_dibayar",
        "sudah_dibayar",
        "gagal_dibayar"
    ),
    cara_pembayaran enum(
        "ovo",
        "gopay",
        "dana",
        "link_aja",
        "bni",
        "jenius"
    ),
    waktu_batas_pembayaran datetime,
    bukti_pembayaran varchar(225),
    created_by int(11),
    created_date datetime,
    updated_by int(11),
    updated_date datetime,
) engine = innodb;
create TABLE pesanan(
    id_pesanan INT(10) PRIMARY KEY auto_increment,
    id_pelanggan int(10),
    id_menu int(10),
    id_kupon_pelanggan int(10),
    kode_pesanan varchar(50),
    waktu_pemesanan datetime,
    nama_penerima varchar(50),
    no_hp_wa_penerima varchar(20),
    alamat_penerima varchar(100),
    alergi_makanan_penerima varchar(150),
    status_pesanan enum(
        "belum_dikirim",
        "sudah_dikirim",
        "gagal_dikirim",
        "pesanan_dibatalkan"
    ),
    catatan_pesanan varchar(250),
    created_by int(11),
    created_date datetime,
    updated_by int(11),
    updated_date datetime
) engine = innodb;