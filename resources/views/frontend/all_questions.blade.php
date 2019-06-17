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
    <div class="panel-heading">
      <div class="row">
        <div class="col-sm-3 col-xs-6">
          <h3>{{ $questionCount }}</h3>
          <div class="text-placeholder">
            Pregunta realizada
          </div>
        </div>
        <div class="col-sm-3 col-xs-6">
          <h3>{{ $answerCount }}</h3>
          <div class="text-placeholder">
            Respuesta aportada
          </div>
        </div>
      </div>
    </div>

    <?php if ($questionsWithAnswer): ?>

      <?php foreach ($questionsWithAnswer as $key => $question): ?>
        
        <div class="panel-body">
          <div class="row">
            <div class="col-md-10">
              <div class="question display-flex flex-row flex-wrap align-items-center align-items-xs-start flex-xs-column">
                <div class="h4 text-base-weight doctor-question-body offset-bottom-2">
                  <a href="todo/{{ $question->id }}/{{ str_slug($question->question, '-') }}" class="text-base-color">{{ $question->question }}</a>
                </div>
              </div>
            </div>
          </div>
          <?php 
            $latestAnswer = DB::table('expert_answers')
              ->join('employees', 'expert_answers.user_id', '=', 'employees.id')
              ->select('expert_answers.*', 'employees.*')
              ->where([['expert_answers.status', 'active'], ['expert_answers.question_id', $question->id]])
              ->orderBy('expert_answers.id', 'DESC')
              ->first();
            ?>
          <?php if ($latestAnswer): ?>
          <div class="row col-md-10">
            <div class="no-border col-12 col-md-1">
              <?php
                if ($latestAnswer->profile_picture != '0') {
                  $profilePic = '/upload/'.$latestAnswer->profile_picture;
                } else {
                  $profilePic = '/frontend/assets/img/default-doctor_1.png';
                }
              ?>
              <img src="{{ $profilePic }}" class="img-responsive">
            </div>
            <div class="question__answer col-12 col-md-10">
              <h3 class="text-base-weight text-base-size offset-bottom-0">
                <a href="/doctor_profile_view/<?= $latestAnswer->id.'/'.$latestAnswer->hash_key ?>" class="text-base-color">
                  <strong>{{ $latestAnswer->first_name }}</strong>
                </a>
                <span class="question__date text-muted">
                {{ $latestAnswer->created_at }}
                </span>
              </h3>
                <p></p>
            </div>
          </div>
          <?php endif ?>
        </div>
        <hr>
      <?php endforeach ?>
      
    <?php endif ?>
      <nav aria-label="Page navigation" class="page-navigation">
        {{ $questionsWithAnswer->links() }}
      </nav>
    </div>
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
<!--------------- Javascripts --------------->
</body>
</html>