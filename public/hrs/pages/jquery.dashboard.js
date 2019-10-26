
/**
* Theme: Ubold Admin Template
* Author: Coderthemes
* Morris Chart
*/

!function($) {
    "use strict";

    var Dashboard1 = function() {
    	this.$realData = []
    };
    
    //creates Stacked chart
    Dashboard1.prototype.createStackedChart  = function(element, data, xkey, ykeys, labels, lineColors) {
        Morris.Bar({
            element: element,
            data: data,
            xkey: xkey,
            ykeys: ykeys,
            stacked: true,
            labels: labels,
            hideHover: 'auto',
            resize: true, //defaulted to true
            gridLineColor: '#eeeeee',
            barColors: lineColors
        });
    },

   
    
    
    Dashboard1.prototype.init = function() {

        //creating Stacked chart
        var $stckedData  = [
            { y: '2005', a: 45, b: 180, c: 100 },
            { y: '2006', a: 75,  b: 65, c: 80 },
            { y: '2007', a: 100, b: 90, c: 56 },
            { y: '2008', a: 75,  b: 65, c: 89 },
            { y: '2009', a: 100, b: 90, c: 120 },
            { y: '2010', a: 75,  b: 65, c: 110 },
            { y: '2011', a: 50,  b: 40, c: 85 },
            { y: '2012', a: 75,  b: 65, c: 52 },
            { y: '2013', a: 50,  b: 40, c: 77 },
            { y: '2014', a: 75,  b: 65, c: 90 },
            { y: '2015', a: 100, b: 90, c: 130 }
        ];
        this.createStackedChart('morris-bar-stacked', $stckedData, 'y', ['a', 'b', 'c'], ['Desktops', 'Tablets', 'Mobiles'], ['#5fbeaa', '#5d9cec', '#ebeff2']);

        

    },
    //init
    $.Dashboard1 = new Dashboard1, $.Dashboard1.Constructor = Dashboard1
}(window.jQuery),

//initializing 
function($) {
    "use strict";
    $.Dashboard1.init();
}(window.jQuery);