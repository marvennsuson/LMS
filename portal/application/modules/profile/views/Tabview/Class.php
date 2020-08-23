
<div class="card">
  <div class="card-header bg-primary">
      <div class="card-title">
          My Class
      </div>
    </div>
      <div class="card-body">
        <div class="row">
          <div class="col-lg-12 ">
            <nav>
              <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                            <?php foreach ($subjectlist as $subjectlist_row):?>
                <a class="nav-item nav-link tablinks " id="nav-<?= $subjectlist_row->id ?>-tab" data-toggle="tab" href="#nav-<?= $subjectlist_row->id ?>" role="tab" aria-controls="nav-<?= $subjectlist_row->id ?>" aria-selected="true" data-value="<?= $subjectlist_row->subjectcode ?>"><?= $subjectlist_row->subject_name ?></a>
                    <?php endforeach; ?>
              </div>
            </nav>
            <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
              <div class="card-body table-responsive p-0" id="div_searched_table">
                  <table class="table table-hover table-sm table-striped table-head-fixed text-nowrap" id="searched_table">

                  </table>
              </div>
            </div>

          </div>
        </div>
      </div>

</div>
<script type="text/javascript">

$('.tablinks').click(function() {
  var Dataform  = $(this).data("value");

    $.ajax({
        url: "<?=site_url('profile/Profiles/getListRegister')?>",
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
