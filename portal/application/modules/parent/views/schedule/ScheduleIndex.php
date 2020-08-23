<style >
.panel_data{
  background-color: #66d5cc;
  width: auto 100%;

}
.panel_header{
  margin-top: 0;
  margin-left: 5px;
  margin-right: 5px;
margin-bottom: 0;
  background-color: white;
  padding: 25px;
}
.title-header > h2{
  text-transform:uppercase;
  font-size: 40px;
  font-weight: 500;
  text-decoration: none;
}
.title-header > small{
  text-transform:uppercase;
  font-size: 20px;
  font-weight: 300;
  text-decoration: none;
}
.panel_notes{
    padding: 10px 10px 10px 20px;
  background-color: #b1e9e5;
  border: 2px solid #00d9e1;

}
.table_paneel{
  margin-left: 30px;
  margin-right: 30px;
}
table.table-bordered{
    border:6px solid  #66d5cc;
    margin-top:20px;
  }
table.table-bordered > thead > tr > th{
    border: 0px solid  #66d5cc;
    background: white;
    color:#02342b;

}
table.table-bordered > tbody > tr > td{
    border:6px solid  #66d5cc;
    background: white;
    color:#02342b;
}
</style>
<title><?= $title;?></title>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Schedule Board</h1>
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
        <div class="container-fluid">
          <div class="container-fluid">
                  <div class="panel_data card">
                      <div class="panel_header mt-5 ">
                          <div class="row ">
                              <div class="col-7">
                                <div class="title-header text-center">
                                    <h2>Class 4 Schedule</h2>
                                    <small>Schedule For 2020-20201</small>
                                </div>
                              </div>
                              <div class="col-5">
                                  <div class="">
                                      <div class="panel_notes">
                                        <h5>Notes:</h5>
                                      </div>
                                  </div>
                              </div>
                          </div>

                      </div>
                      <div class="table_paneel mt-5 mb-5">
                          <table class=" table table-bordered">
                            <thead class="text-white">
                              <tr class="text-center h6">
                                  <th>Subject Name</th>
                                  <th>Schedule</th>
                                  <th>Section</th>
                                  <th>Instrutor</th>

                              </tr>
                            </thead>
                            <tbody>

                              <tr>
                                <td>MATH 1</td>
                                <td>1:30 - 3:30 PM MWT</td>
                                <td>Section A</td>
                                <td>Ramil b. Proyalde</td>
                              </tr>
                              <tr>
                                <td>ENGLISH 1</td>
                                <td>8:30 - 10:30 PM MWF</td>
                                <td>Section A</td>
                                <td>Ramil Gutana</td>
                              </tr>

                              <tr>
                                <td>SCIENCE 1</td>
                                <td>5:30 - 7:30 PM TTS</td>
                                <td>Section A</td>
                                <td>Marilyn Viernes</td>
                              </tr>

                              <tr>
                                <td>FILIPINO 1</td>
                                <td>2:30 - 4:00 PM TWF</td>
                                <td>Section A</td>
                                <td>Roniel Pame</td>
                              </tr>

                              <tr>
                                <td>MAPEH 1</td>
                                <td>10:30 - 1:30 AM MWF</td>
                                <td>Section A</td>
                                <td>Marvenn Suson</td>
                              </tr>

                              <tr>
                                <td>ARALIN PANLIPUNAN 1</td>
                                <td>7:30 - 9:30 AM MF</td>
                                <td>Section A</td>
                                <td>Joseph C Catalina</td>
                              </tr>


                            </tbody>
                          </table>
                      </div>
                  </div>
          </div>
        </div>
    </div>
</div>
