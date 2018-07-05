
var App = angular.module('myApp', [
  'ngRoute'
]).
config(['$locationProvider', function($locationProvider) {

  $locationProvider.hashPrefix('');

}]).
config(['$routeProvider', function($routeProvider) {
   $routeProvider.

   when('/AddModel', {
      templateUrl: 'views/ajouterModele.html'
   }).

   when('/AddCategory', {
      templateUrl: 'views/ajouterCategorie.html'
   }).

   when('/AddFonction', {
      templateUrl: 'views/ajouterFonction.html'
   }).

   when('/AddChamp', {
      templateUrl: 'views/ajouterChamp.html'
   }).

   when('/newModele', {
      templateUrl: 'views/newModele.html'
   }).

   otherwise({
      redirectTo: '/newModele'
   })
}])
