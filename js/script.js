function getSelectedSection(section){
};


$(document).ready(function() {
    $("#imprimir").click(function() {
        PrintElem($("#editor-content"));
    });
    $("#damehtml").click(function() {
        MuestraElem($("#editor-content"));
    });
    $("#bold").click(function() {
        document.execCommand('bold', false, null);
    });
    $("#italic").click(function() {
        document.execCommand('italic', false, null);
    });
    $("#underline").click(function() {
        document.execCommand('underline', false, null);
    });
    $("#decreasefont").click(function() {
        document.execCommand('decreaseFontSize', false, null);
    });
    $("#increasefont").click(function() {
        document.execCommand('increaseFontSize', false, null);
    });
    $("#indent").click(function() {
        document.execCommand('indent', false, null);
    });
    $("#outdent").click(function() {
        document.execCommand('outdent', false, null);
    });
    $("#txt").click(function() {
        var blob = new Blob([$("#editor").text()], {
            type: "text/plain;charset=utf-8"
        });
        saveAs(blob, "hello world.txt");
    });
    $("#word").click(function() {

        var htmlString = '<html xmlns="http://www.w3.org/TR/REC-html4..." xmlns:office="urn:schemas-microsoft-com:office:office" xmlns:word="urn:schemas-microsoft-com:office:word"><head><xml><word:worddocument><word:view>Print</word:view><word:zoom>90</word:zoom><word:donotoptimizeforbrowser/></word:worddocument></xml><meta charset="utf-8"><title>Enjoy generated text by Javatlacati</title></head><body>'+$("#editor").text()+'</body></html>';

        var byteNumbers = new Uint8Array(htmlString.length);

        for (var i = 0; i < htmlString.length; i++) {

            byteNumbers[i] = htmlString.charCodeAt(i);

        }
        var blob = new Blob([byteNumbers], {
            type: "text/html;charset=utf-8"
        });
        saveAs(blob, "hello world.doc");
    });

    function PrintElem(elem) {
        Popup($(elem).html());
    }

    function Popup(data) {
        var mywindow = window.open('', 'my div', 'height=400,width=600');
        mywindow.document.write('<html><head><title>my div</title>');
        /*optional stylesheet*/ //mywindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10

        mywindow.print();
        mywindow.close();

        return true;
    }

    function MuestraElem(elem) {
        PopMuestra($(elem).html());
    }

    function PopMuestra(data) {
        var mywindow = window.open();
        mywindow.document.write(data.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;"));

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10
        //mywindow.close();
        return true;
    }
});