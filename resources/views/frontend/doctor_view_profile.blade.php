<?php use App\Http\Controllers\Frontend\IndexController; ?>
@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<!-- pages-links -->
<?php 
    $visitorIncrease = DB::table('employees')->where('id', $EmpTbl->id)->first();
    $newCount = $visitorIncrease->visitor_count + 1;
    $visitorIncrease = DB::table('employees')->where('id', $EmpTbl->id)->update(['visitor_count'=> $newCount]);
 ?>
<section class="doctor-port doctor_view_main_page">
   <header class="profile-box">
      <div class="container">
         <div class="row">
            <div id="doctor-image" class="col-lg-2">
               <figure class="manuel">
                <?php 
                  if ($EmpTbl->profile_picture != '0') {
                    $profilePic = '/upload/'.$EmpTbl->profile_picture;
                  } else {
                    $profilePic = '/frontend/assets/img/default-doctor_1.png';
                  }
                ?>
                  <img src="<?= $profilePic; ?>" class="img-thumbnail" alt="Doctor Image">
               </figure>
            </div>
            <div id="doctor-profile-section" class="col-lg-7">
               <div class="row">
                  <div id="doctor-name" class="col-lg-12">
                     <h1>Dr. <?= $EmpTbl->first_name.' '.$EmpTbl->last_name;  ?></h1>
                  </div>
                  <div id="doctor-speciality" class="col-lg-12">
                     <p>Specialist in: 
                      <?php 
                        $oldSpecialty = explode(',', substr($EmpTbl->specialty, 0, -1));
                        $specialty = DB::table('specialities')->where('id', $oldSpecialty[0])->first();
                        echo $specialty->name;
                      ?>
                     </p>
                  </div>
                  <div id="doctor-reg-num" class="col-lg-12">
                     <p>RUT: <?= $EmpTbl->RUT_number ?></p>
                  </div>
                  <div id="book-button" class="row">
                     <div id="button1">
                        <a href="#timingsOfDoctor"><i class="fa fa-calendar mr-2" aria-hidden="true"></i>
                        Book Appointment</a>
                     </div>
                     <!-- <div id="button2">
                        <a href=""><i class="fa fa-envelope mr-2" aria-hidden="true"></i> Send Message</a>
                     </div> -->
                     <div id="button3">
                        <a href="/" class="see_phone_profile"><i class="fa fa-phone mr-2" aria-hidden="true"></i> See Phone</a>
                        <a class="d-none phone_number_show" href="tel:<?= $EmpTbl->mobile; ?>"><i class="fa fa-phone mr-2"></i> <?= $EmpTbl->mobile; ?></a>
                     </div>
                  </div>
               </div>
            </div>
            <div id="doctor-ratings" class="col-lg-3">
               <div class="row">
                  <div id="ratings" class="col-lg-12 text-center">
                    <span class="ratingXL">
                    <?php 
                      $allReviews = DB::table('review_doctors')->where('doctor_id', $EmpTbl->id);
                      $ratings = $EmpTbl->reviews *20;
                    ?>
                      <span class="rating-avg-large"><span style="width: <?= (int)$ratings ?>%;"></span></span>
                    </span>
                  </div>
                  <div id="addr" class="col-lg-12 text-center mb-4">
                     <a href="/view_reviews_doctor/<?= $EmpTbl->id.'/'.$EmpTbl->hash_key ?>"><span><?= $allReviews->count(); ?></span> reviews</a>
                  </div>
                  <div class="col-lg-12 text-center">
                   <a href="/review_doctor/<?= $EmpTbl->id.'/'.$EmpTbl->hash_key ?>" class="review_view button4 p-2"><i class="fa fa-comment" aria-hidden="true"></i></a><span>Review</span>
                    <!-- Make Favourite -->
                    <?php 
                      $checked = '';
                      if (Auth::check()) {
                        $userID = Auth::user()->id;
                        $favourite = DB::table('favourite_doctors')->where('patient_id', $userID)->first();
                        if ($favourite != NULL) {
                          $allDoctorsIDs = explode(',', $favourite->doctors_list);
                          if (in_array($EmpTbl->id, $allDoctorsIDs)) {
                            $checked = 'checked';
                          }
                        }
                      } else {
                        $userID = '0';
                      }
                    ?>
                    <div class="pretty p-icon p-toggle p-plain">
                        <input class="make_favourite_heart" data-user="<?= $userID ?>" data-token="{{ csrf_token() }}" data-doctor="<?= $EmpTbl->id ?>" type="checkbox" <?= $checked ?>/>
                        <div class="state p-off">
                            <i class="icon fa fa-heart-o "></i>
                        </div>
                        <div class="state p-on p-info-o">
                            <i class="icon fa fa-heart" style="color:#008000; stroke: #008000;"></i>
                        </div>
                    </div> <span> Favourite</span>
                    <!-- End Make Favourite -->
                  </div>
               </div>
            </div>
         </div>
      </div>
   </header>
   <nav role="navigation" class="onpage">
      <ul>
         <li class="active"><a href="#booking_section_view"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Booking appointment</font></font></a></li>
         <!-- <li class=""><a href="#location"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Queries</font></font></a></li> -->
         <li class=""><a href="#experience_section_view"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Experience</font></font></a></li>
         <!-- <li class="#services_section_view"><a href="#services"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Services</font></font></a></li> -->
         <!-- <li class=""><a href="#articles"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Articles</font></font></a></li> -->
         <!-- <li><a href="#answers"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Answers</font></font></a></li> -->
         <li><a href="#photos_section_view"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Photos</font></font></a></li>
      </ul>
   </nav>
</section>
<section class="booking doctor_view_main_page">
   <div class="container">
      <div class="row" id="timingsOfDoctor">
         <div id="main-heading" class="col-lg-12">
            <h1 id="booking_section_view">Booking appointment</h1>
         </div>
         <div id="sep" class="col-lg-12"></div>
         <div id="addre" class="col-lg-12">
            <!-- <div class="row" >
               <div class="col-lg-12">
                  <h3>Address of the query</h3>
               </div>
               <div class="col-lg-12">
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe dicta nobis sed molestiae aliquam, cum cumque corporis assumenda esse tempore!</p>
               </div>
            </div> -->
         </div>
         <div class="row">
            <div class="col-lg-12">
               <h3>What day and time is going well?</h3>
            </div>
         </div>
         <div class="row">
            <div id="table-day" class="col-lg-9">
               <table class="table table-bordered">
                  <thead>
                     <tr>
                        <th>Monday</th>
                        <th>Tuesday</th>
                        <th>Wednesday</th>
                        <th>Thursday</th>
                        <th>Friday</th>
                        <th>Saturday</th>
                        <th>Sunday</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td><?php echo IndexController::getTimingDoctor('Monday', $EmpTbl->id); ?></td>
                        <td><?php echo IndexController::getTimingDoctor('Tuesday', $EmpTbl->id); ?></td>
                        <td><?php echo IndexController::getTimingDoctor('Wednesday', $EmpTbl->id); ?></td>
                        <td><?php echo IndexController::getTimingDoctor('Thursday', $EmpTbl->id); ?></td>
                        <td><?php echo IndexController::getTimingDoctor('Friday', $EmpTbl->id); ?></td>
                        <td><?php echo IndexController::getTimingDoctor('Saturday', $EmpTbl->id); ?></td>
                        <td><?php echo IndexController::getTimingDoctor('Sunday', $EmpTbl->id); ?></td>
                     </tr>
                  </tbody>
               </table>
            </div>
            <div class="col-lg-3">
               <aside>
                  <div class="note">
                     <h4><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Book your appointment now! </font></font><strong><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">It's easy, fast and safe</font></font></strong></h4>
                     <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">The appointment reservation is a free Doctoralia service.</font></font></p>
                  </div>
               </aside>
            </div>
         </div>
      </div>
   </div>
</section>
<section class="experience doctor_view_main_page">
   <div class="container">
      <div class="row">
         <div id="main-heading" class="col-lg-12">
            <h1 id="experience_section_view">Experience</h1>
         </div>
         <div id="sep" class="col-lg-12"></div>
         <section class="training1 col-lg-12">
            <i class="icon icon-training"></i>
            <h3>Training</h3>
            <ul>
              <?php 
                 $arrayTrainings = unserialize($EmpTbl->training);
                 if ($arrayTrainings != FALSE) {
                    foreach ($arrayTrainings["instName"] as $key => $arrayTraining) {

                       $instName = $arrayTraining;
                       $instYear = $arrayTrainings['instYear'][$key];

                    echo '<li><span>'.$instName.',</span> <span>'.$instYear.'</span></li>';
                    }
                 }
               ?>
            </ul>
         </section>
         <section class="about-me col-lg-12">
            <i class="icon"></i>
            <h3>About Me</h3>
            <div id="doctor-reg-num" class="col-lg-12">
               <p>RUT: <?= $EmpTbl->RUT_number ?></p>
            </div>
            <div>
               <p>&nbsp;</p>
               <p><?= $EmpTbl->about ?></p>
               <p>&nbsp;&nbsp;</p>
            </div>
         </section>
         <section class="webs-social-network col-lg-12 mb-5">
            <i class="icon"></i>
            <h3>Webs and links of interest</h3>
            <ul class="website-links blt">
              <?php 
                 $arrayLinks = unserialize($EmpTbl->web_links);
                 if ($arrayLinks != FALSE) {
                    
                    foreach ($arrayLinks["webTitle"] as $key => $arrayLink) {

                       $webTitle = $arrayLink;
                       $webLink = $arrayLinks['webLinks'][$key];

                    echo '<li><a target="_blank" href="'.$webLink.'">'.$webTitle.'</a></li>';
                    }
                 }
               ?>
            </ul>
            <hr>
            <!-- <ul class="social-networks">
               <li><a target="_blank" class="sn-facebook" href="http://Jose Manuel Martinez ">Facebook</a></li>
               <li><a target="_blank" class="sn-linkedin" href="https://www.linkedin.com/in/jose-manuel-martinez-martinez-611550119?trk=nav_responsive_tab_profile">LinkedIn</a></li>
            </ul> -->
         </section>
      </div>
   </div>
</section>
<section class="box services col-lg-12 doctor_view_main_page">
   <div class="details ">
      <h2>Services</h2>
      <ul id="servicesList" class="body">
        <?php 
           $arrayServices = unserialize($EmpTbl->services);
           if ($arrayServices != FALSE) {
              
              foreach ($arrayServices["service"] as $key => $arrayService) {

                 $rate = $arrayService;
                 $service = $arrayServices['rate'][$key];

              echo '<li class="with-detail">
                      <span class="name no-service mark">'.$rate.'</span>
                      <span class="price text-left">€ '.$service.'</span>
                   </li>';
              }
           } else {
            echo '<p id="servicesNoResults"><strong>No se encontraron resultados</strong>.</p>';
           }
         ?>
      </ul>
   </div>
   <aside>
      <p>Want to book appointment</p>
      <div class="contact">
         <a class="btn-book-app-bottom" href="#timingsOfDoctor"><i class="fa fa-calendar mr-2" aria-hidden="true"></i>Book Appointment</a>
      </div>
   </aside>
</section>
<section class="photos col-lg-12 doctor_view_main_page">
   <div class="container">
      <h2 id="photos_section_view">Photos</h2>
      <div id="sep" class="col-lg-12"></div>
      <div class="row">
        <?php if ($EmpTbl->photos != ''): ?>
         <div class="col-lg-4"></div>
         <div class="col-lg-4">
            <div class="slider1">
               <div id="slider2" class="carousel slide" data-ride="carousel">
                  <div class="carousel-inner">
                      <?php $arrayPhotos = explode(",", $EmpTbl->photos); ?>
                      <?php foreach ($arrayPhotos as $key => $arrayPhoto): ?>
                        <?php if ($key == 0) {
                          $active = 'active';
                        } else {
                          $active = '';
                        } ?>
                        <div class="carousel-item <?= $active ?>">
                          <img class="d-block w-100" src="<?= '/upload/'.trim($arrayPhoto, '"'); ?>" alt="<?= $key+1 ?> slide">
                        </div>
                      <?php endforeach ?>
                  </div>
                  <a class="carousel-control-prev" href="#slider2" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#slider2" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                  </a>
               </div>
            </div>
         </div>
         <div class="col-lg-4"></div>
          <?php else: ?>
            <div class="col-12 mt-4">This doctor has not added any Photo</div>
          <?php endif ?>
      </div>
   </div>
</section>
@stop