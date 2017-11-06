
<!-- Footer -->
<footer class="footer text-right">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 text-center">
                2017 © Adminox - Coderthemes.com
            </div>
        </div>
    </div>
</footer>
<!-- End Footer -->

</div> <!-- end container -->
</div>
<!-- end wrapper -->


<!-- jQuery  -->
<script src="<?php print site_url('assets/js/jquery.min.js')?>"></script>
<script src="<?php print site_url('assets/js/bootstrap.min.js')?>"></script>
<script src="<?php print site_url('assets/js/waves.js')?>"></script>
<script src="<?php print site_url('assets/js/jquery.slimscroll.js')?>"></script>
<script src="<?php print site_url('assets/js/jquery.scrollTo.min.js')?>"></script>

<script src="<?php print site_url('assets/js/bootstrap-datepicker.js')?>"></script>

<script src="<?php print site_url('assets/js/jquery.mask.min.js')?>"></script>

<script src="<?php print site_url('plugins/sweet-alert2/sweetalert2.min.js')?>"></script>
<script src="<?php print site_url('assets/pages/jquery.sweet-alert.init.js')?>"></script>

<!-- App js -->
<script src="<?php print site_url('assets/js/jquery.core.js')?>"></script>
<script src="<?php print site_url('assets/js/jquery.app.js')?>"></script>
<?php
    if(isset($includes))
        $this->load->view('adm/includes/'.$includes)
?>
<script>
    $(document).ready(function () {
        $('.date').mask('00/00/0000');

        $('.datepicker').datepicker({
            format: "dd/mm/yyyy",
            language: "pt-BR",
            todayHighlight: true,
            autoclose: true
        });

        $('#datatable-responsive').DataTable();
    });
</script>

</body>
</html>