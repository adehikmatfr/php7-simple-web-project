<?php
session_start();
require "../sql/index.php";
require "../validasi/index.php";
require "../random/index.php";

$string="SELECT * FROM users WHERE level='1'";
$tampil=tampil($string);
$username=md5($tampil[0]['username']);
$lev=md5($tampil[0]['level']);
// cek dulu cookies nya

if(isset($_COOKIE['72d4b2a056788e501159c1671c272d74'])){
   if($_COOKIE['72d4b2a056788e501159c1671c272d74']!=$lev){
	echo"
	<script>
	document.location.href='../login.php';
	</script> 
	 ";
   }else{
	$_SESSION['user']=$username;
	$_SESSION['level']=$lev;
   }
}
// cari user admin
if(!$_SESSION){
  echo"
 <script>
 alert('Punten Anjen Kedah Login Hela!');
 document.location.href='../login.php';
 </script> 
  ";
}

if($_SESSION['user']!==$username && $_SESSION['level']!==$lev){
	echo"
	<script>
	alert('Bade ngehack nya?');
	document.location.href='../hack.php';
	</script> 
	 ";
}


// logo
$tp="SELECT * FROM logo WHERE untuk='cdk'";
$pt=tampil($tp);
$logo=$pt[0]['nama_logo'];
if(isset($_POST['tkth'])){
    // validasi text valid
    $nkth=tv($_POST["nama"]);
    $akth=tv($_POST["alamat"]);
    $ukth=tv($_POST["url"]);
    $jkth=tv($_POST["jml"]);

    $masuk=true;
    // data tidak boleh kosong
    $nempty=kosong($nkth);
    // validasi nama harus sesuai tidak boleh mengandung karakter
    $non_char=non_karakter($nkth);
    // nama telah terdaftar di database
    $non_nama=cekdb("SELECT * FROM kth WHERE nama_kth='$nkth'");
    // berikan kondisi
    if($nempty){
      $non_valid="show";
      $massage="Nama Hari Di Isi";
      $masuk=false;
    }
    else if($non_char){
      $non_valid="show";
      $massage="Anda hanya Boleh memasukan huruf,angka dan spasi";
      $masuk=false;
    }else if($non_nama>=1){
     $non_valid="show";
      $massage="Nama $nkth Sudah terdaftar";
      $masuk=false;
    }
    // validasi alamat
    $alamat_kosong=kosong($akth);
    $alamat_tex=tex($akth);
    if($alamat_kosong){
     $anon_valid="show";
     $amassage="Alamat Harus Di Isi";
     $masuk=false;
    }else if($alamat_tex){
     $anon_valid="show";
     $amassage="Anda Hanya Boleh memaukan huruf,angka,(,)koma, spasi dan (.)titik";
     $masuk=false;
    }
    // validasi URL
    $url_kosong=kosong($ukth);
       if($url_kosong){
     $unon_valid="show";
     $umassage="URL Harus Di Isi";
     $masuk=false;
    }
    // validasi jumlah
    $jml_kosong=kosong($jkth);
    $jml_char=angka($jkth);
    if($jml_kosong){
     $jnon_valid="show";
     $jmassage="Jumlah Harus Di Isi";
     $masuk=false;
    }
    else if($jml_char){
     $jnon_valid="show";
     $jmassage="Yang anda masukan buan angka";
     $masuk=false;
    }
    else if($jkth<0){
     $jnon_valid="show";
     $jmassage="Jumlah Tidak boleh kurang dari Nol";
     $masuk=false;
    }
    // jika sudah di sleksi maka maukan ke dalam database
    if($masuk){
    $q="INSERT INTO kth VALUES ('','$nkth','$akth','$ukth','$jkth')";
    $rss=iud($q);
      if($rss>0){
        $valid="show";
        $vmassage="SELAMAT! $nkth telah terdaftar";
      }else{
      	$valid="show";
        $vmassage="Oops! $nkth Gagal terdaftar";
      }
    }
    
}


// proses jabatan
    if(isset($_POST["tjabatan"])){
// validasi text
    	$nama=tv($_POST["nama"]);
    	// validasi nama jika sudah terdaftar
    	$q="SELECT * FROM jabatan WHERE nama_jabatan='$nama'";
    	$cek=cekdb($q);
    	$rss=tampil($q);
    	$tr=true;
    	// pastian nama tidak boleh sama
    	$nupper=strtoupper($nama); 
        $dbn=strtoupper($rss[0]['nama_jabatan']);
    	if($cek>0){
          $njnon_valid="show";
        $njmassage="Nama jabatan $nama Sudah Terdaftar";
        $tr=false;
    	}else if($nupper===$dbn){
    	 $njnon_valid="show";
        $njmassage="Nama jabatan $nama Sudah Ada";
        $tr=false;
    	}
    	// masukan ke database
    	if($tr){
    	$key="INSERT INTO jabatan VALUES ('','$nama')";
        $rs=iud($key);
        if($rs>0){
        $njvalid="show";
        $vmassage="SELAMAT! nama Jabatan $nama telah terdaftar";
        }else{
        $njvalid="show";
        $vmassage="Oops! nama Jabatan $nama gagal terdaftar";
        }
      }

    }

// tambah anggota
    $in="";
    $inN="";
    $inT="";
    $inJ="";
    $inA="";
    $inS="";
    $inP="";
    $inJS="";
    $inK="";
    $inJB="";
    $nikval="";
    $namval="";
    $tval="";
    $jval="";
    $aval="";
    $sval="";
    $pval="";
    $jsval="";
    $kval="";
    $jbval="";


    if (isset($_POST['tanggota'])) {
    	$nik=tv($_POST["nik"]);
    	$nama=tv($_POST["nama"]);
    	$ttl=tv($_POST["ttl"]);
    	$jk=tv($_POST["jk"]);
    	$alamat=tv($_POST["alamat"]);
    	$status=tv($_POST["status"]);
    	$pekerjaan=tv($_POST["pekerjaan"]);
    	$kth=tv($_POST["kth"]);
    	$stup=tv($_POST["stup"]);
    	$jabatan=tv($_POST["jabatan"]);
// $str="INSERT INTO anggota VALUES ('$nik','$nama','$ttl','$jk','$alamat','$status','$pekerjaan','$kth','$jabatan','$stup')";
// var_dump($str);die;
$validate=true;
        // validasi nik
$sva="SELECT * FROM anggota WHERE nik='$nik'";
        if (kosong($nik)) {
         	$in="is-invalid";
         	$cs="invalid-feedback";
         	$massage="NIK tidak boleh kosong!";
         	$validate=false;
         }else if(angka($nik)) {
                 $in="is-invalid";
	         	$cs="invalid-feedback";
	         	$massage="Yang Anda Masukan Bukan Angka!";
	         	$nikval=$nik;
	         	$validate=false;
         }else if(!len($nik,16)){
                $in="is-invalid";
	         	$cs="invalid-feedback";
	         	$massage="Angka yang anda Masukan Harus 16 Digit!";
	         	$nikval=$nik;
	         	$validate=false;
         }else if(cekdb($sva)){
                $in="is-invalid";
	         	$cs="invalid-feedback";
	         	$massage="NIK Sudah Terdaftar!";
	         	$nikval=$nik;
	         	$validate=false;
	         }else{
         	    $in="is-valid";
	         	$cs="valid-feedback";
	         	$massage="Sae Pisan !";
	         	$nikval=$nik;
         }

         // validasi nama
         if (kosong($nama)) {
         	$inN="is-invalid";
         	$csN="invalid-feedback";
         	$massageN="Nama Tidak boleh kosong!";
         	$validate=false;
         }else if (karakter($nama)){
            $inN="is-invalid";
         	$csN="invalid-feedback";
         	$massageN="Nama Haya boleh mengandung huruf!";
         	$namval=$nama;
         	$validate=false;
         }else if(!leng($nama,100)){
                $inN="is-invalid";
	         	$csN="invalid-feedback";
	         	$massageN="Nama terlalu panjang!";
	         	$namval=$nama;
	         	$validate=false;
         }else{
         	    $inN="is-valid";
	         	$csN="valid-feedback";
	         	$massageN="Sae Pisan!";
	         	$namval=$nama;
         }
         // validasi ttl
         if (kosong($ttl)) {
         	$inT="is-invalid";
         	$csT="invalid-feedback";
         	$massageT="Tempat Tanggal Lahir Tidak boleh kosong!";
         	$validate=false;
         }else if (tex($ttl)){
            $inT="is-invalid";
         	$csT="invalid-feedback";
         	$massageT="Tempat Tanggal Lahir Haya boleh mengandung huruf angka (.) (,)!";
         	$tval=$ttl;
         	$validate=false;
         }else if(!leng($ttl,100)){
                $inT="is-invalid";
	         	$csT="invalid-feedback";
	         	$massageT="Text terlalu panjang!";
	         	$tval=$ttl;
	         	$validate=false;
         }else{
         	    $inT="is-valid";
	         	$csT="valid-feedback";
	         	$massageT="Sae Pisan!";
	         	$tval=$ttl;
         }
         // validasi jk
         if(empty($jk)){
                $inJ="is-invalid";
	         	$csJ="invalid-feedback";
	         	$massageJ="Pilih Jenis Kelamin!";
	         	$validate=false;
         }else{
         	$inJ="is-valid";
	        $csJ="valid-feedback";
	        $massageJ="Sae Pisan !";
	        $jval=$jk;
         }
         // validasi alamat
                  if (kosong($alamat)) {
         	$inA="is-invalid";
         	$csA="invalid-feedback";
         	$massageA="Alamat Tidak boleh kosong!";
         	$validate=false;
         }else if (tex($alamat)){
            $inA="is-invalid";
         	$csA="invalid-feedback";
         	$massageA="Alamat Haya boleh mengandung huruf angka (.) (,)!";
         	$aval=$alamat;
         	$validate=false;
         }else if(!leng($alamat,100)){
                $inA="is-invalid";
	         	$csA="invalid-feedback";
	         	$massageA="Text terlalu panjang!";
	         	$aval=$alamat;
	         	$validate=false;
         }else{
         	    $inA="is-valid";
	         	$csA="valid-feedback";
	         	$massageA="Sae Pisan!";
	         	$aval=$alamat;
         }
                  // validasi status
         if(empty($status)){
                $inS="is-invalid";
	         	$csS="invalid-feedback";
	         	$massageS="Pilih Status!";
	         	$validate=false;
         }else{
         	$inS="is-valid";
	        $csS="valid-feedback";
	        $massageS="Sae Pisan !";
	        $sval=$status;
         }
         // validasi Pekerjaan
          if (kosong($pekerjaan)) {
         	$inP="is-invalid";
         	$csP="invalid-feedback";
         	$massageP="pekerjaan Tidak boleh kosong!";
         	$validate=false;
         }else if (tex($pekerjaan)){
            $inP="is-invalid";
         	$csP="invalid-feedback";
         	$massageP="pekerjaan Haya boleh mengandung huruf angka (.) (,)!";
         	$pval=$pekerjaan;
         	$validate=false;
         }else if(!leng($pekerjaan,100)){
                $inP="is-invalid";
	         	$csP="invalid-feedback";
	         	$massageP="Text terlalu panjang!";
	         	$pval=$pekerjaan;
	         	$validate=false;
         }else{
         	    $inP="is-valid";
	         	$csP="valid-feedback";
	         	$massageP="Sae Pisan!";
	         	$pval=$pekerjaan;
         }
         // kth
        if(empty($kth)){
                $inK="is-invalid";
	         	$csK="invalid-feedback";
	         	$massageK="Pilih KTH!";
	         	$validate=false;
         }else{
         	$inK="is-valid";
	        $csK="valid-feedback";
	        $massageK="Sae Pisan !";
	        $kval=$kth;
         }
                  // jabatan
        if(empty($jabatan)){
                $inJB="is-invalid";
	         	$csJB="invalid-feedback";
	         	$massageJB="Pilih jabatan!";
	         	$validate=false;
         }else{
         	$inJB="is-valid";
	        $csJB="valid-feedback";
	        $massageJB="Sae Pisan !";
	        $jbval=$jabatan;
         }
         // jumlah stup
         if(angka($stup)) {
                 $inST="is-invalid";
	         	$csST="invalid-feedback";
	         	$massageST="Yang Anda Masukan Bukan Angka!";
	         	$stval=$stup;
	         	$validate=false;
         }else{
         	    $inST="is-valid";
	         	$csST="valid-feedback";
	         	$massageST="Sae Pisan !";
	         	$stval=$stup;
         }

         // jika sukah masukan ke dalam database
      if ($validate) {
				// token random
				$token=random();
      	$str="INSERT INTO anggota VALUES ('','$nik','$nama','$ttl','$jk','$alamat','$status','$pekerjaan','$kth','$jabatan','$stup','$token')";
				$rsult=iud($str);
      	  if($rsult>0){
      	  	$in="";
		    $inN="";
		    $inT="";
		    $inJ="";
		    $inA="";
		    $inS="";
		    $inP="";
		    $inJS="";
		    $inK="";
		    $inJB="";
            $inST="";
		    $nikval="";
		    $namval="";
		    $tval="";
		    $jval="";
		    $aval="";
		    $sval="";
		    $pval="";
		    $jsval="";
		    $kval="";
		    $jbval="";
				$stval="";
           $valids="show";
            $massages="SELAMAT! Anggota Atas nama $nama Dengan Nomor NIK $nik Berhasil Di Tambahkan";
          }else{
          $valids="show";
          $massages="Oops! Anggota Atas nama $nama Dengan Nomor NIK $nik Gagal Di Tambahkan";
           }
      }
     

    }

// proses edit kth
    if(isset($_POST['kedit'])){
    // validasi text valid
    $nkth=tv($_POST["nama"]);
    $akth=tv($_POST["alamat"]);
    $ukth=tv($_POST["url"]);
    $jkth=tv($_POST["jml"]);
    $id=tv($_POST['kedit']);
    $masukk=true;
    // data tidak boleh kosong
    $nempty=kosong($nkth);
    // validasi nama harus sesuai tidak boleh mengandung karakter
    $non_char=non_karakter($nkth);
    // berikan kondisi
    if($nempty){
      $non_validd="show";
      $massagee="Nama Hari Di Isi";
      $masukk=false;
    }
    else if($non_char){
      $non_validd="show";
      $massage="Anda hanya Boleh memasukan huruf,angka dan spasi";
      $masukk=false;
    }
    // validasi alamat
    $alamat_kosong=kosong($akth);
    $alamat_tex=tex($akth);
    if($alamat_kosong){
     $anon_validd="show";
     $amassagee="Alamat Harus Di Isi";
     $masukk=false;
    }else if($alamat_tex){
     $anon_validd="show";
     $amassagee="Anda Hanya Boleh memaukan huruf,angka,(,)koma, spasi dan (.)titik";
     $masukk=false;
    }
    // validasi URL
    $url_kosong=kosong($ukth);
       if($url_kosong){
     $unon_validd="show";
     $umassagee="URL Harus Di Isi";
     $masukk=false;
    }
    // validasi jumlah
    $jml_kosong=kosong($jkth);
    $jml_char=angka($jkth);
    if($jml_kosong){
     $jnon_validd="show";
     $jmassagee="Jumlah Harus Di Isi";
     $masukk=false;
    }
    else if($jml_char){
     $jnon_validd="show";
     $jmassagee="Yang anda masukan buan angka";
     $masukk=false;
    }
    else if($jkth<0){
     $jnon_validd="show";
     $jmassagee="Jumlah Tidak boleh kurang dari Nol";
     $masukk=false;
    }
    // jika sudah di sleksi maka maukan ke dalam database
    if($masukk){
    $q="UPDATE kth set nama_kth='$nkth',alamat='$akth',maps='$ukth',anggota='$jkth' WHERE id_kth='$id'";
    $rss=iud($q);
      if($rss>0){
        $validd="show";
        $vmassagee="SELAMAT! $nkth telah terdaftar";
        echo "<script>
alert('selamat Anada berhasil mengubah');
document.location.href='kth.php#kt';
</script>";
      }else{
      	$validd="show";
        $vmassagee="Oops! $nkth Gagal terdaftar";
      }
    }
    
}


// proses edit jabatan
 
if(isset($_POST['jedit'])){
		$id=$_POST['jedit'];
      	$nama=tv($_POST["nama"]);
    	// validasi nama jika sudah terdaftar
    	$q="SELECT * FROM jabatan WHERE nama_jabatan='$nama'";
    	$cek=cekdb($q);
    	$rss=tampil($q);
    	$trs=true;
    	// pastian nama tidak boleh sama
    	$nupper=strtoupper($nama); 
        $dbn=strtoupper($rss[0]['nama_jabatan']);
    	if($cek>0){
          $nnjnon_valid="show";
        $nnjmassage="Nama jabatan $nama Sudah Terdaftar";
        $trs=false;
    	}else if($nupper===$dbn){
    	 $nnjnon_valid="show";
        $nnjmassage="Nama jabatan $nama Sudah Ada";
        $trs=false;
    	}
    	// masukan ke database
    	if($trs){
    	$key="UPDATE jabatan set nama_jabatan='$nama' WHERE id_jabatan='$id'";
        $rs=iud($key);
        if($rs>0){
        $nnjvalid="show";
        $vvmassage="SELAMAT! nama Jabatan $nama telah berhasil diubah";
echo "<script>
alert('selamat Anada berhasil mengubah');
document.location.href='kth.php#jb';
</script>";
        }else{
        $nnjvalid="show";
        $vvmassage="Oops! nama Jabatan $nama gagal terdaftar";
        }
      }
}

// edit anggota
            $inx="";
		    $inNx="";
		    $inTx="";
		    $inJx="";
		    $inAx="";
		    $inSx="";
		    $inPx="";
		    $inJSx="";
		    $inKx="";
		    $inJBx="";
if(isset($_POST['aedit'])){

    	$nik=tv($_POST["nik"]);
    	$nama=tv($_POST["nama"]);
    	$ttl=tv($_POST["ttl"]);
    	$jk=tv($_POST["jk"]);
    	$alamat=tv($_POST["alamat"]);
    	$status=tv($_POST["status"]);
    	$pekerjaan=tv($_POST["pekerjaan"]);
    	$kth=tv($_POST["kth"]);
    	$stup=tv($_POST["stup"]);
			$jabatan=tv($_POST["jabatan"]);
			$nikk=tv($_POST['aedit']);
			// dapatkan id anggota 
			$qer="SELECT id_anggota FROM anggota WHERE nik='$nikk'";
			$rsul=tampil($qer);
			$id=$rsul[0]['id_anggota'];

$validates=true;
        // validasi nik

        if (kosong($nik)) {
         	$inx="is-invalid";
         	$csx="invalid-feedback";
         	$massagex="NIK tidak boleh kosong!";
         	$validates=false;
         }else if(angka($nik)) {
                 $inx="is-invalid";
	         	$csx="invalid-feedback";
	         	$massagex="Yang Anda Masukan Bukan Angka!";
	         	$validates=false;
         }else if(!len($nik,16)){
                $inx="is-invalid";
	         	$csx="invalid-feedback";
	         	$massagex="Angka yang anda Masukan Harus 16 Digit!";
	         	
	         	$validates=false;
         }else{
         	    $inx="is-valid";
	         	$csx="valid-feedback";
	         	$massagex="Sae Pisan !";
	         
         }

         // validasi nama
         if (kosong($nama)) {
         	$inNx="is-invalid";
         	$csNx="invalid-feedback";
         	$massageNx="Nama Tidak boleh kosong!";
         	$validates=false;
         }else if (karakter($nama)){
            $inNx="is-invalid";
         	$csNx="invalid-feedback";
         	$massageNx="Nama Haya boleh mengandung huruf!";
    
         	$validates=false;
         }else if(!leng($nama,100)){
                $inNx="is-invalid";
	         	$csNx="invalid-feedback";
	         	$massageNx="Nama terlalu panjang!";
	         
	         	$validates=false;
         }else{
         	    $inNx="is-valid";
	         	$csNx="valid-feedback";
	         	$massageNx="Sae Pisan!";
         }
         // validasi ttl
         if (kosong($ttl)) {
         	$inTx="is-invalid";
         	$csTx="invalid-feedback";
         	$massageTx="Tempat Tanggal Lahir Tidak boleh kosong!";
         	$validates=false;
         }else if (tex($ttl)){
            $inTx="is-invalid";
         	$csTx="invalid-feedback";
         	$massageTx="Tempat Tanggal Lahir Haya boleh mengandung huruf angka (.) (,)!";
         	$validates=false;
         }else if(!leng($ttl,100)){
                $inTx="is-invalid";
	         	$csTx="invalid-feedback";
	         	$massageTx="Text terlalu panjang!";
	         	$validates=false;
         }else{
         	    $inTx="is-valid";
	         	$csTx="valid-feedback";
	         	$massageTx="Sae Pisan!";

         }
         // validasi jk
         if(empty($jk)){
                $inJx="is-invalid";
	         	$csJx="invalid-feedback";
	         	$massageJx="Pilih Jenis Kelamin!";
	         	$validates=false;
         }else{
         	$inJx="is-valid";
	        $csJx="valid-feedback";
	        $massageJx="Sae Pisan !";
         }
         // validasi alamat
                  if (kosong($alamat)) {
         	$inAx="is-invalid";
         	$csAx="invalid-feedback";
         	$massageAx="Alamat Tidak boleh kosong!";
         	$validates=false;
         }else if (tex($alamat)){
            $inAx="is-invalid";
         	$csAx="invalid-feedback";
         	$massageAx="Alamat Haya boleh mengandung huruf angka (.) (,)!";

         	$validates=false;
         }else if(!leng($alamat,100)){
                $inAx="is-invalid";
	         	$csAx="invalid-feedback";
	         	$massageAx="Text terlalu panjang!";
	         	$validates=false;
         }else{
         	    $inAx="is-valid";
	         	$csAx="valid-feedback";
	         	$massageAx="Sae Pisan!";

         }
                  // validasi status
         if(empty($status)){
                $inSx="is-invalid";
	         	$csSx="invalid-feedback";
	         	$massageSx="Pilih Status!";
	         	$validates=false;
         }else{
         	$inSx="is-valid";
	        $csSx="valid-feedback";
	        $massageSx="Sae Pisan !";
         }
         // validasi Pekerjaan
          if (kosong($pekerjaan)) {
         	$inPx="is-invalid";
         	$csPx="invalid-feedback";
         	$massagePx="pekerjaan Tidak boleh kosong!";
         	$validates=false;
         }else if (tex($pekerjaan)){
            $inPx="is-invalid";
         	$csPx="invalid-feedback";
         	$massagePx="pekerjaan Haya boleh mengandung huruf angka (.) (,)!";
         	$validates=false;
         }else if(!leng($pekerjaan,100)){
                $inPx="is-invalid";
	         	$csPx="invalid-feedback";
	         	$massagePx="Text terlalu panjang!";
	         	$validates=false;
         }else{
         	    $inPx="is-valid";
	         	$csPx="valid-feedback";
	         	$massagePx="Sae Pisan!";

         }
         // kth
        if(empty($kth)){
                $inKx="is-invalid";
	         	$csKx="invalid-feedback";
	         	$massageKx="Pilih KTH!";
	         	$validates=false;
         }else{
         	$inKx="is-valid";
	        $csKx="valid-feedback";
	        $massageKx="Sae Pisan !";
	
         }
                  // jabatan
        if(empty($jabatan)){
                $inJBx="is-invalid";
	         	$csJBx="invalid-feedback";
	         	$massageJBx="Pilih jabatan!";
	         	$validates=false;
         }else{
         	$inJBx="is-valid";
	        $csJBx="valid-feedback";
	        $massageJBx="Sae Pisan !";

         }
         // jumlah stup
          if(angka($stup)) {
                 $inSTx="is-invalid";
	         	$csSTx="invalid-feedback";
	         	$massageSTx="Yang Anda Masukan Bukan Angka!";
	         	$validates=false;
         }else{
         	    $inSTx="is-valid";
	         	$csSTx="valid-feedback";
	         	$massageSTx="Sae Pisan !";
	         	
         }

         // jika sukah masukan ke dalam database
      if ($validates) {
      	$str="UPDATE anggota SET nik='$nik',
      	nama='$nama', ttl='$ttl', jk='$jk', alamat='$alamat', status='$status', pekerjaan='$pekerjaan', id_kth='$kth', id_jabatan='$jabatan', jml_stup='$stup' where id_anggota='$id'";
      	$rsult=iud($str);
     
      	  if($rsult>0){
      	  	$inx="";
		    $inNx="";
		    $inTx="";
		    $inJx="";
		    $inAx="";
		    $inSx="";
		    $inPx="";
		    $inJSx="";
		    $inKx="";
		    $inJBx="";
		    $inSTx="";
            echo "<script>
alert('selamat Anada berhasil mengubah');
document.location.href='kth.php#ang';
</script>";
           $valids="show";
            $massages="SELAMAT! Anggota Atas nama $nama Dengan Nomor NIK $nik Berhasil Di Ubah";
          }else{
 echo "<script>
alert('Anada gagal mengubah');
document.location.href='kth.php#ang';
</script>";
          $valids="show";
          $massages="Oops! Anggota Atas nama $nama Dengan Nomor NIK $nik Gagal Di Ubah";
           }
      }

}
 

?>

<!DOCTYPE html>
<html>
<head>
<link rel="icon" type="image/png" href="img/logo/<?=$logo?>">
	<title>Cabang Dinas Kehutanan Wilayah VII</title>
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../css/lg.css">
	<link rel="stylesheet" type="text/css" href="../css/sm.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
<!-- navigasi bar -->
<section>
		<nav class="navbar navbar-expand-lg navbar-light bg-dark fixed-top">
		<img src="img/logo/<?=$logo?>">
	  <a class="navbar-brand text-light" href="index.php">Kartu Anggota</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarNav">
		<ul class="navbar-nav">
			<li class="nav-item">
	        <a class="nav-link text-light" href="layout.php">Tampilan</a>
	        </li>
			 <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-warning" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          KTH
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item " href="kth.php#ang">Anggota</a>
          <a class="dropdown-item " href="kth.php#kt">KTH</a>
          <a class="dropdown-item " href="kth.php#jb">Jabatan</a>
      </li>
       <li>
          <a class="nav-link text-light" href="contac.php">Kontak</a>
      </li>
	    </ul>
	  </div>
	   <a class="nav-link text-sm-left text-light" onclick="return confirm('apakah anda yakin ingin keluar?');" href="../logout.php"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
width="34" height="34"
viewBox="0 0 172 172"
style=" fill:#000000;"><defs><linearGradient x1="86" y1="30.23438" x2="86" y2="158.60658" gradientUnits="userSpaceOnUse" id="color-1"><stop offset="0" stop-color="#1a6dff"></stop><stop offset="1" stop-color="#c822ff"></stop></linearGradient><linearGradient x1="86" y1="14.10938" x2="86" y2="95.43124" gradientUnits="userSpaceOnUse" id="color-2"><stop offset="0" stop-color="#6dc7ff"></stop><stop offset="1" stop-color="#e6abff"></stop></linearGradient><linearGradient x1="86" y1="30.23438" x2="86" y2="158.60658" gradientUnits="userSpaceOnUse" id="color-3"><stop offset="0" stop-color="#1a6dff"></stop><stop offset="1" stop-color="#c822ff"></stop></linearGradient></defs><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="#343a40"></path><g id="Слой_1"><path d="M86,155.875c-34.08556,0 -61.8125,-27.72694 -61.8125,-61.8125c0,-24.31381 14.33781,-46.45881 36.52581,-56.41869l2.19838,4.902c-20.25838,9.09719 -33.34919,29.31794 -33.34919,51.51669c0,31.11856 25.31894,56.4375 56.4375,56.4375c31.11856,0 56.4375,-25.31894 56.4375,-56.4375c0,-22.2095 -13.09887,-42.43294 -33.368,-51.52475l2.19837,-4.902c22.20144,9.9545 36.54462,32.10219 36.54462,56.42675c0,34.08556 -27.72694,61.8125 -61.8125,61.8125z" fill="url(#color-1)"></path><path d="M96.75,80.625c0,5.93669 -4.81331,10.75 -10.75,10.75v0c-5.93669,0 -10.75,-4.81331 -10.75,-10.75v-53.75c0,-5.93669 4.81331,-10.75 10.75,-10.75v0c5.93669,0 10.75,4.81331 10.75,10.75z" fill="url(#color-2)"></path><path d="M86,139.75c-25.19263,0 -45.6875,-20.49487 -45.6875,-45.6875c0,-17.62462 9.847,-33.368 25.69787,-41.09456l2.35694,4.83481c-13.99112,6.8155 -22.67981,20.70988 -22.67981,36.25975c0,22.22831 18.08419,40.3125 40.3125,40.3125c22.22831,0 40.3125,-18.08419 40.3125,-40.3125c0,-15.54719 -8.686,-29.44156 -22.67444,-36.25975l2.35694,-4.82944c15.84819,7.72388 25.6925,23.46725 25.6925,41.08919c0,25.19263 -20.49487,45.6875 -45.6875,45.6875z" fill="url(#color-3)"></path></g></g></svg> Logout</a>
</nav>
</section>
<!-- akhir Naigasi bar -->
<!-- awal konten -->
<section id="ang">
<form action="" method="post">
<div class="container topp">
	<nav class="navbar navbar-light bg-light">
			  <a class="navbar-brand" href="#">
			    <img src="https://img.icons8.com/ios/96/000000/groups-filled.png" width="30" height="30" class="d-inline-block align-top" alt="">
			    <span>Registrasi Anggota</span>
			  </a>
			</nav>
	<div class="row justify-content-center mt-3">
		  <div class="col-lg-4">

		  	<img src="https://img.icons8.com/color/50/000000/identity-theft.png" alt="">
		  	<label for="nik">Nomor Induk Keluarga</label>
		  	<input type="text" name="nik" class="form-control <?=$in?>" id="nik" value="<?=$nikval?>" placeholder="Masukan NIK">
		<?php if(!empty($in)): ?>
			      <div class="<?=$cs?>">
			        <?=$massage?>
			      </div>
		<?php endif; ?>  
		  </div>
		  	<div class="col-lg-4">

		  		<img src="https://img.icons8.com/color/48/000000/name.png" alt="">
		  		<label for="nama">Nama Lengkap</label>
		  	<input type="text" name="nama" class="form-control <?=$inN?>" id="nama" value="<?=$namval?>" placeholder="Masukan Nama">
             		<?php if(!empty($inN)): ?>
				      <div class="<?=$csN?>">
				        <?=$massageN?>
				      </div>
	        		<?php endif; ?>  
		  </div>
	</div>

	<div class="row justify-content-center mt-3">
			  <div class="col-lg-4">

			  	<img src="https://img.icons8.com/bubbles/50/000000/home.png" alt="">
			  	<label for="ttl">Tempat Tanggal Lahir</label>
			  	<input type="text" name="ttl" class="form-control <?=$inT?>" id="ttl" value="<?=$tval?>" placeholder="Masukan Tempat Tanggal Lahir">
			  	<?php if(!empty($inT)): ?>
				      <div class="<?=$csT?>">
				        <?=$massageT?>
				      </div>
	        		<?php endif; ?>  
			  </div>
			  	<div class="col-lg-4">

			  		<img src="https://img.icons8.com/color/45/000000/toilet.png" alt="" class="mb-1">
			  		<label for="jk">Jenis Kelamin</label>
			  	<select name="jk" id="jk" class="form-control <?=$inJ?>" value="<?=$jval?>">
			  		<option value="">Pilih</option>
			  		<option value="laki-laki">Laki-laki</option>
			  		<option value="perempuan">Perempuan</option>
			  	</select>
			  	 	<?php if(!empty($inJ)): ?>
				      <div class="<?=$csJ?>">
				        <?=$massageJ?>
				      </div>
	        		<?php endif; ?>  
			  </div>
		</div>

		<div class="row justify-content-center mt-3">
			  <div class="col-lg-4">

			  	<img src="https://img.icons8.com/dusk/40/000000/order-delivered.png" alt="" class="mb-1">
			  	<label for="alamat">Alamat</label>
			  	<input type="text" name="alamat" class="form-control <?=$inA?>" value="<?=$aval?>" id="alamat" placeholder="Masukan Alamat">
			  		<?php if(!empty($inA)): ?>
				      <div class="<?=$csA?>">
				        <?=$massageA?>
				      </div>
	        		<?php endif; ?>  
			  </div>
			  	<div class="col-lg-4">

			  		<img src="https://img.icons8.com/office/40/000000/bank-card-back-side.png" alt="" class="mb-1">
			  		<label for="st">Status</label>
			  	<select name="status" id="st" class="form-control <?=$inS?>" value="<?=$sval?>">
			  		<option value="">Pilih</option>
			  		<option value="Lajang">Lajang</option>
			  		<option value="kawin">Kawin</option>
			  	</select>
			  	<?php if(!empty($inS)): ?>
				      <div class="<?=$csS?>">
				        <?=$massageS?>
				      </div>
	        		<?php endif; ?>  
			  </div>
		</div>

				<div class="row justify-content-center mt-3">
			  <div class="col-lg-4">

			  	<img src="https://img.icons8.com/color/40/000000/coworking.png" alt="" class="mb-1">
			  	<label for="pk">Pekerjaan</label>
			  	<input type="text" name="pekerjaan" class="form-control <?=$inP?>" value="<?=$pval?>" id="pk" placeholder="Masukan Pekerjaan">
			  	<?php if(!empty($inP)): ?>
				      <div class="<?=$csP?>">
				        <?=$massageP?>
				      </div>
	        		<?php endif; ?> 
			  </div>
			  	<div class="col-lg-4">

			  		<img src="https://img.icons8.com/color/40/000000/group-foreground-selected.png" alt="" class="mb-1">
			  		<label for="kth">Pilih KTH</label>
			  	<select name="kth" id="kth" class="form-control <?=$inK?>" value="<?=$kval?>">
			  		<option value="">Pilih</option>
			  		<?php 
                    $ey="SELECT * FROM kth";
                    $eyt=tampil($ey);
                    foreach ($eyt as $e):
			  		?>
			  		<option value="<?=$e['id_kth']?>"><?=$e["nama_kth"]?></option>
			  	    <?php endforeach;?>
			  	</select>
			  	<?php if(!empty($inK)): ?>
				      <div class="<?=$csK?>">
				        <?=$massageK?>
				      </div>
	        		<?php endif; ?> 
			  </div>
		</div>

        <div class="row justify-content-center mt-3">
			  <div class="col-lg-4">

			  	<img src="https://img.icons8.com/plasticine/40/000000/wooden-box-1.png" alt="" class="mb-1">
			  	<label for="stu">Jumlah Stup Yang di Miliki</label>
			  	<input type="number" name="stup" class="form-control <?=$inST?>" id="stu" value="<?=$stval?>" placeholder="Masukan jumlah stup">
			  	<?php if(!empty($inST)): ?>
				      <div class="<?=$csST?>">
				        <?=$massageST?>
				      </div>
	        		<?php endif; ?>
			  </div>
			  	<div class="col-lg-4">

			  		<img src="https://img.icons8.com/ultraviolet/40/000000/new-job.png" alt="" class="mb-1">
			  		<label for="jabatan">Pilih jabatan</label>
			  	<select name="jabatan" id="jabatan" class="form-control <?=$inJB?>" value="<?=$jbval?>">
			  		<option value="">Pilih</option>
			  		<?php 
                    $eb="SELECT * FROM jabatan";
                    $et=tampil($eb);
                    foreach ($et as $ee):
			  		?>
			  		<option value="<?=$ee['id_jabatan']?>"><?=$ee["nama_jabatan"]?></option>
			  	    <?php endforeach;?>
			  	</select>
			  	    <?php if(!empty($inJB)): ?>
				      <div class="<?=$csJB?>">
				        <?=$massageJB?>
				      </div>
	        		<?php endif; ?>
			  </div>
		</div>

		        <div class="row justify-content-center mt-5">
			  <div class="col-lg-4">
			  	<button type="submit" name="tanggota" class="btn btn-primary btn-lg btn-block"><img src="https://img.icons8.com/ultraviolet/30/000000/plus.png" class="mr-2">Tambah</button>
			  	  <?php if(isset($valids)): ?>
			        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
					  <strong>Hallo Admin!</strong> <?=$massages ?>.
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>
				   <?php endif; ?>
			  </div>
			  
		      </div>
</form>
   <!-- table --> 
   <div class="container mt-5">
<div class="pos-f-t">
  <div class="collapse" id="daftaranggota">
    <div class="bg-dark p-4">


<nav class="navbar navbar-light bg-light mb-3 mt-4">
<div class="row">
<div class="col-lg-12">
<h4>Daftar Anggotai KTH Binalestar</h4>
</div>
	</div>
	</nav>
						<!-- tabel -->
						<div class="container table-responsive" style="overflow-y: hidden;">
						    <div data-role="main" class="ui-content">
									<table data-role="table" class="table table-sm table-hover table-dark" >
									 <thead>
									 <tr>
									 <th>No</th>
									 <th>NIK</th>
									 <th>Nama</th>
									 <th>Tempat Tgl Lahir</th>
									 <th>Jenis Kelamin</th>
									 <th>Alamat</th>
									 <th>Status</th>
									 <th>Pekrjaan</th>
									 <th>Jumlah Stup</th>
									 <th>Jabatan</th>
									 <th>Code Token</th>
									 <th>Aksi</th>
									 </tr>
									 </thead>
									 <tbody>
									 <?php 
									 $aa=1;
									 $ku="SELECT * FROM anggota,jabatan where jabatan.id_jabatan=anggota.id_jabatan and id_kth='1'";
									$ku=tampil($ku);
									 foreach($ku as $u):
										?>
									 <tr>
									 <td><?=$aa?></td>
									 <td><?=$u['nik']?></td>
									 <td><?=$u['nama']?></td>
									 <td><?=$u['ttl']?></td>
									 <td><?=$u['jk']?></td>
									 <td><?=$u['alamat']?></td>
									 <td><?=$u['status']?></td>
									 <td><?=$u['pekerjaan']?></td>
									 <td><?=$u['jml_stup']?></td>
									 <td><?=$u['nama_jabatan']?></td>
									 <td><?=$u['token']?></td>
									 <td>
<a href="hapus.php?id=<?=$u['nik']?>&t=anggota&f=nik&a=kth.php#ang" onclick="return confirm('Apakah anda yakin ingin mengpus data?');" class="btn btn-danger btn-sm">hapus</a>
	 <a href="" data-toggle="modal" data-target="#dat<?=$u['nik']?>" class="btn btn-info ml-3 btn-sm">edit</a>
									 </td>
									 </tr>
									 <?php $aa++; endforeach;?>
									 </tbody>
									</table>
								</div>
							
					</div>
					<!-- table -->

		    </div>
		  </div>
		  <nav class="navbar navbar-dark bg-dark">
		    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#daftaranggota" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
		      <span class="navbar-toggler-icon text-light"></span> <span class="text-light">Daftar Anggota</span>
		    </button>
		  </nav>
		</div>
</div>
<!-- akhir table -->
</div>

</section>

<section>
<form action="" method="post">	
  <div class="container topp" id="kt">
	<nav class="navbar navbar-light bg-light">
			  <a class="navbar-brand" href="#">
			    <img src="https://img.icons8.com/cotton/64/000000/business-group.png" width="30" height="30" class="d-inline-block align-top" alt="">
			    <span>Registrasi Kelompok Tani Hutan</span>
			  </a>
			</nav>
	<div class="row justify-content-center mt-3">
		  <div class="col-lg-4 mt-2">
                    
		  	<img src="https://img.icons8.com/flat_round/35/000000/plus.png" alt="">
		  	<label for="nama">Nama KTH</label>
		  	<input type="text" name="nama" class="form-control mt-1" id="nama" placeholder="Masukan KTH">
       <!-- alert -->
       <?php if(isset($non_valid)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
		  <strong>Hallo Admin!</strong> <?=$massage ?>.
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button>
		</div>
	   <?php endif; ?>
      <!-- alert -->
		  </div>
		  	<div class="col-lg-4">

		  		<img src="https://img.icons8.com/dusk/40/000000/order-delivered.png" class="mb-1 mt-1" alt="">
		  		<label for="alamat">Alamat</label>
		  	<input type="text" name="alamat" class="form-control" id="alamat" placeholder="Masukan alamat">
       <!-- alert -->
       <?php if(isset($anon_valid)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
		  <strong>Hallo Admin!</strong> <?=$amassage ?>.
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button>
		</div>
	   <?php endif; ?>
      <!-- alert -->
		  </div>
	</div>

	<div class="row justify-content-center mt-3" id="jb">
			  <div class="col-lg-4">

			  	<img src="https://img.icons8.com/flat_round/40/000000/link.png" class="mb-1" alt="">
			  	<label for="url">Google Maps</label>
			  	<input type="text" name="url" class="form-control" id="url" placeholder="Masukan URL">
	  <!-- alert -->
       <?php if(isset($unon_valid)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
		  <strong>Hallo Admin!</strong> <?=$umassage ?>.
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button>
		</div>
	   <?php endif; ?>
      <!-- alert -->
			  </div>
			  	<div class="col-lg-4">

			  	<img src="https://img.icons8.com/ultraviolet/40/000000/groups.png" class="mb-1" alt="">
			  	<label for="num">Jumlah Anggota</label>
			  	<input type="number" name="jml" class="form-control" id="num" placeholder="Masukan Jumlah">
		 <!-- alert -->
       <?php if(isset($jnon_valid)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
		  <strong>Hallo Admin!</strong> <?=$jmassage ?>.
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button>
		</div>
	   <?php endif; ?>
      <!-- alert -->
			  </div>
		</div>

		        <div class="row justify-content-center mt-5">
			  <div class="col-lg-4">
			  	<button type="submit" name="tkth" class="btn btn-primary btn-lg btn-block"><img src="https://img.icons8.com/ultraviolet/30/000000/plus.png" class="mr-2">Tambah</button>
		 <!-- alert -->
       <?php if(isset($valid)): ?>
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
		  <strong>Hallo Admin!</strong> <?=$vmassage ?>.
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button>
		</div>
	   <?php endif; ?>
      <!-- alert -->
			  </div>
			  
		      </div>
</form>

   <!-- table -->
   <div class="container mt-5">
<div class="pos-f-t">
  <div class="collapse" id="daftarkth">
    <div class="bg-dark p-4">


<nav class="navbar navbar-light bg-light mb-3 mt-4">
<div class="row">
<div class="col-lg-12">
<h4>Daftar Kelompok Tani Hutan</h4>
</div>
	</div>
	</nav>
						<!-- tabel -->
						<div class="container table-responsive" style="overflow-y: hidden;">
						    <div data-role="main" class="ui-content">
									<table data-role="table" class="table table-sm table-hover table-dark" >
									 <thead>
									 <tr>
									 <th>No</th>
									 <th>Nama</th>
									 <th>Alamat</th>
									 <th>URL maps</th>
									 <th>Jumlah</th>
									 <th>Aksi</th>

									 </tr>
									 </thead>
									 <tbody>
									 <?php 
									 $aa=1;
									 $ku="SELECT * FROM kth";
									$ku=tampil($ku);
									 foreach($ku as $u):
										?>
									 <tr>
									 <td><?=$aa?></td>
									 <td><?=$u['nama_kth']?></td>
									 <td><?=$u['alamat']?></td>
									 <td><?=$u['maps']?></td>
									 <td><?=$u['anggota']?></td>
									 <td>
									<a href="hapus.php?id=<?=$u['id_kth']?>&t=kth&f=id_kth&a=kth.php#kt" onclick="return confirm('Apakah anda yakin ingin mengpus data?');" class="btn btn-danger btn-sm">hapus</a>
										 <a href="" data-toggle="modal" data-target="#datak<?=$u['id_kth']?>" class="btn btn-info ml-3 btn-sm">edit</a>
									 </td>
									 </tr>
									 <?php $aa++; endforeach;?>
									 </tbody>
									</table>
								</div>
							
					</div>
					<!-- table -->

		    </div>
		  </div>
		  <nav class="navbar navbar-dark bg-dark">
		    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#daftarkth" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
		      <span class="navbar-toggler-icon text-light"></span> <span class="text-light">Daftar KTH</span>
		    </button>
		  </nav>
		</div>
</div>
<!-- akhir table -->

</div>
</section>

<section>	
	<form action="" method="post">
  <div class="container topp">
	<nav class="navbar navbar-light bg-light">
			  <a class="navbar-brand" href="#">
			    <img src="https://img.icons8.com/cotton/64/000000/business-group.png" width="30" height="30" class="d-inline-block align-top" alt="">
			    <span>Registrasi Jabatan</span>
			  </a>
			</nav>
	<div class="row justify-content-center mt-3">
		  <div class="col-lg-4 mt-2">

		  	<img src="https://img.icons8.com/flat_round/35/000000/plus.png" alt="">
		  	<label for="nama">Nama Jabatan</label>
		  	<input type="text" name="nama" class="form-control mt-1" id="nama" placeholder="Masukan KTH">
	 <!-- alert -->
       <?php if(isset($njnon_valid)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
		  <strong>Hallo Admin!</strong> <?=$njmassage ?>.
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button>
		</div>
	   <?php endif; ?>
      <!-- alert -->
		  </div>
		</div>

		        <div class="row justify-content-center mt-5">
			  <div class="col-lg-4">
			  	<button type="submit" name="tjabatan" class="btn btn-primary btn-lg btn-block"><img src="https://img.icons8.com/ultraviolet/30/000000/plus.png" class="mr-2">Tambah</button>
	 <!-- alert -->
       <?php if(isset($njvalid)): ?>
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
		  <strong>Hallo Admin!</strong> <?=$vmassage ?>.
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button>
		</div>
	   <?php endif; ?>
      <!-- alert -->
			  </div>
			  
		      </div>

     </form>
   <!-- table -->
   <div class="container mt-5">
<div class="pos-f-t">
  <div class="collapse" id="daftarjabatan">
    <div class="bg-dark p-4">


<nav class="navbar navbar-light bg-light mb-3 mt-4">
<div class="row">
<div class="col-lg-12">
<h4>Daftar Jabatan</h4>
</div>
	</div>
	</nav>
						<!-- tabel -->
						<div class="container table-responsive" style="overflow-y: hidden;">
						    <div data-role="main" class="ui-content">
									<table data-role="table" class="table table-sm table-hover table-dark" >
									 <thead>
									 <tr>
									 <th>No</th>
									 <th>Nama Jabatan</th>
									 <th>Aksi</th>
									 </tr>
									 </thead>
									 <tbody>
									 <?php 
									 $ab=1;
									 $uk="SELECT * FROM jabatan";
									$ju=tampil($uk);
									 foreach($ju as $u):
										?>
									 <tr>
									 <td><?=$ab?></td>
									 <td><?=$u['nama_jabatan']?></td>
									 <td>
						<a href="hapus.php?id=<?=$u['id_jabatan']?>&t=jabatan&f=id_jabatan&a=kth.php#jb" onclick="return confirm('Apakah anda yakin ingin mengpus data?');" class="btn btn-danger btn-sm">hapus</a>
						 <a href="" data-toggle="modal" data-target="#data<?=$u['id_jabatan']?>" class="btn btn-info ml-3 btn-sm">edit</a>
									 </td>
									 </tr>
									 <?php $ab++; endforeach;?>
									 </tbody>
									</table>
								</div>
							
					</div>
					<!-- table -->

		    </div>
		  </div>
		  <nav class="navbar navbar-dark bg-dark">
		    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#daftarjabatan" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
		      <span class="navbar-toggler-icon text-light"></span> <span class="text-light">Daftar Jabatan</span>
		    </button>
		  </nav>
		</div>
</div>
<!-- akhir table -->

</div>
</section>

<!-- akhir konten -->


<!-- The content of your page would go here. -->  
<?php 
$str="SELECT * FROM contac WHERE id_con='1'";
$row=tampil($str);
 ?>
<div class="container-fluid bg-dark" style="max-width: 100%; height:200px; margin-top: 200px;"> 
       <div class="container bg-dark mt-3"> 
       <footer class="footer-distributed">  
                  <div class="footer-left">  
                    <h3>3A<span>Production</span></h3>  
                     <p class="footer-links"> 
                   <a href="index.php">Administator</a>  
                   ·                     <a href="layout.php">Tampilan</a>
                   ·                     <a href="kth.php">KTH</a>
                   ·                     <a href="#">About</a>
                   ·                     <a href="contac.php">Contact</a> 
                     </p>                 
                    <p class="footer-company-name">&copy;PKL 2019 smkn 1 kawali</p>
                     <p class="footer-company-name">Ade Hikmat Pauji R</p>    
                     <p class="footer-company-name">Abdul Aziz</p>
                     <p class="footer-company-name">Agil Gugum G</p> 
                     <p class="footer-company-name">Drs. A.Iman Chandra Margana <span class="text-light">(Supervisor)</span></p>              
                 </div>             
                 <div class="footer-center">                 
                  <div>                    
                   <i class="fa fa-map-marker"></i>                     
                   <p><span>Kelompok Tani Hutan</span> Binalestari</p>                 
                  </div>                 
                  <div>                     
                    <i class="fa fa-phone"></i>                     
                    <p><?=$row[0]['nohp']?></p>                 
                  </div>                 
                  <div>                     
                    <i class="fa fa-envelope"></i>                     
                    <p><a href="<?=$row[0]['email']?>"><?=$row[0]['email']?></a></p>                 
                  </div>             
                 </div>             
                 <div class="footer-right">                 
                  <p class="footer-company-about">                     
                    <span>Tentang KTH Binalestari</span>                     <?=$row[0]['about']?>                 
                  </p>                 
                  <div class="footer-icons">                                         
                    <a href="<?=$row[0]['fb']?>"><i class="fa fa-linkedin"><img src="https://img.icons8.com/color/48/000000/gmail.png" class="img-fluid" style="margin-left: -20px; max-height: 40px; position: absolute; max-width: 55px; margin-top: -3px;" alt="fb"></i></a>                      
                    <a href="<?=$row[0]['fb']?>"><i class="fa fa-linkedin"><img src="../admin/img/logo/fb.svg" class="img-fluid" style="margin-left: -30px; position: absolute; max-width: 55px; max-height: 32px;" alt="fb"></i></a>                                      
                  </div>             
                 </div>         
             </footer>
               </div>
           </div>
<!-- akhir footer -->



<!-- edit  -->

<!-- Modal jabatan -->
<?php 
$rok="SELECT * FROM jabatan";
$tp=tampil($rok);
foreach($tp as $w):?>
<div class="modal fade bg-dark" id="data<?=$w['id_jabatan'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

	<div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Jabatan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

 <form method="post" action="" enctype="multipart/form-data">
        	<div class="row justify-content-center mt-3">
		  <div class="col-lg-6 mt-2">

		  	<img src="https://img.icons8.com/flat_round/35/000000/plus.png" alt="">
		  	<label for="nama">Nama Jabatan</label>
		  	<input type="text" name="nama" class="form-control mt-1" id="nama" value="<?= $w['nama_jabatan'] ?>" placeholder="Masukan KTH">
		   <!-- alert -->
       <?php if(isset($nnjnon_valid)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
		  <strong>Hallo Admin!</strong> <?=$nnjmassage ?>.
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button>
		</div>
	   <?php endif; ?>
      <!-- alert -->
		  </div>
		</div>
 <!-- alert -->
       <?php if(isset($nnjvalid)): ?>
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
		  <strong>Hallo Admin!</strong> <?=$vvmassage ?>.
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button>
		</div>
	   <?php endif; ?>
      <!-- alert -->
			  
      <div class="modal-footer mt-5">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary" value="<?=$w['id_jabatan']?>" name="jedit">Simpan</button>
      </div>
    </form>
    </div>
  </div>
</div>
<?php endforeach;?>

<!-- Modal kth -->
<?php 
$ro="SELECT * FROM kth";
$tp=tampil($ro);
foreach($tp as $w):?>
<div class="modal fade bg-dark" id="datak<?=$w['id_kth'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

	<div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit KTH</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

 <form method="post" action="" enctype="multipart/form-data">
        	
 	<div class="row justify-content-center mt-3">
		  <div class="col-lg-6 mt-2">
                    
		  	<img src="https://img.icons8.com/flat_round/35/000000/plus.png" alt="">
		  	<label for="nama">Nama KTH</label>
		  	<input type="text" name="nama" class="form-control mt-1" value="<?=$w['nama_kth']?>" id="nama" placeholder="Masukan KTH">
       <!-- alert -->
       <?php if(isset($non_validd)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
		  <strong>Hallo Admin!</strong> <?=$massagee ?>.
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button>
		</div>
	   <?php endif; ?>
      <!-- alert -->
		  </div>
		  	<div class="col-lg-6">

		  		<img src="https://img.icons8.com/dusk/40/000000/order-delivered.png" class="mb-1 mt-1" alt="">
		  		<label for="alamat">Alamat</label>
		  	<input type="text" name="alamat" class="form-control" value="<?=$w['alamat']?>"  id="alamat" placeholder="Masukan alamat">
       <!-- alert -->
       <?php if(isset($anon_validd)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
		  <strong>Hallo Admin!</strong> <?=$amassagee ?>.
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button>
		</div>
	   <?php endif; ?>
      <!-- alert -->
		  </div>
	</div>

	<div class="row justify-content-center mt-3" id="jb">
			  <div class="col-lg-6">

			  	<img src="https://img.icons8.com/flat_round/40/000000/link.png" class="mb-1" alt="">
			  	<label for="url">Google Maps</label>
			  	<input type="text" name="url" class="form-control" value="<?=$w['maps']?>"  id="url" placeholder="Masukan URL">
	  <!-- alert -->
       <?php if(isset($unon_validd)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
		  <strong>Hallo Admin!</strong> <?=$umassagee ?>.
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button>
		</div>
	   <?php endif; ?>
      <!-- alert -->
			  </div>
			  	<div class="col-lg-6">

			  	<img src="https://img.icons8.com/ultraviolet/40/000000/groups.png" class="mb-1" alt="">
			  	<label for="num">Jumlah Anggota</label>
			  	<input type="number" name="jml" class="form-control" value="<?=$w['anggota']?>"  id="num" placeholder="Masukan Jumlah">
		 <!-- alert -->
       <?php if(isset($jnon_validd)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
		  <strong>Hallo Admin!</strong> <?=$jmassagee ?>.
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button>
		</div>
	   <?php endif; ?>
      <!-- alert -->
			  </div>
		</div>

		  
			  
      <div class="modal-footer mt-5">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary" value="<?=$w['id_kth']?>" name="kedit">Simpan</button>
      </div>
    </form>
    </div>
  </div>
</div>
<?php endforeach;?>



<!-- Modal kth -->
<?php 
$roh="SELECT * FROM anggota";
$tpp=tampil($roh);
foreach($tpp as $w):?>
<div class="modal fade bg-dark" id="dat<?=$w['nik'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

	<div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Anggota</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

 <form method="post" action="" enctype="multipart/form-data">
        	

<div class="row justify-content-center mt-3">
		  <div class="col-lg-6">

		  	<img src="https://img.icons8.com/color/50/000000/identity-theft.png" alt="">
		  	<label for="nik">Nomor Induk Keluarga</label>
		  	<input type="text" name="nik" class="form-control <?=$inx?>" id="nik" value="<?=$w['nik']?>" placeholder="Masukan NIK">
		<?php if(!empty($inx)): ?>
			      <div class="<?=$csx?>">
			        <?=$massagex?>
			      </div>
		<?php endif; ?>  
		  </div>
		  	<div class="col-lg-6">

		  		<img src="https://img.icons8.com/color/48/000000/name.png" alt="">
		  		<label for="nama">Nama Lengkap</label>
		  	<input type="text" name="nama" class="form-control <?=$inNx?>" id="nama" value="<?=$w['nama']?>" placeholder="Masukan Nama">
             		<?php if(!empty($inNx)): ?>
				      <div class="<?=$csNx?>">
				        <?=$massageNx?>
				      </div>
	        		<?php endif; ?>  
		  </div>
	</div>

	<div class="row justify-content-center mt-3">
			  <div class="col-lg-6">

			  	<img src="https://img.icons8.com/bubbles/50/000000/home.png" alt="">
			  	<label for="ttl">Tempat Tanggal Lahir</label>
			  	<input type="text" name="ttl" class="form-control <?=$inTx?>" id="ttl" value="<?=$w['ttl']?>" placeholder="Masukan Tempat Tanggal Lahir">
			  	<?php if(!empty($inTx)): ?>
				      <div class="<?=$csTx?>">
				        <?=$massageTx?>
				      </div>
	        		<?php endif; ?>  
			  </div>
			  	<div class="col-lg-6">

			  		<img src="https://img.icons8.com/color/45/000000/toilet.png" alt="" class="mb-1">
			  		<label for="jk">Jenis Kelamin</label>
			  	<select name="jk" id="jk" class="form-control <?=$inJx?>" required>
			  		<option value="<?=$w['jk']?>"><?=$w['jk']?></option>
			  		<option value="laki-laki">Laki-laki</option>
			  		<option value="perempuan">Perempuan</option>
			  	</select>
			  	 	<?php if(!empty($inJx)): ?>
				      <div class="<?=$csJx?>">
				        <?=$massageJx?>
				      </div>
	        		<?php endif; ?>  
			  </div>
		</div>

		<div class="row justify-content-center mt-3">
			  <div class="col-lg-6">

			  	<img src="https://img.icons8.com/dusk/40/000000/order-delivered.png" alt="" class="mb-1">
			  	<label for="alamat">Alamat</label>
			  	<input type="text" name="alamat" class="form-control <?=$inAx?>" value="<?=$w['alamat']?>" id="alamat" placeholder="Masukan Alamat">
			  		<?php if(!empty($inAx)): ?>
				      <div class="<?=$csAx?>">
				        <?=$massageAx?>
				      </div>
	        		<?php endif; ?>  
			  </div>
			  	<div class="col-lg-6">

			  		<img src="https://img.icons8.com/office/40/000000/bank-card-back-side.png" alt="" class="mb-1">
			  		<label for="st">Status</label>
			  	<select name="status" id="st" class="form-control <?=$inSx?>" required>
			  		<option value="<?=$w['status']?>"><?=$w['status']?></option>
			  		<option value="Lajang">Lajang</option>
			  		<option value="kawin">Kawin</option>
			  	</select>
			  	<?php if(!empty($inSx)): ?>
				      <div class="<?=$csSx?>">
				        <?=$massageSx?>
				      </div>
	        		<?php endif; ?>  
			  </div>
		</div>

				<div class="row justify-content-center mt-3">
			  <div class="col-lg-6">

			  	<img src="https://img.icons8.com/color/40/000000/coworking.png" alt="" class="mb-1">
			  	<label for="pk">Pekerjaan</label>
			  	<input type="text" name="pekerjaan" class="form-control <?=$inPx?>" value="<?=$w['pekerjaan']?>" id="pk" placeholder="Masukan Pekerjaan">
			  	<?php if(!empty($inPx)): ?>
				      <div class="<?=$csPx?>">
				        <?=$massagePx?>
				      </div>
	        		<?php endif; ?> 
			  </div>
			  	<div class="col-lg-6">

			  		<img src="https://img.icons8.com/color/40/000000/group-foreground-selected.png" alt="" class="mb-1">
			  		<label for="kth">Pilih KTH</label>
			  	<select name="kth" id="kth" class="form-control <?=$inKx?>" required >
			  		<option value="<?=$w['id_kth']?>">Pilih..</option>
			  		<?php 
                    $ey="SELECT * FROM kth";
                    $eyt=tampil($ey);
                    foreach ($eyt as $e):
			  		?>
			  		<option value="<?=$e['id_kth']?>"><?=$e["nama_kth"]?></option>
			  	    <?php endforeach;?>
			  	</select>
			  	<?php if(!empty($inKx)): ?>
				      <div class="<?=$csKx?>">
				        <?=$massageKx?>
				      </div>
	        		<?php endif; ?> 
			  </div>
		</div>

        <div class="row justify-content-center mt-3">
			  <div class="col-lg-6">

			  	<img src="https://img.icons8.com/plasticine/40/000000/wooden-box-1.png" alt="" class="mb-1">
			  	<label for="stu">Jumlah Stup Yang di Miliki</label>
			  	<input type="number" name="stup" class="form-control <?=$inSTx?>" id="stu" value="<?=$w['jml_stup']?>" placeholder="Masukan jumlah stup">
			  	<?php if(!empty($inSTx)): ?>
				      <div class="<?=$csSTx?>">
				        <?=$massageSTx?>
				      </div>
	        		<?php endif; ?>
			  </div>
			  	<div class="col-lg-6">

			  		<img src="https://img.icons8.com/ultraviolet/40/000000/new-job.png" alt="" class="mb-1">
			  		<label for="jabatan">Pilih jabatan</label>
			  	<select name="jabatan" id="jabatan" class="form-control <?=$inJBx?>" required >
			  		<option value="<?=$w['id_jabatan']?>">Pilih..</option>
			  		<?php 
                    $eb="SELECT * FROM jabatan";
                    $et=tampil($eb);
                    foreach ($et as $ee):
			  		?>
			  		<option value="<?=$ee['id_jabatan']?>"><?=$ee["nama_jabatan"]?></option>
			  	    <?php endforeach;?>
			  	</select>
			  	    <?php if(!empty($inJBx)): ?>
				      <div class="<?=$csJBx?>">
				        <?=$massageJBx?>
				      </div>
	        		<?php endif; ?>
			  </div>
		</div>

		  
			  
      <div class="modal-footer mt-5">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary" value="<?=$w['nik']?>" name="aedit">Simpan</button>
      </div>
    </form>
    </div>
  </div>
</div>
<?php endforeach;?>



</body>

<script src="../js/jquery-3.3.1.js"></script>
<script src="../js/jquery-3.3.1.min.js"></script>
<script src="../bootstrap/js/bootstrap.js"></script>
</html>