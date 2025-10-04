 <!-- Main Footer -->

 </div>
 <!-- ./wrapper -->

 <!-- REQUIRED SCRIPTS -->
 <!-- jQuery -->
 <script
   src="http://code.jquery.com/jquery-3.4.1.min.js"></script>
 <!-- Bootstrap -->
 <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
 <!-- overlayScrollbars -->
 <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
 <!-- AdminLTE App -->
 <script src="dist/js/adminlte.js"></script>

 <!-- OPTIONAL SCRIPTS -->
 <!-- <script src="dist/js/demo.js"></script> -->

 <!-- PAGE PLUGINS -->
 <!-- jQuery Mapael -->
 <script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
 <script src="plugins/raphael/raphael.min.js"></script>
 <script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
 <script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
 <!-- Datatable JS -->
 <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
 <!-- ChartJS -->
 <script src="plugins/chart.js/Chart.min.js"></script>
 <!-- datepicker js  -->
 <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
 <script>
   // preloader

   function onReady(callback) {
     var intervalID = window.setInterval(checkReady, 1000);

     function checkReady() {
       if (document.getElementsByTagName('body')[0] !== undefined) {
         window.clearInterval(intervalID);
         callback.call(this);
       }
     }
   }

   function show(id, value) {
     document.getElementById(id).style.display = value ? 'block' : 'none';
   }

   onReady(function() {
     show('page', true);
     show('loading', false);
   });
 </script>
 <!-- select 2 js  -->
 <script src="plugins/select2/js/select2.min.js"></script>
 <!-- PAGE SCRIPTS -->
 <script src="dist/js/pages/dashboard2.js"></script>
 <script src="assets/js/custom-patch.js"></script>
 <script src="assets/js/custom.js"></script>
 <script src="assets/js/ajax_req.js"></script>
 <script src="assets/js/buy_product.js"></script>
 <script src="assets/js/customer-management.js"></script>
 <!-- <script src="assets/js/supplier-management.js"></script> -->
 <script src="assets/js/supplier-management-new.js"></script>
 <script src="assets/js/datatables-debug.js"></script>
 <script>
   $(document).ready(function() {
     $('.dropdown-submenu a.test').on("click", function(e) {
       $(this).next('ul').toggle();
       e.stopPropagation();
       e.preventDefault();
     });
   });
 </script>
 <script>
   $(document).ready(function($) {
     // Load customer dropdown fix first
     $.getScript('assets/js/customer-dropdown-fix.js');

     // Initialize other select2 elements (excluding customer dropdown)
     $('.select2:not(.product-search):not(#customer_name)').select2();

     // Initialize datepicker
     $('.datepicker').datepicker({
       format: 'dd-mm-yyyy',
       autoclose: true,
       todayHighlight: true
     });

     // Load other functionality after a short delay
     setTimeout(function() {
       // Load select2 initialization for dynamic elements
       $.getScript('assets/js/select2-init.js');

       // Load product image functionality 
       $.getScript('assets/js/product-image.js');

       // Load enhanced sell functionality
       $.getScript('assets/js/enhanced-sell.js');

       // Load product validation
       $.getScript('assets/js/product-validation.js');

       // Load product search functionality
       $.getScript('assets/js/product-search.js');
     }, 200);
   });
 </script> <!-- datepicker -->
 <script>
   $('.datepicker').datepicker();
 </script>


 <!-- google transelate -->

 <script type="text/javascript">
   function googleTranslateElementInit() {
     new google.translate.TranslateElement({
       pageLanguage: 'en'
     }, 'google_translate_element');
   }
 </script>

 <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

 <script type="text/javascript">
   function googleTranslateElementInit() {
     new google.translate.TranslateElement({
       pageLanguage: 'en'
     }, 'google_translate_element');

     var $googleDiv = $("#google_translate_element .skiptranslate");
     var $googleDivChild = $("#google_translate_element .skiptranslate div");
     $googleDivChild.next().remove();

     $googleDiv.contents().filter(function() {
       return this.nodeType === 3 && $.trim(this.nodeValue) !== '';
     }).remove();

   }
 </script>

 </body>

 </html>