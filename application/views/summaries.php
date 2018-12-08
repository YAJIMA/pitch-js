<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container-fluid">
    <div class="row">
        <nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">
            <p>&nbsp;</p>
            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('summaries/date/'.$kongetsu_1.'/'.$kongetsu_0); ?>">今月</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('summaries/date/'.$sengetsu_1.'/'.$sengetsu_0); ?>">先月</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('summaries/date/'.$nendo_1.'/'.$nendo_0); ?>">今年度</a>
                </li>
            </ul>
        </nav>

        <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
            <h1>集計ページ</h1>

            <?php if ( ! empty($start_date) && ! empty($end_date)) : ?>
                <p><?php echo $start_date; ?> 〜 <?php echo $end_date; ?></p>
            <?php endif; ?>

            <div id="result-data">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>生徒名 / テスト / 実施日時</th>
                        <th>スコア</th>
                        <th>結果</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (count($results) === 0) : ?>
                        <tr>
                            <td colspan="4">
                                <p>対象の集計データがありません。</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php foreach ($results as $item) : ?>
                    <tr>
                        <td><?php echo $item['id']; ?></td>
                        <td>
                            <a href="<?php echo base_url('summaries/user_id/'.$item['user_id']); ?>">
                            <?php echo ( ! empty($item['realname'])) ? $item['realname'] : $item['user_name']; ?>
                            </a><br>
                            <?php echo $item['test_name']; ?><br>
                            <?php echo $item['date_format']; ?>
                        </td>
                        <td><?php echo $item['score']; ?></td>
                        <td>
                            <?php foreach ($item['result_raw'] as $val) : ?>
                            <div class="row <?php if ($val['result'] == "ok") : ?>text-success<?php endif; ?>">
                                <div class="col-sm-4" >問題 : <?php echo $val['mondai']; ?></div>
                                <div class="col-sm-4" >回答 : <?php echo $val['ans']; ?></div>
                                <div class="col-sm-4" >正誤 : <?php echo $val['result']; ?></div>
                            </div>
                            <?php endforeach; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>
