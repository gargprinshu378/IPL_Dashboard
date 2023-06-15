<!DOCTYPE html>
<html>
<head>
	<title>Choose User Type</title>
    <link rel="stylesheet" href="/css/index.css">
</head>
<body>
	<!-- Welcome message -->
	<h1>Welcome!</h1>
	<p>Please choose your user type:</p>
	<!-- Button for Anonymous User -->
	<form action="anonymous.php" method="post">
		<button type="submit" name="user_type" value="anonymous_user">Anonymous User</button>
	</form>
	<!-- Button for Content Editor -->
    <form action="login.php" method="post">
		<button type="submit" name="user_type" value="content_editor">Content Editor</button>
	</form>	
</body>
</html>
