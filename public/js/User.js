AOS.init();
function removeLocationHash(){
    var noHashURL = window.location.href.replace(/#.*$/, '');
    window.history.replaceState('', document.title, noHashURL) 
}



// SETTING DATA TO TABLE
var content = '<button id="edit">Edit</button><button id="hapus">Hapus</button>';
 var table = $('#myData').DataTable({
        "ajax": {
            "url": "/getAllUsers",
            "type": "GET"
        },
        "columns": [
            { "data": 'id' },
            { "data": 'username' },
        ],   
        "columnDefs": [
            {
                "targets": [0],
                "visible": false,
                "searchable": false
            },
            {
                "targets": [2],
                "data": null,
                "defaultContent": content
                
            },

        ]
        
    });

  // TAMBAH DATA
    $("#showTambah").click(function(e){
        e.preventDefault();
        window.location = "/user#formAdd";
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

 

  $("#formAdd").submit(function(e){ //form edit
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
                url:'user/insert_post',
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
                            window.location = "/user";
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
                window.location = "/user#formAdd";
            }
         });
        });

  // EDIT DATA
  $("#hideEdit").click(function(e){
        e.preventDefault();
        removeLocationHash();
        $(".notif").detach();
        $('#formEdit').slideUp( "fast" )
       
    })
  
  $('#myData tbody').on( 'click', '#edit', function () { //edit data
    var data = table.row( $(this).parents('tr') ).data();
    window.location = "/user#formEdit"
    $("#formAdd").hide();
    $('#formEdit').slideDown( "fast" )[0].reset();
    $("#id2").val(data["id"]);
    $("#username2").val(data["username"]);
    $('html, body').animate({
        scrollTop: $("#formEdit").offset().top
    }, 1000);
    } );

    $("#formEdit").submit(function(e){ //form edit
        e.preventDefault();
        var formData = new FormData(this);
        formData.append('gambar_lama',$("#previewedit2 img").attr("id"))
        $.ajax({
                url:'user/update_post',
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
                            window.location = "/user";
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
                window.location = "/user#formEdit";
            }
         });
        });


    // DELETE DATA

    $('#myData tbody').on( 'click', '#hapus', function () { //hapus data
        var confirm = window.confirm("Yakin Akan Menghapus ??");
        var data = table.row( $(this).parents('tr') ).data();        if(confirm){
            $.ajax({
                url:'user/delete_post',
                type:"post",
                data:{id:data["id"]},
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
