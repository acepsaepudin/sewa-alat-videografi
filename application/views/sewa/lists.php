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
                                                <th>ID Pembayaran</th>
                                                <th>Tanggal Input</th>
                                                <th>Total Bayar</th>
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
                                                <td><?=$v->tanggal_input?></td>
                                                <td>Rp.<?=$v->total_harga?></td>
                                                <td>
                                                    <a href="<?=site_url('/');?>" class="btn btn-info">Detail</a>
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
