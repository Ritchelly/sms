
$('document').ready(function() {

    get_statistics();

    $('#btn-start-stop').on('click',function(){


        if($('#txt-sms-read').val()=='')
        {
           //$('#alert').addClass('alert-danger').show().append('O campo de mensagem não pode ficar vazio ! ').children('strong').html('Aviso !')
            alert('O campo de mensagem não pode ficar vazio !');
        }
        else
        {
            var state= $(this).attr('state');
            if(state=='stopped') {
                trigger=setInterval(function () {SendSMS(); }, getRandomInt(1000, 4000));
             //   trigger=setInterval(function () {SendSMS(); }, 4000);
                $(this).addClass('btn-danger').html('Parar').attr('state','started');

            }else
            {
                $(this).removeClass('btn-danger').html('Iniciar').attr('state','stopped');
                clearInterval(trigger);
            }
        }

    });

    $('#txt-sms-read').keyup(function() {

        var len =$(this).val().length;
        $('#lb-qtd-char').html(len+' de 150 caracteres');
    });

});


function SendSMS()
{
    var msg=$('#txt-sms-read').val();
    var data={msg:msg};
    rs= GetData('functions/functions.php?send_sms',null,data);
    console.log('Response code : '+ rs);


    if(rs==3)
    {
        $('#btn-start-stop').removeClass('btn-danger').html('Iniciar').attr('state','stopped');
        clearInterval(trigger);
    }

    get_statistics();

}

function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

function get_statistics()
{
    rs=GetData('functions/functions.php?get_statistics','json',null);
    console.log(rs);
    var total=rs['total'];
    var sent=rs['sent'];
    var no_sent=rs['no_sent'];
    var sent_error=rs['sent_error'];
    if(total==0)
    {
        sent=0;
        no_sent=0;
        sent_error=0;

    }
    else
    {
        $('#lb-qtd-sent').html(sent+' de '+ total +' mensagens enviadas');
        var percent_sent=(((parseInt(sent)+parseInt(sent_error))/total)*100);
    }

    $('#div-progress-bar-sms-progress').css('width',percent_sent.toFixed(2)+'%').html(percent_sent.toFixed(2)+' %');

    $('#badge-to-send').html(no_sent);
    $('#badge-sent').html(sent);
    $('#badge-error').html(sent_error);
    $('#badge-total').html(total);

}


function GetData(url,dataType,data)
{
    var url=url;
    var rs;
    var data;

    $.ajax({
        type:'post',
        data:data,
        url:url,
        cache:false,
        dataType:dataType,
        async:false,
        error:function(){
            alert('Erro de requisição');
        },
        success: function(result)
        {
            rs=result;

        }
    });
    return rs;
}