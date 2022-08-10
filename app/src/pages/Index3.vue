<template>

  <q-page ref="destaque" id="destaque" class=" q-pa-xl">
    <p class=" q-px-sm text-h5 text-bold" style="text-shadow: 3px 3px 6px #00000030">
      <span style="color: magenta">>></span> Vagas
    </p>
    <div class="row">
      <div
        class="col-* q-ma-md"
        v-for="(projeto, index) in projetos"
        :key="projeto"
      >
        <vagas-card :vaga="false" :acao="projeto" :index="index"> </vagas-card>
      </div>
    </div>



  <!-- <q-input class="q-pa-xl" style="max-width: 500px"
        v-model="acoessearch"
        debounce="1000"
        filled
        placeholder="Pesquise sua ação"
      >
        <template v-slot:append>
          <q-icon name="search" />
        </template>
      </q-input>

    <div class="col row q-pa-sm justify-around">
    <q-btn flat
      v-on:click="this.$router.push('/acoes')"
      class=""
      label="Veja todas as ações"
    ><span style="color:blue" class="q-px-sm"> V</span> </q-btn>
    </div> -->

  </q-page>

  <!-- <q-page class="column bg-lime q-pa-xl">
    <div class="row">
    <p class="col q-px-sm text-h5 text-bold" style="text-shadow: 3px 3px 6px #00000030">
      <span style="color: magenta">>></span> Lives em Destaque
    </p>
        <q-tabs class="col">
      <q-tab>Ao vivo</q-tab>
      <q-tab>Próximas</q-tab>
      <q-tab>Passadas</q-tab>
    </q-tabs>
    </div>


    <div class="col row q-pa-xl justify-around">
      <div class="col-3 q-ma-xl" v-for="acao in acoes" :key="acao">
        <q-card
          flat
          vertical
          class="my-card"
          :style="'border-color: ' + acao.cor"
        >
          <iframe
            width="400"
            height="315"
            src="https://www.youtube.com/embed/Xz3bMCj6BFI"
            title="YouTube video player"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen
          ></iframe>

          <q-card-section>
            <div class="text-h6">{{ acao.titulo }}</div>
            <div class="text-subtitle2">{{ acao.coordenador }}</div>
          </q-card-section>

          <q-card-section class="q-pt-none">
            {{ acao.descricao }}
          </q-card-section>
        </q-card>
      </div>
    </div>
    <q-btn flat
      v-on:click="this.$router.push('/lives')"
      class="col-1"
      label="Carregar mais"
    ></q-btn>
  </q-page> -->
</template>

<script>
import { defineComponent } from "vue";
import "@quasar/extras/fontawesome-v5";
import axios from "axios";
import HomeCard from "../components/HomeCard.vue";
import VagasCard from "../components/VagasCard.vue";
import vagasJson from "../../public/vagas-13-05-2022.json";
import acoesJson from "../../public/acoes-13-05-2022.json";
import VueHorizontal from "vue-horizontal";

export default defineComponent({
  components: { VagasCard, },
  name: "PageIndex",
  data: function () {
    return {
      acoessearch : '',
      slide: "style",
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
      for(var acao of vagasJson){
      
          this.projetos.push(acao)
      }

  
      this.projetos = this.projetos.reverse()
      //this.projetos = acoesJson.reverse();
    },
  },
  computed: {
    month() {
      return new Date().toLocaleString('default', { month: 'long' });;
    }

  },
  mounted() {
    this.getProjetosLocal();
  },
});
</script>

<style scoped>
.q-carousel {
  min-height: inherit;
  min-width: inherit;
}

.rounded-borders {
  border-radius: 5%;
}

.my-card {
  min-width: 400px;
  min-height: 400px;
  max-width: 400px;

}

.text-shadow-black {
  text-shadow: 1px 1px 2px black;
}

.slideimage {
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center;
}


</style>
