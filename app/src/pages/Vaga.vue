<template>
  <div v-if='informacoes' >
    <q-page v-if='informacoes' class="hero items-center q-px-md column" >
    <p class="q-px-sm text-h5 text-bold row" style="text-shadow: 3px 3px 6px #00000030">
        <span style="color: magenta">>> </span>&nbsp; {{informacoes['Título curto da ação de extensão para divulgação em materiais gráficos e em redes sociais']}}
    </p>
    <q-img class='' height='50vh' fit='contain' :src="myImage(informacoes['Anexe aqui uma imagem para divulgação da vaga, caso deseje'])">
    </q-img>
    <RedesSociais> </RedesSociais>

    <div class="row q-pt-xl items-center">
        <div class=" col-xs-12 col-md-4 text-right q-pr-md">
        <q-chip v-for="tipo in this.informacoes['Tipo da vaga'].replaceAll('Extensionista: ','').split(',')" :key="tipo" color="primary" outline :icon="tipo.includes('interno') ? 'school' : tipo.includes('externo') ? 'groups' : 'paid'" >{{tipo}}</q-chip>
          <q-chip color="teal" outline   icon="event" >Início: {{this.informacoes['Período de inscrições (Data de Início)']}}</q-chip>
          <q-chip color="teal" outline  icon="event" >Fim: {{this.informacoes['Período de inscrições (Data de Término)']}}</q-chip>
          <q-chip color="orange" outline  icon="people" > <div class="chip">{{informacoes['Atribuições']}}</div> </q-chip>
        </div>
      <div class=' text-h7 col-xs-12 col-md-7 '>
              <p class="text-h5 text-left"> Descrição</p>

        {{ informacoes['Atribuições']}}</div>
      </div>

  <div class='text-h6 text-center q-pa-xl' >
    <p v-if='informacoes["Como se candidatar?"] != ""'>Como se candidatar? {{informacoes['Como se candidatar?']}}</p>
    <p v-if='informacoes["Contato para dúvidas"] != ""'>Contato para dúvidas: {{informacoes['Contato para dúvidas']}}</p>

  </div>





    </q-page>
  </div>




  </template>

  <script>
  import { defineComponent, ref } from "vue";
  import axios from "axios";
  import acoesJson from "../../public/vagas-13-05-2022.json";
  import RedesSociais from "../components/RedesSociais.vue";

  export default defineComponent({
    props: ["index"],
    components: { RedesSociais },

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
      getProjetosLocal() {
        var projetos = []
        for(var acao of acoesJson){
            projetos.push(acao)}
        this.informacoes = projetos.filter(
          (data) =>
            JSON.stringify(data)
              .indexOf(this.index) !== -1
        )[0];
        console.log(this.informacoes['Anexe aqui uma imagem para divulgação da vaga, caso deseje'])
      },
      myImage(src){
        if(src.substr(0,4) == 'http'){
          var imgs = src.split(',')[0]
          var id = imgs.split('open?id=')[1]
          return `https://drive.google.com/u/0/uc?id=${id}`
        }
        else{
          return 'images/Template Vagas -2.png'
        }
      }
    },
    beforeMount() {
      this.getProjetosLocal();
    },

    data: function () {
      return {
          projetos : [],
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
    max-width: 1600px;
  }
  .q-chip{
      height: unset !important;

  }

  .chip {
    white-space: initial !important;
  }
  </style>
