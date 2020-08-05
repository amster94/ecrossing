<?php
require_once "../includes/service/appvars.php";
require_once "../includes/service/class.ecrossingPDO.php";
if(isset($_GET['request_id']) && $_GET['request_id'] !=="") {
$request_id = $_GET['request_id'];
include_once "header.php";

} else {
  header('Location: '.SITE_BASE_URL.'login.php');
}

?>
        <div class="content">
            <div class="container-fluid">
                <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12 mb10">
                  <button onclick="downloadExcelReport();" class="btn btn-danger col-lg-offset-9 col-md-offset-9 col-sm-offset-9 col-xs-offset-6 col-lg-3 col-md-3 col-sm-3 col-xs-6" /><i class="fa fa-file-excel-o" aria-hidden="true"></i> Download Excel</button>
                </div>
                <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">List of Employees Report for BGV Request</h4>
                                <p class="category">Monthly performance</p>
                            </div>
                            <div class="content">
                                <table class="request-download-employee-table table table-striped table-bordered dt-responsive nowrap" style="width:100%;" >
                                  <thead>
                                    <tr>
                                      <th>Create Date</th>
                                      <th>Employee Name</th>
                                      <th>Employee Status</th>
                                      <th>Upload Data</th>
                                    </tr>
                                  </thead>
                                  <tbody id="request-download-employee-list">
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
            </div>
        </div>
<?php
include_once "footer.php";
?>
<script type="text/javascript">

// SET VIEWPORT

  $('.request-download-employee-table').DataTable({
    responsive: false,
    scrollX: true
  });
  $('#DataTables_Table_0_length').css({"display":"none"});
var request_id = "<?php echo $request_id; ?>";
getRequestDownloadEmployeeList(request_id);
function getRequestDownloadEmployeeList(request_id) {
  $.ajax({
                type:'POST',
                url:web_root_path+'includes/utility/handleClientRequest.php',
                dataType : "json",
                data:{
                  handle_get_request_download_employee_list : 1,
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
                        if ($.fn.DataTable.isDataTable("table.request-download-employee-table")) {
                          $('table.request-download-employee-table').DataTable().clear().destroy();
                        }
                        $('#request-download-employee-list').html(data.error);
                            var mytbl = $('table.request-download-employee-table').DataTable({
                            responsive: false,
                            scrollX: true
                            });
                            mytbl.ajax.reload;
                    } else {
                        if ($.fn.DataTable.isDataTable("table.request-download-employee-table")) {
                          $('table.request-download-employee-table').DataTable().clear().destroy();
                        }
                        $('#request-download-employee-list').html(data.success);
                            var mytbl = $('table.request-download-employee-table').DataTable({
                            responsive: false,
                            scrollX: true
                            });
                            mytbl.ajax.reload;
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
