<table class="table table-sm">
    <thead>
    <tr>
        <th>Type</th>
        <th>Test Title</th>
        <th>Date</th>
        <th>Status</th>
        <th>Score</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
        <?php if($exam_lists_quiz):?>
            <?php foreach($exam_lists_quiz as $elq):?>
                <tr>
                    <td><?= $elq['type']?></td>
                    <td><?= $elq['exam_title']?></td>
                    <td><?= $elq['exam_title']?></td>
                    <td><?= $elq['exam_title']?></td>
                    <td><?= $elq['exam_title']?></td>
                    <td>
                        <!-- <a href="<?=base_url('exam/student_browse_exam/'.$elq['joined_header_body_id'])?>" id="btn_take_quiz<?php echo $elq['joined_header_body_id']?>" onclick="return !window.open(this.href, 'NVAC Online Quiz', 'width=1000,height=800')" target="_blank"><button type="button" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i> Take Quiz</button></a> -->
                        <a id="btn_take_quiz<?php echo $elq['joined_header_body_id']?>"><button type="button" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i> Take Test</button></a>
                    </td>
                </tr>
                <script>
                    $('#btn_take_quiz<?php echo $elq['joined_header_body_id']?>').on('click', function(e){
                        e.preventDefault();
                        $('.overlay').css('visibility', 'visible');
                        Swal.fire({
                            title: 'Are you sure you want to take the test ?',
                            text: '<?= $elq['instruction']?>',
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: 'Yes, take the test!'
                        }).then((result) => {
                            if (result.value == true) {
                                window.open("<?=base_url('exam/student_browse_exam/'.$elq['joined_header_body_id'])?>", 'NVAC Online Quiz', 'width=1000,height=800');
                            }
                            $('.overlay').css('visibility', 'hidden');
                        })
                    });
                </script>
            <?php endforeach;?>
        <?php else:?>
            <p>No quiz available.</p>
        <?php endif;?>
    </tbody>
</table>
