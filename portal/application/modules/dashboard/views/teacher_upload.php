<title><?= $title;?></title>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Materials</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-Title"><a href="<?= base_url();?>">E_learning</a></li>
                        <li class="breadcrumb-Title active">Upload</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
                  <div class="text-left text-dark mb-5">
                      <p class="h1">E-Learning upload</p>
                  </div>

<div class="row justify-content-center ">
  <div class="col-lg-8 ">
            <div class="container-fluid">
                        <form class="" action="index.html" method="post">
                              <div class="row">
                                  <div class="col-md-6">
                                          <div class="form-group">
                                                <button type="submit"  class="btn btn-danger " name="bulk-buttin">DELETE</button>
                                          </div>
                                  </div>
                                  <div class="col-md-6">

                                                              <div class="form-group">
                                                                <div class="custom-file">
     <input type="file" class="custom-file-input" id="customFile">
     <label class="custom-file-label" for="customFile">Attachment File</label>
   </div>
                                                              </div>
                                  </div>
                              </div>
                          <div class="card">
                              <div class="card-header bg-warning">
                                    <div class="card-title">
                                          File Uploads
                                    </div>
                              </div>

                              <table class="table table-bordered text-center">
                                      <thead>
                                        <tr>
                                          <th>File Name</th>
                                          <th>Type</th>
                                          <th>Date</th>
                                          <th>Action</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <tr>
                                          <td>fiele.csv</td>
                                          <td>csv file</td>
                                          <td>02/14/12</td>
                                          <td>  <a href="#"><i class="fas fa-plus-circle"></i> </a>  | <a href="#"><i class="far fa-trash-alt"></i></a>  </td>
                                        </tr>
                                        <tr>
                                          <td>fiel2.csv</td>
                                          <td>csv file</td>
                                          <td>02/14/12</td>
                                          <td>  <a href="#"><i class="fas fa-plus-circle"></i> </a>  | <a href="#"><i class="far fa-trash-alt"></i></a>  </td>
                                        </tr>
                                        <tr>
                                          <td>fiel3.csv</td>
                                          <td>csv file</td>
                                          <td>02/14/12</td>
                                          <td>  <a href="#"><i class="fas fa-plus-circle"></i> </a>  | <a href="#"><i class="far fa-trash-alt"></i></a>  </td>
                                        </tr>
                                        <tr>
                                          <td>fiel4.csv</td>
                                          <td>csv file</td>
                                          <td>02/14/12</td>
                                          <td>  <a href="#"><i class="fas fa-plus-circle"></i> </a>  | <a href="#"><i class="far fa-trash-alt"></i></a>  </td>
                                        </tr>
                                      </tbody>
                              </table>
                              <div class="card-footer bg-warning">

                              </div>
                          </div>
                        </form>
            </div>
  </div>
</div>
        </div>
    </div>
</div>
