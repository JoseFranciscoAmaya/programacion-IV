var appexpedientes = new Vue({
    el:'#frm-expedientes',
    data:{
        expediente:{
            idExpediente  : 0,
            accion    : 'nuevo',
            cronica   : '',
            leve      : '',
            sintoma   : '',
            discapacidad : '',
            msg       : ''
        }
    },
    methods:{
        guardarExpediente:function(){
            fetch(`private/modulos/expedientes/procesos.php?proceso=recibirDatos&expediente=${JSON.stringify(this.expediente)}`).then( resp=>resp.json() ).then(resp=>{
                this.expediente.msg = resp.msg;
                this.expediente.idExpediente = 0;
                this.expediente.cronica = '';
                this.expediente.leve = '';
                this.expediente.sintoma= '';
                this.expediente.discapacidad = '';
                this.expediente.accion = 'nuevo'; 
                appBuscarExpedientes.buscarExpediente();
            });
        }
    }
});