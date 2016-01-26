<!DOCTYPE html>
<html lang="en">
<head>
	<title>Survey Report</title><!-- Angular Material style sheet -->
	<link rel="stylesheet" href=
	"http://ajax.googleapis.com/ajax/libs/angular_material/1.0.0/angular-material.min.css">
	<link rel="stylesheet" href="assets/stylesheets/screen.css" media=
	"screen" charset="utf-8">
	<meta name="viewport" content=
	"initial-scale=1, maximum-scale=1, user-scalable=no">
	<script src=
	"//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js">
	</script>
</head>
<body ng-app="report" ng-cloak>
	<div ng-controller="reportController">
      <md-toolbar class="md-primary">
         <div class="md-toolbar-tools">
            <h1 class="md-display-1">Survey Report: There has been {{submissions}} submission(s).</h1>
         </div>
      </md-toolbar>
		<div layout="row" layout-padding>
         <md-card style="margin-left: auto; margin-right: auto;">
            <md-card-title>
               <md-card-title-text>
                  <span class="md-headline">Votes For The Coolest Animal</span>
               </md-card-title-text>
            </md-card-title>
            <div id="animals"></div>
         </md-card>
      </div>
      <div layout="row" layout-padding>
         <md-card style="margin-left: auto; margin-right: auto;">
            <md-card-title>
               <md-card-title-text>
                  <span class="md-headline">Votes for Favorite Pizza Size</span>
               </md-card-title-text>
            </md-card-title>
            <div id="pizzaSize"></div>
         </md-card>
      </div>
      <div layout="row" layout-padding>
         <md-card style="margin-left: auto; margin-right: auto;">
            <md-card-title>
               <md-card-title-text>
                  <span class="md-headline">Votes for Pizza Toppings</span>
               </md-card-title-text>
            </md-card-title>
            <div id="pizzaTopping"></div>

         </md-card>
      </div>
      <div layout="row" layout-padding>
         <md-card style="margin-left: auto; margin-right: auto;">
            <md-card-title>
               <md-card-title-text>
                  <span class="md-headline">Votes for Programming Languages</span>
               </md-card-title-text>
            </md-card-title>
            <div id="programmingLanguages"></div>

         </md-card>
      </div>
      <!--
    Your HTML content here
  -->
	</div><!-- Angular Material requires Angular.js Libraries -->
	<script src=
	"http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js">
	</script>
	<script src=
	"http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-animate.min.js">
	</script>
	<script src=
	"http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-aria.min.js">
	</script>
	<script src=
	"http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-messages.min.js">
	</script> <!-- Angular Material Library -->

	<script src=
	"http://ajax.googleapis.com/ajax/libs/angular_material/1.0.0/angular-material.min.js">
	</script> <!--Load the AJAX API-->

	<script type="text/javascript" src="https://www.google.com/jsapi">
	</script>
	<script type="text/javascript">
      /**
       * You must include the dependency on 'ngMaterial'
       */
      var myReport = angular.module('report', ['ngMaterial']);
      myReport.controller("reportController", function($scope) {

      });

      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

         // get the data from the JSON.
         var reportData = $.ajax({
            url: "reportGen.php",
            dataType: "json"
         }).done(function(reportData) {
            // Create the data table.


            console.log(reportData);

            // Animals
            var animalData = new google.visualization.DataTable();
            animalDataOptions = {
               width: 700,
               height: 400,
               bar: {groupWidth: "95%"}
            };
            animalData.addColumn('string', "Animal");
            animalData.addColumn('number', "Votes");
            $.each(reportData['animal'],function(index, el) {
               animalData.addRow([String(index), el]);
            });


            var pizzaSize = new google.visualization.DataTable();
            pizzaSizeOptions = {
               width: 700,
               height: 400,
               bar: {groupWidth: "95%"}
            };
            pizzaSize.addColumn('string', "Size");
            pizzaSize.addColumn('number', "Votes");
            $.each(reportData['pizza']['size'], function(index, el) {
               pizzaSize.addRow([String(index), el]);
            });
            // make this a Pie chart

            var pizzaTopping = new google.visualization.DataTable();
            pizzaToppingOptions = {
               width: 700,
               height: 400,
               bar: {groupWidth: "95%"}
            };
            pizzaTopping.addColumn('string', "Toppings");
            pizzaTopping.addColumn('number', "Votes");
            $.each(reportData['pizza']['toppings'],function(index, el) {
               pizzaTopping.addRow([String(index), el]);
            });
            // make this a bar chart

            var programmingLanguages = new google.visualization.DataTable();
            programmingLanguagesOptions = {
               width: 700,
               height: 400,
               bar: {groupWidth: "95%"}
            };
            programmingLanguages.addColumn('string', "Languages");
            programmingLanguages.addColumn('number', "Votes");
            $.each(reportData['languages'],function(index, el) {
               programmingLanguages.addRow([String(index), el]);
            });

            var appElement = document.querySelector('[ng-app=report]');
            var $scope = angular.element(appElement).scope();
            $scope.$apply(function() {
               $scope.submissions = reportData['submissions'] / 2;
            });


            // Instantiate and draw our chart, passing in some options.
            var chart = new google.visualization.PieChart(document.getElementById('animals'));
               chart.draw(animalData, animalDataOptions);
            var chart2 = new google.visualization.BarChart(document.getElementById('pizzaSize'));
               chart2.draw(pizzaSize, pizzaSizeOptions);
            var chart3 = new google.visualization.BarChart(document.getElementById('pizzaTopping'));
               chart3.draw(pizzaTopping, pizzaToppingOptions);
            var chart4 = new google.visualization.BarChart(document.getElementById('programmingLanguages'));
               chart4.draw(programmingLanguages, programmingLanguagesOptions);
         });
      };
	</script>
</body>
</html>
