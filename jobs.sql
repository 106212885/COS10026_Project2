-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2025 at 09:09 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quantumshield_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `ref_id` varchar(11) NOT NULL,
  `position_title` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `salary_range` varchar(50) NOT NULL,
  `report_manager` text DEFAULT NULL,
  `key_responsibilities` varchar(255) NOT NULL,
  `ref_link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`ref_id`, `position_title`, `description`, `salary_range`, `report_manager`, `key_responsibilities`, `ref_link`) VALUES
('CA098', 'Cybersecurity Analyst', 'As a Cybersecurity Analyst, you\'re responsible for an organization\'s digital infrastructure. Your primary responsibility is to monitor, analyze, and respond to security threats that could compromise sensitive data, disrupt operations, or damage reputation. You play a crucial role in identifying vulnerabilities, investigating incidents, \r\nand implementing protective measures to ensure systems remain secure and compliant. ', 'RM4500-6800', 'IT Security Manager', 'Key Responsibilities:\r\n- Monitor alerts and research threat activity.\r\n- Generate, execute and analyze security reports.\r\n- Perform in-depth security checks and monitor for threats to detect, analyze, and respond to security issues and weaknesses.\r\n- Cond', 'https://my.jobstreet.com/cybersecurity-analyst-jobs?jobId=86408084&type=standard'),
('CS288', 'Cybersecurity Specialist', ' As a Cybersecurity Specialist, you\'re responsible for protecting computer systems, networks, and data from unauthorized access, theft, or damage. You play a critical role in defending computer \r\nsystems, networks, and sensitive data against unauthorized access, cyberattacks, and potential breaches. Your expertise ensures the confidentiality, integrity, and availability of information across an organization\'s infrastructure.', 'RM6000-9000', 'IT Security Manager', 'Key Responsibilities:\r\n- Develop and enforce security policies and procedures.\r\n- Monitor network traffic for suspicious activity.\r\n- Maintain documentation related to security configurations, incidents, and responses.\r\n- Conduct regular risk assessments ', 'https://my.jobstreet.com/job/86617837?type=standard&ref=search-standalone#sol=c00f6511517bd7093b6d8724932027faa41e6b17'),
('IM404', 'IT Support Specialist/ IT Manager', 'As a IT Support Specialist, you are responsible for maintaining and supporting the day-to-day operation of the IT infrastructure, providing technical support, managing IT projects and ensuring the network\'s security and stability.', 'RM3000-5000', 'IT Manager', 'Key Responsibilities:\r\n- Provide technical support for hardware and software issues.\r\n- Manage IT infrastructure, including servers, networks, and peripherals.\r\n- Monitor system performance and security.\r\n- Coordinate with vendors for equipment purchase a', 'https://www.jobstreet.com.my/en/job/it-support-specialist-36743170?sectionRank=4&jobId=36743170&sectionRank=4&sectionType=searchResults&jobPosition=1'),
('NA718', 'Network Administrator', 'As a Network Administrator, you are responsible for managing, implementing and maintaining the school\'s network infrastructure and security. This role requires the ideal candidate to have a strong technical foundation, proactive problem-solving skills and experience with designing, securing and maintaining the overall network performance and security of the school.', 'RM4000-5000', 'IT Infrastructure Manager', 'Key Responsibilities:\r\n- Monitor network performance for hardware and software and troubleshoot issues to ensure optimal operation and minimal downtime.\r\n- Configure, manage and optimize routers, switches, firewalls, wireless access points and structured ', 'https://malaysia.indeed.com/viewjob?jk=5da48d84b5b410eb&from=mobRdr&utm_source=%2Fm%2F&utm_medium=redir&utm_campaign=dt'),
('NE911', 'Network Security Engineer', 'As a Network Security Engineer, you\'re responsible for implementing and monitoring robust network solutions that enable our customers to operate efficiently and securely. You ensure that every packet of information travels safely across systems, minimizing vulnerabilities and maximizing uptime.', 'RM3000-4700', 'IT Infrastructure Manager', 'Key Responsibilities:\r\n- Provides patch management, security, and cloud infrastructure.\r\n- Configure and maintain firewalls, VPNs, proxies, and network security appliances.\r\n- Monitor network traffic for suspicious behavior.\r\n- Assist cybersecurity team t', 'https://my.jobstreet.com/job/86779235?type=standard&ref=search-standalone#sol=6fe57d03830e2002ef5833bbd8051114ce64e077');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`ref_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
