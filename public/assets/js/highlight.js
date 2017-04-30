
var initPrism = function () {
    if (typeof Prism !== "undefined") {
        var elements = document.querySelectorAll('code[class*="language-"]');
        for (var i = 0, element; element = elements[i++];) {
            Prism.highlightElement(element, true);
        }
    } else {
        setTimeout('initPrism', 200);
    }
}

initPrism();


