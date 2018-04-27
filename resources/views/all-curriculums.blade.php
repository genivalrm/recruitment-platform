<!DOCTYPE html>
<html>
<head>
	<title>Curriculos</title>
  <script src="{{ mix('js/modal.js') }}" DEFER="DEFER"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
  <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
  <link rel="stylesheet" href="css/modal.css">
  <link rel="stylesheet" href="css/view.css">
</head>
<body>
  <!-- Search curriculum -->
  <div class="container flex-center">
    <form action="{{ action('CurriculumController@index') }}" method="get" class="width-80">
      @csrf
      <div class="mdl-textfield mdl-js-textfield width-80">
        <input class="mdl-textfield__input" type="search" name="name">
        <label class="mdl-textfield__label">Digite o Nome</label>
      </div>
      <button type="submit" class="mdl-button mdl-js-button mdl-button--primary">
        Pesquisar
      </button>
    </form>
    <div class="logout">
      <a href="{{ action('LoginController@logout') }}"><i class="material-icons" title="Logout">account_box</i></a>
    </div>
  </div>
  <!-- List curriculas -->
  <div class="container flex-center">
    <!-- Head -->
    <div>
      <label>Resultados</label>
    </div>
  </div>
  <div class="container flex-center">
    <!-- Results -->
    @if(!$profiles)
      <!-- No results -->
      <p>Nenhum resultado encontrado</p>
    @else
      @foreach($profiles as $profile)
        <div class="demo-card-event mdl-card mdl-shadow--2dp">
          <div class="mdl-card__title mdl-card--expand">
            <div>
              <!-- Name -->
              <i class="material-icons">person</i> {{ $profile->name }}<br>
              <!-- Phone -->
              <i class="material-icons">call</i> {{ $profile->phone }}<br>
              <!-- Email -->
              <i class="material-icons">email</i> {{ $profile->email }}<br>
              <!-- Estágio -->
              <i class="material-icons">info</i> 
              @if($profile->internship)
                Estágio<br>
              @else
                Não Estágio<br>
              @endif
              <!-- Office -->
              Áreas de Ineteresse:<br>
              @foreach($profile->office as $office)
                @if($office == '1')
                  - Área 1 <br>
                @elseif($office == '2')
                  - Área 2 <br>
                @elseif($office == '3')
                  - Área 3 <br>
                @elseif($office == '4')
                  - Área 4 <br>
                @else
                  - Área 5 <br>
                @endif
              @endforeach
              <!-- Linkedin -->
              @if($profile->linkedin)
                Lin: {{ $profile->linkedin }} <br>
              @endif
              <!-- github -->
              @if($profile->github)
                Git: {{ $profile->github }} <br>
              @endif
              <!-- Status -->
              Status: 
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
          </div>
          <div class="mdl-card__actions mdl-card--border">
            <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" target="_blank" href="{{ action('CurriculumController@show', encrypt($profile->curriculum_id))}}">
              <i class="material-icons" title="Currículo">&#xE2BC;</i>
            </a>
            <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect btn-info dialog-button" data="{{ encrypt($profile->curriculum_id) }}">
              <i class="material-icons" title="Alterar Status">&#xE5D4;</i>
            </a>
            <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
              <i class="material-icons" title="Tag's">&#xE86F;</i>
            </a>
          </div>
        </div>
      @endforeach
    @endif
  </div>
  <!-- Modal Status-->
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