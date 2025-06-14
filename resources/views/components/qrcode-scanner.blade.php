<style>
  #realtimeReader {
    display: none;
    max-width: 600px;
  }
</style>
@lang('common.qrcode-scanner')
<input type="file" id="qr-input-file" accept="image/*" style="display: none;">
<br />
<select id="select-camera" class="form-control form-control-sm" style="display: none;">
</select>
<br />
<button type="button" class="btn btn-primary" onclick="document.getElementById('qr-input-file').click();">@lang('common.file')</button>
<button type="button" class="btn btn-primary" id="toggle-camera">@lang('common.camera')</button>
<br />
<br />
<div id="realtimeReader"></div>

@push('javascript')
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script>
  $( function() {
    const html5QrCode = new Html5Qrcode("realtimeReader");
    const selectCamera = $("#select-camera");
    let options = "";
    let camera = false;
    let selectedCamera = false;
    
    const qrCodeSuccessCallback = (decodedText, decodedResult) => {
      document.getElementById('{{$resultSelector}}').value = decodedText;
    };
    const getQRBoxDimensions = (
      viewfinderWidth,
      viewfinderHeight
    ) => {
      const minEdgePercentage = 0.7;
      const minEdgeSize = Math.min(viewfinderWidth, viewfinderHeight);
      const qrboxSize = Math.floor(minEdgeSize * minEdgePercentage);
      return {
        width: qrboxSize,
        height: qrboxSize
      };
    };
    const config = { fps: 10, qrbox: getQRBoxDimensions };

    function showCameraOptions() {
      Html5Qrcode.getCameras().then(devices => {
        selectCamera.html("");
        if (devices && devices.length) {
          devices.forEach((device, idx) => {
            if(idx == 0) selectedCamera = device.id;
            selectCamera.append(new Option(device.label, device.id));
          });

          $('#select-camera').val(selectedCamera); 
        }
      }).catch(err => {
        alert(err);
      });
    }

    function toogleCamera(reset = false) {
      camera = (reset) ? true : !camera;
      if(camera) {
        if(!selectedCamera) {
          showCameraOptions();
        }
        if(reset && html5QrCode.isScanning) html5QrCode.stop();
        setTimeout(function() {
          if(selectedCamera) {
            html5QrCode.start(selectedCamera, config, qrCodeSuccessCallback);
            $("#realtimeReader").css("display", "block");
            selectCamera.css("display", "block");
          }
        },1000);
      } else {
        html5QrCode.stop();
        $("#realtimeReader").css("display", "none");
        selectCamera.css("display", "none");
      }
    }

    $('#qr-input-file').click(function() {
      $(this).val(null);
      if(html5QrCode.isScanning) html5QrCode.stop();
      camera = false;
      $("#realtimeReader").css("display", "none");
      selectCamera.css("display", "none");
    });

    const fileinput = document.getElementById('qr-input-file');
    fileinput.addEventListener('change', e => {
      if (e.target.files.length == 0) {
        alert("please select file")
        return;
      }

      const imageFile = e.target.files[0];
      // Scan QR Code
      html5QrCode.scanFile(imageFile, true)
      .then(decodedText => {
        document.getElementById('{{$resultSelector}}').value = decodedText;
      })
      .catch(err => {
        // failure, handle it.
        console.log(`Error scanning file. Reason: ${err}`)
      });
    });

    $("#select-camera").change(function() {
      selectedCamera = $(this).val();
      toogleCamera(true);
    });

    $('#toggle-camera').click(function() {
      toogleCamera();
    });
  });
</script>
@endpush