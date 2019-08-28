-- phpMyAdmin SQL Dump
-- version 4.7.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Авг 28 2019 г., 07:06
-- Версия сервера: 5.7.18
-- Версия PHP: 7.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `testing_system`
--

-- --------------------------------------------------------

--
-- Структура таблицы `completed_tasks`
--

CREATE TABLE `completed_tasks` (
  `id` int(11) NOT NULL,
  `id_razdel` int(11) NOT NULL,
  `id_task` int(11) NOT NULL,
  `id_student` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `completed_tasks`
--

INSERT INTO `completed_tasks` (`id`, `id_razdel`, `id_task`, `id_student`) VALUES
(1, 1, 1, 4),
(2, 1, 4, 4),
(3, 1, 3, 4),
(4, 1, 7, 4),
(5, 2, 5, 4),
(6, 2, 10, 4),
(7, 6, 33, 4),
(8, 2, 13, 4),
(9, 2, 14, 4),
(10, 2, 6, 4),
(11, 2, 12, 4),
(12, 2, 11, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `credit_book_numbers`
--

CREATE TABLE `credit_book_numbers` (
  `id` int(11) NOT NULL,
  `number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `credit_book_numbers`
--

INSERT INTO `credit_book_numbers` (`id`, `number`) VALUES
(1, '12345'),
(2, '12346'),
(3, '12347'),
(5, '12348');

-- --------------------------------------------------------

--
-- Структура таблицы `current_state`
--

CREATE TABLE `current_state` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `time` varchar(255) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `current_state`
--

INSERT INTO `current_state` (`id`, `id_user`, `file`, `status`, `time`, `datetime`) VALUES
(6, 4, 'save/4_store', 1, '7180', '2019-07-15 08:43:56'),
(9, 4, 'save/4_store', 1, '7180', '2019-07-15 08:53:29'),
(10, 4, 'save/4_store', 1, '7200', '2019-07-15 08:54:05'),
(11, 4, 'save/4_store', 1, '7200', '2019-07-15 08:55:26'),
(14, 4, 'save/4_store1563189130', 1, '7160', '2019-07-15 14:12:10'),
(15, 4, 'save/4_store1563189261', 1, '7160', '2019-07-15 14:14:21'),
(16, 4, 'save/4_store1563189426', 0, '-25800', '2019-07-15 14:17:06');

-- --------------------------------------------------------

--
-- Структура таблицы `diapason`
--

CREATE TABLE `diapason` (
  `id` int(11) NOT NULL,
  `id_razdel` int(11) NOT NULL,
  `id_task` int(11) NOT NULL,
  `name_element` varchar(255) NOT NULL,
  `min` decimal(18,2) DEFAULT NULL,
  `max` decimal(18,2) DEFAULT NULL,
  `step` decimal(11,1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `diapason`
--

INSERT INTO `diapason` (`id`, `id_razdel`, `id_task`, `name_element`, `min`, `max`, `step`) VALUES
(1, 1, 1, 'R1', '100.00', '1000000.00', '100.0'),
(2, 1, 1, 'R2', '100.00', '1000000.00', '100.0'),
(3, 1, 1, 'VCC', '2.00', '50.00', '1.0'),
(4, 1, 2, 'R1', '100.00', '1000000.00', '100.0'),
(5, 1, 2, 'R2', '100.00', '1000000.00', '100.0'),
(6, 1, 2, 'VCC', '2.00', '50.00', '1.0'),
(7, 1, 3, 'R1', '100.00', '1000000.00', '100.0'),
(8, 1, 3, 'R2', '100.00', '1000000.00', '100.0'),
(9, 1, 3, 'R3', '100.00', '1000000.00', '100.0'),
(10, 1, 3, 'VCC', '2.00', '50.00', '1.0'),
(11, 1, 4, 'R1', '100.00', '1000000.00', '100.0'),
(12, 1, 4, 'R2', '100.00', '1000000.00', '100.0'),
(13, 1, 4, 'R3', '100.00', '1000000.00', '100.0'),
(14, 1, 4, 'R4', '100.00', '1000000.00', '100.0'),
(15, 1, 4, 'VCC', '2.00', '50.00', '1.0'),
(16, 2, 5, 'R1', '100.00', '10000.00', '100.0'),
(17, 2, 5, 'R2', '100.00', '10000.00', '100.0'),
(18, 2, 5, 'VCC', '2.00', '50.00', '1.0'),
(19, 2, 6, 'R1', '10.00', '10000.00', '100.0'),
(20, 2, 6, 'R2', '100.00', '10000.00', '100.0'),
(21, 2, 6, 'VCC', '2.00', '50.00', '1.0'),
(22, 1, 2, 'R3', '100.00', '1000000.00', '100.0'),
(23, 1, 7, 'R1', '100.00', '1000000.00', '100.0'),
(24, 1, 7, 'R2', '100.00', '1000000.00', '100.0'),
(25, 1, 7, 'R3', '100.00', '1000000.00', '100.0'),
(26, 1, 7, 'R4', '100.00', '1000000.00', '100.0'),
(27, 1, 7, 'VCC', '2.00', '50.00', '1.0'),
(28, 2, 10, 'R1', '100.00', '1000.00', '100.0'),
(29, 2, 10, 'R2', '100.00', '1000.00', '100.0'),
(30, 2, 10, 'VCC', '10.00', '50.00', '1.0'),
(31, 2, 11, 'R1', '100.00', '1000.00', '100.0'),
(32, 2, 11, 'R2', '100.00', '1000.00', '100.0'),
(33, 2, 11, 'VCC', '10.00', '50.00', '1.0'),
(34, 2, 12, 'R1', '100.00', '1000.00', '100.0'),
(35, 2, 12, 'R2', '100.00', '1000.00', '100.0'),
(36, 2, 12, 'Vcc', '10.00', '50.00', '1.0'),
(37, 2, 13, 'R1', '100.00', '1000.00', '100.0'),
(38, 2, 13, 'R2', '100.00', '1000.00', '100.0'),
(39, 2, 13, 'Vcc', '10.00', '50.00', '1.0'),
(40, 2, 14, 'R1', '100.00', '1000.00', '100.0'),
(41, 2, 14, 'R2', '100.00', '1000.00', '100.0'),
(42, 2, 14, 'Vcc', '10.00', '50.00', '1.0'),
(43, 2, 10, 'R5', '100.00', '1000.00', '100.0'),
(44, 2, 11, 'R3', '100.00', '1000.00', '100.0'),
(45, 2, 11, 'R5', '100.00', '1000.00', '100.0'),
(46, 2, 12, 'R3', '100.00', '1000.00', '100.0'),
(47, 2, 12, 'R5', '100.00', '1000.00', '100.0'),
(48, 2, 13, 'R3', '100.00', '1000.00', '100.0'),
(49, 2, 13, 'R5', '100.00', '1000.00', '100.0'),
(50, 2, 14, 'R3', '100.00', '1000.00', '100.0'),
(51, 2, 14, 'R5', '100.00', '1000.00', '100.0'),
(52, 3, 15, 'Doch', '5.00', '20.00', '1.0'),
(53, 3, 15, 'n', '10.00', '1000.00', '10.0'),
(54, 3, 15, 'D', '0.20', '2.00', '0.1'),
(55, 3, 16, 'R', '100.00', '2000000.00', '100.0'),
(56, 3, 16, 'Doch', '5.00', '20.00', '1.0'),
(57, 3, 16, 'D', '0.20', '2.00', '0.1'),
(58, 3, 17, 'Y', '180.00', '320.00', '10.0'),
(59, 3, 17, 'U', '1.00', '50.00', '1.0'),
(60, 3, 17, 'G', '180.00', '320.00', '10.0'),
(61, 3, 18, 'U', '1.00', '50.00', '1.0'),
(62, 3, 18, 'U2', '1.00', '50.00', '1.0'),
(63, 3, 18, 'G', '180.00', '320.00', '10.0'),
(74, 7, 19, 'ln1', '-100.00', '100.00', '10.0'),
(75, 7, 19, 'ln2', '-100.00', '100.00', '10.0'),
(76, 7, 19, 'Vcc1', '3.00', '5.00', '1.0'),
(77, 7, 19, 'Vcc2', '-5.00', '-3.00', '1.0'),
(78, 7, 20, 'ln1', '-100.00', '100.00', '10.0'),
(79, 7, 20, 'ln2', '-100.00', '100.00', '10.0'),
(80, 7, 20, 'Vcc1', '3.00', '5.00', '1.0'),
(81, 7, 20, 'Vcc2', '-5.00', '-3.00', '1.0'),
(82, 7, 19, 'K', NULL, NULL, NULL),
(83, 7, 20, 'K', NULL, NULL, NULL),
(84, 7, 21, 'ln1', NULL, NULL, NULL),
(85, 7, 21, 'Vcc1', '3.00', '5.00', '1.0'),
(86, 7, 21, 'Vcc2', '-5.00', '-3.00', '1.0'),
(87, 7, 21, 'R1', '10000.00', '1000000.00', '10000.0'),
(88, 7, 21, 'R2', '10000.00', '1000000.00', '10000.0'),
(89, 7, 23, 'ln1', NULL, NULL, NULL),
(90, 7, 23, 'Vcc1', '3.00', '5.00', '1.0'),
(91, 7, 23, 'Vcc2', '-5.00', '-3.00', '1.0'),
(92, 7, 23, 'R1', '10000.00', '1000000.00', '10000.0'),
(93, 7, 23, 'R2', '10000.00', '1000000.00', '10000.0'),
(94, 7, 24, 'ln1', NULL, NULL, NULL),
(95, 7, 24, 'Vcc1', '3.00', '5.00', '1.0'),
(96, 7, 24, 'Vcc2', '-5.00', '-3.00', '1.0'),
(97, 7, 24, 'R1', '10000.00', '1000000.00', '10000.0'),
(98, 7, 24, 'R2', '10000.00', '1000000.00', '10000.0'),
(99, 7, 25, 'ln1', NULL, NULL, NULL),
(100, 7, 25, 'Vcc1', '3.00', '5.00', '1.0'),
(101, 7, 25, 'Vcc2', '-5.00', '-3.00', '1.0'),
(102, 7, 25, 'R1', '10000.00', '1000000.00', '10000.0'),
(103, 7, 25, 'R2', '10000.00', '1000000.00', '10000.0'),
(104, 7, 26, 'ln1', NULL, NULL, NULL),
(105, 7, 26, 'Vcc1', '3.00', '5.00', '1.0'),
(106, 7, 26, 'Vcc2', '-5.00', '-3.00', '1.0'),
(107, 7, 26, 'R1', '10000.00', '1000000.00', '10000.0'),
(108, 7, 26, 'R2', '10000.00', '1000000.00', '10000.0'),
(109, 7, 23, 'R3', '10000.00', '1000000.00', '10000.0'),
(110, 7, 24, 'R3', '10000.00', '1000000.00', '10000.0'),
(111, 7, 24, 'R4', '10000.00', '1000000.00', '10000.0'),
(112, 7, 25, 'R3', '10000.00', '1000000.00', '10000.0'),
(113, 7, 25, 'R4', '10000.00', '1000000.00', '10000.0'),
(114, 7, 26, 'R3', '10000.00', '1000000.00', '10000.0'),
(115, 7, 26, 'R4', '10000.00', '1000000.00', '10000.0'),
(116, 7, 26, 'R5', '10000.00', '1000000.00', '10000.0'),
(117, 7, 22, 'ln1', NULL, NULL, NULL),
(118, 7, 22, 'Vcc1', '3.00', '5.00', '1.0'),
(119, 7, 22, 'Vcc2', '-5.00', '-3.00', '1.0'),
(120, 7, 22, 'R1', '10000.00', '1000000.00', '10000.0'),
(121, 7, 22, 'R2', '10000.00', '1000000.00', '10000.0'),
(122, 9, 30, 'N', '8.00', '16.00', '1.0'),
(123, 9, 30, 'Y', '0.00', '16.00', '1.0'),
(124, 9, 30, 'V', '8.00', '14.00', '1.0'),
(125, 11, 32, 'R1', '100.00', '1000000.00', '100.0'),
(126, 11, 32, 'R2', '100.00', '1000000.00', '100.0'),
(127, 11, 32, 'R3', '100.00', '1000000.00', '100.0'),
(128, 11, 32, 'Vcc', '2.00', '30.00', '1.0');

-- --------------------------------------------------------

--
-- Структура таблицы `razdel`
--

CREATE TABLE `razdel` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `razdel`
--

INSERT INTO `razdel` (`id`, `name`) VALUES
(1, 'Раздел 1'),
(2, 'Раздел 2'),
(3, 'Раздел 3'),
(6, 'Раздел 4'),
(7, 'Раздел 5'),
(8, 'Раздел 6'),
(9, 'Раздел 7'),
(10, 'Раздел 8'),
(11, 'Раздел 9');

-- --------------------------------------------------------

--
-- Структура таблицы `result`
--

CREATE TABLE `result` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_task` int(11) NOT NULL,
  `result` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `result_formula` varchar(255) NOT NULL,
  `true_result` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `results`
--

CREATE TABLE `results` (
  `id` int(11) NOT NULL,
  `id_student` int(11) NOT NULL,
  `id_razdel` int(11) NOT NULL,
  `result` int(11) NOT NULL DEFAULT '-1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `results`
--

INSERT INTO `results` (`id`, `id_student`, `id_razdel`, `result`) VALUES
(1, 4, 1, 0),
(2, 4, 2, 1),
(4, 4, 6, 0),
(5, 4, 7, -1),
(6, 4, 8, -2),
(7, 4, 9, -1),
(8, 4, 10, -1),
(9, 4, 11, -2),
(10, 4, 3, -1),
(29, 6, 1, -1),
(30, 6, 2, -1),
(31, 6, 3, -1),
(32, 6, 6, -1),
(33, 6, 7, -1),
(34, 6, 8, -1),
(35, 6, 9, -1),
(36, 6, 10, -1),
(37, 6, 11, -1),
(45, 5, 10, -1),
(46, 5, 11, -1),
(47, 1, 1, -1),
(48, 1, 2, -1),
(49, 1, 3, -1),
(50, 1, 6, -1),
(51, 1, 7, -1),
(52, 1, 8, -1),
(53, 1, 9, -1),
(54, 1, 10, -1),
(55, 1, 11, -1),
(56, 9, 1, -1),
(57, 9, 2, -1),
(58, 9, 3, -1),
(59, 9, 6, -1),
(60, 9, 7, -1),
(61, 9, 8, -1),
(62, 9, 9, -1),
(63, 9, 10, -1),
(64, 9, 11, -1);

-- --------------------------------------------------------

--
-- Структура таблицы `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `id_razdel` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(500) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `formula` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `task`
--

INSERT INTO `task` (`id`, `id_razdel`, `name`, `description`, `img`, `formula`) VALUES
(1, 1, 'task1', 'Вычислить показание вольтметра XMM1, если ', 'static/img/images/part1_task1.png', 'Vxmm1=VCC*R2/(R1+R2)'),
(2, 1, 'task2', 'Вычислить показание вольтметра XMM1, если', 'static/img/images/part1_task2.png', 'Vxmm1=VCC*(R1*R3/(R1+R3))/(R1+(R1*R3/(R1+R3)))\r\n'),
(3, 1, 'task3', 'Вычислить показание вольтметра XMM1, если', 'static\\img\\images\\part1_task3.png', 'Vxmm1=VCC*R2/((R1*R3/(R1+R3))+R2)'),
(4, 1, 'task4', 'Вычислить показание вольтметра XMM1, если', 'static\\img\\images\\part1_task4.png', 'Vxmm1=VCC*(R2*R3/(R2+R3))/((R1*R4/(R1+R4))+(R2*R3/(R2+R3)))'),
(5, 2, 'task1', 'Определить мощность, рассеиваемую резистором R1, если ', 'static\\img\\images\\part2_task1.png', 'P=(POW(VCC/(R1+R2),2))*R1'),
(6, 2, 'task2', 'Определить мощность, рассеиваемую резистором R2, если ', 'static\\img\\images\\part2_task2.png', 'P=(POW(VCC/(R1+R2),2))*R2'),
(7, 1, 'task5', 'Вычислить показание вольтметра XMM1, если', 'static/img/images/1559798891455454.png', 'Vxmm1=VCC*(R2/(R1+R2) - R3/(R3+R4))'),
(9, 1, 'task6', 'Вычислить показание вольтметра XMM1, если', 'static\\img\\images\\part1_task6.png', 'Vxmm1=VCC*(R2*R4/(R2+R4))/((R1*R3*R5/(R3*R5+R1*R5+R1*R3))+(R2*R4/(R2+R4)))'),
(10, 2, 'task3', 'Определить мощность, рассеиваемую резистором R2, если ', 'static\\img\\images\\part2_task3.png', 'P=(POW(VCC/((R1*R5/(R1+R5))+R2) ,2))*R2'),
(11, 2, 'task4', 'Определить мощность, рассеиваемую резистором R1, если ', 'static\\img\\images\\part2_task4.png', 'P=(POW(Vcc-(Vcc/((R1*R5/(R1+R5))+(R2*R3/(R2+R3))))*(R2*R3/(R2+R3)),2))/R1'),
(12, 2, 'task5', 'Определить мощность, рассеиваемую резистором R5, если ', 'static\\img\\images\\part2_task5.png', 'P=(POW(Vcc-(Vcc/((R1*R5/(R1+R5))+(R2*R3/(R2+R3))))*(R2*R3/(R2+R3)),2))/R5'),
(13, 2, 'task6', 'Определить мощность, рассеиваемую резистором R2, если ', 'static\\img\\images\\part2_task6.png', 'P=POW((Vcc-(Vcc/((R1*R5/(R1+R5))+(R2*R3/(R2+R3))))*(R1*R5/(R1+R5))),2/R2)'),
(14, 2, 'task7', 'Определить мощность, рассеиваемую резистором R3, если ', 'static\\img\\images\\part2_task7.png', 'P=pow((Vcc-(Vcc/((R1*R5/(R1+R5))+(R2*R3/(R2+R3))))*(R1*R5/(R1+R5))), 2/R3)'),
(15, 3, 'task31', 'На цилиндрическое керамическое основание (Dосн) намотали n витков нихромовой проволоки. Диаметр проволоки Dпров, удельное сопротивление нихрома ρ=1.1 Ом*мм2/м. Определить сопротивление нихромового резистора.', '', 'R=1.1* Doch*4000*n/(D *D)'),
(16, 3, 'task32', 'Требуется изготовить проволочный резистор сопротивлением R. Имеется цилиндрическое керамическое основание  (Dосн), на которое будет наматываться проволока с удельным сопротивлением  ρ=1.1 Ом*мм2/м и диаметром  Dпров. Определить требуемое количество витков.', NULL, 'n=R*(D *D)/(1.1* Doch*4000)'),
(17, 3, 'task33', 'Имеется переменный резистор сопротивлением R, к которому подключен источник питания напряжением U. В начальный момент времени скользящий контакт вплотную придвинут к контакту резистора, подключенному к нулевому потенциалу источника питания. Определите напряжение на выходе (Uвых), если известно, что максимальный угол поворота скользящего контакт составляет G градусов, а его повернули на Y градусов.', NULL, 'Uvyh=U*Y/G'),
(18, 3, 'task34', 'На какой угол Y относительно контакта, подключенного к нулевому потенциалу источника питания, нужно повернуть пленочный переменный резистор сопротивлением R для получения выходного напряжения величиной Uвых. Известно, что к резистору подключен источник питания напряжением U., а полный угол поворота скользящего контакта составляет G градусов.', NULL, 'Y=G*U2/U'),
(19, 7, 'task51', 'Определите напряжение на выходе (Out),\r\nесли известны входные напряжения In1, In2, Кус\r\nи напряжения питания ОУ Vcc1, Vcc2.\r\n', 'static\\img\\images\\part5_task1.png', 'Out=(ln1-(ln2))*0.000001*K'),
(20, 7, 'task52', 'Определите напряжение на выходе (Out),\r\nесли известны входные напряжения In1, In2\r\nи напряжения питания ОУ Vcc1, Vcc2.\r\n', 'static\\img\\images\\part5_task2.png', 'Out=(ln2-(ln1))*0.000001*K'),
(21, 7, 'task53', 'Определите напряжение на выходе (Out),\r\nесли известны входное напряжение In1, \r\nсопротивления R1, R2  и напряжения питания\r\nпитания ОУ Vcc1, Vcc2.\r\n', 'static\\img\\images\\part5_task3.png', NULL),
(22, 7, 'task54', 'Определите напряжение на выходе (Out),\r\nесли известны входное напряжение In1, \r\nсопротивления R1, R2  и напряжения питания\r\nпитания ОУ Vcc1, Vcc2.\r\n', 'static\\img\\images\\part5_task4.png', NULL),
(23, 7, 'task55', 'Определите напряжение на выходе (Out),если известны входное напряжение In1, \r\nсопротивления R1, R2, R3  и напряжения питания\r\nпитания ОУ Vcc1, Vcc2.\r\n', 'static\\img\\images\\part5_task5.png', NULL),
(24, 7, 'task56', 'Определите напряжение на выходе (Out),если известны входное напряжение In1, \r\nсопротивления R1, R2, R3  и напряжения питания\r\nпитания ОУ Vcc1, Vcc2.\r\n', 'static\\img\\images\\part5_task6.png', NULL),
(25, 7, 'task57', 'Определите напряжение на выходе (Out),\r\nесли известны входное напряжение In1, \r\nсопротивления R1 - R4  и напряжения питания\r\nпитания ОУ Vcc1, Vcc2.\r\n', 'static\\img\\images\\part5_task7.png', NULL),
(26, 7, 'task58', 'Определите напряжение на выходе (Out),\r\nесли известны входное напряжение In1, \r\nсопротивления R1 - R5  и напряжения питания\r\nпитания ОУ Vcc1, Vcc2\r\n', 'static\\img\\images\\part5_task8.png', NULL),
(27, 8, 'task61', 'Определить напряжение на выходе ОУ (Out), если известно, что', 'static\\img\\images\\part6_task1.png', NULL),
(28, 8, 'task62', 'Определить напряжение на выходе ОУ, если известно, что', 'static\\img\\images\\part6_task1.png', NULL),
(29, 8, 'task63', 'Определить напряжение на выходе ОУ, если известно, что', 'static\\img\\images\\part6_task1.png', NULL),
(30, 9, 'task71', 'На вход N разрядного АЦП подан сигнал амплитудой Y Вольт. Определить десятичный код (Code) на выходе, если известно, Vref=X Вольт.', NULL, NULL),
(31, 10, 'task81', '       На вход N разрядного ЦАП подан десятичный код Code10. Определить величину выходного\r\n       напряжения (Out), если известно, Vref=X Вольт.', NULL, 'Out=Vref*Code/(2**N)'),
(32, 11, 'task91', 'Определить напряжение на базе транзистора (Ub), если известно, что:', 'static\\img\\images\\part9_task1.png', 'Ub=Vcc*R2/(R1+R2)'),
(33, 6, 'task41', 'Согласно приведенной таблице определите номинал в Омах и значение погрешности резисторов, если них указана следующая цветовая маркировка:', 'static\\img\\images\\part4_task1.png', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `id_result` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fio` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `login` varchar(255) DEFAULT NULL,
  `student_group` varchar(255) DEFAULT NULL,
  `date_reg` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `fio`, `password`, `login`, `student_group`, `date_reg`, `role`, `status`) VALUES
(1, 'Иванов Иван Иванович', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'admin', NULL, '2019-07-01 16:22:28', 0, 1),
(4, 'Петров Сергей Викторович', '8cb2237d0679ca88db6464eac60da96345513964', '12345', 'IBM-40', '2019-07-01 16:22:28', 1, 1),
(5, 'Гнатюк Максим Николаевич', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'MadMax', NULL, '2019-07-01 16:22:28', 2, 1),
(6, 'Васильев Сергей Геннадьевич', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '12348', 'IBM-44', '2019-07-01 16:22:28', 1, 0),
(7, 'Петров Сергей Александрович', '356a192b7913b04c54574d18c28d46e6395428ab', 'Sergey', NULL, '2019-07-01 16:22:28', 2, 1),
(8, 'Иванова Валентина Петровна', '356a192b7913b04c54574d18c28d46e6395428ab', 'CrazyV', NULL, '2019-07-01 16:22:28', 2, 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `completed_tasks`
--
ALTER TABLE `completed_tasks`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `credit_book_numbers`
--
ALTER TABLE `credit_book_numbers`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `current_state`
--
ALTER TABLE `current_state`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `diapason`
--
ALTER TABLE `diapason`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_razdel` (`id_razdel`),
  ADD KEY `id_task` (`id_task`);

--
-- Индексы таблицы `razdel`
--
ALTER TABLE `razdel`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_task` (`id_task`),
  ADD KEY `id_user` (`id_user`);

--
-- Индексы таблицы `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_razdel` (`id_razdel`),
  ADD KEY `id_student` (`id_student`);

--
-- Индексы таблицы `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_razdel` (`id_razdel`);

--
-- Индексы таблицы `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_result` (`id_result`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `completed_tasks`
--
ALTER TABLE `completed_tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT для таблицы `credit_book_numbers`
--
ALTER TABLE `credit_book_numbers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `current_state`
--
ALTER TABLE `current_state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT для таблицы `diapason`
--
ALTER TABLE `diapason`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;
--
-- AUTO_INCREMENT для таблицы `razdel`
--
ALTER TABLE `razdel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT для таблицы `result`
--
ALTER TABLE `result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `results`
--
ALTER TABLE `results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT для таблицы `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT для таблицы `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `diapason`
--
ALTER TABLE `diapason`
  ADD CONSTRAINT `diapason_ibfk_1` FOREIGN KEY (`id_razdel`) REFERENCES `razdel` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `diapason_ibfk_2` FOREIGN KEY (`id_task`) REFERENCES `task` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `result`
--
ALTER TABLE `result`
  ADD CONSTRAINT `result_ibfk_2` FOREIGN KEY (`id_task`) REFERENCES `task` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `results`
--
ALTER TABLE `results`
  ADD CONSTRAINT `results_ibfk_2` FOREIGN KEY (`id_razdel`) REFERENCES `razdel` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `task_ibfk_1` FOREIGN KEY (`id_razdel`) REFERENCES `razdel` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `test`
--
ALTER TABLE `test`
  ADD CONSTRAINT `test_ibfk_1` FOREIGN KEY (`id_result`) REFERENCES `result` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
