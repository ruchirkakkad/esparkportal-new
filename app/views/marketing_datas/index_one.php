<div class="bg-light lter b-b wrapper-md">
    <h1 class="m-n font-thin h3">Select country</h1>
</div>
<div class="wrapper-md" ng-init="getcountriesview()">
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="row row-sm text-center">
                    <div class="col-xs-3" ng-repeat="country in data.countries">
                        <a href="/#/app/marketing_datas/index-two-view/{{ country.marketing_countries_id }} "
                           class="block panel padder-v bg-info item">
                            <span class="text-white font-thin h1 block">{{ country.marketing_countries_name }}</span>
                            <span class="text-muted h1 ">{{ country.data_count }}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>