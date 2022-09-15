<template>
<div v-if='informacoes' >
  <q-page v-if='informacoes' class="hero q-px-xl" >
  <p class="q-px-sm text-h5 text-bold row" style="text-shadow: 3px 3px 6px #00000030">
      <span style="color: magenta">>> </span> {{informacoes['Título curto da ação de extensão, para divulgação em materiais gráficos e em redes sociais.']}}
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
            <div class="row q-px-xl items-center no-wrap">
              <q-icon name="grid_view" />
              <div class="text-center">Grade</div>
            </div>
          </template>
        </q-btn-toggle>
  </p>


    <q-img class='' height='50vh' fit='contain' v-if='informacoes["Anexe aqui uma imagem para divulgação do curso/evento, caso deseje."] != ""'  :src="informacoes['Anexe aqui uma imagem para divulgação do curso/evento, caso deseje.']">
    </q-img>
    <q-img class='' height='50vh' fit='contain' v-if='informacoes["Anexe aqui uma imagem para divulgação do curso/evento, caso deseje."] == ""'  :src="meta[informacoes['O que você deseja divulgar?']].imagem">
    
</q-img>
     
  <div class="row q-pt-xl items-center">
      <div class="col-4 text-right q-pr-md">
 <q-chip color="primary" outline :icon="informacoes['O que você deseja divulgar?'] == 'Curso' ? 'school' : 'celebration'" >{{informacoes['O que você deseja divulgar?']}}</q-chip>
      <q-chip color="primary" outline :icon="informacoes.Modalidade == 'Online' ? 'public' : 'location_city'" >{{informacoes.Modalidade}}</q-chip>
        <q-chip color="teal" outline   icon="event" >Início: {{informacoes['Período de realização - Data de Início']}}</q-chip>
        <q-chip color="teal" outline  icon="event" >Fim: {{informacoes['Período de realização - Data de Término']}}</q-chip>
        <q-chip color="orange" outline  icon="people" >{{dropTitle(informacoes['Público alvo'],40) }}</q-chip>
      </div>
    <div class=' text-h7 col-7 '>
            <p class="text-h5 text-left"> Descrição</p>

      {{ informacoes['Descreva brevemente a ação (curso ou evento) e como será desenvolvida.']}}</div>
    </div>

<div class='text-h6 text-center q-pa-xl' >
<q-btn v-if='informacoes["Página/link de Inscrições (se houver)"] != ""' rounded label="Página de Inscrição" color='primary' target='_blank' :href="informacoes['Página/link de Inscrições (se houver)']"></q-btn>
<q-btn v-if='informacoes["E-mail de contato para inscrições (se houver)"] != ""' class="q-ma-sm" rounded color='primary' target='_blank' label="Email de contato para Inscrição" :href="'mailto:'+informacoes['E-mail de contato para inscrições (se houver)']"></q-btn>

</div>





  </q-page>
</div>




</template>

<script>
import { defineComponent, ref } from "vue";
import axios from "axios";
import acoesJson from "../../public/acoes-13-05-2022.json";

export default defineComponent({
  props: ["index"],
  methods: {
        dropTitle(titulo,size){
      return titulo.length < size ? titulo : (titulo.slice(0,size) + ' ...')
    },
    getCursos() {
      const url = "http://127.0.0.1:8000/cursos/"+ this.id + '/'
      console.log(url)
      axios.get(url).then((response) => {
        (this.informacoes = response.data.data.attributes), console.log(this.informacoes);
      });
    },
    async getProjetosLocal() {
      var projetos = []
      for(var acao of acoesJson){
        var dtstring = acao['Período de realização - Data de Início']
        var dia = dtstring.substring(0,2)
        var mes = dtstring.substring(3,5)
        var ano = dtstring.substring(6,10)
        
        var dtstringend = acao['Período de realização - Data de Término']
        var diaend = dtstringend.substring(0,2)
        var mesend = dtstringend.substring(3,5)
        var anoend = dtstringend.substring(6,10)
        if(new Date() >= new Date(ano,mes,dia) && new Date() <= new Date(anoend,mesend,diaend))
          projetos.push(acao)
      }
       projetos = projetos.reverse()
       console.log(projetos)

      //this.informacoes = await import("../../public/" + this.id + '.json');
      this.informacoes = projetos[this.index]
      console.log(this.informacoes)
    },
  },
  beforeMount() {
    this.getProjetosLocal();
  },

  data: function () {
    return {
            meta: {
        Projeto: {
          imagem: "images/projetos1",
          corTitulo: "rgb(89,16,236)",
          cor:"black",
        },
        Evento: {
          imagem: "images/eventos1",
          corTitulo: "rgb(88,16,236)",
          cor:"white",
        },
        Curso: {
          imagem: "images/cursos3",
          corTitulo: "rgb(255,255,0)",
          cor:"white",
        },
        Vaga: {
          imagem: "images/vagas1",
          corTitulo: "rgb(255,127,46)",
          cor:"white",
        },
      },
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
