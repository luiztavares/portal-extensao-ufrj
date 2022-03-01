<template>
  <q-layout view="lHh Lpr lFf">
    <q-header elevated>
      <q-toolbar class="q-ma-md">
        <q-toolbar-title> PORTAL Extensão UFRJ </q-toolbar-title>
        <q-search v-model="search"></q-search>
        <q-btn flat label="Destaques"> </q-btn>
        <q-btn flat label="Vagas"> </q-btn>
        <q-btn flat label="Lives" v-on:click="this.$router.push('/lives')"> </q-btn>
        <q-btn flat label="Informações"> </q-btn>
        <q-btn flat label="Notícias"> </q-btn>
      </q-toolbar>
    </q-header>

    <q-page-container>
      <router-view />
    </q-page-container>
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

  setup() {},
});
</script>
