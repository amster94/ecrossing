<?php
require_once "../includes/service/appvars.php";
require_once "../includes/service/class.ecrossingPDO.php";
if(isset($_GET['request_id']) && $_GET['request_id'] !=="") {
$request_id = $_GET['request_id'];
include_once "header.php";
} else {
  header('Location: '.SITE_BASE_URL.'admin-login.php');
}

?>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                <h4>Update BGV Request Status:</h4>
                 <form action="">
                  <div class="form-group">
                    <label class="radio-inline"><input type="radio" name="statusradio" value="In Progress" checked>In Progress</label>
                    <label class="radio-inline"><input type="radio" name="statusradio" value="Reviewing" checked>Reviewing</label>
                    <label class="radio-inline"><input type="radio" name="statusradio" value="Complete" >Completed</label>
                  </div>
                  <input type="button" onclick="updateRequestStatus();" class="btn btn-primary col-lg-offset-8 col-md-offset-8 col-sm-offset-8 col-lg-3 col-md-3 col-sm-3 col-xs-12" value="Update Status" />
                </form> 
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">List of Employees for BGV Request</h4>
                                <p class="category">Monthly performance</p>
                            </div>
                            <div class="content">
                                <table class="employee-review-table table table-striped table-bordered dt-responsive nowrap" >
                                  <thead>
                                    <tr>
                                      <th>Create Date</th>
                                      <th>Employee Name</th>
                                      <th>Employee Status</th>
                                      <th>Update Employee Data</th>
                                    </tr>
                                  </thead>
                                  <tbody id="employee-review-list">
                                  <tr>
                                  <td>26th June 2019</td>
                                  <td>Akash Mehta</td>
                                  <td><button type="button" class="btn btn-default col-lg-12 col-md-12 col-sm-12 col-xs-12">White</button></td>
                                  <td><input type="button" onclick="window.location.href='<?php echo SITE_BASE_URL; ?>admin-panel/update-employee-status.php'" class="btn btn-primary col-lg-12 col-md-12 col-sm-12 col-xs-12" value="Update Employee Report"></td>
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
if(window.innerWidth > 1000) {
    $('.employee-review-table').DataTable({
    responsive: true
    });
} else {
    $('.employee-review-table').DataTable({
    responsive: false,
    scrollX: true
    });
    $('#DataTables_Table_0_length').css({"display":"none"});
}


var request_id = "<?php echo $request_id; ?>";
getRequestEmployee();
    function updateRequestStatus() {
      var status = $("input[name=statusradio]:checked").val();
        $.ajax({
                type:'POST',
                url:web_root_path+'includes/utility/handleAdminRequest.php',
                dataType : "json",
                data:{
                  handle_update_request_status : 1,
                  request_id : request_id,
                  status : status
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
                        $("#Loader").modal("hide");
                        $("#custom_toast").addClass("show");
                        $("#custom_toast").html("<i class='fa fa-check-circle green' aria-hidden='true'></i> "+ data.success);
                        setTimeout(function(){
                              $("#custom_toast").removeClass("show");
                        }, 4000);
                    }
              }
        });
    }

    function getRequestEmployee() {
      $.ajax({
            type:'POST',
            url:web_root_path+'includes/utility/handleAdminRequest.php',
            dataType : "json",
            data:{
              handle_get_all_request_employee : 1,
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
                    if ($.fn.DataTable.isDataTable("table.employee-review-table")) {
                      $('table.employee-review-table').DataTable().clear().destroy();
                    }
                    $('#employee-review-list').html(data.error);
                    if(window.innerWidth > 1000) {
                        var mytbl = $('table.employee-review-table').DataTable({
                        responsive: true
                        });
                        mytbl.ajax.reload;
                    } else {
                        var mytbl = $('table.employee-review-table').DataTable({
                        responsive: false,
                        scrollX: true
                        });
                        mytbl.ajax.reload;
                    }
                } else {
                    if ($.fn.DataTable.isDataTable("table.employee-review-table")) {
                      $('table.employee-review-table').DataTable().clear().destroy();
                    }
                    $('#employee-review-list').html(data.success);
                    if(window.innerWidth > 1000) {
                        var mytbl = $('table.employee-review-table').DataTable({
                        responsive: true
                        });
                        mytbl.ajax.reload;
                    } else {
                        var mytbl = $('table.employee-review-table').DataTable({
                        responsive: false,
                        scrollX: true
                        });
                        mytbl.ajax.reload;
                    }
                }
          }
        });
    }

    function getStats() {
        $.ajax({
                type:'POST',
                url:web_root_path+'utility/handleDashboard.php',
                dataType : "json",
                data:{
                  handle_get_affiliate_monthly_stats : 1,
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
                        // $('.month-coupon').val();
                        // $('.month-revenue').val();
                        // $('.month-profit').val();
                        // $('.custom-order').val();
                    }
              }
        });
    }
    function getCouponData() {
        $.ajax({
                type:'POST',
                url:web_root_path+'utility/handleDashboard.php',
                dataType : "json",
                data:{
                  handle_get_affiliate_coupon_stats : 1,
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
                        $("#Loader").modal("hide");
                        $("#custom_toast").addClass("show");
                        $("#custom_toast").html("<i class='fa fa-check-circle green' aria-hidden='true'></i> "+ data.success);
                        setTimeout(function(){
                              $("#custom_toast").removeClass("show");
                        }, 4000);
                    }
              }
        });
    }
</script>
