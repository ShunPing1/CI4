// 處理主選單按鈕的 active
function do_main_navi_active( navi1, navi2 )
{	
	var navi_1 = navi1 - 1;
	var navi_2 = navi2 - 1;
	
	$('.m-menu__item--tabs:eq(' + navi_1 + ')').addClass('m-menu__item--active').addClass('m-menu__item--active-tab');
	
	$('.m-menu__subnav:eq(' + navi_1 + ')').find('li:eq(' + navi_2 + ')').addClass('m-menu__item--active');
}  