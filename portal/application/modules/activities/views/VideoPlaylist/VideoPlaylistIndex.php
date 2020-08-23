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
                    <h1 class="m-0 text-dark">Playlist Board</h1>
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


<div class="card card-outline card-warning">
  <div class="card-header">
    <h3 class="card-title">Virtual lesson</h3>

    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
      </button>
    </div>

  </div>
  <div class="card-body">

                 <div class="row">
                   <div class="col-lg-12 ">
                     <nav>
                       <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                     <?php foreach ($Subjectplaylist as $Subjectplaylist_row):
                                          $row
                                        ?>
                         <a class="nav-item nav-link tablinks " id="nav-<?= $Subjectplaylist_row->id ?>-tab" data-toggle="tab" href="#nav-<?= $Subjectplaylist_row->id ?>" role="tab" aria-controls="nav-<?= $Subjectplaylist_row->id ?>" aria-selected="true" data-value="<?= $Subjectplaylist_row->subjectcode ?>"><?= $Subjectplaylist_row->subject_name ?></a>
                             <?php endforeach; ?>
                       </div>
                     </nav>
                     <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">

                         <table id="table_id" class="table  table-striped">
                           <thead>
                             <tr>
                               <th>Lesson Number</th>
                                 <th>Lesson Topic</th>
                                 <th>Teacher Name</th>
                                   <th>Subject</th>
                                   <th>Youtube link</th>
                                   <th>Date Created</th>
                                   <th>action</th>
                             </tr>

                           </thead>
                           <tbody id="StudList">


                           </tbody>
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


<script type="text/javascript">

$(document).ready(function() {

    $('.tablinks').click(function() {
      var Dataform  = $(this).data("value");

          if(Dataform){
              $.ajax({
                  type:'POST',
                  url:'<?= site_url('activities/GetPlaylist');?>',
                  data:'Subcode='+Dataform,
                  success:function(data){
                      $('#overlay4').css('visibility', 'hidden');
                         $('#StudList').html('');
                      var dataObj = jQuery.parseJSON(data);
                      if(dataObj){
                          $(dataObj).each(function(){

                            $('#StudList').append('<tr><td>#'+this.lesson_number +'</td><td>'+ this.lesson_topic+'</td><td>'+ this.name+'</td><td>'+this.subject_name+'</td><td>'+ this.youtube_link+'</td><td>'+ this.created_at +'</td><td>  <button type="button" class="btn btn-warning" id="'+this.id+'" onClick="reply_click(this.id)">Open</button></td></tr>');
                          });
                      }else{
                       $('#StudList').html('<tr><td colspan="7"><center>No Available Data</td></tr>');
                      }

                  }

              });
          }else{
            alert();
          }


    });
});
function reply_click(clicked_id)
{

if(clicked_id){

  $.ajax({
      url: "<?=site_url('activities/Activities/Getlesson')?>",
      data:{ lessonID : clicked_id },
      type: "post",

      success: function(data)
      {

          // $('.overlay').css('visibility', 'hidden');
          $("#Modaldata").modal('show');
          // var dataObj = jQuery.parseJSON(data);
          $("#innerModal").html(data);
          
          // var dataObj = jQuery.parseJSON(data);
          // $.each(dataObj,function(i, item){
          //     $("#headerModal").append('<strong>'+ item.lesson_number +'</strong>');
          //   $('#innerModal').append('<div class="embed-responsive embed-responsive-16by9"><iframe id="videoframe" class="embed-responsive-item" src="'+ item.youtube_link+'" allowfullscreen></iframe></div>');
          // });
          // var dataObj = jQuery.parseJSON(data);
          // if(dataObj){
          //     $(dataObj).each(function(i, item){
          //         $("#headerModal").append('<strong>'+ this.lesson_number +'</strong>');
          //       $('#innerModal').append('<div class="embed-responsive embed-responsive-16by9"><iframe id="videoframe" class="embed-responsive-item" src="'+ this.youtube_link+'" allowfullscreen></iframe></div>');
          //     });
          // }else{
          //  $('#innerModal').html('<tr><td colspan="7"><center>No Available Data</td></tr>');
          // }
      }
  })
}


}




$(function() {
  var $tabButtonItem = $('#tab-button li'),
      $tabSelect = $('#tab-select'),
      $tabContents = $('.tab-contents'),
      activeClass = 'is-active';

  $tabButtonItem.first().addClass(activeClass);
  $tabContents.not(':first').hide();

  $tabButtonItem.find('a').on('click', function(e) {
    var target = $(this).attr('href');

    $tabButtonItem.removeClass(activeClass);
    $(this).parent().addClass(activeClass);
    $tabSelect.val(target);
    $tabContents.hide();
    $(target).show();
    e.preventDefault();
  });

  $tabSelect.on('change', function() {
    var target = $(this).val(),
        targetSelectNum = $(this).prop('selectedIndex');

    $tabButtonItem.removeClass(activeClass);
    $tabButtonItem.eq(targetSelectNum).addClass(activeClass);
    $tabContents.hide();
    $(target).show();
  });
});
</script>
<!-- The Modal -->
<div class="modal fade" id="Modaldata">
  <div class="modal-dialog modal-dialog modal-xl modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" >

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title" id="headerModal"></h4>
        <button type="button" class="close" data-dismiss="modal">×</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" id="innerModal">

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> -->
      </div>

    </div>
  </div>
</div>
