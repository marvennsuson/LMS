<?php if ($Studentlist->num_rows() > 0): ?>


        <thead>
          <tr>
            <th>Avatar</th>
                <th>Student Number</th>
                    <th>Full Name</th>
                        <th>Schedule</th>
                            <th>Section</th>
          </tr>
        </thead>
        <tbody>
            <?php foreach ($Studentlist->result() as $Studentlist_row): ?>
          <tr>
            <td>Comming Soon</td>
            <td><?= $Studentlist_row->student_number ?></td>
            <td><?= htmlentities( ucfirst($Studentlist_row->lastname). ',' . ucfirst($Studentlist_row->firstname) .''. ucfirst($Studentlist_row->middlename) ); ?></td>
            <td><?= $Studentlist_row->section ?></td>
            <td><?= $Studentlist_row->schedule ?></td>
          </tr>
            <?php endforeach; ?>
        </tbody>


<?php endif; ?>
<script type="text/javascript">
$(document).ready(function(){
      $('#searched_table').DataTable();
});
</script>
