<!DOCTYPE html>
<html>
<head>
	<title>Login-Curriculos</title>
	<link rel="stylesheet" href="lib/material-components-web.min.css">
	<link rel="stylesheet" href="css/login.css">
	<script type="text/javascript" src="lib/material-components-web.min.js"></script>
</head>
<body class="mdc-typography">
	<div class="login-page">
		<div class="form">
			<form class="login-form" action="{{ action('LoginController@authenticate') }}" method="post">
				@csrf
				<input type="text" name="email" placeholder="email"/>
				<input type="password" name="password" placeholder="password"/>
				<button>login</button>
			</form>
		</div>
	</div>	
</body>
</html>