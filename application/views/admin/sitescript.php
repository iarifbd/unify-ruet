<!-- *************
            ************ JavaScript Files *************
        ************* -->
        <!-- Required jQuery first, then Bootstrap Bundle JS -->
        <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/bootstrap.bundle.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/moment.min.js"></script>

        <!-- *************
            ************ Vendor Js Files *************
        ************* -->

        <!-- Overlay Scroll JS -->
        <script src="<?php echo base_url();?>assets/vendor/overlay-scroll/jquery.overlayScrollbars.min.js"></script>
        <script src="<?php echo base_url();?>assets/vendor/overlay-scroll/custom-scrollbar.js"></script>

        <!-- Toastify JS -->
        <!-- Set the base URL in a meta tag or a custom data attribute -->
        <meta name="base_url" content="<?php echo base_url(); ?>">
        <!-- Include your JavaScript file -->
        <script src="<?php echo base_url();?>assets/vendor/toastify/toastify.js"></script>
        <script src="<?php echo base_url();?>assets/vendor/toastify/custom.js"></script>

        <!-- Custom JS files -->
        <script src="<?php echo base_url();?>assets/js/custom.js"></script>
        <script src="<?php echo base_url();?>assets/js/todays-date.js"></script>

        
        <!-- datatable -->
        <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.1.6/b-3.1.2/b-html5-3.1.2/b-print-3.1.2/datatables.min.js"></script>
        
        <!-- for dataTable -->
        <script>
            $(document).ready(function() {
                var table = $('.mydatatable').DataTable({
                    pageLength: 100,
                    lengthMenu: [
                        [10, 100, 500, -1], // The values to be used (10, 100, All)
                        [10, 100, 500, "All"] // Displayed text for the options
                    ],
                    buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                });

                table.buttons().container()
                    .appendTo('.mdtbtn');
            });
        </script>

