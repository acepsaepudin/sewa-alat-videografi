	<!-- Main Content -->
	<div class="container-fluid">
	                    <div class="side-body">
                    
                <?php if($details):?>
                    <div class="page-title">
                        <span class="title">Daftar Sewa Detail</span>
                        <!-- <div class="description"></div> -->
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
                                                <th>No</th>
                                                <th>Nama Alat</th>
                                                <th>Jumlah</th>
                                                <!-- <th>Aksi</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        $i = 1;
                                        foreach($details as $k => $v):?>
                                            <tr>
                                                <th scope="row"><?=$i;?></th>
                                                <td><?=$v->nama_alat?></td>
                                                <td><?=$v->jumlah?></td>
                                                <!-- <td>
                                                    <a href="<?=site_url('/');?>" class="btn btn-info">Detail</a>
                                                </td> -->
                                            </tr>
                                        <?php 
                                        
                                        $i++;
                                        endforeach;?>

                                        </tbody>
                                    </table>
                                    <?php if(($sewa->status == 1) && $this->session->userdata('status') == 'admin'):?>
                                    <a href="<?=site_url('sewa/kirim/'.$id_sewa);?>" class="btn btn-success pull-right">Kirim</a>
                                <?php endif;?>
                                    <a href="<?=site_url('sewa/lists');?>" class="btn btn-default pull-left">Kembali</a>
                                </div>
                            </div>
                        </div>

                    </div>
                <?php endif;?>
                </div>
	</div>

</div>
