	<!-- Main Content -->
	<div class="container-fluid">
	                    <div class="side-body">
                    <div class="page-title">
                        <span class="title">List Sewa</span>
                        <!-- <div class="description">with jquery Datatable for display data with most usage functional. such as search, ajax loading, pagination, etc.</div> -->
                    </div>

                    <div class="row">
                        <div class="col-xs-12">
                            <div class="card">
                                <div class="card-header">

                                    <div class="card-title">
                                    <div class="title"></div>
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
                                    
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                    	<div class="col-xs-12">
                    		<?php if(validation_errors()):?>
				               <div class="alert fresh-color alert-danger alert-dismissible" role="alert">
				                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
				                    <?php echo validation_errors();?>
				                </div>
				            <?php endif;?>
                    		<div class="card-body">
                            <form class="form-horizontal" method="post" action="<?=site_url('sewa/input_sewa');?>">
                                <div class="form-group" >
                                    <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Sewa</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="tgl_sewa" class="form-control" id="datepicker" onkeydown="return false" value="<?=set_value('tgl_sewa')?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Total Hari</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="total_hari" class="form-control" id="inputEmail3" value="<?=set_value('total_hari')?>">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                        <a href="<?=site_url('sewa/add');?>" class="btn btn-default">Kembali</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    	</div>
                    </div>
                    </div>
                    </div>
                    </div>