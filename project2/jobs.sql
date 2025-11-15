-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2025 at 06:51 AM
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
  `title` varchar(100) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `salary_range` varchar(50) NOT NULL,
  `reporting_manager` varchar(100) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `references_link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`ref_id`, `title`, `image`, `subtitle`, `description`, `salary_range`, `reporting_manager`, `details`, `references_link`) VALUES
('CA098', 'Cybersecurity Analyst', 'images/ca098.jpeg', 'Decoding Threats, Delivering Peace of Mind.', 'As a Cybersecurity Analyst, you\'re responsible for an organization\'s digital infrastructure. Your primary responsibility is to monitor, analyze, and respond to security threats that could compromise sensitive data, disrupt operations, or damage reputation. You play a crucial role in identifying vulnerabilities, investigating incidents, and implementing protective measures to ensure systems remain secure and compliant.', 'RM4500-6800', 'IT Security Manager', '<p><strong>Key Responsibilities:</strong></p>\r\n<ul>\r\n  <li>Monitor alerts and research threat activity.</li>\r\n  <li>Generate, execute and analyze security reports.</li>\r\n  <li>Performing in-depth security checks and monitoring for threats to detect, analyze, and respond to security issues and weaknesses.</li>\r\n  <li>Conducting security assessments and penetration testing.</li>\r\n  <li>Providing expert advice and technical help to the wider IT and security teams.</li>\r\n</ul>\r\n<p><strong>Required qualifications, skills, knowledge and attributes:</strong></p>\r\n<ol>\r\n  <li><strong>Essential:</strong>\r\n    <ul>\r\n      <li>Bachelor\'s degree in Computer Science, Information Technology, Cybersecurity, or a related field</li>\r\n      <li>2 years of practical experience in cybersecurity</li>\r\n      <li>Good understanding of networking, operating systems (Windows, Linux), and firewalls</li>\r\n      <li>Familiar with common threats (malware, phishing, DDoS, etc.)</li>\r\n      <li>Exprience with Python, JavaScript, PowerShell</li>\r\n      <li>Knowledge of Cloud Security (AWS, Azure or Google Cloud)</li>\r\n      <li>Able to work for 35 - 40 hours per week</li>\r\n      <li>May need to be on-call outside regular hours to respond to urgent incidents</li>\r\n    </ul>\r\n  </li>\r\n  <li><strong>Preferable:</strong>\r\n    <ul>\r\n      <li>Exprerience with C/C++ languages is a bonus</li>\r\n      <li>Professional Certifications (CISSP)</li>\r\n    </ul>\r\n  </li>\r\n</ol>', 'https://my.jobstreet.com/cybersecurity-analyst-jobs?jobId=86408084&type=standard'),
('CS288', 'Cybersecurity Specialist', 'images/cs288.jpg', 'Security Is Not Just Code—It\'s Confidence.', 'As a Cybersecurity Specialist, you\'re responsible for protecting computer systems, networks, and data from unauthorized access, theft, or damage. You play a critical role in defending computer systems, networks, and sensitive data against unauthorized access, cyberattacks, and potential breaches. Your expertise ensures the confidentiality, integrity, and availability of information across an organization\'s infrastructure.', 'RM6000-9000', 'IT Security Manager', '<p><strong>Key Responsibilities:</strong></p>\r\n<ul>\r\n  <li>Develop and enforce security policies and procedures.</li>\r\n  <li>Monitor network traffic for suspicious activity.</li>\r\n  <li>Maintain documentation related to security configurations, incidents, and responses.</li>\r\n  <li>Conduct regular risk assessments on networks, systems and applications.</li>\r\n  <li>Support incident response efforts and assist in root cause analysis.</li>\r\n  <li>Conducting data security training and awareness programs to promote a security-first culture across the organization.</li>\r\n</ul>\r\n<p><strong>Required qualifications, skills, knowledge and attributes:</strong></p>\r\n<ol>\r\n  <li><strong>Essential:</strong>\r\n    <ul>\r\n      <li>Degree in Cybersecurity, Computer Science, or related field.</li>\r\n      <li>3-5 years of experience in security engineering, incident response, or security operations.</li>\r\n      <li>Demonstrated understanding of information security concepts, standards, practices, including but not limited to firewalls, intrusion prevention and detection, TCP/IP and related protocols, device monitoring and log management and event monitoring and reporting.</li>\r\n    </ul>\r\n  </li>\r\n  <li><strong>Preferable:</strong>\r\n    <ul>\r\n      <li>Excellent interpersonal relations skills.</li>\r\n      <li>Strong analytical and problem solving skills.</li>\r\n      <li>Able to work under pressure in fast-paced working environment.</li>\r\n    </ul>\r\n  </li>\r\n</ol>', 'https://my.jobstreet.com/job/86617837'),
('IM404', 'IT Support Specialist / IT Manager', 'images/im404.png', 'Tech That Works, Support That Listens.', 'As a IT Support Specialist, you are responsible for maintaining and supporting the day-to-day operation of the IT infrastructure, providing technical support, managing IT projects and ensuring the network\'s security and stability.', 'RM3000-5000', 'IT Manager', '<p><strong>Key Responsibilities:</strong></p>\r\n<ul>\r\n  <li>Provide technical support for hardware and software issues.</li>\r\n  <li>Manage IT infrastructure, including servers, networks, and peripherals.</li>\r\n  <li>Monitor system performance and security.</li>\r\n  <li>Coordinate with vendors for equipment purchase and repair.</li>\r\n  <li>Develop and implement IT policies and procedures.</li>\r\n</ul>\r\n<p><strong>Required qualifications, skills, knowledge and attributes:</strong></p>\r\n<ol>\r\n  <li><strong>Essential:</strong>\r\n    <ul>\r\n      <li>Degree in Information Technology, Computer Science or related field.</li>\r\n      <li>Experience with system administration, network management, and troubleshooting.</li>\r\n      <li>Good communication and organizational skills.</li>\r\n    </ul>\r\n  </li>\r\n  <li><strong>Preferable:</strong>\r\n    <ul>\r\n      <li>IT certifications such as CompTIA A+, Network+, or Microsoft certifications.</li>\r\n      <li>Ability to manage multiple tasks and work under pressure.</li>\r\n    </ul>\r\n  </li>\r\n</ol>', 'https://www.jobstreet.com.my/en/job/it-support-specialist-36743170?sectionRank=4&jobId=36743170&sectionRank=4&sectionType=searchResults&jobPosition=1'),
('NA718', 'Network Administrator', 'images/na718.jpg', 'Keeping Systems Synced, Secure, and Seamless.', 'As a Network Administrator, you are responsible for managing, implementing and maintaining the school\'s network infrastructure and security. This role requires the ideal candidate to have a strong technical foundation, proactive problem-solving skills and experience with designing, securing and maintaining the overall network performance and security of the school.', 'RM4000-5000', 'IT Infrastructure Manager', '<p><strong>Key Responsibilities:</strong></p>\r\n<ul>\r\n  <li>Monitor network performance for hardware and software and troubleshoot issues to ensure optimal operation and minimal downtime.</li>\r\n  <li>Configure, manage and optimize routers, switches, firewalls, wireless access points and structured cabling systems.</li>\r\n  <li>Develop and maintain accurate and up-to-date network documentation, including configurations, logs and files.</li>\r\n  <li>Evaluate and implement emerging networking and security technologies to enhance performance and security.</li>\r\n  <li>Provide support for complex network and security related issues.</li>\r\n  <li>Collaborate with IT helpdesk and other departments to ensure issues are resolved promptly and efficiently.</li>\r\n</ul>\r\n<p><strong>Required qualifications, skills, knowledge and attributes:</strong></p>\r\n<ol>\r\n  <li><strong>Essential:</strong>\r\n    <ul>\r\n      <li>Degree in Computer Science, Computer Networking, Information Technology, or a related field.</li>\r\n      <li>Minimum 2 years of experience in network administration.</li>\r\n      <li>Sound understanding of structured cabling, routers, switches, network security protocols, firewalls and security tools (e.g. IDS/IPS, antivirus).</li>\r\n    </ul>\r\n  </li>\r\n  <li><strong>Preferable:</strong>\r\n    <ul>\r\n      <li>Experience with risk management, vulnerability assessments and incident response.</li>\r\n      <li>Strong communication skills with the ability to articulate complex technical concepts to non-technical stakeholders.</li>\r\n      <li>Able to work with diverse teams.</li>\r\n    </ul>\r\n  </li>\r\n</ol>', 'https://malaysia.indeed.com/viewjob?jk=5da48d84b5b410eb&from=mobRdr&utm_source=%2Fm%2F&utm_medium=redir&utm_campaign=dt'),
('NE911', 'Network Security Engineer', 'images/ne911.jpg', 'Fortifying Connections, Securing Every Byte.', 'As a Network Security Engineer, you\'re responsible for implementing and monitoring robust network solutions that enable our customers to operate efficiently and securely. You ensure that every packet of information travels safely across systems, minimizing vulnerabilities and maximizing uptime.', 'RM3000-4700', 'IT Infrastructure Manager', '<p><strong>Key Responsibilities:</strong></p>\r\n<ul>\r\n  <li>Provides patch management, security, and cloud infrastructure.</li>\r\n  <li>Configure and maintain firewalls, VPNs, proxies, and network security appliances.</li>\r\n  <li>Monitor network traffic for suspicious behavior.</li>\r\n  <li>Assist cybersecurity team to carry out vulnerability checks and fix security issues across the network.</li>\r\n  <li>Ensure timely updates and patching of firewall firmware and network devices.</li>\r\n  <li>Implement and manage intrusion detection/prevention systems (IDS/IPS).</li>\r\n</ul>\r\n<p><strong>Required qualifications, skills, knowledge and attributes:</strong></p>\r\n<ol>\r\n  <li><strong>Essential:</strong>\r\n    <ul>\r\n      <li>Minimum 2 years of experience in network security management, with a strong understanding of firewall technologies, VPNs, and network security protocols.</li>\r\n      <li>Strong knowledge of firewall technologies, TCP/IP, routing, and switching.</li>\r\n      <li>Knowledge of internet protocols such as SSH, FTP, SFTP & HTTP.</li>\r\n      <li>Hands-on experience in analyzing security logs, monitoring network traffic, and implementing access control measures.</li>\r\n    </ul>\r\n  </li>\r\n  <li><strong>Preferable:</strong>\r\n    <ul>\r\n      <li>Strong problem-solving skills and the ability to work independently to identify and resolve security issues with minimum guidance.</li>\r\n      <li>Good Communication Skills.</li>\r\n      <li>Cisco Certified Network Associate (CCNA) or Professional (CCNP) - Security or Enterprise.</li>\r\n    </ul>\r\n  </li>\r\n</ol>', 'https://my.jobstreet.com/job/86779235');

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
