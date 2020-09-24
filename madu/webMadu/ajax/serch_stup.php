<?php 
require '../sql/index.php';

$key=$_GET['key'];

$ka="SELECT a.*,b.*,c.* FROM stup a JOIN anggota b USING(id_anggota) JOIN jenis c USING(id_jenis) WHERE a.code_stup like '%$key%' or b.nama like '%$key%' or c.nama_jenis like '%$key%' order by a.id_stup DESC";
$ku=tampil($ka);

 ?>
 <?php
    if(empty($ku)):   
 ?>
 <h3 class="text-danger mt-5">Data Tidak Di Temukan</h3>
 <img src="../admin/img/src.gif" alt="img" class="img-fluid" style="max-width:200px;margin-left:100px;">
 <?php endif;?>
 <?php if(!empty($ku)):?>
 <!-- tabel -->
        <h3 class="mt-3 mb-2">Daftar Stup</h3> 
            <div class="container table-responsive" style="overflow-y: hidden;">
                <div data-role="main" class="ui-content">
                  <table data-role="table" class="table table-sm table-hover table-dark" >
                   <thead>
                   <tr>
                   <th>No</th>
                   <th>Pemilik</th>
                   <th>Code Stup</th>
                   <th>Bahan Stup</th>
                    <th>Aksi</th>
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
                   <td>
<a href="hapus.php?id=<?=$u['id_stup']?>&t=stup&f=id_stup&a=stup" onclick="return confirm('Apakah anda yakin ingin mengpus data?');" class="btn btn-danger btn-sm">hapus</a>
<a href=""  data-toggle="modal" data-target="#dat<?=$u['id_stup']?>" class="btn btn-info ml-3 btn-sm">Edit</a>
                  </td>
                   </tr>
                   <?php $aa++; endforeach;?>
                   </tbody>
                  </table>
                </div>
              
          </div>
          <!-- table -->
                   <?php endif;?>