@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<!-- pages-links -->
<div class="row page-link-nav">
   <div class="container">
      <div class="pages-links">
         <ul class="list-unstyled">
            <li class="d-inline-block active"><a href="">PROFILE</a></li>
            <li class="d-inline-block"><a href="<?= '/doctor_appointments/'.$EmpTbl->id.'/'.$EmpTbl->hash_key ?>">BOOKING APPOINTMENT</a></li>
            <!-- <li class="d-inline-block"><a href="">STATISTICS</a></li> -->
            <!-- <li class="d-inline-block"><a href="">ACCOUNT</a></li> -->
         </ul>
      </div>
   </div>
</div>
<div class="row bg-white">
   <div class="container">
      <div class="pages-links text-gray-dark">
         <ul class="list-unstyled">
            <li class="d-inline-block active"><a href="" class="text-dark">PROFILE</a></li>
            <li class="d-inline-block"><a href="/my_data" class="text-dark">My Data</a></li>
            <!-- <li class="d-inline-block"><a href="" class="text-dark">Opinions</a></li> -->
            <li class="d-inline-block"><a href="<?= '/premium_profile/'.$EmpTbl->id.'/'.$EmpTbl->hash_key ?>" class="text-dark">Premium profiles</a></li>
         </ul>
      </div>
   </div>
</div>
<!-- pages-links end -->
<section>
   <div class="row quotes-sec">
      <div class="container">
         <div class="quotes-head text-center">
            <h3>PROFILE</h3>
         </div>
      </div>
   </div>
   <div class="container">
      <div class="row">
         <div class="col-lg-8">
            <div class="doc-pro">
               <div class="row">
                  <div class="col-lg-3 user_image" id="user_image">
                     <?php if ($EmpTbl->profile_picture == '0'): ?>
                        <img src="/frontend/assets/img/default-doctor_1.png" alt="Doctor Profile Picture" class="img-thumbnail w-100 doctor_profile_picture">
                     <?php else: ?>
                        <img src="/upload/<?= $EmpTbl->profile_picture; ?>" alt="Doctor Profile Picture" class="img-thumbnail w-100 doctor_profile_picture">
                        <button class="f-size removeProfilePicture">Remove</button>
                     <?php endif ?>
                     <button class="f-size change_profile_button" data-toggle="modal" data-target="#changeProfileModal">Change photo</button>
                     <!-- Modal -->
                     <div class="modal fade" id="changeProfileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                       <div class="modal-dialog modal-dialog-centered" role="document">
                         <div class="modal-content">
                           <div class="modal-header">
                             <h5 class="modal-title" id="exampleModalLongTitle">Agregar Foto</h5>
                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                             </button>
                           </div>
                           <div class="modal-body">
                             <div class="f-size mb-2">Add the photo you want to show on your profile by clicking on "Select file".</div>
                               <input type="file" name="upload_image" id="upload_image" accept=".png, .jpg, .jpeg" />
                              <input class="csrf_token_profile" type="hidden" name="_token" value="{{ csrf_token() }}">
                              <input class="user_id" type="hidden" name="user_id" value="<?= $EmpTbl->id; ?>">
                               <div id="uploaded_image"></div>
                           </div>
                            <div class="text-right p-4">
                               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                         </div>
                       </div>
                     </div>

                     <div id="uploadimageModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                       <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Upload & Crop Image</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                                <div class="modal-body">
                                  <div class="row">
                                     <div class="col-md-8 text-center">
                                       <div id="image_demo" style="width:350px; margin-top:30px"></div>
                                     </div>
                                     <div class="col-md-4" style="padding-top:30px;">
                                     </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button class="btn btn-success crop_image">Crop & Upload Image</button>
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                             </div>
                         </div>
                     </div>
                  </div>
                  <div class="col-lg-9 modify_view_bio">
                     <div class="doc-pro-info">
                        <ul class="list-unstyled">
                           <li class="modify_bio_button">
                              <h4 class="d-inline-block"><?= $UserTbl->name ?></h4>
                              <a href="#" class="modify_bio">Modify</a>
                           </li>
                           <li class="RUT_number_li">
                              <p><small>Rut number: <span class="RUT_number_default"><?= $EmpTbl->RUT_number ?></span></small></p>
                           </li>
                           <li class="specialty_li">
                            <h6>Specialty <button class="f-size add_Experience" data-toggle="modal" data-target="#AddSpecialtyModal">Add</button></h6>
                            <!-- Modal -->
                            <div class="modal fade" id="AddSpecialtyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                              <div class="modal-dialog modal_specialty modal-dialog-centered" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Add Specialty</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <form action="/addSpecialty" method="post" class="updateSpecialtyFormProfile">
                                     <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                     <input type="hidden" name="specialty" class="specialty_array">
                                     <input type="hidden" name="specialtyName" class="specialtyName">
                                     
                                      <div class="all_specialties_modal">
                                        <ul class="list-unstyled row text-center mb-3">
                                           <?php if ($allSpecialities != NULL): ?>
                                              <?php foreach ($allSpecialities as $key => $specialty): ?>
                                                <?php 
                                                  if (in_array($specialty->id, explode(',', $EmpTbl->specialty))) {
                                                    continue;
                                                  }
                                                ?>
                                                 <li class="d-inline-block col-lg-6 text-left">
                                                    <input data-name="{{ $specialty->name }}" class="selectspecialty-modal mr-2" type="checkbox" name="selectspecialty" value="{{ $specialty->id }}" /><h6 class="d-inline-block f-size">{{ $specialty->name }}</h6>
                                                 </li>
                                              <?php endforeach ?>
                                           <?php endif ?>
                                        </ul>  
                                      </div>
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal" id="speciality_modal_close">Close</button>
                                      <button type="submit" class="btn btn-primary">Save changes</button>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                             <ul class="specialty_exists">
                              <?php 
                              if ($EmpTbl->specialty != '' || $EmpTbl->specialty != null) {
                                $allSpecialities = explode(',', substr($EmpTbl->specialty, 0, -1));
                                foreach ($allSpecialities as $key => $allSpecialty) {
                                  $specialitiesTable = DB::table('specialities')->where('id', (int)$allSpecialty)->first();
                                  echo '<li data-name="'.$specialitiesTable->name.'" data-speciality_id="'.$specialitiesTable->id.'">'.$specialitiesTable->name.' -- <a href="#" class="remove-speciality"> Remove</a></li>';
                                }
                              }
                              ?>
                             </ul>
                           </li>

                           <li class="edit-profile-form">
                              <form action="/updateBio" method="post" class="dralia-form dralia-ajax-form dralia-form-bio-save">
                                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                 <input type="hidden" name="user_id" value="{{ $EmpTbl->id }}">
                                 <dl>
                                    <dt>
                                       <label for="Sex">Sexo</label>
                                    </dt>
                                    <dd>
                                       <select id="Sex" name="gender">
                                          <option value="" hidden></option>
                                          <option <?= ($EmpTbl->gender == 'Male') ? 'selected': null ; ?> value="Male">Hombre</option>
                                          <option <?= ($EmpTbl->gender == 'Female') ? 'selected': null ; ?> value="Female"> Mujer</option>
                                       </select>
                                    </dd>
                                 </dl>
                                 <!-- <dl>
                                    <dt>
                                       <label for="Title">Título</label>
                                    </dt>
                                    <dd>
                                       <select id="Title" name="title" disabled="">
                                          <option value="" hidden></option>
                                          <option value="Dr.">Dr.</option>
                                          <option value="Prof.">Prof.</option>
                                       </select>
                                    </dd>
                                 </dl> -->
                                 <dl>
                                    <dt>
                                       <label for="Name">Nombre<span class="field-required"> *</span></label>
                                    </dt>
                                    <dd>
                                       <input type="text" maxlength="50" id="Name" name="Name" value="<?= $EmpTbl->first_name ?>"  required="" disabled="">
                                    </dd>
                                 </dl>
                                 <dl>
                                    <dt>
                                       <label for="LastName">Apellidos<span class="field-required"> *</span></label>
                                    </dt>
                                    <dd>
                                       <input type="text" maxlength="50" id="LastName" name="LastName" value="<?= $EmpTbl->last_name ?>"  required="" disabled="">
                                    </dd>
                                 </dl>
                                 <dl class="mb-4">
                                    <dt>
                                       <label for="RUT_number">Número RUT</label>
                                    </dt>
                                    <dd>
                                       <input type="text" maxlength="20" id="RUT_number" name="RUT_number" value="<?= $EmpTbl->RUT_number ?>">
                                    </dd>
                                 </dl>
                                 <footer class="text-right">
                                    <button type="submit" class="dralia-button btn btn-primary" >Guardar datos</button>
                                    <button type="button" class="dralia-button btn btn-secondary dralia-button-bio-cancel" >Cancelar</button>        
                                 </footer>
                              </form>
                           </li>
                           <!-- <li>Psychology &nbsp;<a href="" class="f-size">Add Subspeciality &nbsp;</a><a href="#" class="f-size text-danger"> Remove</a></li>
                           <li><a href="" class="f-size">Add Specialty</a></li> -->
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-12">
                  <div class="doc-extract">
                     <div class="doc-extract-head" id="doc-extract-head">
                        <h2 class="border-bottom ">Exract
                           <a href="#" class="f-size modify_exract">Modify</a>
                        </h2>
                          <p class="dralia_para_exract">
                            <?php if ($EmpTbl->exract != '' || $EmpTbl->exract != NULL): ?>
                              <?= $EmpTbl->exract ?>
                            <?php endif ?>
                          </p>
                        <form action="/updateExract" method="post" class="dralia-form-exract dralia-ajax-form" style="display: none;">
                           <dl>
                              <dd>
				                     <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                 <input type="hidden" name="user_id" value="{{ $EmpTbl->id }}">
                                <textarea style="resize: none" class="form-control dralia_exract_text" cols="20" rows="2" maxlength="250" id="Extract" name="Extract"><?= $EmpTbl->exract ?></textarea>
                              </dd>
                           </dl>
                           <dl>
                              <dd>
                                 <p><strong>The extract will only be visible on its Doctoralia.me website.</strong><br><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">This is the first information that users will see on their website, so we recommend you write briefly and concisely, taking into account their specialties, experience and work method.</font></font></p>
                              </dd>
                           </dl>
                           <footer class="text-right">
         							<button type="submit" class="btn btn-primary save_data">Save Data</button>
         							<button class="btn btn-secondary cancel_data">Cancel</button>
                           </footer>
                        </form>
                     </div>
                     <div class="doc-extract-desc">
                        &nbsp;
                        <p>&nbsp;</p>
                     </div>
                  </div>
                  <!-- <div class="doc-queries">
                     <div class="doc-queries-head">
                        <h2 class="border-bottom ">Queries
                           <a href="#" class="f-size add_queries">Add</a>
                        </h2>
                     </div>
                     <div class="doc-queries-desc">
                        &nbsp;
                        <p>&nbsp;</p>
                     </div>
                  </div> -->
                  <div class="doc-exp-disease" id="doc-exp-disease">
                     <div class="doc-exp-disease-head">
                        <h2 class="border-bottom ">Experience in disease or disorders
                        	<button class="f-size add_Experience" data-toggle="modal" data-target="#AddExperienceModal">Add</button>
                        	<!-- Modal -->
                        	<div class="modal fade" id="AddExperienceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        	  <div class="modal-dialog modal-dialog-centered" role="document">
                        	    <div class="modal-content">
                        	      <div class="modal-header">
                        	        <h5 class="modal-title" id="exampleModalLongTitle">Add disease</h5>
                        	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        	          <span aria-hidden="true">&times;</span>
                        	        </button>
                        	      </div>
                        	      <div class="modal-body">
                        	      	<p class="f-size">Type the diseases or disorders</p>
                        	      	<form action="/updateExperience" method="post" class="updateExperienceForm">
                        	      		<textarea name="data[Disease][]" id="AddDisease" class="form-control mb-3 AddDisease" cols="30" rows="4"></textarea>
	                        	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	                        	        <button type="submit" class="btn btn-primary">Save changes</button>
                        	      	</form>
                        	      </div>
                        	    </div>
                        	  </div>
                        	</div>
                        </h2>
                     </div>
                     <div class="doc-exp-disease-desc">
                        <p>Puede seleccionar hasta <b>12 enfermedades o trastornos</b> que trata habitualmente o en los que esté mas especializado.</p>
                        <form class="formExperienceDisease">
                        <ul class="all_disease_list_doc">
                           <input type="hidden" name="_token" value="{{ csrf_token() }}">
                           <input type="hidden" name="user_id" value="{{ $EmpTbl->id }}">
                        	<?php 
                        		$array1 = unserialize($EmpTbl->experience);
                        		if ($array1 != FALSE) {
	                        		foreach ($array1['Disease'] as $key => $array2) {
	                        		echo '<li>'.$array2.' <a href="#" class="remove-exp">Remove</a>
              												<input type="hidden" value="'.$array2.'" name="data[Disease][]" />
    		                        		</li>';
	                        		}
                        		}
                        	 ?>
                        </ul>
                        </form>
                     </div>
                  </div>
                  <div class="doc-services-rates">
                     <h2>Services and rates<button class="f-size change_profile_button" data-toggle="modal" data-target="#addServicesRates">Add more services</button></h2>
                     <div class="doc-services-rates-subtitle"><p><small>You can add as many services as you want</small></p></div>
                     <!-- Modal -->
                      <div class="modal fade" id="addServicesRates" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLongTitle">Add Services</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <!-- <p class="f-size">Type the diseases or disorders</p> -->
                              <form method="post" class="updateServiceForm">
                                <div>Service</div>
                                <input type="text" name="data[service][]" id="addService" class="form-control mb-3 addService" required/>
                                <div>Rate</div>
                                <input type="number" name="data[rate][]" id="addRate" class="form-control mb-3 addRate"/>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                     <!-- Modal -->
                     <div class="visitors-list-table table-responsive">
                        <form class="formServices" method="post" >
                        <table class="table">
                           <thead>
                              <th>Your Services</th>
                              <th class="text-center">Rates</th>
                              <th>&nbsp;</th>
                           </thead>
                           <tbody class="all_services_tbody">
                               <input type="hidden" name="_token" value="{{ csrf_token() }}">
                               <input type="hidden" name="user_id" value="{{ $EmpTbl->id }}">
                              <?php 
                                $arrayServices = unserialize($EmpTbl->services);
                                if ($arrayServices != FALSE) {
                                  foreach ($arrayServices['service'] as $key => $arrayService) {
                                  echo '<tr><td>'.$arrayService.' </td><td class="text-center">€ '.$arrayServices['rate'][$key].'</td><td><a href="#" class="remove-service">Delete</a>
                                  </td>
                                  <input type="hidden" value="'.$arrayService.'" name="data[service][]" />
                                  <input type="hidden" value="'.$arrayServices['rate'][$key].'" name="data[rate][]" />
                                        </tr>';
                                  }
                                }
                               ?>
                           </tbody>
                        </table>
                         </form>
                     </div>
                  </div>
                  <div class="about-you" id="about-you">
                     <div class="about-you-head">
                        <h2 class="border-bottom ">About You</h2>
                     </div>
                           <p class="dralia_para_about">
                            <?php if ($EmpTbl->about != '' || $EmpTbl->about != NULL): ?>
                                <?= $EmpTbl->about ?>
                            <?php endif ?>
                            </p>
                        <form action="/updateAbout" method="post" class="dralia-form-about dralia-ajax-form" style="display: none;">
                           <dl>
                              <dd>
                                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                 <input type="hidden" name="user_id" value="{{ $EmpTbl->id }}">
                                <textarea style="resize: none" class="form-control dralia_about_text" cols="20" rows="2" maxlength="250" id="About" name="about"><?= $EmpTbl->about ?></textarea>
                              </dd>
                           </dl>
                           <footer class="text-right">
                              <button type="submit" class="btn btn-primary save_data">Save Data</button>
                              <button type="button" class="btn btn-secondary cancel_about">Cancel</button>
                           </footer>
                        </form>
                     <div class="about-you-add">
                        <button class="btn btn-primary add_about">Add</button>
                     </div>
                  </div>
                 <!--  <div class="languages">
                     <h2 class="border-bottom ">Languages
                     </h2>
                     <div class="all-lang">
                        <div class="select-lang">
                           <p>Please, select the language you speak:</p>
                        </div>
                        <div class="row lang-list">
                           <div class="col-lg-4 col-md-6 col-6">
                              <p>
                                 <label for="">
                                 <input type="checkbox" >
                                 <span class="pl-2">Spanish</span>
                                 </label>
                              </p>
                              <p>
                                 <label for="">
                                 <input type="checkbox">
                                 <span class="pl-2">Spanish</span>
                                 </label>
                              </p>
                           </div>
                           <div class="col-lg-4 col-md-6 col-6">
                              <p>
                                 <label for="">
                                 <input type="checkbox">
                                 <span class="pl-2">Spanish</span>
                                 </label>
                              </p>
                              <p>
                                 <label for="">
                                 <input type="checkbox">
                                 <span class="pl-2">Spanish</span>
                                 </label>
                              </p>
                           </div>
                           <div class="col-lg-4 col-md-6 col-6">
                              <p>
                                 <label for="">
                                 <input type="checkbox">
                                 <span class="pl-2">Spanish</span>
                                 </label>
                              </p>
                              <p>
                                 <label for="">
                                 <input type="checkbox">
                                 <span class="pl-2">Spanish</span>
                                 </label>
                              </p>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="input-field-lang">
                     <input type="text" class="w-100 form-control" placeholder="Otros">
                     <small>Add other language separated by comma</small>
                  </div> -->
                  <div class="training" id="training">
                     <form action="/updateTraining" method="post" class="updateTrainingForm">
                     <h2 class="border-bottom ">Training</h2>
                     <div class="training-set-fields">
                        <p>You can add up to 3 titles or courses (career, specialty, doctorate, certification, rotations ...).</p>
                        <p>Premium Users can add up to 10 ( <a href="#"> Know more</a> )</p>
                     </div>
                     <div class="row training-input">
                        <div class="col-lg-2 offset-lg-4 training-input-fields text-right">
                           <label for="" class="text-right">Institution*
                           </label>
                        </div>
                        <div class="col-lg-5">
                           <input type="text" name="data[instName][]" class="w-100 form-control intstitute_name">
                           <p class="training_title_error d-none" style="color:red; font-size: 12px;">Obligatory field</p>
                           <p><small>University of Santiago, Chile</small></p>
                        </div>
                     </div>
                     <div class="row training-input">
                        <div class="col-lg-2 offset-lg-4 training-input-fields text-right">
                           <label for="" class="text-right">Year*
                           </label>
                        </div>
                        <div class="col-lg-5">
                           <input type="number" name="data[instYear][]" class="w-100 form-control intstitute_year" autocomplete="off">
                           <p class="training_title_error d-none" style="color:red; font-size: 12px;">Obligatory field</p>
                           <button type="submit" class="btn btn-primary mt-3">Add</button>
                        </div>
                        </form>
                        <form class="formTraining">
                        <ul class="user_training_list">
                           <input type="hidden" name="_token" value="{{ csrf_token() }}">
                           <input type="hidden" name="user_id" value="{{ $EmpTbl->id }}">
                           <?php 
                              $arrayTrainings = unserialize($EmpTbl->training);
                              if ($arrayTrainings != FALSE) {
                                 
                                 foreach ($arrayTrainings["instName"] as $key => $arrayTraining) {

                                    $instName = $arrayTraining;
                                    $instYear = $arrayTrainings['instYear'][$key];

                                 echo '<li>'.$instName.', '.$instYear.' <a href="#" class="remove-training">Remove</a>
                                    <input type="hidden" value="'.$instName.'" name="data[instName][]" />
                                    <input type="hidden" value="'.$instYear.'" name="data[instYear][]" />
                                    </li>';
                                 }
                              }
                            ?>
                        </ul>
                        </form>
                     </div>
                  </div>
                  <div class="photos" id="photos_dropzone_upload">
                     <h2 class="border-bottom">Photos</h2>
                     <p>Add Photos. Option only <b>available for Premium</b></p>
                     <div>
                        <form method="post" action="/upload_photos" class="dropzone" id="my-awesome-dropzone" enctype="multipart/form-data">
                         {{ csrf_field() }}
                        <input class="user_id" type="hidden" name="user_id" value="<?= $EmpTbl->id; ?>">
                           <div class="dz-message needsclick text-center mt-2">
                              Drop files here or click to upload
                           </div>
                        </form>
                     </div>
                  </div>
                  <div class="webs-and-link-of-interest" id="webs-and-link-of-interest">
                     <h2 class="border-bottom ">Webs And Link Of Interest</h2>
                     <div class="web-set-fields">
                        <p>You can add up to 3 links to your web pages</p>
                     </div>
                     <form action="/updateWebLinks" method="post" class="updateWebLinksForm">
                     <div class="row web-input">
                        <div class="col-lg-2 offset-lg-2 training-input-fields text-right">
                           <label for="" class="text-right">Title*</label>
                        </div>
                        <div class="col-lg-8">
                           <input type="text" name="data[webTitle][]" class="w-100 form-control link_title">
                           <p class="link_title_error d-none" style="color:red; font-size: 12px;">Obligatory field</p>
                           <p><small>For example: "My personal web", "My blog", "Web of my center"</small></p>
                        </div>
                     </div>
                     <div class="row web-input">
                        <div class="col-lg-2 offset-lg-2 training-input-fields text-right">
                           <label for="" class="text-right">Address*</label>
                        </div>
                        <div class="col-lg-8">
                           <input type="text" name="data[webLinks][]" class="w-100 form-control link_url">
                           <p class="link_title_error d-none" style="color:red; font-size: 12px;">Obligatory field</p>
                           <p><small>Example: "<b>http://www.miblog.com</b>"</small></p>
                           <button class="btn btn-primary float-right add_user_links">Add</button>
                        </div>
                     </div>
                     </form>
                     <div class="link-add">
                        <p><small>Links added to your Doctoralia profile:</small></p>
                        <form class="formWebLinks">
                        <ul class="user_links_list">
                           <input type="hidden" name="_token" value="{{ csrf_token() }}">
                           <input type="hidden" name="user_id" value="{{ $EmpTbl->id }}">
                           <?php 
                              $arrayLinks = unserialize($EmpTbl->web_links);
                              if ($arrayLinks != FALSE) {
                                 
                                 foreach ($arrayLinks["webTitle"] as $key => $arrayLink) {

                                    $webTitle = $arrayLink;
                                    $webLink = $arrayLinks['webLinks'][$key];

                                 echo '<li>'.$webTitle.', '.$webLink.' <a target="_blank" href="'.$webLink.'" class="remove-link">Remove</a>
                                    <input type="hidden" value="'.$webTitle.'" name="data[webTitle][]" />
                                    <input type="hidden" value="'.$webLink.'" name="data[webLinks][]" />
                                    </li>';
                                 }
                              }
                            ?>
                        </ul>
                        </form>
                     </div>
                  </div>
                  <div class="row mb-2">
                     <h2 class="border-bottom">Counsulting Time</h2>
                  </div>
                   <div class="row mb-4">
                      <a href="/consulting_time"><button class="btn btn-primary">Add Counsulting Time</button></a>
                   </div><!-- /.row -->
                  <!-- Social-Network -->
                  <!-- <div class="social-network">
                     <h2 class="border-bottom ">Social Network</h2>
                     <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse nostrum delectus</p>
                     <div class="row">
                        <div class="col-lg-10">
                           <div class="dropdown my-2">
                              <button type="button" class="btn bg-white border text-dark dropdown-toggle text-left w-100" data-toggle="dropdown">
                              dropdown button
                              </button>
                              <div class="dropdown-menu w-100">
                                 <a class="dropdown-item" href="#">Link 1</a>
                                 <a class="dropdown-item" href="#">Link 2</a>
                                 <a class="dropdown-item" href="#">Link 3</a>
                              </div>
                           </div>
                           <input type="text" class="w-100 my-2 form-control">
                           <button class="btn btn-primary">Add</button>
                        </div>
                     </div>
                  </div> -->
                  <div class="resource-website">
                     <h2 class="border-bottom ">Doctorolia Resources For Your Website</h2>
                     <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse nostrum delectus</p>
                     <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                           <div class="valuations-module">
                              <div class="valuation-module-head bg-grey">
                                 <h5>Valuation Module</h5>
                              </div>
                              <div class="row valuation-module-desc-div">
                                 <div class="col-lg-6 col-md-12 col-sm-6 col-12 valuation-module-desc-area">
                                    <p>Show the evaluations of your patients on your website</p>
                                    <button class="btn btn-primary">Know More</button>
                                 </div>
                                 <div class="col-lg-6 col-md-12 col-sm-6 col-12 valuation-module-review">
                                    <div class="review-area bg-green">
                                       <h6><?= $UserTbl->name ?></h6>
                                       <div class="review-star">
                                          <p>
                                             <i class="fa fa-star star-color" aria-hidden="true"></i>
                                             <i class="fa fa-star star-color" aria-hidden="true"></i>
                                             <i class="fa fa-star star-color" aria-hidden="true"></i>
                                             <i class="fa fa-star star-color" aria-hidden="true"></i>
                                             <i class="fa fa-star star-color" aria-hidden="true"></i>
                                          </p>
                                       </div>
                                       <div class="total-review">
                                          <p>20 Review</p>
                                       </div>
                                       <div class="brand-footer">
                                          <img src="/frontend/assets/img/Original.png" alt="" class="w-100 bg-green-dark">
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                           <div class="doc-icon-for-your-website">
                              <div class="doc-icon-for-your-web-head text-center bg-grey">
                                 <h5>Doctoralia icon for your website</h5>
                              </div>
                              <div class="row doc-icon-for-your-website-desc-div">
                                 <div class="col-lg-6 col-md-12 col-sm-6 col-12 doc-icon-for-your-website-desc-area">
                                    <p>Link your Doctoralia profile from your website</p>
                                    <button class="btn btn-primary">Know More</button>
                                 </div>
                                 <div class="col-lg-6 col-md-12 col-sm-6 col-12 doc-icon-for-your-website-icons text-center">
                                    <div class="doc-social-icon-area">
                                       <a href="" class="text-white"><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
                                       <a href="" class="text-white"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
                                       <a href="" class="text-white"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
                                       <div class="doc-icon-brand-footer">
                                          <img src="/frontend/assets/img/Original.png" alt="" class="w-100 bg-green-dark">
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- Your Profile on the internet -->
                  <div class="profile-on-the-internet-sec">
                     <h2 class="border-bottom ">Share Your Profile On the internet</h2>
                     <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse nostrum delectus</p>
                     <div class="doctoralia-social-network border">
                        <div class="doctoralia-social-network-head bg-grey">
                           <h5 class="text-center">Doctoralia in their Social Network</h5>
                        </div>
                        <div class="doctoralia-social-icons">
                           <div class="doctoralia-social-icon-list">
                              <ul class="list-unstyled">
                                 <li class="d-inline-block li-facebook">
                                    <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?= Request::fullUrl(); ?>" class="text-white">
                                    <i class="fa fa-facebook-official" aria-hidden="true"></i>
                                    <span>Facebook</span>	
                                    </a> 
                                 </li>
                                 <li class="d-inline-block li-linkedin">
                                    <a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?= Request::fullUrl(); ?>" class="text-white">
                                    <i class="fa fa-linkedin-square" aria-hidden="true"></i>
                                    <span>Linkedin</span>	
                                    </a> 
                                 </li>
                                 <li class="d-inline-block li-twitter">
                                    <a target="_blank" href="https://twitter.com/home?status=<?= Request::fullUrl(); ?>" class="text-white">
                                    <i class="fa fa-twitter-square" aria-hidden="true"></i>
                                    <span>Twitter</span>	
                                    </a> 
                                 </li>
                                 <li class="d-inline-block li-pinterest">
                                    <a target="_blank" href="http://pinterest.com/pin/create/button/?url=<?= Request::fullUrl(); ?>" class="text-white">
                                    <i class="fa fa-pinterest-square" aria-hidden="true"></i>
                                    <span>Pinterest</span>	
                                    </a> 
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- col-lg-12 -->
            </div>
         </div>
         <!-- col-lg-8 -->
         <!-- side-bar -->
         <div class="col-lg-4">
            <div class="sidebar-doctoralia">
               <div class="doc-premium-pro-sec">
                  <div class="premium-profile-img text-center">
                     <i class="fa fa-picture-o" aria-hidden="true"></i>
                     <p>Premium Profile</p>
                  </div>
                  <div class="premium-pro-desc text-center">
                     <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                     <button class="btn  bg-white">Know More</button>
                  </div>
               </div>
               <?php 
                  // Profile Completeness % count
                  $completenessFields = '';
                  $complete = 0;
                  if ($EmpTbl->profile_picture != 0 && $EmpTbl->profile_picture != '0') {
                     $complete = $complete+30;
                  } else {
                    // add button of remaining profile section
                    $completenessFields .= '<li class="py-2">
                           <a href="#user_image"><span> <i class="fa fa-plus" aria-hidden="true"></i></span>
                           <span class="pl-2">Add Profile Picture 30%</span>  </a>
                        </li>';
                  }
                  if ($UserTbl->confirm_email == null || $UserTbl->confirm_email == 'null' || $UserTbl->confirm_email == '') {
                     $complete = $complete+30;
                  }
                  if ($EmpTbl->about != '' && $EmpTbl->about != null) {
                     $complete = $complete+10;
                  } else {
                    // add button of remaining profile section
                    $completenessFields .= '<li class="py-2">
                           <a href="#about-you"><span> <i class="fa fa-plus" aria-hidden="true"></i></span>
                           <span class="pl-2">Add About Yourself 10%</span>  </a>
                        </li>';
                  }
                  if ($EmpTbl->experience != '' && $EmpTbl->experience != null && $EmpTbl->experience != 'N;') {
                     $complete = $complete+10;
                  } else {
                    // add button of remaining profile section
                    $completenessFields .= '<li class="py-2">
                           <a href="#doc-exp-disease"><span> <i class="fa fa-plus" aria-hidden="true"></i></span>
                           <span class="pl-2">Add Experience 10%</span>  </a>
                        </li>';
                  }
                  if ($EmpTbl->exract != '' && $EmpTbl->exract != null) {
                     $complete = $complete+5;
                  } else {
                    // add button of remaining profile section
                    $completenessFields .= '<li class="py-2">
                           <a href="#doc-extract-head"><span> <i class="fa fa-plus" aria-hidden="true"></i></span>
                           <span class="pl-2">Add Exract 5%</span>  </a>
                        </li>';
                  }
                  if ($EmpTbl->training != '' && $EmpTbl->training != null && $EmpTbl->training != 'N;') {
                     $complete = $complete+5;
                  } else {
                    // add button of remaining profile section
                    $completenessFields .= '<li class="py-2">
                           <a href="#training"><span> <i class="fa fa-plus" aria-hidden="true"></i></span>
                           <span class="pl-2">Add Training 5%</span>  </a>
                        </li>';
                  }
                  if ($EmpTbl->web_links != '' && $EmpTbl->web_links != null && $EmpTbl->web_links != 'N;') {
                     $complete = $complete+5;
                  } else {
                    // add button of remaining profile section
                    $completenessFields .= '<li class="py-2">
                           <a href="#webs-and-link-of-interest"><span> <i class="fa fa-plus" aria-hidden="true"></i></span>
                           <span class="pl-2">Add Web Links 5%</span>  </a>
                        </li>';
                  }
                  if ($EmpTbl->photos != '' && $EmpTbl->photos != null ) {
                     $complete = $complete+5;
                  } else {
                    // add button of remaining profile section
                    $completenessFields .= '<li class="py-2">
                           <a href="#photos_dropzone_upload"><span> <i class="fa fa-plus" aria-hidden="true"></i></span>
                           <span class="pl-2">Add Gallery 5%</span>  </a>
                        </li>';
                  }
               ?>
               <div class="pro-completed">
                  <div class="pro-list">
                     <ul class="list-unstyled">
                        <li class="text-center">
                           <h5>Profile Completed at <?= $complete?>%</h5>
                        </li>
                        <li>
                           <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="70"
                            aria-valuemin="0" aria-valuemax="100" style="width:<?= $complete ?>%">
                              <span class="sr-only"><?= $complete ?>% Complete</span>
                            </div>
                           </div>
                        </li>
                     <!-- View Buttons of remaining profile sections -->
                        <?php echo $completenessFields; ?>
                     <!-- End View Buttons of remaining profile sections -->
                     </ul>
                  </div>
               </div>
               <div class="simplify-of-your-life-and-that-of-your-patients">
                  <div class="simplify-of-your-life-list-items">
                     <ul class="list-unstyled text-center">
                        <li>
                           <h5>Simplify of Your life and that of Your Patients</h5>
                        </li>
                        <li class="py-2"><a href="">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</a></li>
                        <li class="py-2"><a href="">Lorem ipsum dolor sit amet,.</a></li>
                        <li class="py-2"><a href="">Lorem ipsum dolor</a>  </li>
                        <li class="py-2"><a href="">Lorem ipsum dolor sit amet,</a></li>
                        <li>
                           <button class="btn btn-primary py-2 my-2">Know More</button>
                        </li>
                     </ul>
                  </div>
               </div>
               <div class="statistics">
                  <div class="statistics-show">
                     <ul class="list-unstyled">
                        <li>
                           <h5>Statistics</h5>
                        </li>
                        <!-- <li><small>last 30 days</small></li> -->
                     </ul>
                     <div class="statistics-visit">
                        <ul class="list-unstyled">
                           <li>
                              <h5><?= $EmpTbl->visitor_count ?></h5>
                           </li>
                           <li><small>visits to your Profile</small></li>
                        </ul>
                     </div>
                     <div class="statistics-know-more-button">
                        <button class="btn btn-primary w-75">Know More</button>
                     </div>
                  </div>
               </div>
               <div class="sidebar-support">
                  <div class="sidebar-support-show">
                     <ul class="list-unstyled">
                        <li>
                           <span><i class="fa fa-picture-o" aria-hidden="true"></i></span>
                           <h5 class="d-inline-block pl-2">Support</h5>
                        </li>
                     </ul>
                     <div class="sidebar-support-desc text-left">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit accusamus modi</p>
                     </div>
                     <div class="sidebar-support-text-area">
                      <form action="/frequently" method="get">
                        <input type="text" class="form-control" placeholder="Write Your Question here" name="question" required>
                        <button type="submit" class="btn btn-success mt-3">Search</button>
                      </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--Row  -->
   </div>
</section>
<!-- table-sec -->
<?php
  $photoData = '';
   if ($EmpTbl->photos != '') {
      $arrayPhotos = explode(",", $EmpTbl->photos);
      foreach ($arrayPhotos as $key => $arrayPhoto) {
        $photoData .= '
          var mockFile = { name: '.$arrayPhoto.'};
          this.options.addedfile.call(this, mockFile);
          this.options.thumbnail.call(this, mockFile, "/upload/'.str_replace('"', '', $arrayPhoto).'");
          mockFile.previewElement.classList.add("dz-complete");
        ';
      }
   }
?>
<script src="/frontend/assets/js/dropzone.js"></script>
<script>
    Dropzone.options.myAwesomeDropzone = {
    maxFilesize: 5,
    maxFiles: 10,
    dictResponseError: 'Server not Configured',
    acceptedFiles: ".png,.jpg,.jpeg",
    init:function(){
      var self = this;
      // config
      self.options.addRemoveLinks = true;
      self.options.dictRemoveFile = "Delete";
      //New file added
      self.on("addedfile", function (file) {
        // console.log('new file added ', file);
      });
      // Send file starts
      self.on("sending", function (file) {
        // console.log('upload started', file);
        $('.meter').show();

      });
      
      // File upload Progress
      self.on("totaluploadprogress", function (progress) {
        // console.log("progress ", progress);
        $('.roller').width(progress + '%');
      });

      self.on("queuecomplete", function (progress) {
        $('.meter').delay(999).slideUp(999);
      });
      
      // On removing file
      self.on("removedfile", function (file) {
        if (file.hasOwnProperty('xhr')) {
            var fileName = JSON.parse(file.xhr.response).success;
        } else {
            var fileName = file.name;
        }
            var token = $('.csrf_token_profile').val();
            var user_id = $('.user_id').val();
            $.ajax({
                type: 'POST',
                url: '/remove_photos',
                data: {"_token": token, "image": fileName, "user_id": user_id},
                success: function (data){
                    console.log("File has been successfully removed!!");
                },
                error: function(e) {
                    console.log(e);
                }});
      });
      self.on("complete", function(file) {
        });
        
        <?= $photoData; ?>
    }

  };
</script>

@stop