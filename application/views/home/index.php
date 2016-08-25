	<!-- Main Content -->
	<div class="container-fluid">
	    <div class="side-body padding-top">
	        <div class="row">

	            <div class="col-xs-12">
                           <div class="alert fresh-color alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                Selamat Datang, <strong><?= $this->session->userdata('data')['nama'];?></strong>
                            </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <a href="#">
                        <div class="card red summary-inline">
                            <div class="card-body">
                                <i class="icon fa fa-inbox fa-4x"></i>
                                <div class="content">
                                    <div class="title"><?php echo $alat->num_rows();?></div>
                                    <div class="sub-title">Total Alat</div>
                                </div>
                                <div class="clear-both"></div>
                            </div>
                        </div>
                    </a>
                </div>
                <?php if($this->session->userdata('status') == 'admin'):?>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <a href="#">
                                <div class="card green summary-inline">
                                    <div class="card-body">
                                        <i class="icon fa fa-dollar fa-4x"></i>
                                        <div class="content">
                                            <div class="title"><?php echo $dp->num_rows();?></div>
                                            <div class="sub-title">Pembayaran DP</div>
                                        </div>
                                        <div class="clear-both"></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                 <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <a href="#">
                                <div class="card yellow summary-inline">
                                    <div class="card-body">
                                        <i class="icon fa fa-dollar fa-4x"></i>
                                        <div class="content">
                                            <div class="title"><?php echo $lunas->num_rows();?></div>
                                            <div class="sub-title">Pelunasan</div>
                                        </div>
                                        <div class="clear-both"></div>
                                    </div>
                                </div>
                            </a>
                        </div>
				<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <a href="#">
                                <div class="card blue summary-inline">
                                    <div class="card-body">
                                        <i class="icon fa fa-share-alt fa-4x"></i>
                                        <div class="content">
                                            <div class="title"><?php echo $belumbayar->num_rows();?></div>
                                            <div class="sub-title">Belum Bayar</div>
                                        </div>
                                        <div class="clear-both"></div>
                                    </div>
                                </div>
                            </a>
                        </div>                        
                    <?php endif;?>
	        </div>
	        
	    </div>
	</div>
</div>