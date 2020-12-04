<div class="content-wrapper">
    <section class="content-header">
        <h1>
            User
            <small>Tambah User</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> User</a></li>
            <li class="active">Tambah User</li>
        </ol>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Tambah User</h3>
            </div>
            <div class="box-body">
                <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>user/aksi_ubah_user" enctype="multipart/form-data">
                    <input type="hidden" name="user_id" value="<?php echo $satu_user->user_id; ?>">
                    <div class="box-body">
                        <div class="col-lg-10">
                            <div class="form-group">
                                <label for="atk_satuan" class="col-sm-3 control-label">Nama</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?php echo $satu_user->nama_lengkap; ?>" required/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="pull-right">
                            <button type="submit" class="btn btn-success">SIMPAN</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>