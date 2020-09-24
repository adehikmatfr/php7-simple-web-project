<?php 
require '../sql/index.php';
$src="Sedang Di Panen Saat Ini";
$key=$_GET['key'];
$harini=date('d-m-Y');
$sekarang=strtotime($harini);
$carihari=strtotime($key)*60*60*24;
$hari=$sekarang-$carihari;
var_dump($sekarang/60/60/24);die;
  if($hari==0){
    $src="Sedang Di Panen saat ini";
  }else if($hari==1){
    $src="Sudah Di Panen Kemarin";
  }else if($hari==-1){
    $src="Akan Di Panen Besok";
  }else if($hari>31){
    $src="Akan Di Panen Bulan lalu";
  }else if($hari>-31){
    $src="Akan Di Panen Bulan depan";   
  }
$row="SELECT * FROM stup,anggota,jenis,panen,hasil WHERE anggota.id_anggota=stup.id_anggota and jenis.id_jenis=stup.id_jenis and stup.id_stup=panen.id_stup and hasil.id_hasil=panen.id_hasil AND panen.panen like '%$key%'";
$ku=tampil($row);

 ?>
 <?php
    if(empty($ku)):   
 ?>
 <h3 class="text-danger mt-5">Data Tidak Di Temukan</h3>
 <img src="../admin/img/src.gif" alt="img" class="img-fluid" style="max-width:200px;margin-left:100px;">
 <?php endif;?>
 <?php if(!empty($ku)):?>
 <!-- tabel -->
 <h3 class="mt-3 mb-2">Stup Yang <?=$src;?></h3> 
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
                   </tr>
                   </thead>
                   <tbody>
                   <?php 
                   $aa=1;
                   foreach($ku as $u):
                    ?>
                   <tr>
                   <td><?=$aa?></td>
                   <td><?=$u['nama']?></td>
                   <td><?=$u['code_stup']?></td>
                   <td><?=$u['nama_jenis']?></td>
                   <td><?= date('d-m-Y',$u['lebah_masuk'])?></td>
                   <td><?=$u['panen']?></td>
                   <td><?=$u['jumlah']?> Liter</td>
                   </tr>
                   <?php $aa++; endforeach;?>
                   </tbody>
                  </table>
                </div>
              
          </div>
          <!-- table -->
                   <?php endif;?>