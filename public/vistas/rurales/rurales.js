var apprurales = new Vue({
    el:'#frm-rurales',
    data:{
        rural:{
            idRural  : 0,
            accion    : 'nuevo',
            municipio   : '',
            canton  : '',
            colonia : '',
            descripcion : '',
            msg       : ''
        }
    },
    methods:{
        guardarRural:function(){
            fetch(`private/modulos/rurales/procesos.php?proceso=recibirDatos&rural=${JSON.stringify(this.rural)}`).then( resp=>resp.json() ).then(resp=>{
                this.rural.msg = resp.msg;
                this.rural.idRural = 0;
                this.rural.municipio = '';
                this.rural.canton = '';
                this.rural.colonia = '';
                this.rural.descripcion = '';
                this.rural.accion = 'nuevo'; 
                appBuscarRurales.buscarRural();
            });
        }
    }
}); 