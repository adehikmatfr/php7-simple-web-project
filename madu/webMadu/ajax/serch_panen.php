<?php 
require '../sql/index.php';

$key=$_GET['key'];

// $ka="SELECT a.*,b.*,c.*,d.*,e.* FROM panen a,anggota b,stup c,hasil d,bahan e Where a.nik=b.nik and a.id_stup=c.id_stup and a.id_hasil=d.id_hasil and c.id_bahan=e.id_bahan and (b.nama like '%$key%' OR c.code_stup LIKE '%$key%' OR e.nama_bahan LIKE '%$key%' OR a.lebah_masuk LIKE '%$key%' OR d.jumlah like '%$key%') ORDER BY a.id_panen DESC";
$ka="SELECT a.*,b.*,c.*,d.*,e.* FROM panen a,anggota b,stup c,hasil d,jenis e Where a.id_anggota=b.id_anggota and a.id_stup=c.id_stup and a.id_hasil=d.id_hasil and c.id_jenis=e.id_jenis and (b.nama like '%$key%' OR c.code_stup LIKE '%$key%' OR e.nama_jenis LIKE '%$key%' OR a.lebah_masuk LIKE '%$key%' OR d.jumlah like '%$key%' OR a.panen like '%$key%') ORDER BY a.id_panen DESC";
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
 <!-- tabel -->
 <h3 class="mt-3 mb-2">Data Panen</h3> 
            <div class="container table-responsive" style="overflow-y: hidden;">
                <div data-role="main" class="ui-content">
                  <table data-role="table" class="table table-sm table-hover table-dark" >
                   <thead>
                   <tr>
                   <th>No</th>
                   <th>Pemilik</th>
                   <th>Code Stup</th>
                   <th>Jenis Lebah</th>
                   <th>Masuk Lebah</th>
                   <th>Panen</th>
                   <th>Hasil Minimum</th>
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
                   <td><?= date('d-m-Y',$u['lebah_masuk'])?></td>
                   <td><?=$u['panen']?></td>
                   <td><?=$u['jumlah']?> Liter</td>
                    <td>
<a href="hapus.php?id=<?=$u['id_panen']?>&t=panen&f=id_panen&a=panen.php" onclick="return confirm('Apakah anda yakin ingin mengpus data?');" class="btn btn-danger btn-sm">hapus</a>
        <a href=""  data-toggle="modal" data-target="#dat<?=$u['id_panen']?>" class="btn btn-info ml-3 btn-sm">Edit</a>
                  </td>
                   </tr>
                   <?php $aa++; endforeach;?>
                   </tbody>
                  </table>
                </div>
              
          </div>
          <!-- table -->
                   <?php endif;?>