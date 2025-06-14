<?php
namespace App\Utils;

use App\Helpers\ApplicationConstant;

class LineRemainderUtil
{
  public static function send($text, $params)
  {
    $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient(env('LINE_SECRET'));
    $bot = new \LINE\LINEBot($httpClient, ['channelSecret' => env('LINE_CHANNEL_SECRET')]);
    $lineTargets = \App\Models\LineTarget::where(['is_active' => 1])->get();
    foreach($lineTargets as $lineTarget) {
        $params['target'] = $lineTarget['name'];
        $contain = \App\Utils\StringUtil::replaceTemplateVariable($text, $params);
        $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($contain);
        $response = $bot->pushMessage($lineTarget->uid, $textMessageBuilder);
    }
  }

  public static function sendJobRemainder()
  {
    $contain = "🌄 おはようございます 🌞😎。
和心のロボットアシスタント(".env("APP_ENV").")です。 🤖
%target%、お疲れ様です。

📢本日の勤務内容のリマインダーをします。📢
本日仕事内容は下の一覧に各自確認お願いします。

```
今日（%today%）の業務表一覧
```
%job_list%
業務終了したら、勤務表の入力と申請をしてください。

お知らせは以上です。";
    $jobListString = '';
    $today = date('Y-m-d');
    $jobs = \App\Utils\JobUtil::todayJobList();
    if(count($jobs) < 1)
      return true;

    $i = 1;
    foreach($jobs as $row) {
      $jobListString .= $i.'. *'.$row['user'].'* : '.$row['place'].' _'.$row['time_start'].'_
('.$row['job_type'].')
'.$row['staff_url'].'?openExternalBrowser=1
';
      $i++;
    }

    $params = [
        'job_list' => $jobListString,
        'today' => date('Y年m月d日')
    ];
    self::send($contain, $params);

  }

  public static function sendJobSubmissionRemainder()
  {
    $contain = "🌃 こんばんは 🌛😪。
和心のロボットアシスタント(".env("APP_ENV").")です。 🤖
%target%、お疲れ様です。

📢本日の勤務申請のリマインダーをします。📢
当時までの勤務申請まだしない各自にお知らせします。

```
当時（%now%）の勤務申請まだしない一覧
```
%job_list%
早めに勤務表の入力と申請をしてください。

お知らせは以上です。";
    $jobListString = '';
    $today = date('Y-m-d');
    $jobs = \App\Utils\JobUtil::nowJobUnfinishedList();
    if(count($jobs) < 1)
      return true;

    $i = 1;
    foreach($jobs as $row) {
      $jobListString .= $i.'. *'.$row['user'].'* : '.$row['place'].' _'.$row['time_start'].'_
('.$row['job_type'].')
'.$row['staff_url'].'?openExternalBrowser=1
';
      $i++;
    }

    $params = [
        'job_list' => $jobListString,
        'now' => date('Y年m月d日 H:i')
    ];
    self::send($contain, $params);

  }

  public static function sendWaitingApprovalRemainder()
  {
    $contain = "🌃 こんばんは 🌛😪。
和心のロボットアシスタント(".env("APP_ENV").")です。 🤖
%target%、お疲れ様です。

📢本日の勤務承認待ちのリマインダーをします。📢
当時までの勤務表の対応まだしないAdminたちににお知らせします。

```
当時（%now%）の勤務申請の対応まだしない一覧
```
%job_list%
早めに勤務表の申請の対応をしてください。

お知らせは以上です。";
    $jobListString = '';
    $today = date('Y-m-d');
    $jobs = \App\Utils\JobUtil::nowJobWaitingApprovalList();
    if(count($jobs) < 1)
      return true;

    $i = 1;
    foreach($jobs as $row) {
      $jobListString .= $i.'. *'.$row['user'].'* : '.$row['place'].' _'.$row['time_start'].'_
('.$row['job_type'].')
'.$row['manage_url'].'?openExternalBrowser=1
';
      $i++;
    }

    $params = [
        'job_list' => $jobListString,
        'now' => date('Y年m月d日 H:i')
    ];
    self::send($contain, $params);

  }
}