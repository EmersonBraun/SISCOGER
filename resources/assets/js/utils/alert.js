import Vue from 'vue'
const alert = {
    // level: show, success, info, error
    msg(type, happen, fullWidth=false) {
        const levelMsg = this.getLevelMsg(happen);
        console.log('levelMsg', levelMsg);
        const msg = this.getWord(type, levelMsg.level);
        Vue.toasted[levelMsg.level](msg, { 
            theme: 'toasted-primary', 
            // iconPack: 'fontawesome',
            // icon : { name: levelMsg.icon},
            keepOnHover: true,
            fullWidth: fullWidth,
            position: "top-right", 
            duration : 5000
       });
    },
    getLevelMsg(happen) {
        if(happen) return { level: 'success', icon: 'fa fa-check' }
        return { level: 'error', icon: 'fa fa-exclamation-triangle' }
    },
    getWord(type, level) {
        const typeMsg = this.words[type] ? this.words[type] : type;
        if(typeMsg !== type) return typeMsg[level];
        return type;
    },
    words: {
        list: { success : 'Carregado com sucesso', error: 'Erro ao carregar'},
        create: { success : 'Inserido com sucesso', error: 'Erro ao inserir'},
        edit: { success : 'Editado com sucesso', error: 'Erro ao editar'},
        delete: { success : 'Apagadado com sucesso', error: 'Erro ao apagar'},
        restore: { success : 'Restaurado com sucesso', error: 'Erro ao restaurar'},
        forceDelete: { success : 'Apagado definitivamente com sucesso', error: 'Erro ao apagagar definitivamente'},
    }
}
export default alert;