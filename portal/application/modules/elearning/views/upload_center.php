<style>

nav > .nav.nav-tabs{

  border: none;
    color:#fff;
    background:#272e38;
    border-radius:0;


}
nav > div a.nav-item.nav-link,
nav > div a.nav-item.nav-link.active
{
  border: none;
    padding: 18px 25px;
    color:#fff;
    background:#272e38;
    border-radius:0;
}

nav > div a.nav-item.nav-link.active:after
 {
  content: "";
  position: relative;
  bottom: -60px;
  left: -10%;
  border: 15px solid transparent;
  border-top-color: #e74c3c ;
}
.tab-content{
  background: #fdfdfd;
    line-height: 25px;
    border: 1px solid #ddd;
    border-top:5px solid #e74c3c;
    border-bottom:5px solid #e74c3c;
    padding:30px 25px;
}

nav > div a.nav-item.nav-link:hover,
nav > div a.nav-item.nav-link:focus
{
  border: none;
    background: #e74c3c;
    color:#fff;
    border-radius:0;
    transition:background 0.20s linear;
}
</style>
            <title><?= $title;?></title>
            <div class="content-wrapper">
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 text-dark">Upload Center</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
                                    <li class="breadcrumb-item active">E-Learning</li>
                                    <li class="breadcrumb-item active"><a href="<?= current_url();?>">Upload Center</a></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Teacher Upload Center</h3>
                                    </div>

                                    <div class="card-body">
                                        <form id="form_upload">
                                            <div class="row">
                                                <div class="col-12 col-md-12 col-lg-12">
                                                    <div class="form-group">
                                                        <label for="select_class">Class:</label>
                                                        <select class="form-control" name="select_class" id="select_class">
                                                            <option selected disabled></option>
                                                            <?php foreach($classes as $c):?>
                                                                <option value="<?= $c['subjectcode']?>"><?= $c['subject_name']?></option>
                                                            <?php endforeach;?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-12 col-lg-12">
                                                    <div class="form-group">
                                                        <label for="userfile">Upload File</label>
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                <input type="file" class="form-control" id="userfile" name="userfile">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mx-2">
                                                <button type="submit" class="btn btn-success">Upload</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>

                            <div class="col-lg-8">

                            </div>
                        </div>

                        <div class="row">
                            <div class="card col-xs-12 col-md-12 col-lg-12">
                              <div class="card-body">
                                <div class="row">
                                  <div class="col-lg-12 ">
                                    <nav>
                                      <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                                    <?php foreach ($subjectlist as $subjectlist_row):
                                                         $row
                                                       ?>
                                        <a class="nav-item nav-link tablinks " id="nav-<?= $subjectlist_row->id ?>-tab" data-toggle="tab" href="#nav-<?= $subjectlist_row->id ?>" role="tab" aria-controls="nav-<?= $subjectlist_row->id ?>" aria-selected="true" data-value="<?= $subjectlist_row->subjectcode ?>"><?= $subjectlist_row->subject_name ?></a>
                                            <?php endforeach; ?>
                                      </div>
                                    </nav>
                                    <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                                      <div class="card-body table-responsive p-0" id="div_searched_table">
                                          <table class="table table-hover table-head-fixed text-nowrap" id="searched_table">

                                          </table>
                                      </div>
                                    </div>

                                  </div>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>
            $(document).ready(function(){
                  $('#searched_table').DataTable();
            });
                $("#form_upload").submit(function(e){
                    e.preventDefault();
                    $('.overlay').css('visibility', 'visible');
                    var formEditStaff = new FormData($(this)[0]);
                    $.ajax({
                        url: "<?=site_url('elearning/insert_upload')?>",
                        data: formEditStaff,
                        dataType: "json",
                        type: "post",
                        async: false,
                        success: function(data){
                            if(data.response == "false") {
                                Swal.fire({
                                    html: data.message,
                                    type: 'error',
                                })
                            } else {
                                Swal.fire({
                                    title: 'Upload Successful!',
                                    type: 'success',
                                    confirmButtonText: 'Ok'
                                }).then(
                                    (result) => {
                                        if(result.value){
                                            location.reload();
                                        }
                                    }
                                )
                            }
                            $('.overlay').css('visibility', 'hidden');
                        },
                        contentType: false,
                        cache: false,
                        processData: false,
                    });
                });

                $('.tablinks').click(function() {
                  var Dataform  = $(this).data("value");

                    $.ajax({
                        url: "<?=site_url('elearning/GetFilelistBySubject')?>",
                        data: {subcode : Dataform},
                        type: "post",
                        success: function(data){
                            if(data.response == "false") {
                            } else {
                                $("#searched_table").html(data);
                            }
                        },
                    })
                    return false;
                });
            </script>
