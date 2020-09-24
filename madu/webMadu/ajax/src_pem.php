<?php 
require '../sql/index.php';

$key=$_GET['key'];

$ka="SELECT DISTINCT(pemeliharaan.id_pemeliharaan),anggota.nama,stup.code_stup,jenis.nama_jenis,pemeliharaan.keadaan,pemeliharaan.penanganan,pemeliharaan.keterangan,pemeliharaan.waktu,pemeliharaan.photo, anggota.id_anggota FROM stup,anggota,jenis,pemeliharaan WHERE anggota.id_anggota=stup.id_anggota and jenis.id_jenis=stup.id_jenis and stup.id_stup=pemeliharaan.id_stup and (anggota.id_anggota like '%$key%' OR anggota.nama like '%$key%' OR stup.code_stup like '%$key%' OR jenis.nama_jenis like '%$key%' OR pemeliharaan.keadaan like '%$key%' OR pemeliharaan.keterangan like '%$key%' OR pemeliharaan.penanganan like '%$key%' OR pemeliharaan.waktu like '%$key%') ORDER BY pemeliharaan.id_pemeliharaan DESC";

$ku=mysql_query($ka);
$row=[];
WHILE($rows = mysql_fetch_assoc($ku)){
     $row[]=$rows;
}

 ?>
 <?php
    if(empty($row)):   
 ?>
 <h3 class="text-danger mt-5">Data Tidak Di Temukan</h3>
 <img src="../admin/img/src.gif" alt="img" class="img-fluid" style="max-width:200px;margin-left:100px;">
 <?php endif;?>
 <?php if(!empty($row)):?>
 <div class="row justify-content-center mt-2" id='con'>
<!-- tabel -->
        <h3 class="mt-3 mb-2">Data Riwayat Pemeliharaan</h3> 
            <div class="container table-responsive" style="overflow-y: hidden;">
                <div data-role="main" class="ui-content">
                  <table data-role="table" class="table table-sm table-hover table-dark" >
                   <thead>
                   <tr>
                   <th>No</th>
                   <th>Nama</th>
                   <th>Code Stup</th>
                   <th>Jenis-lebah</th>
                   <th>Keadaan</th>
                   <th>Keterangan</th>
                   <th>Penanganan</th>
                   <th>Waktu Pemeriksaan</th>
                   <th>Aksi</th>
                   </tr>
                   </thead>
                   <tbody>
                  <?php 
                   $aa=1;
                   foreach($row as $u):
                    ?>
                   <tr>
                   <td><?=$aa?></td>
                   <td><?=$u['nama']?></td>
                   <td><?=$u['code_stup']?></td>
                   <td><?=$u['nama_jenis']?></td>
                   <td><?=$u['keadaan']?></td>
                   <td><?=$u['keterangan']?></td>
                   <td><?=$u['penanganan']?></td>
                   <td><?=date('d-m-Y',$u['waktu'])?></td>
                   <td><a href="hapus.php?id=<?=$u['id_pemeliharaan']?>&t=pemeliharaan&f=id_pemeliharaan&a=pemeliharaan.php" class="btn btn-danger btn-sm" onclick="return confirm('apakah anda yakin ?');">Hapus</a> <a href="" data-toggle="modal" data-target="#dat<?=$u['id_pemeliharaan']?>" class="btn btn-info btn-sm">Edit</a></td>
                   </tr>
                   <?php $aa++; endforeach;?>
                   </tbody>
                  </table>
                </div>
              
          </div>
          <!-- table -->
      </div>
                   <?php endif;?>