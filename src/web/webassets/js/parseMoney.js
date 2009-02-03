//<!--

var CENTS   = 100;
var DOLLARS = 1;

function parseMoney(value, units, returnAsString) {
    var dollars = 0;
    var cents   = 0;
    
    // convert the initial value to a number 
    if (value) value = parseFloat(value);
    if ( value == null || isNaN(value) == true ) return -1;
    
    // separate the dollars and cents parts of the initial value
    if (units == CENTS) {
        dollars = parseInt(value / 100);
        cents   = parseInt(value % 100);
    }
    else {
        dollars = parseInt(value);
        cents   = Math.ceil((value - dollars) * 100);
    }
    
    // recombine the two values and return in either a string or number form
    if (returnAsString) {
    
        // convert integer part of cents value to a 2 character string
        var centsString = cents.toString();
        if (centsString.length == 1) centsString = '0' + centsString;
    
        // prepend the dollar value and a decimal to cents string
        return (dollars + '.' + centsString);
    }
    else return (dollars + (cents ));
}

//-->