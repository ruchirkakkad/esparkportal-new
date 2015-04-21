<div class="bg-light lter b-b wrapper-md">
  <h1 class="m-n font-thin h3" >Marketing States</h1>
</div>

<div class="wrapper-md">
      <div flash-message="5000" ></div>
      <a href="#/app/marketing_states/create">
      <button class="btn btn-sm btn-primary btn-addon pull-right m-xs">
      <i class="fa fa-plus"></i>Add
      </button>
      </a>

  <div class="panel panel-default">

    <div class="panel-heading">
      Countries
    </div>
    <div class="table-responsive">
      <table ui-jq="dataTable" ui-options="{
          sAjaxSource: 'marketing_states/indexdata-view',
          aoColumns: [
            { mData: 'marketing_states_id' },
            { mData: 'marketing_states_name' },
            { mData: 'marketing_countries_name' },
            { mData: 'timezones_name' },
            { mData: 'edit' },
            { mData: 'delete' }
          ]
        }" class="table table-striped m-b-none">
        <thead>
          <tr>
            <th  style="width:10%">ID</th>
            <th  style="width:20%">Name</th>
            <th  style="width:20%">Country</th>
            <th  style="width:20%">Timezone</th>
            <th  style="width:15%">Edit</th>
            <th  style="width:15%">Delete</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
  </div>
</div>