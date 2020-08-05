<?php
require_once "../includes/service/appvars.php";
if(isset($_GET['employee_id']) && isset($_GET['client_id']) && $_GET['employee_id'] !=="" && $_GET['client_id'] !=="") {
$employee_id = $_GET['employee_id'];
$email = $_GET['client_id'];
include_once "header.php";
} else {
  header('Location: '.SITE_BASE_URL.'admin-login.php');
}
?>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                <h4>Upload Employee File for BGV Request :</h4>
                 <form action="">
                  <div class="file-upload-wrapper">
                  <div class="card card-body view file-upload"><div class="card-text file-upload-message"><i class="fa fa-cloud-download fa-5" aria-hidden="true"></i>
<p>Drag and drop a file here or click</p><p class="file-upload-error">Ooops, something wrong happended.</p></div><div class="mask rgba-stylish-slight"></div><div class="file-upload-errors-container"><ul></ul></div><input type="file" id="input-file-max-fs" class="file_upload" data-max-file-size="20M"><button type="button" class="btn btn-sm btn-danger">Remove<i class="far fa-trash-alt ml-1"></i></button><div class="file-upload-preview"><span class="file-upload-render"></span><div class="file-upload-infos"><div class="file-upload-infos-inner"><p class="file-upload-filename"><span class="file-upload-filename-inner"></span></p><p class="file-upload-infos-message">Drag and drop or click to replace</p></div></div></div></div>
                </div>
                  <!-- <input type="button" onclick="window.location.href='<?php echo SITE_BASE_URL; ?>client-panel/upload-employee-data.php'" class="btn btn-success col-lg-offset-8 col-md-offset-8 col-sm-offset-8 col-lg-3 col-md-3 col-sm-3 col-xs-12" value="Add Employee" /> -->
                </form> 
                </div>
                <div class="row">
                  <div class="progress col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <div id="_progress" class="row file-progress-bar progress-bar progress-bar-striped active" role="progressbar" style="width:100%">0%
                  </div>
                </div>
                </div>
                <div class="row">
                <p class="upload_error" ></p>
                <ul class="request-file-list uploaded_file_list col-lg-4 col-md-4 col-sm-6 col-xs-12">
                </ul>  
                </div>
                <div class="row">
                <p style="font-size: 1em;font-weight:700;">Previously Uploaded Files for Employee</p>
                <ul class="present-file-list uploaded_file_list col-lg-4 col-md-4 col-sm-6 col-xs-12">
                </ul>
                </div>
                <div class="row">
                <h4>Update Employee Status for BGV Request :</h4>
                 <form action="">
                  <div class="form-group">
                    <label class="radio-inline"><input type="radio" name="statusradio" value="Gray" checked>Gray</label>
                    <label class="radio-inline"><input type="radio" name="statusradio" value="Red" checked>Red</label>
                    <label class="radio-inline"><input type="radio" name="statusradio" value="Orange" >Orange</label>
                    <label class="radio-inline"><input type="radio" name="statusradio" value="Green" >Green</label> 
                  </div>
                  <input type="button" onclick="updateEmployeeStatus();" class="btn btn-success col-lg-offset-8 col-md-offset-8 col-sm-offset-8 col-lg-3 col-md-3 col-sm-3 col-xs-12" value="Update Status" />
                </form> 
                </div>
                <!-- <div class="row">
                  <h4> Note : You cannot download or view the uploaded file once you click on upload for security purpose. We recommend you to upload correct files and in case or query or errors contact the administrator respectively.</h4>
                </div> -->
                <div class="row">
            </div>
        </div>
<?php
include_once "footer.php";
?>
<script type="text/javascript">
    var email = "<?php echo $email; ?>";
    var employee_id = "<?php echo $employee_id; ?>";
    getUploadedReportNameList();
    $(".file-progress-bar").hide();
    $('input[type="file"]'). change(function() {
      uploadEmployeeReport();
    });
    function uploadEmployeeReport() {
      var file = $('#input-file-max-fs').prop('files')[0];
      // var validExtensions = ['png']; //array of valid extensions
      // var fileName = file.name;
      // var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
      // if ($.inArray(fileNameExt, validExtensions) == -1){
      //    alert("Invalid file type png allowed");
      //    return false;
      // }
      var data = new FormData();
      data.append('handle_upload_bgv_request_employee_report',1);
      data.append('file',file);
      data.append('email',email);
      data.append('employee_id',employee_id);
      $.ajax({
            type : "POST",
            url : web_root_path+'includes/utility/handleUpload.php',
            dataType : "json",
            data : data,
            cache : false,
            contentType : false,
            processData : false,
            xhr: function() {
            var xhr = $.ajaxSettings.xhr();
            if (xhr.upload) {
              // Upload progress
              xhr.upload.addEventListener("progress", function(evt){
                  if (evt.lengthComputable) {
                    var current = evt.loaded || evt.position;
                    var total = evt.total;
                      var percentComplete = Math.ceil((current/total)* 100) ;
                      _progress.style.width = Math.ceil((current/total)*100) + '%';
                      console.log(percentComplete);
                  }
                  // update progressbars classes so it fits your code
                  $(".file-progress-bar").show();
                  $(".file-progress-bar").css("width", + percentComplete + "%");
                  $(".file-progress-bar").text(percentComplete + "%");
              }, true);
            }
            return xhr;
            },
            error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr);
            console.log(ajaxOptions);
            console.log(thrownError);
            },
            beforeSend: function(){
            },
            success:function(response){
              $(".file-progress-bar").hide();
              if(response.error) {
                $(".upload_error").css("color","red");
                $('.upload_error').html(response.error);
              } else {
                $(".upload_error").css("color","green");
                $('.upload_error').html("File Uploaded.");
                $('.request-file-list').append(response.success);
              }
            }
        });
    }

    function getUploadedReportNameList() {
      $.ajax({
                type:'POST',
                url:web_root_path+'includes/utility/handleUpload.php',
                dataType : "json",
                data:{
                  handle_get_employee_uploaded_report_list : 1,
                  email : email,
                  employee_id : employee_id
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
                        $('.present-file-list').append(data.success);
                    }
              }
      });
    }

    function updateEmployeeStatus() {
      var status = $("input[name=statusradio]:checked").val();
        $.ajax({
                type:'POST',
                url:web_root_path+'includes/utility/handleAdminRequest.php',
                dataType : "json",
                data:{
                  handle_update_employee_status : 1,
                  email : email,
                  employee_id : employee_id,
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

</script>
