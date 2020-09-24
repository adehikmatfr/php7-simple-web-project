<?php
require '../vendor/autoload.php';
function prin($data){
    $id=$_SESSION['nik'];
    $stup=$data['code'];
    $bln=$data['bln'];
    $thn=$data['tahun'];
      if(empty($thn)&&empty($bln)){
        $thn=date('Y');
        $bln=date('m');
      }else if(empty($bln)){
        $bln=date('m');
      }else if(empty($thn)){
        $thn=date('Y');
      }
    $bul="$thn-$bln";
    // logic bulan dan th
    $wkt=strtotime($bul);
    $day=$wkt-3600*24*30;
  
    // echo date('m-Y',$wkt)." ".date('m-Y',$day);

    if(!empty($id)&&!empty($stup)&&!empty($bln)&&!empty($thn)){
      $ku="SELECT DISTINCT(pemeliharaan.id_pemeliharaan),anggota.nama,anggota.nik,anggota.jk,anggota.alamat,stup.code_stup,jenis.nama_jenis,pemeliharaan.keadaan,pemeliharaan.penanganan,pemeliharaan.keterangan,pemeliharaan.waktu,pemeliharaan.photo,pemeliharaan.period, anggota.id_anggota,stup.id_stup FROM stup,anggota,jenis,pemeliharaan WHERE anggota.id_anggota=stup.id_anggota and jenis.id_jenis=stup.id_jenis and stup.id_stup=pemeliharaan.id_stup and (anggota.id_anggota = '$id' AND stup.id_stup='$stup' AND pemeliharaan.waktu >=$day<=$wkt) ORDER BY pemeliharaan.id_pemeliharaan ASC";
    }
 
    $ku=tampil($ku);
    $de=$ku[0]["period"];

    $html='
    <!DOCTYPE html>
    <html>
    <head>
      <title></title>
      <style type="text/css">
    .tab1 {
        font-family: sans-serif;
        color: #232323;
        border-collapse: collapse;
    }
     
    .tab1, th, td {
        border: 1px solid #999;
        padding: 8px 20px;
    }
    .tab2 {
        font-family: sans-serif;
        color: #232323;
        border-collapse: collapse;
    }
     
    .tab2 .td {
        border: 0px solid #999;
        padding: 8px 20px;
    }
      </style>
    </head>
    <body>
    <center><h3 style="">Laporan Pemeliharaan Madu KTH Bina Lestari</h3></center>';
    $html.='
    <table class="tab2" cellpadding="5">
    <tr>
                       <td class="td">NIK</td>
                       <td class="td"> : '.$ku[0]["nik"].'</td>
    </tr>
    <tr>                   
                       <td class="td">Nama </td>
                       <td class="td"> : '.$ku[0]["nama"].'</td>
    </tr>
    <tr>
                       <td class="td">Jenis Kelamin </td>
                       <td class="td"> : '.$ku[0]["jk"].'</td>
    </tr>
    <tr>
                       <td class="td">Alamat </td>
                       <td class="td"> : '.$ku[0]["alamat"].'</td>
    </tr>
    <tr>
                       <td class="td">ID Anggota</td>
                       <td class="td"> : '.$ku[0]['id_anggota'].'</td>
    </tr>';
    $html.='</table>';
      $html.='<center><h3 style="">Data Pemeliharaan Tahun '.date('Y',$wkt).'</h3></center> 
    <table class="tab1">
    <tr style="">
                       <th>No</th>
                       <th>Code Stup</th>
                       <th>Keadaan</th>
                       <th>Keterangan</th>
                       <th>Penanganan</th>
                       <th>Waktu Pemeriksaan</th>
    </tr>';
    $a=1;
    foreach ($ku as $u) {
       $html.='<tr>
    
                       <td>'.$a.'</td>
                       <td>'.$u["code_stup"].'</td>
                       <td>'.$u["keadaan"].'</td>
                       <td>'.$u["keterangan"].'</td>
                       <td>'.$u["penanganan"].'</td>
                       <td>'.date("d-m-Y",$u["waktu"]).'</td>
    
             </tr>';
             $a++;
    }
    $str="SELECT * FROM real_panen WHERE periode=$de";
    $row=tampil();
    $html.='<tr>
<th colspan="5">Hasil Panen</th>
<td>'.$row[0]["hasil"].' Liter</td>
</tr>';
    
    $html.='
    </table>
    
    </body>
    </html>
     ';
    
    
    
    
    
     $mpdf=new \Mpdf\Mpdf();
     $mpdf->WriteHTML($html);
     $mpdf->Output();




  
  }