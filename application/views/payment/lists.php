	<!-- Main Content -->
	<div class="container-fluid">
	                    <div class="side-body">
                    <div class="page-title">
                        <span class="title">Data Pembayaran</span>
                        <!-- <div class="description">with jquery Datatable for display data with most usage functional. such as search, ajax loading, pagination, etc.</div> -->
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                        <?php if($this->session->flashdata('sukses')):?>
			               <div class="alert fresh-color alert-success alert-dismissible" role="alert">
			                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
			                    <?= $this->session->flashdata('sukses');?>
			                </div>
			            <?php endif;?>
                            <div class="card">
                                <div class="card-header">

                                    <!-- <div class="card-title"> -->
                                    <div class="title pull-right">
                                    	<!-- <button type="button" class="btn btn-primary">Primary</button> -->
                                    	<!-- <a href="<?=site_url('alat/add');?>" class="btn btn-primary">Tambah</a> -->
                                    </div>
                                    <!-- </div> -->
                                </div>
                                <div class="card-body">
                                <?php if($pembayaran_detail):?>
                                    <table class="datatable table table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Pembayaran ID</th>
                                                <th>Tipe Pembayaran</th>
                                                <th>Status Pembayaran</th>
                                                <th>Total Pembayaran</th>
                                                <th>Bukti Pembayar</th>
                                                <th>Tanggal Pembayar</th>
                                                <?php if($this->session->userdata('jabatan') == '1'):?>
                                                <th>Aksi</th>
                                                <?php endif;?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($pembayaran_detail as $t):?>
                                            <tr>
                                                <td><?= $t->pembayaran_id;?></td>
                                                <td><?= convert_config('tipe_bayar',$t->tipe_bayar);?></td>
                                                <td><?= convert_config('status_bayar_detail',$t->status_bayar);?></td>
                                                <td>Rp. <?= $t->jumlah_bayar;?></td>
                                                <td><img src="<?=base_url('uploads/'.$t->bukti_bayar);?>" height="100px" width="100px"></td>
                                                <td><?= date('d-m-Y',strtotime($t->tgl_bayar));?></td>
                                                <?php if(($this->session->userdata('jabatan') == '1') && ($t->status_bayar == 1)):?>
                                                    <td>
                                                        <a href="<?=site_url('payment/approve/'.$t->pembayaran_id.'/'.$t->tipe_bayar.'/'.$t->id);?>" class="btn btn-success">Terima</a>
                                                        <!-- <a href="<?=site_url('payment/reject/'.$t->pembayaran_id);?>" class="btn btn-danger">Tolak</a> -->
                                                    </td>
                                                
                                                <?php endif;?>
                                                <!-- <td>
                                                    <a href="<?=site_url('customer/edit/'.$t->id);?>" class="btn btn-info">Edit</a>
                                                    <a href="<?=site_url('customer/destroy/'.$t->id);?>" class="btn btn-danger">Hapus</a>
                                                </td> -->
                                            </tr>
                                        <?php endforeach;?>
                                        </tbody>
                                    </table>
                            <?php endif;?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
	</div>
</div>