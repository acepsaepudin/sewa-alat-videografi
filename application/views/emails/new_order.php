<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<h3>Hi <?=$data['nama'] ?>,</h3>
	<p>Terima kasih Anda telah melakukan penyewaan alat Pondok Traveller. Dengan detail: </p>
	<table border="1px solid;" width="100%">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($data['alat'] as $t):?>
        	<tr>
                <td><?= $t->nama;?></td>
                <td><?= $t->jumlah;?></td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table><br>
    <table>
    	<tr>
    		<td><strong>Total Bayar</strong></td>
    		<td>: Rp. <?=number_format($data['sewa']->total_harga,2,",",".");?></td>
    	</tr>
    	<tr>
    		<td><strong>Total Hari</strong></td>
    		<td>: <?=$data['sewa']->total_hari;?> Hari</td>
    	</tr>
    </table><br>
    <p>Silahkan melakukan pembayaran DP minimal 50% dari total yang harus dibayar.</p>
	<br><br>
	<p>Terima Kasih,</p>
	<br></br>
	<p>Pondok Traveler.</p>
</body>
</html>