<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Create Schedule for @{{rooms[currentRoomId]}} in @{{currentSlot}}</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="class">Class</label>
          <select id="class" name="class" class="form-control" ng-model="schedule.class_id" ng-options="key as value for (key,value) in classes" ng-change="getSubjects()"></select>
        </div>

        <div class="form-group" ng-show="schedule.class_id">
          <label for="subject">Subject</label>
          <select id="subject" name="subject" class="form-control" ng-model="schedule.subject_id" ng-options="subject.id as subject.name for subject in classSubjects" ng-change="setSelectedTeacher()"></select>
        </div>
        
        <div class="progress progress-thin" ng-show="schedule.subject_id">
          <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%"></div>
        </div>

        <div class="form-group" ng-show="schedule.subject_id">
          <label for="teacher">Teacher</label>
          <select id="teacher" name="teacher" class="form-control" ng-model="schedule.teacher_id" ng-options="key as value for (key, value) in teachers"></select>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" ng-click="cancel()">Cancel</button>
        <button type="button" class="btn btn-primary" ng-click="addGroup()" ng-show="schedule.teacher_id">Create</button>
      </div>
    </div>
  </div>
</div>