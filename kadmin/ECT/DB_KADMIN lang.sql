-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Ноя 07 2017 г., 16:13
-- Версия сервера: 5.5.31
-- Версия PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `korzunpp_go2`
--

-- --------------------------------------------------------

--
-- Структура таблицы `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `url` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `value1` text NOT NULL,
  `field_1` varchar(255) NOT NULL,
  `field_2` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `checkbox` tinyint(1) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `background` varchar(255) NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `article_cats`
--

CREATE TABLE `article_cats` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `has_child` tinyint(4) NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `url` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `value1` text NOT NULL,
  `field_1` varchar(255) NOT NULL,
  `field_2` varchar(255) NOT NULL,
  `checkbox` tinyint(4) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `background` varchar(255) NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `article_comments`
--

CREATE TABLE `article_comments` (
  `id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `date` datetime NOT NULL,
  `checkbox` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `article_in_cats`
--

CREATE TABLE `article_in_cats` (
  `id` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `id_article` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `article_tags`
--

CREATE TABLE `article_tags` (
  `id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `banner_1`
--

CREATE TABLE `banner_1` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `field_1` varchar(255) NOT NULL,
  `field_2` varchar(255) NOT NULL,
  `field_3` varchar(255) NOT NULL,
  `field_4` varchar(255) NOT NULL,
  `checkbox` tinyint(4) NOT NULL,
  `image1` varchar(255) NOT NULL,
  `image2` varchar(255) NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `banner_2`
--

CREATE TABLE `banner_2` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `field_1` varchar(255) NOT NULL,
  `field_2` varchar(255) NOT NULL,
  `field_3` varchar(255) NOT NULL,
  `field_4` varchar(255) NOT NULL,
  `checkbox` tinyint(4) NOT NULL,
  `image1` varchar(255) NOT NULL,
  `image2` varchar(255) NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `banner_3`
--

CREATE TABLE `banner_3` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `field_1` varchar(255) NOT NULL,
  `field_2` varchar(255) NOT NULL,
  `field_3` varchar(255) NOT NULL,
  `field_4` varchar(255) NOT NULL,
  `checkbox` tinyint(4) NOT NULL,
  `image1` varchar(255) NOT NULL,
  `image2` varchar(255) NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `city` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `postal` varchar(255) DEFAULT NULL,
  `recover_pass` varchar(255) DEFAULT NULL,
  `token` varchar(255) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `background` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `value` text NOT NULL,
  `field_1` varchar(255) NOT NULL,
  `field_2` varchar(255) NOT NULL,
  `checkbox` tinyint(4) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `galleries`
--

CREATE TABLE `galleries` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `id_category` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `url` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `value1` text NOT NULL,
  `field_1` varchar(255) NOT NULL,
  `field_2` varchar(255) NOT NULL,
  `checkbox` tinyint(4) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `background` varchar(255) NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `gallery_cats`
--

CREATE TABLE `gallery_cats` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `has_child` tinyint(4) NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `url` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `value1` text NOT NULL,
  `field_1` varchar(255) NOT NULL,
  `field_2` varchar(255) NOT NULL,
  `checkbox` tinyint(4) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `background` varchar(255) NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `gallery_images`
--

CREATE TABLE `gallery_images` (
  `id` int(11) NOT NULL,
  `id_gallery` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `media`
--

CREATE TABLE `media` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `thumbnail` varchar(255) DEFAULT NULL,
  `video` text,
  `value` text,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `url` varchar(255) NOT NULL,
  `value_1` text NOT NULL,
  `value_2` text NOT NULL,
  `value_3` text NOT NULL,
  `value_4` varchar(255) NOT NULL,
  `field_1` varchar(255) NOT NULL,
  `field_2` varchar(255) NOT NULL,
  `field_3` varchar(255) NOT NULL,
  `field_4` varchar(255) NOT NULL,
  `checkbox` tinyint(4) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `background` varchar(255) NOT NULL,
  `image1` varchar(255) NOT NULL,
  `image2` varchar(255) NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `newsTranslate`
--

CREATE TABLE `newsTranslate` (
  `id` int(11) NOT NULL,
  `id_news` int(11) NOT NULL,
  `lang` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `value_1` text NOT NULL,
  `value_2` text NOT NULL,
  `value_3` text NOT NULL,
  `value_4` text NOT NULL,
  `field_1` varchar(255) NOT NULL,
  `field_2` varchar(255) NOT NULL,
  `field_3` varchar(255) NOT NULL,
  `field_4` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `price` float NOT NULL,
  `count` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` float NOT NULL DEFAULT '0',
  `url` varchar(255) NOT NULL,
  `value_1` text NOT NULL,
  `value_2` text NOT NULL,
  `value_3` text NOT NULL,
  `value_4` text NOT NULL,
  `field_1` varchar(255) NOT NULL,
  `field_2` varchar(255) NOT NULL,
  `field_3` varchar(255) NOT NULL,
  `field_4` varchar(255) NOT NULL,
  `checkbox` tinyint(4) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `background` varchar(255) NOT NULL,
  `pdf` varchar(255) NOT NULL,
  `position` int(11) NOT NULL,
  `category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `productsTranslate`
--

CREATE TABLE `productsTranslate` (
  `id` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `lang` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `value_1` text NOT NULL,
  `value_2` text NOT NULL,
  `value_3` text NOT NULL,
  `value_4` text NOT NULL,
  `field_1` varchar(255) NOT NULL,
  `field_2` varchar(255) NOT NULL,
  `field_3` varchar(255) NOT NULL,
  `field_4` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `product_cats`
--

CREATE TABLE `product_cats` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `has_child` tinyint(4) NOT NULL,
  `url` varchar(255) NOT NULL,
  `value_1` text NOT NULL,
  `value_2` text NOT NULL,
  `field_1` varchar(255) NOT NULL,
  `field_2` varchar(255) NOT NULL,
  `checkbox` tinyint(4) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `background` varchar(255) NOT NULL,
  `position` int(11) NOT NULL,
  `gallery_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `product_catsTranslate`
--

CREATE TABLE `product_catsTranslate` (
  `id` int(11) NOT NULL,
  `id_product_cats` int(11) NOT NULL,
  `lang` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `value_1` text CHARACTER SET utf8 COLLATE utf8_esperanto_ci NOT NULL,
  `value_2` text NOT NULL,
  `field_1` varchar(255) NOT NULL,
  `field_2` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `product_in_cats`
--

CREATE TABLE `product_in_cats` (
  `id` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `id_product` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `sections`
--

CREATE TABLE `sections` (
  `id` int(11) NOT NULL,
  `landing` tinyint(4) NOT NULL,
  `has_subsect` tinyint(4) NOT NULL,
  `url` varchar(255) NOT NULL,
  `checkbox` tinyint(4) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `background` varchar(255) NOT NULL,
  `image_1` varchar(255) NOT NULL,
  `image_2` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `field_1` varchar(255) NOT NULL,
  `field_2` varchar(255) NOT NULL,
  `field_3` varchar(255) NOT NULL,
  `field_4` varchar(255) NOT NULL,
  `field_5` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `sectionsTranslate`
--

CREATE TABLE `sectionsTranslate` (
  `id` int(11) NOT NULL,
  `id_section` int(11) NOT NULL,
  `lang` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `value_1` text NOT NULL,
  `value_2` text NOT NULL,
  `value_3` text NOT NULL,
  `value_4` text NOT NULL,
  `field_1` varchar(255) NOT NULL,
  `field_2` varchar(255) NOT NULL,
  `field_3` varchar(255) NOT NULL,
  `field_4` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `table` varchar(255) NOT NULL,
  `field_id` int(11) NOT NULL,
  `field_name` varchar(255) NOT NULL,
  `field_title` varchar(255) NOT NULL,
  `field_style` varchar(255) NOT NULL,
  `on_off` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`id`, `table`, `field_id`, `field_name`, `field_title`, `field_style`, `on_off`) VALUES
(346, 'product_cats', -1, 'parent_id', '', '', 0),
(347, 'product_cats', -1, 'has_child', '', '', 0),
(349, 'product_cats', -1, 'title', '', '', 0),
(350, 'product_cats', -1, 'keywords', '', '', 0),
(351, 'product_cats', -1, 'description', '', '', 0),
(352, 'product_cats', -1, 'url', '', '', 1),
(353, 'product_cats', -1, 'value_1', '', '', 0),
(354, 'product_cats', -1, 'value_2', '', '', 0),
(355, 'product_cats', -1, 'field_1', '', '', 0),
(356, 'product_cats', -1, 'field_2', '', '', 0),
(357, 'product_cats', -1, 'checkbox', 'Создать страницу для категорию?', '', 1),
(358, 'product_cats', -1, 'thumbnail', 'Миниатюра', '', 1),
(359, 'product_cats', -1, 'background', '', '', 0),
(366, 'orders', -1, 'id_order', '', '', 1),
(367, 'orders', -1, 'id_customer', '', '', 1),
(368, 'orders', -1, 'id_product', '', '', 1),
(369, 'orders', -1, 'price', '', '', 1),
(370, 'orders', -1, 'count', '', '', 1),
(371, 'orders', -1, 'date', '', '', 1),
(384, 'customers', -1, 'password', '', '', 1),
(385, 'customers', -1, 'name', '', '', 1),
(386, 'customers', -1, 'email', '', '', 1),
(387, 'customers', -1, 'phone', '', '', 1),
(388, 'customers', -1, 'city', '', '', 1),
(389, 'customers', -1, 'province', '', '', 1),
(390, 'customers', -1, 'address', '', '', 1),
(391, 'customers', -1, 'postal', '', '', 1),
(392, 'customers', -1, 'recover_pass', '', '', 1),
(393, 'customers', -1, 'token', '', '', 1),
(394, 'customers', -1, 'thumbnail', '', '', 1),
(395, 'customers', -1, 'background', '', '', 1),
(413, 'products', -1, 'name', 'Имя', '', 1),
(414, 'products', -1, 'price', 'Цена', '', 0),
(418, 'products', -1, 'url', '', '', 1),
(419, 'products', -1, 'value', '', 'ckeditor', 0),
(420, 'products', -1, 'value1', '', '', 0),
(421, 'products', -1, 'value2', '', '', 0),
(422, 'products', -1, 'value3', '', '', 0),
(423, 'products', -1, 'field_1', '', '', 0),
(424, 'products', -1, 'field_2', '', '', 0),
(425, 'products', -1, 'field_3', '', '', 0),
(426, 'products', -1, 'field_4', '', '', 0),
(427, 'products', -1, 'checkbox', '', '', 0),
(428, 'products', -1, 'thumbnail', 'Миниатюра', '', 1),
(429, 'products', -1, 'background', '', '', 0),
(430, 'article_cats', -1, 'parent_id', 'parent ID', 'medium', 1),
(431, 'article_cats', -1, 'has_child', '123', 'small', 1),
(432, 'article_cats', -1, 'name', '132', 'medium', 1),
(433, 'article_cats', -1, 'title', '123', 'ckeditor', 1),
(434, 'article_cats', -1, 'keywords', '32', 'small', 1),
(435, 'article_cats', -1, 'description', '234', 'small', 1),
(436, 'article_cats', -1, 'url', '324', 'medium', 1),
(437, 'article_cats', -1, 'value', '234', 'small', 0),
(438, 'article_cats', -1, 'value1', '324', 'ckeditor', 1),
(439, 'article_cats', -1, 'field_1', '234', 'ckeditor', 1),
(440, 'article_cats', -1, 'field_2', '234', 'medium', 1),
(441, 'article_cats', -1, 'checkbox', '234', 'small', 1),
(442, 'article_cats', -1, 'thumbnail', '234', 'ckeditor', 1),
(443, 'article_cats', -1, 'background', '324', 'small', 1),
(458, 'articles', -1, 'name', 'Имя', '', 1),
(459, 'articles', -1, 'title', '', '', 1),
(460, 'articles', -1, 'keywords', '', '', 1),
(461, 'articles', -1, 'description', '', '', 1),
(462, 'articles', -1, 'url', '', '', 1),
(463, 'articles', -1, 'value', 'Текст', 'ckeditor', 1),
(464, 'articles', -1, 'value1', 'Краткое описание', 'medium', 0),
(465, 'articles', -1, 'field_1', '', '', 0),
(466, 'articles', -1, 'field_2', '', '', 0),
(467, 'articles', -1, 'date', 'Дата', '', 1),
(469, 'articles', -1, 'thumbnail', 'Миниатюра', '0', 0),
(470, 'articles', -1, 'background', '', '', 0),
(481, 'articles', -1, 'checkbox', '', '', 0),
(497, 'galleries', -1, 'name', '', '', 1),
(498, 'galleries', -1, 'id_category', '', '', 0),
(499, 'galleries', -1, 'title', '', '', 1),
(500, 'galleries', -1, 'keywords', '', '', 0),
(501, 'galleries', -1, 'description', '', '', 1),
(502, 'galleries', -1, 'url', '', '', 0),
(503, 'galleries', -1, 'value', '', '', 0),
(504, 'galleries', -1, 'value1', '', '', 0),
(505, 'galleries', -1, 'field_1', '', '', 0),
(506, 'galleries', -1, 'field_2', '', '', 0),
(507, 'galleries', -1, 'checkbox', '', '', 0),
(508, 'galleries', -1, 'thumbnail', '', '', 0),
(509, 'galleries', -1, 'background', '', '', 0),
(524, 'gallery_cats', -1, 'parent_id', '', '', 1),
(525, 'gallery_cats', -1, 'has_child', '', '', 1),
(526, 'gallery_cats', -1, 'name', '', '', 1),
(527, 'gallery_cats', -1, 'title', '', '', 1),
(528, 'gallery_cats', -1, 'keywords', '', '', 1),
(529, 'gallery_cats', -1, 'description', '', '', 1),
(530, 'gallery_cats', -1, 'url', '', '', 1),
(531, 'gallery_cats', -1, 'value', '', '', 1),
(532, 'gallery_cats', -1, 'value1', '', '', 1),
(533, 'gallery_cats', -1, 'field_1', '', '', 1),
(534, 'gallery_cats', -1, 'field_2', '', '', 1),
(535, 'gallery_cats', -1, 'checkbox', '', '', 1),
(536, 'gallery_cats', -1, 'thumbnail', '', '', 1),
(537, 'gallery_cats', -1, 'background', '', '', 1),
(547, 'testimonials', -1, 'name', 'Имя', '', 1),
(548, 'testimonials', -1, 'date', '', '', 0),
(549, 'testimonials', -1, 'value', 'Текст', 'ckeditor', 1),
(550, 'testimonials', -1, 'field_1', '', '', 0),
(551, 'testimonials', -1, 'field_2', '', '', 0),
(552, 'testimonials', -1, 'field_3', '', '', 0),
(553, 'testimonials', -1, 'field_4', '', '', 0),
(554, 'testimonials', -1, 'checkbox', '', '', 1),
(555, 'testimonials', -1, 'thumbnail', 'Фото', '', 1),
(580, 'news', -1, 'url', '', '', 1),
(581, 'news', -1, 'value_1', '', '', 0),
(582, 'news', -1, 'value_2', '', '', 0),
(583, 'news', -1, 'value_3', '', '', 0),
(585, 'news', -1, 'field_1', '', '', 0),
(586, 'news', -1, 'field_2', '', '', 0),
(587, 'news', -1, 'field_3', '', '', 0),
(588, 'news', -1, 'field_4', '', '', 0),
(590, 'news', -1, 'thumbnail', '', '', 0),
(592, 'news', -1, 'image1', '', '', 0),
(593, 'news', -1, 'image2', '', '', 0),
(638, 'media', -1, 'name', '', '', 1),
(639, 'media', -1, 'date', '', '', 1),
(640, 'media', -1, 'type', '', '', 1),
(641, 'media', -1, 'thumbnail', '', '', 1),
(642, 'media', -1, 'video', '', '', 1),
(643, 'media', -1, 'value', '', '', 1),
(651, 'faq', -1, 'name', '', '', 1),
(652, 'faq', -1, 'date', '', '', 1),
(653, 'faq', -1, 'value', '', '', 1),
(654, 'faq', -1, 'field_1', '', '', 1),
(655, 'faq', -1, 'field_2', '', '', 1),
(656, 'faq', -1, 'checkbox', '', '', 1),
(657, 'faq', -1, 'thumbnail', '', '', 1),
(667, 'slider_1', -1, 'name', 'Имя', '', 0),
(668, 'slider_1', -1, 'value', '', '', 0),
(669, 'slider_1', -1, 'field_1', 'Главная ссылка', '', 1),
(670, 'slider_1', -1, 'field_2', 'Ссылка 1', '', 1),
(671, 'slider_1', -1, 'field_3', 'Ссылка 2', '', 1),
(672, 'slider_1', -1, 'field_4', 'Ссылка 3', '', 1),
(673, 'slider_1', -1, 'checkbox', 'Вкл', '', 1),
(674, 'slider_1', -1, 'image1', 'Фото', '', 1),
(675, 'slider_1', -1, 'image2', '', '', 0),
(685, 'slider_2', -1, 'name', '', '', 1),
(686, 'slider_2', -1, 'value', '', '', 0),
(687, 'slider_2', -1, 'field_1', '', '', 0),
(688, 'slider_2', -1, 'field_2', '', '', 0),
(689, 'slider_2', -1, 'field_3', '', '', 0),
(690, 'slider_2', -1, 'field_4', '', '', 0),
(691, 'slider_2', -1, 'checkbox', 'ВКЛ', '', 1),
(692, 'slider_2', -1, 'image1', 'Фото', '', 1),
(693, 'slider_2', -1, 'image2', '', '', 0),
(724, 'slider_3', -1, 'name', '', '', 1),
(725, 'slider_3', -1, 'value', '', '', 1),
(726, 'slider_3', -1, 'field_1', '', '', 1),
(727, 'slider_3', -1, 'field_2', '', '', 1),
(728, 'slider_3', -1, 'field_3', '', '', 1),
(729, 'slider_3', -1, 'field_4', '', '', 1),
(730, 'slider_3', -1, 'checkbox', '', '', 1),
(731, 'slider_3', -1, 'image1', '', '', 1),
(732, 'slider_3', -1, 'image2', '', '', 1),
(742, 'banner_1', -1, 'name', '', '', 1),
(743, 'banner_1', -1, 'value', '', '', 0),
(744, 'banner_1', -1, 'field_1', '', '', 1),
(745, 'banner_1', -1, 'field_2', '', '', 1),
(746, 'banner_1', -1, 'field_3', '', '', 1),
(747, 'banner_1', -1, 'field_4', '', '', 1),
(748, 'banner_1', -1, 'checkbox', '', '', 1),
(749, 'banner_1', -1, 'image1', '', '', 1),
(750, 'banner_1', -1, 'image2', '', '', 1),
(760, 'banner_2', -1, 'name', '', '', 0),
(761, 'banner_2', -1, 'value', '', '', 1),
(762, 'banner_2', -1, 'field_1', '', '', 1),
(763, 'banner_2', -1, 'field_2', '', '', 1),
(764, 'banner_2', -1, 'field_3', '', '', 1),
(765, 'banner_2', -1, 'field_4', '', '', 1),
(766, 'banner_2', -1, 'checkbox', '', '', 1),
(767, 'banner_2', -1, 'image1', '', '', 1),
(768, 'banner_2', -1, 'image2', '', '', 1),
(778, 'banner_3', -1, 'name', '', '', 1),
(779, 'banner_3', -1, 'value', '', '', 1),
(780, 'banner_3', -1, 'field_1', '', '', 0),
(781, 'banner_3', -1, 'field_2', '', '', 1),
(782, 'banner_3', -1, 'field_3', '', '', 1),
(783, 'banner_3', -1, 'field_4', '', '', 1),
(784, 'banner_3', -1, 'checkbox', '', '', 1),
(785, 'banner_3', -1, 'image1', '', '', 1),
(786, 'banner_3', -1, 'image2', '', '', 1),
(845, 'articles', -1, 'categories', '', '', 0),
(846, 'products', -1, 'categories', '', '', 1),
(847, 'articles', -1, 'tags', '', '', 0),
(925, 'news', -1, 'date', '', '', 1),
(938, 'news', -1, 'checkbox', '', '', 0),
(940, 'news', -1, 'background', '', '', 0),
(1015, 'subsections', -1, 'id_sect', '', '', 1),
(1016, 'subsections', -1, 'name', '', '', 1),
(1017, 'subsections', -1, 'title', '', '', 1),
(1018, 'subsections', -1, 'keywords', '', '', 1),
(1019, 'subsections', -1, 'description', '', '', 1),
(1020, 'subsections', -1, 'url', '', '', 1),
(1021, 'subsections', -1, 'value', '', '', 1),
(1022, 'subsections', -1, 'value1', '', '', 1),
(1023, 'subsections', -1, 'value2', '', '', 1),
(1024, 'subsections', -1, 'value3', '', '', 0),
(1025, 'subsections', -1, 'field_1', '', '', 1),
(1026, 'subsections', -1, 'field_2', '', '', 1),
(1027, 'subsections', -1, 'field_3', '', '', 1),
(1028, 'subsections', -1, 'field_4', '', '', 1),
(1029, 'subsections', -1, 'checkbox', '', '', 1),
(1030, 'subsections', -1, 'thumbnail', '', '', 1),
(1031, 'subsections', -1, 'background', '', '', 1),
(1032, 'subsections', -1, 'image1', '', '', 1),
(1033, 'subsections', -1, 'image2', '', '', 1),
(1168, 'product_catsTranslate', -1, 'field_2', '', '', 0),
(1169, 'product_catsTranslate', -1, 'field_1', '', '', 0),
(1170, 'product_catsTranslate', -1, 'value_2', '', '', 0),
(1171, 'product_catsTranslate', -1, 'value_1', 'Контент', 'ckeditor', 1),
(1172, 'product_catsTranslate', -1, 'description', '', '', 1),
(1173, 'product_catsTranslate', -1, 'keywords', '', '', 1),
(1174, 'product_catsTranslate', -1, 'title', '', '', 1),
(1175, 'product_catsTranslate', -1, 'name', '', '', 1),
(1176, 'productsTranslate', -1, 'name', '', '', 1),
(1177, 'productsTranslate', -1, 'title', '', '', 1),
(1178, 'productsTranslate', -1, 'keywords', '', '', 1),
(1179, 'productsTranslate', -1, 'description', '', '', 1),
(1180, 'productsTranslate', -1, 'value_1', 'Контент', 'ckeditor', 1),
(1181, 'productsTranslate', -1, 'value_2', '', '', 0),
(1182, 'productsTranslate', -1, 'field_1', '', '', 0),
(1183, 'productsTranslate', -1, 'field_2', '', '', 0),
(1184, 'productsTranslate', -1, 'value_3', '', '', 0),
(1185, 'productsTranslate', -1, 'value_4', '', '', 0),
(1186, 'productsTranslate', -1, 'field_3', '', '', 0),
(1187, 'productsTranslate', -1, 'field_4', '', '', 0),
(1188, 'newsTranslate', -1, 'field_4', '', '', 0),
(1189, 'newsTranslate', -1, 'field_3', '', '', 0),
(1190, 'newsTranslate', -1, 'value_4', '', '', 0),
(1191, 'newsTranslate', -1, 'value_3', '', '', 0),
(1192, 'newsTranslate', -1, 'field_2', '', '', 0),
(1193, 'newsTranslate', -1, 'field_1', '', '', 0),
(1194, 'newsTranslate', -1, 'value_2', '', '', 0),
(1195, 'newsTranslate', -1, 'value_1', '', 'ckeditor', 1),
(1196, 'newsTranslate', -1, 'description', '', '', 1),
(1197, 'newsTranslate', -1, 'keywords', '', '', 1),
(1198, 'newsTranslate', -1, 'title', '', '', 1),
(1199, 'newsTranslate', -1, 'name', '', '', 1),
(1200, 'news', -1, 'value_4', '', '', 0),
(1511, 'slider_1Translate', -1, 'name', 'Имя', '', 1),
(1512, 'slider_1Translate', -1, 'value_1', 'Текст', 'ckeditor', 1),
(1513, 'slider_1Translate', -1, 'field_1', 'Главная ссылка', '', 0),
(1514, 'slider_1Translate', -1, 'field_2', 'Ссылка 1', '', 0),
(1515, 'slider_1Translate', -1, 'field_3', 'Ссылка 2', '', 0),
(1516, 'slider_1Translate', -1, 'field_4', 'Ссылка 3', '', 0),
(1518, 'slider_1Translate', -1, 'field_5', 'Текст ссылки 1', '', 1),
(1519, 'slider_1Translate', -1, 'field_6', 'Текст ссылки 2', '', 1),
(1520, 'slider_1Translate', -1, 'field_7', 'Текст ссылки 3', '', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `slider_1`
--

CREATE TABLE `slider_1` (
  `id` int(11) NOT NULL,
  `value` text NOT NULL,
  `field_1` varchar(255) NOT NULL,
  `field_2` varchar(255) NOT NULL,
  `field_3` varchar(255) NOT NULL,
  `field_4` varchar(255) NOT NULL,
  `checkbox` tinyint(4) NOT NULL,
  `image1` varchar(255) NOT NULL,
  `image2` varchar(255) NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `slider_1Translate`
--

CREATE TABLE `slider_1Translate` (
  `id` int(11) NOT NULL,
  `id_slider_1` int(11) NOT NULL,
  `lang` varchar(255) CHARACTER SET utf8 NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `value_1` text CHARACTER SET utf8 NOT NULL,
  `field_1` varchar(255) CHARACTER SET utf8 NOT NULL,
  `field_2` varchar(255) CHARACTER SET utf8 NOT NULL,
  `field_3` varchar(255) CHARACTER SET utf8 NOT NULL,
  `field_4` varchar(255) CHARACTER SET utf8 NOT NULL,
  `field_5` varchar(255) CHARACTER SET utf8 NOT NULL,
  `field_6` varchar(255) CHARACTER SET utf8 NOT NULL,
  `field_7` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `slider_2`
--

CREATE TABLE `slider_2` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `field_1` varchar(255) NOT NULL,
  `field_2` varchar(255) NOT NULL,
  `field_3` varchar(255) NOT NULL,
  `field_4` varchar(255) NOT NULL,
  `checkbox` tinyint(4) NOT NULL,
  `image1` varchar(255) NOT NULL,
  `image2` varchar(255) NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `slider_3`
--

CREATE TABLE `slider_3` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `field_1` varchar(255) NOT NULL,
  `field_2` varchar(255) NOT NULL,
  `field_3` varchar(255) NOT NULL,
  `field_4` varchar(255) NOT NULL,
  `checkbox` tinyint(4) NOT NULL,
  `image1` varchar(255) NOT NULL,
  `image2` varchar(255) NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `field_1` varchar(255) NOT NULL,
  `field_2` varchar(255) NOT NULL,
  `field_3` varchar(255) NOT NULL,
  `field_4` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `subsections`
--

CREATE TABLE `subsections` (
  `id` int(11) NOT NULL,
  `id_sect` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `value_1` text NOT NULL,
  `value_2` text NOT NULL,
  `value_3` text NOT NULL,
  `value_4` text NOT NULL,
  `field_1` varchar(255) NOT NULL,
  `field_2` varchar(255) NOT NULL,
  `field_3` varchar(255) NOT NULL,
  `field_4` varchar(255) NOT NULL,
  `checkbox` int(11) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `background` varchar(255) NOT NULL,
  `image1` varchar(255) NOT NULL,
  `image2` varchar(255) NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `subsectionsTranslate`
--

CREATE TABLE `subsectionsTranslate` (
  `id` int(11) NOT NULL,
  `id_subsection` int(11) NOT NULL,
  `lang` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `value_1` text NOT NULL,
  `value_2` text NOT NULL,
  `value_3` text NOT NULL,
  `value_4` text NOT NULL,
  `field_1` varchar(255) NOT NULL,
  `field_2` varchar(255) NOT NULL,
  `field_3` varchar(255) NOT NULL,
  `field_4` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `value` text NOT NULL,
  `field_1` varchar(255) NOT NULL,
  `field_2` varchar(255) NOT NULL,
  `field_3` varchar(255) NOT NULL,
  `field_4` varchar(255) NOT NULL,
  `checkbox` tinyint(4) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `login` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `last_login` datetime NOT NULL,
  `last_activity` datetime NOT NULL,
  `admin_mail` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id_user`, `login`, `password`, `name`, `last_login`, `last_activity`, `admin_mail`, `status`) VALUES
(1, 'dline', '202cb962ac59075b964b07152d234b70', NULL, '2017-10-25 11:19:43', '2017-10-25 11:19:43', '1@1.com', 1),
(2, 'admin', '202cb962ac59075b964b07152d234b70', NULL, '2017-10-23 11:44:08', '2017-10-23 11:44:08', '11@11.com', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `article_cats`
--
ALTER TABLE `article_cats`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `article_comments`
--
ALTER TABLE `article_comments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `article_in_cats`
--
ALTER TABLE `article_in_cats`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `article_tags`
--
ALTER TABLE `article_tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `banner_1`
--
ALTER TABLE `banner_1`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `banner_2`
--
ALTER TABLE `banner_2`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `banner_3`
--
ALTER TABLE `banner_3`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `gallery_cats`
--
ALTER TABLE `gallery_cats`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `gallery_images`
--
ALTER TABLE `gallery_images`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `newsTranslate`
--
ALTER TABLE `newsTranslate`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `productsTranslate`
--
ALTER TABLE `productsTranslate`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `product_cats`
--
ALTER TABLE `product_cats`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `product_catsTranslate`
--
ALTER TABLE `product_catsTranslate`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `product_in_cats`
--
ALTER TABLE `product_in_cats`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `sectionsTranslate`
--
ALTER TABLE `sectionsTranslate`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `slider_1`
--
ALTER TABLE `slider_1`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `slider_1Translate`
--
ALTER TABLE `slider_1Translate`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `slider_2`
--
ALTER TABLE `slider_2`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `slider_3`
--
ALTER TABLE `slider_3`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `subsections`
--
ALTER TABLE `subsections`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `subsectionsTranslate`
--
ALTER TABLE `subsectionsTranslate`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `article_cats`
--
ALTER TABLE `article_cats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `article_comments`
--
ALTER TABLE `article_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `article_in_cats`
--
ALTER TABLE `article_in_cats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `article_tags`
--
ALTER TABLE `article_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `banner_1`
--
ALTER TABLE `banner_1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `banner_2`
--
ALTER TABLE `banner_2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `banner_3`
--
ALTER TABLE `banner_3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `gallery_cats`
--
ALTER TABLE `gallery_cats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `gallery_images`
--
ALTER TABLE `gallery_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `newsTranslate`
--
ALTER TABLE `newsTranslate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `productsTranslate`
--
ALTER TABLE `productsTranslate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `product_cats`
--
ALTER TABLE `product_cats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `product_catsTranslate`
--
ALTER TABLE `product_catsTranslate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `product_in_cats`
--
ALTER TABLE `product_in_cats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `sectionsTranslate`
--
ALTER TABLE `sectionsTranslate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1521;
--
-- AUTO_INCREMENT для таблицы `slider_1`
--
ALTER TABLE `slider_1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `slider_1Translate`
--
ALTER TABLE `slider_1Translate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `slider_2`
--
ALTER TABLE `slider_2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `slider_3`
--
ALTER TABLE `slider_3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `subsections`
--
ALTER TABLE `subsections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `subsectionsTranslate`
--
ALTER TABLE `subsectionsTranslate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
