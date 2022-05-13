<template>
<div v-if='informacoes' >
  <q-page v-if='informacoes' class="hero" >
    <q-img  height='70vh' fit='cover' src='https://auditoriacidada.org.br/wp-content/uploads/2018/01/curso-1500x575.jpg'>
    <div class="q-pa-xl window-height text-shadow-black">
    <div class='q-mt-xl  q-pl-xl text-h3'>{{ informacoes['Título curto da ação de extensão, para divulgação em materiais gráficos e em redes sociais.']}}</div>
    <div class='q-mt-md  q-pl-xl text-h6'>{{ informacoes["Descreva brevemente a ação (curso ou evento), ou a atividade/serviço e como será desenvolvida."]}}</div>
    </div>
    </q-img>
    <div class='text-h6 q-pl-xl q-pt-xl'>    <span class="text-h5 q-mt-xl">Data de Início:</span>
  {{ informacoes["Período de realização - Data de Início"]}}</div>
  <div class='text-h6 q-pl-xl'>    <span class="text-h5 q-mt-xl">Data de Término:</span>
  {{ informacoes["Período de realização - Data de Término"]}}</div>
  <div class='text-h6 q-pl-xl' v-if='informacoes["Início do prazo de inscrições: (se houver)"] != ""'>    <span class="text-h5 q-mt-xl">Inscrições de </span>
  {{ informacoes["Início do prazo de inscrições: (se houver)"]}} até {{ informacoes["Fim do prazo de inscrições: (se houver)"]}}</div>
  <div class='text-h6 q-px-xl q-pt-md' v-if='informacoes["Público alvo"] != "-"'>    <span class="text-h5 q-mt-xl">Público Alvo:</span>
  {{ informacoes["Público alvo"]}}</div>
  <div class='text-h6 q-pl-xl q-pt-md' v-if='informacoes["Número de vagas internas da UFRJ"] != "-"'>    <span class="text-h5 q-mt-xl">Vagas internas da UFRJ:</span>
  {{ informacoes["Número de vagas internas da UFRJ"]}}</div>
  <div class='text-h6 q-pl-xl' v-if='informacoes["Número de vagas externas"] != "-"'>    <span class="text-h5 q-mt-xl">Vagas externas:</span>
  {{ informacoes["Número de vagas externas"]}}</div>

  <div class='text-h6 q-pl-xl' v-if='informacoes["Número de vagas externas"] != "-"'>    <span class="text-h5 q-mt-xl">Vagas externas:</span>
  {{ informacoes["Número de vagas externas"]}}</div>

<div class='text-h6 text-center q-pa-xl' >
<q-btn v-if='informacoes["Página/link de Inscrições (se houver)"] != ""' rounded label="Página de Inscrição" :href="informacoes['Página/link de Inscrições (se houver)']"></q-btn>
<q-btn v-if='informacoes["E-mail de contato para inscrições (se houver)"] != ""' class="q-ma-sm" rounded label="Email de contato para Inscrição" :href="'mailto:'+informacoes['E-mail de contato para inscrições (se houver)']"></q-btn>

</div>





  </q-page>
    <!-- <q-page >
    <div class="q-pa-xl  ">
      <span class="text-h3">Objetivos:</span>

    <div class='text-h6 '><span class='text-h5'> Carga Horária: </span>{{ informacoes.informacoes_da_acao_de_extensao.carga_horaria}} Horas</div>
    <div class='text-h6 '><span class='text-h5'> Redes: </span>{{ informacoes.informacoes_da_acao_de_extensao.links_para_redes_sociaus_e_sites}}</div>

    </div>
  </q-page> -->

  <!-- <q-page class='q-pa-xl bg-purple'>
    <p class="text-h3 text-white" v-if='informacoes.instituicoes_parceiras.length'>Instituições Parceiras</p>
    <q-chip v-for='instituicao in informacoes.instituicoes_parceiras' :key='instituicao.nome' class="glossy" color="green" text-color="white" icon-right="business">
        {{instituicao.nome}}
      </q-chip>
    <p class="text-h3 text-white q-pt-xl"  v-if='informacoes.escolas_participantes.length'>Escolas</p>
    <q-chip v-for='instituicao in informacoes.escolas_participantes' :key='instituicao.nome' class="glossy" color="orange" text-color="white" icon-right="school">
        {{instituicao.nome}}
      </q-chip>

    <p class="text-h3 text-white q-pt-xl"  v-if='informacoes.equipe_de_realizacao.length'>Equipe</p>
    <q-chip v-for='instituicao in informacoes.equipe_de_realizacao' :key='instituicao.nome' class="glossy" color="red" text-color="white" icon-right="person">
        {{instituicao.nome}}
      </q-chip>
  </q-page> -->
</div>




</template>

<script>
import { defineComponent, ref } from "vue";
import axios from "axios";
import acoesJson from "../../public/acoes-13-05-2022.json";

export default defineComponent({
  props: ["index"],
  methods: {
    getCursos() {
      const url = "http://127.0.0.1:8000/cursos/"+ this.id + '/'
      console.log(url)
      axios.get(url).then((response) => {
        (this.informacoes = response.data.data.attributes), console.log(this.informacoes);
      });
    },
    async getProjetosLocal() {
      //this.informacoes = await import("../../public/" + this.id + '.json');
      this.informacoes = acoesJson[this.index]
      console.log(this.informacoes)
    },
  },
  beforeMount() {
    this.getProjetosLocal();
  },

  data: function () {
    return {
      informacoes: null,
    };
  },
});
</script>

<style scoped>
.text-shadow-black{
  text-shadow: 1px 1px 2px black;
}
.hero {
  height: 100%;
}
</style>
