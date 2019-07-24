            AOS.init();
            //set preview 
                function readURL(input,id) { 
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            $('#preview'+id).attr('src', e.target.result);
                        }

                        reader.readAsDataURL(input.files[0]);
                    }
            }

            function removeLocationHash(){
                var noHashURL = window.location.href.replace(/#.*$/, '');
                window.history.replaceState('', document.title, noHashURL) 
            }



            // SETTING DATA TO TABLE
            var content = '<button id="edit">Edit</button><button id="hapus">Hapus</button>';
             var table = $('#myData').DataTable({
                    "ajax": {
                        "url": "/getAllData",
                        "type": "GET"
                    },
                    "columnDefs": [
                        {
                            "targets": [0],
                            "visible": false,
                            "searchable": false
                        },
                        {
                            "targets": -1,
                            "data": null,
                            "defaultContent": content
                            
                        },

                    ]
                    
                });

              // TAMBAH DATA
                $("#showTambah").click(function(e){
                    e.preventDefault();
                    window.location = "/crud#formAdd";
                    $('#preview').hide();
                    $('#formEdit').hide();
                    $(".notiferror").detach();
                    $('#formAdd').slideDown( "fast" )
                    $('html, body').animate({
                        scrollTop: $("#formAdd").offset().top
                    }, 1000);
                })
                $("#hideTambah").click(function(e){
                    e.preventDefault();
                    removeLocationHash();
                    $(".notiferror").detach();
                    $('#formAdd').slideUp( "fast" )
                   
                })

               $("#gambar").change(function(e){
                e.preventDefault();
                $("#previewedit").hide();
                $("#preview").show();
                readURL(this,""); //memanggil preview
              })

              $("#formAdd").submit(function(e){ //form edit
                    e.preventDefault();
                    var formData = new FormData(this);
                    $.ajax({
                            url:'crud/insert_post',
                            type:"post",
                            data:formData,
                            dataType:"json",
                            processData:false,
                            contentType:false,
                            cache:false,
                            success: function(response){
                                var pesan="";
                                if(response.status==="success"){
                                    pesan = "<div class='alert alert-"+response.status+"'><strong>Success!</strong> Terimakasih Telas Mengisi Form</div>";
                                    $("#pesanbox").html(pesan);
                                    setTimeout(() => {
                                        $('#formAdd').slideUp( "fast" )
                                        $("#pesanbox").html("");
                                        table.ajax.reload();
                                        removeLocationHash();
                                    }, 2000);
                                }else{
                                    pesan = "<div class='alert alert-"+response.status+"'><strong>GAGAL!</strong> Periksa Kembali Data Anda</div>";
                                    $("#pesanbox").html(pesan);
                                    setTimeout(() => {
                                        window.location = "/crud";
                                    }, 1000);
                                }
                        },
                        error:function(xhr,errors){
                            var error = xhr.responseJSON.errors;
                            $(".notiferror").detach();
                            Object.keys(error).forEach(function(key){
                                var elem = "<p class='notiferror' style='opacity:0;color:red'>"+error[key][0]+"<p>";
                                $(elem).insertAfter("#"+key).animate({
                                    opacity:'9'
                                },1000);
                            })
                            window.location = "/crud#formAdd";
                        }
                     });
                    });

              // EDIT DATA

              $("#gambar2").change(function(e){
                e.preventDefault();
                $("#previewedit2").hide();
                $("#preview2").show();
                readURL(this,2); //memanggil preview
              })

              $("#hideEdit").click(function(e){
                    e.preventDefault();
                    removeLocationHash();
                    $(".notif").detach();
                    $('#formEdit').slideUp( "fast" )
                   
                })
              
              $('#myData tbody').on( 'click', '#edit', function () { //edit data
                var data = table.row( $(this).parents('tr') ).data();
                window.location = "/crud#formEdit"
                $("#formAdd").hide();
                $('#formEdit').slideDown( "fast" )[0].reset();
                $("#id2").val(data[0]);
                $("#nama2").val(data[1]);
                $("#email2").val(data[2]);
                $("#tanggal_lahir2").val(data[3]);
                $("#nohp2").val(data[4]);
                $("#"+data[5]+"2").attr('selected','selected');
                $("#previewedit2").html(data[6]);
                $('html, body').animate({
                    scrollTop: $("#formEdit").offset().top
                }, 1000);
                } );

                $("#formEdit").submit(function(e){ //form edit
                    e.preventDefault();
                    var formData = new FormData(this);
                    $.ajax({
                            url:'crud/update_post',
                            type:"post",
                            data:formData,
                            dataType:"json",
                            processData:false,
                            contentType:false,
                            cache:false,
                            success: function(response){
                                var pesan = ""
                                if(response.status==="success"){
                                    pesan = "<div class='alert alert-"+response.status+"'><strong>Success!</strong> Update Dara Telah Tersimpan</div>"
                                    $("#pesanbox2").html(pesan);
                                    setTimeout(() => {
                                        table.ajax.reload();
                                        removeLocationHash();
                                        $(".notif").detach();
                                        $("#pesanbox2").html("");
                                        $('#formEdit').slideUp( "fast" )
                                        
                                    }, 1000);
                                }else{
                                    pesan = "<div class='alert alert-"+response.status+"'><strong>GAGAL!</strong> Periksa Kembali Data Anda</div>"
                                    $("#pesanbox2").html(pesan);
                                    setTimeout(() => {
                                        window.location = "/crud";
                                    }, 1000);
                                }
                        },
                        error:function(xhr,errors){
                            var error = xhr.responseJSON.errors;
                            $(".notif").detach();
                            Object.keys(error).forEach(function(key){
                                $("<p class='notif' style='opacity:0;color:red'>"+error[key][0]+"<p>").insertAfter("#"+key+"2").animate({
                                    opacity:'9'
                                },1000);
                            })
                            window.location = "/crud#formEdit";
                        }
                     });
                    });


                // DELETE DATA

                $('#myData tbody').on( 'click', '#hapus', function () { //hapus data
                    var confirm = window.confirm("Yakin Akan Menghapus ??");
                    var data = table.row( $(this).parents('tr') ).data();
                    var gambar =  $(this).parents('tr').find('img').get(0).id;
                    if(confirm){
                        $.ajax({
                            url:'crud/delete_post',
                            type:"post",
                            data:{id:data[0],gambar},
                            dataType:"json",
                            success: function(response){
                                if(response.status==="success"){
                                table.ajax.reload();
                                }
                        },
                        error:function(xhr){
                            console.log(xhr.responseText);
                        }
                        });
                        
                    }
                });
