-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- 主机: localhost:3306
-- 生成日期: 2018 年 08 月 08 日 22:38
-- 服务器版本: 5.1.59
-- PHP 版本: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `gwc`
--

-- --------------------------------------------------------

--
-- 表的结构 `about`
--

DROP TABLE IF EXISTS `about`;
CREATE TABLE IF NOT EXISTS `about` (
  `ITEM` int(10) NOT NULL AUTO_INCREMENT,
  `CATE_INDEX` int(10) NOT NULL,
  `SET_TIME` date NOT NULL,
  `MODEFY_TIME` datetime NOT NULL,
  `DOC_PATH` text NOT NULL,
  `DELETE_ID` int(1) NOT NULL,
  `MEMBER_NUM` int(10) NOT NULL,
  `SORT` int(10) NOT NULL,
  `DOC_LEVEL` int(10) NOT NULL,
  `TOPIC` varchar(200) NOT NULL COMMENT '標題',
  `CONTENT` text NOT NULL COMMENT '內容',
  PRIMARY KEY (`ITEM`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='內容管理' AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `about`
--

INSERT INTO `about` (`ITEM`, `CATE_INDEX`, `SET_TIME`, `MODEFY_TIME`, `DOC_PATH`, `DELETE_ID`, `MEMBER_NUM`, `SORT`, `DOC_LEVEL`, `TOPIC`, `CONTENT`) VALUES
(1, 0, '2018-06-10', '2018-06-29 14:55:12', '0<br>', 0, 1, 1, 1, '介紹', '<p style="text-align: center;"><span style="font-size: 38px;"><span style="color: rgb(51, 153, 102);"><strong>創新綠金引爆點</strong></span></span></p>\r\n<p style="text-align: center;"><span style="font-size: 52px;"><span style="color: rgb(255, 0, 0);"><u><strong><span style="font-family: 微軟正黑體, &quot;Microsoft JhengHei&quot;;">WGC風利幣</span></strong></u></span></span></p>\r\n<p style="text-align: center;">&nbsp;</p>\r\n<p><span style="font-size: 20px;"> </span></p>\r\n<p style="text-align: center;">&nbsp;</p>\r\n<p><span style="font-size: 28px;"> </span></p>\r\n<p style="text-align: center;"><span style="font-size: 28px;"><span style="color: rgb(51, 153, 102);"><strong><span style="font-family: 微軟正黑體, &quot;Microsoft JhengHei&quot;;">地表最強虛實整合綠金ICO</span></strong></span></span></p>\r\n<p style="text-align: center;">&nbsp;<span style="color: rgb(0, 0, 255);"><span style="font-size: 28px;"><strong><span style="font-family: 微軟正黑體, &quot;Microsoft JhengHei&quot;;">全面打造6000區小型風力發電場為挖金返利基底</span></strong></span></span></p>\r\n<p style="text-align: center;"><span style="color: rgb(51, 153, 102);"><span style="font-size: 36px;"><strong><span style="font-family: 微軟正黑體, &quot;Microsoft JhengHei&quot;;"><img src="/upload/fckimages/images/%E7%B6%A0%E9%87%911.jpg" width="795" height="524" alt="" /></span></strong></span></span></p>\r\n<p style="text-align: center;"><span style="color: rgb(51, 153, 102);"><span style="font-size: 36px;"><strong><span style="font-family: 微軟正黑體, &quot;Microsoft JhengHei&quot;;"><img src="/upload/fckimages/images/ico%E5%8B%9F%E8%B3%87%E5%9C%96.png" width="1133" height="935" alt="" /></span></strong></span></span></p>\r\n<p style="text-align: center;">&nbsp;</p>\r\n<p><span style="font-size: 28px;"> </span></p>\r\n<p style="text-align: center;">&nbsp;</p>\r\n<p><span style="font-size: 28px;"> </span></p>\r\n<p style="text-align: center;"><span style="color: rgb(255, 0, 0);"><span style="font-size: 28px;"><strong><span style="font-family: 微軟正黑體, &quot;Microsoft JhengHei&quot;;">代幣總量: 2160,000,000 WGC(等於21.6億美金)</span></strong></span></span><span style="font-size: 28px;"><span style="color: rgb(51, 153, 102);"><strong><span style="font-family: 微軟正黑體, &quot;Microsoft JhengHei&quot;;">&nbsp;<br />\r\n可購買總量: 648,000,000 WGC (30% 公募階段)<br />\r\n接受投資幣種: ETH <span style="font-size: 20px;">(以太幣)</span><br />\r\n價格(未計優惠): 0.0025 ETH (約1美金)<br />\r\n投資計價單位: 1 ETH <br />\r\n白名單註冊: 不需要 <br />\r\n</span><span style="color: rgb(0, 0, 255);"><span style="font-family: 微軟正黑體, &quot;Microsoft JhengHei&quot;;">KYC (實名認證): 需要，在 ICO 結束後</span></span></strong></span></span></p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p style="text-align: center;"><span style="font-size: 28px;">&nbsp;</span></p>\r\n<p style="text-align: center;"><span style="font-size: 28px;"> </span><span style="font-size: 28px;">&nbsp;</span><span style="color: rgb(51, 153, 102);"><strong><span style="font-size: 28px;"><span style="font-family: 微軟正黑體, &quot;Microsoft JhengHei&quot;;">首輪 ICO<span style="font-size: 20px;">(至少100萬枚WGC)</span><br />\r\n從: 2018 6月 29日 <br />\r\n至: 2018 7月 31日<br />\r\n20% 優惠</span></span></strong></span></p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p style="text-align: center;"><span style="font-size: 28px;">&nbsp;</span></p>\r\n<p style="text-align: center;"><span style="font-size: 28px;"> </span><span style="font-size: 28px;">&nbsp;</span><span style="color: rgb(51, 153, 102);"><strong><span style="font-size: 28px;"><span style="font-family: 微軟正黑體, &quot;Microsoft JhengHei&quot;;">A輪 ICO<span style="font-size: 20px;">(至少1萬枚WGC)</span><br />\r\n從: 2018 8月 1日 <br />\r\n至: 2018 9月 30日<br />\r\n10% 優惠</span></span></strong></span></p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p style="text-align: center;"><span style="font-size: 28px;">&nbsp;</span></p>\r\n<p><span style="font-size: 28px;"> </span></p>\r\n<p style="text-align: center;">&nbsp;<span style="font-size: 28px;"> </span><span style="color: rgb(51, 153, 102);"><strong><span style="font-size: 28px;"><span style="font-family: 微軟正黑體, &quot;Microsoft JhengHei&quot;;">B輪 ICO<span style="font-size: 20px;">(至少400枚WGC)</span><br />\r\n從: 2018 10月 1日 <br />\r\n至: 2018 12月 31日</span></span></strong></span></p>\r\n<p style="text-align: center;"><span style="color: rgb(51, 153, 102);"><strong><span style="font-family: 微軟正黑體, &quot;Microsoft JhengHei&quot;;"><span style="font-size: 28px;">5% 優惠</span></span></strong></span></p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p style="text-align: center;"><span style="font-size: 28px;">&nbsp;</span></p>\r\n<p style="text-align: center;"><span style="font-size: 28px;">&nbsp;</span><span style="font-size: 28px;"> </span><span style="font-size: 28px;">&nbsp;</span><span style="font-size: 28px;"><span style="color: rgb(255, 0, 0);"><strong><span style="font-family: 微軟正黑體, &quot;Microsoft JhengHei&quot;;">每年綠能以ETH返利以公募WGC(1美金為基底)10%</span></strong></span></span></p>\r\n<p style="text-align: center;"><span style="font-size: 28px;">&nbsp;</span><span style="font-size: 28px;">&nbsp;</span><span style="color: rgb(255, 0, 0);"><span style="font-size: 28px;"><strong><span style="font-family: 微軟正黑體, &quot;Microsoft JhengHei&quot;;">(20年共200%)</span></strong></span></span><span style="font-size: 28px;"><span style="color: rgb(255, 0, 0);"><strong><span style="font-family: 微軟正黑體, &quot;Microsoft JhengHei&quot;;"><br />\r\n</span><span style="color: rgb(0, 0, 255);"><span style="font-family: 微軟正黑體, &quot;Microsoft JhengHei&quot;;">從: 2019 1月 1日 (2.5%),&nbsp;4月 1日(2.5%),7月1日(2.5%),10月1日(2.5%)=&gt;每年每季以ETH返利以此類推</span></span></strong></span></span></p>\r\n<p>&nbsp;</p>'),
(2, 0, '2018-06-10', '2018-06-29 18:32:23', '0<br>', 0, 1, 2, 1, '白皮書', '<p style="text-align: center;"><a href="/upload/fckimages/files/WGC(Wind%20Gain%20Coin)%E9%A2%A8%E5%88%A9%E5%B9%A3%20%E7%99%BD%E7%9A%AE%E6%9B%B8.pdf" target="_blank"><img src="/upload/fckimages/images/whitepaper.jpg" width="900" height="1200" alt="" /></a></p>\r\n<p style="text-align: center;">&nbsp;</p>\r\n<p style="text-align: center;">&nbsp;</p>\r\n<p style="text-align: center;">&nbsp;</p>'),
(3, 0, '2018-06-10', '2018-07-08 16:08:01', '0<br>', 0, 1, 3, 1, '發展藍圖', '<p style="text-align: center;"><span style="color: rgb(0, 0, 255);"><u><span style="font-size: 40px;"><strong><span style="font-family: 微軟正黑體, &quot;Microsoft JhengHei&quot;;">ICO	Token	Business</span></strong></span></u></span></p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp;<span style="font-size: 24px;"><span style="font-family: 微軟正黑體, &quot;Microsoft JhengHei&quot;;"> 時代的潮流「虛擬貨幣」市場，ICO眾籌計畫，為整個企業商業模式帶來巨大變化，去中央化、技術加密性提升的特性，能跨越地域限制，使任何商業計畫皆能走進國際 市場。WGC  ICO將成為亞洲首創小型風力發電綠能產業完美結合虛擬貨幣技術 破百億的商業計劃，正式誕生!</span></span></p>\r\n<p style="text-align: center;"><img src="/upload/fckimages/images/plan1(1).jpg" width="918" height="870" alt="" /></p>\r\n<p style="text-align: center;">&nbsp;</p>\r\n<p style="text-align: center;">&nbsp;</p>\r\n<p style="text-align: center;"><span style="font-size: 40px;"><span style="color: rgb(0, 0, 255);"><u><strong><font face="微軟正黑體, Microsoft JhengHei">藍圖階段項目運作</font></strong></u></span></span></p>\r\n<p style="text-align: center;"><span style="font-size: 40px;"><span style="color: rgb(0, 0, 255);"><u><strong><font face="微軟正黑體, Microsoft JhengHei"><img src="/upload/fckimages/images/plan2.jpg" width="1075" height="381" alt="" /></font></strong></u></span></span></p>\r\n<p style="text-align: center;">&nbsp;</p>\r\n<p style="text-align: center;">&nbsp;<img src="/upload/fckimages/images/plan3(1).jpg" width="1600" height="679" alt="" /></p>\r\n<p style="text-align: center;">&nbsp;</p>\r\n<p style="text-align: center;">&nbsp;</p>\r\n<p style="text-align: center;">&nbsp;</p>\r\n<p style="text-align: center;"><span style="color: rgb(0, 0, 255);"><u><strong><span style="font-size: 40px;"><span style="font-family: 微軟正黑體, &quot;Microsoft JhengHei&quot;;">發展藍圖架構</span></span></strong></u></span></p>\r\n<p style="text-align: center;">&nbsp;</p>\r\n<p style="text-align: center;"><img src="/upload/fckimages/images/plan4(1).jpg" width="1017" height="598" alt="" /></p>\r\n<p style="text-align: center;">&nbsp;</p>\r\n<p style="text-align: center;">&nbsp;</p>\r\n<p style="text-align: center;"><span style="color: rgb(0, 0, 255);"><u><strong><span style="font-size: 40px;"><span style="font-family: 微軟正黑體, &quot;Microsoft JhengHei&quot;;">公募時間軸</span></span></strong></u></span></p>\r\n<p style="text-align: center;">&nbsp;</p>\r\n<p style="text-align: center;"><img src="/upload/fckimages/images/plan5(1).jpg" width="998" height="837" alt="" /></p>'),
(4, 0, '2018-06-10', '2018-06-29 15:18:19', '0<br>', 0, 1, 4, 1, '營運團隊', '<p>&nbsp;<img src="/upload/fckimages/images/Img0427.jpg" width="300" height="283" alt="" /></p>\r\n<p><span style="color: rgb(0, 0, 255);"><strong>&lt;WGC執行長&gt;李奎典 Cankey</strong></span></p>\r\n<p>1. RICH STAR GROUP CO.,LTD.集團 CEO.</p>\r\n<p>2.兆邦國際企業股份有限公司 總經理.</p>\r\n<p><img src="/upload/fckimages/images/%E9%BB%83%E4%BF%8A%E9%81%94.jpg" width="300" height="259" alt="" /></p>\r\n<p><span style="color: rgb(0, 0, 255);"><strong>&lt;WGC技術長&gt; </strong></span><strong style="color: rgb(0, 0, 255);">Nick&nbsp;</strong></p>\r\n<p>&nbsp;1.達威國際數位行銷 執行長</p>\r\n<p>&nbsp;2.台南入口網 營運長</p>\r\n<p>&nbsp;3.嘉南藥理科技大學 業界講師</p>\r\n<p>&nbsp;</p>\r\n<p><img src="/upload/fckimages/images/%E8%8E%8A%E6%98%93%E7%A5%90.jpg" width="300" height="399" alt="" /></p>\r\n<p><span style="color: rgb(0, 0, 255);"><strong>&lt;WGC營運總監&gt; 莊易祐 Yiyu</strong></span></p>\r\n<p>1.見龍機構營銷經理.<br />\r\n2.瑞麟貿易營運經理.<br />\r\n3.精頭腦傳播文化營運經理.<br />\r\n4.富比世國際能源營銷經理.<br />\r\n5.寰球國際綠能業務經理.<br />\r\n<img src="/upload/fckimages/images/S_8099187805977.jpg" width="300" height="401" alt="" /></p>\r\n<p><span style="color: rgb(0, 0, 255);"><strong>&lt;WGC行銷總監&gt; Jeffery&nbsp;&nbsp;</strong></span></p>\r\n<p>1.IPO募資20年經驗，輔導過多家上市櫃公司.<br />\r\n2.曾任多家投顧及資產管理總經理.<br />\r\n3.北京甄怡餐飲集團 執行董事.<span style="color: rgb(0, 0, 255);"><strong><br />\r\n</strong></span></p>\r\n<p><img src="/upload/fckimages/images/%E9%BB%83%E5%8B%9D%E6%9A%89.jpg" width="300" height="296" alt="" /></p>\r\n<p><span style="color: rgb(0, 0, 255);"><strong>&lt;WGC行政總監&gt; Samson&nbsp;</strong></span></p>\r\n<p>1.貝里斯商精聯有限公司-創辦人</p>\r\n<p>2.瑪郁思生技股份有限公司-副執行長</p>\r\n<p>3.豐耀國際創意行銷有限公司-首席戰略官</p>'),
(5, 0, '2018-06-10', '2018-06-29 14:58:40', '0<br>', 0, 1, 5, 1, '最新消息', '<p><span style="color: rgb(255, 0, 0);"><strong><span style="font-size: 24px;"><span style="font-family: 微軟正黑體, &quot;Microsoft JhengHei&quot;;">(1)由RICH STAR GROUP公司開始公募階段已於2018年6月29日啟動首輪募資,誠摯邀請各界企業及人士踴躍參與,共襄盛舉!</span></span></strong></span></p>\r\n<p>&nbsp;</p>\r\n<p><span style="font-size: 24px;"><span style="font-family: 微軟正黑體, &quot;Microsoft JhengHei&quot;;">(2)相關小風電廠工程進度請查[<u><strong><span style="color: rgb(0, 0, 255);"><a href="http://www.zb-green.com" target="_blank">兆邦國際企業(股)公司</a></span></strong></u>]網站:</span></span></p>\r\n<p><span style="color: rgb(0, 0, 255);"><strong><span style="font-size: 24px;"><span style="font-family: 微軟正黑體, &quot;Microsoft JhengHei&quot;;"><a href="http://www.zb-green.com" target="_blank">http://www.zb-green.com/</a>&nbsp;</span></span></strong></span></p>\r\n<p>&nbsp;</p>\r\n<p><span style="font-size: 24px;"><span style="font-family: 微軟正黑體, &quot;Microsoft JhengHei&quot;;"><a href="http://www.zb-green.com" target="_blank"><img src="/upload/fckimages/images/all-view.jpg" width="1600" height="900" alt="" /></a></span></span></p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>');

-- --------------------------------------------------------

--
-- 表的结构 `banner`
--

DROP TABLE IF EXISTS `banner`;
CREATE TABLE IF NOT EXISTS `banner` (
  `ITEM` int(10) NOT NULL AUTO_INCREMENT,
  `CATE_INDEX` int(10) NOT NULL,
  `SET_TIME` date NOT NULL,
  `MODEFY_TIME` datetime NOT NULL,
  `DOC_PATH` text NOT NULL,
  `DELETE_ID` int(1) NOT NULL,
  `MEMBER_NUM` int(10) NOT NULL,
  `SORT` int(10) NOT NULL,
  `DOC_LEVEL` int(10) NOT NULL,
  `TOPIC` varchar(200) NOT NULL COMMENT '圖片標題',
  `IMAGE` varchar(100) NOT NULL COMMENT '圖片',
  PRIMARY KEY (`ITEM`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='網站主視覺' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `banner`
--

INSERT INTO `banner` (`ITEM`, `CATE_INDEX`, `SET_TIME`, `MODEFY_TIME`, `DOC_PATH`, `DELETE_ID`, `MEMBER_NUM`, `SORT`, `DOC_LEVEL`, `TOPIC`, `IMAGE`) VALUES
(1, 0, '2018-06-09', '2018-06-16 22:52:08', '0<br>', 0, 1, 1, 1, '風利幣', '1529160727_9661.jpg');

-- --------------------------------------------------------

--
-- 表的结构 `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `ITEM` int(10) NOT NULL AUTO_INCREMENT,
  `CATE_INDEX` int(10) NOT NULL,
  `SET_TIME` date NOT NULL,
  `MODEFY_TIME` datetime NOT NULL,
  `DOC_PATH` text NOT NULL,
  `DELETE_ID` int(1) NOT NULL,
  `MEMBER_NUM` int(10) NOT NULL,
  `SORT` int(10) NOT NULL,
  `DOC_LEVEL` int(10) NOT NULL,
  `NAME` varchar(200) NOT NULL COMMENT '姓名',
  `TEL` varchar(200) NOT NULL COMMENT '聯絡電話',
  `EMAIL` varchar(200) NOT NULL COMMENT 'Email',
  `CONTENT` text NOT NULL COMMENT '留言內容',
  `ONREAD` int(10) DEFAULT '1' COMMENT '是否閱讀',
  PRIMARY KEY (`ITEM`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='聯絡我們' AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- 表的结构 `member`
--

DROP TABLE IF EXISTS `member`;
CREATE TABLE IF NOT EXISTS `member` (
  `ITEM` int(10) NOT NULL AUTO_INCREMENT,
  `CATE_INDEX` int(10) NOT NULL,
  `SET_TIME` date NOT NULL,
  `MODEFY_TIME` datetime NOT NULL,
  `DOC_PATH` text NOT NULL,
  `DELETE_ID` int(1) NOT NULL,
  `MEMBER_NUM` int(10) NOT NULL,
  `SORT` int(10) NOT NULL,
  `DOC_LEVEL` int(10) NOT NULL,
  `NAME` varchar(200) NOT NULL COMMENT '姓名',
  `EMAIL` varchar(200) NOT NULL COMMENT 'Email',
  `PASSWORD` varchar(200) NOT NULL COMMENT '密碼',
  `TEL` varchar(200) NOT NULL COMMENT '電話',
  `ADDRESS` varchar(200) NOT NULL COMMENT '地址',
  `ETH_ADDRESS` varchar(200) NOT NULL COMMENT '以太錢包地址',
  `IP` varchar(200) NOT NULL COMMENT 'IP位址',
  `WGGT` int(10) NOT NULL COMMENT '現有風力幣',
  `STATUS` int(10) DEFAULT '1' COMMENT '會員狀態',
  `MEMBER_LEVEL` int(10) DEFAULT '1' COMMENT '會員等級',
  PRIMARY KEY (`ITEM`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='會員管理' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `member`
--

INSERT INTO `member` (`ITEM`, `CATE_INDEX`, `SET_TIME`, `MODEFY_TIME`, `DOC_PATH`, `DELETE_ID`, `MEMBER_NUM`, `SORT`, `DOC_LEVEL`, `NAME`, `EMAIL`, `PASSWORD`, `TEL`, `ADDRESS`, `ETH_ADDRESS`, `IP`, `WGGT`, `STATUS`, `MEMBER_LEVEL`) VALUES
(1, 0, '2018-08-06', '2018-08-06 22:26:54', '0<br>', 0, 1, 1, 1, '黃昌武', 'awu0307@gmail.com', 'abc123', '', '', '', '111.254.42.213', 0, 1, 1),
(2, 0, '2018-08-06', '2018-08-06 23:03:25', '0<br>', 0, 1, 2, 1, '林小ｐ', 'sp@dweb.com.tw', 'MPis940238', '', '', '', '122.117.173.80', 0, 1, 1),
(3, 0, '2018-08-08', '2018-08-08 00:45:22', '0<br>', 0, 1, 3, 1, '郭育青', 'kuc517@gmail.com', 'cc5255', '', '', '', '114.136.235.214', 0, 1, 1),
(4, 0, '2018-08-08', '2018-08-08 16:54:00', '0<br>', 0, 1, 4, 1, '王晨光', 'a0905955535@gmail.com', 'adda5488', '', '', '', '27.246.103.66', 0, 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `member_level`
--

DROP TABLE IF EXISTS `member_level`;
CREATE TABLE IF NOT EXISTS `member_level` (
  `ITEM` int(10) NOT NULL AUTO_INCREMENT,
  `CATE_INDEX` int(10) NOT NULL,
  `SET_TIME` date NOT NULL,
  `MODEFY_TIME` datetime NOT NULL,
  `DOC_PATH` text NOT NULL,
  `DELETE_ID` int(1) NOT NULL,
  `MEMBER_NUM` int(10) NOT NULL,
  `SORT` int(10) NOT NULL,
  `DOC_LEVEL` int(10) NOT NULL,
  `TOPIC` varchar(200) NOT NULL COMMENT '名稱',
  PRIMARY KEY (`ITEM`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='會員權限' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `order_topic`
--

DROP TABLE IF EXISTS `order_topic`;
CREATE TABLE IF NOT EXISTS `order_topic` (
  `ITEM` int(10) NOT NULL AUTO_INCREMENT,
  `CATE_INDEX` int(10) NOT NULL,
  `SET_TIME` date NOT NULL,
  `MODEFY_TIME` datetime NOT NULL,
  `DOC_PATH` text NOT NULL,
  `DELETE_ID` int(1) NOT NULL,
  `MEMBER_NUM` int(10) NOT NULL,
  `SORT` int(10) NOT NULL,
  `DOC_LEVEL` int(10) NOT NULL,
  `ETH_ADDRESS` varchar(200) NOT NULL COMMENT '以太錢包地址',
  `ETH` decimal(60,10) NOT NULL COMMENT '以太幣數量',
  `WGC` decimal(60,10) NOT NULL COMMENT '風電幣數量',
  `SESSION_ID` int(10) NOT NULL COMMENT '購買會員',
  `ORDER_NUMBER` varchar(200) NOT NULL,
  `NAME` varchar(200) NOT NULL,
  `EMAIL` varchar(200) NOT NULL,
  `STATUS` int(10) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ITEM`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='購買紀錄' AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `order_topic`
--

INSERT INTO `order_topic` (`ITEM`, `CATE_INDEX`, `SET_TIME`, `MODEFY_TIME`, `DOC_PATH`, `DELETE_ID`, `MEMBER_NUM`, `SORT`, `DOC_LEVEL`, `ETH_ADDRESS`, `ETH`, `WGC`, `SESSION_ID`, `ORDER_NUMBER`, `NAME`, `EMAIL`, `STATUS`) VALUES
(2, 0, '2018-06-24', '2018-06-24 23:12:25', '0<br>', 0, 0, 0, 1, '0x3D703C4d05719338C58d439948E50576F46d1386', 500.0000000000, 250000.0000000000, 11, '20180624231225341', '黃俊達', 'chunta.tn@gmail.com', 2),
(3, 0, '2018-07-09', '2018-07-09 17:38:24', '0<br>', 0, 0, 0, 1, '', 0.0000000000, 0.0000000000, 17, '20180709173824917', '謝小敏', '635450389@qq.com', 2);

-- --------------------------------------------------------

--
-- 表的结构 `sys_control`
--

DROP TABLE IF EXISTS `sys_control`;
CREATE TABLE IF NOT EXISTS `sys_control` (
  `ITEM` int(10) NOT NULL AUTO_INCREMENT,
  `CATE_INDEX` int(10) NOT NULL,
  `SET_TIME` date NOT NULL,
  `MODEFY_TIME` datetime NOT NULL,
  `DOC_PATH` text NOT NULL,
  `DELETE_ID` int(1) NOT NULL,
  `MEMBER_NUM` int(10) NOT NULL,
  `SORT` int(10) NOT NULL,
  `DOC_LEVEL` int(10) NOT NULL,
  `LOGIN_IP` text NOT NULL,
  `LOGIN_TIME` text NOT NULL,
  `ACCOUNT` varchar(200) NOT NULL COMMENT '帳號',
  `PASSWORD` varchar(200) NOT NULL COMMENT '密碼',
  `SELECT_GROUP` int(10) DEFAULT '1' COMMENT '群組選擇',
  PRIMARY KEY (`ITEM`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='後台帳號管理' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `sys_control`
--

INSERT INTO `sys_control` (`ITEM`, `CATE_INDEX`, `SET_TIME`, `MODEFY_TIME`, `DOC_PATH`, `DELETE_ID`, `MEMBER_NUM`, `SORT`, `DOC_LEVEL`, `LOGIN_IP`, `LOGIN_TIME`, `ACCOUNT`, `PASSWORD`, `SELECT_GROUP`) VALUES
(1, 0, '2018-08-06', '2018-08-06 21:28:12', '0<br>', 0, 1, 1, 1, '101.8.163.53', '2018-08-07 23:59:46', 'root', 'root', 1);

-- --------------------------------------------------------

--
-- 表的结构 `sys_group`
--

DROP TABLE IF EXISTS `sys_group`;
CREATE TABLE IF NOT EXISTS `sys_group` (
  `ITEM` int(10) NOT NULL AUTO_INCREMENT,
  `CATE_INDEX` int(10) NOT NULL,
  `SET_TIME` date NOT NULL,
  `MODEFY_TIME` datetime NOT NULL,
  `DOC_PATH` text NOT NULL,
  `DELETE_ID` int(1) NOT NULL,
  `MEMBER_NUM` int(10) NOT NULL,
  `SORT` int(10) NOT NULL,
  `DOC_LEVEL` int(10) NOT NULL,
  `TOPIC` varchar(200) NOT NULL COMMENT '群組名稱',
  `GROUP_CONTROL` text NOT NULL COMMENT '群組權限',
  PRIMARY KEY (`ITEM`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='權限群組管理' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `sys_group`
--

INSERT INTO `sys_group` (`ITEM`, `CATE_INDEX`, `SET_TIME`, `MODEFY_TIME`, `DOC_PATH`, `DELETE_ID`, `MEMBER_NUM`, `SORT`, `DOC_LEVEL`, `TOPIC`, `GROUP_CONTROL`) VALUES
(1, 0, '2018-08-06', '2018-08-06 21:31:13', '0<br>', 0, 1, 1, 1, '系統管理員', '1.1,2.1,3.1,4.1,5.1');

-- --------------------------------------------------------

--
-- 表的结构 `uploadfile`
--

DROP TABLE IF EXISTS `uploadfile`;
CREATE TABLE IF NOT EXISTS `uploadfile` (
  `ITEM` int(10) NOT NULL AUTO_INCREMENT,
  `FILENAME` varchar(100) NOT NULL,
  `TOPIC` varchar(200) NOT NULL,
  `SORT` int(10) DEFAULT NULL,
  `MEMBER_NUM` int(10) DEFAULT NULL,
  PRIMARY KEY (`ITEM`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `web_config`
--

DROP TABLE IF EXISTS `web_config`;
CREATE TABLE IF NOT EXISTS `web_config` (
  `ITEM` int(10) NOT NULL AUTO_INCREMENT,
  `CATE_INDEX` int(10) NOT NULL,
  `SET_TIME` date NOT NULL,
  `MODEFY_TIME` datetime NOT NULL,
  `DOC_PATH` text NOT NULL,
  `DELETE_ID` int(1) NOT NULL,
  `MEMBER_NUM` int(10) NOT NULL,
  `SORT` int(10) NOT NULL,
  `DOC_LEVEL` int(10) NOT NULL,
  `TOPIC` varchar(200) NOT NULL COMMENT '網站名稱',
  `WALLET` varchar(200) NOT NULL COMMENT '收款錢包地址',
  `TOTAL_MONEY` int(20) NOT NULL DEFAULT '0' COMMENT '預計募資總額',
  `END_DATE` date NOT NULL COMMENT '預計募資結束日期',
  `NOW_MONEY` int(20) NOT NULL DEFAULT '0' COMMENT '以太幣總量',
  `WGC` float NOT NULL DEFAULT '0' COMMENT '風電幣',
  PRIMARY KEY (`ITEM`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='網站基礎設定' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `web_config`
--

INSERT INTO `web_config` (`ITEM`, `CATE_INDEX`, `SET_TIME`, `MODEFY_TIME`, `DOC_PATH`, `DELETE_ID`, `MEMBER_NUM`, `SORT`, `DOC_LEVEL`, `TOPIC`, `WALLET`, `TOTAL_MONEY`, `END_DATE`, `NOW_MONEY`, `WGC`) VALUES
(1, 0, '2018-06-09', '2018-06-29 18:52:30', '0<br>', 0, 1, 1, 1, 'WGC', '0x751c8f23812144324de1d5e4bc7232d7fff0e2c7', 2147483647, '2018-07-31', 0, 400);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
