import alert from './alert';
const crud = {
    async list(URL, debug=false){
        let res = [];
        if(debug) console.log('URL list',URL);
        try {
            const response = await axios.get(URL)
            if(debug) console.log('response list', response);
            res = response;
            // alert.msg('list',true);
        } catch (error) {
            console.error(error);
            res = false;
            alert.msg('list',false);
        }
        return res;
    },

    async create(URL, data, debug=false){
        let res = [];
        if(debug) {
            console.log('URL create',URL);
            console.log('data create',data);
        }
        try {
            const response = await axios.post(URL, data);
            if(debug) console.log('response create', response);
            res = response;
            alert.msg('create',true);
        } catch (error) {
            console.error(error);
            res = false;
            alert.msg('create',false);
        }
        return res;
    },

    async update(URL, data, debug=false){
        let res = [];
        if(debug) {
            console.log('URL update',URL);
            console.log('data update',data);
        }
        try {
            const response = await axios.put(URL, data)
            if(debug) console.log('response update', response);
            res = response;
            alert.msg('edit',true);
        } catch (error) {
            console.error(error);
            res = false;
            alert.msg('edit',false);
        }
        return res;
    },

    async destroy(URL, id, debug=false){
        let res = [];
        if(debug) {
            console.log('URL destroy',URL);
            console.log('id destroy',id);
        }
        if(confirm('Você tem certeza?')){
            try {
                const response = await axios.delete(URL, id)
                if(debug) console.log('response destroy', response);
                res = response;
                alert.msg('delete',true);
            } catch (error) {
                console.error(error);
                res = false;
                alert.msg('delete',false);
            }
        }
        return res;
    },

    async restore(URL, id, debug=false){
        let res = [];
        if(debug) {
            console.log('URL restore',URL);
            console.log('id restore',id);
        }
        try {
            const response = await axios.post(URL, id);
            if(debug) console.log('response restore', response);
            res = response;
            alert.msg('restore',true);
        } catch (error) {
            console.error(error);
            res = false;
            alert.msg('restore',false);
        }
        return res;
    },

    async forceDelete(URL, id, debug=false){
        let res = [];
        if(debug) {
            console.log('URL foreceDelete',URL);
            console.log('id foreceDelete',id);
        }
        if(confirm('Você tem certeza?')){
            try {
                const response = await axios.delete(URL, id);
                if(debug) console.log('response foreceDelete', response);
                res = response;
                alert.msg('forceDelete',true);
            } catch (error) {
                console.error(error);
                res = false;
                alert.msg('forceDelete',false);
            }
        }
        return res;
    }
}
export default crud;
