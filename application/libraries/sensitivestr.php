<?php
/**
 * 过滤或检查敏感字符
 * tab参数：1--对字符串进行敏感字符检查
 *	 0--对字符串进行敏感字符替换
 * 返回值：当tab值为1时，如果有敏感字符返回值为1，如果没有敏感字符返回值为0；
 *	当tab值为0时，返回被*替换后的字符串
 */
class Sensitivestr {
    
    public function  filter_SensitiveStr($str){
    $SenArr=array(
        "香港婚姻",
"打破家装暴利",
"课外辅导",
"苹果.*电脑",
"18846362221",
"bzxcfui.com",
"校验.吗",
"中奖",
"独裁政治",
"考研全程备",
"【招商银行】",
"射精",
"预测",
"13851589581",
"骨科治疗领域",
"徐匡迪",
"阳具",
"神经官能",
"13706070008",
"13795287347",
"13805538282",
"流亡",
"中华人民实话实说",
"13811038365",
"刘山青",
"统战",
"不雅视频",
"强势板块",
"男女公关",
"发伦",
"钱国梁",
"将会暴涨",
"上床",
"冯素英",
"13537669224",
"豪&华新场",
"虐待",
"争鸣论坛",
"钟山风雨论坛",
"坐诊",
"多党",
"白癜风",
"triangle",
"13759779425",
"性伴侣",
"反监考大师",
"刘华清",
"只限山东考区",
"骚货",
"中华民国",
"超高通过率",
"15004505637",
"小泉参拜",
"丁关根",
"18250069209",
"13506004653",
"13872329105",
"淄博执医",
"行房",
"boxun",
"开苞",
"舆论反制",
"颈腰椎病",
"13523085083",
"炸药",
"世维会",
"13820426061",
"法抡功",
"13598086326",
"中国社会论坛",
"中华真实报道",
"易丹轩",
"15727776666",
"提升成绩",
"13817095111",
"升天",
"郭伯雄",
"民意论坛",
"监视",
"13757819377",
"江泽慧",
"我出事了",
"13937756016",
"会计参考",
"minghuinews",
"俞正声",
"13936325894",
"实力说明一切",
"性服务",
"名 师小班",
"13631056719",
"不限贷",
"輪一功",
"15262084700",
"万晓东",
"远志明",
"中华时事",
"蒲团",
"北美自由论坛",
"safeweb",
"建国党",
"靠你妈",
"30前公开提示",
"刘宾雁",
"建仓",
"13868008467",
"[品冠]",
"可平仓",
"13939959009",
"股道提示",
"13733302225",
"镇压",
"taip",
"迟浩田",
"打倒",
"统独",
"13886699992",
"H7N9",
"13524620124",
"指点江山论坛",
"梦想创业基金",
"被查",
"舆论",
"民主墙",
"喷尿",
"台独",
"13730111275",
"金帛理财",
"让你渡过难关",
"千万别来电话",
"无须担保",
"高端私密养生",
"你妈的",
"www.hnwsmx.com",
"13791886619",
"今天下午买进",
"将强势拉",
"法功",
"专业做账报税",
"分裂",
"教徒",
"佛展千手法",
"小语种1对1培训",
"黄金旺铺",
"13850599248",
"巴勒斯坦民族解放事业",
"鸡八",
"谢选骏",
"申报资质",
"18292376636",
"枪",
"口交",
"找小姐",
"《湖南卫视》",
"公司注册",
"让您拥有属于自己的美宅，闻松听海",
"于浩成",
"我司昨已低位",
"养生会员刊",
"15904033878",
"钓 鱼岛",
"四川独立",
"18668904162",
"洪哲胜",
"台湾青年独立联盟",
"家教",
"灵宝通信",
"请尽快加入学信群:1024253详情:http://t.cn/R4P5daR",
"18204500820",
"15862734696",
"城管",
"15257195922",
"请您速打5000元到赵警官卡上",
"吉的堡",
"开票",
"迫害",
"艳舞",
"18379220900",
"13563763112",
"13620784297",
"400-016-9558",
"极品“花茶”",
"13510262815",
"信用卡",
"bgg",
"肌肤问题",
"huanet",
"国研锦成",
"涨停",
"老江",
"送出梦想创业基金",
"15195352211",
"把钱汇到",
"13852639386",
"无需担保",
"徐水良",
"dfdz",
"后市大涨",
"功法",
"张伟国",
"石戈",
"鲍彤",
"程真",
"加Q群",
"哈批",
"郑义",
"宋xx",
"奸淫",
"保岛",
"13626287641",
"抢房",
"13801163267",
"QQ:572229390",
"xinsheng",
"QQ:987776381",
"他妈的",
"周旋",
"15210991391",
"朱嘉明",
"13953535954",
"操你妈",
"卖淫",
"王兆国",
"13854501623",
"朱小龙口腔",
"泡沫经济",
"jiangdongriji",
"王力雄",
"上访",
"午盘",
"异性开房",
"妈我和异性同居被查",
"hypermart.net",
"凌锋",
"15022198023",
"止损",
"炸弹",
"小鸡鸡",
"插你",
"全部真题",
"13500763659",
"黄翔",
"making",
"招行帐号",
"生殖",
"赤化",
"100%帮你轻松",
"贱人",
"15842417687",
"交大复旦一流师资",
"会计一手包过",
"18701178695",
"盛华仁",
"赤匪",
"1对1课外辅导",
"伦功",
"QQ：312878785",
"看到成绩后再付款",
"夜话紫禁城",
"狗屎",
"13517002011",
"阴道",
"桑拿",
"四川独",
"咨询有图片欣赏",
"13604075262",
"13589040457",
"情色",
"王策",
"13965009707",
"群奸",
"大盖帽",
"李洪宽",
"幼齿",
"13931505456",
"民联",
"13607658135",
"李红痔",
"李克强",
"助考",
"13779929815",
"杨建利",
"13995489776",
"incest",
"李克",
"喷你",
"天下藏獒",
"低位布局",
"政治犯",
"限额招生",
"狗卵子",
"把钱打到",
"[品冠自发货商场]",
"今年参加了医学笔",
"高端定制课",
"(李).*(洪).*(志)",
"仿真枪",
"英伦美墅",
"金源投资",
"1对1试听",
"关注重组股",
"13582350637",
"同步教学",
"阴囊",
"Family Radio",
"监听",
"交行帐号",
"精液",
"张宏堡",
"金相",
"共产党",
"持不同政见",
"民族矛盾",
"免费试卷",
"13657907088",
"姜春云",
"共狗",
"江流氓",
"望君前来赏花",
"15859312288",
"男人常食一种",
"dajiyuan",
"共军",
"一线名师",
"您被随机抽取为德州市纪委监察局评议评价代表",
"15292897606",
"falungong",
"考试中传",
"面瘫",
"司马晋",
"军国 主义",
"15000386279",
"zhuanfalun",
"新人新场新气象",
"13905098688",
"www.shjtsj.net",
"医考",
"法轮",
"75536964499",
"高自联",
"电视流氓",
"18655053667",
"风雨神州论坛",
"异议人士",
"南京博雅教育",
"freechina",
"国军",
"13979607517",
"13958368878",
"傻逼",
"零风险100%过",
"赵海青",
"加Q",
"魏新生",
"二手车",
"法规密训",
"15910936022",
"13942822819",
"13901662573",
"逆势拉升",
"别墅",
"华岳时事论坛",
"东土耳其斯坦",
"18831613234",
"15737569055",
"异见人士",
"止盈",
"两会报道",
"明日拉升",
"www.hkjc88.com",
"贾廷安",
"15901385689",
"邓小平",
"会计考前必备",
"除皱塑形",
"农行帐号",
"热点板块",
"刘凯中",
"徐邦秦",
"IP17908",
"反封锁",
"嘌|缥",
"13661241816",
"13941207203",
"社保中心",
"陈总统",
"央视内部晚会",
"买码",
"信用贷款",
"杨月清",
"tibetalk",
"政治反对派",
"东社",
"淘宝系统提示",
"回良玉",
"考创奇迹",
"兴业私",
"僵贼",
"小泽玛莉亚",
"天安门屠杀",
"15990159118",
"13810656764",
"100倍杠杆",
"新飞讯传媒",
"疆独",
"留学",
"做坚持不懈真男人",
"開盤后",
"天安门事件",
"法考试不",
"法轮功",
"快速突破",
"氵去",
"护法",
"豪华装修新场",
"速记班",
"13901671831",
"青天白日旗",
"15853826881",
"dafa",
"gkl",
"发伦功",
"医保均可报销",
"联系我处帮您办理100%",
"张伯笠",
"无抵押",
"13414795099",
"行踪",
"地产",
"迪里夏提",
"野鸡",
"QQ:177786032",
"李小鹏",
"13866651800",
"温家宝",
"骨干老师",
"轮功",
"13901881927",
"强歼",
"岳武",
"法一轮",
"炼功",
"偷情",
"今宵伴君何处",
"UltraSurf",
"请您立即还清欠款",
"零基础过",
"与庄起飞",
"涨?停",
"酱猪媳",
"13731096269",
"鸡巴",
"刘国凯",
"http://tvzjhaosyin766.com",
"&星摩",
"癫痫病",
"阴水",
"超强股",
"考试内容",
"13865994259",
"喇嘛&抗议",
"工行帐号",
"曾庆红",
"法谪",
"强势介入",
"福利彩票",
"淫荡",
"习近平",
"王立军",
"保钓",
"15298608680",
"送iphone6手机",
"百分之百一次性包通",
"胡景涛",
"丁子霖",
"透视镜",
"则民",
"异性同居",
"祛斑",
"你爸",
"免费服务",
"中国社会进步党",
"13401688864",
"无担保",
"15980437863",
"沪深A股",
"免费精品陪读",
"亲美",
"闹事",
"ustibet",
"狗B",
"司法考试",
"游行",
"缠绵水灵",
"新语丝",
"儿童智能手表",
"氵去车仑工力",
"GMAT",
"发论",
"马三家",
"人人游戏",
"钓鱼 岛",
"春夏自由论坛",
"工力",
"岁末清仓",
"卖逼",
"杜智富",
"15965734288",
"peacehall",
"13813823303",
"胡平",
"反革命",
"支那",
"15270666662",
"13811668959",
"13518694774",
"幸运用户",
"李洪志",
"QQ:507089996",
"飯島愛",
"我加你进群关注",
"13910669701",
"贾育台",
"赴港产子",
"兴诚港务",
"早盘拉涨",
"林长盛",
"独夫",
"13935186440",
"股双向交易平台",
"大纪园",
"解套",
"吴仁华",
"解决你一切难题",
"法愣",
"澳城大MBA",
"苏绍智",
"独裁",
"法－轮輪",
"洪志",
"动力持久真男人",
"13705553468",
"反封锁技术",
"13695091433",
"我公司代开",
"朱镕基",
"13453378310",
"15985211155",
"达赖",
"项怀诚",
"狗操",
"www.XinXunXi.com",
"烤瓷牙",
"100%帮你轻松通",
"13750607800",
"13960401690",
"共匪",
"恢复嫩白无暇肌肤",
"13713168613",
"13736189216",
"江八点",
"*点播",
"王瑞林",
"一级建造师考试",
"操你",
"摩根盛通",
"13817867331",
"傅志寰",
"法伦",
"voachinese",
"精锐1对1",
"心脑血管疾病",
"枪支弹药炸弹",
"13962169406",
"东北独立",
"朱毛",
"13777447770",
"太子党",
"房产",
"大史纪",
"为考试烦恼",
"勃起",
"揭批书",
"阎明复",
"票抄底如需",
"江猪媳",
"chinesenewsnet",
"因材施教",
"13805973859",
"全盘封顶",
"13679156850",
"13671182472",
"13522010101",
"黄金铺",
"90％取现",
"日死你",
"水扁",
"六合彩",
"15002909180",
"轻松通过",
"移民",
"15019827679",
"首付",
"选股方法",
"荡妇",
"中国论坛",
"台盟",
"法輪大法",
"13552620590",
"无界浏览器",
"一手网关",
"13864965366",
"塑美极",
"没有花言巧语",
"离婚",
"南大自由论坛",
"一个月提升性状况",
"安全套",
"反人类",
"交易手续费",
"POS机",
"义解",
"胡锦滔",
"王秀丽",
"13913033886",
"13985203641",
"淘宝客服",
"falun",
"李大师",
"叫床",
"13805532105",
"企业贷",
"成绩下来后付",
"日你",
"妈批",
"13522390999",
"破处",
"兑换价之后领取手机和话",
"学联",
"王希哲",
"帮助千万男性重振雄风",
"地下教会",
"罗礼诗",
"15900395181",
"18639021823",
"13784122691",
"加你进群",
"尽在他和她的空间",
"张昭富",
"接收真卷",
"男士养生会",
"失密",
"9:30前公开发布",
"商业配套",
"我司来了很多新人",
"一党",
"台湾建国运动组织",
"热站政论网",
"执业医师考试",
"教养院",
"让您渡过难关",
"江猪",
"江贼",
"13910593373",
"已给您发送秋波",
"东辉教育",
"女優"
    );    
		$SenStr='';
		foreach($SenArr as $value){
			if(strpos($str,$value)!==FALSE){
				$SenStr=$value;
				break;
			}
		}
		return $SenStr;
}
}