-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2025 at 09:43 PM
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
-- Database: `library_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `isbn` varchar(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) DEFAULT NULL,
  `genre` varchar(100) DEFAULT NULL,
  `shelf` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `isbn`, `title`, `author`, `genre`, `shelf`) VALUES
(1, '9780140449136', 'The Odyssey', 'Homer', 'Epic Poetry', 'Shelf A1'),
(2, '9780439023481', 'The Hunger Games', 'Suzanne Collins', 'Science Fiction', 'Shelf B2'),
(3, '9780061120084', 'To Kill a Mockingbird', 'Harper Lee', 'Classic', 'Shelf A2'),
(4, '9781982137274', 'The Silent Patient', 'Alex Michaelides', 'Thriller', 'Shelf C1'),
(5, '9780590353427', 'Harry Potter and the Sorcerer\'s Stone', 'J.K. Rowling', 'Fantasy', 'Shelf B1'),
(6, '9780307277671', 'The Road', 'Cormac McCarthy', 'Post-apocalyptic', 'Shelf C3'),
(7, '9780345803481', 'Fifty Shades of Grey', 'E. L. James', 'Romance', 'Shelf D2'),
(8, '9780141439600', 'Pride and Prejudice', 'Jane Austen', 'Romance', 'Shelf D1'),
(9, '9780374533557', 'Thinking, Fast and Slow', 'Daniel Kahneman', 'Psychology', 'Shelf E2'),
(10, '9781593279509', 'Eloquent JavaScript', 'Marijn Haverbeke', 'Programming', 'Shelf F1');

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `book_id` int(11) DEFAULT NULL,
  `book_title` varchar(255) DEFAULT NULL,
  `borrow_date` date DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `actual_return` date DEFAULT NULL,
  `status` enum('On Loan','Returned') DEFAULT 'On Loan',
  `renew_count` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`id`, `user_id`, `book_id`, `book_title`, `borrow_date`, `return_date`, `actual_return`, `status`, `renew_count`) VALUES
(19, 18, NULL, 'The Odyssey', '2025-05-20', '2025-06-06', '2025-05-20', 'Returned', 2),
(20, 18, NULL, 'The Hunger Games', '2025-05-27', '2025-05-28', '2025-05-22', 'Returned', 0),
(21, 18, NULL, 'The Odyssey', '2025-04-30', '2025-05-05', '2025-05-28', 'Returned', 0),
(22, 18, NULL, 'The Odyssey', '2025-05-21', '2025-05-30', '2025-05-21', 'Returned', 0),
(23, 18, NULL, 'The Hunger Games', '2025-05-22', '2025-05-23', '2025-05-23', 'Returned', 0),
(24, 18, NULL, 'The Odyssey', '2025-05-22', '2025-06-06', '2025-05-28', 'Returned', 2),
(25, 18, NULL, 'The Odyssey', '2025-04-27', '2025-04-28', NULL, 'On Loan', 0),
(26, 19, NULL, 'The Odyssey', '2025-05-06', '2025-05-09', '2025-05-23', 'Returned', 0),
(27, 20, NULL, 'The Odyssey', '2025-05-22', '2025-05-27', '2025-05-27', 'Returned', 0),
(28, 20, NULL, 'The Odyssey', '2025-05-20', '2025-05-27', '2025-05-30', 'Returned', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `id_proof` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `library_card_number` varchar(20) DEFAULT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `status` enum('pending','approved') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `id_proof`, `password`, `library_card_number`, `role`, `status`) VALUES
(1, 'Shajid SHAJID', 'shajids023@gmail.com', NULL, '123', NULL, 'user', 'pending'),
(2, 'Shahriar Shajid', 'shuvo09sa@gmail.com', NULL, '12345', NULL, 'user', 'pending'),
(3, 'billa', 'Billa09@gmail.com', NULL, '$2y$10$dNI.0s4KJjPNOaiH0fjqieeoy9ESnwrGwasM6Y3RWMYeSojge8K3O', NULL, 'user', 'pending'),
(18, 'Billa', 'billa@gmail.com', '../uploads/id_proofs/1747761838_Letter for DGDP - DGDP Contract number 218.469.23 date 06 June 2024.pdf', '111', 'LIB-682CBAAE3048B', 'user', 'pending'),
(19, 'akid', 'hello12@gmail.com', '../uploads/id_proofs/1747764379_Letter for DGDP - DGDP Contract number 218.469.23 date 06 June 2024.pdf', '222', 'LIB-682CC49BCAAC3', 'user', 'pending'),
(20, 'yoo', 'billa07@gmail.com', '../uploads/id_proofs/1747765284_Screenshot 2025-05-20 114225.png', '123', 'LIB-682CC824B8A97', 'user', 'pending');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `fk_book` (`book_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `loans`
--
ALTER TABLE `loans`
  ADD CONSTRAINT `fk_book` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`),
  ADD CONSTRAINT `loans_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
