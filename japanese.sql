-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2014 at 05:59 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `japanese`
--

-- --------------------------------------------------------

--
-- Table structure for table `grammar`
--

CREATE TABLE IF NOT EXISTS `grammar` (
  `g_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `g_title` varchar(100) CHARACTER SET utf8 NOT NULL,
  `g_mean` varchar(100) CHARACTER SET utf8 NOT NULL,
  `g_explain` text CHARACTER SET utf8 NOT NULL,
  `g_note` text CHARACTER SET utf8 NOT NULL,
  `g_example_jp` text CHARACTER SET utf8 NOT NULL,
  `g_example_en` text CHARACTER SET utf8 NOT NULL,
  `g_example_vi` text CHARACTER SET utf8 NOT NULL,
  `g_lesson_id` int(4) NOT NULL,
  PRIMARY KEY (`g_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `grammar`
--

INSERT INTO `grammar` (`g_id`, `g_title`, `g_mean`, `g_explain`, `g_note`, `g_example_jp`, `g_example_en`, `g_example_vi`, `g_lesson_id`) VALUES
(5, '~は ~です', '~ la` ~', 'Dùng để nói tên, nghề nghiệp, quốc tịch ( tương tự như động từ TO BE của tiếng Anh. \r\n* Đây là mẫu câu khẳng định ', 'Với mẫu câu này ta dùng trợ từ は<ha> (đọc là <wa>, chứ không phải là <ha> trong bảng chữ - đây là cấu trúc câu-.) Từ chỗ này về sau sẽ viết là <wa> luôn, các bạn cứ hiểu khi viết sẽ là viết chữ <ha> trong bảng chữ ', 'わたし　は　マイク　ミラー　です. | これはペンです。 | それはノートです。', 'I am Michael Miler. | This is pen | That is note.', 'Tôi là Michael Miler | Cái này là cái bút | Cái đó là cuốn vở.', 1),
(3, '~は ~です', '~ la` ~', 'Dùng để nói tên, nghề nghiệp, quốc tịch ( tương tự như động từ TO BE của tiếng Anh. \r\n* Đây là mẫu câu khẳng định ', 'Với mẫu câu này ta dùng trợ từ は<ha> (đọc là <wa>, chứ không phải là <ha> trong bảng chữ - đây là cấu trúc câu-.) Từ chỗ này về sau sẽ viết là <wa> luôn, các bạn cứ hiểu khi viết sẽ là viết chữ <ha> trong bảng chữ ', 'わたし　は　マイク　ミラー　です. | これはペンです。 | それはノートです。', 'I am Michael Miler. | This is pen | That is note.', 'Tôi là Michael Miler | Cái này là cái bút | Cái đó là cuốn vở.', 1),
(4, '~は じゃ/ではありません。', '(chủ ngữ) không phải là ~', 'Cách dùng tương tự như cấu trúc khẳng định. ', 'Mẫu câu vẫn dùng trợ từ は<wa> nhưng với ý nghĩa phủ định. Ở mẫu câu này ta có thể dùng　じゃ<ja> hoặc　では<dewa> đi trước　ありません<arimasen>　đều được. ', 'サントスさん　は　がくせい　じゃ (では) ありません.', 'Santos isn''t student.', 'Anh Santose không phải là sinh viên', 2),
(6, '~は ~です- coppy', '~ la` ~', 'Dùng để nói tên, nghề nghiệp, quốc tịch ( tương tự như động từ TO BE của tiếng Anh. \r\n* Đây là mẫu câu khẳng định ', 'Với mẫu câu này ta dùng trợ từ は<ha> (đọc là <wa>, chứ không phải là <ha> trong bảng chữ - đây là cấu trúc câu-.) Từ chỗ này về sau sẽ viết là <wa> luôn, các bạn cứ hiểu khi viết sẽ là viết chữ <ha> trong bảng chữ ', 'わたし　は　マイク　ミラー　です. | これはペンです。 | それはノートです。', 'I am Michael Miler. | This is pen | That is note.', 'Tôi là Michael Miler | Cái này là cái bút | Cái đó là cuốn vở.', 1),
(7, '~は じゃ/ではありません。 - coppy', '(chủ ngữ) không phải là ~', 'Cách dùng tương tự như cấu trúc khẳng định. ', 'Mẫu câu vẫn dùng trợ từ は<wa> nhưng với ý nghĩa phủ định. Ở mẫu câu này ta có thể dùng　じゃ<ja> hoặc　では<dewa> đi trước　ありません<arimasen>　đều được. ', 'サントスさん　は　がくせい　じゃ (では) ありません.', 'Santos isn''t student.', 'Anh Santose không phải là sinh viên', 2),
(8, '', '', '', '', 'fsdf | ', ' | ', ' | ', 0),
(9, '', '', '', '', 'f | ', ' | ', 'fas | ', 0),
(10, 'test', 'a', '<p>\r\n	sdf</p>\r\n', '<p>\r\n	sdf</p>\r\n', 'a | b | c', '... | b | ...', 'a | ... | ...', 2),
(11, 'fsdf', 'fsd', '<p>\r\n	fsd</p>\r\n', '<p>\r\n	fsd</p>\r\n', 't | b | c', '...  c |   ...  cc |   ...c', 'c |   ...  cc |   ...c', 4);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'Administrator', 'Những thành viên trong ban quản trị website-Admin'),
(2, 'Manager', 'Nhóm user quản lý website'),
(3, 'User', 'Những user là thành viên của website');

-- --------------------------------------------------------

--
-- Table structure for table `kanji`
--

CREATE TABLE IF NOT EXISTS `kanji` (
  `k_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `k_kanji` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `k_mean_kanji` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `k_mean_en` varchar(100) CHARACTER SET utf8 NOT NULL,
  `k_mean_vi` varchar(100) CHARACTER SET utf8 NOT NULL,
  `k_onyomi` varchar(100) CHARACTER SET utf8 NOT NULL,
  `k_kunyomi` varchar(100) CHARACTER SET utf8 NOT NULL,
  `k_remember` varchar(100) CHARACTER SET utf8 NOT NULL,
  `k_on_ex` varchar(100) CHARACTER SET utf8 NOT NULL,
  `k_kun_ex` varchar(100) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`k_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `kanji`
--

INSERT INTO `kanji` (`k_id`, `k_kanji`, `k_mean_kanji`, `k_mean_en`, `k_mean_vi`, `k_onyomi`, `k_kunyomi`, `k_remember`, `k_on_ex`, `k_kun_ex`) VALUES
(1, '学', 'HOC', 'study, learn', 'hoc tap', 'ガク;シ', 'まな。ぶ;ふえ。る;おり。る', '				Dua be ngoi duoi mai hien hoc bai\r\nDua be ngoi duoi mai hien hoc baiDua be ngoi duoi mai hien ho', '学校:がっこう:truong hoc|学生:がくせい:hoc sinh|学費:がくひ:Hoc phi', '学ぶ:まなぶ:hoc|学ぶ:まなぶ:hoc|学ぶ:まなぶ:hoc'),
(21, '学', 'HOC', 'study, learn', 'hoc tap', 'ガク;シ', 'まな。ぶ;ふえ。る;おり。る', '				Dua be ngoi duoi mai hien hoc bai\r\nDua be ngoi duoi mai hien hoc baiDua be ngoi duoi mai hien ho', '学校:がっこう:truong hoc|学生:がくせい:hoc sinh|学費:がくひ:Hoc phi', '学ぶ:まなぶ:hoc|学ぶ:まなぶ:hoc|学ぶ:まなぶ:hoc'),
(20, '学', 'HOC', 'study, learn', 'hoc tap', 'ガク;シ', 'まな。ぶ;ふえ。る;おり。る', '				Dua be ngoi duoi mai hien hoc bai\r\nDua be ngoi duoi mai hien hoc baiDua be ngoi duoi mai hien ho', '学校:がっこう:truong hoc|学生:がくせい:hoc sinh|学費:がくひ:Hoc phi', '学ぶ:まなぶ:hoc|学ぶ:まなぶ:hoc|学ぶ:まなぶ:hoc'),
(19, '学', 'HOC', 'study, learn', 'hoc tap', 'ガク;シ', 'まな。ぶ;ふえ。る;おり。る', '				Dua be ngoi duoi mai hien hoc bai\r\nDua be ngoi duoi mai hien hoc baiDua be ngoi duoi mai hien ho', '学校:がっこう:truong hoc|学生:がくせい:hoc sinh|学費:がくひ:Hoc phi', '学ぶ:まなぶ:hoc|学ぶ:まなぶ:hoc|学ぶ:まなぶ:hoc'),
(22, '学', 'HOC', 'study, learn', 'hoc tap', 'ガク;シ', 'まな。ぶ;ふえ。る;おり。る', '				Dua be ngoi duoi mai hien hoc bai\r\nDua be ngoi duoi mai hien hoc baiDua be ngoi duoi mai hien ho', '学校:がっこう:truong hoc|学生:がくせい:hoc sinh|学費:がくひ:Hoc phi', '学ぶ:まなぶ:hoc|学ぶ:まなぶ:hoc|学ぶ:まなぶ:hoc'),
(23, '学', 'HOC', 'study, learn', 'hoc tap', 'ガク;シ', 'まな。ぶ;ふえ。る;おり。る', '				Dua be ngoi duoi mai hien hoc bai\r\nDua be ngoi duoi mai hien hoc baiDua be ngoi duoi mai hien ho', '学校:がっこう:truong hoc|学生:がくせい:hoc sinh|学費:がくひ:Hoc phi', '学ぶ:まなぶ:hoc|学ぶ:まなぶ:hoc|学ぶ:まなぶ:hoc');

-- --------------------------------------------------------

--
-- Table structure for table `lesson`
--

CREATE TABLE IF NOT EXISTS `lesson` (
  `le_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `le_title` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`le_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `lesson`
--

INSERT INTO `lesson` (`le_id`, `le_title`) VALUES
(1, '第１課：初めまして'),
(2, '第２課：ほんの気持ちです'),
(3, '第３課：これをください'),
(4, '第４課：そちらは何時から何時までですか'),
(7, '第５課：甲子園へ行きますか'),
(8, '第６課：一緒に行きませんか'),
(9, '第７課：ごめんください'),
(10, '第８課：そろそろ失れします'),
(11, '第９課：残念ですね'),
(12, '第１０課：チリンースはありますか'),
(13, '第11課：これ、お願いします'),
(14, '第１２課：お祭りはどうでしたか'),
(15, '第１３課：別々にお願いします'),
(16, '梅田まで行ってください'),
(17, '第１５課：ご家族は？'),
(18, '第１６課：使い方を教えてください'),
(19, '第１７課：どうしましたか'),
(20, '第１８課：趣味は何ですか'),
(21, '第19課：ダイエットは明日からします'),
(22, '第20課：夏休みはどうするの？'),
(23, '第21課：私もそう思いいます'),
(24, 'どんなアパートがいいですか'),
(25, '第23課：どうやって行きますか'),
(26, '第24課：手伝ってくれますか'),
(27, '第25課：いろいろお世話になりました');

-- --------------------------------------------------------

--
-- Table structure for table `listening`
--

CREATE TABLE IF NOT EXISTS `listening` (
  `li_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `li_lesson_id` int(11) NOT NULL,
  `li_title` varchar(100) CHARACTER SET utf8 NOT NULL,
  `li_script_jp` text CHARACTER SET utf8 NOT NULL,
  `li_script_en` text CHARACTER SET utf8 NOT NULL,
  `li_script_vi` text CHARACTER SET utf8 NOT NULL,
  `li_track` varchar(100) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`li_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `listening`
--

INSERT INTO `listening` (`li_id`, `li_lesson_id`, `li_title`, `li_script_jp`, `li_script_en`, `li_script_vi`, `li_track`) VALUES
(42, 1, '初めまして', '<p>\r\n	&nbsp;</p>\r\n<p>\r\n	佐藤：おはようございます。</p>\r\n<p>\r\n	山田：おはようございます。</p>\r\n<p>\r\n	　　　佐藤さん、こちらは　マイク。ミラーさんです。</p>\r\n<p>\r\n	ミラー：初めまして</p>\r\n<p>\r\n	　　　マイク。ミラーです。</p>\r\n<p>\r\n	　　　アメリカから来ました。</p>\r\n<p>\r\n	　　　どうぞ　よろしく。</p>\r\n<p>\r\n	佐藤：佐藤恵子です。</p>\r\n<p>\r\n	　　　どうぞよろしく</p>\r\n<p>\r\n	&nbsp;</p>\r\n', '', '', 'Dai 1 ka_Dai 1 ka.mp3');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `q_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `q_question` varchar(100) CHARACTER SET utf8 NOT NULL,
  `q_anwser1` varchar(100) CHARACTER SET utf8 NOT NULL,
  `q_anwser2` varchar(100) CHARACTER SET utf8 NOT NULL,
  `q_anwser3` varchar(100) CHARACTER SET utf8 NOT NULL,
  `q_anwser4` varchar(100) CHARACTER SET utf8 NOT NULL,
  `q_correct` int(11) NOT NULL,
  `q_type` int(11) NOT NULL,
  PRIMARY KEY (`q_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`q_id`, `q_question`, `q_anwser1`, `q_anwser2`, `q_anwser3`, `q_anwser4`, `q_correct`, `q_type`) VALUES
(1, '勉強', 'べんきょう', 'べんきゃ', 'べんきゅう', 'べんとう', 1, 1),
(12, 'sadsa', 'sadsa', 'sad', 'sad', 'sa', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `reading`
--

CREATE TABLE IF NOT EXISTS `reading` (
  `r_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `r_title` varchar(100) NOT NULL,
  `r_content_jp` text CHARACTER SET utf8 NOT NULL,
  `r_content_en` text CHARACTER SET utf8 NOT NULL,
  `r_content_vi` text CHARACTER SET utf8 NOT NULL,
  `r_lesson_id` int(11) NOT NULL,
  PRIMARY KEY (`r_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `reading`
--

INSERT INTO `reading` (`r_id`, `r_title`, `r_content_jp`, `r_content_en`, `r_content_vi`, `r_lesson_id`) VALUES
(8, 'toi la toi', '<p>\r\n	sdfsd</p>\r\n', '<p>\r\n	dsf</p>\r\n', '<p>\r\n	fsd</p>\r\n', 3),
(10, 'trieugiathang', '<p>\r\n	sdfsd</p>\r\n', '<p>\r\n	dsf</p>\r\n', '<p>\r\n	fsd</p>\r\n', 2),
(20, 'em la ai ', '<p>\r\n	fsd</p>\r\n', '', '', 2),
(19, 'sdf', '<p>\r\n	fsd</p>\r\n', '', '', 4),
(14, 'dsf', '<p>\r\n	sdfds</p>\r\n', '', '', 2),
(15, 'faf', '<p>\r\n	sdfsd</p>\r\n', '<p>\r\n	dsf</p>\r\n', '<p>\r\n	fsd</p>\r\n', 4),
(16, 'faf', '<p>\r\n	sdfsd</p>\r\n', '<p>\r\n	dsf</p>\r\n', '<p>\r\n	fsd</p>\r\n', 2),
(17, 'a', '<p>\r\n	sdfsd</p>\r\n', '<p>\r\n	dsf</p>\r\n', '<p>\r\n	fsd</p>\r\n', 2),
(18, 'traithaibinh', '<p>\r\n	sdfsd</p>\r\n', '<p>\r\n	dsf</p>\r\n', '<p>\r\n	fsd</p>\r\n', 3),
(6, 'b', '日本では　子どもの　ための　まんがから　大人も　楽しめる　まんがまで、いろいろな　まんがが　売られて　います。絵が　じょうずだと　いう　ことも　ありますが、話が　おもしろいのです。「この　後　どうなるのだろう。」と　思うと、とちゅうで　止める　ことが　できなく　なるほどです.\r\n人気が　ある　まんがから　映画や　テレビの　ばんぐみが　生まれる　ことも　あります。今では「まんが」は「ＭＡＮＧＡ」と　なって　世界中で　日本の　まんがが　読まれて　います。', 'lyric', 'Ở Nhật truyện tranh được bày bán rất nhiều, từ những cuốn truyện tranh dành cho trẻ em đến những cuốn truyện tranh ngay cả người lớn cũng thích.Cũng có khi là do tranh đẹp, cũng có khi là do cốt truyện nó hay.\r\nĐến mức mà mỗi khi nghĩ rằng "Đoạn sau sẽ ra sao nhỉ", thì tự dưng không thể ngưng giữa chừng được.\r\nCòn có cả những kênh truyền hình hay kênh phim được sản xuất ra từ những cuốn truyện tranh đang được yêu thích.\r\nBây giờ, "Truyện tranh" đã trở thành "Manga" và truyện tranh Nhật Bản đã được đọc trên khắp thế giới.', 2),
(7, 'a', '日本では　子どもの　ための　まんがから　大人も　楽しめる　まんがまで、いろいろな　まんがが　売られて　います。絵が　じょうずだと　いう　ことも　ありますが、話が　おもしろいのです。「この　後　どうなるのだろう。」と　思うと、とちゅうで　止める　ことが　できなく　なるほどです.\r\n人気が　ある　まんがから　映画や　テレビの　ばんぐみが　生まれる　ことも　あります。今では「まんが」は「ＭＡＮＧＡ」と　なって　世界中で　日本の　まんがが　読まれて　います。', 'lyric', 'Ở Nhật truyện tranh được bày bán rất nhiều, từ những cuốn truyện tranh dành cho trẻ em đến những cuốn truyện tranh ngay cả người lớn cũng thích.Cũng có khi là do tranh đẹp, cũng có khi là do cốt truyện nó hay.\r\nĐến mức mà mỗi khi nghĩ rằng "Đoạn sau sẽ ra sao nhỉ", thì tự dưng không thể ngưng giữa chừng được.\r\nCòn có cả những kênh truyền hình hay kênh phim được sản xuất ra từ những cuốn truyện tranh đang được yêu thích.\r\nBây giờ, "Truyện tranh" đã trở thành "Manga" và truyện tranh Nhật Bản đã được đọc trên khắp thế giới.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(50) NOT NULL,
  `time` int(11) NOT NULL,
  `token` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `client` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=125 ;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `ip`, `time`, `token`, `user_id`, `client`) VALUES
(124, '::1', 1396276958, '7a685d9edd95508471a9d3d6fcace432', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `testtype`
--

CREATE TABLE IF NOT EXISTS `testtype` (
  `t_id` int(11) NOT NULL AUTO_INCREMENT,
  `t_type` varchar(100) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`t_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `testtype`
--

INSERT INTO `testtype` (`t_id`, `t_type`) VALUES
(1, 'Vocabulary'),
(2, 'Reading'),
(3, 'Kanji-Mean Kanji'),
(4, 'Kanji-Mean EN'),
(5, 'Kanji-Mean Vi'),
(6, 'Kanji-Onyomi'),
(7, 'Kanji-Kunyomi');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `group_id` int(11) NOT NULL,
  `block` tinyint(100) NOT NULL,
  `actived` tinyint(1) NOT NULL,
  `registerDate` datetime NOT NULL,
  `lastvisitDate` datetime NOT NULL,
  `hash` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `email`, `group_id`, `block`, `actived`, `registerDate`, `lastvisitDate`, `hash`) VALUES
(1, 'Trieu ', 'admin', '96e79218965eb72c92a549dd5a330112', 'sfsfffffdfds@gmail.com', 1, 0, 1, '2012-02-01 22:00:14', '2014-03-31 16:42:33', ''),
(17, 'teo', 'teo', 'b0baee9d279d34fa1dfd71aadb908c3f', 'sdfdsfsd', 1, 0, 1, '2014-03-26 00:00:00', '2014-03-13 00:00:00', 'fsdfsdfsd');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE IF NOT EXISTS `user_info` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `birthday` date NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `ssn` int(11) NOT NULL,
  `occupation` varchar(100) NOT NULL,
  `company` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`id`, `user_id`, `firstname`, `lastname`, `gender`, `birthday`, `mobile`, `ssn`, `occupation`, `company`, `address`, `city`, `country`) VALUES
(1, 1, 'Triệu Gia ', 'Thắng', 1, '1991-06-17', '0983940965', 151809941, 'Sinh viên', 'hcmutrans', '532D XVNT,P.25,quận Bình Thạnh', 'Tphcm', 'Việt Nam');

-- --------------------------------------------------------

--
-- Table structure for table `vocabulary`
--

CREATE TABLE IF NOT EXISTS `vocabulary` (
  `v_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `v_word` varchar(100) CHARACTER SET utf8 NOT NULL,
  `v_hiragana` varchar(100) CHARACTER SET utf8 NOT NULL,
  `v_mean_kanji` varchar(100) CHARACTER SET utf8 NOT NULL,
  `v_mean_en` varchar(100) CHARACTER SET utf8 NOT NULL,
  `v_mean_vi` varchar(100) CHARACTER SET utf8 NOT NULL,
  `v_lesson_id` int(11) NOT NULL,
  `v_note` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`v_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=71 ;

--
-- Dumping data for table `vocabulary`
--

INSERT INTO `vocabulary` (`v_id`, `v_word`, `v_hiragana`, `v_mean_kanji`, `v_mean_en`, `v_mean_vi`, `v_lesson_id`, `v_note`) VALUES
(63, '', '～さん', '', '', 'Ông ~, Bà ~, Anh ~, Chị ~,…..(đi kèm theo tên, dùng để gọi tên người khác một cách lịch sự)', 1, '						'),
(64, '', 'Mai さん', '', '', '(cô/chị/bạn) Mai', 1, '								'),
(65, '', '～ちゃん', '', '', '(đi kèm theo tên, dùng để gọi các bé gái thay cho さん)', 1, '								'),
(66, '', 'Linh ちゃん', '', '', 'Bé Linh', 1, '								'),
(67, '', '～くん', '', '', 'đi kèm theo tên, dùng để gọi các bé trai thay cho さん)', 1, '								'),
(68, '', 'しんくん', '', '', 'Bé Shin', 1, '								'),
(69, '', '～じん', '', '', '(đi kèm theo tên nước ) người nước ~', 1, '								'),
(70, 'ベトナム人', 'ベトナムじん ', '', '', 'Người Việt Nam', 1, '								'),
(57, '私たち', 'わたしたち', '', 'we', 'Chúng tôi, chúng ta…(ngôi thứ nhất số nhiều)', 1, '								'),
(58, '', 'あなた', '', '', 'Bạn, ông, bà, anh, chị, cô, chú (ngôi thứ hai số ít)', 1, '								'),
(59, '', 'あなたがた', '', '', 'Các bạn, các anh, các chị…(ngôi thứ hai số nhiều)', 1, '								'),
(60, '人', 'ひと', 'NHÂN', 'people', 'Người', 1, '								'),
(61, '', 'あのひと', '', '', 'Người ấy, người kia', 1, '								'),
(62, '皆さん', 'みなさん', '', '', 'Các bạn, các anh, các chị, mọi người…', 1, '								'),
(56, '私', 'わたし', '', 'I', 'Tôi (ngôi thứ nhất số ít)', 1, '								');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
