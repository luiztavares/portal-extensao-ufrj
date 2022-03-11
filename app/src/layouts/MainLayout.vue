<template>
  <q-layout view="lHh Lpr lFf">
    <q-header elevated>
      <q-toolbar class="q-ma-md">
        <q-toolbar-title @click="this.$router.push('/')"> PORTAL Extensão UFRJ </q-toolbar-title>
        <q-btn flat label="Destaques" @click="scrollToAnchorPoint('destaque')"> </q-btn>
        <q-btn flat label="Vagas"> </q-btn>
        <q-btn flat label="Lives" v-on:click="this.$router.push('/lives')"> </q-btn>
        <q-btn flat label="Informações"> </q-btn>
        <q-btn flat label="Notícias"> </q-btn>
      </q-toolbar>
    </q-header>

    <q-page-container>
      <router-view />
    </q-page-container>
          <q-footer elevated class = 'q-pa-md'>
            <p class="text-h6 text-center">
 Este Portal tem como objetivo informar aos estudantes, docentes, técnicos administrativos e comunidade externa das ações e serviços disponíveis e promovidos pela Pró-Reitoria de Extensão (PR-5) da Universidade Federal do Rio de Janeiro.
            </p>
      </q-footer>
  </q-layout>
</template>

<script>
import { defineComponent, ref } from "vue";

export default defineComponent({
  name: "MainLayout",
  data: function () {
    return { search: "" };
  },
  components: {},
  methods:{
        scrollToAnchorPoint(refName) {
            const el = this.$refs[refName]
            el.scrollIntoView({ behavior: 'smooth'})
        }
  },

  setup() {},
});
</script>
