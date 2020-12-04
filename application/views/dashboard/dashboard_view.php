<!DOCTYPE html>
<html lang="en">

	<head><base href="">
		<meta charset="utf-8" />
		<title>Cek Analisis Kepuasan Pelanggan</title>
		<meta name="description" content="Updates and statistics" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<link href="<?php echo base_url(); ?>asset/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css?v=7.0.5" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url(); ?>asset/assets/plugins/global/plugins.bundle.css?v=7.0.5" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url(); ?>asset/assets/plugins/custom/prismjs/prismjs.bundle.css?v=7.0.5" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url(); ?>asset/assets/css/style.bundle.css?v=7.0.5" rel="stylesheet" type="text/css" />
		<link rel="shortcut icon" href="<?php echo base_url(); ?>asset/assets/media/logos/pln.png" />
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
		
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	</head>
	<body id="kt_body" style="background-image: url(<?php echo base_url(); ?>asset/assets/media/bg/bg-13.jpg)" class="quick-panel-right demo-panel-right offcanvas-right header-fixed subheader-enabled page-loading">
		<div id="kt_header_mobile" class="header-mobile">
			<!--begin::Logo-->
			<a href="index.html">
				<img alt="Logo" src="<?php echo base_url(); ?>asset/assets/media/logos/logo-letter-1.png" class="logo-default max-h-30px" />
			</a>
			<!--end::Logo-->
			<!--begin::Toolbar-->
			<div class="d-flex align-items-center">
				<button class="btn p-0 burger-icon burger-icon-left ml-4" id="kt_header_mobile_toggle">
					<span></span>
				</button>
				<button class="btn btn-icon btn-hover-transparent-white p-0 ml-3" id="kt_header_mobile_topbar_toggle">
					<span class="svg-icon svg-icon-xl">
						<!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
							<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<polygon points="0 0 24 0 24 24 0 24" />
								<path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
								<path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
							</g>
						</svg>
						<!--end::Svg Icon-->
					</span>
				</button>
			</div>
			<!--end::Toolbar-->
		</div>
		<!--end::Header Mobile-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="d-flex flex-row flex-column-fluid page">
				<!--begin::Wrapper-->
				<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
					<!--begin::Header-->
					<div id="kt_header" class="header header-fixed">
						<!--begin::Container-->
						<div class="container d-flex align-items-stretch justify-content-between">
							<!--begin::Left-->
							<div class="d-flex align-items-stretch mr-3">
								<!--begin::Header Logo-->
								<div class="header-logo">
									<a href="<?php echo base_url(); ?>page/dashboard">
										<img alt="Logo" src="<?php echo base_url(); ?>asset/assets/media/logos/cakep2.png" class="logo-default max-h-40px" />
									</a>
								</div>
								<!--end::Header Logo-->
								<!--begin::Header Menu Wrapper-->
								<div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
									<!--begin::Header Menu-->
									<div id="kt_header_menu" class="header-menu header-menu-left header-menu-mobile header-menu-layout-default">
										<!--begin::Header Nav-->
										<ul class="menu-nav">
											<li class="menu-item menu-item-open menu-item-here menu-item-submenu menu-item-rel menu-item-open menu-item-here" data-menu-toggle="click" aria-haspopup="true">
												<a href="<?php echo base_url(); ?>page/dashboard" class="menu-link menu-toggle">
													<span class="menu-text">Dashboard</span>
													<i class="menu-arrow"></i>
												</a>		
											</li>
											<li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="click" aria-haspopup="true">
												<a href="<?php echo base_url(); ?>responden/daftar_responden">
													<span class="menu-text">Responden</span>
													<span class="menu-desc"></span>
													<i class="menu-arrow"></i>
												</a>												
											</li>
										</ul>
										<!--end::Header Nav-->
									</div>
									
									<!--end::Header Menu-->
								</div>
								<!--end::Header Menu Wrapper-->
							</div>
							<!--end::Left-->
							<!--begin::Topbar-->
							<div class="topbar">								
								<div class="dropdown">
									<!--begin::Toggle-->
									<div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
										<a href="<?php echo base_url(); ?>page/login">
										<div class="btn btn-icon btn-hover-transparent-white btn-dropdown btn-lg mr-1 pulse pulse-primary">
										<span class="svg-icon svg-icon-white svg-icon-2x"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24"/>
													<path d="M7.62302337,5.30262097 C8.08508802,5.000107 8.70490146,5.12944838 9.00741543,5.59151303 C9.3099294,6.05357769 9.18058801,6.67339112 8.71852336,6.97590509 C7.03468892,8.07831239 6,9.95030239 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,9.99549229 17.0108275,8.15969002 15.3875704,7.04698597 C14.9320347,6.73472706 14.8158858,6.11230651 15.1281448,5.65677076 C15.4404037,5.20123501 16.0628242,5.08508618 16.51836,5.39734508 C18.6800181,6.87911023 20,9.32886071 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,9.26852332 5.38056879,6.77075716 7.62302337,5.30262097 Z" fill="#000000" fill-rule="nonzero"/>
													<rect fill="#000000" opacity="0.3" x="11" y="3" width="2" height="10" rx="1"/>
												</g>
											</svg><!--end::Svg Icon-->
										</span>
										<span class="pulse-ring"></span>
										</div>
										</a>
										<span class="text-white opacity-90 font-weight-bolder font-size-base d-none d-md-inline mr-4">Logout</span>
									</div>
									<!--end::Dropdown-->
								</div>
							</div>
						</div>
						<!--end::Container-->
					</div>
					<!--end::Header-->
					<!--begin::Content-->
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
						<!--begin::Subheader-->
						
						<!--end::Subheader-->
						<!--begin::Entry-->
						<div class="d-flex flex-column-fluid">
							<!--begin::Container-->
							<div class="container">
								<div class="row">
									<div class="col-xl-8">
										<div class="row">
											<div class="col-xl-3">
												<!--begin::Tiles Widget 11-->
												<div class="card card-custom bg-info bg-hover-state-info card-stretch gutter-b" style="height: 150px">
													<div class="card-body">
														<span class="svg-icon svg-icon-3x svg-icon-white ml-n2">
															<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group.svg-->
															<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																	<polygon points="0 0 24 0 24 24 0 24" />
																	<path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
																	<path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
																</g>
															</svg>
															<!--end::Svg Icon-->
														</span>
														<div class="text-inverse-primary font-weight-bolder font-size-h2 mt-3">1790</div>
														<a href="#" class="text-inverse-primary font-weight-bold font-size-lg mt-1">Pelanggan</a>
													</div>
												</div>
												<!--end::Tiles Widget 11-->
											</div>
											<div class="col-xl-3">
												<!--begin::Tiles Widget 11-->
												<div class="card card-custom bg-primary bg-hover-state-primary card-stretch gutter-b" style="height: 150px">
													<div class="card-body">
														<span class="svg-icon svg-icon-3x svg-icon-white ml-n2">
															<!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
															<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																	<rect x="0" y="0" width="24" height="24"/>
																	<path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "/>
																	<path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
																</g>
															</svg>
															<!--end::Svg Icon-->
														</span>
														<div class="text-inverse-primary font-weight-bolder font-size-h2 mt-3">790</div>
														<a href="#" class="text-inverse-primary font-weight-bold font-size-lg mt-1">Mengisi</a>
													</div>
												</div>
												<!--end::Tiles Widget 11-->
											</div>
											<div class="col-xl-3">
												<!--begin::Tiles Widget 11-->
												<div class="card card-custom bg-danger bg-hover-state-danger card-stretch gutter-b" style="height: 150px">
													<div class="card-body">
														<span class="svg-icon svg-icon-3x svg-icon-white ml-n2">
															<!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
															<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																	<rect x="0" y="0" width="24" height="24"/>
																	<path d="M12,22 C6.4771525,22 2,17.5228475 2,12 C2,6.4771525 6.4771525,2 12,2 C17.5228475,2 22,6.4771525 22,12 C22,17.5228475 17.5228475,22 12,22 Z M12,20 C16.418278,20 20,16.418278 20,12 C20,7.581722 16.418278,4 12,4 C7.581722,4 4,7.581722 4,12 C4,16.418278 7.581722,20 12,20 Z M19.0710678,4.92893219 L19.0710678,4.92893219 C19.4615921,5.31945648 19.4615921,5.95262146 19.0710678,6.34314575 L6.34314575,19.0710678 C5.95262146,19.4615921 5.31945648,19.4615921 4.92893219,19.0710678 L4.92893219,19.0710678 C4.5384079,18.6805435 4.5384079,18.0473785 4.92893219,17.6568542 L17.6568542,4.92893219 C18.0473785,4.5384079 18.6805435,4.5384079 19.0710678,4.92893219 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
																</g>
															</svg>
															<!--end::Svg Icon-->
														</span>
														<div class="text-inverse-primary font-weight-bolder font-size-h2 mt-3">100</div>
														<a href="#" class="text-inverse-primary font-weight-bold font-size-lg mt-1">Menolak</a>
													</div>
												</div>
												<!--end::Tiles Widget 11-->
											</div>
											<div class="col-xl-3">
												<!--begin::Tiles Widget 11-->
												<div class="card card-custom bg-dark bg-hover-state-dark card-stretch gutter-b" style="height: 150px">
													<div class="card-body">
														<span class="svg-icon svg-icon-3x svg-icon-white ml-n2">
															<!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
															<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																	<rect x="0" y="0" width="24" height="24" />
																	<rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5" />
																	<path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3" />
																</g>
															</svg>
															<!--end::Svg Icon-->
														</span>
														<div class="text-inverse-primary font-weight-bolder font-size-h2 mt-3">900</div>
														<a href="#" class="text-inverse-primary font-weight-bold font-size-lg mt-1">No Respon</a>
													</div>
												</div>
												<!--end::Tiles Widget 11-->
											</div>
										</div>	
									</div>
								</div>
								<div class="row">
									<div class="col-xl-6">
										<div class="card card-custom card-stretch gutter-b">
											<div class="card-header border-0 pt-5">
												<h3 class="card-title font-weight-bolder">Broadcast Survey Pelanggan 2020</h3>
											</div>
											<div class="card-body">
												<div style="width: 450px;margin: 0px auto;">
													<canvas id="myChart"></canvas>
												</div>														
											</div>
										</div>
									</div>
									<div class="col-xl-6">
										<div class="card card-custom card-stretch gutter-b">											
											<div class="card-header border-0 pt-5">
												<h3 class="card-title font-weight-bolder">Grafik Kepuasan Pelanggan 2020</h3>
											</div>
											<div class="card-body">
												<div style="width: 450px;margin: 0px auto;">
														<canvas id="linechart"></canvas>
												</div>														
											</div>
										</div>
									</div>										
								</div>
								<div class="row">
								<div class="col-xl-12">
										<div class="card card-custom card-stretch gutter-b">
											<div class="card-header border-0 pt-5">
												<h3 class="card-title font-weight-bolder">Respon Pelanggan Terhadap Durasi Penyambungan</h3>
											</div>
											<div class="card-body">
												<div class="row">
													<div class="col-xl-3">
														<div style="width: 300px;margin: 0px auto;">
																<canvas id="half"></canvas>
														</div>
													</div>
													<div class="col-xl-3">
														<div style="width: 300px;margin: 0px auto;">
																<canvas id="half2"></canvas>
														</div>
													</div>
													<div class="col-xl-3">
														<div style="width: 300px;margin: 0px auto;">
																<canvas id="half3"></canvas>
														</div>
													</div>	
													<div class="col-xl-3">
														<div style="width: 300px;margin: 0px auto;">
																<canvas id="half4"></canvas>
														</div>
													</div>	
												</div>													
											</div>
										</div>
									</div>																			
								</div>
								<div class="row">										
									<div class="col-xl-4">
										<div class="card card-custom card-stretch gutter-b">
											<div class="card-header border-0 pt-5">
												<h3 class="card-title font-weight-bolder">Sumber Informasi Pelanggan</h3></br>
												<div class="font-size-sm text-muted mt-1">Pasang Baru-Tambah Daya-Penyambungan Sementara</div>
											</div>										
												<div style="width: 340px;margin: 0px auto;" id="piechart3d"></div>														
										</div>	
									</div>
									<div class="col-xl-8">
										<div class="card card-custom card-stretch gutter-b">											
											<div class="card-header border-0 pt-5">
												<h3 class="card-title font-weight-bolder">Jumlah Pelanggan yang membayar di luar biaya terdaftar 2020</h3>
											</div>
											<div class="card-body">
												<div style="width: 550px;margin: 0px auto;">
														<canvas id="myChart2"></canvas>
												</div>														
											</div>
										</div>
									</div>																		
								</div>
							</div>
						</div>
					</div>
					
					<div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
						<div class="container d-flex flex-column flex-md-row align-items-center justify-content-between">
							<div class="text-dark order-2 order-md-1">
								<span class="text-muted font-weight-bold mr-2">2020©</span>
								<a href="#" target="_blank" class="text-dark-75 text-hover-primary">PT PLN (Persero) UIW Kaltimra</a>
							</div>							
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div id="kt_scrolltop" class="scrolltop">
			<span class="svg-icon">
				<!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Up-2.svg-->
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
					<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
						<polygon points="0 0 24 0 24 24 0 24" />
						<rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1" />
						<path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero" />
					</g>
				</svg>
				<!--end::Svg Icon-->
			</span>
		</div>
		<script>var HOST_URL = "https://keenthemes.com/metronic/tools/preview";</script>
		<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1200 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#6993FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#F3F6F9", "dark": "#212121" }, "light": { "white": "#ffffff", "primary": "#E1E9FF", "secondary": "#ECF0F3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#212121", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#ECF0F3", "gray-300": "#E5EAEE", "gray-400": "#D6D6E0", "gray-500": "#B5B5C3", "gray-600": "#80808F", "gray-700": "#464E5F", "gray-800": "#1B283F", "gray-900": "#212121" } }, "font-family": "Poppins" };</script>
		<script src="<?php echo base_url(); ?>asset/assets/plugins/global/plugins.bundle.js?v=7.0.5"></script>
		<script src="<?php echo base_url(); ?>asset/assets/plugins/custom/prismjs/prismjs.bundle.js?v=7.0.5"></script>
		<script src="<?php echo base_url(); ?>asset/assets/js/scripts.bundle.js?v=7.0.5"></script>
		<script src="<?php echo base_url(); ?>asset/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js?v=7.0.5"></script>
		<script src="<?php echo base_url(); ?>asset/assets/js/pages/widgets.js?v=7.0.5"></script>

		<script>
			var ctx = document.getElementById("myChart").getContext('2d');
			var myChart = new Chart(ctx, {
				type: 'bar',
				data: {
					labels: ["Jan", "Feb", "Mar", "Apr","Mei","Jun","Jul","Agu","Sep","Okt","Nov","Des"],
					datasets: [{
						label: '',
						data: [
						14, 
						42, 
						3, 
						24,5,16,7,8,9,10,11,12],
						backgroundColor: [
						'rgba(75, 192, 192, 0.2)',
						'rgba(75, 192, 192, 0.2)',
						'rgba(75, 192, 192, 0.2)',
						'rgba(75, 192, 192, 0.2)',
						'rgba(75, 192, 192, 0.2)',
						'rgba(75, 192, 192, 0.2)',
						'rgba(75, 192, 192, 0.2)',
						'rgba(75, 192, 192, 0.2)',
						'rgba(75, 192, 192, 0.2)',
						'rgba(75, 192, 192, 0.2)',
						'rgba(75, 192, 192, 0.2)',
						'rgba(75, 192, 192, 0.2)'
						],
						borderColor: [
						'rgba(54, 162, 235, 1)',
						'rgba(54, 162, 235, 1)',
						'rgba(54, 162, 235, 1)',
						'rgba(54, 162, 235, 1)',
						'rgba(54, 162, 235, 1)',
						'rgba(54, 162, 235, 1)',
						'rgba(54, 162, 235, 1)',
						'rgba(54, 162, 235, 1)',
						'rgba(54, 162, 235, 1)',
						'rgba(54, 162, 235, 1)',
						'rgba(54, 162, 235, 1)',
						'rgba(54, 162, 235, 1)'
						],
						borderWidth: 1
					}]
				},
				options: {
					scales: {
						yAxes: [{
							ticks: {
								beginAtZero:true
							}
						}]
					}
				}
			});
		</script>
		<script  type="text/javascript">
			var ctx = document.getElementById("linechart").getContext("2d");
			var data = {
						labels: ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],
						datasets: [
							{
								label: "Puas",
								fill: false,
								lineTension: 0.1,
								backgroundColor: "#29B0D0",
								borderColor: "#29B0D0",
								pointHoverBackgroundColor: "#29B0D0",
								pointHoverBorderColor: "#29B0D0",
								data: [21,12,33,64,15,26,47,48,59,60,51,92]
							},
							{
								label: "Tidak Puas",
								fill: false,
								lineTension: 0.1,
								backgroundColor: "#EE2127",
								borderColor: "#EE2127",
								pointHoverBackgroundColor: "#EE2127",
								pointHoverBorderColor: "#EE2127",
								data: [1,2,3,4,5,6,7,8,9,10,11,12]
							}
							]
					};

			var myBarChart = new Chart(ctx, {
						type: 'line',
						data: data,
						options: {
						legend: {
						display: true
						},
						barValueSpacing: 20,
						scales: {
						yAxes: [{
							ticks: {
								min: 0,
							}
						}],
						xAxes: [{
									gridLines: {
										color: "rgba(0, 0, 0, 0)",
									}
								}]
						}
					}
					});
		</script>
			
		<script type="text/javascript">
			google.charts.load("current", {packages:["corechart"]});
			google.charts.setOnLoadCallback(drawChart);
			function drawChart() {
				var data = google.visualization.arrayToDataTable([
				['Task', 'Hours per Day'],
				['Web PLN',     11],
				['PLN Mobile',      25],
				['PLN 123',  2],
				['Kantor Pelayanan', 2]
				]);

				var options = {
					is3D: true,
				};

				var chart = new google.visualization.PieChart(document.getElementById('piechart3d'));
				chart.draw(data, options);
			}
		</script>

		<script>
			var ctx = document.getElementById("half");
			var myChart = new Chart(ctx, {
				type: 'doughnut',
				data: {
					labels: ["< 3 Hari"],
					datasets: [{
						label: '# of Votes',
						data: [20,100-20],
						text: "ff",
						backgroundColor: [
						
							'rgba(75, 192, 192, 0.2)'
						],
						borderColor: [
						
							'rgba(75, 192, 192, 1)'
						],
						borderWidth: 1
					}]
				},
				options: {
					rotation: 1 * Math.PI,
					circumference: 1 * Math.PI,
					title: {
					display: true,
					text: '20 %',
					position: 'bottom'}
				}
			});
		</script>
		
		<script>
			var ctx = document.getElementById("half2");
			var myChart = new Chart(ctx, {
				type: 'doughnut',
				data: {
					labels: ["4 Hari"],
					datasets: [{
						label: '# of Votes',
						data: [32,100-32],
						text: "ff",
						backgroundColor: [
						
							'rgba(255, 206, 86, 0.2)'
						],
						borderColor: [
						
							'rgba(255, 206, 86, 1)'
						],
						borderWidth: 1
					}]
				},
				options: {
					rotation: 1 * Math.PI,
					circumference: 1 * Math.PI,
					title: {
					display: true,
					text: '32 %',
					position: 'bottom'}
				}
			});
		</script>

		<script>
			var ctx = document.getElementById("half3");
			var myChart = new Chart(ctx, {
				type: 'doughnut',
				data: {
					labels: ["5 Hari"],
					datasets: [{
						label: '# of Votes',
						data: [10,100-10],
						text: "ff",
						backgroundColor: [
						
							'rgba(255, 159, 64, 0.2)'
						],
						borderColor: [
						
							'rgba(255, 159, 64, 1)'
						],
						borderWidth: 1
					}]
				},
				options: {
					rotation: 1 * Math.PI,
					circumference: 1 * Math.PI,
					title: {
					display: true,
					text: '10 %',
					position: 'bottom'}
				}
			});
		</script>

		<script>
			var ctx = document.getElementById("half4");
			var myChart = new Chart(ctx, {
				type: 'doughnut',
				data: {
					labels: ["> 5 Hari"],
					datasets: [{
						label: '# of Votes',
						data: [38,100-38],
						text: "ff",
						backgroundColor: [
						
							'rgba(255, 99, 132, 0.2)'
						],
						borderColor: [
						
							'rgba(255,99,132,1)'
						],
						borderWidth: 1
					}]
				},
				options: {
					rotation: 1 * Math.PI,
					circumference: 1 * Math.PI,
					title: {
					display: true,
					text: '38 %',
					position: 'bottom'}
				}
			});
		</script>
		<script>
			var ctx = document.getElementById("myChart2").getContext('2d');
			var myChart = new Chart(ctx, {
				type: 'bar',
				data: {
					labels: ["Jan", "Feb", "Mar", "Apr","Mei","Jun","Jul","Agu","Sep","Okt","Nov","Des"],
					datasets: [{
						label: '',
						data: [
						14, 
						42, 
						3, 
						24,5,16,7,8,9,10,11,12],
						backgroundColor: [
						'rgba(255, 99, 132, 0.2)',
						'rgba(255, 99, 132, 0.2)',
						'rgba(255, 99, 132, 0.2)',
						'rgba(255, 99, 132, 0.2)',
						'rgba(255, 99, 132, 0.2)',
						'rgba(255, 99, 132, 0.2)',
						'rgba(255, 99, 132, 0.2)',
						'rgba(255, 99, 132, 0.2)',
						'rgba(255, 99, 132, 0.2)',
						'rgba(255, 99, 132, 0.2)',
						'rgba(255, 99, 132, 0.2)',
						'rgba(255, 99, 132, 0.2)'
						],
						borderColor: [
						'rgba(255,99,132,1)',
						'rgba(255,99,132,1)',
						'rgba(255,99,132,1)',
						'rgba(255,99,132,1)',
						'rgba(255,99,132,1)',
						'rgba(255,99,132,1)',
						'rgba(255,99,132,1)',
						'rgba(255,99,132,1)',
						'rgba(255,99,132,1)',
						'rgba(255,99,132,1)',
						'rgba(255,99,132,1)',
						'rgba(255,99,132,1)'
						],
						borderWidth: 1
					}]
				},
				options: {
					scales: {
						yAxes: [{
							ticks: {
								beginAtZero:true
							}
						}]
					}
				}
			});
		</script>
	
	</body>
</html>