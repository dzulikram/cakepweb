/*==============================================================*/
/* dbms name:      mysql 5.0                                    */
/* created on:     13/05/2020 00:25:44                          */
/*==============================================================*/


drop table if exists diklat;

drop table if exists laporan_hcr;

drop table if exists penilaian;

drop table if exists penugasan_hcr;

drop table if exists role;

drop table if exists sertifikasi_hcr;

drop table if exists unit;

drop table if exists user;

/*==============================================================*/
/* table: diklat                                                */
/*==============================================================*/
create table diklat
(
   diklat_id            int not null auto_increment,
   user_id              int,
   jenis_diklat         varchar(100),
   sejak                date,
   hingga               date,
   lembaga_pendidikan   varchar(100),
   judul_diklat         varchar(100),
   no_sertifikat        varchar(100),
   tanggal_sertifikat   date,
   primary key (diklat_id)
);

/*==============================================================*/
/* table: laporan_hcr                                           */
/*==============================================================*/
create table laporan_hcr
(
   laporan_hcr_id       int not null auto_increment,
   user_id              int,
   daftar_aktivitas_pengembangan varchar(1024),
   level_profisiensi    varchar(100),
   tanggal_selesai_pelaksanaan date,
   output_laporan_hcr   varchar(100),
   primary key (laporan_hcr_id)
);

/*==============================================================*/
/* table: penilaian                                             */
/*==============================================================*/
create table penilaian
(
   penilaian_id         int not null auto_increment,
   user_id              int,
   penilaian_nama       varchar(100),
   nilai                int,
   primary key (penilaian_id)
);

/*==============================================================*/
/* table: penugasan_hcr                                         */
/*==============================================================*/
create table penugasan_hcr
(
   penugasan_hcr_id     int not null auto_increment,
   user_id              int,
   kode_sjf             varchar(100),
   competency_profile   varchar(100),
   aktivitas            varchar(100),
   tanggal_awal_penugasan date,
   tanggal_akhir_penugasan date,
   aktivitas_penugasan  varchar(100),
   keterangan           varchar(100),
   primary key (penugasan_hcr_id)
);

/*==============================================================*/
/* table: role                                                  */
/*==============================================================*/
create table role
(
   role_id              int not null auto_increment,
   role_nama            varchar(100),
   primary key (role_id)
);

/*==============================================================*/
/* table: sertifikasi_hcr                                       */
/*==============================================================*/
create table sertifikasi_hcr
(
   sertifikasi_hcr_id   int not null auto_increment,
   user_id              int,
   kode_sjf             varchar(100),
   competency_profile   varchar(100),
   judul_sertifikasi    varchar(100),
   lembaga_sertifikasi  varchar(100),
   no_sertfikat_sertifikasi varchar(100),
   tanggal_awal_sertifikat date,
   tanggal_akhir_sertifikat date,
   status               varchar(100),
   keterangan           varchar(100),
   primary key (sertifikasi_hcr_id)
);

/*==============================================================*/
/* table: unit                                                  */
/*==============================================================*/
create table unit
(
   unit_id              int not null auto_increment,
   unit_nama            varchar(100),
   personnel_area       varchar(10),
   personnel_sub_area   varchar(100),
   primary key (unit_id)
);

/*==============================================================*/
/* table: user                                                  */
/*==============================================================*/
create table user
(
   user_id              int not null auto_increment,
   unit_id              int,
   role_id              int,
   nip                  varchar(20),
   username             varchar(100),
   password             varchar(1024),
   personal_number      varchar(20),
   nama_lengkap         varchar(200),
   grade                varchar(200),
   jenjang_jabatan      varchar(200),
   jabatan              varchar(200),
   marital_status       int,
   gender               int,
   telepon              varchar(20),
   email                varchar(100),
   bank_account         varchar(200),
   no_rekening          varchar(30),
   jenjang_pendidikan   varchar(100),
   golongan_darah       varchar(5),
   tanggal_grade_terakhir date,
   tanggal_masuk        date,
   tanggal_capeg        date,
   tanggal_pegawai_tetap date,
   birth_date           date,
   masa_kerja           int,
   kelompok_masa_kerja  int,
   usia                 int,
   kelompok_usia        int,
   ulang_tahun          date,
   tahun_pensiun        date,
   tanggal_jabat        date,
   masa_jabat           int,
   primary key (user_id)
);

alter table diklat add constraint fk_relationship_4 foreign key (user_id)
      references user (user_id) on delete restrict on update restrict;

alter table laporan_hcr add constraint fk_relationship_5 foreign key (user_id)
      references user (user_id) on delete restrict on update restrict;

alter table penilaian add constraint fk_relationship_3 foreign key (user_id)
      references user (user_id) on delete restrict on update restrict;

alter table penugasan_hcr add constraint fk_relationship_7 foreign key (user_id)
      references user (user_id) on delete restrict on update restrict;

alter table sertifikasi_hcr add constraint fk_relationship_6 foreign key (user_id)
      references user (user_id) on delete restrict on update restrict;

alter table user add constraint fk_relationship_1 foreign key (role_id)
      references role (role_id) on delete restrict on update restrict;

alter table user add constraint fk_relationship_2 foreign key (unit_id)
      references unit (unit_id) on delete restrict on update restrict;

