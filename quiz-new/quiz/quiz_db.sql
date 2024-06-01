-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 07 أبريل 2024 الساعة 02:56
-- إصدار الخادم: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quiz_db`
--

-- --------------------------------------------------------

--
-- بنية الجدول `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `correct` int(11) NOT NULL,
  `wrong` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `history`
--

INSERT INTO `history` (`id`, `user_id`, `quiz_id`, `correct`, `wrong`) VALUES
(10, 17, 1, 2, 1),
(11, 19, 1, 1, 2),
(12, 17, 4, 1, 1),
(13, 19, 4, 1, 1),
(14, 19, 5, 3, 1);

-- --------------------------------------------------------

--
-- بنية الجدول `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question_text` varchar(250) NOT NULL,
  `option_a` varchar(250) NOT NULL,
  `option_b` varchar(250) NOT NULL,
  `option_c` varchar(250) NOT NULL,
  `option_d` varchar(250) NOT NULL,
  `correct_option` varchar(10) NOT NULL,
  `quiz_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `questions`
--

INSERT INTO `questions` (`id`, `question_text`, `option_a`, `option_b`, `option_c`, `option_d`, `correct_option`, `quiz_id`) VALUES
(1, 'klklkj', 'kklk', 'kjkjk', 'jkjkkj', 'jkjkjk', 'a', 1),
(2, 'klklklj', ';;;', 'klklkl', 'kjllkkl', 'jklkl', 'b', 1),
(3, 'klkllk', 'klklkl', 'lklkkl', 'kjlkl', 'klkl', 'c', 1),
(5, 'how to print text in c++', 'cout>>\"text\";', 'cout<<\"text\";', 'println(\"text\");', 'echo \"text\";', 'b', 4),
(6, 'which language allow to use pointers', 'java', 'C#', 'c++', 'python', 'c', 4),
(7, 'vkjngjkngngjk', 'vkjkjfjkfkjf', 'kjgjfkkj', 'fklk', 'klklkl', 'a', 5),
(8, 'rkkjrjk', 'kkjj', 'jkkj', 'kjjk', 'kjjk', 'b', 5),
(9, 'ghhggh', 'ghghgh', 'ghhg', 'kjh', 'hjjh', 'd', 5),
(10, 'klfjrjkfjk', 'jkiujrfkj', 'kjoi', 'll', 'll', 'd', 5);

-- --------------------------------------------------------

--
-- بنية الجدول `quizzes`
--

CREATE TABLE `quizzes` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `questions_count` int(11) NOT NULL,
  `score_per_q` int(11) NOT NULL,
  `time_limit` int(11) NOT NULL,
  `description` varchar(500) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `quizzes`
--

INSERT INTO `quizzes` (`id`, `title`, `questions_count`, `score_per_q`, `time_limit`, `description`, `date`) VALUES
(1, 'Web Programming', 3, 5, 5, 'web pro quiz .................................', '2024-04-05 23:20:02'),
(4, 'Programming 1', 2, 1, 5, 'ghgghhgghgh', '2024-04-06 22:49:33'),
(5, 'Math A', 4, 2, 10, 'rjhgfrhjrbhcbhrbjhjklrjtfijr', '2024-04-06 23:27:33');

-- --------------------------------------------------------

--
-- بنية الجدول `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`) VALUES
(17, 'esha', 'admin@quiz.com', '1234'),
(18, 'eee', 'eshakqasim15@gmail.com ', '123456'),
(19, 'eee', 'eshakqasim1@gmail.com ', '123456');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- قيود الجداول المُلقاة.
--

--
-- قيود الجداول `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `history_ibfk_2` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- قيود الجداول `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
