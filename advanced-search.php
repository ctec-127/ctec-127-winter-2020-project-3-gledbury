<?php //advanced-search.php
$pageTitle = "Advanced Search";
require_once 'inc/layout/header.inc.php';
?>

<div class="container-fluid">
    <div class="row mt-5">
        <div class="col-sm-12 col-md-3 col-lg-3 mb-5 border-right border-secondary p-20">
        <h1>Advanced Search</h1>
        <?php require_once __DIR__ . '/inc/advanced-search/advanced-search.inc.php'; ?>
        <?php require_once __DIR__ . '/inc/shared/form.inc.php'; ?>
        </div>
        <div class="col-sm-12 col-md-9 col-lg-9">
        <?php require_once __DIR__ . '/inc/advanced-search/advanced-search-results.inc.php'; ?>        
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/inc/layout/footer.inc.php'; ?>
