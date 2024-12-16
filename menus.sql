

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `nameM` varchar(50) NOT NULL,
  `DescriptionM` varchar(250) NOT NULL,
  `idParentM` char(3) NOT NULL DEFAULT '',
  `nameParent` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

