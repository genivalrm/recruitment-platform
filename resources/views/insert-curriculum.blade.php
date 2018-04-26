<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trabalhe conosco</title>

    <script src="{{ mix('lib/jquery.min.js') }}" type="text/javascript" DEFER="DEFER"></script>
    <script src="{{ mix('lib/jquery.mask.min.js') }}" type="text/javascript" DEFER="DEFER"></script>
    <script src="https://code.getmdl.io/1.3.0/material.min.js" DEFER="DEFER"></script>
    <script src="{{ mix('js/insert.js') }}" type="text/javascript" DEFER="DEFER"></script>

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.light_blue-blue.min.css" />
    <link rel="stylesheet" href="{{ mix('css/insert.css') }}">
</head>

<body class="flex row center max">
    <div class="front-of-bg mb-90 mg-lr-10 self-start">
        <div class="mb-30">
            <img src="images/logo.png" class="shadow logo" alt="You logo">
        </div>
        <div class="mb-30 text-center phrase">
            <p>May your force be with us!</p>
        </div>
        <div class="demo-card-wide mdl-card mdl-shadow--8dp">
            <div class="mdl-card__supporting-text mdl-card__supporting-text--full">
                <form class="curriculo-form" action="{{ action('HomeController@store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mdl-textfield mdl-js-textfield w-full">
                        <i class="mdl-textfield__icon material-icons">person</i>
                        <input class="mdl-textfield__input" name="name" type="text" required>
                        <label class="mdl-textfield__label">Nome*</label>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield w-full">
                        <i class="mdl-textfield__icon material-icons">email</i>
                        <input class="mdl-textfield__input" name="email" type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
                            required>
                        <label class="mdl-textfield__label">E-mail*</label>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield w-full">
                        <i class="mdl-textfield__icon material-icons">call</i>
                        <input class="mdl-textfield__input" name="tel" type="text" pattern=".{14,15}" required>
                        <label class="mdl-textfield__label">Telefone*</label>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield w-full">
                        <i class="mdl-textfield__icon fab fa-linkedin icon-24"></i>
                        <input class="mdl-textfield__input" name="linkedin" type="url" pattern="https?://(www.)?linkedin.com/in/.+">
                        <label class="mdl-textfield__label">LinkedIn</label>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield w-full">
                        <i class="mdl-textfield__icon fab fa-github icon-24"></i>
                        <input class="mdl-textfield__input" name="github" type="url" pattern="https?://(www.)?github.com/.+">
                        <label class="mdl-textfield__label">GitHub</label>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--file w-full">
                        <div class="mdl-button mdl-button--primary mdl-button--icon mdl-button--file">
                            <i class="material-icons">attach_file</i>
                            <input type="file" name="upload-btn" required>
                        </div>
                        <input class="mdl-textfield__input w-file" placeholder="Selecione seu currículo*" type="text" name="upload-file" readonly/>
                    </div>
                    <div class="pd-20-tb ml-48">
                        <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect">
                            <input type="checkbox" name="internship[]" class="mdl-switch__input" value="1">
                            <span class="mdl-switch__label font-16">Estágio</span>
                        </label>
                    </div>
                    <div class="pt-15">
                        <p class="mg-0"> Áreas de interesse</p>
                    </div>
                    <div class="mdl-grid pl-48">
                        <div class="mdl-cell mdl-cell--6-col mdl-cell--4-col-tablet mdl-cell--4-col-phone">
                            <ul class="demo-list-control mdl-list mt-0 pt-0 pl-0">
                                <li class="mdl-list__item">
                                    <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox-1">
                                        <input type="checkbox" id="checkbox-1" class="mdl-checkbox__input">
                                        <span class="mdl-checkbox__label">Front-end</span>
                                    </label>
                                </li>
                                <li class="mdl-list__item">
                                    <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox-2">
                                        <input type="checkbox" id="checkbox-2" class="mdl-checkbox__input">
                                        <span class="mdl-checkbox__label">Back-end</span>
                                    </label>
                                </li>
                            </ul>
                        </div>
                        <div class="mdl-cell mdl-cell--6-col mdl-cell--4-col-tablet mdl-cell--4-col-phone">
                            <ul class="demo-list-control mdl-list mt-0 pt-0">
                                <li class="mdl-list__item">
                                    <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox-3">
                                        <input type="checkbox" id="checkbox-3" class="mdl-checkbox__input">
                                        <span class="mdl-checkbox__label">Financeiro</span>
                                    </label>
                                </li>
                                <li class="mdl-list__item">
                                    <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox-4">
                                        <input type="checkbox" id="checkbox-4" class="mdl-checkbox__input">
                                        <span class="mdl-checkbox__label">Auxiliar geral</span>
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>
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
</body>
</html>