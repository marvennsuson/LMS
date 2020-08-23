<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
<div class="row">
<div class="col-12">
<div class="card p-3">
<form  id="composeMessage"  action="<?= site_url('message/Messages/SendMessageStudent');?>" method="post">
  <div class="form-group" id="prefetch">
    <div class="ui-widget">
          <input  id="sendto" type="text" class="form-control col-sm-12 " placeholder="To:" value="" name="sendto[]">
        </div>
  </div>
<div class="form-group mb-2">
   <span style="color:red"><?= form_error('message_title');  ?></span>
<input type="text" class="form-control col-sm-12" name="message_title" value="<?=  set_value('message_title'); ?>" placeholder="Your'e Title">
</div>
<div class="form-group">
<span style="color:red"><?= form_error('message_text');  ?></span>
<textarea id="fortextarea" name="message_text" class="form-control" rows="8" cols="80" placeholder="Message Here!!"><?=  set_value('message_text'); ?></textarea>
</div>
<div class="d-flex justify-content-end clearfix">
<button type="submit" class="btn btn-md btn-success" ><i style="font-size:14px" class="far fa-paper-plane"></i>&nbsp;&nbsp;Send</button>
</div>

</div>
</div>

</form>


</div>
<script src="<?= base_url('public/plugins/summernote/summernote-bs4.min.js');?>"></script>
<script type="text/javascript">

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
           url:"<?php echo base_url(); ?>message/Messages/fetchStudent",
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

  $(function () {
    // Summernote
    $('#fortextarea').summernote({
       height: 300,
    });
  })



  $('#composeMessage').submit(function(e){

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
                      timer: 3000,
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
                                  title: 'Succesfully Sent!',
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


</script>
