<?php
include_once "header.php";
?>
        <div class="content">
            <div class="container-fluid">
                <!-- <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">All Employees Completed By Request till Date</h4>
                                <p class="category">Yearly Record</p>
                            </div>
                            <div class="content">
                                <table class="employee-report-table table table-striped table-bordered dt-responsive nowrap" style="width:100%;">
                                  <thead>
                                    <tr>
                                      <th>Employee Date</th>
                                      <th>Assigned BGV</th>
                                      <th>Request Details</th>
                                      <th>BGV Status</th>
                                    </tr>
                                  </thead>
                                  <tbody id="employee-report-list">
                                  </tbody>
                                </table>
                                <div class="footer">
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">All Employees Completed till Date</h4>
                                <p class="category">Yearly Record</p>
                            </div>
                            <div class="content">
                                <table class="employee-report-table table table-striped table-bordered dt-responsive nowrap" style="width:100%;">
                                  <thead>
                                    <tr>
                                      <th>Employee Date</th>
                                      <th>Employee Name</th>
                                      <th>Employee Status</th>
                                      <th>Download Report</th>
                                    </tr>
                                  </thead>
                                  <tbody id="employee-report-list">
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
  $('.employee-report-table').DataTable({
    responsive: false,
    scrollX: true
  });
  $('#DataTables_Table_0_length').css({"display":"none"});
// getEmployeeReport();
getCompletedEmployeeReport();
    function getEmployeeReport() {
      $.ajax({
                type:'POST',
                url:web_root_path+'includes/utility/handleClientDashboard.php',
                dataType : "json",
                data:{
                  handle_get_employee_report_by_request : 1
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
                          $('table.employee-report-table').DataTable().clear().destroy();
                        }
                        $('#employee-report-list').html(data.error);
                            var mytbl = $('table.employee-report-table').DataTable({
                            responsive: false,
                            scrollX: true
                            });
                            mytbl.ajax.reload;
                    } else {
                        if ($.fn.DataTable.isDataTable("table.employee-report-table")) {
                          $('table.employee-report-table').DataTable().clear().destroy();
                        }
                        $('#employee-report-list').html(data.success);
                            var mytbl = $('table.employee-report-table').DataTable({
                            responsive: false,
                            scrollX: true
                            });
                            mytbl.ajax.reload;
                    }
              }
      });
    }

    function getCompletedEmployeeReport() {
      $.ajax({
                type:'POST',
                url:web_root_path+'includes/utility/handleClientDashboard.php',
                dataType : "json",
                data:{
                  handle_get_completed_employee_report : 1
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
                          $('table.employee-report-table').DataTable().clear().destroy();
                        }
                        $('#employee-report-list').html(data.error);
                            var mytbl = $('table.employee-report-table').DataTable({
                            responsive: false,
                            scrollX: true
                            });
                            mytbl.ajax.reload;
                    } else {
                        if ($.fn.DataTable.isDataTable("table.employee-report-table")) {
                          $('table.employee-report-table').DataTable().clear().destroy();
                        }
                        $('#employee-report-list').html(data.success);
                            var mytbl = $('table.employee-report-table').DataTable({
                            responsive: false,
                            scrollX: true
                            });
                            mytbl.ajax.reload;
                    }
              }
      });
    }
</script>
