<template>
  <q-page class="row bg-green q-pa-none">
      <div class="q-pa-md col">
        <p class="text-white text-h3">Cursos</p>
    <q-table          :pagination="pagination"

      :rows="cursos"
    />
  </div>
      <div class="q-pa-md col">
        <p class="text-white text-h3">Eventos</p>
    <q-table          :pagination="pagination"

      :rows="eventos"
    />
  </div>
      <div class="q-pa-md col">
        <p class="text-white text-h3">Projetos</p>
    <q-table          :pagination="pagination"

      :rows="projetos"
    />
  </div>
  </q-page>
</template>

<script>
import { defineComponent, ref } from "vue";
import json from "../../public/dados.json";

export default defineComponent({
  setup() {
    return {
    };
  },

  data: function () {
    return {
      pagination: {
        rowsPerPage: 30 // current rows per page being displayed
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
