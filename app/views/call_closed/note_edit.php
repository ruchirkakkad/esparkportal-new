<div class="hbox hbox-auto-xs hbox-auto-sm" ng-init="getNoteData()">

    <!-- .col -->
    <div class="col">
        <div class="wrapper">
            <ul class="timeline">
                <li class="tl-header">
                    <div class="btn btn-info">Now</div>
                </li>
                <li class="tl-item tl-left">
                    <div class="tl-wrap b-primary">
                        <div class="tl-content panel padder b-a block">
                            <span class="arrow left pull-up hidden-left"></span>
                            <span class="arrow right pull-up visible-left"></span>

                            <div class="text-lt m-b-sm">Add Note</div>
                            <div class="panel-body pull-in b-t b-light">
                                <div class="panel panel-default m-t-md m-b-n-sm pos-rlt">
                                    <form>
                                        <div class="panel panel-default modal-body">
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Date</label>

                                                    <div class="col-sm-9" ng-controller="DatepickerDemoCtrl"
                                                         ng-init="data.userApproveData.users.doj = ''">
                                                        <div class="input-group w-md">
                                                            <input type="text" class="form-control"
                                                                   datepicker-popup="yyyy-MM-dd"
                                                                   ng-model="data.new_note_date" is-open="opened"
                                                                   datepicker-options="dateOptions" close-text="Close"/>
                                                            <span class="input-group-btn">
                                                                <button type="button" class="btn btn-default"
                                                                        ng-click="open($event)"><i
                                                                        class="glyphicon glyphicon-calendar"></i>
                                                                </button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group" ng-controller="TimepickerDemoCtrl">
                                                    <label class="col-sm-3 control-label">Time</label>

                                                    <div class="col-sm-9">
                                                        <timepicker ng-model="data.new_note_time" ng-change="changed()"
                                                                    hour-step="hstep"
                                                                    minute-step="mstep"
                                                                    show-meridian="ismeridian"></timepicker>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <textarea class="form-control no-border" rows="2"
                                                  placeholder="Your message..." ng-model="data.new_message"></textarea>

                                        <div class="panel-footer bg-light lter nav nav-sm">
                                            <button class="btn btn-info pull-right btn-sm" ng-click="addNote()">Comment</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="tl-item" ng-repeat="note in data.notes">
                    <div class="tl-wrap b-info">
                        <span class="tl-date">{{ note.created_at | date:'dd-MM-yyyy h:mm:ss a' }}</span>

                        <div class="tl-content panel padder b-a block bg-light lt">
                            <span class="arrow arrow-light left pull-up hidden-left b-light"></span>
                            <span class="arrow arrow-light right pull-up visible-left b-light"></span>

                            <div class="text-lt m-b-sm"><a href="">{{ note.note_date }}</a>
                                <span class="text m-b-sm pull-right">{{ note.note_time }}</span></div>

                            <div class="panel-body pull-in b-t b-light">
                                <div>{{ note.message }}</div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <!-- /.col -->
    <!-- .col -->
    <div class="col w-lg bg-light dk b-r bg-auto" id="aside">
        <div class="wrapper bg b-b">
            <h3 class="m-n font-thin">Details</h3>
        </div>
        <div class="wrapper">
            <form>
                <div class="form-group">
                    <label>Owner Name</label>
                    <input type="text" value="{{ data.marketing_data.owner_name }}" class="input-sm form-control" disabled>
                </div>
                <div class="form-group">
                    <label>Company Name</label>
                    <input type="text"  value="{{ data.marketing_data.company_name }}" class="input-sm form-control" disabled>
                </div>
                <div class="form-group">
                    <label>Website</label>
                    <input type="text"  value="{{ data.marketing_data.website }}" class="input-sm form-control" disabled>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text"  value="{{ data.marketing_data.email }}" class="input-sm form-control" disabled>
                </div>
                <div class="form-group">
                    <label>Phone</label>
                    <input type="text"  value="{{ data.marketing_data.phone }}" class="input-sm form-control" disabled>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <input type="text"  value="{{ data.marketing_data.leads_statuses_name }}" class="input-sm form-control" disabled>
                </div>

            </form>
        </div>
    </div>
    <!-- /.col -->
</div>