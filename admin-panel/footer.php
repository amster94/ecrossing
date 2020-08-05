<footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="http://ecrossings.in/" target="_blank">
                                Ecrossings
                            </a>
                        </li>
                        <li>
                            <a href="http://ecrossings.in/contact-us/" target="_blank">
                               Contact Us
                            </a>
                        </li>
                        <li>
                            <a href="http://ecrossings.in/privacy-policy/" target="_blank">
                                Privacy Policy
                            </a>
                        </li>
                        <li>
                            <a href="http://ecrossings.in/privacy-policy/" target="_blank">
                                Help
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script>, made with <i class="fa fa-heart heart"></i> by <a href="https://www.pixsuit.com">Pixsuit</a>
                </div>
            </div>
        </footer>
</div>
</div>
<div class="center-block text-center" id="custom_toast"></div>
</body>
    <!--  Notifications Plugin    -->
    <script src="<?php echo SITE_BASE_URL; ?>js/bootstrap-notify.js"></script>
    <!-- Paper Dashboard Core javascript and methods for Demo purpose -->
	<script src="<?php echo SITE_BASE_URL; ?>js/paper-dashboard.js"></script>
	<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
	<script src="<?php echo SITE_BASE_URL; ?>js/demo.js"></script>
    <script src="<?php echo SITE_BASE_URL; ?>js/datatables/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo SITE_BASE_URL; ?>js/datatables/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo SITE_BASE_URL; ?>js/datatables/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
     <script src="<?php echo SITE_BASE_URL; ?>js/datatables/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
     <script src="<?php echo SITE_BASE_URL; ?>js/datatables/datatables.net-scroller/js/dataTables.scroller.min.js"></script>

	<script type="text/javascript">
        // GET THE ROOT PATH
        function getWebSiteRootPath()
        {
        var _location = document.location.toString();
        var applicationNameIndex = _location.indexOf('/', _location.indexOf('://') + 3);
        var applicationName = _location.substring(0, applicationNameIndex) + '/';
        var webFolderIndex = _location.indexOf('/', _location.indexOf(applicationName) + applicationName.length);
        var webFolderFullPath = _location.substring(0, webFolderIndex);

        return webFolderFullPath;
        }
        var web_root_path = getWebSiteRootPath();
        // var web_root_path = web_root_path;
        var web_root_path = web_root_path +"/ecrossing/";

        // FOR THE NAVIGATION CHANGE IN SIDEBAR
        $(function(){
        // this will get the full URL at the address bar
        var url = window.location.href; 
        $('.nav li.active').removeClass('active');
        // passes on every "a" tag 
        $(".nav a").each(function() {
            // checks if its the same on the address bar
            if(url == (this.href)) { 
                $(this).closest("li").addClass("active");
            }
        });
        });

	</script>

</html>