--
-- Table structure for table `ideas`
--

CREATE TABLE `ideas` (
  `id` int(11) NOT NULL,
  `ideakey` varchar(8) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `idea` varchar(255) NOT NULL,
  `status` int(1) DEFAULT NULL,
  `ipv4` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_general_ci;

--
-- Indexes for table `ideas`
--

ALTER TABLE `ideas`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ideas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;