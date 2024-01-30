<?php
/**
 * PROJECT AKHIR SEMESTER PALCOMTECH
 * Mata Kuliah: Pemograman Web Dasar
 * Dosen : Bpk. Hendra Efendi
 * 
 * DAFTAR KELOMPOK :
 * - Stephanus Bagus Saputra
 * - Muhammd Ilham brosnansyah
 * - Muhamad Firdaus 
 * - M Ihsan Adrian 
 * - M. Chaidar Ramadhan 
 * - Mega
 */
?>
</main>
  <footer class="py-3 my-4 border-top text-center">
    <div class="container-fluid d-flex flex-wrap justify-content-center justify-content-md-between align-items-center">
      <div class="col-md-4 d-flex flex-md-grow-1 align-items-center text-center mt-3 mt-md-0 order-1 order-md-0">
        <a href="<?= create_url('/') ?>" class="me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
          <img src="<?= create_url('resources/images/bucumi-logosquare.png') ?>" class="ms-3" height="36" alt="Bucumi Book Libraries">
        </a>
        <span class="text-body-secondary">&copy; ID <?= date('Y') ?> Bucumi (Pustaka Buku Online)</span>
      </div>
      <div class="col-md-4 order-0 order-md-1 justify-content-end d-flex">
        <a href="https://www.palcomtech.ac.id" class="text-none-decoration">
          <img src="<?= create_url('resources/images/bucumi-poweredby.webp') ?>" class="me-3" height="36" alt="Powered by Palcomtech">
        </a>
      </div>
    </div>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.7.0.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <script type="text/javascript">
    (() => {
      'use strict';
      const forms = document.querySelectorAll('.needs-validation');
      const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
      const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

      Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
          if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
          }

          form.classList.add('was-validated');
        }, false);
      });

      
    })();

    $(document).ready(function() {
      $.fn.dataTable.ext.errMode = 'none';
      $('table.table-print').DataTable( {
        dom: 'Bfrtip',
        buttons: [
          {
              extend: 'excel'
          },
          {
              extend: 'csv'
          },
          {
            extend: 'pdf',
            orientation: 'landscape'
          }          
        ]
      });
      $(".select-paymentbank").select2({
        templateResult: function(bankName) {
          if (!bankName.id) {
            return bankName.text;
          }
          var baseUrl = "<?= create_url('/resources/images/payments') ?>";
          var paymentHtml = $(
            '<span><img src="' + baseUrl + '/' + bankName.element.value.toLowerCase() + '-logo.svg" class="img-payment me-1" width="48" /> ' + bankName.text + '</span>'
          );
          return paymentHtml;
        }
      });
      $('.grid-responsive table tbody tr td').each(function(index, rowelement) {
        var headtable = $('.grid-responsive table thead tr').find('th:nth('+(index+1)+')');
        if (headtable.length > 0) {
          var linksorter = $('.grid-responsive table thead tr').find('a');
          if (linksorter.length > 0) {
            $(rowelement).attr('data-header', linksorter.text());
          } else {
            $(rowelement).attr('data-header', headtable.text());
          }
        }
      });
      $('.grid-responsive table tbody td, .grid-responsive table tbody td a.grid-expand').on('click', function(e) {
          e.preventDefault();
          let tr = $(this).parent();
          console.log($(this));
          let span = $(tr).find('.grid-expand').children('span');
          if ($(this).hasClass('grid-expand')) {
              tr = $(this).parent().parent();
              span = $(this).children('span');
          }
          tr.toggleClass('expanded');
          span.removeClass('bi-caret-up-square-fill, bi-caret-up-square-fill');
          let arrow = tr.hasClass('expanded') ? 'bi-caret-up-square-fill' : 'bi-caret-down-square-fill';
          span.addClass(arrow);
          
          return false;
      });
    });
  </script>
</body>
</html>