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
                        <h6 class="h6 fw-bold mb-1">mistral-7b-openorca.Q4_0</h6>
                        <div class="small mt-2">
                            <span class="fa-solid fa-minus text-success me-1"></span>
                            <a href="https://huggingface.co/Open-Orca/Mistral-7B-OpenOrca">OpenOrca - Mistral - 7B - 8k</a>
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
                        <h6 class="h6 fw-bold mb-1"><a href="http://localhost:4891/docs">http://localhost:4891</a></h6>
                        <div class="small mt-2">
                            <span class="fa-solid fa-circle-check text-success me-1"></span>
                            <span class="text-success fw-bold">Online</span>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="card border-gray-300">
            <div class="card-body d-block d-md-flex align-items-center">
            <table class="table table-hover">
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
                                Jackson <span class="badge badge-primary ml-2">Pro</span>
                            </div>
                        </td>
                        <td>Larry</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>
                            <div class="d-flex align-items-center">
                                Jacob <span class="badge badge-secondary ml-2">Mid</span>
                            </div>
                        </td>
                        <td>Thornton</td>
                    </tr>
                </tbody>
            </table>
        </div>
        </div>
        </div>
        {{  data }}
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
        async getDataStatus() {
            try {
                this.loading = true;
                const response = await axios.get(`http://localhost:4891/v1/health/`);
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
