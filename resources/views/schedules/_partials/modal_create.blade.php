<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Create Schedule</h4>
      </div>
      <div class="modal-body">
        <time>Tue, December 1, 13:00 - 14:00</time>
        <div class="form-group">
          <label for="class">Class</label>
          <select id="class" name="class" class="form-control" ng-model="group.id" ng-change="getSubjects()">
            <option value="">Please select</option>
            <option value="1">T0907L</option>
            <option value="2">C0907M</option>
          </select>
        </div>

        <div class="form-group" ng-show="group.id">
          <label for="subject">Subject</label>
          <select id="subject" name="subject" class="form-control" ng-model="group.subject" ng-options="subject.id as subject.name for subject in subjects" ng-change="setSelectedTeacher()"></select>
        </div>

        <div class="form-group" ng-show="group.subject">
          <label for="teacher">Teacher</label>
          <select id="teacher" name="teacher" class="form-control" ng-model="group.teacher" ng-options="key as value for (key, value) in teachers"></select>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Create</button>
      </div>
    </div>
  </div>
</div>