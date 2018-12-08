<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: yajima
 * Date: 2018-9月-22
 * Time: 0:28
 */
?><!doctype html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>音感テスト</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="<?php echo base_url('css/style.css'); ?>">

    <!-- Google Web Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Kosugi+Maru|M+PLUS+Rounded+1c&amp;subset=japanese" rel="stylesheet">
    <style type="text/css">
        .container {
            /* font-family: 'Kosugi Maru', sans-serif; */
            font-family: 'M PLUS Rounded 1c', sans-serif;
        }
    </style>
</head>
<body>
<!-- header -->
<header>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a class="navbar-brand" href="#">音感テスト</a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item <?php if (uri_string() == 'settings'): ?>active<?php endif; ?>">
                </li>
                <li class="nav-item">
                </li>
            </ul>
            <span class="navbar-text">満点目指して頑張りましょう！</span>
        </div>
    </nav>
</header>
<!-- /header -->

<!-- Audio load -->
<?php foreach ($audios as $audio) : ?>
<audio id="<?php echo 'audio-'.$audio; ?>">
    <source src="<?php echo base_url('audio/'.$audio.'.ogg'); ?>" type="audio/ogg">
    <source src="<?php echo base_url('audio/'.$audio.'.m4a'); ?>" type="audio/mpeg">
    <source src="<?php echo base_url('audio/'.$audio.'.WAV'); ?>" type="audio/wav">
</audio>
<?php endforeach; ?>
<!-- /Audio load -->

<!-- Container -->
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h1>テストをはじめるよ</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <?php if ($result == "ok") : ?>
        <div class="col-sm-6 text-center" id="result">
            <img src="<?php echo base_url('img/animal_quiz_usagi_maru.png'); ?>" height="200">
            <p class="alert alert-success">せいかい</p>
            <p>そのちょうし！がんばって！</p>
        </div>
        <?php elseif ($result == "ng") : ?>
        <div class="col-sm-6 text-center" id="result">
            <img src="<?php echo base_url('img/animal_quiz_usagi_batsu.png'); ?>" height="200">
            <p class="alert alert-danger">まちがい</p>
            <p>つぎのもんだいをよくきいて</p>
        </div>
        <?php endif; ?>
    </div>
    <div class="row justify-content-center">
        <div class="col-sm-6 text-center">
            <h3>もんだい.<?php echo count($this->session->score) + 1; ?></h3>
            <a href="#" class="btn btn-lg btn-danger mb-3" id="play_mondai">もんだいをきく</a>
            <p id="mondai_help_text">うえのボタンをおして、もんだいをきこう。</p>
        </div>
    </div>
    <div id="answer_area" class="collapse fade">
    <?php echo form_open(uri_string(),NULL,array('mondai'=>$mondai)); ?>
        <div class="row justify-content-center">
            <div class="col-sm-6 text-center">
                <h3>こたえをおしてね。</h3>
            </div>
        </div>
    <?php foreach ($octaves as $octave) : ?>
        <?php if ($this_octave == $octave) : ?>
        <div class="row">
            <h3>オクターブ&nbsp;<?php echo $octave; ?></h3>
        </div>
        <div class="row mb-3">
            <div class="col-sm-1"><button type="submit" name="ans" value="do<?php echo $octave; ?>" class="btn btn-block btn-secondary">ド</button></div>
            <div class="col-sm-1"><button type="submit" name="ans" value="cis<?php echo $octave; ?>" class="btn btn-block btn-dark">チス</button></div>
            <div class="col-sm-1"><button type="submit" name="ans" value="re<?php echo $octave; ?>" class="btn btn-block btn-secondary">レ</button></div>
            <div class="col-sm-1"><button type="submit" name="ans" value="es<?php echo $octave; ?>" class="btn btn-block btn-dark">エス</button></div>
            <div class="col-sm-1"><button type="submit" name="ans" value="mi<?php echo $octave; ?>" class="btn btn-block btn-secondary">ミ</button></div>
            <div class="col-sm-1"><button type="submit" name="ans" value="fa<?php echo $octave; ?>" class="btn btn-block btn-secondary">ファ</button></div>
            <div class="col-sm-1"><button type="submit" name="ans" value="fis<?php echo $octave; ?>" class="btn btn-block btn-dark">フィス</button></div>
            <div class="col-sm-1"><button type="submit" name="ans" value="so<?php echo $octave; ?>" class="btn btn-block btn-secondary">ソ</button></div>
            <div class="col-sm-1"><button type="submit" name="ans" value="gis<?php echo $octave; ?>" class="btn btn-block btn-dark">ギス</button></div>
            <div class="col-sm-1"><button type="submit" name="ans" value="la<?php echo $octave; ?>" class="btn btn-block btn-secondary">ラ</button></div>
            <div class="col-sm-1"><button type="submit" name="ans" value="b<?php echo $octave; ?>" class="btn btn-block btn-dark">ベー</button></div>
            <div class="col-sm-1"><button type="submit" name="ans" value="si<?php echo $octave; ?>" class="btn btn-block btn-secondary">シ</button></div>
        </div>
        <?php endif; ?>
    <?php endforeach; ?>
    <?php echo form_close(); ?>
    </div>
</div>
<!-- /Container -->

<!-- Bootstrap core JavaScript ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script
        src="http://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<!-- /Bootstrap -->

<script type="text/javascript">
    var mondai_audio = document.getElementById('audio-<?php echo $mondai; ?>');
    var play_button = document.getElementById('play_mondai');
    var answer_area = document.getElementById('answer_area');
    var result_area = document.getElementById('result');

    function play_mondai() {
        $('#mondai_help_text').text("もんだいをきいてね。");

        // 音を再生
        mondai_audio.play();

        // 解答欄をアクティブ
        mondai_audio.addEventListener("ended", function() {
            $('#mondai_help_text').text("うえのボタンをおして、もんだいをきこう。");
            answer_area.setAttribute('class','collapse show fade');
        }, false);

    }

    play_button.addEventListener('click', function () {
        play_mondai();
    }, false);

    /* bootstrap alertをx秒後に消す */
    $(document).ready(function()
    {
        $(window).on('load',function()
        {
            window.setTimeout("$('#result').fadeOut()", 1500);
        });
    });
</script>
</body>
</html>