<template>
  <q-page class="bg-white q-pa-xs-sm q-pa-md-xl row">
    <div class="" v-if="$q.screen.lt.sm">
      <q-toolbar>
        <q-btn
          fab
          label="Filtros"
          color="primary"
          @click="drawerLeft = !drawerLeft"
          icon="filter_alt"
        />
      </q-toolbar>

      <q-drawer
        v-model="drawerLeft"
        show-if-above
        :breakpoint="700"
        elevated
        class=""
      >
        <q-list bordered round padding class="">
          <div
            v-if="$q.screen.gt.sm || $q.screen.sm"
            class="text-h5 q-px-sm text-bold full-width"
            style="text-shadow: 3px 3px 6px #00000030"
          >
            <q-input
              class="col"
              v-model="search"
              rounded
              outlined
              type="search"
            >
              <template v-slot:append>
                <q-icon name="search" />
              </template>
            </q-input>
          </div>

          <q-separator spaced inset />

          <q-item-label header>Categoria</q-item-label>
          <q-item v-for="item in divulgacao.items" :key="item.label" v-ripple>
            <q-tooltip
              anchor="center right"
              self="center left"
              class="q-pl-xl bg-purple text-h4"
              :offset="[10, 100]"
              style="max-width: 500px"
            >
              <span class="toltiptext">
                {{ item.texto }}
              </span>
            </q-tooltip>
            <q-item-section side top>
              <q-checkbox
                v-model="divulgacao.select"
                :val="item.label"
                color="orange"
              />
            </q-item-section>
            <q-item-section>
              <q-item-label>{{ item.label }}</q-item-label>
              <q-item-label caption> </q-item-label>
            </q-item-section>
          </q-item>
        </q-list>

        <div
          class="q-px-sm text-h5 text-bold row"
          style="text-shadow: 3px 3px 6px #00000030"
        >
          <q-input
            class="col-12 q-pl-sm-none q-pl-md-xl"
            v-model="search"
            rounded
            outlined
            type="search"
          >
            <template v-slot:append>
              <q-icon name="search" />
            </template>
          </q-input>
        </div>
      </q-drawer>
    </div>

    <div v-if="$q.screen.gt.xs || $q.screen.sm" class="col-2">
      <q-list bordered round padding class="fixed">
        <div
          v-if="$q.screen.gt.sm || $q.screen.sm"
          class="text-h5 q-px-sm text-bold full-width"
          style="text-shadow: 3px 3px 6px #00000030"
        >
          <q-input class="col" v-model="search" rounded outlined type="search">
            <template v-slot:append>
              <q-icon name="search" />
            </template>
          </q-input>
        </div>

        <q-separator spaced inset />

        <q-item-label header>Categoria</q-item-label>
        <q-item v-for="item in divulgacao.items" :key="item.label" v-ripple>
          <q-tooltip
            anchor="center right"
            self="center left"
            class="q-pl-xl bg-purple"
            :offset="[10, 100]"
            style="max-width: 500px"
          >
            <span class="toltiptext">
              {{ item.texto }}
            </span>
          </q-tooltip>
          <q-item-section side top>
            <q-checkbox
              v-model="divulgacao.select"
              :val="item.label"
              color="orange"
            />
          </q-item-section>
          <q-item-section>
            <q-item-label>{{ item.label }}</q-item-label>
            <q-item-label caption> </q-item-label>
          </q-item-section>
        </q-item>
        <div class="q-pa-lg">
          Resultados: {{filteredList2.length}}
        <q-pagination
          v-model="page"
          :min="currentPage"
          :max="Math.ceil(filteredList2.length / totalPages)"
          :input="true"
          input-class="text-orange-10"
        >
        </q-pagination>
      </div>

      </q-list>

    </div>

    <div class="q-pa-md col-md-10 col-xs-12 row">
      <q-list bordered expand-separator class="rounded-borders q-mx-xl">
        <q-expansion-item
          class="header"
          style="border-style: solid; border-color: #8640c4; color: #8640c4"
          v-for="(curso,index) in getData"
          :key="curso"
          expand-separator
          :label="(index+1) + ((page-1)*totalPages) + ' - '+curso.titulo"
        >
          <q-card
            class="q-pa-xl header2"
            style="border-top-style: solid; border-color: #8640c4"
          >
            <q-card-section class="row">
              <div class="col-4">
                <p class="header2">Modalidade: {{ curso.modalidade }}</p>
                <p class="text1 q-pl-md">
                  Coordenador: {{ curso.coordenador_da_acao_de_extensao }}
                </p>
                <p class="text1 q-pl-md">Contato: {{ curso.Contato }}</p>
                <p class="text1 q-pl-md">Centro: {{ curso.centro }}</p>
                <p class="text1 q-pl-md">Unidade: {{ curso.unidade }}</p>
                <p class="text1 q-pl-md">
                  Links de redes: {{ curso.links_para_redes_sociaus_e_sites }}
                </p>
                <a class="text1 q-pl-md" :href="'https://portal.ufrj.br/Inscricao/extensao/acaoExtensao/acao?id='+curso.id" target="_blank"> Saiba mais</a>

              </div>
              <div class="col-8">
                <p class="header2">Resumo:</p>
                <p class="text1 col-6 q-pl-md">{{ curso["Resumo"] }}</p>
              </div>
            </q-card-section>
          </q-card>
        </q-expansion-item>
      </q-list>
    </div>
  </q-page>
</template>

<script>
import { defineComponent, ref } from "vue";
import json from "../../public/todasacoes.json";

export default defineComponent({
  setup() {
    return {};
  },
  computed: {
    filteredList() {
      return this.acoes.filter(
        (data) =>
          JSON.stringify(data)
            .toLowerCase()
            .indexOf(this.search.toLowerCase()) !== -1
      );
    },
    filteredList2() {
      return this.filteredList.filter((data) =>
        this.divulgacao.select.includes(data["modalidade"])
      );
    },
    getData() {
      return this.filteredList2.slice(
        (this.page - 1) * this.totalPages,
        (this.page - 1) * this.totalPages + this.totalPages
      );
    },
  },
  data: function () {
    return {
      drawerLeft: ref(false),
      page: 1,
      currentPage: 1,
      nextPage: null,
      totalPages: 20,
      tab: "Cursos",
      pagination: {
        rowsPerPage: 30, // current rows per page being displayed
      },
      acoes: json,
      search: "",
      divulgacao: {
        items: [
          {
            label: "Curso",
            texto:
              "Um curso de extensão é uma ação pedagógica teórica e/ou prática, com carga horária mínima de 8 horas, critérios de avaliação definidos e que é aberta à participação de pessoas sem vínculo institucional com a universidade. No Portal da Extensão, você encontra cursos presenciais ou à distância para frequentar gratuitamente e obter certificação ao final.",
          },
          {
            label: "Evento",
            texto:
              "O evento de extensão é uma ação que promove apresentação e/ou exibição pública, livre ou com público específico, do conhecimento ou produto cultural, artístico, esportivo, científico e tecnológico desenvolvido, conservado ou reconhecido pela universidade. No Portal da Extensão, você encontra eventos gratuitos para criar novas conexões com pessoas e ideias.",
          },
          {
            label: "Projeto",
            texto:
              "Os projetos de extensão são ações promovidas pela comunidade acadêmica, de caráter educativo, social, cultural, científico ou tecnológico, que promovem a interação dialógica a partir do trabalho com grupos sociais e/ou territórios sem vínculo institucional com a universidade.",
          },
          {
            label: "Programa",
            texto:
              "Os programas articulam pelo menos três ações de extensão, sendo pelo menos dois projetos, com objetivos comuns ou correlatos, propiciando a integração de ações interdisciplinares, com participação de professores, alunos e técnicos de diversas unidades e centros da UFRJ.",
          },
        ],
        select: ["Curso", "Evento", "Projeto", "Programa"],
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

.bgcurso {
  background-image: url("/images/cursos1");
  background-color: red;
}

.header {
  font-size: min(25px, 2.5vw);
  font-weight: bold;
}

.header2 {
  font-size: min(20px, 2vw);
  font-weight: bold;
}

.text1 {
  font-size: min(16px, 2vw);
  font-weight: 400;
}
</style>
