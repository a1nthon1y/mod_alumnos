-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2017 at 02:47 PM
-- Server version: 5.5.46-0ubuntu0.14.04.2
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `Tesis_BDD`
--
CREATE DATABASE IF NOT EXISTS `Tesis_BDD` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `Tesis_BDD`;

-- --------------------------------------------------------

--
-- Table structure for table `Alumno_Representante`
--

CREATE TABLE IF NOT EXISTS `Alumno_Representante` (
  `cedulaEstudiante` varchar(15) NOT NULL,
  `cedulaRepresentante` varchar(15) NOT NULL,
  PRIMARY KEY (`cedulaEstudiante`,`cedulaRepresentante`),
  KEY `fk_Alumno_Representante_Personas1_idx` (`cedulaEstudiante`),
  KEY `fk_Alumno_Representante_Personas2_idx` (`cedulaRepresentante`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Alumno_Representante`
--

INSERT INTO `Alumno_Representante` (`cedulaEstudiante`, `cedulaRepresentante`) VALUES
('V18318614', '18624621');

-- --------------------------------------------------------

--
-- Table structure for table `Asistencia_Curso`
--

CREATE TABLE IF NOT EXISTS `Asistencia_Curso` (
  `idAsistenciaEst` int(11) NOT NULL AUTO_INCREMENT,
  `Curso_has_Personas_Personas_cedula` varchar(15) NOT NULL DEFAULT '',
  `Relacion_Personas_cedula` varchar(15) NOT NULL DEFAULT '',
  `Relacion_Curso_idCurso` int(11) NOT NULL DEFAULT '0',
  `Relacion_Materia_idMateria` int(11) NOT NULL DEFAULT '0',
  `fecha_hora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `justificado` tinyint(1) NOT NULL,
  `retraso` tinyint(1) NOT NULL,
  PRIMARY KEY (`idAsistenciaEst`,`Curso_has_Personas_Personas_cedula`,`Relacion_Personas_cedula`,`Relacion_Curso_idCurso`,`Relacion_Materia_idMateria`),
  KEY `fk_Asistencia_Estudiante_Curso_has_Personas1_idx` (`Curso_has_Personas_Personas_cedula`),
  KEY `fk_Asistencia_Estudiante_Relacion1_idx` (`Relacion_Personas_cedula`),
  KEY `fk_Asistencia_Estudiante_Relacion2_idx` (`Relacion_Curso_idCurso`),
  KEY `fk_Asistencia_Estudiante_Relacion3_idx` (`Relacion_Materia_idMateria`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `Asistencia_Curso`
--

INSERT INTO `Asistencia_Curso` (`idAsistenciaEst`, `Curso_has_Personas_Personas_cedula`, `Relacion_Personas_cedula`, `Relacion_Curso_idCurso`, `Relacion_Materia_idMateria`, `fecha_hora`, `justificado`, `retraso`) VALUES
(1, 'V18318614', '23748114', 1, 1, '2016-07-16 03:34:18', 0, 0),
(2, 'V18318614', '23748114', 1, 1, '2016-07-16 03:34:18', 0, 1),
(3, 'V18318614', '23748114', 1, 1, '2016-07-16 03:34:56', 1, 1),
(4, 'V18318614', '23748114', 1, 2, '2016-07-16 19:02:23', 0, 0),
(5, 'V18318614', '23748114', 1, 2, '2016-07-16 19:03:15', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Asistencia_Personal`
--

CREATE TABLE IF NOT EXISTS `Asistencia_Personal` (
  `idAsistenciaPer` int(11) NOT NULL AUTO_INCREMENT,
  `Personas_cedula` varchar(15) NOT NULL,
  `fecha_hora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `justificado` tinyint(1) DEFAULT NULL,
  `retraso` tinyint(1) NOT NULL,
  PRIMARY KEY (`idAsistenciaPer`,`Personas_cedula`),
  KEY `fk_Registros_Personas1_idx` (`Personas_cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Cargo`
--

CREATE TABLE IF NOT EXISTS `Cargo` (
  `idCargo` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  PRIMARY KEY (`idCargo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `Cargo`
--

INSERT INTO `Cargo` (`idCargo`, `descripcion`) VALUES
(1, 'Jardinero');

-- --------------------------------------------------------

--
-- Table structure for table `Curso`
--

CREATE TABLE IF NOT EXISTS `Curso` (
  `idCurso` int(11) NOT NULL AUTO_INCREMENT,
  `grado` varchar(45) NOT NULL,
  `seccion` varchar(45) NOT NULL,
  PRIMARY KEY (`idCurso`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `Curso`
--

INSERT INTO `Curso` (`idCurso`, `grado`, `seccion`) VALUES
(1, 'Septimo', 'A'),
(2, 'Septimo', 'B');

-- --------------------------------------------------------

--
-- Table structure for table `Curso_has_Personas`
--

CREATE TABLE IF NOT EXISTS `Curso_has_Personas` (
  `Personas_cedula` varchar(15) NOT NULL,
  `Curso_idCurso` int(11) NOT NULL,
  `Año` varchar(5) NOT NULL,
  PRIMARY KEY (`Personas_cedula`,`Curso_idCurso`),
  KEY `fk_Curso_has_Personas_Curso1_idx` (`Curso_idCurso`),
  KEY `fk_Curso_has_Personas_Personas1_idx` (`Personas_cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Curso_has_Personas`
--

INSERT INTO `Curso_has_Personas` (`Personas_cedula`, `Curso_idCurso`, `Año`) VALUES
('V18318614', 1, '2016');

-- --------------------------------------------------------

--
-- Table structure for table `Hora`
--

CREATE TABLE IF NOT EXISTS `Hora` (
  `idHora` int(11) NOT NULL AUTO_INCREMENT,
  `dia` varchar(45) NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  PRIMARY KEY (`idHora`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `Hora`
--

INSERT INTO `Hora` (`idHora`, `dia`, `hora_inicio`, `hora_fin`) VALUES
(1, 'Martes', '07:00:00', '09:00:00'),
(2, 'Jueves', '09:00:00', '11:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `Horario_Personal`
--

CREATE TABLE IF NOT EXISTS `Horario_Personal` (
  `idHorario_Personal` int(11) NOT NULL AUTO_INCREMENT,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `dia` varchar(45) NOT NULL,
  PRIMARY KEY (`idHorario_Personal`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `Horario_Personal`
--

INSERT INTO `Horario_Personal` (`idHorario_Personal`, `hora_inicio`, `hora_fin`, `dia`) VALUES
(1, '04:27:27', '04:27:27', 'Martes');

-- --------------------------------------------------------

--
-- Table structure for table `Materia`
--

CREATE TABLE IF NOT EXISTS `Materia` (
  `idMateria` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`idMateria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Materia`
--

INSERT INTO `Materia` (`idMateria`, `nombre`) VALUES
(1, 'Matematica'),
(2, 'Castellano');

-- --------------------------------------------------------

--
-- Table structure for table `Personas`
--

CREATE TABLE IF NOT EXISTS `Personas` (
  `cedula` varchar(15) NOT NULL,
  `Horario_Personal_idHorario_Personal` int(11) NOT NULL DEFAULT '0',
  `Cargo_idCargo` int(11) NOT NULL DEFAULT '0',
  `tarjetaID` varchar(15) DEFAULT '0',
  `primerNombre` varchar(45) NOT NULL,
  `segundoNombre` varchar(45) DEFAULT NULL,
  `primerApellido` varchar(45) NOT NULL,
  `segundoApellido` varchar(45) DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `correo` varchar(45) NOT NULL,
  `telefono` varchar(45) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `tipo` int(11) NOT NULL,
  PRIMARY KEY (`cedula`,`Horario_Personal_idHorario_Personal`,`Cargo_idCargo`),
  KEY `fk_Personas_Horario_Personal1_idx` (`Horario_Personal_idHorario_Personal`),
  KEY `fk_Personas_Cargo1_idx` (`Cargo_idCargo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Personas`
--

INSERT INTO `Personas` (`cedula`, `Horario_Personal_idHorario_Personal`, `Cargo_idCargo`, `tarjetaID`, `primerNombre`, `segundoNombre`, `primerApellido`, `segundoApellido`, `direccion`, `correo`, `telefono`, `estado`, `tipo`) VALUES
('123', 1, 1, '00000', 'Admin', 'Admin', 'Admin', 'Admin', 'xxx', 'xxx', 'xxx', 1, 3),
('18624621', 1, 1, '0', 'qwe', 'rte', 'asd', 'zxc', 'asd', 'marco.portillo05@hotmail.com', '12345', 1, 3),
('23748114', 1, 1, '0', 'Marco', 'David', 'Portillo', 'Ochoa', 'as', 'marco.portillo05@gmail.com', '04160261529', 1, 2),
('V18318614', 1, 1, '0', 'as', 'asd', 'asd', 'asd', 'asd', 'marco.portillo05@gmail.com', '1234', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Relacion`
--

CREATE TABLE IF NOT EXISTS `Relacion` (
  `Curso_idCurso` int(11) NOT NULL,
  `Materia_idMateria` int(11) NOT NULL,
  `Hora_idHora` int(11) NOT NULL,
  `Personas_cedula` varchar(15) NOT NULL,
  PRIMARY KEY (`Curso_idCurso`,`Materia_idMateria`,`Hora_idHora`,`Personas_cedula`),
  KEY `fk_Relacion_Curso1_idx` (`Curso_idCurso`),
  KEY `fk_Relacion_Materia1_idx` (`Materia_idMateria`),
  KEY `fk_Relacion_Hora1_idx` (`Hora_idHora`),
  KEY `fk_Relacion_Personas1_idx` (`Personas_cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Relacion`
--

INSERT INTO `Relacion` (`Curso_idCurso`, `Materia_idMateria`, `Hora_idHora`, `Personas_cedula`) VALUES
(1, 1, 1, '23748114'),
(1, 1, 2, '23748114'),
(1, 2, 2, '23748114');

-- --------------------------------------------------------

--
-- Table structure for table `Usuario`
--

CREATE TABLE IF NOT EXISTS `Usuario` (
  `Personas_cedula` varchar(15) NOT NULL,
  `nivel` int(11) NOT NULL,
  `clave` varchar(15) NOT NULL,
  PRIMARY KEY (`Personas_cedula`),
  KEY `fk_Usuario_Personas1_idx` (`Personas_cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Usuario`
--

INSERT INTO `Usuario` (`Personas_cedula`, `nivel`, `clave`) VALUES
('123', 1, '123');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Alumno_Representante`
--
ALTER TABLE `Alumno_Representante`
  ADD CONSTRAINT `fk_Alumno_Representante_Personas1` FOREIGN KEY (`cedulaEstudiante`) REFERENCES `Personas` (`cedula`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Alumno_Representante_Personas2` FOREIGN KEY (`cedulaRepresentante`) REFERENCES `Personas` (`cedula`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Asistencia_Curso`
--
ALTER TABLE `Asistencia_Curso`
  ADD CONSTRAINT `fk_Asistencia_Estudiante_Curso_has_Personas1` FOREIGN KEY (`Curso_has_Personas_Personas_cedula`) REFERENCES `Curso_has_Personas` (`Personas_cedula`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Asistencia_Estudiante_Relacion1` FOREIGN KEY (`Relacion_Personas_cedula`) REFERENCES `Relacion` (`Personas_cedula`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Asistencia_Estudiante_Relacion2` FOREIGN KEY (`Relacion_Curso_idCurso`) REFERENCES `Relacion` (`Curso_idCurso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Asistencia_Estudiante_Relacion3` FOREIGN KEY (`Relacion_Materia_idMateria`) REFERENCES `Relacion` (`Materia_idMateria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Asistencia_Personal`
--
ALTER TABLE `Asistencia_Personal`
  ADD CONSTRAINT `fk_Registros_Personas1` FOREIGN KEY (`Personas_cedula`) REFERENCES `Personas` (`cedula`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Curso_has_Personas`
--
ALTER TABLE `Curso_has_Personas`
  ADD CONSTRAINT `fk_Curso_has_Personas_Curso1` FOREIGN KEY (`Curso_idCurso`) REFERENCES `Curso` (`idCurso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Curso_has_Personas_Personas1` FOREIGN KEY (`Personas_cedula`) REFERENCES `Personas` (`cedula`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Personas`
--
ALTER TABLE `Personas`
  ADD CONSTRAINT `fk_Personas_Cargo1` FOREIGN KEY (`Cargo_idCargo`) REFERENCES `Cargo` (`idCargo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Personas_Horario_Personal1` FOREIGN KEY (`Horario_Personal_idHorario_Personal`) REFERENCES `Horario_Personal` (`idHorario_Personal`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Relacion`
--
ALTER TABLE `Relacion`
  ADD CONSTRAINT `fk_Relacion_Curso1` FOREIGN KEY (`Curso_idCurso`) REFERENCES `Curso` (`idCurso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Relacion_Hora1` FOREIGN KEY (`Hora_idHora`) REFERENCES `Hora` (`idHora`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Relacion_Materia1` FOREIGN KEY (`Materia_idMateria`) REFERENCES `Materia` (`idMateria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Relacion_Personas1` FOREIGN KEY (`Personas_cedula`) REFERENCES `Personas` (`cedula`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Usuario`
--
ALTER TABLE `Usuario`
  ADD CONSTRAINT `fk_Usuario_Personas1` FOREIGN KEY (`Personas_cedula`) REFERENCES `Personas` (`cedula`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
