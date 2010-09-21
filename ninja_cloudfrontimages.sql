
--
-- Table structure for table `tbl_javaScriptCDN`
--

CREATE TABLE IF NOT EXISTS `tbl_javaScriptCDN` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `scriptIds` varchar(50) NOT NULL,
  `version` int(11) unsigned NOT NULL,
  `gzip` tinyint(1) NOT NULL,
  PRIMARY KEY (`scriptIds`,`gzip`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_javaScriptScript`
--

CREATE TABLE IF NOT EXISTS `tbl_javaScriptScript` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `lookupId` int(11) unsigned NOT NULL,
  `fileName` varchar(255) NOT NULL,
  `dependencies` varchar(50) NOT NULL,
  `sortOrder` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;


