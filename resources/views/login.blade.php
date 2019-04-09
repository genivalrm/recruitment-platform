<!DOCTYPE html>
<html>
	<head>
		<title>Curriculo - Login</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="{{ mix('lib/js/material.min.js') }}" DEFER="DEFER"></script>
		<script src="{{ mix('lib/js/jquery.min.js') }}" type="text/javascript" DEFER="DEFER"></script>
		<script src="{{ mix('js/login.js') }}" type="text/javascript" DEFER="DEFER"></script>

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
{{-- 		<link rel="stylesheet" href="{{ mix('lib/material-icons.css') }}">
		<link href="{{ mix('lib/roboto-300-400-700') }}" rel="stylesheet"> --}}
		<link rel="stylesheet" href="{{ mix('lib/css/material.min.css') }}" />
		<link rel="stylesheet" href="{{ mix('css/utils.css') }}">
		<link rel="stylesheet" href="{{ mix('css/login.css') }}">
	</head>
	<body>
		<div class="mdl-grid h-full flex align-center">
			<div class="mdl-cell mdl-cell--middle mdl-cell--4-col mdl-cell--6-col-tablet mdl-cell--4-col-phone mdl-cell--4-offset-desktop mdl-cell--1-offset-tablet">
				<div class="demo-card-square mdl-card mdl-shadow--8dp w-full">
					<div class="mdl-card__title mdl-card--expand">
						<h2 class="mdl-card__title-text">Login</h2>
					</div>
					<div class="mdl-card__supporting-text mdl-card__supporting-text--full">
						<form id="login-form" class="login-form" action="{{ action('LoginController@authenticate') }}" method="POST">
							@csrf
							<div class="mdl-textfield mdl-js-textfield pr-6 flex align-center w-full">
								<i class="mdl-textfield__icon material-icons self-center">email</i>
								<input class="mdl-textfield__input" name="email" type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
								data-required="true">
								<label class="mdl-textfield__label">E-mail*</label>
							</div>
							<div class="mdl-textfield mdl-js-textfield pr-6 flex align-center w-full">
								<i class="mdl-textfield__icon material-icons self-center">lock</i>
								<input class="mdl-textfield__input" name="password" type="password" data-required="true">
								<label class="mdl-textfield__label">Senha*</label>
							</div>
						</form>
						<p class="font-12 color-red mb-0 ml-8">* Campos obrigatórios</p>
					</div>
					<div class="mdl-card__actions mdl-card--border flex align-center flex-end">
						@if (session('message'))
							<p class="font-12 color-red mb-0 ml-8">
								{{ session('message') }}
							</p>
						@endif
						<button class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect ev-submit-login" type="submit" form="login-form" value="Submit">Entrar</button>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>