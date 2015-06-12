<div class="bg-light lter b-b wrapper-md">
    <h1 class="m-n font-thin h3">Add Candidate</h1>
</div>
<div class="wrapper-md" ng-init="resetData()">
    <div flash-message="5000"></div>
    <div>
        <div class="row">
            <div class="col-sm-8">
                <form name="formValidate" class="form-horizontal form-validation" novalidate>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <strong>Add Candidate</strong>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">First Name</label>

                                <div class="col-sm-9">
                                    <input type="text" name="recruit_candidates_fname" class="form-control"
                                           placeholder="First Name" ng-model="data.recruit_candidates_fname"
                                           required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Middle Name</label>

                                <div class="col-sm-9">
                                    <input type="text" name="recruit_candidates_mname" class="form-control"
                                           placeholder="Middle Name" ng-model="data.recruit_candidates_mname"
                                        >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Last Name</label>

                                <div class="col-sm-9">
                                    <input type="text" name="recruit_candidates_lname" class="form-control"
                                           placeholder="Last Name" ng-model="data.recruit_candidates_lname"
                                           required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Address</label>

                                <div class="col-sm-9">
                                    <textarea name="recruit_candidates_address" class="form-control"
                                              placeholder="Address" ng-model="data.recruit_candidates_address"
                                              required=""></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Email Id</label>

                                <div class="col-sm-9">
                                    <input type="email" name="recruit_candidates_email" class="form-control"
                                           placeholder="Email" ng-model="data.recruit_candidates_email"
                                           required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Contact No</label>

                                <div class="col-sm-9">
                                    <input type="text" name="recruit_candidates_contact_no" class="form-control"
                                           placeholder="Contact No" ng-model="data.recruit_candidates_contact_no"
                                           required="">
                                </div>
                            </div>
                            <div class="line line-dashed b-b line-lg pull-in"></div>
                            <div ng-repeat="qualification_detail  in data.users_qualification">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Education Detail</label>

                                    <div class="col-sm-9">
                                        <select type="text" class="form-control"
                                                ng-model="qualification_detail.educational_qualifications_id"
                                                ng-options="selectedItem.educational_qualifications_id as selectedItem.educational_qualifications_name for selectedItem in data.educational_qualifications"
                                                required>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Degree</label>

                                    <div class="col-sm-9">
                                        <input class="form-control" ng-model="qualification_detail.degree">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">University</label>

                                    <div class="col-sm-9">
                                        <input class="form-control"
                                               ng-model="qualification_detail.education_university">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Passing year</label>

                                    <div class="col-sm-9">
                                        <input class="form-control" ng-model="qualification_detail.passing_year">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Grade</label>

                                    <div class="col-sm-9">
                                        <input class="form-control" ng-model="qualification_detail.grade">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-3 control-label">
                                        <button type="button" class="btn btn-danger" ng-click="removeQualificationDetails($index)">Remove</button>
                                    </div>
                                </div>
                                <hr>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-3 control-label">
                                    <button type="button" class="btn btn-info" ng-click="addQualificationDetails()">Add</button>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Apply For</label>

                                <div class="col-sm-9">
                                    <select ng-model="data.recruit_candidates_apply_for"
                                            name="recruit_candidates_apply_for"
                                            class="form-control"
                                            ng-options="selectedItem.designations_id as selectedItem.designations_name for selectedItem in data.designations"
                                        >
                                        <option value="">Select</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Skills</label>

                                <div class="col-sm-9">
                                    <select ui-jq="chosen" multiple class="w-md" data-placeholder="Select skills"
                                            ng-model="data.recruit_candidates_skills"
                                            data-ng-options="row1.skills_id as row1.skills_name for row1 in data.skills">
                                        <option value="">Select Course</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Category</label>

                                <div class="col-sm-9">
                                    <select ng-model="data.recruit_candidates_category" name="marketing_countries_id"
                                            class="form-control"
                                            ng-options="selectedItem.id as selectedItem.value for selectedItem in [{id:'Fresher',value:'Fresher'},{id:'Experienced',value:'Experienced'}]"
                                        >
                                        <option value="">Select</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Resume</label>

                                <div class="col-sm-9">
                                    <button ngf-select ng-model="files" class="attachment_submit"
                                            ngf-multiple="true">Attach Any File
                                    </button>
                            <span class="progress" ng-show="picFile[0].progress >= 0">
                                <div style="width:{{picFile[0].progress}}%" ng-bind="picFile[0].progress + '%'"></div>
                            </span>
                                    <span ng-show="picFile[0].result">Upload Successful</span>
                                    <ul style="clear:both" ng-show="rejFiles.length > 0" class="response">
                                        <li class="sel-file" ng-repeat="f in rejFiles">
                                            Rejected file: {{f.name}} - size: {{f.size}}B - type: {{f.type}}
                                        </li>
                                    </ul>
                                    <ul style="clear:both" ng-show="files.length > 0" class="response">
                                        <li class="sel-file" ng-repeat="f in files">

                                            {{f.name}} - size: {{f.size}}B - type: {{f.type}}

                                        </li>
                                    </ul>
                                </div>
                            </div>



                            <footer class="panel-footer text-right bg-light lter">
                                <button
                                    ng-disabled="formValidate.timezones_id.$invalid ||
                                    formValidate.timezones_id.$invalid ||
                                    formValidate.marketing_states_name.$invalid"
                                    type="submit" class="btn btn-success" ng-click="create(files)">Submit
                                </button>
                            </footer>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>