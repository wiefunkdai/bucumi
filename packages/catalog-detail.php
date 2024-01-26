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

if (isset($_SERVER['HTTP_ORIGIN'])) {
  header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
  header('Access-Control-Allow-Credentials: true');
  header('Access-Control-Max-Age: 86400');
}

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
  if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
      header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");         

  if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
      header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

}

if($paramName===false) {
    throw new \Exception('Tidak ada parameter!');
}

$pageTitle = "Katalog Detail";

$tableName = mysqli_table_name('books');
$SQLQuery = $SQLConnector->query("SELECT * FROM $tableName WHERE bookid='$paramName';");
if ($SQLQuery->num_rows === 0) {
    throw new \Exception('Data is invalid!');
}
$model = $SQLQuery->fetch_array(MYSQLI_ASSOC);
$pageTitle = "Buku ".ucfirst($model['booktitle']);
$linkTags = explode(',',$model['bookkeyword']);
?>
<?php require_once('header.layout.php'); ?>
<div class="container col-lg-12">
    <div class="row align-items-start g-lg-5 py-5">
      <div class="col-lg-7 text-center text-lg-start">
        <?php if (bucumi_auth()): ?>
          <div class="h-100 p-3 border rounded-3 mb-3">
          <nav class="navbar bg-bucumi pagination">
            <form class="container-fluid wrap justify-content-between">
              <button id="prev" class="btn btn-sm btn-light" type="button"><i class="bi bi-caret-left-fill"></i> Prev</button>
              <div class="text-white fs-5 fw-bold">
                  <span>Page: <span id="page_num"></span> / 
                  <span id="page_count"></span></span>
              </div>
              <button id="next" class="btn btn-sm btn-light" type="button">Next <i class="bi bi-caret-right-fill"></i></button>
            </form>
          </nav>

          <canvas id="bucumi-pdfcanvas" class="bucumi-pdfcanvas" style="width:100%"></canvas>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
          <script>
            const canvas = document.getElementById('bucumi-pdfcanvas');
            if (canvas != null) {
              document.addEventListener('contextmenu', event => event.preventDefault());
              var url = '<?= create_assetlink('downloads/'.$model['bookid'].'.pdf') ?>';
              var pdfjsLib = window['pdfjs-dist/build/pdf'];
              pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

              var pdfDoc = null,
                  pageNum = 1,
                  pageRendering = false,
                  pageNumPending = null,
                  scale = 2,
                  ctx = canvas.getContext('2d');

              function renderPage(num) {
                pageRendering = true;
                pdfDoc.getPage(num).then(function(page) {
                  var viewport = page.getViewport({scale: scale});
                  canvas.height = viewport.height;
                  canvas.width = viewport.width;

                  var renderContext = {
                    canvasContext: ctx,
                    viewport: viewport
                  };
                  var renderTask = page.render(renderContext);

                  renderTask.promise.then(function() {
                    pageRendering = false;
                    if (pageNumPending !== null) {
                      renderPage(pageNumPending);
                      pageNumPending = null;
                    }
                  });
                });
                document.getElementById('page_num').textContent = num;
              }

              function queueRenderPage(num) {
                if (pageRendering) {
                  pageNumPending = num;
                } else {
                  renderPage(num);
                }
              }
              function onPrevPage() {
                if (pageNum <= 1) {
                  return;
                }
                pageNum--;
                queueRenderPage(pageNum);
              }
              document.getElementById('prev').addEventListener('click', onPrevPage);

              function onNextPage() {
                if (pageNum >= pdfDoc.numPages) {
                  return;
                }
                pageNum++;
                queueRenderPage(pageNum);
              }
              document.getElementById('next').addEventListener('click', onNextPage);

              pdfjsLib.getDocument(url).promise.then(function(pdfDoc_) {
                pdfDoc = pdfDoc_;
                document.getElementById('page_count').textContent = pdfDoc.numPages;
                renderPage(pageNum);
              });
            }      
          </script>

          </div>
        <hr class="my-4">
        <?php endif; ?>
        <h1 class="display-5 fw-bold lh-1 text-body-emphasis mb-4"><?= $pageTitle; ?></h1>
        <div class="btn-group" role="group">
          <?php foreach($linkTags as $tags): ?>
          <a href="<?= create_url('catalog/label/'.trim($tags)) ?>" class="btn btn-outline-secondary"><?= $tags ?></a>
          <?php endforeach; ?>
        </div>
        <hr class="my-4">
        <p class="col-lg-10"><?= $model['booksummary'] ?></p>
        <hr class="my-4">
        <p class="col-lg-10"><?= $model['bookdescription'] ?></p>
      </div>
      <div class="col-md-10 mx-auto col-lg-5">
        <div class="p-4 p-md-5 border rounded-3 bg-body-tertiary">
        <img src="<?= create_assetlink('books/'. (!empty($model['bookcover']) ? $model['bookcover'] : 'default.jpg')) ?>" class="bd-placeholder-img w-100 d-block bordered mb-3">
        <?php if (!bucumi_auth()): ?>
        <a href="<?= create_url('login') ?>" class="w-100 btn btn-lg btn-primary" type="submit">Login Terlebih Dahulu</a>  
        <?php endif; ?>
        <hr class="my-4">
        <div class="infoboxbook">
          <div class="col-md-12 row">
            <p class="col-4 fw-bold">Total Halaman</p>
            <p class="col-8">: <?= $model['booktotalpages'] ?? 0 ?> Halaman</p>
          </div>
          <div class="col-md-12 row">
            <p class="col-4 fw-bold">Pengarang</p>
            <p class="col-8">: <?= $model['bookauthor'] ?? 'Tidak Tersedia' ?></p>
          </div>
          <div class="col-md-12 row">
            <p class="col-4 fw-bold">Penerbit</p>
            <p class="col-8">: <?= $model['bookpublisher'] ?? 'Tidak Tersedia' ?></p>
          </div>
          <div class="col-md-12 row">
            <p class="col-4 fw-bold">Tahun Terbit</p>
            <p class="col-8">: <?= !empty($model['bookpublishdate']) ? date('Y', strtotime($model['bookpublishdate'])) : 'Tidak Tersedia' ?></p>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php require_once('footer.layout.php'); ?>