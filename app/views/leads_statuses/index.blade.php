<div class="bg-light lter b-b wrapper-md">
  <h1 class="m-n font-thin h3" >Statuses</h1>
</div>



<div class="wrapper-md">
      <div flash-message="5000" ></div>
      <a href="#/app/leads_statuses/create">
      <button class="btn btn-sm btn-primary btn-addon pull-right m-xs">
      <i class="fa fa-plus"></i>Add
      </button>
      </a>

  <div class="panel panel-default">

    <div class="panel-heading">
      Statuses
    </div>
    <div class="table-responsive">
      <table ui-jq="dataTable" ui-options="{
          sAjaxSource: 'leads_statuses/indexdata-view',
          aoColumns: [
            { mData: 'leads_statuses_id' },
            { mData: 'leads_statuses_name' },
            { mData: 'edit' },
            { mData: 'delete' }
          ]
        }" class="table table-striped m-b-none">
        <thead>
          <tr>
            <th  style="width:15%">ID</th>
            <th  style="width:55%">Name</th>
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