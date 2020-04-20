var appBuscarHombres = new Vue({
    el:'#frm-buscar-hombres',
    data:{
        mishombres:[],
        valor:''
    },
    methods:{
        buscarHombre:function(){
            fetch(`private/modulos/hombres/procesos.php?proceso=buscarHombre&hombre=${this.valor}`).then(resp=>resp.json()).then(resp=>{
                this.mishombres = resp;
            });
        },
        modificarHombre:function(hombre){
            apphombres.hombre = hombre;
            apphombres.hombre.accion = 'modificar';
        },
        eliminarHombre:function(idHombre){
            fetch(`private/modulos/hombres/procesos.php?proceso=eliminarHombre&hombre=${idHombre}`).then(resp=>resp.json()).then(resp=>{
                this.buscarHombre();
            });
        }
    },
    created:function(){
        this.buscarHombre();
    }
}); 