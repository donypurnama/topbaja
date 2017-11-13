$(document).ready(function()
{
    $("[data-submit]").click(function() {
        var r = confirm($(this).data("submit"));
        if (r == false) return false;
    });

    $(document).on("click", ".box-ship", function()
    {
      $("input[name='order_ship_vendor']").val($(this).data("vendor"));
      $("input[name='order_ship_package']").val($(this).data("package"));
      $("input[name='order_ship_etd']").val($(this).data("etd"));
      $("input[name='order_ship_cost']").val($(this).data("cost"));
      $("#btnReview").removeAttr("disabled");
    });

    $(document).on("click", ".choose-bank", function(){
      $("#btnSubmitTransaction").removeAttr("disabled");
    });

    $('#verification-upload').on('click', function () {
      $('#img-container').hide();
      $('#vloader').show();
      var file_data = $('#file').prop('files')[0];
      var form_data = new FormData();
      var order_ref = $(this).data("ref");
      form_data.append('file', file_data);
      $.ajax({
         url: 'account/verification_upload/'+order_ref, // point to server-side controller method
         dataType: 'text', // what to expect back from the server
         cache: false,
         contentType: false,
         processData: false,
         data: form_data,
         type: 'post',
         success: function (response) {
           if (response == "success") {
             $("#img-container").load(location.href + " #img-container");
           } else {
             alert(response);
           }
         },
         error: function (response) {
             alert(response);
         },
         complete:function(){
           $('#vloader').hide();
           $('#img-container').show();
         }
      });
    });

    $('#loader').hide();
    $('#freeshippingOpt').show();
    $('#vloader').hide();

    $("#province").on("change", function()
    {
      // $("#shippingMethodContainer").html("");
      $("input[name='order_ship_province']").val($("#province option:selected").text());
      $("input[name='order_ship_city']").val("");
      $("input[name='order_ship_district']").val("");
      $("input[name='order_ship_vendor']").val("");
      $("input[name='order_ship_package']").val("");
      $("input[name='order_ship_etd']").val("");
      $("input[name='order_ship_cost']").val("");
      $("#subdistrict-dropdown").html("<option value='' disabled selected>Pilih Kecamatan</option>");
      $("#btnReview").prop("disabled", true);

      $.ajax({
          url:'cart/get_city/'+this.value,
          dataType:'json',
          success:function(response){
              // $(id).html('');
              $city = '';
              $.each(response["rajaongkir"]["results"], function(i,n){
                city = '<option value="'+n['city_id']+'">'+n['type']+' '+n['city_name']+'</option>';
                $city += city;
              });
              var initial = '<option value="" disabled selected>Pilih Kota</option>';
              $("#city-dropdown").html(initial+$city);
          },
          error:function(){
              $("#city-dropdown").html('ERROR');
          }
      });
    });

    $("#city-dropdown").on("change", function(){
      // $("#shippingMethodContainer").html("");
      $("input[name='order_ship_city']").val($("#city-dropdown option:selected").text());
      $("input[name='order_ship_district']").val("");
      $("input[name='order_ship_vendor']").val("");
      $("input[name='order_ship_package']").val("");
      $("input[name='order_ship_etd']").val("");
      $("input[name='order_ship_cost']").val("");
      $("#btnReview").prop("disabled", true);
      $.ajax({
          url:'cart/get_subdistrict/'+this.value,
          dataType:'json',
          success:function(response){
              // $(id).html('');
              $subdistrict = '';
              $.each(response["rajaongkir"]["results"], function(i,n){
                subdistrict = '<option value="'+n['subdistrict_id']+'">'+n['subdistrict_name']+'</option>';
                $subdistrict += subdistrict;
              });
              var initial = '<option value="" disabled selected>Pilih Kecamatan</option>';
              $("#subdistrict-dropdown").html(initial+$subdistrict);
          },
          error:function(){
              $("#subdistrict-dropdown").html('<option value="" disabled selected>-</option>');
          }
      });
    });

    $("#subdistrict-dropdown").on("change", function() {

      $("input[name='order_ship_district']").val($("#subdistrict-dropdown option:selected").text());

      $("#btnReview").prop("disabled", false);

      $('#loader').show();

      $('#freeshippingOpt').show();
      var z = $("#city-dropdown").val();

      $.ajax({
          url:'cart/get_ongkir/'+z,
          dataType:'json',
          success:function(response){
              // $(id).html('');
              $shipping = '';
              $.each(response["rajaongkir"]["results"], function(i,n){
                $.each(n["costs"], function(j,m){
                  if (m["cost"]) {
                      if (m["cost"]["value"] != 0) {
                        var etd = m["cost"][0]["etd"] + ' hari';
                        if (m["cost"][0]["etd"] == "") etd = 'Same day';
                        shipment = '<div data-vendor="' + n["code"] + '" data-package="' + m["description"] + '" data-etd="' + etd + '" data-cost="' + m["cost"][0]["value"] + '" data-sort="' + m["cost"][0]["cost_value"] + '" class="col-sm-3 box-ship"><div class="box shipping-method"><img src="file_assets/couriers/' +
                        n["code"] + '.png" class="img-responsive" title="' + m["description"] + '" style="margin:0 auto;height:50px;"><h5 class="text-muted text-center text-ellipsis-row-1" title="' + m["description"] + '">' + m["service"] +
                        '</h5><p class="text-muted text-center" style="font-size:10px;">'+m["description"]+'</p><p class="text-center text-muted"><i class="fa fa-clock-o"></i> ' + etd + '</p><h5 class="text-center text-muted">Rp ' + m["cost"][0]["cost_value"] +
                        '</h5><div class="box-footer text-center"><input type="radio" class="radio-shipment" name="delivery" value="' + m["description"] + ',' +
                        m["description"] + '"></div></div></div>';
                        $shipping += shipment;
                      }
                  }
                });
              });
              // $("#shippingMethodContainer").html($shipping);
              var $wrapper = $('#shippingMethodContainer');
              $wrapper.find('.box-ship').sort(function(a, b) {
                  return +a.dataset.sort - +b.dataset.sort;
              })
              .appendTo($wrapper);
          },
          error:function(){
              $("#shippingMethodContainer").html('<option value="" disabled selected>-</option>');
          },
          complete:function(){
            $('#loader').hide();
          }
      });
    });
    // $("input:radio[name='delivery']").change(function(){
    //   alert();
    //   $("input[name='order_ship_vendor']").val($(this).data("vendor"));
    //   $("input[name='order_ship_package']").val($(this).data("package"));
    //   $("input[name='order_ship_etd']").val($(this).data("etd"));
    //   $("input[name='order_ship_cost']").val($(this).data("cost"));
    // });
    //submit enter
    $('.submitOnEnter').keydown(function(event) {
      // enter has keyCode = 13, change it if you want to use another button
      if (event.keyCode == 13) {
        this.form.submit();
        return false;
      }
    });


    //js for fixed top on scroll
    var offset = document.getElementById("top").offsetHeight;
    $(window).scroll(function () {
        if ($(window).scrollTop() > offset) {
            $('#navbar').addClass('fixed-header');
        }

        if ($(window).scrollTop() < offset) {
            $('#navbar').removeClass('fixed-header');
        }
    });

    //js for category page
    function UpdateQueryString(key, value, url) {
        if (!url) url = window.location.href;
        var re = new RegExp("([?&])" + key + "=.*?(&|#|$)(.*)", "gi"),
            hash;

        if (re.test(url)) {
            if (typeof value !== 'undefined' && value !== null)
                return url.replace(re, '$1' + key + "=" + value + '$2$3');
            else {
                hash = url.split('#');
                url = hash[0].replace(re, '$1$3').replace(/(&|\?)$/, '');
                if (typeof hash[1] !== 'undefined' && hash[1] !== null)
                    url += '#' + hash[1];
                return url;
            }
        }
        else {
            if (typeof value !== 'undefined' && value !== null) {
                var separator = url.indexOf('?') !== -1 ? '&' : '?';
                hash = url.split('#');
                url = hash[0] + separator + key + '=' + value;
                if (typeof hash[1] !== 'undefined' && hash[1] !== null)
                    url += '#' + hash[1];
                return url;
            }
            else
                return url;
        }
    }

    $("#btnFilter").on("click", function(){
      //reset to default url, and page = 1
      var url = [location.protocol, '//', location.host, location.pathname].join('');

      var url = UpdateQueryString("page","1", url);
      var sort = $('#sort').val();
      url = UpdateQueryString("sort", sort, url);
      var brands = [];
      $.each($("input[name='brands[]']:checked"), function(){
        url += "&brands[]=" + $(this).val();
      });

      window.location.href = url;
    });

    $("#btnResetFilter").on("click", function(){
      $("input[name='brands[]']:checked").removeAttr('checked');
      $("#sort").val("latest");
    });

    $("#btnNextPage").on("click", function(){
      var gotoPage = $(this).val();
      var url = UpdateQueryString("page", gotoPage);

      window.location.href = url;
    });

    $("#btnPrevPage").on("click", function(){
      var gotoPage = $(this).val();
      var url = UpdateQueryString("page", gotoPage);

      window.location.href = url;
    });

});
