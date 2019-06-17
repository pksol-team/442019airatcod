<?php $user = Auth::user(); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $title ?></title>
    <link rel="stylesheet" type="text/css" href="/frontend/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/frontend/assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/frontend/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="/frontend/assets/css/ask_expert.css">
  </head>
  <body>
    <!-- Header Section -->
    <header>
      <div class="row header-sec bg-green">
        <div class="login-header w-100">
          <div class="container">
            <div class="brand float-left w-25">
              <a href="/"><img src="/frontend/assets/img/Original.png" alt="Logo - PSICOLOGOS VIBEMAR"></a>
            </div>
            <div class="login-header-items float-right w-75">
              <div class="login-header-links float-right">
                <ul class="list-unstyled">
                  <?php if (Auth::check() != true): ?>
                  <li class="d-inline-block float-left text-white mr-4"><button class="btn bg-blue"><a href="/register_doctor_init" class="text-white">Registrarme</a></button></li>
                  <li class="d-inline-block float-left text-white"><button class="btn bg-blue"><a href="/userlogin" class="text-white">Iniciar sesión</a></button></li>
                  <?php endif ?>
                  <?php if (Auth::check() == true): ?>
                  <li class="d-inline-block float-left text-white"><a href="/my_data"><?php echo $user->name; ?></a> |</li>
                  <li class="d-inline-block float-left text-white"><a href="/">Ir a la página de inicio</a>|</li>
                  <li class="d-inline-block float-left text-white"><a href="/logout" onclick="return confirm('¿Seguro que quieres cerrar sesión?')" >Cerrar sesión</a></li>
                  <?php endif ?>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>
    <!-- Header End -->
    <!-- Main Content -->
    <section class="inner-pages">
      <div class="container custom">
        <div class="row">
          <div class="col-7">
            <h1>Pregunte al experto</h1>
            <p>Puede resolver, de forma anónima, todas sus dudas sobre la salud.</p>
            <div class="offset-top-2 offset-bottom-1">
              <ul class="list-unstyled">
                <li class="display-flex align-items-center custom-list">
                  <i class="fa fa-check-circle" aria-hidden="true"></i>
                  <p>Recibirá una respuesta fiable y de calidad.</p>
                </li>
              </ul>
              <ul class="list-unstyled">
                <li class="display-flex align-items-center custom-list">
                  <i class="fa fa-check-circle" aria-hidden="true"></i>
                  <p>Su duda se resolverá en 48 horas.</p>
                </li>
              </ul>
              <ul class="list-unstyled">
                <li class="display-flex align-items-center custom-list">
                  <i class="fa fa-check-circle" aria-hidden="true"></i>
                  <p>Y, por supuesto, gratis.</p>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-5 right-img">
            <img src="/frontend/assets/img/qna_landing.png" class="img-responsive">
          </div>
        </div>
        <div class="offset-top-2 offset-bottom-4 offset-xs-bottom-2">
          <div class="panel panel-success">
            <div class="panel-body">
              <form action="/realizarpregunta" name="doctor_question_ask_form" class="doctor_question_ask_form" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group offset-bottom-1">
                  <div class="ask-question-box__box">
                    <div class="row">
                      <div class="col-sm-6">
                        <label for="doctor_question_ask_form_question" class="required">Tu pregunta</label>
                      </div>
                      <div class="col-sm-6">
                        <div class="text-placeholder text-sm-right text-md-right d-block hide characters_left_div">Necesitas escribir: <span class="characters_left_count">50</span> mas personajes.</div>
                      </div>
                    </div>
                    <textarea id="doctor_question_ask_form_question" name="doctor_question_ask_" class="form-control ask-question-box__text" placeholder="Escribe aquí tu pregunta"></textarea>
                  </div>
                  <p class="text-error hide to_short_p">
                    Este valor es demasiado corto. Debe contener 50 o más caracteres.
                  </p>
                </div>
                <div class="offset-top-2 small text-muted hide detail_form_hidden">
                  <ul>
                    <li>
                      <p> Tu pregunta se publicará de forma anónima. </p>
                    </li>
                    <li>
                      <p> Intente que su consulta médica sea clara y breve. </p>
                    </li>
                    <li>
                      <p> La pregunta se dirigirá a todos los especialistas de Psicologos, no a uno específico. </p>
                    </li>
                    <li>
                      <p> Este servicio no reemplaza una consulta con un profesional de la salud. Si tiene un problema o una emergencia, consulte a su médico o a los servicios de emergencia.
                      </p>
                    </li>
                    <li>
                      <p> No se permiten preguntas sobre casos específicos o segundas opiniones. </p>
                    </li>
                  </ul>
                </div>
                <button class="btn btn-primary btn-xs-block offset-top-2 hide" type="submit">
                Enviar pregunta
                </button>
                <div>
                  <div class="hide form_extra_fields_hidden">
                    <hr class="color-docplanner-gray-light">
                    <div class="form-group">
                      <label for="doctor_question_ask_form_doctor_question_details_specialization_id">Especialidad</label>
                      <div class="row">
                        <div class="col-sm-7">
                          <div class="ask-question-box__specialization">
                            <select id="doctor_question_ask_form_doctor_question_details_specialization_id" name="specialty" class="form-control specialization_id">
                              <?php if ($allSpecialties): ?>
                              <?php foreach ($allSpecialties as $key => $specialty): ?>
                              <option value="{{ $specialty->name }}">{{ $specialty->name }}</option>
                              <?php endforeach ?>
                              <?php endif ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-sm-5">
                          <div class="small text-muted">
                            Elige la especialidad de los médicos que quieras consultar.
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="doctor_question_ask_form_email" class="required">What is the email address?</label>
                      <div class="row">
                        <div class="col-sm-7">
                          <input type="email" id="doctor_question_ask_form_email" name="doctor_question_ask_form_email" class="form-control doctor_question_ask_form_email">
                        </div>
                        <div class="col-sm-5">
                          <div class="small text-muted">
                            Lo usaremos para notificarle la respuesta (en ningún momento aparecerá en Psicologos)
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="checkbox offset-left-2">
                      <input type="checkbox" id="doctor_question_ask_form_accept_rules" class="doctor_question_ask_form_accept_rules">Acepto los términos y condiciones, la política de privacidad y el tratamiento de mis datos</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <button class="btn btn-primary btn-xs-block" type="submit">
                    Enviar pregunta
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-4">
            <div class="media">
              <div class="media-left">
                <i class="fa fa-commenting" aria-hidden="true"></i>
              </div>
              <div class="media-body">
                <h3 class="media-heading">{{ $questionCount }}</h3>
                <p class="text-muted">Preguntas enviadas por los pacientes.</p>
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="media">
              <div class="media-left">
                <i class="fa fa-comments" aria-hidden="true"></i>
              </div>
              <div class="media-body">
                <h3 class="media-heading">{{ $answerCount }}</h3>
                <p class="text-muted">Respuestas ofrecidas por especialistas</p>
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="media">
              <div class="media-left">
                <i class="fa fa-user-md" aria-hidden="true"></i>
              </div>
              <div class="media-body">
                <h3 class="media-heading">{{ count($expertCount) }}</h3>
                <p class="text-muted">Los profesionales de la salud están participando.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End Container -->
    </section>
    <!-- End Section -->
    <section class="inner-pages">
      <div class="container custom">
        <div class="panel panel-default">
          <div class="panel-heading">
            <div class="panel-title">
              ¿Cómo funciona 'Pregunte al experto'?
            </div>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-md-3 col-sm-6">
                <div class="media media-vertical text-center">
                  <div class="media-left w-100">
                    <span class="circle bg-info">1</span>
                  </div>
                  <div class="media-body">
                    <h4 class="media-heading">
                      Los pacientes preguntan
                    </h4>
                    <p class="text-muted">
                      Haga una breve pregunta sobre su problema de salud.
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="media media-vertical text-center">
                  <div class="media-left w-100">
                    <span class="circle bg-info">2</span>
                  </div>
                  <div class="media-body">
                    <h4 class="media-heading">
                      Filtro de moderadores
                    </h4>
                    <p class="text-muted">
                      Las preguntas son verificadas por un moderador y enviadas a los especialistas correspondientes.
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="media media-vertical text-center">
                  <div class="media-left w-100">
                    <span class="circle bg-info">3</span>
                  </div>
                  <div class="media-body">
                    <h4 class="media-heading">
                      Los especialistas responden
                    </h4>
                    <p class="text-muted">
                      Por lo general, una pregunta recibe una respuesta de más de un médico o especialista.
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="media media-vertical text-center">
                  <div class="media-left w-100">
                    <span class="circle bg-info">4</span>
                  </div>
                  <div class="media-body">
                    <h4 class="media-heading">
                      ¡Tu duda está resuelta!
                    </h4>
                    <p class="text-muted">
                      Le informaremos por correo electrónico de las respuestas que reciba.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="inner-pages">
      <div class="container custom">
        <div class="panel panel-default">
          <div class="panel-heading">
            <div class="panel-title">
              Preguntas con más respuestas en los últimos 30 días.
            </div>
          </div>
          <div class="panel-body">
        <?php if ($questionsWithAnswer): ?>
          <?php foreach ($questionsWithAnswer as $key => $question): ?>
            
            <div class="question display-flex flex-row flex-wrap align-items-center align-items-xs-start flex-xs-column">
              <div class="h4 text-base-weight doctor-question-body offset-bottom-2">
                <a href="ask_expert/todo/{{ $question->Q_id }}/{{ str_slug($question->question, '-') }}" class="text-base-color">{{ $question->question }}</a>
              </div>
            </div>
            <div class="answer-container offset-bottom-2">
              <div class="offset-bottom-2">
                <div class="row">
                  <?php 
                    $latestAnswer = DB::table('expert_answers')
                      ->join('employees', 'expert_answers.user_id', '=', 'employees.id')
                      ->select('expert_answers.*', 'employees.*')
                      ->where([['expert_answers.status', 'active'], ['expert_answers.question_id', $question->question_id]])
                      ->orderBy('expert_answers.id', 'DESC')
                      ->first();
                  ?>
                  <?php if ($latestAnswer): ?>
                    <div class="col-sm-4 col-sm-push-8">
                      <div class="media offset-bottom-1">
                        <div class="media-left">
                          <div class="avatar avatar-sm">
                            <?php 
                              if ($latestAnswer->profile_picture != '0') {
                                $profilePic = '/upload/'.$latestAnswer->profile_picture;
                              } else {
                                $profilePic = '/frontend/assets/img/default-doctor_1.png';
                              }
                            ?>
                            <img src="{{ $profilePic }}" class="img-responsive">
                          </div>
                        </div>
                        <div class="media-body">
                          <a href="/doctor_profile_view/<?= $latestAnswer->id.'/'.$latestAnswer->hash_key ?>" class="h5 text-primary offset-bottom-0">{{ $latestAnswer->first_name }}</a>
                          <div class="small text-muted">
                            Psychologist
                          </div>
                          <div class="small text-placeholder">
                            {{ $latestAnswer->city }}
                          </div>
                          <div id="ratings">
                            <span class="ratingXL">
                            <?php 
                              $allReviews = DB::table('review_doctors')->where('doctor_id', $latestAnswer->id);
                              $ratings = $latestAnswer->reviews *20;
                            ?>
                              <span class="rating-avg-large" style="margin-top:3px;margin-left:2px;height: 19px;width:90px;background-position: 0px 1px;background-size: 18px;">
                                <span style="width: <?= (int)$ratings ?>%;background-size: 18px;background-position: 0 -17px;"></span>
                              </span>
                            </span>
                          </div>
                          <div class="offset-top-1">
                            <div class="offset-bottom-1">
                              <a href="/doctor_profile_view/<?= $latestAnswer->id.'/'.$latestAnswer->hash_key ?>#timingsOfDoctor" class="btn btn-primary">
                              Reservar una cita
                              </a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-8 col-sm-pull-4">
                      <div class="doctor-answer-content offset-bottom-1">
                        <div>{{ $latestAnswer->answer }}</div>
                      </div>
                      <a href="ask_expert/todo/{{ $question->Q_id }}/{{ str_slug($question->question, '-') }}">
                      {{ $question->answer_count }} answers
                      </a>
                    </div>
                  <?php endif ?>
                </div>
              </div>
              <hr class="offset-top-1 offset-bottom-0">
            </div>
            <?php endforeach ?>
        <?php endif ?>

          </div>
          <div class="panel-footer text-center">
            <a href="/ask_expert/todo">
            Ver todas las preguntas
            </a>
          </div>
        </div>
      </div>
    </section>
    <section class="inner-pages">
      <div class="container custom">
        <div class="panel panel-default">
          <div class="panel-heading">
            <div class="panel-title">
              Los especialistas más activos en los últimos 30 días.
            </div>
          </div>
          <div class="panel-body">
            <?php if ($activeExperts): ?>
              <?php foreach ($activeExperts as $key => $activeExpert): ?>
                <div class="col-sm-4">
                  <div class="media offset-bottom-1">
                    <div class="media-left">
                      <div class="avatar avatar-sm">
                        <?php 
                          if ($activeExpert->profile_picture != '0') {
                            $profilePic = '/upload/'.$activeExpert->profile_picture;
                          } else {
                            $profilePic = '/frontend/assets/img/default-doctor_1.png';
                          }
                        ?>
                        <img src="{{ $profilePic }}" class="img-responsive">
                      </div>
                    </div>
                    <div class="media-body">
                      <a href="/doctor_profile_view/<?= $activeExpert->id.'/'.$activeExpert->hash_key ?>" class="h5 text-primary offset-bottom-0">
                      {{ $activeExpert->first_name }}
                      </a>
                      <div class="small text-muted">
                        Psicólogo
                      </div>
                      <div class="small text-placeholder">
                        {{ $activeExpert->city }}
                      </div>
                      <div id="ratings">
                        <span class="ratingXL">
                        <?php 
                          $allReviews = DB::table('review_doctors')->where('doctor_id', $latestAnswer->id);
                          $ratings = $latestAnswer->reviews *20;
                        ?>
                          <span class="rating-avg-large" style="margin-top:3px;margin-left:2px;height: 19px;width:90px;background-position: 0px 1px;background-size: 18px;">
                            <span style="width: <?= (int)$ratings ?>%;background-size: 18px;background-position: 0 -17px;"></span>
                          </span>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="media">
                    <div class="media-left last-left">
                      <i class="fa fa-comments" aria-hidden="true"></i>
                    </div>
                    <div class="media-body">
                      <h3 class="media-heading">{{ $activeExpert->answer_count }}</h3>
                      <p class="text-muted">Respuestas ofrecidas en los últimos 30 días.</p>
                    </div>
                  </div>
                </div>
              <?php endforeach ?>
            <?php endif ?>
          </div>
        </div>
      </div>
    </section>
    <section class="inner-pages">
      <div class="container">
        <div class="col-12">
          <p>Todos los contenidos publicados en Psicologos, especialmente las preguntas y respuestas, son informativos y en ningún caso deben considerarse sustitutos de los consejos médicos.</p>
        </div>
      </div>
    </section>
    <!-- Main Content -->
    <footer>
      <div class="footer-sec">
        <!-- footer-sec-top-start -->
        <div class="row login header-sec bg-green-dark">
          <div class="login-footer w-100">
            <div class="container">
              <div class="login-footer-items float-left w-75 order-2">
                <div class="login-footer-links float-left">
                  <ul class="list-unstyled">
                    <li class="d-inline-block float-left text-white"><a href="#">Sobre nosotros</a>|</li>
                    <li class="d-inline-block float-left text-white"><a href="/contact_us">Contacto </a>|</li>
                    <li class="d-inline-block float-left text-white"><a href="/frequently">Preguntas frecuentes </a>|</li>
                    <li class="d-inline-block float-left text-white"><a href="//blog_article">Blog de salud </a>|</li>
                    <li class="d-inline-block float-left text-white"><a href="#">Uso y política de privacidad</a></li>
                  </ul>
                </div>
              </div>
              <div class="brand float-right w-25 order-1">
                <a href="/"><img src="/frontend/assets/img/Original.png" alt="Logo - PSICOLOGOS VIBEMAR"></a>
              </div>
            </div>
          </div>
        </div>
        <!-- footer-sec-top-end -->
        <!-- footer-sec-bottom start -->
        <div class="footer-bottom bg-green">
          <div class="terms-and-conditions text-center">
            <p class="text-white m-0 d-inline-block"><i class="fa fa-copyright" aria-hidden="true"></i>2019 psicologos Internet,SL</p>
            <a href="#" class="text-white">Sobre Nosotros Contáctenos y Política de Privacidad</a>
          </div>
        </div>
      </div>
      <!-- footer-sec-bottom end -->
    </footer>
    <script src="/frontend/assets/js/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="/frontend/assets/js/bootstrap.min.js"></script>
    <script>
      jQuery(document).ready(function($) {
        $('.ask-question-box__text').on('input', function(e) {
          e.preventDefault();
          var $this = $(this);
          var $thisLength = $this.val().length;
          $('.characters_left_count').html(50 - $thisLength);
      
            if ($thisLength > 10) {
              $('.detail_form_hidden').removeClass('hide');
            }
      
            if ($thisLength == 0) {
              $('.characters_left_div').addClass('hide');
            }
      
            if($thisLength > 0) {
              $('.to_short_p').addClass('hide');
              $('.characters_left_div').removeClass('hide');
            }
      
            if ($thisLength > 49) {
              $('.characters_left_div').addClass('hide');
            }
      
        });
      
        
        $('.doctor_question_ask_form').on('submit', function(e) {
          e.preventDefault();
          var $this = $(this);
          var question = $('.ask-question-box__text').val();
          
          if (question.length < 50) {
            $('.to_short_p').removeClass('hide');
          } else {
            $('.form_extra_fields_hidden').removeClass('hide');
            $('.ask-question-box__text, .specialization_id, .doctor_question_ask_form_email, .doctor_question_ask_form_accept_rules').attr('required', '1');

            if ($('.ask-question-box__text').val() != '' && $('.specialization_id').val() != '' && $('.doctor_question_ask_form_email').val() != '') {
              $this[0].submit();
            }
          }
      
        });
      });
      
    </script>
  </body>
</html>