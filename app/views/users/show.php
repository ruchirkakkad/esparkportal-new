<div ng-init="showData()">
<div class="hbox hbox-auto-xs hbox-auto-sm">
<div class="col">
<div style="background:url('img/c3.jpg') center center; background-size:cover">
    <div class="wrapper-lg bg-white-opacity">
        <div class="row m-t">
            <div class="col-sm-4">
                <a href class="thumb-lg pull-left m-r">
                    <img src="{{ data.user.profile_image }}" class="img-circle">
                </a>

                <div class="clear m-b">
                    <div class="m-b m-t-sm">
                        <span class="h3 text-black">
                            {{ data.user.first_name }}.{{ data.user.last_name }}
                        </span>
                        <small class="m-l">{{ data.user.gender }}</small>
                    </div>
                    <p>Company email : {{ data.user.email }}</p>

                    <p>Personal email : {{ data.user.personal_email }}</p>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <label class="col-sm-6 control-label">Date of Birth</label>

                    <div class="col-sm-6">
                        {{ data.user.user_personal.dob }}
                    </div>
                </div>
                <br>

                <div class="form-group">
                    <label class="col-sm-6 control-label">Blood Group</label>

                    <div class="col-sm-6">
                        {{ data.user.user_personal.blood_group }}
                    </div>
                </div>
                <br>

                <div class="form-group">
                    <label class="col-sm-6 control-label">Marital Status</label>

                    <div class="col-sm-6">
                        <a ng-if="MaritalStatusChangeVarView">Married</a>
                        <a ng-if="!MaritalStatusChangeVarView">Unmarried</a>
                    </div>
                </div>
                <br>

                <div class="form-group" ng-show="MaritalStatusChangeVarView">
                    <label class="col-sm-6 control-label">Spouse Name</label>

                    <div class="col-sm-6">
                        {{ data.user.user_personal.spouse_name }}
                    </div>
                </div>
                <br>

                <div class="form-group" ng-show="MaritalStatusChangeVarView">
                    <label class="col-sm-6 control-label">Anniversary date</label>

                    <div class="col-sm-6">
                        {{ data.user.user_personal.aniversary_date }}
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="col-sm-6 control-label">Driving License No.</label>

                    <div class="col-sm-6">
                        {{ data.user.user_personal.driving_licence_no }}
                    </div>
                </div>
                <br>

                <div class="form-group">
                    <label class="col-sm-6 control-label">Passport No.</label>

                    <div class="col-sm-6">
                        {{ data.user.user_personal.passport_no }}
                    </div>
                </div>
                <br>

                <div class="form-group">
                    <label class="col-sm-6 control-label">Bio</label>

                    <div class="col-sm-6">
                        {{ data.user.user_personal.bio }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="wrapper bg-white b-b">

</div>
<div class="padder">
<div class="wrapper-md">
<div class="row">
    <div class="col-lg-6">
        <!-- chat -->
        <div class="panel panel-default">
            <div class="panel-heading">Position in company</div>
            <div class="panel-body">
                <div class="list-group">
                    <a href class="list-group-item">
                        <div class="form-group">
                            <label class="col-sm-5 control-label">Date of joining</label>

                            <div class="col-sm-1">:</div>
                            <div class="col-sm-6">
                                {{ data.user.doj }}
                            </div>
                        </div>
                    </a>
                    <a href class="list-group-item">
                        <div class="form-group">
                            <label class="col-sm-5 control-label">Employee id</label>

                            <div class="col-sm-1">:</div>
                            <div class="col-sm-6">
                                {{ data.user.employee_id }}
                            </div>
                        </div>
                    </a>
                    <a href class="list-group-item">
                        <div class="form-group">
                            <label class="col-sm-5 control-label">Department</label>

                            <div class="col-sm-1">:</div>
                            <div class="col-sm-6">
                                {{ data.user.department.departments_name }}
                            </div>
                        </div>
                    </a>
                    <a href class="list-group-item">
                        <div class="form-group">
                            <label class="col-sm-5 control-label">Designation</label>

                            <div class="col-sm-1">:</div>
                            <div class="col-sm-6">
                                {{ data.user.designation.designations_name }}
                            </div>
                        </div>
                    </a>
                    <a href class="list-group-item">
                        <div class="form-group">
                            <label class="col-sm-5 control-label">Job Profile</label>

                            <div class="col-sm-1">:</div>
                            <div class="col-sm-6">
                                {{ data.user.job_profile.job_profiles_name }}
                            </div>
                        </div>
                    </a>
                    <a href class="list-group-item">
                        <div class="form-group">
                            <label class="col-sm-5 control-label">Role</label>

                            <div class="col-sm-1">:</div>
                            <div class="col-sm-6">
                                {{ data.user.role.name }}
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <!-- /chat -->
    </div>
    <div class="col-lg-6">
        <!-- chat -->
        <div class="panel panel-default">
            <div class="panel-heading">Bank Detail</div>
            <div class="panel-body">
                <div class="list-group">
                    <a href class="list-group-item">
                        <div class="form-group">
                            <label class="col-sm-5 control-label">Bank Name</label>

                            <div class="col-sm-1">:</div>
                            <div class="col-sm-6">
                                {{ data.user.user_bank_details.bank_name }}
                            </div>
                        </div>
                    </a>
                    <a href class="list-group-item">
                        <div class="form-group">
                            <label class="col-sm-5 control-label">Branch Name</label>

                            <div class="col-sm-1">:</div>
                            <div class="col-sm-6">
                                {{ data.user.user_bank_details.branch_name }}
                            </div>
                        </div>
                    </a>
                    <a href class="list-group-item">
                        <div class="form-group">
                            <label class="col-sm-5 control-label">Account number</label>

                            <div class="col-sm-1">:</div>
                            <div class="col-sm-6">
                                {{ data.user.user_bank_details.account_no }}
                            </div>
                        </div>
                    </a>
                    <a href class="list-group-item">
                        <div class="form-group">
                            <label class="col-sm-5 control-label">Account type</label>

                            <div class="col-sm-1">:</div>
                            <div class="col-sm-6">
                                {{ data.user.user_bank_details.account_type }}
                            </div>
                        </div>
                    </a>
                    <a href class="list-group-item">
                        <div class="form-group">
                            <label class="col-sm-5 control-label">IFSC No.</label>

                            <div class="col-sm-1">:</div>
                            <div class="col-sm-6">
                                {{ data.user.user_bank_details.ifsc_no }}
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <!-- /chat -->
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <!-- chat -->
        <div class="panel panel-default">
            <div class="panel-heading">Qualification</div>
            <div class="panel-body">
                <div class="list-group">
                    <div ng-repeat="qualification_detail  in data.user.users_qualification">
                        <a href class="list-group-item">
                            <div class="form-group">
                                <label class="col-sm-5 control-label">Education Detail</label>

                                <div class="col-sm-1">:</div>
                                <div class="col-sm-6">
                                    {{ data.educational_qualifications[qualification_detail.educational_qualifications_id] }}
                                </div>
                            </div>
                        </a>
                        <a href class="list-group-item">
                            <div class="form-group">
                                <label class="col-sm-5 control-label">Degree</label>

                                <div class="col-sm-1">:</div>
                                <div class="col-sm-6">
                                    {{ qualification_detail.degree }}
                                </div>
                            </div>
                        </a>
                        <a href class="list-group-item">
                            <div class="form-group">
                                <label class="col-sm-5 control-label">University</label>

                                <div class="col-sm-1">:</div>
                                <div class="col-sm-6">
                                    {{ qualification_detail.education_university }}
                                </div>
                            </div>
                        </a>
                        <a href class="list-group-item">
                            <div class="form-group">
                                <label class="col-sm-5 control-label">Passing year</label>

                                <div class="col-sm-1">:</div>
                                <div class="col-sm-6">
                                    {{ qualification_detail.passing_year }}
                                </div>
                            </div>
                        </a>
                        <a href class="list-group-item">
                            <div class="form-group">
                                <label class="col-sm-5 control-label">Grade</label>

                                <div class="col-sm-1">:</div>
                                <div class="col-sm-6">
                                    {{ qualification_detail.grade }}
                                </div>
                            </div>
                        </a>
                        <span ng-if="!$last"><hr></span>
                    </div>
                </div>
            </div>
        </div>
        <!-- /chat -->
    </div>
    <div class="col-lg-6">
        <!-- chat -->
        <div class="panel panel-default">
            <div class="panel-heading">Work Experience</div>
            <div class="panel-body">
                <div class="list-group">
                    <div ng-repeat="work_experience in data.user.user_work_experience">
                        <a href class="list-group-item">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Duration :</label>
                                <label class="col-sm-1 control-label">Start: </label>

                                <div class="col-sm-3">
                                    {{ work_experience.job_duration_start }}
                                </div>
                                <label class="col-sm-1 control-label">End: </label>

                                <div class="col-sm-3">
                                    {{ work_experience.job_duration_end }}
                                </div>
                            </div>
                        </a>
                        <a href class="list-group-item">
                            <div class="form-group">
                                <label class="col-sm-5 control-label">Company Name</label>

                                <div class="col-sm-1">:</div>
                                <div class="col-sm-6">
                                    {{ work_experience.company_name }}
                                </div>
                            </div>
                        </a>
                        <a href class="list-group-item">
                            <div class="form-group">
                                <label class="col-sm-5 control-label">Company Number</label>

                                <div class="col-sm-1">:</div>
                                <div class="col-sm-6">
                                    {{ work_experience.company_number }}
                                </div>
                            </div>
                        </a>
                        <a href class="list-group-item">
                            <div class="form-group">
                                <label class="col-sm-5 control-label">Company Address</label>

                                <div class="col-sm-1">:</div>
                                <div class="col-sm-6">
                                    {{ work_experience.company_address }}
                                </div>
                            </div>
                        </a>
                        <span ng-if="!$last"><hr></span>
                    </div>
                </div>
            </div>
        </div>
        <!-- /chat -->
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <!-- chat -->
        <div class="panel panel-default">
            <div class="panel-heading"> Current Contact</div>
            <div class="panel-body">
                <div class="list-group">
                    <a href class="list-group-item">
                        <div class="form-group">
                            <label class="col-sm-5 control-label">Current Address</label>

                            <div class="col-sm-1">:</div>
                            <div class="col-sm-6">
                                {{ data.user.user_contact.current_address }}
                            </div>
                        </div>
                    </a>
                    <a href class="list-group-item">
                        <div class="form-group">
                            <label class="col-sm-5 control-label">Current City</label>

                            <div class="col-sm-1">:</div>
                            <div class="col-sm-6">
                                {{ data.user.user_contact.current_city }}
                            </div>
                        </div>
                    </a>
                    <a href class="list-group-item">
                        <div class="form-group">
                            <label class="col-sm-5 control-label">Current State</label>

                            <div class="col-sm-1">:</div>
                            <div class="col-sm-6">
                                {{ data.user.user_contact.current_state }}
                            </div>
                        </div>
                    </a>
                    <a href class="list-group-item">
                        <div class="form-group">
                            <label class="col-sm-5 control-label">Current Zipcode</label>

                            <div class="col-sm-1">:</div>
                            <div class="col-sm-6">
                                {{ data.user.user_contact.current_zipcode }}
                            </div>
                        </div>
                    </a>
                    <a href class="list-group-item">
                        <div class="form-group">
                            <label class="col-sm-5 control-label">Personal Contact No.</label>

                            <div class="col-sm-1">:</div>
                            <div class="col-sm-6">
                                {{ data.user.user_contact.current_phone }}
                            </div>
                        </div>
                    </a>
                    <a href class="list-group-item">
                        <div class="form-group">
                            <label class="col-sm-5 control-label">Current SkypeID</label>

                            <div class="col-sm-1">:</div>
                            <div class="col-sm-6">
                                {{ data.user.user_contact.current_skype }}
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <!-- /chat -->
    </div>
    <div class="col-lg-6">
        <!-- chat -->
        <div class="panel panel-default">
            <div class="panel-heading">Permanent Contact</div>
            <div class="panel-body">
                <div class="list-group">
                    <a href class="list-group-item">
                        <div class="form-group">
                            <label class="col-sm-5 control-label">Permanent Address</label>

                            <div class="col-sm-1">:</div>
                            <div class="col-sm-6">
                                {{ data.user.user_contact.permanent_address }}
                            </div>
                        </div>
                    </a>
                    <a href class="list-group-item">
                        <div class="form-group">
                            <label class="col-sm-5 control-label">Permanent City</label>

                            <div class="col-sm-1">:</div>
                            <div class="col-sm-6">
                                {{ data.user.user_contact.permanent_city }}
                            </div>
                        </div>
                    </a>
                    <a href class="list-group-item">
                        <div class="form-group">
                            <label class="col-sm-5 control-label">Permanent State</label>

                            <div class="col-sm-1">:</div>
                            <div class="col-sm-6">
                                {{ data.user.user_contact.permanent_state }}
                            </div>
                        </div>
                    </a>
                    <a href class="list-group-item">
                        <div class="form-group">
                            <label class="col-sm-5 control-label">Permanent Zipcode</label>

                            <div class="col-sm-1">:</div>
                            <div class="col-sm-6">
                                {{ data.user.user_contact.permanent_zipcode }}
                            </div>
                        </div>
                    </a>
                    <a href class="list-group-item">
                        <div class="form-group">
                            <label class="col-sm-5 control-label">Permanent Contact No.</label>

                            <div class="col-sm-1">:</div>
                            <div class="col-sm-6">
                                {{ data.user.user_contact.permanent_phone }}
                            </div>
                        </div>
                    </a>
                    <a href class="list-group-item">
                        <div class="form-group">
                            <label class="col-sm-5 control-label">Permanent SkypeID</label>

                            <div class="col-sm-1">:</div>
                            <div class="col-sm-6">
                                {{ data.user.user_contact.permanent_skype }}
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <!-- /chat -->
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <!-- chat -->
        <div class="panel panel-default">
            <div class="panel-heading">Emergency Contact</div>
            <div class="panel-body">
                <div class="list-group">
                    <a href class="list-group-item">
                        <div class="form-group">
                            <label class="col-sm-5 control-label">Name</label>

                            <div class="col-sm-1">:</div>
                            <div class="col-sm-6">
                                {{ data.user.user_emergency.contact_name }}
                            </div>
                        </div>
                    </a>
                    <a href class="list-group-item">
                        <div class="form-group">
                            <label class="col-sm-5 control-label">Relation</label>

                            <div class="col-sm-1">:</div>
                            <div class="col-sm-6">
                                {{ data.user.user_emergency.contact_relation }}
                            </div>
                        </div>
                    </a>
                    <a href class="list-group-item">
                        <div class="form-group">
                            <label class="col-sm-5 control-label">Contact number</label>

                            <div class="col-sm-1">:</div>
                            <div class="col-sm-6">
                                {{ data.user.user_emergency.contact_phone }}
                            </div>
                        </div>
                    </a>
                    <a href class="list-group-item">
                        <div class="form-group">
                            <label class="col-sm-5 control-label">Address</label>

                            <div class="col-sm-1">:</div>
                            <div class="col-sm-6">
                                {{ data.user.user_emergency.contact_address }}
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <!-- /chat -->
    </div>
    <div class="col-lg-6">
        <!-- chat -->
        <div class="panel panel-default">
            <div class="panel-heading">Attachments</div>
            <div class="panel-body">
                <div class="list-group">
                    <div ng-repeat="attechment in data.user.user_attachments">
                        <a href class="list-group-item">
                            <div class="form-group">
                                <label class="col-sm-5 control-label">Attachment_{{ $index }}</label>

                                <div class="col-sm-1">:</div>
                                <div class="col-sm-6">
                                    <a href="<?php echo url();?>/user_profiles/download-attachment-view?attachement={{ attechment.attachment_url }}">{{ attechment.attachment_name }}</a>
                                </div>
                            </div>
                        </a>
                        <br>
                    </div>
                </div>
            </div>
        </div>
        <!-- /chat -->
    </div>
</div>
</div>
</div>
</div>
</div>
</div>