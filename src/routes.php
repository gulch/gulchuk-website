<?php

return [
    ['GET', '/login', ['Gulchuk\Controllers\AuthController', 'showLoginPage']],
    ['GET', '/cv', ['Gulchuk\Controllers\PageController', 'showCvPage']],
    ['GET', '/', ['Gulchuk\Controllers\PageController', 'index']],
    ['GET', '/{slug}', ['Gulchuk\Controllers\PageController', 'showPage']]
];