<!DOCTYPE html>
<html>
<head>
	<title>Curriculos</title>
	
	<script src="{{ mix('js/file.js') }}" DEFER="DEFER"></script>
  	<link rel="stylesheet" href="css/curriculum.css">
</head>
<body>
	<div class="container">
		<imgsrc="/images/logo_sys.png">
	</div>
	<div class="container">
		<label>Nosso time aguarda VOCE!</label>
	</div>
	<div class="container">
		<div>
			<form action="{{ action('HomeController@store') }}" method="post" enctype="multipart/form-data">
				@csrf
				<ul>
	          		<li>
	          			<!-- Name -->
				    	<div>
				    		<label>Nome</label>
				    		<input type="text" name="name" required>
				      	</div>
	          		</li>
	          		<li>
	          			<!-- Email -->
				      	<div>
				      		<label>Email</label>
				        	<input type="email" name="email" required>
				      	</div>
	          		</li>
	          		<li>
	          			<!-- Phone -->
				      	<div>
				      		<label>Telefone</label>
						    <input type="text" pattern="-?[0-9]*(\.[0-9]+)?" name="phone" required>
						</div>
	          		</li>
	          		<li>
	          			<!-- Curriculum -->
				      	<div>
				      		<label>Currículo</label>
				        	<input type="file" name="curriculum" required>
				      	</div>
	          		</li>
	          		<li>
	          			<!-- Linkedin -->
				      	<div>
				      		<label>Linkedin</label>
						    <input type="text" name="linkedin">
						</div>
	          		</li>
	          		<li>
	          			<!-- GitHub -->
				      	<div>
				      		<label>GitHub</label>
						    <input type="text" name="github">
						</div>
	          		</li>
	          		<li>
	          			<div>
				      		<label>Estágio</label>
						    <input type="checkbox" name="internship[]" value="1">
						</div>
	          		</li>
	          		<li>
		          		<!-- Office -->
		          		<label>Áreas de Interesse</label>
				      	<div>
				        	<label>
							  <input type="checkbox" name="office[]" value="1">
							  <span>Estágio</span>
							</label>
							<label>
							  <input type="checkbox" name="office[]" value="2">
							  <span>Administração</span>
							</label>
							<label>
							  <input type="checkbox" name="office[]" value="3">
							  <span>Desenvolvedor</span>
							</label>
				      	</div>
	          		</li>
	          		<li>
	          			<button type="submit">Submit</button>
	          		</li>
	          	</ul>
		    </form>
		</div>
		@if (session('message'))
			<div>
				<div class="alert alert-success">
				    {{ session('message') }}
				</div>
			</div>
		@endif
		</div>
	</div>
</body>
</html>