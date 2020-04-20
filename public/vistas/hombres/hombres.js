var apphombres = new Vue({
    el:'#frm-hombres',
    data:{
        hombre:{
            idHombre  : 0,
            accion    : 'nuevo',
            nombre   : '',
            apellido  : '',
            edad : '',
            dui  : '',
            msg       : ''
        }
    },
    methods:{
        guardarHombre:function(){
            fetch(`private/modulos/hombres/procesos.php?proceso=recibirDatos&hombre=${JSON.stringify(this.hombre)}`).then( resp=>resp.json() ).then(resp=>{
                this.hombre.msg = resp.msg;
                this.hombre.idHombre = 0;
                this.hombre.nombre = '';
                this.hombre.apellido = '';
                this.hombre.edad = '';
                this.hombre.dui = '';
                this.hombre.accion = 'nuevo'; 
                appBuscarHombres.buscarHombre();
            });
        }
    }
}); 