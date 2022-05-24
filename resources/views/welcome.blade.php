<!doctype html>
<html lang="{{ app()->getLocale() }}" ng-app="myApp" >
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

         <!-- Bootstrap Core CSS -->
         <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    </head>
    <body>

        
        <ul class="nav nav-tabs">
        <li><a href="#home" ng-click="marktList()">Home</a></li>
        <li><a href="#subject" ng-click="subjectList()">Subject</a></li>
        <li><a href="#student" ng-click="studentList()">Student</a></li>
        <li><a href="#inputmarks" ng-click="marksInput()">Marks Input</a></li>
        </ul>

        <div ng-view>
            

        </div>

         

        <!-- jQuery library -->
        <script src="{{ url('/javascript') }}"></script>
        <script src="{{asset('js/jquery.min.js')}}"></script>
        
        <script src="{{asset('js/bootstrap.min.js')}}"></script>

         <!-- Angular Library -->
        <script src="{{asset('js/angular.min.js')}}"></script>
        <script src="{{asset('js/angular-route.min.js')}}"></script>
        <script src="{{asset('js/angular-cookies.min.js')}}"></script>
        <script src="{{asset('js/myapp.js')}}"></script>
        
    </body>
</html>
