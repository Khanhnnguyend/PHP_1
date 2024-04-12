-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 11, 2024 lúc 05:03 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

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
  `cat_name` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `cat_name`, `description`) VALUES
(8, 'Cơ khí', 'q'),
(9, 'Giao Thông', 'g'),
(10, 'Điện tử', 'a'),
(11, 'Giáo dục', 'a'),
(12, '&amp; &#039; &gt; &quot;&gt; &#039;/&gt; &quot;/&g', 'dau'),
(13, '&#039; &quot; &#039;&gt; &quot;&gt; &#039;/&gt; &q', '&#039; &quot; &#039;&gt; &quot;&gt; &#039;/&gt; &quot;/&gt;'),
(14, '&#039; &quot; &#039;&gt; &quot;&gt; &#039;/&gt; &quot;/&gt;', '&#039; &quot; &#039;&gt; &quot;&gt; &#039;/&gt; &quot;/&gt;');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `product_name` text NOT NULL,
  `sku` varchar(50) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `image` text NOT NULL,
  `gallery` text NOT NULL,
  `categories` text NOT NULL,
  `tags` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `product_name`, `sku`, `price`, `image`, `gallery`, `categories`, `tags`, `date`) VALUES
(219, 'JavaScript &quot; &gt;', 'JavaScript', 1234, '123.png', '[\"123.png\",\"w.jpg\",\"b5b14dd5859d218f7da810c936733d76.jpg\"]', '[\"9\",\"11\"]', '[\"18\",\"21\"]', '2024-04-11'),
(220, 'PHP', 'qwe', 123, '123.png', '[\"w.jpg\",\"b5b14dd5859d218f7da810c936733d76.jpg\"]', '[\"11\"]', '[\"18\"]', '2024-04-09'),
(221, 'Laptop', 'lp', 343, 'w.jpg', '[\"w.jpg\",\"b5b14dd5859d218f7da810c936733d76.jpg\",\"123.png\"]', '[\"10\"]', '[\"17\"]', '2024-04-21'),
(222, 'C', '123', 64654, '123.png', '[\"w.jpg\",\"b5b14dd5859d218f7da810c936733d76.jpg\",\"123.png\"]', '[\"8\"]', '[\"19\"]', '2024-04-09'),
(223, 'Golang', '123', 3242, '123.png', '[\"b5b14dd5859d218f7da810c936733d76.jpg\"]', '[\"8\"]', '[\"20\"]', '2024-04-05'),
(224, 'T', 'weq', 12333, '123.png', '[\"123.png\"]', '[\"9\"]', '[\"18\"]', '2024-04-09'),
(225, 'T13', '123', 2342, '123.png', '[\"w.jpg\",\"b5b14dd5859d218f7da810c936733d76.jpg\",\"123.png\"]', '[\"11\"]', '[\"18\"]', '2024-04-09'),
(228, 'T4', '123', 123, '123.png', '[\"b5b14dd5859d218f7da810c936733d76.jpg\"]', '[\"11\"]', '[\"18\"]', '2024-04-09'),
(229, 'T6', '231', 12, 'b5b14dd5859d218f7da810c936733d76.jpg', '[\"w.jpg\"]', '[\"11\"]', '[\"18\"]', '2024-04-09'),
(230, 'T5', '123', 123, '123.png', '[\"b5b14dd5859d218f7da810c936733d76.jpg\"]', '[\"11\"]', '[\"19\"]', '2024-04-09'),
(240, 'qwe', 'qwe', 123, '123.png', '[\"123.png\",\"eq.jpg\"]', '[\"9\"]', '[\"18\"]', '2024-04-10'),
(241, 'qwe', 'qwe', 123, '123.png', '[\"123.png\",\"eq.jpg\"]', '[\"9\"]', '[\"18\"]', '2024-04-10'),
(242, 'T&#039;3', '123', 12321, '123.png', '[\"123.png\"]', '[\"10\"]', '[\"19\"]', '2024-04-09'),
(243, 'T&#039;&quot;9', 'q', 1123, '123.png', '[\"w.jpg\"]', '[\"11\"]', '[\"17\"]', '2024-04-04'),
(245, 'T&#039;&#039;&#039;7', '123', 12342, '', '[\"123.png\"]', '[\"9\"]', '[\"18\"]', '2024-04-11'),
(246, 'T&#039;&#039;2', '123', 123, '123.png', '[\"123.png\"]', '[\"10\"]', '[\"18\"]', '2024-04-11');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `tag_name` text NOT NULL,
  `description` text NOT NULL
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
(23, 'chia&#039;doi', 'dd&quot;/&gt;'),
(24, '&#039; &quot; &#039;', '&#039; &quot; &#039;&gt; &quot;&gt; &#039;/&gt; &quot;/&gt;'),
(25, '&#039; &quot; &#039;&gt; &quot;&gt; &#039;/&gt; &quot;/&gt;', '&#039; &quot; &#039;&gt; &quot;&gt; &#039;/&gt; &quot;/&gt;');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT cho bảng `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
