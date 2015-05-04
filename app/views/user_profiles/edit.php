<div class="bg-light lter b-b wrapper-md">
    <h1 class="m-n font-thin h3">Edit Profile</h1>
</div>
<div class="wrapper-md">
<accordion close-others="true">
<accordion-group heading="Personal Details">
    <form name="formValidate" class="form-horizontal form-validation" novalidate>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-3 control-label">First Name</label>

                    <div class="col-sm-9">
                        <input class="form-control" ng-model="data.user.first_name">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Middle Name</label>

                    <div class="col-sm-9">
                        <input class="form-control" ng-model="data.user.middle_name">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Last Name</label>

                    <div class="col-sm-9">
                        <input class="form-control" ng-model="data.user.last_name">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Personal Email</label>

                    <div class="col-sm-9">
                        <input type="email" class="form-control" ng-model="data.user.personal_email"
                               required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">Company Email</label>

                    <div class="col-sm-9">
                        <input type="email" class="form-control"
                               ng-model="data.users.email" required readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Password</label>

                    <div class="col-sm-9">
                        <input type="password" class="form-control"
                               ng-model="data.users.password" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">Gender</label>

                    <div class="col-sm-9">
                        <div class="radio">
                            <label class="i-checks">
                                <input type="radio" name="gender" value="male"
                                       ng-model="data.users.gender">
                                <i></i>
                                Male
                            </label>
                            <label class="i-checks">
                                <input type="radio" name="gender" value="female"
                                       ng-model="data.users.gender">
                                <i></i>
                                Female
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Profile Pic</label>

                    <div class="col-sm-9">
                        <div class="col-sm-6">
                            <input ui-jq="filestyle" type="file" data-icon="false"
                                   data-classButton="btn btn-default"
                                   data-classInput="form-control inline v-middle input-s">
                        </div>
                        <div class="col-sm-6"></div>
                    </div>
                </div>
            </div>
            <footer class="panel-footer text-right bg-light lter">
                <button type="submit" class="btn btn-success" ng-click="savePersonalDetails()">Submit
                </button>
            </footer>
        </div>
    </form>
</accordion-group>
<accordion-group heading="General Details">
    <form name="formValidate" class="form-horizontal form-validation" novalidate>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-3 control-label">Date of Birth</label>

                    <div class="col-sm-9" ng-controller="DatepickerDemoCtrl" ng-init="data.users.dob = ''">
                        <div class="input-group w-md">
                            <input type="text" class="form-control" datepicker-popup="yyyy-MM-dd"
                                   ng-model="data.users.dob" is-open="opened" datepicker-options="dateOptions"
                                   ng-required="true" close-text="Close"/>
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-default" ng-click="open($event)"><i
                                                        class="glyphicon glyphicon-calendar"></i></button>
                                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Blood Group</label>

                    <div class="col-sm-9">
                        <input class="form-control" ng-model="data.user.blood_group">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Marital Status</label>

                    <div class="col-sm-9">
                        <select type="text" class="form-control" placeholder="required field"
                                ng-model="data.user.marital_status"
                                ng-options="selectedItem.key as selectedItem.value for selectedItem in [{key:0,value:'Unmarried'},{key:1,value:'Married'}]"
                                required>

                        </select>
                    </div>
                </div>
                <div class="form-group" ng-show="data.user.marital_status">
                    <label class="col-sm-3 control-label">Spouse Name</label>

                    <div class="col-sm-9">
                        <input type="email" class="form-control" ng-model="data.user.spouse_name" required>
                    </div>
                </div>
                <div class="form-group" ng-show="data.user.marital_status">
                    <label class="col-sm-3 control-label">Anniversary date</label>

                    <div class="col-sm-9" ng-controller="DatepickerDemoCtrl" ng-init="data.users.aniversary_date = ''">
                        <div class="input-group w-md">
                            <input type="text" class="form-control" datepicker-popup="yyyy-MM-dd"
                                   ng-model="data.users.aniversary_date" is-open="opened"
                                   datepicker-options="dateOptions" ng-required="true" close-text="Close"/>
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-default" ng-click="open($event)"><i
                                                        class="glyphicon glyphicon-calendar"></i></button>
                                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Driving License No.</label>

                    <div class="col-sm-9">
                        <input type="password" class="form-control"
                               ng-model="data.users.driving_licence_no" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Passport number</label>

                    <div class="col-sm-9">
                        <input type="password" class="form-control"
                               ng-model="data.users.passport_no" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Skills</label>

                    <div class="col-sm-9">
                        <input ui-jq="tagsinput" ui-options="" class="form-control w-lg" ng-model="data.users.skills"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Languages</label>

                    <div class="col-sm-9">
                        <input ui-jq="tagsinput" ui-options="" class="form-control w-md"
                               ng-model="data.users.languages"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Bio</label>

                    <div class="col-sm-9">
                        <textarea rows="2" class="form-control" ng-model="data.users.bio"></textarea>
                    </div>
                </div>
            </div>
            <footer class="panel-footer text-right bg-light lter">
                <button type="submit" class="btn btn-success" ng-click="saveGeneralDetails()">Submit
                </button>
            </footer>
        </div>
    </form>
</accordion-group>
<accordion-group heading="Contact Details">
    <form name="formValidate" class="form-horizontal form-validation" novalidate>
        <div class="panel panel-default">
            <div class="panel-body col-sm-6">
                <div class="form-group">
                    <label class="col-sm-3 control-label">Current Address</label>

                    <div class="col-sm-9">
                        <textarea rows="2" class="form-control" ng-model="data.users.current_address"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Current City</label>

                    <div class="col-sm-9">
                        <input class="form-control" ng-model="data.user.current_city">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Current State</label>

                    <div class="col-sm-9">
                        <input class="form-control" ng-model="data.user.current_state">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Current Zipcode</label>

                    <div class="col-sm-9">
                        <input class="form-control" ng-model="data.user.current_zipcode">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Personal Contact No.</label>

                    <div class="col-sm-9">
                        <input class="form-control" ng-model="data.user.current_phone">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Current SkypeID</label>

                    <div class="col-sm-9">
                        <input class="form-control" ng-model="data.user.current_skype">
                    </div>
                </div>
            </div>
            <div class="panel-body col-sm-6">
                <div class="form-group">
                    <label class="col-sm-3 control-label">Permanent Address</label>

                    <div class="col-sm-9">
                        <textarea rows="2" class="form-control" ng-model="data.users.permanent_address"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Permanent City</label>

                    <div class="col-sm-9">
                        <input class="form-control" ng-model="data.user.permanent_city">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Permanent State</label>

                    <div class="col-sm-9">
                        <input class="form-control" ng-model="data.user.permanent_state">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Permanent Zipcode</label>

                    <div class="col-sm-9">
                        <input class="form-control" ng-model="data.user.permanent_zipcode">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Permanent Contact No.</label>

                    <div class="col-sm-9">
                        <input class="form-control" ng-model="data.user.permanent_phone">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Permanent SkypeID</label>

                    <div class="col-sm-9">
                        <input class="form-control" ng-model="data.user.permanent_skype">
                    </div>
                </div>
            </div>
            <footer class="panel-footer text-right bg-light lter">
                <button type="submit" class="btn btn-success" ng-click="saveContactDetails()">Submit
                </button>
            </footer>
        </div>
    </form>
</accordion-group>
<accordion-group heading="Emergency Details">
    <form name="formValidate" class="form-horizontal form-validation" novalidate>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-3 control-label">Name</label>

                    <div class="col-sm-9">
                        <input class="form-control" ng-model="data.user.contact_name">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Relation</label>

                    <div class="col-sm-9">
                        <input class="form-control" ng-model="data.user.contact_relation">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Contact number</label>

                    <div class="col-sm-9">
                        <input class="form-control" ng-model="data.user.contact_phone">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Address</label>

                    <div class="col-sm-9">
                        <textarea rows="2" class="form-control" ng-model="data.users.contact_address"></textarea>
                    </div>
                </div>
                <footer class="panel-footer text-right bg-light lter">
                    <button type="submit" class="btn btn-success" ng-click="saveEmergencyDetails()">Submit
                    </button>
                </footer>
            </div>

        </div>
    </form>
</accordion-group>
<accordion-group heading="Company Details">
    <form name="formValidate" class="form-horizontal form-validation" novalidate>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-3 control-label">Date of joining</label>

                    <div class="col-sm-9">
                        {{ data.user.doj }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Employee id</label>

                    <div class="col-sm-9">
                        {{ data.user.employee_id }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Department</label>

                    <div class="col-sm-9">
                        {{ data.user.department_id }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Designation</label>

                    <div class="col-sm-9">
                        {{ data.user.designation_id }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Job Profile</label>

                    <div class="col-sm-9">
                        {{ data.user.job_profile }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Role</label>

                    <div class="col-sm-9">
                        {{ data.user.role_id }}
                    </div>
                </div>
            </div>

        </div>
    </form>
</accordion-group>
<accordion-group heading="Work Experience">
    <form name="formValidate" class="form-horizontal form-validation" novalidate>
        <div class="panel panel-default">
            <div class="panel-body">
                <div ng-repeat="work_experience in data.user.work_experiences">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Duration</label>

                        <div class="col-sm-9">
                            <input class="form-control" ng-model="work_experience.job_duration">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Company Name</label>

                        <div class="col-sm-9">
                            <input class="form-control" ng-model="work_experience.company_name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Company Number</label>

                        <div class="col-sm-9">
                            <input class="form-control" ng-model="work_experience.company_number">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Company Address</label>

                        <div class="col-sm-9">
                            <input class="form-control" ng-model="work_experience.company_address">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-3 control-label">
                        <button type="button" class="btn btn-info" ng-click="addWorkExperience()">Add More</button>
                    </div>
                </div>
                <footer class="panel-footer text-right bg-light lter">
                    <button type="submit" class="btn btn-success" ng-click="saveBankDetails()">Submit
                    </button>
                </footer>
            </div>
        </div>
    </form>
</accordion-group>
<accordion-group heading="Bank Details">
    <form name="formValidate" class="form-horizontal form-validation" novalidate>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-3 control-label">Bank Name</label>

                    <div class="col-sm-9">
                        <input class="form-control" ng-model="data.user.bank_name">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Branch Name</label>

                    <div class="col-sm-9">
                        <input class="form-control" ng-model="data.user.branch_name">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Account number</label>

                    <div class="col-sm-9">
                        <input class="form-control" ng-model="data.user.account_no">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Account type</label>

                    <div class="col-sm-9">
                        <input class="form-control" ng-model="data.user.account_type">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">IFSC No.</label>

                    <div class="col-sm-9">
                        <input class="form-control" ng-model="data.user.ifsc_no">
                    </div>
                </div>
                <footer class="panel-footer text-right bg-light lter">
                    <button type="submit" class="btn btn-success" ng-click="saveBankDetails()">Submit
                    </button>
                </footer>
            </div>
        </div>
    </form>
</accordion-group>
<accordion-group heading="Attachment">
    <form name="formValidate" class="form-horizontal form-validation" novalidate>
        <div class="panel panel-default">
            <div class="panel-body">
                <div ng-repeat="attechment in data.user.attechments">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Attachment</label>

                        <div class="col-sm-4">
                            <select type="text" class="form-control" placeholder="required field"
                                    ng-model="attechment.attachment_name"
                                    ng-options="selectedItem.key as selectedItem.value for selectedItem in [
                                    {key:1,value:'Pancard'},
                                    {key:2,value:'Licence'},
                                    {key:3,value:'Aadharcard'},
                                    {key:4,value:'Passport'},
                                    {key:5,value:'Votercard'}
                                    ]"
                                    required></select>
                        </div>
                        <div class="col-sm-5">
                            <input ui-jq="filestyle" type="file" data-icon="false" ng-model="attachment.attachment_url"
                                   data-classButton="btn btn-default"
                                   data-classInput="form-control inline v-middle input-s">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-3 control-label">
                        <button type="button" class="btn btn-info" ng-click="addAttechments()">Add More</button>
                    </div>
                </div>
                <footer class="panel-footer text-right bg-light lter">
                    <button type="submit" class="btn btn-success" ng-click="saveAttechments()">Submit
                    </button>
                </footer>
            </div>
        </div>
    </form>
</accordion-group>
</accordion>
</div>
