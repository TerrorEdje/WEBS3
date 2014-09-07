INSERT INTO `categories` (`id`, `name`, `description`, `hidden`, `created_at`, `updated_at`) VALUES
(1, 'Members', '', NULL, '2014-09-07 13:16:19', '2014-09-07 13:16:19'),
(2, 'Elder Scrolls Online', '', NULL, '2014-09-07 13:16:50', '2014-09-07 13:16:50');

INSERT INTO `ranks` (`id`, `name`, `title`, `admin`, `moderator`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Member', 'Member', 0, 0, 'Just a regular member', '2014-09-07 00:00:00', '2014-09-07 00:00:00'),
(2, 'Superb Admin', 'Superb Admin', 1, 1, NULL, '2014-09-07 00:00:00', '2014-09-07 00:00:00');

INSERT INTO `users` (`id`, `username`, `eso_username`, `password`, `password_temp`, `email`, `signature`, `image`, `description`, `created_at`, `updated_at`, `active`, `code`, `ranks_id`, `remember_token`) VALUES
(1, 'Iseke', NULL, '$2y$10$.c1HEBIx6g0zv6edyW8UReTUsrYLuFjhsRdTNUeulP7bHoRVLEqYe', NULL, 'edwinhattink@me.com', 'R.E.V.O.L.U.T.I.O.N.', '0Rn361TyqokT.png', 'I like programming', '2014-09-07 13:15:04', '2014-09-07 13:30:19', 1, '', 2, NULL),
(2, 'Iseka', NULL, '$2y$10$kK359O15Xo.r/NvxZ4y3EeDtv8E6XGC.GLwBJj3gDic.Iaz6pz6DO', NULL, 'edwinhattink@gmail.com', NULL, NULL, NULL, '2014-09-07 13:43:01', '2014-09-07 13:50:04', 1, '', 1, NULL);

INSERT INTO `news` (`id`, `name`, `content`, `users_id`, `created_at`, `updated_at`) VALUES
(1, 'Lorem ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent bibendum venenatis sem, et dignissim tortor. Curabitur eget augue at tellus bibendum ultricies ac et lorem. Duis semper sem vel turpis congue, sed pharetra lectus vulputate. Nam nec dolor velit. Fusce scelerisque tempor urna, id fermentum elit varius sit amet. Cras dignissim pulvinar scelerisque. In ut consectetur lorem, sit amet finibus diam. Proin mattis erat non lectus vestibulum, nec sodales enim dictum. Donec eros mauris, consectetur in quam et, iaculis posuere tortor. Maecenas sodales posuere magna, eget consequat lectus semper vitae. Cras dapibus arcu non velit varius porttitor. Donec nec leo at neque imperdiet consequat.', 1, '2014-09-07 13:33:47', '2014-09-07 13:33:47');

INSERT INTO `subcategories` (`id`, `name`, `description`, `hidden`, `created_at`, `updated_at`, `categories_id`, `ranks_id`) VALUES
(1, 'News', '', NULL, '2014-09-07 13:16:24', '2014-09-07 13:16:24', 1, NULL),
(2, 'General', '', NULL, '2014-09-07 13:16:38', '2014-09-07 13:16:38', 1, NULL),
(3, 'Fun', '', NULL, '2014-09-07 13:16:41', '2014-09-07 13:16:41', 1, NULL),
(4, 'Theorycrafting - Dragonknight', '', NULL, '2014-09-07 13:17:01', '2014-09-07 13:17:01', 2, NULL),
(5, 'Theorycrafting - Nightblade', '', NULL, '2014-09-07 13:17:11', '2014-09-07 13:17:11', 2, NULL),
(6, 'Theorycrafting - Sorcerer', '', NULL, '2014-09-07 13:17:19', '2014-09-07 13:17:19', 2, NULL),
(7, 'Theorycrafting - Templar', '', NULL, '2014-09-07 13:17:53', '2014-09-07 13:17:53', 2, NULL);

INSERT INTO `topics` (`id`, `title`, `by`, `open`, `hidden`, `created_at`, `updated_at`, `subcategories_id`) VALUES
(1, 'Lorem Ipsum', 1, 1, NULL, '2014-09-07 13:21:53', '2014-09-07 13:21:53', 1);

INSERT INTO `replies` (`id`, `content`, `by`, `topics_id`, `created_at`, `updated_at`) VALUES
(1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent bibendum venenatis sem, et dignissim tortor. Curabitur eget augue at tellus bibendum ultricies ac et lorem. Duis semper sem vel turpis congue, sed pharetra lectus vulputate. Nam nec dolor velit. Fusce scelerisque tempor urna, id fermentum elit varius sit amet. Cras dignissim pulvinar scelerisque. In ut consectetur lorem, sit amet finibus diam. Proin mattis erat non lectus vestibulum, nec sodales enim dictum. Donec eros mauris, consectetur in quam et, iaculis posuere tortor. Maecenas sodales posuere magna, eget consequat lectus semper vitae. Cras dapibus arcu non velit varius porttitor. Donec nec leo at neque imperdiet consequat.', 1, 1, '2014-09-07 13:21:53', '2014-09-07 13:21:53'),
(2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent bibendum venenatis sem, et dignissim tortor. Curabitur eget augue at tellus bibendum ultricies ac et lorem. Duis semper sem vel turpis congue, sed pharetra lectus vulputate. Nam nec dolor velit. Fusce scelerisque tempor urna, id fermentum elit varius sit amet. Cras dignissim pulvinar scelerisque. In ut consectetur lorem, sit amet finibus diam. Proin mattis erat non lectus vestibulum, nec sodales enim dictum. Donec eros mauris, consectetur in quam et, iaculis posuere tortor. Maecenas sodales posuere magna, eget consequat lectus semper vitae. Cras dapibus arcu non velit varius porttitor. Donec nec leo at neque imperdiet consequat.', 1, 1, '2014-09-07 13:28:30', '2014-09-07 13:28:30'),
(3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent bibendum venenatis sem, et dignissim tortor. Curabitur eget augue at tellus bibendum ultricies ac et lorem. Duis semper sem vel turpis congue, sed pharetra lectus vulputate. Nam nec dolor velit. Fusce scelerisque tempor urna, id fermentum elit varius sit amet. Cras dignissim pulvinar scelerisque. In ut consectetur lorem, sit amet finibus diam. Proin mattis erat non lectus vestibulum, nec sodales enim dictum. Donec eros mauris, consectetur in quam et, iaculis posuere tortor. Maecenas sodales posuere magna, eget consequat lectus semper vitae. Cras dapibus arcu non velit varius porttitor. Donec nec leo at neque imperdiet consequat.', 1, 1, '2014-09-07 13:28:32', '2014-09-07 13:28:32'),
(4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent bibendum venenatis sem, et dignissim tortor. Curabitur eget augue at tellus bibendum ultricies ac et lorem. Duis semper sem vel turpis congue, sed pharetra lectus vulputate. Nam nec dolor velit. Fusce scelerisque tempor urna, id fermentum elit varius sit amet. Cras dignissim pulvinar scelerisque. In ut consectetur lorem, sit amet finibus diam. Proin mattis erat non lectus vestibulum, nec sodales enim dictum. Donec eros mauris, consectetur in quam et, iaculis posuere tortor. Maecenas sodales posuere magna, eget consequat lectus semper vitae. Cras dapibus arcu non velit varius porttitor. Donec nec leo at neque imperdiet consequat.', 1, 1, '2014-09-07 13:28:34', '2014-09-07 13:28:34');
