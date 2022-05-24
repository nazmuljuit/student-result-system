
<!-- Start Modal For Add Mark-->
<div>
	<div >

	<!-- Modal Content For Edit-->
	<div >
		<div >
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<div class="box-title">
			<h3 style="text-align: center;">
			
			Student Mark Form
			</h3>
			</div>
		</div>
		<div class="modal-body">
			<div class="box-content">
			<form id="form" action="" method="POST" class='form-horizontal' enctype="multipart/form-data">
        
			
				<table class="table">
					<thead class="thead-light">
					<tr>
					  <th>SL</th>
					  <th scope="col">Student Name</th>
					  <th scope="col" ng-repeat="subject in subjects">{{ subject.su_name}}</th>
					  
					</tr>
					</thead>
					<tbody>
				    <tr  ng-repeat="student in students track by $index">

				      <td>{{$index+1 }}</td>
				      <td >
				        
				   	   {{ student.st_name}} 
				        
				      </td>
				      <td ng-repeat="subject in subjects track by $index">
                        <input type="number" ng-model="student[subjectCount[0].totalSubject][($index)][subject.suid].mark" required="required">
				      	
				      	
				      </td>
				      
				      
				    </tr>
				    
				  </tbody>
				</table>		

			</div>
		</div>
		<div class="modal-footer">
			<input type="submit" id="submit" ng-click="addAllMark(students)" name="btn" class="btn btn-primary pull-left " value="Save Record" data-dismiss="modal"/> 
			</form>
			
		</div>
	</div>

	</div>
</div>
<!-- End Modal For Add Mark -->