<template>      
    <div class="col-12 col-lg-8">
      <div class="card bg-white border-gray-300 p-4 mb-4">
        <div class="d-flex justify-content-between align-items-center mb-2">
          <span class="font-small">
              <span class="fw-bold">Neil Sims</span>
            <span class="ms-2">March 26, 19:25</span>
          </span>
          <div class="d-none d-sm-block">
            <button class="btn btn-link text-dark" aria-label="phone" data-toggle="tooltip" data-placement="top" title="Sent from the phone " data-original-title="Sent from the phone">
              <span class="fas fa-mobile-alt"></span>
            </button>
          </div>
        </div>
        <p class="m-0">Hi Chris! Thanks a lot for this very useful template. Saved me a lot of time and searches on the internet.</p>
      </div>

      <div class="card bg-primary text-white border-gray-300 p-4 ms-md-5 ms-lg-6 mb-4">
        <div class="d-flex justify-content-between align-items-center mb-2">
          <span class="font-small">
            <span class="fw-bold">Your Answer</span>
            <span class="ms-2">March 26, 19:25</span>
          </span>
          <div class="d-none d-sm-block">
            <button class="btn btn-link text-white" aria-label="phone" data-toggle="tooltip" data-placement="top" title="Sent from the phone " data-original-title="Sent from the phone">
              <span class="fas fa-mobile-alt"></span>
            </button>
          </div>
        </div>
        <p class="m-0">Hi Neil, thanks for sharing your thoughts regarding Spaces. Hi Neil, thanks for sharing your thoughts regarding Spaces.</p>
      </div>

      <div class="card bg-white border-gray-300 p-4 mb-5">
        <div class="d-flex justify-content-between align-items-center mb-2">
          <span class="font-small">
            <span class="fw-bold">Neil Sims</span>
            <span class="ms-2">March 26, 19:25</span>
          </span>
          <div class="d-none d-sm-block">
            <button class="btn btn-link text-dark" aria-label="phone" data-toggle="tooltip" data-placement="top" title="Sent from the phone " data-original-title="Sent from the phone">
              <span class="fas fa-mobile-alt"></span>
            </button>
          </div>
        </div>
        <p class="m-0">Hi Chris! Thanks a lot for this very useful template. Saved me a lot of time and searches on the internet.</p>
      </div>

      <form action="#" class="mt-4">
        <textarea class="form-control border border-gray-300-gray mb-4" id="message" placeholder="Your Message" rows="6" maxlength="1000" required=""></textarea>
        <div class="d-flex justify-content-between align-items-center mt-3">
          <div>
            <FontAwesomeIcon icon="fa-brands fa-twitter" />
            <button type="submit" class="btn btn-dark">Enviar</button>
          </div>
        </div>
      </form>

    </div>
</template>

<script>
import { useToast } from "vue-toastification";

export default {
    data() {
         return {
            menu: "status",
            loading: false,
            toast: useToast(),
         }
  },
  methods: {
    updateMenu(value) {
      this.menu = value;
    }
  }
}
</script>