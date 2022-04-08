<?php

function listeRender() {
    $html_title = 'liste';
    require_once PATH_ROOT. 'partials'. DS. 'top-html.php';
    require_once PATH_ROOT. 'pages'. DS. 'liste.php';
    require_once PATH_ROOT. 'partials'. DS. 'bottom-html.php';
}
