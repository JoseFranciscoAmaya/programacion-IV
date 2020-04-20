var appBuscarMujeres = new Vue({
    el:'#frm-buscar-mujeres',
    data:{
        mismujeres:[],
        valor:''
    },
    methods:{
        buscarMujer:function(){
            fetch(`private/modulos/mujeres/procesos.php?proceso=buscarMujer&mujer=${this.valor}`).then(resp=>resp.json()).then(resp=>{
                this.mismujeres = resp;
            });
        },
        modificarMujer:function(mujer){
            appmujeres.mujer = mujer;
            appmujeres.mujer.accion = 'modificar';
        },
        eliminarMujer:function(idMujer){
            fetch(`private/modulos/mujeres/procesos.php?proceso=eliminarMujer&mujer=${idMujer}`).then(resp=>resp.json()).then(resp=>{
                this.buscarMujer();
            });
        }
    },
    created:function(){
        this.buscarMujer();
    }
});