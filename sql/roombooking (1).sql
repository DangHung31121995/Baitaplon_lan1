-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 01, 2018 lúc 08:19 AM
-- Phiên bản máy phục vụ: 10.1.26-MariaDB
-- Phiên bản PHP: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `roombooking`
--

DELIMITER $$
--
-- Thủ tục
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `getCountTypeWithDate` (IN `idHotel` INT, IN `startDate` DOUBLE, IN `endDate` DOUBLE)  NO SQL
SELECT COUNT(r.id) as num, r.roomType FROM  room as r 
where r.idHotel = idHotel AND (r.id  NOT IN (SELECT DISTINCT r2.id FROM room as r2 JOIN bookdetail as bd on bd.idRoom = r2.id 
WHERE ((startDate <= bd.inDate AND endDate >=bd.inDate) OR startDate<=bd.outDate AND startDate >= bd.inDate ) )) AND r.idHotel=idHotel
group BY r.roomType$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getHistory` (IN `idUser` INT)  NO SQL
SELECT hb.id,u.id,u.username,h.name,h.address,r.roomName,bd.inDate,bd.outDate,bd.price from room as r join roomtype as rt on r.roomType = rt.id 
						join hotel as h on r.idHotel = h.id 
                        join bookdetail as bd on bd.idRoom=r.id 
                        JOIN historybooking as hb on hb.idBookingDetail= bd.id
                        JOIN user as u on u.id	=hb.idCustomer
where u.id = idUser$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getIdRoomIdTypeWithDate` (IN `idHotel` INT, IN `startDate` DOUBLE, IN `endDate` DOUBLE)  NO SQL
SELECT  DISTINCT r.id, r.roomType from  room as r WHERE r.id NOT IN (SELECT r2.id FROM room as r2 JOIN bookdetail as bd on bd.idRoom = r2.id WHERE ((startDate <=bd.inDate AND endDate >=bd.inDate) OR (startDate>=bd.inDate AND startDate<=bd.outDate ) )) AND r.idHotel=idHotel$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getroomWithMoreIdType` (IN `doLonIdType` INT)  BEGIN
	select * from room where room.roomType in (SELECT id from roomtype WHERE roomtype.id>doLonIdType);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getTypeWithIdHotel` (IN `idHotel` INT)  BEGIN
  select DISTINCT rt.id,rt.typeName,rt.pricePerDay from hotel as h, room as r JOIN roomtype as rt ON r.roomType=rt.id WHERE r.idHotel= idHotel;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bookdetail`
--

CREATE TABLE `bookdetail` (
  `id` int(11) NOT NULL,
  `idRoom` int(11) NOT NULL,
  `inDate` double NOT NULL,
  `outDate` double NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `bookdetail`
--

INSERT INTO `bookdetail` (`id`, `idRoom`, `inDate`, `outDate`, `price`) VALUES
(3, 14, 123, 123, 1),
(4, 14, 10, 12, 1),
(5, 14, 14, 16, 1),
(6, 14, 17, 19, 1),
(8, 13, 7, 8, 1),
(9, 12, 1519686000, 1519858800, 24),
(10, 11, 1519686000, 1519858800, 24),
(11, 12, 1519686000, 1519858800, 24),
(12, 11, 1519686000, 1519858800, 24),
(13, 12, 1519686000, 1519858800, 24),
(14, 11, 1519686000, 1519858800, 24),
(15, 11, 1519686000, 1519858800, 24),
(17, 12, 1519686000, 1519858800, 24),
(18, 11, 1519686000, 1519858800, 24),
(19, 12, 1519686000, 1519858800, 24),
(20, 11, 1519686000, 1519858800, 24),
(21, 12, 1519686000, 1519858800, 24),
(22, 11, 1519686000, 1519858800, 24),
(23, 12, 1519686000, 1519858800, 24),
(24, 11, 1519686000, 1519858800, 24),
(25, 12, 1519686000, 1519858800, 24),
(26, 11, 1519686000, 1519858800, 24),
(27, 12, 1519686000, 1519858800, 24),
(28, 11, 1519686000, 1519858800, 24),
(29, 12, 1519686000, 1519858800, 24),
(30, 9, 1519772400, 1519945200, 200000),
(31, 10, 1519772400, 1519945200, 200000),
(32, 14, 1519772400, 1519945200, 200000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `city`
--

CREATE TABLE `city` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `city`
--

INSERT INTO `city` (`id`, `name`) VALUES
(1, 'Hà Nội'),
(2, 'Hồ Chí Minh'),
(3, 'Đà Nẵng'),
(4, 'Hải Phòng');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `historybooking`
--

CREATE TABLE `historybooking` (
  `id` int(11) NOT NULL,
  `idCustomer` int(11) NOT NULL,
  `idBookingDetail` int(11) NOT NULL,
  `dateOfBooking` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `historybooking`
--

INSERT INTO `historybooking` (`id`, `idCustomer`, `idBookingDetail`, `dateOfBooking`) VALUES
(2, 12, 17, 1519749122),
(3, 12, 18, 1519749285),
(4, 12, 19, 1519749285),
(5, 12, 20, 1519749426),
(6, 12, 21, 1519749426),
(7, 12, 22, 1519749441),
(8, 12, 23, 1519749441),
(9, 12, 24, 1519749476),
(10, 12, 25, 1519749476),
(11, 12, 26, 1519749580),
(12, 12, 27, 1519749580),
(13, 12, 28, 1519749603),
(14, 12, 29, 1519749603),
(15, 12, 30, 1519801500),
(16, 12, 31, 1519801500),
(17, 12, 32, 1519801500);

--
-- Bẫy `historybooking`
--
DELIMITER $$
CREATE TRIGGER `delBookingDetail` AFTER DELETE ON `historybooking` FOR EACH ROW DELETE FROM bookdetail
    WHERE bookdetail.id = OLD.idBookingDetail
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hotel`
--

CREATE TABLE `hotel` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `idCity` int(11) NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hotel`
--

INSERT INTO `hotel` (`id`, `name`, `idCity`, `address`) VALUES
(1, 'Crutiss Luxury', 1, 'Phường Kim, Hoàng Mai, Hà Nội'),
(2, 'Crutiss Grad', 1, 'Nguyễn Trãi, Thanh Xuân, Hà Nội'),
(3, 'Crutiss Holiday', 2, 'số 69, phố nguyễn trãi, quận 7');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `idCity` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `shortContent` text COLLATE utf8_unicode_ci NOT NULL,
  `image` text COLLATE utf8_unicode_ci NOT NULL,
  `date` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `room`
--

CREATE TABLE `room` (
  `id` int(11) NOT NULL,
  `roomName` text COLLATE utf8_unicode_ci NOT NULL,
  `roomType` int(11) NOT NULL,
  `idHotel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `room`
--

INSERT INTO `room` (`id`, `roomName`, `roomType`, `idHotel`) VALUES
(1, 'room1', 1, 1),
(2, 'room2', 1, 1),
(3, 'room3', 1, 1),
(4, 'room4', 1, 1),
(5, 'room5', 1, 1),
(6, 'room6', 1, 1),
(7, 'room7', 1, 1),
(8, 'room8', 1, 1),
(9, 'grad_1', 1, 2),
(10, 'grad_2', 1, 2),
(11, 'grad_3', 2, 2),
(12, 'grad_4', 2, 2),
(13, 'grad_5', 3, 2),
(14, 'grad_6', 1, 2),
(15, 'luxu_1', 3, 1),
(16, 'luxu_1', 3, 1),
(17, 'luxu_2', 2, 1),
(18, 'luxu_3', 2, 1),
(19, 'luxu_4', 2, 1),
(20, 'luxu_5', 3, 1),
(21, 'holiday_1', 4, 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roomtype`
--

CREATE TABLE `roomtype` (
  `id` int(11) NOT NULL,
  `typeName` text COLLATE utf8_unicode_ci NOT NULL,
  `pricePerDay` float NOT NULL,
  `typeDescription` text COLLATE utf8_unicode_ci NOT NULL,
  `totalPeople` int(11) NOT NULL,
  `image` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `roomtype`
--

INSERT INTO `roomtype` (`id`, `typeName`, `pricePerDay`, `typeDescription`, `totalPeople`, `image`) VALUES
(1, '2 nguoi', 100000, 'sang trọng quý tộc', 2, 'View/user/images/type1.jpg'),
(2, '3 nguoi', 12, 'co dien va sang trỏng', 3, 'View/user/images/type3.jpg'),
(3, '4 nguoi', 40, 'co dien va sang trỏng', 40, 'View/user/images/type3.jpg'),
(4, '5 nguoi', 50, 'co dien va sang trỏng', 50, 'View/user/images/type2.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `isAdmin` tinyint(1) DEFAULT NULL,
  `username` text COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `sex` text COLLATE utf8_unicode_ci NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `cmtnd` int(11) NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `phoneNumber` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `isAdmin`, `username`, `password`, `name`, `sex`, `email`, `cmtnd`, `address`, `phoneNumber`) VALUES
(1, 0, 'a', 'b', 'b', 'Nam', 'df@gmail.com', 0, 'a', 0),
(2, 0, 'ab', 'fghjk', 'adsf', 'Nam', 'a234@gmail.com', 0, 'Äƒefgr', 23546),
(3, 0, '1', '1', '1', 'Nam', '111a@gmail.com', 132, '123', 123),
(4, 0, 'abc', 'agshd', '2345y', 'Nam', 'adf@gmail.com', 21435456, 'sdsfgh', 34567),
(5, 0, 'abc2', '32465', '2345y', 'Nam', 'adf123@gmail.com', 21435456, 'sdsfgh', 2147483647),
(6, 0, '1234', '214354', '13234', 'Nam', 'a12345@gmail.com', 1423, '1234', 565576),
(7, 0, '12344', '4', '13234', 'Nam', 'a123445@gmail.com', 1423, '1234', 5655764),
(8, 0, '1234434', '1234', '13234', 'Nam', 'a1234443245@gmail.com', 1423, '1234', 2147483647),
(9, 0, '123443445', '435435', '13234', 'Nam', 'a1234443345245@gmail.com', 1423, '1234', 2147483647),
(10, 0, '123443445r456', '432543', '13234', 'Nam', 'a1234443342345245@gmail.com', 1423, '1234', 2147483647),
(11, 0, '21', '123', '123', 'Nam', '12312311a@gmail.com', 2312, '123', 12312312),
(12, 0, 'b', '1', 'abc', 'Nam', '12312a@gmail.com', 0, 'ử', 0),
(13, 0, 'adfad', 'fsadfdasf', 'ádfasdf', 'Nữ', 'dfas@gmail.com', 0, 'ádfa', 0),
(14, 0, '2134356', '213243', '324', 'Nữ', 'sfdgfhjhk@gmail.com', 3124565, '324', 124354657),
(15, 0, '213456', '2345465', '235464', 'Nữ', 'jkljf@gmail.com', 213245, '343523678', 23465789),
(16, 0, '2131233123123131', '1231232', '1312', 'Nữ', 'a@gmail.com', 12432435, '3123123', 0),
(17, 1, 'z', '1', '123', 'Nam', 'sdfg@gmail.com', 2435457, '2435465689', 324567);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bookdetail`
--
ALTER TABLE `bookdetail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idRoom` (`idRoom`),
  ADD KEY `idRoom_2` (`idRoom`);

--
-- Chỉ mục cho bảng `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `historybooking`
--
ALTER TABLE `historybooking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idCustomer` (`idCustomer`),
  ADD KEY `idBooking` (`idBookingDetail`);

--
-- Chỉ mục cho bảng `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idLocation` (`idCity`);

--
-- Chỉ mục cho bảng `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `idCity` (`idCity`);

--
-- Chỉ mục cho bảng `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roomType` (`roomType`),
  ADD KEY `idHotel` (`idHotel`);

--
-- Chỉ mục cho bảng `roomtype`
--
ALTER TABLE `roomtype`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `bookdetail`
--
ALTER TABLE `bookdetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT cho bảng `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `historybooking`
--
ALTER TABLE `historybooking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `hotel`
--
ALTER TABLE `hotel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `room`
--
ALTER TABLE `room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `roomtype`
--
ALTER TABLE `roomtype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `bookdetail`
--
ALTER TABLE `bookdetail`
  ADD CONSTRAINT `bookdetail_ibfk_1` FOREIGN KEY (`idRoom`) REFERENCES `room` (`id`) ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `historybooking`
--
ALTER TABLE `historybooking`
  ADD CONSTRAINT `historybooking_ibfk_1` FOREIGN KEY (`idBookingDetail`) REFERENCES `bookdetail` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `historybooking_ibfk_2` FOREIGN KEY (`idCustomer`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `hotel`
--
ALTER TABLE `hotel`
  ADD CONSTRAINT `hotel_ibfk_1` FOREIGN KEY (`idCity`) REFERENCES `city` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`idCity`) REFERENCES `city` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `room_ibfk_1` FOREIGN KEY (`roomType`) REFERENCES `roomtype` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `room_ibfk_2` FOREIGN KEY (`idHotel`) REFERENCES `hotel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
