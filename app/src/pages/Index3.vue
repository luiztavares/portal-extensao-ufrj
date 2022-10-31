<template>

  <q-page ref="destaque" id="destaque" class=" q-pa-xs-sm q-pa-md-xl">
    <p class="text-h5 text-bold q-px-xs-sm q-px-md-xl q-pt-md" style="text-shadow: 3px 3px 6px #00000030">
      <span style="color: magenta">>></span> Vagas
    </p>
    <p class="text-h6 text-bold q-px-xs-sm q-px-md-xl q-ml-xl">
      As vagas de extensão são oportunidades para estudantes da UFRJ atuarem na equipe de uma ação de extensão, contribuindo para o desenvolvimento das atividades e recebendo creditação de horas (somente estudantes da graduação) e/ou certificado de participação. </p>
    <div class="row justify-center">
      <div
        class="col-* q-ma-md"
        v-for="(projeto, index) in projetos"
        :key="projeto"
      >
        <vagas-card :vaga="false" :acao="projeto" :index="index"> </vagas-card>
      </div>
    </div>


  </q-page>


</template>

<script>
import { defineComponent } from "vue";
import "@quasar/extras/fontawesome-v5";
import axios from "axios";
import VagasCard from "../components/VagasCard.vue";
import vagasJson from "../../public/vagas-13-05-2022.json";

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
         var i = 0;
      for (var acao of vagasJson) {
        var dtstring2 = acao["Período de inscrições (Data de Início)"];
        var dia2 = dtstring2.substring(0, 2);
        var mes2 = dtstring2.substring(3, 5);
        var ano2 = dtstring2.substring(6, 10);

        var dtstringend2 = acao["Período de inscrições (Data de Término)"];
        var diaend2 = dtstringend2.substring(0, 2);
        var mesend2 = dtstringend2.substring(3, 5);
        var anoend2 = dtstringend2.substring(6, 10);
        acao['id'] = acao['Link da página da ação no SIGA'].split('https://portal.ufrj.br/Inscricao/extensao/acaoExtensao/acao?id=')[1].split('&cid=')[0]
        if(acao['Anexe aqui uma imagem para divulgação da vaga, caso deseje'] == ''){
          acao['Anexe aqui uma imagem para divulgação da vaga, caso deseje'] = `images/Template Vagas -${i}.png`
            i+= 1;
            i = i%3
        }

          this.projetos.push(acao);
          console.log(Date(anoend2, mesend2, diaend2));

      i+= 1;
      i = i%3;
      }
      this.projetos = this.projetos.reverse();
      //this.projetos = acoesJson.reverse();
      this.vagas = this.vagas.reverse();
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
