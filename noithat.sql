-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 28, 2024 at 07:23 PM
-- Server version: 8.0.31
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `noithat`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `Brand_Id` int NOT NULL,
  `Brand_Name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`Brand_Id`, `Brand_Name`) VALUES
(1, 'Lam Sơn'),
(2, 'Beyours'),
(3, 'ChiLai'),
(4, 'Phố xinh'),
(5, 'Nhà xinh');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`) VALUES
(1, 3),
(3, 6);

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int NOT NULL,
  `cart_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`id`, `cart_id`, `product_id`, `quantity`) VALUES
(20, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `Category_Id` int NOT NULL,
  `Category_Name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`Category_Id`, `Category_Name`) VALUES
(1, 'Sofa'),
(2, 'Bàn'),
(3, 'Tủ'),
(4, 'Ghế'),
(5, 'Bộ bàn ăn'),
(6, 'Giường');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `Product_Id` int NOT NULL,
  `Product_Name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Description` text COLLATE utf8mb4_general_ci,
  `Price` decimal(14,2) DEFAULT NULL,
  `Image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Brand_Id` int DEFAULT NULL,
  `Category_Id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`Product_Id`, `Product_Name`, `Description`, `Price`, `Image`, `Brand_Id`, `Category_Id`) VALUES
(1, 'Bàn Lam Sơn', 'Bàn học', 20000000.00, 'lam1.png', 1, 1),
(3, 'bàn phố', 'bàn phố', 30000000.00, 'lam1.png', 4, 4),
(4, 'ghế nhà', 'ghế nhà', 400000.00, 'lam1.png', 5, 5),
(7, 'Ghế Sofa Lucky', 'Được làm bằng chất liệu được làm từ Khung gỗ ASH, thiết kế đơn giản nhưng tôn lên sự hiện đại sang trọng.Mẫu ghế sofa gỗ Ash đơn giản gọn gàng với thiết kế độc đáo, mới mẻ. Tone màu trung tính dễ dàng kết hợp với đa số phong cách nội thất và là một sản phẩm có vai trò quan trọng làm cho không gian trở nên hài hòa.Sản phẩm sử dụng gỗ Ash phủ PU màu nâu walnut hoặc màu gỗ tự nhiên, phần vải màu kem mang đến một không khí tươi mới, sáng sủa cho không gian. Thiết kế phần khung đẹp mắt và phần lưng bằng nệm đẹp mắt và sang trọng. Với sự đơn giản hiện có, Ghế Sofa Lucky sẽ chiếm được lòng tin của những ai yêu thích hiện đại nhưng đơn giản và nhã nhặn. Thiết kế chân cao ráo thuận tiện cho việc vệ sinh.', 10500000.00, 'sofalucky.jpg', 1, 1),
(8, 'Sofa góc Hana', 'Được làm bằng chất liệu được làm từ Gỗ ASH tự nhiên, Nhập khẩu với những đường vân gỗ tự nhiên tôn lên sự sang trọng.Sofa gỗ luôn là dòng sản phẩm giành được nhiều sự ưu ái của khách hàng bởi độ bền, tính thẩm mỹ cao, thiết kế đơn giản, mặc dù ghế mang đậm nét đẹp truyền thống nhưng vẫn đảm bảo tính tiện nghi và hiện đại.Sofa góc Hana hiện đại được thiết kế với phần khung và phần chân ghế được là từ chất liệu gỗ tự nhiên, kết hợp đệm mút để tạo cảm giác êm ái, thoải mái cho người dùng hoặc để trống tùy thuộc vào sở thích của gia chủ. Hiện nay, trên thị trường, kiểu dáng thiết kế của ghế sofa gỗ được biến tấu liên tục, nhưng phần lớn chúng sẽ được thiết kế cho nhiều người ngồi (hoặc ít nhất là 2-3 người ngồi). Bên cạnh đó, một điểm đặc trưng ở bộ bàn ghế sofa gỗ là diện tích của chúng khá lớn, khó di chuyển và thường sẽ phù hợp với không gian có diện tích trung bình và lớn.', 26500000.00, 'sofagochana.jpg', 1, 1),
(9, 'Bàn Học Xếp Gọn', 'Sản phẩm được làm bằng chất liệu Gỗ tự nhiên Ash, veneer ash, (gỗ tần bì) nhập khẩu với những đường vân gỗ tự nhiên tôn lên sự sang trọng, với kiểu dáng đơn giản nhưng vô cùng tiện dụng, những tính năng được lồng ghép khéo léo vào cấu trúc của bàn, phù hợp với hầu hết mọi không gian. Ngoài ra quý khách còn có thể chọn làm bằng gỗ MDF melamine chống ẩm với giá thành tốt.Thiết kế đơn giản hiện đại bàn rộng rãi thoải mái, với thiết kế lòng ghép nhiều tính năng và tiết kiệm được không gian khi xếp gọn lại, sẽ đem đến cho người sử dụng nhiều không gian để các vật dụng cá nhân cần thiết, giúp cho bạn có nhiều không gian chứa đựng đồ dùng để làm việc tiện lợi. Bàn được làm cứng cáp và chắc chắn. Bàn làm việc với thiết kế thanh lịch năng động diện tích sử dụng rộng rãi, giúp không gian học tập, làm việc của bạn gọn gàng, tiện lợi hơn. Nó có thể đáp ứng được trong việc trang trí trong chính gia đình của bạn và cũng giúp cho bạn có thể tập trung hơn trong công việc của mình.', 5600000.00, 'banhocxepgon.jpg', 1, 2),
(10, 'Bàn làm việc Zen', 'Sản phẩm được làm bằng chất liệu Gỗ tự nhiên Ash, veneer ash, (gỗ tần bì) nhập khẩu với những đường vân gỗ tự nhiên tôn lên sự sang trọng, với kiểu dáng đơn giản nhưng vô cùng tiện dụng, những tính năng được lồng ghép khéo léo vào cấu trúc của bàn, phù hợp với hầu hết mọi không gian.Thiết kế đơn giản hiện đại bàn rộng rãi thoải mái sẽ đem đến cho người sử dụng nhiều không gian để các vật dụng cá nhân cần thiết, thiết kế có 1 ngăn kéo và 1 ngăn trống cho bạn không gian chứa đựng đồ dùng để làm việc tiện lợi. Phần chân thiết kế hơi vát xéo thân bo tròn thanh mảnh nhưng cứng cáp và chắc chắn. Bàn làm việc với thiết kế thanh lịch năng động diện tích sử dụng rộng rãi, giúp không gian học tập, làm việc của bạn gọn gàng, tiện lợi hơn. Nó có thể đáp ứng được trong việc trang trí trong chính gia đình của bạn và cũng giúp cho bạn có thể tập trung hơn trong công việc của mình.', 5440000.00, 'banlamvieczen.jpg', 1, 2),
(11, 'Tủ Áo MAY', 'Tủ được làm bằng chất liệu Gỗ tự nhiên ASH, veneer ASH nhập khẩu kết hợp với vẻ đẹp của chất liệu mây đan, chắc chắn sẽ mang đến cho không gian nội thất phòng ngủ của bạn vẻ đẹp độc đáo.Tủ được thiết kế gồm 2 cánh, 2 hộc kéo ,bên trong tủ bố trí kết hợp ngăn đợt và thanh treo giúp bạn có thế lưu trữ một cách linh hoạt, gọn gàng cho quần áo dài, quần áo xếp gọn.', 9600000.00, 'tuaomay.jpg', 1, 3),
(12, 'Tủ Áo Tích Hợp', 'Tủ Áo Tích Hợp là mẫu tủ được thiết kế 4 cánh mở kết hợp cùng bệ ngồi bên hông tủ áo (làm hoặc không làm đều được) cùng phần tủ đụng trần có thêm không gian lưu trữ đồ, với kiểu dáng tối giản, hiện đại với màu sắc và lối thiết kế đơn giản dễ kết hợp các mẫu nội thất khác nhưng lại mang đến không gian hiện đại và sang trọng. Thiết kế tối ưu hóa không gian lưu trữ là chiếc tủ kết hợp gữa 1 khoang lớn treo đồ và 1 khoang nhỏ để ngăn kệ đồ xếp, thanh treo giúp lưu trữ một cách linh hoạt, gọn gàng và có thể để được một lượng đồ lớn tiên lợi cho gia chủ sử dụng.', 17100000.00, 'tuaotichhop.jpg', 1, 3),
(13, 'Ghế Neva', 'Ghế ăn được thiết kế lưng tựa cao, với đường nét mềm mại uốn lượn phía trên cùng chân ghế được uốn nhẹ mang lại sự thoải mái cho cả gia đình bạn mỗi khi dùng bữa hay ăn tiệc tại gia.', 1650000.00, 'gheneva.jpg', 1, 4),
(14, 'Ghế Classic', 'Ghế Classic được sản xuất hoàn toàn bởi Nội thất Lam Sơn, được làm từ chất liệu Gỗ Xoan Tự Nhiên, đặc tính của gỗ là mềm dẻo, chịu lực tốt, mê tựa cao thoải mái ngồi lâu mà vẫn dễ chịu.', 2000000.00, 'gheclassic.jpg', 1, 4),
(15, 'Bộ bàn ăn gỗ me tây 8 ghế Santiano', 'Một bộ bàn ghế ăn hiện đại, sang trọng vừa khẳng định được vị thế của chủ nhà, vừa tạo nên nét đẹp cho không gian ngôi nhà. Các vật dụng nội thất khi đến tay từng khách hàng đều được trau chuốt tỉ mỉ. Từ khâu thiết kế, chọn kích thước giữa bàn và ghế, chất liệu mặt bàn gỗ me tây tự nhiên nguyên khối… đều được chọn lựa kỹ càng để tạo nên một sản phẩm đẹp, bắt mắt.', 16100000.00, 'bobanansantiano.jpg', 1, 5),
(16, 'Bộ bàn ăn 4 ghế mặt đá Mango', 'Một bộ bàn ghế ăn hiện đại, sang trọng vừa khẳng định được vị thế của chủ nhà, vừa tạo nên nét đẹp cho không gian ngôi nhà. Các vật dụng nội thất khi đến tay từng khách hàng đều được trau chuốt tỉ mỉ. Từ khâu thiết kế, chọn kích thước giữa bàn và ghế, chất liệu mặt đá… đều được chọn lựa kỹ càng để tạo nên một sản phẩm đẹp, bắt mắt.', 7380000.00, 'bobananmango.jpg', 1, 5),
(17, 'Giường ngủ Viva', 'Giường được thiết kế với kết cấu vô cùng chắc chắn, sử dụng gỗ dầy, được xử lý tỉ mỉ từng đường nét đã tạo nên giường Viva vô cùng đẹp. được thiết kế theo phong cách tối giản và cổ điển, phù hợp với mọi không gian phòng ngủ. Thiết kế phần đầu giường được nhấn nhá bo cong nhẹ sang tạo sự mềm mại và đẹp mắt, giường sử dụng gỗ chắc chắn, đường nét được làm tỉ mỉ. Đặc biệt, giường làm dạng chân cao thuận tiện cho việc vệ sinh dưới gầm giường.', 12500000.00, 'giuongviva.jpg', 1, 6),
(18, 'Giường New City', 'Với tiêu chí tạo ra những sản phẩm chất lượng, độc đáo và đẹp mắt cho khách hàng. Đa dạng về chất liệu gồm có giường gỗ sồi (gỗ Oak), giường gỗ Tần bì (gỗ Ash), giường gỗ thông, giường gỗ MDF, giường sắt, giường gỗ xoan đào, với thiết kế vai giường và vạt tấm chắc chắn. Được thiết kế với kết cấu vô cùng chắc chắn, sử dụng gỗ dầy, được xử lý tỉ mỉ từng đường nét đã tạo nên giường New City vô cùng đẹp mắt. Thiết kế đơn giản nhưng không kém phần sang trọng, phù hợp với mọi không gian.', 9500000.00, 'giuongnewcity.jpg', 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `reset_pass`
--

CREATE TABLE `reset_pass` (
  `Email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Token` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `total_money`
--

CREATE TABLE `total_money` (
  `total` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `total_money`
--

INSERT INTO `total_money` (`total`) VALUES
(53000000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `User_Id` int NOT NULL,
  `Username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Phone` varchar(11) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Role` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`User_Id`, `Username`, `Phone`, `Password`, `Email`, `Role`) VALUES
(3, 'admin', '0703560881', '$2y$10$W4ySBG3kh91v3VJMD1kYru7nFYsa5IMmOVR/zKYvbP3V.X.tX5juK', 'admin@gmail.com', 'admin'),
(6, 'Duy', '0703560881', '$2y$10$Lu/BiuWLU8/PizDEe3MNmObHZuttbq3Czp/P5VkTU0HcpWyaG1bTm', 'ngohoangduy0103@gmail.com', 'customer'),
(7, 'root', '0000000000', '$2y$10$A46VkJVKZZ28gq0CDc.BQexUirDSWub5H4KLVfdt48r.X2d5m1hmW', 'hoangduytedofu0103@gmail.com', 'customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`Brand_Id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_id` (`cart_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`Category_Id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`Product_Id`),
  ADD KEY `Brand_Id` (`Brand_Id`),
  ADD KEY `Category_Id` (`Category_Id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`User_Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `Brand_Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `Category_Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `Product_Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `User_Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`User_Id`);

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`),
  ADD CONSTRAINT `cart_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`Product_Id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`Brand_Id`) REFERENCES `brand` (`Brand_Id`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`Category_Id`) REFERENCES `category` (`Category_Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
