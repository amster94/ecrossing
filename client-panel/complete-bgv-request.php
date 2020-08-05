<?php
include_once "header.php";
?>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">All Requests Completed till Date</h4>
                                <p class="category">Yearly Record</p>
                            </div>
                            <div class="content">
                                <table class="complete-request-table table table-striped table-bordered dt-responsive nowrap" style="width:100%;">
                                  <thead>
                                    <tr>
                                      <th>Request Date</th>
                                      <th>BGV Request</th>
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
                </div>
            </div>
        </div>
<?php
include_once "footer.php";
?>
<script type="text/javascript">
  $('.complete-request-table').DataTable({
    responsive: false,
    scrollX: true
  });
  $('#DataTables_Table_0_length').css({"display":"none"});
getCompleteBGVRequest();
    function getCompleteBGVRequest() {
      $.ajax({
                type:'POST',
                url:web_root_path+'includes/utility/handleClientDashboard.php',
                dataType : "json",
                data:{
                  handle_get_all_completed_bgv_request : 1
                },
                error: function (xhr, ajaxOptions, thrownError) {
                  //alert(xhr.status);
                  console.log(xhr);
                  console.log(ajaxOptions);
                  console.log(thrownError);
                },
                beforeSend: function() {

                },
                success: function(data) {
                    if(data.error) {
                        if ($.fn.DataTable.isDataTable("table.request-employee-table")) {
                          $('table.complete-request-table').DataTable().clear().destroy();
                        }
                        $('#employee-report-list').html(data.error);
                            var mytbl = $('table.complete-request-table').DataTable({
                            responsive: false,
                            scrollX: true
                            });
                            mytbl.ajax.reload;
                    } else {
                        if ($.fn.DataTable.isDataTable("table.complete-request-table")) {
                          $('table.complete-request-table').DataTable().clear().destroy();
                        }
                        $('#employee-report-list').html(data.success);
                            var mytbl = $('table.complete-request-table').DataTable({
                            responsive: false,
                            scrollX: true
                            });
                            mytbl.ajax.reload;
                    }
              }
      });
    }
</script>
