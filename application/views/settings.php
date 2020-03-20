<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container-fluid">
    <div class="row">
        <nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">
            <p>&nbsp;</p>
            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a class="nav-link <?php if (uri_string() == 'settings/problems'): ?>active<?php endif; ?>" href="<?php echo base_url('settings/problems'); ?>">問題設定</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if (uri_string() == 'settings/users'): ?>active<?php endif; ?>" href="<?php echo base_url('settings/users'); ?>">生徒設定</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if (uri_string() == 'settings/summaries'): ?>active<?php endif; ?>" href="<?php echo base_url('settings/summaries'); ?>">集計設定</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if (uri_string() == 'settings/commons'): ?>active<?php endif; ?>" href="<?php echo base_url('settings/commons'); ?>">その他設定</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if (uri_string() == 'summaries'): ?>active<?php endif; ?>" href="<?php echo base_url('summaries'); ?>">集計</a>
                </li>
            </ul>
        </nav>

        <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
            <h1>設定ページ</h1>
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-2">生徒設定</h5>
                            <p class="card-text">システム内で使用する生徒さんの氏名を登録できます。</p>
                            <a href="<?php echo base_url('settings/users'); ?>" class="card-link">生徒設定</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-2">問題設定</h5>
                            <p class="card-text">音感テストの種別を生徒さんごとに設定できます。</p>
                            <a href="<?php echo base_url('settings/problems'); ?>" class="card-link">問題設定</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-2">集計</h5>
                            <p class="card-text">音感テストの集計結果を確認できます。</p>
                            <a href="<?php echo base_url('summaries'); ?>" class="card-link">集計</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-2">新しい生徒の読み込み</h5>
                            <p class="card-text">新しく追加された生徒の設定を読み込むには下のボタンを押してください。<br>
                                リンク先のページが読み込み終わったら、そのページは閉じて、この画面に戻ってください。</p>
                            <a href="<?php echo base_url('enter/aroundregi'); ?>" class="card-link" target="_blank">生徒の設定を読み込む</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <p>
                        その他、取り扱い説明書は、下のリンクからご確認ください。<br>
                    </p>
                    <a href="https://docs.google.com/document/d/1ZOhbvsK1doVc-ecKaxXjEDydwP_rLyJQ_XMLrXMwaRc/edit?usp=sharing" target="_blank" >テストマニュアル</a>
                </div>
            </div>
        </main>
    </div>
</div>
