var appBuscarExpedientes = new Vue({ 
    el:'#frm-buscar-expedientes',
    data:{
        misexpedientes:[],
        valor:''
    },
    methods:{
        buscarExpediente:function(){
            fetch(`private/modulos/expedientes/procesos.php?proceso=buscarExpediente&expediente=${this.valor}`).then(resp=>resp.json()).then(resp=>{
                this.misexpedientes = resp;
            });
        },
        modificarExpediente:function(expediente){
            appexpedientes.expediente = expediente;
            appexpedientes.expediente.accion = 'modificar';
        },
        eliminarExpediente:function(idExpediente){
            fetch(`private/modulos/expedientes/procesos.php?proceso=eliminarExpediente&expediente=${idExpediente}`).then(resp=>resp.json()).then(resp=>{
                this.buscarExpediente();
            });
        }
    },
    created:function(){
        this.buscarExpediente();
    }
});