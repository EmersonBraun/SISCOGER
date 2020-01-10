<template>
    <div class="col-lg-12 col-md-12 col-xs-12 card">
        <div class="card-header">
            <h5><b>Arquivos</b></h5> 
        </div>
        <div class="card-body" :class="add ? 'bordaform' : ''" v-if="!only">
            <div v-if="!add">
                <button @click="add = !add" class="btn btn-success btn-block"><i class="fa fa-plus"></i> Adicionar arquivo</button>
            </div>
            <div v-else>
                <div id="ligacaoForm1" class="row">
                    <form id="formArquivo" name="formArquivo">
                        <input type="hidden" name="procedimento" :value="dproc">
                        <input type="hidden" :name="'id_'+dproc" :value="idp">
                        <input type="hidden" name="sjd_ref" :value="dref">
                        <input type="hidden" name="sjd_ref_ano" :value="dano">
                        <input type="hidden" name="arquivo_data" :value="today">
                        <input type="hidden" name="rg" :value="rg">
                        <input type="hidden" name="nome" :value="nome">
                        <input type="hidden" name="opm" :value="opm">
                        <div class="col-lg-3 col-md-3 col-xs-3">
                            <label for="local_atual">Local</label><br>
                            <select name="local_atual" v-model="local" class="form-control">
                                <option v-for="l in locais" :key="l">{{ l }}</option>
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-3 col-xs-3">
                            <label for="numero">Número</label><br>
                            <select name="numero" v-model="numero" class="form-control">
                                <option v-for="n in 100" :key="n">{{ n }}</option>
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-3 col-xs-3">
                            <label for="letra">Letra</label><br>
                            <select name="letra" v-model="letra" class="form-control">
                                <option>-</option>
                                <option v-for="letra in letras" :key="letra">{{ letra }}</option>
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-3 col-xs-3">
                            <label for="obs">Observações:</label><br>
                            <input v-model="obs" name="obs" class="form-control" type="text" size="30" >
                        </div>
                        <div class="col-lg-6 col-md-6 col-xs-6">
                            <label>Cancelar</label><br>
                            <a class="btn btn-danger btn-block" @click="clear(false)"><i class="fa fa-times" style="color: white"></i></a>
                        </div>
                        <div class="col-lg-6 col-md-6 col-xs-6">
                            <template v-if="toEdit">
                                <label>Editar</label><br>
                                <a class="btn btn-success btn-block" :disabled="!local" 
                                @click="editArquivo"><i class="fa fa-plus" style="color: white"></i></a>
                            </template>
                            <template v-else>
                                <label>Adicionar</label><br>
                                <a class="btn btn-success btn-block" :disabled="!local" 
                                @click="createArquivo"><i class="fa fa-plus" style="color: white"></i></a>
                            </template>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-footer"> 
            <div class="row bordaform" v-if="arquivos.length">
                <div class="col-sm-12">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="col-sm-1">#</th>
                                <th class="col-sm-1">Data</th>
                                <th class="col-sm-2">Local</th>
                                <th class="col-sm-1">N°/Letra</th>
                                <th class="col-sm-3">Obs</th>
                                <th class="col-sm-2">RG</th>
                                <th class="col-sm-2">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(arquivo, index) in arquivos" :key="index">
                                <td>{{ index + 1 }}</td>
                                <td>{{ arquivo.arquivo_data | date_br}}</td>
                                <td>{{ arquivo.local_atual }}</td>
                                <td>{{ arquivo.numero }}/{{ arquivo.letra }}</td>
                                <td>{{ arquivo.obs }}</td>
                                <td>{{ arquivo.rg }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="First group">
                                        <a v-if="canEdit" type="button"  @click="replaceArquivo(arquivo)" class="btn btn-success" style="color: white">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a v-if="canDelete" type="button"  @click="removeArquivo(arquivo.id_arquivo, index)" class="btn btn-danger" style="color: white">
                                            <i class="fa fa-trash"></i> 
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>  
             <div v-if="!arquivos.length && only">
                <h6>Não há registtros</h6>
            </div> 
        </div>
    </div>
</template>

<script>
    import mixin from '../../mixins.js'
    import {Datepicker} from '../Vuestrap/Datepicker'
    export default {
        mixins: [mixin],
        components: {Datepicker},
        props: {
            unique: {type: Boolean, default: false},
            idp: {type: String, default: ''},
            dproc: {type: String, default: ''},
            dref: {type: String, default: ''},
            dano: {type: String, default: ''},
        },
        data() {
            return {
                local: '',
                numero: '',
                letra: '',
                obs: '',
                opm: '',
                nome: '',
                toEdit: '',
                arquivos: [],
                only: false,
                rg: '',
                nome: '',
                opm: '',
                add: false,
                locais: ['Arquivo COGER','Arquivo Geral(PMPR)','Cautela (Saída)'],
                letras: ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','aa','ab','ac','ad','ae','af','ag','ah','ai','aj','ak','al','am','an','ao','ap','aq','ar','as','at','au','av','aw','ax','ay','az','ba','bb','bc','bd','be','bf','bg','bh','bi','bj','bk','bl','bm','bn','bo','bp','bq','br','bs','bt','bu','bv','bw','bx','by','bz','ca','cb','cc','cd','ce','cf','cg','ch','ci','cj','ck','cl','cm','cn','co','cp','cq','cr','cs','ct','cu','cv','cw','cx','cy','cz','da','db','dc','dd','de','df','dg','dh','di','dj','dk','dl','dm','dn','do','dp','dq','dr','ds','dt','du','dv','dw','dx','dy','dz','ea','eb','ec','ed','ee','ef','eg','eh','ei','ej','ek','el','em','en','eo','ep','eq','er','es','et','eu','ev','ew','ex','ey','ez','fa','fb','fc','fd','fe','ff','fg','fh','fi','fj','fk','fl','fm','fn','fo','fp','fq','fr','fs','ft','fu','fv','fw','fx','fy','fz','ga','gb','gc','gd','ge','gf','gg','gh','gi','gj','gk','gl','gm','gn','go','gp','gq','gr','gs','gt','gu','gv','gw','gx','gy','gz','ha','hb','hc','hd','he','hf','hg','hh','hi','hj','hk','hl','hm','hn','ho','hp','hq','hr','hs','ht','hu','hv','hw','hx','hy','hz','ia','ib','ic','id','ie','if','ig','ih','ii','ij','ik','il','im','in','io','ip','iq','ir','is','it','iu','iv','iw','ix','iy','iz','ja','jb','jc','jd','je','jf','jg','jh','ji','jj','jk','jl','jm','jn','jo','jp','jq','jr','js','jt','ju','jv','jw','jx','jy','jz','ka','kb','kc','kd','ke','kf','kg','kh','ki','kj','kk','kl','km','kn','ko','kp','kq','kr','ks','kt','ku','kv','kw','kx','ky','kz','la','lb','lc','ld','le','lf','lg','lh','li','lj','lk','ll','lm','ln','lo','lp','lq','lr','ls','lt','lu','lv','lw','lx','ly','lz','ma','mb','mc','md','me','mf','mg','mh','mi','mj','mk','ml','mm','mn','mo','mp','mq','mr','ms','mt','mu','mv','mw','mx','my','mz','na','nb','nc','nd','ne','nf','ng','nh','ni','nj','nk','nl','nm','nn','no','np','nq','nr','ns','nt','nu','nv','nw','nx','ny','nz','oa','ob','oc','od','oe','of','og','oh','oi','oj','ok','ol','om','on','oo','op','oq','or','os','ot','ou','ov','ow','ox','oy','oz','pa','pb','pc','pd','pe','pf','pg','ph','pi','pj','pk','pl','pm','pn','po','pp','pq','pr','ps','pt','pu','pv','pw','px','py','pz','qa','qb','qc','qd','qe','qf','qg','qh','qi','qj','qk','ql','qm','qn','qo','qp','qq','qr','qs','qt','qu','qv','qw','qx','qy','qz','ra','rb','rc','rd','re','rf','rg','rh','ri','rj','rk','rl','rm','rn','ro','rp','rq','rr','rs','rt','ru','rv','rw','rx','ry','rz','sa','sb','sc','sd','se','sf','sg','sh','si','sj','sk','sl','sm','sn','so','sp','sq','sr','ss','st','su','sv','sw','sx','sy','sz','ta','tb','tc','td','te','tf','tg','th','ti','tj','tk','tl','tm','tn','to','tp','tq','tr','ts','tt','tu','tv','tw','tx','ty','tz','ua','ub','uc','ud','ue','uf','ug','uh','ui','uj','uk','ul','um','un','uo','up','uq','ur','us','ut','uu','uv','uw','ux','uy','uz','va','vb','vc','vd','ve','vf','vg','vh','vi','vj','vk','vl','vm','vn','vo','vp','vq','vr','vs','vt','vu','vv','vw','vx','vy','vz','wa','wb','wc','wd','we','wf','wg','wh','wi','wj','wk','wl','wm','wn','wo','wp','wq','wr','ws','wt','wu','wv','ww','wx','wy','wz','xa','xb','xc','xd','xe','xf','xg','xh','xi','xj','xk','xl','xm','xn','xo','xp','xq','xr','xs','xt','xu','xv','xw','xx','xy','xz','ya','yb','yc','yd','ye','yf','yg','yh','yi','yj','yk','yl','ym','yn','yo','yp','yq','yr','ys','yt','yu','yv','yw','yx','yy','yz','za','zb','zc','zd','ze','zf','zg','zh','zi','zj','zk','zl','zm','zn','zo','zp','zq','zr','zs','zt','zu','zv','zw','zx','zy','zz']
            }
        },
        mounted(){
            this.verifyOnly
            this.listArquivo()
            this.rg = this.$root.dadoSession('rg')
            this.nome = this.$root.dadoSession('nome')
            this.opm = this.$root.dadoSession('cdopm')
        },
        computed:{
            today() {
                let today = new Date();
                let dd = today.getDate() > 10 ? String(today.getDate()) : '0'+today.getDate()
                let mm = today.getMonth() + 1 > 10 ? String(today.getMonth() + 1) : '0'+String(today.getMonth() + 1)//January is 0!
                let yyyy = today.getFullYear()

                today = yyyy + '-' + mm + '-' + dd;
                return today
            },
            verifyOnly(){     
                if(this.unique == true){
                    this.only = true
                }else{
                    this.only = false
                }      
            },
            canEdit(){
                return this.$root.hasPermission('editar-arquivamento')
            },
            canDelete(){
                return this.$root.hasPermission('apagar-arquivamento')
            },
        },
        methods: {
            listArquivo(){
                this.clear(true)
                let urlIndex = `${this.$root.baseUrl}api/arquivo/list/${this.dproc}/${this.idp}`;
                if(this.dproc && this.idp){
                    axios
                    .get(urlIndex)
                    .then((response) => {
                        this.arquivos = response.data
                        // console.log(response.data)
                    })
                    .then(this.clear)//limpa a busca
                    .catch(error => console.log(error));
                }
            },
            createArquivo(){
                let urlCreate = `${this.$root.baseUrl}api/arquivo/store`;

                let formArquivo = document.getElementById('formArquivo');
                let data = new FormData(formArquivo);
                
                axios.post( urlCreate,data)
                .then(this.listArquivo())
                .catch((error) => console.log(error));
            },
            replaceArquivo(arquivo){
                this.toEdit = arquivo.id_arquivo

                this.arquivo_data = arquivo.arquivo_data,
                this.local = arquivo.local_atual,
                this.numero = arquivo.numero,
                this.letra = arquivo.letra,
                this.obs = arquivo.obs,

                // this.titleSubstitute=" - Substituição do "+pm.situacao+" "+pm.nome
                this.add = true
            },
            editArquivo(){
                let urledit = `${this.$root.baseUrl}api/arquivo/edit/${this.toEdit}`;

                let formData = document.getElementById('formArquivo');
                let data = new FormData(formData);
                
                axios.post( urledit,data)
                .then(() => {
                    this.listArquivo()
                    this.clear(false)
                })
                .catch((error) => console.log(error));
            },
            removeArquivo(id, index){
                let urlDelete = `${this.$root.baseUrl}api/arquivo/destroy/${id}`;
                // console.log(urlDelete)
                axios
                .delete(urlDelete)
                .then(this.arquivos.splice(index,1))
                .then(this.clear(false))
                .catch(error => console.log(error));
            },
            clear(add){
                this.add = add
                this.local = '',
                this.numero = '',
                this.letra = '',
                this.obs = ''
                this.toEdit = ''
            },
        },
    }
</script>

<style scoped>

</style>
