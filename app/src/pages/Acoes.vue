<template>
  <q-page class=" bg-green q-pa-none">
    <q-tabs
      v-model="tab"
      dense
      class="text-black"
      active-color="primary"
      indicator-color="primary"
      align="justify"
      narrow-indicator
    >
      <q-tab name="Cursos" label="Cursos" />
      <q-tab name="Eventos" label="Eventos" />
      <q-tab name="Projetos" label="Projetos" />
    </q-tabs>

    <q-tab-panels v-model="tab" animated>
    <q-tab-panel name='Cursos' class="q-pa-md col">
      <p class="text-white text-h3">Cursos</p>
      <p class="text-h5">
        O Curso de Extensão é responsável por garantir uma formação livre em um determinado tema e é oferecido tanto para o público externo, quanto para a universidade. Um Curso pode ser presencial ou à distância, teórico ou prático e ter a duração de semanas ou meses, a depender de cada coordenação.
      </p>
      <q-table :pagination="pagination" :rows="cursos" />
    </q-tab-panel>
    <q-tab-panel name='Eventos' class="q-pa-md col">
      <p class="text-white text-h3">Eventos</p>
            <p class="text-h5">
Um Evento de Extensão é uma das formas de mostrar o resultado dos conhecimentos produzidos na Universidade, tendo como público alvo, normalmente, a própria comunidade da UFRJ. De caráter científico, artístico, esportivo, cultural ou multidisciplinar, podem ser organizados em formatos de Congressos, Seminários, Feiras, Festivais, etc., por docentes e discentes de determinada área.
      </p>
      <q-table :pagination="pagination" :rows="eventos" />
    </q-tab-panel>
    <q-tab-panel name='Projetos' class="q-pa-md col">
      <p class="text-white text-h3">Projetos</p>
            <p class="text-h5">
Os Projetos de Extensão são ações promovidas pela comunidade acadêmica, de caráter educativo, social, cultural, científico ou tecnológico, que promovam a interação dialógica a partir do trabalho com grupos vulneráveis e/ou territórios.
      </p>
      <q-table :pagination="pagination" :rows="projetos" />
    </q-tab-panel>
    </q-tab-panels>
  </q-page>
</template>

<script>
import { defineComponent, ref } from "vue";
import json from "../../public/dados.json";

export default defineComponent({
  setup() {
    return {};
  },

  data: function () {
    return {
      tab: 'Cursos',
      pagination: {
        rowsPerPage: 30, // current rows per page being displayed
      },
      cursos: json["SegmentacaoAcaoExtensaoCurso"],
      eventos: json["AcaoExtensaoEvento"],
      programas: json["AcaoExtensaoAcaoExtensaoProgram"],
      projetos: json["AcaoExtensaoProjeto"],
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
