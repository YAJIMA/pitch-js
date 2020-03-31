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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

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

<!-- Container -->
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h1>テストのけっか</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-sm-12 text-center">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>問題</th>
                        <th>回答</th>
                        <th>正誤</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php for ($i = 1; $i < 11; $i++) : ?>
                    <tr>
                        <td><?php echo $this->session->oldscore[$i]['mondai_str']; ?></td>
                        <td><?php echo $this->session->oldscore[$i]['ans_str']; ?></td>
                        <td class="<?php echo $this->session->oldscore[$i]['result']; ?>"><?php echo $this->session->oldscore[$i]['result']; ?></td>
                    </tr>
                    <?php endfor; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /Container -->

<!-- Bootstrap core JavaScript ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!-- /Bootstrap -->
</body>
</html>