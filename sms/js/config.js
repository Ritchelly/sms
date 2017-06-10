
$(document).ready(function(){


    function SendRequest(url,data,dataType)
    {
        var url=url;
        var rs;
        $.ajax({
            type:'post',
            data:data,
            url:url,
            cache:false,
             dataType:dataType,
            async:false,
            error:function(){
                console.log('impossivel carregar dados');
            } ,
            success: function(result)
            {
                rs=result;
            }
        });
        return rs;
    }

    function get_statistics()
    {

        rs=SendRequest('functions/functions.php?get_statistics',null,'json');

        console.log(rs);
        var total=rs['total'];
        var sent=rs['sent'];
        var no_sent=rs['no_sent'];
        var sent_error=rs['sent_error'];

        $('#badge-to-send').html(no_sent);
        $('#badge-sent').html(sent);
        $('#badge-error').html(sent_error);
        $('#badge-total').html(total);

        return rs;


    }


    $(document).on('change', '.btn-file :file', function() {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);
    });


    $(document).ready( function() {

        $('.btn-file :file').on('fileselect', function(event, numFiles, label) {

            $('#txt-get-file').val(label);
        });

        var form;
        $('#arquivo').change(function (event) {
            form = new FormData();
            form.append('arquivo', event.target.files[0]); // para apenas 1 arquivo

            $('#btn-enviar-arquivo').prop('disabled', false);
           // $(this).prop('disabled',true);

        });

        $('#btn-enviar-arquivo').click(function () {
            $.ajax({
                url: 'functions/recebe_upload.php',
                data: form,
                processData: false,
                contentType: false,
                type: 'POST',
                success: function (data) {
                    // utilizar o retorno
                    alert(data);

                    //$('#teste').html(data);

                    $('#btn-importar-dados').prop('disabled', false);
                }

            });
        });

        $('#btn-importar-dados').click(function () {

            var data= {file:$('#txt-get-file').val()};
            var progress=setInterval(function(){get_statistics();},1000);

            var rs=SendRequest('functions/functions.php?import_file',data,null);
            if(!rs)
            {
                alert('Dados importados com sucesso !');
                clearInterval(progress);
            }
         //   $('#div-progress-bar-import-progress').css('width',percent_sent.toFixed(2)+'%').html(percent_sent.toFixed(2)+' %');
            get_statistics();
        });


        $('#btn-delete-db').on('click',function(){


            var data= {file:$('#txt-get-file').val()};
            var rs=SendRequest('functions/functions.php?delete_db',data,null);


                console.log('lista excluidas : '+rs);
            if(rs!=0)
            {
                alert('Dados excluidos com sucesso !');
            }

            get_statistics();

        });


        get_statistics();
    });

});