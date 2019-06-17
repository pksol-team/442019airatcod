<?php $user = Auth::user(); ?>
<!DOCTYPE html>
<html lang="en">
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

<section class="inner-pages">
  <div class="container custom">
    <div class="panel-body">
      @if(session()->has('error'))
          <div class="alert alert-danger">
              {!! session()->get('error') !!}
          </div>
      @endif
      @if(session()->has('message'))
          <div class="alert alert-success">
              {!! session()->get('message') !!}
          </div>
      @endif
      <div class="question display-flex flex-row flex-wrap align-items-center align-items-xs-start flex-xs-column">
        <div class="h4 text-base-weight doctor-question-body offset-bottom-2">
          {{ $singleQuestion->question }}
        </div>
      </div>
      <div class="answer-container ">
        <div class="offset-bottom-2">

          <?php 
            $latestAnswer = DB::table('expert_answers')
              ->join('employees', 'expert_answers.user_id', '=', 'employees.id')
              ->select('expert_answers.*', 'employees.*')
              ->where([['expert_answers.status', 'active'], ['expert_answers.question_id', $singleQuestion->id]])
              ->orderBy('expert_answers.id', 'DESC')
              ->paginate(10);

          ?>
          <?php if ($latestAnswer): ?>
            <?php foreach ($latestAnswer as $key => $answerWithDoctor): ?>
              <div class="row">
                <div class="col-sm-4 col-sm-push-8">
                  <div class="media offset-bottom-1">
                    <div class="media-left">
                      <div class="avatar avatar-sm">
                        <?php 
                          if ($answerWithDoctor->profile_picture != '0') {
                            $profilePic = '/upload/'.$answerWithDoctor->profile_picture;
                          } else {
                            $profilePic = '/frontend/assets/img/default-doctor_1.png';
                          }
                        ?>
                        <img src="{{ $profilePic }}" class="img-responsive">
                      </div>
                    </div>
                    <div class="media-body">
                      <a href="/doctor_profile_view/<?= $answerWithDoctor->id.'/'.$answerWithDoctor->hash_key ?>" class="h5 text-primary offset-bottom-0">
                        {{ $answerWithDoctor->first_name }}
                      </a>
                      <div class="small text-muted">
                        Psicólogo
                      </div>
                      <div class="small text-placeholder">
                        {{ $answerWithDoctor->city }}
                      </div>
                      <div id="ratings">
                        <span class="ratingXL">
                        <?php 
                          $allReviews = DB::table('review_doctors')->where('doctor_id', $answerWithDoctor->id);
                          $ratings = $answerWithDoctor->reviews *20;
                        ?>
                          <span class="rating-avg-large" style="margin-top:3px;margin-left:2px;height: 19px;width:90px;background-position: 0px 1px;background-size: 18px;">
                            <span style="width: <?= (int)$ratings ?>%;background-size: 18px;background-position: 0 -17px;"></span>
                          </span>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-8 col-sm-pull-4">
                  <div class="doctor-answer-content offset-bottom-1">
                    <div>{{ $answerWithDoctor->answer }}</div>
                  </div>
                </div>
              </div>
              <hr />
            <?php endforeach ?>
          <?php endif ?>
          <nav aria-label="Page navigation" class="page-navigation">
            {{ $latestAnswer->links() }}
          </nav>
          <?php if (Auth::check() && $EmpTbl): ?>
            <div class="premium_reply_div">
              <hr />
              <div class="row">
                <div class="col-10">
                  <form action="/question_reply" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="question_id" value="{{ $singleQuestion->id }}" />
                    <input type="hidden" name="asked_by" value="{{ $singleQuestion->user_id }}" />
                    <input type="hidden" name="user_id" value="{{ $EmpTbl->id }}" />
                    <textarea name="premium_reply" id="premium_reply" cols="5" rows="3" class="form-control" placeholder="Contestarlo" required></textarea>
                    <button class="btn btn-success float-right mt-3" type="submit">Respondedor</button>
                  </form>
                </div><!-- /.col-8 -->
                <div class="col-2">
                  <?php 
                    if ($EmpTbl->profile_picture != '0') {
                      $profilePic = '/upload/'.$EmpTbl->profile_picture;
                    } else {
                      $profilePic = '/frontend/assets/img/default-doctor_1.png';
                    }
                  ?>
                  <img src="{{ $profilePic }}" class="rounded border w-50">
                </div><!-- /.col-8 -->
              </div><!-- /.row -->
              <hr />
            </div>
          <?php endif ?>
          
        </div>
      </div>
    </div>
  </div>
</section>


<?php if ($relatedQuestions): ?>  
<section class="inner-pages">
  <div class="container custom">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h2 class="panel-title">
          Preguntas relacionadas
        </h2>
      </div>
      <div class="panel-body">
        <ul class="padding-left-2">
          <?php foreach ($relatedQuestions as $key => $relatedQuestion): ?>
            <li class="offset-bottom-1">
              <a href="ask_expert/todo/{{ $relatedQuestion->id }}/{{ str_slug($relatedQuestion->question, '-') }}">
                {{ $relatedQuestion->question }}
              </a>
            </li>
          <?php endforeach ?>
        </ul>
      </div>
    </section>
<?php endif ?>


<section class="inner-pages">
  <div class="container custom">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h2 class="panel-title">¿Quieres enviar tu pregunta?</h2>
      </div>
      <div class="panel-body">
        Our experts have answered {{ count($latestAnswer) }} questions about <span>{{ $singleQuestion->specialty }}</span>
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
                      <label for="doctor_question_ask_form_email" class="required">¿Cuál es la dirección de correo electrónico?</label>
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
    </div>
  </div>
</section>

<section class="inner-pages">
  <div class="container">
    <p>
      Todos los contenidos publicados en Psicologos, especialmente las preguntas y respuestas, son informativos y en ningún caso deben considerarse sustitutos de los consejos médicos.
    </p>
  </div>
</section>

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

<!--------------- Javascripts --------------->
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
<!--------------- Javascripts --------------->
</body>
</html>