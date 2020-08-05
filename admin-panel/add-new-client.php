<?php


include_once "header.php";
?>
        <div class="content">
            <div class="container-fluid">
                <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12 mb10">
                <h4 style="font-size: 1.2em;">Enter Client Data :</h4>
                 <p class="add-error"></p>
                 <form action="">
                  <div class="form-group">
                    <label for="client-email">Enter Client Email:</label>
                    <input type="text" class="form-control" id="client-email" placeholder="Client Email">
                  </div>
                  <div class="form-group">
                    <label for="client-name">Enter Client Name:</label>
                    <input type="text" class="form-control" id="client-name" placeholder="Client Name">
                  </div>
                  <div class="form-group">
                    <label for="client-password1">Enter Client Password:</label>
                    <input type="password" class="form-control" id="client-password1" placeholder="Client Name">
                  </div>
                  <div class="form-group">
                    <label for="client-password2">Re-Enter Client Password:</label>
                    <input type="password" class="form-control" id="client-password2" placeholder="Client Name">
                  </div>
                  <input type="button" onclick="addNewClientData();" class="btn btn-success col-lg-offset-9 col-md-offset-9 col-sm-offset-9 col-xs-offset-6 col-lg-3 col-md-3 col-sm-3 col-xs-6" value="Add Client" />
                </form> 
                </div>
                <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">All Client Added till Date</h4>
                                <p class="category">Yearly Record</p>
                            </div>
                            <div class="content">
                                <table class="client-data-table table table-striped table-bordered dt-responsive nowrap" style="width: 100%;">
                                  <thead>
                                    <tr>
                                      <th>Client Date</th>
                                      <th>Client Name</th>
                                      <th>Client Email</th>
                                      <th>Client Active</th>
                                    </tr>
                                  </thead>
                                  <tbody id="client-data-list">
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
        </div>
<?php
include_once "footer.php";
?>
<script type="text/javascript">

// SET VIEWPORT
    $('.client-data-table').DataTable({
    responsive: false,
    scrollX: true
    });
    $('#DataTables_Table_0_length').css({"display":"none"});
    getAllClientAdded();
    function isEmail(email) {
      var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      return regex.test(email);
    }


    function addNewClientData() {
        var email = $('#client-email').val();
        var name = $('#client-name').val();
        var password1 = $('#client-password1').val();
        var password2 = $('#client-password2').val();
        if(!isEmail(email)) {
            $(".add-error").css("color","red");
            $('.add-error').html("Enter Valid Email");
            return;
        }
        if(email!="" && name!="" && password1!="" && password2!="" && password1 == password2) {
            $.ajax({
                type:'POST',
                url:web_root_path+'includes/utility/handleAdminRequest.php',
                dataType : "json",
                data:{
                  handle_add_new_client_data : 1,
                  email : email,
                  name : name,
                  password1 : password1
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
                        getAllClientAdded();
                    }
              }
            });
        } else {
            if(email=="") {
                $(".add-error").css("color","red");
                $('.add-error').html("Enter Email");
            } else if(name=="") {
                $(".add-error").css("color","red");
                $('.add-error').html("Enter Name");
            } else if(password1=="") {
                $(".add-error").css("color","red");
                $('.add-error').html("Enter Password");
            } else if(password2=="") {
                $(".add-error").css("color","red");
                $('.add-error').html("Re-Enter Password");
            }
        }
    }

    // GET ALL BGV REQUEST
    function getAllClientAdded() {
        $.ajax({
            type:'POST',
            url:web_root_path+'includes/utility/handleAdminRequest.php',
            dataType : "json",
            data:{
              handle_get_all_client_added : 1
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
                    if ($.fn.DataTable.isDataTable("table.client-data-table")) {
                      $('table.client-data-table').DataTable().clear().destroy();
                    }
                    $('#client-data-list').html(data.error);
                        var mytbl = $('table.client-data-table').DataTable({
                        responsive: false,
                        scrollX: true
                        });
                        mytbl.ajax.reload;
                } else {
                    if ($.fn.DataTable.isDataTable("table.client-data-table")) {
                      $('table.client-data-table').DataTable().clear().destroy();
                    }
                    $('#client-data-list').html(data.success);
                        var mytbl = $('table.client-data-table').DataTable({
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
