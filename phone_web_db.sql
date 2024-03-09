-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 05, 2024 lúc 04:32 AM
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
-- Cơ sở dữ liệu: `phone_web_db`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `phoneID` int(10) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `customerID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Samsung'),
(2, 'Iphone'),
(3, 'Xiaomi'),
(4, 'ASUS'),
(9, 'quocan'),
(10, 'asdifjasdfasdf'),
(11, 'wr2rwrwr'),
(12, '2342er456yrty');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `color`
--

CREATE TABLE `color` (
  `id` int(11) NOT NULL,
  `phoneID` int(10) NOT NULL,
  `colorID` int(10) NOT NULL,
  `color` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `color`
--

INSERT INTO `color` (`id`, `phoneID`, `colorID`, `color`) VALUES
(1, 3, 1, 'Tím'),
(2, 3, 2, 'Xanh Rêu'),
(3, 3, 3, 'Đen'),
(4, 3, 4, 'Trắng'),
(5, 4, 1, 'Xanh Rêu'),
(6, 4, 3, 'Đen'),
(7, 4, 2, 'Trắng'),
(8, 5, 1, 'Xanh Rêu'),
(9, 5, 2, 'Tím'),
(10, 5, 3, 'Trắng'),
(11, 5, 4, 'Đen'),
(16, 6, 1, 'Xanh'),
(17, 6, 3, 'Đen'),
(18, 6, 2, 'Trắng'),
(19, 7, 1, 'Đen'),
(20, 7, 2, 'Vàng'),
(21, 7, 3, 'Tím'),
(22, 7, 4, 'Xanh'),
(23, 8, 1, 'Trắng'),
(24, 8, 2, 'Đen'),
(25, 8, 3, 'Vàng'),
(26, 8, 4, 'Tím'),
(27, 9, 1, 'Trắng'),
(28, 9, 2, 'Đen'),
(29, 9, 3, 'Tím'),
(30, 9, 4, 'Vàng'),
(31, 10, 1, 'Xanh'),
(32, 10, 2, 'Tím'),
(33, 10, 3, 'Trắng'),
(34, 10, 4, 'Vàng'),
(35, 11, 1, 'Trắng'),
(36, 11, 2, 'Tím'),
(37, 11, 3, 'Xanh'),
(38, 11, 4, 'Đỏ'),
(39, 16, 1, 'Xanh Ngọc'),
(40, 16, 2, 'Đen'),
(41, 16, 3, 'Trắng'),
(42, 17, 2, 'Đen'),
(43, 17, 1, 'Trắng'),
(44, 18, 1, 'Đen'),
(45, 18, 2, 'Hồng'),
(46, 18, 3, 'Xanh'),
(47, 19, 1, 'Xanh'),
(48, 19, 2, 'Xám'),
(49, 19, 3, 'Đen'),
(50, 20, 1, 'Xanh'),
(51, 20, 2, 'Xám'),
(52, 20, 3, 'Đen'),
(53, 22, 1, 'Đen'),
(54, 22, 2, 'Trắng'),
(55, 23, 1, 'Đen'),
(56, 23, 2, 'Trắng'),
(57, 24, 1, 'Đen'),
(58, 24, 2, 'Trắng'),
(84, 25, 1, 'he'),
(85, 26, 1, 'he'),
(87, 25, 2, 'ge');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer`
--

CREATE TABLE `customer` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phoneNumber` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `customer`
--

INSERT INTO `customer` (`id`, `name`, `email`, `password`, `address`, `phoneNumber`) VALUES
(1, 'Quoc An', 'lyquocan@gmail.com', '4297f44b13955235245b2497399d7a93', '114 Phan Đăng Lưu, P.3, Q.Phú Nhuận, TP HCM', '123123123'),
(2, 'quocan', 'lyquocan123@gmail.com', '4297f44b13955235245b2497399d7a93', '5 Nguyễn Kiệm, P.3, Q.Gò Vấp, TP HCM', '345123123'),
(3, 'abcabc', 'lyquocan1@gmail.com', '4297f44b13955235245b2497399d7a93', '159 Nguyễn Thị Minh Khai, P.Phạm Ngũ Lão, Q.1, TP HCM', '654688239'),
(4, 'hehe', 'lyquocan123@gmail.com', '4297f44b13955235245b2497399d7a93', '190B Hoàng Văn Thụ, P4, Q.Tân Bình, TPHCM', '54463651'),
(5, 'haha', 'lyquocan123@gmail.com', '4297f44b13955235245b2497399d7a93', '134 Nguyễn Thái Học, P.Phạm Ngũ Lão, Q.1, TP HCM', '123168998'),
(6, 'htjujg', 'lyquocan123@gmail.com', '4297f44b13955235245b2497399d7a93', '379 Điện Biên Phủ, P.25, Q.Bình Thạnh, TP HCM', '890785634523'),
(7, '6rert', 'lyquocan123@gmail.com', '4297f44b13955235245b2497399d7a93', '347 Nguyễn Tri Phương, P.5, Q.10, TP HCM', '567124146'),
(8, 'qưeqwe', 'lyquocan171@gmail.com.asd.ád', '481a4883778afa7ec63b70f163f737e6', '', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `employee`
--

CREATE TABLE `employee` (
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phoneNumber` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `block` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `employee`
--

INSERT INTO `employee` (`name`, `email`, `phoneNumber`, `position`, `password`, `block`) VALUES
('Quoc An', 'lyquocan171@gmail.com', '123123', 'admin', '4297f44b13955235245b2497399d7a93', 0),
('quocan', 'lyquocann@gmail.com', '5732400', 'user', '4297f44b13955235245b2497399d7a93', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `phoneID` int(10) NOT NULL,
  `colorID` int(10) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `image`
--

INSERT INTO `image` (`id`, `phoneID`, `colorID`, `image`) VALUES
(4, 3, 1, 'S23_1_1.jpg'),
(5, 3, 1, 'S23_1_2.jpg'),
(6, 3, 1, 'S23_1_3.jpg'),
(7, 3, 2, 'S23_2_1.jpg'),
(8, 3, 2, 'S23_2_2.jpg'),
(9, 3, 2, 'S23_2_3.jpg'),
(10, 3, 3, 'S23_3_1.jpg'),
(11, 3, 3, 'S23_3_2.jpg'),
(12, 3, 3, 'S23_3_3.jpg'),
(13, 3, 4, 'S23_4_1.jpg'),
(14, 3, 4, 'S23_4_2.jpg'),
(15, 3, 4, 'S23_4_3.jpg'),
(16, 4, 1, 'S23+_1_1.jpg'),
(17, 4, 1, 'S23+_1_2.jpg'),
(18, 4, 1, 'S23+_1_3.jpg'),
(19, 4, 2, 'S23+_2_1.jpg'),
(20, 4, 2, 'S23+_2_2.jpg'),
(21, 4, 2, 'S23+_2_3.jpg'),
(22, 4, 3, 'S23+_3_1.jpg'),
(23, 4, 3, 'S23+_3_2.jpg'),
(24, 4, 3, 'S23+_3_3.jpg'),
(25, 5, 1, 'S23Ultra_1_1.jpg'),
(26, 5, 1, 'S23Ultra_1_2.jpg'),
(27, 5, 1, 'S23Ultra_1_3.jpg'),
(28, 5, 2, 'S23Ultra_2_1.jpg'),
(29, 5, 2, 'S23Ultra_2_2.jpg'),
(30, 5, 2, 'S23Ultra_2_3.jpg'),
(31, 5, 3, 'S23Ultra_3_1.jpg'),
(32, 5, 3, 'S23Ultra_3_2.jpg'),
(33, 5, 3, 'S23Ultra_3_3.jpg'),
(34, 5, 4, 'S23Ultra_4_1.jpg'),
(35, 5, 4, 'S23Ultra_4_2.jpg'),
(36, 5, 4, 'S23Ultra_4_3.jpg'),
(37, 6, 1, 'ZFold4_1_1.jpg'),
(38, 6, 1, 'ZFold4_1_2.jpg'),
(39, 6, 1, 'ZFold4_1_3.jpg'),
(40, 6, 2, 'ZFold4_2_1.jpg'),
(41, 6, 2, 'ZFold4_2_2.jpg'),
(42, 6, 2, 'ZFold4_2_3.jpg'),
(43, 6, 3, 'ZFold4_3_1.jpg'),
(44, 6, 3, 'ZFold4_3_2.jpg'),
(45, 6, 3, 'ZFold4_3_3.jpg'),
(46, 7, 1, 'ZFlip4_1_1.jpg'),
(47, 7, 2, 'ZFlip4_2_1.jpg'),
(48, 7, 3, 'ZFlip4_3_1.jpg'),
(49, 7, 4, 'ZFlip4_4_1.jpg'),
(50, 8, 1, 'IPhone14ProMax_1_1.jpg'),
(51, 8, 2, 'IPhone14ProMax_2_1.jpg'),
(52, 8, 3, 'IPhone14ProMax_3_1.jpg'),
(53, 8, 4, 'IPhone14ProMax_4_1.jpg'),
(54, 9, 1, 'IPhone14Pro_1_1.jpg'),
(55, 9, 2, 'IPhone14Pro_2_1.jpg'),
(56, 9, 3, 'IPhone14Pro_3_1.jpg'),
(57, 9, 4, 'IPhone14Pro_4_1.jpg'),
(58, 10, 1, 'IPhone14_1_1.jpg'),
(59, 10, 2, 'IPhone14_2_1.jpg'),
(60, 10, 3, 'IPhone14_3_1.jpg'),
(61, 10, 4, 'IPhone14_4_1.jpg'),
(62, 11, 1, 'IPhone14Plus_1_1.jpg'),
(63, 11, 2, 'IPhone14Plus_2_1.jpg'),
(64, 11, 3, 'IPhone14Plus_3_1.jpg'),
(65, 11, 4, 'IPhone14Plus_4_1.jpg'),
(66, 16, 1, 'Xiaomi13_1_1.jpg'),
(67, 16, 1, 'Xiaomi13_1_2.jpg'),
(68, 16, 1, 'Xiaomi13_1_3.jpg'),
(69, 16, 2, 'Xiaomi13_2_1.jpg'),
(70, 16, 2, 'Xiaomi13_2_2.jpg'),
(71, 16, 2, 'Xiaomi13_2_3.jpg'),
(72, 16, 3, 'Xiaomi13_3_1.jpg'),
(73, 16, 3, 'Xiaomi13_3_2.jpg'),
(74, 16, 3, 'Xiaomi13_3_3.jpg'),
(75, 16, 3, 'Xiaomi13_3_4.jpg'),
(76, 16, 3, 'Xiaomi13_3_5.jpg'),
(77, 16, 3, 'Xiaomi13_3_6.jpg'),
(78, 16, 3, 'Xiaomi13_3_7.jpg'),
(79, 17, 1, 'Xiaomi13Pro_1_1.jpg'),
(80, 17, 1, 'Xiaomi13Pro_1_2.jpg'),
(81, 17, 2, 'Xiaomi13Pro_2_1.jpg'),
(82, 17, 2, 'Xiaomi13Pro_2_2.jpg'),
(83, 17, 2, 'Xiaomi13Pro_2_3.jpg'),
(84, 17, 2, 'Xiaomi13Pro_2_4.jpg'),
(85, 17, 2, 'Xiaomi13Pro_2_5.jpg'),
(86, 18, 1, 'Xiaomi13Lite_1_1.jpg'),
(87, 18, 2, 'Xiaomi13Lite_2_1.jpg'),
(88, 18, 2, 'Xiaomi13Lite_2_2.jpg'),
(89, 18, 2, 'Xiaomi13Lite_2_3.jpg'),
(90, 18, 3, 'Xiaomi13Lite_3_1.jpg'),
(91, 19, 2, 'Xiaomi12TPro_2_1.jpg'),
(92, 19, 1, 'Xiaomi12TPro_1_1.jpg'),
(93, 19, 1, 'Xiaomi12TPro_1_2.jpg'),
(94, 19, 1, 'Xiaomi12TPro_1_3.jpg'),
(95, 19, 1, 'Xiaomi12TPro_1_4.jpg'),
(96, 19, 3, 'Xiaomi12TPro_3_1.jpg'),
(97, 20, 2, 'Xiaomi12T_2_1.jpg'),
(98, 20, 2, 'Xiaomi12T_2_2.jpg'),
(99, 20, 1, 'Xiaomi12T_1_1.jpg'),
(100, 20, 1, 'Xiaomi12T_1_2.jpg'),
(101, 20, 1, 'Xiaomi12T_1_3.jpg'),
(102, 20, 3, 'Xiaomi12T_3_1.jpg'),
(103, 20, 3, 'Xiaomi12T_3_2.jpg'),
(104, 22, 1, 'Rog6_1_1.jpg'),
(105, 22, 1, 'Rog6_1_2.jpg'),
(106, 22, 1, 'Rog6_1_3.jpg'),
(107, 22, 1, 'Rog6_1_4.jpg'),
(108, 22, 2, 'Rog6_2_1.jpg'),
(109, 22, 2, 'Rog6_2_2.jpg'),
(110, 22, 2, 'Rog6_2_3.jpg'),
(111, 22, 2, 'Rog6_2_4.jpg'),
(112, 22, 2, 'Rog6_2_5.jpg'),
(113, 22, 2, 'Rog6_2_6.jpg'),
(114, 23, 1, 'Rog5_1_1.jpg'),
(115, 23, 1, 'Rog5_1_2.jpg'),
(116, 23, 1, 'Rog5_1_3.jpg'),
(117, 23, 1, 'Rog5_1_4.jpg'),
(118, 23, 2, 'Rog5_2_1.jpg'),
(119, 23, 2, 'Rog5_2_2.jpg'),
(120, 24, 1, 'Rog5s_1_1.jpg'),
(121, 24, 1, 'Rog5s_1_2.jpg'),
(122, 24, 1, 'Rog5s_1_3.jpg'),
(123, 24, 2, 'Rog5s_2_1.jpg'),
(124, 24, 2, 'Rog5s_2_2.jpg'),
(125, 24, 2, 'Rog5s_2_3.jpg'),
(195, 25, 1, 'IPhone14_2_1.jpg'),
(196, 26, 1, 'IPhone14_2_1.jpg'),
(198, 25, 2, 'IPhone14Plus_4_1.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order`
--

CREATE TABLE `order` (
  `id` int(10) NOT NULL,
  `customerID` int(10) NOT NULL,
  `date` date NOT NULL,
  `totalPayment` int(100) NOT NULL,
  `orderStatus` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order`
--

INSERT INTO `order` (`id`, `customerID`, `date`, `totalPayment`, `orderStatus`, `address`) VALUES
(1, 1, '2023-01-01', 61470000, 'Completed', '123 Main St'),
(2, 1, '2023-01-01', 61470000, 'Completed', '123 Main St'),
(3, 2, '2023-01-01', 80970000, 'Completed', '456456 Main Sadasdqaweqweqwt'),
(4, 3, '2023-02-02', 31990000, 'Completed', '456456 Main Sadasdqaweqweqwt'),
(5, 4, '2023-02-02', 31990000, 'Completed', '456456 Main Sadasdqaweqweqwt'),
(6, 5, '2023-02-02', 199950000, 'Completed', '456456 Main Sadasdqaweqweqwt'),
(7, 6, '2023-02-03', 35980000, 'Completed', '456456 Main Sadasdqaweqweqwt'),
(8, 6, '2023-03-03', 35980000, 'Completed', '456456 Main Sadasdqaweqweqwt'),
(9, 2, '2023-03-03', 39980000, 'Completed', '456456 Main Sadasdqaweqweqwt'),
(10, 3, '2023-03-04', 73980000, 'Completed', '456456 Main Sadasdqaweqweqwt'),
(11, 4, '2023-04-04', 54180000, 'Completed', '456456 Main Sadasdqaweqweqwt'),
(12, 4, '2023-04-04', 204950000, 'Completed', '456456 Main Sadasdqaweqweqwt'),
(13, 5, '2023-05-04', 35380000, 'Completed', '456456 Main Sadasdqaweqweqwt'),
(14, 7, '2023-05-04', 70760000, 'Completed', '456456 Main Sadasdqaweqweqwt'),
(15, 8, '2023-05-04', 78760000, 'Completed', '456456 Main Sadasdqaweqweqwt'),
(16, 1, '2023-05-04', 119970000, 'Completed', '123 Main St');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orderdetail`
--

CREATE TABLE `orderdetail` (
  `orderID` int(10) NOT NULL,
  `variantID` int(10) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orderdetail`
--

INSERT INTO `orderdetail` (`orderID`, `variantID`, `quantity`, `price`) VALUES
(1, 1, 3, 20490000),
(2, 4, 3, 20490000),
(3, 13, 3, 26990000),
(4, 19, 1, 31990000),
(5, 20, 1, 31990000),
(6, 24, 5, 39990000),
(7, 26, 2, 17990000),
(8, 26, 2, 17990000),
(9, 29, 2, 19990000),
(10, 34, 2, 36990000),
(11, 40, 2, 27090000),
(12, 51, 5, 40990000),
(13, 116, 2, 17690000),
(14, 114, 2, 18990000),
(14, 113, 2, 18990000),
(15, 106, 2, 10890000),
(15, 99, 2, 28490000),
(16, 21, 3, 39990000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phone`
--

CREATE TABLE `phone` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` int(10) NOT NULL,
  `date` date NOT NULL,
  `detail` varchar(255) DEFAULT NULL,
  `visible` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `phone`
--

INSERT INTO `phone` (`id`, `name`, `category`, `date`, `detail`, `visible`) VALUES
(3, 'Samsung Galaxy S23', 1, '2023-04-05', '', 0),
(4, 'Samsung Galaxy S23+', 1, '2023-04-05', '', 1),
(5, 'Samsung Galaxy S23 Ultra', 1, '2023-04-05', '', 1),
(6, 'Samsung Galaxy Z Fold 4', 1, '2023-04-05', '', 1),
(7, 'Samsung Galaxy Z Flip 4', 1, '2023-04-05', '', 1),
(8, 'iPhone 14 Pro Max', 2, '2023-04-05', '', 1),
(9, 'iPhone 14 Pro', 2, '2023-04-05', '', 1),
(10, 'iPhone 14', 2, '2023-04-05', '', 1),
(11, 'iPhone 14 Plus', 2, '2023-04-05', '', 1),
(16, 'Xiaomi 13', 3, '2023-04-05', '', 1),
(17, 'Xiaomi 13 Pro', 3, '2023-04-05', '', 1),
(18, 'Xiaomi 13 Lite', 3, '2023-04-05', '', 1),
(19, 'Xiaomi 12T Pro', 3, '2023-04-05', '', 1),
(20, 'Xiaomi 12T', 3, '2023-04-05', '', 1),
(22, 'ASUS ROG Phone 6', 4, '2023-04-05', '', 1),
(23, 'ASUS ROG Phone 5', 4, '2023-04-05', '', 1),
(24, 'ASUS ROG Phone 5s', 4, '2023-04-05', '', 1),
(25, 'adfhiasdjfiasdf', 4, '2023-05-03', NULL, 1),
(26, 'adfhiasdjfiasdf', 4, '2023-05-03', NULL, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `spec`
--

CREATE TABLE `spec` (
  `phoneID` int(10) NOT NULL,
  `chipset` varchar(50) NOT NULL,
  `cpuType` varchar(255) NOT NULL,
  `bodySize` varchar(255) NOT NULL,
  `bodyWeight` varchar(255) NOT NULL,
  `screenFeature` varchar(255) NOT NULL,
  `screenResolution` varchar(50) NOT NULL,
  `screenSize` varchar(255) NOT NULL,
  `screenTech` varchar(255) NOT NULL,
  `os` varchar(50) NOT NULL,
  `videoCapture` varchar(255) NOT NULL,
  `cameraFront` varchar(255) NOT NULL,
  `cameraBack` varchar(255) NOT NULL,
  `cameraFeature` varchar(255) NOT NULL,
  `battery` varchar(255) NOT NULL,
  `sim` varchar(50) NOT NULL,
  `networkSupport` varchar(50) NOT NULL,
  `wifi` varchar(255) NOT NULL,
  `misc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `spec`
--

INSERT INTO `spec` (`phoneID`, `chipset`, `cpuType`, `bodySize`, `bodyWeight`, `screenFeature`, `screenResolution`, `screenSize`, `screenTech`, `os`, `videoCapture`, `cameraFront`, `cameraBack`, `cameraFeature`, `battery`, `sim`, `networkSupport`, `wifi`, `misc`) VALUES
(3, 'Snapdragon 8 Gen 2', '1 nhân 3.36 GHz, 4 nhân 2.8 GHz & 3 nhân 2 GHz', '146.3 x 70.9 x 7.6 mm', '168g', 'Tần số quét 120Hz, Kính cường lực Corning Gorilla Glass Victus 2, Độ sáng tối đa: 1750 nits', '1080 x 2340 pixels (FullHD+)', '6.1 inches', 'Dynamic AMOLED 2X', 'Android 13, One UI 5.1', 'FullHD 1080p@30fps, 4K 2160p@60fps, HD 720p@30fps, 8K 4320p@24fps, 8K 4320p@30fps', '12MP', 'Chính 50 MP & Phụ 12 MP, 10 MP', 'Quay Siêu chậm , AI Camera , Chuyên nghiệp (Pro) , Tự động lấy nét (AF) , Toàn cảnh (Panorama) , Chống rung quang học (OIS) , Ảnh Raw , Ban đêm (Night Mode) , Trôi nhanh thời gian (Time Lapse) , Zoom quang học , Nhãn dán (AR Stickers) , Làm đẹp', '3900 mAh', '2 Nano-SIM + eSIM', '5G', 'Dual-band (2.4 GHz/5 GHz), Wi-Fi Direct, Wi-Fi 802.11 a/b/g/n/ac/ax, 6 GHz', 'Cảm biến vân tay trong màn hình, Hỗ trợ 5G, Sạc không dây, Bảo mật vân tay, Nhận diện khuôn mặt, Kháng nước, kháng bụi'),
(4, 'Snapdragon 8 Gen 2', '1x3.2 GHz Cortex-X3 & 2x2.8 GHz Cortex-A715 & 2x2.8 GHz Cortex-A710 & 3x2.0 GHz Cortex-A510', '\r\n157.8 x 76.2 x 7.6 mm', '195g', 'Tần số quét 120Hz, HDR10+, Kính cường lực Corning® Gorilla® Glass Victus® 2c', '1080 x 2340 pixels (FullHD+)', '6.6 inches', 'Dynamic AMOLED 2X', 'Android 13, One UI 5.1', '8K@24/30fps, 4K@30/60fps, 1080p@30/60/240fps, 720p@960fps, HDR10+, stereo sound rec., gyro-EIS', '12MP, f/2.2', 'Camera chính góc rộng: 50 MP, f/1.8, Dual Pixel PDAF, OIS, Camera tele: 10 MP, f/2, 3x optical zoom, Camera góc siêu rộng:12 MP, f/2.2', 'Quay Siêu chậm (Super Slow Motion), AI Camera, Chuyên nghiệp (Pro), Tự động lấy nét (AF), Toàn cảnh (Panorama), Ảnh Raw, Ban đêm (Night Mode), Zoom quang học, Nhãn dán (AR Stickers), Làm đẹp, Live Photo, Bộ lọc màu, Trôi nhanh thời gian (Time Lapse), Góc ', '4700 mAh', '2 SIM (nano‑SIM và eSIM)', '5G', 'Wi-Fi 802.11 a/b/g/n/ac/6e, tri-band, Wi-Fi Direct', 'Cảm biến vân tay trong màn hình, Cảm biến gia tốc, La bàn, Con quay hồi chuyển, Cảm biến áp kế, Hỗ trợ 5G, Sạc không dây, Bảo mật vân tay, Nhận diện khuôn mặt, Kháng nước, kháng bụi'),
(5, 'Snapdragon 8 Gen 2 (4 nm)', '1x3.36 GHz Cortex-X3 & 2x2.8 GHz Cortex-A715 & 2x2.8 GHz Cortex-A710 & 3x2.0 GHz Cortex-A510', '163.4 x 78.1 x 8.9 mm', '234g', '120Hz, HDR10+, 1750 nits, Gorilla Glass Victus 2', '1440 x 3088 pixels (QHD+)', '6.8 inches', 'Dynamic AMOLED 2X', 'Android 13, One UI 5.1', '8K@24/30fps, 4K@30/60fps, 1080p@30/60/240fps, 720p@960fps, HDR10+, stereo sound rec., gyro-EIS', '\r\n12MP F2.2 (Dual Pixel AF)', 'Siêu rộng: 12MP F2.2 (Dual Pixel AF), Chính: 200MP F1.7 OIS ±3° (Super Quad Pixel AF), Tele 1: 10MP F4.9 (10X, Dual Pixel AF) OIS,Tele 2: 10MP F2.4 (3X, Dual Pixel AF) OIS Thu phóng chuẩn không gian 100X', 'Quay Siêu chậm (Super Slow Motion), Chuyên nghiệp (Pro), Tự động lấy nét (AF), HDR, Toàn cảnh (Panorama), Ảnh Raw, Ban đêm (Night Mode), Zoom quang học, \r\nLàm đẹp, Live Photo, Bộ lọc màu, Trôi nhanh thời gian (Time Lapse), Góc siêu rộng (Ultrawide), Góc r', '5000 mAh', '\r\n2 Nano-SIM + eSIM', '5G', 'Wi-Fi 802.11 a/b/g/n/ac/6e, tri-band, Wi-Fi Direct', 'Cảm biến vân tay trong màn hình, Cảm biến gia tốc, Cảm biến tiệm cận, La bàn, Con quay hồi chuyển, Cảm biến áp kế\r\n'),
(6, 'Snapdragon 8 Plus Gen 1', '1 nhân 3.18 GHz, 3 nhân 2.7 GHz & 4 nhân 2 GHz', 'Kích thước khi gập lại: 155.1 x 130.1 x 6.3 mm, Kích thước khi máy mở ra: 155.1 x 67.1 x 14.2-15.8 mm', '263g', 'Màn hình chính: 7,6 inch QXGA + Dynamic AMOLED 2X, 120Hz, Màn hình phụ: 6.2 inch HD + AMOLED, 120Hz', '2176 x 1812 pixels (QXGA+)', '\r\n7.6 inches', 'AMOLED', 'Android 12, One UI 5.1', 'UHD 8K (7680 x 4320)@24fps', '10MP (bên ngoài) + 4MP (dưới màn hình)', 'Camera chính: 50MP, f/1.8, Camera góc siêu rộng: 12MP, f/2.2, Camera tele: 10MP, f/2.4 (3x zoom)', 'Quay Siêu chậm (Super Slow Motion), Chuyên nghiệp (Pro), Tự động lấy nét (AF), HDR, Toàn cảnh (Panorama), Ảnh Raw, Ban đêm (Night Mode), Zoom quang học, \r\nLàm đẹp, Live Photo, Bộ lọc màu, Trôi nhanh thời gian (Time Lapse), Góc siêu rộng (Ultrawide), Quay ', '4400 mAh', '2 SIM (nano‑SIM và eSIM)', '5G', '802.11 a/b/g/n/ac/ax 2.4G+5GHz+6GHz, HE160, MIMO, 1024-QAM', 'Hỗ trợ 5G, Sạc không dây, Bảo mật vân tay, Nhận diện khuôn mặt, Kháng nước, kháng bụi, Cảm biến gia tốc, Cảm biến tiệm cận, Cảm biến ánh sáng, La bàn, Cảm biến áp kế, Cảm biến vân tay cạnh bên'),
(7, 'Snapdragon 8+ Gen 1 8 nhân', '1 nhân 3.18 GHz, 3 nhân 2.7 GHz & 4 nhân 2 GHz', 'Khi mở: 165.2 x 71.9 x 6.9mm, Khi gâp: 84.9 x 71.9 x 15.9-17.1 mm', '187g', 'Màn hình chính: 6.7 inches, Dynamic AMOLED 2X, Màn hình ngoài: 1.9 inches, Super AMOLED, 120Hz, HDR10+, 1200 nits (peak)', '1080 x 2640 pixels', '6.7 inches', 'Dynamic AMOLED 2X', 'Android 12', '4K@30/60fps, 1080p@60/240fps, 720p@960fps, HDR10+', '10 MP, f/2.4', 'Camera góc rộng: 12 MP, f/1.8, PDAF, OIS, Camera góc siêu rộng: 12 MP, f/2.2, 123˚', 'Đèn Flash, Quay Siêu chậm (Super Slow Motion), AI Camera, Zoom quang học', '3700 mAh', '2 SIM (nano‑SIM và eSIM)', '5G', '802.11 a/b/g/n/ac/ax, dual-band, Wi-Fi Direct, hotspot', 'Samsung Pay, Chế độ đơn giản (Giao diện đơn giản), Thu nhỏ màn hình sử dụng một tay, Trợ lý ảo Samsung Bixby\r\nSamsung DeX (Kết nối màn hình sử dụng giao diện tương tự PC), Đa cửa sổ (chia đôi màn hình), Tối ưu game (Game Booster), Cảm biến vân tay cạnh bê'),
(8, 'Apple A16 Bionic', '6-core', '160.7 x 77.6 x 7.9 mm', '240g', 'ProMotion 120Hz', '1290 x 2796 pixels', '6.7 inches', 'Super Retina XDR OLED', 'iOS 16', '4K@24/25/30/60fps, 1080p@25/30/60/120/240fps, 10-bit HDR, Dolby Vision HDR (60fps), Chế độ ProRes, Chế độ Cinematic (4K@30fps)', 'Camera selfie: 12 MP, f/1.9, 23mm, 1/3.6\", PDAF', 'Camera chính: 48 MP, f/1.8, 24mm, 1.22µm, PDAF, OIS, Camera góc siêu rộng: 12 MP, f/2.2, 13mm, 120˚, 1.4µm, PDAF, Camera tele: 12 MP, f/2.8, 77mm (telephoto), PDAF, OIS, 3x optical zoom, Cảm biến độ sâu TOF 3D LiDAR', 'Quay phim Cinematic, Chế độ ProRes, Quay phim Dolby Vision HDR', '4352 mAh', '2 SIM (nano‑SIM và eSIM)', '5G\r\n', 'Wi-Fi MIMO, Dual-band (2.4 GHz/5 GHz), Wi-Fi 802.11 a/b/g/n/ac/ax, Wi-Fi hotspot', 'Hỗ trợ 5G, Sạc không dây, Nhận diện khuôn mặt, Kháng nước, kháng bụi'),
(10, 'Apple A15 Bionic', '6-core', '146.7 x 71.5 x 7.8 mm', '172g', 'Tần số quét 60Hz', '1170 x 2532 pixels', '6.1 inches', 'Super Retina XDR OLED', 'iOS 16', '4K@24/25/30/60fps, 1080p@25/30/60/120/240fps, HDR, Dolby Vision HDR (up to 60fps), Cinematic mode (4K@30fps), stereo sound rec.', '12 MP, f/1.9, 23mm (wide), 1/3.6\", PDAF, SL 3D, (depth/biometrics sensor)', '12 MP, f/1.5, 26mm (wide), 1/1.7\", 1.9µm, dual pixel PDAF, sensor-shift OIS, 12 MP, f/2.4, 13mm, 120˚ (ultrawide)', 'Dual-LED dual-tone flash, HDR (photo/panorama)', '3279 mAh', '2 SIM (nano‑SIM và eSIM)', '%G', 'Wi-Fi MIMO, Dual-band (2.4 GHz/5 GHz), Wi-Fi 802.11 a/b/g/n/ac/ax, Wi-Fi hotspot', 'Hỗ trợ 5G, Nhận diện khuôn mặt, Kháng nước, kháng bụi'),
(11, 'Apple A15 Bionic', '6-core', '160.8 x 78.1 x 7.8 mm', '203g', '458 ppi, HDR, True Tone, độ sáng 1200 nits , màn hình chống bám vân tay, 2,000,000:1', '2778 x 1284 pixels', '6.7 inches', 'Super Retina XDR OLED', 'iOS 16', '4K / Full HD 60FPS, 720p 30FPS, Slow-mo Full HD 240FPS', '12 MP, f/1.9, 23mm (wide), 1/3.6\", PDAF, SL 3D, (depth/biometrics sensor)', '12 MP, f/1.5, 26mm (wide), 1/1.7\", 1.9µm, dual pixel PDAF, sensor-shift OIS, 12 MP, f/2.4, 13mm, 120˚ (ultrawide)', 'Deep Fusion, Smart HDR 4,Panorama, Chụp đêm, Chân dung, QuickTake video, Time‑lapse, Slo-mo video', '4323 mAh', '2 SIM (nano‑SIM và eSIM)', '5G', 'Wi‑Fi 6 (802.11ax)', 'Hỗ trợ 5G, Sạc không dây, Nhận diện khuôn mặt, Kháng nước, kháng bụi'),
(16, 'Qualcomm SM8550-AB Snapdragon 8 Gen 2 (4 nm)', 'Octa-core (1x3.2 GHz Cortex-X3 & 2x2.8 GHz Cortex-A715 & 2x2.8 GHz Cortex-A710 & 3x2.0 GHz Cortex-A510)', '152.8 x 71.5 x 8.0 mm', '185g', 'Tốc độ lấy mẫu cảm ứng: lên tới 240Hz, Độ sáng: HBM 1200 nits (typ), độ sáng tối đa 1900 nits, HDR, Tầm nhìn Dolby® HDR10+, Gam màu: DCI-P3', '1080 x 2400 pixels (FullHD+)', '6.36 inches', 'AMOLED', 'Android 13, MIUI 14', '8K@24fps (HDR), 4K@24/30/60fps (HDR10+, 10-bit Dolby Vision HDR, 10-bit LOG), 1080p@30/120/240/960fps, 1080p@1920fps, gyro-EIS', '32 MP, f/2.0, 22mm (wide), 0.7µm', '50 MP, f/1.8, 23mm (wide), 1/1.49\", 1.0µm, PDAF, OIS, 10 MP, f/2.0, 75mm (telephoto), 1/3.75\", 1.0µm, PDAF, OIS, 3.2x optical zoom, 12 MP, f/2.2, 15mm, 120˚ (ultrawide), 1/3.06\", 1.12µm', 'Hai phong cách chụp ảnh (Leica Authentic Look, Leica Vibrant Look), Hình ảnh chân thực của Leica, Vẻ ngoài rực rỡ của Leica, bộ lọc Leica, Âm thanh màn trập cổ điển của Leica, Hình mờ Leica, Chế độ ban đêm (rộng/siêu rộng/tele)', '4500 mAh', '2 SIM (Nano-SIM)', '5G', 'Wi-Fi 802.11 a/b/g/n/ac/6e, dual-band, Wi-Fi Direct', 'Hỗ trợ 5G, Sạc không dây, Bảo mật vân tay, Nhận diện khuôn mặt'),
(17, 'Qualcomm SM8550-AB Snapdragon 8 Gen 2 (4 nm)', 'Octa-core (1x3.2 GHz Cortex-X3 & 2x2.8 GHz Cortex-A715 & 2x2.8 GHz Cortex-A710 & 3x2.0 GHz Cortex-A510)', '162.9 x 74.6 x 8.4 mm', '210g', 'Pro HDR display, Dolby Vision®, HDR10+, DCI-P3, 1 triệu màu, Corning®Gorilla®Glass Victus®', '3200 x 1440 pixel', '6.73 inches', 'AMOLED', 'Android 13, MIUI 14', '8K@24fps (HDR), 4K@24/30/60fps (HDR10+, 10-bit Dolby Vision HDR, 10-bit LOG), 1080p@30/120/240/960fps, 1080p@1920fps, gyro-EIS', '32 MP, (wide)', '50.3 MP, f/1.9, 23mm (wide), 1.0\"-type, 1.6µm, Dual Pixel PDAF, Laser AF, OIS, 50 MP, f/2.0, 75mm (telephoto), PDAF (10cm - ∞), 3.2x optical zoom, 50 MP, f/2.2, 14mm, 115˚ (ultrawide), AF', 'Leica lens, Dual-LED dual-tone flash, HDR, panorama', '4820 mAh', '2 SIM (Nano-SIM)', '5G', '802.11 a/b/g/n/ac/6e, dual-band, Wi-Fi Direct', 'Cảm biến vân tay trong màn hình, IP68'),
(18, 'Qualcomm SM7450-AB Snapdragon 7 Gen 1 (4 nm)', 'Octa-core (1x2.4 GHz Cortex-A710 & 3x2.36 GHz Cortex-A710 & 4x1.8 GHz Cortex-A510)', '159.2 x 72.7 x 7.2 mm', '171g', '68 triệu màu, Dolby Vision, HDR10+, 120Hz, 500 nits, Corning Gorilla Glass 5', '1080 x 2400 pixels (FullHD+)', '6.55 inches', 'AMOLED', 'Android 12, MIUI 14', '4K@30fps, 1080p@30/60/120fps, 720p@960fps', '32 MP, f/2.4, 100˚ (ultrawide), 1/2.74\", 0.8µm, 8 MP, f/2.3, (depth)', '50 MP, f/1.8, 23mm (wide), 1/1.56\", 1.0µm, PDAF, 8 MP, f/2.2, 119˚ (ultrawide), 1/4.0\", 1.12µm, 2 MP, f/2.4, (macro)', 'Chế độ ban đêm, Chụp chuyển động thời gian bùng nổ, chế độ tài liệu, máy ảnh A,I sấm chớp, Google Ống kính AI, Làm đẹp AI ở chế độ chân dung khung hình điện ảnh, 12 bộ lọc video', '4500 mAh', '2 SIM (Nano-SIM)', '5G', 'Wi-Fi 802.11 a/b/g/n/ac/6, dual-band', 'Hỗ trợ 5G, Bảo mật vân tay, Nhận diện khuôn mặt, IP53'),
(19, 'Qualcomm SM8475 Snapdragon 8+ Gen 1 (4 nm)', 'Octa-core (1x3.19 GHz Cortex-X2 & 3x2.75 GHz Cortex-A710 & 4x2.0 GHz Cortex-A510)', '163.1 x 75.9 x 8.6 mm', '205g', 'Tần số quét 120Hz, Corning Gorilla Glass 5, HDR10+, Độ sáng: 500 nit, Dolby Vision®, Cảm biến ánh sáng xung quanh 360°', '1080 x 2400 pixels (FullHD+)', '6.67 inches', 'AMOLED', 'Android 12, MIUI 13', '8K@24fps, 4K@30/60fps, 1080p@30/60/120/240fps, HDR10+', '20 MP, f/2.2, (wide), 1/3.47\", 0.8µm', '200 MP, f/1.7, (wide), 1/1.22\", 0.64µm, PDAF, OIS, 8 MP, f/2.2, 120˚ (ultrawide), 1/4\", 1.12µm, 2 MP, f/2.4, (macro)', 'Góc rộng (Wide), Quay video Full HD, Làm đẹp, Toàn cảnh (Panorama), Nhận diện khuôn mặt, Xóa phông, Quay video HD, Chụp đêm, Trôi nhanh thời gian (Time Lapse), Flash màn hình, Hiệu ứng Bokeh, A.I Camera, Quay chậm (Slow Motion), HDR, Bộ lọc màu', '5000 mAh', '2 SIM (Nano-SIM)', '5G', 'Wi-Fi 802.11 a/b/g/n/ac/6e, dual-band, Wi-Fi Direct, hotspot', 'Hệ thống làm mát bằng chất lỏng (Buồng hơi siêu lớn + Tấm graphit nhiều lớp + màng Boron Nitride), Đa cửa sổ (Chia đôi màn hình), Tối ưu game (Game Turbo), Theo dõi nhịp tim bằng cảm biến vân tay, Âm thanh bởi Harman Kardon ,Màn hình luôn hiển thị AOD, Cả'),
(20, 'Mediatek Dimensity 8100-Ultra', 'Octa-core (4x2.85 GHz Cortex-A78 & 4x2.0 GHz Cortex-A55)', '163.1 x 75.9 x 8.6 mm', '202g', '1 tỉ màu, 120Hz, Dolby Vision, HDR10+', '1220 x 2712 pixels', '6.67 inches', 'AMOLED', 'Android 12, MIUI 13', '4K@30fps, 1080p@30/60/120/240fps, HDR', '20 MP, f/2.2, (wide), 1/3.47\", 0.8µm', '108 MP, f/1.7, 24mm (wide), 1/1.67\", 0.64µm, PDAF, OIS, 8 MP, f/2.2, 120˚ (ultrawide), 1/4\", 1.12µm, 2 MP, f/2.4, (macro)', 'Trôi nhanh thời gian (Time Lapse) Quay chậm (Slow Motion) Ảnh Raw Chống rung quang học (OIS) Siêu độ phân giải Toàn cảnh (Panorama) Làm đẹp, Nhận diện khuôn mặt, Google Lens, Xóa phông, Ban đêm (Night Mode), Chạm lấy nét, Chuyên nghiệp (Pro), HDR', '5000 mAh', '2 SIM (Nano-SIM)', '5G', 'Wi-Fi 802.11 a/b/g/n/ac/6e, dual-band, Wi-Fi Direct, hotspot', 'Hệ thống làm mát bằng chất lỏng (Buồng hơi siêu lớn + Tấm graphit nhiều lớp + màng Boron Nitride), Đa cửa sổ (chia đôi màn hình), Tối ưu game (Game Turbo), Theo dõi nhịp tim bằng cảm biến vân tay, Dolby Atmos, Loa kép, Cảm biến vân tay trong màn hình'),
(22, 'Qualcomm SM8475 Snapdragon 8+ Gen 1 (4 nm)', 'Octa-core (1x3.19 GHz Cortex-X2 & 3x2.75 GHz Cortex-A710 & 4x1.80 GHz Cortex-A510)', '173 x 77 x 10.3 mm', '239g', '1 tỷ màu, Tần số quét màn hình 165Hz, HDR10+, Độ sáng màn hình 800 nits (typ) và 1200 nits (peak), Corning Gorilla Glass Victus', '1080 x 2448 pixels (FullHD+)', '6.78 inches', 'AMOLED', 'Android 12, upgradable to Android 13', '8K@24fps, 4K@30/60/120fps, 1080p@30/60/120/240fps, 720p@480fps; gyro-EIS', '12 MP, 28mm (wide)', '50 MP, f/1.9, (wide), 1/1.56\", 1.0µm, PDAF, 13 MP, f/2.2, (ultrawide), 5 MP, (macro)', 'LED flash, HDR, panorama', '6000 mAh', '2 SIM (Nano-SIM)', '5G', 'Wi-Fi 802.11 a/b/g/n/ac/6e, tri-band, Wi-Fi Direct, hotspot', 'Cảm biến vân tay trong màn hình'),
(23, 'Qualcomm SM8350 Snapdragon 888 5G (5 nm)', 'Octa-core (1x2.84 GHz Cortex-X1 & 3x2.42 GHz Cortex-A78 & 4x1.80 GHz Cortex-A55)', '172.8 x 77.3 x 10.3 mm', '238g', 'Tần số quét 144Hz, hỗ trợ hiển thị 1 tỷ màu, HDR10+, độ sáng tối đa 1200 nits', '1080 x 2448 pixels (FullHD+)', '6.78 inches', 'AMOLED', 'Android 11, upgradable to Android 12, ROG UI', '8K@30fps, 4K@30/60/120fps, 1080p@30/60/120/240fps, 720p@480fps; gyro-EIS', '24 MP, f/2.5, 27mm (wide), 0.9µm', '64 MP, f/1.8, 26mm (wide), 1/1.73\", 0.8µm, PDAF, 13 MP, f/2.4, 11mm, 125˚ (ultrawide), 5 MP, f/2.0, (macro)', 'LED flash, HDR, panorama', '6000 mAh', '2 SIM (Nano-SIM)', '5G', 'Wi-Fi 802.11 a/b/g/n/ac/6e, dual-band, Wi-Fi Direct, hotspot', 'Cảm biến vân tay trong màn hình, Hỗ trợ 5G, Bảo mật vân tay'),
(24, 'Qualcomm SM8350 Snapdragon 888+ 5G (5 nm)', 'Octa-core (1x2.99 GHz Cortex-X1 & 3x2.42 GHz Cortex-A78 & 4x1.80 GHz Cortex-A55)', '172.8 x 77.3 x 9.9 mm', '238g', '144 Hz / 1 ms Samsung AMOLED. Corning® Gorilla® Glass Victus. Delta-E < 1', '1080 x 2448 pixels', '6.78 inches', 'AMOLED', 'Android 11, upgradable to Android 12, ROG UI', '8K@30fps, 4K@30/60/120fps, 1080p@30/60/120/240fps, 720p@480fps; gyro-EIS', '24 MP, f/2.5, 27mm (wide), 0.9µm', '64 MP, f/1.8, 26mm (wide), 1/1.73\", 0.8µm, PDAF, 13 MP, f/2.4, 11mm, 125˚ (ultrawide), 5 MP, f/2.0, (macro)', 'LED flash, HDR, panorama', '6000 mAh', '2 SIM (Nano-SIM)', '5G', '802.11a/b/g/n/ac/ax', 'Cảm biến vân tay trong màn hình'),
(25, 'qưeqwe', 'qưeqweq', '123 x 123 x 123 mm', '123123g', 'qưeqwe', '123 x123', '123123 inches', 'qưeqwe', 'qưeqwe', 'qưeqwe', 'qưeqwe', 'qưeqw', 'eqweqwe', '123123 mAh', 'ưeqweqwe', 'qưeq', 'qưeqew', 'qưeqew'),
(26, 'qưeqwe', 'qưeqweq', '123 x 123 x 123', '123123g', 'qưeqwe', '123 x123', '123123 inches', 'qưeqwe', 'qưeqwe', 'qưeqwe', 'qưeqwe', 'qưeqw', 'eqweqwe', '123123 mAh', 'ưeqweqwe', 'qưeq', 'qưeqew', 'qưeqew');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `variant`
--

CREATE TABLE `variant` (
  `id` int(11) NOT NULL,
  `phoneID` int(10) NOT NULL,
  `sizeID` int(10) NOT NULL,
  `size` varchar(50) NOT NULL COMMENT 'ram and memory',
  `colorID` int(10) NOT NULL,
  `price` int(50) NOT NULL,
  `quantity` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `variant`
--

INSERT INTO `variant` (`id`, `phoneID`, `sizeID`, `size`, `colorID`, `price`, `quantity`) VALUES
(1, 3, 1, '8GB 256GB', 1, 20490000, 10),
(2, 3, 1, '8GB 256GB', 2, 20490000, 10),
(3, 3, 1, '8GB 256GB', 3, 20490000, 10),
(4, 3, 1, '8GB 256GB', 4, 20490000, 10),
(5, 4, 1, '8GB 512GB', 1, 24490000, 10),
(6, 4, 1, '8GB 512GB', 2, 24490000, 10),
(7, 4, 1, '8GB 512GB', 3, 24490000, 10),
(9, 4, 2, '8GB 256GB', 1, 21490000, 10),
(10, 4, 2, '8GB 256GB', 2, 21490000, 10),
(11, 4, 2, '8GB 256GB', 3, 21490000, 10),
(13, 5, 1, '8GB 256GB', 1, 26990000, 10),
(14, 5, 1, '8GB 256GB', 2, 26990000, 10),
(15, 5, 1, '8GB 256GB', 3, 26990000, 10),
(16, 5, 1, '8GB 256GB', 4, 26990000, 10),
(17, 5, 2, '12GB 512GB', 1, 31990000, 10),
(18, 5, 2, '12GB 512GB', 2, 31990000, 10),
(19, 5, 2, '12GB 512GB', 3, 31990000, 10),
(20, 5, 2, '12GB 512GB', 4, 31990000, 10),
(21, 5, 3, '12GB 1TB', 1, 39990000, 10),
(22, 5, 3, '12GB 1TB', 2, 39990000, 10),
(23, 5, 3, '12GB 1TB', 3, 39990000, 10),
(24, 5, 3, '12GB 1TB', 4, 39990000, 10),
(25, 7, 1, '8GB 128GB', 1, 17990000, 10),
(26, 7, 1, '8GB 128GB', 2, 17990000, 10),
(27, 7, 1, '8GB 128GB', 3, 17990000, 10),
(28, 7, 1, '8GB 128GB', 4, 17990000, 10),
(29, 7, 2, '8GB 256GB', 1, 19990000, 10),
(30, 7, 2, '8GB 256GB', 2, 19990000, 10),
(31, 7, 2, '8GB 256GB', 3, 19990000, 10),
(32, 7, 2, '8GB 256GB', 4, 19990000, 10),
(33, 6, 1, '12GB 256GB', 1, 36990000, 10),
(34, 6, 1, '12GB 256GB', 2, 36990000, 10),
(35, 6, 1, '12GB 256GB', 3, 36990000, 10),
(36, 6, 2, '12GB 512GB', 1, 40490000, 10),
(37, 6, 2, '12GB 512GB', 2, 40490000, 10),
(38, 6, 2, '12GB 512GB', 3, 40490000, 10),
(39, 8, 1, '6GB 128GB', 1, 27090000, 10),
(40, 8, 1, '6GB 128GB', 2, 27090000, 10),
(41, 8, 1, '6GB 128GB', 3, 27090000, 10),
(42, 8, 1, '6GB 128GB', 4, 27090000, 10),
(43, 8, 2, '6GB 256GB', 1, 29990000, 10),
(44, 8, 2, '6GB 256GB', 2, 29990000, 10),
(45, 8, 2, '6GB 256GB', 3, 29990000, 10),
(46, 8, 2, '6GB 256GB', 4, 29990000, 10),
(47, 8, 3, '6GB 512GB', 1, 35790000, 10),
(48, 8, 3, '6GB 512GB', 2, 35790000, 10),
(49, 8, 3, '6GB 512GB', 3, 35790000, 10),
(50, 8, 3, '6GB 512GB', 4, 35790000, 10),
(51, 8, 4, '6GB 1TB', 1, 40990000, 10),
(52, 8, 4, '6GB 1TB', 2, 40990000, 10),
(53, 8, 4, '6GB 1TB', 3, 40990000, 10),
(54, 8, 4, '6GB 1TB', 4, 40990000, 10),
(55, 9, 1, '6GB 128GB', 1, 25090000, 10),
(56, 9, 1, '6GB 128GB', 2, 25090000, 10),
(57, 9, 1, '6GB 128GB', 3, 25090000, 10),
(58, 9, 1, '6GB 128GB', 4, 25090000, 10),
(59, 9, 2, '6GB 256GB', 1, 27790000, 10),
(60, 9, 2, '6GB 256GB', 2, 27790000, 10),
(61, 9, 2, '6GB 256GB', 3, 27790000, 10),
(62, 9, 2, '6GB 256GB', 4, 27790000, 10),
(63, 9, 3, '6GB 512GB', 1, 32990000, 10),
(64, 9, 3, '6GB 512GB', 2, 32990000, 10),
(65, 9, 3, '6GB 512GB', 3, 32990000, 10),
(66, 9, 3, '6GB 512GB', 4, 32990000, 10),
(67, 9, 4, '6GB 1TB', 1, 34990000, 10),
(68, 9, 4, '6GB 1TB', 2, 34990000, 10),
(69, 9, 4, '6GB 1TB', 3, 34990000, 10),
(70, 9, 4, '6GB 1TB', 4, 34990000, 10),
(71, 10, 1, '6GB 128GB', 1, 19490000, 10),
(72, 10, 1, '6GB 128GB', 2, 19490000, 10),
(73, 10, 1, '6GB 128GB', 3, 19490000, 10),
(74, 10, 1, '6GB 128GB', 4, 19490000, 10),
(75, 10, 2, '6GB 256GB', 1, 22490000, 10),
(76, 10, 2, '6GB 256GB', 2, 22490000, 10),
(77, 10, 2, '6GB 256GB', 3, 22490000, 10),
(78, 10, 2, '6GB 256GB', 4, 22490000, 10),
(79, 10, 3, '6GB 512GB', 1, 24990000, 10),
(80, 10, 3, '6GB 512GB', 2, 24990000, 10),
(81, 10, 3, '6GB 512GB', 3, 24990000, 10),
(82, 10, 3, '6GB 512GB', 4, 24990000, 10),
(83, 11, 1, '6GB 128GB', 1, 21990000, 10),
(84, 11, 1, '6GB 128GB', 2, 21990000, 10),
(85, 11, 1, '6GB 128GB', 3, 21990000, 10),
(86, 11, 1, '6GB 128GB', 4, 21990000, 10),
(87, 11, 2, '6GB 256GB', 1, 24990000, 10),
(88, 11, 2, '6GB 256GB', 2, 24990000, 10),
(89, 11, 2, '6GB 256GB', 3, 24990000, 10),
(90, 11, 2, '6GB 256GB', 4, 26990000, 10),
(91, 11, 3, '6GB 512GB', 1, 26990000, 10),
(92, 11, 3, '6GB 512GB', 2, 26990000, 10),
(93, 11, 3, '6GB 512GB', 3, 26990000, 10),
(94, 11, 3, '6GB 512GB', 4, 26990000, 10),
(95, 16, 1, '8GB 256GB', 1, 22090000, 10),
(96, 16, 1, '8GB 256GB', 2, 22090000, 10),
(97, 16, 1, '8GB 256GB', 3, 22090000, 10),
(98, 17, 1, '12GB 256GB', 1, 28490000, 10),
(99, 17, 1, '12GB 256GB', 2, 28490000, 10),
(100, 18, 1, '8GB 256GB', 1, 11050000, 10),
(101, 18, 1, '8GB 256GB', 2, 11050000, 10),
(102, 18, 1, '8GB 256GB', 3, 11050000, 10),
(103, 19, 1, '12GB 256GB', 1, 15490000, 10),
(104, 19, 1, '12GB 256GB', 2, 15490000, 10),
(105, 19, 1, '12GB 256GB', 3, 15490000, 10),
(106, 20, 1, '8GB 128GB', 1, 10890000, 10),
(107, 20, 1, '8GB 128GB', 2, 10890000, 10),
(108, 20, 1, '8GB 128GB', 3, 10890000, 10),
(109, 22, 1, '16GB 512GB', 1, 19490000, 10),
(110, 22, 1, '16GB 512GB', 2, 19490000, 10),
(111, 22, 2, '12GB 256GB', 1, 17690000, 10),
(112, 22, 2, '12GB 256GB', 2, 17690000, 10),
(113, 23, 1, '16GB 256GB', 1, 18990000, 10),
(114, 23, 1, '16GB 256GB', 2, 18990000, 10),
(115, 24, 1, '16GB 256GB', 1, 17690000, 10),
(116, 24, 1, '16GB 256GB', 2, 17690000, 10),
(151, 25, 1, '1GB 3GB', 2, 123123, NULL),
(152, 26, 1, '1GB 3GB', 1, 123123, NULL),
(154, 25, 11, '10GB 10GB ', 2, 1231233, NULL),
(155, 25, 11, '10GB 10GB ', 2, 1231233, NULL),
(156, 25, 111, '2GB 2GB', 1, 133333, NULL),
(157, 25, 111, '2GB 2GB', 2, 133333, NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `phoneID` (`phoneID`,`customerID`),
  ADD KEY `customerID` (`customerID`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`id`),
  ADD KEY `phoneID` (`phoneID`,`colorID`);

--
-- Chỉ mục cho bảng `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`phoneID`,`colorID`),
  ADD KEY `phoneID` (`phoneID`),
  ADD KEY `colorID` (`colorID`);

--
-- Chỉ mục cho bảng `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customerID` (`customerID`);

--
-- Chỉ mục cho bảng `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD KEY `orderID` (`orderID`),
  ADD KEY `variantID` (`variantID`);

--
-- Chỉ mục cho bảng `phone`
--
ALTER TABLE `phone`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`category`);

--
-- Chỉ mục cho bảng `spec`
--
ALTER TABLE `spec`
  ADD PRIMARY KEY (`phoneID`);

--
-- Chỉ mục cho bảng `variant`
--
ALTER TABLE `variant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`phoneID`),
  ADD KEY `idColor` (`colorID`),
  ADD KEY `phoneID` (`phoneID`),
  ADD KEY `colorID` (`colorID`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `color`
--
ALTER TABLE `color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT cho bảng `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;

--
-- AUTO_INCREMENT cho bảng `order`
--
ALTER TABLE `order`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `phone`
--
ALTER TABLE `phone`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT cho bảng `variant`
--
ALTER TABLE `variant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`phoneID`) REFERENCES `phone` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`customerID`) REFERENCES `customer` (`id`);

--
-- Các ràng buộc cho bảng `color`
--
ALTER TABLE `color`
  ADD CONSTRAINT `color_ibfk_1` FOREIGN KEY (`phoneID`) REFERENCES `phone` (`id`);

--
-- Các ràng buộc cho bảng `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`phoneID`) REFERENCES `phone` (`id`),
  ADD CONSTRAINT `image_ibfk_2` FOREIGN KEY (`colorID`) REFERENCES `color` (`id`);

--
-- Các ràng buộc cho bảng `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customer` (`id`);

--
-- Các ràng buộc cho bảng `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD CONSTRAINT `orderdetail_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `order` (`id`),
  ADD CONSTRAINT `orderdetail_ibfk_2` FOREIGN KEY (`variantID`) REFERENCES `variant` (`id`);

--
-- Các ràng buộc cho bảng `phone`
--
ALTER TABLE `phone`
  ADD CONSTRAINT `phone_ibfk_1` FOREIGN KEY (`category`) REFERENCES `category` (`id`);

--
-- Các ràng buộc cho bảng `spec`
--
ALTER TABLE `spec`
  ADD CONSTRAINT `spec_ibfk_1` FOREIGN KEY (`phoneID`) REFERENCES `phone` (`id`);

--
-- Các ràng buộc cho bảng `variant`
--
ALTER TABLE `variant`
  ADD CONSTRAINT `variant_ibfk_1` FOREIGN KEY (`phoneID`) REFERENCES `phone` (`id`),
  ADD CONSTRAINT `variant_ibfk_2` FOREIGN KEY (`colorID`) REFERENCES `color` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
