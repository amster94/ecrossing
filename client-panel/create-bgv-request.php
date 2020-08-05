<?php


include_once "header.php";
?>
        <div class="content">
            <div class="container-fluid">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h4 style="font-size: 1.2em;">Create New BGV Request Id :</h4>
                 <form action="">
                  <!-- <input type="button" onclick="window.location.href='<?php echo SITE_BASE_URL; ?>client-panel/view-request.php'" class="btn btn-success col-lg-offset-8 col-md-offset-8 col-sm-offset-8 col-lg-3 col-md-3 col-sm-3 col-xs-12" value="Generate New BGV Request" /> -->
                  <input type="button" onclick="generateNewRequest();" class="btn btn-fill btn-success col-lg-offset-7 col-md-offset-7 col-sm-offset-7 col-lg-4 col-md-4 col-sm-4 col-xs-12" value="Generate New BGV Request" />
                </form> 
                </div>
                <div class="row">
                <!-- <h4> Note : You can create only 2 BGV Request in a day for the convenience purpose of both the parties. To Create more than 2 BGV Request in a day please contact the administrator for further instruction.</h4> -->
                </div>
            </div>
        </div>
<?php
include_once "footer.php";
?>
<script type="text/javascript">
function generateNewRequest() {
          $.ajax({
                type:'POST',
                url:web_root_path+'includes/utility/handleClientRequest.php',
                dataType : "json",
                data:{
                  handle_generate_client_bgv_request : 1,
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
                        window.location.href=data.success;
                        
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
    
</script>