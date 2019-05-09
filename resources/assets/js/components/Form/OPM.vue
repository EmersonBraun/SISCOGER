<template>
    <div>
        <select name="cdopm" v-model="cdopm" class="form-control">
            <option value="">Todas as OPM</option>
            <optgroup label="CG">
                <option value="0">CG (sede)</option>
                <option value="001">CG/GAB</option>
                <option value="001013">AG/CCS</option>
                <option value="002">CG/CJ</option>
                <option value="006">CM</option>
            </optgroup>
            <optgroup label="SUBCG">
                <option value="010">SUBCG (sede)</option>
                <option value="020">COGER</option>
                <option value="030">BPRV</option>
                <option value="031">BPAMBFV</option>
                <option value="036">BPEC</option>
                <option value="037">BOPE</option>
                <option value="038">COPOM</option>
                <option value="039">BPM OA</option>
                <option value="040">COORTERRA</option>
            </optgroup>
            <optgroup label="EM">
                <option value="1">EM (sede)</option>
                <option value="101">PM1</option>
                <option value="102">PM2</option>
                <option value="103">PM3</option>
                <option value="104">PM4</option>
                <option value="105">PM5</option>
                <option value="106">PM6</option>
                <option value="110">DP</option>
                <option value="11000009">DP/SESP</option>
                <option value="111">APMG</option>
                <option value="11105403">APMG/ESO</option>
                <option value="11105404">APMG/1ESFAEP</option>
                <option value="11105405">APMG/2ESFAEP</option>
                <option value="11108">2COLEGIO/PMPR</option>
                <option value="112">DAL</option>
                <option value="113">DF</option>
                <option value="114">DDTQ</option>
                <option value="115">DS</option>
                <option value="11502">HPM</option>
            </optgroup>
            <optgroup label="1CRPM">
                <option value="2">1CRPM (sede)</option>
                <option value="212">12BPM</option>
                <option value="213">13BPM</option>
                <option value="220">RPMON</option>
                <option value="221">CIPG</option>
                <option value="223">20BPM</option>
                <option value="225">BPTRAN</option>
                <option value="233">23BPM</option>
            </optgroup>
            <optgroup label="2CRPM">
                <option value="3">2CRPM (sede)</option>
                <option value="302">2BPM</option>
                <option value="305">5BPM</option>
                <option value="306">6CIPM</option>
                <option value="307">7CIPM</option>
                <option value="310">10BPM</option>
                <option value="315">15BPM</option>
                <option value="318">18BPM</option>
                <option value="335">4CIPM</option>
            </optgroup>
            <optgroup label="3CRPM">
                <option value="4">3CRPM (sede)</option>
                <option value="404">4BPM</option>
                <option value="407">7BPM</option>
                <option value="408">8BPM</option>
                <option value="411">11BPM</option>
                <option value="438">5CIPM</option>
                <option value="439">9CIPM</option>
                <option value="440">25BPM</option>
                <option value="443">3CIPM</option>
            </optgroup>
            <optgroup label="4CRPM">
                <option value="5">4CRPM (sede)</option>
                <option value="501">1BPM</option>
                <option value="516">16BPM</option>
                <option value="526">26BPM</option>
                <option value="527">27BPM</option>
                <option value="532">1CIPM</option>
                <option value="535">8CIPM</option>
                <option value="545">28BPM</option>
            </optgroup>
            <optgroup label="5CRPM">
                <option value="6">5CRPM (sede)</option>
                <option value="603">3BPM</option>
                <option value="606">6BPM</option>
                <option value="614">14BPM</option>
                <option value="619">19BPM</option>
                <option value="621">21BPM</option>
                <option value="624">BPFRON</option>
            </optgroup>
            <optgroup label="6CRPM">
                <option value="7">6CRPM (sede)</option>
                <option value="701">OPVMATINHOS</option>
                <option value="702">OPVPONTAL</option>
                <option value="703">OPVGUARA</option>
                <option value="705">BPGD</option>
                <option value="709">9BPM</option>
                <option value="717">17BPM</option>
                <option value="722">22BPM</option>
            </optgroup>
            <optgroup label="CCB">
                <option value="9">CCB (sede)</option>
                <option value="90000008">GOST</option>
                <option value="901">1GB</option>
                <option value="902">2GB</option>
                <option value="903">3GB</option>
                <option value="904">4GB</option>
                <option value="905">5GB</option>
                <option value="906">6GB</option>
                <option value="907">7GB</option>
                <option value="908">8GB</option>
                <option value="909">9GB</option>
                <option value="921">1SGBI</option>
                <option value="922">2SGBI</option>
                <option value="926">6SGBI</option>
            </optgroup>
        </select>
    </div>
</template>

<script>
    export default {
        props: ['cdopm'],
        data(){
            return {
                opm: this.cdopm
            }
        }
    }
</script>

<style scoped>

</style>