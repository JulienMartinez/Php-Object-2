<?php

function routerStart(): void
{
    $route = $_SERVER[ 'REDIRECT_URL' ] ?? '/';

    switch ( $route ) {
        case '/':
            require_once PATH_ROOT. 'fonctions'. DS. 'home-function.php';
            homeRender();
            break;

        case '/liste':
            require_once PATH_ROOT. 'fonctions'. DS. 'liste-function.php';
            listeRender();
            break;

        case '/details':
            require_once PATH_ROOT. 'fonctions'. DS. 'details-function.php';
            detailsRender();
            break;
    }
}
