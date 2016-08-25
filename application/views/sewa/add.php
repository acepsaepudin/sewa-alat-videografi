	<!-- Main Content -->
	<div class="container-fluid">
	                    <div class="side-body">
                    <div class="page-title">
                        <span class="title">Input Sewa</span>
                        <!-- <div class="description">with jquery Datatable for display data with most usage functional. such as search, ajax loading, pagination, etc.</div> -->
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                        <!-- Button trigger modal -->
                                        <!-- <button type="button" class="btn btn-primary btn-success" data-toggle="modal" data-target="#modalSuccess">
                                            Modal Success
                                        </button> -->

                                        <!-- Modal -->
                                        <div class="modal fade modal-success" id="modalSuccess" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="myModalLabel">Input Sewa</h4>
                                                    </div>
                                                        <form method="post" action="<?=site_url('sewa/add_item');?>" class="form-horizontal add_item_alat">
                                                            <div class="modal-body">
                                                                    <div class="form-group form-jumlah">
                                                                        <label for="jmlnya" class="col-sm-2 control-label">Jumlah</label>
                                                                        <div class="col-sm-10">
                                                                            <input type="hidden" name="alat_id" class="form-control" id="alat_id">
                                                                            <input type="text" name="jumlah" class="form-control" id="jmlnya">
                                                                            <span style="color:red;display: none;" id="errorjumlah">Jumlah Tidak Boleh Kosong Atau Melebihi Stok </span>
                                                                        </div>
                                                                    </div>
                                                                    <!-- <div class="form-group form-start form-end">
                                                                        <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Sewa</label>
                                                                        <div class="col-sm-10">
                                                                            <div class="input-daterange input-group" id="datepicker">
                                                                                <input type="text" class="input-sm form-control" name="start" onkeydown="return false"/>
                                                                                <span class="input-group-addon">Sampai</span>
                                                                                <input type="text" class="input-sm form-control" name="end" onkeydown="return false"/>
                                                                            </div>
                                                                        </div>

                                                                    </div> -->
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                                                <button type="submit" class="btn btn-success">Tambah</button>
                                                            </div>
                                                        </form>
                                                </div>
                                            </div>
                                        </div>
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
                                    <table class="datatable table table-striped" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th>Deskripsi</th>
                                                <th>Stok</th>
                                                <th>Harga Per Hari</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Nama</th>
                                                <th>Deskripsi</th>
                                                <th>Stok</th>
                                                <th>Harga Per Hari</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                        <?php foreach($alat->result() as $t):?>
                                        	<tr>
                                                <td><?= $t->nama;?></td>
                                                <td><?= $t->deskripsi;?></td>
                                                <td><?= $t->stok;?></td>
                                                <td>Rp. <?= $t->harga_harian;?></td>
                                                <td>
                                                	<!-- <a href="<?=site_url('alat/edit/'.$t->id);?>" class="btn btn-info">Edit</a> -->
                                                    <?php if($this->session->userdata('jabatan') == 3):?>
                                                	<a href="<?=site_url('sewa/edit/'.$t->id);?>" class="btn btn-danger">Edit</a>
                                                    <?php endif;?>
                                                    <?php if($this->session->userdata('status') == 'user'):?>
                                                        <?php ?>
                                                    <button class="btn btn-info" onclick="item_add(<?=$t->id?>)" <?php if(isset($_SESSION['tmp_sewa'])){ foreach($_SESSION['tmp_sewa'] as $s){ if($t->id == $s['alat_id']){ echo 'disabled';}}};?>>Sewa</button >
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
                <?php if($this->session->userdata('tmp_sewa')):?>
                    <div class="page-title">
                        <span class="title">Daftar Sewa</span>
                        <!-- <div class="description"></div> -->
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="card">
                                <div class="card-header">

                                    <div class="card-title">
                                    <div class="title">Table</div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama Alat</th>
                                                <th>Jumlah Alat</th>
                                                <th>Sewa / Hari</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        $i = 1;
                                        $tot = 0;
                                        foreach($sewa as $k => $v):?>
                                            <tr>
                                                <th scope="row"><?=$i;?></th>
                                                <td><?=$v['nama_alat'];?></td>
                                                <td><?=$v['jumlah'];?></td>
                                                <td>Rp. <?=$v['total'];?></td>
                                                <td>
                                                    <a href="<?=site_url('sewa/delete_item/'.$k);?>" class="btn btn-danger">Hapus</a>
                                                </td>
                                            </tr>
                                        <?php 
                                        $tot +=$v['total'];
                                        $i++;
                                        endforeach;?>
                                            <tr>
                                                <td ><strong>Total Sewa Perhari</strong></td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>Rp. <?=$tot;?></td>
                                            </tr>
                                        </tbody>
                                    </table> 
                                    <a href="<?=site_url('sewa/store_all_item');?>" class="btn btn-success pull-right">Proses Selanjutnya</a>
                                </div>
                            </div>
                        </div>

                    </div>
                <?php endif;?>
                </div>
	</div>

</div>
