<?php

namespace App\Libraries;

class Address
{
	public function city()
	{
		$city = <<<Cityarea
			<option value="">縣市</option>
			<option value="基隆市">基隆市</option>
			<option value="台北市">台北市</option>
			<option value="新北市">新北市</option>
			<option value="桃園市">桃園市</option>
			<option value="新竹市">新竹市</option>
			<option value="新竹縣">新竹縣</option>
			<option value="宜蘭縣">宜蘭縣</option>
			<option value="苗栗縣">苗栗縣</option>
			<option value="台中市">台中市</option>
			<option value="彰化縣">彰化縣</option>
			<option value="南投縣">南投縣</option>
			<option value="雲林縣">雲林縣</option>
			<option value="嘉義市">嘉義市</option>
			<option value="嘉義縣">嘉義縣</option>
			<option value="台南市">台南市</option>
			<option value="高雄市">高雄市</option>
			<option value="屏東縣">屏東縣</option>
			<option value="澎湖縣">澎湖縣</option>
			<option value="花蓮縣">花蓮縣</option>
			<option value="台東縣">台東縣</option>
			<option value="連江縣">連江縣</option>
			<option value="金門縣">金門縣</option>
			<option value="海外">海外</option>
Cityarea;
		
		return $city;
	}
	
	public function town( $city = '' )
	{
        $location = '';
		
		switch( $city )
        {
            case '基隆市':
            $location = <<<kilong
                <option value="">區域</option>
                <option value="200#$#仁愛區">仁愛區</option>	
                <option value="201#$#信義區">信義區</option>	
                <option value="202#$#中正區">中正區</option>	
                <option value="203#$#中山區">中山區</option>	
                <option value="204#$#安樂區">安樂區</option>	
                <option value="205#$#暖暖區">暖暖區</option>	
                <option value="206#$#七堵區">七堵區</option>	
kilong;
            break;

            case '台北市':
                $location = <<<taipei
                    <option value="">區域</option>
                    <option value="100#$#中正區">中正區</option>
                    <option value="103#$#大同區">大同區</option>
                    <option value="104#$#中山區">中山區</option>
                    <option value="105#$#松山區">松山區</option>
                    <option value="106#$#大安區">大安區</option>
                    <option value="108#$#萬華區">萬華區</option>
                    <option value="110#$#信義區">信義區</option>
                    <option value="111#$#士林區">士林區</option>
                    <option value="112#$#北投區">北投區</option>
                    <option value="114#$#內湖區">內湖區</option>
                    <option value="115#$#南港區">南港區</option>
                    <option value="116#$#文山區">文山區</option>
taipei;
            break;

            case '新北市':
                $location = <<<shin_bay
                    <option value="">區域</option>
                    <option value="207#$#萬里區">萬里區</option>
                    <option value="208#$#金山區">金山區</option>
                    <option value="220#$#板橋區">板橋區</option>
                    <option value="221#$#汐止區">汐止區</option>
                    <option value="222#$#深坑區">深坑區</option>
                    <option value="223#$#石碇區">石碇區</option>
                    <option value="224#$#瑞芳區">瑞芳區</option>
                    <option value="226#$#平溪區">平溪區</option>
                    <option value="227#$#雙溪區">雙溪區</option>
                    <option value="228#$#貢寮區">貢寮區</option>
                    <option value="231#$#新店區">新店區</option>
                    <option value="232#$#坪林區">坪林區</option>
                    <option value="233#$#烏來區">烏來區</option>
                    <option value="234#$#永和區">永和區</option>
                    <option value="235#$#中和區">中和區</option>
                    <option value="236#$#土城區">土城區</option>
                    <option value="237#$#三峽區">三峽區</option>
                    <option value="238#$#樹林區">樹林區</option>
                    <option value="239#$#鶯歌區">鶯歌區</option>
                    <option value="241#$#三重區">三重區</option>
                    <option value="242#$#新莊區">新莊區</option>
                    <option value="243#$#泰山區">泰山區</option>
                    <option value="244#$#林口區">林口區</option>
                    <option value="247#$#蘆洲區">蘆洲區</option>
                    <option value="248#$#五股區">五股區</option>
                    <option value="249#$#八里區">八里區</option>
                    <option value="251#$#淡水區">淡水區</option>
                    <option value="252#$#三芝區">三芝區</option>
                    <option value="253#$#石門區">石門區</option>
shin_bay;
            break;

            case '桃園市':
                $location = <<<tou_yuan
                    <option value="">區域</option>
                    <option value="320#$#中壢區">中壢區</option>
                    <option value="324#$#平鎮區">平鎮區</option>
                    <option value="325#$#龍潭區">龍潭區</option>
                    <option value="326#$#楊梅區">楊梅區</option>
                    <option value="327#$#新屋區">新屋區</option>
                    <option value="328#$#觀音區">觀音區</option>
                    <option value="330#$#桃園區">桃園區</option>
                    <option value="333#$#龜山區">龜山區</option>
                    <option value="334#$#八德區">八德區</option>
                    <option value="335#$#大溪區">大溪區</option>
                    <option value="336#$#復興區">復興區</option>
                    <option value="337#$#大園區">大園區</option>
                    <option value="338#$#蘆竹區">蘆竹區</option>
tou_yuan;
            break;

            case '新竹市':
                $location = <<<shin_ju_city
                    <option value="">區域</option>
                    <option value="300#$#東區">東區</option>
                    <option value="300#$#北區">北區</option>
                    <option value="300#$#香山區">香山區</option>
shin_ju_city;
            break;

            case '新竹縣':
                $location = <<<shin_ju_shan
                    <option value="">區域</option>
                    <option value="302#$#竹北市">竹北市</option>
                    <option value="303#$#湖口鄉">湖口鄉</option>
                    <option value="304#$#新豐鄉">新豐鄉</option>
                    <option value="305#$#新埔鎮">新埔鎮</option>
                    <option value="306#$#關西鎮">關西鎮</option>
                    <option value="307#$#芎林鄉">芎林鄉</option>
                    <option value="308#$#寶山鄉">寶山鄉</option>
                    <option value="310#$#竹東鎮">竹東鎮</option>
                    <option value="311#$#五峰鄉">五峰鄉</option>
                    <option value="312#$#橫山鄉">橫山鄉</option>
                    <option value="313#$#尖石鄉">尖石鄉</option>
                    <option value="314#$#北埔鄉">北埔鄉</option>
                    <option value="315#$#峨眉鄉">峨眉鄉</option>
shin_ju_shan;
            break;

            case '苗栗縣';
                $location = <<<meow_li
                    <option value="">區域</option>
                    <option value="350#$#竹南鎮">竹南鎮</option>
                    <option value="351#$#頭份市">頭份市</option>
                    <option value="352#$#三灣鄉">三灣鄉</option>
                    <option value="353#$#南庄鄉">南庄鄉</option>
                    <option value="354#$#獅潭鄉">獅潭鄉</option>
                    <option value="356#$#後龍鎮">後龍鎮</option>
                    <option value="357#$#通霄鎮">通霄鎮</option>
                    <option value="358#$#苑裡鎮">苑裡鎮</option>
                    <option value="360#$#苗栗市">苗栗市</option>
                    <option value="361#$#造橋鄉">造橋鄉</option>
                    <option value="362#$#頭屋鄉">頭屋鄉</option>
                    <option value="363#$#公館鄉">公館鄉</option>
                    <option value="364#$#大湖鄉">大湖鄉</option>
                    <option value="365#$#泰安鄉">泰安鄉</option>
                    <option value="366#$#銅鑼鄉">銅鑼鄉</option>
                    <option value="367#$#三義鄉">三義鄉</option>
                    <option value="368#$#西湖鄉">西湖鄉</option>
                    <option value="369#$#卓蘭鎮">卓蘭鎮</option>
meow_li;
            break;

            case '台中市':
                $location = <<<taichung
                    <option value="">區域</option>
                    <option value="400#$#中區">中區</option>
                    <option value="401#$#東區">東區</option>
                    <option value="402#$#南區">南區</option>
                    <option value="403#$#西區">西區</option>
                    <option value="404#$#北區">北區</option>
                    <option value="406#$#北屯區">北屯區</option>
                    <option value="407#$#西屯區">西屯區</option>
                    <option value="408#$#南屯區">南屯區</option>
                    <option value="411#$#太平區">太平區</option>
                    <option value="412#$#大里區">大里區</option>
                    <option value="413#$#霧峰區">霧峰區</option>
                    <option value="414#$#烏日區">烏日區</option>
                    <option value="420#$#豐原區">豐原區</option>
                    <option value="421#$#后里區">后里區</option>
                    <option value="422#$#石岡區">石岡區</option>
                    <option value="423#$#東勢區">東勢區</option>
                    <option value="424#$#和平區">和平區</option>
                    <option value="426#$#新社區">新社區</option>
                    <option value="427#$#潭子區">潭子區</option>
                    <option value="428#$#大雅區">大雅區</option>
                    <option value="429#$#神岡區">神岡區</option>
                    <option value="432#$#大肚區">大肚區</option>
                    <option value="433#$#沙鹿區">沙鹿區</option>
                    <option value="434#$#龍井區">龍井區</option>
                    <option value="435#$#梧棲區">梧棲區</option>
                    <option value="436#$#清水區">清水區</option>
                    <option value="437#$#大甲區">大甲區</option>
                    <option value="438#$#外埔區">外埔區</option>
                    <option value="439#$#大安區">大安區</option>
taichung;
            break;

            case '彰化縣':
                $location = <<<dran_hwa
                    <option value="">區域</option>
                    <option value="500#$#彰化市">彰化市</option>
                    <option value="502#$#芬園鄉">芬園鄉</option>
                    <option value="503#$#花壇鄉">花壇鄉</option>
                    <option value="504#$#秀水鄉">秀水鄉</option>
                    <option value="505#$#鹿港鎮">鹿港鎮</option>
                    <option value="506#$#福興鄉">福興鄉</option>
                    <option value="507#$#線西鄉">線西鄉</option>
                    <option value="508#$#和美鎮">和美鎮</option>
                    <option value="509#$#伸港鄉">伸港鄉</option>
                    <option value="510#$#員林市">員林市</option>
                    <option value="511#$#社頭鄉">社頭鄉</option>
                    <option value="512#$#永靖鄉">永靖鄉</option>
                    <option value="513#$#埔心鄉">埔心鄉</option>
                    <option value="514#$#溪湖鎮">溪湖鎮</option>
                    <option value="515#$#大村鄉">大村鄉</option>
                    <option value="516#$#埔鹽鄉">埔鹽鄉</option>
                    <option value="520#$#田中鎮">田中鎮</option>
                    <option value="521#$#北斗鎮">北斗鎮</option>
                    <option value="522#$#田尾鄉">田尾鄉</option>
                    <option value="523#$#埤頭鄉">埤頭鄉</option>
                    <option value="524#$#溪州鄉">溪州鄉</option>
                    <option value="525#$#竹塘鄉">竹塘鄉</option>
                    <option value="526#$#二林鎮">二林鎮</option>
                    <option value="527#$#大城鄉">大城鄉</option>
                    <option value="528#$#芳苑鄉">芳苑鄉</option>
                    <option value="530#$#二水鄉">二水鄉</option>
dran_hwa;
            break;

            case '南投縣':
                $location = <<<nan_to
                    <option value="">區域</option>
                    <option value="540#$#南投市">南投市</option>
                    <option value="541#$#中寮鄉">中寮鄉</option>
                    <option value="542#$#草屯鎮">草屯鎮</option>
                    <option value="544#$#國姓鄉">國姓鄉</option>
                    <option value="545#$#埔里鎮">埔里鎮</option>
                    <option value="546#$#仁愛鄉">仁愛鄉</option>
                    <option value="551#$#名間鄉">名間鄉</option>
                    <option value="552#$#集集鎮">集集鎮</option>
                    <option value="553#$#水里鄉">水里鄉</option>
                    <option value="555#$#魚池鄉">魚池鄉</option>
                    <option value="556#$#信義鄉">信義鄉</option>
                    <option value="557#$#竹山鎮">竹山鎮</option>
                    <option value="558#$#鹿谷鄉">鹿谷鄉</option>
nan_to;
            break;

            case '雲林縣':
                $location = <<<yun_lin
                    <option value="">區域</option>
                    <option value="630#$#斗南鎮">斗南鎮</option>
                    <option value="631#$#大埤鄉">大埤鄉</option>
                    <option value="632#$#虎尾鎮">虎尾鎮</option>
                    <option value="633#$#土庫鎮">土庫鎮</option>
                    <option value="634#$#褒忠鄉">褒忠鄉</option>
                    <option value="635#$#東勢鄉">東勢鄉</option>
                    <option value="636#$#台西鄉">台西鄉</option>
                    <option value="637#$#崙背鄉">崙背鄉</option>
                    <option value="638#$#麥寮鄉">麥寮鄉</option>
                    <option value="640#$#斗六市">斗六市</option>
                    <option value="643#$#林內鄉">林內鄉</option>
                    <option value="646#$#古坑鄉">古坑鄉</option>
                    <option value="647#$#莿桐鄉">莿桐鄉</option>
                    <option value="648#$#西螺鎮">西螺鎮</option>
                    <option value="649#$#二崙鄉">二崙鄉</option>
                    <option value="651#$#北港鎮">北港鎮</option>
                    <option value="652#$#水林鄉">水林鄉</option>
                    <option value="653#$#口湖鄉">口湖鄉</option>
                    <option value="654#$#四湖鄉">四湖鄉</option>
                    <option value="655#$#元長鄉">元長鄉</option>
yun_lin;
            break;

            case '嘉義市':
                $location = <<<ja_yi_city
                    <option value="">區域</option>
                    <option value="600#$#東區">東區</option>
                    <option value="600#$#西區">西區</option>
ja_yi_city;
            break;

            case '嘉義縣':
                $location = <<<ja_yi
                    <option value="">區域</option>
                    <option value="602#$#番路鄉">番路鄉</option>
                    <option value="603#$#梅山鄉">梅山鄉</option>
                    <option value="604#$#竹崎鄉">竹崎鄉</option>
                    <option value="605#$#阿里山鄉">阿里山鄉</option>
                    <option value="606#$#中埔鄉">中埔鄉</option>
                    <option value="607#$#大埔鄉">大埔鄉</option>
                    <option value="608#$#水上鄉">水上鄉</option>
                    <option value="611#$#鹿草鄉">鹿草鄉</option>
                    <option value="612#$#太保市">太保市</option>
                    <option value="613#$#朴子市">朴子市</option>
                    <option value="614#$#東石鄉">東石鄉</option>
                    <option value="615#$#六腳鄉">六腳鄉</option>
                    <option value="616#$#新港鄉">新港鄉</option>
                    <option value="621#$#民雄鄉">民雄鄉</option>
                    <option value="622#$#大林鎮">大林鎮</option>
                    <option value="623#$#溪口鄉">溪口鄉</option>
                    <option value="624#$#義竹鄉">義竹鄉</option>
                    <option value="625#$#布袋鎮">布袋鎮</option>
ja_yi;
            break;

            case '台南市':
                $location = <<<tai_nan
                    <option value="">區域</option>
                    <option value="700#$#中西區">中西區</option>
                    <option value="701#$#東區">東區</option>
                    <option value="702#$#南區">南區</option>
                    <option value="704#$#北區">北區</option>
                    <option value="708#$#安平區">安平區</option>
                    <option value="709#$#安南區">安南區</option>
                    <option value="710#$#永康區">永康區</option>
                    <option value="711#$#歸仁區">歸仁區</option>
                    <option value="712#$#新化區">新化區</option>
                    <option value="713#$#左鎮區">左鎮區</option>
                    <option value="714#$#玉井區">玉井區</option>
                    <option value="715#$#楠西區">楠西區</option>
                    <option value="716#$#南化區">南化區</option>
                    <option value="717#$#仁德區">仁德區</option>
                    <option value="718#$#關廟區">關廟區</option>
                    <option value="719#$#龍崎區">龍崎區</option>
                    <option value="720#$#官田區">官田區</option>
                    <option value="721#$#麻豆區">麻豆區</option>
                    <option value="722#$#佳里區">佳里區</option>
                    <option value="723#$#西港區">西港區</option>
                    <option value="724#$#七股區">七股區</option>
                    <option value="725#$#將軍區">將軍區</option>
                    <option value="726#$#學甲區">學甲區</option>
                    <option value="727#$#北門區">北門區</option>
                    <option value="730#$#新營區">新營區</option>
                    <option value="731#$#後壁區">後壁區</option>
                    <option value="732#$#白河區">白河區</option>
                    <option value="733#$#東山區">東山區</option>
                    <option value="734#$#六甲區">六甲區</option>
                    <option value="735#$#下營區">下營區</option>
                    <option value="736#$#柳營區">柳營區</option>
                    <option value="737#$#鹽水區">鹽水區</option>
                    <option value="741#$#善化區">善化區</option>
                    <option value="742#$#大內區">大內區</option>
                    <option value="743#$#山上區">山上區</option>
                    <option value="744#$#新市區">新市區</option>
                    <option value="745#$#安定區">安定區</option>
tai_nan;
            break;

            case '高雄市':
                $location = <<<gou_shon
                    <option value="">區域</option>
                    <option value="800#$#新興區">新興區</option>
                    <option value="801#$#前金區">前金區</option>
                    <option value="802#$#苓雅區">苓雅區</option>
                    <option value="803#$#鹽埕區">鹽埕區</option>
                    <option value="804#$#鼓山區">鼓山區</option>
                    <option value="805#$#旗津區">旗津區</option>
                    <option value="806#$#前鎮區">前鎮區</option>
                    <option value="807#$#三民區">三民區</option>
                    <option value="811#$#楠梓區">楠梓區</option>
                    <option value="812#$#小港區">小港區</option>
                    <option value="813#$#左營區">左營區</option>
                    <option value="814#$#仁武區">仁武區</option>
                    <option value="815#$#大社區">大社區</option>
                    <option value="817#$#東沙群島">東沙群島</option>
                    <option value="819#$#南沙群島">南沙群島</option>
                    <option value="820#$#岡山區">岡山區</option>
                    <option value="821#$#路竹區">路竹區</option>
                    <option value="822#$#阿蓮區">阿蓮區</option>
                    <option value="823#$#田寮區">田寮區</option>
                    <option value="824#$#燕巢區">燕巢區</option>
                    <option value="825#$#橋頭區">橋頭區</option>
                    <option value="826#$#梓官區">梓官區</option>
                    <option value="827#$#彌陀區">彌陀區</option>
                    <option value="828#$#永安區">永安區</option>
                    <option value="829#$#湖內區">湖內區</option>
                    <option value="830#$#鳳山區">鳳山區</option>
                    <option value="831#$#大寮區">大寮區</option>
                    <option value="832#$#林園區">林園區</option>
                    <option value="833#$#鳥松區">鳥松區</option>
                    <option value="840#$#大樹區">大樹區</option>
                    <option value="842#$#旗山區">旗山區</option>
                    <option value="843#$#美濃區">美濃區</option>
                    <option value="844#$#六龜區">六龜區</option>
                    <option value="845#$#內門區">內門區</option>
                    <option value="846#$#杉林區">杉林區</option>
                    <option value="847#$#甲仙區">甲仙區</option>
                    <option value="848#$#桃源區">桃源區</option>
                    <option value="849#$#那瑪夏區">那瑪夏區</option>
                    <option value="851#$#茂林區">茂林區</option>
                    <option value="852#$#茄萣區">茄萣區</option>
gou_shon;
            break;

            case '屏東縣':
                $location = <<<pin_dong
                    <option value="">區域</option>
                    <option value="900#$#屏東市">屏東市</option>
                    <option value="901#$#三地門鄉">三地門鄉</option>
                    <option value="902#$#霧台鄉">霧台鄉</option>
                    <option value="903#$#瑪家鄉">瑪家鄉</option>
                    <option value="904#$#九如鄉">九如鄉</option>
                    <option value="905#$#里港鄉">里港鄉</option>
                    <option value="906#$#高樹鄉">高樹鄉</option>
                    <option value="907#$#鹽埔鄉">鹽埔鄉</option>
                    <option value="908#$#長治鄉">長治鄉</option>
                    <option value="909#$#麟洛鄉">麟洛鄉</option>
                    <option value="911#$#竹田鄉">竹田鄉</option>
                    <option value="912#$#內埔鄉">內埔鄉</option>
                    <option value="913#$#萬丹鄉">萬丹鄉</option>
                    <option value="920#$#潮州鎮">潮州鎮</option>
                    <option value="921#$#泰武鄉">泰武鄉</option>
                    <option value="922#$#來義鄉">來義鄉</option>
                    <option value="923#$#萬巒鄉">萬巒鄉</option>
                    <option value="924#$#崁頂鄉">崁頂鄉</option>
                    <option value="925#$#新埤鄉">新埤鄉</option>
                    <option value="926#$#南州鄉">南州鄉</option>
                    <option value="927#$#林邊鄉">林邊鄉</option>
                    <option value="928#$#東港鎮">東港鎮</option>
                    <option value="929#$#琉球鄉">琉球鄉</option>
                    <option value="931#$#佳冬鄉">佳冬鄉</option>
                    <option value="932#$#新園鄉">新園鄉</option>
                    <option value="940#$#枋寮鄉">枋寮鄉</option>
                    <option value="941#$#枋山鄉">枋山鄉</option>
                    <option value="942#$#春日鄉">春日鄉</option>
                    <option value="943#$#獅子鄉">獅子鄉</option>
                    <option value="944#$#車城鄉">車城鄉</option>
                    <option value="945#$#牡丹鄉">牡丹鄉</option>
                    <option value="946#$#恆春鎮">恆春鎮</option>
                    <option value="947#$#滿州鄉">滿州鄉</option>
pin_dong;
            break;

            case '台東縣':
                $location = <<<tai_dong
                    <option value="">區域</option>
                    <option value="950#$#台東市">台東市</option>
                    <option value="951#$#綠島鄉">綠島鄉</option>
                    <option value="952#$#蘭嶼鄉">蘭嶼鄉</option>
                    <option value="953#$#延平鄉">延平鄉</option>
                    <option value="954#$#卑南鄉">卑南鄉</option>
                    <option value="955#$#鹿野鄉">鹿野鄉</option>
                    <option value="956#$#關山鎮">關山鎮</option>
                    <option value="957#$#海端鄉">海端鄉</option>
                    <option value="958#$#池上鄉">池上鄉</option>
                    <option value="959#$#東河鄉">東河鄉</option>
                    <option value="961#$#成功鎮">成功鎮</option>
                    <option value="962#$#長濱鄉">長濱鄉</option>
                    <option value="963#$#太麻里鄉">太麻里鄉</option>
                    <option value="964#$#金峰鄉">金峰鄉</option>
                    <option value="965#$#大武鄉">大武鄉</option>
                    <option value="966#$#達仁鄉">達仁鄉</option>
tai_dong;
            break;

            case '花蓮縣':
                $location = <<<hwa_lian
                    <option value="">區域</option>
                    <option value="970#$#花蓮市">花蓮市</option>
                    <option value="971#$#新城鄉">新城鄉</option>
                    <option value="972#$#秀林鄉">秀林鄉</option>
                    <option value="973#$#吉安鄉">吉安鄉</option>
                    <option value="974#$#壽豐鄉">壽豐鄉</option>
                    <option value="975#$#鳳林鎮">鳳林鎮</option>
                    <option value="976#$#光復鄉">光復鄉</option>
                    <option value="977#$#豐濱鄉">豐濱鄉</option>
                    <option value="978#$#瑞穗鄉">瑞穗鄉</option>
                    <option value="979#$#萬榮鄉">萬榮鄉</option>
                    <option value="981#$#玉里鎮">玉里鎮</option>
                    <option value="982#$#卓溪鄉">卓溪鄉</option>
                    <option value="983#$#富里鄉">富里鄉</option>
hwa_lian;
            break;

            case '宜蘭縣':
                $location = <<<yi_lian
                    <option value="">區域</option>
                    <option value="260#$#宜蘭市">宜蘭市</option>
                    <option value="261#$#頭城鎮">頭城鎮</option>
                    <option value="262#$#礁溪鄉">礁溪鄉</option>
                    <option value="263#$#壯圍鄉">壯圍鄉</option>
                    <option value="264#$#員山鄉">員山鄉</option>
                    <option value="265#$#羅東鎮">羅東鎮</option>
                    <option value="266#$#三星鄉">三星鄉</option>
                    <option value="267#$#大同鄉">大同鄉</option>
                    <option value="268#$#五結鄉">五結鄉</option>
                    <option value="269#$#冬山鄉">冬山鄉</option>
                    <option value="270#$#蘇澳鎮">蘇澳鎮</option>
                    <option value="272#$#南澳鄉">南澳鄉</option>
                    <option value="290#$#釣魚台">釣魚台</option>
yi_lian;
            break;

            case '澎湖縣':
                $location = <<<pon_hoo
                    <option value="">區域</option>
                    <option value="880#$#馬公市">馬公市</option>
                    <option value="881#$#西嶼鄉">西嶼鄉</option>
                    <option value="882#$#望安鄉">望安鄉</option>
                    <option value="883#$#七美鄉">七美鄉</option>
                    <option value="884#$#白沙鄉">白沙鄉</option>
                    <option value="885#$#湖西鄉">湖西鄉</option>
pon_hoo;
            break;

            case '金門縣':
                $location = <<<jin_mon
                    <option value="">區域</option>
                    <option value="890#$#金沙鎮">金沙鎮</option>
                    <option value="891#$#金湖鎮">金湖鎮</option>
                    <option value="892#$#金寧鄉">金寧鄉</option>
                    <option value="893#$#金城鎮">金城鎮</option>
                    <option value="894#$#烈嶼鄉">烈嶼鄉</option>
                    <option value="896#$#烏坵鄉">烏坵鄉</option>
jin_mon;
            break;

            case '連江縣':
                $location = <<<lian_jan
                    <option value="">區域</option>
                    <option value="209#$#南竿鄉">南竿鄉</option>
                    <option value="210#$#北竿鄉">北竿鄉</option>
                    <option value="211#$#莒光鄉">莒光鄉</option>
                    <option value="212#$#東引鄉">東引鄉</option>
lian_jan;
            break;
                
            case '海外':
                $location = <<<sea
                    <option value="海外">海外</option>
sea;
            break;
                
            default:
                $location = '<option value="">區域</option>';
            break;
        }
		
		
        return $location;
	}
}