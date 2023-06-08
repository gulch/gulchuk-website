(function (window, document) {
    'use strict';

    var prefix = 'Gulchuk_SVG';
    var dataKeyName = prefix + '_Data';
    var versionKeyName = prefix + '_Version';

    /* sprite version */
    var app_version = document.querySelector('meta[name="version"]')?.content;
    if (!app_version) {
        /* console.error('SVG Loader: app version not defined'); */
        return true;
    }

    /* path to svg sprite */
    var file = '/a/' + app_version + '/s.svg';

    /* if (!document.createElementNS || !document.createElementNS('http://www.w3.org/2000/svg', 'svg').createSVGRect) {
        return true;
    } */

    var isLocalStorage = 'localStorage' in window && window['localStorage'] !== null;

    if (!isLocalStorage) {
        return true;
    }

    var data;

    var insertIT = function () {
        document.body.insertAdjacentHTML('beforeend', data);
    };

    var insert = function () {
        if (document.body) {
            insertIT();
        } else {
            document.addEventListener('DOMContentLoaded', insertIT);
        }
    };

    if (localStorage.getItem(versionKeyName) == app_version) {
        data = localStorage.getItem(dataKeyName);
        if (data) {
            insert();
            return true;
        }
    }

    fetch(file, { fetchpriority: "high" })
        .then((response) => {
            return response.text();
        })
        .then((text) => {
            data = text;
            insert();
            localStorage.setItem(dataKeyName, data);
            localStorage.setItem(versionKeyName, app_version);
        })
        .catch((e) => {
            console.error(e);
        });
}(window, document));