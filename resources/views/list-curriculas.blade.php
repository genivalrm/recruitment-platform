<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Currículos</title>

    <script src="{{ mix('lib/jquery.min.js') }}" type="text/javascript" DEFER="DEFER"></script>
    <script src="https://code.getmdl.io/1.3.0/material.min.js" DEFER="DEFER"></script>
    <script src="{{ mix('js/list.js') }}" type="text/javascript" DEFER="DEFER"></script>

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg"
        crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="node_modules/dialog-polyfill/dialog-polyfill.css" />
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.light_blue-blue.min.css" />
    <link rel="stylesheet" href="{{ mix('css/list.css') }}">
</head>

<body>
    <div class="demo-layout-waterfall mdl-layout mdl-js-layout mdl-layout--no-desktop-drawer-button">
        <header class="mdl-layout__header mdl-layout__header--waterfall">
            <!-- Top row, always visible -->
            <div class="mdl-layout__header-row">
                <!-- Title -->
                <span class="mdl-layout-title">
                    <img src="images/logo.png" class="logo" alt="You logo">
                </span>
                <div class="mdl-layout-spacer"></div>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable
                          mdl-textfield--floating-label mdl-textfield--align-right">
                    <label class="mdl-button mdl-js-button mdl-button--icon" for="nav-search">
                        <i class="material-icons">search</i>
                    </label>
                    <div class="mdl-textfield__expandable-holder">
                        <input class="mdl-textfield__input" type="text" name="sample" id="nav-search">
                    </div>
                </div>
                <!-- Icon button -->
                <button class="mdl-button mdl-js-button mdl-button--icon ml-26">
                    <i class="material-icons">exit_to_app</i>
                </button>
            </div>
        </header>
        <div class="mdl-layout__drawer">
            <span class="mdl-layout-title">
                <img src="images/logo.png" class="logo-drawer" alt="You logo">
            </span>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable
                          mdl-textfield--floating-label mdl-textfield--align-left pd-lr-16">
                <label class="mdl-button mdl-js-button mdl-button--icon" for="drawer-search">
                    <i class="material-icons">search</i>
                </label>
                <div class="mdl-textfield__expandable-holder">
                    <input class="mdl-textfield__input" type="text" name="sample" id="drawer-search">
                </div>
            </div>
            <nav class="mdl-navigation">
                <a class="mdl-navigation__link" href="">Link</a>
                <a class="mdl-navigation__link" href="">Link</a>
                <a class="mdl-navigation__link" href="">Link</a>
                <a class="mdl-navigation__link" href="">Link</a>
            </nav>
        </div>
        <main class="mdl-layout__content">
            <div class="page-content">
                <div class="mdl-grid pd-lr-64 pd-tb-60">
                    @foreach($profiles as $profile)
                        <div class="mdl-cell mdl-cell--4-col mdl-cell--8-col-tablet mdl-cell--4-col-phone">
                            <div class="mdl-card mdl-shadow--4dp mdl-card-wide">
                                <div class="mdl-card__title column pr-48">
                                    <h2 class="mdl-card__title-text self-center dont-break-out">{{ $profile->name }}</h2>
                                    <div class="mdl-card__subtitle-text self-center">
                                        @if($profile->internship)
                                            <span class="mdl-chip chip-estagio">
                                                <span class="mdl-chip__text">Estágio</span>
                                            </span>
                                        @else
                                            <span class="mdl-chip chip-contrato">
                                                <span class="mdl-chip__text">Contrato</span>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <!-- <hr class="mg-0 pd-0"> -->
                                <div class="mdl-card__supporting-text">
                                    <ul class="mdl-list pd-tb-0 mg-tb-0">
                                        <li class="mdl-list__item">
                                            <span class="mdl-list__item-primary-content">
                                                <i class="material-icons mdl-list__item-icon">call</i>
                                                <a href="tel:+5574991106578">{{ $profile->phone }}</a>
                                            </span>
                                        </li>
                                        <li class="mdl-list__item">
                                            <span class="mdl-list__item-primary-content">
                                                <i class="material-icons mdl-list__item-icon">email</i>
                                                <a class="dont-break-out" href="mailto:gabrielrafael2508@hotmail.com">{{ $profile->email }}</a>
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="mdl-card__menu">
                                    <button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect ev-discard" >
                                        <i class="material-icons">close</i>
                                    </button>
                                </div>
                                <!-- <hr class="mg-0 pd-0"> -->
                                <div class="mdl-card__actions flex space-between">
                                    <!-- Colored icon button -->
                                    <button class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored" href="{{ action('CurriculumController@show', encrypt($profile->curriculum_id))}}">
                                        <i class="material-icons icon-color">attachment</i>
                                    </button>
                                    @if($profile->github)
                                        <button class="mdl-button mdl-js-button mdl-button--icon">
                                            <a href="{{ $profile->github }}" target="_blank">
                                                <i class="mdl-textfield__icon fab fa-github icon-color font-24"></i>
                                            </a>
                                        </button>
                                    @endif
                                    @if($profile->linkedin)
                                        <button class="mdl-button mdl-js-button mdl-button--icon">
                                            <a href="{{ $profile->linkedin }}" target="_blank">
                                                <i class="mdl-textfield__icon fab fa-linkedin icon-color font-24"></i>
                                            </a>
                                        </button>
                                    @endif
                                    <button class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored ev-open-dialog">
                                        <i class="material-icons icon-color">polymer</i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </main>

    </div>
    <dialog class="mdl-dialog">
        <h4 class="mdl-dialog__title">Gabriel Rafael Gomes - TAGS</h4>
        <div class="mdl-dialog__content">
            <!-- Deletable Chip -->
            <span class="mdl-chip mdl-chip--deletable">
                <span class="mdl-chip__text">Front-end</span>
                <button type="button" class="mdl-chip__action">
                    <i class="material-icons">cancel</i>
                </button>
            </span>
            <span class="mdl-chip mdl-chip--deletable">
                <span class="mdl-chip__text">User experience</span>
                <button type="button" class="mdl-chip__action">
                    <i class="material-icons">cancel</i>
                </button>
            </span>
            <span class="mdl-chip mdl-chip--deletable">
                <span class="mdl-chip__text">Administração</span>
                <button type="button" class="mdl-chip__action">
                    <i class="material-icons">cancel</i>
                </button>
            </span>
            <span class="mdl-chip mdl-chip--deletable">
                <span class="mdl-chip__text">Node.JS</span>
                <button type="button" class="mdl-chip__action">
                    <i class="material-icons">cancel</i>
                </button>
            </span>
            <span class="mdl-chip mdl-chip--deletable">
                <span class="mdl-chip__text">JavaScript</span>
                <button type="button" class="mdl-chip__action">
                    <i class="material-icons">cancel</i>
                </button>
            </span>
        </div>
        <div class="mdl-dialog__actions">
            <button type="button" class="mdl-button mdl-js-button mdl-button--primary close">Fechar</button>
        </div>
    </dialog>
</body>

</html>