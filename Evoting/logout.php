<?php
session_start();
session_unset();
session_destroy();
$_SESSION['admin']='';

echo "
<script>
document.location.href='index.php';
</script>
";