<?php
include_once "header.php";
?>
        <div class="content">
            <div class="container-fluid">
                <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12 mb10">
                <h4 style="font-size: 1.2em;">Newsfeed :</h4>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb10 newsfeed">
                </div>
                </div>
            </div>
        </div>
<?php
include_once "footer.php";
?>
<script type="text/javascript">

// SET VIEWPORT
getLatestNewsFeed();
    function getLatestNewsFeed() {
        $.ajax({
                type:'POST',
                url:web_root_path+'includes/utility/handleAdminRequest.php',
                dataType : "json",
                data:{
                  handle_get_latest_news_feed : 1
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
                        // $("#Loader").modal("hide");
                        // $("#custom_toast").addClass("show");
                        // $("#custom_toast").html("<i class='fa fa-exclamation-circle red' aria-hidden='true'></i> "+ data.error);
                        // setTimeout(function(){
                        //       $("#custom_toast").removeClass("show");
                        // }, 4000);
                        $('.newsfeed').append(data.error);
                    } else {
                        $('.newsfeed').append(data.success);
                    }
              }
        });
    }
</script>
