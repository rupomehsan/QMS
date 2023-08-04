$("#menu-toggle").click(function(e) {
   e.preventDefault();
   $("#wrapper").toggleClass("toggled");
});
$("#menu-toggle-2").click(function(e) {
   e.preventDefault();
   $("#wrapper").toggleClass("toggled-2");
   $('#menu ul').hide();
});

function initMenu() {
   $('#menu ul').hide();
   $('#menu ul').children('.current').parent().show();
   //$('#menu ul:first').show();
   $('#menu li a').click(
      function() {
         var checkElement = $(this).next();
         if ((checkElement.is('ul')) && (checkElement.is(':visible'))) {
            return false;
         }
         if ((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
            $('#menu ul:visible').slideUp('normal');
            checkElement.slideDown('normal');
            return false;
         }
      }
   );
}
$(document).ready(function() {
   initMenu();
});
 $(document).ready(function(){
          $('.user-image ul li a span').click(function(){
               $('.user-info').toggle();
               // $('.mains-menu').slideToggle(1000)
          })
     })
 $(document).ready(function(){
          $('.user-image ul li a img').click(function(){
               $('.user-info').toggle();
               // $('.mains-menu').slideToggle(1000)
          })
     })





// plaguni javascript


window.onload = function () {

// Construct options first and then pass it as a parameter
var options1 = {
   animationEnabled: true,
   title: {
      text: "Sales"
   },
   data: [{
      // type: "column", //change it to line, area, bar, pie, etc
      // legendText: "Try Resizing with the handle to the bottom right",
      showInLegend: true,
      dataPoints: [
         { y: 10 },
         { y: 6 },
         { y: 14 },
         { y: 12 },
         { y: 19 },
         { y: 14 },
         { y: 26 },
         { y: 10 },
         { y: 22 }
         ]
      }]
};

$("#resizable").resizable({
   create: function (event, ui) {
      //Create chart.
      $("#chartContainer1").CanvasJSChart(options1);
   },
   resize: function (event, ui) {
      //Update chart size according to its container size.
      $("#chartContainer1").CanvasJSChart().render();
   }
});
   


   var dataPoints = [];

var options = {
   theme: "light2",
   title: {
      text: "Visitors Over Time"
   },
   data: [{
      type: "line",
      dataPoints: dataPoints
   }]
};
$("#chartContainer").CanvasJSChart(options);
updateData();

// Initial Values
var xValue = 0;
var yValue = 10;
var newDataCount = 6;

function addData(data) {
   if(newDataCount != 1) {
      $.each(data, function(key, value) {
         dataPoints.push({x: value[0], y: parseInt(value[1])});
         xValue++;
         yValue = parseInt(value[1]);
      });
   } else {
      //dataPoints.shift();
      dataPoints.push({x: data[0][0], y: parseInt(data[0][1])});
      xValue++;
      yValue = parseInt(data[0][1]);
   }
  
   newDataCount = 1;
  
   $("#chartContainer").CanvasJSChart().render()
   setTimeout(updateData, 1500); 
}

function updateData() {
   $.getJSON("https://canvasjs.com/services/data/datapoints.php?xstart="+xValue+"&ystart="+yValue+"&length="+newDataCount+"&type=json", addData);
}


}



