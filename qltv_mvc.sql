-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 11, 2024 lúc 09:23 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `qltv_mvc`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `doc_gia`
--

CREATE TABLE `doc_gia` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ten` varchar(255) NOT NULL,
  `ngay_sinh` date NOT NULL,
  `khoa_hoc` varchar(100) NOT NULL,
  `khoa_cn` varchar(255) NOT NULL,
  `anh` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `doc_gia`
--

INSERT INTO `doc_gia` (`id`, `user_id`, `ten`, `ngay_sinh`, `khoa_hoc`, `khoa_cn`, `anh`, `created_at`) VALUES
(1, 1, 'Thào Đình Khải', '2002-10-05', '2021 - 2025', 'Khoa Khoa học Tự nhiên - Công nghệ', 'khai.png', '2024-11-29 03:30:04'),
(12, 20, 'Quàng Nhất Long', '2003-01-23', '2021 - 2025', 'Khoa Khoa học Tự nhiên - Công nghệ', 'tt_hcm.png', '2024-11-30 12:42:02'),
(19, 27, 'Lò Hải Nam', '2003-04-26', '2021 - 2025', 'Khoa Khoa học Tự nhiên - Công nghệ', 'cnxhkh.png', '2024-11-30 09:44:30'),
(28, 44, 'Nguyễn Tiến Dũng', '2005-02-03', '2021 - 2025', 'Khoa Khoa học Tự nhiên - Công nghệ', 'logo.png', '2024-12-03 16:18:21');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `gio_sach`
--

CREATE TABLE `gio_sach` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_sach` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `gio_sach`
--

INSERT INTO `gio_sach` (`id`, `id_user`, `id_sach`, `created_at`) VALUES
(4, 1, 3, '2024-12-02 02:56:09'),
(7, 1, 9, '2024-12-02 03:00:38'),
(13, 1, 11, '2024-12-05 02:06:06'),
(15, 1, 15, '2024-12-05 03:35:57'),
(16, 1, 14, '2024-12-05 04:07:51'),
(17, 1, 13, '2024-12-05 04:14:53'),
(18, 44, 3, '2024-12-05 07:06:57'),
(19, 44, 9, '2024-12-05 07:07:00'),
(20, 1, 16, '2024-12-10 08:28:50');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `muon_tra`
--

CREATE TABLE `muon_tra` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_gio` int(11) NOT NULL,
  `ngay_muon` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ngay_hen_tra` date NOT NULL,
  `ngay_tra` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `tinh_trang` enum('Đang chờ duyệt','Đang mượn','Đã trả') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `muon_tra`
--

INSERT INTO `muon_tra` (`id`, `id_user`, `id_gio`, `ngay_muon`, `ngay_hen_tra`, `ngay_tra`, `tinh_trang`) VALUES
(10, 1, 7, '2024-12-09 17:07:11', '2024-12-11', '2024-12-09 17:07:11', 'Đã trả'),
(20, 1, 4, '2024-12-06 02:56:13', '2024-12-11', '2024-12-06 02:56:13', 'Đã trả'),
(33, 1, 13, '2024-12-05 07:10:43', '2024-12-20', '2024-12-05 07:10:43', 'Đã trả'),
(34, 1, 15, '2024-12-10 08:25:12', '2024-12-20', '2024-12-10 08:25:12', 'Đã trả'),
(35, 1, 16, '2024-12-10 08:25:15', '2024-12-20', '2024-12-10 08:25:15', 'Đã trả'),
(36, 1, 17, '2024-12-10 08:25:20', '2024-12-20', '2024-12-10 08:25:20', 'Đã trả'),
(37, 44, 18, '2024-12-05 07:08:51', '2024-12-20', '2024-12-05 07:08:51', 'Đã trả'),
(38, 44, 19, '2024-12-05 07:09:16', '2024-12-20', '2024-12-05 07:09:16', 'Đã trả'),
(39, 1, 20, '2024-12-09 17:00:00', '2024-12-25', NULL, 'Đang chờ duyệt');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sach`
--

CREATE TABLE `sach` (
  `id` int(11) NOT NULL,
  `ten_sach` text NOT NULL,
  `anh` text NOT NULL,
  `tac_gia` varchar(255) NOT NULL,
  `nha_xuat_ban` varchar(255) NOT NULL,
  `nam_xuat_ban` year(4) NOT NULL,
  `the_loai` varchar(255) NOT NULL,
  `so_luong` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sach`
--

INSERT INTO `sach` (`id`, `ten_sach`, `anh`, `tac_gia`, `nha_xuat_ban`, `nam_xuat_ban`, `the_loai`, `so_luong`, `created_at`) VALUES
(3, 'Kinh tế chính trị Mác - Lênin', 'ktct.png', 'Bộ Giáo dục và Đào tạo', 'Nhà xuất bản Chính trị quốc gia Sự thật', '2024', 'Sách chung', 1000, '2024-11-29 03:15:51'),
(9, 'Giáo trình C++ và Lập trình hướng đối tượng', 'laptrinhc.png', 'Vũ Đức Thông', 'Nhà xuất bản Bách khoa Hà Nội', '2019', 'Sách Tin', 506, '2024-12-02 00:49:08'),
(11, 'Triết học Mác - Lênin', 'triet_hoc.png', 'Bộ Giáo dục và Đào tạo', 'Nhà xuất bản Chính trị quốc gia Sự thật', '2023', 'Sách chung', 500, '2024-12-02 02:23:53'),
(13, 'Giải tích 1', 'gt_1.png', 'GS. Vũ Tuấn', 'Nhà xuất bản Giáo dục Việt Nam', '2011', 'Sách Toán', 500, '2024-12-05 03:34:10'),
(14, 'Giải tích 2', 'gt_2.png', 'GS. Vũ Tuấn', 'Nhà xuất bản Giáo dục Việt Nam', '2011', 'Sách Toán', 500, '2024-12-05 03:34:34'),
(15, 'Tin học cơ sở', 'tinhoc.png', 'GS. Phạm Văn Ất', 'Nhà xuất bản Giáo dục Việt Nam', '2018', 'Sách Tin', 500, '2024-12-05 03:35:07'),
(16, 'Lịch sử Đảng Cộng sản Việt Nam', 'ls_dcsvn.png', 'Bộ Giáo dục và Đào tạo', 'Nhà xuất bản Chính trị quốc gia Sự thật', '2023', 'Sách chung', 1000, '2024-12-10 08:23:50');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thu_thu`
--

CREATE TABLE `thu_thu` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `anh` text NOT NULL,
  `ten` varchar(255) NOT NULL,
  `ngay_sinh` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `sdt` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `thu_thu`
--

INSERT INTO `thu_thu` (`id`, `user_id`, `anh`, `ten`, `ngay_sinh`, `email`, `sdt`, `created_at`) VALUES
(1, 2, 'khai.png', 'Thủ Thư', '2002-10-05', 'thuthu@gmail.com', '123-456-7890', '2024-12-09 16:14:14'),
(6, 51, 'laptrinhc.png', 'Khải TĐ', '2003-02-11', 'khaitd0510@gmail.com', '0819400780', '2024-12-09 17:05:34');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'nguoidung', 'khaitd0510@gmail.com', '$2y$10$pOtiOd5UpDYwmB87aAC25.vCk0zBQHKlmKfNaPdQtmeb4eW26rRH.', 1, '2024-11-26 03:51:18'),
(2, 'admin', 'khaizombie333@gmail.com', '$2y$10$ItoX03ksn4Xbsl3bURlCxelCD20jhdwRAh1ob3sGVVuIQWCgEBYxC', 3, '2024-12-09 15:44:58'),
(20, 'longqn', 'longqu@gmail.com', '$2y$10$gJL1DRTjXonDzT6zlSqSvOR9zg2dQZkgc8q3tdpJUEUENsapm.Hdu', 1, '2024-11-29 15:40:55'),
(27, 'hainam', 'hainam@gmail.com', '$2y$10$HZ7okHccC1LpyrLXSiUOquiYqNdJ73Ahmech8i1CC1POGhl9b8o1q', 1, '2024-11-30 09:44:30'),
(36, 'thanhmeu', 'thanhlv@gmail.com', '$2y$10$7xhfB0FUv9WqTOnhGNfpY.tBEVZ6fbycBXiqyV/jyDx1yxAoJwn7e', 1, '2024-11-30 10:07:44'),
(44, 'dinhkhai', 'khaitd0510@gmail.com', '$2y$10$Lcgxar4c9VCSm0uxTgzKRuEqJHM2JzbdxM9Bf7P4xPpKuPnBq3zX2', 1, '2024-12-03 16:17:34'),
(45, 'thuthu', 'thuthu@gmail.com', '$2y$10$o3dr6tnutJxJTzQ2QRzNc..GgwTHneIrZaStIjDr1XHhQZBGKlKgC', 2, '2024-12-09 07:22:34'),
(50, 'thuthu2', 'khaizombie333@gmail.com', '$2y$10$cq8Z7/ruk9RPuq1BLsdZYe2K5nYxeksjTX9s6BTulNEfwtlMCgVSW', 2, '2024-12-09 17:01:23'),
(51, 'thuthu3', 'khaitd0510@gmail.com', '$2y$10$u9pDKJDhT0anjyhJYIiVde0fQRS3HZsewjx8jHlBL05lGI6EQIM8K', 2, '2024-12-09 17:05:16');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `doc_gia`
--
ALTER TABLE `doc_gia`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `gio_sach`
--
ALTER TABLE `gio_sach`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_doc_gia` (`id_user`,`id_sach`),
  ADD KEY `id_sach` (`id_sach`);

--
-- Chỉ mục cho bảng `muon_tra`
--
ALTER TABLE `muon_tra`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_doc_gia` (`id_user`,`id_gio`),
  ADD KEY `id_gio` (`id_gio`);

--
-- Chỉ mục cho bảng `sach`
--
ALTER TABLE `sach`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `thu_thu`
--
ALTER TABLE `thu_thu`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `doc_gia`
--
ALTER TABLE `doc_gia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT cho bảng `gio_sach`
--
ALTER TABLE `gio_sach`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `muon_tra`
--
ALTER TABLE `muon_tra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT cho bảng `sach`
--
ALTER TABLE `sach`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `thu_thu`
--
ALTER TABLE `thu_thu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `doc_gia`
--
ALTER TABLE `doc_gia`
  ADD CONSTRAINT `doc_gia_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `gio_sach`
--
ALTER TABLE `gio_sach`
  ADD CONSTRAINT `gio_sach_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `gio_sach_ibfk_4` FOREIGN KEY (`id_sach`) REFERENCES `sach` (`id`);

--
-- Các ràng buộc cho bảng `muon_tra`
--
ALTER TABLE `muon_tra`
  ADD CONSTRAINT `muon_tra_ibfk_2` FOREIGN KEY (`id_gio`) REFERENCES `gio_sach` (`id`),
  ADD CONSTRAINT `muon_tra_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `thu_thu`
--
ALTER TABLE `thu_thu`
  ADD CONSTRAINT `thu_thu_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
