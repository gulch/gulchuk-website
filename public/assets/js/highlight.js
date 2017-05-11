
function initPrism () {
    if (typeof Prism !== "undefined") {
        var elements = document.querySelectorAll('pre[class*="language-"]');
        for (var i = 0, element; element = elements[i++];) {
            Prism.highlightElement(element, true);
        }
    } else {
        setTimeout('initPrism', 200);
    }
}

initPrism();


