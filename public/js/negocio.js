ne = {
    negocio: function() {
         $('.edit-cuenta').on('click', function (e){
            $('#TypeValidation')[0].reset(); 
             e.preventDefault();
            UIkit.modal('#modal-sections').show();
            var id = $('.cid').val();
            //console.log(id);
            var data = {
                id : id
            };
            contacto(data);        
        });
    },   
}
function contacto(datos){

    $.ajax({    
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: '/contactos/get_contacto', 
        type: 'GET',
        data: datos,
        dataType: 'json',        
        success: function(response){
          //console.log(response);
            data = response;   
            var name = data[0].nombre;     
            var email = data[0].correo;            
            var tel = data[0].telefono;             
            //console.log(name);  
            $('.cnombre').val(name);     
            $('.ccorreo').val(email);             
            $('.ctelefono').val(tel);         
        }, 
        error: function (r) {
            console.log(r); 
        } 
      });
}