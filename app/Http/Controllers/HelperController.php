<?php

namespace App\Http\Controllers;

use App;
use Session;
use Lang;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HelperController extends Controller
{
  public function changeRowPerPage(Request $request)
  {
    $rowPerPage = $request->input('rpp');
    Session::put('rowPerPage', $rowPerPage);

    return Response()->json([
      'success' => true
    ]);
  }

  function changeLocale(Request $request)
  {
    $locale = $request->input('locale');
    \App::setLocale($locale);
    \Session::put('locale', $locale);
    \Session::save();

    return Response()->json([
        'success' => true
    ]);
  }

  public function export(Request $request)
  {
    $request = $request->all();
    $export = new \App\Utils\ExportUtil('csv');
    $model = '\\App\\Models\\'.$request['model'];
    $objClass = new $model();
    $options = [
      'file_name' => $request['model'].".csv",
      'with_header' => true,
      'model' => $request['model'],
      //'os_type' => $request['os_type'],
    ];

    $filters = (isset($request['filters'])) ? $request['filters'] : [];
    $data = $objClass->filter($filters, ['no-paging' => true]);
    $data = $objClass->csvFormatter($data);
    $export->exportCsv($data, $options);
  }

  public function download(Request $request)
  {
    $request = $request->all();
    $path = $request['path'];
    $fileName = $request['file_name'];

    $headers = array(
      'Content-Type: text/csv',
    );

    return response()->download($path, $fileName, $headers);
  }
  
  public function activation(Request $request)
  {
    $request = $request->all();
    $model = '\\App\\Models\\'.$request['model'];
    $id = $request['id'];

    $obj = $model::findOrFail($id);
    
    $obj->is_active = $obj->is_active ? 0 : 1;
    $obj->save();
      
    return redirect()
      ->back()
      ->with('success', ($obj->is_active ? Lang::get('common.activation-succeed', ['module' => $request['model']]) : Lang::get('common.disactivation-succeed', ['module' => $request['model']])));
  }

  public function loadEvent(Request $request)
  {
    $data = $request->all();
    $data = \App\Models\Event::loadEvent($data);
    $data = \App\Models\Event::formatFullCalendar($data);
    
    return Response()->json($data);
  }

  public function downloadFile(Request $request)
  {
    $request = $request->all();
    $pathName = $request['path_name'];
    $fileName = $request['file_name'];

    $disk = \Storage::disk('public')->path(config('image.path.' . $pathName));
    $filepath = $disk . $fileName;
    
    return Response()->download($filepath);
  }

  public function getUserList(Request $request)
  {
    $userList = [];
    $userList = \App\Models\User::getUserListAutoComplete($request->term);

    return json_encode($userList, JSON_UNESCAPED_UNICODE);
  }

  public function getEventList(Request $request)
  {
    $eventList = [];
    $eventList = \App\Models\Event::getEventListAutoComplete($request->term);

    return json_encode($eventList, JSON_UNESCAPED_UNICODE);
  }

  public function getRequestServiceByCode(Request $request)
  {
    $requestService = [];
    $requestService = \App\Models\RequestService::where('request_code', $request->request_code)->first();

    return json_encode($requestService, JSON_UNESCAPED_UNICODE);
  }

  public function paymentUserGenerator()
  {
    \App\Models\Payment::massPaymentUserGenerator();
  }

  public function massCreateTemporaryUser()
  {
    $json = "{\"data\":[{\"name\":\"ALEX TANTONO\",\"place\":\"BDI - JATIM 1 - MATA BUDDHA\"},{\"name\":\"TEDY KOMALA\",\"place\":\"BDI - DKI 2 - SUNTER\"},{\"name\":\"YOSEP MARTIUS\",\"place\":\"BDI - DKI 2 - TEGAL ALUR\"},{\"name\":\"WEI KUNG HUI\",\"place\":\"VISISTACARITRA\"},{\"name\":\"SHI LINA\",\"place\":\"VISISTACARITRA\"},{\"name\":\"KRISNO TRIYANTO SOEKARNO\",\"place\":\"BDI - DKI 1 - BOGOR\"},{\"name\":\"DEBBY MURYATI\",\"place\":\"BDI - JATENG 6 - \"},{\"name\":\"TEDY KOMALA\",\"place\":\"BDI - DKI 2 - SUNTER\"},{\"name\":\"OEI KING LIM\",\"place\":\"BDI - JATIM 1 - MATA BUDDHA\"},{\"name\":\"ELLY\",\"place\":\"BDI - JATIM 1 - JIWA BESAR\"},{\"name\":\"FREDDY KOMALA\",\"place\":\"BDI - DKI 2 - SUNTER\"},{\"name\":\"KWA GWAN HOK\",\"place\":\"BDI - JATIM 1 - MATA BUDDHA\"},{\"name\":\"BUDDY KOMALA\",\"place\":\"BDI - DKI 1 - BALAS BUDI\"},{\"name\":\"TONY KOMALA\",\"place\":\"BDI - DKI 1 - BALAS BUDI\"},{\"name\":\"MESRAWATI ISKANDAR\",\"place\":\"BDI - DKI 2 - CILEDUG\"},{\"name\":\"NATALIA \",\"place\":\"BDI - DKI 1 - BOGOR\"},{\"name\":\"LAVINKA LEEANDRA VISOKA\",\"place\":\"VISISTACARITRA\"},{\"name\":\"LUVINIA REIKO VISOKA\",\"place\":\"VISISTACARITRA\"},{\"name\":\"NG LIE CHING\",\"place\":\"BDI\"},{\"name\":\"SUMIYATI\",\"place\":\"BDI - SUMUT 1 - \"},{\"name\":\"YENI KURNIAWATI\",\"place\":\"BDI - BALI - \"},{\"name\":\"HENI HARTATI\",\"place\":\"BDI - JATIM 2 - SALE\"},{\"name\":\"YULIANA SANTOSO\",\"place\":\"BDI - JATIM 1 - JIWA BESAR\"},{\"name\":\"CYNTHIA INDAH PERMATA SUDALI\",\"place\":\"BDI - JATIM 1 - JIWA BESAR\"},{\"name\":\"LUSIANA\",\"place\":\"VISISTACARITRA\"},{\"name\":\"VERONICA WIJAYA\",\"place\":\"BDI - BALI - \"},{\"name\":\"SIAW LAN\",\"place\":\"BDI - DKI 2 - TEGAL ALUR\"},{\"name\":\"OEIJ YULIANA\",\"place\":\"BDI - DKI 2 - TEGAL ALUR\"},{\"name\":\"AMIRTO\",\"place\":\"BDI - DKI 2 - SATU HATI\"},{\"name\":\"JAYA PUNDARIKA\",\"place\":\"BDI - KALIMANTAN TENGAH - \"},{\"name\":\"FANNY INDRIANTI\",\"place\":\"PERMATA\"},{\"name\":\"TEDDY\",\"place\":\"BDI - KALIMANTAN BARAT - \"},{\"name\":\"STEVANUS HERLIANTO/ TEPEN\",\"place\":\"BDI - DKI 2 - TEGAL ALUR\"},{\"name\":\"SALMA ADRIYANI\",\"place\":\"VISISTACARITRA\"},{\"name\":\"CHANG AI LING\",\"place\":\"VISISTACARITRA\"},{\"name\":\"TRISNING TJAHYANI\",\"place\":\"VISISTACARITRA\"},{\"name\":\"JAYAMULYA SETIADI\",\"place\":\"VISISTACARITRA\"},{\"name\":\"NADYA BELLATRIX PARAMITA\",\"place\":\"VISISTACARITRA\"},{\"name\":\"YOSEPHINE WELIYANTO\",\"place\":\"BDI - JATIM 1 - OPTIMIS\"},{\"name\":\"FIRMAN MULJADI\",\"place\":\"BDI - DKI 2 - KELAPA GADING\"},{\"name\":\"APRI PRAFITRI\",\"place\":\"BDI - JATIM 1 - OPTIMIS\"},{\"name\":\"WUI WUI\",\"place\":\"BDI - SUMUT 1 - \"},{\"name\":\"CYNTHIA SARLO\",\"place\":\"BDI - SUMUT 1 - \"},{\"name\":\"CHARLES KRISNANDA\",\"place\":\"BDI - DKI 2 - EKAYANA\"},{\"name\":\"ELLYS\",\"place\":\"BDI - SUMUT 1 - \"},{\"name\":\"ELIZABETH YAPARTO\",\"place\":\"BDI - MAKASSAR - \"},{\"name\":\"TINY LAULIA\",\"place\":\"BDI - SUMUT 1 - \"}]}";
    $data = json_decode($json, true);

    forEach($data['data'] as $row) {
      $tuObject = \App\Models\TemporaryUser::where($row)->first();
      if($tuObject) continue;
      $tu = new \App\Models\TemporaryUser();
      $tu->add($row);
    }
  }
}