-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 09, 2024 lúc 05:44 AM
-- Phiên bản máy phục vụ: 10.4.22-MariaDB
-- Phiên bản PHP: 7.4.27

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
  `cat_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `cat_name`, `description`) VALUES
(8, 'Cơ khí', 'q'),
(9, 'Giao Thông', 'g'),
(10, 'Điện tử', 'a'),
(11, 'Giáo dục', 'a');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `product_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `sku` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `image` text COLLATE utf8_unicode_ci NOT NULL,
  `gallery` text COLLATE utf8_unicode_ci NOT NULL,
  `categories` text COLLATE utf8_unicode_ci NOT NULL,
  `tags` text COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `product_name`, `sku`, `price`, `image`, `gallery`, `categories`, `tags`, `date`) VALUES
(218, 'java', 'java', '123', 'w.jpg', '[\"w.jpg\",\"b5b14dd5859d218f7da810c936733d76.jpg\"]', '[\"11\"]', '[\"18\"]', '2024-04-09'),
(219, 'JavaScript', 'JavaScript', '1234', '123.png', '[\"w.jpg\",\"b5b14dd5859d218f7da810c936733d76.jpg\",\"123.png\"]', '[\"11\"]', '[\"21\"]', '2024-04-19'),
(220, 'PHP', 'qwe', '123', '123.png', '[\"w.jpg\",\"b5b14dd5859d218f7da810c936733d76.jpg\"]', '[\"11\"]', '[\"18\"]', '2024-04-09'),
(221, 'Laptop', 'lp', '343', 'w.jpg', '[\"w.jpg\",\"b5b14dd5859d218f7da810c936733d76.jpg\",\"123.png\"]', '[\"10\"]', '[\"17\"]', '2024-04-21'),
(222, 'C', '123', '64654', '123.png', '[\"w.jpg\",\"b5b14dd5859d218f7da810c936733d76.jpg\",\"123.png\"]', '[\"8\"]', '[\"19\"]', '2024-04-09'),
(223, 'Golang', '123', '3242', '123.png', '[\"b5b14dd5859d218f7da810c936733d76.jpg\"]', '[\"8\"]', '[\"20\"]', '2024-04-05'),
(224, 'T', 'weq', '12333', '123.png', '[\"123.png\"]', '[\"9\"]', '[\"18\"]', '2024-04-09'),
(225, 'T13', '123', '2342', '123.png', '[\"w.jpg\",\"b5b14dd5859d218f7da810c936733d76.jpg\",\"123.png\"]', '[\"11\"]', '[\"18\"]', '2024-04-09');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `tag_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
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
(21, 'giaoduc', 'g');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=228;

--
-- AUTO_INCREMENT cho bảng `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
