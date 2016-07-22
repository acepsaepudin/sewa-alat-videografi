	<!-- Main Content -->
	<div class="container-fluid">
    <div class="side-body">
        
        <div class="row">
        	   <div class="col-xs-12">
               <?php if(validation_errors()):?>
               <div class="alert fresh-color alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <?php echo validation_errors();?>
                </div>
            <?php endif;?>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <div class="title">Form Tambah Alat</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" method="post" action="<?=site_url('alat/store');?>">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nama" class="form-control" id="inputEmail3" placeholder="Nama Alat">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Stok</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="stok" class="form-control" id="inputEmail3" placeholder="Stok">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Deskripsi</label>
                                    <div class="col-sm-10">
                                    <textarea class="form-control" rows="3" name="deskripsi"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Harga Perhari</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="harga_harian" class="form-control" id="inputEmail3" placeholder="Harga Per Hari">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                        <a href="<?=site_url('alat');?>" class="btn btn-default">Kembali</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> 
            
        </div>
    </div>
	</div>
</div>