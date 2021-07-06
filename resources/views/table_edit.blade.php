<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>            
    <script src="https://markcell.github.io/jquery-tabledit/assets/js/tabledit.min.js"></script>
  </head>
  <body>
    <div class="container">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">All Users</h3>
        </div>
        <div class="panel-body">
          <div class="table-responsive">
            @csrf
            <table id="orders-today-table" class="table table-bordered table-striped">
              <thead>
                <tr>
                    <th>
                        <button style="border: none; background: transparent; font-size: 14px;" id="MyTableCheckAllButton">
                        <i class="far fa-square"></i>  
                        </button>
                    </th>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Country</th>
                    <th>Date Joined</th>
                    <th>Balance</th>
                    <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($data as $row)
                <tr>
                 <td></td>
                  <td>{{ $row->id }}</td>
                  <td>{{ $row->fname }}</td>
                  <td>{{ $row->lname }}</td>
                  <td>{{ $row->country }}</td>
                  <td>{{ date('d/m/Y', strtotime($row->created_at)) }}</td>
                  <td class="">{{ $row->balance }}</td>
                  <td>{{$row->suspend_user}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>

<script type="text/javascript">
$(document).ready(function(){
   
  $.ajaxSetup({
    headers:{
      'X-CSRF-Token' : $("input[name=_token]").val()
    }
  });

  $('#orders-today-table').Tabledit({
    url:'{{ route("tabledit.suspend") }}',
    dataType:"json",
    columns:{
      identifier:[1, 'id'],
      editable:[ [7, 'suspend_user', '{"1":"suspended", "2":"unsuspend"}']]
    },
    restoreButton:false,
    onSuccess:function(data, textStatus, jqXHR)
    {
      if(data.action == 'delete')
      {
        $('#'+data.id).remove();
      }
    }
  });

});  
</script>