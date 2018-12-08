<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="ja">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/style.css'); ?>">
</head>
<body>

<div id="container">
	<h1>テストページ</h1>

    <button id="btn">START</button>

	<div id="piano">
        <div data-key="65" class="pianokey"><span class="text">C3</span></div>
        <div data-key="87" class="pianokey sharp"><span class="text">C#3</span></div>
        <div data-key="83" class="pianokey"><span class="text">D3</span></div>
        <div data-key="69" class="pianokey sharp"><span class="text">D#3</span></div>
        <div data-key="68" class="pianokey"><span class="text">E3</span></div>
        <div data-key="70" class="pianokey"><span class="text">F3</span></div>
        <div data-key="84" class="pianokey sharp"><span class="text">F#3</span></div>
        <div data-key="71" class="pianokey"><span class="text">G3</span></div>
        <div data-key="89" class="pianokey sharp"><span class="text">G#3</span></div>
        <div data-key="72" class="pianokey"><span class="text">A3</span></div>
        <div data-key="85" class="pianokey sharp"><span class="text">A#3</span></div>
        <div data-key="74" class="pianokey"><span class="text">B3</span></div>
	</div>


    <script type="text/javascript" src="<?php echo base_url('js/Tone.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('js/app.js'); ?>"></script>

    <div><a href="<?php echo base_url('testpage/toi1'); ?>">問題ページに移動</a></div>
</div>

</body>
</html>