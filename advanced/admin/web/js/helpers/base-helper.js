function getCityConfigWithProvinceCode(provinceCode){
    var cityList = [];
    if(provinceCode == 10){
        // 江苏
        cityList.push({"code": 162, "label": "南京"});
        cityList.push({"code": 163, "label": "无锡"});
        cityList.push({"code": 164, "label": "徐州"});
        cityList.push({"code": 165, "label": "常州"});
        cityList.push({"code": 166, "label": "苏州"});
        cityList.push({"code": 167, "label": "南通"});
        cityList.push({"code": 168, "label": "连云港"});
        cityList.push({"code": 169, "label": "淮安"});
        cityList.push({"code": 170, "label": "盐城"});
        cityList.push({"code": 171, "label": "扬州"});
        cityList.push({"code": 172, "label": "镇江"});
        cityList.push({"code": 173, "label": "泰州"});
        cityList.push({"code": 174, "label": "宿迁"});
    } else if (provinceCode == 11){
        // 浙江
        cityList.push({"code": 175, "label": "杭州"});
        cityList.push({"code": 176, "label": "宁波"});
        cityList.push({"code": 177, "label": "温州"});
        cityList.push({"code": 178, "label": "嘉兴"});
        cityList.push({"code": 179, "label": "湖州"});
        cityList.push({"code": 180, "label": "绍兴"});
        cityList.push({"code": 181, "label": "舟山"});
        cityList.push({"code": 182, "label": "衢州"});
        cityList.push({"code": 183, "label": "金华"});
        cityList.push({"code": 184, "label": "台州"});
        cityList.push({"code": 185, "label": "丽水"});
    } else if(provinceCode == 12){
        // 安徽
        cityList.push({"code": 186, "label": "合肥"});
        cityList.push({"code": 187, "label": "芜湖"});
        cityList.push({"code": 188, "label": "蚌埠"});
        cityList.push({"code": 189, "label": "淮南"});
        cityList.push({"code": 190, "label": "马鞍山"});
        cityList.push({"code": 191, "label": "淮北"});
        cityList.push({"code": 192, "label": "铜陵"});
        cityList.push({"code": 193, "label": "安庆"});
        cityList.push({"code": 194, "label": "黄山"});
        cityList.push({"code": 195, "label": "滁州"});
        cityList.push({"code": 196, "label": "阜阳"});
        cityList.push({"code": 197, "label": "宿州"});
        cityList.push({"code": 198, "label": "巢湖"});
        cityList.push({"code": 199, "label": "六安"});
        cityList.push({"code": 200, "label": "亳州"});
        cityList.push({"code": 201, "label": "池州"});
        cityList.push({"code": 202, "label": "宣城"});
    } else  if(provinceCode == 13){
        // 福建
        cityList.push({"code": 203, "label": "福州"});
        cityList.push({"code": 204, "label": "厦门"});
        cityList.push({"code": 205, "label": "莆田"});
        cityList.push({"code": 206, "label": "三明"});
        cityList.push({"code": 207, "label": "泉州"});
        cityList.push({"code": 208, "label": "漳州"});
        cityList.push({"code": 209, "label": "南平"});
        cityList.push({"code": 210, "label": "龙岩"});
        cityList.push({"code": 211, "label": "宁德"});
    } else if(provinceCode == 14){
        // 江西
        cityList.push({"code": 212, "label": "南昌"});
        cityList.push({"code": 213, "label": "景德镇"});
        cityList.push({"code": 214, "label": "萍乡"});
        cityList.push({"code": 215, "label": "九江"});
        cityList.push({"code": 216, "label": "新余"});
        cityList.push({"code": 217, "label": "鹰潭"});
        cityList.push({"code": 218, "label": "赣州"});
        cityList.push({"code": 219, "label": "吉安"});
        cityList.push({"code": 220, "label": "宜春"});
        cityList.push({"code": 221, "label": "抚州"});
        cityList.push({"code": 222, "label": "上饶"});
    } else if(provinceCode == 15){
        // 山东
        cityList.push({"code": 223, "label": "济南"});
        cityList.push({"code": 224, "label": "青岛"});
        cityList.push({"code": 225, "label": "淄博"});
        cityList.push({"code": 226, "label": "枣庄"});
        cityList.push({"code": 227, "label": "东营"});
        cityList.push({"code": 228, "label": "烟台"});
        cityList.push({"code": 229, "label": "潍坊"});
        cityList.push({"code": 230, "label": "济宁"});
        cityList.push({"code": 231, "label": "泰安"});
        cityList.push({"code": 232, "label": "威海"});
        cityList.push({"code": 233, "label": "日照"});
        cityList.push({"code": 234, "label": "莱芜"});
        cityList.push({"code": 235, "label": "临沂"});
        cityList.push({"code": 236, "label": "德州"});
        cityList.push({"code": 237, "label": "聊城"});
        cityList.push({"code": 238, "label": "滨州"});
        cityList.push({"code": 239, "label": "菏泽"});
    } else if(provinceCode == 16){
        // 河南
        cityList.push({"code": 240, "label": "郑州"});
        cityList.push({"code": 241, "label": "开封"});
        cityList.push({"code": 242, "label": "洛阳"});
        cityList.push({"code": 243, "label": "平顶市"});
        cityList.push({"code": 244, "label": "安阳"});
        cityList.push({"code": 245, "label": "鹤壁"});
        cityList.push({"code": 246, "label": "新乡"});
        cityList.push({"code": 247, "label": "焦作"});
        cityList.push({"code": 248, "label": "濮阳"});
        cityList.push({"code": 249, "label": "许昌"});
        cityList.push({"code": 250, "label": "漯河"});
        cityList.push({"code": 251, "label": "三门峡"});
        cityList.push({"code": 252, "label": "南阳"});
        cityList.push({"code": 253, "label": "商丘"});
        cityList.push({"code": 254, "label": "信阳"});
        cityList.push({"code": 255, "label": "周口"});
        cityList.push({"code": 256, "label": "驻马店"});
        cityList.push({"code": 257, "label": "济源"});
    } else if(provinceCode == 17){
        // 湖北
        cityList.push({"code": 258, "label": "武汉"});
        cityList.push({"code": 259, "label": "黄石"});
        cityList.push({"code": 260, "label": "十堰"});
        cityList.push({"code": 261, "label": "宜昌"});
        cityList.push({"code": 262, "label": "襄樊"});
        cityList.push({"code": 263, "label": "鄂州"});
        cityList.push({"code": 264, "label": "荆门"});
        cityList.push({"code": 265, "label": "孝感"});
        cityList.push({"code": 266, "label": "荆州"});
        cityList.push({"code": 267, "label": "黄冈"});
        cityList.push({"code": 268, "label": "咸宁"});
        cityList.push({"code": 269, "label": "随州"});
        cityList.push({"code": 270, "label": "恩施土家族苗族自治州"});
        cityList.push({"code": 271, "label": "仙桃"});
        cityList.push({"code": 272, "label": "潜江"});
        cityList.push({"code": 273, "label": "天门"});
        cityList.push({"code": 274, "label": "神农架林区"});
    } else if(provinceCode == 18){
        // 湖南
        cityList.push({"code": 275, "label": "长沙"});
        cityList.push({"code": 276, "label": "株洲"});
        cityList.push({"code": 277, "label": "湘潭"});
        cityList.push({"code": 278, "label": "衡阳"});
        cityList.push({"code": 279, "label": "邵阳"});
        cityList.push({"code": 280, "label": "岳阳"});
        cityList.push({"code": 281, "label": "常德"});
        cityList.push({"code": 282, "label": "张家"});
        cityList.push({"code": 283, "label": "益阳"});
        cityList.push({"code": 284, "label": "郴州"});
        cityList.push({"code": 285, "label": "永州"});
        cityList.push({"code": 286, "label": "怀化"});
        cityList.push({"code": 287, "label": "娄底"});
        cityList.push({"code": 288, "label": "湘西土家族苗族自治州"});
    } else if(provinceCode == 19){
        // 广东
        cityList.push({"code": 289, "label": "广州"});
        cityList.push({"code": 290, "label": "韶关"});
        cityList.push({"code": 291, "label": "深圳"});
        cityList.push({"code": 292, "label": "珠海"});
        cityList.push({"code": 293, "label": "汕头"});
        cityList.push({"code": 294, "label": "佛山"});
        cityList.push({"code": 295, "label": "江门"});
        cityList.push({"code": 296, "label": "湛江"});
        cityList.push({"code": 297, "label": "茂名"});
        cityList.push({"code": 298, "label": "肇庆"});
        cityList.push({"code": 299, "label": "惠州"});
        cityList.push({"code": 300, "label": "梅州"});
        cityList.push({"code": 301, "label": "汕尾"});
        cityList.push({"code": 302, "label": "河源"});
        cityList.push({"code": 303, "label": "阳江"});
        cityList.push({"code": 304, "label": "清远"});
        cityList.push({"code": 305, "label": "东莞"});
        cityList.push({"code": 306, "label": "中山"});
        cityList.push({"code": 307, "label": "潮州"});
        cityList.push({"code": 308, "label": "揭阳"});
        cityList.push({"code": 309, "label": "云浮"});
    } else if(provinceCode == 20){
        // 广西
        cityList.push({"code": 310, "label": "南宁"});
        cityList.push({"code": 311, "label": "柳州"});
        cityList.push({"code": 312, "label": "桂林"});
        cityList.push({"code": 313, "label": "梧州"});
        cityList.push({"code": 314, "label": "北海"});
        cityList.push({"code": 315, "label": "防城港"});
        cityList.push({"code": 316, "label": "钦州"});
        cityList.push({"code": 317, "label": "贵港"});
        cityList.push({"code": 318, "label": "玉林"});
        cityList.push({"code": 319, "label": "百色"});
        cityList.push({"code": 320, "label": "贺州"});
        cityList.push({"code": 321, "label": "河池"});
        cityList.push({"code": 322, "label": "来宾"});
        cityList.push({"code": 323, "label": "崇左"});
    } else if (provinceCode == 21){
        // 海南
        cityList.push({"code": 324, "label": "海口"});
        cityList.push({"code": 325, "label": "三亚"});
        cityList.push({"code": 326, "label": "五指山"});
        cityList.push({"code": 327, "label": "琼海"});
        cityList.push({"code": 328, "label": "儋州"});
        cityList.push({"code": 329, "label": "文昌"});
        cityList.push({"code": 330, "label": "万宁"});
        cityList.push({"code": 331, "label": "东方"});
        cityList.push({"code": 332, "label": "定安县"});
        cityList.push({"code": 333, "label": "屯昌县"});
        cityList.push({"code": 334, "label": "澄迈县"});
        cityList.push({"code": 335, "label": "临高县"});
        cityList.push({"code": 336, "label": "白沙黎族自治县"});
        cityList.push({"code": 337, "label": "昌江黎族自治县"});
        cityList.push({"code": 338, "label": "乐东黎族自治县"});
        cityList.push({"code": 339, "label": "陵水黎族自治县"});
        cityList.push({"code": 340, "label": "保亭黎族苗族自治县"});
        cityList.push({"code": 341, "label": "琼中黎族苗族自治县"});
        cityList.push({"code": 342, "label": "西沙群岛"});
        cityList.push({"code": 343, "label": "南沙群岛"});
        cityList.push({"code": 344, "label": "中沙群岛的岛礁及其海域"});
    } else if(provinceCode == 22){
        // 重庆
        cityList.push({"code": 345, "label": "万州区"});
        cityList.push({"code": 346, "label": "涪陵区"});
        cityList.push({"code": 347, "label": "渝中区"});
        cityList.push({"code": 348, "label": "大渡口区"});
        cityList.push({"code": 349, "label": "江北区"});
        cityList.push({"code": 350, "label": "沙坪坝区"});
        cityList.push({"code": 351, "label": "九龙坡区"});
        cityList.push({"code": 352, "label": "南岸区"});
        cityList.push({"code": 353, "label": "北碚区"});
        cityList.push({"code": 354, "label": "双桥区"});
        cityList.push({"code": 355, "label": "万盛区"});
        cityList.push({"code": 356, "label": "渝北区"});
        cityList.push({"code": 357, "label": "巴南区"});
        cityList.push({"code": 358, "label": "黔江区"});
        cityList.push({"code": 359, "label": "长寿区"});
        cityList.push({"code": 360, "label": "綦江县"});
        cityList.push({"code": 361, "label": "潼南县"});
        cityList.push({"code": 362, "label": "铜梁县"});
        cityList.push({"code": 363, "label": "大足县"});
        cityList.push({"code": 364, "label": "荣昌县"});
        cityList.push({"code": 365, "label": "璧山县"});
        cityList.push({"code": 366, "label": "梁平县"});
        cityList.push({"code": 367, "label": "城口县"});
        cityList.push({"code": 368, "label": "丰都县"});
        cityList.push({"code": 369, "label": "垫江县"});
        cityList.push({"code": 370, "label": "武隆县"});
        cityList.push({"code": 371, "label": "忠县"});
        cityList.push({"code": 372, "label": "开县"});
        cityList.push({"code": 373, "label": "云阳县"});
        cityList.push({"code": 374, "label": "奉节县"});
        cityList.push({"code": 375, "label": "巫山县"});
        cityList.push({"code": 376, "label": "巫溪县"});
        cityList.push({"code": 377, "label": "石柱土家族自治县"});
        cityList.push({"code": 378, "label": "秀山土家族苗族自治县"});
        cityList.push({"code": 379, "label": "酉阳土家族苗族自治县"});
        cityList.push({"code": 380, "label": "彭水苗族土家族自治县"});
        cityList.push({"code": 381, "label": "江津"});
        cityList.push({"code": 382, "label": "合川"});
        cityList.push({"code": 383, "label": "永川"});
        cityList.push({"code": 384, "label": "南川"});
    } else if(provinceCode == 23){
        // 四川
        cityList.push({"code": 385, "label": "成都"});
        cityList.push({"code": 386, "label": "自贡"});
        cityList.push({"code": 387, "label": "攀枝花"});
        cityList.push({"code": 388, "label": "泸州"});
        cityList.push({"code": 389, "label": "德阳"});
        cityList.push({"code": 390, "label": "绵阳"});
        cityList.push({"code": 391, "label": "广元"});
        cityList.push({"code": 392, "label": "遂宁"});
        cityList.push({"code": 393, "label": "内江"});
        cityList.push({"code": 394, "label": "乐山"});
        cityList.push({"code": 395, "label": "南充"});
        cityList.push({"code": 396, "label": "眉山"});
        cityList.push({"code": 397, "label": "宜宾"});
        cityList.push({"code": 398, "label": "广安"});
        cityList.push({"code": 399, "label": "达州"});
        cityList.push({"code": 400, "label": "雅安"});
        cityList.push({"code": 401, "label": "巴中"});
        cityList.push({"code": 402, "label": "资阳"});
        cityList.push({"code": 403, "label": "阿坝藏族羌族自治州"});
        cityList.push({"code": 404, "label": "甘孜藏族自治州"});
        cityList.push({"code": 405, "label": "凉山彝族自治州"});
    } else if(provinceCode == 24){
        // 贵州
        cityList.push({"code": 406, "label": "贵阳"});
        cityList.push({"code": 407, "label": "六盘水"});
        cityList.push({"code": 408, "label": "遵义"});
        cityList.push({"code": 409, "label": "安顺"});
        cityList.push({"code": 410, "label": "铜仁地区"});
        cityList.push({"code": 411, "label": "黔西南布依族苗族自治州"});
        cityList.push({"code": 412, "label": "毕节地区"});
        cityList.push({"code": 413, "label": "黔东南苗族侗族自治州"});
        cityList.push({"code": 414, "label": "黔南布依族苗族自治州"});
    } else if(provinceCode == 25){
        // 云南
        cityList.push({"code": 415, "label": "昆明"});
        cityList.push({"code": 416, "label": "曲靖"});
        cityList.push({"code": 417, "label": "玉溪"});
        cityList.push({"code": 418, "label": "保山"});
        cityList.push({"code": 419, "label": "昭通"});
        cityList.push({"code": 420, "label": "丽江"});
        cityList.push({"code": 421, "label": "思茅"});
        cityList.push({"code": 422, "label": "临沧"});
        cityList.push({"code": 423, "label": "楚雄彝族自治州"});
        cityList.push({"code": 424, "label": "红河哈尼族彝族自治州"});
        cityList.push({"code": 425, "label": "文山壮族苗族自治州"});
        cityList.push({"code": 426, "label": "西双版纳傣族自治州"});
        cityList.push({"code": 427, "label": "大理白族自治州"});
        cityList.push({"code": 428, "label": "德宏傣族景颇族自治州"});
        cityList.push({"code": 429, "label": "怒江傈僳族自治州"});
        cityList.push({"code": 430, "label": "迪庆藏族自治州"});
    } else if(provinceCode == 26){
        // 西藏
        cityList.push({"code": 431, "label": "拉萨"});
        cityList.push({"code": 432, "label": "昌都地区"});
        cityList.push({"code": 433, "label": "山南地区"});
        cityList.push({"code": 434, "label": "日喀则地区"});
        cityList.push({"code": 435, "label": "那曲地区"});
        cityList.push({"code": 436, "label": "阿里地区"});
        cityList.push({"code": 437, "label": "林芝地区"});
    } else if(provinceCode == 27){
        // 陕西
        cityList.push({"code": 438, "label": "西安"});
        cityList.push({"code": 439, "label": "铜川"});
        cityList.push({"code": 440, "label": "宝鸡"});
        cityList.push({"code": 441, "label": "咸阳"});
        cityList.push({"code": 442, "label": "渭南"});
        cityList.push({"code": 443, "label": "延安"});
        cityList.push({"code": 444, "label": "汉中"});
        cityList.push({"code": 445, "label": "榆林"});
        cityList.push({"code": 446, "label": "安康"});
        cityList.push({"code": 447, "label": "商洛"});
    } else if(provinceCode == 28){
        // 甘肃
        cityList.push({"code": 448, "label": "兰州"});
        cityList.push({"code": 449, "label": "嘉峪关"});
        cityList.push({"code": 450, "label": "金昌"});
        cityList.push({"code": 451, "label": "白银"});
        cityList.push({"code": 452, "label": "天水"});
        cityList.push({"code": 453, "label": "武威"});
        cityList.push({"code": 454, "label": "张掖"});
        cityList.push({"code": 455, "label": "平凉"});
        cityList.push({"code": 456, "label": "酒泉"});
        cityList.push({"code": 457, "label": "庆阳"});
        cityList.push({"code": 458, "label": "定西"});
        cityList.push({"code": 459, "label": "陇南"});
        cityList.push({"code": 460, "label": "临夏回族自治州"});
        cityList.push({"code": 461, "label": "甘南藏族自治州"});
    } else if(provinceCode == 29){
        // 青海
        cityList.push({"code": 462, "label": "西宁"});
        cityList.push({"code": 463, "label": "海东地区"});
        cityList.push({"code": 464, "label": "海北藏族自治州"});
        cityList.push({"code": 465, "label": "黄南藏族自治州"});
        cityList.push({"code": 466, "label": "海南藏族自治州"});
        cityList.push({"code": 467, "label": "果洛藏族自治州"});
        cityList.push({"code": 468, "label": "玉树藏族自治州"});
        cityList.push({"code": 469, "label": "海西蒙古族藏族自治州"});
    } else if(provinceCode == 30){
        // 宁夏
        cityList.push({"code": 470, "label": "银川"});
        cityList.push({"code": 471, "label": "石嘴山"});
        cityList.push({"code": 472, "label": "吴忠"});
        cityList.push({"code": 473, "label": "固原"});
        cityList.push({"code": 474, "label": "中卫"});
    } else if(provinceCode == 31){
        // 新疆
        cityList.push({"code": 475, "label": "乌鲁木齐"});
        cityList.push({"code": 476, "label": "克拉玛依"});
        cityList.push({"code": 477, "label": "吐鲁番地区"});
        cityList.push({"code": 478, "label": "哈密地区"});
        cityList.push({"code": 479, "label": "昌吉回族自治州"});
        cityList.push({"code": 480, "label": "博尔塔拉蒙古自治州"});
        cityList.push({"code": 481, "label": "巴音郭楞蒙古自治州"});
        cityList.push({"code": 482, "label": "阿克苏地区"});
        cityList.push({"code": 483, "label": "克孜勒苏柯尔克孜自治州"});
        cityList.push({"code": 484, "label": "喀什地区"});
        cityList.push({"code": 485, "label": "和田地区"});
        cityList.push({"code": 486, "label": "伊犁哈萨克自治州"});
        cityList.push({"code": 487, "label": "塔城地区"});
        cityList.push({"code": 488, "label": "阿勒泰地区"});
        cityList.push({"code": 489, "label": "石河子"});
        cityList.push({"code": 490, "label": "阿拉尔"});
        cityList.push({"code": 491, "label": "图木舒克"});
        cityList.push({"code": 492, "label": "五家渠"});
    } else if(provinceCode == 32){
        // 台湾
        cityList.push({"code": 493, "label": "台北"});
        cityList.push({"code": 494, "label": "高雄"});
        cityList.push({"code": 495, "label": "基隆"});
        cityList.push({"code": 496, "label": "台中"});
        cityList.push({"code": 497, "label": "台南"});
        cityList.push({"code": 498, "label": "新竹"});
        cityList.push({"code": 499, "label": "嘉义"});
        cityList.push({"code": 500, "label": "台北县"});
        cityList.push({"code": 501, "label": "宜兰县"});
        cityList.push({"code": 502, "label": "桃园县"});
        cityList.push({"code": 503, "label": "新竹县"});
        cityList.push({"code": 504, "label": "苗栗县"});
        cityList.push({"code": 505, "label": "台中县"});
        cityList.push({"code": 506, "label": "彰化县"});
        cityList.push({"code": 507, "label": "南投县"});
        cityList.push({"code": 508, "label": "云林县"});
        cityList.push({"code": 509, "label": "嘉义县"});
        cityList.push({"code": 510, "label": "台南县"});
        cityList.push({"code": 511, "label": "高雄县"});
        cityList.push({"code": 512, "label": "屏东县"});
        cityList.push({"code": 513, "label": "澎湖县"});
        cityList.push({"code": 514, "label": "台东县"});
        cityList.push({"code": 515, "label": "花莲县"});
    } else if(provinceCode == 33){
        // 香港
        cityList.push({"code": 516, "label": "中西区"});
        cityList.push({"code": 517, "label": "东区"});
        cityList.push({"code": 518, "label": "九龙城区"});
        cityList.push({"code": 519, "label": "观塘区"});
        cityList.push({"code": 520, "label": "南区"});
        cityList.push({"code": 521, "label": "深水埗区"});
        cityList.push({"code": 522, "label": "黄大仙区"});
        cityList.push({"code": 523, "label": "湾仔区"});
        cityList.push({"code": 524, "label": "油尖旺区"});
        cityList.push({"code": 525, "label": "离岛区"});
        cityList.push({"code": 526, "label": "葵青区"});
        cityList.push({"code": 527, "label": "北区"});
        cityList.push({"code": 528, "label": "西贡区"});
        cityList.push({"code": 529, "label": "沙田区"});
        cityList.push({"code": 530, "label": "屯门区"});
        cityList.push({"code": 531, "label": "大埔区"});
        cityList.push({"code": 532, "label": "荃湾区"});
        cityList.push({"code": 533, "label": "元朗区"});
    } else if(provinceCode == 34){
        // 澳门
        cityList.push({"code": 534, "label": "澳门特别行政区"});
    }
    return cityList;
}
