<?php
namespace App\Utils;

use App\Helpers\ApplicationConstant;
use App\Utils\DateTimeInherit;
use DateInterval;
use DB;
use Illuminate\Support\Collection;
use App\Models\RequestService;
use App\Models\Gojukai;
use App\Models\Kankai;
use App\Models\DeathAnniversary;
use App\Models\Gohifu;
use App\Models\ReceiveGohonzon;

class RequestServiceUtil
{
    public static function getDataByStatus($status)
    {
        $list = [];

        $requestServices =  RequestService::where('status', $status)->get();
        return $requestServices;
    }

    public static function getForm($serviceId)
    {
        $viewName = self::getView($serviceId);
        $formName = 'components.pages.requestService._'.$viewName.'-form';
        
        return $formName;
    }

    public static function getModel($serviceId)
    {
        $model = '\\App\\Models\\';
        switch($serviceId) {
          case 1:
            $model .= 'Gojukai';
            break;
          case 2:
            $model .= 'Kankai'; 
            break;
          case 3:
            $model .= 'ReceiveGohonzon'; 
            break;
          case 4:
            $model .= 'RepairJutzu'; 
            break;
          case 5:
            $model .= 'RepairGohonzon'; 
            break;
          case 10:
            $model .= 'WeddingCeremony'; 
            break;
          case 11:
            $model .= 'WeddingCeremony'; 
            break;
          case 12:
            $model .= 'WeddingCeremony'; 
            break;
          case 13:
            $model .= 'BabyNaming'; 
            break;
          case 14:
            $model .= 'Gohifu'; 
            break;
          case 15:
            $model .= 'DeathCeremonyItem'; 
            break;
          case 16:
            $model .= 'DeathAnniversary'; 
            break;
          case 18:
            $model .= 'Ihai'; 
            break;
          case 19:
            $model .= 'DeathName'; 
            break;
          case 20:
            $model .= 'SotobaItem'; 
            break;
          case 21:
            $model .= 'SotobaItem'; 
            break;
          case 22:
            $model .= 'PersonalMemorialBook'; 
            break;
          case 23:
            $model .= 'MemorialTablet'; 
            break;
          case 24:
            $model .= 'MemorialTablet'; 
            break;
          case 26:
            $model .= 'EitaiKuyo'; 
            break;
          case 28:
            $model .= 'TempleMemorialBook'; 
            break;
          case 30:
            $model .= 'ReturnGohonzon';
            break;
          case 32:
            $model .= 'SotobaItem';
            break;
          case 34:
            $model .= 'CremationAshKeep';
            break;
          case 35:
            $model .= 'RentalGohonzon';
            break;
          default:
            $model .= 'Gojukai'; 
            break;
        }
        
        return $model;
    }

    public static function getView($serviceId)
    {
        $model = '';
        switch($serviceId) {
          case 1:
            $model .= 'gojukai';
            break;
          case 2:
            $model .= 'kankai'; 
            break;
          case 3:
            $model .= 'receive-gohonzon'; 
            break;
          case 4:
            $model .= 'repair-jutzu';
            break;
          case 5:
            $model .= 'repair-gohonzon'; 
            break;
          case 10:
            $model .= 'wedding-ceremony'; 
            break;
          case 11:
            $model .= 'wedding-ceremony'; 
            break;
          case 12:
            $model .= 'wedding-ceremony'; 
            break;
          case 13:
            $model .= 'baby-naming'; 
            break;
          case 14:
            $model .= 'gohifu'; 
            break;
          case 18:
            $model .= 'ihai'; 
            break;
          case 15:
            $model .= 'death-ceremony'; 
            break;
          case 16:
            $model .= 'death-anniversary'; 
            break;
          case 19:
            $model .= 'death-name'; 
            break;
          case 20:
            $model .= 'sotoba'; 
            break;
          case 21:
            $model .= 'sotoba-event'; 
            break;
          case 22:
            $model .= 'personal-memorial-book'; 
            break;
          case 23:
            $model .= 'memorial-tablet'; 
            break;
          case 24:
            $model .= 'memorial-tablet'; 
            break;
          case 26:
            $model .= 'eitai-kuyo'; 
            break;
          case 28:
            $model .= 'temple-memorial-book'; 
            break;
          case 30:
            $model .= 'return-gohonzon';
            break;
          case 32:
            $model .= 'sotoba-anniversary';
            break;
          case 34:
            $model .= 'cremation-ash-keep';
            break;
          case 35:
            $model .= 'rental-gohonzon';
            break;
          default:
            $model .= 'gojukai'; 
            break;
        }
        
        return $model;
    }

    public static function hasPrintPreview($serviceId)
    {
      $printableServices = [1,13, 14, 15, 16, 18, 19, 35];
      
      return in_array($serviceId, $printableServices);
    }

    public static function getDailyService($filters)
    {
      $data = [];

      $obj = new Gojukai();
      $obj->fill($filters);
      $data['gojukai'] = $obj->filter($filters, [
        'pagination' => false,
      ]);

      $obj = new Kankai();
      $obj->fill($filters);
      $data['kankai'] = $obj->filter($filters, [
        'pagination' => false,
      ]);

      $obj = new ReceiveGohonzon();
      $obj->fill($filters);
      $data['receive_gohonzon'] = $obj->filter($filters, [
        'pagination' => false,
      ]);

      $obj = new Gohifu();
      $obj->fill($filters);
      $data['gohifu'] = $obj->filter($filters, [
        'pagination' => false,
      ]);

      $obj = new DeathAnniversary();
      $obj->fill($filters);
      $data['death_anniversary'] = $obj->filter($filters, [
        'pagination' => false,
      ]);

      return $data;
    }

    public function done($data)
    {
      $merged = new Collection();
      foreach($data as $service) {
        if($service instanceof Collection)
          $merged = $merged->merge($service);
        else
          $merged[] = $service;
      }

      foreach($merged as $row) {
        $row->done_at = \App\Utils\DateUtil::dateTimeNow();
        $row->processed_by = \Auth::guard('admin')->user()->name;
        $row->save();
        $requestService = $row->requestService;
        $this->doneParentStatus($row->request_code, $requestService);
      }
    }

    public function doneParentStatus($requestCode, $requestService)
    {
      $model = self::getModel($requestService->service_id);
      $undoneServices = $model::where("request_code", $requestCode)
        ->where('done_at', '=', '')->count();
      if($undoneServices == 0) {
        $requestService = RequestService::where('request_code', $requestCode)->firstOrFail();
        $requestService->doneRequest();
      }
    }
}