<!DOCTYPE html>
<html>
<head>
	<title>Curriculos</title>
	<link rel="stylesheet" href="css/view.css">
  <script src="{{ mix('js/modal.js') }}" DEFER="DEFER"></script>
	<link rel="stylesheet" href="lib/material-components-web.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
  <script src="https://code.getmdl.io/1.3.0/material.min.js"></script>
  <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
</head>
<body>
  <div class="container">
    <div class="form2">
      <label class="label-sm">Pesquisar Currículo</span></label>
      <input type="text" name="name" class="form-control" placeholder="Digite o Nome">
      <button type="button" class="btn btn-info">Search</button>
    </div>
  </div>
  <div class="container">
    @if(!$profiles)
      <p class="qtd-results">Não há currículos</p>
    @else
      @foreach ($profiles as $profile)
        <!-- cards -->
        <div class="demo-card-square mdl-card mdl-shadow--2dp">
          <div class="mdl-card__supporting-text">
            <!-- Name - Phone - Email-->
            <div>Nome: {{ $profile->name }}  | Telefone: {{ $profile->phone }}  | Email: {{ $profile->email }}</div>
            <!-- Office -->
            <div>
            @if($profile->office == 'E')
              Estágio
            @elseif($profile->office == 'D')
              Developer
            @else
              Administração
            @endif
            <!-- Status -->
              |  
            @if($curriculas[$profile->curriculum_id]->status == '1')
              Pendente
            @elseif($curriculas[$profile->curriculum_id]->status == '2')
              Em Análise
            @elseif($curriculas[$profile->curriculum_id]->status == '3')
              Entrevista Marcada
            @else
              Encerrado
            @endif
            </div>
            <!-- Buttons -->
            <div class="mdl-card__actions mdl-card--border">
              <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" target="_blank" href="{{ action('CurriculumController@show', encrypt($profile->curriculum_id)) }}">
                View Curriculum
              </a>
              <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect btn-info dialog-button" data="{{ encrypt($profile->curriculum_id) }}">
                Modify Status
              </a>
              <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                View Tag's
              </a>
            </div>
          </div>
        </div>
      @endforeach
    @endif
  </div> 
  <dialog id="dialog" class="mdl-dialog">
    <h3 class="mdl-dialog__title">Alterar Status</h3>
    <form action="{{ action('CurriculumController@store') }}" method="post">
      @csrf
      <input type="hidden" name="id">    
      <div class="mdl-dialog__content">
        <ul class='mdl-list'>
          <li class="mdl-list__item">
            <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect">
              <input type="radio" class="mdl-radio__button" name="option" value="1" checked>
              <span class="mdl-radio__label">Pendente</span>
            </label>
          </li>
          <li class="mdl-list__item">
            <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect">
              <input type="radio" class="mdl-radio__button" name="option" value="2">
              <span class="mdl-radio__label">Em Análise</span>
            </label>
          </li>
          <li class="mdl-list__item">
            <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect">
              <input type="radio" class="mdl-radio__button" name="option" value="3">
              <span class="mdl-radio__label">Entrevista Marcada</span>
            </label>
          </li>
          <li class="mdl-list__item">
            <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect">
              <input type="radio" class="mdl-radio__button" name="option" value="4">
              <span class="mdl-radio__label">Encerrado</span>
            </label>
          </li>
        </ul>
      </div>
      <div class="mdl-dialog__actions">
        <button type="submit" class="mdl-button bnt-sucess">OK</button>
        <button type="button" class="mdl-button bnt-cancel">Cancel</button>
      </div>
    </form>
  </dialog>
</body>
</html>