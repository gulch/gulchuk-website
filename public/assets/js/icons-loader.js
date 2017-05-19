;(function (window, document) {
    'use strict';
    
    /*версия спрайта*/
    var revision = '1.0.1';

    /*путь к файлу спрайта на сервере*/
    var file = '/build/' + revision + '/icons.svg';

    if (!document.createElementNS || !document.createElementNS('http://www.w3.org/2000/svg', 'svg').createSVGRect) return true;
    var isLocalStorage = 'localStorage' in window && window['localStorage'] !== null,
        request,
        data,
        insertIT = function () {
            document.body.insertAdjacentHTML('afterbegin', data);
        },
        insert = function () {
            if (document.body) insertIT();
            else document.addEventListener('DOMContentLoaded', insertIT);
        };
    if (isLocalStorage && localStorage.getItem('SVGIconsRev') == revision) {
        data = localStorage.getItem('SVGIconsData');
        if (data) {
            insert();
            return true;
        }
    }
    try {
        request = new XMLHttpRequest();
        request.open('GET', file, true);
        request.onload = function () {
            if (request.status >= 200 && request.status < 400) {
                data = request.responseText;
                insert();
                if (isLocalStorage) {
                    localStorage.setItem('SVGIconsData', data);
                    localStorage.setItem('SVGIconsRev', revision);
                }
            }
        }
        request.send();
    } catch (e) {

    }
}(window, document));