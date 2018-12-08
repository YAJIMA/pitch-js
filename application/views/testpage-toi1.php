<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="ja">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<title>音感テスト01</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/style.css'); ?>">
</head>
<body>

<div id="container">
	<h1>テストページ <?php echo $mondai; ?></h1>

    <div class="dleft">
        <button id="btn" data-key="32">問題を再生</button>
    </div>
    <div class="dright">
        <button id="next">次の問題へ</button>
    </div>

    <div id="result"></div>

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

    <audio id="sound-file" preload="auto">
        <source src="<?php echo base_url(); ?>audio/se_maoudamashii_onepoint15.mp3" type="audio/mp3">
    </audio>
    <script type="text/javascript" src="<?php echo base_url('js/Tone.min.js'); ?>"></script>
    <script type="text/javascript">
        (function() {

            var btn = document.getElementById('btn');
            var keyboard = document.getElementById('piano');
            var state = false;  // 状態監視用フラグ
            var synth;
            var div;  // div要素の格納

            var next = document.getElementById('next');

// 「電源ON」ボタンのイベント処理
            btn.addEventListener('touchstart', init);
            btn.addEventListener('click', init);


// 「押した」状態のイベント処理
            window.addEventListener('keydown', playSound);
            window.addEventListener('mousedown', playSound);
            window.addEventListener('touchstart', playSound);


// 「離した」状態のイベント処理
            window.addEventListener('keyup', offSound);
            window.addEventListener('mouseup', offSound);
            window.addEventListener('touchend', offSound);

            // 新しい問題に移動
            next.addEventListener('touchstart', nextpage);
            next.addEventListener('click', nextpage);

// 初期設定
            function init() {
                state = true;
                synth = new Tone.Synth().toMaster();
                // btn.style.display = 'none';
                keyboard.style.opacity = 1;

                synth.triggerAttackRelease('<?php echo $mondai; ?>', '8n');
            }

            function nextpage() {
                window.location.reload();
            }

            function playSound(e) {
                if(!state) return;  // falseなら処理を実行しない

                // 「キーボード」はkeyCodeを、「マウス」はdata属性を取得する
                var key = e.keyCode || e.target.dataset.key;

                // 「key」を使って「div要素」を取得する
                div = document.querySelector('div[data-key="'+ key +'"]');

                // 「div要素」が取得できたかチェック
                if(div) {

                    // div要素のテキスト(音名)を代入する
                    synth.triggerAttackRelease(div.textContent, '8n');

                    // 判定
                    if(div.textContent === '<?php echo $mondai; ?>') {
                        var audio = document.getElementById('sound-file');
                        audio.volume = 0.2;
                        audio.play();

                        var resultDOM = document.getElementById('result');
                        resultDOM.textContent = '正解!';
                        resultDOM.style.color = '#F00';
                        resultDOM.style.fontSize = '120%';
                        resultDOM.style.textAlign = 'center';
                    }

                    // 状態をfalseにして、連続的な発音を防止する
                    state = false;
                    div.classList.add('activekey');

                }
            }

            function offSound(e) {
                if(div) {
                    state = true;  // 再度、発音できるようにtrueへ戻す
                    div.classList.remove('activekey');
                }
                e.preventDefault(); //スマホの画面拡大防止
            }

        })();
    </script>

</div>

</body>
</html>