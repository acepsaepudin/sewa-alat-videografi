	<!-- Main Content -->
	<div class="container-fluid">
	                    <div class="side-body">
                    
                <?php if($sewa):?>
                    <div class="page-title">
                        <span class="title">Daftar Sewa</span>
                        <!-- <div class="description"></div> -->
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

                                    <div class="card-title">
                                    <div class="title">Table</div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>ID Sewa</th>
                                                <th>Tanggal Input</th>
                                                <th>Total Bayar</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        $i = 1;
                                        foreach($sewa as $k => $v):?>
                                            <tr>
                                                <th scope="row"><?=$i;?></th>
                                                <td><?=$v->id?></td>
                                                <td><?=date('d-m-Y',strtotime($v->tanggal_input));?></td>
                                                <td>Rp.<?=$v->total_harga?></td>
                                                <td><?=convert_config('status_sewa',$v->status);?></td>
                                                <td>
                                                    <a href="<?=site_url('sewa/list_details/'.$v->id);?>" class="btn btn-info">Detail</a>
                                                </td>
                                            </tr>
                                        <?php 
                                        
                                        $i++;
                                        endforeach;?>
                                        </tbody>
                                    </table> 
                                    <!-- <a href="<?=site_url('sewa/store_all_item');?>" class="btn btn-success pull-right">Selesai</a> -->
                                </div>
                            </div>
                        </div>

                    </div>
                <?php endif;?>
                </div>
	</div>

</div>
