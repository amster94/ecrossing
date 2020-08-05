<?php


include_once "header.php";
?>
        <div class="content">
            <div class="container-fluid">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                 <form action="">
                  <div class="form-group">
                    <label for="text">Query Title:</label>
                    <input type="text" class="form-control" id="text" placeholder ="Case Title">
                  </div>
                  <div class="form-group">
                    <label for="text">Query Description:</label>
                    <input type="text" class="form-control" id="description" placeholder ="Case Description">
                  </div>
                  <button type="button" class="btn btn-fill btn-primary col-lg-offset-9 col-md-offset-9 col-sm-offset-9 col-lg-3 col-md-3 col-sm-3 col-xs-12" onclick="sendQuery();">Submit Query</button>
                </form> 
                </div>
            </div>
        </div>
<?php
include_once "footer.php";
?>
<script type="text/javascript">
$('.coupon-management-table').DataTable({
    responsive: true
});
    function sendQuery() {
        // GET DATA
        var title = $('#text').val();
        var description = $('#description').val();
        $.ajax({
                type:'POST',
                url:web_root_path+'includes/utility/handleClientDashboard.php',
                dataType : "json",
                data:{
                  handle_send_query_status : 1,
                  title : title,
                  description : description
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
