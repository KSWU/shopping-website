-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2023-06-19 23:26:03
-- 伺服器版本： 10.4.27-MariaDB
-- PHP 版本： 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `group_03`
--
CREATE DATABASE IF NOT EXISTS `group_03` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `group_03`;

-- --------------------------------------------------------

--
-- 資料表結構 `member`
--

CREATE TABLE `member` (
  `member_id` int(11) NOT NULL,
  `username` varchar(13) NOT NULL,
  `password` varchar(200) NOT NULL,
  `member_name` varchar(11) NOT NULL,
  `sex` varchar(4) NOT NULL,
  `birthday` date NOT NULL,
  `tel_num` varchar(11) DEFAULT NULL,
  `addr` varchar(51) DEFAULT NULL,
  `mail` varchar(51) NOT NULL,
  `admin` varchar(4) DEFAULT NULL,
  `member_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `member`
--

INSERT INTO `member` (`member_id`, `username`, `password`, `member_name`, `sex`, `birthday`, `tel_num`, `addr`, `mail`, `admin`, `member_date`) VALUES
(5, 'member', '$2y$10$i2/wWLUqkeyWvcH64ZwHM.sV/z916tnR5312jkL/9PnBqp/U4/fHu', '會員一號', '女', '2001-06-20', '0968979379', '進德路1號', 's1154039@mail.ncue.edu.tw', NULL, '2023-05-08'),
(7, 'admin', '$2y$10$tisCEM4LzwSJHNqZlfA7Uuv8cBualOPa4RhhapSVwPZ9by3EvWe/e', '管理者一號', '男', '2023-06-22', '087659750', '進德路2號', 'pattyzx456789@gmail.com', 'yes', '2023-05-08'),
(8, 'patty', '$2y$10$AuIISBZmHA1uRQ.TyJmdpuuZdwh2/KXJmzLfH9IT0obuX.G6xTrRO', '蒂蒂', '女', '2023-05-17', '', '你好', 'pattyzx329329@gmail.com', NULL, '2023-06-19'),
(9, 'david', '$2y$10$7n./2FhJBZT92P9TL6HRgOyYRaJ0885frHv4cYGGT3weMGllquElK', '大衛', '男', '2023-06-07', '', '', 's1012138@gm.ncue.edu.tw', NULL, '2023-06-19'),
(10, 'lily', '$2y$10$cdKcaOCIqjuzr3FfVihXVeBOkg8DFSc5pW83MVqV0sJvv6AN62JBC', 'lily', '女', '2023-06-14', '', '', 'pattyzx456789@yahoo.com.tw', NULL, '2023-06-19'),
(11, 'rere', '$2y$10$XymY7YGADMypKeTSGz7qrevq8Ui1ShjqGA6l7PrYM2tzRu1ZE1qlu', '芮芮', '女', '2023-06-21', '087659759', '進德路', 'pattyzx456789@yahoo.com.tw', NULL, '2023-06-19'),
(12, 'admin2', '$2y$10$k/Om4CYZP.4YOkA3dqdI3OdosymmF9DKl6X/27LAuptW9uJg19sii', '管理員二號', '女', '2023-06-28', '', '', 'pa@gmail.com', 'yes', '2023-06-19');

-- --------------------------------------------------------

--
-- 資料表結構 `message`
--

CREATE TABLE `message` (
  `msge_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `msge` varchar(200) NOT NULL,
  `msge_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `message`
--

INSERT INTO `message` (`msge_id`, `member_id`, `product_id`, `msge`, `msge_date`) VALUES
(1, 5, 1, '請問還有現貨嗎?', '2023-05-26 07:29:32'),
(2, 7, 1, '有的喔~', '2023-05-27 07:14:25'),
(3, 5, 2, '請問164cm穿會太短嗎?', '2023-05-25 13:14:24'),
(4, 7, 2, '寶子你好~剛好落地喔~', '2023-05-27 10:17:27'),
(6, 5, 2, 'hello', '2023-06-19 23:06:08'),
(7, 5, 2, 'hello123', '2023-06-19 23:07:41'),
(8, 5, 2, 'hellohello', '2023-06-19 23:09:16');

-- --------------------------------------------------------

--
-- 資料表結構 `order_manage`
--

CREATE TABLE `order_manage` (
  `order_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL,
  `payment_methon` varchar(21) NOT NULL,
  `total_consumption` int(11) NOT NULL,
  `recipient` varchar(21) NOT NULL,
  `recipient_phone` varchar(11) NOT NULL,
  `shipping_addr` varchar(51) NOT NULL,
  `order_state` varchar(21) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `order_manage`
--

INSERT INTO `order_manage` (`order_id`, `member_id`, `order_date`, `payment_methon`, `total_consumption`, `recipient`, `recipient_phone`, `shipping_addr`, `order_state`) VALUES
(1, 5, '2023-05-27 11:21:18', '貨到付款', 1290, '陳德仁', '0912345678', '彰化市寶山路1號', '待確認'),
(2, 5, '2023-05-27 12:23:41', '貨到付款', 2870, '陳小德', '0912345678', '彰化市寶山路1號', '待確認'),
(3, 11, '2023-06-19 05:08:24', 'ATM轉帳', 5550, '芮芮', '0999999', '寶山路一號', '已完成'),
(5, 9, '2023-06-19 05:10:43', 'ATM轉帳', 3360, '大衛', '09787878', '寶山路二號', '待確認');

-- --------------------------------------------------------

--
-- 資料表結構 `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(21) NOT NULL,
  `price` int(50) NOT NULL,
  `intro` varchar(200) DEFAULT NULL,
  `category` varchar(5) NOT NULL,
  `quality` int(11) DEFAULT NULL,
  `product_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `price`, `intro`, `category`, `quality`, `product_date`) VALUES
(1, '輕薄質感下開岔杏黃襯衫', 590, '*實品顏色依單品照為主\r\n棉 65% 聚酯纖維 35%\r\n厚薄:適中\r\n彈性:無\r\n素材產地 / 中國\r\n加工產地 / 中國\r\n輕薄襯衫材質/四釦設計/下擺無釦可以自然開岔', '上衣', 0, '2023-05-10'),
(2, '俐落打褶西裝短褲', 990, '*實品顏色依單品照為主\r\n聚酯纖維 80% 嫘縈 20%\r\n厚薄:適中\r\n彈性:無\r\n素材產地 / 中國\r\n加工產地 / 中國\r\n細緻西裝面料/兩側有口袋/後面裝飾口袋', '短褲', 28, '2023-05-11'),
(3, '編織感緹花修身咖啡微喇叭', 1290, '*實品顏色依單品照為主\r\n聚酯纖維 100 %\r\n厚薄:適中\r\n彈性:無\r\n素材產地 / 中國\r\n加工產地 / 中國\r\n紋理感緹花面料/緞面光澤感/修身喇叭褲版型/兩側有口袋/白色建議穿著淺色內著或搭配長版上衣', '長褲', 18, '2023-05-11'),
(4, '短版細緻白蕾絲襯衫', 990, '*實品顏色依單品照為主\r\n尼龍 90% 彈性纖維 10%\r\n厚薄:薄\r\n彈性:無\r\n素材產地 / 中國\r\n加工產地 / 中國\r\n柔軟親膚針織蕾絲/花草感造型蕾絲/下擺弧形造型/門襟開釦設計/短版版型', '上衣', 56, '2023-05-11'),
(5, '短版細緻黑蕾絲襯衫', 990, '*實品顏色依單品照為主\r\n尼龍 90% 彈性纖維 10%\r\n厚薄:薄\r\n彈性:無\r\n素材產地 / 中國\r\n加工產地 / 中國\r\n柔軟親膚針織蕾絲/花草感造型蕾絲/下擺弧形造型/門襟開釦設計/短版版型', '上衣', 75, '2023-05-11'),
(6, '暈染感墨綠網紗長袖上衣', 690, '*實品顏色依單品照為主\r\n聚酯纖維 95% 彈性纖維 5%\r\n厚薄:薄\r\n彈性:適中\r\n素材產地 / 中國\r\n加工產地 / 中國\r\n涼感親柔網紗面料/後開隱形拉鍊拉鍊/小高領造型/套指設計建議參考袖長尺寸做選擇/此款為大圖印花面料，每件商品印花效果略有不同', '上衣', 34, '2023-05-27'),
(7, '輕薄質感下開岔果綠襯衫', 690, '*實品顏色依單品照為主\r\n棉 65% 聚酯纖維 35%\r\n厚薄:適中\r\n彈性:無\r\n素材產地 / 中國\r\n加工產地 / 中國\r\n輕薄襯衫材質/四釦設計/下擺無釦可以自然開', '上衣', 76, '2023-05-27'),
(8, '親膚軟滑高領寬鬆杏透膚上衣', 690, '*實品顏色依單品照為主\r\n聚酯纖維 100%\r\n厚薄:薄\r\n彈性:無\r\n素材產地 / 中國\r\n加工產地 / 中國\r\n親膚軟滑布料/高領設計/後開水滴洞/袖口及下擺做拷克邊處理', '上衣', 77, '2023-05-27'),
(9, '親膚軟滑高領寬鬆黑透膚上衣', 690, '*實品顏色依單品照為主\r\n聚酯纖維 100%\r\n厚薄:薄\r\n彈性:無\r\n素材產地 / 中國\r\n加工產地 / 中國\r\n親膚軟滑布料/高領設計/後開水滴洞/袖口及下擺做拷克邊處理', '上衣', 70, '2023-05-27'),
(10, '編織感白緹花修身微喇叭褲', 1290, '*實品顏色依單品照為主\r\n聚酯纖維 100 %\r\n厚薄:適中\r\n彈性:無\r\n素材產地 / 中國\r\n加工產地 / 中國\r\n紋理感緹花面料/緞面光澤感/修身喇叭褲版型/兩側有口袋/白色建議穿著淺色內著或搭配長版上衣', '上衣', 69, '2023-05-12'),
(11, '單口袋造型霧綠西裝長褲', 990, '*實品顏色依單品照為主\r\n聚酯纖維 100%\r\n厚薄:適中\r\n彈性:無\r\n素材產地 / 中國\r\n加工產地 / 中國\r\n前片假口袋設計/後片真口袋/腰結鉤釦設計', '長褲', 56, '2023-05-27'),
(12, '單口袋造型黑西裝長褲', 690, '*實品顏色依單品照為主\r\n聚酯纖維 100%\r\n厚薄:適中\r\n彈性:無\r\n素材產地 / 中國\r\n加工產地 / 中國\r\n前片假口袋設計/後片真口袋/腰結鉤釦設計', '長褲', 34, '2023-05-27'),
(13, '舒適棉感壓褶白長褲', 790, '*實品顏色依單品照為主\r\n聚酯纖維 95% 彈性纖維 5%\r\n厚薄:適中\r\n彈性:佳\r\n素材產地 / 中國\r\n加工產地 / 中國\r\n無內裡/側邊口袋設計/腰頭全鬆緊有抽繩', '長褲', 66, '2023-05-27'),
(14, '質感修身高腰條紋寬褲', 690, '*實品顏色依單品照為主\r\n聚酯纖維 65% 人造絲 35%\r\n厚薄:適中\r\n彈性:無\r\n素材產地 / 中國\r\n加工產地 / 中國\r\n褲頭暗鉤釦設計/褲頭附耳仔可穿皮帶/雙側斜口袋/無內裡', '長褲', 34, '2023-05-27'),
(15, '編織感黑緹花修身微喇叭褲', 1290, '*實品顏色依單品照為主\r\n聚酯纖維 100 %\r\n厚薄:適中\r\n彈性:無\r\n素材產地 / 中國\r\n加工產地 / 中國\r\n紋理感緹花面料/緞面光澤感/修身喇叭褲版型/兩側有口袋/白色建議穿著淺色內著或搭配長版上衣', '長褲', 70, '2023-05-27'),
(16, '俐落打褶西裝灰短褲', 1290, '*實品顏色依單品照為主\r\n聚酯纖維 80% 嫘縈 20%\r\n厚薄:適中\r\n彈性:無\r\n素材產地 / 中國\r\n加工產地 / 中國\r\n細緻西裝面料/兩側有口袋/後面裝飾口袋', '短褲', 34, '2023-05-27'),
(17, '舒適彈力日常白五分褲', 490, '*實品顏色依單品照為主\r\n聚酯纖維 79% 彈性纖維 21%\r\n厚薄:適中\r\n彈性:佳\r\n素材產地 / 台灣\r\n加工產地 / 台灣\r\n台灣製造/親膚柔彈面料/寬腰結造型增加包覆性', '短褲', 70, '2023-05-24'),
(18, '鬆緊抽繩白小短褲', 490, '*實品顏色依單品照為主\r\n嫘縈纖維 48% 聚酯纖維 45% 彈性纖維 7%\r\n厚薄:適中\r\n彈性:佳\r\n素材產地 / 台灣\r\n加工產地 / 台灣\r\n台灣製造/左右兩側有口袋/下擺圍細滾邊/腰圍鬆緊抽繩設計', '短褲', 56, '2023-05-27'),
(19, '鬆緊抽繩灰小短褲', 490, '*實品顏色依單品照為主\r\n嫘縈纖維 48% 聚酯纖維 45% 彈性纖維 7%\r\n厚薄:適中\r\n彈性:佳\r\n素材產地 / 台灣\r\n加工產地 / 台灣\r\n台灣製造/左右兩側有口袋/下擺圍細滾邊/腰圍鬆緊抽繩設計', '短褲', 76, '2023-05-27'),
(20, '舒適日常顯瘦灰五分褲', 490, '*實品顏色依單品照為主\r\n棉 93% 彈性纖維 7%\r\n厚薄:適中\r\n彈性:佳\r\n素材產地 / 台灣\r\n加工產地 / 台灣\r\n台灣製造/親膚柔棉布料/寬腰結包覆設計/前片顯瘦剪接線/實際售價以官網為主', '短褲', 56, '2023-05-27'),
(21, '蕾絲雙層白半身裙', 1390, '*實品顏色依單品照為主\r\n主布:聚酯纖維 100% 裡布:聚酯纖維 100% 蕾絲:尼龍 90% 彈性纖維 10%\r\n厚薄:適中\r\n彈性:無\r\n素材產地 / 中國\r\n加工產地 / 中國\r\n細緻刺繡蕾絲/兩側下襬開岔設計/側邊隱形拉鍊/有內裡/訂染布料初期會有些許吐色反應，經洗滌後淡化,黑色請與淺色衣物分開洗滌', '裙裝', 34, '2023-05-27'),
(22, '拼接剪裁黑魚尾裙', 1190, '*實品顏色依單品照為主\r\n主布:聚酯纖維 80% 嫘縈 20% 裡布:聚酯纖維 95% 彈性纖維 5%\r\n厚薄:適中\r\n彈性:無\r\n素材產地 / 中國\r\n加工產地 / 中國\r\n細緻西裝面料/側邊隱形拉鍊勾釦設計/有內裡/修身剪裁/傘擺魚尾裙襬造型', '裙裝', 66, '2023-05-27'),
(23, '拼接剪裁淺暖灰魚尾裙', 1190, '*實品顏色依單品照為主\r\n主布:聚酯纖維 80% 嫘縈 20% 裡布:聚酯纖維 95% 彈性纖維 5%\r\n厚薄:適中\r\n彈性:無\r\n素材產地 / 中國\r\n加工產地 / 中國\r\n細緻西裝面料/側邊隱形拉鍊勾釦設計/有內裡/修身剪裁/傘擺魚尾裙襬造型', '裙裝', 56, '2023-05-27'),
(24, '拼接剪裁冷灰棕魚尾裙', 1190, '*實品顏色依單品照為主\r\n主布:聚酯纖維 80% 嫘縈 20% 裡布:聚酯纖維 95% 彈性纖維 5%\r\n厚薄:適中\r\n彈性:無\r\n素材產地 / 中國\r\n加工產地 / 中國\r\n細緻西裝面料/側邊隱形拉鍊勾釦設計/有內裡/修身剪裁/傘擺魚尾裙襬造型', '裙裝', 70, '2023-05-27'),
(25, '兩穿式綁帶造型開岔米杏中長裙', 790, '*實品顏色依單品照為主\r\n聚酯纖維 95% 彈性纖維 5%\r\n厚薄:適中\r\n彈性:無\r\n素材產地 / 中國\r\n加工產地 / 中國\r\n側拉鍊綁帶造型/可前後兩穿/開岔造型/交壘設計/無內裡/造型假口袋', '裙裝', 34, '2023-05-27'),
(26, '兩穿式綁帶造型開岔深灰中長裙', 790, '*實品顏色依單品照為主\r\n聚酯纖維 95% 彈性纖維 5%\r\n厚薄:適中\r\n彈性:無\r\n素材產地 / 中國\r\n加工產地 / 中國\r\n側拉鍊綁帶造型/可前後兩穿/開岔造型/交壘設計/無內裡/造型假口袋', '裙裝', 66, '2023-05-27'),
(27, '親膚軟滑百褶裙', 790, '*實品顏色依單品照為主\r\n聚酯纖維 100%\r\n厚薄:薄\r\n彈性:無\r\n素材產地 / 中國\r\n加工產地 / 中國\r\n親膚軟滑布料/高領設計/後開水滴洞/袖口及下擺做拷克邊處理', '連身', 56, '2023-05-27'),
(28, '俐落雙釦短版淺暖灰西裝外套', 1290, '*實品顏色依單品照為主\r\n主布:聚酯纖維 80% 嫘縈 20% 裡布:聚酯纖維 95% 彈性纖維 5%\r\n厚薄:適中\r\n\r\n彈性:無\r\n素材產地 / 中國\r\n加工產地 / 中國\r\n細緻西裝面料/短版造型/附不可拆薄墊肩/有內裡/雙釦造型/無口袋', '外套', 34, '2023-05-27'),
(29, '俐落雙釦短版橄欖棕西裝外套', 1290, '*實品顏色依單品照為主\r\n主布:聚酯纖維 80% 嫘縈 20% 裡布:聚酯纖維 95% 彈性纖維 5%\r\n厚薄:適中\r\n彈性:無\r\n素材產地 / 中國\r\n加工產地 / 中國\r\n細緻西裝面料/短版造型/附不可拆薄墊肩/有內裡/雙釦造型/無口袋', '外套', 55, '2023-05-27'),
(30, '俐落雙釦短版灰卡其西裝外套', 1190, '*實品顏色依單品照為主\r\n主布:聚酯纖維 80% 嫘縈 20% 裡布:聚酯纖維 95% 彈性纖維 5%\r\n厚薄:適中\r\n\r\n彈性:無\r\n素材產地 / 中國\r\n加工產地 / 中國\r\n細緻西裝面料/短版造型/附不可拆薄墊肩/有內裡/雙釦造型/無口袋', '外套', 55, '2023-05-27'),
(31, '俐落雙釦短版冷灰棕西裝外套', 990, '*實品顏色依單品照為主\r\n主布:聚酯纖維 80% 嫘縈 20% 裡布:聚酯纖維 95% 彈性纖維 5%\r\n厚薄:適中\r\n\r\n彈性:無\r\n素材產地 / 中國\r\n加工產地 / 中國\r\n細緻西裝面料/短版造型/附不可拆薄墊肩/有內裡/雙釦造型/無口袋', '外套', 66, '2023-05-27'),
(32, '簡約緞面珍珠白連身裙', 1190, '*實品顏色依單品照為主\r\n聚酯纖維 100%\r\n厚薄:薄\r\n彈性:無\r\n素材產地 / 中國\r\n加工產地 / 中國\r\n親膚軟滑布料/高領設計/後開水滴洞/袖口及下擺做拷克邊處理', '連身', 80, '2023-05-27'),
(33, '簡約長條墜感珍珠金耳飾', 590, '*實品顏色依單品照為主\r\n壓克力+合金\r\n素材產地 / 韓國\r\n加工產地 / 韓國\r\n直立珍珠垂墜設計/耳針款', '配飾', 30, '2023-05-18'),
(34, '蕾絲黑透膚連身裙', 1290, '*實品顏色依單品照為主\r\n聚酯纖維 95% 彈性纖維 5%\r\n厚薄:適中\r\n彈性:無\r\n素材產地 / 中國\r\n加工產地 / 中國\r\n側拉鍊綁帶造型/可前後兩穿/開岔造型/交壘設計/無內裡/造型假口袋', '連身', 80, '2023-05-19'),
(35, '簡約長條墜感珍珠銀耳飾', 490, '*實品顏色依單品照為主\r\n壓克力+合金\r\n素材產地 / 韓國\r\n加工產地 / 韓國\r\n直立珍珠垂墜設計/耳針款', '配飾', 55, '2023-05-11'),
(36, '日系不對稱黑蝴蝶結串珠耳飾', 690, '*實品顏色依單品照為主\r\n壓克力 合金\r\n素材產地 / 韓國\r\n加工產地 / 韓國\r\n不對稱串珠設計/耳針款', '配飾', 80, '2023-05-27'),
(37, '日系透膚五分袖長裙', 890, '*實品顏色依單品照為主\r\n聚酯纖維 100%\r\n厚薄:薄\r\n彈性:無\r\n素材產地 / 中國\r\n加工產地 / 中國\r\n親膚軟滑布料/高領設計/後開水滴洞/袖口及下擺做拷克邊處理', '連身', 35, '2023-05-27'),
(38, '優雅感垂墜珍珠耳飾', 790, '*實品顏色依單品照為主\r\n珍珠 合金\r\n素材產地 / 韓國\r\n加工產地 / 韓國\r\n不對稱珍珠垂墜設計/耳針款', '配飾', 12, '2023-05-27'),
(39, '日系厚底白樂福鞋', 290, '*實品顏色依單品照為主\r\n棉+尼龍+彈性纖維\r\n厚薄:適中\r\n彈性:無\r\n素材產地 / 中國\r\n加工產地 / 中國\r\n厚底鞋/人工皮革材質', '鞋子', 22, '2023-05-27'),
(40, '黑尖頭商務細高跟', 390, '*實品顏色依單品照為主\r\n棉+尼龍+彈性纖維\r\n厚薄:適中\r\n彈性:無\r\n素材產地 / 中國\r\n加工產地 / 中國\r\n黑高跟/厚皮革材質', '鞋子', 33, '2023-05-18'),
(41, '日系感淺米黃暗紋花朵膝下襪', 290, '*實品顏色依單品照為主\r\n尼龍 88% 彈性纖維 12%\r\n厚薄:薄\r\n彈性:佳\r\n素材產地 / 中國\r\n加工產地 / 中國\r\n膝下襪/舒適天鵝絨/暗紋花朵圖案', '配飾', 33, '2023-05-27'),
(42, '日系感暗紋黑花朵膝下襪', 190, '*實品顏色依單品照為主\r\n尼龍 88% 彈性纖維 12%\r\n厚薄:薄\r\n彈性:佳\r\n素材產地 / 中國\r\n加工產地 / 中國\r\n膝下襪/舒適天鵝絨/暗紋花朵圖案', '配飾', 12, '2023-05-19'),
(43, '霧面壓褶造型提袋', 990, '*實品顏色依單品照為主\r\n主布:聚酯纖維 100% 裡布:聚酯纖維 95% 彈性纖維 5%\r\n厚薄:適中\r\n彈性:無\r\n素材產地 / 中國\r\n加工產地 / 中國\r\n袋口包邊造型/霧面質感壓褶布料/附內裡/無夾層', '配飾', 43, '2023-05-27'),
(44, '綁帶尖頭圓高跟鞋', 1290, '*實品顏色依單品照為主\r\n棉+尼龍+彈性纖維\r\n厚薄:適中\r\n彈性:無\r\n素材產地 / 中國\r\n加工產地 / 中國\r\n黑高跟/厚皮革材質', '鞋子', 77, '2023-05-25');

-- --------------------------------------------------------

--
-- 資料表結構 `product_sales`
--

CREATE TABLE `product_sales` (
  `sales_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `num` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `product_sales`
--

INSERT INTO `product_sales` (`sales_id`, `order_id`, `product_id`, `num`) VALUES
(1, 1, 10, 1),
(2, 2, 1, 1),
(3, 2, 2, 1),
(4, 2, 3, 1),
(5, 3, 3, 2),
(6, 3, 2, 2),
(7, 3, 5, 1),
(12, 5, 17, 1),
(13, 5, 21, 1),
(14, 5, 8, 1),
(15, 5, 27, 1);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`member_id`);

--
-- 資料表索引 `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`msge_id`),
  ADD KEY `member_id` (`member_id`),
  ADD KEY `product_id` (`product_id`);

--
-- 資料表索引 `order_manage`
--
ALTER TABLE `order_manage`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `member_id` (`member_id`);

--
-- 資料表索引 `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- 資料表索引 `product_sales`
--
ALTER TABLE `product_sales`
  ADD PRIMARY KEY (`sales_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `member`
--
ALTER TABLE `member`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `message`
--
ALTER TABLE `message`
  MODIFY `msge_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `order_manage`
--
ALTER TABLE `order_manage`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `product_sales`
--
ALTER TABLE `product_sales`
  MODIFY `sales_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`),
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- 資料表的限制式 `order_manage`
--
ALTER TABLE `order_manage`
  ADD CONSTRAINT `order_manage_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`);

--
-- 資料表的限制式 `product_sales`
--
ALTER TABLE `product_sales`
  ADD CONSTRAINT `product_sales_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order_manage` (`order_id`),
  ADD CONSTRAINT `product_sales_ibfk_3` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);
--
-- 資料庫： `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- 資料表結構 `pma__bookmark`
--
-- 讀取資料表 phpmyadmin.pma__bookmark 的結構時出現錯誤： #1932 - Table &#039;phpmyadmin.pma__bookmark&#039; doesn&#039;t exist in engine
-- 讀取資料表 phpmyadmin.pma__bookmark 的資料時出現錯誤： #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `phpmyadmin`.`pma__bookmark`&#039; at line 1

-- --------------------------------------------------------

--
-- 資料表結構 `pma__central_columns`
--
-- 讀取資料表 phpmyadmin.pma__central_columns 的結構時出現錯誤： #1932 - Table &#039;phpmyadmin.pma__central_columns&#039; doesn&#039;t exist in engine
-- 讀取資料表 phpmyadmin.pma__central_columns 的資料時出現錯誤： #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `phpmyadmin`.`pma__central_columns`&#039; at line 1

-- --------------------------------------------------------

--
-- 資料表結構 `pma__column_info`
--
-- 讀取資料表 phpmyadmin.pma__column_info 的結構時出現錯誤： #1932 - Table &#039;phpmyadmin.pma__column_info&#039; doesn&#039;t exist in engine
-- 讀取資料表 phpmyadmin.pma__column_info 的資料時出現錯誤： #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `phpmyadmin`.`pma__column_info`&#039; at line 1

-- --------------------------------------------------------

--
-- 資料表結構 `pma__designer_settings`
--
-- 讀取資料表 phpmyadmin.pma__designer_settings 的結構時出現錯誤： #1932 - Table &#039;phpmyadmin.pma__designer_settings&#039; doesn&#039;t exist in engine
-- 讀取資料表 phpmyadmin.pma__designer_settings 的資料時出現錯誤： #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `phpmyadmin`.`pma__designer_settings`&#039; at line 1

-- --------------------------------------------------------

--
-- 資料表結構 `pma__export_templates`
--
-- 讀取資料表 phpmyadmin.pma__export_templates 的結構時出現錯誤： #1932 - Table &#039;phpmyadmin.pma__export_templates&#039; doesn&#039;t exist in engine
-- 讀取資料表 phpmyadmin.pma__export_templates 的資料時出現錯誤： #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `phpmyadmin`.`pma__export_templates`&#039; at line 1

-- --------------------------------------------------------

--
-- 資料表結構 `pma__favorite`
--
-- 讀取資料表 phpmyadmin.pma__favorite 的結構時出現錯誤： #1932 - Table &#039;phpmyadmin.pma__favorite&#039; doesn&#039;t exist in engine
-- 讀取資料表 phpmyadmin.pma__favorite 的資料時出現錯誤： #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `phpmyadmin`.`pma__favorite`&#039; at line 1

-- --------------------------------------------------------

--
-- 資料表結構 `pma__history`
--
-- 讀取資料表 phpmyadmin.pma__history 的結構時出現錯誤： #1932 - Table &#039;phpmyadmin.pma__history&#039; doesn&#039;t exist in engine
-- 讀取資料表 phpmyadmin.pma__history 的資料時出現錯誤： #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `phpmyadmin`.`pma__history`&#039; at line 1

-- --------------------------------------------------------

--
-- 資料表結構 `pma__navigationhiding`
--
-- 讀取資料表 phpmyadmin.pma__navigationhiding 的結構時出現錯誤： #1932 - Table &#039;phpmyadmin.pma__navigationhiding&#039; doesn&#039;t exist in engine
-- 讀取資料表 phpmyadmin.pma__navigationhiding 的資料時出現錯誤： #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `phpmyadmin`.`pma__navigationhiding`&#039; at line 1

-- --------------------------------------------------------

--
-- 資料表結構 `pma__pdf_pages`
--
-- 讀取資料表 phpmyadmin.pma__pdf_pages 的結構時出現錯誤： #1932 - Table &#039;phpmyadmin.pma__pdf_pages&#039; doesn&#039;t exist in engine
-- 讀取資料表 phpmyadmin.pma__pdf_pages 的資料時出現錯誤： #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `phpmyadmin`.`pma__pdf_pages`&#039; at line 1

-- --------------------------------------------------------

--
-- 資料表結構 `pma__recent`
--
-- 讀取資料表 phpmyadmin.pma__recent 的結構時出現錯誤： #1932 - Table &#039;phpmyadmin.pma__recent&#039; doesn&#039;t exist in engine
-- 讀取資料表 phpmyadmin.pma__recent 的資料時出現錯誤： #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `phpmyadmin`.`pma__recent`&#039; at line 1

-- --------------------------------------------------------

--
-- 資料表結構 `pma__relation`
--
-- 讀取資料表 phpmyadmin.pma__relation 的結構時出現錯誤： #1932 - Table &#039;phpmyadmin.pma__relation&#039; doesn&#039;t exist in engine
-- 讀取資料表 phpmyadmin.pma__relation 的資料時出現錯誤： #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `phpmyadmin`.`pma__relation`&#039; at line 1

-- --------------------------------------------------------

--
-- 資料表結構 `pma__savedsearches`
--
-- 讀取資料表 phpmyadmin.pma__savedsearches 的結構時出現錯誤： #1932 - Table &#039;phpmyadmin.pma__savedsearches&#039; doesn&#039;t exist in engine
-- 讀取資料表 phpmyadmin.pma__savedsearches 的資料時出現錯誤： #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `phpmyadmin`.`pma__savedsearches`&#039; at line 1

-- --------------------------------------------------------

--
-- 資料表結構 `pma__table_coords`
--
-- 讀取資料表 phpmyadmin.pma__table_coords 的結構時出現錯誤： #1932 - Table &#039;phpmyadmin.pma__table_coords&#039; doesn&#039;t exist in engine
-- 讀取資料表 phpmyadmin.pma__table_coords 的資料時出現錯誤： #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `phpmyadmin`.`pma__table_coords`&#039; at line 1

-- --------------------------------------------------------

--
-- 資料表結構 `pma__table_info`
--
-- 讀取資料表 phpmyadmin.pma__table_info 的結構時出現錯誤： #1932 - Table &#039;phpmyadmin.pma__table_info&#039; doesn&#039;t exist in engine
-- 讀取資料表 phpmyadmin.pma__table_info 的資料時出現錯誤： #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `phpmyadmin`.`pma__table_info`&#039; at line 1

-- --------------------------------------------------------

--
-- 資料表結構 `pma__table_uiprefs`
--
-- 讀取資料表 phpmyadmin.pma__table_uiprefs 的結構時出現錯誤： #1932 - Table &#039;phpmyadmin.pma__table_uiprefs&#039; doesn&#039;t exist in engine
-- 讀取資料表 phpmyadmin.pma__table_uiprefs 的資料時出現錯誤： #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `phpmyadmin`.`pma__table_uiprefs`&#039; at line 1

-- --------------------------------------------------------

--
-- 資料表結構 `pma__tracking`
--
-- 讀取資料表 phpmyadmin.pma__tracking 的結構時出現錯誤： #1932 - Table &#039;phpmyadmin.pma__tracking&#039; doesn&#039;t exist in engine
-- 讀取資料表 phpmyadmin.pma__tracking 的資料時出現錯誤： #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `phpmyadmin`.`pma__tracking`&#039; at line 1

-- --------------------------------------------------------

--
-- 資料表結構 `pma__userconfig`
--
-- 讀取資料表 phpmyadmin.pma__userconfig 的結構時出現錯誤： #1932 - Table &#039;phpmyadmin.pma__userconfig&#039; doesn&#039;t exist in engine
-- 讀取資料表 phpmyadmin.pma__userconfig 的資料時出現錯誤： #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `phpmyadmin`.`pma__userconfig`&#039; at line 1

-- --------------------------------------------------------

--
-- 資料表結構 `pma__usergroups`
--
-- 讀取資料表 phpmyadmin.pma__usergroups 的結構時出現錯誤： #1932 - Table &#039;phpmyadmin.pma__usergroups&#039; doesn&#039;t exist in engine
-- 讀取資料表 phpmyadmin.pma__usergroups 的資料時出現錯誤： #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `phpmyadmin`.`pma__usergroups`&#039; at line 1

-- --------------------------------------------------------

--
-- 資料表結構 `pma__users`
--
-- 讀取資料表 phpmyadmin.pma__users 的結構時出現錯誤： #1932 - Table &#039;phpmyadmin.pma__users&#039; doesn&#039;t exist in engine
-- 讀取資料表 phpmyadmin.pma__users 的資料時出現錯誤： #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `phpmyadmin`.`pma__users`&#039; at line 1
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
