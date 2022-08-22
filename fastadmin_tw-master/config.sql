-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- 主機： localhost
-- 產生時間： 2021 年 02 月 01 日 16:44
-- 伺服器版本： 5.6.41-log
-- PHP 版本： 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `icarepo1_test`
--

-- --------------------------------------------------------

--
-- 資料表結構 `config`
--

CREATE TABLE `config` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) DEFAULT '' COMMENT '變量名',
  `group` varchar(30) DEFAULT '' COMMENT '分組',
  `title` varchar(100) DEFAULT '' COMMENT '變量標題',
  `tip` varchar(100) DEFAULT '' COMMENT '變量描述',
  `type` varchar(30) DEFAULT '' COMMENT '類型:string,text,int,bool,array,datetime,date,file',
  `value` text COMMENT '變量值',
  `content` text COMMENT '變量字典數據',
  `rule` varchar(100) DEFAULT '' COMMENT '驗證規則',
  `extend` varchar(255) DEFAULT '' COMMENT '擴展屬性',
  `setting` varchar(255) DEFAULT '' COMMENT '配置'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='系統配置';

--
-- 傾印資料表的資料 `config`
--

INSERT INTO `config` (`id`, `name`, `group`, `title`, `tip`, `type`, `value`, `content`, `rule`, `extend`, `setting`) VALUES
(1, 'name', 'basic', 'Site name', '請填寫網站名稱', 'string', '我的網站', '', 'required', '', NULL),
(2, 'beian', 'basic', 'Beian', '備案號', 'string', '', '', '', '', NULL),
(3, 'cdnurl', 'basic', 'Cdn url', '如果全站靜態資源使用第三方儲存請配置該值', 'string', '', '', '', '', NULL),
(4, 'version', 'basic', 'Version', '如果靜態資源有變動請重新配置該值', 'string', '1.0.3', '', 'required', '', NULL),
(5, 'timezone', 'basic', 'Timezone', '', 'string', 'Asia/Shanghai', '', 'required', '', NULL),
(6, 'forbiddenip', 'basic', 'Forbidden ip', '一行一條記錄', 'text', '', '', '', '', NULL),
(7, 'languages', 'basic', 'Languages', '', 'array', '{\"backend\":\"zh-cn\",\"frontend\":\"zh-cn\"}', '', 'required', '', NULL),
(8, 'fixedpage', 'basic', 'Fixed page', '請盡量輸入左側菜單欄存在的鏈接', 'string', 'user/dashboard', '', 'required', '', NULL),
(9, 'categorytype', 'dictionary', 'Category type', '', 'array', '{\"default\":\"Default\",\"page\":\"Page\",\"article\":\"Article\",\"test\":\"Test\"}', '', '', '', ''),
(10, 'configgroup', 'dictionary', 'Config group', '', 'array', '{\"basic\":\"Basic\",\"email\":\"Email\",\"dictionary\":\"Dictionary\",\"user\":\"User\",\"example\":\"Example\"}', '', '', '', ''),
(11, 'mail_type', 'email', 'Mail type', '選擇郵件發送方式', 'select', '1', '[\"請選擇\",\"SMTP\",\"Mail\"]', '', '', ''),
(12, 'mail_smtp_host', 'email', 'Mail smtp host', '錯誤的配置發送郵件會導致服務器超時', 'string', 'smtp.gmail.com', '', '', '', ''),
(13, 'mail_smtp_port', 'email', 'Mail smtp port', '(不加密默認25,SSL默認465,TLS默認587)', 'string', '465', '', '', '', ''),
(14, 'mail_smtp_user', 'email', 'Mail smtp user', '（填寫完整用戶名）', 'string', '10000', '', '', '', ''),
(15, 'mail_smtp_pass', 'email', 'Mail smtp password', '（填寫您的密碼）', 'string', 'password', '', '', '', ''),
(16, 'mail_verify_type', 'email', 'Mail vertify type', '（SMTP驗證方式[推薦SSL]）', 'select', '2', '[\"无\",\"TLS\",\"SSL\"]', '', '', ''),
(17, 'mail_from', 'email', 'Mail from', '', 'string', '10000@gmail.com', '', '', '', ''),
(18, 'url', 'basic', '路徑', 'API路徑', 'array', '{\"furl\":\"https://www.myweb.com\",\"burl\":\"https://www.myweb.com/backpanel.php\",\"api\":\"https://www.myweb.com/api\"}', '{\"value1\":\"title1\",\"value2\":\"title2\"}', '', '', NULL);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `config`
--
ALTER TABLE `config`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
