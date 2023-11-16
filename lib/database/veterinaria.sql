-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2023 at 12:00 AM
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
-- Database: `veterinaria`
--

-- --------------------------------------------------------

--
-- Table structure for table `categoria`
--

CREATE TABLE `categoria` (
  `idcat` int(11) NOT NULL COMMENT 'Identificador de la categoria',
  `namecat` varchar(255) NOT NULL COMMENT 'Nombre de la categoria',
  `descat` varchar(255) NOT NULL COMMENT 'Descripcion de la categoria'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cita`
--

CREATE TABLE `cita` (
  `idcita` int(11) NOT NULL COMMENT 'Identificador de la cita',
  `dniusercit` int(11) NOT NULL COMMENT 'DNI del usuario ',
  `nameusercit` varchar(255) NOT NULL COMMENT 'Nombre del usuario',
  `addresusercit` varchar(255) NOT NULL COMMENT 'Direccion del usuario',
  `phoneusercit` varchar(255) NOT NULL COMMENT 'Numero de telefono del usuario',
  `emailusercit` varchar(255) NOT NULL COMMENT 'Email del usuario',
  `namemascit` varchar(255) NOT NULL COMMENT 'Nombre de la mascota',
  `espmascit` varchar(255) NOT NULL COMMENT 'Especie de la mascota',
  `genmascit` varchar(255) NOT NULL COMMENT 'Genero de la mascota',
  `motcit` varchar(255) NOT NULL COMMENT 'Motivo de la solicitud del servicio',
  `servicecit` varchar(255) NOT NULL COMMENT 'Servicio que solicita el usuario\r\n',
  `datesolcit` date NOT NULL COMMENT 'Fecha de solicitud de la cita',
  `datecit` date DEFAULT NULL COMMENT 'Fecha de asignacion de la cita',
  `hourcit` time DEFAULT NULL COMMENT 'Hora de asignacion de la cita',
  `idcolcit` int(11) DEFAULT NULL COMMENT 'FK del colaborador que atenderá()',
  `statecit` varchar(255) NOT NULL COMMENT 'Estado de la cita'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mascota`
--

CREATE TABLE `mascota` (
  `idmas` int(11) NOT NULL COMMENT 'Numero identificador de la mascota',
  `nommas` varchar(255) NOT NULL COMMENT 'Nombre de la mascota',
  `edadmas` varchar(255) NOT NULL COMMENT 'Edad de la mascota',
  `genmas` varchar(255) NOT NULL COMMENT 'Genero de la mascota',
  `espmas` varchar(255) NOT NULL COMMENT 'Especie de la mascota',
  `idcli` int(11) NOT NULL COMMENT 'FK de cliente(idcli)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `producto`
--

CREATE TABLE `producto` (
  `idprod` int(11) NOT NULL COMMENT 'Numero identificador del producto',
  `nomprod` varchar(255) NOT NULL COMMENT 'Nombre del prodcuto',
  `desprod` varchar(255) NOT NULL COMMENT 'Descripcion del producto',
  `precprod` int(11) NOT NULL COMMENT 'Costo de adquision del producto',
  `precvenprod` int(11) NOT NULL COMMENT 'Precio de venta al publico',
  `stockprod` int(11) NOT NULL COMMENT 'Numero de productos existentes',
  `catprod` int(11) NOT NULL COMMENT 'Fk de la Categoria del producto',
  `idprov` int(11) NOT NULL COMMENT 'FK de proveedor(idprov)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `proveedor`
--

CREATE TABLE `proveedor` (
  `idprov` int(11) NOT NULL COMMENT 'Numero Identificador del Proveedor',
  `nomprov` varchar(255) NOT NULL,
  `dirprov` varchar(255) NOT NULL COMMENT 'Direccion del Proveedor',
  `emaprov` varchar(255) NOT NULL COMMENT 'Correo electronico del proveedor',
  `telprov` varchar(255) NOT NULL COMMENT 'Numero de telefono del proveedor'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `receta`
--

CREATE TABLE `receta` (
  `idrec` int(11) NOT NULL COMMENT 'Numero identificador de la receta',
  `dnicolrec` int(11) NOT NULL COMMENT 'Numero de documento del colaborador que recetó. ',
  `dniuserrec` int(11) NOT NULL COMMENT 'Numero de documento del cliente al que se le receta. ',
  `idmasrec` int(11) NOT NULL COMMENT 'Id de la mascota a la que se le receta',
  `prodrec` varchar(255) NOT NULL COMMENT 'Productos seleccionados en la receta. ',
  `precrec` int(11) NOT NULL COMMENT 'Cantidades seleccionadas en la receta',
  `fecharec` varchar(255) NOT NULL COMMENT 'Fecha de generación de la receta',
  `indrec` varchar(255) NOT NULL COMMENT 'Procedimiento que se le realiza a la mascota'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `iduser` int(11) NOT NULL,
  `dniuser` int(11) NOT NULL,
  `nameuser` varchar(255) NOT NULL,
  `surnameuser` varchar(255) NOT NULL,
  `nickuser` varchar(255) NOT NULL,
  `passuser` varchar(255) NOT NULL,
  `emailuser` varchar(255) NOT NULL,
  `diruser` varchar(255) NOT NULL,
  `zoneuser` varchar(255) DEFAULT NULL,
  `phoneuser` varchar(255) NOT NULL,
  `phonealtuser` varchar(255) DEFAULT NULL,
  `privileges` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`iduser`, `dniuser`, `nameuser`, `surnameuser`, `nickuser`, `passuser`, `emailuser`, `diruser`, `zoneuser`, `phoneuser`, `phonealtuser`, `privileges`) VALUES
(4, 1029981035, 'Jose Alejandro', 'Cuellar Menza', 'Asalejo1', 'd00cb1987c6c69dc665e046a11dccc6b', 'jcuellarmenza@gmail.com', 'calle 8 # 6-87', 'rural', '3133215141', '3224091130', 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idcat`);

--
-- Indexes for table `cita`
--
ALTER TABLE `cita`
  ADD PRIMARY KEY (`idcita`),
  ADD KEY `idcolcit` (`idcolcit`);

--
-- Indexes for table `mascota`
--
ALTER TABLE `mascota`
  ADD PRIMARY KEY (`idmas`),
  ADD KEY `idcli` (`idcli`);

--
-- Indexes for table `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idprod`),
  ADD KEY `idprov` (`idprov`),
  ADD KEY `catprod` (`catprod`);

--
-- Indexes for table `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`idprov`);

--
-- Indexes for table `receta`
--
ALTER TABLE `receta`
  ADD PRIMARY KEY (`idrec`),
  ADD KEY `idmasrec` (`idmasrec`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idcat` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de la categoria', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cita`
--
ALTER TABLE `cita`
  MODIFY `idcita` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de la cita', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mascota`
--
ALTER TABLE `mascota`
  MODIFY `idmas` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Numero identificador de la mascota', AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `producto`
--
ALTER TABLE `producto`
  MODIFY `idprod` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Numero identificador del producto', AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `idprov` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Numero Identificador del Proveedor', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `receta`
--
ALTER TABLE `receta`
  MODIFY `idrec` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Numero identificador de la receta';

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cita`
--
ALTER TABLE `cita`
  ADD CONSTRAINT `cita_ibfk_1` FOREIGN KEY (`idcolcit`) REFERENCES `usuario` (`iduser`);

--
-- Constraints for table `mascota`
--
ALTER TABLE `mascota`
  ADD CONSTRAINT `mascota_ibfk_1` FOREIGN KEY (`idcli`) REFERENCES `usuario` (`iduser`);

--
-- Constraints for table `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`idprov`) REFERENCES `proveedor` (`idprov`),
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`catprod`) REFERENCES `categoria` (`idcat`);

--
-- Constraints for table `receta`
--
ALTER TABLE `receta`
  ADD CONSTRAINT `receta_ibfk_1` FOREIGN KEY (`idmasrec`) REFERENCES `mascota` (`idmas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
