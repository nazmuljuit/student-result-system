
<h1>Tebulation Sheet</h1>

<hr>
<table class="table" ng-able="tableParams">
  <thead class="thead-light">
    <tr>
      <th scope="col">SL</th>
      <th  scope="col">Student Name</th>
      <th  scope="col" ng-repeat="subject in subjectList">{{ subject.su_name }}</th>
      
      <th scope="col">Result</th>
    </tr>
  </thead>
  <tbody>

    <tr ng-repeat="student in studentList" >
      <th scope="row">{{$index + 1}}</th>
      <td>{{student.st_name}}</td>
      <td ng-repeat="subject in subjectList">{{ marks[student.sid][subject.suid].mark }}</td>
      
      <td>{{ result[student.sid].grade }}({{ result[student.sid].gpa }})</td>
    </tr>
  </tbody>
</table>

