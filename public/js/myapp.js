
var myApp = angular.module('myApp', ['ngRoute','ngCookies']);

myApp.config(function($routeProvider, $locationProvider) {

	$locationProvider.hashPrefix('');
   
    $routeProvider
    .when("/home", {
        templateUrl : APPURL.get("/template/home"),
        controller: 'homeCtrl',
    })
    .when("/subject", {
        templateUrl : APPURL.get("/subject"),
        controller: 'subCtrl',
    })
    .when("/student", {
        templateUrl : APPURL.get("/template/student"),
        controller: 'studCtrl',
    })
    .when("/inputmarks", {
        templateUrl : APPURL.get("/template/inputmarks"),
        controller: 'studCtrl',
    });
});

//---------------subject page controller start------------
myApp.controller('subCtrl', ['$scope', '$log', '$http',
    function($scope, $log, $http ){
        /*Add subject*/
        $scope.addSubject = function () {
            var list = {
                su_name: $scope.subject
            };

            

            $http({
                method: 'POST',
                url: APPURL.get("/add/subject"),
                data: list
            }).then(function (data) {
                $scope.subjects.push(data);
                console.log(data);
            }, function(){
                console.log('false');
            });

            
        }

        $scope.subDelete = function(id){
                

                $http({
                method: 'POST',
                url: APPURL.get("/delete/subject/"+id),
                data: id
                }).then(function (data) {
                  location.reload();
                  
                   
                }, function(){
                console.log('false');
                });
        }

        /*subject list*/
        $scope.subjects = [];
       

            $http({
                method: 'get',
                url: APPURL.get("/subject/list")
            }).then(function (response) {
                $scope.subjects = response.data;
               

                
            }, function(){
                console.log('false');
            });
        
       
    }]);

//------------student page controller start------------
myApp.controller('studCtrl', ['$scope', '$log', '$http',
    function($scope, $log, $http ){
        /*add student*/
        $scope.addStudent = function () {
            var list = {
                student: $scope.student,
                father: $scope.father,
                mother: $scope.mother
            };

            console.log(list);

            $http({
                method: 'POST',
                url: APPURL.get("/add/student"),
                data: list
            }).then(function (data) {
                
                console.log(data);
            }, function(){
                console.log('false');
            })
        }

       /*student list*/
        //$scope.students = [];
       

        $http({
                method: 'get',
                url: APPURL.get("/student/list")
            }).then(function (response) {
                angular.extend($scope, response.data);
               
                 console.log($scope);
                
            }, function(){
                console.log('false');
            });
            /*subject list*/
        $scope.subjects = [];
       

        $http({
                method: 'get',
                url: APPURL.get("/subject/list")
            }).then(function (response) {
                $scope.subjects = response.data;
               

                
            }, function(){
                console.log('false');
            });
       /*student id pass*/  
       $scope.stidPass =function(id)
       {
          //alert(id);
          $scope.student_id = id;
       }     
       /*add mark for individual students*/
       $scope.addMark =function(subjects)
       {
           var data = {
                student_id: $scope.student_id,
                subjects: subjects
            };
          console.log(data);
          
            $http({
                method: 'POST',
                url: APPURL.get("/add/mark"),
                data: data
            }).then(function (data) {
                location.reload();
                console.log(data);
            }, function(){
                console.log('false');
            });
       }
        /*add mark for all students*/
       $scope.addAllMark =function(students)
       {
           var data = {
                students: students
            };
          console.log(data);
          
            $http({
                method: 'POST',
                url: APPURL.get("/addAllStudentMark"),
                data: data
            }).then(function (data) {
                location.reload();
                console.log(data);
            }, function(){
                console.log('false');
            });
       }

          /*View Student Result*/
       $scope.viewStudentResult =function(student_id)
       {
           //alert(student_id);
           var data = {
                student_id: student_id
            };
          
            $http({
                method: 'post',
                url: APPURL.get("/viewResultById"),
                data: data
            }).then(function (response) {
                angular.extend($scope, response.data);
                console.log($scope);
            }, function(){
                console.log('false');
            });
       }      
  
    }]);

//------------home page controller start------------
myApp.controller('homeCtrl', ['$scope', '$log', '$http',
    function($scope, $log, $http ){
        
       /*Mark list*/
       //$scope.marks = [];


        $http({
                method: 'get',
                url: APPURL.get("/mark/list")
            }).then(function (response) {

                angular.extend($scope, response.data);
                 console.log($scope);
                
            }, function(){
                console.log('false');
            });
            
         
  
    }]);