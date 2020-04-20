var appBuscarUrbanas = new Vue({
    el:'#frm-buscar-urbanas',
    data:{
        misurbanas:[],
        valor:''
    },
    methods:{
        buscarUrbana:function(){
            fetch(`private/modulos/urbanas/procesos.php?proceso=buscarUrbana&urbana=${this.valor}`).then(resp=>resp.json()).then(resp=>{
                this.misurbanas = resp;
            });
        },
        modificarUrbana:function(urbana){
            appurbanas.urbana = urbana;
            appurbanas.urbana.accion = 'modificar';
        },
        eliminarUrbana:function(idUrbana){
            fetch(`private/modulos/urbanas/procesos.php?proceso=eliminarUrbana&urbana=${idUrbana}`).then(resp=>resp.json()).then(resp=>{
                this.buscarUrbana();
            });
        }
    },
    created:function(){
        this.buscarUrbana();
    }
}); 