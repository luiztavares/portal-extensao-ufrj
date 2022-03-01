<template>
  <q-page class="column bg-green q-pa-xl">
    <span class="col-1 text-h2">Lives da Extensão UFRJ</span>
    <q-tabs class="col-1">
      <q-tab>Ao vivo</q-tab>
      <q-tab>Próximas</q-tab>
      <q-tab>Passadas</q-tab>
    </q-tabs>
    <div class="col row q-pa-xl items-center">
      <div class="col" v-for="acao in acoes" :key="acao">
        <YoutubeCard v-bind:acao="acao" />
      </div>
    </div>
    <q-btn class="col-1" label="Veja todas as Lives"></q-btn>
  </q-page>
</template>

<script>
import { defineComponent } from "vue"
import YoutubeCard from "components/YoutubeCard.vue"

export default defineComponent({
  setup() {
    
  },

  components: {
    YoutubeCard
  },

  data: function () {
    return {
      slide: "style",
      acoes: [
        {
          titulo: "América Latina Póscolonial: estudos de caso.",
          coordenador: "CARLOS EDUARDO REBELLO DE MENDONCA",
          modalidade: "Curso",
          cor: "red",
          descricao:
            "Trata-se de curso onde a história política, social e econômica recente da América Latina será discutida a partir dos enfoques trazidos pela perspectiva dos estudos pós-coloniais e subalternistas, através da leitura de alguns clássicos e da literatura recente sobre alguns casos nacionais mais relevantes",
        },
        {
          titulo: "América Latina Póscolonial: estudos de caso.",
          coordenador: "CARLOS EDUARDO REBELLO DE MENDONCA",
          modalidade: "Evento",
          cor: "green",

          descricao:
            "Trata-se de curso onde a história política, social e econômica recente da América Latina será discutida a partir dos enfoques trazidos pela perspectiva dos estudos pós-coloniais e subalternistas, através da leitura de alguns clássicos e da literatura recente sobre alguns casos nacionais mais relevantes",
        },
        {
          titulo: "América Latina Póscolonial: estudos de caso.",
          coordenador: "CARLOS EDUARDO REBELLO DE MENDONCA",
          modalidade: "Projeto",
          cor: "blue",

          descricao:
            "Trata-se de curso onde a história política, social e econômica recente da América Latina será discutida a partir dos enfoques trazidos pela perspectiva dos estudos pós-coloniais e subalternistas, através da leitura de alguns clássicos e da literatura recente sobre alguns casos nacionais mais relevantes",
        },
      ],
    };
  },
})
</script>

<style scoped>

</style>
