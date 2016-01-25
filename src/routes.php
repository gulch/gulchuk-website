<?php

return [
    ['GET', '/{slug}', ['Gulchuk\Controllers\PageController', 'showPage']],
    ['GET', '/', ['Gulchuk\Controllers\PageController', 'index']]
];