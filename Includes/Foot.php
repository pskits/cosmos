<footer class="main-footer">
  <div class="pull-right hidden-xs"> <b>Version</b> 2.0 </div>
  <strong>Copyright &copy; <?php echo date('Y'); ?><a href="http://cosmopumps.com"> Cosmo</a>.</strong> All rights
  reserved.
</footer>
<div class="control-sidebar-bg"></div>
</div>
<div class="wrapper">
  <!-- ./wrapper -->
  <script src="<?php echo base_url('assets/Js/jquery.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/Js/bootstrap.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/Js/adminlte.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/Js/select2.full.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/Js/notify.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/Js/dataTables.bootstrap.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/Js/Datepicker.js'); ?>"></script>
  <script src="<?php echo base_url('assets/Js/Timepicker.js'); ?>"></script>
  <script src="<?php echo base_url('assets/Js/Datatables/jquery.dataTables.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/Js/Datatables/dataTables.responsive.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/Js/Datatables/dataTables.rowReorder.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/Js/HtmlDataView/Html5Buttons.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/Js/HtmlDataView/Html5DatatableButtons.js'); ?>"></script>
  <script src="<?php echo base_url('assets/Js/HtmlDataView/Html5JsZip.js'); ?>"></script>
  <script src="<?php echo base_url('assets/Js/HtmlDataView/Html5Pdf.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/Js/HtmlDataView/vfs_fonts.js'); ?>"></script>

  
  <script>
  function title()
  {
	  document.title  = "<?php echo $title;?>";
  }
  title();
    </script>
	  <script>
    function datatableonadjustscreenwidth() {
      setTimeout(function() {
        loaddatatable('#Viewtable');
      }, 500);
    }

    function loaddatatable(table) {
      if ($.fn.DataTable.isDataTable(table)) {
        $(table).DataTable().destroy();
      }
      var table = $(table).DataTable({
		     dom: 'liftpB',
        responsive: true,
		lengthMenu: [[10, 100,-1], [10, 100, "All"]],
		 buttons: [             {
                extend: 'pdf',
                messageTop: '<?php echo $datatableTitle;?>',
				messageBottom:''
            }, 'excel', 'copy']
      });
    }

    function daterender() {
      $('.Date').attr("autocomplete", "off");
      $(".Date").datepicker({
        changeMonth: true,
        changeYear: true,
        showAnim: "clip",
        dateFormat: "dd-mm-yy",
        yearRange: "1950:2030"
      });
    }

    function timerender() {
      $('.Timepicker').attr("autocomplete", "off");
      $(".Timepicker").click(function() {
        $(this).timepicker('showWidget');
      });
    }
    $(document).ready(function() {
      var Viewtable = document.getElementById("Viewtable");
      if (Viewtable) {
        loaddatatable('#Viewtable');
      }
      $('.select2').select2();
      daterender();
	  timerender();
    });
  </script>
  <?php if ($this->session->flashdata('msgS')) { ?>
    <script>
      $(function() {
        $.notify("<?php echo $this->session->flashdata('msgS');  ?>", "success", {
          position: "right"
        });
      });
    </script>
  <?php
  } ?>
  <?php if ($this->session->flashdata('msgU')) { ?>
    <script>
      $(function() {
        $.notify("<?php echo $this->session->flashdata('msgU');  ?>", "info");
      });
    </script>
  <?php } ?>
  <?php if ($this->session->flashdata('msgD')) { ?>
    <script>
      $(function() {
        $.notify("<?php echo $this->session->flashdata('msgD');  ?>", "error");
      });
    </script>
  <?php }
  unset($this->session->flashdata);
  ?>
  <script>
    var HoursLabel = document.getElementById("hours");
    var minutesLabel = document.getElementById("minutes");
    var secondsLabel = document.getElementById("seconds");
    var totalSeconds = (Number(secondsLabel.innerHTML) + Number(minutesLabel.innerHTML * 60) + Number(HoursLabel.innerHTML * 3600));
    setInterval(setTime, 1000);

    function setTime() {
      ++totalSeconds;
      totalSeconds = Number(totalSeconds);
      var h = secondsToH(totalSeconds);
      var m = secondsTom(totalSeconds);
      var s = secondsTos(totalSeconds);
      HoursLabel.innerHTML = h;
      minutesLabel.innerHTML = m;
      secondsLabel.innerHTML = s;
    }

    function secondsToH(d) {
      var h = Math.floor(d / 3600);
      var hDisplay = h > 0 ? ('0' + h).slice(-2) : "00";
      return hDisplay;
    }

    function secondsTom(d) {
      var m = Math.floor(d % 3600 / 60);
      var mDisplay = m > 0 ? ('0' + m).slice(-2) : "00";
      return mDisplay;
    }

    function secondsTos(d) {
      var s = Math.floor(d % 3600 % 60);
      var sDisplay = s > 0 ? ('0' + s).slice(-2) : "00";
      return sDisplay;
    }
  </script>
 
  </body>

  </html>