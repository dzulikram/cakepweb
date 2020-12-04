<?php
$user = $this->session->userdata('sesi');
?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <!-- <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url(); ?>asset/adminlte/dist/img/propic.png" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div> -->
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="treeview" id="nav-dashboard">
                <a href="<?php echo base_url() ?>page">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="header">User</li>
            <li class="treeview" id="nav-list-jenis_jabatan">
                <a href="#">
                    <i class="fa fa-tv"></i> <span>User</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li id='nav-list-jenis_jabatan'><a href="<?php echo base_url(); ?>user/daftar_user"><i class='fa fa-circle-o'></i> Daftar User</a></li>
                    <li id='nav-list-jenis_jabatan'><a href="<?php echo base_url(); ?>user/tambah_user"><i class='fa fa-circle-o'></i> Tambah User</a></li>
                </ul>
            </li>
        </ul>
    </section>
</aside>