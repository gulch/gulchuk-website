/* get Google Analytics 4 ID*/
var GoogleAnalyticsID = document.querySelector('script[data-gaid]')?.dataset?.gaid;

if (!GoogleAnalyticsID) return;

window.dataLayer = window.dataLayer || [];
function gtag() { dataLayer.push(arguments); }
gtag('js', new Date());
gtag('config', GoogleAnalyticsID);

(function (d, t, s, e) {
    e = d.createElement(t);
    e.defer = true;
    e.src = s;
    d.body.appendChild(e);
})(document, 'script', 'https://www.googletagmanager.com/gtag/js?id=' + GoogleAnalyticsID);