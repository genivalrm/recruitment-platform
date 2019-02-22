<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<meta name="description" content="Trabalhe conosco - {{env('company', '')}}">
		<meta name="keywords" content="curriculum,{{env('company', '')}},trabalhe">
		<meta name='language' content='pt-br'>
		<link rel="shortcut icon" href="{{env('FAVICON', '../images/favicon.png')}}" type="image/x-icon">
        <title>Trabalhe conosco</title>

        <script src="{{ mix('lib/js/jquery.min.js') }}" type="text/javascript" DEFER="DEFER"></script>
        <script src="{{ mix('lib/js/jquery.mask.min.js') }}" type="text/javascript" DEFER="DEFER"></script>
        <script src="{{ mix('lib/js/material.min.js') }}" DEFER="DEFER"></script>
        <script src="{{ mix('js/mask-tel.js') }}" type="text/javascript" DEFER="DEFER"></script>
        <script src="{{ mix('js/insert.js') }}" type="text/javascript" DEFER="DEFER"></script>

        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
        {{-- <link rel="stylesheet" href="{{ mix('lib/material-icons.css') }}"> --}}
        {{-- <link rel="stylesheet" href="{{ mix('lib/roboto-300-400-700') }}"> --}}
        {{-- <link rel="stylesheet" href="{{ mix('lib/fontawesome-5.0.10-all') }}"> --}}
        <link rel="stylesheet" href="{{ mix('lib/css/material.min.css') }}" />
        <link rel="stylesheet" href="{{ mix('css/utils.css') }}">
        <link rel="stylesheet" href="{{ mix('css/insert.css') }}">
    </head>
<!-- Uses a transparent header that draws on top of the layout's background -->
    <body class="flex row center max">
            <div class="demo-layout-transparent mdl-layout mdl-js-layout mdl-layout--no-desktop-drawer-button mdl-layout--fixed-header">
                <header class="mdl-layout__header mdl-layout__header--transparent">
                    <div class="mdl-layout__header-row">
                    <!-- Title -->
                    <span class="mdl-layout-title mdl-layout--large-screen-only">
                        <a href="#">
                        <img src="{{env('LOGO', '../images/logo.png')}}" class="logo" alt="logo">
                        </a>
                    </span>
                    <!-- Add spacer, to align navigation to the right -->
                    <div class="mdl-layout-spacer"></div>
                    <!-- Navigation -->
                    <nav class="mdl-navigation mdl-layout--large-screen-only">
                        <a class="mdl-navigation__link color-white" href="../curriculum">Login</a>
                    </nav>
                    </div>
                </header>
                <div class="mdl-layout__drawer">
                    <span class="mdl-layout-title">
                        <a href="#">
                            <img src="{{env('LOGO_DRAWER', '../images/logo-mobile.png')}}" class="logo-drawer" alt="logo">
                        </a>
                    </span>
                    <nav class="mdl-navigation">
                        <a class="mdl-navigation__link" href="../curriculum/auth">Login</a>
                    </nav>
                </div>
                <main class="mdl-layout__content flex center">
                    <div class="front-of-bg mb-90 mg-lr-10 self-start">
                        {{-- <div class="mb-30">
                            <img src="images/logo.png" class="shadow logo" alt="logo">
                        </div> --}}
                        <div class="mb-30 text-center">
                            <h5 class="phrase">May your force be with us!</h5>
                        </div>
                        <div class="demo-card-wide mdl-card mdl-shadow--8dp">
                            <div class="mdl-card__supporting-text mdl-card__supporting-text--full">
                                <form class="curriculo-form" action="{{ action('HomeController@store') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mdl-textfield mdl-js-textfield w-full pr-24 flex align-center">
                                        <i class="mdl-textfield__icon material-icons self-center">person</i>
                                        <input class="mdl-textfield__input" name="name" type="text" data-required="true" autofocus>
                                        <label class="mdl-textfield__label">Nome*</label>
                                    </div>
                                    <div class="mdl-textfield mdl-js-textfield w-full pr-24 flex align-center">
                                        <i class="mdl-textfield__icon material-icons self-center">email</i>
                                        <input class="mdl-textfield__input" name="email" type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
                                        data-required="true">
                                        <label class="mdl-textfield__label">E-mail*</label>
                                    </div>
                                    <div class="mdl-textfield mdl-js-textfield w-full pr-24 flex align-center">
                                        <i class="mdl-textfield__icon material-icons self-center">call</i>
                                        <input class="mdl-textfield__input mask-tel" name="tel" type="text" pattern=".{14,15}" data-required="true">
                                        <label class="mdl-textfield__label">Telefone*</label>
                                    </div>
                                    <div class="mdl-textfield mdl-js-textfield w-full pr-24 flex align-center">
                                        <i class="mdl-textfield__icon fab fa-linkedin icon-24 self-center"></i>
                                        <input class="mdl-textfield__input" name="linkedin" type="url" pattern="https?://(www.)?linkedin.com/in/.+">
                                        <label class="mdl-textfield__label">LinkedIn</label>
                                    </div>
                                    <div class="mdl-textfield mdl-js-textfield w-full pr-24 flex align-center">
                                        <i class="mdl-textfield__icon fab fa-github icon-24 self-center"></i>
                                        <input class="mdl-textfield__input" name="github" type="url" pattern="https?://(www.)?github.com/.+">
                                        <label class="mdl-textfield__label">GitHub</label>
                                    </div>
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--file w-full pr-24 flex align-center">
                                        <div class="mdl-button mdl-button--primary mdl-button--icon mdl-button--file mr-24">
                                            <i class="material-icons">attach_file</i>
                                            <input type="file" name="upload-btn" accept=".pdf" required>
                                        </div>
                                        <input class="mdl-textfield__input w-file" placeholder="Selecione seu currículo (.pdf)*" type="text" name="upload-file" readonly/>
                                    </div>
                                    <div class="pd-20-tb ml-48">
                                        <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect">
                                            <input type="checkbox" name="internship" class="mdl-switch__input" value="1">
                                            <span class="mdl-switch__label font-16">Estágio</span>
                                        </label>
                                    </div>
                                    <div class="pt-15 ml-4">
                                        <p class="mg-0"> Áreas de interesse</p>
                                    </div>
                                    <div class="mdl-grid pl-48">
                                        @foreach($offices as $office)
                                            <div class="mdl-cell mdl-cell--6-col mdl-cell--4-col-tablet mdl-cell--4-col-phone">
                                                <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect">
                                                    <input type="checkbox" name="office[]" value="{{ $office->id }}" class="mdl-checkbox__input">
                                                    <span class="mdl-checkbox__label">{{ $office->name }}</span>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="pd-20-tb">
                                        {!! Recaptcha::render() !!}
                                        <div class="recaptcha-required"></div>
                                    <div>
                                    <button class="submit-btn mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored fab-on-edge">
                                        <i class="material-icons">send</i>
                                    </button>
                                </form>
                                <div class="pt-15">
                                    <p class="mg-0 font-12 color-red">* Campos obrigatórios</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>

            @if(Session('curriculumSended'))
                <div aria-live="assertive" aria-atomic="true" aria-relevant="text" class="mdl-snackbar mdl-snackbar--active mdl-snackbar-success mdl-js-snackbar flex center">
                    <i class="material-icons color-dark-green pl-16">done</i>
                    <div class="mdl-snackbar__text pd-16 self-center color-dark-green font-14 text-justify"></div>
                    <button type="button" class="mdl-snackbar__action none"></button>
                </div>
                <script>
                    r(function() {
                    var notification = document.querySelector('.mdl-js-snackbar');
                        notification.MaterialSnackbar.showSnackbar({
                            message: '{{Session('curriculumSended')}}',
                            timeout: 3000,
                        });
                    });
                    function r(f){/in/.test(document.readyState)?setTimeout('r('+f+')',9):f()}
                </script>
            @endif

            @if ($errors->any())
                <div aria-live="assertive" aria-atomic="true" aria-relevant="text" class="mdl-snackbar mdl-snackbar-alert mdl-js-snackbar mdl-snackbar--active flex center">
                    <div class="mdl-snackbar__text pd-16 self-center color-dark-red">
                        <ul class="pl-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <button type="button" class="mdl-snackbar__action none"></button>
                </div>
            @endif
    </body>
</html>