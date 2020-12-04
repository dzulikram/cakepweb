<link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/style.css">
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Unit
            <small>Daftar Unit</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Unit</a></li>
            <li class="active">Daftar Unit</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Daftar Unit</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <a href="<?php echo base_url(); ?>unit/tambah_unit" class="btn btn-primary pull-left">TAMBAH UNIT</a>
                        <br/><br/><br/>
                        <table id="main-grid" class="table table-bordered table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th width="10%">NO</th>
                                    <th width="20%">NAMA</th>
                                    <th width="20%">LEVEL</th>
                                    <th width="20%">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $no = 1;
                                foreach ($semua_unit as $row)
                                {
                                    ?>
                                    <tr>
                                        <td><?php echo $no; $no++; ?></td>
                                        <td><?php echo $row->unit_nama; ?></td>
                                        <td><?php echo $row->unit_level; ?></td>
                                        <td><a href="<?php echo base_url(); ?>unit/ubah_unit/<?php echo $row->unit_id; ?>" class="btn btn-primary">UBAH</td>
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
    </section>
</div>

<script>
    $(function () {
        oTable = $('#main-grid').DataTable({
            responsive:true
        }
        );   //pay attention to capital D, which is mandatory to retrieve "api" datatables' object, as @Lionel said
        
        $('#pilih').each(function(){
          oTable.search($(this).val()).draw() ;
        });
    });
</script>