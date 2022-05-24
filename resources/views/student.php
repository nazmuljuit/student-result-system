

<h1>Student List</h1>

<button class="btn btn-danger" data-toggle="modal" data-target="#adSubjMod">Add Student</button>

<hr>
<table class="table">
  <thead class="thead-light">
    <tr>
      <th scope="col">SL</th>
      <th scope="col">Student Name</th>
      <th scope="col">Father Name</th>
      <th scope="col">Mother Name</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

    <tr ng-repeat="student in students track by $index">
      <th scope="row">{{$index + 1}}</th>
      <td>{{student.st_name}}</td>
      <td>{{student.father}}</td>
      <td>{{student.mother}}</td>
      <td><button class="btn btn-primary">Edit Student Info</button>
      	<button class="btn btn-success" ng-if="student.is_mark==0"  data-toggle="modal" data-target="#adMarks" ng-click="stidPass(student.sid)">Add Mark</button>
      	<button class="btn btn-warning" data-toggle="modal" data-target="#viewResult" ng-if="student.is_mark==1" ng-click="viewStudentResult(student.sid)">View Result</button>

      </td>
      
    </tr>
    
  </tbody>
</table>


<!-- Start Modal For Add Student-->
<div id="adSubjMod" class="modal fade" role="dialog">
	<div class="modal-dialog">

	<!-- Modal Content For Edit-->
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<div class="box-title">
			<h3>
			<i class="fa fa-edit"></i>
			Add Student
			</h3>
			</div>
		</div>
		<div class="modal-body">
			<div class="box-content">
			<form id="form" action="" method="POST" class='form-horizontal' enctype="multipart/form-data">

				<div class="form-group">
				 <label for="textfield" class="control-label col-sm-2">Student Name:</label>
				 <div class="col-sm-10">
				 <input type="text" ng-model="student" name="student" class="form-control" required>
				 </div>
				</div>

				<div class="form-group">
				 <label for="textfield" class="control-label col-sm-2">Father Name:</label>
				 <div class="col-sm-10">
				 <input type="text" ng-model="father" name="father" class="form-control" required>
				 </div>
				</div>

				<div class="form-group">
				 <label for="textfield" class="control-label col-sm-2">Mother Name:</label>
				 <div class="col-sm-10">
				 <input type="text" ng-model="mother" name="mother" class="form-control" required>
				 </div>
				</div>		

			
			</div>
		</div>
		<div class="modal-footer">
			<input type="submit" id="submit" ng-click="addStudent()" name="btn" class="btn btn-primary pull-left qtype_submit" value="Save Record" data-dismiss="modal"/> 
			</form>
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</div>

	</div>
</div>
<!-- End Modal For Add Student Model-->


<!-- Start Modal For Add Mark-->
<div id="adMarks" class="modal fade" role="dialog">
	<div class="modal-dialog">

	<!-- Modal Content For Edit-->
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<div class="box-title">
			<h3>
			<i class="fa fa-edit"></i>
			Add Mark
			</h3>
			</div>
		</div>
		<div class="modal-body">
			<div class="box-content">
			<form id="form" action="" method="POST" class='form-horizontal' enctype="multipart/form-data">
        
			<input type="hidden" name="student_id" ng-model="student_id" value="{{student_id}}">
				<table class="table">
					<thead class="thead-light">
					<tr>
					  
					  <th scope="col">Subject Name</th>
					  <th scope="col">Mark</th>
					  
					</tr>
					</thead>
					<tbody>
				    <tr ng-repeat="subject in subjects track by $index" >
				      
				      <td >
				        
				   	    {{ subject.su_name}}
				        
				      </td>
				      <td>
				      	<input type="number" ng-model="subject.mark"  min="0" max="100">
                        
				      	
				      	
				      </td>
				      
				      
				    </tr>
				    
				  </tbody>
				</table>		

			</div>
		</div>
		<div class="modal-footer">
			<input type="submit" id="submit" ng-click="addMark(subjects)" name="btn" class="btn btn-primary pull-left " value="Save Record" data-dismiss="modal"/> 
			</form>
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</div>

	</div>
</div>
<!-- End Modal For Add Mark -->


<!-- Start Modal For View Result-->
<div id="viewResult" class="modal fade" role="dialog">
	<div class="modal-dialog">

	<!-- Modal Content For Edit-->
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<div class="box-title">
			<h3>
			Name of Student:{{studentName[0].st_name}}
			</h3>
			
			</div>
		</div>
		<div class="modal-body">
			<div class="box-content">
			<form id="form" action="" method="POST" class='form-horizontal' enctype="multipart/form-data">
        
			<input type="hidden" name="student_id" ng-model="student_id" value="{{student_id}}">
				<table class="table">
					<thead class="thead-light">
					<tr>
					  
					  <th scope="col">Subject Name</th>
					  <th scope="col">Mark</th>
					  <th scope="col">GPA</th>
					  
					</tr>
					</thead>
					<tbody>
				    <tr ng-repeat="subject in subjects" >
				      
				      <td >
				        
				   	    {{ subject.su_name}}
				        
				      </td>
				      <td>
				      	
                        
				      	{{ student_mark[subject.suid].mark }}
				      	
				      </td>

				      <td>
				      	
                        
				      	{{ student_mark[subject.suid].gpa }}
				      	
				      </td>
				      
				      
				    </tr>
				    
				  </tbody>
				</table>
				<hr>
				<h3>Result</h3>	
				<table class="table">
					<thead class="thead-light">
					<tr>
					  <th>Grade</th>
					  <td>{{student_result[0].grade}}</td>	
					  
					  
					  
					</tr>
					</thead>
					<tbody>
						<tr>
						  <th>GPA</th>
					      <td>{{student_result[0].gpa}}</td>
							
						</tr>
				    </tbody>
		        </table>	

			</div>
		</div>
		<div class="modal-footer">



		</div>
	</div>

	</div>
</div>
<!-- End Modal For View Result-->
