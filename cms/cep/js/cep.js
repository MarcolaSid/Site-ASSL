$(document).ready(function(){
    $('head').append('<script src="http://assl.dev/cms/cep/js/mask.js" type="text/javascript"></script>');
})

var last_cep = 0;
var address;
var lat;
var lng;
var wsconf;
function wscep(conf)
{
    //parametros padrao true
    if(!conf){
        conf = {
            'auto': true,
            'map' : '',
            'wsmap' : ''
        };
    }
    wsconf = conf;
    //evento keyup no campo cep opcional
    if(wsconf.auto == true){
        $('.cep-ws').live('keyup',function(){
			var elm_id = $(this).attr('id');
            var cep = $.trim($(this).val()).replace('_','');
            if(cep.length >= 9){
                if(cep != last_cep){
                    busca(elm_id);
                }
            }
        });         
    }else{
        var btn_busca = '<button class="btn btn_handler" type="button">Busca</button>';
        $('form').append(btn_busca)
        $('.btn_handler').live('click',function(){
            busca();
        })
    }    
    $('.cep-ws').mask('99999-999');    
}
//busca o cep
function busca(elm_id){
    var cep = $.trim($('#'+elm_id).val());
	var prefix = $('#'+elm_id).attr('prefix');
//    var url = 'http://xtends.com.br/webservices/cep/json/'+cep+'/';    
    var url = 'http://serverpanelhost.com/cep2014/cep.php?json&cep='+cep;
    if ($.browser.msie) {
        var url = 'ie.php';    
    }    
    $.post(url,{cep:cep},
		function (data) {
			
 		   data = $.parseJSON(data);
		   rs = data.rs[0]; 

            if(rs.endereco != ""){
                address = rs.endereco + ', ' + rs.bairro + ', ' + rs.cidade + ', ' + ', ' + rs.uf;
                if(wsconf.map != '' ){
                    setMap(wsconf.map);
                }
                // $('#rua').val(rs.endereco);
                console.log( '#'+prefix+'Rua');
				$('#'+prefix+'Rua').val(rs.tipo + ' ' + rs.endereco);				
                $('#'+prefix+'Bairro').val(rs.bairro);
                $('#'+prefix+'Cidade').val(rs.cidade);
                $('#'+prefix+'Estado').val(rs.uf);
                $('#'+prefix+'Cep').removeClass('error');
                $('#'+prefix+'Num').focus();
                $('#'+prefix+'Num').live('change',function(){
                    address = rs.endereco + ', ' + $('#'+prefix+'Num').val() + ', ' + rs.bairro + ', ' + rs.cidade + ', ' + ', ' + rs.uf;    
                    if(wsconf.map != ''){
                        setMap(wsconf.map);
                    }
                })
                last_cep = cep;
            }
            else{
                $('#errocep').addClass('error');    
                $('#'+elm_id).focus();  
                last_cep = 0;
            }
        })    
}
 
function wsmap(cep,num,elm)
{
    var url = 'http://serverpanelhost.com/cep2014/cep.php?json&cep='+cep;	
    if ($.browser.msie) {
        var url = 'ie.php';    
    }    
    $.post(url,{cep:cep},
		function (data) {
			data = $.parseJSON(data);
	        rs = data.rs[0]; 
            if(rs.endereco != ''){
                address = rs.endereco + ', ' + num + ', ' + rs.bairro + ', ' + rs.cidade + ', ' + ', ' + rs.uf;
                setMap(elm);
            }
        })
}
function setMap(elm)
{
    GMaps.geocode({
        address: address,
        callback: function(results, status) {            
            if (status == 'OK') {
                //console.log(elm);
                $('#'+elm).show();
                var latlng = results[0].geometry.location;
                lat = latlng.lat();
                lng = latlng.lng()
                map = new GMaps({
                    div: elm,
                    lat: lat,
                    lng: lng,
                    scrollwheel: false,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    streetViewControl: true,
                    zoom: 14
                })
                map.addMarker({
                    lat: lat,
                    lng: lng,
                    title: address
                });
                map.setCenter(lat, lng);
              // SETANDO VALORES NO FORM
              $('#lat').val(lat);
              $('#lng').val(lng);
            }
        }
    });   
     
}
