    <title><?= $title; ?></title>
    <section class="ftco-section contact-section ftco-degree-bg">
        <div class="container">
            <h4 class="mb-4">Fill up these forms</h4>
            <form id="form_admission">
                <div class="row block-9">
                    <div class="col-md-4 pr-md-5">
                        <div class="form-group">
                            <label for="select_student">Student type</label>
                            <select class="form-control inputDado" name="select_student" id="select_student">
                                <option selected disabled></option>
                                <option value="elementary">Elementary</option>
                                <option value="junior high">Junior High</option>
                                <option value="senior high">Senior High</option>
                                <option value="college">College</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 pr-md-5">
                        <div class="form-group">
                            <label for="input_date ">Date Filed</label>
                            <input type="text" class="form-control inputDado" id="input_date" name="input_date" value="<?= date("Y-m-d");?>" readonly>
                        </div>
                    </div>
                </div>
                <div class="row block-9">
                    <div class="col-md-4 pr-md-5" id="div_elem" style="display: none;">
                        <div class="form-group">
                            <label for="select_grade">Grade</label>
                            <select class="form-control inputDado" name="select_grade" id="select_grade">
                                <option selected disabled></option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4 pr-md-5" id="div_hs" style="display: none;">
                        <div class="form-group">
                            <label for="select_grade">Grade</label>
                            <select class="form-control inputDado" name="select_grade" id="select_grade">
                                <option selected disabled></option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4 pr-md-5" id="div_shs" style="display: none;">
                        <div class="form-group">
                            <label for="select_grade">Grade</label>
                            <select class="form-control inputDado" name="select_grade" id="select_grade">
                                <option selected disabled></option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 pr-md-5" id="div_academictrack" style="display: none;">
                        <div class="form-group">
                            <label for="select_strand">Academic Track</label>
                            <select class="form-control inputDado" name="select_strand" id="select_strand">
                                <option selected disabled></option>
                                <option value="GAS">GAS</option>
                                <option value="STEM">STEM</option>
                                <option value="HUMSS">HUMSS</option>
                                <option value="TVL">TVL</option>
                                <option value="ABM">ABM</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 pr-md-5" id="div_qvr" style="display: none;">
                        <label for="radio_qvr">QVR</label>
                        <div class="row">
                            <div class="col-auto">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="radio_qvr" id="radio_qvr" value="poor">
                                    <label class="form-check-label" for="radio_healthcondition1">Public</label>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="radio_qvr" id="radio_qvr" value="fair">
                                    <label class="form-check-label" for="radio_healthcondition2">ESC</label>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="radio_qvr" id="radio_qvr" value="good">
                                    <label class="form-check-label" for="radio_healthcondition3">VMS</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 pr-md-5" id="div_collegecourse" style="display: none;">
                        <div class="form-group">
                            <label for="input_course">State the course you want to take</label>
                            <input type="text" class="form-control inputDado" id="input_course" name="input_course" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-4 pr-md-5" id="div_collegelevel" style="display: none;">
                        <div class="form-group">
                            <label for="select_grade">Year Level</label>
                            <select class="form-control inputDado" name="select_grade" id="select_grade">
                                <option selected disabled></option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 pr-md-5" id="div_collegeterm" style="display: none;">
                        <div class="form-group">
                            <label for="input_term">Term you wish to start school</label>
                            <input type="text" class="form-control inputDado" id="input_term" name="input_term">
                        </div>
                    </div>

                </div>

                <div class="row block-9">
                    <div class="col-md-4 pr-md-5">
                        <div class="form-group">
                            <label for="input_firstname">First Name</label>
                            <input type="text" class="form-control inputDado" id="input_firstname" name="input_firstname" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-4 pr-md-5">
                        <div class="form-group">
                            <label for="input_middlename">Middle Name</label>
                            <input type="text" class="form-control inputDado" id="input_middlename" name="input_middlename" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-4 pr-md-5">
                        <div class="form-group">
                            <label for="input_lastname">Last Name</label>
                            <input type="text" class="form-control inputDado" id="input_lastname" name="input_lastname" autocomplete="off">
                        </div>
                    </div>
                </div>

                <div class="row block-9">
                    <div class="col-md-4 pr-md-5">
                        <div class="form-group">
                            <label for="input_birthdate">Date of Birth</label>
                            <input type="date" class="form-control inputDado" id="input_birthdate" name="input_birthdate" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-4 pr-md-5">
                        <div class="form-group">
                            <label for="input_birthplace">Place of Birth (Town/City, Province)</label>
                            <input type="text" class="form-control inputDado" id="input_birthplace" name="input_birthplace" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-4 pr-md-5">
                        <div class="form-group">
                            <label for="select_sex">Sex</label>
                            <select class="form-control inputDado" name="select_sex" id="select_sex">
                                <option selected disabled></option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row block-9">
                    <div class="col-md-4 pr-md-5">
                        <div class="form-group">
                            <label for="input_nationality">Nationality</label>
                            <input type="text" class="form-control inputDado" id="input_nationality" name="input_nationality" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-4 pr-md-5">
                        <div class="form-group">
                            <label for="input_weight">Weight (in kg.)</label>
                            <input type="text" class="form-control inputDado" id="input_weight" name="input_weight" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-4 pr-md-5">
                        <div class="form-group">
                            <label for="input_height">Height (in ft., inches)</label>
                            <input type="text" class="form-control inputDado" id="input_height" name="input_height" autocomplete="off">
                        </div>
                    </div>
                </div>

                <div class="row block-9">
                    <div class="col-md-4 pr-md-5">
                        <div class="form-group">
                            <label for="input_nationality">Health Condition</label><br>
                            <div class="row">
                                <div class="col-auto">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="radio_healthcondition" id="radio_healthcondition" value="poor">
                                        <label class="form-check-label" for="radio_healthcondition1">Poor</label>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="radio_healthcondition" id="radio_healthcondition" value="fair">
                                        <label class="form-check-label" for="radio_healthcondition2">Fair</label>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="radio_healthcondition" id="radio_healthcondition" value="good">
                                        <label class="form-check-label" for="radio_healthcondition3">Good</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 pr-md-5">
                        <div class="form-group">
                            <label for="input_address">Home/Mailing Address</label>
                            <input type="text" class="form-control inputDado" id="input_address" name="input_address" autocomplete="off">
                        </div>
                    </div>
                </div>

                <div class="row block-9">
                    <div class="col-md-4 pr-md-5">
                        <div class="form-group">
                            <label for="input_telephone">Telephone</label>
                            <input type="text" class="form-control inputDado" id="input_telephone" name="input_telephone" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-4 pr-md-5">
                        <div class="form-group">
                            <label for="input_cellphone">Cellphone Number</label>
                            <input type="text" class="form-control inputDado" id="input_cellphone" name="input_cellphone" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-4 pr-md-5">
                        <div class="form-group">
                            <label for="input_email">Email</label>
                            <input type="text" class="form-control inputDado" id="input_email" name="input_email" autocomplete="off">
                        </div>
                    </div>
                </div>

                <div class="row block-9">
                    <div class="col-md-4 pr-md-5">
                        <div class="form-group">
                            <label for="input_religion">Religion</label>
                            <input type="text" class="form-control inputDado" id="input_religion" name="input_religion" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-4 pr-md-5">
                        <div class="form-group">
                            <label for="input_churchmembership">(for SDA's): Church Membership</label>
                            <input type="text" class="form-control inputDado" id="input_churchmembership" name="input_churchmembership" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-4 pr-md-5">
                        <div class="form-group">
                            <label for="input_missionconference">Mission/Conference</label>
                            <input type="text" class="form-control inputDado" id="input_missionconference" name="input_missionconference" autocomplete="off">
                        </div>
                    </div>
                </div>

                <div class="row block-9">
                    <div class="col-md-4 pr-md-5">
                        <div class="form-group">
                            <label for="input_baptismdate">Date of Baptism</label>
                            <input type="date" class="form-control inputDado" id="input_baptismdate" name="input_baptismdate" autocomplete="off">
                        </div>
                    </div>
                </div>

                <div class="row block-9">
                    <div class="col-md-4 pr-md-5">
                        <div class="form-group">
                            <label for="input_schoolattended">Last school attended</label>
                            <input type="text" class="form-control inputDado" id="input_schoolattended" name="input_schoolattended" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-4 pr-md-5">
                        <div class="form-group">
                            <label for="input_grade">Grade</label>
                            <input type="text" class="form-control inputDado" id="input_grade" name="input_grade" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-4 pr-md-5">
                        <div class="form-group">
                            <label for="input_yearattended">Year of Attendance</label>
                            <input type="text" class="form-control inputDado" id="input_yearattended" name="input_yearattended" autocomplete="off">
                        </div>
                    </div>
                </div>

                <div class="row block-9">
                    <div class="col-md-4 pr-md-5">
                        <div class="form-group">
                            <label for="input_schooladdress">Last school address</label>
                            <input type="text" class="form-control inputDado" id="input_schooladdress" name="input_schooladdress" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-4 pr-md-5">
                        <div class="form-group">
                            <label for="input_honors">Honors, if any (indicate date)</label>
                            <input type="text" class="form-control inputDado" id="input_honors" name="input_honors" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-4 pr-md-5">
                        <div class="form-group">
                            <label for="input_awards">Awards, if any (indicate date)</label>
                            <input type="text" class="form-control inputDado" id="input_awards" name="input_awards" autocomplete="off">
                        </div>
                    </div>
                </div>

                <div class="row block-9">
                    <div class="col-md-4 pr-md-5">
                        <div class="form-group">
                            <label for="input_genave">Previous Year's General Average</label>
                            <input type="text" class="form-control inputDado" id="input_genave" name="input_genave" autocomplete="off">
                        </div>
                    </div>
                </div>

                <div class="row block-9">
                    <div class="col-md-4 pr-md-5">
                        <div class="form-group">
                            <label for="input_fathersname">Father's Name</label>
                            <input type="text" class="form-control inputDado" id="input_fathersname" name="input_fathersname" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-4 pr-md-5">
                        <div class="form-group">
                            <label for="input_fathersoccupation">Occupation</label>
                            <input type="text" class="form-control inputDado" id="input_fathersoccupation" name="input_fathersoccupation" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-4 pr-md-5">
                        <div class="form-group">
                            <label for="input_fathersreligion">Religion</label>
                            <input type="text" class="form-control inputDado" id="input_fathersreligion" name="input_fathersreligion" autocomplete="off">
                        </div>
                    </div>
                </div>

                <div class="row block-9">
                    <div class="col-md-12 pr-md-5">
                        <div class="form-group">
                            <label for="input_fathersaddress">Address</label>
                            <input type="text" class="form-control inputDado" id="input_fathersaddress" name="input_fathersaddress" autocomplete="off">
                        </div>
                    </div>
                </div>

                <div class="row block-9">
                    <div class="col-md-4 pr-md-5">
                        <div class="form-group">
                            <label for="input_mothersname">Mother's Name</label>
                            <input type="text" class="form-control inputDado" id="input_mothersname" name="input_mothersname" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-4 pr-md-5">
                        <div class="form-group">
                            <label for="input_mothersoccupation">Occupation</label>
                            <input type="text" class="form-control inputDado" id="input_mothersoccupation" name="input_mothersoccupation" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-4 pr-md-5">
                        <div class="form-group">
                            <label for="input_mothersreligion">Religion</label>
                            <input type="text" class="form-control inputDado" id="input_mothersreligion" name="input_mothersreligion" autocomplete="off">
                        </div>
                    </div>
                </div>

                <div class="row block-9">
                    <div class="col-md-12 pr-md-5">
                        <div class="form-group">
                            <label for="input_mothersaddress">Address</label>
                            <input type="text" class="form-control inputDado" id="input_mothersaddress" name="input_mothersaddress" autocomplete="off">
                        </div>
                    </div>
                </div>

                <div class="row block-9">
                    <div class="col-md-4 pr-md-5">
                        <div class="form-group">
                            <label for="input_familycount">Number of persons in the family</label>
                            <input type="text" class="form-control inputDado" id="input_familycount" name="input_familycount" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-4 pr-md-5">
                        <div class="form-group">
                            <label for="input_brothers">Brothers</label>
                            <input type="text" class="form-control inputDado" id="input_brothers" name="input_brothers" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-4 pr-md-5">
                        <div class="form-group">
                            <label for="input_sisters">Sisters</label>
                            <input type="text" class="form-control inputDado" id="input_sisters" name="input_sisters" autocomplete="off">
                        </div>
                    </div>
                </div>

                <div class="row block-9">
                    <div class="col-md-4 pr-md-5">
                        <div class="form-group">
                            <label for="input_annualfamilyincome">Annual Family Income</label>
                            <input type="text" class="form-control inputDado" id="input_annualfamilyincome" name="input_annualfamilyincome" autocomplete="off">
                        </div>
                    </div>
                </div>

                <div class="row block-9">
                    <div class="col-md-4 pr-md-5">
                        <div class="form-group">
                            <label for="input_willingness">Are your parents willing that you attend NVAC?</label>
                            <input type="text" class="form-control inputDado" id="input_willingness" name="input_willingness" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-4 pr-md-5">
                        <div class="form-group">
                            <label for="input_whoencourage">Who encourage you to enroll at NVAC?</label>
                            <input type="text" class="form-control inputDado" id="input_whoencourage" name="input_whoencourage" autocomplete="off">
                        </div>
                    </div>
                </div>

                <div class="row block-9">
                    <div class="col-md-4 pr-md-5">
                        <div class="form-group">
                            <label for="input_personresponsible">Person responsible for your school account</label>
                            <input type="text" class="form-control inputDado" id="input_personresponsible" name="input_personresponsible" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-4 pr-md-5">
                        <div class="form-group">
                            <label for="input_personresponsibleaddress">Address (if other than the parents)</label>
                            <input type="text" class="form-control inputDado" id="input_personresponsibleaddress" name="input_personresponsibleaddress" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-4 pr-md-5">
                        <div class="form-group">
                            <label for="select_dormitory">Do you plan to stay in the dormitory?</label>
                            <select class="form-control inputDado" name="select_dormitory" id="select_dormitory">
                                <option selected disabled></option>
                                <option value="No">No</option>
                                <option value="Yes">Yes</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row block-9">
                    <div class="col-md-4 pr-md-5">
                        <div class="form-group">
                            <label for="input_whereandwhom">If not, where and with whom?</label>
                            <input type="text" class="form-control inputDado" id="input_whereandwhom" name="input_whereandwhom" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-4 pr-md-5">
                        <div class="form-group">
                            <label for="input_relationship">Relationship</label>
                            <input type="text" class="form-control inputDado" id="input_relationship" name="input_relationship" autocomplete="off">
                        </div>
                    </div>
                </div>

                <div class="row block-9">
                    <div class="col-md-4 pr-md-5">
                        <div class="form-group">
                            <label for="textarea_whynvac">Why have you chosen Naga View Adventist College?</label>
                            <textarea class="form-control inputDado" name="textarea_whynvac" id="textarea_whynvac" ></textarea>
                        </div>
                    </div>
                    <div class="col-md-8 pr-md-5">
                        <label for="student_pledge"><strong>Student pledge</strong></label>
                        <div class="form-check form-check-inline">
                            
                            <p><input class="form-check-input" type="checkbox" name="student_pledge" id="student_pledge"> I recognize that attendance at Naga View Adventist College is a privilege. I voluntarily pledge that if admitted,
                                I will uphold to the best of my ability the standards and principles of the school
                                - never cheat, steal, smoke, drink alcoholic beverages, use prohibited drugs, fight, destroy school property or
                                do any act contrary to the code of conduct. Should I be unfaithful to this pledge, or should I prove unable to 
                                comply and obey all the rules and regulations of Naga View Adventist College, I shall withdraw from attendance therein.
                            </p>
                        </div>
                        
                    </div>
                </div>

                <div class="row block-9 mt-5">
                    <div class="col-md-12 pr-md-5">
                        <div class="form-group">
                            <input type="submit" style="display: none;" value="Submit" class="btn btn-primary btn-sm btn-block py-3 px-5" id="btn_submit">
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </section>


    <script>
        $(document).ready(function(){
            $("#student_pledge").click(function(){
                $("#btn_submit").toggle();
            });
        });

        $('#select_student').change(function(){
            var studentType = $('#select_student').val();
            if(studentType == 'elementary'){
                $('#div_elem').css('display', 'block');
                $('#div_hs').css('display', 'none');
                $('#div_shs').css('display', 'none');
                $('#div_academictrack').css('display', 'none');
                $('#div_qvr').css('display', 'none');
                $('#div_collegecourse').css('display', 'none');
                $('#div_collegelevel').css('display', 'none');
                $('#div_collegeterm').css('display', 'none');
            } else if (studentType == 'junior high'){
                $('#div_elem').css('display', 'none');
                $('#div_hs').css('display', 'block');
                $('#div_shs').css('display', 'none');
                $('#div_academictrack').css('display', 'none');
                $('#div_qvr').css('display', 'none');
                $('#div_collegecourse').css('display', 'none');
                $('#div_collegelevel').css('display', 'none');
                $('#div_collegeterm').css('display', 'none');
            } else if (studentType == 'senior high'){
                $('#div_elem').css('display', 'none');
                $('#div_hs').css('display', 'none');
                $('#div_shs').css('display', 'block');
                $('#div_academictrack').css('display', 'block');
                $('#div_qvr').css('display', 'block');
                $('#div_collegecourse').css('display', 'none');
                $('#div_collegelevel').css('display', 'none');
                $('#div_collegeterm').css('display', 'none');
            } else if (studentType == 'college'){
                $('#div_elem').css('display', 'none');
                $('#div_hs').css('display', 'none');
                $('#div_shs').css('display', 'none');
                $('#div_academictrack').css('display', 'none');
                $('#div_qvr').css('display', 'none');
                $('#div_collegecourse').css('display', 'block');
                $('#div_collegelevel').css('display', 'block');
                $('#div_collegeterm').css('display', 'block');
            }
        })

        $("#form_admission").submit(function(e){
            e.preventDefault();
            var formAddAdmission = new FormData($(this)[0]);
            $("#form_admission_response").css('display','none');
            $.ajax({
                url: "<?=site_url('admission/add_online_admission')?>",
                data: formAddAdmission,
                dataType: "json",
                type: "post",
                async: false,
                success: function(data){

                    if(data.response == "false") {
                        Swal.fire({
                            html: data.message,
                            type: 'error',
                        })
                        // $("#form_admission_response").removeClass('alert alert-success').addClass('alert alert-danger').html(data.message).slideDown('fast');
                    } else {
                        // $("#form_admission_response").removeClass('alert alert-danger').addClass('alert alert-success').html(data.message).slideDown('fast');
                        $("#select_student").val('');
                        $("#input_date").val('');
                        $("#select_grade").val('');
                        $("#select_strand").val('');
                        $("#radio_qvr").val('');
                        $("#input_course").val('');
                        $("#select_grade").val('');
                        $("#input_term").val('');
                        $("#input_firstname").val('');
                        $("#input_middlename").val('');
                        $("#input_lastname").val('');
                        $("#input_birthdate").val('');
                        $("#input_birthplace").val('');
                        $("#select_sex").val('');
                        $("#input_nationality").val('');
                        $("#input_weight").val('');
                        $("#input_height").val('');
                        $("#radio_healthcondition").val('');
                        $("#input_address").val('');
                        $("#input_telephone").val('');
                        $("#input_cellphone").val('');
                        $("#input_email").val('');
                        $("#input_religion").val('');
                        $("#input_churchmembership").val('');
                        $("#input_missionconference").val('');
                        $("#input_baptismdate").val('');
                        $("#input_schoolattended").val('');
                        $("#input_grade").val('');
                        $("#input_yearattended").val('');
                        $("#input_schooladdress").val('');
                        $("#input_honors").val('');
                        $("#input_awards").val('');
                        $("#input_genave").val('');
                        $("#input_fathersname").val('');
                        $("#input_fathersoccupation").val('');
                        $("#input_fathersreligion").val('');
                        $("#input_fathersaddress").val('');
                        $("#input_mothersname").val('');
                        $("#input_mothersoccupation").val('');
                        $("#input_mothersreligion").val('');
                        $("#input_mothersaddress").val('');
                        $("#input_familycount").val('');
                        $("#input_brothers").val('');
                        $("#input_sisters").val('');
                        $("#input_annualfamilyincome").val('');
                        $("#input_willingness").val('');
                        $("#input_whoencourage").val('');
                        $("#input_personresponsible").val('');
                        $("#input_personresponsibleaddress").val('');
                        $("#select_dormitory").val('');
                        $("#input_whereandwhom").val('');
                        $("#input_relationship").val('');
                        $("#textarea_whynvac").val('');

                        Swal.fire({
                            title: 'Submitted!',
                            type: 'success',
                        })
                    }
                },
                contentType: false,
                cache: false,
                processData: false,
            });
        });
    </script>