-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 23, 2019 at 05:08 AM
-- Server version: 5.0.89-community-nt
-- PHP Version: 5.5.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `odf_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(11) NOT NULL auto_increment,
  `admin_email` varchar(255) character set utf8 collate utf8_bin NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `education` varchar(255) NOT NULL,
  `password` varchar(255) character set utf8 collate utf8_bin NOT NULL,
  `invitation_code` text character set utf8 collate utf8_bin NOT NULL,
  `admin_pic` varchar(255) NOT NULL,
  `ad_pic_src` varchar(255) NOT NULL,
  `employment` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `admin_date_time` datetime NOT NULL,
  `validation_code` text character set utf8 collate utf8_bin NOT NULL,
  `active` tinyint(4) NOT NULL default '0',
  `approve` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`admin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_email`, `first_name`, `last_name`, `education`, `password`, `invitation_code`, `admin_pic`, `ad_pic_src`, `employment`, `address`, `admin_date_time`, `validation_code`, `active`, `approve`) VALUES
(1, 'subratadasbca@gmail.com', 'Subrata', 'Das', 'MCA', '827ccb0eea8a706c4c34a16891f84e7b', '12345', 'ssssssssxcxcss.jpg', 'images/ProfilePicture/ssssssssxcxcss.jpg', 'Student of tha year', 'Purunda', '2018-09-05 20:42:27', '0', 1, 1),
(2, 'subratadas606@gmail.com', 'Subrata', 'Das', 'MCA', '827ccb0eea8a706c4c34a16891f84e7b', '1', '', '', '', '', '2018-12-03 00:22:08', '0', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin_request`
--

CREATE TABLE IF NOT EXISTS `admin_request` (
  `admin_id` int(11) NOT NULL auto_increment,
  `admin_email` varchar(255) character set utf8 collate utf8_bin NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `education` varchar(255) NOT NULL,
  `password` varchar(255) character set utf8 collate utf8_bin NOT NULL,
  `invitation_code` text character set utf8 collate utf8_bin NOT NULL,
  `employment` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `admin_date_time` datetime NOT NULL,
  `validation_code` text character set utf8 collate utf8_bin NOT NULL,
  `active` tinyint(4) NOT NULL default '0',
  `approve` tinyint(4) NOT NULL default '4',
  PRIMARY KEY  (`admin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin_request`
--

INSERT INTO `admin_request` (`admin_id`, `admin_email`, `first_name`, `last_name`, `education`, `password`, `invitation_code`, `employment`, `address`, `admin_date_time`, `validation_code`, `active`, `approve`) VALUES
(1, 'debabratadas@gmail.com', 'Debabrata ', 'Das', 'MCA', '', 'a24abc4c2ea337dd373892cc3c2f66f4', '', '', '2018-11-28 04:28:26', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE IF NOT EXISTS `answers` (
  `a_no` int(11) NOT NULL auto_increment,
  `image` varchar(255) NOT NULL,
  `img_src` varchar(255) NOT NULL,
  `pdf` varchar(255) NOT NULL,
  `pdf_src` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL,
  `video_src` varchar(255) NOT NULL,
  `answer` varchar(1000) NOT NULL,
  `a_date_time` datetime NOT NULL,
  `a_user_id` int(11) NOT NULL,
  `q_no` int(11) NOT NULL,
  `a_subject_id` int(11) NOT NULL,
  `a_a` tinyint(4) NOT NULL default '0',
  `a_s` tinyint(4) NOT NULL default '0',
  `a_q` tinyint(4) NOT NULL default '0',
  `user_approve` tinyint(4) NOT NULL default '0',
  `status` varchar(255) NOT NULL,
  PRIMARY KEY  (`a_no`),
  KEY `answers_ibfk_2` (`q_no`),
  KEY `answers_ibfk_3` (`a_user_id`),
  KEY `answers_ibfk_4` (`a_subject_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`a_no`, `image`, `img_src`, `pdf`, `pdf_src`, `video`, `video_src`, `answer`, `a_date_time`, `a_user_id`, `q_no`, `a_subject_id`, `a_a`, `a_s`, `a_q`, `user_approve`, `status`) VALUES
(1, '', 'images/', '', 'pdf/', '', 'videos/', '&lt;p&gt;In Object Oriented Programming, a Class is a blueprint for an object. In fact, classes describe the type of objects, while objects are usable instances of classes. Each Object was built from the same set of blueprints and therefore contains the same components (properties and methods). A class can have any number of properties and methods to access the value of various kinds of methods.&lt;/p&gt;\r\n&lt;p&gt;In real life, similar objects can be grouped based on some criteria. For example: A Ford car and a Toyota car are both Cars, so they can be classified as belonging to the Car class. There may be thousands of other Cars in existence, all of the same make and model. Each Car was built from the same set of blueprints and therefore contains the same components. In object-oriented terms, we can say that your car is an object (instance) of the class known as CAR. You can create different objects using the same class, because a class is just a template, while the objects are concre', '2018-10-11 20:26:21', 4, 5, 6, 0, 1, 1, 1, 'read'),
(2, '', 'images/', '', 'pdf/', '', 'videos/', '&lt;p&gt;Python is a high-level and object-oriented programming language which was developed by Guido Van Rossum in 1991.&lt;/p&gt;\r\n&lt;p&gt;Python provides an easy syntax which makes programming simple and is done in very compact manner. Main aim of Python programming language is to make the code readable.&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p&gt;Some of main benefits of Python are :&lt;/p&gt;\r\n&lt;p&gt;&amp;bull; Python provide a large standard library that manages memory automatically.&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p&gt;&amp;bull; Python is widely used in many companies as it because of its interactive, portable and dynamic nature.&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p&gt;&amp;bull; Python enable users to develop Web services in very easy manner, by invoking components of COBRA.&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p&gt;&amp;bull; Python can execute same byte code on different platforms available&lt;/p&gt;', '2018-10-11 20:27:50', 4, 15, 8, 1, 1, 1, 1, 'read'),
(3, 'what-is-c-3-638.jpg', 'images/what-is-c-3-638.jpg', '', 'pdf/', '', 'videos/', '&lt;p&gt;C is a structured, procedural programming language that has been widely used both for operating systems and applications and that has had a wide following in the academic community. Many versions of UNIX-based operating systems are written in C. C has been standardized as part of the Portable Operating System Interface (POSIX).&lt;/p&gt;\r\n&lt;p&gt;With the increasing popularity of object-oriented programming, C is being rapidly replaced as &quot;the&quot; programming language by C++, a superset of the C language that uses an entirely different set of programming concepts, and by Java, a language similar to but simpler than C++, that was designed for use in distributed networks.&lt;/p&gt;', '2018-10-11 20:36:07', 2, 24, 10, 1, 1, 1, 1, 'read'),
(4, 'slide_3.jpg', 'images/slide_3.jpg', '', 'pdf/', '', 'videos/', '&lt;p&gt;&amp;nbsp;Java is a widely used programming language expressly designed for use in the distributed environment of the internet. It is the most popular programming language for Android smartphone applications and is among the most favored for edge device and internet of things development&lt;/p&gt;', '2018-10-11 20:44:18', 2, 23, 7, 1, 1, 1, 1, 'read'),
(5, 'asa.png', 'images/asa.png', '', 'pdf/', '', 'videos/', '&lt;p&gt;Variables and methods marked static belong to the class rather than to any particular instance of the class. These can be used without having any instances of that class at all. Only the class is sufficient to invoke a static method or access a static variable. A static variable is shared by all the instances of that class i.e only one copy of the static variable is maintained.&lt;/p&gt;', '2018-10-11 20:50:55', 4, 13, 7, 1, 1, 1, 1, 'unread'),
(6, '', 'images/', '', 'pdf/', '', 'videos/', '&lt;p&gt;Flask is a web micro framework for Python based on &amp;ldquo;Werkzeug, Jinja 2 and good intentions&amp;rdquo; BSD licensed. Werkzeug and jingja are two of its dependencies.&lt;br /&gt;&lt;br /&gt;Flask is part of the micro-framework. Which means it will have little to no dependencies on external libraries.&amp;nbsp; It makes the framework light while there is little dependency to update and less security bugs.&lt;/p&gt;', '2018-10-11 20:54:04', 4, 20, 8, 1, 1, 1, 1, 'read'),
(7, '', 'images/', '', 'pdf/', '', 'videos/', '&lt;p&gt;&amp;nbsp;Memory management in Python involves a private heap containing all Python objects and data structures. Interpreter takes care of Python heap and that the programmer has no access to it.&lt;br /&gt;- The allocation of heap space for Python objects is done by Python memory manager. The core API of Python provides some tools for the programmer to code reliable and more robust program.&lt;br /&gt;- Python also has a build-in garbage collector which recycles all the unused memory. When an object is no longer referenced by the program, the heap space it occupies can be freed. The garbage collector determines objects which are no longer referenced by the sprogram frees the occupied memory and make it available to the heap space.&lt;/p&gt;', '2018-10-11 20:58:54', 5, 19, 8, 1, 1, 1, 1, 'read'),
(8, '', 'images/', '', 'pdf/', '', 'videos/', '&lt;p&gt;C is a general-purpose, imperative computer programming language, supporting structured programming, lexical variable scope and recursion, while a static type system prevents many unintended operations.&lt;/p&gt;', '2018-10-11 21:58:46', 1, 24, 10, 1, 1, 1, 1, 'unread'),
(9, '', 'images/', '', 'pdf/', '', 'videos/', '&lt;p&gt;The classes are the most important feature of C++ that leads to Object Oriented programming. Class is a user defined data type, which holds its own data members and member functions, which can be accessed and used by creating instance of that class.&lt;/p&gt;', '2018-10-11 22:00:42', 1, 5, 6, 1, 1, 1, 1, 'unread'),
(10, '', 'images/', '', 'pdf/', '144203_00_02_XR15_know.mp4', 'videos/144203_00_02_XR15_know.mp4', '&lt;p&gt;Java is a programming language that produces software for multiple platforms. When a programmer writes a Java application, the compiled code (known as bytecode) runs on most operating systems (OS), including Windows, Linux and Mac OS. Java derives much of its syntax from the C and C++ programming languages.&lt;/p&gt;\r\n&lt;p&gt;Java was developed in the mid-1990s by James A. Gosling, a former computer scientist with Sun Microsystems.&lt;/p&gt;', '2018-10-11 23:51:10', 1, 23, 7, 1, 1, 1, 1, 'unread'),
(11, 'index.jpg', 'images/index.jpg', '', 'pdf/', '', 'videos/', '&lt;p&gt;An algorithm is a step by step method of solving a problem. It is commonly used for data processing, calculation and other related computer and mathematical operations.&lt;br /&gt;&lt;br /&gt;An algorithm is also used to manipulate data in various ways, such as inserting a new data item, searching for a particular item or sorting an item.&lt;/p&gt;', '2018-10-12 12:09:51', 8, 9, 11, 1, 1, 1, 1, 'unread'),
(12, '', 'images/', '', 'pdf/', '', 'videos/', '&lt;p&gt;gfsdlaklsfgadsjk;h;sadfn&lt;/p&gt;', '2018-10-13 12:42:00', 2, 24, 10, 0, 1, 1, 1, 'unread'),
(13, '', 'images/', '', 'pdf/', '', 'videos/', '&lt;p&gt;dfghghfgdhdfg&lt;/p&gt;', '2019-03-16 15:05:21', 21, 26, 6, 0, 1, 1, 1, 'unread');

-- --------------------------------------------------------

--
-- Table structure for table `answer_view_count`
--

CREATE TABLE IF NOT EXISTS `answer_view_count` (
  `count_ID` int(11) NOT NULL auto_increment,
  `view` tinyint(4) NOT NULL default '0',
  `answer_ID` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  PRIMARY KEY  (`count_ID`),
  KEY `answer_ID` (`answer_ID`),
  KEY `user_ID` (`user_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=51 ;

--
-- Dumping data for table `answer_view_count`
--

INSERT INTO `answer_view_count` (`count_ID`, `view`, `answer_ID`, `user_ID`) VALUES
(1, 1, 1, 2),
(2, 1, 1, 4),
(3, 1, 4, 2),
(4, 1, 1, 1),
(5, 1, 3, 1),
(6, 1, 7, 1),
(7, 1, 7, 2),
(8, 1, 3, 2),
(9, 1, 4, 1),
(10, 1, 8, 1),
(11, 1, 6, 4),
(12, 1, 5, 4),
(13, 1, 9, 4),
(14, 1, 3, 3),
(15, 1, 1, 3),
(16, 1, 9, 3),
(17, 1, 4, 3),
(18, 1, 6, 3),
(19, 1, 7, 3),
(20, 1, 3, 8),
(21, 1, 3, 5),
(22, 1, 2, 1),
(23, 1, 6, 1),
(27, 1, 1, 8),
(28, 1, 11, 8),
(29, 1, 11, 4),
(30, 1, 3, 4),
(31, 1, 4, 4),
(32, 1, 10, 4),
(33, 1, 9, 2),
(35, 1, 2, 4),
(38, 1, 2, 2),
(40, 1, 7, 4),
(41, 1, 2, 5),
(42, 1, 8, 4),
(43, 1, 2, 22),
(44, 1, 5, 22),
(47, 1, 3, 22),
(48, 1, 4, 22),
(49, 1, 2, 21),
(50, 1, 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `answer_vote`
--

CREATE TABLE IF NOT EXISTS `answer_vote` (
  `ans_vote_ID` int(11) NOT NULL auto_increment,
  `upvotes` int(11) NOT NULL,
  `downvotes` int(11) NOT NULL,
  `reports` int(11) NOT NULL,
  `answer_ID` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `date_time` datetime NOT NULL,
  PRIMARY KEY  (`ans_vote_ID`),
  KEY `answer_vote_ibfk_1` (`answer_ID`),
  KEY `answer_vote_ibfk_2` (`user_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `answer_vote`
--

INSERT INTO `answer_vote` (`ans_vote_ID`, `upvotes`, `downvotes`, `reports`, `answer_ID`, `user_ID`, `date_time`) VALUES
(2, 0, 0, 0, 9, 0, '0000-00-00 00:00:00'),
(4, 0, 1, 0, 3, 3, '2018-10-12 08:29:52'),
(5, 0, 0, 0, 3, 0, '0000-00-00 00:00:00'),
(6, 1, 0, 0, 1, 3, '2018-10-12 08:31:13'),
(7, 0, 0, 1, 9, 3, '2018-10-12 08:31:30'),
(8, 0, 0, 0, 9, 0, '0000-00-00 00:00:00'),
(9, 1, 0, 0, 4, 3, '2018-10-12 08:36:09'),
(10, 0, 1, 0, 6, 3, '2018-10-12 08:38:52'),
(11, 1, 0, 0, 7, 3, '2018-10-12 08:39:30'),
(12, 0, 0, 0, 3, 0, '0000-00-00 00:00:00'),
(14, 0, 0, 0, 3, 0, '0000-00-00 00:00:00'),
(16, 0, 0, 0, 3, 0, '0000-00-00 00:00:00'),
(17, 0, 0, 0, 3, 0, '0000-00-00 00:00:00'),
(32, 0, 0, 1, 4, 4, '2018-11-16 11:47:41'),
(33, 0, 0, 0, 2, 0, '0000-00-00 00:00:00'),
(34, 0, 0, 0, 2, 0, '0000-00-00 00:00:00'),
(35, 0, 0, 0, 2, 0, '0000-00-00 00:00:00'),
(37, 0, 0, 0, 2, 0, '0000-00-00 00:00:00'),
(38, 0, 0, 0, 2, 0, '0000-00-00 00:00:00'),
(39, 0, 0, 0, 2, 0, '0000-00-00 00:00:00'),
(40, 0, 0, 0, 3, 0, '0000-00-00 00:00:00'),
(41, 0, 0, 1, 3, 5, '2019-04-13 18:33:22'),
(42, 0, 0, 0, 3, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `discussion`
--

CREATE TABLE IF NOT EXISTS `discussion` (
  `discussion_id` int(11) NOT NULL auto_increment,
  `communication` varchar(1000) NOT NULL,
  `image` varchar(255) NOT NULL,
  `img_src` varchar(255) NOT NULL,
  `pdf` varchar(255) NOT NULL,
  `pdf_src` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL,
  `video_src` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `d_user_id` int(11) NOT NULL,
  `q_no` int(11) NOT NULL,
  `a_no` int(11) NOT NULL,
  `d_date_time` datetime NOT NULL,
  `approve` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`discussion_id`),
  KEY `discussion_ibfk_1` (`d_user_id`),
  KEY `q_no` (`q_no`),
  KEY `a_no` (`a_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `discussion`
--

INSERT INTO `discussion` (`discussion_id`, `communication`, `image`, `img_src`, `pdf`, `pdf_src`, `video`, `video_src`, `link`, `d_user_id`, `q_no`, `a_no`, `d_date_time`, `approve`) VALUES
(1, '<div class="floatingSponsor">\r\n<div>\r\n<div>\r\n<p>C is a high-level and general-purpose programming language that is ideal for developing firmware or portable applications. Originally intended for writing system software, C was developed at Bell Labs by Dennis Ritchie for the Unix Operating System in the early 1970s.</p>\r\n<p>Ranked among the most widely used languages, C has a compiler for most computer systems and has influenced many popular languages &ndash; notably C++..</p>\r\n</div>\r\n</div>\r\n</div>', 'index.jpg', 'images/discussion/index.jpg', 'Synopsis_Subrata.pdf', 'pdf/discussion/Synopsis_Subrata.pdf', '144203_00_02_XR15_know.mp4', 'videos/discussion/144203_00_02_XR15_know.mp4', 'https://www.techopedia.com/definition/24068/c-programming-language-c', 4, 24, 4, '2018-10-10 01:42:29', 1),
(2, '&lt;p&gt;C belongs to the structured, procedural paradigms of languages. It is proven, flexible and powerful and may be used for a variety of different applications. Although high level, C and assembly language share many of the same attributes.&lt;/p&gt;', '', 'images/discussion/', '', 'pdf/discussion/', '', 'videos/discussion/', '', 4, 24, 4, '2018-10-10 01:48:45', 1),
(3, '&lt;p&gt;C is a computer programming language. That means that you can use C to create lists of instructions for a computer to follow. C is one of thousands of programming languages currently in use. C has been around for several decades and has won widespread acceptance because it gives programmers maximum control and efficiency. C is an easy language to learn. It is a bit more cryptic in its style than some other languages, but you get beyond that fairly quickly.&lt;/p&gt;', '', 'images/discussion/', '', 'pdf/discussion/', '', 'videos/discussion/', 'https://computer.howstuffworks.com/c1.htm', 2, 24, 4, '2018-10-10 02:04:53', 1),
(5, '&lt;p&gt;I am trying to insert some set data into an SQL database on the click of a button on a website I am toying with. I have the following code present, however, something must be going wrong and I thought this was the right forum to see where I am messing up.&lt;/p&gt;', '', 'images/discussion/', '', 'pdf/discussion/', '', 'videos/discussion/', '', 1, 24, 4, '2018-10-10 09:42:20', 1),
(6, '&lt;p&gt;&lt;span style=&quot;color: #333333; font-family: ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 14px; text-align: justify; background-color: #fbf9fa;&quot;&gt;I am trying to insert some set data into an SQL database on the click of a button on a website I am toying with. I have the following code present, however, something must be going wrong and I thought this was the right forum to see where I am messing up.&lt;/span&gt;&lt;/p&gt;', '', 'images/discussion/', '', 'pdf/discussion/', '', 'videos/discussion/', '', 3, 24, 4, '2018-10-10 22:58:24', 1),
(7, '&lt;p&gt;a class describes the contents of the objects that belong to it: it describes an aggregate of data fields (called instance variables), and defines the operations (called methods).&lt;/p&gt;', '', 'images/discussion/', '', 'pdf/discussion/', '', 'videos/discussion/', '', 4, 5, 9, '2018-10-12 08:26:01', 1),
(8, '&lt;p&gt;It was based on the B language, which had been created by Ken Thompson and Dennis Ritchie in 1969. In 1972, they planned to rewrite Unix in B, but then decided they needed a new version of the language that could do things such as byte addressability. The next version of B should be called C, the next letter after B.&lt;br /&gt;&lt;br /&gt;So why was B named B? B was a cut-down version of BCPL (Basic Combined Programming Language). Its name might be just a short version of BCPL, but Dennis Ritchie always maintained that it was named after Bonnie, Ken Thompson&amp;rsquo;s wife.&lt;/p&gt;', '', 'images/discussion/', '', 'pdf/discussion/', '', 'videos/discussion/', '', 3, 24, 3, '2018-10-12 08:30:50', 1),
(9, '&lt;p&gt;We don&amp;rsquo;t, actually. There exist systems where data and methods are added to &amp;ldquo;raw&amp;rdquo; objects without any particular class &amp;mdash; each object could be unique. JavaScript can be used in this mode, for example (although ES6 adds much more class-like support for those who want it.)&lt;br /&gt;&lt;br /&gt;Generally, though, implementations of languages (interpreters and compilers) end up wanting a class because that lets them generate code that runs faster, and for many languages, allows for static type checking which may find potential problems during compile time, rather than during runtime.&lt;/p&gt;', 'main-qimg-c850d13bffc40e18c1fa9d952fc9573a.png', 'images/discussion/main-qimg-c850d13bffc40e18c1fa9d952fc9573a.png', '', 'pdf/discussion/', '', 'videos/discussion/', 'https://caml.inria.fr/pub/docs/oreilly-book/html/book-ora140.html', 3, 5, 9, '2018-10-12 08:34:53', 1),
(10, '<p>Arup, your answer is right. Well done!</p>', '', '', '', '', '', '', '', 3, 23, 4, '2018-10-12 08:38:00', 1),
(11, '&lt;p&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; C language has evolved from three different structured language ALGOL, BCPL(Basic combined programming language) and B Language(B language is developed by Ken Thompson in 1970).&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; C is also called an offspring of the BCPL.&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; BCPL and B are data type less language. However, C language has a variety of data types.&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; It uses many concepts from these languages and introduced many new concepts such as data types, struct , pointer.&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; In 1989, the C language was standardizes by American National Standard Institute(ANSI).&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; In 1990, a version of C language was approved by the International Standard Organisation(ISO) and that version of C is also referred to as C89.&lt;/p&gt;', 'what-is-c-3-638.jpg', 'images/discussion/what-is-c-3-638.jpg', '', 'pdf/discussion/', '', 'videos/discussion/', '', 8, 24, 3, '2018-10-12 08:44:29', 1),
(12, '&lt;p&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; C language has evolved from three different structured language ALGOL, BCPL(Basic combined programming language) and B Language(B language is developed by Ken Thompson in 1970).&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; C is also called an offspring of the BCPL.&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; BCPL and B are data type less language. However, C language has a variety of data types.&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; It uses many concepts from these languages and introduced many new concepts such as data types, struct , pointer.&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; In 1989, the C language was standardizes by American National Standard Institute(ANSI).&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; In 1990, a version of C language was approved by the International Standard Organisation(ISO) and that version of C is also referred to as C89.&lt;/p&gt;', '', 'images/discussion/', '', 'pdf/discussion/', '', 'videos/discussion/', 'http://w3techs.in', 5, 24, 3, '2018-10-12 08:49:03', 1),
(14, '<p>As a middle-level language, C combines benefits of both low machine level languages and high-level developer friendly languages. Further, it is fast, structured, portable and has a rich library. These features make C a general purpose programming language, and hence, it finds application across every domain in programming world.</p>', '', 'images/discussion/', '', 'pdf/discussion/', '144203_00_03_XR15_exfiles.mp4', 'videos/discussion/144203_00_03_XR15_exfiles.mp4', '', 1, 24, 3, '2018-10-12 08:57:17', 1),
(15, '&lt;p&gt;&lt;strong style=&quot;color: #2f4f4f; font-family: verdana, helvetica, arial, sans-serif; font-size: 13px;&quot;&gt;Python&lt;/strong&gt;&lt;span style=&quot;font-family: verdana, helvetica, arial, sans-serif; font-size: 13px;&quot;&gt;&amp;nbsp;is a general purpose, dynamic, high level and interpreted programming language. It supports Object Oriented programming approach to develop applications. It is simple and easy to learn and provides lots of high-level data structures.&lt;/span&gt;&lt;/p&gt;', '', 'images/discussion/', '', 'pdf/discussion/', '', 'videos/discussion/', '', 2, 15, 2, '2018-11-28 02:35:26', 1),
(16, '&lt;p&gt;&lt;span style=&quot;font-family: verdana, helvetica, arial, sans-serif; font-size: 13px;&quot;&gt;Python is&amp;nbsp;&lt;/span&gt;&lt;em style=&quot;font-family: verdana, helvetica, arial, sans-serif; font-size: 13px;&quot;&gt;easy to learn&lt;/em&gt;&lt;span style=&quot;font-family: verdana, helvetica, arial, sans-serif; font-size: 13px;&quot;&gt;&amp;nbsp;yet powerful and versatile scripting language which makes it attractive for Application Development.&lt;/span&gt;&lt;/p&gt;', '', 'images/discussion/', '', 'pdf/discussion/', '', 'videos/discussion/', '', 1, 15, 2, '2018-11-28 02:36:44', 1),
(17, '&lt;p&gt;&lt;span style=&quot;font-family: verdana, helvetica, arial, sans-serif; font-size: 13px;&quot;&gt;Python''s syntax and&amp;nbsp;&lt;/span&gt;&lt;em style=&quot;font-family: verdana, helvetica, arial, sans-serif; font-size: 13px;&quot;&gt;dynamic typing&lt;/em&gt;&lt;span style=&quot;font-family: verdana, helvetica, arial, sans-serif; font-size: 13px;&quot;&gt;&amp;nbsp;with its interpreted nature, makes it an ideal language for scripting and rapid application development.&lt;/span&gt;&lt;/p&gt;', '', 'images/discussion/', '', 'pdf/discussion/', '', 'videos/discussion/', '', 5, 15, 2, '2018-11-28 02:38:05', 1),
(19, '<p><strong style="box-sizing: border-box; text-align: justify; color: #2f4f4f; font-family: verdana, helvetica, arial, sans-serif; font-size: 13px;">Python</strong><span style="box-sizing: border-box; color: #333333; text-align: justify; font-family: verdana, helvetica, arial, sans-serif; font-size: 13px;">&nbsp;is a general purpose, dynamic, high level and interpreted programming language. It supports Object Oriented programming approach to develop applications. It is simple and easy to learn and provides lots of high-level data structures.</span></p>', '', 'images/discussion/', '', 'pdf/discussion/', '', 'videos/discussion/', '', 4, 15, 2, '2018-11-28 03:46:56', 1),
(20, '&lt;p&gt;&lt;strong style=&quot;box-sizing: border-box; text-align: justify; color: #2f4f4f; font-family: verdana, helvetica, arial, sans-serif; font-size: 13px;&quot;&gt;Python&lt;/strong&gt;&lt;span style=&quot;box-sizing: border-box; color: #333333; text-align: justify; font-family: verdana, helvetica, arial, sans-serif; font-size: 13px;&quot;&gt;&amp;nbsp;is a general purpose, dynamic, high level and interpreted programming language. It supports Object Oriented programming approach to develop applications. It is simple and easy to learn and provides lots of high-level data structures.&lt;/span&gt;&lt;/p&gt;', 'down.png', 'images/discussion/down.png', 'eee.pdf', 'pdf/discussion/eee.pdf', '11.mp4', 'videos/discussion/11.mp4', 'https://www.javatpoint.com/what-is-python', 4, 15, 2, '2018-11-28 03:48:21', 1),
(21, '<p>Subrata Das</p>', '', 'images/discussion/', '', 'pdf/discussion/', '', 'videos/discussion/', '', 4, 24, 3, '2019-02-08 17:50:56', 1),
(22, '<p>What is this?</p>', '', 'images/discussion/', '', 'pdf/discussion/', '', 'videos/discussion/', '', 5, 24, 3, '2019-04-13 18:34:26', 1);

-- --------------------------------------------------------

--
-- Table structure for table `discussion_vote`
--

CREATE TABLE IF NOT EXISTS `discussion_vote` (
  `dis_vote_id` int(11) NOT NULL auto_increment,
  `upvotes` int(11) NOT NULL,
  `downvotes` int(11) NOT NULL,
  `reports` int(11) NOT NULL,
  `discussion_id` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `date_time` datetime NOT NULL,
  PRIMARY KEY  (`dis_vote_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=59 ;

--
-- Dumping data for table `discussion_vote`
--

INSERT INTO `discussion_vote` (`dis_vote_id`, `upvotes`, `downvotes`, `reports`, `discussion_id`, `user_ID`, `date_time`) VALUES
(1, 1, 0, 0, 1, 1, '2018-10-11 10:13:12'),
(4, 1, 0, 0, 3, 1, '2018-10-11 10:13:36'),
(5, 1, 0, 0, 6, 1, '2018-10-11 10:14:09'),
(9, 1, 0, 0, 4, 2, '2018-10-11 10:20:48'),
(12, 1, 0, 0, 5, 2, '2018-10-11 10:22:37'),
(15, 1, 0, 0, 2, 2, '2018-10-11 10:25:49'),
(16, 0, 1, 0, 4, 2, '2018-10-11 10:33:21'),
(17, 0, 1, 0, 4, 2, '2018-10-11 10:33:21'),
(18, 0, 1, 0, 4, 2, '2018-10-11 10:33:21'),
(19, 0, 1, 0, 4, 2, '2018-10-11 10:33:22'),
(20, 0, 1, 0, 4, 2, '2018-10-11 10:33:22'),
(35, 1, 0, 0, 3, 4, '2018-10-11 17:25:31'),
(36, 1, 0, 0, 7, 3, '2018-10-12 08:33:46'),
(37, 1, 0, 0, 8, 8, '2018-10-12 08:42:58'),
(39, 1, 0, 0, 8, 5, '2018-10-12 08:49:34'),
(55, 1, 0, 0, 12, 1, '2018-10-12 10:01:19'),
(57, 1, 0, 0, 8, 1, '2018-10-12 10:11:23'),
(58, 1, 0, 0, 15, 1, '2018-11-28 02:36:37');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `message_id` int(11) NOT NULL auto_increment,
  `email` varchar(255) character set utf8 collate utf8_bin NOT NULL,
  `mobile_no` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` varchar(500) NOT NULL,
  `date_time` datetime NOT NULL,
  PRIMARY KEY  (`message_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `email`, `mobile_no`, `subject`, `message`, `date_time`) VALUES
(6, 'subratadasbca@gmail.com', '9932259291', 'Hello', '&lt;p&gt;sdhfahdsf ksjadhfkjasdhjfhas&lt;/p&gt;', '2018-09-14 17:58:33'),
(7, 'subratadasbca@gmail.com', '9932259291', 'hello', '&lt;p&gt;sdfhsdlfasdf&lt;/p&gt;', '2018-09-14 18:00:31'),
(8, 'subratadasbca@yahoo.co.uk', '9932259291', 'Hello', '&lt;p&gt;fhajdshfljasdhlfkjas&lt;/p&gt;', '2018-09-14 18:02:21');

-- --------------------------------------------------------

--
-- Table structure for table `post_query`
--

CREATE TABLE IF NOT EXISTS `post_query` (
  `query_id` int(11) NOT NULL auto_increment,
  `user_subject` varchar(255) NOT NULL,
  `user_description` varchar(1000) NOT NULL,
  `user_des_time` datetime NOT NULL,
  `user_des_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `response` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`query_id`),
  KEY `user_des_id` (`user_des_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `post_query`
--

INSERT INTO `post_query` (`query_id`, `user_subject`, `user_description`, `user_des_time`, `user_des_id`, `status`, `response`) VALUES
(1, 'Marketing Letter to CEO', '&lt;p&gt;The way our economy is striving right now, we are aware on the problems being dealt with by a CEO like you. For ________years now, our company has successfully assisted a number of companies in training and counseling their workers in order to ensure the success of these companies and avoid employee reduction number as an option.&lt;br /&gt;&lt;br /&gt;Below is a list of the various services that we provide.&lt;br /&gt;&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; We focus on those employees who have a tenure of less than two years in order to fully enhance their skills.&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; We provide advanced training and counseling for tenured employees in order to retain to keep the loyalty of these employees.&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; We conduct sessions for different levels of employee in your company on different sessions.&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; Rest assured that our services will bring something good in your business', '2018-10-07 15:06:46', 4, 'read', 1),
(2, 'Warning', '&lt;p&gt;The IT industry is performing extremely well, and your company is one of the most successful. Unfortunately, employee attrition is a matter of concern for companies like yours, and as the CEO you must be under tremendous pressure to check this trend. We, EZWorkStuff, have supplied ergonomically designed furniture and office equipment to a few IT firms in the past and would like an opportunity to further enhance the working conditions in your offices as well.&lt;br /&gt;&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; Ergonomically designed chairs provide ample back support for desk workers&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; Ergonomic keyboards allow uninterrupted and pain-free typing&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; Desks and cabinets with an ergonomic design makes moving about and storing easy and safe&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; Less fatigue and injuries leads to happier and more satisfied employees.&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; We are ce', '2018-10-07 16:10:41', 4, 'read', 1),
(3, 'Warning', '&lt;p&gt;The IT industry is performing extremely well, and your company is one of the most successful. Unfortunately, employee attrition is a matter of concern for companies like yours, and as the CEO you must be under tremendous pressure to check this trend. We, EZWorkStuff, have supplied ergonomically designed furniture and office equipment to a few IT firms in the past and would like an opportunity to further enhance the working conditions in your offices as well.&lt;br /&gt;&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; Ergonomically designed chairs provide ample back support for desk workers&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; Ergonomic keyboards allow uninterrupted and pain-free typing&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; Desks and cabinets with an ergonomic design makes moving about and storing easy and safe&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; Less fatigue and injuries leads to happier and more satisfied employees.&lt;br /&gt;&amp;nbsp;&amp;nbsp;&lt;/p&gt;', '2018-10-07 16:21:51', 4, 'read', 1),
(5, 'Warning', '&lt;p&gt;The IT industry is performing extremely well, and your company is one of the most successful. Unfortunately, employee attrition is a matter of concern for companies like yours, and as the CEO you must be under tremendous pressure to check this trend. We, EZWorkStuff, have supplied ergonomically designed furniture and office equipment to a few IT firms in the past and would like an opportunity to further enhance the working conditions in your offices as well.&lt;br /&gt;&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; Ergonomically designed chairs provide ample back support for desk workers&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; Ergonomic keyboards allow uninterrupted and pain-free typing&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; Desks and cabinets with an ergonomic design makes moving about and storing easy and safe&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; Less fatigue and injuries leads to happier and more satisfied employees.&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; We are ce', '2018-10-07 18:08:55', 4, 'read', 1),
(6, 'Warning', '&lt;p&gt;The IT industry is performing extremely well, and your company is one of the most successful. Unfortunately, employee attrition is a matter of concern for companies like yours, and as the CEO you must be under tremendous pressure to check this trend. We, EZWorkStuff, have supplied ergonomically designed furniture and office equipment to a few IT firms in the past and would like an opportunity to further enhance the working conditions in your offices as well.&lt;br /&gt;&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; Ergonomically designed chairs provide ample back support for desk workers&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; Ergonomic keyboards allow uninterrupted and pain-free typing&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; Desks and cabinets with an ergonomic design makes moving about and storing easy and safe&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; Less fatigue and injuries leads to happier and more satisfied employees.&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; We are ce', '2018-10-08 00:56:21', 4, 'read', 1),
(7, 'please add database ', '&lt;p&gt;The IT industry is performing extremely well, and your company is one of the most successful. Unfortunately, employee attrition is a matter of concern for companies like yours, and as the CEO you must be under tremendous pressure to check this trend. We, EZWorkStuff, have supplied ergonomically designed furniture and office equipment to a few IT firms in the past and would like an opportunity to further enhance the working conditions in your offices as well.&lt;/p&gt;', '2018-10-12 02:12:30', 4, 'read', 1);

-- --------------------------------------------------------

--
-- Table structure for table `post_solution`
--

CREATE TABLE IF NOT EXISTS `post_solution` (
  `solution_id` int(11) NOT NULL auto_increment,
  `admin_subject` varchar(255) NOT NULL,
  `admin_description` varchar(1000) NOT NULL,
  `admin_des_time` datetime NOT NULL,
  `admin_des_id` int(11) NOT NULL,
  `query_id` int(11) NOT NULL,
  `query_user_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY  (`solution_id`),
  KEY `query_id` (`query_id`),
  KEY `user_query_id` (`query_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `post_solution`
--

INSERT INTO `post_solution` (`solution_id`, `admin_subject`, `admin_description`, `admin_des_time`, `admin_des_id`, `query_id`, `query_user_id`, `status`) VALUES
(1, 'Support.odf', '&lt;p&gt;The IT industry is performing extremely well, and your company is one of the most successful. Unfortunately, employee attrition is a matter of concern for companies like yours, and as the CEO you must be under tremendous pressure to check this trend. We, EZWorkStuff, have supplied ergonomically designed furniture and office equipment to a few IT firms in the past and would like an opportunity to further enhance the working conditions in your offices as well.&lt;br /&gt;&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; Ergonomically designed chairs provide ample back support for desk workers&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; Ergonomic keyboards allow uninterrupted and pain-free typing&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; Desks and cabinets with an ergonomic design makes moving about and storing easy and safe&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; Less fatigue and injuries leads to happier and more satisfied employees.&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; We are ce', '2018-10-07 15:12:11', 0, 0, 4, 'read'),
(2, 'Support.odf', '&lt;p&gt;The IT industry is performing extremely well, and your company is one of the most successful. Unfortunately, employee attrition is a matter of concern for companies like yours, and as the CEO you must be under tremendous pressure to check this trend. We, EZWorkStuff, have supplied ergonomically designed furniture and office equipment to a few IT firms in the past and would like an opportunity to further enhance the working conditions in your offices as well.&lt;br /&gt;&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; Ergonomically designed chairs provide ample back support for desk workers&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; Ergonomic keyboards allow uninterrupted and pain-free typing&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; Desks and cabinets with an ergonomic design makes moving about and storing easy and safe&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; Less fatigue and injuries leads to happier and more satisfied employees.&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; We are ce', '2018-10-07 15:12:50', 0, 1, 4, 'read'),
(3, 'warning', '&lt;p&gt;The IT industry is performing extremely well, and your company is one of the most successful. Unfortunately, employee attrition is a matter of concern for companies like yours, and as the CEO you must be under tremendous pressure to check this trend. We, EZWorkStuff, have supplied ergonomically designed furniture and office equipment to a few IT firms in the past and would like an opportunity to further enhance the working conditions in your offices as well.&lt;br /&gt;&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; Ergonomically designed chairs provide ample back support for desk workers&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; Ergonomic keyboards allow uninterrupted and pain-free typing&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; Desks and cabinets with an ergonomic design makes moving about and storing easy and safe&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; Less fatigue and injuries leads to happier and more satisfied employees.&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; We are ce', '2018-10-07 16:11:20', 0, 2, 4, 'read'),
(5, 'Support.odf', '&lt;p&gt;The IT industry is performing extremely well, and your company is one of the most successful. Unfortunately, employee attrition is a matter of concern for companies like yours, and as the CEO you must be under tremendous pressure to check this trend. We, EZWorkStuff, have supplied ergonomically designed furniture and office equipment to a few IT firms in the past and would like an opportunity to further enhance the working conditions in your offices as well.&lt;br /&gt;&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; Ergonomically designed chairs provide ample back support for desk workers&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; Ergonomic keyboards allow uninterrupted and pain-free typing&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; Desks and cabinets with an ergonomic design makes moving about and storing easy and safe&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; Less fatigue and injuries leads to happier and more satisfied employees.&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; We are ce', '2018-10-07 18:47:41', 0, 0, 2, 'read'),
(6, 'Support.odf', '&lt;p&gt;The IT industry is performing extremely well, and your company is one of the most successful. Unfortunately, employee attrition is a matter of concern for companies like yours, and as the CEO you must be under tremendous pressure to check this trend. We, EZWorkStuff, have supplied ergonomically designed furniture and office equipment to a few IT firms in the past and would like an opportunity to further enhance the working conditions in your offices as well.&lt;br /&gt;&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; Ergonomically designed chairs provide ample back support for desk workers&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; Ergonomic keyboards allow uninterrupted and pain-free typing&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; Desks and cabinets with an ergonomic design makes moving about and storing easy and safe&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; Less fatigue and injuries leads to happier and more satisfied employees.&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; We are ce', '2018-10-08 00:57:37', 0, 6, 4, 'read'),
(7, 'Support.odf', '&lt;p&gt;The IT industry is performing extremely well, and your company is one of the most successful. Unfortunately, employee attrition is a matter of concern for companies like yours, and as the CEO you must be under tremendous pressure to check this trend. We, EZWorkStuff, have supplied ergonomically designed furniture and office equipment to a few IT firms in the past and would like an opportunity to further enhance the working conditions in your offices as well.&lt;/p&gt;', '2018-10-12 02:08:51', 0, 5, 4, 'read'),
(10, 'Welcome', 'Welcome to O.D.F ! As Manager of ODF, I would like to personally welcome you as a new advertiser. You are another fortunate taking part in the ODF.  Our associates are licensed contractors with lifetime of experience in real estate maintenance. We have assigned John Doe to take care of your account. Please feel free to contact our office at +91 9932259291 at any time and we will immediately take care of any problems. Again, thank you for choosing ODF.', '2018-09-15 02:30:31', 0, 0, 5, 'read'),
(11, 'Welcome', 'Welcome to O.D.F ! As Manager of ODF, I would like to personally welcome you as a new advertiser. You are another fortunate taking part in the ODF.  Our associates are licensed contractors with lifetime of experience in real estate maintenance. We have assigned John Doe to take care of your account. Please feel free to contact our office at +91 9932259291 at any time and we will immediately take care of any problems. Again, thank you for choosing ODF.', '2018-09-15 02:30:31', 0, 0, 5, 'unread'),
(12, 'Welcome', 'Welcome to O.D.F ! As Manager of ODF, I would like to personally welcome you as a new advertiser. You are another fortunate taking part in the ODF.  Our associates are licensed contractors with lifetime of experience in real estate maintenance. We have assigned John Doe to take care of your account. Please feel free to contact our office at +91 9932259291 at any time and we will immediately take care of any problems. Again, thank you for choosing ODF.', '2018-09-15 02:30:31', 0, 0, 5, 'unread'),
(13, 'Welcome', 'Welcome to O.D.F ! As Manager of ODF, I would like to personally welcome you as a new advertiser. You are another fortunate taking part in the ODF.  Our associates are licensed contractors with lifetime of experience in real estate maintenance. We have assigned John Doe to take care of your account. Please feel free to contact our office at +91 9932259291 at any time and we will immediately take care of any problems. Again, thank you for choosing ODF.', '2018-09-15 02:30:31', 0, 0, 5, 'unread'),
(14, 'Welcome', 'Welcome to O.D.F ! As Manager of ODF, I would like to personally welcome you as a new advertiser. You are another fortunate taking part in the ODF.  Our associates are licensed contractors with lifetime of experience in real estate maintenance. We have assigned John Doe to take care of your account. Please feel free to contact our office at +91 9932259291 at any time and we will immediately take care of any problems. Again, thank you for choosing ODF.', '2018-09-15 02:30:31', 0, 0, 1, 'read'),
(15, 'Support.odf', '&lt;p&gt;The IT industry is performing extremely well, and your company is one of the most successful. Unfortunately, employee attrition is a matter of concern for companies like yours, and as the CEO you must be under tremendous pressure to check this trend. We, EZWorkStuff, have supplied ergonomically designed furniture and office equipment to a few IT firms in the past and would like an opportunity to further enhance the working conditions in your offices as well.&lt;/p&gt;', '2018-10-12 14:52:18', 0, 8, 8, 'read'),
(17, 'Warning', '&lt;p&gt;&lt;span style=&quot;color: #333333; font-family: ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 14px; text-align: justify; background-color: #f5f5f5;&quot;&gt;Welcome to O.D.F ! As Manager of ODF, I would like to personally welcome you as a new advertiser. You are another fortunate taking part in the ODF. Our associates are licensed contractors with lifetime of experience in real estate maintenance. We have assigned John Doe to take care of your account. Please feel free to contact our office at +91 9932259291 at any time and we will immediately take care of any problems. Again, thank you for choosing ODF.&lt;/span&gt;&lt;/p&gt;', '2018-11-15 20:39:18', 0, 0, 1, 'read'),
(18, 'Welcome', 'Welcome to O.D.F ! As Manager of ODF, I would like to personally welcome you as a new advertiser. You are another fortunate taking part in the ODF.  Our associates are licensed contractors with lifetime of experience in real estate maintenance. We have assigned John Doe to take care of your account. Please feel free to contact our office at +91 9932259291 at any time and we will immediately take care of any problems. Again, thank you for choosing ODF.', '2018-11-30 18:20:06', 0, 0, 21, 'unread'),
(19, 'Welcome', 'Welcome to O.D.F ! As Manager of ODF, I would like to personally welcome you as a new advertiser. You are another fortunate taking part in the ODF.  Our associates are licensed contractors with lifetime of experience in real estate maintenance. We have assigned John Doe to take care of your account. Please feel free to contact our office at +91 9932259291 at any time and we will immediately take care of any problems. Again, thank you for choosing ODF.', '2018-12-21 19:39:46', 0, 0, 22, 'read');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `q_no` int(11) NOT NULL auto_increment,
  `q_subject_id` int(11) NOT NULL,
  `question` varchar(600) character set utf8 collate utf8_bin NOT NULL,
  `q_date_time` datetime NOT NULL,
  `q_email` varchar(255) character set utf8 collate utf8_bin NOT NULL,
  `q_user_id` int(11) NOT NULL,
  `a_q` tinyint(4) NOT NULL default '0',
  `a_s` tinyint(11) NOT NULL default '0',
  `user_approve` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`q_no`),
  KEY `questions_ibfk_1` (`q_user_id`),
  KEY `questions_ibfk_2` (`q_subject_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`q_no`, `q_subject_id`, `question`, `q_date_time`, `q_email`, `q_user_id`, `a_q`, `a_s`, `user_approve`) VALUES
(1, 10, '&lt;p&gt;What are the key features in C programming language?&lt;/p&gt;', '2018-09-12 23:18:55', 'subratadas@gmail.com', 4, 1, 1, 1),
(2, 10, '&lt;p&gt;What are the basic data types associated with C?&lt;/p&gt;', '2018-09-12 23:19:28', 'subratadas@gmail.com', 4, 1, 1, 1),
(3, 10, '&lt;p&gt;What is the description for syntax errors?&lt;/p&gt;', '2018-09-12 23:19:50', 'subratadas@gmail.com', 4, 1, 1, 1),
(4, 6, '&lt;p&gt;What is the full form of OOPS?&lt;/p&gt;', '2018-09-12 23:32:15', 'aruppanda@gmail.com', 2, 1, 1, 1),
(5, 6, '&lt;p&gt;What is a class?&lt;/p&gt;', '2018-09-12 23:32:28', 'aruppanda@gmail.com', 2, 1, 1, 1),
(6, 6, '&lt;p&gt;What is an object?&lt;/p&gt;', '2018-09-12 23:32:49', 'aruppanda@gmail.com', 2, 1, 1, 1),
(7, 11, '&lt;p&gt;What is data-structure?&lt;/p&gt;', '2018-09-12 23:37:58', 'subratadas@gmail.com', 4, 1, 1, 1),
(8, 11, '&lt;p&gt;What are various data-structures available?&lt;/p&gt;', '2018-09-12 23:38:19', 'subratadas@gmail.com', 4, 1, 1, 1),
(9, 11, '&lt;p&gt;What is algorithm?&lt;/p&gt;', '2018-09-12 23:39:58', 'amiyamaity@gmail.com', 1, 1, 1, 1),
(10, 11, '&lt;p&gt;Why we need to do algorithm analysis?&lt;/p&gt;', '2018-09-12 23:40:35', 'amiyamaity@gmail.com', 1, 1, 1, 1),
(11, 7, '&lt;p&gt;What is the difference between an Inner Class and a Sub-Class?&lt;/p&gt;', '2018-09-12 23:46:39', 'subhashisneogi@gmail.com', 5, 1, 1, 1),
(12, 7, '&lt;p&gt;What are the various access specifiers for Java classes?&lt;/p&gt;', '2018-09-12 23:47:06', 'subhashisneogi@gmail.com', 5, 1, 1, 1),
(13, 7, '&lt;p&gt;What''s the purpose of Static methods and static variables?&lt;/p&gt;', '2018-09-12 23:47:34', 'subhashisneogi@gmail.com', 5, 1, 1, 1),
(14, 7, '&lt;p&gt;What is data encapsulation and what''s its significance?&lt;/p&gt;', '2018-09-12 23:47:59', 'subhashisneogi@gmail.com', 5, 1, 1, 1),
(15, 8, '&lt;p&gt;What is Python? What are the benefits of using Python?&lt;/p&gt;', '2018-09-13 03:02:07', 'ramanathmondal@gmail.com', 3, 1, 1, 1),
(16, 8, '&lt;p&gt;What is PEP 8?&lt;/p&gt;', '2018-09-13 03:02:26', 'ramanathmondal@gmail.com', 3, 1, 1, 1),
(17, 8, '&lt;p&gt;What is pickling and unpickling?&lt;/p&gt;', '2018-09-13 03:02:48', 'ramanathmondal@gmail.com', 3, 1, 1, 1),
(18, 8, '&lt;p&gt;What are the tools that help to find bugs or perform static analysis?&lt;/p&gt;', '2018-09-13 03:03:09', 'ramanathmondal@gmail.com', 3, 1, 1, 1),
(19, 8, '&lt;p&gt;How is memory managed in Python?&lt;/p&gt;', '2018-09-14 13:53:37', 'aruppanda@gmail.com', 2, 1, 1, 1),
(20, 8, '&lt;p&gt;Explain what Flask is and its benefits?&lt;/p&gt;', '2018-09-14 13:54:46', 'aruppanda@gmail.com', 2, 1, 1, 1),
(21, 10, '&lt;p&gt;What is the output of this C code?&lt;/p&gt;', '2018-09-14 17:44:55', 'subratadas@gmail.com', 4, 1, 1, 1),
(23, 7, '&lt;p&gt;What is Java ?&lt;/p&gt;', '2018-09-15 18:30:19', 'subhashisneogi@gmail.com', 5, 1, 1, 1),
(24, 10, '&lt;p&gt;What is C?&lt;/p&gt;', '2018-10-08 13:36:10', 'subratadas@gmail.com', 4, 1, 1, 1),
(25, 11, '&lt;p&gt;&amp;nbsp;t6uy6&lt;/p&gt;', '2018-10-12 11:40:57', 'amiyamaity@gmail.com', 1, 0, 1, 1),
(26, 6, '&lt;p&gt;What is&amp;nbsp; C++???????&lt;/p&gt;', '2019-02-08 17:47:03', 'subratadasbca@gmail.com', 22, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE IF NOT EXISTS `subjects` (
  `subject_id` int(11) NOT NULL auto_increment,
  `sub_code` varchar(255) NOT NULL,
  `sub_name` varchar(255) NOT NULL,
  `sub_date_time` datetime NOT NULL,
  `sub_uploaded_by` varchar(255) character set utf8 collate utf8_bin NOT NULL,
  `s_admin_id` int(11) NOT NULL,
  `a_s` tinyint(11) NOT NULL default '0',
  PRIMARY KEY  (`subject_id`),
  KEY `admin_id` (`s_admin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_id`, `sub_code`, `sub_name`, `sub_date_time`, `sub_uploaded_by`, `s_admin_id`, `a_s`) VALUES
(6, 'C++-102', 'C++', '2018-09-07 17:34:25', 'subratadasbca@gmail.com', 1, 1),
(7, 'Java-103', 'Java with OOP', '2018-09-07 17:34:39', 'subratadasbca@gmail.com', 1, 1),
(8, 'Python-103', 'Python', '2018-09-07 17:34:52', 'subratadasbca@gmail.com', 1, 1),
(9, 'English-101', 'English', '2018-09-10 23:53:34', 'subratadasbca@gmail.com', 1, 1),
(10, 'C-101', 'Programming C', '2018-09-11 00:19:15', 'subratadasbca@gmail.com', 1, 1),
(11, 'Data Structure-102', 'Data Structure with C', '2018-09-11 00:19:28', 'subratadasbca@gmail.com', 1, 1),
(12, 'Nework-104', 'Networking & Communication', '2018-09-14 13:43:30', 'subratadasbca@gmail.com', 1, 1),
(13, 'AI-105', 'Artifical Inteligent ...', '2018-09-14 23:36:13', 'subratadasbca@gmail.com', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL auto_increment,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) character set utf8 collate utf8_bin NOT NULL,
  `password` text character set utf8 collate utf8_bin NOT NULL,
  `u_date_time` datetime NOT NULL,
  `validation_code` text character set utf8 collate utf8_bin NOT NULL,
  `active` tinyint(4) NOT NULL default '0',
  `education` varchar(255) NOT NULL,
  `employment` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `pic_src` varchar(255) NOT NULL,
  `approve` tinyint(4) NOT NULL default '0',
  `online` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `username`, `email`, `password`, `u_date_time`, `validation_code`, `active`, `education`, `employment`, `address`, `profile_pic`, `pic_src`, `approve`, `online`) VALUES
(1, 'amiya', 'maity', 'amiyamaity', 'amiyamaity@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2018-09-12 23:09:45', '1', 1, 'M.C.A', 'Software Engineer', 'Belda', 'amiya.png', 'Profile_picture/amiya.png', 1, 1),
(2, 'arup', 'panda', 'aruppanda', 'aruppanda@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2018-09-12 23:10:23', '1', 1, 'M.C.A', 'Software Engineer', 'Bnakura', 'arup.png', 'Profile_picture/arup.png', 1, 0),
(3, 'ramanath', 'mondal', 'ramanathmondal', 'ramanathmondal@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2018-09-12 23:11:03', '1', 1, 'M.C.A', 'Software Engineer', 'Panskura', 'ramanath.png', 'Profile_picture/ramanath.png', 1, 0),
(4, 'subrata', 'das', 'subratadas', 'subratadas@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2018-09-12 23:11:37', '340fac1e6d8fb7a35623cfa921522eff', 1, 'M.C.A', 'Student of the year', 'Panskura', 'sub123.jpg', 'Profile_picture/sub123.jpg', 1, 1),
(5, 'subhashis', 'neogi', 'subhashisneogi', 'subhashisneogi@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2018-09-12 23:12:35', '1', 1, 'M.C.A', 'Software Engineer', 'Siliguri', 'subha.png', 'Profile_picture/subha.png', 1, 1),
(6, 'Debabrata', 'Das', 'debabrata', 'debabratadas@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2018-09-14 02:03:23', '1', 1, 'B.tech', 'Student', 'Egra', 'debabrata.png', 'Profile_picture/debabrata.png', 1, 0),
(7, 'Akash', 'Roy', 'akash', 'akashroy@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2018-09-15 02:30:31', '1', 1, '', '', '', '', '', 0, 0),
(8, 'Rahul', 'Das', 'rahuldas', 'rahuldas@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2018-10-12 01:55:17', '0', 1, 'M.C.A', 'Student of the year', 'Durgapur', 'Rahul_Das.jpg', 'Profile_picture/Rahul_Das.jpg', 1, 1),
(21, 'Subrata', 'Das', 'subrata', 'subratadas606@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2018-11-30 18:20:06', '0', 1, '', '', '', '', '', 1, 0),
(22, 'Subrata', 'Das', 'subratadasbca', 'subratadasbca@gmail.com', '25f9e794323b453885f5181f1b624d0b', '2018-12-04 13:06:35', 'sUTJqBtS', 1, '', '', '', '', '', 1, 1),
(23, 'uuuiuuuu', 'uuuuuuu', 'hhhhhhhh', 'uday.banerjee@bcrec.ac.in', '827ccb0eea8a706c4c34a16891f84e7b', '2018-12-04 13:07:58', 'b7e6923f6de66497d51789db0ef3571d', 0, '', '', '', '', '', 0, 0),
(24, 'Debabrata ', 'Das', 'debabrata1234', 'debabratadas711@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2018-12-26 10:15:09', 'qjIz54ps', 0, '', '', '', '', '', 0, 0),
(26, 'Debabrata ', 'Maity', 'debabratamaity', 'debabratamaiti108@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2018-12-26 10:18:56', '61df4b1a7bcef4d9c311972805bef6e2', 0, '', '', '', '', '', 0, 0),
(27, 'Sitaram', 'Das', 'sitaramdas', 'sitaramdas84@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2018-12-26 10:21:59', '0bbcb8a780588e3177fbc30f50028c76', 0, '', '', '', '', '', 0, 0),
(31, 'Subrata', 'Das', 'subratadas765', 'mr.subrata.15@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2019-01-29 14:12:58', 'e26068e899d0347e022aa841534fc154', 0, '', '', '', '', '', 0, 0),
(32, 'Subrata', 'Das', 'sub123', 'subr123456@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2019-02-15 18:30:10', '969c7b23afead937f4497e49a2cfed90', 0, '', '', '', '', '', 0, 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_2` FOREIGN KEY (`q_no`) REFERENCES `questions` (`q_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `answers_ibfk_3` FOREIGN KEY (`a_user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `answers_ibfk_4` FOREIGN KEY (`a_subject_id`) REFERENCES `subjects` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `answer_view_count`
--
ALTER TABLE `answer_view_count`
  ADD CONSTRAINT `answer_view_count_ibfk_1` FOREIGN KEY (`answer_ID`) REFERENCES `answers` (`a_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `answer_view_count_ibfk_2` FOREIGN KEY (`user_ID`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `discussion`
--
ALTER TABLE `discussion`
  ADD CONSTRAINT `discussion_ibfk_1` FOREIGN KEY (`d_user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `discussion_ibfk_2` FOREIGN KEY (`q_no`) REFERENCES `questions` (`q_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `discussion_ibfk_3` FOREIGN KEY (`a_no`) REFERENCES `answers` (`a_no`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `post_query`
--
ALTER TABLE `post_query`
  ADD CONSTRAINT `post_query_ibfk_2` FOREIGN KEY (`user_des_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `post_solution`
--
ALTER TABLE `post_solution`
  ADD CONSTRAINT `post_solution_ibfk_2` FOREIGN KEY (`query_user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`q_user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `questions_ibfk_2` FOREIGN KEY (`q_subject_id`) REFERENCES `subjects` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `subjects_ibfk_1` FOREIGN KEY (`s_admin_id`) REFERENCES `admin` (`admin_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
