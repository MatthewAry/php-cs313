<?php
session_start();

if(isset($_SESSION['voted']) && $_SESSION['voted'] == true) {
    header("Location: report.php");
    exit;
}

?>
<!DOCTYPE html>
<html>
<head>
   <title>Matthew's Survey</title>
   <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no" />
   <link rel="stylesheet" href=
	"http://ajax.googleapis.com/ajax/libs/angular_material/1.0.0/angular-material.min.css">
   <link rel="stylesheet" href="assets/stylesheets/screen.css" media="screen" charset="utf-8">
   <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
</head>
<body ng-app="myApp" ng-cloak>
   <div ng-controller="SurveyController">
      <form>
         <md-toolbar class="md-primary">
            <div class="md-toolbar-tools">
               <h1 class="md-display-1">Matthew's Survey</h1>
               <span flex></span>
               <md-button class="md-raised" aria-label="See Survey Results" href="report.php">
                  See Survey Results
               </md-button>
            </div>
         </md-toolbar>
         <md-toolbar class="md-accent md-hue-3">
            <span flex></span>
            <h2 class="md-toolbar-tools md-toolbar-tools-bottom">
               <span class="md-flex">Which animal is cooler?</span>
            </h2>
         </md-toolbar>
         <div layout="row" layout-padding>
            <md-card layout-padding>
               <md-radio-group ng-model="aSelected" class="md-primary">
                  <div ng-repeat="(key, value) in animals">
                     <md-radio-button ng-value="key" aria-label="key">
                        {{key}}
                     </md-radio-button>
                  </div>
               </md-radio-group>
            </md-card>
            <div layout="column" class="animal-image-content" flex>
               <div class="flex-box" id="fixed">
                  <img ng-hide="!aSelected" ng-src="{{animals[aSelected]}}" style="max-width: 100%; width: auto; height: auto;" />
               </div>
            </div>
         </div>
         <md-toolbar class="md-accent md-hue-3">
            <span flex></span>
            <h2 class="md-toolbar-tools md-toolbar-tools-bottom">
               <span class="md-flex">How do you like your pizza?</span>
            </h2>
         </md-toolbar>
         <div flex layout="row" layout-padding>
            <md-card layout-padding>
               <md-card-title>
                  <md-card-title-text>
                     <span class="md-headline">Pizza Size</span>
                  </md-card-title>
               </md-card-title-text>
               <md-input-container>
                  <label>Size</label>
                  <md-select ng-model="formData.pizza.size">
                     <md-option ng-repeat="size in sizes" ng-value="size">{{size}}
                     </md-option>
                  </md-select>
               </md-input-container>
            </md-card>
         </div>
         <div layout="row" layout-padding>
            <div layout="column" ng-repeat="topping in toppings">
               <md-card layout-padding>
                  <md-card-title>
                     <md-card-title-text>
                        <span class="md-headline">{{topping.category}}</span>
                     </md-card-title>
                  </md-card-title-text>
                  <div flex layout-wrap>
                     <div flex="50" ng-repeat="option in topping.options">
                        <md-checkbox checklist-model="formData.pizza.toppings" checklist-value="option.name">{{option.name}}</md-checkbox>
                     </div>
                  </div>
               </md-card>
            </div>
         </div>
         <md-toolbar class="md-accent md-hue-3">
            <span flex></span>
            <h2 class="md-toolbar-tools md-toolbar-tools-bottom">
               <span class="md-flex">What programming languages do you know?</span>
            </h2>
         </md-toolbar>
         <div layout="row" layout-padding>
            <md-card layout-padding>
            <div flex="100" flex-gt-sm="50" layout="column">
               <div layout="row" layout-wrap flex>
                  <div flex="50" ng-repeat="language in languages">
                     <md-checkbox checklist-model="formData.languages" checklist-value="language.name">{{language.name}}</md-checkbox>
                  </div>
               </div>
            </div>
         </md-card>
         </div>
         <md-button class="md-raised" ng-click="submit()"> Submit </md-button>
      </form>
   </div>
   <!-- Angular Material requires Angular.js Libraries -->
   <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
   <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-animate.min.js"></script>
   <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-aria.min.js"></script>
   <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-messages.min.js"></script>

   <!-- Angular Material Library -->
   <script src="http://ajax.googleapis.com/ajax/libs/angular_material/1.0.0/angular-material.min.js"></script>
   <script src="assets/scripts/checklist-model.js"></script>
   <script>

   // Include app dependency on ngMaterial
   var myApp = angular.module( 'myApp', [ 'ngMaterial', 'checklist-model'] );
   myApp.controller("SurveyController", function($scope, $http) {
      $scope.animals = {
         "Red-lipped Batfish": "assets/images/21-More-Weird-Animals-You-Never-Knew-Existed.jpg",
         "Goblin Shark": "assets/images/21-More-Weird-Animals-You-Never-Knew-Existed-1.jpg",
         "Panda Ant": "assets/images/21-More-Weird-Animals-You-Never-Knew-Existed-2.jpg",
         "Umbonia Spinosa": "assets/images/21-More-Weird-Animals-You-Never-Knew-Existed-5.jpg",
         "Lowland Streaked Tenrec": "assets/images/21-More-Weird-Animals-You-Never-Knew-Existed-6.jpg",
         "Hummingbird Hawk-Moth": "assets/images/21-More-Weird-Animals-You-Never-Knew-Existed-7.jpg",
         "Glaucus Atlanticus": "assets/images/21-More-Weird-Animals-You-Never-Knew-Existed-9.jpg",
         "Mantis Shrimp": "assets/images/21-More-Weird-Animals-You-Never-Knew-Existed-10.jpg",
         "Venezuelan Poodle Moth": "assets/images/21-More-Weird-Animals-You-Never-Knew-Existed-11.jpg",
         "The Pacu Fish": "assets/images/21-More-Weird-Animals-You-Never-Knew-Existed-12.jpg",
         "Giant Isopod": "assets/images/21-More-Weird-Animals-You-Never-Knew-Existed-13.jpg",
         "The Saiga Antelope": "assets/images/21-More-Weird-Animals-You-Never-Knew-Existed-14.jpg",
         "The Bush Viper": "assets/images/21-More-Weird-Animals-You-Never-Knew-Existed-15.jpg",
         "The Blue Parrotfish": "assets/images/21-More-Weird-Animals-You-Never-Knew-Existed-16.jpg",
         "Indian Purple Frog": "assets/images/21-More-Weird-Animals-You-Never-Knew-Existed-17.jpg",
         "Shoebill": "assets/images/21-More-Weird-Animals-You-Never-Knew-Existed-18.jpg",
         "Okapi": "assets/images/21-More-Weird-Animals-You-Never-Knew-Existed-19.jpg",
         "Narwhal": "assets/images/21-More-Weird-Animals-You-Never-Knew-Existed-20.jpg",
         "Thorny Dragon": "assets/images/21-More-Weird-Animals-You-Never-Knew-Existed-21.jpg",
         "Sea Pig": "assets/images/21-More-Weird-Animals-You-Never-Knew-Existed-22.jpg",
         "Pikachu": "assets/images/025Pikachu_OS_anime_5.png"};
      $scope.sizes = [
         "Small (12-inch)",
         "Medium (14-inch)",
         "Large (16-inch)",
         "Insane (42-inch)"];
      $scope.toppings = [
         { category: 'Cheese', options: [
            { name: 'Mozzarella' },
            { name: 'Provolone' },
            { name: 'Cheddar' },
            { name: 'Parmesan' },
            { name: 'Emmental' },
            { name: 'Romano' },
            { name: 'Ricotta' },
            { name: 'Gouda' }
         ]},
         { category: 'Meat', options: [
            { name: 'Pepperoni' },
            { name: 'Sausage' },
            { name: 'Ground Beef' },
            { name: 'Bacon' },
            { name: 'Chicken' },
            { name: 'Canadian Bacon' }
         ]},
         { category: 'Vegetables', options: [
            { name: 'Mushrooms' },
            { name: 'Onion' },
            { name: 'Green Pepper' },
            { name: 'Green Olives' }
         ]},
         { category: 'Fruit', options: [
            { name: 'Pineapple' }
         ]}
      ];
      $scope.languages = [
         { name: "Python" },
         { name: "Ruby" },
         { name: "Java" },
         { name: "JavaScript" },
         { name: "PHP" },
         { name: "Lua" },
         { name: "C++" },
         { name: "C" },
         { name: "C#" },
         { name: "Lisp" },
         { name: "Perl" },
         { name: "Haskell" },
         { name: "GO" },
         { name: "Erlang" },
         { name: "Objective C" },
         { name: "Small Talk" },
         { name: "Scala" },
         { name: "Visual Basic" },
         { name: "Cobol" },
         { name: "Clojure" },
         { name: "Assembly" }
      ];
      $scope.formData = {};
      $scope.$watch('aSelected', function(v) {
         $scope.formData.animal = v;
      })
      $scope.submit = function() {
         $http({
            method   : 'POST',
            url      : 'process.php',
            data     : $.param($scope.formData),
            headers  : {'Content-Type': 'application/x-www-form-urlencoded' }
         })
         .success(function(data) {
            window.location.href = "report.php";
         })
      };
   }
);
</script>

</body>
</html>
