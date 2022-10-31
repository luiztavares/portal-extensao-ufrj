<template>
  <div v-if="informacoes">
    <q-page v-if="informacoes" class="hero items-center q-px-md column">
      <p
        class="q-px-sm text-h5 text-bold row"
        style="text-shadow: 3px 3px 6px #00000030"
      >
        <span style="color: magenta">>> </span>&nbsp;
        {{
          informacoes[
            "Título curto da ação de extensão para divulgação em materiais gráficos e em redes sociais"
          ]
        }}
      </p>
      <q-img
        class=""
        height="50vh"
        fit="contain"
        :src="
          myImage(
            informacoes[
              'Anexe aqui uma imagem para divulgação do curso/evento, caso deseje'
            ]
          )
        "
      >
      </q-img>

      <RedesSociais> </RedesSociais>

      <div class="row q-pt-xl items-center">
        <div class="col-xs-12 col-md-4 text-right q-pr-md">
          <q-chip
            color="primary"
            outline
            :icon="
              informacoes['O que você deseja divulgar?'] == 'Curso'
                ? 'school'
                : 'celebration'
            "
            >{{ informacoes["O que você deseja divulgar?"] }}</q-chip
          >
          <q-chip
            color="primary"
            outline
            :icon="
              informacoes.Modalidade == 'Online' ? 'public' : 'location_city'
            "
            >{{ informacoes.Modalidade }}</q-chip
          >
          <q-chip color="teal" outline icon="event"
            >Início:
            {{ informacoes["Período de realização (Data de Início)"] }}</q-chip
          >
          <q-chip color="teal" outline icon="event"
            >Fim:
            {{ informacoes["Período de realização (Data de Término)"] }}</q-chip
          >
          <q-chip color="orange" outline icon="people">
            <div class="chip">{{ informacoes["Público"] }}</div>
          </q-chip>
        </div>
        <div class="text-h7 col-xs-12 col-md-7">
          <p class="text-h5 text-left">Descrição</p>

          {{
            informacoes[
              "Descreva brevemente a ação (curso ou evento) e como será desenvolvida"
            ]
          }}
        </div>
      </div>

      <div class="text-h6 text-center q-pa-xl">
        <p v-if="informacoes['Página/link de inscrições (se houver)'] != ''">
          Página para inscrição:
          <a
            target="_blank"
            :href="informacoes['Página/link de inscrições (se houver)']"
          >
            {{ informacoes["Página/link de inscrições (se houver)"] }}</a
          >
        </p>
        <p
          v-if="
            informacoes['E-mail de contato para inscrições (se houver)'] != ''
          "
        >
          Email sobre inscrições
          {{ informacoes["E-mail de contato para inscrições (se houver)"] }}
        </p>
        <p v-if="informacoes['E-mail para atendimento ao público'] != ''">
          E-mail para atendimento ao público:
          {{ informacoes["E-mail para atendimento ao público"] }}
        </p>
        <p v-if="informacoes['Telefone para atendimento ao público'] != ''">
          Telefone para atendimento ao público:
          {{ informacoes["Telefone para atendimento ao público"] }}
        </p>
      </div>
    </q-page>
  </div>
</template>

<script>
import { defineComponent, ref, Vue } from "vue";
import axios from "axios";
import acoesJson from "../../public/acoes-13-05-2022.json";
import RedesSociais from "../components/RedesSociais.vue";

export default {
  props: ["index"],
  components: { RedesSociais },
  methods: {
    dropTitle(titulo, size) {
      return titulo.length < size ? titulo : titulo.slice(0, size) + " ...";
    },
    getCursos() {
      const url = "http://127.0.0.1:8000/cursos/" + this.id + "/";
      console.log(url);
      axios.get(url).then((response) => {
        (this.informacoes = response.data.data.attributes),
          console.log(this.informacoes);
      });
    },
    async getProjetosLocal() {
      var projetos = [];
      for (var acao of acoesJson) {
        projetos.push(acao);
      }

      this.informacoes = projetos.filter(
        (data) => JSON.stringify(data).indexOf(this.index) !== -1
      )[0];
      console.log(this.informacoes);
    },
    myImage(src) {
      if (src.substr(0, 4) == "http") {
        var imgs = src.split(",")[0];
        var id = imgs.split("open?id=")[1];
        return `https://drive.google.com/u/0/uc?id=${id}`;
      } else {
        return "images/Template Curso -1.png";
      }
    },
  },
  beforeMount() {
    this.getProjetosLocal();
  },
  created() {
    this.myurl = encodeURIComponent(window.location.href);
  },

  data: function () {
    return {
      myurl: "",
      projetos: [],
      meta: {
        Projeto: {
          imagem: "images/projetos1",
          corTitulo: "rgb(89,16,236)",
          cor: "black",
        },
        Evento: {
          imagem: "images/eventos1",
          corTitulo: "rgb(88,16,236)",
          cor: "white",
        },
        Curso: {
          imagem: "images/cursos3",
          corTitulo: "rgb(255,255,0)",
          cor: "white",
        },
        Vaga: {
          imagem: "images/vagas1",
          corTitulo: "rgb(255,127,46)",
          cor: "white",
        },
      },
      informacoes: null,
    };
  },
};
</script>

<style scoped>
.text-shadow-black {
  text-shadow: 1px 1px 2px black;
}
.hero {
  height: 100%;
  max-width: 1600px;
}
.q-chip {
  height: unset !important;
}

.chip {
  white-space: initial !important;
}
</style>
