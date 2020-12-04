<div class="content-wrapper">
    <section class="content-header">
        <h1>
            User
            <small>Ganti Password</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>User</a></li>
            <li class="active">Change Password</li>
        </ol>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Ganti Password</h3>
            </div>
            <div class="box-body">
                <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>user/aksi_ubah_password" enctype="multipart/form-data">
                    <input type="hidden" name="user_id" value="<?php echo $satu_user->user_id; ?>">
                    <div class="box-body">
                        <div class="col-lg-10">
                            <div class="form-group">
                                <label for="atk_satuan" class="col-sm-3 control-label">Password Lama</label>
                                <div class="col-sm-5">
                                    <input type="Text" class="form-control" id="user_password_old" name="user_password_old" value="<?php echo $satu_user->user_password; ?>" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-10">
                            <div class="form-group">
                                <label for="atk_satuan" class="col-sm-3 control-label">Password Baru</label>
                                <div class="col-sm-5">
                                    <input type="password" class="form-control" id="user_password" name="user_password" value="<?php echo $satu_user->user_password; ?>" required/>
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