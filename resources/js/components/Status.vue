<template>      
        <div class="col-12 col-lg-8">
            <div class="row">
                <div class="col-12 col-sm-6 mb-4">
                    <div class="card border-gray-300">
                    <div class="card-body d-block d-md-flex align-items-center">
                        <div class="icon icon-shape icon-md icon-shape-primary rounded-circle me-3 mb-4 mb-md-0">
                        <span class="fa-brands fa-docker"></span>
                        </div>
                        <div>
                        <span class="d-block h6 fw-normal">Detalhamento do Modelo</span>
                        <h6 v-if="!loading" class="h6 fw-bold mb-1">
                            <small v-if="data === true">Nous-Hermes-2-Mistral-7B-DPO</small>
                            <small class="text-danger" v-else>Sem conexão com modelo</small>
                        </h6>
                        <h6 v-else class="h6 fw-bold mb-1"><Skeleton class="vf-col-12 px-xl-0" width="10rem" height="1rem"></Skeleton></h6>
                        <div v-if="!loading" class="small mt-2">
                            
                            <span v-if="data === true" class="fa-solid fa-minus text-success me-1"></span>
                            <a v-if="data === true" href="https://huggingface.co/NousResearch">NousResearch</a>
                            <small class="text-danger"v-else>Falha ao obter modelo</small>
                        </div>
                        <div v-else class="small mt-2">
                            <Skeleton class="vf-col-12 px-xl-0" width="10rem" height="1rem"></Skeleton>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 mb-4">
                    <div class="card border-gray-300">
                    <div class="card-body d-block d-md-flex align-items-center">
                        <div class="icon icon-shape icon-md icon-shape-primary rounded-circle me-3 mb-4 mb-md-0">
                        <span class="fa-solid fa-server"></span>
                        </div>
                        <div>
                        <span class="d-block h6 fw-normal">Status API</span>
                        <h6 v-if="!loading" class="h6 fw-bold mb-1">
                            <a :class="{ 'text-danger': data === false }" href="http://localhost:4891/docs">http://localhost:4891</a>
                        </h6>
                        <h6 v-else class="h6 fw-bold mb-1"><Skeleton class="vf-col-12 px-xl-0" width="10rem" height="1rem"></Skeleton></h6>
                        <div v-if="!loading" class="small mt-2">
                            <st v-if="data === true">
                                <span class="fa-solid fa-circle-check text-success me-1"></span>
                                <span class="text-success fw-bold">Online</span>
                            </st>
                            <st v-else>
                                <span class="fa-solid fa-circle-down text-danger me-1"></span>
                                <span class="text-danger fw-bold">Offline</span>
                            </st>
                        </div>
                        <div v-else class="small mt-2">
                            <Skeleton class="vf-col-12 px-xl-0" width="10rem" height="1rem"></Skeleton>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="card border-gray-300">
            <div class="card-body d-block d-md-flex align-items-center">
            <table v-if="!loading" class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Resposta</th>
                        <th scope="col">Data da Busca</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>
                            <div class="d-flex align-items-center">
                                {{ data }}
                            </div>
                        </td>
                        <td>{{ now() }}</td>
                    </tr>
                </tbody>
            </table>
            <div v-else>
                <Skeleton class="vf-col-12 px-xl-0" width="40rem" height="10rem"></Skeleton>
            </div>
        </div>
        </div>
        </div>
</template>
<script>
import { useToast } from "vue-toastification";

export default {
    data() {
        return {
        toast: useToast(),
        loading: true,
        data: [],
        }
    },
    mounted(){
        this.getDataStatus();
    },
    methods: {
        now() {
            const today = new Date();
            let dd = today.getDate();
            let mm = today.getMonth() + 1; // Adiciona 1 ao mês, pois Janeiro é 0
            const yyyy = today.getFullYear();

            // Adiciona um zero na frente, se o dia ou mês for menor que 10
            if (dd < 10) {
            dd = '0' + dd;
            }
            if (mm < 10) {
            mm = '0' + mm;
            }

            return dd + '/' + mm + '/' + yyyy;
        },
        async getDataStatus() {
            try {
                this.loading = true;
                const response = await axios.get(`http://localhost/api/bot/check`);
                this.data = response.data;
                this.loading = false;
                return this.data;
            } catch (error) {
                this.loading = false;
                if (error.response.data && error.response.data.error) {
                    this.msg_erro_show = "[Erro " + error.response.status + "]: " + error.response.data.error + ".";
                } else {
                    this.msg_erro_show = "Erro desconhecido na solicitação [" + error.response.status + "]";
                }
                console.error('Erro ao buscar dados da API:', error);
            }
        },
    }
}
</script>
