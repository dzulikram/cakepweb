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
		<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>

		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.16/b-1.5.1/b-colvis-1.5.1/b-html5-1.5.1/b-print-1.5.1/fh-3.1.3/datatables.min.css"/>
		
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.16/b-1.5.1/b-colvis-1.5.1/b-html5-1.5.1/b-print-1.5.1/fh-3.1.3/datatables.min.js"></script>
		
		<script>
			$(document).ready( function () {
			var table = $('#example').DataTable({
					dom: '<"dom_wrapper fh-fixedHeader"Bf>tip',
					buttons: [
						
						'excelHtml5',
						'pdfHtml5'
					],
				pageLength: 20,
				fixedHeader: true
			});
			} );
		</script>
	</head>
	<body id="kt_body" style="background-image: url(<?php echo base_url(); ?>asset/assets/media/bg/bg-13.jpg)" class="quick-panel-right demo-panel-right offcanvas-right header-fixed subheader-enabled page-loading">
		<div id="kt_header_mobile" class="header-mobile">
			<a href="index.html">
				<img alt="Logo" src="<?php echo base_url(); ?>asset/assets/media/logos/logo-letter-1.png" class="logo-default max-h-30px" />
			</a>
			<div class="d-flex align-items-center">
				<button class="btn p-0 burger-icon burger-icon-left ml-4" id="kt_header_mobile_toggle">
					<span></span>
				</button>
				<button class="btn btn-icon btn-hover-transparent-white p-0 ml-3" id="kt_header_mobile_topbar_toggle">
					<span class="svg-icon svg-icon-xl">
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
							<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<polygon points="0 0 24 0 24 24 0 24" />
								<path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
								<path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
							</g>
						</svg>
					</span>
				</button>
			</div>
		</div>
		<div class="d-flex flex-column flex-root">
			<div class="d-flex flex-row flex-column-fluid page">
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
                                            <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="click" aria-haspopup="true">
												<a href="<?php echo base_url(); ?>page/dashboard" >
													<span class="menu-text">Dashboard</span>
													<span class="menu-desc"></span>
                                                    <i class="menu-arrow"></i>
												</a>		
											</li>
											<li class="menu-item menu-item-open menu-item-here menu-item-submenu menu-item-rel menu-item-open menu-item-here" data-menu-toggle="click" aria-haspopup="true">
												<a href="<?php echo base_url(); ?>hasil/daftar_hasil" class="menu-link menu-toggle">
													<span class="menu-text">Hasil Survey</span>
													<i class="menu-arrow"></i>
												</a>		
											</li>
											<li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="click" aria-haspopup="true">
												<a href="<?php echo base_url(); ?>map/sebaranmap">
													<span class="menu-text">Peta Sebaran</span>
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
									<div class="col">
										
											<div class="card-custom">
												<div class="card-header flex-wrap border-0 pt-6 pb-0">
													<div class="card-title">
														<h3 class="card-label">Data Responden
														<span class="text-muted pt-2 font-size-sm d-block">Pelanggan PT. PLN (Persero) UIW Kaltimra</span></h3>
													</div>
													
                                                    <div class="box">
                                                        <div class="box-body">
															<table id="example" width="100%">
                                                                <thead>
                                                                    <tr>
                                                                        <th width="1%">NO</th>
                                                                        <th width="19%">NO WHATSAPP</th>
																		<th width="19%">TANGGAL ISI</th>
																		<th width="19%">ID PEL</th>
                                                                        <th width="20%">BERSEDIA MENGISI SURVEY</th>
                                                                        <th width="20%">SUMBER MEDIA INFORMASI LAYANAN PLN</th>
                                                                        <th width="20%">LAMA PENYAMBUNGAN</th>
                                                                        <th width="20%">PERMINTAAN BIAYA TAMBAHAN</th>
                                                                        <th width="20%">TINGKAT KEPUASAN</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php 
																		$no = 1;
																		foreach ($pelanggan as $row)
																		{
																			?>
																			<tr>
																				<td><?php echo $no; $no++;?></td>
																				<td><?php echo $row; ?></td>
																				<td><?php echo $tanggal[$row]; ?></td>
																				<td><?php echo $idpel[$row]; ?></td>
																				<td><?php if(!empty($jawaban[$row]['1'])){if($jawaban[$row]['1']=='Y'){echo "Bersedia";}elseif($jawaban[$row]['1']=='T'){echo "Tidak Bersedia";}} ?></td>
																				<td><?php if(!empty($jawaban[$row]['2'])){if($jawaban[$row]['2']=='A'){echo "Web pln.co.id";}elseif($jawaban[$row]['2']=='B'){echo "Aplikasi PLN Mobile";}elseif($jawaban[$row]['2']=='C'){echo "Call Center PLN 123";}elseif($jawaban[$row]['2']=='D'){echo "Kantor Pelayanan PLN";}} ?></td>
																				<td><?php if(!empty($jawaban[$row]['4'])){if($jawaban[$row]['4']=='A'){echo "<3 Hari Kerja";}elseif($jawaban[$row]['4']=='B'){echo "4 Hari Kerja";}elseif($jawaban[$row]['4']=='C'){echo "5 Hari Kerja";}elseif($jawaban[$row]['4']=='D'){echo ">5 Hari Kerja";}} ?></td>
																				<td><?php if(!empty($jawaban[$row]['5'])){if($jawaban[$row]['5']=='A'){echo "Ada";}elseif($jawaban[$row]['5']=='B'){echo "Tidak";}} ?></td>
																				<td><?php if(!empty($jawaban[$row]['6'])){if($jawaban[$row]['6']=='A'){echo "Puas";}elseif($jawaban[$row]['6']=='B'){echo "Tidak Puas";}} ?></td>
																				
																			</tr>
																			<?php
																		}
                                                                    ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
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
		

	
	</body>
</html>