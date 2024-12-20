-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2024 at 07:15 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `easydrive_school`
--

-- --------------------------------------------------------

--
-- Table structure for table `car`
--

CREATE TABLE `car` (
  `Car_ID` int(11) NOT NULL,
  `Instructor_ID` int(11) NOT NULL,
  `Registration_No` varchar(50) NOT NULL,
  `wFaults` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `car`
--

INSERT INTO `car` (`Car_ID`, `Instructor_ID`, `Registration_No`, `wFaults`) VALUES
(3, 2, 'AB24 CDE', 1),
(4, 1, 'BD51 SMR', 0);

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `Client_ID` int(11) NOT NULL,
  `First_Name` varchar(255) NOT NULL,
  `Last_Name` varchar(255) NOT NULL,
  `Gender` varchar(50) NOT NULL,
  `Age` int(11) NOT NULL,
  `Office_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`Client_ID`, `First_Name`, `Last_Name`, `Gender`, `Age`, `Office_ID`, `User_ID`) VALUES
(1, 'John', 'David', 'Male', 20, 2, 2),
(2, 'Maria', 'Elizabeth', 'Female', 21, 2, 3),
(3, 'Client', 'Example', 'Others', 25, 3, 12),
(4, 'Client', 'Example', 'Others', 25, 2, 15);

-- --------------------------------------------------------

--
-- Table structure for table `drivingtest`
--

CREATE TABLE `drivingtest` (
  `DrivingTest_ID` int(11) NOT NULL,
  `Client_ID` int(11) NOT NULL,
  `Notes` text DEFAULT NULL,
  `is_Passed` tinyint(1) DEFAULT 0,
  `Date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drivingtest`
--

INSERT INTO `drivingtest` (`DrivingTest_ID`, `Client_ID`, `Notes`, `is_Passed`, `Date`) VALUES
(1, 2, NULL, 0, '2024-12-13'),
(2, 2, NULL, 1, '2024-12-13');

-- --------------------------------------------------------

--
-- Table structure for table `interview`
--

CREATE TABLE `interview` (
  `Interview_ID` int(11) NOT NULL,
  `Client_ID` int(11) NOT NULL,
  `Instructor_ID` int(11) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp(),
  `Notes` text DEFAULT NULL,
  `Client_License_Status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `interview`
--

INSERT INTO `interview` (`Interview_ID`, `Client_ID`, `Instructor_ID`, `Date`, `Notes`, `Client_License_Status`) VALUES
(1, 2, 1, '2024-12-13 02:57:52', 'Polite, eager to learn, and well-prepared for the interview.\r\nAppeared slightly nervous but answered questions honestly and thoughtfully.\r\nNo prior driving experience but shows a strong interest in learning.\r\nFamiliar with basic road rules (e.g., stop signs, speed limits).\r\nExpressed confidence in learning both manual and automatic vehicles if needed.', 1),
(2, 1, 2, '2024-12-13 02:59:06', 'Energetic and enthusiastic about learning.\r\nAsked a lot of thoughtful questions about the program.\r\nNo experience; completely new to driving.\r\nKnows basic traffic rules from studying for the written permit test.\r\nHighly motivated and eager to learn. Likely to pick up skills quickly with structured guidance.', 1),
(3, 3, 2, '2024-12-04 16:00:00', 'Notes example', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lesson`
--

CREATE TABLE `lesson` (
  `Lesson_ID` int(11) NOT NULL,
  `Client_ID` int(11) NOT NULL,
  `Instructor_ID` int(11) NOT NULL,
  `Car_ID` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Time_Start` time NOT NULL,
  `Time_End` time NOT NULL,
  `Mileage_Used` varchar(255) DEFAULT NULL,
  `Fee` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lesson`
--

INSERT INTO `lesson` (`Lesson_ID`, `Client_ID`, `Instructor_ID`, `Car_ID`, `Date`, `Time_Start`, `Time_End`, `Mileage_Used`, `Fee`) VALUES
(1, 2, 1, 4, '2024-12-14', '12:00:04', '17:00:04', '12,000', 0.00),
(2, 1, 2, 3, '2024-12-14', '12:00:04', '17:00:04', '13,000', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `Manager_ID` int(11) NOT NULL,
  `First_Name` varchar(255) NOT NULL,
  `Last_Name` varchar(255) NOT NULL,
  `Telephone` varchar(15) NOT NULL,
  `Age` int(11) NOT NULL,
  `Gender` varchar(50) NOT NULL,
  `User_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`Manager_ID`, `First_Name`, `Last_Name`, `Telephone`, `Age`, `Gender`, `User_ID`) VALUES
(1, 'Jenny', 'Mcdonald', '0141 123 456', 32, 'Female', 4),
(2, 'Carl', 'Macraham', '0121 987 6543', 41, 'Male', 5),
(3, 'Gina', 'Ferrer', '020 1555 1212', 39, 'Female', 6),
(4, 'Hans', 'Solo', '020 2403 1829', 52, 'Male', 7),
(5, 'Winnie', 'Cruz', '0161 273 0817', 28, 'Male', 8),
(6, 'Daniella', 'Smith', '0141 837 2384', 43, 'Female', 9),
(7, 'Mikyla', 'Escudero', '09283028271', 25, 'Female', 11),
(8, 'Manager', 'Example', '09876543210', 25, 'Others', 14);

-- --------------------------------------------------------

--
-- Table structure for table `office`
--

CREATE TABLE `office` (
  `Office_ID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `City` varchar(255) NOT NULL,
  `Manager_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `office`
--

INSERT INTO `office` (`Office_ID`, `Name`, `Address`, `City`, `Manager_ID`) VALUES
(1, 'Sauchiehall Branch', 'Sauchiehall', 'Glasgow', 1),
(2, 'Central Office', 'Bearsden', 'Glasgow', 6),
(3, 'Downing Branch', 'Downing', 'London', 2),
(4, 'Deansgate Branch', 'Deansgate', 'Manchester', 4),
(5, 'Caledonia Branch', 'Caledonia', 'Bristol', 5),
(6, 'Colmore Branch', 'Colmore', 'Birmingham', 3);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `Staff_ID` int(11) NOT NULL,
  `First_Name` varchar(255) NOT NULL,
  `Last_Name` varchar(255) NOT NULL,
  `Phone_Num` varchar(15) NOT NULL,
  `Age` int(11) NOT NULL,
  `Gender` varchar(50) NOT NULL,
  `Position` varchar(255) NOT NULL,
  `Office_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`Staff_ID`, `First_Name`, `Last_Name`, `Phone_Num`, `Age`, `Gender`, `Position`, `Office_ID`, `User_ID`) VALUES
(1, 'Mikyla', 'Escudero', '0281938103', 21, 'Female', 'Senior Instructor', 2, 1),
(2, 'Jeremy', 'Hue', '09876543211', 32, 'Male', 'Instructor', 2, 10),
(3, 'Ejay', 'Madiales', '09283948273', 25, 'Male', 'Administrative Staff', 2, 13),
(4, 'Staff', 'Example', '09237849283', 25, 'Male', 'Senior Instructor', 2, 16);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_type`, `username`, `password`) VALUES
(1, 'Staff', 'Example1', '12345'),
(2, 'Client', 'Example2', '12345'),
(3, 'Client', 'Example3', '12345'),
(4, 'Manager', 'Example4', '12345'),
(5, 'Manager', 'Example5', '12345'),
(6, 'Manager', 'Example6', '12345'),
(7, 'Manager', 'Example7', '12345'),
(8, 'Manager', 'Example8', '12345'),
(9, 'Manager', 'Example9', '1234'),
(10, 'Staff', 'Example10', '12345'),
(11, 'manager', 'Manager_M', '$2y$10$Cpbx7eYb26t5Hc1UEScQROIH3Mi7dGh.7owT.BvZ8sIIh5U.8ghQy'),
(12, 'client', 'gmail@gmail.com', '$2y$10$1w.Obh/rWJaUL..hPDga6.kgqtZsxcJ3cHObPpYu0t76nfHpSqLG2'),
(13, 'staff', 'ejay@gmail.com', '$2y$10$oyU2lnRSbij8O7JZQzgbzuUYh9Fx7xT1nnJucVdDBivnd4F.XnBhO'),
(14, 'manager', 'Manager_E', '$2y$10$DGfQOgC6GSJUK44q7zbzWuISnYR2lgkNp2b/I52ulTx3clxIODtle'),
(15, 'client', 'Client_E', '$2y$10$6JE7CS/ZWZSLxq1bdPl/HeJLUPd8k24TC02ZHf2fncpRwzaB4guxW'),
(16, 'staff', 'Staff_E', '$2y$10$ac0ZiMgx8nyXBfNxRWExLeJafUFUrEwF3lRBNmlOEe4CxoUzRc2IG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`Car_ID`),
  ADD UNIQUE KEY `Registration_No` (`Registration_No`),
  ADD UNIQUE KEY `Instructor_ID` (`Instructor_ID`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`Client_ID`),
  ADD KEY `Office_ID` (`Office_ID`),
  ADD KEY `User_ID` (`User_ID`);

--
-- Indexes for table `drivingtest`
--
ALTER TABLE `drivingtest`
  ADD PRIMARY KEY (`DrivingTest_ID`),
  ADD KEY `Client_ID` (`Client_ID`);

--
-- Indexes for table `interview`
--
ALTER TABLE `interview`
  ADD PRIMARY KEY (`Interview_ID`),
  ADD KEY `Client_ID` (`Client_ID`),
  ADD KEY `Instructor_ID` (`Instructor_ID`);

--
-- Indexes for table `lesson`
--
ALTER TABLE `lesson`
  ADD PRIMARY KEY (`Lesson_ID`),
  ADD KEY `Client_ID` (`Client_ID`),
  ADD KEY `Instructor_ID` (`Instructor_ID`),
  ADD KEY `Car_ID` (`Car_ID`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`Manager_ID`),
  ADD KEY `User_ID` (`User_ID`);

--
-- Indexes for table `office`
--
ALTER TABLE `office`
  ADD PRIMARY KEY (`Office_ID`),
  ADD KEY `Manager_ID` (`Manager_ID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`Staff_ID`),
  ADD KEY `Office_ID` (`Office_ID`),
  ADD KEY `User_ID` (`User_ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `car`
--
ALTER TABLE `car`
  MODIFY `Car_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `Client_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `drivingtest`
--
ALTER TABLE `drivingtest`
  MODIFY `DrivingTest_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `interview`
--
ALTER TABLE `interview`
  MODIFY `Interview_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `lesson`
--
ALTER TABLE `lesson`
  MODIFY `Lesson_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `manager`
--
ALTER TABLE `manager`
  MODIFY `Manager_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `office`
--
ALTER TABLE `office`
  MODIFY `Office_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `Staff_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `car`
--
ALTER TABLE `car`
  ADD CONSTRAINT `car_ibfk_1` FOREIGN KEY (`Instructor_ID`) REFERENCES `staff` (`Staff_ID`);

--
-- Constraints for table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `client_ibfk_1` FOREIGN KEY (`Office_ID`) REFERENCES `office` (`Office_ID`),
  ADD CONSTRAINT `client_ibfk_2` FOREIGN KEY (`User_ID`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `drivingtest`
--
ALTER TABLE `drivingtest`
  ADD CONSTRAINT `drivingtest_ibfk_1` FOREIGN KEY (`Client_ID`) REFERENCES `client` (`Client_ID`);

--
-- Constraints for table `interview`
--
ALTER TABLE `interview`
  ADD CONSTRAINT `interview_ibfk_1` FOREIGN KEY (`Client_ID`) REFERENCES `client` (`Client_ID`),
  ADD CONSTRAINT `interview_ibfk_2` FOREIGN KEY (`Instructor_ID`) REFERENCES `staff` (`Staff_ID`);

--
-- Constraints for table `lesson`
--
ALTER TABLE `lesson`
  ADD CONSTRAINT `lesson_ibfk_1` FOREIGN KEY (`Car_ID`) REFERENCES `car` (`Car_ID`),
  ADD CONSTRAINT `lesson_ibfk_2` FOREIGN KEY (`Client_ID`) REFERENCES `client` (`Client_ID`),
  ADD CONSTRAINT `lesson_ibfk_3` FOREIGN KEY (`Instructor_ID`) REFERENCES `staff` (`Staff_ID`);

--
-- Constraints for table `manager`
--
ALTER TABLE `manager`
  ADD CONSTRAINT `manager_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `office`
--
ALTER TABLE `office`
  ADD CONSTRAINT `office_ibfk_1` FOREIGN KEY (`Manager_ID`) REFERENCES `manager` (`Manager_ID`);

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `staff_ibfk_2` FOREIGN KEY (`Office_ID`) REFERENCES `office` (`Office_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
