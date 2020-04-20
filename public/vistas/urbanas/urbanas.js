var appurbanas = new Vue({
    el:'#frm-urbanas',
    data:{
        urbana:{
            idUrbana  : 0,
            accion    : 'nuevo',
            municipio   : '',
            ciudad  : '',
            avenida: '',
            descripcion : '',
            msg       : ''
        }
    },
    methods:{
        guardarUrbana:function(){
            fetch(`private/modulos/urbanas/procesos.php?proceso=recibirDatos&urbana=${JSON.stringify(this.urbana)}`).then( resp=>resp.json() ).then(resp=>{
                this.urbana.msg = resp.msg;
                this.urbana.idUrbana = 0;
                this.urbana.municipio = '';
                this.urbana.ciudad = '';
                this.urbana.avenida= '';
                this.urbana.descripcion = '';
                this.urbana.accion = 'nuevo'; 
                appBuscarUrbanas.buscarUrbana();
            });
        }
    }
}); 