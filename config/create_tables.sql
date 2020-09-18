CREATE TABLE IF NOT EXISTS `travel` (
  `id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
  `vehicle` varchar(255),
  `vehicle_number` varchar(255),
  `v_from` varchar(255),
  `v_to` varchar(255),
  `seat` float,
  `gate` varchar(20),
  `v_start` timestamp,
  `v_end` timestamp,
  `bag_conditions` varchar(255),
  `createdAt` datetime NOT NULL,
  `updatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);