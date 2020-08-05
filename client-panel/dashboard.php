<?php
include_once "header.php";
?>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <!-- <div class="col-xs-5">
                                        <div class="icon-big icon-warning text-center">
                                            <i class="ti-server"></i>
                                        </div>
                                    </div> -->
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="numbers">
                                            <p>BGV Request Pending</p>
                                            <span class="pending-request-count">0</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-reload"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <!-- <div class="col-xs-5">
                                        <div class="icon-big icon-success text-center">
                                            <i class="ti-wallet"></i>
                                        </div>
                                    </div> -->
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="numbers">
                                            <p>BGV Request Completed</p>
                                            <span class="complete-request-count">0</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-calendar"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">All BGV Request Pending till Date</h4>
                                <p class="category">Yearly Record</p>
                            </div>
                            <div class="content">
                                <table class="bgv-request-table table table-striped table-bordered dt-responsive nowrap" style="width:100%;" >
                                  <thead>
                                    <tr>
                                      <th>Create Date</th>
                                      <th>BGV Request</th>
                                      <th>View BGV Request</th>
                                      <th>BGV Request Status</th>
                                    </tr>
                                  </thead>
                                  <tbody id="bgv-request-list">
                                  <tr>
                                  <td>26th June 2019</td>
                                  <td>BGV1706190953</td>
                                  <td><input type="button" onclick="window.location.href='<?php echo SITE_BASE_URL; ?>client-panel/view-request.php'" class="btn btn-primary col-lg-12 col-md-12 col-sm-12 col-xs-12" value="View Request"></td>
                                  <td><button type="button" class="btn btn-default col-lg-12 col-md-12 col-sm-12 col-xs-12">In Progress</button></td>
                                  </tr>
                                  </tbody>
                                </table>
                                <div class="footer">
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Employees Reviewed By Request till Date</h4>
                                <p class="category">Yearly Record</p>
                            </div>
                            <div class="content">
                                <table class="employee-review-table table table-striped table-bordered dt-responsive nowrap" style="width:100%;">
                                  <thead>
                                    <tr>
                                     <th>Create Date</th>
                                     <th>BGV Request</th>
                                     <th>View Employees</th>
                                     <th>Employees Reviewed</th>
                                     <th>BGV Request Status</th>
                                    </tr>
                                  </thead>
                                  <tbody id="employee-review-list">
                                  <tr>
                                  <td>26th June 2019</td>
                                  <td>Akash Mehta</td>
                                  <td>BGV1519542321</td>
                                  <td>2</td>
                                  <td><button type="button" class="btn btn-default col-lg-12 col-md-12 col-sm-12 col-xs-12">White</button></td>
                                  </tr>
                                  </tbody>
                                </table>
                                <div class="footer">
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
include_once "footer.php";
?>
<script type="text/javascript">

// SET VIEWPORT
$('.bgv-request-table').DataTable({
responsive: false,
scrollX: true
});
$('.employee-review-table').DataTable({
responsive: false,
scrollX: true
});
$('#DataTables_Table_0_length').css({"display":"none"});
$('#DataTables_Table_1_length').css({"display":"none"});
getAllBGVRequest();
getAllEmployeeReviewed();
getBGVRequestStatus();
// GET ALL BGV REQUEST
function getAllBGVRequest() {
    $.ajax({
        type:'POST',
        url:web_root_path+'includes/utility/handleClientDashboard.php',
        dataType : "json",
        data:{
          handle_get_all_bgv_request : 1
        },
        error: function (xhr, ajaxOptions, thrownError) {
          //alert(xhr.status);
          console.log(xhr);
          console.log(ajaxOptions);
          console.log(thrownError);
        },
        beforeSend: function(){

        },
        success: function(data) {
            if(data.error) {
                if ($.fn.DataTable.isDataTable("table.bgv-request-table")) {
                  $('table.bgv-request-table').DataTable().clear().destroy();
                }
                $('#bgv-request-list').html(data.error);
                    var mytbl = $('table.bgv-request-table').DataTable({
                    responsive: false,
                    scrollX: true
                    });
                    mytbl.ajax.reload;
            } else {
                if ($.fn.DataTable.isDataTable("table.bgv-request-table")) {
                  $('table.bgv-request-table').DataTable().clear().destroy();
                }
                $('#bgv-request-list').html(data.success);
                    var mytbl = $('table.bgv-request-table').DataTable({
                    responsive: false,
                    scrollX: true
                    });
                    mytbl.ajax.reload;
            }
      }
    });
}

// GET ALL EMPLOYEE REVIEWED
function getAllEmployeeReviewed() {
    $.ajax({
        type:'POST',
        url:web_root_path+'includes/utility/handleClientDashboard.php',
        dataType : "json",
        data:{
          handle_get_all_employee_reviewed : 1
        },
        error: function (xhr, ajaxOptions, thrownError) {
          //alert(xhr.status);
          console.log(xhr);
          console.log(ajaxOptions);
          console.log(thrownError);
        },
        beforeSend: function(){

        },
        success: function(data) {
            if(data.error) {
                if ($.fn.DataTable.isDataTable("table.employee-review-table")) {
                  $('table.employee-review-table').DataTable().clear().destroy();
                }
                $('#employee-review-list').html(data.error);
                    var mytbl = $('table.employee-review-table').DataTable({
                    responsive: false,
                    scrollX: true
                    });
                    mytbl.ajax.reload;
            } else {
                if ($.fn.DataTable.isDataTable("table.employee-review-table")) {
                  $('table.employee-review-table').DataTable().clear().destroy();
                }
                $('#employee-review-list').html(data.success);
                    var mytbl = $('table.employee-review-table').DataTable({
                    responsive: false,
                    scrollX: true
                    });
                    mytbl.ajax.reload;
            }
      }
    });
}

function getBGVRequestStatus() {
    $.ajax({
        type:'POST',
        url:web_root_path+'includes/utility/handleClientDashboard.php',
        dataType : "json",
        data:{
          handle_get_all_bgv_request_status : 1
        },
        error: function (xhr, ajaxOptions, thrownError) {
          //alert(xhr.status);
          console.log(xhr);
          console.log(ajaxOptions);
          console.log(thrownError);
        },
        beforeSend: function(){

        },
        success: function(data) {
            if(data.error) {
                $('.pending-request-count').html("NaN");
                $('.complete-request-count').html("NaN");
            } else {
                $('.pending-request-count').html(data.pending);
                $('.complete-request-count').html(data.complete);
            }
      }
    });
}

</script>
