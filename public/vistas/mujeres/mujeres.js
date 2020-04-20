var appmujeres = new Vue({
    el:'#frm-mujeres',
    data:{
        mujer:{
            idMujer  : 0,
            accion    : 'nuevo',
            nombre   : '',
            apellido  : '',
            edad : '',
            dui  : '',
            msg       : ''
        }
    },
    methods:{
        guardarMujer:function(){
            fetch(`private/modulos/mujeres/procesos.php?proceso=recibirDatos&mujer=${JSON.stringify(this.mujer)}`).then( resp=>resp.json() ).then(resp=>{
                this.mujer.msg = resp.msg;
                this.mujer.idMujer = 0;
                this.mujer.nombre = '';
                this.mujer.apellido = '';
                this.mujer.edad = '';
                this.mujer.dui = '';
                this.mujer.accion = 'nuevo'; 
                appBuscarMujeres.buscarMujer();
            });
        }
    }
});