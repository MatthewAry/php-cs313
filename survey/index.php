<!DOCTYPE html>
<html>
<head>
   <title>Matthew's Survey</title>
   <link rel="stylesheet" href="assets/stylesheets/screen.css" media="screen" charset="utf-8">
   <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no" />
   <link rel="stylesheet" href="node_modules/angular-material/angular-material.css">
   <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
</head>
<body ng-app="myApp" ng-cloak>
   <div ng-controller="SurveyController">
      <form>
         <md-toolbar class="md-primary">
            <div class="md-toolbar-tools">
               <h1 class="md-display-1">Matthew's Survey</h1>
            </div>
         </md-toolbar>
            <div layout="row" layout-padding>
               <md-content layout="column" flex>
                  <h2 class="md-title">Which animal is cooler?</h2>
                  <md-radio-group ng-model="aSelected" class="md-primary">
                     <div ng-repeat="(key, value) in animals">
                        <md-radio-button ng-value="key" aria-label="key">
                           {{key}}
                        </md-radio-button>
                     </div>
                  </md-radio-group>
               </md-content>
               <md-content layout="column" class="animal-image-content" flex>
                  <div class="flex-box" id="fixed">
                     <img ng-hide="!aSelected" ng-src="{{animals[aSelected]}}" style="max-width: 100%; width: auto; height: auto;" />
                  </div>
               </md-content>
            </div>
         <md-content>
            <h2 class="md-title">How do you like your pizza?</h2>
         </md-content>

         <div flex layout="row" layout-padding>
            <md-input-container>
               <label>Size</label>
               <md-select ng-model="formData.size">
                  <md-option ng-repeat="size in sizes" ng-value="size">{{size}}
                  </md-option>
               </md-select>
            </md-input-container>
         </div>
         <div layout="row" layout-padding>
            <div flex layout="column" ng-repeat="topping in toppings">
               <fieldset>
                  <legend>{{topping.category}}</legend>
                  <div flex layout-wrap>
                     <div flex="50" ng-repeat="option in topping.options">
                        <md-checkbox ng-model="tSelect">{{option.name}}</md-checkbox>
                     </div>
                  </div>
               </fieldset>
            </div>
         </div>
         <md-content>
            <h2 class="md-title">What programming languages do you know?</h2>
         </md-content>
         <div layout="row" layout-padding>
            <div flex="100" flex-gt-sm="50" layout="column">
               <div layout="row" layout-wrap flex>
                  <div flex="50" ng-repeat="option in languages">
                     <md-checkbox ng-model="lSelect" value={{}}>{{option.name}}</md-checkbox>
                  </div>
               </div>
            </div>
         </div>
         <md-button class="md-raised" ng-click="submit()"> Submit </md-button>
      </form>
   </div>
   <script src="node_modules/angular/angular.js"></script>
   <script src="node_modules/angular-aria/angular-aria.js"></script>
   <script src="node_modules/angular-animate/angular-animate.js"></script>
   <script src="node_modules/angular-material/angular-material.js"></script>
   <script src="bower_components/ngSticky/dist/sticky.min.js"></script>
   <script>

   // Include app dependency on ngMaterial
   var myApp = angular.module( 'myApp', [ 'ngMaterial'] );
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
         "small (12-inch)",
         "medium (14-inch)",
         "large (16-inch)",
         "insane (42-inch)"];
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
            { name: 'Bacon' }
         ]},
         { category: 'Vegetables', options: [
            { name: 'Mushrooms' },
            { name: 'Onion' },
            { name: 'Green Pepper' },
            { name: 'Green Olives' }
         ]},
         { category: 'Fruit', options: [
            { name: 'Pinapple' }
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
      $scope.toggleSelection = function toggleSelection(type, value) {
         $scope.formData[type]
      }
      $scope.submit = function() {
         $http({
            method   : 'POST',
            url      : 'process.php',
            data     : $.param($scope.formData),
            headers  : {'Content-Type': 'application/x-www-form-urlencoded' }
         })
         .success(function(data) {
            console.log(data);
         })

      };
   }
);



</script>

</body>
</html>
