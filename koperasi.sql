/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 10.4.27-MariaDB : Database - koperasi
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`koperasi` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `koperasi`;

/*Table structure for table `tbl_anggota` */

DROP TABLE IF EXISTS `tbl_anggota`;

CREATE TABLE `tbl_anggota` (
  `id_anggota` int(11) NOT NULL AUTO_INCREMENT,
  `id_fakultas` int(11) DEFAULT NULL,
  `nama_anggota` varchar(100) DEFAULT NULL,
  `alamat_anggota` varchar(255) DEFAULT NULL,
  `no_tlpn` varchar(15) DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `tanggal_gabung` date DEFAULT NULL,
  `status` enum('Aktif','Tidak Aktif') DEFAULT NULL,
  PRIMARY KEY (`id_anggota`),
  KEY `id_fakultas` (`id_fakultas`)
) ENGINE=InnoDB AUTO_INCREMENT=1403 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tbl_anggota` */

insert  into `tbl_anggota`(`id_anggota`,`id_fakultas`,`nama_anggota`,`alamat_anggota`,`no_tlpn`,`jenis_kelamin`,`tanggal_gabung`,`status`) values 
(1123,1,'Prof. Dr. Eddy Lion, M. Pd','JL. PANGRANGO 8','60968579419.8','L','2018-04-10','Aktif'),
(1124,1,'Prof. Dr.Holten Sion, M.Pd.','JL. BELIBIS 14','60954579597.6','L','2016-04-11','Aktif'),
(1125,1,'Drs. Pantur Pandiangan, M.Pd','JL. LAWU 9','60940579775.4','L','2014-04-13','Aktif'),
(1126,1,'Dra. Sumarnie, M.Pd','JL. BAJAU RANJU 8','60926579953.2','P','2015-04-14','Aktif'),
(1127,1,'Drs. Cukei, M.Pd','JL. RAJAWALI 12','60912580131','L','2013-04-16','Aktif'),
(1128,1,'Dra. Sri Puryaningsih, M.Pd','JL. MENTENG 13','60898580308.8','P','2016-04-17','Aktif'),
(1129,1,'Dr. Tonich, M.Si','JL. TILUNG 7','60884580486.6','L','2016-04-19','Aktif'),
(1130,1,'Drs. H. Suparman, M.Pd','JL. RANYING SURING 5','60870580664.4','L','2018-04-20','Aktif'),
(1131,1,'Drs. Walter Punding, M.Pd','JL. PANGRANGO 7','60856580842.2','L','2019-03-29','Aktif'),
(1132,1,'Drs. Henry Aritonang, M.Pd','JL. BELIBIS 6','60842581020','L','2019-03-30','Aktif'),
(1133,1,'Drs. Ardo Subagjo, M.Pd','JL. BELIBIS 7','60828581197.8','L','2019-03-31','Aktif'),
(1134,1,'Dr. Dehen , M.Si.','JL. KRAKATAU 8','60814581375.6','L','2019-04-01','Aktif'),
(1135,1,'Dr. Manesa, M.Pd','JL. BUKIT RAYA 9','60800581553.4','P','2019-04-02','Aktif'),
(1136,1,'Drs. Janu Pinardi, M.Si.','JL. PANGRANGO 8','60786581731.2','L','2019-04-03','Aktif'),
(1137,1,'Prof. Dr. Petrus Poerwadi, MS','JL. BELIBIS 7','60772581909','L','2018-04-10','Aktif'),
(1138,1,'Drs. Elyasib Y. Lada, M.Pd','JL. BELIBIS 15','60758582086.8','P','2016-04-11','Aktif'),
(1139,1,'Dra. Intan Kamala, S.Pd, M.Pd','JL. LAWU 10','60744582264.6','P','2016-04-11','Aktif'),
(1140,1,'Drs. M. Nawir, M.Si','JL. BAJAU RANJU 9','60730582442.4','L','2014-04-13','Aktif'),
(1141,1,'Drs. Dagai, M.Pd','JL. RAJAWALI 13','60716582620.2','L','2015-04-14','Aktif'),
(1142,1,'Dra. Sapriline, M.Pd','JL. MENTENG 14','60702582798','P','2013-04-16','Aktif'),
(1143,1,'Drs. Muhamad Hamdani, M.Pd','JL. TILUNG 8','60688582975.8','L','2016-04-17','Aktif'),
(1144,1,'Dra.Pancarita, M.Pd.','JL. RANYING SURING 6','60674583153.6','L','2016-04-19','Aktif'),
(1145,1,'Prof. Dr. Suandi Sidauruk, M.Pd','JL. PANGRANGO 8','60660583331.4','L','2018-04-20','Aktif'),
(1146,1,'Prof. Dr. Joni Bungai, M.Pd','JL. BELIBIS 8','60646583509.2','L','2019-03-29','Aktif'),
(1147,1,'Drs. Tampung N. S, M.Lib.','JL. BELIBIS 9','60632583687','L','2019-03-30','Aktif'),
(1148,1,'Dr. KRISNAYADI TOENDAN, M.Si','JL. KRAKATAU 9','60618583864.8','L','2019-03-31','Aktif'),
(1149,2,'Dr. Yunikewaty, MM.','JL. PANGRANGO 9','60604584042.6','P','2018-04-10','Aktif'),
(1150,2,'Drs. Asriansyah S. Mawung, M.Si','JL. BELIBIS 15','60590584220.4','P','2016-04-11','Aktif'),
(1151,2,'Drs. Misel, ME','JL. LAWU 10','60576584398.2','P','2014-04-13','Aktif'),
(1152,2,'Drs. Murie Piter Kulu, M.Si.','JL. BAJAU RANJU 9','60562584576','P','2015-04-14','Aktif'),
(1153,2,'Drs. Hamun S.Masin, Ak, M.Si','JL. RAJAWALI 13','60548584753.8','L','2013-04-16','Aktif'),
(1154,2,'Drs. Agau Lenin, MM.','JL. MENTENG 14','60534584931.6','L','2016-04-17','Aktif'),
(1155,2,'Drs.Yohanes Kalvin Anggen,MS.','JL. TILUNG 8','60520585109.4','L','2016-04-19','Aktif'),
(1156,2,'Drs. Pingo, M.Si.','JL. RANYING SURING 6','60506585287.2','L','2018-04-20','Aktif'),
(1157,2,'Drs. Bambang Mantikei Jaya Budi, M.Si','JL. PANGRANGO 8','60492585465','L','2019-03-29','Aktif'),
(1158,2,'Drs. Yoga Manurung, M.M','JL. BELIBIS 8','60478585642.8','L','2019-03-30','Aktif'),
(1159,2,'Dra. Talawang Mayang Murniati, MM','JL. BELIBIS 9','60464585820.6','P','2019-03-31','Aktif'),
(1160,2,'Drs. Jonfrid, MM','JL. KRAKATAU 9','60450585998.4','L','2019-04-01','Aktif'),
(1161,2,'Prof.Dr. Ferdinand, MS','JL. BUKIT RAYA 10','60436586176.2','L','2019-04-02','Aktif'),
(1162,2,'Drs. Damus, M.Si','JL. PANGRANGO 9','60422586354','L','2019-04-03','Aktif'),
(1163,2,'Dr. Usup Riassy Christa, MM.','JL. BELIBIS 23','60408586531.8','P','2018-04-10','Aktif'),
(1164,2,'Drs. Tindan, MM','JL. BELIBIS 31','60394586709.6','P','2016-04-11','Aktif'),
(1165,2,'Dra. Mutmainah, AK.','JL. LAWU 11','60380586887.4','P','2016-04-11','Aktif'),
(1166,2,'Dr. Andrie Elia, M.Si','JL. BAJAU RANJU 10','60366587065.2','L','2014-04-13','Aktif'),
(1167,2,'Drs. Fiasco Darung, M.Si','JL. RAJAWALI 14','60352587243','L','2015-04-14','Aktif'),
(1168,2,'Drs. Dimer Merpati, M.Si.','JL. MENTENG 15','60338587420.8','L','2013-04-16','Aktif'),
(1169,2,'Dra. Trecy E. Anden, M.Pd.','JL. TILUNG 9','60324587598.6','P','2016-04-17','Aktif'),
(1170,2,'Dra. Sri Lestari  Hendrayati, M.Si','JL. RANYING SURING 7','60310587776.4','P','2016-04-19','Aktif'),
(1171,2,'Dr. Irawan M.Si','JL. PANGRANGO 9','60296587954.2','L','2018-04-20','Aktif'),
(1172,2,'Drs. Karmen Marpaung, MP.','JL. BELIBIS 10','60282588132','P','2019-03-29','Aktif'),
(1173,2,'Drs. Noorjaya, M.Si','JL. BELIBIS 11','60268588309.8','P','2019-03-30','Aktif'),
(1174,2,'Drs. Siang I.S, ME','JL. KRAKATAU 10','60254588487.6','P','2019-03-31','Aktif'),
(1175,2,'Drs. Ec. Rapel, Ak. MM.','JL. PANGRANGO 10','60240588665.4','L','2018-04-10','Aktif'),
(1176,2,'Hansly, SE, MM','JL. BELIBIS 16','60226588843.2','L','2016-04-11','Aktif'),
(1177,2,'Dra. EC. Solikah Nurwati, MM','JL. LAWU 11','60212589021','P','2014-04-13','Aktif'),
(1178,2,'Drs. Sabirin, ME.','JL. BAJAU RANJU 10','60198589198.8','P','2015-04-14','Aktif'),
(1179,2,'Drs. ASTON PAKPAHAN, MM','JL. RAJAWALI 14','60184589376.6','L','2013-04-16','Aktif'),
(1180,2,'Prof. Dr. Danes Jaya Negara, SE. M.Si','JL. MENTENG 15','60170589554.4','L','2016-04-17','Aktif'),
(1181,2,'Dr. Miar, MS','JL. TILUNG 9','60156589732.2','L','2016-04-19','Aktif'),
(1182,2,'Dr. Harin Tiawon, SE,MP.','JL. RANYING SURING 7','60142589910','L','2018-04-20','Aktif'),
(1183,2,'Drs. Harjoni, M.Si','JL. PANGRANGO 9','60128590087.8','L','2019-03-29','Aktif'),
(1184,2,'Lamria Simamora, SE, MSA, Ak','JL. BELIBIS 10','60114590265.6','P','2019-03-30','Aktif'),
(1185,2,'Dr. Sunaryo Neneng, MP','JL. BELIBIS 11','60100590443.4','L','2019-03-31','Aktif'),
(1186,2,'Dra. Anike Retawati, MM','JL. KRAKATAU 10','60086590621.2','L','2019-04-01','Aktif'),
(1187,2,'Dr. Lelo Sintani ,MM','JL. BUKIT RAYA 11','60072590799','P','2019-04-02','Aktif'),
(1188,2,'Drs. Benius, M.M., Ph.D.','JL. PANGRANGO 10','60058590976.8','L','2019-04-03','Aktif'),
(1189,2,'Drs. Dedi Takari, M.Ec','JL. BELIBIS 39','60044591154.6','L','2018-04-10','Aktif'),
(1190,2,'Penyang, S.Pd, M.Pd.','JL. BELIBIS 47','60030591332.4','L','2016-04-11','Aktif'),
(1191,2,'Dr. Darmae, Ak.,M.Si.,M.A.','JL. LAWU 12','60016591510.2','L','2016-04-11','Aktif'),
(1192,2,'Peridawaty, SE, MM','JL. BAJAU RANJU 11','60002591688','P','2014-04-13','Aktif'),
(1193,2,'Meitiana, SE, MM','JL. RAJAWALI 15','59988591865.8','P','2015-04-14','Aktif'),
(1194,3,'Ir. Inga Torang, M.Si','JL. PANGRANGO 2','62853555291','L','2018-04-01','Aktif'),
(1195,3,'Ir. H. Muhammad Saleh','JL. BELIBIS 4','62857555754','L','2018-06-02','Aktif'),
(1196,3,'Ir. Sweking Gandih','JL. BELIBIS 3','62819555831','L','2019-05-03','Aktif'),
(1197,3,'Ir. Petrus Soewar Senas','JL. KRAKATAU 3','62819555858','L','2020-02-04','Aktif'),
(1198,3,'Jumri Dulamin, Ir.','JL. BUKIT RAYA 4','62802556128','L','2019-02-05','Aktif'),
(1199,3,'Ir. Natalo Bugar','JL. PANGRANGO 3','62788556305.8','L','2016-02-06','Aktif'),
(1200,3,'Ici Piter Kulu, Ir.','JL. BELIBIS 2','62774556483.6','L','2017-02-07','Aktif'),
(1201,3,'Ir. I Nyoman Surasana, MP','JL. BELIBIS 1','62760556661.4','L','2015-02-08','Aktif'),
(1202,3,'Edison Harteman','JL. BATU SULI 4','62746556839.2','L','2016-02-09','Aktif'),
(1203,3,'Ir. Lilies Supriati','JL. BUKIT RAYA 5','62732557017','L','2016-02-10','Aktif'),
(1204,3,'Ir. Johansyah','JL. PANGRANGO 4','62718557194.8','L','2016-02-11','Aktif'),
(1205,3,'Ir. Erwyn, MP.','JL. BELIBIS 10','62704557372.6','L','2014-02-12','Aktif'),
(1206,3,'Ir. Oesin Oemar, MP','JL. LAWU 5','62690557550.4','L','2019-02-13','Aktif'),
(1207,3,'Ir. Herry','JL. BATU BADINDING 3','62676557728.2','L','2018-02-14','Aktif'),
(1208,3,'Ir. Nuwa','JL. MANDOMAI 8','62662557906','L','2017-02-15','Aktif'),
(1209,3,'Ir. Ruben Tinting Sirenden, M.Si.','JL. PANGRANGO 3','62648558083.8','L','2017-02-16','Aktif'),
(1210,3,'Ir. Hj. Masliani, MP','JL. BELIBIS 2','62634558261.6','L','2018-02-17','Aktif'),
(1211,3,'Moch. Anwar','JL. BELIBIS 1','62620558439.4','L','2019-02-18','Aktif'),
(1212,3,'Ir. Raden Mas Sukarna, M.Si','JL. KRAKATAU 4','62606558617.2','L','2022-02-19','Aktif'),
(1213,3,'Ir. Adrianson Agus Djaya, M.Si.','JL. BUKIT RAYA 5','62592558795','L','2021-02-20','Aktif'),
(1214,3,'Ir. Yohana Maria Rutinsulu, MP','JL. PANGRANGO 4','62578558972.8','P','2020-02-21','Aktif'),
(1215,3,'Ir. Suharno, MP','JL. BELIBIS 0','62564559150.6','L','2020-02-22','Aktif'),
(1216,3,'Ir. Matling, M.Si.','JL. BELIBIS 1','62550559328.4','L','2020-02-23','Aktif'),
(1217,3,'Ir. H. Saputra, M.Si','JL. BATU SULI 5','62536559506.2','L','2020-02-24','Aktif'),
(1218,3,'Ir. Yusintha Tanduh','JL. BUKIT RAYA 6','62522559684','P','2020-02-25','Aktif'),
(1219,3,'Panji Surawijaya, Ir.','JL. PANGRANGO 5','62508559861.8','L','2020-02-26','Aktif'),
(1220,3,'Ir. Basuki, M.Si','JL. BELIBIS 11','62494560039.6','L','2020-02-27','Aktif'),
(1221,3,'Ir. Yetrie Ludang','JL. LAWU 6','62480560217.4','P','2020-02-28','Aktif'),
(1222,3,'Ir. Sri Endang Agustina R.','JL. BATU BADINDING 4','62466560395.2','P','2020-02-29','Aktif'),
(1223,3,'Muliansyah','JL. MANDOMAI 9','62452560573','P','2020-03-01','Aktif'),
(1224,3,'Ir. Sari Mayawati, MP','JL. PANGRANGO 4','62438560750.8','P','2020-03-02','Aktif'),
(1225,3,'Ir. Moh. Rizal, M.Si','JL. BELIBIS 0','62424560928.6','L','2022-03-03','Aktif'),
(1226,3,'Ir. Robertho Imanuel Aden, MP','JL. BELIBIS 1','62410561106.4','L','2021-03-04','Aktif'),
(1227,3,'Lies Indrayanti, S.Hut., MT','JL. KRAKATAU 5','62396561284.2','P','2020-03-05','Aktif'),
(1228,3,'Nyahu Rumbang, Ir., MP','JL. BUKIT RAYA 6','62382561462','P','2019-03-06','Aktif'),
(1229,3,'Prof. Dr. Ir. Salampak D., MS.','JL. PANGRANGO 5','62368561639.8','L','2020-03-07','Aktif'),
(1230,3,'Pandriyani, SP.','JL. BELIBIS 2','62354561817.6','P','2015-03-08','Aktif'),
(1231,3,'Ir. Rolland Agustine, MP','JL. BELIBIS 3','62340561995.4','L','2016-03-09','Aktif'),
(1232,3,'Ir. Herwin Joni, MP','JL. BATU SULI 6','62326562173.2','L','2016-03-10','Aktif'),
(1233,3,'DR. Sulmin Gumiri, M.Sc., PHd','JL. BUKIT RAYA 7','62312562351','L','2020-03-11','Aktif'),
(1234,3,'Ir. Rosdiana','JL. PANGRANGO 6','62298562528.8','P','2020-03-12','Aktif'),
(1235,3,'Ir. Pordamantra','JL. BELIBIS 12','62284562706.6','L','2020-03-13','Aktif'),
(1236,3,'Ir. Untung Darung, MP','JL. LAWU 7','62270562884.4','L','2020-03-14','Aktif'),
(1237,3,'Ir. Sunariyo, MP','JL. BATU BADINDING 5','62256563062.2','L','2020-03-15','Aktif'),
(1238,3,'Ir. Yanarita, M.Si.','JL. MANDOMAI 10','62242563240','P','2020-03-16','Aktif'),
(1239,3,'Ir. Revi Sunaryati','JL. PANGRANGO 5','62228563417.8','P','2020-03-17','Aktif'),
(1240,3,'Ir. Sosilawaty, MP','JL. BELIBIS 2','62214563595.6','P','2015-03-18','Aktif'),
(1241,3,'Ir. Ahmad Mujaffar','JL. BELIBIS 3','62200563773.4','L','2015-03-19','Aktif'),
(1242,3,'Ir. Akhmad Sajarwan, MP','JL. KRAKATAU 6','62186563951.2','L','2020-03-20','Aktif'),
(1243,3,'Ir. Satrio Wibowo, M.Si','JL. BUKIT RAYA 7','62172564129','L','2017-03-21','Aktif'),
(1244,3,'Ir. Uras Tantulo, M.Sc.','JL. PANGRANGO 6','62158564306.8','L','2020-03-22','Aktif'),
(1245,3,'Rosita, S.Pi.','JL. BELIBIS 4','62144564484.6','P','2018-03-23','Aktif'),
(1246,3,'Ir. Shella AgnessyJullyta Winerungan, M.Si','JL. BELIBIS 5','62130564662.4','P','2020-03-24','Aktif'),
(1247,3,'Ir. Evi Feronika, M.Si','JL. BATU SULI 7','62116564840.2','P','2020-03-25','Aktif'),
(1248,3,'Ir. Nisfiatul Hidayat, M.Si','JL. BUKIT RAYA 8','62102565018','L','2020-03-26','Aktif'),
(1249,3,'Heri Sujoko, Ir.','JL. PANGRANGO 7','62088565195.8','L','2020-03-27','Aktif'),
(1250,3,'Ir. Wijantri Kusumadati S., MP','JL. BELIBIS 13','62074565373.6','P','2020-03-28','Aktif'),
(1251,3,'Ivone Christiana, S.Pi','JL. LAWU 8','62060565551.4','P','2019-03-29','Aktif'),
(1252,3,'Ir. Kamillah, MP','JL. BATU BADINDING 6','62046565729.2','P','2019-03-30','Aktif'),
(1253,3,'Ir. Asri Pudjirahaju, MP','JL. MANDOMAI 11','62032565907','P','2019-03-31','Aktif'),
(1254,3,'Ir. Yudha, M.Sc','JL. PANGRANGO 6','62018566084.8','L','2019-04-01','Aktif'),
(1255,3,'Eti Dewi Nopemberini','JL. BELIBIS 4','62004566262.6','L','2019-04-02','Aktif'),
(1256,3,'Rario, S.Pi.','JL. BELIBIS 5','61990566440.4','L','2019-04-03','Aktif'),
(1257,3,'Bina Candra, SP, MP','JL. KRAKATAU 7','61976566618.2','L','2019-04-04','Aktif'),
(1258,3,'Hj. Reni Rahmawati, S.Hut. MP','JL. BUKIT RAYA 8','61962566796','P','2020-04-05','Aktif'),
(1259,3,'Fouad Fauzi','JL. PANGRANGO 7','61948566973.8','L','2020-04-06','Aktif'),
(1260,3,'Maria Haryulin Astuti','JL. BELIBIS 6','61934567151.6','P','2018-04-07','Aktif'),
(1261,3,'Milad Madiyawati','JL. BELIBIS 7','61920567329.4','P','2018-04-08','Aktif'),
(1262,3,'Tri Prajawahyudo, SP.','JL. BATU SULI 8','61906567507.2','L','2018-04-09','Aktif'),
(1263,3,'Alpian, SP., MP','JL. BUKIT RAYA 9','61892567685','L','2018-04-10','Aktif'),
(1264,3,'Patricia Erosa Putir, S.Hut','JL. PANGRANGO 8','61878567862.8','P','2016-04-11','Aktif'),
(1265,3,'Hendrik Segah, S.Hut, M.Si','JL. BELIBIS 14','61864568040.6','L','2014-04-13','Aktif'),
(1266,3,'Wahyu Supriati, S.Hut., MP','JL. LAWU 9','61850568218.4','L','2015-04-14','Aktif'),
(1267,3,'Renhart Jemi, S.Hut., MP','JL. BATU BADINDING 7','61836568396.2','P','2013-04-16','Aktif'),
(1268,3,'Yanciluk, S.Hut','JL. MANDOMAI 12','61822568574','L','2016-04-17','Aktif'),
(1269,3,'Ajun Junaedi, S.Hut.','JL. PANGRANGO 7','61808568751.8','L','2016-04-19','Aktif'),
(1270,3,'Misrita','JL. BELIBIS 6','61794568929.6','P','2018-04-20','Aktif'),
(1271,3,' Selvie Mahrita, SP., MP','JL. PANGRANGO 3','61780569107.4','P','2019-03-29','Aktif'),
(1272,3,'Wahyu Widyawati, SP.','JL. BELIBIS 2','61766569285.2','L','2019-03-30','Aktif'),
(1273,3,'Grace Siska, S.Hut','JL. BELIBIS 1','61752569463','P','2019-03-31','Aktif'),
(1274,3,'Desy Natalia Koroh, S.Hut.','JL. KRAKATAU 4','61738569640.8','P','2019-04-01','Aktif'),
(1275,3,'Muhammad Fadhil AS., SP., MP','JL. BUKIT RAYA 5','61724569818.6','L','2019-04-02','Aktif'),
(1276,3,'Yanetri Asi, SP, M.Si','JL. PANGRANGO 4','61710569996.4','P','2019-04-03','Aktif'),
(1277,3,'Maryani, S.Pi., M.Si','JL. BELIBIS 0','61696570174.2','P','2019-04-04','Aktif'),
(1278,3,'Dewi Saraswati, SP., MP','JL. BELIBIS 1','61682570352','P','2020-04-05','Aktif'),
(1279,3,'Titin Apung Atikah, SP., MP','JL. BATU SULI 5','61668570529.8','P','2020-04-06','Aktif'),
(1280,3,'Mayang Meilantina, SP., MP','JL. BUKIT RAYA 6','61654570707.6','P','2018-04-07','Aktif'),
(1281,3,'Afentina, S.Hut., MP','JL. PANGRANGO 5','61640570885.4','P','2018-04-08','Aktif'),
(1282,3,'Rini Dwiastuti, S.Hut., M.Si','JL. BELIBIS 11','61626571063.2','P','2018-04-09','Aktif'),
(1283,3,'Tyas Wara S., S.Pi.','JL. LAWU 6','61612571241','P','2018-04-10','Aktif'),
(1284,3,'Belinda Hastari','JL. BATU BADINDING 4','61598571418.8','P','2016-04-11','Aktif'),
(1285,3,'Zafrullah Damanik','JL. MANDOMAI 9','61584571596.6','L','2014-04-13','Aktif'),
(1286,3,'Evnaweri, S.Pi','JL. PANGRANGO 4','61570571774.4','P','2015-04-14','Aktif'),
(1287,3,'Iis Yuanita, S.Pt','JL. BELIBIS 0','61556571952.2','P','2013-04-16','Aktif'),
(1288,3,'Ria Anjalani, S.Pt','JL. BELIBIS 1','61542572130','P','2016-04-17','Aktif'),
(1289,3,'Nina Yulianti','JL. KRAKATAU 5','61528572307.8','P','2016-04-19','Aktif'),
(1290,3,'Fandi Karuniawan Putera A.','JL. BUKIT RAYA 6','61514572485.6','L','2018-04-20','Aktif'),
(1291,3,'Robby Octavianus','JL. PANGRANGO 5','61500572663.4','L','2019-03-29','Aktif'),
(1292,3,'Ellydia Ludang','JL. BELIBIS 2','61486572841.2','P','2019-03-30','Aktif'),
(1293,3,'Ellen Christ Tambunan','JL. BELIBIS 3','61472573019','L','2019-03-31','Aktif'),
(1294,3,'Emmy U . Antang','JL. BATU SULI 6','61458573196.8','P','2019-04-01','Aktif'),
(1295,3,'Ricky Jauhari','JL. BUKIT RAYA 7','61444573374.6','L','2019-04-02','Aktif'),
(1296,3,'Evi Faridawati','JL. PANGRANGO 6','61430573552.4','P','2019-04-03','Aktif'),
(1297,3,'Fengki F. Adji','JL. BELIBIS 12','61416573730.2','L','2019-04-04','Aktif'),
(1298,3,'Shinta Syilvia','JL. LAWU 7','61402573908','P','2020-04-05','Aktif'),
(1299,4,'Lemu','JL. PANGRANGO 6','61388574085.8','P','2018-04-20','Aktif'),
(1300,4,'Irsani','JL. BELIBIS 12','61374574263.6','P','2019-03-29','Aktif'),
(1301,4,'Muhammad Syamsudin Noor, SE','JL. LAWU 7','61360574441.4','L','2019-03-30','Aktif'),
(1302,4,'Eka Putri Setiati, ST','JL. BATU BADINDING 5','61346574619.2','P','2019-03-31','Aktif'),
(1303,4,'Gerson','JL. MANDOMAI 10','61332574797','L','2019-04-01','Aktif'),
(1304,4,'Patmawaty, ST','JL. PANGRANGO 5','61318574974.8','P','2019-04-02','Aktif'),
(1305,4,'Aprind Pirantawan, ST.','JL. BELIBIS 2','61304575152.6','P','2019-04-03','Aktif'),
(1306,4,'Deddy Hernawan, ST., MS','JL. BELIBIS 3','61290575330.4','L','2019-04-04','Aktif'),
(1307,4,'Rejo','JL. KRAKATAU 6','61276575508.2','L','2020-04-05','Aktif'),
(1308,4,'Agustin, S.T','JL. BUKIT RAYA 7','61262575686','L','2018-04-20','Aktif'),
(1309,4,'Sumarni, ST.','JL. PANGRANGO 6','61248575863.8','P','2021-03-29','Aktif'),
(1310,4,'Wartely Apriliani, S.E.','JL. BELIBIS 4','61234576041.6','P','2022-03-30','Aktif'),
(1311,4,'Saiful Ihsan, ST.','JL. PINUS 5','61220576219.4','L','2019-03-31','Aktif'),
(1312,4,'BENI SUPRIONO, A.Md.','JL. BATU SULI 7','61206576397.2','L','2019-04-01','Aktif'),
(1313,4,'Benny Kalawa, ST.','JL. CUK NYAK DIEN 6','61192576575','L','2022-04-02','Aktif'),
(1314,5,'Yulinde, S.Hut','JL. BELIBIS 4','61178576752.8','P','2019-03-31','Aktif'),
(1315,5,'Godli','JL. BELIBIS 5','61164576930.6','L','2019-04-01','Aktif'),
(1316,5,'Rubed','JL. KRAKATAU 7','61150577108.4','L','2019-04-02','Aktif'),
(1317,5,'Nampung, S.Pd','JL. BUKIT RAYA 8','61136577286.2','L','2019-04-03','Aktif'),
(1318,5,'Weniati, SP., M.Si','JL. PANGRANGO 7','61122577464','P','2019-04-04','Aktif'),
(1319,5,'Robitson','JL. BELIBIS 6','61108577641.8','L','2020-04-05','Aktif'),
(1320,5,'Rinto Nopriadi','JL. TJILIK RIWUT 6','61094577819.6','L','2018-04-20','Aktif'),
(1321,5,'Siti Asih Windriana, S. Pd.','JL. BATU SULI 8','61080577997.4','P','2021-03-29','Aktif'),
(1322,5,'Van Hendro','JL. KERUING 5','61066578175.2','L','2022-03-30','Aktif'),
(1323,5,'Flora Chisyashita','JL. PANGRANGO 8','61052578353','P','2019-03-31','Aktif'),
(1324,5,'Astin Arini, SH.','JL. WORTEL 5','61038578530.8','P','2019-04-01','Aktif'),
(1325,6,'Keridieni, S.Pd','JL. KRAKATAU 7','61024578708.6','L','2019-04-01','Aktif'),
(1326,6,'Ardison, SE','JL. BUKIT RAYA 8','61010578886.4','L','2022-04-02','Aktif'),
(1327,6,'Denny Paulus, S.Sos','JL. PANGRANGO 7','60996579064.2','L','2019-03-31','Aktif'),
(1328,6,'Santi, S.Pi','JL. BELIBIS 5','60982579242','P','2019-04-01','Aktif'),
(1329,6,'Harry, S.Pd','JL. PINUS 6','60968579419.8','L','2019-04-02','Aktif'),
(1330,6,'YOSIA NUGRAHANINGSIH, S.I.KOM, M.I.KOM','JL. BATU SULI 8','60954579597.6','L','2019-04-03','Aktif'),
(1331,7,'Tri Widodo','JL. BAJAU RANJU 6','61388574085.8','L','2018-04-10','Aktif'),
(1332,7,'Agnes Frethernety','JL. RAJAWALI 10','61374574263.6','P','2016-04-11','Aktif'),
(1333,7,'dr. Herlina Eka Shinta','JL. MENTENG 11','61360574441.4','P','2014-04-13','Aktif'),
(1334,7,'Ratna Widayati','JL. TILUNG 5','61346574619.2','P','2015-04-14','Aktif'),
(1335,7,'Helena Jelita','JL. NYAI BALAU 5','61332574797','P','2013-04-16','Aktif'),
(1336,7,'Francisca Diana A','JL. PANGRANGO 5','61318574974.8','P','2016-04-17','Aktif'),
(1337,7,'Angeline Novia Toemon','JL. BELIBIS 2','61304575152.6','P','2016-04-19','Aktif'),
(1338,7,'dr. Dewi Klarita Fur','JL. BELIBIS 3','61290575330.4','P','2018-04-20','Aktif'),
(1339,7,'dr. Nawan','JL. KRAKATAU 6','61276575508.2','L','2019-03-29','Aktif'),
(1340,7,'dr. Septi Handayani','JL. BUKIT RAYA 7','61262575686','P','2019-03-30','Aktif'),
(1341,7,'dr.  Donna Novina Kahanjak','JL. PANGRANGO 6','61248575863.8','P','2019-03-31','Aktif'),
(1342,7,'dr. Indria Augustina','JL. BELIBIS 4','61234576041.6','P','2019-04-01','Aktif'),
(1343,7,'Natalia Sri Martani','JL. BELIBIS 5','61220576219.4','P','2019-04-02','Aktif'),
(1344,7,'Austin Bertilova C','JL. BATU SULI 7','61206576397.2','P','2019-04-03','Aktif'),
(1345,7,'Agnes Imanuela Toemon','JL. BUKIT RAYA 8','61192576575','P','2019-04-04','Aktif'),
(1346,7,'Tisha Patricia Oedoy','JL. PANGRANGO 7','61178576752.8','P','2020-04-05','Aktif'),
(1347,7,'Dian Mutiasari, S.Ked','JL. BELIBIS 13','61164576930.6','L','2018-04-10','Aktif'),
(1348,7,'Elsa Trianovita S.Farm. Apt','JL. LAWU 8','61150577108.4','P','2016-04-11','Aktif'),
(1349,7,'Supak Silawani','JL. BAJAU RANJU 7','61136577286.2','P','2014-04-13','Aktif'),
(1350,7,'dr. Lia Sasmithae','JL. RAJAWALI 11','61122577464','P','2015-04-14','Aktif'),
(1351,7,'I Gede Hary Eka Adnyana','JL. MENTENG 12','61108577641.8','L','2013-04-16','Aktif'),
(1352,7,'Arif Rahman Jabal','JL. TILUNG 6','61094577819.6','L','2016-04-17','Aktif'),
(1353,7,'Abi Bakring B','JL. RANYING SURING 4','61080577997.4','L','2016-04-19','Aktif'),
(1354,7,'Ashari Mohpul','JL. PANGRANGO 6','61066578175.2','L','2018-04-20','Aktif'),
(1355,7,'Silvani Permatasari','JL. BELIBIS 4','61052578353','P','2019-03-29','Aktif'),
(1356,7,'Ravenalla Abdurrahman Al Hakim S.','JL. BELIBIS 5','61038578530.8','P','2019-03-30','Aktif'),
(1357,7,'Anna Marthea Veronicha','JL. KRAKATAU 7','61024578708.6','P','2019-03-31','Aktif'),
(1358,7,'Galih Indra Permana','JL. BUKIT RAYA 8','61010578886.4','L','2019-04-01','Aktif'),
(1359,7,'Ervi Audina Munthe','JL. PANGRANGO 7','60996579064.2','P','2019-04-02','Aktif'),
(1360,7,'Ihsanul Irfan','JL. BELIBIS 6','60982579242','L','2019-04-03','Aktif'),
(1361,8,'Dr. Yohanes Edy G, M.Si.','JL. TILUNG 6','60968579419.8','L','2014-04-13','Aktif'),
(1362,8,'Dr. Siti Sunariyati, M.Si.','JL. NYAI BALAU 6','60954579597.6','P','2015-04-14','Aktif'),
(1363,8,'Prof. Dr. I Nyoman Sudyana, M,Sc','JL. PANGRANGO 6','60940579775.4','L','2013-04-16','Aktif'),
(1364,8,'Drs.Akhmad Damsyik, M.Sc.,Ph.D.','JL. BELIBIS 4','60926579953.2','L','2016-04-17','Aktif'),
(1365,8,'Dr. Liswara N, S.Pd., M.Si','JL. BELIBIS 5','60912580131','P','2016-04-19','Aktif'),
(1366,8,'Adventus Panda, S.Si, M.Si','JL. KRAKATAU 7','60898580308.8','L','2018-04-20','Aktif'),
(1367,8,'Wahyu Nugroho, S.Si.','JL. BUKIT RAYA 8','60884580486.6','L','2019-03-29','Aktif'),
(1368,8,'Luqman Hakim, S.Si','JL. PANGRANGO 7','60870580664.4','L','2019-03-30','Aktif'),
(1369,8,'Karelius, S.Si, M.Sc','JL. BELIBIS 6','60856580842.2','L','2019-03-31','Aktif'),
(1370,8,'Lilis Rosmainar, S.Si., M.Si','JL. BELIBIS 7','60842581020','P','2019-04-01','Aktif'),
(1371,8,'Vinsen Willi Wardhana, S.P., M.Si','JL. BATU SULI 8','60828581197.8','L','2019-04-02','Aktif'),
(1372,8,'Dwi Hermayantiningsih, S.Si, M.Sc','JL. BUKIT RAYA 9','60814581375.6','P','2019-04-03','Aktif'),
(1373,8,'Awalul Fatiqin, S.Si.M.Si','JL. PANGRANGO 8','60800581553.4','L','2019-04-04','Aktif'),
(1374,8,'Ahriyati, S.Pd, M.Si','JL. BELIBIS 14','60786581731.2','P','2020-04-05','Aktif'),
(1375,8,'Mirnawati Dewi, M.Si','JL. LAWU 9','60772581909','P','2018-04-10','Aktif'),
(1376,8,'Widya Krestina, S.Si.,M.Si','JL. BAJAU RANJU 8','60758582086.8','P','2016-04-11','Aktif'),
(1377,8,'Rizko Hadi, S.Si, M.Si','JL. RAJAWALI 12','60744582264.6','L','2014-04-13','Aktif'),
(1378,8,'Marvin Horale Pasaribu, S.Si, M.Si','JL. MENTENG 13','60730582442.4','L','2015-04-14','Aktif'),
(1379,8,'Muhammad Rizki, S.Si., M.Si','JL. TILUNG 7','60716582620.2','L','2013-04-16','Aktif'),
(1380,8,'Rasidah, S.Pd., M.Sc.','JL. RANYING SURING 5','60702582798','P','2016-04-17','Aktif'),
(1381,8,'Neny Kurniawati, S.Si., M.Si','JL. PANGRANGO 7','60688582975.8','P','2016-04-19','Aktif'),
(1382,8,'Ria Windi Lestari, M.Si','JL. BELIBIS 6','60674583153.6','P','2018-04-20','Aktif'),
(1383,8,'Tety Wahyuningsih Manurung, S.Si, M.Si','JL. BELIBIS 7','60660583331.4','P','2019-03-29','Aktif'),
(1384,8,'Samsul Arifin, M.Si','JL. KRAKATAU 8','60646583509.2','L','2019-03-30','Aktif'),
(1385,8,'Yuniarta Basani, S.Si, M.Si','JL. BUKIT RAYA 9','60632583687','P','2019-03-31','Aktif'),
(1386,8,'Rokiy Alfanaar, S.Si, M.Sc','JL. PANGRANGO 8','60618583864.8','L','2019-04-01','Aktif'),
(1387,8,'Fadhila Aziz, M.Si','JL. BELIBIS 7','60604584042.6','P','2019-04-02','Aktif'),
(1388,8,'Decenly, M.Si','JL. TILUNG 7','60590584220.4','L','2019-04-03','Aktif'),
(1389,8,'Desimaria Panjaitan, S.Si., M.Si.','JL. NYAI BALAU 7','60576584398.2','P','2014-04-13','Aktif'),
(1390,8,'Frans Grovy Naibaho, S.Si., M.Si','JL. PANGRANGO 7','60562584576','L','2015-04-14','Aktif'),
(1391,8,'apt. Noverda Ayuchecaria, S.Farm., M.Farm.','JL. BELIBIS 6','60548584753.8','P','2013-04-16','Aktif'),
(1392,8,'Apt. Ahmad Irawan, M.Farm','JL. BELIBIS 7','60534584931.6','L','2016-04-17','Aktif'),
(1393,8,'Retno Agnestisia, S.Si, M.Sc','JL. KRAKATAU 8','60520585109.4','P','2016-04-19','Aktif'),
(1394,8,'Sudarman Rahman, S.Pd., M.Sc.','JL. BUKIT RAYA 9','60506585287.2','L','2018-04-20','Aktif'),
(1395,8,'Febri Nur Ngazizah, S.Pd, M.Si','JL. PANGRANGO 8','60492585465','P','2019-03-29','Aktif'),
(1396,8,'Reny Rosalina, S.Si, M.Si','JL. BELIBIS 8','60478585642.8','P','2019-03-30','Aktif'),
(1397,8,'Jhon Wesly Manik, S.Si., M.Si','JL. BELIBIS 9','60464585820.6','L','2019-03-31','Aktif'),
(1398,8,'Made Dirgantara, S.Si., M.Si','JL. BATU SULI 9','60450585998.4','L','2019-04-01','Aktif'),
(1399,8,'Erwin Prasetya Toepak, S.Si., M.Si','JL. BUKIT RAYA 10','60436586176.2','L','2019-04-02','Aktif'),
(1400,8,'Fandi Tuju, M.Si','JL. PANGRANGO 9','60422586354','L','2019-04-03','Aktif'),
(1401,8,'Zimon Pereiz, S.Si., M.Sc','JL. BELIBIS 15','60408586531.8','L','2019-04-04','Aktif'),
(1402,8,'Rahayu Opi Anggoro, S.Si, M.Biotech','JL. LAWU 10','60394586709.6','P','2020-04-05','Aktif');

/*Table structure for table `tbl_bunga` */

DROP TABLE IF EXISTS `tbl_bunga`;

CREATE TABLE `tbl_bunga` (
  `id_bunga` int(11) NOT NULL AUTO_INCREMENT,
  `nama_bunga` varchar(50) DEFAULT NULL,
  `besaran_bunga` decimal(5,2) DEFAULT NULL,
  PRIMARY KEY (`id_bunga`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tbl_bunga` */

insert  into `tbl_bunga`(`id_bunga`,`nama_bunga`,`besaran_bunga`) values 
(1,'Bunga Koperasi ',0.02);

/*Table structure for table `tbl_detail_pinjaman` */

DROP TABLE IF EXISTS `tbl_detail_pinjaman`;

CREATE TABLE `tbl_detail_pinjaman` (
  `id_detail_pinjaman` int(11) NOT NULL AUTO_INCREMENT,
  `id_pinjaman` int(11) DEFAULT NULL,
  `bulan` int(11) DEFAULT NULL,
  `tanggal_detail_pinjaman` date DEFAULT NULL,
  `sisa_pinjam` decimal(20,2) DEFAULT NULL,
  `bunga` decimal(5,2) DEFAULT NULL,
  `angsuran_pokok` decimal(20,2) DEFAULT NULL,
  `angsuran_bunga` decimal(20,2) DEFAULT NULL,
  `total_angsuran` decimal(20,2) DEFAULT NULL,
  `status_detail_pinjaman` enum('Lunas','Belum Lunas') DEFAULT NULL,
  PRIMARY KEY (`id_detail_pinjaman`)
) ENGINE=InnoDB AUTO_INCREMENT=391 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tbl_detail_pinjaman` */

insert  into `tbl_detail_pinjaman`(`id_detail_pinjaman`,`id_pinjaman`,`bulan`,`tanggal_detail_pinjaman`,`sisa_pinjam`,`bunga`,`angsuran_pokok`,`angsuran_bunga`,`total_angsuran`,`status_detail_pinjaman`) values 
(373,52,1,'2024-01-10',833333.33,0.02,166666.67,20000.00,186666.67,'Lunas'),
(374,52,2,'2024-02-10',666666.67,0.02,166666.67,16666.67,183333.33,'Belum Lunas'),
(375,52,3,'2024-03-10',500000.00,0.02,166666.67,13333.33,180000.00,'Belum Lunas'),
(376,52,4,'2024-04-10',333333.33,0.02,166666.67,10000.00,176666.67,'Belum Lunas'),
(377,52,5,'2024-05-10',166666.67,0.02,166666.67,6666.67,173333.33,'Belum Lunas'),
(378,52,6,'2024-06-10',0.00,0.02,166666.67,3333.33,170000.00,'Belum Lunas'),
(379,53,1,'2024-01-11',833333.33,0.02,166666.67,20000.00,186666.67,'Belum Lunas'),
(380,53,2,'2024-02-11',666666.67,0.02,166666.67,16666.67,183333.33,'Belum Lunas'),
(381,53,3,'2024-03-11',500000.00,0.02,166666.67,13333.33,180000.00,'Belum Lunas'),
(382,53,4,'2024-04-11',333333.33,0.02,166666.67,10000.00,176666.67,'Belum Lunas'),
(383,53,5,'2024-05-11',166666.67,0.02,166666.67,6666.67,173333.33,'Belum Lunas'),
(384,53,6,'2024-06-11',0.00,0.02,166666.67,3333.33,170000.00,'Belum Lunas'),
(385,54,1,'2022-02-11',833333.33,0.02,166666.67,20000.00,186666.67,'Belum Lunas'),
(386,54,2,'2022-03-11',666666.67,0.02,166666.67,16666.67,183333.33,'Belum Lunas'),
(387,54,3,'2022-04-11',500000.00,0.02,166666.67,13333.33,180000.00,'Belum Lunas'),
(388,54,4,'2022-05-11',333333.33,0.02,166666.67,10000.00,176666.67,'Belum Lunas'),
(389,54,5,'2022-06-11',166666.67,0.02,166666.67,6666.67,173333.33,'Belum Lunas'),
(390,54,6,'2022-07-11',0.00,0.02,166666.67,3333.33,170000.00,'Belum Lunas');

/*Table structure for table `tbl_fakultas` */

DROP TABLE IF EXISTS `tbl_fakultas`;

CREATE TABLE `tbl_fakultas` (
  `id_fakultas` int(11) NOT NULL AUTO_INCREMENT,
  `kode_fakultas` varchar(100) DEFAULT NULL,
  `nama_fakultas` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_fakultas`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tbl_fakultas` */

insert  into `tbl_fakultas`(`id_fakultas`,`kode_fakultas`,`nama_fakultas`) values 
(1,'FKIP','Fakultas Keguruan dan Ilmu Pendidikan'),
(2,'FEB','Fakultas Ekonomi dan Bisnis'),
(3,'FP','Fakultas Pertanian '),
(4,'FT','Fakultas Teknik'),
(5,'FH','Fakultas Hukum '),
(6,'FISIP','Fakultas Ilmu Sosial dan Ilmu Politik '),
(7,'FK','Fakultas Kedokteran'),
(8,'FMIPA','Fakultas Matematika dan Ilmu Pengetahuan Alam');

/*Table structure for table `tbl_jenis_simpanan` */

DROP TABLE IF EXISTS `tbl_jenis_simpanan`;

CREATE TABLE `tbl_jenis_simpanan` (
  `id_jenis_simpanan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jenis_simpanan` varchar(100) DEFAULT NULL,
  `jumlah_jenis_simpanan` decimal(15,2) DEFAULT NULL,
  PRIMARY KEY (`id_jenis_simpanan`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tbl_jenis_simpanan` */

insert  into `tbl_jenis_simpanan`(`id_jenis_simpanan`,`nama_jenis_simpanan`,`jumlah_jenis_simpanan`) values 
(1,'Simpanan Pokok',10000.00),
(5,'Simpanan Wajib - 1',1000000.00),
(11,'Simpanan Wajib - 2',2000000.00),
(12,'Simpanan Wajib - 3',3000000.00),
(13,'Simpanan Wajib - 4',4000000.00),
(14,'Simpanan Wajib - 5',5000000.00),
(15,'Simpanan Wajib - 6',6000000.00),
(16,'Simpanan Wajib - 7',7000000.00),
(17,'Simpanan Wajib - 8',8000000.00),
(18,'Simpanan Wajib - 9',9000000.00),
(19,'Simpanan Wajib -10',10000000.00);

/*Table structure for table `tbl_koperasi` */

DROP TABLE IF EXISTS `tbl_koperasi`;

CREATE TABLE `tbl_koperasi` (
  `id_koperasi` int(11) NOT NULL AUTO_INCREMENT,
  `nama_koperasi` varchar(100) DEFAULT NULL,
  `alamat_koperasi` varchar(255) DEFAULT NULL,
  `logo_koperasi` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_koperasi`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tbl_koperasi` */

insert  into `tbl_koperasi`(`id_koperasi`,`nama_koperasi`,`alamat_koperasi`,`logo_koperasi`) values 
(1,'KOPERASI KPRI UPAYA','Jl. Yos Sudarso, Palangka, Kec. Jekan Raya, Kota Palangka Raya, Kalimantan Tengah 74874','1699953828_6f81e4dc42a8fcdea5d6.png');

/*Table structure for table `tbl_pinjaman` */

DROP TABLE IF EXISTS `tbl_pinjaman`;

CREATE TABLE `tbl_pinjaman` (
  `id_pinjaman` int(11) NOT NULL AUTO_INCREMENT,
  `id_anggota` int(11) DEFAULT NULL,
  `tanggal_pengajuan` date DEFAULT NULL,
  `jumlah_pinjaman` decimal(15,2) DEFAULT NULL,
  `bunga_pinjaman` decimal(5,2) DEFAULT NULL,
  `tenor_pinjaman` int(11) DEFAULT NULL,
  `status_pinjaman` enum('Lunas','Belum Lunas') DEFAULT NULL,
  PRIMARY KEY (`id_pinjaman`),
  KEY `id_anggota` (`id_anggota`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tbl_pinjaman` */

insert  into `tbl_pinjaman`(`id_pinjaman`,`id_anggota`,`tanggal_pengajuan`,`jumlah_pinjaman`,`bunga_pinjaman`,`tenor_pinjaman`,`status_pinjaman`) values 
(52,1123,'2023-12-10',1000000.00,0.02,6,'Belum Lunas'),
(53,1124,'2023-12-11',1000000.00,0.02,6,'Belum Lunas'),
(54,1125,'2022-01-11',1000000.00,0.02,6,'Belum Lunas');

/*Table structure for table `tbl_simpanan` */

DROP TABLE IF EXISTS `tbl_simpanan`;

CREATE TABLE `tbl_simpanan` (
  `id_simpanan` int(11) NOT NULL AUTO_INCREMENT,
  `id_anggota` int(11) DEFAULT NULL,
  `id_jenis_simpanan` int(11) DEFAULT NULL,
  `tanggal_simpanan` date DEFAULT NULL,
  PRIMARY KEY (`id_simpanan`),
  KEY `id_anggota` (`id_anggota`),
  KEY `id_jenis_simpanan` (`id_jenis_simpanan`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tbl_simpanan` */

insert  into `tbl_simpanan`(`id_simpanan`,`id_anggota`,`id_jenis_simpanan`,`tanggal_simpanan`) values 
(36,1123,1,'2023-01-04'),
(37,1123,1,'2023-02-04'),
(38,1123,1,'2023-03-04'),
(39,1123,1,'2023-04-04'),
(40,1123,1,'2023-05-04'),
(41,1123,1,'2023-06-04'),
(42,1123,1,'2023-07-04'),
(43,1123,1,'2023-08-04'),
(44,1123,1,'2023-09-04'),
(45,1123,1,'2023-10-04'),
(46,1123,1,'2023-11-04'),
(47,1124,1,'2023-01-08'),
(48,1124,1,'2023-02-08'),
(49,1124,1,'2023-03-08'),
(50,1124,1,'2023-04-08'),
(51,1124,1,'2023-05-08'),
(52,1124,1,'2023-06-08'),
(53,1124,1,'2023-07-08'),
(54,1124,1,'2023-08-08'),
(55,1124,1,'2023-09-08'),
(56,1125,1,'2023-01-20'),
(57,1125,1,'2023-02-20'),
(58,1125,1,'2023-03-20'),
(59,1125,1,'2023-04-20'),
(60,1125,1,'2023-05-20'),
(61,1125,1,'2023-06-20'),
(62,1126,1,'2023-01-22'),
(64,1126,1,'2023-02-22'),
(65,1126,1,'2023-03-22'),
(66,1126,1,'2023-04-22'),
(67,1127,1,'2023-01-14'),
(68,1127,1,'2023-02-14'),
(69,1127,1,'2023-03-14'),
(70,1127,1,'2023-04-14'),
(71,1127,1,'2023-05-14'),
(72,1127,1,'2023-06-14'),
(73,1130,1,'2023-01-07'),
(74,1130,1,'2023-02-07'),
(75,1130,1,'2023-03-07'),
(76,1130,1,'2023-04-07'),
(77,1130,1,'2023-05-07'),
(78,1132,1,'2023-01-10'),
(79,1132,1,'2023-02-10'),
(80,1132,1,'2023-03-10'),
(81,1132,1,'2023-04-10'),
(82,1132,1,'2023-05-10'),
(83,1132,1,'2023-06-10'),
(84,1132,1,'2023-07-10'),
(85,1132,1,'2023-08-10'),
(86,1132,1,'2023-09-10'),
(89,1129,1,'2021-01-09'),
(90,1129,1,'2022-01-09');

/*Table structure for table `tbl_user` */

DROP TABLE IF EXISTS `tbl_user`;

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `level` int(1) DEFAULT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `foto_user` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tbl_user` */

insert  into `tbl_user`(`id_user`,`username`,`password`,`level`,`nama_lengkap`,`foto_user`) values 
(1,'Bendahara','81dc9bdb52d04dc20036dbd8313ed055',2,'Resha Ananda Rahman','1699502953_95842f403a762bfe239a.png'),
(3,'Admin','81dc9bdb52d04dc20036dbd8313ed055',1,'Elgato','1699163785_027865b88f5488ef4824.png');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
