<template>
<div class="container">
  <div class="row pt-5 pt-md-0">
    <div class="col-12 col-lg-4 mb-3 mb-lg-0">
      <div class="card border-gray-300 p-2">
        <div class="card-header bg-white border-0 text-center d-flex flex-row flex-lg-column align-items-center justify-content-center px-1 px-lg-4">
          <span class="h5 my-0 my-lg-3 me-3 me-lg-0">Projeto ChatBot - Fucapi!</span>
          <a href="#" class="btn btn-gray-300 btn-xs">
            <span class="me-2">
              <span class="fa-solid fa-rotate-right"></span>
            </span>Reiniciar Interação</a>
        </div>
        <div class="card-body p-2 d-none d-lg-block">
          <div class="list-group dashboard-menu list-group-sm">
            <a class="d-flex list-group-item border-0 list-group-item-action" @click="updateMenu('doc')"  :class="{ active: menu === 'doc' }">Documentação <span class="icon icon-xs ms-auto">
                <span class="fas fa-chevron-right"></span>
              </span>
            </a>
            <a class="d-flex list-group-item border-0 list-group-item-action" @click="updateMenu('status')" :class="{ active: menu === 'status' }">
              Status API 
              <span class="icon icon-xs ms-auto">
                <span class="fas fa-chevron-right"></span>
              </span>
            </a>
            <a class="d-flex list-group-item border-0 list-group-item-action" @click="updateMenu('chatbot')" :class="{ active: menu === 'chatbot' }" >ChatBot <span class="icon icon-xs ms-auto">
                <span class="fas fa-chevron-right"></span>
              </span>
            </a>
          </div>
        </div>
      </div>
    </div>

    <statusbot v-if="menu === 'status'"></statusbot>
    <docbot v-else-if="menu === 'doc'"></docbot>
    <llmbot v-else-if="menu === 'chatbot'"></llmbot>
    
  </div>
</div>

</template>

<script>
import { useToast } from "vue-toastification";
import StatusBot from './Status.vue';
import DocBot from './DocBot.vue';
import LLMbot from './LLM.vue';

export default {
    data() {
         return {
            menu: "status",
            loading: false,
            toast: useToast(),
         }
  },
  components: {
    statusbot: StatusBot,
    docbot: DocBot,
    llmbot: LLMbot
  },
  methods: {
    updateMenu(value) {
      this.menu = value;
    }
  }
}
</script>
