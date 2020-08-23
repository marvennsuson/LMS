<link rel="stylesheet" href="<?= base_url('public/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')?>">
<div class="content">
    <form id="form_add_school_fees">
        <div class="container-fluid">
            <div class ="row">
                <div class="justify-content-center mx-auto ">
                    <div class="input-group mb-3">
                            <div class="input-group-prepend">
                        <label for="input_student_search" class="input-group-text">Student Search:</label>
                      </div>
                        <input type="text" class="form-control"  name="input_student_search" id="input_student_search">
                        <span class="input-group-append">
                            <button type="button" class="btn bg-gradient-primary" id = "btn_student_search"><i class="fas fa-search"></i></button>
                        </span>
                    </div>
                      <p style="font-size:12px;">by student type college/high school/elem or by level grade 1-12/ college 1-4</p>
                    <hr>
                </div>
            </div>

            <div class = "row">
                <div class = "col-12 col-md-12 col-lg-12">
                    <div id="div_student_search_response">

                    </div>
                </div>
            </div>

            <div class ="row">
                <div class="col-12" id="search_tip">
                    <p class="text-center">Search for student</p>
                </div>
            </div>

            <hr>

            <div class = "row">
                <div class="col-lg-12">
                    <label for="file">Bill PDF file</label>
                    <input type="file" name="userfile" id="">
                    
                </div>
                <hr>
            </div>

            <div class = "row">
                <div class="col-lg-12">
                    <label for="text_description">Description</label>
                    <textarea class="form-control" style="resize:none" name="text_description" id="text_description" cols="30" rows="5"></textarea>
                    <hr>
                </div>
                <hr>
            </div>
           
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>
<script src="<?= base_url('public/plugins/moment/moment.min.js')?>"></script>
<script src="<?= base_url('public/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')?>"></script>
<script>
    $('#form_add_school_fees').submit(function(e){
        e.preventDefault();
        $('#overlay_add_school_fees > .overlay').css('visibility', 'visible');
        
        var addSchoolFee = new FormData($(this)[0]);
        $.ajax({
            url: "<?=site_url('school_fees/add_school_fees')?>",
            data: addSchoolFee,
            dataType: "json",
            type: "post",
            async: false,
            success: function(data)
            {
                if(data.response == "false") {
                    $('#overlay_add_school_fees > .overlay').css('visibility', 'hidden');
                    Swal.fire({
                        html: data.message,
                        type: 'error',
                    })
                } else {
                    $("#reg_select_classcode").val('');
                    $('#overlay_add_school_fees > .overlay').css('visibility', 'hidden');
                    Swal.fire({
                        title: 'Bill Added!',
                        type: 'success',
                    }).then((result) => {
                        location.reload();
                    })
                }
            },
            contentType: false,
            cache: false,
            processData: false,
        });
    });
    $('#btn_student_search').click(function(){
        var searchdata = $("#input_student_search").val();
        if (searchdata) {
            $('#overlay_add_school_fees > .overlay').css('visibility', 'visible');
            $.ajax({
                url: "<?=site_url('school_fees/search_student')?>",
                data: {
                    searchItem: searchdata
                },
                type: "post",
                success: function (data) {
                    $('#overlay_add_school_fees > .overlay').css('visibility', 'hidden');
                    $('#search_tip').remove();
                    // $("#student_edit").modal('show');
                    $("#div_student_search_response").html(data);
                }
            })
        }else{
            $('#overlay_add_school_fees > .overlay').css('visibility', 'hidden');
        }
    });
</script>