<!DOCTYPE html>
<html>
<head>
	<title>Curriculos</title>
	<link rel="stylesheet" href="css/view.css">
	<link rel="stylesheet" href="lib/material-components-web.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
</head>
<body class="mdc-typography">
	@if (session('message'))
	    <div class="alert alert-success">
	        {{ session('message') }}
	    </div>
	@endif
	<a href="{{ action('LoginController@authenticate') }}"><i class="material-icons" title="Login">account_box</i></a>
	<div class="container">
	 	<div class="form">
			<form class="add-profile" action="{{ action('HomeController@store') }}" method="post" enctype="multipart/form-data">
				@csrf
				<div class="row">
					<h3>Enviar Currículo</h3>
					<!-- Name -->
					<label class="label-sm">Nome:</span></label>
					<input type="text" name="name" class="form-control" placeholder="Nome" required>
					<!-- Email -->
					<label class="label-sm">Email:</label>
					<input type="email" name="email" class="form-control" placeholder="Email" required>
					<!-- Office -->
					<label class="label-sm" class="btn btn-primary">Cargo:</label>
					<select name="office" class="form-control">
						<option value="E">Estágio</option>
						<option value="A">Administração</option>
						<option value="D">Desenvolvedor</option>
					</select>
					<!-- Phone -->
					<label class="label-sm">Telefone:</label>
					<input type="tel" name="phone" class="form-control mask-phone" regex="^(|.{14,15})$" placeholder="(xx)xxxx-xxxx" required>
					<!-- Curriculum -->
					<label class="label-sm">Currículo:</label>
					<input type="file" name="curriculum" class="form-control" required>
					<!-- Tag -->
					<label>Tag's:</label>
					<textarea class="form-control" rows="3" name="tag"></textarea>
					<!-- Submit -->
					<button type="submit">Salvar</button>
				</div>
			</div>
		</form>
	</div>
</body>
</html>