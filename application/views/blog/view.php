<div class="row">
    <div class="col-md-12">
        <h3 class="box-title" align="center">News</h3>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <img class="img-detail" src="<?= $file['url'] ?>">
            <div class="box-body" align="center">
                <h3><?= $tbl_blog['title'] ?><br></h3>
                Dibuat pada : <?= date('d M Y', strtotime($tbl_blog['created_at'])) ?> <br>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body">
                <?= $tbl_blog['deskripsi'] ?>
            </div>
        </div>
    </div>
</div>