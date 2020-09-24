

var cari1= document.getElementById('car');
var wadah1= document.getElementById('cont');

cari1.addEventListener('keyup', function(){

  var xhr = new XMLHttpRequest();

  //cek kesiapan dokument

  xhr.onreadystatechange =function(){
     if(xhr.readyState == 4 && xhr.status == 200){
        wadah1.innerHTML = xhr.responseText;
     }
  }
xhr.open('GET','../ajax/serch_panen.php?key='+cari1.value, true);
xhr.send();

});

var sel= document.getElementById('sel');
var container= document.getElementById('sell');

sel.addEventListener('onchange', function(){

  var xhr = new XMLHttpRequest();

  //cek kesiapan dokument

  xhr.onreadystatechange =function(){
     if(xhr.readyState == 4 && xhr.status == 200){
        container.innerHTML = xhr.responseText;
        console.log('ok');
     }
  }
xhr.open('GET','../ajax/select.php?key='+sel.value, true);
xhr.send();

});