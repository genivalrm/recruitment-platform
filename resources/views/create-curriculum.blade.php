<!DOCTYPE html>
<html>
<head>
	<title>Curriculos</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
	<header>
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<ul class="nav navbar-nav">
					<li><a href="{{ action('HomeController@index') }}">Visualizar Currículo</a></li>	
					<li><a href="{{ action('HomeController@create') }}">Inserir Currículo</a></li>	
				</ul>
			</div>
		</nav>
	</header>
	<div class="container">
		@if (session('message'))
		    <div class="alert alert-success">
		        {{ session('message') }}
		    </div>
		@endif
		<form class="add-profile" action="{{ action('HomeController@store') }}" method="post" enctype="multipart/form-data">
			@csrf
			<div class="row">
				<div class="col-md-6">
					<!-- Name -->
					<div class="form-group">
						<label class="label-sm">Nome*</span></label>
						<input type="text" name="name" class="form-control" placeholder="Nome" required>
					</div>
				</div>
				<div class="col-md-6">
					<!-- Email -->
					<div class="form-group">
						<label class="label-sm">Email*</label>
						<input type="email" name="email" class="form-control" placeholder="Email" required>
					</div>
				</div>
				<div class="col-md-4">
					<!-- Office -->
					<div class="form-group">
						<label class="label-sm" class="btn btn-primary">Cargo*</label>
						<select name="office" class="form-control">
							<option value="E">Estágio</option>
							<option value="A">Administração</option>
							<option value="D">Desenvolvedor</option>
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<!-- Phone -->
					<div class="form-group">
						<label class="label-sm">Telefone*</label>
						<input type="tel" name="phone" class="form-control mask-phone" regex="^(|.{14,15})$" placeholder="(xx)xxxx-xxxx" required>
					</div>
				</div>
				<div class="col-md-4">
					<!-- Curriculum -->
					<div class="form-group">
						<label class="label-sm">Currículo*</label>
						<input type="file" name="curriculum" class="form-control" required>
					</div>
				</div>
				<div class="col-md-8">
					<!-- Tag -->
					<div class="form-group">
					  <label>Tag's:</label>
					  <textarea class="form-control" rows="5" name="tag"></textarea>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<!-- Submit -->
					<button type="submit" class="btn btn-success btn-block">Salvar</button>
				</div>
			</div>
		</form>
</body>
</html>