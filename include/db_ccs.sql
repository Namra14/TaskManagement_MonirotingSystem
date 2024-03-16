-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 04, 2023 at 02:09 PM
-- Server version: 5.7.36
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

DROP TABLE IF EXISTS `admin_acc`;
CREATE TABLE IF NOT EXISTS `admin_acc` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `admin_username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_acc`
--

INSERT INTO `admin_acc` (`admin_id`, `name`, `admin_username`, `password`, `user_type`) VALUES
(1, 'Paolo Bachicha', 'superadmin', '21232f297a57a5a743894a0e4a801fc3', 'superadmin'),
(2, 'Josef Liu', 'admin2', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(4, 'James Roland Angeles', 'admin3', '21232f297a57a5a743894a0e4a801fc3', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `blog_data`
--

DROP TABLE IF EXISTS `blog_data`;
CREATE TABLE IF NOT EXISTS `blog_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `introduction` longtext,
  `content` longtext,
  `conclusion` longtext,
  `date_posted` datetime DEFAULT CURRENT_TIMESTAMP,
  `content_creator` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog_data`
--

INSERT INTO `blog_data` (`id`, `title`, `introduction`, `content`, `conclusion`, `date_posted`, `content_creator`) VALUES
(7, '\"Web and Mobile Application Development: An Overview\"', 'Web and mobile application development is a rapidly growing field, with new technologies and tools emerging all the time. These applications have become an integral part of our daily lives, making it easier to communicate, access information, and complete tasks. If you\'re interested in learning more about this field, then this blog post is for you.', 'Web applications are software programs that are accessed over the internet through a web browser. These applications are developed using a variety of programming languages, such as HTML, CSS, and JavaScript. Some popular examples of web applications include online shopping sites, social media platforms, and email services.<br><br>\n\nMobile applications, on the other hand, are software programs that are designed to be used on mobile devices such as smartphones and tablets. These applications can be native, meaning they are developed specifically for a particular platform (such as iOS or Android), or they can be cross-platform, meaning they can be used on multiple platforms. Mobile applications can be downloaded from app stores, such as the Apple App Store or Google Play Store.<br><br>\n\nBoth web and mobile application development require a strong understanding of programming languages, as well as an understanding of user experience and design. Developers must also be able to troubleshoot and solve problems, as well as stay up-to-date with the latest technologies and best practices.', 'Web and mobile application development is a dynamic field that offers a range of career opportunities. Whether you\'re interested in developing the next big app or just want to learn more about this field, there are many resources available to help you get started. With the right knowledge and skills, you can enter this exciting and growing industry and make your mark as a developer.', '2023-01-02 21:22:09', 'Kimcarlo Alvarez'),
(6, '\"IT Specialization Course: Animation and Motion Graphics\"          ', '                        Animation and motion graphics are a staple of modern media, with applications in film, television, advertising, and more. If you\'re interested in pursuing a career in this field, then an IT specialization course in animation and motion graphics may be the right fit for you. In this blog post, we\'ll give you an overview of what to expect from this type of course and how it can help you succeed in your career.                    ', 'An IT specialization course in animation and motion graphics typically covers the principles and techniques of animation and motion graphics design, including 2D and 3D animation, character design, and compositing. Students learn to use software such as Adobe After Effects, Adobe Photoshop, and Autodesk Maya to create professional-quality animations and motion graphics.<br><br>\r\n\r\nIn addition to technical skills, an IT specialization course in animation and motion graphics may also cover topics such as storytelling, design principles, and project management. These skills are essential for success in the industry, as they help students to develop their creative vision and to effectively communicate their ideas to clients and team members.<br><br>\r\n\r\nUpon completion of an IT specialization course in animation and motion graphics, students should have a strong portfolio of work to showcase their skills and a solid foundation in the principles of animation and motion graphics design. This can help them to stand out in a competitive job market and to pursue exciting careers in the field.<br><br>', 'An IT specialization course in animation and motion graphics is a great way to develop the skills and knowledge you need to succeed in this exciting field. With the right course and a dedication to your studies, you can join the ranks of professional animators and motion graphics designers and make your mark in the world of media.\r\n                                              \r\n                                              \r\n                    ', '2023-01-02 21:22:09', 'Paolo Bachicha'),
(8, '\"IT Specialization Course: Animation and Motion Graphics\"', 'Animation and motion graphics are a staple of modern media, with applications in film, television, advertising, and more. If you\'re interested in pursuing a career in this field, then an IT specialization course in animation and motion graphics may be the right fit for you. In this blog post, we\'ll give you an overview of what to expect from this type of course and how it can help you succeed in your career.', 'An IT specialization course in animation and motion graphics typically covers the principles and techniques of animation and motion graphics design, including 2D and 3D animation, character design, and compositing. Students learn to use software such as Adobe After Effects, Adobe Photoshop, and Autodesk Maya to create professional-quality animations and motion graphics.<br><br>\r\n\r\nIn addition to technical skills, an IT specialization course in animation and motion graphics may also cover topics such as storytelling, design principles, and project management. These skills are essential for success in the industry, as they help students to develop their creative vision and to effectively communicate their ideas to clients and team members.<br><br>\r\n\r\nUpon completion of an IT specialization course in animation and motion graphics, students should have a strong portfolio of work to showcase their skills and a solid foundation in the principles of animation and motion graphics design. This can help them to stand out in a competitive job market and to pursue exciting careers in the field.<br><br>', 'An IT specialization course in animation and motion graphics is a great way to develop the skills and knowledge you need to succeed in this exciting field. With the right course and a dedication to your studies, you can join the ranks of professional animators and motion graphics designers and make your mark in the world of media.', '2023-01-02 21:22:09', ''),
(9, '\"The World of Gaming: An Introduction\"', 'Gaming is a pastime enjoyed by millions of people all over the world. From casual mobile games to competitive esports tournaments, there is a game for everyone. In this blog post, we\'ll give you an overview of the world of gaming and how it has evolved over the years.', 'Gaming has come a long way since the days of Pong and Pac-Man. Today\'s games are more realistic and immersive than ever before, with graphics and gameplay that rival those of major Hollywood productions. The gaming industry is now a multi-billion dollar industry, with major companies such as Sony, Microsoft, and Nintendo competing to release the latest and greatest gaming hardware and software.<br><br>\r\n\r\nThere are many different types of games to choose from, ranging from first-person shooters and role-playing games to sports games and strategy games. There are also countless genres within these categories, so you\'re sure to find a game that fits your interests and skill level.<br><br>\r\n\r\nGaming has also become a major spectator sport, with professional esports tournaments drawing millions of viewers around the world. These tournaments feature top players competing in games such as League of Legends, Overwatch, and Counter-Strike: Global Offensive, with prize pools that can reach into the millions of dollars.<br><br>', 'The world of gaming is vast and varied, with something for everyone. Whether you\'re a casual gamer or a competitive esports player, there is a place for you in the gaming community. So why not give it a try and see what all the hype is about?', '2023-01-02 21:22:09', ''),
(14, '\"Fliptop Battles: The World of Philippine Hip-hop\"', 'Fliptop battles are a popular form of entertainment in the Philippines, featuring rappers competing against each other in freestyle battles. These battles have helped to popularize hip-hop culture in the Philippines and have launched the careers of many successful artists. In this blog post, we\'ll give you an overview of the world of Fliptop battles and how they have impacted the Philippine music scene.', 'Fliptop battles originated in the Philippines in the early 2010s and quickly gained popularity through social media and online streaming platforms. These battles feature two rappers competing against each other in a freestyle format, with the goal of outshining their opponent with clever rhymes, punchlines, and insults. Fliptop battles are known for their high-energy performances and humorous lyrics, and they have become a fixture in the Philippine hip-hop scene.\r\n\r\nFliptop battles have helped to popularize hip-hop culture in the Philippines and have launched the careers of many successful artists. Some of the most popular Fliptop battlers, such as Abra, Loonie, and Sinio, have gone on to release successful albums and perform at major music festivals. Fliptop battles have also inspired the creation of other popular Philippine hip-hop events, such as the Grind Time Rap Battle League and the Philippine Hip-hop Music Festival.', 'Fliptop battles are a unique and exciting part of the Philippine music scene, offering a platform for aspiring rappers to showcase their skills and for fans to discover new talent. Whether you\'re a fan of hip-hop or just looking for something different, Fliptop battles are worth checking out.', '2023-01-02 22:17:49', 'Paolo Bachicha'),
(15, '                    	Lorem Ipsum  Lorem Ipsum         		\r\n                    ', '                        Lorem Ipsum Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum                     ', '                         Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum.<br><br>\r\n\r\n Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum                             \r\n                    ', '                         Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum  Lorem Ipsum                           \r\n                    ', '2023-01-02 22:33:37', 'Ivoh Isiah Latayan');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `specialization` varchar(255) NOT NULL,
  `subject` text NOT NULL,
  `question` text NOT NULL,
  `option_a` text NOT NULL,
  `option_b` text NOT NULL,
  `option_c` text NOT NULL,
  `option_d` text NOT NULL,
  `answer` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `specialization`, `subject`, `question`, `option_a`, `option_b`, `option_c`, `option_d`, `answer`) VALUES
(1, 'WMAD', 'ITEC101', '1. In a computer, most processing takes place in _______?', 'CPU', 'RAM', 'Storage', 'Motherboard', 'option_a'),
(2, 'WMAD', 'ITEC101', '2. Who is the father of Computer?', 'Allan Turing', 'Charles Babbage', 'Adam Osborne', 'John Moore', 'option_b'),
(3, 'WMAD', 'ITEC101', '3. What converts an entire program into machine language?', 'CPU', 'Simulator', 'Interpreter', 'Compiler', 'option_d'),
(4, 'WMAD', 'ITEC101', '4. Who is the father of personal computer?', 'Allen Turning', 'Charles Babbage', 'Edward Robert', 'Simur Cray', 'option_c'),
(5, 'WMAD', 'ITEC102', '5. The name for a memory location that may hold data is ________.', 'Syntax', 'Key Word', 'Variable', 'Operator', 'option_c'),
(6, 'WMAD', 'ITEC102', '6. Characters or symbols that perform operations on one or more operands are __________.', 'Variable', 'Operators', 'Program', 'Operating System', 'option_b'),
(7, 'WMAD', 'ITEC102', '7. A(n) _______ is a set of instructions that the computer follows to solve a problem.', 'Variable', 'Operators', 'Program', 'Operating System', 'option_c'),
(8, 'WMAD', 'ITEC102', '8. A(n) ______ is the most fundamental set of programs on a computer.', 'Operating System', 'Operators', 'Variable', 'Program', 'option_a'),
(9, 'WMAD', 'ITEC103', '9. In Java, the _______________ is used to append one String to the end of another String.', 'Addition', 'Merging', 'concatenation', 'tying', 'option_c'),
(10, 'WMAD', 'ITEC103', '10. ________ is referred to be as First In First Out list.', 'Queue', 'Stack', 'Array', 'List', 'option_a'),
(11, 'WMAD', 'ITEC103', '11. A ________ follows the LIFO (Last In First Out) principle, i.e., the element inserted at the last is the first element to come\r\nout.', 'Queue', 'Stack', 'Array', 'List', 'option_b'),
(12, 'WMAD', 'ITEP101', '12. The difference between the intentions and the allowable actions.', 'Constraints', 'Gulf of execution', 'Usability', 'Mapping', 'option_b'),
(13, 'WMAD', 'ITEP101', '13. It limits the number of possibilities of what can be done with the objects.', 'Constraints', 'Gulf of Execution', 'Usability', 'Mapping', 'option_a'),
(14, 'WMAD', 'ITEP101', '14. The measure of how well a specific user in a specific context can use a product/design to achieve a defined goal\r\neffectively, efficiently and satisfactorily.', 'Usability', 'Mapping', 'Constraint', 'Gulf of Execution', 'option_a'),
(15, 'WMAD', 'ITEP101', '15. This refers to the relationship between controls and their effects in the world.', 'Constraints', 'Gulf of Execution', 'Mapping', 'Usability', 'option_c'),
(16, 'AMG', 'GEC106', '1. It is a Latin word which means a \"craft or specialized form of skill\".', 'Ars', 'Theater/Theatre', 'Mimesis', 'None of the Above', 'option_a'),
(17, 'AMG', 'GEC106', '2. Plato first developed the idea of art as__________.', 'Ars', 'Mimesis', 'Theater/Theatre', 'None of the Above', 'option_b'),
(18, 'AMG', 'GEC106', '3. What do you call a collaborative form of fine art that uses live performers, typically actors or actresses, to present the a\r\ncollaborative form of fine art that uses live performers, typically actors or actresses, to present the experience of a real or\r\nimagined event before a live audience in a specific place, often a stage?', 'Ars', 'Mimesis', 'Theater/Theatre', 'None of the Above', 'option_c'),
(19, 'AMG', 'ITEP205', '4. __________ basically consists of video and sound cards, and cd - rom drives. To make it a little easier multimedia kits are\r\navailable that include all the necessary hardware and software to upgrade your present computer(s).', 'Multimedia Software', 'Multimedia Hardware', 'Multimedia', 'Animation', 'option_b'),
(20, 'AMG', 'ITEP205', '5. __________ is defined as the combination of text, audio, images, animation, or video to produce interactive content.\r\nLearn about media players, file formats, and how to work with audio and video software.', 'Multimedia Hardware', 'Multimedia Software', 'Animation', 'Multimedia', 'option_b'),
(21, 'AMG', 'ITEP205', '6. __________ is the use of a computer to present and combine text, graphics, audio, and video with links and tools that let\r\nthe user.', 'Multimedia Hardware', 'Multimedia Software', 'Animation', 'Multimedia', 'option_d'),
(22, 'AMG', 'ITEP205', '7. __________ is a method of photographing successive drawings, models, or even puppets, to create an illusion of\r\nmovement in a sequence', 'Multimedia Software', 'Multimedia Hardware', 'Multimedia', 'Animation', 'option_d'),
(23, 'SMP', 'ITEP 203', '1. The number of rejected applicants for an internship.', 'Discrete', 'Continuous', 'Both', 'None of the above', 'option_a'),
(24, 'SMP', 'ITEP 203', '2. The number of girls in a randomly selected five-child family.', 'Discrete', 'Continuous', 'Both', 'None of the above', 'option_a'),
(25, 'SMP', 'ITEP 203', '3. The average amount spent on electricity each December by a randomly selected household in a certain province.', 'Discrete', 'Continuous', 'Both', 'None of the above', 'option_b'),
(26, 'SMP', 'GEC 105', '4. It is the sharing of perspective, behavior and emotions between different individuals.', 'Social Media', 'Language', 'Communication', 'Speech', 'option_c'),
(27, 'SMP', 'GEC 105', '5. You have watched a K-drama and noticed that Koreans have their own accent in speaking the English language. What\r\ncharacteristic of language is present in the situation.', 'Language is unique', 'Language is dynamic', 'Language is arbitrary', 'None of the above', 'option_a'),
(28, 'SMP', 'GEC 105', '6. It pertains to the websites and applications that enable users to create and share content or to participate in social networking.', 'Blog', 'Social Media', 'Application', 'None of the above', 'option_b'),
(29, 'SMP', 'ITEP 203', '7. What is the main goal of service request management?', 'To ensure that services meet the needs of customers\r\n', 'To optimize the use of resources', 'What is the main goal of service request management?', 'To ensure that services are aligned with business goals and objectives\r\n\r\n', 'option_d'),
(30, 'SMP', 'ITEP 203', '8. What is the main goal of demand management?\r\n', 'To ensure that services meet the needs of customers\r\n', 'To optimize the use of resources', 'To ensure that services are delivered consistently and reliably', 'To ensure that services are aligned with business goals and objectives', 'option_a'),
(31, 'SMP', 'ITEP 203', '9. What is the main goal of release management?', 'To ensure that services meet the needs of customers', 'To optimize the use of resources\r\n', 'To ensure that services are delivered consistently and reliably', 'To ensure that services are aligned with business goals and objectives', 'option_d'),
(32, 'SMP', 'ITEP 203', '10. What is the main goal of change management?', 'To ensure that services meet the needs of customers', 'To optimize the use of resources', 'To ensure that services are delivered consistently and reliably', 'To ensure that services are aligned with business goals and objectives', 'option_c'),
(33, 'SMP', 'ITEP 203', '11. What is the main goal of configuration management?', 'To ensure that services meet the needs of customers', 'To optimize the use of resources', 'To ensure that services are delivered consistently and reliably', 'To ensure that services are aligned with business goals and objectives', 'option_a'),
(34, 'SMP', 'ITEP 203', '12. What is the main goal of financial management?', 'To ensure that services meet the needs of customers', ' To optimize the use of resources', 'To ensure that services are delivered consistently and reliably', 'To ensure that services are aligned with business goals and objectives', 'option_d'),
(35, 'SMP', 'ITEP 203', '13. What is the main goal of availability management?', 'To ensure that services meet the needs of customers', 'To optimize the use of resources', 'To ensure that services are delivered consistently and reliably', ' To ensure that services are aligned with business goals and objectives', 'option_c'),
(36, 'SMP', 'ITEP 203', '14.What is the main goal of capacity management?', 'To ensure that services meet the needs of customers', 'To optimize the use of resources', 'To ensure that services are delivered consistently and reliably', 'To ensure that services are aligned with business goals and objectives', 'option_b'),
(37, 'SMP', 'ITEP 203', '15. What is the main goal of service level management?', 'To ensure that services meet the needs of customers', 'To optimize the use of resources', 'To ensure that services are delivered consistently and reliably', 'To ensure that services are aligned with business goals and objectives', 'option_a'),
(38, 'SMP', 'ITEP 203', '16. Which of the following is NOT a key principle of service management?', 'Customer focus', 'Cost efficiency', 'Continuous improvement', 'Innovation', 'option_d'),
(39, 'SMP', 'ITEP 203', '17. Which of the following processes is NOT a key process of service management?', 'Service design', 'Service deployment', 'Service operation', 'Service transition', 'option_b'),
(40, 'SMP', 'ITEP 203', '18. Which of the following is NOT a goal of service management?', 'To increase customer satisfaction', 'To reduce cost', 'To increase revenue', 'To increase complexity', 'option_d'),
(41, 'SMP', 'ITEP 203', '19. Which of the following is NOT a benefit of effective service management?', 'Improved customer satisfaction', 'Increased efficiency', 'Increased revenue', 'Increased risk', 'option_d'),
(42, 'SMP', 'ITEP 203', '20. Which of the following is NOT a common service level agreement (SLA) metric?', 'Availability', 'Mean time to repair\r\n', 'Mean time between failures\r\n', 'Customer satisfaction', 'option_d'),
(43, 'AMG', 'ITEP 205', '8. What is the process of creating the illusion of movement in a static medium?', 'Animation', 'Motion graphics', 'Cinematography', 'All of the above', 'option_a'),
(44, 'AMG', 'ITEP 205', '9. Which of the following is NOT a type of animation?', '2D', '3D', 'Stop-motion', 'Live-action', 'option_d'),
(45, 'AMG', 'ITEP 205', '10. What is the process of creating visual effects for film and television called?', 'Motion graphics', 'Visual effects', 'Animation', 'Cinematography', 'option_b'),
(46, 'AMG', 'ITEP 205', '11. Which of the following is NOT a keyframe in animation?', 'In-between', 'Hold', 'Ease', 'Loop', 'option_d'),
(47, 'AMG', 'ITEP 205', '12. Which software is commonly used for 3D animation?', 'Photoshop', 'After Effects', 'Blender', 'Inkscape', 'option_c'),
(48, 'AMG', 'ITEP 205', '13. What is the process of creating the illusion of motion in a static image called?', 'Motion graphics', 'Cinematography\r\n', 'Compositing', 'Rotoscoping\r\n', 'option_a'),
(49, 'AMG', 'ITEP 205', '14. What is the process of creating a smooth transition between two keyframes called?\r\n', 'Easing', 'In-betweening\r\n', 'Loop', 'Hold', 'option_a'),
(50, 'AMG', 'ITEP 205', '15. What is the process of creating a seamless loop called?', 'Easing', 'In-betweening\r\n', 'Loop', 'Hold', 'option_d'),
(51, 'AMG', 'ITEP 205', '16. What is the process of creating a pause in an animation called?', 'Easing', 'In-betweening', 'Loop', 'Hold', 'option_d'),
(52, 'AMG', 'ITEP 205', '17.Which of the following is NOT a technique used in stop-motion animation?\r\n', 'Claymation', 'Cutout animation\r\n', 'Pixel art\r\n', 'Live-action\r\n', 'option_d'),
(53, 'AMG', 'ITEP 205', '18. What is the process of tracing over live-action footage frame-by-frame called?', 'Rotoscoping', 'Motion graphics', 'Compositing', 'Keyframing', 'option_a'),
(54, 'AMG', 'ITEP 205', '19. Which of the following is NOT a software commonly used for motion graphics?', 'Photoshop', 'After Effects', 'Blender', 'Illustrator', 'option_c'),
(55, 'AMG', 'ITEP 205', '20. Which of the following is NOT a technique used in 2D animation?', 'Cell animation', 'Cutout animation', 'Pixel art', 'Live-action', 'option_d'),
(56, 'WMAD', 'ITEC 103', '16. Which of the following is NOT a front-end web development language?', 'HTML', 'CSS', 'JavaScript', 'PHP', 'option_d'),
(57, 'WMAD', 'ITEC 103', '17. Which of the following is NOT a back-end web development language?', 'HTML', 'Java', 'JavaScript', 'Python', 'option_a'),
(58, 'WMAD', 'ITEC 103', '18. Which of the following is NOT a type of database commonly used in web development?', 'MySQL', 'MongoDB', 'Oracle', 'Excel', 'option_d'),
(59, 'WMAD', 'ITEC 103', '19. Which of the following is NOT a web development framework?', 'Django', 'Ruby on Rails', 'Laravel', 'Excel', 'option_d'),
(60, 'WMAD', 'ITEC 103', '20. What is the process of breaking down a web page into smaller, reusable pieces called?', 'Componentization', 'Modularization', 'Abstraction', 'Encapsulation', 'option_a');

-- --------------------------------------------------------

--
-- Table structure for table `students_acc`
--

DROP TABLE IF EXISTS `students_acc`;
CREATE TABLE IF NOT EXISTS `students_acc` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `school_id` varchar(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `year_lvl` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `dp_img` varchar(100) DEFAULT NULL,
  `wmad_score` int(11) DEFAULT NULL,
  `amg_score` int(11) DEFAULT NULL,
  `smp_score` int(11) DEFAULT NULL,
  `specialization` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`userid`),
  UNIQUE KEY `school_id_2` (`school_id`),
  UNIQUE KEY `school_id` (`school_id`(9))
) ENGINE=MyISAM AUTO_INCREMENT=10008 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students_acc`
--

INSERT INTO `students_acc` (`userid`, `school_id`, `fullname`, `year_lvl`, `password`, `dp_img`, `wmad_score`, `amg_score`, `smp_score`, `specialization`) VALUES
(1, '0320-0481', 'Paolo Bachicha', '3RD YEAR', '827ccb0eea8a706c4c34a16891f84e7b', 'a1.jpg', 0, 0, 7, 'SMP'),
(10006, '0320-0483', 'Ivoh Isiah Latayan', '1ST YEAR', '25f9e794323b453885f5181f1b624d0b', 'PineappleJuice.jpeg', 16, 6, 4, 'WMAD'),
(10007, '1111-1114', 'Joven Ray Bagayawa', '3RD YEAR', '827ccb0eea8a706c4c34a16891f84e7b', NULL, NULL, NULL, NULL, NULL),
(10001, '1111-1123', 'Kimcarlo Alvarez', '1ST YEAR', '827ccb0eea8a706c4c34a16891f84e7b', '', NULL, NULL, NULL, 'WMAD'),
(10002, '0320-0533', 'Andrea Cornejo', '3RD YEAR', '4f1c9ffa941c6026b7a7199603327a8e', '', 13, 7, 3, 'WMAD'),
(10005, '15-0922', 'Russel Bachicha', '3RD YEAR', '202cb962ac59075b964b07152d234b70', NULL, 11, 7, 6, 'WMAD');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
