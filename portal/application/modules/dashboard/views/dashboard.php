            <title><?= $title;?></title>
            <div class="content-wrapper">
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 text-dark">Notification Board</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
                                    <li class="breadcrumb-item active">Dashboard</li>
                                    <li class="breadcrumb-item active"><a href="<?= current_url();?>">Notification Board</a></li>
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
                                    <div class="card-header bNotification-transparent">
                                        <h3 class="card-title">Latest Notifications</h3>

                                        <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                        <table class="table m-0">
                                            <thead>
                                            <tr>
                                            <th>Notification ID</th>
                                            <th>Title</th>
                                            <th>Status</th>
                                            <th>Popularity</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                            <td><a href="pages/examples/invoice.html">OR9842</a></td>
                                            <td>Notification 1</td>
                                            <td><span class="badge badge-success">On Going</span></td>
                                            <td>
                                                <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td><a href="pages/examples/invoice.html">OR1848</a></td>
                                            <td>Notification 2</td>
                                            <td><span class="badge badge-warning">Pending</span></td>
                                            <td>
                                                <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td><a href="pages/examples/invoice.html">OR7429</a></td>
                                            <td>Notification 3</td>
                                            <td><span class="badge badge-danger">On Going</span></td>
                                            <td>
                                                <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td><a href="pages/examples/invoice.html">OR7429</a></td>
                                            <td>Notification 2</td>
                                            <td><span class="badge badge-info">Processing</span></td>
                                            <td>
                                                <div class="sparkbar" data-color="#00c0ef" data-height="20">90,80,-90,70,-61,83,63</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td><a href="pages/examples/invoice.html">OR1848</a></td>
                                            <td>Notification 2</td>
                                            <td><span class="badge badge-warning">Pending</span></td>
                                            <td>
                                                <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td><a href="pages/examples/invoice.html">OR7429</a></td>
                                            <td>Notification 3</td>
                                            <td><span class="badge badge-danger">On Going</span></td>
                                            <td>
                                                <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td><a href="pages/examples/invoice.html">OR9842</a></td>
                                            <td>Notification 1</td>
                                            <td><span class="badge badge-success">On Going</span></td>
                                            <td>
                                                <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>
                                            </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        </div>
                                        <!-- /.table-responsive -->
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer clearfix">
                                        <a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Place New Notification</a>
                                        <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-right">View All Notifications</a>
                                    </div>
                                    <!-- /.card-footer -->
                                    </div>

                            </div>

                            <div class="col-lg-4">
                                <!-- PRODUCT LIST -->
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Recently Added Notification</h3>

                                        <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body p-0">
                                        <ul class="products-list product-list-in-card pl-2 pr-2">
                                        <li class="item">
                                            <div class="product-img">
                                            <img src="<?= base_url('public/dist/img/default-150x150.png');?>" alt="Product Image" class="img-size-50">
                                            </div>
                                            <div class="product-info">
                                            <a href="javascript:void(0)" class="product-title">Notif 1
                                                <span class="badge badge-warning float-right">Pending</span></a>
                                            <span class="product-description">
                                                Notif Description 1
                                            </span>
                                            </div>
                                        </li>
                                        <!-- /.item -->
                                        <li class="item">
                                            <div class="product-img">
                                            <img src="<?= base_url('public/dist/img/default-150x150.png');?>" alt="Product Image" class="img-size-50">
                                            </div>
                                            <div class="product-info">
                                            <a href="javascript:void(0)" class="product-title">Notif 2
                                                <span class="badge badge-info float-right">Pending</span></a>
                                            <span class="product-description">
                                                On going
                                            </span>
                                            </div>
                                        </li>
                                        <!-- /.item -->
                                        <li class="item">
                                            <div class="product-img">
                                            <img src="<?= base_url('public/dist/img/default-150x150.png');?>" alt="Product Image" class="img-size-50">
                                            </div>
                                            <div class="product-info">
                                            <a href="javascript:void(0)" class="product-title">
                                                Notif 3 <span class="badge badge-danger float-right">
                                                Pending
                                            </span>
                                            </a>
                                            <span class="product-description">
                                                Notif Description 3
                                            </span>
                                            </div>
                                        </li>
                                        <!-- /.item -->
                                        <li class="item">
                                            <div class="product-img">
                                            <img src="<?= base_url('public/dist/img/default-150x150.png');?>" alt="Product Image" class="img-size-50">
                                            </div>
                                            <div class="product-info">
                                            <a href="javascript:void(0)" class="product-title">Notif 4
                                                <span class="badge badge-success float-right">On going</span></a>
                                            <span class="product-description">
                                                Notif Description 4
                                            </span>
                                            </div>
                                        </li>
                                        <!-- /.item -->
                                        </ul>
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer text-center">
                                        <a href="javascript:void(0)" class="uppercase">View All Notifications</a>
                                    </div>
                                    
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


            
