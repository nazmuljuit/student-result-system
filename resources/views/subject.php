

<h1>Subjects List</h1>
<button class="btn btn-danger" data-toggle="modal" data-target="#adSubjMod">Add Subject</button>
<hr>
<table class="table" ng-able="tableParams">
  <thead class="thead-light">
    <tr>
      <th scope="col">SL</th>
      <th scope="col">Subject Name</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

    <tr ng-repeat="subject in subjects track by $index" >
      <th scope="row">{{ $index+1 }}</th>
      <td>{{ subject.su_name}}</td>
      <td><button class="btn btn-primary">Edit</button>
      <button class="btn btn-danger" ng-click="subDelete(subject.suid)">Delete</button></td>
    </tr>
    
  </tbody>
</table>


<!-- Start Modal For Add Subject-->
<div id="adSubjMod" class="modal fade" role="dialog">
	<div class="modal-dialog">

	<!-- Modal Content For Edit-->
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<div class="box-title">
			<h3>
			<i class="fa fa-edit"></i>
			Add Subject
			</h3>

			</div>
		</div>
		<div class="modal-body">
			<div class="box-content">        
			<form id="form" action="" method="POST" class='form-horizontal'>

					<div class="form-group">
						<label for="textfield" class="control-label col-sm-2">Subject Name:</label>
						<div class="col-sm-10">
							<input type="text" ng-model="subject" id="subject" name="subject" class="form-control" required>
						</div>
					</div>



			
			</div>
		</div>
		<div class="modal-footer">
			<input type="submit" ng-click="addSubject()" id="submit" name="btn" class="btn btn-primary pull-left " value="Save Record" data-dismiss="modal"/> 
			</form>
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</div>

	</div>
</div>
<!-- End Modal For Add Subject Model-->

