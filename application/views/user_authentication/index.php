<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login Api Graph Facebook & Codeigniter</title>
</head>
<body>
<?php
if(!empty($authUrl)) {
	echo '<a href="'.$authUrl.'"><img style="margin-left: 40%;" src="'.base_url().'../assets/images/flogin.png" alt=""/></a>';
}
else{
    echo '<a href="'.$logoutUrl.'"><img style="margin-left: 40%;height: 30%;" src="'.base_url().'../assets/images/logout.jpg" alt=""/></a>';
}    
?>    
</body>
</html>