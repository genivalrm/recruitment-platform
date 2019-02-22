<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Currículo - Dashboard</title>

        <script src="{{ mix('lib/js/material.min.js') }}" DEFER="DEFER"></script>
        <script src="{{ mix('lib/js/jquery.min.js') }}" type="text/javascript" DEFER="DEFER"></script>
        <script src="{{ mix('lib/js/jquery.barrating.min.js') }}" type="text/javascript" DEFER="DEFER"></script>
        <script src="{{ mix('lib/js/jquery.mask.min.js') }}" type="text/javascript" DEFER="DEFER"></script>
        <script src="{{ mix('lib/js/dialog-polyfill.js') }}" type="text/javascript" DEFER="DEFER"></script>
        <script src="{{ mix('js/list.js') }}" type="text/javascript" DEFER="DEFER"></script>
        <script src="{{ mix('js/mask-tel.js') }}" type="text/javascript" DEFER="DEFER"></script>
        <script src="{{ mix('js/search.js') }}" type="text/javascript" DEFER="DEFER"></script>

        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        {{-- <link rel="stylesheet" href="{{ mix('lib/material-icons.css') }}"> --}}
        {{-- <link href="{{ mix('lib/roboto-300-400-700') }}" rel="stylesheet"> --}}
        {{-- <link rel="stylesheet" href="{{ mix('lib/fontawesome-4.7.0') }}"> --}}
        <link rel="stylesheet" href="{{ mix('lib/css/material.min.css') }}" />
        <link rel="stylesheet" href="{{ mix('lib/css/dialog-polyfill.css') }}">
        <link rel="stylesheet" href="{{ mix('lib/css/fontawesome-stars.css') }}">
        <link rel="stylesheet" href="{{ mix('css/utils.css') }}">
        <link rel="stylesheet" href="{{ mix('css/list.css') }}">

    </head>

    <body>
            <!-- Simple header with scrollable tabs. -->
        <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
            <header class="mdl-layout__header">
                <div class="mdl-layout__header-row flex">
                <!-- Title -->
                    <span class="mdl-layout-title mdl-layout--large-screen-only">
                        <a href="/curriculum">
                            <img src="{{ env('LOGO','/images/logo.png') }}" class="logo" alt="You logo">
                        </a>
                    </span>
                    <span class="mdl-layout-title mdl-layout--small-screen-only">
                        <a href="/curriculum">
                            <img src="{{ env('LOGO_DRAWER_WHITE', '/images/logo-mobile.png') }}" class="logo" alt="You logo">
                        </a>
                    </span>
                    <div class="mdl-layout-spacer"></div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable
                            mdl-textfield--floating-label mdl-textfield--align-right text-field-pd-0">
                        <label class="mdl-button mdl-js-button mdl-button--icon" for="nav-search">
                            <i class="material-icons icon-responsive color-white">search</i>
                            {{-- <i class="fa fa-search icon-responsive color-white" aria-hidden="true"></i> --}}
                        </label>
                        <div class="mdl-textfield__expandable-holder">
                            <input class="mdl-textfield__input" type="search" name="search" id="nav-search" placeholder="Pesquisar" autocomplete="off">
                        </div>
                    </div>
                    <!-- Icon button -->
                    <button class="mdl-button mdl-js-button mdl-button--icon ml-26 mb-4">
                        <a href="{{ action('LoginController@logout') }}">
                            {{-- <i class="fa fa-sign-out icon-responsive color-white" aria-hidden="true"></i> --}}
                            <i class="material-icons icon-responsive color-white">exit_to_app</i>
                        </a>
                    </button>
                </div>
                <!-- Tabs -->
                <div class="mdl-layout__tab-bar mdl-js-ripple-effect">
                    <a href="#scroll-tab-1" class="mdl-layout__tab is-active">Home</a>
                    <a href="#scroll-tab-2" class="mdl-layout__tab">Arquivados</a>
                </div>
            </header>
            <div class="mdl-layout__drawer">
                <span class="mdl-layout-title">Filtros</span>
                <ul class="demo-list-control mdl-list flex column">
                    <li class="mdl-list__item">
                        <span class="mdl-list__item-primary-content">
                            Estágio
                        </span>
                        <span class="mdl-list__item-secondary-action">
                            <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect pr-8">
                                <input type="checkbox" class="mdl-switch__input ev-internship-filter" checked />
                            </label>
                        </span>
                    </li>
                    <li class="mdl-list__item">
                        <span class="mdl-list__item-primary-content">
                            Contrato
                        </span>
                        <span class="mdl-list__item-secondary-action">
                            <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect pr-8">
                                <input type="checkbox" class="mdl-switch__input ev-contract-filter" checked />
                            </label>
                        </span>
                    </li>
                    <li class="mdl-list__item">
                        <span class="mdl-list__item-primary-content flex space-between">
                            <spam>Avaliação mínima</spam>

                            <select class="rating ev-filter-rating" data-current-rating="0">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>

                        </span>
                    </li>
                    <li class="mdl-list__item self-end">
                        <button class="mdl-button mdl-button--raised mdl-js-button mdl-js-ripple-effect ev-reset-filter">
                            Limpar
                        </button>
                    </li>
                </ul>
            </div>
            <main class="mdl-layout__content">
                @include('curriculas')
            </main>
        </div>
        <dialog class="mdl-dialog">
            <h4 class="mdl-dialog__title"></h4>
            <div class="mdl-dialog__content"></div>
            <div class="mdl-dialog__actions flex space-between wrap-reverse">
                <button type="button" class="mdl-button mdl-js-button mdl-button--primary ev-close-dialog">Fechar</button>
                <form action="#" method="POST" class="ev-submit-tag">
                    <div class="mdl-textfield mdl-js-textfield text-field-pd-0">
                    <input class="mdl-textfield__input" name="new-tag" type="text" data-required="true">
                    <label class="mdl-textfield__label">Adicionar tag</label>
                    </div>
                </form>
            </div>
        </dialog>
    </body>

</html>