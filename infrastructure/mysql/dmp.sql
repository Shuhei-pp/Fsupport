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
  `admin_ranks` (`id`,`rank`) 
VALUES 
  (0,'ユーザー'),
  (1,'サイト編集者'),
  (2,'サイト管理者');

INSERT INTO
  `disabled` (`disabled_id`,`disabled_status_name`)
VALUES
  (1,'利用停止中');

INSERT INTO
  `fish_kinds` (`fish_id`,`fish_name`,`create_user_id`)
VALUES 
  (2,'アナゴ',2),
  (3,'キス',2),
  (4,'アジ',2),
  (5,'サンマ',2),
  (6,'タコ',2);

INSERT INTO `frecord_fishs` (`id`, `frecord_id`, `fish_id`, `fish_amount`) VALUES
(1, 2, 1, 8),
(2, 3, 5, 4),
(3, 4, 1, 1),
(4, 5, 1, 1),
(5, 6, 11, 1),
(6, 7, 3, 2),
(7, 8, 2, 1),
(8, 9, 10, 1),
(9, 10, 7, 1),
(10, 11, 10, 1),
(11, 12, 1, 3),
(12, 13, 2, 2),
(13, 14, 2, 2),
(14, 15, 6, 1),
(15, 16, 4, 1),
(16, 17, 10, 1),
(17, 18, 3, 1),
(18, 19, 3, 2),
(19, 20, 3, 1),
(20, 21, 11, 1),
(21, 22, 10, 1),
(22, 23, 1, 1),
(23, 24, 3, 1),
(24, 25, 1, 1),
(25, 26, 3, 5),
(26, 27, 1, 9);

INSERT INTO `comments` (`id`, `comment_frecord_id`, `comment_user_id`, `comment_text`, `created_at`, `updated_at`) VALUES
(1, 25, 10, 'すごい', '2021-10-13 13:13:24', '2021-10-13 13:13:24'),
(2, 24, 10, 'かわいい', '2021-10-13 13:15:56', '2021-10-13 13:15:56'),
(3, 24, 10, 'スゲー', '2021-10-13 13:18:01', '2021-10-13 13:18:01'),
(4, 26, 10, '多いですね', '2021-10-13 13:24:25', '2021-10-13 13:24:25'),
(5, 20, 10, 'ああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああ', '2021-10-13 13:26:09', '2021-10-13 13:26:09'),
(6, 27, 8, 'やるじゃん', '2022-03-14 23:06:48', '2022-03-14 23:06:48');



INSERT INTO `fishingrecords` (`id`, `user_id`, `area_id`, `content`, `image_name`, `time`, `created_at`, `updated_at`, `datetime`) VALUES
(2, 7, 4, '青物のキホン。。', '71MycDMJZDzZGiYLhc7F35CfXhDejaCebOKn1t7x.jpg', NULL, '2021-10-11 15:09:20', '2021-10-11 15:09:20', '2021-10-06 16:09:00'),
(3, 7, 1, '鯖釣れた！', '70ptT88sCX2IK0lzFfPkdJWc2dmPO6AyRPL5SGlF.jpg', NULL, '2021-10-11 15:53:04', '2021-10-11 15:53:04', '2021-10-08 15:54:00'),
(4, 7, 1, 'dfghjkl', 'x0BxkGMLRqfQNUhDW9T5F8nvSrySIDvknLrhShOU.jpg', NULL, '2021-10-11 16:31:17', '2021-10-11 16:31:17', '2021-09-29 16:33:00'),
(5, 12, 1, 'アジ釣れた', 'hlw4X58sVGuhYoP2IVeoQdqaD3KfHayvkglF3he6.jpg', NULL, '2021-10-13 11:40:54', '2021-10-13 11:40:54', '2021-10-13 11:40:00'),
(6, 12, 2, 'タコ取ったどー', 'W5PSzZf7WGMibyTz0B0waib6wNC0XKZVJBqbIRaS.jpg', NULL, '2021-10-13 11:44:49', '2021-10-13 11:44:49', '2021-10-13 11:30:00'),
(7, 12, 4, 'かわいい', 'lJy73I0eOTHFbj5Q8BHcS42G2hqPAu07AmJV29x1.jpg', NULL, '2021-10-13 11:46:37', '2021-10-13 11:46:37', '2021-10-13 11:46:00'),
(8, 10, 7, 'キスゲット', 'Kum6LgG8nt7r09HmNK4nYMDcGyXG6e6Jrj6IEyyc.jpg', NULL, '2021-10-13 11:51:32', '2021-10-13 11:51:32', '2021-10-13 11:45:00'),
(9, 10, 3, 'イカ', 'Uj4u0cypZ6NR0O1Taf4MVQKyAfupboAykj1hgB1W.jpg', NULL, '2021-10-13 11:52:53', '2021-10-13 11:52:53', '2021-10-13 11:50:00'),
(10, 10, 5, 'アイナメじゃん', 'fsMXO6hOg9mOZ0D1mUNmA8IOLPksj1ZEgxDrwgrs.jpg', NULL, '2021-10-13 12:46:52', '2021-10-13 12:46:52', '2021-10-13 12:46:00'),
(11, 11, 1, 'イカやん', 'DmPrSoknkh079IYrbng3B4g8ZMNYb4oo7DfFp54v.jpg', NULL, '2021-10-13 12:48:44', '2021-10-13 12:48:44', '2021-10-13 12:48:00'),
(12, 11, 6, 'めっちゃ釣れた', '2Q1Hy46XIArF2JbC1CimLn7X2Pf4PBPxV9ck27Gc.jpg', NULL, '2021-10-13 12:50:22', '2021-10-13 12:50:51', '2021-10-13 12:50:00'),
(14, 11, 2, 'キス', 'gn7m2EiuaKQCqXihBrJHZtNL22P2s1PbB0OZAtzI.jpg', NULL, '2021-10-13 12:52:07', '2021-10-13 12:52:07', '2021-10-13 12:51:00'),
(15, 10, 4, 'ゲット', 'MjrUC8NCPx2iRFfHXIbtJcZIoXg6Tu1vfqV9jvSe.jpg', NULL, '2021-10-13 12:54:53', '2021-10-13 12:54:53', '2021-10-13 12:54:00'),
(16, 10, 7, 'カマスやん', 'k9N9dteiTZU9qQrU6icmrs5auOq3Y1Hc3H7WTy1T.jpg', NULL, '2021-10-13 12:55:49', '2021-10-13 12:56:43', '2021-10-13 12:55:00'),
(17, 11, 4, 'でっか', 'YPPY2yIdqkS9d6llmBUkzwrL4ceTHakGnIlaAP5z.jpg', NULL, '2021-10-13 12:59:44', '2021-10-13 12:59:44', '2021-10-13 12:59:00'),
(18, 11, 3, '手のひらサイズ', '2zCvSp3R9S4R8l0chrlqfEmo9473FEzpQ2vp4Ax5.jpg', NULL, '2021-10-13 13:00:25', '2021-10-13 13:00:25', '2021-10-13 13:00:00'),
(26, 11, 5, 'たくさん釣れた', '3Pr57p9Rhso9qd2bkiD2CGVDNQIHKZVBPdM6P2Ia.jpg', NULL, '2021-10-13 13:20:48', '2021-10-13 13:20:48', '2021-10-13 13:20:00'),
(27, 14, 1, 'さかな', '7W6JHeOPOnmv9919pPr0i0VSTdxT9ZTr98o2N1r3.jpg', NULL, '2021-10-16 12:52:21', '2021-10-16 12:52:21', '2021-07-17 19:52:00');

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `email_verified`, `email_verify_token`, `auth_status`, `admin`, `disabled_status`) VALUES
(2,'管理者','testadmin@gmail.com',null,'$2y$10$xMur5n5Ds8C/IbhIHzWkG.Jmy2CqWcZFhwJCcT/79GJAtLZ0lmF8.','dGVzdGFkbWluQGdtYWlsLmNvbQ==',null,null,0,null,1,2,0),
(6, NULL, 'bntflkusp.113@docomo.ne.jp', NULL, '$2y$10$hMFnydAnanTK1JmwImEYNu2rinJeI.tbO8rbNbTa3tts6Fx8Ztfoa', NULL, '2021-09-22 21:15:33', '2021-09-22 21:15:33', 0, 'Ym50ZmxrdXNwLjExM0Bkb2NvbW8ubmUuanA=', 0, 0, NULL),
(7, NULL, 'testadmin@gmail.com', NULL, '$2y$10$xPMVDk/LHYa3v5UB6I7ZDOjBU8cjEFJ0nPpEFRSJxExlnrl2Wlb5e', NULL, '2021-09-23 10:41:40', '2021-09-23 10:41:40', 0, 'bG90YWtvdGF5b3RhQGdtYWlsLmNvbQ==', 0, 1, NULL),
(8, NULL, 'lotakotayota@gmail.com', NULL, '$2y$10$FRC3hqx6eBTSPXLBxbqxteGJrUen8ieKjGLKK3jWKJSqU2bR7TWfK', NULL, '2021-10-11 10:40:26', '2021-10-11 10:40:26', 0, 'bG90YWtvdGF5b3RhQGdtYWlsLmNvbQ==', 0, 0, NULL),
(10, NULL, 'kaneimike07@gmail.com', NULL, '$2y$10$1gjy9/hw.q7HhGaqq6n8uuJVhp2RuKf4Eu7ra9BhqlCkqNq8KjSBO', NULL, '2021-10-13 10:16:05', '2021-10-13 10:16:05', 0, 'a2FuZWltaWtlMDdAZ21haWwuY29t', 0, 1, NULL),
(11, NULL, 'kankan131@icloud.com', NULL, '$2y$10$GNNY3IQvxjhbgbLDG5Tnlu.RZGDQ7g/wLd0kYNB4SdNw7RTe3iZz6', NULL, '2021-10-13 10:19:28', '2021-10-13 10:19:28', 0, 'a2Fua2FuMTMxQGljbG91ZC5jb20=', 0, NULL, NULL),
(12, NULL, 'kotaft7s@gmail.com', NULL, '$2y$10$JyU.VEuKNS5tkocMrVxlGOLNZUZtjQjjZSpaX7U5HcoEutM9Eq39i', NULL, '2021-10-13 10:59:09', '2021-10-13 10:59:09', 0, 'a290YWZ0N3NAZ21haWwuY29t', 0, NULL, NULL),
(14, NULL, 'takkyuu1031@icloud.com', NULL, '$2y$10$JnTu9QfqMvtj3CeHQ8pEOeakJKd.MqPUylkxZ29Ktp7K/7Zsbyl9m', NULL, '2021-10-16 12:49:08', '2021-10-16 12:49:08', 0, 'dGFra3l1dTEwMzFAaWNsb3VkLmNvbQ==', 0, NULL, NULL);
