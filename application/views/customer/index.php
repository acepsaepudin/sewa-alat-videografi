	<!-- Main Content -->
	<div class="container-fluid">
	                    <div class="side-body">
                    <div class="page-title">
                        <span class="title">Data Customer</span>
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
                                    	<a href="<?=site_url('customer/add');?>" class="btn btn-primary">Tambah</a>
                                    </div>
                                    <!-- </div> -->
                                </div>
                                <div class="card-body">
                                    <table class="datatable table table-striped" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>ID Customer</th>
                                                <th>Nama</th>
                                                <th>Password</th>
                                                <th>Email</th>
                                                <th>Alamat</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <!-- <tfoot>
                                            <tr>
                                                <th>Nama</th>
                                                <th>Deskripsi</th>
                                                <th>Stok</th>
                                                <th>Harga Per Hari</th>
                                            </tr>
                                        </tfoot> -->
                                        <tbody>
                                        <?php foreach($customer->result() as $t):?>
                                        	<tr>
                                                <td><?= $t->id;?></td>
                                                <td><?= $t->nama;?></td>
                                                <td><?= $t->password;?></td>
                                                <td><?= $t->email;?></td>
                                                <td><?= $t->alamat;?></td>
                                                <td><?= ($t->status == 1) ? 'Aktif': 'Non Aktif' ;?></td>
                                                <td>
                                                	<a href="<?=site_url('customer/edit/'.$t->id);?>" class="btn btn-info">Edit</a>
                                                    <?php if($t->status == 1):?>
                                                    <a href="<?=site_url('customer/non_aktif/'.$t->id);?>" class="btn btn-danger">Non Aktif</a>
                                                    <?php else:?>
                                                    <a href="<?=site_url('customer/aktif/'.$t->id);?>" class="btn btn-success">Aktif</a>
                                                <?php endif;?>
                                                </td>
                                            </tr>
                                        <?php endforeach;?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
	</div>
</div>