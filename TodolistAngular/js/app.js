/**
 * Created by miharizoravonison on 23/02/2017.
 */
"use-strict";
var app = angular.module('todo',[]);

app.directive('ngBlur', function()
{
    return function(scope, elem, attrs)
    {
        elem.bind('blur', function()
        {
            scope.$apply(attrs.ngBlur);
        });
    }
});

app.controller('TodoCtrl', function($scope,filterFilter, $http, $location)
{
    /*
    *VERSION avec Ajax
    * voir todos.php
    ********************/

    $scope.todos = [];
    $scope.placeholder = "Chargement...";
    $scope.statusFilter = {};


    $http.get('todos.php').success(function(data){
        $scope.todos = data;
        $scope.placeholder = 'Ajouter une nouvelle tâches';
    });

   /*
    * VERSION sans Ajax
    * $scope.todos = [
        {
            name: 'Tâche incomplète',
            completed: false
        },
        {
            name: 'Tâche complète',
            completed: true
        }
    ];
    ********************/

    $scope.$watch('todos',function ()
    {
        $scope.remaining = filterFilter($scope.todos, {completed: false}).length;
        $scope.allchecked = !$scope.remaining;
    }, true);

    if ($location.path() == '')
    {
        $location.path('/')
    }
    $scope.location = $location;
    $scope.$watch('location.path()', function(path)
    {
        $scope.statusFilter =
            (path == '/active') ? {completed : false} :
                (path == '/done') ? {completed : true}:
                    null;
    });

    $scope.removeTodo = function(index)
    {
        $scope.todos.splice(index,1);
    };

    $scope.addTodo = function()
    {
        $scope.todos.push(
            {
                name: $scope.newtodo,
                completed: false
            });
        $scope.newtodo = '';
    };

    $scope.editTodo = function(todo)
    {
        todo.editing = false;
    };

    $scope.checkAllTodo = function(allchecked)
    {
        $scope.todos.forEach(function(todo)
        {
            todo.completed = allchecked;
        });
    };
});