<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Create Schedule for @{{rooms[schedule.room_id]}} in @{{slots[schedule.slot_id].name}}</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="class_id">Class</label>
          <select id="class_id" name="class_id" class="form-control" ng-model="schedule.class_id" ng-options="key*1 as value for (key,value) in classes" ng-change="getSubjects()"></select>
        </div>

        <div class="form-group" ng-if="schedule.class_id">
          <label for="subject_id">Subject</label>
          <select id="subject_id" ng-init="getSubjects()" name="subject_id" class="form-control" ng-model="schedule.subject_id" ng-options="subject.id as subject.name for subject in class_subjects[schedule.class_id]" ng-change="setSelectedTeacher()"></select>
        </div>
        
        <div class="progress progress-thin" ng-show="schedule.subject_id" ng-if="schedule.class_id && schedule.subject_id">
          <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="@{{getCompletedPercent()}}" aria-valuemin="0" aria-valuemax="100" style="width: @{{getCompletedPercent()}}%"></div>
        </div>

        <div class="form-group" ng-show="schedule.subject_id">
          <label for="teacher_id">Teacher</label>
          <select id="teacher_id" name="teacher_id" class="form-control" ng-model="schedule.teacher_id" ng-options="key*1 as value for (key, value) in teachers"></select>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" ng-click="cancel()">Cancel</button>
        <button type="button" class="btn btn-primary" ng-click="addGroup()" ng-show="schedule.teacher_id && schedule.subject_id">
          <span ng-show="!schedule.id">Create</span>
          <span ng-show="schedule.id">Update</span>
        </button>
      </div>
    </div>
  </div>
</div>