-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2023 at 06:28 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ccs`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_acc`
--

CREATE TABLE `admin_acc` (
  `admin_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `admin_username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_acc`
--

INSERT INTO `admin_acc` (`admin_id`, `name`, `admin_username`, `password`, `user_type`) VALUES
(1, 'Paolo', 'superadmin', '21232f297a57a5a743894a0e4a801fc3', 'superadmin'),
(2, 'Josef Liu', 'admin2', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(4, 'James Roland Angeles', 'admin3', '21232f297a57a5a743894a0e4a801fc3', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `blog_data`
--

CREATE TABLE `blog_data` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `introduction` longtext DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `conclusion` longtext DEFAULT NULL,
  `date_posted` datetime DEFAULT current_timestamp(),
  `content_creator` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog_data`
--

INSERT INTO `blog_data` (`id`, `title`, `introduction`, `content`, `conclusion`, `date_posted`, `content_creator`) VALUES
(7, '\"Web and Mobile Application Development: An Overview\"', 'Web and mobile application development is a rapidly growing field, with new technologies and tools emerging all the time. These applications have become an integral part of our daily lives, making it easier to communicate, access information, and complete tasks. If you\'re interested in learning more about this field, then this blog post is for you.', 'Web applications are software programs that are accessed over the internet through a web browser. These applications are developed using a variety of programming languages, such as HTML, CSS, and JavaScript. Some popular examples of web applications include online shopping sites, social media platforms, and email services.<br><br>\n\nMobile applications, on the other hand, are software programs that are designed to be used on mobile devices such as smartphones and tablets. These applications can be native, meaning they are developed specifically for a particular platform (such as iOS or Android), or they can be cross-platform, meaning they can be used on multiple platforms. Mobile applications can be downloaded from app stores, such as the Apple App Store or Google Play Store.<br><br>\n\nBoth web and mobile application development require a strong understanding of programming languages, as well as an understanding of user experience and design. Developers must also be able to troubleshoot and solve problems, as well as stay up-to-date with the latest technologies and best practices.', 'Web and mobile application development is a dynamic field that offers a range of career opportunities. Whether you\'re interested in developing the next big app or just want to learn more about this field, there are many resources available to help you get started. With the right knowledge and skills, you can enter this exciting and growing industry and make your mark as a developer.', '2023-01-02 21:22:09', 'Kimcarlo Alvarez'),
(6, '\"IT Specialization Course: Animation and Motion Graphics\"          ', '                        Animation and motion graphics are a staple of modern media, with applications in film, television, advertising, and more. If you\'re interested in pursuing a career in this field, then an IT specialization course in animation and motion graphics may be the right fit for you. In this blog post, we\'ll give you an overview of what to expect from this type of course and how it can help you succeed in your career.                    ', 'An IT specialization course in animation and motion graphics typically covers the principles and techniques of animation and motion graphics design, including 2D and 3D animation, character design, and compositing. Students learn to use software such as Adobe After Effects, Adobe Photoshop, and Autodesk Maya to create professional-quality animations and motion graphics.<br><br>\r\n\r\nIn addition to technical skills, an IT specialization course in animation and motion graphics may also cover topics such as storytelling, design principles, and project management. These skills are essential for success in the industry, as they help students to develop their creative vision and to effectively communicate their ideas to clients and team members.<br><br>\r\n\r\nUpon completion of an IT specialization course in animation and motion graphics, students should have a strong portfolio of work to showcase their skills and a solid foundation in the principles of animation and motion graphics design. This can help them to stand out in a competitive job market and to pursue exciting careers in the field.<br><br>', 'An IT specialization course in animation and motion graphics is a great way to develop the skills and knowledge you need to succeed in this exciting field. With the right course and a dedication to your studies, you can join the ranks of professional animators and motion graphics designers and make your mark in the world of media.\r\n                                              \r\n                                              \r\n                    ', '2023-01-02 21:22:09', 'Paolo Bachicha'),
(8, '\"IT Specialization Course: Animation and Motion Graphics\"', 'Animation and motion graphics are a staple of modern media, with applications in film, television, advertising, and more. If you\'re interested in pursuing a career in this field, then an IT specialization course in animation and motion graphics may be the right fit for you. In this blog post, we\'ll give you an overview of what to expect from this type of course and how it can help you succeed in your career.', 'An IT specialization course in animation and motion graphics typically covers the principles and techniques of animation and motion graphics design, including 2D and 3D animation, character design, and compositing. Students learn to use software such as Adobe After Effects, Adobe Photoshop, and Autodesk Maya to create professional-quality animations and motion graphics.<br><br>\r\n\r\nIn addition to technical skills, an IT specialization course in animation and motion graphics may also cover topics such as storytelling, design principles, and project management. These skills are essential for success in the industry, as they help students to develop their creative vision and to effectively communicate their ideas to clients and team members.<br><br>\r\n\r\nUpon completion of an IT specialization course in animation and motion graphics, students should have a strong portfolio of work to showcase their skills and a solid foundation in the principles of animation and motion graphics design. This can help them to stand out in a competitive job market and to pursue exciting careers in the field.<br><br>', 'An IT specialization course in animation and motion graphics is a great way to develop the skills and knowledge you need to succeed in this exciting field. With the right course and a dedication to your studies, you can join the ranks of professional animators and motion graphics designers and make your mark in the world of media.', '2023-01-02 21:22:09', 'Admin'),
(9, '\"The World of Gaming: An Introduction\"', 'Gaming is a pastime enjoyed by millions of people all over the world. From casual mobile games to competitive esports tournaments, there is a game for everyone. In this blog post, we\'ll give you an overview of the world of gaming and how it has evolved over the years.', 'Gaming has come a long way since the days of Pong and Pac-Man. Today\'s games are more realistic and immersive than ever before, with graphics and gameplay that rival those of major Hollywood productions. The gaming industry is now a multi-billion dollar industry, with major companies such as Sony, Microsoft, and Nintendo competing to release the latest and greatest gaming hardware and software.<br><br>\r\n\r\nThere are many different types of games to choose from, ranging from first-person shooters and role-playing games to sports games and strategy games. There are also countless genres within these categories, so you\'re sure to find a game that fits your interests and skill level.<br><br>\r\n\r\nGaming has also become a major spectator sport, with professional esports tournaments drawing millions of viewers around the world. These tournaments feature top players competing in games such as League of Legends, Overwatch, and Counter-Strike: Global Offensive, with prize pools that can reach into the millions of dollars.<br><br>', 'The world of gaming is vast and varied, with something for everyone. Whether you\'re a casual gamer or a competitive esports player, there is a place for you in the gaming community. So why not give it a try and see what all the hype is about?', '2023-01-02 21:22:09', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `full_name`, `email`, `message`) VALUES
(2, 'Paolo Bachicha', '0320-0481@lspu.edu.ph', 'this is another message from me hehe');

-- --------------------------------------------------------

--
-- Table structure for table `grades_dataset`
--

CREATE TABLE `grades_dataset` (
  `id` int(11) NOT NULL,
  `dataset_name` varchar(100) NOT NULL,
  `dataset_upload_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `grades_dataset`
--

INSERT INTO `grades_dataset` (`id`, `dataset_name`, `dataset_upload_date`) VALUES
(1, 'original_dataset.csv', '2023-11-04'),
(3, 'grades_data_2023-11-05.csv', '2023-11-04'),
(4, 'grades_data_2023-11-06.csv', '2023-11-04'),
(13, 'grades_data_2023-11-10.csv', '2023-11-05');

-- --------------------------------------------------------

--
-- Table structure for table `ml_feed_dataset`
--

CREATE TABLE `ml_feed_dataset` (
  `id` int(11) NOT NULL,
  `uploaded_dataset_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ml_feed_dataset`
--

INSERT INTO `ml_feed_dataset` (`id`, `uploaded_dataset_name`) VALUES
(1, 'original_dataset.csv');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `specialization` varchar(255) NOT NULL,
  `subject` text NOT NULL,
  `question` text NOT NULL,
  `option_a` text NOT NULL,
  `option_b` text NOT NULL,
  `option_c` text NOT NULL,
  `option_d` text NOT NULL,
  `answer` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `specialization`, `subject`, `question`, `option_a`, `option_b`, `option_c`, `option_d`, `answer`) VALUES
(1, 'WMAD', 'ITEC101', 'In a computer, most processing takes place in _______?', 'CPU', 'RAM', 'Storage', 'Motherboard', 'option_a'),
(2, 'WMAD', 'ITEC101', 'Who is the father of Computer?', 'Allan Turing', 'Charles Babbage', 'Adam Osborne', 'John Moore', 'option_b'),
(3, 'WMAD', 'ITEC101', 'What converts an entire program into machine language?', 'CPU', 'Simulator', 'Interpreter', 'Compiler', 'option_d'),
(4, 'WMAD', 'ITEC101', 'Who is the father of personal computer?', 'Allen Turning', 'Charles Babbage', 'Edward Robert', 'Simur Cray', 'option_c'),
(5, 'WMAD', 'ITEC102', 'The name for a memory location that may hold data is ________.', 'Syntax', 'Key Word', 'Variable', 'Operator', 'option_c'),
(6, 'WMAD', 'ITEC102', 'Characters or symbols that perform operations on one or more operands are __________.', 'Variable', 'Operators', 'Program', 'Operating System', 'option_b'),
(7, 'WMAD', 'ITEC102', 'A(n) _______ is a set of instructions that the computer follows to solve a problem.', 'Variable', 'Operators', 'Program', 'Operating System', 'option_c'),
(8, 'WMAD', 'ITEC102', 'A(n) ______ is the most fundamental set of programs on a computer.', 'Operating System', 'Operators', 'Variable', 'Program', 'option_a'),
(9, 'WMAD', 'ITEC103', 'In Java, the _______________ is used to append one String to the end of another String.', 'Addition', 'Merging', 'concatenation', 'tying', 'option_c'),
(10, 'WMAD', 'ITEC103', '________ is referred to be as First In First Out list.', 'Queue', 'Stack', 'Array', 'List', 'option_a'),
(11, 'WMAD', 'ITEC103', 'A ________ follows the LIFO (Last In First Out) principle, i.e., the element inserted at the last is the first element to come\r\nout.', 'Queue', 'Stack', 'Array', 'List', 'option_b'),
(12, 'WMAD', 'ITEP101', 'The difference between the intentions and the allowable actions.', 'Constraints', 'Gulf of execution', 'Usability', 'Mapping', 'option_b'),
(13, 'WMAD', 'ITEP101', 'It limits the number of possibilities of what can be done with the objects.', 'Constraints', 'Gulf of Execution', 'Usability', 'Mapping', 'option_a'),
(14, 'WMAD', 'ITEP101', 'The measure of how well a specific user in a specific context can use a product/design to achieve a defined goal\r\neffectively, efficiently and satisfactorily.', 'Usability', 'Mapping', 'Constraint', 'Gulf of Execution', 'option_a'),
(15, 'WMAD', 'ITEP101', 'This refers to the relationship between controls and their effects in the world.', 'Constraints', 'Gulf of Execution', 'Mapping', 'Usability', 'option_c'),
(17, 'AMG', 'GEC106', 'Plato first developed the idea of art as__________.', 'Ars', 'Mime', 'Theater/Theatres', 'None of the Above', 'option_a'),
(18, 'AMG', 'GEC106', 'What do you call a collaborative form of fine art that uses live performers, typically actors or actresses, to present the a\r\ncollaborative form of fine art that uses live performers, typically actors or actresses, to present the experience of a real or\r\nimagined event before a live audience in a specific place, often a stage?', 'Ars', 'Mimesis', 'Theater/Theatre', 'None of the Above', 'option_a'),
(19, 'AMG', 'ITEP205', '__________ basically consists of video and sound cards, and cd - rom drives. To make it a little easier multimedia kits are\r\navailable that include all the necessary hardware and software to upgrade your present computer(s).', 'Multimedia Software', 'Multimedia Hardware', 'Multimedia', 'Animation', 'option_a'),
(20, 'AMG', 'ITEP205', '__________ is defined as the combination of text, audio, images, animation, or video to produce interactive content.\r\nLearn about media players, file formats, and how to work with audio and video software.', 'Multimedia Hardware', 'Multimedia Software', 'Animation', 'Multimedia', 'option_a'),
(21, 'AMG', 'ITEP205', '__________ is the use of a computer to present and combine text, graphics, audio, and video with links and tools that let\r\nthe user.', 'Multimedia Hardware', 'Multimedia Software', 'Animation', 'Multimedia', 'option_a'),
(22, 'AMG', 'ITEP205', '__________ is a method of photographing successive drawings, models, or even puppets, to create an illusion of\r\nmovement in a sequence', 'Multimedia Software', 'Multimedia Hardware', 'Multimedia', 'Animation', 'option_a'),
(23, 'SMP', 'ITEP 203', 'The number of rejected applicants for an internship.', 'Discrete', 'Continuous', 'Both', 'None of the above', 'option_a'),
(24, 'SMP', 'ITEP 203', 'The number of girls in a randomly selected five-child family.', 'Discrete', 'Continuous', 'Both', 'None of the above', 'option_a'),
(25, 'SMP', 'ITEP 203', 'The average amount spent on electricity each December by a randomly selected household in a certain province.', 'Discrete', 'Continuous', 'Both', 'None of the above', 'option_b'),
(26, 'SMP', 'GEC 105', 'It is the sharing of perspective, behavior and emotions between different individuals.', 'Social Media', 'Language', 'Communication', 'Speech', 'option_c'),
(27, 'SMP', 'GEC 105', 'You have watched a K-drama and noticed that Koreans have their own accent in speaking the English language. What\r\ncharacteristic of language is present in the situation.', 'Language is unique', 'Language is dynamic', 'Language is arbitrary', 'None of the above', 'option_a'),
(28, 'SMP', 'GEC 105', 'It pertains to the websites and applications that enable users to create and share content or to participate in social networking.', 'Blog', 'Social Media', 'Application', 'None of the above', 'option_b'),
(29, 'SMP', 'ITEP 203', 'What is the main goal of service request management?', 'To ensure that services meet the needs of customers', 'To optimize the use of resources', 'What is the main goal of service request management?', 'To ensure that services are aligned with business goals and objectives', 'option_d'),
(30, 'SMP', 'ITEP 203', 'What is the main goal of demand management?\r\n', 'To ensure that services meet the needs of customers', 'To optimize the use of resources', 'To ensure that services are delivered consistently and reliably', 'To ensure that services are aligned with business goals and objectives', 'option_a'),
(31, 'SMP', 'ITEP 203', 'What is the main goal of release management?', 'To ensure that services meet the needs of customers', 'To optimize the use of resources', 'To ensure that services are delivered consistently and reliably', 'To ensure that services are aligned with business goals and objectives', 'option_d'),
(32, 'SMP', 'ITEP 203', 'What is the main goal of change management?', 'To ensure that services meet the needs of customers', 'To optimize the use of resources', 'To ensure that services are delivered consistently and reliably', 'To ensure that services are aligned with business goals and objectives', 'option_c'),
(33, 'SMP', 'ITEP 203', 'What is the main goal of configuration management?', 'To ensure that services meet the needs of customers', 'To optimize the use of resources', 'To ensure that services are delivered consistently and reliably', 'To ensure that services are aligned with business goals and objectives', 'option_a'),
(34, 'SMP', 'ITEP 203', 'What is the main goal of financial management?', 'To ensure that services meet the needs of customers', ' To optimize the use of resources', 'To ensure that services are delivered consistently and reliably', 'To ensure that services are aligned with business goals and objectives', 'option_d'),
(35, 'SMP', 'ITEP 203', 'What is the main goal of availability management?', 'To ensure that services meet the needs of customers', 'To optimize the use of resources', 'To ensure that services are delivered consistently and reliably', ' To ensure that services are aligned with business goals and objectives', 'option_c'),
(36, 'SMP', 'ITEP 203', 'What is the main goal of capacity management?', 'To ensure that services meet the needs of customers', 'To optimize the use of resources', 'To ensure that services are delivered consistently and reliably', 'To ensure that services are aligned with business goals and objectives', 'option_b'),
(37, 'SMP', 'ITEP 203', 'What is the main goal of service level management?', 'To ensure that services meet the needs of customers', 'To optimize the use of resources', 'To ensure that services are delivered consistently and reliably', 'To ensure that services are aligned with business goals and objectives', 'option_a'),
(38, 'SMP', 'ITEP 203', 'Which of the following is NOT a key principle of service management?', 'Customer focus', 'Cost efficiency', 'Continuous improvement', 'Innovation', 'option_d'),
(39, 'SMP', 'ITEP 203', 'Which of the following processes is NOT a key process of service management?', 'Service design', 'Service deployment', 'Service operation', 'Service transition', 'option_b'),
(40, 'SMP', 'ITEP 203', 'Which of the following is NOT a goal of service management?', 'To increase customer satisfaction', 'To reduce cost', 'To increase revenue', 'To increase complexity', 'option_d'),
(41, 'SMP', 'ITEP 203', 'Which of the following is NOT a benefit of effective service management?', 'Improved customer satisfaction', 'Increased efficiency', 'Increased revenue', 'Increased risk', 'option_d'),
(42, 'SMP', 'ITEP 203', 'Which of the following is NOT a common service level agreement (SLA) metric?', 'Availability', 'Mean time to repair', 'Mean time between failures', 'Customer satisfaction', 'option_d'),
(43, 'AMG', 'ITEP 205', 'What is the process of creating the illusion of movement in a static medium?', 'Animation', 'Motion graphics', 'Cinematography', 'All of the above', 'option_a'),
(44, 'AMG', 'ITEP 205', 'Which of the following is NOT a type of animation?', '2D', '3D', 'Stop-motion', 'Live-action', 'option_a'),
(45, 'AMG', 'ITEP 205', 'What is the process of creating visual effects for film and television called?', 'Motion graphics', 'Visual effects', 'Animation', 'Cinematography', 'option_a'),
(46, 'AMG', 'ITEP 205', 'Which of the following is NOT a keyframe in animation?', 'In-between', 'Hold', 'Ease', 'Loop', 'option_a'),
(47, 'AMG', 'ITEP 205', 'Which software is commonly used for 3D animation?', 'Photoshop', 'After Effects', 'Blender', 'Inkscape', 'option_a'),
(48, 'AMG', 'ITEP 205', 'What is the process of creating the illusion of motion in a static image called?', 'Motion graphics', 'Cinematography', 'Compositing', 'Rotoscoping', 'option_a'),
(49, 'AMG', 'ITEP 205', 'What is the process of creating a smooth transition between two keyframes called?\r\n', 'Easing', 'In-betweening', 'Loop', 'Hold', 'option_a'),
(50, 'AMG', 'ITEP 205', 'What is the process of creating a seamless loop called?', 'Easing', 'In-betweening', 'Loop', 'Hold', 'option_a'),
(51, 'AMG', 'ITEP 205', 'What is the process of creating a pause in an animation called?', 'Easing', 'In-betweening', 'Loop', 'Hold', 'option_a'),
(52, 'AMG', 'ITEP 205', 'Which of the following is NOT a technique used in stop-motion animation?\r\n', 'Claymation', 'Cutout animation', 'Pixel art', 'Live-action', 'option_a'),
(53, 'AMG', 'ITEP 205', 'What is the process of tracing over live-action footage frame-by-frame called?', 'Rotoscoping', 'Motion graphics', 'Compositing', 'Keyframing', 'option_a'),
(54, 'AMG', 'ITEP 205', 'Which of the following is NOT a software commonly used for motion graphics?', 'Photoshop', 'After Effects', 'Blender', 'Illustrator', 'option_a'),
(55, 'AMG', 'ITEP 205', 'Which of the following is NOT a technique used in 2D animation?', 'Cell animation', 'Cutout animation', 'Pixel art', 'Live-action', 'option_a'),
(56, 'WMAD', 'ITEC 103', 'Which of the following is NOT a front-end web development language?', 'HTML', 'CSS', 'React', 'PHP', 'option_d'),
(57, 'WMAD', 'ITEC 103', 'Which of the following is NOT a back-end web development language?', 'HTML', 'Java', 'JavaScript', 'Python', 'option_a'),
(58, 'WMAD', 'ITEC 103', 'Which of the following is NOT a type of database commonly used in web development?', 'MySQL', 'MongoDB', 'Oracle', 'Excel', 'option_d'),
(59, 'WMAD', 'ITEC 103', 'Which of the following is NOT a web development framework?', 'Django', 'Ruby on Rails', 'Laravel', 'Excel', 'option_a'),
(60, 'WMAD', 'ITEC 103', 'What is the process of breaking down a web page into smaller, reusable pieces called?', 'Componentization', 'Modularization', 'Abstraction', 'Encapsulation', 'option_a'),
(62, 'AMG', 'GEC106', 'It is a Latin word which means a \"craft or specialized form of skill\".', 'Ars', 'Theater/Theatre', 'Mimesis', 'None of the Above', 'option_a');

-- --------------------------------------------------------

--
-- Table structure for table `students_acc`
--

CREATE TABLE `students_acc` (
  `userid` int(11) NOT NULL,
  `school_id` varchar(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `year_lvl` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `dp_img` varchar(100) DEFAULT NULL,
  `wmad_score` int(11) DEFAULT NULL,
  `amg_score` int(11) DEFAULT NULL,
  `smp_score` int(11) DEFAULT NULL,
  `specialization` varchar(255) DEFAULT NULL,
  `itec102` float DEFAULT NULL,
  `itec103` float DEFAULT NULL,
  `itec205` float DEFAULT NULL,
  `itel201` float DEFAULT NULL,
  `itec204` float DEFAULT NULL,
  `itep204` float DEFAULT NULL,
  `gec106` float DEFAULT NULL,
  `itep205` float DEFAULT NULL,
  `itel203` float DEFAULT NULL,
  `gec108` float DEFAULT NULL,
  `itep203` float DEFAULT NULL,
  `itep207` float DEFAULT NULL,
  `grade_based` varchar(255) DEFAULT NULL,
  `preference_based` varchar(255) DEFAULT NULL,
  `pref_based_desc` text DEFAULT NULL,
  `student_choice` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students_acc`
--

INSERT INTO `students_acc` (`userid`, `school_id`, `fullname`, `year_lvl`, `password`, `dp_img`, `wmad_score`, `amg_score`, `smp_score`, `specialization`, `itec102`, `itec103`, `itec205`, `itel201`, `itec204`, `itep204`, `gec106`, `itep205`, `itel203`, `gec108`, `itep203`, `itep207`, `grade_based`, `preference_based`, `pref_based_desc`, `student_choice`) VALUES
(10021, '0320-0489', 'Guest 2', '2ND YEAR', '827ccb0eea8a706c4c34a16891f84e7b', NULL, 7, 13, 6, 'AMG', 1, 1, 1, 1.5, 2, 2.25, 1.25, 1.25, 1.25, 2.5, 2.75, 4, 'AMG', 'AMG', '\r\n\r\nBased on the user\'s preferences, the best specialization to recommend is Animation and Motion Graphics. All of the user\'s selected preferences are related to creating animated content, from designing 3D models to adding captivating visual effects, and utilizing software such as Adobe After Effects. Therefore, if the user is looking to specialize in animation and motion graphics production, Animation and Motion Graphics is the perfect choice.', NULL),
(10002, '0320-0533', 'Andrea Cornejo', '3RD YEAR', '4f1c9ffa941c6026b7a7199603327a8e', '', 13, 7, 3, 'WMAD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10008, '0323-0483', 'Mikasa Ackerman', '4TH YEAR', '827ccb0eea8a706c4c34a16891f84e7b', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9999, '0320-0481', 'Paolo Z. Bachicha', '1ST YEAR', '827ccb0eea8a706c4c34a16891f84e7b', 'a1.jpg', 14, 10, 12, 'WMAD', 1.5, 1.75, 1.5, 1.75, 1.5, 1.5, 1.25, 1.5, 1.5, 1.25, 2, 1.75, 'WMAD', 'WMAD', '\r\n\r\nBased on the user\'s preferences, they are most interested in Web and Mobile Application Development. The majority of the selected preferences fall under this particular specialization, such as problem-solving in coding, user experience (UX) design, programming languages (e.g., Java, Swift), user interface (UI) design, and mobile app optimization. These skills are essential for developing web and mobile applications, making it the ideal specialization for the user.', 'AMG'),
(10010, '0320-0485', 'Isiah Latayan', '3RD YEAR', '827ccb0eea8a706c4c34a16891f84e7b', 'roque.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10020, '0320-0487', 'Yvo Velasco', '2ND YEAR', '827ccb0eea8a706c4c34a16891f84e7b', 'pengu darcc.jpg', NULL, 0, NULL, 'AMG', 1.5, 1.75, 1.5, 1.75, 1.5, 1.5, 1.25, 1.5, 1.25, 1.25, 2, 1.75, 'WMAD', 'AMG', '\r\n\r\n Based on the preferences given, it seems that the majority of them lie under Animation and Motion Graphics. This specialization covers both 2D & 3D animation, visual effects, character animation, sound design, storyboarding, scriptwriting, and animation software. Therefore, it is the most suitable specialization for the user.', NULL),
(10022, '0320-1234', 'josef', '1ST YEAR', 'd738a3ca632764f074626b7e4014295c', 'a3.jpg', 6, 10, 7, 'AMG', 1.25, 2.5, 2.5, 1.5, 2.25, 2, 2, 1.75, 2.25, 2.25, 2, 1.75, 'WMAD', 'AMG', ' \r\n\r\nBased on the user\'s selected preferences, the most suitable specialization for them would be Animation and Motion Graphics. Many of the selected preferences relate to the animation industry, such as Sound Design, Storyboarding and Scriptwriting, Animation Software, and User Interface (UI) Design. These all show that the user has a strong interest in animation and motion graphics. Team Leadership and Collaboration, Process Optimization, and Mobile App Optimization can all be beneficial skills for working in the animation industry, but are secondary to the core animation-related skills.', NULL),
(10023, '0320-0320', 'josefjosef', '1ST YEAR', '6f0f4d469eaead0ac18da3a460f263b6', 'a3.jpg', 5, 13, 5, 'AMG', 1, 1, 1, 1, 1, 1.25, 1.25, 1.5, 1, 1.25, 1.5, 1, 'WMAD', 'WMAD', ' \r\n\r\nBased on the user selected preferences, the most suitable specialization for them would be Web and Mobile Application Development. This specialization focuses on all the areas of coding, UX design, programming languages, UI design, and optimizing mobile apps. Therefore, you can fulfill the user\'s needs and help them achieve their goal of becoming a skilled developer.', 'WMAD');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_acc`
--
ALTER TABLE `admin_acc`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `blog_data`
--
ALTER TABLE `blog_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grades_dataset`
--
ALTER TABLE `grades_dataset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ml_feed_dataset`
--
ALTER TABLE `ml_feed_dataset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students_acc`
--
ALTER TABLE `students_acc`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `school_id_2` (`school_id`),
  ADD UNIQUE KEY `school_id` (`school_id`(9));

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_acc`
--
ALTER TABLE `admin_acc`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `blog_data`
--
ALTER TABLE `blog_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `grades_dataset`
--
ALTER TABLE `grades_dataset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `ml_feed_dataset`
--
ALTER TABLE `ml_feed_dataset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `students_acc`
--
ALTER TABLE `students_acc`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10024;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
