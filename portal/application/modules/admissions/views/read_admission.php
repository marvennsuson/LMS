<?php if($admission_details):?>
    <?php foreach( $admission_details as $ad):?>
        <section class="content">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12 order-2 order-md-1">
                    <div class="mb-3">
                        <p style="margin-bottom: 0;"><strong>Name:</strong> <?= strtoupper($ad['lastname']);?>, <?= strtoupper($ad['firstname']);?> <?= strtoupper($ad['middlename']);?></p>
                        <small><strong>Date Filed:</strong> <?= $ad['date_filed'];?> </small>
                    </div>
                    <table class="table table-hover table-head-fixed text-nowrap">
                        <thead>
                            <tr>
                                <th>Field</th>
                                <th>Info</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Student Type</strong></td>
                                <td><?= strtoupper($ad['student_type']);?></td>
                            </tr>
                            <tr>
                                <td><strong>Grade</strong></td>
                                <td><?= strtoupper($ad['grade']);?></td>
                            </tr>
                            <?php if($ad['student_type'] == 'senior high'):?>
                                <tr>
                                    <td><strong>Strand</strong></td>
                                    <td><?= $ad['strand'];?></td>
                                </tr>
                            <?php elseif($ad['student_type'] == 'college'):?>
                                <tr>
                                    <td><strong>Strand</strong></td>
                                    <td><?= strtoupper($ad['course']);?></td>
                                </tr>
                                <tr>
                                    <td><strong>Term</strong></td>
                                    <td><?= $ad['term'];?></td>
                                </tr>
                            <?php endif;?>
                            <tr>
                                <td><strong>Birth Date</strong></td>
                                <td><?= strtoupper(date('F d, Y', strtotime($ad['birthdate'])));?></td>
                            </tr>
                            <tr>
                                <td><strong>Birth Place</strong></td>
                                <td><?= strtoupper($ad['birthplace']);?></td>
                            </tr>
                            <tr>
                                <td><strong>Sex</strong></td>
                                <td><?= strtoupper($ad['sex']);?></td>
                            </tr>
                            <tr>
                                <td><strong>Nationality</strong></td>
                                <td><?= strtoupper($ad['nationality']);?></td>
                            </tr>
                            <tr>
                                <td><strong>Weight</strong></td>
                                <td><?= strtoupper($ad['weight']);?></td>
                            </tr>
                            <tr>
                                <td><strong>Height</strong></td>
                                <td><?= strtoupper($ad['height']);?></td>
                            </tr>
                            <tr>
                                <td><strong>Health Condition</strong></td>
                                <td><?= strtoupper($ad['healthcondition']);?></td>
                            </tr>
                            <tr>
                                <td><strong>Address</strong></td>
                                <td><?= strtoupper($ad['address']);?></td>
                            </tr>
                            <tr>
                                <td><strong>Telephone</strong></td>
                                <td><?= strtoupper($ad['telephone']);?></td>
                            </tr>
                            <tr>
                                <td><strong>Cellphone</strong></td>
                                <td><?= strtoupper($ad['cellphone']);?></td>
                            </tr>
                            <tr>
                                <td><strong>Email</strong></td>
                                <td><?= strtoupper($ad['email']);?></td>
                            </tr>
                            <tr>
                                <td><strong>Religion</strong></td>
                                <td><?= strtoupper($ad['religion']);?></td>
                            </tr>
                            <tr>
                                <td><strong>Church Membership</strong></td>
                                <td><?= strtoupper($ad['churchmembership']);?></td>
                            </tr>
                            <tr>
                                <td><strong>Mission/Conference</strong></td>
                                <td><?= strtoupper($ad['missionconference']);?></td>
                            </tr>
                            <tr>
                                <td><strong>Baptism Date</strong></td>
                                <td><?= strtoupper($ad['baptismdate']);?></td>
                            </tr>
                            <tr>
                                <td><strong>Last School Attended</strong></td>
                                <td><?= strtoupper($ad['schoolattended']);?></td>
                            </tr>
                            <tr>
                                <td><strong>Grade on Last School Attended</strong></td>
                                <td><?= strtoupper($ad['sex']);?></td>
                            </tr>
                            <tr>
                                <td><strong>Year Attended</strong></td>
                                <td><?= strtoupper($ad['yearattended']);?></td>
                            </tr>
                            <tr>
                                <td><strong>Address of Last School Attended</strong></td>
                                <td><?= strtoupper($ad['schooladdress']);?></td>
                            </tr>
                            <tr>
                                <td><strong>Honors</strong></td>
                                <td><?= strtoupper($ad['honors']);?></td>
                            </tr>
                            <tr>
                                <td><strong>Awards</strong></td>
                                <td><?= strtoupper($ad['awards']);?></td>
                            </tr>
                            <tr>
                                <td><strong>General Average</strong></td>
                                <td><?= strtoupper($ad['genave']);?></td>
                            </tr>
                            <tr>
                                <td><strong>Father's Name</strong></td>
                                <td><?= strtoupper($ad['fathersname']);?></td>
                            </tr>
                            <tr>
                                <td><strong>Father's Occupation</strong></td>
                                <td><?= strtoupper($ad['fathersoccupation']);?></td>
                            </tr>
                            <tr>
                                <td><strong>Father's Religion</strong></td>
                                <td><?= strtoupper($ad['fathersreligion']);?></td>
                            </tr>
                            <tr>
                                <td><strong>Father's Religion</strong></td>
                                <td><?= strtoupper($ad['fathersaddress']);?></td>
                            </tr>
                            <tr>
                                <td><strong>Mother's Name</strong></td>
                                <td><?= strtoupper($ad['mothersname']);?></td>
                            </tr>
                            <tr>
                                <td><strong>Mother's Occupation</strong></td>
                                <td><?= strtoupper($ad['mothersoccupation']);?></td>
                            </tr>
                            <tr>
                                <td><strong>Mother's Religion</strong></td>
                                <td><?= strtoupper($ad['mothersreligion']);?></td>
                            </tr>
                            <tr>
                                <td><strong>Mother's Address</strong></td>
                                <td><?= strtoupper($ad['mothersaddress']);?></td>
                            </tr>
                            <tr>
                                <td><strong>Number of Family Members</strong></td>
                                <td><?= strtoupper($ad['familycount']);?></td>
                            </tr>
                            <tr>
                                <td><strong>Brothers</strong></td>
                                <td><?= strtoupper($ad['brothers']);?></td>
                            </tr>
                            <tr>
                                <td><strong>Sisters</strong></td>
                                <td><?= strtoupper($ad['sisters']);?></td>
                            </tr>
                            <tr>
                                <td><strong>Annual Family Income</strong></td>
                                <td><?= strtoupper($ad['annualfamilyincome']);?></td>
                            </tr>
                            <tr>
                                <td><strong>Are your parents willing that you attend NVAC?</strong></td>
                                <td><?= strtoupper($ad['willingness']);?></td>
                            </tr>
                            <tr>
                                <td><strong>Who encouraged you to enroll at NVAC?</strong></td>
                                <td><?= strtoupper($ad['whoencourage']);?></td>
                            </tr>
                            <tr>
                                <td><strong>Person responsible for your school account</strong></td>
                                <td><?= strtoupper($ad['personresponsible']);?></td>
                            </tr>
                            <tr>
                                <td><strong>Address (if other than parents)</strong></td>
                                <td><?= strtoupper($ad['personresponsibleaddress']);?></td>
                            </tr>
                            <tr>
                                <td><strong>Plan to stay in Dormitory?</strong></td>
                                <td><?= strtoupper($ad['dormitory']);?></td>
                            </tr>
                            <tr>
                                <td><strong>If not, where and whom?</strong></td>
                                <td><?= strtoupper($ad['whereandwhom']);?></td>
                            </tr>
                            <tr>
                                <td><strong>Relationship</strong></td>
                                <td><?= strtoupper($ad['relationship']);?></td>
                            </tr>
                            <tr>
                                <td><strong>Why NVAC?</strong></td>
                                <td><?= strtoupper($ad['whynvac']);?></td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    <?php endforeach;?>
<?php else:?>
    <h1>No Admission Available.</h1>
<?php endif;?>