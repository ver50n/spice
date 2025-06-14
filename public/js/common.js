/*
 * ATTENTION: An "eval-source-map" devtool has been used.
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file with attached SourceMaps in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/common.js":
/*!********************************!*\
  !*** ./resources/js/common.js ***!
  \********************************/
/***/ (() => {

eval("$(function ($) {\n  // init\n  init();\n  function init() {\n    setThousandSeparator($(\".price-field\"));\n    creditcardFormat($('.creditcard-format'));\n    zipcodeFormat($('.zipcode-format'));\n    phoneFormat($('.phone-format'));\n  }\n\n  // predispatch submit\n  $(\"form\").submit(function () {\n    $(\".price-field\").each(function () {\n      $(this).val($(this).val().replaceAll(',', ''));\n    });\n    $('.creditcard-format, .zipcode-format, .phone-format').each(function () {\n      $(this).val($(this).val().replaceAll('-', ''));\n    });\n    return true;\n  });\n  $('form').on('focus', '.user-label', function () {\n    $(this).autocomplete({\n      source: userList,\n      select: function select(event, ui) {\n        $(this).val(ui.item.label);\n        $(this).parent().find('.user_id').val(ui.item.value);\n        return false;\n      },\n      minLength: 3\n    });\n  });\n  $('form').on('focus', '.event-label', function () {\n    $(this).autocomplete({\n      source: eventList,\n      select: function select(event, ui) {\n        $(this).val(ui.item.label);\n        $(this).parent().find('.event_id').val(ui.item.value);\n        return false;\n      },\n      minLength: 3\n    });\n  });\n\n  // view elevator \n  $('.go-top').click(function () {\n    $('html,body').animate({\n      scrollTop: 0\n    }, 'slow');\n  });\n  $('.go-bottom').click(function () {\n    $(\"html, body\").animate({\n      scrollTop: $(document).height()\n    }, 'slow');\n  });\n\n  // password show toggle\n  $(\".password-icon\").click(function () {\n    var input = $(this).parent().parent().find(\"input\");\n    if (input.attr(\"type\") == \"password\") {\n      input.attr(\"type\", \"text\");\n      $(this).attr(\"class\", \"password-icon fa fa-eye-slash\");\n    } else {\n      input.attr(\"type\", \"password\");\n      $(this).attr(\"class\", \"password-icon fa fa-eye\");\n    }\n  });\n\n  // formatting trigger\n  $(\".price-field\").blur(function () {\n    setThousandSeparator($(this));\n  });\n  $(\".price-field\").focus(function () {\n    $(this).val($(this).val().replaceAll(',', ''));\n  });\n  $('.creditcard-format').keyup(function () {\n    creditcardFormat($(this));\n  });\n  $('.zipcode-format').keyup(function () {\n    zipcodeFormat($(this));\n  });\n  $('.phone-format').keyup(function () {\n    phoneFormat($(this));\n  });\n\n  // formatting function\n  function setThousandSeparator(el) {\n    if (el.length == 0) return true;\n    el.val(parseInt($(el).val()).toLocaleString('ja'));\n  }\n  function creditcardFormat(el) {\n    if (el.length == 0) return true;\n    var str = el.val().split(\"-\").join(\"\"); // remove hyphens\n    if (str.length > 12) {\n      str = str.slice(0, 12);\n    }\n    if (str.length > 0) {\n      str = str.match(new RegExp('.{1,4}', 'g')).join(\"-\");\n    }\n    el.val(str);\n  }\n  function zipcodeFormat(el) {\n    if (el.length == 0) return true;\n    var str = el.val().split(\"-\").join(\"\"); // remove hyphens\n    if (str.length > 7) {\n      str = str.slice(0, 7);\n    }\n    if (str.length > 3) {\n      str = str.substring(0, 3) + \"-\" + str.substring(3);\n    }\n    el.val(str);\n  }\n  function phoneFormat(el) {\n    if (el.length == 0) return true;\n    var str = el.val().split(\"-\").join(\"\"); // remove hyphens\n    if (str.length > 11) {\n      str = str.slice(0, 11);\n    }\n    var re = /^(\\d{3})(?:(\\d{1,4})(?:(\\d{1,4}))?)?$/;\n    str = str.replace(/\\D/g, '').replace(re, function (_, a, b, c, d) {\n      return a + (b ? \"-\".concat(b) : \"\") + (c ? \"-\".concat(c) : \"\") + (d ? \"-\".concat(d) : \"\");\n    });\n    el.val(str);\n  }\n  var changeLocale = function changeLocale(locale) {\n    $.ajax({\n      url: '/helpers/change-locale',\n      data: {\n        locale: locale\n      },\n      headers: {\n        'X-CSRF-TOKEN': $('meta[name=\"csrf-token\"]').attr('content')\n      },\n      method: 'POST',\n      success: function success() {\n        location.reload();\n      }\n    });\n  };\n  $('#change-locale-select').change(function () {\n    changeLocale($(this).val());\n  });\n\n  // grid function\n  var changeRowPerPage = function changeRowPerPage(rpp) {\n    $.ajax({\n      url: '/helpers/change-row-per-page',\n      data: {\n        rpp: rpp\n      },\n      headers: {\n        'X-CSRF-TOKEN': $('meta[name=\"csrf-token\"]').attr('content')\n      },\n      method: 'POST',\n      success: function success() {\n        location.reload();\n      }\n    });\n  };\n  $('.grids-control-records-per-page').change(function () {\n    var rpp = $(this).val();\n    changeRowPerPage(rpp);\n  });\n  $('.grid-table .sortable').click(function () {\n    var url = new URL(window.location.href);\n    var sort_name = $(this).attr(\"data-key\");\n    var sort_type = $(this).attr(\"data-type\");\n    url.searchParams.set('sort[sort_name]', sort_name);\n    url.searchParams.set('sort[sort_type]', sort_type);\n    window.location.href = url;\n  });\n\n  // copy to clipboard\n  var copyToClipboard = function copyToClipboard(ele) {\n    var $temp = $(\"<input>\");\n    $(\"body\").append($temp);\n    $temp.val(ele.text()).select();\n    document.execCommand(\"copy\");\n    $temp.remove();\n    alert(ele.text() + \" copied\");\n  };\n  $(\".copyToClipboard\").click(function () {\n    copyToClipboard($(this).parent().find('.copyValue'));\n  });\n  $(\".conducted_at\").flatpickr({\n    locale: document.documentElement.lang,\n    dateFormat: \"Y-m-d\",\n    minDate: \"today\",\n    disableMobile: true\n  });\n  $(\".conducted_time\").flatpickr({\n    locale: document.documentElement.lang,\n    noCalendar: true,\n    enableTime: true,\n    dateFormat: \"H:i\",\n    time_24hr: true,\n    disableMobile: true\n  });\n\n  // print\n  $(\".print\").click(function () {\n    customPrint();\n  });\n  $(\".print-for-altar\").click(function () {\n    $(\".for-altar\").css({\n      \"display\": \"block\"\n    });\n    customPrint();\n    $(\".for-altar\").css({\n      \"display\": \"none\"\n    });\n  });\n  function customPrint() {\n    document.body.innerHTML = document.getElementById(\"print-area\").innerHTML;\n    window.print();\n    location.reload();\n  }\n\n  // readOnly on selection hack on submit\n  $('[readonly]').prop(\"disabled\", false);\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvanMvY29tbW9uLmpzIiwibmFtZXMiOlsiJCIsImluaXQiLCJzZXRUaG91c2FuZFNlcGFyYXRvciIsImNyZWRpdGNhcmRGb3JtYXQiLCJ6aXBjb2RlRm9ybWF0IiwicGhvbmVGb3JtYXQiLCJzdWJtaXQiLCJlYWNoIiwidmFsIiwicmVwbGFjZUFsbCIsIm9uIiwiYXV0b2NvbXBsZXRlIiwic291cmNlIiwidXNlckxpc3QiLCJzZWxlY3QiLCJldmVudCIsInVpIiwiaXRlbSIsImxhYmVsIiwicGFyZW50IiwiZmluZCIsInZhbHVlIiwibWluTGVuZ3RoIiwiZXZlbnRMaXN0IiwiY2xpY2siLCJhbmltYXRlIiwic2Nyb2xsVG9wIiwiZG9jdW1lbnQiLCJoZWlnaHQiLCJpbnB1dCIsImF0dHIiLCJibHVyIiwiZm9jdXMiLCJrZXl1cCIsImVsIiwibGVuZ3RoIiwicGFyc2VJbnQiLCJ0b0xvY2FsZVN0cmluZyIsInN0ciIsInNwbGl0Iiwiam9pbiIsInNsaWNlIiwibWF0Y2giLCJSZWdFeHAiLCJzdWJzdHJpbmciLCJyZSIsInJlcGxhY2UiLCJfIiwiYSIsImIiLCJjIiwiZCIsImNvbmNhdCIsImNoYW5nZUxvY2FsZSIsImxvY2FsZSIsImFqYXgiLCJ1cmwiLCJkYXRhIiwiaGVhZGVycyIsIm1ldGhvZCIsInN1Y2Nlc3MiLCJsb2NhdGlvbiIsInJlbG9hZCIsImNoYW5nZSIsImNoYW5nZVJvd1BlclBhZ2UiLCJycHAiLCJVUkwiLCJ3aW5kb3ciLCJocmVmIiwic29ydF9uYW1lIiwic29ydF90eXBlIiwic2VhcmNoUGFyYW1zIiwic2V0IiwiY29weVRvQ2xpcGJvYXJkIiwiZWxlIiwiJHRlbXAiLCJhcHBlbmQiLCJ0ZXh0IiwiZXhlY0NvbW1hbmQiLCJyZW1vdmUiLCJhbGVydCIsImZsYXRwaWNrciIsImRvY3VtZW50RWxlbWVudCIsImxhbmciLCJkYXRlRm9ybWF0IiwibWluRGF0ZSIsImRpc2FibGVNb2JpbGUiLCJub0NhbGVuZGFyIiwiZW5hYmxlVGltZSIsInRpbWVfMjRociIsImN1c3RvbVByaW50IiwiY3NzIiwiYm9keSIsImlubmVySFRNTCIsImdldEVsZW1lbnRCeUlkIiwicHJpbnQiLCJwcm9wIl0sInNvdXJjZVJvb3QiOiIiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvY29tbW9uLmpzPzg2ZmYiXSwic291cmNlc0NvbnRlbnQiOlsiJChmdW5jdGlvbigkKSB7XG4gIC8vIGluaXRcbiAgaW5pdCgpO1xuICBmdW5jdGlvbiBpbml0KCkge1xuICAgIHNldFRob3VzYW5kU2VwYXJhdG9yKCQoXCIucHJpY2UtZmllbGRcIikpO1xuICAgIGNyZWRpdGNhcmRGb3JtYXQoJCgnLmNyZWRpdGNhcmQtZm9ybWF0JykpO1xuICAgIHppcGNvZGVGb3JtYXQoJCgnLnppcGNvZGUtZm9ybWF0JykpO1xuICAgIHBob25lRm9ybWF0KCQoJy5waG9uZS1mb3JtYXQnKSk7XG4gIH1cblxuICAvLyBwcmVkaXNwYXRjaCBzdWJtaXRcbiAgJChcImZvcm1cIikuc3VibWl0KGZ1bmN0aW9uKCkge1xuICAgICQoXCIucHJpY2UtZmllbGRcIikuZWFjaChmdW5jdGlvbigpIHtcbiAgICAgICQodGhpcykudmFsKCQodGhpcykudmFsKCkucmVwbGFjZUFsbCgnLCcsICcnKSk7XG4gICAgfSk7XG4gICAgJCgnLmNyZWRpdGNhcmQtZm9ybWF0LCAuemlwY29kZS1mb3JtYXQsIC5waG9uZS1mb3JtYXQnKS5lYWNoKGZ1bmN0aW9uKCkge1xuICAgICAgJCh0aGlzKS52YWwoJCh0aGlzKS52YWwoKS5yZXBsYWNlQWxsKCctJywgJycpKTtcbiAgICB9KTtcbiAgICBcbiAgICByZXR1cm4gdHJ1ZTtcbiAgfSk7XG5cbiAgJCgnZm9ybScpLm9uKCdmb2N1cycsICcudXNlci1sYWJlbCcsIGZ1bmN0aW9uICgpIHtcbiAgICAkKHRoaXMpLmF1dG9jb21wbGV0ZSh7XG4gICAgICBzb3VyY2U6IHVzZXJMaXN0LFxuICAgICAgc2VsZWN0OiBmdW5jdGlvbiAoZXZlbnQsIHVpKSB7XG4gICAgICAgICQodGhpcykudmFsKHVpLml0ZW0ubGFiZWwpXG4gICAgICAgICQodGhpcykucGFyZW50KCkuZmluZCgnLnVzZXJfaWQnKS52YWwodWkuaXRlbS52YWx1ZSk7XG4gICAgICAgIHJldHVybiBmYWxzZTtcbiAgICAgIH0sXG4gICAgICBtaW5MZW5ndGg6IDNcbiAgICB9KTtcbiAgfSk7XG5cbiAgJCgnZm9ybScpLm9uKCdmb2N1cycsICcuZXZlbnQtbGFiZWwnLCBmdW5jdGlvbiAoKSB7XG4gICAgJCh0aGlzKS5hdXRvY29tcGxldGUoe1xuICAgICAgc291cmNlOiBldmVudExpc3QsXG4gICAgICBzZWxlY3Q6IGZ1bmN0aW9uIChldmVudCwgdWkpIHtcbiAgICAgICAgJCh0aGlzKS52YWwodWkuaXRlbS5sYWJlbClcbiAgICAgICAgJCh0aGlzKS5wYXJlbnQoKS5maW5kKCcuZXZlbnRfaWQnKS52YWwodWkuaXRlbS52YWx1ZSk7XG4gICAgICAgIHJldHVybiBmYWxzZTtcbiAgICAgIH0sXG4gICAgICBtaW5MZW5ndGg6IDNcbiAgICB9KTtcbiAgfSk7XG5cbiAgLy8gdmlldyBlbGV2YXRvciBcbiAgJCgnLmdvLXRvcCcpLmNsaWNrKCBmdW5jdGlvbigpIHtcbiAgICAkKCdodG1sLGJvZHknKS5hbmltYXRlKHsgc2Nyb2xsVG9wOiAwIH0sICdzbG93Jyk7XG4gIH0pO1xuICAkKCcuZ28tYm90dG9tJykuY2xpY2soIGZ1bmN0aW9uKCkge1xuICAgICQoXCJodG1sLCBib2R5XCIpLmFuaW1hdGUoeyBzY3JvbGxUb3A6ICQoZG9jdW1lbnQpLmhlaWdodCgpIH0sICdzbG93Jyk7XG4gIH0pO1xuXG4gIC8vIHBhc3N3b3JkIHNob3cgdG9nZ2xlXG4gICQoXCIucGFzc3dvcmQtaWNvblwiKS5jbGljayhmdW5jdGlvbigpIHtcbiAgICBsZXQgaW5wdXQgPSAkKHRoaXMpLnBhcmVudCgpLnBhcmVudCgpLmZpbmQoXCJpbnB1dFwiKTtcbiAgICBpZiAoaW5wdXQuYXR0cihcInR5cGVcIikgPT0gXCJwYXNzd29yZFwiKSB7XG4gICAgICBpbnB1dC5hdHRyKFwidHlwZVwiLCBcInRleHRcIik7XG4gICAgICAkKHRoaXMpLmF0dHIoXCJjbGFzc1wiLCBcInBhc3N3b3JkLWljb24gZmEgZmEtZXllLXNsYXNoXCIpO1xuICAgIH0gZWxzZSB7XG4gICAgICBpbnB1dC5hdHRyKFwidHlwZVwiLCBcInBhc3N3b3JkXCIpO1xuICAgICAgJCh0aGlzKS5hdHRyKFwiY2xhc3NcIiwgXCJwYXNzd29yZC1pY29uIGZhIGZhLWV5ZVwiKTtcbiAgICB9XG4gIH0pO1xuICBcbiAgLy8gZm9ybWF0dGluZyB0cmlnZ2VyXG4gICQoXCIucHJpY2UtZmllbGRcIikuYmx1cihmdW5jdGlvbigpIHtcbiAgICBzZXRUaG91c2FuZFNlcGFyYXRvcigkKHRoaXMpKTtcbiAgfSk7XG4gICQoXCIucHJpY2UtZmllbGRcIikuZm9jdXMoZnVuY3Rpb24oKSB7XG4gICAgJCh0aGlzKS52YWwoJCh0aGlzKS52YWwoKS5yZXBsYWNlQWxsKCcsJywgJycpKTtcbiAgfSk7XG4gICQoJy5jcmVkaXRjYXJkLWZvcm1hdCcpLmtleXVwKGZ1bmN0aW9uKCkge1xuICAgIGNyZWRpdGNhcmRGb3JtYXQoJCh0aGlzKSk7XG4gIH0pO1xuICAkKCcuemlwY29kZS1mb3JtYXQnKS5rZXl1cChmdW5jdGlvbigpIHtcbiAgICB6aXBjb2RlRm9ybWF0KCQodGhpcykpO1xuICB9KTtcbiAgJCgnLnBob25lLWZvcm1hdCcpLmtleXVwKGZ1bmN0aW9uKCkge1xuICAgIHBob25lRm9ybWF0KCQodGhpcykpO1xuICB9KTtcblxuICAvLyBmb3JtYXR0aW5nIGZ1bmN0aW9uXG4gIGZ1bmN0aW9uIHNldFRob3VzYW5kU2VwYXJhdG9yKGVsKSB7XG4gICAgaWYoZWwubGVuZ3RoID09IDApXG4gICAgICByZXR1cm4gdHJ1ZTtcbiAgICBlbC52YWwocGFyc2VJbnQoJChlbCkudmFsKCkpLnRvTG9jYWxlU3RyaW5nKCdqYScpKTtcbiAgfVxuXG4gIGZ1bmN0aW9uIGNyZWRpdGNhcmRGb3JtYXQoZWwpIHtcbiAgICBpZihlbC5sZW5ndGggPT0gMClcbiAgICAgIHJldHVybiB0cnVlO1xuICAgIHZhciBzdHIgPSBlbC52YWwoKS5zcGxpdChcIi1cIikuam9pbihcIlwiKTsgLy8gcmVtb3ZlIGh5cGhlbnNcbiAgICBpZihzdHIubGVuZ3RoID4gMTIpIHtcbiAgICAgIHN0ciA9IHN0ci5zbGljZSgwLCAxMik7XG4gICAgfVxuICAgIGlmIChzdHIubGVuZ3RoID4gMCkge1xuICAgICAgc3RyID0gc3RyLm1hdGNoKG5ldyBSZWdFeHAoJy57MSw0fScsICdnJykpLmpvaW4oXCItXCIpO1xuICAgIH1cbiAgICBlbC52YWwoc3RyKTtcbiAgfVxuICBcbiAgZnVuY3Rpb24gemlwY29kZUZvcm1hdChlbCkge1xuICAgIGlmKGVsLmxlbmd0aCA9PSAwKVxuICAgICAgcmV0dXJuIHRydWU7XG4gICAgdmFyIHN0ciA9IGVsLnZhbCgpLnNwbGl0KFwiLVwiKS5qb2luKFwiXCIpOyAvLyByZW1vdmUgaHlwaGVuc1xuICAgIGlmKHN0ci5sZW5ndGggPiA3KSB7XG4gICAgICBzdHIgPSBzdHIuc2xpY2UoMCwgNyk7XG4gICAgfVxuICAgIGlmIChzdHIubGVuZ3RoID4gMykge1xuICAgICAgICBzdHIgPSBzdHIuc3Vic3RyaW5nKDAsMykgKyBcIi1cIiArIHN0ci5zdWJzdHJpbmcoMyk7XG4gICAgfVxuICAgIGVsLnZhbChzdHIpO1xuICB9XG5cbiAgZnVuY3Rpb24gcGhvbmVGb3JtYXQoZWwpIHtcbiAgICBpZihlbC5sZW5ndGggPT0gMClcbiAgICAgIHJldHVybiB0cnVlO1xuICAgIHZhciBzdHIgPSBlbC52YWwoKS5zcGxpdChcIi1cIikuam9pbihcIlwiKTsgLy8gcmVtb3ZlIGh5cGhlbnNcbiAgICBpZihzdHIubGVuZ3RoID4gMTEpIHtcbiAgICAgIHN0ciA9IHN0ci5zbGljZSgwLCAxMSk7XG4gICAgfVxuICAgIGNvbnN0IHJlICA9IC9eKFxcZHszfSkoPzooXFxkezEsNH0pKD86KFxcZHsxLDR9KSk/KT8kLztcbiAgICBzdHIgPSBzdHIucmVwbGFjZSgvXFxEL2csJycpLnJlcGxhY2UocmUsIChfLGEsYixjLGQpID0+ICBcbiAgICAgIGEgKyBcbiAgICAgICAgKCBiID8gYC0ke2J9YCA6IFwiXCIpICsgXG4gICAgICAgICggYyA/IGAtJHtjfWAgOiBcIlwiKSArIFxuICAgICAgICAgICggZCA/IGAtJHtkfWAgOiBcIlwiKSApO1xuICAgIGVsLnZhbChzdHIpO1xuICB9XG4gIFxuICBcbiAgdmFyIGNoYW5nZUxvY2FsZSA9IGZ1bmN0aW9uIChsb2NhbGUpIHtcbiAgICAkLmFqYXgoe1xuICAgICAgdXJsOiAnL2hlbHBlcnMvY2hhbmdlLWxvY2FsZScsXG4gICAgICBkYXRhOiB7bG9jYWxlOiBsb2NhbGV9LFxuICAgICAgaGVhZGVyczoge1xuICAgICAgICAnWC1DU1JGLVRPS0VOJzogJCgnbWV0YVtuYW1lPVwiY3NyZi10b2tlblwiXScpLmF0dHIoJ2NvbnRlbnQnKVxuICAgICAgfSxcbiAgICAgIG1ldGhvZDogJ1BPU1QnLFxuICAgICAgc3VjY2VzczogZnVuY3Rpb24gKCkge1xuICAgICAgICBsb2NhdGlvbi5yZWxvYWQoKTtcbiAgICAgIH1cbiAgICB9KTtcbiAgfVxuICBcbiAgJCgnI2NoYW5nZS1sb2NhbGUtc2VsZWN0JykuY2hhbmdlKGZ1bmN0aW9uKCkge1xuICAgIGNoYW5nZUxvY2FsZSgkKHRoaXMpLnZhbCgpKTtcbiAgfSk7XG5cbiAgLy8gZ3JpZCBmdW5jdGlvblxuICB2YXIgY2hhbmdlUm93UGVyUGFnZSA9IGZ1bmN0aW9uIChycHApIHtcbiAgICAkLmFqYXgoe1xuICAgICAgdXJsOiAnL2hlbHBlcnMvY2hhbmdlLXJvdy1wZXItcGFnZScsXG4gICAgICBkYXRhOiB7cnBwOiBycHB9LFxuICAgICAgaGVhZGVyczoge1xuICAgICAgICAnWC1DU1JGLVRPS0VOJzogJCgnbWV0YVtuYW1lPVwiY3NyZi10b2tlblwiXScpLmF0dHIoJ2NvbnRlbnQnKVxuICAgICAgfSxcbiAgICAgIG1ldGhvZDogJ1BPU1QnLFxuICAgICAgc3VjY2VzczogZnVuY3Rpb24gKCkge1xuICAgICAgICBsb2NhdGlvbi5yZWxvYWQoKTtcbiAgICAgIH1cbiAgICB9KTtcbiAgfVxuICAkKCcuZ3JpZHMtY29udHJvbC1yZWNvcmRzLXBlci1wYWdlJykuY2hhbmdlKGZ1bmN0aW9uKCkge1xuICAgIHZhciBycHAgPSAkKHRoaXMpLnZhbCgpO1xuICAgIGNoYW5nZVJvd1BlclBhZ2UocnBwKTtcbiAgfSk7XG4gICQoJy5ncmlkLXRhYmxlIC5zb3J0YWJsZScpLmNsaWNrKGZ1bmN0aW9uKCkge1xuICAgIHZhciB1cmwgPSBuZXcgVVJMKHdpbmRvdy5sb2NhdGlvbi5ocmVmKTtcbiAgICB2YXIgc29ydF9uYW1lID0gJCh0aGlzKS5hdHRyKFwiZGF0YS1rZXlcIik7XG4gICAgdmFyIHNvcnRfdHlwZSA9ICQodGhpcykuYXR0cihcImRhdGEtdHlwZVwiKTtcbiAgICBcbiAgICB1cmwuc2VhcmNoUGFyYW1zLnNldCgnc29ydFtzb3J0X25hbWVdJywgc29ydF9uYW1lKTtcbiAgICB1cmwuc2VhcmNoUGFyYW1zLnNldCgnc29ydFtzb3J0X3R5cGVdJywgc29ydF90eXBlKTtcbiAgICBcbiAgICB3aW5kb3cubG9jYXRpb24uaHJlZiA9IHVybFxuICB9KTtcblxuICAvLyBjb3B5IHRvIGNsaXBib2FyZFxuICB2YXIgY29weVRvQ2xpcGJvYXJkID0gZnVuY3Rpb24gKGVsZSkge1xuICAgIHZhciAkdGVtcCA9ICQoXCI8aW5wdXQ+XCIpO1xuICAgICQoXCJib2R5XCIpLmFwcGVuZCgkdGVtcCk7XG4gICAgJHRlbXAudmFsKGVsZS50ZXh0KCkpLnNlbGVjdCgpO1xuICAgIGRvY3VtZW50LmV4ZWNDb21tYW5kKFwiY29weVwiKTtcbiAgICAkdGVtcC5yZW1vdmUoKTtcblxuICAgIGFsZXJ0KGVsZS50ZXh0KCkgKyBcIiBjb3BpZWRcIik7XG4gIH1cbiAgJChcIi5jb3B5VG9DbGlwYm9hcmRcIikuY2xpY2soZnVuY3Rpb24oKSB7XG4gICAgY29weVRvQ2xpcGJvYXJkKCQodGhpcykucGFyZW50KCkuZmluZCgnLmNvcHlWYWx1ZScpKTtcbiAgfSk7XG4gIFxuICAkKFwiLmNvbmR1Y3RlZF9hdFwiKS5mbGF0cGlja3Ioe1xuICAgIGxvY2FsZTogZG9jdW1lbnQuZG9jdW1lbnRFbGVtZW50LmxhbmcsXG4gICAgZGF0ZUZvcm1hdDogXCJZLW0tZFwiLFxuICAgIG1pbkRhdGU6IFwidG9kYXlcIixcbiAgICBkaXNhYmxlTW9iaWxlOiB0cnVlXG4gIH0pO1xuICBcbiAgJChcIi5jb25kdWN0ZWRfdGltZVwiKS5mbGF0cGlja3Ioe1xuICAgIGxvY2FsZTogZG9jdW1lbnQuZG9jdW1lbnRFbGVtZW50LmxhbmcsXG4gICAgbm9DYWxlbmRhcjogdHJ1ZSxcbiAgICBlbmFibGVUaW1lOiB0cnVlLFxuICAgIGRhdGVGb3JtYXQ6IFwiSDppXCIsXG4gICAgdGltZV8yNGhyOiB0cnVlLFxuICAgIGRpc2FibGVNb2JpbGU6IHRydWVcbiAgfSk7XG5cbiAgLy8gcHJpbnRcbiAgJChcIi5wcmludFwiKS5jbGljayhmdW5jdGlvbigpIHtcbiAgICBjdXN0b21QcmludCgpO1xuICB9KTtcbiAgJChcIi5wcmludC1mb3ItYWx0YXJcIikuY2xpY2soZnVuY3Rpb24oKSB7XG4gICAgJChcIi5mb3ItYWx0YXJcIikuY3NzKHtcImRpc3BsYXlcIjogXCJibG9ja1wifSk7XG4gICAgY3VzdG9tUHJpbnQoKTtcbiAgICAkKFwiLmZvci1hbHRhclwiKS5jc3Moe1wiZGlzcGxheVwiOiBcIm5vbmVcIn0pO1xuICB9KVxuXG4gIGZ1bmN0aW9uIGN1c3RvbVByaW50KCkge1xuICAgIGRvY3VtZW50LmJvZHkuaW5uZXJIVE1MID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoXCJwcmludC1hcmVhXCIpLmlubmVySFRNTDtcbiAgICB3aW5kb3cucHJpbnQoKTtcbiAgICBsb2NhdGlvbi5yZWxvYWQoKTtcbiAgfVxuXG4gIC8vIHJlYWRPbmx5IG9uIHNlbGVjdGlvbiBoYWNrIG9uIHN1Ym1pdFxuICAkKCdbcmVhZG9ubHldJykucHJvcCggXCJkaXNhYmxlZFwiLCBmYWxzZSApO1xufSk7XG4iXSwibWFwcGluZ3MiOiJBQUFBQSxDQUFDLENBQUMsVUFBU0EsQ0FBQyxFQUFFO0VBQ1o7RUFDQUMsSUFBSSxDQUFDLENBQUM7RUFDTixTQUFTQSxJQUFJQSxDQUFBLEVBQUc7SUFDZEMsb0JBQW9CLENBQUNGLENBQUMsQ0FBQyxjQUFjLENBQUMsQ0FBQztJQUN2Q0csZ0JBQWdCLENBQUNILENBQUMsQ0FBQyxvQkFBb0IsQ0FBQyxDQUFDO0lBQ3pDSSxhQUFhLENBQUNKLENBQUMsQ0FBQyxpQkFBaUIsQ0FBQyxDQUFDO0lBQ25DSyxXQUFXLENBQUNMLENBQUMsQ0FBQyxlQUFlLENBQUMsQ0FBQztFQUNqQzs7RUFFQTtFQUNBQSxDQUFDLENBQUMsTUFBTSxDQUFDLENBQUNNLE1BQU0sQ0FBQyxZQUFXO0lBQzFCTixDQUFDLENBQUMsY0FBYyxDQUFDLENBQUNPLElBQUksQ0FBQyxZQUFXO01BQ2hDUCxDQUFDLENBQUMsSUFBSSxDQUFDLENBQUNRLEdBQUcsQ0FBQ1IsQ0FBQyxDQUFDLElBQUksQ0FBQyxDQUFDUSxHQUFHLENBQUMsQ0FBQyxDQUFDQyxVQUFVLENBQUMsR0FBRyxFQUFFLEVBQUUsQ0FBQyxDQUFDO0lBQ2hELENBQUMsQ0FBQztJQUNGVCxDQUFDLENBQUMsb0RBQW9ELENBQUMsQ0FBQ08sSUFBSSxDQUFDLFlBQVc7TUFDdEVQLENBQUMsQ0FBQyxJQUFJLENBQUMsQ0FBQ1EsR0FBRyxDQUFDUixDQUFDLENBQUMsSUFBSSxDQUFDLENBQUNRLEdBQUcsQ0FBQyxDQUFDLENBQUNDLFVBQVUsQ0FBQyxHQUFHLEVBQUUsRUFBRSxDQUFDLENBQUM7SUFDaEQsQ0FBQyxDQUFDO0lBRUYsT0FBTyxJQUFJO0VBQ2IsQ0FBQyxDQUFDO0VBRUZULENBQUMsQ0FBQyxNQUFNLENBQUMsQ0FBQ1UsRUFBRSxDQUFDLE9BQU8sRUFBRSxhQUFhLEVBQUUsWUFBWTtJQUMvQ1YsQ0FBQyxD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\n//# sourceURL=webpack-internal:///./resources/js/common.js\n");

/***/ }),

/***/ "./resources/sass/common.scss":
/*!************************************!*\
  !*** ./resources/sass/common.scss ***!
  \************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n// extracted by mini-css-extract-plugin\n//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvc2Fzcy9jb21tb24uc2NzcyIsIm1hcHBpbmdzIjoiO0FBQUEiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvc2Fzcy9jb21tb24uc2Nzcz9kOGIzIl0sInNvdXJjZXNDb250ZW50IjpbIi8vIGV4dHJhY3RlZCBieSBtaW5pLWNzcy1leHRyYWN0LXBsdWdpblxuZXhwb3J0IHt9OyJdLCJuYW1lcyI6W10sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/sass/common.scss\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"/js/common": 0,
/******/ 			"css/common": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some((id) => (installedChunks[id] !== 0))) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkId] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunk"] = self["webpackChunk"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	__webpack_require__.O(undefined, ["css/common"], () => (__webpack_require__("./resources/js/common.js")))
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["css/common"], () => (__webpack_require__("./resources/sass/common.scss")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;