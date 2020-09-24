<?php
session_start();
session_unset();
session_destroy();
$_SESSION['voute']='';
$_SESSION['jk']='';
echo "
<script>
document.location.href='index.php';
</script>
";