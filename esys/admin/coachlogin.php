<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<head>
<title>Antingen login</title>
<link rel="stylesheet" href="style.css" type="text/css">
</head>
<body id="adminlogin">
<form name="login" method="post" action="login.php">
<fieldset id="admlogin"><legend><img src="../dimg/logga_84x29.png"/></legend>
<table id="logintable" border="0"><tr><td valign="top">
<label for="username">Anv&auml;ndarnamn:</label><br/><br/>
<label for="password">L&ouml;senord:</label>
</td><td valign="top">
<input type="text" name="username"/><br/>
<input type="password" name="password"/><br/>
<input type="submit" class="submit" onclick="document.login.submit()" value="Logga in"/><br/><br/>
</td></tr></table>
</fieldset>
</form>
</body>
</html>