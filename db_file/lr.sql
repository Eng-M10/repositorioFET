-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2023 at 04:52 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lr`
--

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE `document` (
  `id_doc` int(20) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `resumo` text NOT NULL,
  `autores` varchar(255) NOT NULL,
  `tipo_trabalho` varchar(255) NOT NULL,
  `data_submissao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `data_alteracao` timestamp NULL DEFAULT NULL,
  `id_user` int(15) NOT NULL,
  `estado` varchar(10) NOT NULL,
  `arquivo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `estados`
--

CREATE TABLE `estados` (
  `id_estados` varchar(100) NOT NULL,
  `designacao` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `estados`
--

INSERT INTO `estados` (`id_estados`, `designacao`) VALUES
('EV', 'Em Verificacao'),
('RJ', 'Rejeitado'),
('VD', 'Verificado');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `permissions` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `permissions`) VALUES
(1, 'Standard User', ''),
(2, 'Administrator', '{\"admin\":1}');

-- --------------------------------------------------------

--
-- Table structure for table `tipo_documento`
--

CREATE TABLE `tipo_documento` (
  `id_doc_type` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tipo_documento`
--

INSERT INTO `tipo_documento` (`id_doc_type`, `name`) VALUES
('Dissertacao', 'Dissertação para Doutoramento'),
('Monografia', 'Monografia científica'),
('Tese', 'Tese de Mestrado');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `salt` varchar(64) NOT NULL,
  `name` varchar(50) NOT NULL,
  `departamento` varchar(64) NOT NULL,
  `entidade` varchar(64) NOT NULL,
  `joined` datetime NOT NULL,
  `group` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `salt`, `name`, `departamento`, `entidade`, `joined`, `group`) VALUES
(1, 'Dev', '68c42675ece241f8c7892b4e0492476314fcea449fb07251e659025b1ff33408', 'muviDEv@gmail.com', '95298ef682e6971d70c2dc957a095f12450fcedbf107390dd3bf46e00c89afdd', 'Muvimbene Daniel Maposse', '', '', '2023-11-01 16:06:48', 1),
(9, 'mmb', '^?H??(qQ??o??)\'s`=\rj???*?rB?', 'mmb@gmail.com', '45de7a36e2ccc86faa8f6bb4c4b57e8d4b0bf84d8dc8a8741dbaadd5b1db53d7', 'password', '', '', '2023-10-31 14:40:36', 1),
(11, 'adm', '4d76fe623fd891d67263d9be7dcff18ffe38c4a442a9421d320aa934827efa93', 'admin@admin.admin', '84403c0252785f5160f8224646e575c3c98646f7e7457c908280b0739a1185ec', 'Admin Muvi', '', '', '2023-11-02 21:31:10', 2),
(16, 'Kool', '5d2ec8e5ce69b1b02934190747ab43ad9fb74877f08cd301bd8aa42a9fe516ef', 'KoolKid@gmail.com', '30d265fcdf8abd533baaa8ba41846e6a2300f95994486c0d51fd7ccefb59d519', 'Kool Kids', '', '', '2023-11-03 10:14:37', 1),
(17, 'Muv', '08e7f2437d41fac491c0c1b5466ecf11106f375366cd29055c70c04ce663d167', 'Muvimbene@gmail.com', 'dfbb052581dc2532af3d96cb1a89e02a52a903068a6255d665ee04ad876afb30', 'Muvimbene', '', '', '2023-11-03 10:42:39', 1),
(18, 'Mbn', 'bff4f040832e4c129d6ef31e5ee6cb1c8e6dd329f9d3d68d259702f46346a33e', 'Mbn@gmail.com', 'b03dce182d7bf2c35f90eedaf48de18dbf2e58823d190d5c47a3293bea0b16f7', 'Muvimbene Maposse', '', '', '2023-11-03 10:44:37', 1),
(19, 'Hit', '5007db03d81ef0304a0bc0ef43a088c68fb43678156e7a8aeba6aade26ea83fb', 'assaas@gmail.com', '8eed3269612c38a7a6a0f01fb916bfa0fa03c629c93db84bd5c1b76c83a91de3', 'Hirman', '', '', '2023-11-06 13:51:13', 1),
(20, 'muvi', '4909cde12e3cabc66f2e83935159100df0782021737c9c468ddd7e63c627c985', 'muvi.com@teste.com', '6594f3bb0c19d1d7d29d9b8f1099c9b6c2f7f588db313a00b002fc4251f26d67', 'Muvimbene Maposse', 'Informatica', 'Estudante', '2023-11-11 19:02:11', 1),
(21, 'usrr', '7fd6a45a1d0ac8089d9a30149e6a251ba9db3100cd3ef62f99667951319d8db3', '', '37fef87bb6870bbd2dbf86accac82be9e88e2e1c1f0d8f46800c66938939b239', 'Muvimbene Daniel Maposse', '', '', '2023-11-20 05:52:08', 1),
(22, 'hug', '0a25cb664dc9b4608aa4d516936842b1ebbe781bb41704b5b3be5bd9b10d24d2', 'hugo@huggos.com', 'e29c13360f7a9699dc1452da0dda97b640f9f4d1a0ed94037850f3112389575d', 'Hugo Alisson', 'Eletronica', 'Funcionario', '2023-11-23 03:53:46', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users_session`
--

CREATE TABLE `users_session` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hash` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`id_doc`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `estado` (`estado`),
  ADD KEY `Docntype` (`tipo_trabalho`);

--
-- Indexes for table `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id_estados`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipo_documento`
--
ALTER TABLE `tipo_documento`
  ADD PRIMARY KEY (`id_doc_type`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_session`
--
ALTER TABLE `users_session`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `document`
--
ALTER TABLE `document`
  MODIFY `id_doc` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users_session`
--
ALTER TABLE `users_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
