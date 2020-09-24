
var cari= document.getElementById('src');
var wadah= document.getElementById('con');

cari.addEventListener('keyup', function(){

  var xhr = new XMLHttpRequest();

  //cek kesiapan dokument

  xhr.onreadystatechange =function(){
     if(xhr.readyState == 4 && xhr.status == 200){
        wadah.innerHTML = xhr.responseText;
     }
  }
xhr.open('GET','../ajax/src_pem.php?key='+cari.value, true);
xhr.send();

});
