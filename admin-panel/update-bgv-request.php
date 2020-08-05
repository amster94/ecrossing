<?php


include_once "header.php";
?>
        <div class="content">
            <div class="container-fluid">
                <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12 mb10">
                <h4 style="font-size: 1.2em;">Check Client BGV Request Data :</h4>
                 <form action="">
                  <div class="form-group">
                    <label for="client-email">Enter Client Email:</label>
                    <input type="text" class="form-control" id="client-email" placeholder="Client Email">
                  </div>
                  <input type="button" onclick="checkClientData();" class="btn btn-success col-lg-offset-9 col-md-offset-9 col-sm-offset-9 col-xs-offset-6 col-lg-3 col-md-3 col-sm-3 col-xs-6" value="Check Client Data" />
                </form> 
                </div>
                <div class="row">
                    <div class="col-lg-3 col-sm-6 col-xs-12">
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
                                            <p>Request In Progress</p>
                                            <span class="pending_request">0</span>
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
                    <div class="col-lg-3 col-sm-6 col-xs-12">
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
                                            <p>Request Completed</p>
                                            <span class="complete_request">0</span>
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
                    <div class="col-lg-3 col-sm-6 col-xs-12">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="numbers">
                                            <p>Employees Reviewed</p>
                                            <span class="complete_employee">0</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-timer"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-xs-12">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="numbers">
                                            <p>Employees Pending</p>
                                            <span class="pending_employee">0</span>
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
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">All BGV Request Pending till Date</h4>
                                <p class="category">Yearly Record</p>
                            </div>
                            <div class="content">
                                <table class="bgv-request-table table table-striped table-bordered dt-responsive nowrap" style="width:100%;">
                                  <thead>
                                    <tr>
                                      <th>BGV Request Date</th>
                                      <th>BGV Request</th>
                                      <th>Download BGV</th>
                                      <th>View BGV Request</th>
                                    </tr>
                                  </thead>
                                  <tbody id="bgv-request-list">
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
                                <h4 class="title">All BGV Request Completed till Date</h4>
                                <p class="category">Yearly Record</p>
                            </div>
                            <div class="content">
                                <table class="complete-bgv-request-table table table-striped table-bordered dt-responsive nowrap" style="width:100%;">
                                  <thead>
                                    <tr>
                                      <th>BGV Request Date</th>
                                      <th>BGV Request</th>
                                      <th>Download BGV</th>
                                      <th>View BGV Request</th>
                                    </tr>
                                  </thead>
                                  <tbody id="complete-bgv-request-list">
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
                                <h4 class="title">Employees Review Remaining till Date</h4>
                                <p class="category">Yearly Record</p>
                            </div>
                            <div class="content">
                                <table class="employee-review-table table table-striped table-bordered dt-responsive nowrap" style="width:100%;" >
                                  <thead>
                                    <tr>
                                      <th>Employee Name</th>
                                      <th>Employee BGV </th>
                                      <th>Employee Status</th>
                                      <th>Update Employee</th>
                                    </tr>
                                  </thead>
                                  <tbody id="employee-review-list">
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

    function checkClientData() {
        var email = $('#client-email').val();
        $.ajax({
                type:'POST',
                url:web_root_path+'includes/utility/handleAdminRequest.php',
                dataType : "json",
                data:{
                  handle_check_client_data : 1,
                  email : email
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
                        $('.pending_request').html(data.pending_request);
                        $('.complete_request').html(data.complete_request);
                        $('.pending_employee').html(data.pending_employee);
                        $('.complete_employee').html(data.complete_employee);
                        getAllClientBGVRequest(email);
                        getAllClientCompletedRequest(email);
                        getAllEmployeeReviewed(email);
                    }
              }
        });
    }

    // GET ALL BGV REQUEST
    function getAllClientBGVRequest(email) {
        $.ajax({
            type:'POST',
            url:web_root_path+'includes/utility/handleAdminRequest.php',
            dataType : "json",
            data:{
              handle_get_all_client_bgv_request : 1,
              email : email
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

    // GET ALL BGV REQUEST
    function getAllClientCompletedRequest(email) {
        $.ajax({
            type:'POST',
            url:web_root_path+'includes/utility/handleAdminRequest.php',
            dataType : "json",
            data:{
              handle_get_all_client_completed_bgv_request : 1,
              email : email
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
                    if ($.fn.DataTable.isDataTable("table.complete-bgv-request-table")) {
                      $('table.complete-bgv-request-table').DataTable().clear().destroy();
                    }
                    $('#complete-bgv-request-list').html(data.error);
                        var mytbl = $('table.complete-bgv-request-table').DataTable({
                        responsive: false,
                        scrollX: true
                        });
                        mytbl.ajax.reload;
                } else {
                    if ($.fn.DataTable.isDataTable("table.complete-bgv-request-table")) {
                      $('table.complete-bgv-request-table').DataTable().clear().destroy();
                    }
                    $('#complete-bgv-request-list').html(data.success);
                        var mytbl = $('table.complete-bgv-request-table').DataTable({
                        responsive: false,
                        scrollX: true
                        });
                        mytbl.ajax.reload;
                }
          }
        });
    }

    // GET ALL EMPLOYEE REVIEWED
    function getAllEmployeeReviewed(email) {
        $.ajax({
            type:'POST',
            url:web_root_path+'includes/utility/handleAdminRequest.php',
            dataType : "json",
            data:{
              handle_get_all_employee_reviewed : 1,
              email : email
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

    function downloadRequest(request_id,email) {
        $.ajax({
                type:'POST',
                url:web_root_path+'includes/utility/handleAdminRequest.php',
                dataType : "json",
                data:{
                  handle_download_request : 1,
                  request_id : request_id,
                  email : email
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



    function getStats() {
        $.ajax({
                type:'POST',
                url:'utility/handleDashboard.php',
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

</script>
