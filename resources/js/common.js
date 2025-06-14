$(function($) {
  // init
  init();
  function init() {
    setThousandSeparator($(".price-field"));
    creditcardFormat($('.creditcard-format'));
    zipcodeFormat($('.zipcode-format'));
    phoneFormat($('.phone-format'));
  }

  // predispatch submit
  $("form").submit(function() {
    $(".price-field").each(function() {
      $(this).val($(this).val().replaceAll(',', ''));
    });
    $('.creditcard-format, .zipcode-format, .phone-format').each(function() {
      $(this).val($(this).val().replaceAll('-', ''));
    });
    
    return true;
  });

  // view elevator 
  $('.go-top').click( function() {
    $('html,body').animate({ scrollTop: 0 }, 'slow');
  });
  $('.go-bottom').click( function() {
    $("html, body").animate({ scrollTop: $(document).height() }, 'slow');
  });

  // password show toggle
  $(".password-icon").click(function() {
    let input = $(this).parent().parent().find("input");
    if (input.attr("type") == "password") {
      input.attr("type", "text");
      $(this).attr("class", "password-icon fa fa-eye-slash");
    } else {
      input.attr("type", "password");
      $(this).attr("class", "password-icon fa fa-eye");
    }
  });
  
  // formatting trigger
  $(".price-field").blur(function() {
    setThousandSeparator($(this));
  });
  $(".price-field").focus(function() {
    $(this).val($(this).val().replaceAll(',', ''));
  });
  $('.creditcard-format').keyup(function() {
    creditcardFormat($(this));
  });
  $('.zipcode-format').keyup(function() {
    zipcodeFormat($(this));
  });
  $('.phone-format').keyup(function() {
    phoneFormat($(this));
  });

  // formatting function
  function setThousandSeparator(el) {
    if(el.length == 0)
      return true;
    el.val(parseInt($(el).val()).toLocaleString('ja'));
  }

  function creditcardFormat(el) {
    if(el.length == 0)
      return true;
    var str = el.val().split("-").join(""); // remove hyphens
    if(str.length > 12) {
      str = str.slice(0, 12);
    }
    if (str.length > 0) {
      str = str.match(new RegExp('.{1,4}', 'g')).join("-");
    }
    el.val(str);
  }
  
  function zipcodeFormat(el) {
    if(el.length == 0)
      return true;
    var str = el.val().split("-").join(""); // remove hyphens
    if(str.length > 7) {
      str = str.slice(0, 7);
    }
    if (str.length > 3) {
        str = str.substring(0,3) + "-" + str.substring(3);
    }
    el.val(str);
  }

  function phoneFormat(el) {
    if(el.length == 0)
      return true;
    var str = el.val().split("-").join(""); // remove hyphens
    if(str.length > 11) {
      str = str.slice(0, 11);
    }
    const re  = /^(\d{3})(?:(\d{1,4})(?:(\d{1,4}))?)?$/;
    str = str.replace(/\D/g,'').replace(re, (_,a,b,c,d) =>  
      a + 
        ( b ? `-${b}` : "") + 
        ( c ? `-${c}` : "") + 
          ( d ? `-${d}` : "") );
    el.val(str);
  }
  
  
  var changeLocale = function (locale) {
    $.ajax({
      url: '/helpers/change-locale',
      data: {locale: locale},
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      method: 'POST',
      success: function () {
        location.reload();
      }
    });
  }
  
  $('#change-locale-select').change(function() {
    changeLocale($(this).val());
  });

  // grid function
  var changeRowPerPage = function (rpp) {
    $.ajax({
      url: '/helpers/change-row-per-page',
      data: {rpp: rpp},
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      method: 'POST',
      success: function () {
        location.reload();
      }
    });
  }
  $('.grids-control-records-per-page').change(function() {
    var rpp = $(this).val();
    changeRowPerPage(rpp);
  });
  $('.grid-table .sortable').click(function() {
    var url = new URL(window.location.href);
    var sort_name = $(this).attr("data-key");
    var sort_type = $(this).attr("data-type");
    
    url.searchParams.set('sort[sort_name]', sort_name);
    url.searchParams.set('sort[sort_type]', sort_type);
    
    window.location.href = url
  });

  // copy to clipboard
  var copyToClipboard = function (ele) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val(ele.text()).select();
    document.execCommand("copy");
    $temp.remove();

    alert(ele.text() + " copied");
  }
  $(".copyToClipboard").click(function() {
    copyToClipboard($(this).parent().find('.copyValue'));
  });

  // print
  $(".print").click(function() {
    customPrint();
  });
  $(".print-for-altar").click(function() {
    $(".for-altar").css({"display": "block"});
    customPrint();
    $(".for-altar").css({"display": "none"});
  })

  function customPrint() {
    document.body.innerHTML = document.getElementById("print-area").innerHTML;
    window.print();
    location.reload();
  }

  // readOnly on selection hack on submit
  $('[readonly]').prop( "disabled", false );
});
