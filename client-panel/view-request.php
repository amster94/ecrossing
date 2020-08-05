<?php
require_once "../includes/service/appvars.php";
require_once "../includes/service/class.ecrossingPDO.php";
if(isset($_GET['request_id']) && $_GET['request_id'] !=="") {
$request_id = $_GET['request_id'];
include_once "header.php";
if(!isset($_SESSION)) {
        session_start();
}
$email = $_SESSION['ecrossing_client_email'];
// CHECK WHETHER STATUS IS PENDING OR NOT
$condition_arr1="";
$condition_arr2="";
$condition_arr1 = array(":client_email",":unique_id");
$condition_arr2 = array($email,$request_id);
$CheckActiveUser = new EcrossingPDO();
$request_sql = "SELECT request_status FROM ecrossing_client_request WHERE client_email=:client_email AND request_unique_id=:unique_id";
$request_result=$CheckActiveUser->selectQuery($request_sql,$condition_arr1,$condition_arr2);
if(is_array($request_result) && sizeof($request_result) >= 0) {
  if($request_result[0]['request_status'] == "Pending") {
    $show_add_employee = 1;
  } else {
    $show_add_employee = 0;
  }
} else {
  $show_add_employee = 0;
}

} else {
  header('Location: '.SITE_BASE_URL.'login.php');
}

?>
        <div class="content">
            <div class="container-fluid">
                <?php if($show_add_employee == 1) { ?>
                <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12 mb10">
                <h4 style="font-size: 1.2em;">Add Employees for BGV Request :</h4>
                 <form action="">
                  <div class="form-group">
                    <label for="name">Employee Name:</label>
                    <input type="text" class="form-control" id="name" placeholder="Employee Name" value="">
                  </div>
                  <input type="button" onclick="addEmployeeToRequest();" class="btn btn-fill btn-success col-lg-offset-9 col-md-offset-9 col-sm-offset-9 col-xs-offset-6 col-lg-3 col-md-3 col-sm-3 col-xs-6" value="Add Employee" />
                </form> 
                </div>
                <?php } else { ?>
                <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12 mb10">
                  <button onclick="downloadExcelReport();" class="btn btn-danger col-lg-offset-9 col-md-offset-9 col-sm-offset-9 col-xs-offset-6 col-lg-3 col-md-3 col-sm-3 col-xs-6" /><i class="fa fa-file-excel-o" aria-hidden="true"></i> Download Excel</button>
                </div>
                <?php } ?>
                <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">List of Employees Created for BGV Request</h4>
                                <p class="category">Monthly performance</p>
                            </div>
                            <div class="content">
                                <table class="request-employee-table table table-striped table-bordered dt-responsive nowrap" style="width:100%;" >
                                  <thead>
                                    <tr>
                                      <th>Create Date</th>
                                      <th>Employee Name</th>
                                      <th>Employee Status</th>
                                      <th>Upload Data</th>
                                    </tr>
                                  </thead>
                                  <tbody id="request-employee-list">
                                  <tr>
                                  <td>26th June 2019</td>
                                  <td>Akash Mehta</td>
                                  <td><input type="button" class="btn btn-default col-lg-12 col-md-12 col-sm-12 col-xs-12" value="White"></td>
                                  <td><input type="button" onclick="window.location.href='<?php echo SITE_BASE_URL; ?>client-panel/upload-employee-data.php'" class="btn btn-primary col-lg-12 col-md-12 col-sm-12 col-xs-12" value="Upload Employee Data"></td>
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
                <?php if($show_add_employee == 1) { ?>
                <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12 mb5">
                  <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                    <!-- <h4>Finish BGV Request :</h4> -->
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                  <input type="button" onclick="finishBGVRequest();" class="btn btn-fill btn-danger col-lg-12 col-md-12 col-sm-12 col-xs-12" value="Finish Request" />
                  </div>
                </div>
                <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <p style="font-size: 1em;font-weight:700;"> Note : You cannot add new employees once you click on finish request button. We recommend you to add all the employees and upload correct files before finishing request and in case or query or errors contact the administrator respectively.</p>
                </div>
              <?php } ?>
            </div>
        </div>
<?php
include_once "footer.php";
?>
<script type="text/javascript">

// SET VIEWPORT

  $('.request-employee-table').DataTable({
    responsive: false,
    scrollX: true
  });
  $('#DataTables_Table_0_length').css({"display":"none"});
var request_id = "<?php echo $request_id; ?>";
getRequestEmployeeList(request_id);
function getRequestEmployeeList(request_id) {
  $.ajax({
                type:'POST',
                url:web_root_path+'includes/utility/handleClientRequest.php',
                dataType : "json",
                data:{
                  handle_get_request_employee_list : 1,
                  request_id : request_id
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
                        if ($.fn.DataTable.isDataTable("table.request-employee-table")) {
                          $('table.request-employee-table').DataTable().clear().destroy();
                        }
                        $('#request-employee-list').html(data.error);
                            var mytbl = $('table.request-employee-table').DataTable({
                            responsive: false,
                            scrollX: true
                            });
                            mytbl.ajax.reload;
                    } else {
                        if ($.fn.DataTable.isDataTable("table.request-employee-table")) {
                          $('table.request-employee-table').DataTable().clear().destroy();
                        }
                        $('#request-employee-list').html(data.success);
                            var mytbl = $('table.request-employee-table').DataTable({
                            responsive: false,
                            scrollX: true
                            });
                            mytbl.ajax.reload;
                    }
              }
  });
}

function addEmployeeToRequest() {
  var employee_name = $('#name').val();
  if(employee_name !== "") {
  $.ajax({
                type:'POST',
                url:web_root_path+'includes/utility/handleClientRequest.php',
                dataType : "json",
                data:{
                  handle_add_request_employee : 1,
                  request_id : request_id,
                  employee_name : employee_name
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
                        $("#Loader").modal("hide");
                        $("#custom_toast").addClass("show");
                        $("#custom_toast").html("<i class='fa fa-exclamation-circle red' aria-hidden='true'></i> "+ data.error);
                        setTimeout(function(){
                              $("#custom_toast").removeClass("show");
                        }, 4000);
                    } else {
                        $('#name').val("");
                        getRequestEmployeeList(request_id);
                    }
              }
  });
  } else {
    $("#Loader").modal("hide");
    $("#custom_toast").addClass("show");
    $("#custom_toast").html("<i class='fa fa-exclamation-circle red' aria-hidden='true'></i> Employee must have Name.");
    setTimeout(function(){
          $("#custom_toast").removeClass("show");
    }, 4000);
  }
}

function finishBGVRequest() {
  $.ajax({
                type:'POST',
                url:web_root_path+'includes/utility/handleClientRequest.php',
                dataType : "json",
                data:{
                  handle_finish_bgv_request : 1,
                  request_id : request_id
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
                        $("#Loader").modal("hide");
                        $("#custom_toast").addClass("show");
                        $("#custom_toast").html("<i class='fa fa-exclamation-circle red' aria-hidden='true'></i> "+ data.error);
                        setTimeout(function(){
                              $("#custom_toast").removeClass("show");
                        }, 4000);
                    } else {
                        alert("Request Finished. Reloading content...");
                        location.reload();
                    }
              }
  });
}

function downloadExcelReport() {
  $.ajax({
                type:'POST',
                url:web_root_path+'includes/utility/handleClientRequest.php',
                dataType : "json",
                data:{
                  handle_download_excel_report : 1,
                  request_id : request_id
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
                        $("#Loader").modal("hide");
                        $("#custom_toast").addClass("show");
                        $("#custom_toast").html("<i class='fa fa-exclamation-circle red' aria-hidden='true'></i> "+ data.error);
                        setTimeout(function(){
                              $("#custom_toast").removeClass("show");
                        }, 4000);
                    } else {
                        window.location = data.success;
                    }
              }
  });
}



</script>
