<?php

function homeRender() {
    $html_title = 'home';
    require_once PATH_ROOT. 'partials'. DS. 'top-html.php';
    require_once PATH_ROOT. 'pages'. DS. 'home.php';
    require_once PATH_ROOT. 'partials'. DS. 'bottom-html.php';
}