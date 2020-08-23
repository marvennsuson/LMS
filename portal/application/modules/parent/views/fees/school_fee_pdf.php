<style>
#pdf_viewer{
    height : 1200px;
}
</style>
<title><?= $title;?></title>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Student Bill Information</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>

                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div id= "pdf_viewer">

        </div>
    </div>
</div>



<script src="<?= base_url('public/newAssets/pdfobject.min.js');?>"></script>
<script>
    $(document).ready(function(){
        var viewer = $('#pdf_viewer');
        var file = "<?php echo $filename ?>";
        PDFObject.embed('<?= base_url('public/uploads/bills/');?>'+file,viewer);
    });

</script>
