-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:3306
-- 生成日時: 2025-02-04 07:25:28
-- サーバのバージョン： 5.7.24
-- PHP のバージョン: 8.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `kadai11_php_all`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `contents`
--

CREATE TABLE `contents` (
  `id` int(12) NOT NULL,
  `user_id` int(10) NOT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `image` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `evaluate` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `contents`
--

INSERT INTO `contents` (`id`, `user_id`, `content`, `created_at`, `updated_at`, `image`, `evaluate`) VALUES
(1, 1, '教室ちょっと暑いです。mmm', '2020-09-22 07:28:23', '0000-00-00 00:00:00', NULL, '79'),
(2, 2, 'メモassaaaa    qqqqqq', '2020-09-22 16:02:47', '0000-00-00 00:00:00', NULL, '58'),
(43, 1, 'かなしいです', '2025-02-04 07:49:06', NULL, NULL, '36'),
(44, 1, 'あわわわわ', '2025-02-04 08:57:52', NULL, 'img/67a15800b99ac.png', '7'),
(45, 2, '気分がいい！', '2025-02-04 09:42:49', NULL, NULL, '57'),
(46, 1, 'キャー', '2025-02-04 09:44:32', NULL, NULL, '88'),
(47, 1, 'いえい', '2025-02-04 10:24:45', NULL, 'img/67a16c5d6186d.png', '86'),
(48, 3, 'ちょっぴりかなしい', '2025-02-04 10:44:16', NULL, 'img/67a170f0d820d.png', '24');

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` int(12) NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `lid` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `lpw` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `kanri_flg` int(1) NOT NULL,
  `life_flg` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `name`, `lid`, `lpw`, `kanri_flg`, `life_flg`) VALUES
(1, 'テスト１(管理者)', 'test1', '$2y$10$tWle3xOsQPdE46Swh3MxQef5wnoAvklEYXMvIn7Fj/zH4d6eUFme.', 1, 0),
(2, 'テスト2(一般)', 'test2', '$2y$10$886RFPOqE6nVjLsUrn92BeS0uvpiB.MFvCT2wIzcQcE1GfOCtOgLG', 0, 0),
(3, 'テスト3(一般)', 'test3', '$2y$10$6Vy7JPLXR82IAWnL.1jlBuvkyCfB1unIgUqqYcZ8Idf.2e5zLb.Sa', 0, 0);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `contents`
--
ALTER TABLE `contents`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
