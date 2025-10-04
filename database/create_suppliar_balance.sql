-- Create the suppliar_balance table
CREATE TABLE `suppliar_balance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sup_id` int(11) NOT NULL,
  `due_balance` float(15,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `sup_id` (`sup_id`),
  CONSTRAINT `suppliar_balance_ibfk_1` FOREIGN KEY (`sup_id`) REFERENCES `suppliar` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;