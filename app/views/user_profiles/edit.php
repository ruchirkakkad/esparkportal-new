<div ng-init="editData()">
    <div class="bg-light lter b-b wrapper-md">
        <h1 class="m-n font-thin h3">Edit Profile</h1>
    </div>
    <div class="wrapper-md">
        <accordion close-others="false">
            <accordion-group heading="Personal Details" is-open="var_profile_edit_personal_details">
                <div ng-include="profile_edit_personal_details"></div>
            </accordion-group>
            <accordion-group heading="General Details" is-open="var_profile_edit_general_details">
                <div ng-include="profile_edit_general_details"></div>
            </accordion-group>
            <accordion-group heading="Contact Details" is-open="var_profile_edit_contact_details">
                <div ng-include="profile_edit_contact_details"></div>
            </accordion-group>
            <accordion-group heading="Emergency Details" is-open="var_profile_edit_emergency_details">
                <div ng-include="profile_edit_emergency_details"></div>
            </accordion-group>
<!--            <accordion-group heading="Company Details" is-open="var_profile_edit_company_details">-->
<!--                <div ng-include="profile_edit_company_details"></div>-->
            </accordion-group>
            <accordion-group heading="Qualification Details" is-open="var_profile_edit_qualification_details">
                <div ng-include="profile_edit_qualification_details"></div>
            </accordion-group>
            <accordion-group heading="Work Experience" is-open="var_profile_edit_work_experience">
                <div ng-include="profile_edit_work_experience"></div>
            </accordion-group>
            <accordion-group heading="Bank Details" is-open="var_profile_edit_bank_details">
                <div ng-include="profile_edit_bank_details"></div>
            </accordion-group>
            <accordion-group heading="Attachment" is-open="var_profile_edit_attachments">
                <div ng-include="profile_edit_attachments"></div>
            </accordion-group>
        </accordion>
    </div>
</div>