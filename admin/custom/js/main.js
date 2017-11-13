$(document).ready(function () {

    $('#summernote').summernote({
        height: 300, // set editor height
        minHeight: 300, // set minimum height of editor
        maxHeight: null, // set maximum height of editor
        focus: true, // set focus to editable area after initializing summernote
        dialogsInBody: true // make the dialog popup override the bs backdrop from template
    });

/*    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });*/

    $('[data-target="#confirm-delete"]').on("click", function() {
        var href = $(this).data('href');

        swal({
          title: "Hapus data ini?",
          text: "Data tidak dapat dikembalikan setelah dihapus",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: 'btn-danger',
          confirmButtonText: 'Ya, hapus!',
          cancelButtonText: 'Batal',
          closeOnConfirm: false,
          //closeOnCancel: false
        },
        function(){
            swal("Terhapus!", "Data telah dihapus!", "success");
            setTimeout(function() {
                window.location.replace(href);
            }, 1000);
        });
        return false;
    });

    $('[data-target="#confirm-save"]').on("click", function() {
        var href = $(this).data('href');
        var form = $(this).parents('form');
        swal({
          title: "Simpan data ini?",
          text: "Anda yakin untuk menyimpan data ini?",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: 'btn-success',
          confirmButtonText: 'Ya, Simpan!',
          cancelButtonText: 'Tidak, Tetap di Sini',
          closeOnConfirm: false,
          //closeOnCancel: false
        },
        function(){
            swal("Tersimpan!", "Data telah Disimpan!", "success");
            setTimeout(function() {
                form.submit();
            }, 1000);
        });
        return false;
    });

    //batal di edit dan tambah artikel
    $(".btn-batal").on("click", function() {
        var href = $(this).attr("href");

        swal({
          title: "Kembali?",
          text: "Pastikan perubahan Anda telah disimpan",
          type: "warning",
          showCancelButton: true,
          reverseButtons: true,
          confirmButtonClass: 'btn-danger',
          confirmButtonText: 'Ya, kembali!',
          cancelButtonText: 'Tidak, tetap disini',
          closeOnConfirm: false
        },
        function(){
            window.location.replace(href);
        });
        return false;
    });

    $(".btn-back").on("click", function() {
        var href = $(this).attr("href");

        swal({
          title: "Batal?",
          text: "Data yang Anda masukkan tidak akan tersimpan",
          type: "warning",
          showCancelButton: true,
          reverseButtons: true,
          confirmButtonClass: 'btn-danger',
          confirmButtonText: 'Ya, batal!',
          cancelButtonText: 'Tidak, tetap disini',
          closeOnConfirm: false
        },
        function(){
            window.location.replace(href);
        });
        return false;
    });

    $(".btn-back-update").on("click", function() {
        var href = $(this).attr("href");

        swal({
          title: "Batal?",
          text: "Data yang Anda ubah tidak akan disimpan",
          type: "warning",
          showCancelButton: true,
          reverseButtons: true,
          confirmButtonClass: 'btn-danger',
          confirmButtonText: 'Ya, batal!',
          cancelButtonText: 'Tidak, tetap disini',
          closeOnConfirm: false
        },
        function(){
            window.location.replace(href);
        });
        return false;
    });
    $('input.number').priceFormat({
      prefix: '',
      centsSeparator: ',',
      thousandsSeparator: '.',
      centsLimit: 0
    });

    $('#category').change(function () {
        var selcategory = $(this).val();
        console.log(selcategory);  //menampilan pada log browser apa yang dibawa pada saat dipilih pada combo box
        $.ajax({
            url: "product/get_type/",       //memanggil function controller dari url
            async: false,
            type: "POST",     //jenis method yang dibawa ke function
            data: "category_id="+selcategory,   //data yang akan dibawa di url
            dataType: "html",
            success: function(data) {
                console.log(data);
                $('#type').html(data);   //hasil ditampilkan pada combobox id=kota
            }
        })
    });

    //product_images
    $('.ajax-loader').hide();
    $(function () {
    	var inputFile = $('input#file');
    	var uploadURI = $('#form-upload').attr('action');
    	var progressBar = $('#progress-bar');

    	listFilesOnServer();

    	$('#upload-btn').on('click', function(event) {
          var $loader = $('.ajax-loader');
      		var filesToUpload = inputFile[0].files;
      		// make sure there is file(s) to upload
      		if (filesToUpload.length > 0) {
      			// provide the form data
      			// that would be sent to sever through ajax
      			var formData = new FormData();

      			for (var i = 0; i < filesToUpload.length; i++) {
      				var file = filesToUpload[i];

      				formData.append("file[]", file, file.name);
      			}

      			// now upload the file using $.ajax
      			$.ajax({
      				url: uploadURI,
      				type: 'POST',
      				data: formData,
      				processData: false,
      				contentType: false,
                      beforeSend : function(){
                         $loader.show();
                      },
                        complete : function(returndata){
                        console.log(returndata);
                        $loader.hide();
                      },
      				success: function() {
              $('input').val("");
      				listFilesOnServer();
      				}
      			});
      		}
          return false;
    	});

    	$('body').on('click', '.remove-file', function () {
    		var me = $(this);

            swal({
              title: "Hapus gambar ini?",
              text: "Gambar tidak dapat dikembalikan setelah dihapus",
              type: "warning",
              showCancelButton: true,
              confirmButtonClass: 'btn-danger',
              confirmButtonText: 'Ya, hapus!',
              cancelButtonText: 'Batal',
              closeOnConfirm: false,
              //closeOnCancel: false
            },
            function(){
                $.ajax({
    			url: uploadURI,
    			type: 'POST',
    			data: {file_to_remove: me.attr('data-file')},
    			success: function() {
                    me.closest('.thumbnail-container').remove();
                    $('.photo-qty').html("Terdapat " + $('.thumbnail-container').length + " Koleksi Foto");
                    swal("Terhapus!", "Gambar telah dihapus!", "success");
                    }
                });
            });

            return false;
    	});

        $('body').on('click', '.edit-file', function () {
            var me = $(this);
    		    var new_description = $('[data-caption="'+me.attr('data-file')+'"]').html();

            swal({
              title: "Ubah Keterangan",
              type: "input",
              showCancelButton: true,
              closeOnConfirm: false,
              inputValue: new_description,
              inputPlaceholder: "Tulis keterangan foto disini",

            }, function (inputValue) {
              if (inputValue === false) return false;
              else {
                  new_description = inputValue;
                  $.ajax({
                      url: 'product/update_description',
                      type: 'POST',
                      data: {
                          product_image_id: me.attr('data-file'),
                          product_image_description: inputValue
                      },
                      success: function(result) {
                          console.log(result);
                          swal("Keterangan berhasil dirubah",null, "success");
                          $('[data-caption="'+me.attr('data-file')+'"]').html(new_description);
                      },
                      error: function() {
                          swal("Keterangan gagal dirubah", "Terdapat kesalahan saat proses", "error");
                      }
                  });
              }
            });

            return false;
    	});

    	function listFilesOnServer () {
    		var items = [];

    		$.getJSON(uploadURI, function(data) {
    			$.each(data, function(index, element) {
                    //console.log(element);
    				items.push('<div class="col-xs-12 col-sm-6 col-md-4 thumbnail-container"><div class="thumbnail"><img src="../file_assets/products/'+element.product_image+'" class="img-responsive photo-thumbnail"><div class="caption"><p data-caption="'+element.product_image_id+'" class="text-center txt-caption text-ellipsis-row-1">'+element.product_image_description+'</p></div><p align="center"><a href="#" data-file="' + element.product_image_id + '" data-description="'+element.product_image_id+'" class="btn btn-info btn-sm btn-wd btn-fill edit-file">Ubah Keterangan</a></p><p align="center"><a href="#" data-file="' + element.product_image_id + '" class="btn btn-danger btn-sm btn-wd btn-fill remove-file">Hapus</a></p></div></div></div>');
    			});
    			$('.thumbnails').html("").html(items.join(""));
          $('.photo-qty').html("Terdapat " + items.length + " Koleksi Foto");
    		});
    	}
    });

    //Nomor Resi
    //check radio checked
    var radio_status = $('#order_status_prev').val();

    if (radio_status == 0 || radio_status == 4 ){
      $('.order_resi').hide();
    };
    $('.order_status').change(function () {
      var order_status = $(this).val();
      if (order_status == 1 || order_status ==2 ||  order_status ==3  ) {

        $('.order_resi').show("slow");
      }else {
        $('.order_resi').hide("slow");
      }
    });

    //Alamat
    $('.order-address-edit').hide();
    $('#address-edit').click(function(){
          if($(this).is(":checked")){
              $('.order-address-edit').show("slow");
          }
          else if($(this).is(":not(:checked)")){
              $('.order-address-edit').hide("slow");
          }
      });

    if($('#inactive').prop('Checked')==true){

      alert('click');
    }
    //pagination
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

    $( "#sandbox-container input" ).datepicker({
      dateFormat: "dd/mm/yy",
      regional: "id",
      maxDate: "today",
      setDate: new Date(),
      showAnim: "fold"
    });
    // $( ".datepicker" ).datepicker({
    //   dateFormat: "dd/mm/yy",
    //   regional: "id",
    //   maxDate: "today",
    //   setDate: new Date(),
    //   showAnim: "fold"
    // });

    var dateFormat = "dd/mm/yy",
      from = $( "#from" )
        .datepicker({
          defaultDate: "-1d",
          regional: "id",
          maxDate: "today",
          showAnim:"fold"
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
        }),
      to = $( "#to" ).datepicker({
        defaultDate: "today",
        regional: "id",
        maxDate: "today",
        showAnim:"fold"
      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate( this ) );
      });

    function getDate( element ) {
      var date;
      try {
        date = $.datepicker.parseDate( dateFormat, element.value );
      } catch( error ) {
        date = null;
      }

      return date;
    }
});
