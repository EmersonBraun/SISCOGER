export default{
    data() {
        return {
            add: false
        }
    },
    methods: {
        list(){
            let urlIndex = `${this.$root.baseUrl}api/${this.module}/list/${this.rg}`;
            if(this.rg){
                axios
                .get(urlIndex)
                .then((response) => {
                    this.registros = response.data
                })
                .catch(error => console.log(error));
            }
        },
        create(){
            let urlCreate = `${this.$root.baseUrl}api/${this.module}/store`;
            axios
            .post(urlCreate, this.registro)
            .then((response) => {
                this.transation(response.data.success, 'create')
            })
            .catch(error => console.log(error));
            this.showModal = false
            
        },
        edit(registro){
            this.registro = registro
            this.showModal = true
        },
        update(id){
            let urlUpdate = `${this.$root.baseUrl}api/${this.module}/update/${id}`;
            axios
            .put(urlUpdate, this.registro)
            .then((response) => {
                this.transation(response.data.success, 'edit')
            })
            .catch(error => console.log(error));
        },
        destroy(id){
            if(confirm('Você tem certeza?')){
                let urlDelete = `${this.$root.baseUrl}api/${this.module}/destroy/${id}`;
                axios
                .delete(urlDelete)
                .then((response) => {
                    this.transation(response.data.success, 'delete')
                })
                .catch(error => console.log(error));
            }
        },
        transation(happen,type) {
            let msg = this.words(type)
            this.showModal = false
            if(happen) { // se deu certo
                    this.list()
                    this.$root.msg(msg.success,'success')
                    this.registro = []
            } else { // se falhou
                this.$root.msg(msg.fail,'danger')
            }
        },
        words(type) {
            if(type == 'create') return { success : 'Inserido com sucesso', fail: 'Erro ao inserir'}
            if(type == 'edit') return { success : 'Editado com sucesso', fail: 'Erro ao editar'}
            if(type == 'delete') return { success : 'Apagado com sucesso', fail: 'Erro ao apagar'}
        }
    }
}