@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<div class="row page-link-nav">
   <div class="container">
      <div class="pages-links">
         <ul class="list-unstyled">
            <li class="d-inline-block active"><a href="/doctor_full_profile/<?= $UserTbl->hash_key ?>">PROFILE</a></li>
            <li class="d-inline-block"><a href="<?= '/doctor_appointments/'.$EmpTbl->id.'/'.$EmpTbl->hash_key ?>">BOOKING APPOINTMENT</a></li>
         </ul>
      </div>
   </div>
</div>
<div class="row bg-white">
   <div class="container">
      <div class="pages-links text-gray-dark">
         <ul class="list-unstyled">
            <li class="d-inline-block active"><a href="/doctor_full_profile/<?= $UserTbl->hash_key ?>" class="text-dark">PROFILE</a></li>
            <li class="d-inline-block"><a href="/my_data" class="text-dark">My Data</a></li>
            <li class="d-inline-block">Premium profiles</li>
         </ul>
      </div>
   </div>
</div>
<!-- header-end -->
<section class="professional-page">
   <div class="container">
      <div class="row">
         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 professional-page-main">
            <div class="offset-lg-3 prof-page-head text-center">
               <h1 class="f-30">Lorem ipsum dolor sit amet, consectetur adipisicing elit. A quas illo odio eius dolorem doloribus.</h1>
            </div>
         </div>
      </div>
      <div class="row pro-page-columns">
         <div class="col-lg-4 pro-page-column-first text-center">
            <div class="pro-page-column-first-img">
               <i class="fa fa-picture-o" aria-hidden="true"></i>
            </div>
            <div class="pro-page-first-column-text">
               <p>You will find More</p>
            </div>
            <div class="pro-page-sec-desc">
               <div class="pro">
                  <div class="pro-page-desc-icon">
                     <i class="fa fa-check" aria-hidden="true"></i>
                  </div>
                  <div class="pro-page-desc text-left">
                     <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis enim quo, accusamus aperiam id velit in ullam odit suscipit.</p>
                  </div>
               </div>
               <div class="pro-page-link text-center">
                  <a href="">Why will they find me More ?</a>
               </div>
            </div>
         </div>
         <div class="col-lg-4  pro-page-column-sec text-center">
            <div class="pro-page-column-first-img">
               <i class="fa fa-picture-o" aria-hidden="true"></i>  
            </div>
            <div class="pro-page-column-sec-text">
               <p>You will find More</p>
            </div>
            <div class="pro-page-sec-desc">
               <div class="pro">
                  <div class="pro-page-desc-icon">
                     <i class="fa fa-check" aria-hidden="true"></i>
                  </div>
                  <div class="pro-page-desc text-left">
                     <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis enim quo, accusamus aperiam id velit in ullam odit suscipit.</p>
                  </div>
               </div>
               <div class="pro-page-link text-center">
                  <a href="">Why will they find me More ?</a>
               </div>
            </div>
         </div>
         <div class="col-lg-4  pro-page-column-third text-center">
            <div class="pro-page-column-third-img">
               <i class="fa fa-picture-o" aria-hidden="true"></i>  
            </div>
            <div class="pro-page-column-third-text">
               <p>You will find More</p>
            </div>
            <div class="pro-page-third-desc">
               <div class="pro">
                  <div class="pro-page-desc-icon">
                     <i class="fa fa-check" aria-hidden="true"></i>
                  </div>
                  <div class="pro-page-desc text-left">
                     <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis enim quo, accusamus aperiam id velit in ullam odit suscipit.</p>
                  </div>
               </div>
               <div class="pro-page-link text-center">
                  <a href="">Why will they find me More ?</a>
               </div>
            </div>
         </div>
      </div>
      <!-- row -->
      <!-- choose-your-premium-plan -->
      <div class="choose-your-premium-plan text-center">
         <div class="choose-your-plan-area ">
            <ul class="list-unstyled">
               <li>
                  <a href="">For Only $ 25,990</a>
               </li>
               <li class="my-2"><button class="btn btn-primary">Choose Premium plan</button>
               </li>
            </ul>
         </div>
      </div>
      <!--choose-your-premium-plan-end  -->
      <!-- compare your current -->
      <div class="compre-your-account my-5">
         <div class="compare-your-premium-acc-head text-center my-5">
            <h2>Compare Your Current Profile with basic</h2>
         </div>
         <div class="compare-your-basic-table table-responsive">
            <table class="table">
               <thead>
                  <tr>
                     <th>Visibility in Doctoralia</th>
                     <th class="text-center">Basic <br> Current profile</th>
                     <th class="text-center">Premium</th>
                  </tr>
               </thead>
               <tbody class="table-body">
                  <tr class="border border-bottom-0 border-left-0 border-right-0">
                     <td>Better Positioning<i class="fa fa-question-circle pl-2" aria-hidden="true"></i></td>
                     <td class="text-center"><i class="fa fa-times" aria-hidden="true"></i></td>
                     <td class="text-center"><i class="fa fa-check" aria-hidden="true"></i></td>
                  </tr>
                  <tr>
                     <th>Online Credibility and prestige</th>
                  </tr>
                  <tr>
                     <td>Better Positioning<i class="fa fa-question-circle pl-2" aria-hidden="true"></i></td>
                     <td class="text-center"><i class="fa fa-times" aria-hidden="true"></i></td>
                     <td class="text-center"><i class="fa fa-check" aria-hidden="true"></i></td>
                  </tr>
                  <tr>
                     <td>Better Positioning<i class="fa fa-question-circle pl-2" aria-hidden="true"></i></td>
                     <td class="text-center"><i class="fa fa-times" aria-hidden="true"></i></td>
                     <td class="text-center"><i class="fa fa-check" aria-hidden="true"></i></td>
                  </tr>
                  <tr>
                     <td>Better Positioning<i class="fa fa-question-circle pl-2" aria-hidden="true"></i></td>
                     <td class="text-center"><i class="fa fa-times" aria-hidden="true"></i></td>
                     <td class="text-center"><i class="fa fa-check" aria-hidden="true"></i></td>
                  </tr>
                  <tr>
                     <td>Better Positioning<i class="fa fa-question-circle pl-2" aria-hidden="true"></i></td>
                     <td class="text-center"><i class="fa fa-times" aria-hidden="true"></i></td>
                     <td class="text-center"><i class="fa fa-check" aria-hidden="true"></i></td>
                  </tr>
                  <tr>
                     <th>Better Ways TO Contact</th>
                  </tr>
                  <tr>
                     <td>Better Positioning<i class="fa fa-question-circle pl-2" aria-hidden="true"></i></td>
                     <td class="text-center"><i class="fa fa-times" aria-hidden="true"></i></td>
                     <td class="text-center"><i class="fa fa-check" aria-hidden="true"></i></td>
                  </tr>
                  <tr>
                     <td>Better Positioning<i class="fa fa-question-circle pl-2" aria-hidden="true"></i></td>
                     <td class="text-center"><i class="fa fa-times" aria-hidden="true"></i></td>
                     <td class="text-center"><i class="fa fa-check" aria-hidden="true"></i></td>
                  </tr>
                  <tr>
                     <td>Better Positioning<i class="fa fa-question-circle pl-2" aria-hidden="true"></i></td>
                     <td class="text-center"><i class="fa fa-times" aria-hidden="true"></i></td>
                     <td class="text-center"><i class="fa fa-check" aria-hidden="true"></i></td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
      <!-- compare your current end -->
      <!-- advantages of the Premium Profile -->
      <div class="premium-profile text-center">
         <div class="premium-profile-head">
            <h2>Advantage of the premium profile page</h2>
         </div>
         <div class="premium-profile-page-content">
            <div class="row profile-first-row">
               <div class="col-lg-6">
                  <div class="you-will-find-more clearfix">
                     <div class="you-will-find-more-head">
                        <h3 class="text-left">You Will Find More</h3>
                     </div>
                     <div class="you-will-find">
                        <div class="you-will-find-div-area">
                           <div class="you-will-find-more-first-list-items">
                              <div class="you-will-find-more-list-items-icon">
                                 <i class="fa fa-check" aria-hidden="true"></i>
                              </div>
                              <div class="you-will-find-more-list-items-text">
                                 <p>Lorem ipsum dolor sit amet, consectetur adipisicing</p>
                              </div>
                           </div>
                           <div class="you-will-find-more-sec-list-items">
                              <div class="you-will-find-more-list-items-icon">
                                 <i class="fa fa-check" aria-hidden="true"></i>
                              </div>
                              <div class="you-will-find-more-list-items-text">
                                 <p>Lorem ipsum dolor sit amet, consectetur adipisicing</p>
                              </div>
                           </div>
                        </div>
                        <div class="you-will-find-more-visit clearfix">
                           <div class="you-will-visit">
                              <div class="you-will-find-visit">
                                 <h4>Visit x3</h4>
                              </div>
                              <div class="you-will-find-more-premium-text">
                                 <p>Lorem ipsum dolor sit amet, consectetur</p>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="adv-of-pro text-left my-3">
                        <a href="">Lorem ipsum dolor sit amet ?</a>
                     </div>
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="premiumpro-image">
                     <img src="/frontend/assets/img/img1.jpg" alt="">
                  </div>
               </div>
            </div>
            <!-- row -->
            <div class="row profile-sec-row">
               <div class="col-lg-6">
                  <div class="premiumpro-image">
                     <img src="/frontend/assets/img/img1.jpg" alt="">
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="you-will-find-more clearfix">
                     <div class="you-will-find-more-head">
                        <h3 class="text-left">You Will Find More</h3>
                     </div>
                     <div class="you-will-find">
                        <div class="you-will-find-div-area">
                           <div class="you-will-find-more-first-list-items">
                              <div class="you-will-find-more-list-items-icon">
                                 <i class="fa fa-check" aria-hidden="true"></i>
                              </div>
                              <div class="you-will-find-more-list-items-text">
                                 <p>Lorem ipsum dolor sit amet, consectetur adipisicing</p>
                              </div>
                           </div>
                           <div class="you-will-find-more-sec-list-items">
                              <div class="you-will-find-more-list-items-icon">
                                 <i class="fa fa-check" aria-hidden="true"></i>
                              </div>
                              <div class="you-will-find-more-list-items-text">
                                 <p>Lorem ipsum dolor sit amet, consectetur adipisicing</p>
                              </div>
                           </div>
                        </div>
                        <div class="you-will-find-more-visit clearfix">
                           <div class="you-will-visit">
                              <div class="you-will-find-visit">
                                 <h4>Visit x3</h4>
                              </div>
                              <div class="you-will-find-more-premium-text">
                                 <p>Lorem ipsum dolor sit amet, consectetur</p>
                              </div>
                           </div>
                        </div>
                        <div class="adv-of-pro text-left my-3">
                           <a href="">Lorem ipsum dolor sit amet ?</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row profile-first-row">
               <div class="col-lg-6">
                  <div class="you-will-find-more clearfix">
                     <div class="you-will-find-more-head">
                        <h3 class="text-left">You Will Find More</h3>
                     </div>
                     <div class="you-will-find">
                        <div class="you-will-find-div-area">
                           <div class="you-will-find-more-first-list-items">
                              <div class="you-will-find-more-list-items-icon">
                                 <i class="fa fa-check" aria-hidden="true"></i>
                              </div>
                              <div class="you-will-find-more-list-items-text">
                                 <p>Lorem ipsum dolor sit amet, consectetur adipisicing</p>
                              </div>
                           </div>
                           <div class="you-will-find-more-sec-list-items">
                              <div class="you-will-find-more-list-items-icon">
                                 <i class="fa fa-check" aria-hidden="true"></i>
                              </div>
                              <div class="you-will-find-more-list-items-text">
                                 <p>Lorem ipsum dolor sit amet, consectetur adipisicing</p>
                              </div>
                           </div>
                        </div>
                        <div class="you-will-find-more-visit clearfix">
                           <div class="you-will-visit">
                              <div class="you-will-find-visit">
                                 <h4>Visit x3</h4>
                              </div>
                              <div class="you-will-find-more-premium-text">
                                 <p>Lorem ipsum dolor sit amet, consectetur</p>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="adv-of-pro text-left my-3">
                        <a href="">Lorem ipsum dolor sit amet ?</a>
                     </div>
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="premiumpro-image">
                     <img src="/frontend/assets/img/img1.jpg" alt="">
                  </div>
               </div>
            </div>
            <div class="premium-pro-buy">
               <div class="premium-pro-button">
                  <ul class="list-unstyled">
                     <li>
                        <a href="">For Only $ 25,990</a>
                     </li>
                     <li><button class="btn btn-primary my-3">Choose Premium plan</button>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
         <!-- premium-profile-page-content -->
      </div>
      <!-- advantages of the premium profile end -->
      <!-- already-premium -->
      <div class="premium-already-members text-center">
         <div class="premium-head my-3">
            <h4>More than 1,000 professionals in Chile are already Premium</h4>
         </div>
      </div>
      <div class="row">
         <div id="responsive" class="container">
          <?php if ($allPremiumDoctors): ?>
            <?php foreach ($allPremiumDoctors as $key => $premiumDoctor): ?>
              <div class="col-lg-12">
                 <div class="box border">
                    <div class="row">
                       <div class="col-4 p-0">
                          <div class="box-img">
                            <?php 
                              if ($premiumDoctor->profile_picture != '0') {
                                $profilePic = '/upload/'.$premiumDoctor->profile_picture;
                              } else {
                                $profilePic = '/frontend/assets/img/default-doctor_1.png';
                              }
                             ?>
                             <img src="<?= $profilePic; ?>" alt="" class="w-100 img-fluid">
                          </div>
                       </div>
                       <div class="col-8 my-3">
                          <div class="box-desc">
                             <div class="box-head">
                                <h4>Dr. <?= $premiumDoctor->first_name; ?></h4>
                             </div>
                             <div class="box-desc">
                                <p class="f-13 mb-0"><?= substr($premiumDoctor->about, 0, 35).'...'; ?></p>
                             </div>
                          </div>
                       </div>
                    </div>
                 </div>
              </div>
            <?php endforeach ?>
          <?php endif ?>
         </div>
      </div>
      <div class="faq-section clearfix my-5">
         <div class="faq-head text-center my-4">
            <h4>Frequently asked Question about the Premium Profile</h4>
         </div>
         <div class="frequently-asked-questions">
            <div class="container">
               <div id="accordion">
                  <div class="card border-0">
                     <div class="card card-header border-right-0 border-left-0 border-bottom-0 faq-panel">
                        <a class="card-link"  data-toggle="collapse" href="#collapseOne">
                        <span class="pr-2"><i class="fa fa-caret-down" aria-hidden="true"></i></span>What is the Premium Profile?
                        </a>
                     </div>
                     <div id="collapseOne" class="collapse show" data-parent="#accordion">
                        <div class="card-body border-0">
                           The Premium Profile is the most complete profile that a doctor can have :

                           Full and professional profile:
                           • Extend the content of your profile to improve your online reputation. 
                           • Add your experience in tests and diseases to improve your search results. 
                           • Photos 
                           • No third party ads.

                           More visibility in listings:
                           • Appear above the basic profiles. 
                           • Get a Premium badge.

                           More options to contact you:
                           • Accept online appointment reservations: patients can request an appointment 24 hours from your computer or mobile. 
                        </div>
                     </div>
                  </div>
                  <div class="card border-0">
                     <div class="card card-header faq-panel border-right-0 border-left-0 border-bottom-0">
                        <a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
                        <span class="pr-2"><i class="fa fa-caret-down" aria-hidden="true"></i></span>How to activate the subscription to the Premium Profile?
                        </a>
                     </div>
                     <div id="collapseTwo" class="collapse" data-parent="#accordion">
                        <div class="card-body border-0">
                           To start enjoying all the advantages of the Premium Profile, follow the following steps:

                           1. Go to the top right of the Doctoralia home page and you will find the option "Log in" . 2. Enter your email and password and click on the "Log in" button . In this way, you will enter your private area and you will see the option "Choose Premium plan" in the upper right part of the screen. 3. Look for the option "Subscribe" and choose between monthly or annual payment options. 4. Finally, for monthly or annual payments you must choose between adding your credit card information or direct debit option and clicking on the option "Activate Premium Profile" 
                           . 
                           This way, the process will be finished and you will be able to enjoy the benefits of this service.
                        </div>
                     </div>
                  </div>
                  <div class="card border-0">
                     <div class="card card-header  border-right-0 border-left-0 border-bottom-0 faq-panel">
                        <a class="collapsed card-link" data-toggle="collapse" href="#collapseThree">
                        <span class="pr-2"><i class="fa fa-caret-down" aria-hidden="true"></i></span>Conditions and permanence of the Premium Profile
                        </a>
                     </div>
                     <div id="collapseThree" class="collapse" data-parent="#accordion">
                        <div class="card-body border-0">
                           It will depend on the modality that has contracted, annual or monthly. In the monthly mode, a minimum stay of 6 months is applied in order to be able to measure the results obtained more effectively. In the annual mode, you can unsubscribe at any time and it will be effective at the end of the contracted period. The cancellation of the service is done from your private area to which you will have access at all times.
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- container -->
</section>
@stop