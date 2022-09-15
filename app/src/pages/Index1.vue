<template>
  <q-page ref="destaque" id="destaque" class="q-pa-xl row">
    <div class="col-2">
      <q-list bordered round padding>
        <q-item-label header>Data</q-item-label>
        <q-item tag="label" v-ripple>
          <q-item-section side top>
            <q-checkbox v-model="check1" />
          </q-item-section>

          <q-item-section>
            <q-item-label> Hoje</q-item-label>
            <q-item-label caption> </q-item-label>
          </q-item-section>
        </q-item>
        <q-item tag="label" v-ripple>
          <q-item-section side top>
            <q-checkbox v-model="check1" />
          </q-item-section>

          <q-item-section>
            <q-item-label> Esta Semana</q-item-label>
            <q-item-label caption> </q-item-label>
          </q-item-section>
        </q-item>
        <q-item tag="label" v-ripple>
          <q-item-section side top>
            <q-checkbox v-model="check1" />
          </q-item-section>

          <q-item-section>
            <q-item-label> Este Mês</q-item-label>
            <q-item-label caption> </q-item-label>
          </q-item-section>
        </q-item>
      <q-separator spaced inset />

        <q-item-label header>Modalidade</q-item-label>
        <q-item v-for="item in modalidade" :key="item" tag="label" v-ripple>
          <q-item-section side top>
            <q-checkbox v-model="check1" color='purple'/>
          </q-item-section>

          <q-item-section>
            <q-item-label>{{ item }}</q-item-label>
            <q-item-label caption> </q-item-label>
          </q-item-section>
        </q-item>
      <q-separator spaced inset />

        <q-item-label header>Categoria</q-item-label>
        <q-item v-for="item in divulgar" :key="item" tag="label" v-ripple>
          <q-item-section side top>
            <q-checkbox v-model="check1" color='orange'/>
          </q-item-section>

          <q-item-section>
            <q-item-label>{{ item }}</q-item-label>
            <q-item-label caption> </q-item-label>
          </q-item-section>
        </q-item>
      </q-list>
    </div>
    <div class="col">
      <div
        class="q-px-sm text-h5 text-bold row"
        style="text-shadow: 3px 3px 6px #00000030"
      >
        <q-input class="col q-pl-xl" v-model="search" rounded outlined type="search">
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
         <q-btn-dropdown color="primary" label="Ordenar por">
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
    </q-btn-dropdown>
      </div>
      
      <div class="row">
        <q-list v-if="toggleAcoes == 'one'" responsive class="q-mx-xl">
          <section
            class="col-auto q-ma-md"
            v-for="(projeto, index) in filteredList3"
            :key="projeto"
          >
            <home-list :vaga="false" :acao="projeto" :index="index">
            </home-list>
          </section>
        </q-list>
        <div class="row q-px-xl" v-if="toggleAcoes == 'two'">
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
import VagasCard from "../components/VagasCard.vue";
import vagasJson from "../../public/vagas-13-05-2022.json";
import acoesJson from "../../public/acoes-13-05-2022.json";
import VueHorizontal from "vue-horizontal";

export default defineComponent({
  components: { HomeCard, HomeList },
  name: "PageIndex",
  data: function () {
    return {
      search: "",
      slide: "style",
      toggleAcoes: "one",
      divulgar: ["Curso", "Evento"],
      modalidade: ["Online", "Presencial"],
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
        if (acao["O que você deseja divulgar?"] == "Curso")
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
    filteredList2() {
      return this.filteredList.filter((data) =>
        this.divulgar.includes(data["O que você deseja divulgar?"])
      );
    },
    filteredList3() {
      return this.filteredList2.filter((data) =>
        this.modalidade.includes(data["Modalidade"])
      );
    },
  },
  mounted() {
    this.getProjetosLocal();
  },
});
</script>

<style scoped></style>
