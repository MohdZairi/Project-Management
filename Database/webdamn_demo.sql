--
-- Table structure for table `pms_hours`
--

CREATE TABLE `pms_hours` (
  `id` int(11) UNSIGNED NOT NULL,
  `date` date DEFAULT NULL,
  `time` float DEFAULT NULL,
  `work_completed` varchar(255) DEFAULT NULL,
  `task_id` int(11) UNSIGNED NOT NULL,
  `employee_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pms_hours`
--

INSERT INTO `pms_hours` (`id`, `date`, `time`, `work_completed`, `task_id`, `employee_id`) VALUES
(2, '2013-10-11', 3.25, 'Got started with basic definitions', 1, 2),
(3, '2013-10-09', 0.5, 'Further definition work.', 1, 3),
(4, '2013-10-02', 3, 'Started with our default framework; modified CSS; add HTML for initial pages', 5, 1),
(5, '2017-02-07', 1, '', 7, 1),
(6, '2017-02-11', 0.05, '', 6, 2),
(7, '2017-02-28', 1, '', 4, 2),
(8, '2017-02-27', 1, 'tested out entry ', 10, 2),
(9, '2017-03-03', 0, 'asdfas', 10, 1),
(10, '2017-03-08', 1, '', 10, 2),
(11, '2017-03-08', 2.25, 'Testing', 10, 2),
(12, '2020-01-09', 3, 'safafasf', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `pm_clients`
--

CREATE TABLE `pm_clients` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `industry` varchar(255) DEFAULT NULL,
  `revenue` varchar(255) DEFAULT NULL,
  `description` varchar(512) DEFAULT '',
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pm_clients`
--

INSERT INTO `pm_clients` (`id`, `name`, `website`, `industry`, `revenue`, `description`, `phone`, `address`, `country`, `notes`) VALUES
(1, 'Macroserve', 'http://www.macroserve.com', 'Technology', '< $500,000', '', '310-602-4009', '3976 Sumner Street', '', ''),
(2, 'Patterson-Fletcher', 'http://www.pfllc.com', 'Education', '< $500,000', '', '402-269-1382', '4435 Crummit Lane', '', ''),
(3, 'Corpbay', 'http://corpbay.com', 'Heathcare', '< $500,000', 'A leader in HealthCare Management.', '619-205-6584', '4923 Holden Street', '', 'Strong potential for long-term partnership.'),
(4, 'Infosoft', 'http://www.infosoft.com', 'Technology', '< $500,000', '', '520-632-3440', '1 Infosoft Way', '', ''),
(5, 'Mango', 'http://mango.com', 'Education', '< $500,000', 'Mango is the premier educational software company in the world.', '7173307734', '4615 Center Blvd', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `pm_milestones`
--

CREATE TABLE `pm_milestones` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `deliverables` varchar(255) DEFAULT NULL,
  `status_id` int(11) UNSIGNED NOT NULL,
  `project_id` int(11) UNSIGNED NOT NULL,
  `total_hours` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pm_milestones`
--

INSERT INTO `pm_milestones` (`id`, `name`, `due_date`, `deliverables`, `status_id`, `project_id`, `total_hours`) VALUES
(1, 'Design Complete', '2013-10-17', 'Complete Design Mocks', 3, 2, NULL),
(2, 'Design Converted to Code', '2013-10-23', 'Design applied to working code base.<br />Core optimization.', 1, 2, 4.5),
(3, 'Framework Coded', '2013-10-25', 'Fully functioning code base', 2, 2, NULL),
(4, 'Project Outline', '2013-11-25', 'Schedule and milestones', 1, 1, 1),
(5, 'Shot 01', '2013-12-10', 'Full database schema definition and build.', 2, 1, 3.75),
(6, 'Programming', '2013-12-18', 'Code Repository Sounds Good<br />', 1, 1, NULL),
(7, 'Testing', '2014-01-04', 'nothing<br />', 2, 1, NULL),
(8, 'New bezel design', '2014-01-31', 'CSS and JavaScript customizations --- hello', 2, 1, NULL),
(9, 'Create Copy', '2017-01-11', 'Create Copy for Ad', 3, 3, 1.05),
(10, 'Send Into Magazine', '2017-01-22', '', 3, 3, NULL),
(11, 'Rollout', '2017-03-12', '', 3, 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pm_projects`
--

CREATE TABLE `pm_projects` (
  `id` int(11) UNSIGNED NOT NULL,
  `project_name` varchar(255) DEFAULT NULL,
  `project_manager_id` int(11) UNSIGNED NOT NULL,
  `start_date` date DEFAULT NULL,
  `hourly_rate` float DEFAULT NULL,
  `budget` float DEFAULT NULL,
  `active` int(11) UNSIGNED NOT NULL,
  `status_id` int(11) UNSIGNED NOT NULL,
  `client_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pm_projects`
--

INSERT INTO `pm_projects` (`id`, `project_name`, `project_manager_id`, `start_date`, `hourly_rate`, `budget`, `active`, `status_id`, `client_id`) VALUES
(1, 'Application Build', 2, '2015-10-21', 100, 6000, 0, 3, 3),
(2, 'New Intranet Website', 2, '2015-10-26', 130, 2000, 1, 3, 1),
(3, 'Ad Campaign', 2, '2015-12-04', 125, 1900, 1, 4, 2),
(4, 'test', 2, '0000-00-00', 100, 15000, 1, 1, 1),
(5, 'Blog Writing', 2, '0000-00-00', 50, 800, 1, 1, 3),
(6, 'Tester', 2, '0000-00-00', 12.75, 5600, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pm_status`
--

CREATE TABLE `pm_status` (
  `id` int(11) UNSIGNED NOT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pm_status`
--

INSERT INTO `pm_status` (`id`, `status`) VALUES
(1, 'Sales'),
(2, 'R & D'),
(3, 'In Production'),
(4, 'Pending Approval'),
(5, 'Complete');

-- --------------------------------------------------------

--
-- Table structure for table `pm_tasks`
--

CREATE TABLE `pm_tasks` (
  `id` int(11) UNSIGNED NOT NULL,
  `task_name` varchar(255) DEFAULT NULL,
  `instruction` varchar(255) DEFAULT NULL,
  `status_id` int(11) UNSIGNED NOT NULL,
  `total_hours` float DEFAULT NULL,
  `milestone_id` int(11) UNSIGNED DEFAULT NULL,
  `project_id` int(11) UNSIGNED NOT NULL,
  `employee_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pm_tasks`
--

INSERT INTO `pm_tasks` (`id`, `task_name`, `instruction`, `status_id`, `total_hours`, `milestone_id`, `project_id`, `employee_id`) VALUES
(1, 'Define Database', 'Set all tables and fields.  Reference data schema from client.', 4, 3.75, 5, 1, 3),
(2, 'Wireframe sketches', 'Sketch out initial wireframe designs', 1, 0, 8, 1, 2),
(3, 'Program Framework', 'Add all the function stubs with comments.', 2, 0, 6, 1, 3),
(4, 'Prepare Outline', 'Prepare full outline document for client deliverable', 4, 1, 4, 1, 1),
(5, 'HTML Coding', 'This is description', 4, 4.5, 2, 1, 2),
(6, 'Open Up Word', '', 1, 0.05, 9, 3, NULL),
(7, 'Write Stuff', '', 1, 1, 9, 3, NULL),
(8, 'Configure Software', '', 1, 0, 10, 3, 2),
(9, 'Migrate Content', '', 1, 0, 11, 3, 2),
(10, 'test task', 'this is a test', 2, 4.25, NULL, 3, 2),
(11, 'Blah', 'asdfsadf', 1, 0, NULL, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `pm_task_status`
--

CREATE TABLE `pm_task_status` (
  `id` int(11) UNSIGNED NOT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pm_task_status`
--

INSERT INTO `pm_task_status` (`id`, `status`) VALUES
(1, 'Pending Start'),
(2, 'Active'),
(3, 'Pending Feedback'),
(4, 'Completed');

-- --------------------------------------------------------

--
-- Table structure for table `pm_users`
--

CREATE TABLE `pm_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(64) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `role` enum('admin','manager','employee') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pm_users`
--

INSERT INTO `pm_users` (`id`, `email`, `password`, `first_name`, `last_name`, `role`) VALUES
(1, 'admin@webdamn.com', '202cb962ac59075b964b07152d234b70', 'web', 'damn', 'admin'),
(2, 'steve@webdamn.com', '202cb962ac59075b964b07152d234b70', 'steve', 'smith', 'manager'),
(3, 'william@webdamn.com', '202cb962ac59075b964b07152d234b70', 'john', 'William', 'employee');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pms_hours`
--
ALTER TABLE `pms_hours`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pm_clients`
--
ALTER TABLE `pm_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pm_milestones`
--
ALTER TABLE `pm_milestones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pm_projects`
--
ALTER TABLE `pm_projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pm_status`
--
ALTER TABLE `pm_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pm_tasks`
--
ALTER TABLE `pm_tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pm_task_status`
--
ALTER TABLE `pm_task_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pm_users`
--
ALTER TABLE `pm_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pms_hours`
--
ALTER TABLE `pms_hours`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pm_clients`
--
ALTER TABLE `pm_clients`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pm_milestones`
--
ALTER TABLE `pm_milestones`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pm_projects`
--
ALTER TABLE `pm_projects`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pm_status`
--
ALTER TABLE `pm_status`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pm_tasks`
--
ALTER TABLE `pm_tasks`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pm_task_status`
--
ALTER TABLE `pm_task_status`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pm_users`
--
ALTER TABLE `pm_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;


