<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$answerIcon = array(
    'do1' => 'ド 1',
    'cis1' => 'シス 1',
    're1' => 'レ 1',
    'es1' => 'エス 1',
    'mi1' => 'ミ 1',
    'fa1' => 'ファ 1',
    'fis1' => 'フィス 1',
    'so1' => 'ソ 1',
    'gis1' => 'ギス 1',
    'la1' => 'ラ 1',
    'b1' => 'ベー 1',
    'si1' => 'シ 1',
    'do2' => 'ド 2',
    'cis2' => 'シス 2',
    're2' => 'レ 2',
    'es2' => 'エス 2',
    'mi2' => 'ミ 2',
    'fa2' => 'ファ 2',
    'fis2' => 'フィス 2',
    'so2' => 'ソ 2',
    'gis2' => 'ギス 2',
    'la2' => 'ラ 2',
    'b2' => 'ベー 2',
    'si2' => 'シ 2',
    'do3' => 'ド 3',
    'cis3' => 'シス 3',
    're3' => 'レ 3',
    'es3' => 'エス 3',
    'mi3' => 'ミ 3',
    'fa3' => 'ファ 3',
    'fis3' => 'フィス 3',
    'so3' => 'ソ 3',
    'gis3' => 'ギス 3',
    'la3' => 'ラ 3',
    'b3' => 'ベー 3',
    'si3' => 'シ 3',
    'do4' => 'ド 4',
    'cis4' => 'シス 4',
    're4' => 'レ 4',
    'es4' => 'エス 4',
    'mi4' => 'ミ 4',
    'fa4' => 'ファ 4',
    'fis4' => 'フィス 4',
    'so4' => 'ソ 4',
    'gis4' => 'ギス 4',
    'la4' => 'ラ 4',
    'b4' => 'ベー 4',
    'si4' => 'シ 4',
    'do5' => 'ド 5',
    'cis5' => 'シス 5',
    're5' => 'レ 5',
    'es5' => 'エス 5',
    'mi5' => 'ミ 5',
    'fa5' => 'ファ 5',
    'fis5' => 'フィス 5',
    'so5' => 'ソ 5',
    'gis5' => 'ギス 5',
    'la5' => 'ラ 5',
    'b5' => 'ベー 5',
    'si5' => 'シ 5',
    'wakaranai' =>'？'
);
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
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('summaries/date/'.$sakunendo_1.'/'.$sakunendo_0); ?>">昨年度</a>
                </li>
            </ul>
        </nav>

        <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
            <h1><?php echo $page_title; ?></h1>

            <?php if ( ! empty($start_date) && ! empty($end_date)) : ?>
                <p><?php echo $start_date; ?> 〜 <?php echo $end_date; ?></p>
            <?php endif; ?>

            <div id="result-data">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>生徒名 / テストの種類 / 実施日時</th>
                        <th>スコア</th>
                        <th colspan="11">結果</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (count($results) === 0) : ?>
                        <tr>
                            <td colspan="14">
                                <p>対象の集計データがありません。</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php foreach ($results as $item) : ?>
                    <tr>
                        <td class="text-center va-m" rowspan="3"><?php echo $item['id']; ?></td>
                        <td>
                            <a href="<?php echo base_url('summaries/user_id/'.$item['user_id']); ?>">
                            <?php echo ( ! empty($item['realname'])) ? $item['realname'] : $item['user_name']; ?>
                            </a>
                        </td>
                        <td class="text-center va-m" rowspan="3">
                            <span style="font-size: 36px;"><?php echo $item['score']; ?></span>
                        </td>
                        <td class="text-center">問題</td>
                        <?php foreach ($item['result_raw'] as $val) : ?>
                            <td class="text-center"><?php echo $answerIcon[$val['mondai']]; ?></td>
                        <?php endforeach; ?>
                    </tr>
                    <tr>
                        <td><?php echo $item['test_name']; ?></td>
                        <td class="text-center">回答</td>
                        <?php foreach ($item['result_raw'] as $val) : ?>
                            <td class="text-center"><?php echo $answerIcon[$val['ans']]; ?></td>
                        <?php endforeach; ?>
                    </tr>
                    <tr>
                        <td><?php echo $item['date_format']; ?></td>
                        <td class="text-center">正誤</td>
                        <?php foreach ($item['result_raw'] as $val) : ?>
                            <td class="text-center <?php if ($val['result'] == "ok") : ?>text-success<?php endif; ?>"><?php echo ($val['result'] === "ok") ? "○" : "×"; ?></td>
                        <?php endforeach; ?>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>
