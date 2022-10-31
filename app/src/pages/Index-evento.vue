<template>
  <q-page ref="destaque" id="destaque" class="q-pa-md-xl q-pa-xs-sm row">
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
        <q-list bordered round padding>
          <q-item-label header>Modalidade</q-item-label>
          <q-item v-for="item in modalidade.items" :key="item" v-ripple>
            <q-item-section side top>
              <q-checkbox
                v-model="modalidade.select"
                :val="item"
                color="purple"
              />
            </q-item-section>

            <q-item-section>
              <q-item-label>{{ item }}</q-item-label>
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
          <q-btn-toggle
            class="float-right"
            v-model="toggleAcoes"
            toggle-color="primary"
            flat
            :options="[
              { slot: 'one', value: 'one' },
              { slot: 'two', value: 'two' },
            ]"
          >
            <template v-slot:one>
              <div class="row items-center no-wrap">
                <q-icon name="list" />
                <div class="text-center">Lista</div>
              </div>
            </template>

            <template v-slot:two>
              <div class="row items-center no-wrap">
                <q-icon name="grid_view" />
                <div class="text-center">Grade</div>
              </div>
            </template>
          </q-btn-toggle>
        </div>
      </q-drawer>
    </div>

    <div v-if="$q.screen.gt.xs || $q.screen.sm" class="col-2">
      <q-list class="fixed" bordered round padding>
        <q-item-label header>Modalidade</q-item-label>
        <q-item v-for="item in modalidade.items" :key="item" v-ripple>
          <q-item-section side top>
            <q-checkbox
              v-model="modalidade.select"
              :val="item"
              color="purple"
            />
          </q-item-section>

          <q-item-section>
            <q-item-label>{{ item }}</q-item-label>
            <q-item-label caption> </q-item-label>
          </q-item-section>
        </q-item>
      </q-list>
    </div>

    <div class="col-xs-12 col-sm-10">
      <div
        v-if="$q.screen.gt.xs || $q.screen.sm"
        class="q-px-sm text-h5 text-bold row"
        style="text-shadow: 3px 3px 6px #00000030"
      >
        <q-input
          class="col q-pl-xl"
          v-model="search"
          rounded
          outlined
          type="search"
        >
          <template v-slot:append>
            <q-icon name="search" />
          </template>
        </q-input>
        <q-btn-toggle
          class="float-right"
          v-model="toggleAcoes"
          toggle-color="primary"
          flat
          :options="[
            { slot: 'one', value: 'one' },
            { slot: 'two', value: 'two' },
          ]"
        >
          <template v-slot:one>
            <div class="row items-center no-wrap">
              <q-icon name="list" />
              <div class="text-center">Lista</div>
            </div>
          </template>

          <template v-slot:two>
            <div class="row items-center no-wrap">
              <q-icon name="grid_view" />
              <div class="text-center">Grade</div>
            </div>
          </template>
        </q-btn-toggle>
        <!-- <q-btn-dropdown color="primary" label="Ordenar por">
      <q-list>
        <q-item clickable v-close-popup @click="onItemClick">
          <q-item-section>
            <q-item-label>Data de início</q-item-label>
          </q-item-section>
        </q-item>

        <q-item clickable v-close-popup @click="onItemClick">
          <q-item-section>
            <q-item-label>Data de Fim</q-item-label>
          </q-item-section>
        </q-item>

        <q-item clickable v-close-popup @click="onItemClick">
          <q-item-section>
            <q-item-label>Mais visitados</q-item-label>
          </q-item-section>
        </q-item>
      </q-list>
    </q-btn-dropdown> -->
      </div>
      <p
        class="text-h5 text-bold q-px-xs-sm q-px-md-xl q-pt-md"
        style="text-shadow: 3px 3px 6px #00000030"
      >
        <span style="color: magenta">>></span> Eventos
      </p>
      <p class="text-h6 text-bold q-px-xs-sm q-px-md-xl q-ml-xl">
        O evento de extensão é uma ação que promove apresentação e/ou exibição
        pública, livre ou com público específico, do conhecimento ou produto
        cultural, artístico, esportivo, científico e tecnológico desenvolvido,
        conservado ou reconhecido pela universidade. No Portal da Extensão, você
        encontra eventos gratuitos para criar novas conexões com pessoas e
        ideias.
      </p>
      <div class="row justify-center">
        <q-list v-if="toggleAcoes == 'one'" responsive class="q-px-xl">
          <section
            class="col-auto q-pa-md"
            v-for="(projeto, index) in filteredList3"
            :key="projeto"
          >
            <home-list class="col" :vaga="false" :acao="projeto" :index="index">
            </home-list>
          </section>
        </q-list>
        <div class="row q-px-xl justify-center" v-if="toggleAcoes == 'two'">
          <div
            class="col-* q-ma-md"
            v-for="(projeto, index) in filteredList3"
            :key="projeto"
          >
            <home-card class="" :vaga="false" :acao="projeto" :index="index">
            </home-card>
          </div>
        </div>
      </div>
    </div>
  </q-page>
</template>

<script>
import { defineComponent } from "vue";
import "@quasar/extras/fontawesome-v5";
import axios from "axios";
import HomeCard from "../components/HomeCard.vue";
import HomeList from "../components/HomeList.vue";
import acoesJson from "../../public/acoes-13-05-2022.json";
import { useQuasar } from "quasar";
import { ref } from "vue";

export default defineComponent({
  components: { HomeCard, HomeList },
  name: "PageIndex",
  setup() {
    const $q = useQuasar();
  },
  data: function () {
    return {
      drawerLeft: ref(false),
      search: "",
      slide: "style",
      toggleAcoes: "two",
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
        ],
        select: ["Curso", "Evento"],
      },
      modalidade: {
        items: ["Online", "Presencial", "Semi-Presencial"],
        select: ["Online", "Presencial", "Semi-Presencial"],
      },
      projetos: [],
      vagas: [],
      items: [...Array(20).keys()].map((i) => {
        return { title: `Item ${i}`, content: `🚀 Content ${i}` };
      }),
    };
  },
  created() {
    this.windowHeight = window.innerHeight + "px";
  },
  methods: {
    getProjetos() {
      axios.get("http://127.0.0.1:8000/home/").then((response) => {
        (this.projetos = response.data.data), console.log(this.projetos);
        this.vagas = response.data.data.slice(0, 3);
      });
    },
    getProjetosLocal() {
      for (var acao of acoesJson) {

        if (acao["O que você deseja divulgar?"] == "Evento")
          this.projetos.push(acao);

      }

      this.projetos = this.projetos.reverse();
      //this.projetos = acoesJson.reverse();
    },
  },
  computed: {
    month() {
      return new Date().toLocaleString("default", { month: "long" });
    },
    filteredList() {
      return this.projetos.filter(
        (data) =>
          JSON.stringify(data)
            .toLowerCase()
            .indexOf(this.search.toLowerCase()) !== -1
      );
    },
    filteredList3() {
      return this.filteredList.filter((data) =>
        this.modalidade.select.includes(data["Modalidade"])
      );
    },
  },
  mounted() {
    this.getProjetosLocal();
  },
});
</script>

<style scoped></style>
