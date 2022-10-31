<template>
  <div class="float-right q-mt-md">
    <span class="q-mr-md text-h6" style="color: purple"
      >Compartilhe nas redes:</span
    >

    <q-btn
      class="q-ml-md"
      round
      style="color: white; background-color: #25d366"
      icon="fab fa-whatsapp"
      target="_blank"
      :href="'https://api.whatsapp.com/send?text=' + url"
    />
    <q-btn
      class="q-ml-md"
      round
      style="color: white; background-color: #1da1f2"
      icon="fab fa-twitter"
      target="_blank"
      :href="'http://twitter.com/share?url=' + url"
    />
    <!-- <q-btn
      class="q-ml-md"
      round
      style="color: white; background-color: PURPLE"
      icon="fab fa-instagram"

    /> -->
    <q-btn
      class="q-ml-md"
      round
      style="color: white; background-color: #0088cc"
      icon="fab fa-telegram"
      target="_blank"
      :href="'https://telegram.me/share/url?url=' + url"
    />
    <q-btn
      class="q-ml-md"
      round
      style="color: white; background-color: #1877f2"
      icon="fab fa-facebook"
      target="_blank"
      :href="'https://www.facebook.com/dialog/share?href=' + url +'&app_id=757478061461447'"
    />
  </div>
</template>

<script>
import { createDOMCompilerError } from "@vue/compiler-dom";
import { defineComponent } from "vue";

export default defineComponent({
  setup: function () {
    url: "";
  },
  created() {
    this.url = encodeURIComponent(window.location.href);
  },
});
</script>

<style>
</style>
