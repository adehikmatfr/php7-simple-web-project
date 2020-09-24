<?php
session_start();
session_unset();
session_destroy();
$_SESSION['user']='';
$_SESSION['level']='';
setcookie('72d4b2a056788e501159c1671c272d74','',time()-3600);
echo "
<script>
document.location.href='index.php';
</script>
";
