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
                                <div class="title">Form Edit Customer</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" method="post" action="<?=site_url('customer/add');?>">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nama" class="form-control" id="inputEmail3">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" name="email" class="form-control" id="inputEmail3" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="password" class="form-control" id="inputEmail3" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Konfirmasi Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="password_confirmation" class="form-control" id="inputEmail3" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Alamat</label>
                                    <div class="col-sm-10">
                                    <textarea class="form-control" rows="3" name="alamat" ></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Status</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="status">
                                            <?php foreach($this->config->item('status_user') as $k => $v):?>
                                            <option value="<?=$k?>"><?=$v?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                        <a href="<?=site_url('customer');?>" class="btn btn-default">Kembali</a>
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