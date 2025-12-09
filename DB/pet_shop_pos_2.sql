

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `created_at`, `updated_at`) VALUES
(7, 'abc', '2025-03-06 14:49:46', '2025-03-06 14:49:46');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigserial  NOT NULL,
  `district_id` bigserial  DEFAULT NULL,
  `name_en` varchar(45) NOT NULL,
  `name_si` varchar(45) NOT NULL,
  `name_ta` varchar(45) NOT NULL,
  `sub_name_en` varchar(45) NOT NULL,
  `sub-name_si` varchar(45) NOT NULL,
  `sub_name_ta` varchar(45) NOT NULL,
  `post_code` varchar(45) NOT NULL,
  `latitude` decimal(8,2) NOT NULL,
  `longitude` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
);

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `district_id`, `name_en`, `name_si`, `name_ta`, `sub_name_en`, `sub-name_si`, `sub_name_ta`, `post_code`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES
(1, 1, 'default', 'default', 'default', 'default', 'default', 'default', '23', 221.00, 22.00, '2024-11-09 09:32:36', '2024-11-09 09:32:36');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigserial  NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `contact_number` varchar(45) NOT NULL,
  `cities_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address_line_1` varchar(255) DEFAULT NULL,
  `address_line_2` varchar(255) DEFAULT NULL,
  `due_amount` decimal(10,2) DEFAULT NULL,
  `user_id` bigint(10) UNSIGNED DEFAULT NULL,
  `city_name` varchar(255) DEFAULT NULL,
  `customer_id` varchar(100) DEFAULT NULL
) ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer_name`, `contact_number`, `cities_id`, `status_id`, `created_at`, `updated_at`, `email`, `address_line_1`, `address_line_2`, `due_amount`, `user_id`, `city_name`, `customer_id`) VALUES
(1, 'Defult Customer', '1234567890', 1, 1, '2025-03-18 07:26:44', '2025-03-18 07:26:44', 'abc@gmail.com', 'aaa', NULL, 0.00, 1, 'aaa', '1'),
(68, 'aaa', '0765432422', 1, 1, '2025-03-25 09:34:58', '2025-03-25 09:34:58', 'abc@gmail.com', 'aaa', NULL, NULL, 1, 'aaa', '2'),
(69, 'aaa', '0766666666', 1, 1, '2025-03-25 09:39:20', '2025-03-25 09:39:20', 'abc@gmail.com', 'aa', NULL, 0.00, 1, 'aa', '3'),
(70, 'bbbbbb', '0766666669', 1, 1, '2025-03-25 09:39:38', '2025-03-25 09:39:38', 'abc@gmail.com', 'aa', NULL, 0.00, 1, 'aa', '4'),
(71, 'hdhdhd', '0766666670', 1, 1, '2025-03-25 09:40:53', '2025-03-25 09:40:53', 'abc@gmail.com', 'aa', NULL, 0.00, 1, 'aa', '5'),
(72, 'test', '0766666678', 1, 1, '2025-03-25 09:41:25', '2025-03-25 09:41:25', 'abc@gmail.com', 'aa', NULL, 0.00, 1, 'aa', '6'),
(73, 'test2', '0766666645', 1, 1, '2025-03-25 09:41:36', '2025-03-25 09:41:36', 'abc@gmail.com', 'aa', NULL, 0.00, 1, 'aa', '7'),
(74, 'test3', '0766646645', 1, 1, '2025-03-25 09:42:37', '2025-03-25 09:42:37', 'abc@gmail.com', 'aa', NULL, 0.00, 1, 'aa', '8'),
(75, 'test4', '0746646645', 1, 1, '2025-03-25 09:43:06', '2025-03-25 09:43:06', 'abc@gmail.com', 'aa', NULL, 0.00, 1, 'aa', '9'),
(76, 'test5', '0746666645', 1, 1, '2025-03-25 09:43:51', '2025-03-25 09:43:51', 'abc@gmail.com', 'aa', NULL, 0.00, 1, 'aa', '10'),
(77, 'test6', '0746666676', 1, 1, '2025-03-25 09:44:06', '2025-03-25 09:44:06', 'abc@gmail.com', 'aa', NULL, 0.00, 1, 'aa', '10'),
(78, 'test7', '0744566676', 1, 1, '2025-03-25 09:44:47', '2025-03-25 09:44:47', 'abc@gmail.com', 'aa', NULL, 0.00, 1, 'aa', '10'),
(79, 'test8', '0744567876', 1, 1, '2025-03-25 09:45:13', '2025-03-25 09:45:13', 'abc@gmail.com', 'aa', NULL, 0.00, 1, 'aa', '10');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `province_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name_en` varchar(45) NOT NULL,
  `name_si` varchar(45) NOT NULL,
  `name_ta` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `province_id`, `name_en`, `name_si`, `name_ta`, `created_at`, `updated_at`) VALUES
(1, 1, 'default', 'default', 'default', '2024-11-09 09:32:36', '2024-11-09 09:32:36');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `expense_title` varchar(225) NOT NULL,
  `details` longtext NOT NULL,
  `expense_date` date NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `expense_categories_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
);

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `expense_title`, `details`, `expense_date`, `amount`, `expense_categories_id`, `user_id`, `created_at`, `updated_at`) VALUES
(22, 'aaa', 'a', '2025-02-27', 2.00, 9, 1, '2025-03-18 08:43:15', '2025-03-18 08:43:15');

-- --------------------------------------------------------

--
-- Table structure for table `expense_categories`
--

CREATE TABLE `expense_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(45) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
);

--
-- Dumping data for table `expense_categories`
--

INSERT INTO `expense_categories` (`id`, `name`, `user_id`, `created_at`, `updated_at`) VALUES
(9, 'aaaa', 1, '2025-03-18 08:42:51', '2025-03-18 08:42:51');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
);

-- --------------------------------------------------------

--
-- Table structure for table `hold_orders`
--

CREATE TABLE `hold_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customers_id` bigint(20) UNSIGNED DEFAULT NULL,
  `users_id` bigint(20) UNSIGNED DEFAULT NULL,
  `hold_reference` varchar(255) NOT NULL,
  `hold_status` enum('ACTIVE','DEACTIVE') NOT NULL DEFAULT 'ACTIVE',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `hold_order_items`
--

CREATE TABLE `hold_order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `users_id` bigint(20) UNSIGNED DEFAULT NULL,
  `items_id` bigint(20) UNSIGNED DEFAULT NULL,
  `hold_orders_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `discount_type` enum('FIXED','PERCENTAGE') NOT NULL DEFAULT 'FIXED',
  `discount` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `inhouseitemstock`
--

CREATE TABLE `inhouseitemstock` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_code` varchar(225) NOT NULL,
  `item_name` varchar(225) NOT NULL,
  `suppliers_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `minimum_qty` int(11) DEFAULT NULL,
  `purchase_price` decimal(8,2) NOT NULL,
  `retail_price` decimal(8,2) NOT NULL,
  `wholesale_price` decimal(8,2) NOT NULL,
  `start_qty` int(10) DEFAULT NULL,
  `image_path` varchar(225) DEFAULT NULL,
  `item_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
);

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `item_code`, `item_name`, `suppliers_id`, `quantity`, `minimum_qty`, `purchase_price`, `retail_price`, `wholesale_price`, `start_qty`, `image_path`, `item_category_id`, `status_id`, `created_at`, `updated_at`) VALUES
(43, '38648', 'aaaa', 10, 1, 2, 2.00, 2.00, 2.00, 2, 'default.png', 15, 1, '2025-03-18 04:37:35', '2025-03-18 08:08:46'),
(44, '16911', 'aaa', 11, 0, 2, 2.00, 2.00, 2.00, 2, NULL, 15, 1, '2025-03-18 05:11:06', '2025-04-01 13:50:37'),
(45, '62575', 'aaa', 10, 1, 2, 2.00, 2.00, 2.00, 2, NULL, 14, 1, '2025-03-18 05:51:57', '2025-04-01 13:48:58'),
(46, '03841', 'aaaa', 10, 1, 2, 2.00, 4.00, 2.00, 2, 'default.png', 14, 1, '2025-03-18 07:28:24', '2025-04-01 13:48:58'),
(47, '99218', 'aaaaa', 10, 2, 2, 2.00, 2.00, 2.00, 2, 'default.png', 15, 1, '2025-03-18 07:30:05', '2025-03-18 07:30:14');

-- --------------------------------------------------------

--
-- Table structure for table `item_categories`
--

CREATE TABLE `item_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `categories` varchar(255) NOT NULL,
  `description` varchar(500) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
);

--
-- Dumping data for table `item_categories`
--

INSERT INTO `item_categories` (`id`, `categories`, `description`, `created_at`, `updated_at`) VALUES
(14, 'ABCDE', 'aaaaaaaaa', '2025-03-18 04:24:33', '2025-03-18 04:24:50'),
(15, 'ABCDEFSGT', 'aaaaaaaaaa', '2025-03-18 04:24:43', '2025-03-18 04:24:43'),
(16, 'aaa', 'aaa', '2025-03-18 04:45:45', '2025-03-18 04:45:45'),
(17, 'aaaaaa', 'aaa', '2025-03-18 04:46:03', '2025-03-18 04:46:03');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
);

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_11_000000_create_statuses_table', 1),
(2, '2014_10_11_000001_create_roles_table', 1),
(3, '2014_10_12_000000_create_users_table', 1),
(4, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(5, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(6, '2019_08_19_000000_create_failed_jobs_table', 1),
(7, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(8, '2024_11_25_132922_create_sessions_table', 1),
(9, '2024_11_25_165000_create_suppliers_table', 1),
(10, '2024_11_25_165647_create_items_table', 1),
(11, '2024_11_25_170214_create_stock_updates_table', 1),
(12, '2024_11_25_170325_create_expense_categories_table', 1),
(13, '2024_11_25_170516_create_permissions_table', 1),
(14, '2024_11_25_170605_create_roles_has_permissions_table', 1),
(15, '2024_11_25_170644_create_expenses_table', 1),
(16, '2024_11_25_170716_create_provinces_table', 1),
(17, '2024_11_25_170802_create_districts_table', 1),
(18, '2024_11_25_170823_create_cities_table', 1),
(19, '2024_11_25_170842_create_customers_table', 1),
(20, '2024_11_25_170905_create_settings_table', 1),
(22, '2024_11_27_181716_create_sales_table', 2),
(23, '2024_11_28_181801_create_sales_items_table', 2),
(24, '2024_11_28_181823_create_hold_orders_table', 2),
(25, '2024_11_28_181830_create_hold_order_items_table', 2),
(26, '2024_11_29_151838_create_item_categories_table', 2),
(29, '2024_12_09_174448_create_payments_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `otheritem_brands`
--

CREATE TABLE `otheritem_brands` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ;

--
-- Dumping data for table `otheritem_brands`
--

INSERT INTO `otheritem_brands` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'bcd', '2025-03-25 04:25:48', '2025-03-25 04:25:48'),
(2, 'gggg', '2025-03-25 06:06:13', '2025-03-25 06:06:13');

-- --------------------------------------------------------

--
-- Table structure for table `otheritem_categories`
--

CREATE TABLE `otheritem_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
);

--
-- Dumping data for table `otheritem_categories`
--

INSERT INTO `otheritem_categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(3, 'aaaaa', '2025-03-25 05:14:48', '2025-03-25 05:14:48'),
(4, 'bcbc', '2025-03-25 06:44:41', '2025-03-25 06:44:41');

-- --------------------------------------------------------

--
-- Table structure for table `otheritem_types`
--

CREATE TABLE `otheritem_types` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ;

--
-- Dumping data for table `otheritem_types`
--

INSERT INTO `otheritem_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'hhhh', '2025-03-25 04:25:54', '2025-03-25 04:25:54'),
(2, 'fffff', '2025-03-25 06:00:09', '2025-03-25 06:00:09');

-- --------------------------------------------------------

--
-- Table structure for table `other_item`
--

CREATE TABLE `other_item` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `otherItem_brand_id` int(11) NOT NULL,
  `otherItem_category_id` int(11) NOT NULL,
  `otherItem_type_id` int(11) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `status_id` bigint(20) UNSIGNED NOT NULL,
  `purchase_price` decimal(10,2) NOT NULL,
  `retail_price` decimal(10,2) NOT NULL,
  `wholesale_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ;

--
-- Dumping data for table `other_item`
--

INSERT INTO `other_item` (`id`, `name`, `otherItem_brand_id`, `otherItem_category_id`, `otherItem_type_id`, `image_path`, `status_id`, `purchase_price`, `retail_price`, `wholesale_price`, `created_at`, `updated_at`) VALUES
(1, 'abcde', 1, 3, 2, 'OtherItem/uuJtDYo6iFB6GzSm80Nv.jpg', 1, 200.00, 200.00, 200.00, '2025-03-25 05:17:44', '2025-03-26 09:04:26'),
(3, 'abcdde', 1, 3, 1, 'OtherItem/njY80ySZ7tLYbLJjYoc9.jpg', 1, 2000.00, 2000.00, 2000.00, '2025-03-25 05:35:38', '2025-03-25 05:35:38'),
(4, 'aaaaa', 1, 3, 2, 'OtherItem/pFRBXPN1J08A1hPjUqGG.jpg', 1, 200.00, 200.00, 200.00, '2025-03-25 06:00:26', '2025-03-25 07:01:15');

-- --------------------------------------------------------

--
-- Table structure for table `other_order`
--

CREATE TABLE `other_order` (
  `id` int(11) NOT NULL,
  `other_payment_id` int(11) NOT NULL,
  `serial_number_id` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
);

-- --------------------------------------------------------

--
-- Table structure for table `other_payment`
--

CREATE TABLE `other_payment` (
  `id` int(11) NOT NULL,
  `invoice_num` varchar(50) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `payment_type` varchar(50) DEFAULT NULL,
  `warranty` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sales_id` bigint(20) UNSIGNED DEFAULT NULL,
  `users_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sub_total` decimal(14,2) DEFAULT NULL,
  `grand_total` decimal(14,2) DEFAULT NULL,
  `paid_amount` decimal(14,2) DEFAULT NULL,
  `due_amount` decimal(14,2) DEFAULT NULL,
  `discount_type` enum('FIXED','PERCENTAGE') DEFAULT 'FIXED',
  `cheque_no` varchar(255) DEFAULT NULL,
  `cheque_date` date DEFAULT NULL,
  `discount` decimal(14,2) DEFAULT NULL,
  `payment_type` enum('CASH','CARD','CHEQUE','CREDIT') DEFAULT 'CASH',
  `payment_status` enum('PAID','DUE','HOLD') DEFAULT 'PAID',
  `sales_note` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pay_due_amount` decimal(14,2) DEFAULT 0.00
);

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `sales_id`, `users_id`, `sub_total`, `grand_total`, `paid_amount`, `due_amount`, `discount_type`, `cheque_no`, `cheque_date`, `discount`, `payment_type`, `payment_status`, `sales_note`, `created_at`, `updated_at`, `pay_due_amount`) VALUES
(333, 403, 1, 2.00, 2.00, 2.00, 0.00, 'FIXED', NULL, NULL, 0.00, 'CASH', 'PAID', NULL, '2025-03-18 08:08:46', '2025-03-18 08:08:46', 0.00),
(334, 404, 1, 4.00, 4.00, 2.00, 2.00, 'FIXED', NULL, NULL, 0.00, 'CASH', 'DUE', NULL, '2025-03-18 08:09:01', '2025-03-18 08:09:01', 0.00),
(335, 405, 1, 6.00, 6.00, 6.00, 0.00, 'FIXED', NULL, NULL, 0.00, 'CASH', 'PAID', NULL, '2025-04-01 13:48:58', '2025-04-01 13:48:58', 0.00),
(336, 406, 1, 2.00, 2.00, 2.00, 0.00, 'FIXED', NULL, NULL, 0.00, 'CASH', 'PAID', NULL, '2025-04-01 13:50:37', '2025-04-01 13:50:37', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `permissions_name` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
);

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `permissions_name`, `created_at`, `updated_at`) VALUES
(1, 'aaaaa1111', '2024-12-16 08:08:26', '2024-12-16 08:08:40'),
(10, 'dashboards', '2024-12-16 02:22:36', '2024-12-17 02:30:08'),
(17, 'Access_Dashbord', '2024-12-16 04:14:57', '2024-12-16 04:14:57'),
(18, 'Access_Billing', '2024-12-16 04:15:08', '2024-12-16 04:15:08'),
(19, 'Access_Items', '2024-12-16 04:15:20', '2024-12-16 04:15:20'),
(20, 'Access_Stock', '2024-12-16 04:15:31', '2024-12-16 04:15:31'),
(21, 'Access_Sales', '2024-12-16 04:15:42', '2024-12-16 04:15:42'),
(22, 'Access_Users', '2024-12-16 04:15:56', '2024-12-16 04:15:56'),
(23, 'Access_Customers', '2024-12-16 04:16:12', '2024-12-16 04:16:12'),
(24, 'Access_Suppliers', '2024-12-16 04:16:25', '2024-12-16 04:16:25'),
(25, 'Access_Expenses', '2024-12-16 04:16:42', '2024-12-16 04:16:42'),
(26, 'Access_Reports', '2024-12-16 04:16:55', '2024-12-16 04:16:55'),
(27, 'Access_Settings', '2024-12-16 04:17:07', '2024-12-16 04:17:07'),
(28, 'Add new Item', '2024-12-16 22:02:19', '2024-12-16 22:02:19'),
(29, 'Add New User', '2024-12-17 00:55:52', '2024-12-17 00:55:52'),
(30, 'Add New Role', '2024-12-17 00:55:59', '2024-12-17 00:55:59'),
(31, 'Add New Permission', '2024-12-17 00:56:16', '2024-12-17 00:56:16'),
(32, 'User List View', '2024-12-17 00:56:31', '2024-12-17 00:56:31'),
(33, 'Role List View', '2024-12-17 00:56:43', '2024-12-17 00:56:43'),
(34, 'Permission List View', '2024-12-17 00:56:56', '2024-12-17 00:56:56'),
(35, 'User Status Control', '2024-12-17 00:57:31', '2024-12-17 00:57:31'),
(36, 'User Update', '2024-12-17 00:57:38', '2024-12-17 00:57:38'),
(37, 'Role Update', '2024-12-17 00:58:10', '2024-12-17 00:58:10'),
(38, 'Permission Update', '2024-12-17 00:58:20', '2024-12-17 00:58:20'),
(39, 'Add New Customers', '2024-12-17 02:41:41', '2024-12-17 02:41:41'),
(40, 'View Customer List', '2024-12-17 02:41:55', '2024-12-16 18:30:00'),
(41, 'Import Customers', '2024-12-16 21:12:10', '2024-12-16 21:12:10'),
(42, 'Update Customers', '2024-12-16 21:12:19', '2024-12-16 21:12:19'),
(43, 'Delete Customers', '2024-12-16 21:12:31', '2024-12-16 21:12:31'),
(44, 'Add New Supplier', '2024-12-16 21:38:38', '2024-12-16 21:38:38'),
(45, 'View Supplier List', '2024-12-16 21:38:55', '2024-12-16 21:38:55'),
(46, 'Import Suppliers', '2024-12-16 21:39:14', '2024-12-16 21:39:14'),
(47, 'Update Suppliers', '2024-12-16 21:39:24', '2024-12-16 21:39:24'),
(48, 'Delete Suppliers', '2024-12-16 21:39:36', '2024-12-16 21:39:36'),
(49, 'Add New Items', '2024-12-16 22:31:08', '2024-12-16 22:31:08'),
(50, 'Add New Category', '2024-12-16 22:31:23', '2024-12-16 22:31:23'),
(51, 'View Item List', '2024-12-16 22:31:37', '2024-12-16 22:31:37'),
(52, 'View Item Category List', '2024-12-16 22:32:25', '2024-12-16 22:32:25'),
(53, 'Update Item Category List', '2024-12-16 22:32:44', '2024-12-16 22:32:44'),
(54, 'Delete Item Category', '2024-12-16 22:37:50', '2024-12-16 22:37:50'),
(55, 'Delete Items', '2024-12-16 22:38:05', '2024-12-16 22:38:05'),
(56, 'Update Items', '2024-12-16 22:41:56', '2024-12-16 22:41:56'),
(57, 'Add Stock', '2024-12-17 02:45:46', '2024-12-17 02:45:46'),
(58, 'Import Item', '2024-12-22 21:02:16', '2024-12-22 21:02:16'),
(59, 'Suppliers Status Control', '2024-12-22 21:06:31', '2024-12-22 21:06:31'),
(60, 'Billing', '2024-12-23 17:34:52', '2024-12-23 17:34:52'),
(61, 'Add Sales Returns', '2024-12-23 17:35:05', '2024-12-23 17:35:05'),
(62, 'Sales Items List', '2024-12-23 17:35:23', '2024-12-23 17:35:23'),
(63, 'Sales Return List', '2024-12-23 17:35:37', '2024-12-23 17:35:37'),
(64, 'Process Return', '2024-12-23 17:36:22', '2024-12-23 17:36:22'),
(65, 'View Return List', '2024-12-26 17:50:49', '2024-12-26 17:50:49'),
(66, 'Pay Due Amount', '2025-01-03 18:28:15', '2025-01-03 18:28:15'),
(67, 'View Payment Details', '2025-01-03 18:28:28', '2025-01-03 18:28:28'),
(68, 'Site Setting', '2025-01-03 18:28:37', '2025-01-03 18:28:37'),
(69, 'Change Password', '2025-01-03 18:28:47', '2025-01-03 18:28:47'),
(70, 'Add New Expense', '2025-01-05 00:27:57', '2025-01-05 00:27:57'),
(71, 'Add New Expense Category', '2025-01-05 00:28:12', '2025-01-05 00:28:12'),
(72, 'Expenses List', '2025-01-05 00:28:25', '2025-01-05 00:28:25'),
(73, 'Expenses Category List', '2025-01-05 00:28:38', '2025-01-05 00:28:38'),
(74, 'Edit Expenses', '2025-01-05 01:24:16', '2025-01-05 01:24:16'),
(75, 'Delete Expenses', '2025-01-05 01:24:24', '2025-01-05 01:24:24'),
(76, 'Edit Expenses Category', '2025-01-05 01:24:44', '2025-01-05 01:24:44'),
(77, 'Delete Expenses Category', '2025-01-05 01:24:54', '2025-01-05 01:24:54'),
(78, 'Access Due Amount', '2025-01-05 16:10:56', '2025-01-05 16:10:56'),
(79, 'view sales report', '2025-01-12 02:15:29', '2025-01-12 02:15:29'),
(80, 'view item report', '2025-01-12 02:16:27', '2025-01-12 02:16:27'),
(81, 'view expenses report', '2025-01-12 02:16:38', '2025-01-12 02:16:38'),
(82, 'Change Site Setting', '2025-01-20 02:13:32', '2025-01-20 02:13:32'),
(83, 'Generate Stock Report', '2025-01-20 02:14:08', '2025-01-20 02:14:08'),
(84, 'InHouse_admin', '2025-02-28 08:27:28', '2025-02-28 08:27:28'),
(85, 'Add Mobile Items', '2025-03-06 11:28:06', '2025-03-06 11:28:06'),
(86, 'View Mobile Items', '2025-03-06 11:28:20', '2025-03-06 11:28:20'),
(87, 'Update Mobile Items', '2025-03-06 11:28:28', '2025-03-06 11:28:28'),
(88, 'Add Mobile IMEI', '2025-03-06 11:28:38', '2025-03-06 11:28:38'),
(89, 'Control Mobile Item Status', '2025-03-06 11:28:57', '2025-03-06 11:28:57'),
(90, 'Access Mobile Billing', '2025-03-06 11:29:09', '2025-03-06 11:29:09'),
(91, 'Access Mobile Section', '2025-03-06 11:30:25', '2025-03-06 11:30:25');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

CREATE TABLE `provinces` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_en` varchar(45) NOT NULL,
  `name_si` varchar(45) NOT NULL,
  `name_ta` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
);

--
-- Dumping data for table `provinces`
--

INSERT INTO `provinces` (`id`, `name_en`, `name_si`, `name_ta`, `created_at`, `updated_at`) VALUES
(1, 'default', 'default', 'default', '2024-11-09 09:32:36', '2024-11-09 09:32:36');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_status`
--

CREATE TABLE `purchase_status` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
);

--
-- Dumping data for table `purchase_status`
--

INSERT INTO `purchase_status` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Unsold', '2025-03-05 02:46:53', '2025-03-05 02:46:53'),
(2, 'Sold', '2025-03-05 02:47:13', '2025-03-05 02:47:13');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
);

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2024-12-16 08:08:56', '2024-12-16 08:08:56'),
(2, 'manager', '2024-12-21 12:51:52', '2024-12-21 12:51:52'),
(3, 'Super Admin', '2025-01-10 10:44:11', '2025-01-10 10:44:11');

-- --------------------------------------------------------

--
-- Table structure for table `roles_has_permissions`
--

CREATE TABLE `roles_has_permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `roles_id` bigint(20) UNSIGNED DEFAULT NULL,
  `permissions_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
);

--
-- Dumping data for table `roles_has_permissions`
--

INSERT INTO `roles_has_permissions` (`id`, `roles_id`, `permissions_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 1, 10, NULL, NULL),
(3, 1, 17, NULL, NULL),
(4, 1, 18, NULL, NULL),
(5, 1, 19, NULL, NULL),
(6, 1, 20, NULL, NULL),
(7, 1, 21, NULL, NULL),
(8, 1, 22, NULL, NULL),
(9, 1, 23, NULL, NULL),
(10, 1, 24, NULL, NULL),
(11, 1, 25, NULL, NULL),
(12, 1, 26, NULL, NULL),
(13, 1, 27, NULL, NULL),
(14, 1, 28, NULL, NULL),
(15, 1, 29, NULL, NULL),
(16, 1, 30, NULL, NULL),
(17, 1, 31, NULL, NULL),
(18, 1, 32, NULL, NULL),
(19, 1, 33, NULL, NULL),
(20, 1, 34, NULL, NULL),
(21, 1, 35, NULL, NULL),
(22, 1, 36, NULL, NULL),
(23, 1, 37, NULL, NULL),
(24, 1, 38, NULL, NULL),
(25, 1, 39, NULL, NULL),
(26, 1, 40, NULL, NULL),
(27, 2, 1, NULL, NULL),
(28, 2, 10, NULL, NULL),
(29, 2, 17, NULL, NULL),
(30, 2, 18, NULL, NULL),
(31, 2, 19, NULL, NULL),
(32, 2, 20, NULL, NULL),
(33, 2, 21, NULL, NULL),
(34, 2, 22, NULL, NULL),
(35, 2, 23, NULL, NULL),
(36, 2, 24, NULL, NULL),
(37, 2, 25, NULL, NULL),
(38, 2, 26, NULL, NULL),
(39, 2, 27, NULL, NULL),
(40, 2, 28, NULL, NULL),
(41, 2, 29, NULL, NULL),
(42, 2, 30, NULL, NULL),
(43, 2, 31, NULL, NULL),
(44, 2, 32, NULL, NULL),
(45, 2, 33, NULL, NULL),
(46, 2, 34, NULL, NULL),
(47, 2, 35, NULL, NULL),
(48, 2, 36, NULL, NULL),
(49, 2, 37, NULL, NULL),
(50, 2, 38, NULL, NULL),
(51, 2, 39, NULL, NULL),
(52, 2, 40, NULL, NULL),
(53, 1, 41, NULL, NULL),
(54, 1, 42, NULL, NULL),
(55, 1, 43, NULL, NULL),
(56, 1, 44, NULL, NULL),
(57, 1, 45, NULL, NULL),
(58, 1, 46, NULL, NULL),
(59, 1, 47, NULL, NULL),
(60, 1, 48, NULL, NULL),
(61, 1, 49, NULL, NULL),
(62, 1, 50, NULL, NULL),
(63, 1, 51, NULL, NULL),
(64, 1, 52, NULL, NULL),
(65, 1, 53, NULL, NULL),
(66, 1, 54, NULL, NULL),
(67, 1, 55, NULL, NULL),
(68, 1, 56, NULL, NULL),
(69, 1, 57, NULL, NULL),
(70, 1, 58, NULL, NULL),
(71, 1, 59, NULL, NULL),
(72, 1, 60, NULL, NULL),
(73, 1, 61, NULL, NULL),
(74, 1, 62, NULL, NULL),
(75, 1, 63, NULL, NULL),
(76, 1, 64, NULL, NULL),
(77, 1, 65, NULL, NULL),
(78, 1, 66, NULL, NULL),
(79, 1, 67, NULL, NULL),
(80, 1, 68, NULL, NULL),
(81, 1, 69, NULL, NULL),
(82, 1, 70, NULL, NULL),
(83, 1, 71, NULL, NULL),
(84, 1, 72, NULL, NULL),
(85, 1, 73, NULL, NULL),
(86, 1, 74, NULL, NULL),
(87, 1, 75, NULL, NULL),
(88, 1, 76, NULL, NULL),
(89, 1, 77, NULL, NULL),
(90, 1, 78, NULL, NULL),
(91, 3, 1, NULL, NULL),
(92, 3, 10, NULL, NULL),
(93, 3, 20, NULL, NULL),
(94, 3, 21, NULL, NULL),
(95, 1, 79, NULL, NULL),
(96, 1, 80, NULL, NULL),
(97, 1, 81, NULL, NULL),
(98, 1, 82, NULL, NULL),
(99, 1, 83, NULL, NULL),
(100, 1, 84, NULL, NULL),
(101, 1, 91, NULL, NULL),
(102, 1, 85, NULL, NULL),
(104, 1, 90, NULL, NULL),
(105, 1, 86, NULL, NULL),
(106, 1, 87, NULL, NULL),
(107, 1, 88, NULL, NULL),
(108, 1, 89, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sales_code` varchar(255) NOT NULL,
  `customers_id` bigint(20) UNSIGNED DEFAULT NULL,
  `users_id` bigint(20) UNSIGNED DEFAULT NULL,
  `warranty_period` varchar(255) DEFAULT NULL,
  `warranty_card_no` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
);

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `sales_code`, `customers_id`, `users_id`, `warranty_period`, `warranty_card_no`, `created_at`, `updated_at`) VALUES
(403, 'SALE-67D92A0E5B1F7', 1, 1, NULL, NULL, '2025-03-18 08:08:46', '2025-03-18 08:08:46'),
(404, 'SALE-67D92A1D86223', 1, 1, NULL, NULL, '2025-03-18 08:09:01', '2025-03-18 08:09:01'),
(405, 'SALE-67EBEECA2F283', 1, 1, NULL, NULL, '2025-04-01 13:48:58', '2025-04-01 13:48:58'),
(406, 'SALE-67EBEF2D72E39', 1, 1, NULL, NULL, '2025-04-01 13:50:37', '2025-04-01 13:50:37');

-- --------------------------------------------------------

--
-- Table structure for table `sales_due_payments`
--

CREATE TABLE `sales_due_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `amount_paid` decimal(10,2) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `sale_id` varchar(20) NOT NULL,
  `cheque_number` varchar(20) DEFAULT NULL,
  `cheque_date` date DEFAULT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `sales_items`
--

CREATE TABLE `sales_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `items_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sales_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `discount_type` enum('FIXED','PERCENTAGE') DEFAULT 'FIXED',
  `discount` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `return_quantity` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ;

--
-- Dumping data for table `sales_items`
--

INSERT INTO `sales_items` (`id`, `items_id`, `sales_id`, `quantity`, `discount_type`, `discount`, `created_at`, `updated_at`, `return_quantity`, `status`) VALUES
(730, 43, 403, 1, 'FIXED', 0.00, '2025-03-18 08:08:46', '2025-03-18 08:08:46', NULL, NULL),
(731, 45, 404, 1, 'FIXED', 0.00, '2025-03-18 08:09:01', '2025-03-18 08:12:54', 1, 'not_permanent'),
(732, 44, 404, 1, 'FIXED', 0.00, '2025-03-18 08:09:01', '2025-03-18 08:09:01', NULL, NULL),
(733, 46, 405, 1, 'FIXED', 0.00, '2025-04-01 13:48:58', '2025-04-01 13:48:58', NULL, NULL),
(734, 45, 405, 1, 'FIXED', 0.00, '2025-04-01 13:48:58', '2025-04-01 13:48:58', NULL, NULL),
(735, 44, 406, 1, 'FIXED', 0.00, '2025-04-01 13:50:37', '2025-04-01 13:50:37', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sales_return_items`
--

CREATE TABLE `sales_return_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `sales_id` bigint(20) UNSIGNED NOT NULL,
  `return_quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
);

--
-- Dumping data for table `sales_return_items`
--

INSERT INTO `sales_return_items` (`id`, `item_id`, `sales_id`, `return_quantity`, `created_at`, `updated_at`, `status`) VALUES
(15, 45, 404, 1, '2025-03-18 08:12:54', '2025-03-18 08:12:54', 'not_permanent');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
);

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('Yj6E8lromLX3C3KJh5ZiJOyBZTP9ZUxPiARsM1wb', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNXpZeUxYNmhPaHNqOTM4WDMxa1VPbmxUbjZ6Q0RldHdmUUdMUzlLVSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9pdGVtcy92YWxpZGF0ZS8xMTEwMSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1736185095);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(45) NOT NULL,
  `value` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
);

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'Login Page Image', 'Company Logo/1743514703_8277432.png', '2025-01-19 23:54:24', '2025-04-01 13:38:23'),
(2, 'Login Page Background Color', '#010117', '2025-01-19 23:54:45', '2025-01-30 13:30:19'),
(3, 'Login Page Header Text Color', '#010117', '2025-01-19 23:55:13', '2025-01-30 13:32:31'),
(4, 'Login Button Color', '#010117', '2025-01-19 23:56:00', '2025-01-20 02:09:41'),
(5, 'Login Button Text Color', '#ffffff', '2025-01-19 23:57:06', '2025-03-04 05:25:06'),
(6, 'Company Name', 'Pet POS', '2025-01-19 23:59:00', '2025-04-01 13:39:09'),
(7, 'Header Color', '#000000', '2025-01-19 23:59:18', '2025-04-01 15:29:34'),
(8, 'Footer Color', '#010117', '2025-01-19 23:59:49', '2025-03-18 07:51:24'),
(9, 'Company Address', '12/12 B Matara', '2025-01-20 00:00:34', '2025-04-01 13:39:34'),
(10, 'Company Contact No', '0769999999', '2025-01-20 00:00:54', '2025-04-01 13:39:45'),
(11, 'Company Mobile No', '0778877654', '2025-01-20 00:00:54', '2025-04-01 13:40:00'),
(12, 'Company Web site URL', 'support@plexCode.com', '2025-01-20 00:02:40', '2025-04-01 13:40:14'),
(13, 'Header Icon', 'Company Logo/1743514726_8277432.png', NULL, '2025-04-01 13:38:46'),
(14, 'Header Icon And Font Color', '#010117', NULL, '2025-01-20 22:53:17'),
(15, 'Header Title Color', '#ffffff', NULL, '2025-01-22 05:23:29'),
(16, 'Footer Text Color', '#ffffff', NULL, '2025-01-22 05:23:38');

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` int(11) NOT NULL,
  `site_name` varchar(255) NOT NULL,
  `sidebar_one_name` varchar(255) NOT NULL,
  `sidebar_two_name` varchar(255) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `company_logo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
);

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `site_name`, `sidebar_one_name`, `sidebar_two_name`, `contact_number`, `company_logo`, `created_at`, `updated_at`) VALUES
(2, 'Pet Shop POS', 'aaa', 'aa', '0775463523', 'Company Logo/1743514849_8277432.png', '2024-12-30 04:17:19', '2025-04-01 13:40:49');

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
);

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `status_name`, `created_at`, `updated_at`) VALUES
(1, 'Active', '2024-11-09 09:32:36', '2024-11-09 09:32:36'),
(2, 'Inactive', '2024-11-09 09:32:36', '2024-11-09 09:32:36');

-- --------------------------------------------------------

--
-- Table structure for table `stock_updates`
--

CREATE TABLE `stock_updates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `items_id` bigint(20) UNSIGNED DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `note` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `storages`
--

CREATE TABLE `storages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
);

--
-- Dumping data for table `storages`
--

INSERT INTO `storages` (`id`, `name`, `created_at`, `updated_at`) VALUES
(12, '4', '2025-03-06 14:50:11', '2025-03-06 14:50:11');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplier_name` varchar(45) NOT NULL,
  `contact_number` varchar(45) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `city_id` bigint(20) DEFAULT NULL,
  `city_name` varchar(255) DEFAULT NULL
);

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `supplier_name`, `contact_number`, `email`, `address`, `user_id`, `status_id`, `created_at`, `updated_at`, `city_id`, `city_name`) VALUES
(10, 'abcde', '0765555555', 'abc@gmail.com', 'aaa', 1, 1, '2025-03-18 04:31:44', '2025-03-18 04:31:44', 1, 'aaa'),
(11, 'bbbbb', '1111111111', 'abbbb@gmail.com', 'sss', 1, 1, '2025-03-18 05:10:37', '2025-03-18 05:10:37', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `roles_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status_id` bigint(20) UNSIGNED DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
);

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `number`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `roles_id`, `status_id`, `gender`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'ddddd', 'admin@gmail.com', '0761234567', '2024-11-28 15:41:41', '$2y$12$pFOIESa97xDPZdGUxl.DR.Q6gfFOgY4HFPEoI4Z6K2xonRvkjif6G', NULL, NULL, NULL, 'SdffJOimBTj23LehrSruXe1sQ2d19DESnwesc6x9foZf7LiD3UPwFCFrgHAK', 1, 1, 'male', NULL, NULL, '2025-03-14 11:36:26'),
(2, 'aaaa', 'student@gmail.com', '1234567890', NULL, '$2y$12$5mwtEYTPhEp7Y0EgoQFEOOgd6Gj95MOV5Ibi0yyX7PU6fULzrFYiC', NULL, NULL, NULL, NULL, 1, 1, 'male', NULL, '2024-12-16 08:10:05', '2024-12-16 08:10:05'),
(3, 'master admin', 'madmin@gmail.com', '0760123123', NULL, '$2y$12$QNF07UMEa1E.vPKvIXqcoOjh8cWuPsFw6d341Bb.Ed9iDbrQlumOu', NULL, NULL, NULL, 'VwVz1DTSCIc2cb4IAw71XKM9AQv1oBtCrsN04E0PNJZJVQsYbFb8BmoEDcD7', 1, 1, 'male', NULL, '2024-12-21 12:16:23', '2025-01-25 08:04:21'),
(4, 'abc', 'admin123@gmail.com', '1234567808', NULL, '$2y$12$TjNn.wd4YWVuYXxnxjKLKeupggdqybb8vQ2EXvKakentEyjPiPmLS', NULL, NULL, NULL, '0m491LnRqqrdZpptFyAASRafkDfXuuYsfFG7nLNib7mubAFiRj8f5emXxjoT', 2, 1, 'male', NULL, '2024-12-21 12:52:42', '2024-12-21 12:52:42'),
(5, 'Nimal', 'nimal@gmail.com', '0764534234', NULL, '$2y$12$hMV6iC87vD162.pFpcR3p.AGSxfjUYpsWNfAk32JmDTbLcocACcJy', NULL, NULL, NULL, 'viOQOz2t38UgaEEfuvOtNwh7cYJJZrGmgZtbSfkAvxX9KcrfTENLAbT5Sbq9', 3, 1, 'male', NULL, '2025-01-10 10:46:20', '2025-01-25 12:33:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cities_district_id_foreign` (`district_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customers_cities_id_foreign` (`cities_id`),
  ADD KEY `customers_status_id_foreign` (`status_id`),
  ADD KEY `customers_user_id_foreign` (`user_id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `districts_province_id_foreign` (`province_id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expenses_expense_categories_id_foreign` (`expense_categories_id`),
  ADD KEY `expenses_user_id_foreign` (`user_id`);

--
-- Indexes for table `expense_categories`
--
ALTER TABLE `expense_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expense_categories_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `hold_orders`
--
ALTER TABLE `hold_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hold_orders_customers_id_foreign` (`customers_id`),
  ADD KEY `hold_orders_users_id_foreign` (`users_id`);

--
-- Indexes for table `hold_order_items`
--
ALTER TABLE `hold_order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hold_order_items_users_id_foreign` (`users_id`),
  ADD KEY `hold_order_items_items_id_foreign` (`items_id`),
  ADD KEY `hold_order_items_hold_orders_id_foreign` (`hold_orders_id`);

--
-- Indexes for table `inhouseitemstock`
--
ALTER TABLE `inhouseitemstock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_suppliers_id_foreign` (`suppliers_id`),
  ADD KEY `items_status_id_foreign` (`status_id`),
  ADD KEY `item_category_id_item_fk` (`item_category_id`);

--
-- Indexes for table `item_categories`
--
ALTER TABLE `item_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otheritem_brands`
--
ALTER TABLE `otheritem_brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otheritem_categories`
--
ALTER TABLE `otheritem_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otheritem_types`
--
ALTER TABLE `otheritem_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `other_item`
--
ALTER TABLE `other_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `otherItem_brand_id` (`otherItem_brand_id`),
  ADD KEY `otherItem_category_id` (`otherItem_category_id`),
  ADD KEY `otherItem_type_id` (`otherItem_type_id`),
  ADD KEY `add staus fk` (`status_id`);

--
-- Indexes for table `other_order`
--
ALTER TABLE `other_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `other_payment_id` (`other_payment_id`);

--
-- Indexes for table `other_payment`
--
ALTER TABLE `other_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_sales_id_foreign` (`sales_id`),
  ADD KEY `payments_users_id_foreign` (`users_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_status`
--
ALTER TABLE `purchase_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles_has_permissions`
--
ALTER TABLE `roles_has_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roles_has_permissions_roles_id_foreign` (`roles_id`),
  ADD KEY `roles_has_permissions_permissions_id_foreign` (`permissions_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_customers_id_foreign` (`customers_id`),
  ADD KEY `sales_users_id_foreign` (`users_id`);

--
-- Indexes for table `sales_due_payments`
--
ALTER TABLE `sales_due_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_items`
--
ALTER TABLE `sales_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_items_items_id_foreign` (`items_id`),
  ADD KEY `sales_items_sales_id_foreign` (`sales_id`);

--
-- Indexes for table `sales_return_items`
--
ALTER TABLE `sales_return_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_return_items_item_id_foreign` (`item_id`),
  ADD KEY `sales_return_items_sales_id_foreign` (`sales_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`),
  ADD KEY `sessions_user_id_index` (`user_id`) USING BTREE;

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_updates`
--
ALTER TABLE `stock_updates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_updates_user_id_foreign` (`user_id`),
  ADD KEY `stock_updates_items_id_foreign` (`items_id`);

--
-- Indexes for table `storages`
--
ALTER TABLE `storages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `suppliers_user_id_foreign` (`user_id`),
  ADD KEY `suppliers_status_id_foreign` (`status_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_number_unique` (`number`),
  ADD KEY `users_roles_id_foreign` (`roles_id`),
  ADD KEY `users_status_id_foreign` (`status_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `expense_categories`
--
ALTER TABLE `expense_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hold_orders`
--
ALTER TABLE `hold_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `hold_order_items`
--
ALTER TABLE `hold_order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `inhouseitemstock`
--
ALTER TABLE `inhouseitemstock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `item_categories`
--
ALTER TABLE `item_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `otheritem_brands`
--
ALTER TABLE `otheritem_brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `otheritem_categories`
--
ALTER TABLE `otheritem_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `otheritem_types`
--
ALTER TABLE `otheritem_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `other_item`
--
ALTER TABLE `other_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `other_order`
--
ALTER TABLE `other_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `other_payment`
--
ALTER TABLE `other_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=337;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `provinces`
--
ALTER TABLE `provinces`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `purchase_status`
--
ALTER TABLE `purchase_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles_has_permissions`
--
ALTER TABLE `roles_has_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=407;

--
-- AUTO_INCREMENT for table `sales_due_payments`
--
ALTER TABLE `sales_due_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `sales_items`
--
ALTER TABLE `sales_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=736;

--
-- AUTO_INCREMENT for table `sales_return_items`
--
ALTER TABLE `sales_return_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stock_updates`
--
ALTER TABLE `stock_updates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `storages`
--
ALTER TABLE `storages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`);

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_cities_id_foreign` FOREIGN KEY (`cities_id`) REFERENCES `cities` (`id`),
  ADD CONSTRAINT `customers_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`),
  ADD CONSTRAINT `customers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `districts`
--
ALTER TABLE `districts`
  ADD CONSTRAINT `districts_province_id_foreign` FOREIGN KEY (`province_id`) REFERENCES `provinces` (`id`);

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_expense_categories_id_foreign` FOREIGN KEY (`expense_categories_id`) REFERENCES `expense_categories` (`id`),
  ADD CONSTRAINT `expenses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `expense_categories`
--
ALTER TABLE `expense_categories`
  ADD CONSTRAINT `expense_categories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `hold_orders`
--
ALTER TABLE `hold_orders`
  ADD CONSTRAINT `hold_orders_customers_id_foreign` FOREIGN KEY (`customers_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `hold_orders_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `hold_order_items`
--
ALTER TABLE `hold_order_items`
  ADD CONSTRAINT `hold_order_items_hold_orders_id_foreign` FOREIGN KEY (`hold_orders_id`) REFERENCES `hold_orders` (`id`),
  ADD CONSTRAINT `hold_order_items_items_id_foreign` FOREIGN KEY (`items_id`) REFERENCES `items` (`id`),
  ADD CONSTRAINT `hold_order_items_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `item_category_id_item_fk` FOREIGN KEY (`item_category_id`) REFERENCES `item_categories` (`id`),
  ADD CONSTRAINT `items_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`),
  ADD CONSTRAINT `items_suppliers_id_foreign` FOREIGN KEY (`suppliers_id`) REFERENCES `suppliers` (`id`);

--
-- Constraints for table `other_item`
--
ALTER TABLE `other_item`
  ADD CONSTRAINT `add staus fk` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`),
  ADD CONSTRAINT `other_item_ibfk_1` FOREIGN KEY (`otherItem_brand_id`) REFERENCES `otheritem_brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `other_item_ibfk_2` FOREIGN KEY (`otherItem_category_id`) REFERENCES `otheritem_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `other_item_ibfk_3` FOREIGN KEY (`otherItem_type_id`) REFERENCES `otheritem_types` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `other_order`
--
ALTER TABLE `other_order`
  ADD CONSTRAINT `other_order_ibfk_1` FOREIGN KEY (`other_payment_id`) REFERENCES `other_payment` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_sales_id_foreign` FOREIGN KEY (`sales_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `roles_has_permissions`
--
ALTER TABLE `roles_has_permissions`
  ADD CONSTRAINT `roles_has_permissions_permissions_id_foreign` FOREIGN KEY (`permissions_id`) REFERENCES `permissions` (`id`),
  ADD CONSTRAINT `roles_has_permissions_roles_id_foreign` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_customers_id_foreign` FOREIGN KEY (`customers_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `sales_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `sales_items`
--
ALTER TABLE `sales_items`
  ADD CONSTRAINT `sales_items_items_id_foreign` FOREIGN KEY (`items_id`) REFERENCES `items` (`id`),
  ADD CONSTRAINT `sales_items_sales_id_foreign` FOREIGN KEY (`sales_id`) REFERENCES `sales` (`id`);

--
-- Constraints for table `sales_return_items`
--
ALTER TABLE `sales_return_items`
  ADD CONSTRAINT `sales_return_items_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`),
  ADD CONSTRAINT `sales_return_items_sales_id_foreign` FOREIGN KEY (`sales_id`) REFERENCES `sales` (`id`);

--
-- Constraints for table `stock_updates`
--
ALTER TABLE `stock_updates`
  ADD CONSTRAINT `stock_updates_items_id_foreign` FOREIGN KEY (`items_id`) REFERENCES `items` (`id`),
  ADD CONSTRAINT `stock_updates_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD CONSTRAINT `suppliers_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`),
  ADD CONSTRAINT `suppliers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_roles_id_foreign` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `users_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
