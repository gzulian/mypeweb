-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-11-2017 a las 19:38:40
-- Versión del servidor: 10.1.25-MariaDB
-- Versión de PHP: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mypeweb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mypeweb_admin`
--

CREATE TABLE `mypeweb_admin` (
  `adm_id` int(11) NOT NULL,
  `adm_user` varchar(45) DEFAULT NULL COMMENT 'Credecial de acceso',
  `adm_pass` varchar(45) DEFAULT NULL COMMENT 'Clave de acceso al sistema, debe estar encryptada \nen algoritmo sha1',
  `adm_name` varchar(100) DEFAULT NULL COMMENT 'Nombre completo del administrador\n',
  `adm_photo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mypeweb_category`
--

CREATE TABLE `mypeweb_category` (
  `cat_id` int(11) NOT NULL COMMENT 'Clave primaria de tabla',
  `cat_name` varchar(60) NOT NULL COMMENT '''Nombre asignado a una categoríaa''',
  `cat_parent` int(11) DEFAULT NULL COMMENT 'FK intrínseca y recursiva hace referenci al padre de la categoría',
  `cat_status` tinyint(4) NOT NULL COMMENT '0:  inactiva 1: Activa',
  `cat_position` tinyint(4) NOT NULL COMMENT 'Orden asignado en vista para categoría'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabla que almacena las categorías & subcategorías de producto';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mypeweb_configuration`
--

CREATE TABLE `mypeweb_configuration` (
  `con_id` int(11) NOT NULL COMMENT 'Pk de tabla',
  `con_background` varchar(20) NOT NULL COMMENT '''Color de fondo''',
  `con_footer` varchar(20) NOT NULL,
  `con_navbar` varchar(20) NOT NULL COMMENT '''Colo de fondo navbar''',
  `con_logo` varchar(100) DEFAULT NULL COMMENT '''Path para la marca de empresa''',
  `con_video` varchar(200) DEFAULT NULL COMMENT '''Url o path a video corporativo''',
  `con_fontcolor` varchar(20) DEFAULT NULL COMMENT '''Color de fuente principal''',
  `con_fontstyle` varchar(20) DEFAULT NULL COMMENT 'Estilo de funte principal',
  `con_fontsize` tinyint(4) DEFAULT NULL COMMENT 'Tamaño de fuente principal',
  `con_status` tinyint(4) NOT NULL COMMENT '0:  Inactico 1: Activo',
  `con_banner` varchar(100) NOT NULL,
  `con_products` int(11) NOT NULL DEFAULT '3' COMMENT 'Número de productos en la vista principal'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabla que almacena la configuración base de la página comepleta\n';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mypeweb_customer`
--

CREATE TABLE `mypeweb_customer` (
  `cus_id` int(11) NOT NULL COMMENT 'Pk de tabla',
  `cus_name` varchar(100) NOT NULL COMMENT 'Nombre de cliente suscrito',
  `cus_email` varchar(150) NOT NULL COMMENT 'Email de suscripción',
  `cus_phonenumber` varchar(20) DEFAULT NULL COMMENT 'Número de contacto',
  `cus_datesystem` datetime NOT NULL COMMENT 'Fecha de sistema que registra el día y la hora de subscripción\n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Clientes suscritos\n';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mypeweb_empresa`
--

CREATE TABLE `mypeweb_empresa` (
  `emp_id` int(11) NOT NULL,
  `emp_mision` varchar(300) DEFAULT NULL,
  `emp_vision` varchar(300) DEFAULT NULL,
  `emp_objetivo` varchar(300) DEFAULT NULL,
  `emp_descripcion` varchar(200) DEFAULT NULL,
  `emp_estado` int(11) DEFAULT NULL COMMENT '0: inactivo 1:activo',
  `emp_slogan` varchar(300) DEFAULT NULL,
  `emp_direccion` varchar(200) DEFAULT NULL,
  `emp_telefono` varchar(40) DEFAULT NULL,
  `emp_celular` varchar(40) DEFAULT NULL,
  `emp_nombrefantasia` varchar(100) DEFAULT NULL,
  `emp_email` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mypeweb_multimedia`
--

CREATE TABLE `mypeweb_multimedia` (
  `mul_pro_id` int(11) NOT NULL COMMENT 'Fk de product',
  `mul_id` int(11) NOT NULL,
  `mul_name` varchar(200) NOT NULL COMMENT '''Nombre asignado al elemento''',
  `mul_route` varchar(300) NOT NULL COMMENT '''Path de elemento''',
  `mul_position` tinyint(4) NOT NULL COMMENT 'Posición asignada al elemento',
  `mul_status` tinyint(4) NOT NULL COMMENT '0 :  inactiva 1: activa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mypeweb_newsletter`
--

CREATE TABLE `mypeweb_newsletter` (
  `new_id` int(11) NOT NULL COMMENT 'Pk de tabla',
  `new_subject` varchar(100) NOT NULL COMMENT ' Asunto de mail\n',
  `new_text` text NOT NULL COMMENT 'Texto de correo o mailing'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Mailing o información para clientes\n';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mypeweb_newslog`
--

CREATE TABLE `mypeweb_newslog` (
  `log_id` int(11) NOT NULL,
  `log_datesystem` datetime DEFAULT NULL COMMENT 'Registro de envío de mensaje',
  `log_cus_id` int(11) NOT NULL COMMENT 'Fk de tabla customer',
  `log_new_id` int(11) NOT NULL COMMENT 'Fk de tabla newletter\n',
  `log_type` int(11) NOT NULL,
  `log_state` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Registgro de envío de mensajes';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mypeweb_product`
--

CREATE TABLE `mypeweb_product` (
  `pro_id` int(11) NOT NULL,
  `pro_name` varchar(200) NOT NULL COMMENT 'Nombre de elemento',
  `pro_subtitle` varchar(200) DEFAULT NULL COMMENT 'Información segundaria de elemento',
  `pro_description` text NOT NULL COMMENT 'Descripción de elemento',
  `pro_price` decimal(10,2) NOT NULL COMMENT 'Precio real de producto\n',
  `pro_currency` varchar(4) NOT NULL COMMENT 'Tipo de moneda del producto',
  `pro_position` tinyint(4) DEFAULT NULL COMMENT 'Posición asignada al elemento',
  `pro_status` tinyint(4) NOT NULL COMMENT '0: Inactico 1:Activo',
  `pro_cat_id` int(11) NOT NULL COMMENT 'Fk , Categoría a la que pertence el producto\n',
  `pro_discount` decimal(10,2) DEFAULT NULL COMMENT 'Monto de descuento\n',
  `pro_total` decimal(10,2) DEFAULT NULL COMMENT 'Precio con descuento aplicado\n',
  `pro_stock` int(11) DEFAULT '0',
  `pro_discounttype` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabla que almacena productos o servicios de una empresa\n';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `redes`
--

CREATE TABLE `redes` (
  `red_id` int(11) NOT NULL,
  `red_nom` varchar(80) NOT NULL,
  `red_tip` varchar(30) NOT NULL,
  `red_url` varchar(200) NOT NULL,
  `red_ico` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `team`
--

CREATE TABLE `team` (
  `team_id` int(11) NOT NULL,
  `team_nom` varchar(200) NOT NULL,
  `team_desc` text NOT NULL,
  `team_cargo` varchar(30) NOT NULL,
  `team_foto` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `mypeweb_admin`
--
ALTER TABLE `mypeweb_admin`
  ADD PRIMARY KEY (`adm_id`);

--
-- Indices de la tabla `mypeweb_category`
--
ALTER TABLE `mypeweb_category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indices de la tabla `mypeweb_configuration`
--
ALTER TABLE `mypeweb_configuration`
  ADD PRIMARY KEY (`con_id`);

--
-- Indices de la tabla `mypeweb_customer`
--
ALTER TABLE `mypeweb_customer`
  ADD PRIMARY KEY (`cus_id`);

--
-- Indices de la tabla `mypeweb_empresa`
--
ALTER TABLE `mypeweb_empresa`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indices de la tabla `mypeweb_multimedia`
--
ALTER TABLE `mypeweb_multimedia`
  ADD PRIMARY KEY (`mul_id`);

--
-- Indices de la tabla `mypeweb_newsletter`
--
ALTER TABLE `mypeweb_newsletter`
  ADD PRIMARY KEY (`new_id`);

--
-- Indices de la tabla `mypeweb_newslog`
--
ALTER TABLE `mypeweb_newslog`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `log_cus_id` (`log_cus_id`),
  ADD KEY `log_new_id` (`log_new_id`);

--
-- Indices de la tabla `mypeweb_product`
--
ALTER TABLE `mypeweb_product`
  ADD PRIMARY KEY (`pro_id`);

--
-- Indices de la tabla `redes`
--
ALTER TABLE `redes`
  ADD PRIMARY KEY (`red_id`);

--
-- Indices de la tabla `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`team_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `mypeweb_admin`
--
ALTER TABLE `mypeweb_admin`
  MODIFY `adm_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `mypeweb_category`
--
ALTER TABLE `mypeweb_category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clave primaria de tabla';
--
-- AUTO_INCREMENT de la tabla `mypeweb_configuration`
--
ALTER TABLE `mypeweb_configuration`
  MODIFY `con_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Pk de tabla';
--
-- AUTO_INCREMENT de la tabla `mypeweb_customer`
--
ALTER TABLE `mypeweb_customer`
  MODIFY `cus_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Pk de tabla';
--
-- AUTO_INCREMENT de la tabla `mypeweb_empresa`
--
ALTER TABLE `mypeweb_empresa`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `mypeweb_multimedia`
--
ALTER TABLE `mypeweb_multimedia`
  MODIFY `mul_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `mypeweb_newsletter`
--
ALTER TABLE `mypeweb_newsletter`
  MODIFY `new_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Pk de tabla';
--
-- AUTO_INCREMENT de la tabla `mypeweb_newslog`
--
ALTER TABLE `mypeweb_newslog`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `mypeweb_product`
--
ALTER TABLE `mypeweb_product`
  MODIFY `pro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `redes`
--
ALTER TABLE `redes`
  MODIFY `red_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `team`
--
ALTER TABLE `team`
  MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `mypeweb_newslog`
--
ALTER TABLE `mypeweb_newslog`
  ADD CONSTRAINT `mypeweb_newslog_ibfk_1` FOREIGN KEY (`log_cus_id`) REFERENCES `mypeweb_customer` (`cus_id`),
  ADD CONSTRAINT `mypeweb_newslog_ibfk_2` FOREIGN KEY (`log_new_id`) REFERENCES `mypeweb_newsletter` (`new_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
