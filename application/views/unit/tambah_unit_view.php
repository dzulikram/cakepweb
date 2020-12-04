<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Unit
            <small>Tambah Unit</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Unit</a></li>
            <li class="active">Tambah Unit</li>
        </ol>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Tambah Unit</h3>
            </div>
            <div class="box-body">
                <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>unit/aksi_tambah_unit" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="col-lg-10">
                            <div class="form-group">
                                <label for="atk_satuan" class="col-sm-3 control-label">Nama Unit</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="unit_nama" name="unit_nama" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="atk_satuan" class="col-sm-3 control-label">Level Unit</label>
                                <div class="col-sm-5">
                                    <select class="form-control" name="unit_level">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="atk_satuan" class="col-sm-3 control-label">Induk</label>
                                <div class="col-sm-5">
                                    <select class="form-control" name="unit_induk">
                                        <?php
                                        foreach ($semua_unit as $row) {
                                            ?>
                                            <option value="<?php echo $row->unit_id; ?>"><?php echo $row->unit_nama; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
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