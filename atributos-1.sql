-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-03-2019 a las 22:29:59
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `atributos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `id_admin_pk` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `pass` text NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Ap_P` varchar(50) NOT NULL,
  `Ap_M` varchar(50) DEFAULT NULL,
  `id_depto_fk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`id_admin_pk`, `usuario`, `pass`, `Nombre`, `Ap_P`, `Ap_M`, `id_depto_fk`) VALUES
(1, 'canelita', 'canelita', 'asd', 'Sistemas', '1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `Num_Control` varchar(10) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Ap_P` varchar(100) NOT NULL,
  `Ap_M` varchar(100) DEFAULT NULL,
  `id_carrera` int(11) DEFAULT NULL,
  `especialidad_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atributo`
--

CREATE TABLE `atributo` (
  `id_atributo_pk` int(11) NOT NULL,
  `Nombre` text NOT NULL,
  `Descripcion` text NOT NULL,
  `Admin_id` int(11) DEFAULT NULL,
  `id_carrera` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `atributo`
--

INSERT INTO `atributo` (`id_atributo_pk`, `Nombre`, `Descripcion`, `Admin_id`, `id_carrera`) VALUES
(2, 'Atributo a', 'Este es el atributo a', 1, 1);

--
-- Disparadores `atributo`
--
DELIMITER $$
CREATE TRIGGER `atributo_trigger_delete` BEFORE DELETE ON `atributo` FOR EACH ROW begin

	insert into atributo_log values(OLD.Nombre, null, OLD.Descripcion, null,
    OLD.Admin_id, null, OLD.id_carrera, null, old.id_atributo_pk, 
    null, now(), current_user());
    
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `atributo_trigger_insert` BEFORE INSERT ON `atributo` FOR EACH ROW begin

	insert into atributo_log values(null, NEW.Nombre, null, New.Descripcion,
    null, NEW.Admin_id, null, new.id_carrera, null, 
    new.id_atributo_pk, now(), current_user());
    
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `atributo_trigger_update` BEFORE UPDATE ON `atributo` FOR EACH ROW begin

	insert into atributo_log values(OLD.Nombre, NEW.Nombre, OLD.Descripcion, New.Descripcion,
    OLD.Admin_id, NEW.Admin_id, OLD.id_carrera, new.id_carrera, old.id_atributo_pk, 
    new.id_atributo_pk, now(), current_user());
    
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atributo_log`
--

CREATE TABLE `atributo_log` (
  `Nombre_ant` text,
  `Nombre_nvo` text,
  `Descripcion_ant` text,
  `Descripcion_nvo` text,
  `Admin_id_ant` int(11) DEFAULT NULL,
  `Admin_id_nvo` int(11) DEFAULT NULL,
  `id_carrera_ant` int(11) DEFAULT NULL,
  `id_carrera_nvo` int(11) DEFAULT NULL,
  `id_atributo_ant` int(11) DEFAULT NULL,
  `id_atributo_nvo` int(11) DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT NULL,
  `usuario` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `atributo_log`
--

INSERT INTO `atributo_log` (`Nombre_ant`, `Nombre_nvo`, `Descripcion_ant`, `Descripcion_nvo`, `Admin_id_ant`, `Admin_id_nvo`, `id_carrera_ant`, `id_carrera_nvo`, `id_atributo_ant`, `id_atributo_nvo`, `fecha`, `usuario`) VALUES
(NULL, 'Atributo a', NULL, 'Este es el atributo a', NULL, 1, NULL, 1, NULL, 0, '2019-03-04 22:54:02', 'root@localhost'),
('Atributo a', 'Atributo c', 'Este es el atributo a', 'Atributo modificado', 1, 1, 1, 1, 1, 1, '2019-03-04 23:03:51', 'root@localhost'),
('Atributo c', NULL, 'Atributo modificado', NULL, 1, NULL, 1, NULL, 1, NULL, '2019-03-04 23:08:10', 'root@localhost'),
(NULL, 'Atributo a', NULL, 'Este es el atributo a', NULL, 1, NULL, 1, NULL, 0, '2019-03-04 23:17:40', 'root@localhost');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrera`
--

CREATE TABLE `carrera` (
  `id_carrera` int(11) NOT NULL,
  `Nombre` varchar(200) NOT NULL,
  `id_depto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `carrera`
--

INSERT INTO `carrera` (`id_carrera`, `Nombre`, `id_depto`) VALUES
(1, 'Sistemas', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `criterio_ev`
--

CREATE TABLE `criterio_ev` (
  `id_criterio` int(11) NOT NULL,
  `Nombre` text NOT NULL,
  `Descripcion` text NOT NULL,
  `ponderacion` int(11) NOT NULL,
  `id_atributo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `criterio_ev`
--

INSERT INTO `criterio_ev` (`id_criterio`, `Nombre`, `Descripcion`, `ponderacion`, `id_atributo`) VALUES
(2, 'Criterio modificado', 'Este es el criterio a', 70, 2);

--
-- Disparadores `criterio_ev`
--
DELIMITER $$
CREATE TRIGGER `criterio_trigger_delete` BEFORE DELETE ON `criterio_ev` FOR EACH ROW begin

	insert into criterio_ev_log values(old.id_criterio, null, old.Nombre, null,
     old.Descripcion, null, old.ponderacion, null, old.id_atributo, null, now(), 
     current_user());
    
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `criterio_trigger_insert` BEFORE INSERT ON `criterio_ev` FOR EACH ROW begin

	insert into criterio_ev_log values(null, new.id_criterio, null, new.Nombre,
     null, new.Descripcion, null, new.ponderacion, null, new.id_atributo, now(), 
     current_user());
       
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `criterio_trigger_update` BEFORE UPDATE ON `criterio_ev` FOR EACH ROW begin

	insert into criterio_ev_log values(old.id_criterio, new.id_criterio, old.Nombre, new.Nombre,
     old.Descripcion, new.Descripcion, old.ponderacion, new.ponderacion, old.id_atributo, new.id_atributo, now(), 
     current_user());
    
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `criterio_ev_log`
--

CREATE TABLE `criterio_ev_log` (
  `id_criterio_ant` int(11) DEFAULT NULL,
  `id_criterio_nvo` int(11) DEFAULT NULL,
  `Nombre_ant` text,
  `Nombre_nvo` text,
  `Descripcion_ant` text,
  `Descripcion_nvo` text,
  `Ponderacion_ant` int(11) DEFAULT NULL,
  `ponderacion_nvo` int(11) DEFAULT NULL,
  `id_atributo_ant` int(11) DEFAULT NULL,
  `id_atributo_nvo` int(11) DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT NULL,
  `usuario` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `criterio_ev_log`
--

INSERT INTO `criterio_ev_log` (`id_criterio_ant`, `id_criterio_nvo`, `Nombre_ant`, `Nombre_nvo`, `Descripcion_ant`, `Descripcion_nvo`, `Ponderacion_ant`, `ponderacion_nvo`, `id_atributo_ant`, `id_atributo_nvo`, `fecha`, `usuario`) VALUES
(NULL, 0, NULL, 'Criterio a', NULL, 'Este es el criterio a', NULL, 100, NULL, 2, '2019-03-04 23:34:10', 'root@localhost'),
(2, 2, 'Criterio a', 'Criterio modificado', 'Este es el criterio a', 'Este es el criterio a', 100, 70, 2, 2, '2019-03-04 23:40:31', 'root@localhost');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `id_depto` int(11) NOT NULL,
  `Nombre` varchar(200) NOT NULL,
  `Logo` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`id_depto`, `Nombre`, `Logo`) VALUES
(1, 'Sistemas', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidad`
--

CREATE TABLE `especialidad` (
  `id_esp` int(11) NOT NULL,
  `Nombre` text NOT NULL,
  `id_depto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `espelegida`
--

CREATE TABLE `espelegida` (
  `Num_Control` varchar(10) NOT NULL,
  `id_esp` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ind_gpal`
--

CREATE TABLE `ind_gpal` (
  `id_criterio` int(11) DEFAULT NULL,
  `P_Ind` int(11) NOT NULL,
  `P_Gpal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia`
--

CREATE TABLE `materia` (
  `id_materia` int(11) NOT NULL,
  `Nombre` text NOT NULL,
  `Status` enum('Habilitada','Deshabilitada') DEFAULT NULL,
  `Semestre` enum('1','2','3','4','5','6','7','8','9') DEFAULT NULL,
  `id_carrera` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias_cursando`
--

CREATE TABLE `materias_cursando` (
  `id_mat` int(11) NOT NULL,
  `Num_Control` varchar(10) DEFAULT NULL,
  `RFC_prof` varchar(13) DEFAULT NULL,
  `id_materia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Disparadores `materias_cursando`
--
DELIMITER $$
CREATE TRIGGER `materia_cursando_trigger_delete` BEFORE DELETE ON `materias_cursando` FOR EACH ROW begin

	insert into criterio_ev_log values(old.id_mat, null, old.Num_Control, null,
     old.RFC_prof, null, old.id_materia, null, now(), 
     current_user());
    
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `materia_cursando_trigger_insert` BEFORE INSERT ON `materias_cursando` FOR EACH ROW begin

	insert into criterio_ev_log values(null, new.id_mat, null, new.Num_Control,
     null, new.RFC_prof, null, new.id_materia, now(), 
     current_user());
    
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `materia_cursando_trigger_update` BEFORE UPDATE ON `materias_cursando` FOR EACH ROW begin

	insert into criterio_ev_log values(old.id_mat, new.id_mat, old.Num_Control, new.Num_Control,
     old.RFC_prof, new.RFC_prof, old.id_materia, new.id_materia, now(), 
     current_user());
    
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias_cursando_log`
--

CREATE TABLE `materias_cursando_log` (
  `id_mat_ant` int(11) DEFAULT NULL,
  `id_mat_nvo` int(11) DEFAULT NULL,
  `Num_Control_ant` varchar(10) DEFAULT NULL,
  `Num_Control_nvo` varchar(10) DEFAULT NULL,
  `RFC_ant` varchar(13) DEFAULT NULL,
  `RFC_nvo` varchar(13) DEFAULT NULL,
  `id_materia_ant` int(11) DEFAULT NULL,
  `id_materia_nvo` int(11) DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT NULL,
  `usuario` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id_admin_pk`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD KEY `fk_depto` (`id_depto_fk`);

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`Num_Control`),
  ADD KEY `fk_alum_carrera` (`id_carrera`);

--
-- Indices de la tabla `atributo`
--
ALTER TABLE `atributo`
  ADD PRIMARY KEY (`id_atributo_pk`),
  ADD KEY `fk_at_admin` (`Admin_id`),
  ADD KEY `fk_carrera_at` (`id_carrera`);

--
-- Indices de la tabla `carrera`
--
ALTER TABLE `carrera`
  ADD PRIMARY KEY (`id_carrera`),
  ADD KEY `fk_carr_dep` (`id_depto`);

--
-- Indices de la tabla `criterio_ev`
--
ALTER TABLE `criterio_ev`
  ADD PRIMARY KEY (`id_criterio`),
  ADD KEY `fk_at_criterio` (`id_atributo`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`id_depto`);

--
-- Indices de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  ADD PRIMARY KEY (`id_esp`),
  ADD KEY `fk_esp_dep` (`id_depto`);

--
-- Indices de la tabla `espelegida`
--
ALTER TABLE `espelegida`
  ADD KEY `fk_esp_elegida` (`Num_Control`),
  ADD KEY `fk_esp_elegida_esp` (`id_esp`);

--
-- Indices de la tabla `ind_gpal`
--
ALTER TABLE `ind_gpal`
  ADD KEY `fk_ct_eval` (`id_criterio`);

--
-- Indices de la tabla `materia`
--
ALTER TABLE `materia`
  ADD PRIMARY KEY (`id_materia`),
  ADD KEY `fk_mat_carr` (`id_carrera`);

--
-- Indices de la tabla `materias_cursando`
--
ALTER TABLE `materias_cursando`
  ADD PRIMARY KEY (`id_mat`),
  ADD KEY `fk_mat_cur_alum` (`id_materia`),
  ADD KEY `fk_prof_cur_alum` (`RFC_prof`),
  ADD KEY `fk_alum_cur` (`Num_Control`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id_admin_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `atributo`
--
ALTER TABLE `atributo`
  MODIFY `id_atributo_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `carrera`
--
ALTER TABLE `carrera`
  MODIFY `id_carrera` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `criterio_ev`
--
ALTER TABLE `criterio_ev`
  MODIFY `id_criterio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `id_depto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  MODIFY `id_esp` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `materia`
--
ALTER TABLE `materia`
  MODIFY `id_materia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `materias_cursando`
--
ALTER TABLE `materias_cursando`
  MODIFY `id_mat` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD CONSTRAINT `fk_depto` FOREIGN KEY (`id_depto_fk`) REFERENCES `departamento` (`id_depto`);

--
-- Filtros para la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD CONSTRAINT `fk_alum_carrera` FOREIGN KEY (`id_carrera`) REFERENCES `carrera` (`id_carrera`);

--
-- Filtros para la tabla `atributo`
--
ALTER TABLE `atributo`
  ADD CONSTRAINT `fk_at_admin` FOREIGN KEY (`Admin_id`) REFERENCES `administrador` (`id_admin_pk`),
  ADD CONSTRAINT `fk_carrera_at` FOREIGN KEY (`id_carrera`) REFERENCES `carrera` (`id_carrera`);

--
-- Filtros para la tabla `carrera`
--
ALTER TABLE `carrera`
  ADD CONSTRAINT `fk_carr_dep` FOREIGN KEY (`id_depto`) REFERENCES `departamento` (`id_depto`);

--
-- Filtros para la tabla `criterio_ev`
--
ALTER TABLE `criterio_ev`
  ADD CONSTRAINT `fk_at_criterio` FOREIGN KEY (`id_atributo`) REFERENCES `atributo` (`id_atributo_pk`);

--
-- Filtros para la tabla `especialidad`
--
ALTER TABLE `especialidad`
  ADD CONSTRAINT `fk_esp_dep` FOREIGN KEY (`id_depto`) REFERENCES `departamento` (`id_depto`);

--
-- Filtros para la tabla `espelegida`
--
ALTER TABLE `espelegida`
  ADD CONSTRAINT `fk_esp_elegida` FOREIGN KEY (`Num_Control`) REFERENCES `alumno` (`Num_Control`),
  ADD CONSTRAINT `fk_esp_elegida_esp` FOREIGN KEY (`id_esp`) REFERENCES `especialidad` (`id_esp`);

--
-- Filtros para la tabla `ind_gpal`
--
ALTER TABLE `ind_gpal`
  ADD CONSTRAINT `fk_ct_eval` FOREIGN KEY (`id_criterio`) REFERENCES `criterio_ev` (`id_criterio`);

--
-- Filtros para la tabla `materia`
--
ALTER TABLE `materia`
  ADD CONSTRAINT `fk_mat_carr` FOREIGN KEY (`id_carrera`) REFERENCES `carrera` (`id_carrera`);

--
-- Filtros para la tabla `materias_cursando`
--
ALTER TABLE `materias_cursando`
  ADD CONSTRAINT `fk_alum_cur` FOREIGN KEY (`Num_Control`) REFERENCES `alumno` (`Num_Control`),
  ADD CONSTRAINT `fk_mat_cur_alum` FOREIGN KEY (`id_materia`) REFERENCES `materia` (`id_materia`),
  ADD CONSTRAINT `fk_prof_cur_alum` FOREIGN KEY (`RFC_prof`) REFERENCES `profesor` (`rfc`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
