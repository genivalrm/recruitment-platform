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
		<form class="list-curriculums" action="curriculum/show">
			<div class="row">
				<div class="col-md-6">
					<!-- Search -->
					<div class="form-group">
						<input type="text" placeholder="Pesquisar por Nome" class="form-control" name="search" autocomplete="off">
					</div>
				</div>
				<button type="submit" class="align-self-end btn btn-min btn-success data">Pesquisar</button>
			</div>
		</form>
		{{-- Panel for results --}}
	<div class="panel panel-default panel-results">
		<div class="panel-body">
			<div class="content-results">
				@if(!$profiles)
					<p class="qtd-results">Não há currículos</p>
				@else
					<header class="navbar-brand"><b>Lista de Currículos</b></header>
					<table class="table table-striped">
						<colgroup>
							<col width="160">
							<col width="50">
							<col width="50">
							<col width="80">
							<col width="80">
							<col width="80">
							<col width="20">
						</colgroup>
						<thead>
							<tr>
								<th>Nome</th>
								<th>Cargo</th>
								<th>Status</th>
								<th>Telefone</th>
								<th>E-mail</th>
								<th>Currículo</th>
								<th>Comentários</th>
							</tr>
							@foreach ($profiles as $profile)
							    <tr>
									<th>{{ $profile->name }}</th>
									@if($profile->office == 'E')
										<th>Estágio</th>
									@elseif($profile->office == 'D')
										<th>Developer</th>
									@else
										<th>Administração</th>
									@endif
									@if($curriculas[$profile->curriculum_id]->status == 'P')
										<th>Pendente</th>
									@elseif($curriculas[$profile->curriculum_id]->status == 'R')
										<th>Reprovado</th>
									@else
										<th>Aprovado</th>
									@endif
									<th>{{ $profile->phone }}</th>
									<th>{{ $profile->email }}</th>
									<th><a target="_blank" href="{{ action('CurriculumController@show', encrypt($profile->curriculum_id)) }}">Currículo</a></th>
									<th>Comentários</th>
								</tr>
							@endforeach
						</thead>
					</table>
				@endif
				<!--<section class="flex">
					<div class="grow header--content">
						<header class="navbar-brand"><b>Lista de Currículos</b></header>
					</div>
					<div class="filter-result-list ">
						{{-- <div>
								<label class="block">Resultados por página</label>
								<select class="number-itens form-control chosen-select w-200" name="len">
								<option value="10">10 resultados</option>
								<option value="20">20 resultados</option>
								<option value="30">30 resultados</option>
							</select>
						</div> --}}
					</div>
				</section>-->
			</div>
		</div>{{-- fim do panel body --}}
	</div>
</body>
</html>