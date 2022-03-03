<template>
  <q-page class="column bg-green q-pa-none">
    <span class="col-1 text-h2 q-my-lg q-ml-xl">Lives da Extensão UFRJ</span>
    <q-tabs class="col-1 bg-green-7" v-model="panel">
      <q-tab name="ao vivo">Ao vivo</q-tab>
      <q-tab name="proximas">Próximas</q-tab>
      <q-tab name="passadas">Passadas</q-tab>
    </q-tabs>

    <q-tab-panels v-model="panel" animated class="shadow-2 q-mb-xl">
      <q-tab-panel name="ao vivo">
        <div class="col row q-pa-none lives">
          <div class="card_wrapper" v-for="acao in acoes.ao_vivo" :key="acao">
            <YoutubeCard v-bind:acao="acao" />
          </div>
        </div>
      </q-tab-panel>

      <q-tab-panel name="proximas">
        <div class="col row q-pa-none lives">
          <div class="card_wrapper" v-for="acao in acoes.proximas" :key="acao">
            <YoutubeCard v-bind:acao="acao" />
          </div>
        </div>
      </q-tab-panel>

      <q-tab-panel name="passadas">
        <div class="col row q-pa-none lives">
          <div class="card_wrapper" v-for="acao in acoes.passadas" :key="acao">
            <YoutubeCard v-bind:acao="acao" />
          </div>
        </div>
      </q-tab-panel>
    </q-tab-panels>
  </q-page>
</template>

<script>
import { defineComponent, ref } from "vue";
import YoutubeCard from "components/YoutubeCard.vue";

export default defineComponent({
  setup() {
    return {
      panel: ref("ao vivo"),
    };
  },

  components: {
    YoutubeCard
  },

  data: function () {
    return {
      slide: "style",
      acoes: {
        ao_vivo: [
          {
            titulo: "LIVE AO VIVO",
            coordenador: "CARLOS EDUARDO REBELLO DE MENDONCA",
            modalidade: "Curso",
            cor: "red",
            descricao:
              "Trata-se de curso onde a história política, social e econômica recente da América Latina será discutida a partir dos enfoques trazidos pela perspectiva dos estudos pós-coloniais e subalternistas, através da leitura de alguns clássicos e da literatura recente sobre alguns casos nacionais mais relevantes",
          },
          {
            titulo: "LIVE AO VIVO 2",
            coordenador: "CARLOS EDUARDO REBELLO DE MENDONCA",
            modalidade: "Evento",
            cor: "green",

            descricao:
              "Trata-se de curso onde a história política, social e econômica recente da América Latina será discutida a partir dos enfoques trazidos pela perspectiva dos estudos pós-coloniais e subalternistas, através da leitura de alguns clássicos e da literatura recente sobre alguns casos nacionais mais relevantes",
          },
          {
            titulo: "LIVE AO VIVO 3",
            coordenador: "CARLOS EDUARDO REBELLO DE MENDONCA",
            modalidade: "Evento",
            cor: "green",

            descricao:
              "Trata-se de curso onde a história política, social e econômica recente da América Latina será discutida a partir dos enfoques trazidos pela perspectiva dos estudos pós-coloniais e subalternistas, através da leitura de alguns clássicos e da literatura recente sobre alguns casos nacionais mais relevantes",
          }
        ],
        proximas: [
          {
            titulo: "Live agendada",
            coordenador: "CARLOS EDUARDO REBELLO DE MENDONCA",
            modalidade: "Curso",
            cor: "red",
            descricao:
              "Trata-se de curso onde a história política, social e econômica recente da América Latina será discutida a partir dos enfoques trazidos pela perspectiva dos estudos pós-coloniais e subalternistas, através da leitura de alguns clássicos e da literatura recente sobre alguns casos nacionais mais relevantes",
          }
        ],
        passadas: [
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
          {
            titulo: "América Latina Póscolonial: estudos de caso.",
            coordenador: "CARLOS EDUARDO REBELLO DE MENDONCA",
            modalidade: "Projeto",
            cor: "blue",

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
          {
            titulo: "América Latina Póscolonial: estudos de caso.",
            coordenador: "CARLOS EDUARDO REBELLO DE MENDONCA",
            modalidade: "Projeto",
            cor: "blue",

            descricao:
              "Trata-se de curso onde a história política, social e econômica recente da América Latina será discutida a partir dos enfoques trazidos pela perspectiva dos estudos pós-coloniais e subalternistas, através da leitura de alguns clássicos e da literatura recente sobre alguns casos nacionais mais relevantes",
          },
        ],
      },
    };
  },
});
</script>

<style scoped>
.card_wrapper {
  margin: 20px;
  flex-grow: 1;
  padding-left: auto;
}

.q-card {
  margin: auto;
}

.lives {
  align-items: center;
  margin-left: auto;
  margin-right: auto;
  display: flex;
  flex-basis: auto;
  max-width: 1600px;
}
</style>
