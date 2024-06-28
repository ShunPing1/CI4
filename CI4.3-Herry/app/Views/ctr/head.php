<!DOCTYPE html>

<html lang="tw" >
	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>
			<?php echo $_SERVER['GS_ENVIRONMENT']['headTitle']; ?>
		</title>
		<meta name="description" content="">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Cache-Control" content="no-cache" />
		<meta http-equiv="Expires" content="0" />
		
		<base href="<?php echo base_url(); ?>">
		
		<script src="ctr/js/jquery.min.js"></script>
		<!-- <script src="js/bootstrap.min.js"></script> -->
		<script src="ctr/js/js.js"></script>
		
        <!--begin::Base Styles -->  
        <!--begin::Page Vendors -->
		<!-- <link href="css/bootstrap.css" rel="stylesheet" type="text/css"> -->
		<!--<link href="ctr/vassets/endors/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />-->
		<!--end::Page Vendors -->
		<link href="ctr/assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />
		<link href="ctr/assets/demo/demo10/base/style.bundle.css" rel="stylesheet" type="text/css" />
		
		<link rel="icon" type="image/png" sizes="16x16" href="ctr/imgs/favicon.ico">
		<link href="ctr/css/gs.css" rel="stylesheet" type="text/css" />
		<!--end::Base Styles -->
		
		<!-- dropify upload -->
		<link rel="stylesheet" href="ctr/plugins/bower_components/dropify/dist/css/dropify.min.css">
		<?php
		/*
		<!-- Jquery UI -->
		<link rel="stylesheet" href="ctr/assets/vendors/custom/jquery-ui/jquery-ui.bundle.css">
		
		<!-- time picker -->
		<link rel="stylesheet" href="ctr/plugins/bower_components/clockpicker/dist/jquery-clockpicker.css">
		*/
		?>
		<!-- cropper -->
        <link rel="stylesheet" href="ctr/plugins/cropper/css/cropper.css">
        <link rel="stylesheet" href="ctr/plugins/cropper/css/main.css">
        
		<!--begin::Base Scripts -->
		<script src="ctr/assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
		<script src="ctr/assets/demo/demo10/base/scripts.bundle.js" type="text/javascript"></script>
        <?php
        /*
		<script src="ctr/assets/vendors/custom/jquery-ui/jquery-ui.bundle.js" type="text/javascript"></script>
		*/
		?>
		<!--end::Base Scripts -->   
        <!--begin::Page Vendors -->
		<script src="ctr/assets/vendors/custom/fullcalendar/fullcalendar.bundle.js" type="text/javascript"></script>
		<!--end::Page Vendors -->  
        <!--begin::Page Snippets -->
		<script src="ctr/assets/app/js/dashboard.js" type="text/javascript"></script>
		<!--end::Page Snippets -->
		<?php
        /*
		<!-- time picker -->
		<script src="ctr/plugins/bower_components/clockpicker/dist/jquery-clockpicker.js"></script>
		*/
		?>
        <!-- begin::Page Loader -->
		<script>
            $(window).on('load', function() {
                $('body').removeClass('m-page--loading');         
            });
		</script>
		<!-- end::Page Loader -->

		 <!-- dropify upload -->
    	<script src="ctr/plugins/bower_components/dropify/dist/js/dropify.min.js"></script>
    
		<script src="ckeditor/ckeditor.js?<?php echo time(); ?>"></script>
		
		 <!-- cropper -->
        <script src="ctr/plugins/cropper/js/cropper.js"></script>
	
		 <!-- bpopup -->
        <script src="ctr/js/jquery.bpopup.js"></script>
		
		 <!-- geyes cropper -->
        <script src="ctr/js/crop_img.js"></script>
        
		 <!-- sweetalert2 -->
        <script src="ctr/js/sweetalert2.js"></script>
    <!--
        <script src="ctr/plugins/cropper/js/main.js"></script>-->
	</head>
	<!-- end::Head -->
	
    <!-- begin::Body -->
	<body  class="m-page--fluid m-page--loading-enabled m-page--loading m-header--fixed m-header--fixed-mobile m-footer--push m-aside--offcanvas-default" >
		
		<!-- begin::Page loader -->
		<div class="m-page-loader m-page-loader--base">
			<div class="m-blockui">
				<span>
					讀取中...
				</span>
				<span>
					<div class="m-loader m-loader--brand"></div>
				</span>
			</div>
		</div>
		<!-- end::Page Loader -->        
    	<!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">
			<!-- begin::Header -->
			<header id="m_header" class="m-grid__item m-header "  m-minimize="minimize" m-minimize-mobile="minimize" m-minimize-offset="10" m-minimize-mobile-offset="10" >
				<div class="m-header__top">
					<div class="m-container m-container--fluid m-container--full-height m-page__container">
						<div class="m-stack m-stack--ver m-stack--desktop">
							<!-- begin::Brand -->
							<div class="m-stack__item m-brand m-stack__item--left">
								<div class="m-stack m-stack--ver m-stack--general m-stack--inline">
									<div class="m-stack__item m-stack__item--middle m-brand__logo">
										<a class="m-brand__logo-wrapper" style="font-size: 2em;color: #5867dd;">
											<div class="m-brand__logo-desktop">
												<?php echo $_SERVER['GS_ENVIRONMENT']['menuTitle']; ?>
											</div>
											<!--
											<img alt="" src="assets/demo/demo10/media/img/logo/logo.png" class="m-brand__logo-desktop"/>
											<img alt="" src="assets/demo/demo10/media/img/logo/logo_mini.png" class="m-brand__logo-mobile"/>
											-->
										</a>
									</div>
									<div class="m-stack__item m-stack__item--middle m-brand__tools">
										<div class="mobile_item" style="margin: 1.5em 1em 0 0; font-size: 1.2em;">
											
											系統使用者
										</div>
										
										<!-- begin::Responsive Header Menu Toggler-->
										<a id="m_aside_header_menu_mobile_toggle" href="javascript:;" class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
											<span></span>
										</a>
										<!-- end::Responsive Header Menu Toggler-->
									</div>
								</div>
							</div>
							<!-- end::Brand -->	
							
							<a href="ctr/login/logout">
								<input type="button" class="btn btn-primary float-right pc_item" value="登出" style="margin-top: 1em;">
							</a>
							
							<div class="float-right pc_item" style="margin: 1.5em 1em 0 0; font-size: 1.2em;">
								系統使用者
							</div>
						</div>
					</div>
				</div>
				<div class="m-header__bottom">
					<div class="m-container m-container--fluid m-container--full-height m-page__container">
						<div class="m-stack m-stack--ver m-stack--desktop">
							<!-- begin::Horizontal Menu -->
							
							<div class="m-stack__item m-stack__item--fluid m-header-menu-wrapper">
								<button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-light " id="m_aside_header_menu_mobile_close_btn">
									<i class="la la-close"></i>
								</button>
								<div id="m_header_menu" class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-dark m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-light m-aside-header-menu-mobile--submenu-skin-light "  >
									<ul class="m-menu__nav  m-menu__nav--submenu-arrow " id="main_navi_ul" style="opacity: 0;">
										<li class="m-menu__item m-menu__item--submenu m-menu__item--tabs"  m-menu-submenu-toggle="tab" aria-haspopup="true">
											<a href="javascript:;" class="m-menu__link m-menu__toggle main_menu">
												<span class="m-menu__link-text">
													留言管理
												</span>
												<i class="m-menu__hor-arrow la la-angle-down"></i>
												<i class="m-menu__ver-arrow la la-angle-right"></i>
											</a>
											<div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs">
												<span class="m-menu__arrow m-menu__arrow--adjust"></span>
												<ul class="m-menu__subnav">
													<li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
														<a href="<?php echo base_url(); ?>ctr/contact/ilist" class="m-menu__link ">
															<span class="m-menu__link-text">
																留言管理
															</span>
														</a>
													</li>
													<li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
														<a href="<?php echo base_url(); ?>ctr/contact_navi/ilist" class="m-menu__link ">
															<span class="m-menu__link-text">
																問題類型管理
															</span>
														</a>
													</li>
												</ul>
											</div>
										</li>
										
										<li class="m-menu__item  m-menu__item--submenu m-menu__item--tabs"  m-menu-submenu-toggle="tab" aria-haspopup="true">
											<a href="javascript:;" class="m-menu__link m-menu__toggle main_menu">
												<span class="m-menu__link-text">
													最新消息
												</span>
												<i class="m-menu__hor-arrow la la-angle-down"></i>
												<i class="m-menu__ver-arrow la la-angle-right"></i>
											</a>
											<div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs">
												<span class="m-menu__arrow m-menu__arrow--adjust"></span>
												<ul class="m-menu__subnav">
													<li class="m-menu__item" m-menu-link-redirect="1" aria-haspopup="true">
														<a href="<?php echo base_url(); ?>ctr/news/ilist" class="m-menu__link">
															<span class="m-menu__link-text">
																列表管理
															</span>
														</a>
													</li>
													<li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
														<a href="<?php echo base_url(); ?>ctr/news_navi/ilist" class="m-menu__link ">
															<span class="m-menu__link-text">
																分類管理
															</span>
														</a>
													</li>
												</ul>
											</div>
										</li>
										
										<li class="m-menu__item m-menu__item--submenu m-menu__item--tabs"  m-menu-submenu-toggle="tab" aria-haspopup="true">
											<a href="javascript:;" class="m-menu__link m-menu__toggle main_menu">
												<span class="m-menu__link-text">
													訂購流程
												</span>
												<i class="m-menu__hor-arrow la la-angle-down"></i>
												<i class="m-menu__ver-arrow la la-angle-right"></i>
											</a>
											<div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs">
												<span class="m-menu__arrow m-menu__arrow--adjust"></span>
												<ul class="m-menu__subnav">
													<li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
														<a href="<?php echo base_url(); ?>ctr/cart_process/update_form" class="m-menu__link ">
															<span class="m-menu__link-text">
																訂購流程管理
															</span>
														</a>
													</li>
												</ul>
											</div>
										</li>
										
										<li class="m-menu__item m-menu__item--submenu m-menu__item--tabs"  m-menu-submenu-toggle="tab" aria-haspopup="true">
											<a href="javascript:;" class="m-menu__link m-menu__toggle main_menu">
												<span class="m-menu__link-text">
													常見問題
												</span>
												<i class="m-menu__hor-arrow la la-angle-down"></i>
												<i class="m-menu__ver-arrow la la-angle-right"></i>
											</a>
											<div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs">
												<span class="m-menu__arrow m-menu__arrow--adjust"></span>
												<ul class="m-menu__subnav">
													<li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
														<a href="<?php echo base_url(); ?>ctr/qa_list/ilist" class="m-menu__link ">
															<span class="m-menu__link-text">
																列表管理
															</span>
														</a>
													</li>
												</ul>
											</div>
										</li>
										
										<li class="m-menu__item m-menu__item--submenu m-menu__item--tabs"  m-menu-submenu-toggle="tab" aria-haspopup="true">
											<a href="javascript:;" class="m-menu__link m-menu__toggle main_menu">
												<span class="m-menu__link-text">
													設定教學
												</span>
												<i class="m-menu__hor-arrow la la-angle-down"></i>
												<i class="m-menu__ver-arrow la la-angle-right"></i>
											</a>
											<div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs">
												<span class="m-menu__arrow m-menu__arrow--adjust"></span>
												<ul class="m-menu__subnav">
													<li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
														<a href="<?php echo base_url(); ?>ctr/setting_page/ilist" class="m-menu__link ">
															<span class="m-menu__link-text">
																列表管理
															</span>
														</a>
													</li>
												</ul>
											</div>
										</li>
										
										<li class="m-menu__item m-menu__item--submenu m-menu__item--tabs"  m-menu-submenu-toggle="tab" aria-haspopup="true">
											<a href="javascript:;" class="m-menu__link m-menu__toggle main_menu">
												<span class="m-menu__link-text">
													會員管理
												</span>
												<i class="m-menu__hor-arrow la la-angle-down"></i>
												<i class="m-menu__ver-arrow la la-angle-right"></i>
											</a>
											<div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs">
												<span class="m-menu__arrow m-menu__arrow--adjust"></span>
												<ul class="m-menu__subnav">
													<li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
														<a href="<?php echo base_url(); ?>ctr/member/ilist" class="m-menu__link ">
															<span class="m-menu__link-text">
																會員管理
															</span>
														</a>
													</li>
												</ul>
											</div>
										</li>
										
										<li class="m-menu__item  m-menu__item--submenu m-menu__item--tabs"  m-menu-submenu-toggle="tab" aria-haspopup="true">
											<a href="javascript:;" class="m-menu__link m-menu__toggle main_menu">
												<span class="m-menu__link-text">
													訂單管理
												</span>
												<i class="m-menu__hor-arrow la la-angle-down"></i>
												<i class="m-menu__ver-arrow la la-angle-right"></i>
											</a>
											<div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs">
												<span class="m-menu__arrow m-menu__arrow--adjust"></span>
												<ul class="m-menu__subnav">
													<li class="m-menu__item" m-menu-link-redirect="1" aria-haspopup="true">
														<a href="<?php echo base_url(); ?>ctr/order/ilist" class="m-menu__link">
															<span class="m-menu__link-text">
																列表管理
															</span>
														</a>
													</li>
													<li class="m-menu__item" m-menu-link-redirect="1" aria-haspopup="true">
														<a href="<?php echo base_url(); ?>ctr/shipping/update_form" class="m-menu__link">
															<span class="m-menu__link-text">
																滿額免運管理
															</span>
														</a>
													</li>
												</ul>
											</div>
										</li>
										
										<li class="m-menu__item m-menu__item--submenu m-menu__item--tabs"  m-menu-submenu-toggle="tab" aria-haspopup="true">
											<a href="javascript:;" class="m-menu__link m-menu__toggle main_menu">
												<span class="m-menu__link-text">
													產品列表
												</span>
												<i class="m-menu__hor-arrow la la-angle-down"></i>
												<i class="m-menu__ver-arrow la la-angle-right"></i>
											</a>
											<div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs">
												<span class="m-menu__arrow m-menu__arrow--adjust"></span>
												<ul class="m-menu__subnav">
													<li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
														<a href="<?php echo base_url(); ?>ctr/products/ilist" class="m-menu__link ">
															<span class="m-menu__link-text">
																產品列表
															</span>
														</a>
													</li>
													<li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
														<a href="<?php echo base_url(); ?>ctr/hot_products/ilist" class="m-menu__link ">
															<span class="m-menu__link-text">
																加價購列表
															</span>
														</a>
													</li>
												</ul>
											</div>
										</li>
										
										<li class="m-menu__item m-menu__item--submenu m-menu__item--tabs"  m-menu-submenu-toggle="tab" aria-haspopup="true">
											<a href="javascript:;" class="m-menu__link m-menu__toggle main_menu">
												<span class="m-menu__link-text">
													優惠碼管理
												</span>
												<i class="m-menu__hor-arrow la la-angle-down"></i>
												<i class="m-menu__ver-arrow la la-angle-right"></i>
											</a>
											<div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs">
												<span class="m-menu__arrow m-menu__arrow--adjust"></span>
												<ul class="m-menu__subnav">
													<li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
														<a href="<?php echo base_url(); ?>ctr/discount/ilist" class="m-menu__link ">
															<span class="m-menu__link-text">
																優惠碼管理
															</span>
														</a>
													</li>
												</ul>
											</div>
										</li>
										
										<li class="m-menu__item m-menu__item--submenu m-menu__item--tabs"  m-menu-submenu-toggle="tab" aria-haspopup="true">
											<a href="javascript:;" class="m-menu__link m-menu__toggle main_menu">
												<span class="m-menu__link-text">
													序號管理
												</span>
												<i class="m-menu__hor-arrow la la-angle-down"></i>
												<i class="m-menu__ver-arrow la la-angle-right"></i>
											</a>
											<div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs">
												<span class="m-menu__arrow m-menu__arrow--adjust"></span>
												<ul class="m-menu__subnav">
													<li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
														<a href="<?php echo base_url(); ?>ctr/card/ilist" class="m-menu__link ">
															<span class="m-menu__link-text">
																序號管理
															</span>
														</a>
													</li>
													<li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
														<a href="<?php echo base_url(); ?>ctr/card_navi/ilist" class="m-menu__link ">
															<span class="m-menu__link-text">
																序號期數管理
															</span>
														</a>
													</li>
													<li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
														<a href="<?php echo base_url(); ?>ctr/template/ilist" class="m-menu__link ">
															<span class="m-menu__link-text">
																模版管理
															</span>
														</a>
													</li>
													<li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
														<a href="<?php echo base_url(); ?>ctr/card_icon/ilist" class="m-menu__link ">
															<span class="m-menu__link-text">
																Icon模版管理
															</span>
														</a>
													</li>
													<li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
														<a href="<?php echo base_url(); ?>ctr/card_button/ilist" class="m-menu__link ">
															<span class="m-menu__link-text">
																按鍵模版管理
															</span>
														</a>
													</li>
													<li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
														<a href="<?php echo base_url(); ?>ctr/card_glut/ilist" class="m-menu__link ">
															<span class="m-menu__link-text">
																大量購買管理
															</span>
														</a>
													</li>
												</ul>
											</div>
										</li>
										
										<li class="m-menu__item m-menu__item--submenu m-menu__item--tabs"  m-menu-submenu-toggle="tab" aria-haspopup="true">
											<a href="javascript:;" class="m-menu__link m-menu__toggle main_menu">
												<span class="m-menu__link-text">
													頁面管理
												</span>
												<i class="m-menu__hor-arrow la la-angle-down"></i>
												<i class="m-menu__ver-arrow la la-angle-right"></i>
											</a>
											<div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs">
												<span class="m-menu__arrow m-menu__arrow--adjust"></span>
												<ul class="m-menu__subnav">
													<li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
														<a href="<?php echo base_url(); ?>ctr/pages/update_form/1" class="m-menu__link ">
															<span class="m-menu__link-text">
																隱私政策管理
															</span>
														</a>
													</li>
													<li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
														<a href="<?php echo base_url(); ?>ctr/pages/update_form/2" class="m-menu__link ">
															<span class="m-menu__link-text">
																服務條款管理
															</span>
														</a>
													</li>
													<li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
														<a href="<?php echo base_url(); ?>ctr/pages/update_form/3" class="m-menu__link ">
															<span class="m-menu__link-text">
																購物須知管理
															</span>
														</a>
													</li>
													<li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
														<a href="<?php echo base_url(); ?>ctr/pages/update_form/2" class="m-menu__link ">
															<span class="m-menu__link-text">
																設定教學管理
															</span>
														</a>
													</li>
												</ul>
											</div>
										</li>
										
										<li class="m-menu__item m-menu__item--submenu m-menu__item--tabs"  m-menu-submenu-toggle="tab" aria-haspopup="true">
											<a href="javascript:;" class="m-menu__link m-menu__toggle main_menu">
												<span class="m-menu__link-text">
													好評回饋
												</span>
												<i class="m-menu__hor-arrow la la-angle-down"></i>
												<i class="m-menu__ver-arrow la la-angle-right"></i>
											</a>
											<div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs">
												<span class="m-menu__arrow m-menu__arrow--adjust"></span>
												<ul class="m-menu__subnav">
													<li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
														<a href="<?php echo base_url(); ?>ctr/blog/ilist" class="m-menu__link ">
															<span class="m-menu__link-text">
																好評回饋管理
															</span>
														</a>
													</li>
												</ul>
											</div>
										</li>
										
										<li class="m-menu__item m-menu__item--submenu m-menu__item--tabs"  m-menu-submenu-toggle="tab" aria-haspopup="true">
											<a href="javascript:;" class="m-menu__link m-menu__toggle main_menu">
												<span class="m-menu__link-text">
													首頁
												</span>
												<i class="m-menu__hor-arrow la la-angle-down"></i>
												<i class="m-menu__ver-arrow la la-angle-right"></i>
											</a>
											<div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs">
												<span class="m-menu__arrow m-menu__arrow--adjust"></span>
												<ul class="m-menu__subnav">
													<li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
														<a href="<?php echo base_url(); ?>ctr/main_slider/ilist" class="m-menu__link ">
															<span class="m-menu__link-text">
																主輪播電腦版管理
															</span>
														</a>
													</li>
													<li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
														<a href="<?php echo base_url(); ?>ctr/main_slider_mobile/ilist" class="m-menu__link ">
															<span class="m-menu__link-text">
																主輪播手機版管理
															</span>
														</a>
													</li>
												</ul>
											</div>
										</li>
										
										<li class="m-menu__item m-menu__item--submenu m-menu__item--tabs"  m-menu-submenu-toggle="tab" aria-haspopup="true">
											<a href="javascript:;" class="m-menu__link m-menu__toggle main_menu">
												<span class="m-menu__link-text">
													關鍵字管理
												</span>
												<i class="m-menu__hor-arrow la la-angle-down"></i>
												<i class="m-menu__ver-arrow la la-angle-right"></i>
											</a>
											<div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs">
												<span class="m-menu__arrow m-menu__arrow--adjust"></span>
												<ul class="m-menu__subnav">
													<li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
														<a href="index.php/ctr/keyword/ilist" class="m-menu__link ">
															<span class="m-menu__link-text">
																關鍵字管理
															</span>
														</a>
													</li>
												</ul>
											</div>
										</li>
										
										<li class="m-menu__item m-menu__item--submenu m-menu__item--tabs"  m-menu-submenu-toggle="tab" aria-haspopup="true">
											<a href="javascript:;" class="m-menu__link m-menu__toggle main_menu">
												<span class="m-menu__link-text">
													匯入資料管理
												</span>
												<i class="m-menu__hor-arrow la la-angle-down"></i>
												<i class="m-menu__ver-arrow la la-angle-right"></i>
											</a>
											<div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs">
												<span class="m-menu__arrow m-menu__arrow--adjust"></span>
												<ul class="m-menu__subnav">
													<li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
														<a href="index.php/ctr/import_data/ilist" class="m-menu__link ">
															<span class="m-menu__link-text">
																匯入資料管理
															</span>
														</a>
													</li>
												</ul>
											</div>
										</li>
										
										<li class="m-menu__item m-menu__item--submenu m-menu__item--tabs"  m-menu-submenu-toggle="tab" aria-haspopup="true">
											<a href="javascript:;" class="m-menu__link m-menu__toggle main_menu">
												<span class="m-menu__link-text">
													精選品牌
												</span>
												<i class="m-menu__hor-arrow la la-angle-down"></i>
												<i class="m-menu__ver-arrow la la-angle-right"></i>
											</a>
											<div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs">
												<span class="m-menu__arrow m-menu__arrow--adjust"></span>
												<ul class="m-menu__subnav">
													<li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
														<a href="index.php/ctr/brand/ilist" class="m-menu__link ">
															<span class="m-menu__link-text">
																精選品牌管理
															</span>
														</a>
													</li>
												</ul>
											</div>
										</li>
										
										<?php //此為登出鈕，一定在最下 ?>
										<li class="m-menu__item  m-menu__item--submenu m-menu__item--tabs mobile_item"  m-menu-submenu-toggle="tab" aria-haspopup="true" id="control_admin">
											<a href="index.php/ctr/login/logout" class="m-menu__link m-menu__toggle">
												<span class="m-menu__link-text">
													登出
												</span>
											</a>											
										</li>
									</ul>
									
									<script>
										$(document).ready(function(){
											$('#main_navi_ul').css('opacity','1');
                                            
                                            $(".main_menu").each(function(){
                                                var href = $(this).next("div").children("ul").children("li:eq(0)").children("a").attr("href");
                                                
                                                $(this).attr("href",href);
                                            });
										});
                                        
                                        $(".main_menu").click(function(){
                                            var href = $(this).attr("href");
                                            var width = $(window).width();
                                            
                                            if(width > 1024)
                                            {
                                                window.location.href = href;
                                            }
                                        });
                                        
                                        $(".main_menu_blank").click(function(){
                                            var href = $(this).attr("href");
                                            var width = $(window).width();
                                            
                                            window.open(href);
                                        });
									</script>
								</div>
							</div>
							<!-- end::Horizontal Menu -->
						</div>
					</div>
				</div>
			</header>
			<!-- end::Header -->		