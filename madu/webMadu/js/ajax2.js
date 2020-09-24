
var cari= document.getElementById('cari');
var wadah= document.getElementById('wadah');

cari.addEventListener('keyup', function(){

  var xhr = new XMLHttpRequest();

  //cek kesiapan dokument

  xhr.onreadystatechange =function(){
     if(xhr.readyState == 4 && xhr.status == 200){
        wadah.innerHTML = xhr.responseText;
     }
  }
xhr.open('GET','../ajax/serch_day.php?key='+cari.value, true);
xhr.send();

});
