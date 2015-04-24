<div class="bg-light lter b-b wrapper-md">
    <h1 class="m-n font-thin h3">Lead</h1>
</div>
<div class="wrapper-md" ng-init="getLeads()">
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="row row-sm text-center">
                    <div class="col-xs-3" ng-repeat="lead in data.leads">
                        <a href="/#/app/leads/index-two-view/{{ lead.leads_statuses_id }} "
                           class="block panel padder-v bg-info item">
                            <span class="text-muted h1 "><i class=" icon-user"></i></span>
                            <span class="text-white font-thin h2 block">{{ lead.leads_statuses_name }}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>