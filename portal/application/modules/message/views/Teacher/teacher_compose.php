<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">

<div class="row">
      <div class="col-md-9">
                    <form class="" id="Composeform" action="<?= site_url('message/Messages/CreateMessage_teacher');?>" method="post">
  <div class="card card-primary card-outline">
    <div class="card-header">
      <h3 class="card-title">Compose New Message</h3>
    </div>

    <div class="card-body">
      <div class="form-group" id="prefetch">
        <div class="ui-widget">
              <input  id="sendto" type="text" class="form-control col-sm-12 " placeholder="To:" value="" name="sendto[]">
            </div>
      </div>
      <div class="form-group">
    <span style="color:red;"><?= form_error('texttitle');?> </span>
<input type="text" class="form-control  col-sm-12 " name="texttitle" value="<?= set_value('texttitle'); ?>" placeholder="Subject:">
      </div>
      <div class="form-group"><span style="color:red;"><?= form_error('textmessage');?> </span>
            <textarea id="fortextarea" name="textmessage" class="form-control" rows="8" cols="80" placeholder="Message Here!!"><?= set_value('textmessage'); ?></textarea>
      </div>
    </div>
    <div class="card-footer">
      <div class="float-right">
        <button type="submit" class="btn btn-primary btn-flat btn-md"><i class="far fa-envelope"></i> Send</button>
      </div>
    </div>
  </div>

        <div id="overlay1" class="overlay" style="visibility: hidden;">
              <i class="fas fa-2x fa-sync-alt fa-spin"></i>
          </div>
      </div>
      <div class="col-md-3">

      <div class="card">
            <div class="card-title bg-dark">
             <strong class="h-6 ml-4"> Other Options </strong>
            </div>
            <div class="card-body p-4">
                  <div class="row">


                          <div class="form-group">
                                <label for=""> Select By Subject</label>
                                <select id="bySubcode"   name="bySubcode" class="custom-select custom-select-sm">
                                  <option selected disabled> Select By Subject</option>
                                  <?php if ($SubjectCodelist->num_rows() > 0): ?>
                                      <?php foreach ($SubjectCodelist->result() as $SubjectCodelist_row): ?>
                                          <option value="<?= $SubjectCodelist_row->subjectcode; ?>"><?= $SubjectCodelist_row->subject_name; ?></option>
                                      <?php endforeach; ?>
                                  <?php else:
                                      echo "Null";
                                   endif; ?>
                                </select>
                          </div>

                  </div>
              <div id="" style="overflow-y:scroll; overflow-x:hidden; height:400px;">
                <div  id="Byclasssubj" class="list-group list-group-flush">
                            <?= form_error('BySubcodelist');?>

                  </div>
              </div>
            </div>
            <!-- <div id="overlay3" class="overlay" style="visibility: hidden;">
              <i class="fas fa-2x fa-sync-alt fa-spin"></i>
          </div> -->

      </div>

    </form>
      </div>
</div>
<script src="<?= base_url('public/plugins/summernote/summernote-bs4.min.js');?>"></script>
<script type="text/javascript">
$(function () {
  // Summernote
  $('#fortextarea').summernote({
     height: 300,

  }).css('position', 'fixed');

});
$(document).ready(function(){

  $("#sendto").keyup(function(){
  $('#bySubcode').attr("disabled", "disabled");
});

})
$(function () {
    $("#bySubcode").change(function () {
        if ($("#bySubcode").val() == 0) {
            $("#sendto").removeAttr("disabled");
            $("#sendto").focus();
        } else {
            $("#sendto").attr("disabled", "disabled");
        }


    });

});

$('#Composeform').submit(function(e){

e.preventDefault();
 var fa = $(this);

  $.ajax({
    url: fa.attr('action'),
    type: 'post' ,
    data: fa.serialize(),
    // dataType: 'json',
    success: function(data) {
        if(data.response != "false"){
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            onOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
          })

          Toast.fire({
            icon: 'success',
            title: 'Sending Data'
          }).then((result) => {

                  if (result.dismiss === Swal.DismissReason.timer) {

                    Swal.fire({
                        title: 'Succesfully sent!',
                        type: 'success',
                        showConfirmButton: false,
                        timer: 2000
                    }).then((result) =>{

                      if(result.dismiss === Swal.DismissReason.timer){
                            window.location.href='<?= current_url(); ?>';
                      }

                    });

                  }
              });



        }
    }

 });


});




  $( function() {
    function split( val ) {
      return val.split( /,\s*/ );
    }
    function extractLast( term ) {
      return split( term ).pop();
    }
      // $( "#sendto" ).on( "keydown", function( event ) {
      //
      //   // if ( event.keyCode === $.ui.keyCode.TAB &&
      //   //     $( this ).autocomplete( "instance" ).menu.active ) {
      //   //   event.preventDefault();
      //   // }
      // })
    $( "#sendto" ).autocomplete({

        minLength: 0,
        source: function( request, response ) {
        var searchText = extractLast(request.term);
          $.ajax({
           url:"<?php echo base_url(); ?>message/Messages/fetch",
           method:"POST",
           data:{query:searchText},
           dataType:"json",
           success:function(data)
           {
             // response( $.ui.autocomplete.filter(data, extractLast( request.term ) ) );
            // result($.map(data, function(item){
            //  return item;
            // }));
            response(data);
           }
          })


        },
        focus: function() {
          // prevent value inserted on focus
          return false;
        },
        select: function( event, ui ) {
          var terms = split( this.value );
          // remove the current input
          terms.pop();
          // add the selected item
          terms.push( ui.item.value );
          // add placeholder to get the comma-and-space at the end
          terms.push( "" );
          this.value = terms.join( "," );
          return false;
        }
      });
  } );
</script>
