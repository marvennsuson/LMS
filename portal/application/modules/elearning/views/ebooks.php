  <title><?= $title;?></title>
            <div class="content-wrapper">
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 text-dark">E-Books</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
                                    <li class="breadcrumb-item active">E-Learning</li>
                                    <li class="breadcrumb-item active"><a href="<?= current_url();?>">E-Books</a></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="content">
                    <div class="container-fluid">

                              <div class="row">
                                <!-- <section class="jumbotron text-center">
                                    <div class="container">
                                        <h1 class="jumbotron-heading">E-COMMERCE CATEGORY</h1>
                                        <p class="lead text-muted mb-0">Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un peintre anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte...</p>
                                    </div>
                                </section> -->
                                <!-- <div class="container">
                                    <div class="row">
                                        <div class="col">
                                            <nav aria-label="breadcrumb">
                                                <ol class="breadcrumb">
                                                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                                    <li class="breadcrumb-item"><a href="category.html">Category</a></li>
                                                    <li class="breadcrumb-item active" aria-current="page">Sub-category</li>
                                                </ol>
                                            </nav>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6 col-md-3">
                                            <div class="card bg-light mb-3">
                                                <div class="card-header bg-primary text-white text-uppercase"><i class="fa fa-list"></i> Categories</div>
                                                <ul class="list-group category_block " style="overflow-y:scroll; overflow-x:hidden; height:400px;">
                                                  <?php foreach ($GetSubject as $GetSubject_row): ?>
                                                      <a href="#" id="SubjectItems" class="list-group-item list-group-item-action" data-value="<?= $GetSubject_row["subjectcode"] ?>"><?=  $GetSubject_row['subject_name'] ?></a>
                                                  <?php endforeach; ?>
                                                </ul>
                                            </div>
                                            <!-- <div class="card bg-light mb-3">
                                                <div class="card-header bg-success text-white text-uppercase">Last product</div>
                                                <div class="card-body">
                                                    <img class="img-fluid" src="https://dummyimage.com/600x400/55595c/fff" />
                                                    <h5 class="card-title">Product title</h5>
                                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                                    <p class="bloc_left_price">99.00 $</p>
                                                </div>
                                            </div> -->
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-9">
                                            <div class="row">
                                              <?php foreach($gebooks as $gebooksrow): ?>

                                                <div class="col-12 col-md-6 col-lg-3">
                                                    <div class="card">
                                                        <img class="card-img-top" src="https://dummyimage.com/600x400/55595c/fff" alt="Card image cap">
                                                        <div class="card-body">
                                                            <h4 class="card-title mb-3"><a href="#" title="View Product"><?= $gebooksrow["filename"] ?></a></h4>
                                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                                            <div class="row mt-3">
                                                                <div class="col">
                                                                     <a class="btn btn-info btn-block btn-flat btn-sm tablinks" data-value="<?= $gebooksrow["ebook_id"] ?>"><i style="color:#fff; font-size: 14px;" class="fas fa-eye"></i></a>

                                                                </div>
                                                                <div class="col">
                                                                    <a href="<?=site_url('elearning/Elearning/ModuleDownload/').$gebooksrow['filename'];?>" title="Download this module" class="btn btn-success btn-block btn-flat btn-sm"><i style="color:#fff; font-size: 14px;" class="fas fa-download"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
<!-- href="<//?=site_url('elearning/Elearning/ViewFile/').$gebooksrow['filename'];?>" -->
<!-- The Modal -->

                                                      <?php endforeach; ?>
                                            </div>
                                            <?= $links; ?>
                                        </div>

                                    </div>
                                </div>
                              </div>






                    </div>
                </div>
            </div>

            <div class="modal fade" id="myModal">
              <div class="modal-dialog modal-xl modal-dialog-centered  modal-dialog-scrollable">
                <div class="modal-content">

                  <!-- Modal Header -->
                  <div class="modal-header">
                    <h4 class="modal-title">PDF FILE Viewer</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>

                  <!-- Modal body -->
                  <div class="modal-body" id="innerModaldata">

                  </div>


                </div>
              </div>
            </div>


            <script type="text/javascript">
            $(document).ready(function() {

                $('.tablinks').click(function() {
                  var Dataform  = $(this).data("value");
                
                  $.ajax({
                      url: "<?=site_url('elearning/GetPdfilebooks')?>",
                      data: {BooksFile : Dataform},
                      type: "post",
                      success: function(data){
                          if(data.response == "false") {
                          } else {
                              $('#myModal').modal("show")
                              $("#innerModaldata").html(data);
                          }
                      },
                  })
                  return false;

                });

                });
            </script>


            <!-- START OF FEATRUES -->
<!-- <script type="text/javascript">
$('#SubjectItems').click(function() {
  var Dataform  = $(this).data("value");

    $.ajax({
        url: "</?=site_url('elearning/GetEbooksList')?>",
        data: {subcode : Dataform},
        type: "post",
        success: function(data){
            if(data.response == "false") {
            } else {
                $("#Passingdata").html(data);
            }
        },
    })
    return false;
});
</script> -->
<!-- END OF FEATURES -->
