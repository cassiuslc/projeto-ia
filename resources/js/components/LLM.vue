<template>      
  <div class="col-12 col-lg-8">
    <!-- Iterar sobre as mensagens -->
    <div v-if="!loading && data">
      <div v-for="(mensagem, index) in data" :key="index">
        <!-- Verificar se o ator é 'assistant' -->
        <div v-if="mensagem.ator === 'assistant'" class="card bg-white border-gray-300 p-4 mb-4">
          <div class="d-flex justify-content-between align-items-center mb-2">
            <span class="font-small">
              <span class="fw-bold">Assistente</span>
              <span class="ms-2">{{ formatarData(mensagem.timestamp) }}</span>
            </span>
            <div class="d-none d-sm-block">
              <button class="btn btn-link text-dark" aria-label="phone" data-toggle="tooltip" data-placement="top">
                <span class="fas fa-mobile-alt"></span>
              </button>
            </div>
          </div>
          <p class="m-0">{{ mensagem.mensagem }}</p>
        </div>
        
        <!-- Verificar se o ator é 'user' -->
        <div v-else class="card bg-primary text-white border-gray-300 p-4 ms-md-5 ms-lg-6 mb-4">
          <div class="d-flex justify-content-between align-items-center mb-2">
            <span class="font-small">
              <span class="fw-bold">Você</span>
              <span class="ms-2">{{ formatarData(mensagem.timestamp) }}</span>
            </span>
            <div class="d-none d-sm-block">
              <button class="btn btn-link text-white" aria-label="phone" data-toggle="tooltip" data-placement="top">
                <span class="fas fa-mobile-alt"></span>
              </button>
            </div>
          </div>
          <p class="m-0">{{ mensagem.mensagem }}</p>
        </div>
    </div>
  </div>
  <div v-else-if="!loading && !data">
  </div>
  <div v-else>
    <div class="card bg-primary text-white border-gray-300 p-4 ms-md-5 ms-lg-6 mb-4">
          <div class="d-flex justify-content-between align-items-center mb-2">
            <span class="font-small">
              <span class="fw-bold"> <Skeleton class="vf-col-12 px-xl-0" width="30rem" height="1rem"></Skeleton></span>
              <span class="ms-2"> <Skeleton class="vf-col-12 px-xl-0" width="30rem" height="1rem"></Skeleton></span>
            </span>
            <div class="d-none d-sm-block">
              <button class="btn btn-link text-white" aria-label="phone" data-toggle="tooltip" data-placement="top">
                <span class="fas fa-mobile-alt"></span>
              </button>
            </div>
          </div>
          <p class="m-0"> <Skeleton class="vf-col-12 px-xl-0" width="30rem" height="3rem"></Skeleton></p>
        </div>
  </div>
        <textarea v-model="msg" class="form-control border border-gray-300-gray mb-4" id="message" placeholder="Sua menssagem" :disabled="submit" rows="6" maxlength="1000" required=""></textarea>
        <div class="d-flex justify-content-between align-items-center mt-3">
          <div>
            <FontAwesomeIcon icon="fa-brands fa-twitter" />
            <button type="submit" v-if="submit === false" @click="onSubmit" :disabled="submit" class="btn btn-dark">Enviar</button>
            <Skeleton v-else class="vf-col-12 px-xl-0" width="10rem" height="3rem"></Skeleton>
          </div>
        </div>
  </div>
</template>

<script>
import { useToast } from "vue-toastification";

export default {
    data() {
         return {
            data: [],
            loading: true,
            falha: false,
            submit: false,
            msg_erro_show: "",
            toast: useToast(),
         }
  },
  mounted(){
    this.getDataHistorico();
  },
  methods: {
    async getDataHistorico() {
            try {
                this.loading = true;
                const response = await axios.get(`http://localhost/api/bot/historico`);
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
    async onSubmit() {
                this.submit = true;
                try {
                    const data = {
                        "ator": "user",
                        "mensagem": this.msg,
                    };
                    // Chamar a API
                    const response = await axios.post(`http://localhost/api/bot/inserir`, data);
                    this.toast.info(response.data.message);
                    this.getDataHistorico();
                    this.msg="";
                    this.submit = false;
                    } catch (error) {
                        this.falha = true;
                        this.submit = false;
                    if (error.response.data && error.response.data.error.mensagem) {
                      this.toast.info("[Erro " + error.response.status + "]: " + error.response.data.error.mensagem[0] + ".");
                    }else if (error.response.data && error.response.data.error) {
                      this.toast.info("[Erro " + error.response.status + "]: " + error.response.data.error + ".");
                    } else {
                      this.toast.info("Erro [" + error.response.status + "]");
                    }
                    console.error('Erro ao buscar dados da API:', error);
    }
    },
    formatarData(timestamp) {
      // Lógica para formatar o timestamp para exibição
      // Aqui você pode usar bibliotecas como o moment.js
      // Para este exemplo simples, vamos formatar para 'DD/MM/YYYY HH:mm:ss'
      const data = new Date(timestamp * 1000);
      const dia = data.getDate().toString().padStart(2, '0');
      const mes = (data.getMonth() + 1).toString().padStart(2, '0');
      const ano = data.getFullYear();
      const horas = data.getHours().toString().padStart(2, '0');
      const minutos = data.getMinutes().toString().padStart(2, '0');
      const segundos = data.getSeconds().toString().padStart(2, '0');
      
      return `${dia}/${mes}/${ano} ${horas}:${minutos}:${segundos}`;
    }
  }
}
</script>