<?php
namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use App\Models\SotobaItem;
use App\Models\PaymentRequestService;
use Lang;

class ReportController extends Controller
{
  public $routePrefix = 'manage.report';
  public $viewPrefix = 'manage.report';
  public $module = 'report';

  public function sotobaDaily(Request $request)
  {
    $obj = new SotobaItem();
    $rsUtil = new \App\Utils\RequestServiceUtil();
    $data = [];
    $filters = $request->query('filters');
    
    if(!isset($filters['conducted_at']) || !$filters['conducted_at']) {
      $currDate = \App\Utils\DateUtil::dateTimeNow('date');
      $filters['conducted_at'] = $currDate;
    }
    $filters['status'] = "in_process";
    $filters['done_at'] = "in_null";
    $obj->fill($filters);
    $data = $obj->filter($filters, [
      'pagination' => false,
    ]);

    if($request->done) $rsUtil->done($data);
    $data = $obj->filter($filters, [
      'pagination' => false,
    ]);
    
    return view($this->viewPrefix.'.sotoba-daily', [
      'obj' => $obj,
      'data' => $data,
      'routePrefix' => $this->routePrefix,
      'viewPrefix' => $this->viewPrefix
    ]);
  }

  public function serviceDaily(Request $request)
  {
    $obj = new SotobaItem();
    $rsUtil = new \App\Utils\RequestServiceUtil();
    $filters = $request->query('filters');
    
    if(!isset($filters['conducted_at']) || !$filters['conducted_at']) {
      $currDate = \App\Utils\DateUtil::dateTimeNow('date');
      $filters['conducted_at'] = $currDate;
    }
    $filters['status'] = "in_process";
    $filters['done_at'] = "in_null";
    $data = $rsUtil->getDailyService($filters);

    if($request->done) $rsUtil->done($data);
    $data = $rsUtil->getDailyService($filters);
    
    return view($this->viewPrefix.'.service-daily', [
      'obj' => $obj,
      'data' => $data,
      'routePrefix' => $this->routePrefix,
      'viewPrefix' => $this->viewPrefix
    ]);
  }
  
  public function paymentRequestService(Request $request)
  {
    $obj = new PaymentRequestService();
    $data = [];
    $filters = $request->query('filters');

    if($filters) {
      if(!isset($filters['pay_at_start']) || !isset($filters['pay_at_end']) && !$filters['pay_at_start'] || !$filters['pay_at_end']) {
        $currMonthDateRange = \App\Utils\DateUtil::currMonthDateRange();
        $filters['pay_at_start'] = $currMonthDateRange[0];
        $filters['pay_at_end'] = $currMonthDateRange[1];
      }

      switch($request->query('export_type')) {
        case 'filter':
          $obj->fill($filters);
    
          $data = $obj->filter($filters, [
            'pagination' => false,
          ]);
    
          return view($this->viewPrefix.'.payment-request-service', [
            'obj' => $obj,
            'data' => $data,
            'routePrefix' => $this->routePrefix,
            'viewPrefix' => $this->viewPrefix
          ]);
          break;
        case 'export_by_service_and_place':
          $data = PaymentRequestService::getReportByServiceAndPlace($filters['pay_at_start'], $filters['pay_at_end']);
          $exportUtil = new \App\Utils\ExportUtil('csv');
          $exportUtil->exportCsv($data, ['file_name' => 'report_by_service_and_place_'.$filters['pay_at_start'].'_'.$filters['pay_at_end'].'.csv']);

          break;

      }
    } else {
      return view($this->viewPrefix.'.payment-request-service', [
        'obj' => $obj,
        'data' => $data,
        'routePrefix' => $this->routePrefix,
        'viewPrefix' => $this->viewPrefix
      ]);
    }
  }
}