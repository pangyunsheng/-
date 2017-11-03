/*
Navicat MySQL Data Transfer

Source Server         : wamp集成包
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : dfz

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2017-11-02 21:26:05
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for dfz_admin
-- ----------------------------
DROP TABLE IF EXISTS `dfz_admin`;
CREATE TABLE `dfz_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(32) NOT NULL DEFAULT '123456' COMMENT '管理员密码默认123456',
  `realname` varchar(11) NOT NULL COMMENT '真实姓名',
  `email` char(30) NOT NULL,
  `role_id` enum('1','0') NOT NULL DEFAULT '0' COMMENT '0是商家管理员，1是平台管理员',
  `phone` varchar(13) NOT NULL,
  `shop_id` int(11) NOT NULL COMMENT '管理员对应的店铺id',
  `delete_time` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dfz_admin
-- ----------------------------
INSERT INTO `dfz_admin` VALUES ('18', 'w809794', 'admin', '', '1', '15767976872', '5', null, null, null);
INSERT INTO `dfz_admin` VALUES ('20', '123456', 'g ', '', '0', '13432312312', '7', null, null, null);
INSERT INTO `dfz_admin` VALUES ('21', '123456', 'e ', '', '0', '18909809889', '1', null, null, null);
INSERT INTO `dfz_admin` VALUES ('22', '123456', 'f ', '', '0', '18088456456', '6', null, null, null);
INSERT INTO `dfz_admin` VALUES ('16', '123456', 'c ', '', '0', '18877877773', '3', null, null, null);
INSERT INTO `dfz_admin` VALUES ('17', '123456', 'd ', '', '0', '18908908900', '4', null, null, null);
INSERT INTO `dfz_admin` VALUES ('14', '123456', 'a123', '', '0', '15678978977', '0', null, null, null);
INSERT INTO `dfz_admin` VALUES ('15', 'w809794', 'b 123', '', '0', '15767976871', '2', null, null, null);
INSERT INTO `dfz_admin` VALUES ('19', '123456', 'f ', '', '0', '18088456456', '6', null, null, null);

-- ----------------------------
-- Table structure for dfz_collect
-- ----------------------------
DROP TABLE IF EXISTS `dfz_collect`;
CREATE TABLE `dfz_collect` (
  `coll_id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_name` varchar(50) NOT NULL COMMENT '店铺名字',
  `shop_id` int(11) NOT NULL COMMENT '店铺ID',
  `username` varchar(20) NOT NULL COMMENT '收藏该店铺的用户',
  `create_time` varchar(30) NOT NULL COMMENT '收藏时间',
  `update_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`coll_id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dfz_collect
-- ----------------------------
INSERT INTO `dfz_collect` VALUES ('2', 'Super薯排', '2', '15767976871', '', '0', '0');
INSERT INTO `dfz_collect` VALUES ('29', '', '1', '15767976872', '', '0', '0');

-- ----------------------------
-- Table structure for dfz_comment
-- ----------------------------
DROP TABLE IF EXISTS `dfz_comment`;
CREATE TABLE `dfz_comment` (
  `pj_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '评价id',
  `content` varchar(255) DEFAULT NULL COMMENT '评论内容',
  `order_id` int(11) NOT NULL COMMENT '对应的订单号',
  `xing_count` varchar(2) NOT NULL COMMENT '几星评价',
  `pj_time` varchar(30) NOT NULL COMMENT '评价时间',
  `username` varchar(255) NOT NULL COMMENT '下单用户，即注册的手机号',
  `shop_id` int(11) DEFAULT NULL COMMENT '店铺id',
  `delete_time` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`pj_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dfz_comment
-- ----------------------------
INSERT INTO `dfz_comment` VALUES ('4', '出菜的方式好刁钻啊                                 \n                                    ', '26', '3', '2017/10/30  23:18:28', '15767976872', '2', '0', '0', '0');
INSERT INTO `dfz_comment` VALUES ('5', '艾玉鸥撒的发生', '25', '1', '2017/10/30  23:20:25', '15767976872', '2', '0', '0', '0');
INSERT INTO `dfz_comment` VALUES ('6', 'ABCD四十', '27', '4', '2017/10/30  23:21:03', '15767976871', '2', '0', '0', '0');

-- ----------------------------
-- Table structure for dfz_dishes
-- ----------------------------
DROP TABLE IF EXISTS `dfz_dishes`;
CREATE TABLE `dfz_dishes` (
  `mid` int(11) NOT NULL AUTO_INCREMENT COMMENT '一道菜的id',
  `cid` int(11) NOT NULL COMMENT '这道菜所属的父类； 通过cid也能找到店铺shopID',
  `meal_name` varchar(100) NOT NULL COMMENT '菜名',
  `meal_price` int(10) NOT NULL DEFAULT '0' COMMENT '菜的价格',
  `meal_sell_num` int(100) NOT NULL DEFAULT '0' COMMENT '月售多少份',
  `meal_pic` varchar(255) NOT NULL COMMENT '菜品图片',
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`mid`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dfz_dishes
-- ----------------------------
INSERT INTO `dfz_dishes` VALUES ('1', '3', '\r\n爆辣火鸡面', '12', '0', '/static/img/1.gif', null, null, null);
INSERT INTO `dfz_dishes` VALUES ('2', '1', '\r\n南山咖啡', '7', '0', '/static/img/2.gif', null, null, null);
INSERT INTO `dfz_dishes` VALUES ('3', '1', '三串骨肉相连', '7', '0', '/static/img/3.gif', null, null, null);
INSERT INTO `dfz_dishes` VALUES ('4', '3', '绝对薯格（微辣）', '10', '0', '/static/img/4.gif', null, null, null);
INSERT INTO `dfz_dishes` VALUES ('5', '1', '海苔多春鱼', '13', '0', '/static/img/5.gif', null, null, null);
INSERT INTO `dfz_dishes` VALUES ('6', '3', '奥尔良霸王腿', '15', '0', '/static/img/6.gif', null, null, null);
INSERT INTO `dfz_dishes` VALUES ('7', '3', '\r\n绝对薯格（微辣）', '14', '0', '/static/img/7.gif', null, null, null);
INSERT INTO `dfz_dishes` VALUES ('8', '1', '甘梅地瓜', '3', '0', '/static/img/8.gif', null, null, null);
INSERT INTO `dfz_dishes` VALUES ('9', '1', '宫廷盐酥鸡', '7', '0', '/static/img/9.gif', null, null, null);
INSERT INTO `dfz_dishes` VALUES ('10', '3', '\r\n爆芝大鸡排', '6', '0', '/static/img/10.gif', null, null, null);
INSERT INTO `dfz_dishes` VALUES ('11', '2', '脆皮香蕉（3个）', '6', '0', '/static/img/10.gif', null, null, null);
INSERT INTO `dfz_dishes` VALUES ('12', '3', '\r\n三角薯饼（6个）', '8', '0', '/static/img/9.gif', null, null, null);
INSERT INTO `dfz_dishes` VALUES ('13', '0', '\r\n带皮薯角', '9', '0', '/static/img/8.gif', null, null, null);
INSERT INTO `dfz_dishes` VALUES ('14', '0', '日式乌冬面', '43', '0', '/static/img/7.gif', null, null, null);
INSERT INTO `dfz_dishes` VALUES ('15', '0', '香港车仔面', '56', '0', '/static/img/6.gif', null, null, null);
INSERT INTO `dfz_dishes` VALUES ('16', '0', '爆辣火鸡面', '5', '0', '/static/img/5.gif', null, null, null);
INSERT INTO `dfz_dishes` VALUES ('17', '0', '袋袋瘾', '23', '0', '/static/img/4.gif', null, null, null);
INSERT INTO `dfz_dishes` VALUES ('18', '0', '原味奶茶', '7', '0', '/static/img/3.gif', null, null, null);
INSERT INTO `dfz_dishes` VALUES ('19', '0', '香蕉牛奶', '5', '0', '/static/img/2.gif', null, null, null);
INSERT INTO `dfz_dishes` VALUES ('20', '0', '\r\n卡布奇诺', '9', '0', '/static/img/1.gif', null, null, null);
INSERT INTO `dfz_dishes` VALUES ('21', '0', '红牛（牛奶）', '4', '0', '', null, null, null);
INSERT INTO `dfz_dishes` VALUES ('22', '0', '\r\n南山咖啡', '12', '0', '', null, null, null);
INSERT INTO `dfz_dishes` VALUES ('23', '0', '土豆宽粉', '98', '0', '', null, null, null);
INSERT INTO `dfz_dishes` VALUES ('24', '0', '手工面', '123', '0', '', null, null, null);
INSERT INTO `dfz_dishes` VALUES ('25', '0', '公仔面', '43', '0', '', null, null, null);
INSERT INTO `dfz_dishes` VALUES ('26', '0', '河粉', '123', '0', '', null, null, null);
INSERT INTO `dfz_dishes` VALUES ('27', '0', '桂林米粉', '2', '0', '', null, null, null);
INSERT INTO `dfz_dishes` VALUES ('28', '0', '蕨根粉', '123', '0', '', null, null, null);
INSERT INTO `dfz_dishes` VALUES ('29', '0', '红薯粉', '3', '0', '', null, null, null);
INSERT INTO `dfz_dishes` VALUES ('30', '0', '\r\n玉米粉', '54', '0', '', null, null, null);
INSERT INTO `dfz_dishes` VALUES ('31', '0', '香芋肉卷', '23', '0', '', null, null, null);
INSERT INTO `dfz_dishes` VALUES ('32', '0', '亲亲肠', '2', '0', '', null, null, null);
INSERT INTO `dfz_dishes` VALUES ('33', '0', '\r\n虾米饺', '234', '0', '', null, null, null);
INSERT INTO `dfz_dishes` VALUES ('34', '0', '香辣鱼果', '14', '0', '', null, null, null);
INSERT INTO `dfz_dishes` VALUES ('35', '0', '\r\n鸭胸肉', '2', '0', '', null, null, null);
INSERT INTO `dfz_dishes` VALUES ('36', '0', '培根', '5', '0', '', null, null, null);
INSERT INTO `dfz_dishes` VALUES ('37', '0', '\r\n猪扒肉', '16', '0', '', null, null, null);
INSERT INTO `dfz_dishes` VALUES ('38', '0', '黄金鱼豆腐', '6', '0', '', null, null, null);
INSERT INTO `dfz_dishes` VALUES ('39', '0', '水晶包', '16', '0', '', null, null, null);
INSERT INTO `dfz_dishes` VALUES ('40', '0', '\r\n撒尿牛肉丸', '87', '0', '', null, null, null);
INSERT INTO `dfz_dishes` VALUES ('41', '0', '西湖燕饺', '145', '0', '', null, null, null);

-- ----------------------------
-- Table structure for dfz_dishes_cate
-- ----------------------------
DROP TABLE IF EXISTS `dfz_dishes_cate`;
CREATE TABLE `dfz_dishes_cate` (
  `cid` int(11) NOT NULL AUTO_INCREMENT COMMENT '菜品大分类--父级id',
  `dishes_name` varchar(30) NOT NULL COMMENT '菜品分类--标题名称',
  `shop_id` int(11) NOT NULL COMMENT '该菜品分类是所属哪一家店铺的',
  `delete_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dfz_dishes_cate
-- ----------------------------
INSERT INTO `dfz_dishes_cate` VALUES ('1', '农家菜', '2', null, null, null);
INSERT INTO `dfz_dishes_cate` VALUES ('2', '湘菜', '3', null, null, null);
INSERT INTO `dfz_dishes_cate` VALUES ('3', '粤菜', '2', null, null, null);
INSERT INTO `dfz_dishes_cate` VALUES ('4', '奶茶', '5', null, null, null);
INSERT INTO `dfz_dishes_cate` VALUES ('5', '饺子', '4', null, null, null);
INSERT INTO `dfz_dishes_cate` VALUES ('6', '烤鱼', '4', null, null, null);
INSERT INTO `dfz_dishes_cate` VALUES ('7', '水果', '6', null, null, null);
INSERT INTO `dfz_dishes_cate` VALUES ('8', '养生茶', '7', null, null, null);
INSERT INTO `dfz_dishes_cate` VALUES ('9', '百合花', '8', null, null, null);
INSERT INTO `dfz_dishes_cate` VALUES ('10', '玫瑰花', '8', null, null, null);
INSERT INTO `dfz_dishes_cate` VALUES ('11', '康乃馨', '8', null, null, null);
INSERT INTO `dfz_dishes_cate` VALUES ('12', '小面', '9', null, null, null);
INSERT INTO `dfz_dishes_cate` VALUES ('13', '羊肉串', '4', null, null, null);
INSERT INTO `dfz_dishes_cate` VALUES ('14', '木桶饭', '1', null, null, null);
INSERT INTO `dfz_dishes_cate` VALUES ('15', '饮料', '2', null, null, null);

-- ----------------------------
-- Table structure for dfz_order
-- ----------------------------
DROP TABLE IF EXISTS `dfz_order`;
CREATE TABLE `dfz_order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '订单号',
  `username` varchar(20) NOT NULL COMMENT '用户，即手机号',
  `item` mediumtext COMMENT '包含订单信息的 json格式数据',
  `total_price` int(11) NOT NULL COMMENT '总价',
  `shop_id` varchar(11) NOT NULL COMMENT '店铺id',
  `order_status` smallint(2) NOT NULL DEFAULT '0' COMMENT '订单支付状态；0：未支付，1：已支付',
  `order_name` varchar(20) NOT NULL COMMENT '外卖接收人姓名',
  `order_phone` varchar(20) NOT NULL COMMENT '顾客留的手机号',
  `order_address` varchar(255) NOT NULL COMMENT '收货地址',
  `order_arrived_time` varchar(20) NOT NULL COMMENT '外卖送达时间',
  `order_liuyan` varchar(50) DEFAULT NULL COMMENT '订单留言，备注',
  `sf_price` int(11) DEFAULT NULL COMMENT '订单实付数额',
  `order_time` varchar(30) DEFAULT NULL COMMENT '下单时间',
  `jiedan_status` int(2) NOT NULL DEFAULT '0' COMMENT '商家是否已经接单；0：未接 ； 1：已接单； 2：拒单',
  `jiedan_time` varchar(30) DEFAULT NULL COMMENT '商家接单时间',
  `order_cancel` int(2) NOT NULL DEFAULT '0' COMMENT '0：顾客没取消；1：顾客发起取消订单；2：商家同意取消',
  `received` int(2) NOT NULL DEFAULT '0' COMMENT '饭是否已经送达；0：未开始送 ；1：在送途中；2：已送达',
  `received_time` varchar(30) DEFAULT NULL COMMENT '最终送达时间',
  `urge_count` int(2) NOT NULL DEFAULT '0' COMMENT '催单次数，0：返回通知商家消息，1+：返回催单成功',
  `is_comment` int(2) NOT NULL DEFAULT '0' COMMENT '是否评价了；0：未评 1：已评',
  `delete_time` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=60 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dfz_order
-- ----------------------------
INSERT INTO `dfz_order` VALUES ('25', '15767976872', '[{\"itemId\":\"7\",\"name\":\"\\n绝对薯格（微辣）\",\"count\":3,\"price\":\"14\"},{\"itemId\":\"1\",\"name\":\"\\n爆辣火鸡面\",\"count\":3,\"price\":\"12\"},{\"itemId\":\"6\",\"name\":\"奥尔良霸王腿\",\"count\":3,\"price\":\"15\"},{\"itemId\":\"12\",\"name\":\"\\n三角薯饼（6个）\",\"count\":1,\"price\":\"8\"},{\"itemId\":\"4\",\"name\":\"绝对薯格（微辣）\",\"count\":1,\"price\":\"10\"}]', '141', '2', '1', '饿了么', '13123123213', '深圳千峰', '10:00-10:30', '测试', '141', '2017/10/29 16:24:21', '0', null, '1', '2', '2017/10/29 17:27:21', '28', '0', null, null, null);
INSERT INTO `dfz_order` VALUES ('26', '15767976872', '[{\"itemId\":\"1\",\"name\":\"\\n爆辣火鸡面\",\"count\":3,\"price\":\"12\"},{\"itemId\":\"6\",\"name\":\"奥尔良霸王腿\",\"count\":3,\"price\":\"15\"},{\"itemId\":\"12\",\"name\":\"\\n三角薯饼（6个）\",\"count\":1,\"price\":\"8\"}]', '141', '2', '1', '国产007', '15123123111', '硅谷', '11:00-11:30', '不要辣', '139', '2017/10/29 16:00:27', '1', '2017/11/2  16:14:50', '0', '2', '2017/10/29 16:24:21', '0', '1', null, null, null);
INSERT INTO `dfz_order` VALUES ('28', '15767976872', '[{\"itemId\":\"7\",\"name\":\"\\n绝对薯格（微辣）\",\"count\":3,\"price\":\"14\"},{\"itemId\":\"1\",\"name\":\"\\n爆辣火鸡面\",\"count\":3,\"price\":\"12\"},{\"itemId\":\"6\",\"name\":\"奥尔良霸王腿\",\"count\":3,\"price\":\"15\"},{\"itemId\":\"12\",\"name\":\"\\n三角薯饼（6个）\",\"count\":1,\"price\":\"8\"},{\"itemId\":\"4\",\"name\":\"绝对薯格（微辣）\",\"count\":1,\"price\":\"10\"}]', '15', '4', '1', '老妈子', '13223231333', '广州越秀区', '11:00-11:30', '多双筷子', '14', '2017/10/26 23:37:17', '0', null, '0', '0', '2017/10/26 23:39:17', '0', '0', null, null, null);
INSERT INTO `dfz_order` VALUES ('27', '15767976872', '[{\"itemId\":\"7\",\"name\":\"\\n绝对薯格（微辣）\",\"count\":3,\"price\":\"14\"},{\"itemId\":\"1\",\"name\":\"\\n爆辣火鸡面\",\"count\":3,\"price\":\"12\"},{\"itemId\":\"6\",\"name\":\"奥尔良霸王腿\",\"count\":3,\"price\":\"15\"},{\"itemId\":\"12\",\"name\":\"\\n三角薯饼（6个）\",\"count\":1,\"price\":\"8\"},{\"itemId\":\"4\",\"name\":\"绝对薯格（微辣）\",\"count\":1,\"price\":\"10\"}]', '26', '3', '1', '老豆', '18853232323', '深圳宝安区', '11:00-11:30', '多放葱', '20', '2017/10/27 23:37:17', '0', null, '0', '0', '2017/10/27 23:40:17', '0', '0', null, null, null);
INSERT INTO `dfz_order` VALUES ('33', '15767976872', '[{\"itemId\":\"7\",\"name\":\"\\n绝对薯格（微辣）\",\"count\":3,\"price\":\"14\"},{\"itemId\":\"1\",\"name\":\"\\n爆辣火鸡面\",\"count\":3,\"price\":\"12\"},{\"itemId\":\"6\",\"name\":\"奥尔良霸王腿\",\"count\":3,\"price\":\"15\"},{\"itemId\":\"12\",\"name\":\"\\n三角薯饼（6个）\",\"count\":1,\"price\":\"8\"},{\"itemId\":\"4\",\"name\":\"绝对薯格（微辣）\",\"count\":1,\"price\":\"10\"}]', '141', '2', '1', '准备评论', '15345435435', '千峰', '14:00-14:30', '好的', '141', '2017/10/30  13:54:51', '0', '2017/11/1  13:48:15', '0', '2', '2017/10/30  14:54:51', '1', '0', null, null, null);
INSERT INTO `dfz_order` VALUES ('59', '15767976872', '[{\"itemId\":\"7\",\"name\":\"\\n绝对薯格（微辣）\",\"count\":1,\"price\":\"14\"},{\"itemId\":\"12\",\"name\":\"\\n三角薯饼（6个）\",\"count\":2,\"price\":\"8\"}]', '30', '2', '1', '我家', '15123123213', '千灯', '21:30-22:00', '沙', '28', '2017/11/2  21:01:34', '0', null, '0', '0', null, '0', '0', null, null, null);

-- ----------------------------
-- Table structure for dfz_shop_cate
-- ----------------------------
DROP TABLE IF EXISTS `dfz_shop_cate`;
CREATE TABLE `dfz_shop_cate` (
  `all_cate_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '商家经营范围',
  `cate_name` varchar(20) NOT NULL COMMENT '商家经营范围--类别名称',
  `weight` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`all_cate_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dfz_shop_cate
-- ----------------------------
INSERT INTO `dfz_shop_cate` VALUES ('1', '快食简餐', null, null, null, null);
INSERT INTO `dfz_shop_cate` VALUES ('2', '西式简餐', null, null, null, null);
INSERT INTO `dfz_shop_cate` VALUES ('3', '中式正餐', null, null, null, null);
INSERT INTO `dfz_shop_cate` VALUES ('4', '烧烤海鲜', null, null, null, null);
INSERT INTO `dfz_shop_cate` VALUES ('5', '甜点饮品', null, null, null, null);
INSERT INTO `dfz_shop_cate` VALUES ('6', '水果生鲜', null, null, null, null);
INSERT INTO `dfz_shop_cate` VALUES ('7', '下午茶', null, null, null, null);
INSERT INTO `dfz_shop_cate` VALUES ('8', '鲜花蛋糕', null, null, null, null);
INSERT INTO `dfz_shop_cate` VALUES ('9', '夜宵', null, null, null, null);

-- ----------------------------
-- Table structure for dfz_shop_list
-- ----------------------------
DROP TABLE IF EXISTS `dfz_shop_list`;
CREATE TABLE `dfz_shop_list` (
  `shop_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '商家店铺ID',
  `shop_name` varchar(32) NOT NULL COMMENT '店铺名称',
  `shop_user_id` int(11) DEFAULT NULL COMMENT '店铺持有人id',
  `shop_addtime` varchar(100) DEFAULT NULL COMMENT '店铺注册时间',
  `shop_opentime` varchar(50) DEFAULT NULL COMMENT '店铺营业时间',
  `shop_introduce` text COMMENT '店铺介绍',
  `shop_tel` varchar(20) NOT NULL COMMENT '联系人电话',
  `shop_addr` varchar(255) DEFAULT NULL COMMENT '店铺地址',
  `shop_dispatch_price` decimal(10,2) DEFAULT NULL COMMENT '起送价格',
  `shop_state` smallint(2) NOT NULL DEFAULT '0' COMMENT '店铺营业状态: 0:已闭店； 1：营业中',
  `shop_pic` varchar(255) DEFAULT NULL COMMENT '店铺图片',
  `shop_mode_id` smallint(2) NOT NULL COMMENT '经营范围--种类id',
  `shop_dispath` smallint(2) NOT NULL DEFAULT '0' COMMENT '配送方式，是平台送还是自配送; 0:平台送； 1：自配送',
  `shop_add_price` int(10) NOT NULL DEFAULT '0' COMMENT '配送费',
  `shop_box_price` decimal(10,2) NOT NULL COMMENT '餐盒费',
  `shop_sell_sum` smallint(10) NOT NULL DEFAULT '0' COMMENT '月销售量',
  `shop_get_time` int(5) NOT NULL DEFAULT '0' COMMENT '商品送达时间',
  `status` int(2) NOT NULL DEFAULT '0' COMMENT '0：商家已经入驻；1：提交申请，尚未通过',
  `delete_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`shop_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dfz_shop_list
-- ----------------------------
INSERT INTO `dfz_shop_list` VALUES ('1', '金拱门', null, null, null, null, '15678978977', null, '20.00', '0', '/static/img/jin.png', '1', '0', '5', '0.00', '0', '0', '0', null, null, null);
INSERT INTO `dfz_shop_list` VALUES ('2', 'Super薯排', null, '2017/10/28 16:24:20', '9:00 - 22:30', '薯d', '15767976871', '深圳宝安千峰', '15.00', '1', '/static/img/55b1b51099703cc_ccx@2x@2x.png', '2', '0', '0', '0.00', '5', '0', '0', null, null, null);
INSERT INTO `dfz_shop_list` VALUES ('3', '冰岛茶餐厅（点送配送）', null, null, null, null, '18088456456', null, '0.00', '0', '/static/img/573035f161eb7111@2x@2x.png', '3', '0', '2', '0.00', '0', '0', '0', null, null, null);
INSERT INTO `dfz_shop_list` VALUES ('4', '台湾口口冰', null, null, null, null, '15767976872', null, '39.00', '0', '/static/img/56fc8674e3d0d130@2x@2x.png', '4', '0', '10', '0.00', '2', '0', '0', null, null, null);
INSERT INTO `dfz_shop_list` VALUES ('5', '祥记牛肉面', null, null, null, null, '', null, '0.00', '0', '/static/img/21ad00d1ca620794.png', '5', '0', '0', '0.00', '1', '0', '0', null, null, null);
INSERT INTO `dfz_shop_list` VALUES ('6', '河间驴肉火烧(大学城店）', null, null, null, null, '', null, '0.00', '1', '/static/img/569f64d190c56120x120@2x@2x.png', '6', '0', '0', '0.00', '0', '0', '0', null, null, null);
INSERT INTO `dfz_shop_list` VALUES ('7', '东北水饺店（平山店)', null, null, null, null, '', null, '12.00', '0', '/static/img/562c8927c9cd5120@2x@2x.png', '7', '0', '0', '0.00', '12', '0', '0', null, null, null);
INSERT INTO `dfz_shop_list` VALUES ('8', '旺湘城市快餐', null, null, null, null, '', null, '13.00', '0', '/static/img/55b1b52509a71cc_ccx@2x@2x.png', '8', '0', '0', '0.00', '0', '0', '0', null, null, null);
INSERT INTO `dfz_shop_list` VALUES ('9', '果然心动（大学城店）', null, null, null, null, '', null, '124.00', '0', '/static/img/1002.jpg', '9', '0', '13', '0.00', '0', '0', '0', null, null, null);
INSERT INTO `dfz_shop_list` VALUES ('10', '贡茶西丽旗舰店', null, null, null, null, '', null, '132.00', '0', '/static/img/about_header_bg.jpg', '4', '0', '0', '0.00', '13', '0', '0', null, null, null);
INSERT INTO `dfz_shop_list` VALUES ('11', '快餐丽旗舰店', null, null, null, null, '', null, '0.00', '0', '/static/img/55b1b52509a71cc_ccx@2x@2x.png', '2', '0', '0', '0.00', '0', '0', '0', null, null, null);
INSERT INTO `dfz_shop_list` VALUES ('12', '东北肉火烧', null, null, null, null, '', null, '15.00', '0', '/static/img/569f64d190c56120x120@2x@2x.png', '2', '0', '0', '0.00', '12', '0', '0', null, null, null);
INSERT INTO `dfz_shop_list` VALUES ('13', 'ceshi', null, null, null, null, '13111111111', '我家', null, '0', null, '3', '1', '0', '0.00', '0', '0', '1', null, null, null);

-- ----------------------------
-- Table structure for dfz_suggest
-- ----------------------------
DROP TABLE IF EXISTS `dfz_suggest`;
CREATE TABLE `dfz_suggest` (
  `tid` int(11) NOT NULL AUTO_INCREMENT COMMENT '投诉建议',
  `username` varchar(11) NOT NULL COMMENT '用户名',
  `content` varchar(255) DEFAULT NULL COMMENT '投诉内容',
  `reply` varchar(255) DEFAULT NULL COMMENT '回复',
  `delete_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`tid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dfz_suggest
-- ----------------------------

-- ----------------------------
-- Table structure for dfz_user
-- ----------------------------
DROP TABLE IF EXISTS `dfz_user`;
CREATE TABLE `dfz_user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL COMMENT '手机号登录',
  `password` varchar(32) NOT NULL COMMENT '登录密码',
  `jifen` varchar(6) NOT NULL DEFAULT '0' COMMENT '积分，积分抵现',
  `real_name` varchar(20) DEFAULT NULL COMMENT '账户设置的姓名',
  `delete_time` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dfz_user
-- ----------------------------
INSERT INTO `dfz_user` VALUES ('1', '15767976871', 'w809794', '35', null, null, null, null);
INSERT INTO `dfz_user` VALUES ('9', '18397646259', 'w12345678', '25', null, null, null, null);
INSERT INTO `dfz_user` VALUES ('10', '15767976872', 'w809794', '5', 'faker', null, null, null);
INSERT INTO `dfz_user` VALUES ('12', '15767976873', 'w809794', '30', null, null, null, null);
