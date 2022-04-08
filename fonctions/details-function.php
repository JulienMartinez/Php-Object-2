<?php

function detailsRender() {
    $html_title = 'details';
    require_once PATH_ROOT. 'partials'. DS. 'top-html.php';
    require_once PATH_ROOT. 'pages'. DS. 'details.php';
    require_once PATH_ROOT. 'partials'. DS. 'bottom-html.php';
}
