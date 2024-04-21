-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 21, 2024 lúc 06:57 PM
-- Phiên bản máy phục vụ: 10.4.24-MariaDB
-- Phiên bản PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `db_khanh`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `cat_name` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `cat_name`, `description`) VALUES
(8, 'Cơ khí', 'q'),
(9, 'Giao Thông', 'g'),
(10, 'Điện tử', 'a'),
(11, 'Giáo dục', 'a'),
(15, 'Plugins', ''),
(17, '123', '123');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `product_name` text COLLATE utf8_unicode_ci NOT NULL,
  `sku` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `image` text COLLATE utf8_unicode_ci NOT NULL,
  `gallery` text COLLATE utf8_unicode_ci NOT NULL,
  `date` char(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `product_name`, `sku`, `price`, `image`, `gallery`, `date`) VALUES
(393, 'T2', '123', '123', './assets/upload/Electrolux_trilobite.jpg', '[\"assets/upload/Electrolux_trilobite.jpg\"]', '2024-04-21'),
(395, 'T5', '234', '234', './assets/upload/Blue strokes.jpg', '[\"assets/upload/wp2555194-blue-background.png\"]', '2024-04-21'),
(396, 'T7', '1412', '12312', './assets/upload/c2d6970d29a961eee16c661431c36720.jpg', '[\"assets/upload/w9rsySb.jpg\"]', '2024-04-21'),
(397, 'T4', '123', '123', './assets/upload/8-85255_abstract-blue-design-backgrounds-widescreen-and-hd-blue.jpg', '[\"assets/upload/8acea9261c892e75b0651de1d4f4e0e1.jpg\"]', '2024-04-21'),
(398, 'T32', '123', '4234', './assets/upload/9d1b038a37775ad60111d1c79d789a63.jpg', '[\"assets/upload/501343.jpg\"]', '2024-04-21'),
(399, 'T78', '1231', '12312', './assets/upload/Blue strokes.jpg', '[\"assets/upload/Electrolux_trilobite.jpg\"]', '2024-04-21'),
(400, 'T3', '1234', '123', '', '[]', '2024-04-21'),
(401, 'T65', '456', '456', '', '', '2024-04-21'),
(402, 'T456', '353', '45345', '', '', '2024-04-21'),
(403, 'T234', '345', '456', '', '', '2024-04-21');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_fk_cat`
--

CREATE TABLE `product_fk_cat` (
  `id` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_cat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_fk_cat`
--

INSERT INTO `product_fk_cat` (`id`, `id_product`, `id_cat`) VALUES
(123, 393, 8),
(125, 395, 10),
(126, 396, 9),
(127, 397, 11),
(128, 398, 10),
(129, 399, 9),
(131, 401, 10),
(132, 402, 9),
(133, 400, 9);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_fk_tag`
--

CREATE TABLE `product_fk_tag` (
  `id` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_tag` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_fk_tag`
--

INSERT INTO `product_fk_tag` (`id`, `id_product`, `id_tag`) VALUES
(84, 393, 18),
(86, 395, 18),
(87, 395, 20),
(88, 396, 19),
(89, 397, 18),
(90, 398, 18),
(91, 399, 18),
(93, 401, 19),
(94, 402, 18),
(95, 400, 18);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `tag_name` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tags`
--

INSERT INTO `tags` (`id`, `tag_name`, `description`) VALUES
(17, 'tiendung', 'td'),
(18, 'trending', 't'),
(19, 'giaothong', 'g'),
(20, 'phuongtien', 't'),
(21, 'giaoduc', 'g'),
(22, 'chiase', 'cs'),
(27, '123', '123');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `product_fk_cat`
--
ALTER TABLE `product_fk_cat`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `product_fk_tag`
--
ALTER TABLE `product_fk_tag`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=405;

--
-- AUTO_INCREMENT cho bảng `product_fk_cat`
--
ALTER TABLE `product_fk_cat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT cho bảng `product_fk_tag`
--
ALTER TABLE `product_fk_tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT cho bảng `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
