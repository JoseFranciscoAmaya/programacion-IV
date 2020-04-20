var appBuscarRurales = new Vue({
    el:'#frm-buscar-rurales',
    data:{
        misrurales:[],
        valor:''
    },
    methods:{
        buscarRural:function(){
            fetch(`private/modulos/rurales/procesos.php?proceso=buscarRural&rural=${this.valor}`).then(resp=>resp.json()).then(resp=>{
                this.misrurales = resp;
            });
        },
        modificarRural:function(rural){
            apprurales.rural = rural;
            apprurales.rural.accion = 'modificar';
        },
        eliminarRural:function(idRural){
            fetch(`private/modulos/rurales/procesos.php?proceso=eliminarRural&rural=${idRural}`).then(resp=>resp.json()).then(resp=>{
                this.buscarRural();
            });
        }
    },
    created:function(){
        this.buscarRural();
    }
}); 