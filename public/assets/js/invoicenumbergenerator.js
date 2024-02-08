

function generateInvoiceNumber() {
    var pattern = /[a-zA-Z0-9_\-\+\.]/;

    function getRandomByte() {
        if (window.crypto && window.crypto.getRandomValues) {
            var result = new Uint8Array(1);
            window.crypto.getRandomValues(result);
            return result[0];
        } else if (window.msCrypto && window.msCrypto.getRandomValues) {
            var result = new Uint8Array(1);
            window.msCrypto.getRandomValues(result);
            return result[0];
        } else {
            return Math.floor(Math.random() * 256);
        }
    }

    function generate(length) {
        return Array.apply(null, { 'length': length })
            .map(function () {
                var result;
                while (true) {
                    result = String.fromCharCode(getRandomByte());
                    if (pattern.test(result)) {
                        return result;
                    }
                }
            })
            .join('');
    }

    // Generate a unique two-digit random number
    var randomNumber = ('0' + Math.floor(Math.random() * 100)).slice(-2);

    // Extract the first character of each word in the store name and convert to uppercase
    var storeNameParts = '<?php echo $store->store_name; ?>'.split(' ');
    var storeShortCode = '';
    for (var i = 0; i < storeNameParts.length; i++) {
        storeShortCode += storeNameParts[i].charAt(0).toUpperCase();
    }

    // Generate the invoice number in the format "INV-{store_name}-{random number}"
    var generatedNumber = 'INV-' + storeShortCode + '-' + randomNumber;

    var inputElements = document.getElementsByClassName("invoice_number");
    for (var i = 0; i < inputElements.length; i++) {
        inputElements[i].value = generatedNumber;
    }
}