<?php
error_reporting(0);
session_start();
if($_SESSION['chef'] or $_SESSION['ulvl'] == 4) $location = 2;
elseif($_SESSION['coach'] or $_SESSION['ulvl'] > 5) $location = 1;
else $location = 0;
$_SESSION['ulvl'] = 0;
unset($_SESSION['authory']);
unset($_SESSION['coach']);
unset($_SESSION['chef']);
unset($_SESSION['anv']);
unset($_SESSION['ulvl']);
unset($_SESSION['authorized']);
$coachlogin = 'logged';
$coachlosen = 'out';
setcookie('niana', $coachlogin.','.$coachlosen, time()-3600, '/', false, 0);
setcookie('niananv', $coachlogin.','.$coachlosen.','.$coachlosen, time()-3600, '/', false, 0);
setcookie('nianachef', $coachlogin.','.$coachlosen, time()-3600, '/', false, 0);
echo'
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="sv" />
<title>Antingen logout</title>
<link rel="stylesheet" href="style.css" type="text/css">
</head>
<body id="adminlogin">
<form name="logout" method="post"">
<div class="rowAB">
<fieldset id="admlogin"><legend><img src="../dimg/logga_84x29.png"/></legend>
<div class="colA4"><br/>
</div>
<div class="colB4"><br/>
Om du inte vidarebefodrats når du<br/>
<a href="../index.php">login för testtagare här</a><br/>
<a href="../login/index.php">login för chefer här</a><br/>
<a href="coachlogin.php">login för coacher här</a><br/>
</div>
</fieldset>
</div>
</form>
</body>
</html>
';
usleep(500000);
setcookie("niana", '', time()-32400);
setcookie("niananv", '', time()-32400);
setcookie("nianachef", '', time()-32400);
usleep(500000);
$_SESSION = array();
session_unset();
session_destroy();
if($location > 1){ header("location: ../login/index.php"); exit;
}elseif($location > 0){ header("location: coachlogin.php"); exit;
}else{ header("location: ../index.php");
}
?>