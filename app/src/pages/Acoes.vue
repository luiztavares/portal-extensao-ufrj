<template>
  <q-page class=" bg-purple ">
    <q-tabs
      v-model="tab"
      dense
      class="text-white"
      active-color="yellow"
      align="justify"
      narrow-indicator
    >
      <q-tab name="Cursos" label="Cursos" />
      <q-tab name="Eventos" label="Eventos" />
      <q-tab name="Projetos" label="Projetos" />
      <q-tab name="Programas" label="Programas" />

    </q-tabs>

    <q-tab-panels v-model="tab" animated>
    <q-tab-panel name='Cursos' class="q-pa-xl col">
      <p class="text-h5">
        O Curso de Extensão é responsável por garantir uma formação livre em um determinado tema e é oferecido tanto para o público externo, quanto para a universidade. Um Curso pode ser presencial ou à distância, teórico ou prático e ter a duração de semanas ou meses, a depender de cada coordenação.
      </p>
      <q-table card-class=" text-white full-height" 
  card-style="padding: 22px; background-image: url('/images/cursos1'); background-size: cover; background-repeat: no-repeat;  " grid  :columns="columns.cursos" :pagination="pagination" :rows="cursos" />
    </q-tab-panel>
    <q-tab-panel name='Eventos' class="q-pa-xl col">
            <p class="text-h5">
Um Evento de Extensão é uma das formas de mostrar o resultado dos conhecimentos produzidos na Universidade, tendo como público alvo, normalmente, a própria comunidade da UFRJ. De caráter científico, artístico, esportivo, cultural ou multidisciplinar, podem ser organizados em formatos de Congressos, Seminários, Feiras, Festivais, etc., por docentes e discentes de determinada área.
      </p>
      <q-table card-class=" text-white full-height" 
  card-style="padding: 22px; background-image: url('/images/eventos3'); background-size: cover; background-repeat: no-repeat;  " grid  :columns="columns.eventos" :pagination="pagination" :rows="eventos" />
    </q-tab-panel>
    <q-tab-panel name='Projetos' class="q-pa-xl col">
            <p class="text-h5">
Os Projetos de Extensão são ações promovidas pela comunidade acadêmica, de caráter educativo, social, cultural, científico ou tecnológico, que promovam a interação dialógica a partir do trabalho com grupos vulneráveis e/ou territórios.
      </p>
     <q-table card-class=" text-white full-height" 
  card-style="padding: 22px; background-image: url('/images/projetos3'); background-size: cover; background-repeat: no-repeat;  " grid  :columns="columns.projetos"  :pagination="pagination" :rows="projetos" row-key="nome">
             <template v-slot:body-cell-nome="props">
        <q-td :props="props">
          
          <div>
            <q-btn :to="'/'+ '/'"  :label="props.value" />
          </div>
          <div class="my-table-details">
            {{ props.row.details }}
          </div>
        </q-td>
      </template>
       </q-table>
    </q-tab-panel>
        <q-tab-panel name='Programas' class="q-pa-xl col">
            <p class="text-h5">
Um Programa de Extensão é uma coleção de ações com objetivos em comum.
      </p>
     <q-table card-class=" text-black full-height" 
  card-style="padding: 22px; background-image: url('/images/eventos1'); background-size: cover; background-repeat: no-repeat;  " grid :columns='columns.programas'  :pagination="pagination" :rows="programas" />
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
      columns : {
        cursos:[
          { name: 'Nome', label: 'Nome', field: 'nome'},
          { name: 'Coordenador', label: 'coordenador', field: 'coordenador'},
          { name: 'Unidade', label: 'Unidade', field: 'unidade'},
          { name: 'Modalidade', label: 'Modalidade', field: 'modalidade'},
          { name: 'Classificação curso', label: 'Classificação curso', field: 'classificação curso'},
          { name: 'Programa de formação', label: 'Programa de formação', field: 'programa de formação'},
        ],
         eventos:[
          { name: 'Nome', label: 'Nome', field: 'nome'},
          { name: 'Coordenador', label: 'coordenador', field: 'coordenador'},
          { name: 'Unidade', label: 'Unidade', field: 'unidade'},
          { name: 'Área temática', label: 'Área temática', field: 'área temática primária'},
          { name: 'Duração em dias', label: 'Duração em dias', field: 'duração em dias'},
          { name: 'Carga horária total', label: 'Carga horária total', field: 'carga horária total'},
        ],
         projetos:[
          { name: 'Nome', label: 'Nome', field: 'nome'},
          { name: 'Coordenador', label: 'coordenador', field: 'coordenador'},
          { name: 'Unidade', label: 'Unidade', field: 'unidade'},
          { name: 'Área temática', label: 'Área temática', field: 'área temática primária'},
        ],
         programas:[
          { name: 'Nome', label: 'Nome', field: 'nome'},
          { name: 'Coordenador', label: 'coordenador', field: 'coordenador'},
          { name: 'Unidade', label: 'Unidade', field: 'unidade'},
          { name: 'Área temática', label: 'Área temática', field: 'área temática primária'},
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

.bgcurso{
  background-image: url('/images/cursos1');
  background-color: red;
}
</style>
