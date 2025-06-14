<?php
namespace App\Utils;

use App\Helpers\ApplicationConstant;
use DB;

class MailRemainderUtil
{

  public static function paymentRemainder()
  {
    $requestServiceString = '';
    $receivers = \App\Models\RequestService::undonePaymentRemainders();

    if(count($receivers) < 1)
      return true;

    foreach($receivers as $email => $requestServices) {
      $name = $requestServices[0]['user']->name;
      $requestServiceString = '';
      foreach($requestServices as $requestService)
        $requestServiceString .= $requestService['request_code'].'('.$requestService['status'].') '.$requestService['service_name'].' : '.$requestService['cost'].'('.$requestService['staff_url'].'?openExternalBrowser=1)
';

      \App\Models\MailTemplate::sendPaymentRemainder(
        [
          'receiver' => [
            'name' => $name,
            'email' => $email
          ],
          'undone_payments' => $requestServiceString,
          'name' => $name,
        ],
      );
    }
  }

  public static function pendingRequestRemainder()
  {
    $requestServiceString = '';
    $receivers = \App\Models\RequestService::undonePaymentRemainders();

    if(count($receivers) < 1)
      return true;

    foreach($receivers as $email => $requestServices) {
      $name = $requestServices[0]['user']->name;
      $requestServiceString = '';
      foreach($requestServices as $requestService)
        $requestServiceString .= $requestService['request_code'].'('.$requestService['status'].') '.$requestService['service_name'].' : '.$requestService['cost'].'('.$requestService['staff_url'].'?openExternalBrowser=1)
';

      \App\Models\MailTemplate::sendPaymentRemainder(
        [
          'receiver' => [
            'name' => $name,
            'email' => $email
          ],
          'undone_payments' => $requestServiceString,
          'name' => $name,
        ],
      );
    }
  }

  public static function mailChecker() 
  {
    $receivers = [
      'hendraimz@gmail.com',
    ];

    $admins = \App\Models\Admin::select('email')
      ->where('is_active', 1)
      ->get();

    $today = date('Y-m-d');
    foreach($receivers as $receiver) {
      \App\Models\MailTemplate::sendMailChecker(
        [
          'receiver' => [
            'name' => $receiver,
            'email' => $receiver
          ],
          'today' => $today,
        ],
      );
    }
  }

}