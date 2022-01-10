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
  <script src="<?php echo base_url('assets/Js/notify.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/Js/dataTables.bootstrap.min.js'); ?>"></script>  
  <script src="<?php echo base_url('assets/Js/select2.full.min.js'); ?>"></script>
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
    function rendercurrencyformat() {
      // Get all the "row_data" elements into an array
      let cells = Array.prototype.slice.call(document.querySelectorAll(".Currency"));
      // Loop over the array
      cells.forEach(function(cell) {
        // Convert cell data to a number, call .toLocaleString()
        // on that number and put result back into the cell
        // cell.textContent = (+cell.textContent).toLocaleString('en-US', { style: 'currency', currency: '' });
        if ((!isNaN(cell.textContent)) && ((cell.textContent)))
			 //cell.textContent = (cell.textContent).toFixed(2);
         // cell.textContent = new Intl.NumberFormat('en-IN').format(parseFloat(cell.textContent));
		 <?php if($_SESSION['currentdatabasename']=='cosmo_oman') 
		 {
			 ?>
		  cell.textContent = Number(parseFloat(cell.textContent).toFixed(3)).toLocaleString('en', {
    minimumFractionDigits: 3
});
	<?php 
		 }
		 else
		 {?>
			 
			 cell.textContent = Number(parseFloat(cell.textContent).toFixed(2)).toLocaleString('en', {
    minimumFractionDigits: 2
});
			 
		<?php }	 ?>
		 	 
		 
      });
    }
    function rendertable() {
      // Setup - add a text input to each footer cell
      $('#Reptable thead tr:eq(0) th').each(function(i) {
        var title = $(this).text();
        $(this).html('<input type="text" class="datatablefilerhead" placeholder="' + title + '" />');
        $('input', this).on('keyup change', function() {
          if (table.column(i).search() !== this.value) {
            table
              .column(i)
              .search(this.value)
              .draw();
          }
        });
      });
      var table = $('#Reptable').DataTable({
        ordering: <?php echo $ordering;   ?>,
        orderCellsTop: true,
        responsive: true,
        dom: 'iBt',
        autoWidth: false,
        lengthMenu: [
          [-1],
          ["All"]
        ],
        buttons: [{
          extend: 'collection',
          text: 'Export',
          buttons: ['copy', 'csv', 'excel', 'pdf']
        }],
        "footerCallback": function(row, data, start, end, display) {
          var api = this.api(),
            data;
          // Remove the formatting to get integer data for summation
          var intVal = function(i) {
            return typeof i === 'string' ?
              i.replace(/[\$,]/g, '') * 1 :
              typeof i === 'number' ?
              i : 0;
          };
          <?php foreach ($tablecolumntotallist as  $coulmnlist) {  ?>
            // Total over all pages
            total = api
              .column(<?php echo $coulmnlist; ?>, {
                page: 'current'
              })
              .data()
              .reduce(function(a, b) {
                return intVal(a) + intVal(b);
              }, 0);
            // Update footer
            total = total.toFixed(2);
            total = (isNaN(total)) ? '' : total;
            $(api.column(<?php echo $coulmnlist; ?>).footer()).html(total);
          <?php } ?>
        }
      });
	   rendercurrencyformat();
    }
    function exporttable() {
      var table = $('.exporttable').DataTable({
        ordering: <?php echo $ordering;   ?>,
        dom: 'iBt',
        lengthMenu: [
          [-1],
          ["All"]
        ],
        autoWidth: false,
        buttons: ['excel', 'pdf'],
        "footerCallback": function(row, data, start, end, display) {
          var api = this.api(),
            data;
          // Remove the formatting to get integer data for summation
          var intVal = function(i) {
            return typeof i === 'string' ?
              i.replace(/[\$,]/g, '') * 1 :
              typeof i === 'number' ?
              i : 0;
          };
          <?php foreach ($tablecolumntotallist as  $coulmnlist) {  ?>
            // Total over all pages
            total = api
              .column(<?php echo $coulmnlist; ?>, {
                page: 'current'
              })
              .data()
              .reduce(function(a, b) {
                return intVal(a) + intVal(b);
              }, 0);
            // Update footer
            total = total.toFixed(2);
            total = (isNaN(total)) ? '' : total;
            $(api.column(<?php echo $coulmnlist; ?>).footer()).html(total);
          <?php } ?>
        }
      });
	   rendercurrencyformat();
    }
    </script>
  <script>
    function daterender() {
      $('.Date').attr("autocomplete", "off");
      // $(".Date").daterangepicker({});
      $(".Date").datepicker({
        changeMonth: true,
        changeYear: true,
        showAnim: "clip",
        dateFormat: "dd-mm-yy",
        yearRange: "1950:2030"
      });
    }
  </script>
  <script>
    $(document).ready(function() {
      daterender();
      rendertable();
      $('.select2').select2();
      setTimeout(exporttable(), 15000000);
      rendercurrencyformat();
 
    });
    $(window).bind("load", function () {
        $('#overlay').fadeOut(100);
    });
  </script>
  
  </body>
  </html>