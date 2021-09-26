INSERT INTO 
  `areas` (`bigarea_id`, `harbor_id`, `area_name`, `area_zip`, `created_at`, `updated_at`) 
VALUES 
  (15, 6, '新川', '950-2102,jp', NOW(), NOW()),
  (15, 5, '巻', '953-0012,jp', NOW(), NOW()),
  (15, 5, '寺泊', '940-2502,jp', NOW(), NOW()),
  (15, 13, '新潟東港', '957-0101,jp', NOW(), NOW()),
  (15, 11, '岩船', '958-0058,jp', NOW(), NOW()),
  (16, 2, '伏木', '933-0102,jp', NOW(), NOW()),
  (16, 3, '富山', '931-8378,jp', NOW(), NOW());

INSERT INTO 
  `bigareas` (`bigarea_id`,`bigarea_name`,`created_at`,`updated_at`) 
VALUES 
  (15,'新潟県',NOW(),NOW()),
  (16,'富山県',NOW(),NOW());

INSERT INTO 
  `harbors` (`bigarea_id`,`harbor_id`,`harbor_name`,`created_at`,`updated_at`) 
VALUES 
  (15,1,'能生',NOW(),NOW()),
  (15,2,'直江津',NOW(),NOW()),
  (15,3,'柏崎',NOW(),NOW()),
  (15,4,'出雲崎',NOW(),NOW()),
  (15,5,'寺泊',NOW(),NOW()),
  (15,6,'新潟西港',NOW(),NOW()),
  (15,11,'岩船',NOW(),NOW()),
  (15,13,'新潟東港',NOW(),NOW()),
  (16,2,'伏木',NOW(),NOW()),
  (16,3,'富山',NOW(),NOW());

INSERT INTO 
  `admin_ranks` (`id`,`admin`) 
VALUES 
  (0,'ユーザー'),
  (1,'サイト編集者'),
  (2,'サイト管理者');