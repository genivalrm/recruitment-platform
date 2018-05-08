<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Currículo - Dashboard</title>

        <script src="https://code.getmdl.io/1.3.0/material.min.js" DEFER="DEFER"></script>
        <script src="{{ mix('lib/js/jquery.min.js') }}" type="text/javascript" DEFER="DEFER"></script>
        <script src="{{ mix('lib/js/jquery.barrating.min.js') }}" type="text/javascript" DEFER="DEFER"></script>
        <script src="{{ mix('lib/js/dialog-polyfill.js') }}" type="text/javascript" DEFER="DEFER"></script>
        <script src="{{ mix('js/list.js') }}" type="text/javascript" DEFER="DEFER"></script>

        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.light_blue-blue.min.css" />
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
                            <img src="../images/logo.png" class="logo" alt="You logo">
                        </a>
                    </span>
                    <span class="mdl-layout-title mdl-layout--small-screen-only">
                        <a href="/curriculum">
                            <img src="../images/logo-mobile.png" class="logo" alt="You logo">
                        </a>
                    </span>
                    <div class="mdl-layout-spacer"></div>
                    <form action="{{ action('CurriculumController@index') }}" method="GET" autocomplete="off" class="typeahead" role="search">
                        @csrf
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable
                                mdl-textfield--floating-label mdl-textfield--align-right text-field-pd-0">
                            <label class="mdl-button mdl-js-button mdl-button--icon" for="nav-search">
                                <i class="fa fa-search icon-responsive font-white" aria-hidden="true"></i>
                            </label>
                            <div class="mdl-textfield__expandable-holder">
                                <input class="mdl-textfield__input" type="search" name="name" id="nav-search" placeholder="Search" autocomplete="off">
                            </div>
                        </div>
                    </form>
                    <!-- Icon button -->
                    <button class="mdl-button mdl-js-button mdl-button--icon ml-26 mb-4">
                        <a href="{{ action('LoginController@logout') }}">
                            <i class="fa fa-sign-out icon-responsive font-white" aria-hidden="true"></i>
                        </a>
                    </button>
                </div>
                <!-- Tabs -->
                <div class="mdl-layout__tab-bar mdl-js-ripple-effect">
                    <a href="#scroll-tab-1" class="mdl-layout__tab is-active">Home</a>
                    <a href="#scroll-tab-2" class="mdl-layout__tab">Arquivados</a>
                </div>
            </header>
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