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
            <?php if(isset($error)):?>
               <div class="alert fresh-color alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <?php foreach($error as $err => $er ):?>
                        <?=$er;?>
                    <?php endforeach;?>
                </div>
            <?php endif;?>
            <?php if($this->session->flashdata('sukses')):?>
               <div class="alert fresh-color alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <?= $this->session->flashdata('sukses');?>
                </div>
            <?php endif;?>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <div class="title">Form Input Pembayaran</div>
                            </div>
                        </div>
                        <div class="card-body">
                        <?php if($pembayaran):?>
                            <form class="form-horizontal" method="post" action="<?=site_url('payment/add');?>" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">ID Pembayaran</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="pembayaran_id">
                                            <?php foreach($pembayaran as $k => $s):?>
                                                <option value="<?=$s->id?>"><?=$s->id?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Type Bayar</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="tipe_bayar">
                                            <?php foreach($this->config->item('tipe_bayar') as $k => $v):?>
                                            <option value="<?=$k?>" ><?=$v?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Jumlah</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="jumlah_bayar" class="form-control" id="inputEmail3" value="<?=set_value('jumlah_bayar');?>" placeholder="Untuk DP Minimun Pembayaran 50% dari Total Pembayaran">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Bukti Pembayaran</label>
                                    <div class="col-sm-10">
                                        <input type="file" name="bukti_bayar" class="form-control" id="inputEmail3" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Bayar</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="tgl_bayar" class="form-control" id="datepicker-pembayaran" onkeydown="return false" value="<?=set_value('tgl_bayar');?>">
                                    </div>
                                </div>
                                
                                
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                        <a href="<?=site_url('employees');?>" class="btn btn-default">Kembali</a>
                                    </div>
                                </div>
                            </form>
                            <?php else:?>
                                <div class="alert fresh-color alert-danger alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    Belum Ada Data Pembayaran.
                                </div>
                            <?php endif;?>
                        </div>
                    </div>
                </div> 
            
        </div>
    </div>
	</div>
</div>