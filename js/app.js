(function() {

    var btn = document.getElementById('btn');
    var keyboard = document.getElementById('piano');
    var state = false;  // 状態監視用フラグ
    var synth;
    var div;  // div要素の格納


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


// 初期設定
    function init() {
        state = true;
        synth = new Tone.Synth().toMaster();
        btn.style.display = 'none';
        keyboard.style.opacity = 1;
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