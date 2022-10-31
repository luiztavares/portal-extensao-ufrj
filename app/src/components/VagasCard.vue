<template>
  <q-card  class="mycard">
 <router-link v-ripple class="cursor-pointer nounderline relative-position" :to="{
    path: `/vaga/`+ acao['id'] ,
    params: {
        acao: acao
    }
    }"
    >    <q-img ratio='1' fit='cover' :src="myImage(acao['Anexe aqui uma imagem para divulgação da vaga, caso deseje'])">
      <q-img ratio='1' fit='contain' class="blurred" :src="myImage(acao['Anexe aqui uma imagem para divulgação da vaga, caso deseje'])"></q-img>
    </q-img>
    <q-img class=''   v-if='acao["Anexe aqui uma imagem para divulgação da vaga, caso deseje."] == ""' :src="'images/Template Vagas -' +  index%3 + '.png'">
    </q-img>
      <q-card-section >
        <div class="text-h6 text-black text-underline q-pb-sm">{{dropTitle( acao['Título curto da ação de extensão para divulgação em materiais gráficos e em redes sociais'])}}</div>
        <q-chip color="teal" outline   icon="event" >Início: {{acao['Período de inscrições (Data de Início)']}}</q-chip>
        <q-chip color="teal" outline  icon="event" >Fim: {{acao['Período de inscrições (Data de Término)']}}</q-chip>
        <q-chip v-for="tipo in acao['Tipo da vaga'].replaceAll('Extensionista: ','').split(',')" :key="tipo" color="primary" outline :icon="tipo.includes('interno') ? 'school' : tipo.includes('externo') ? 'groups' : 'paid'" >{{tipo}}</q-chip>

      </q-card-section>
    </router-link>
  </q-card>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
  setup() {},

  props: ["acao",'index','vaga'],

  data: function () {
    return {
      meta: {
        Projeto: {
          imagem: "images/projetos",
          corTitulo: "rgb(89,16,236)",
          cor:"black",
        },
        Evento: {
          imagem: "images/eventos",
          corTitulo: "rgb(88,16,236)",
          cor:"white",
        },
        Curso: {
          imagem: "images/cursos",
          corTitulo: "rgb(255,255,0)",
          cor:"white",
        },
        Vaga: {
          imagem: "images/vagas1",
          corTitulo: "rgb(255,127,46)",
          cor:"white",
        },
      },
    };
  },

  methods: {
    dropTitle(titulo){
      return titulo.length < 70 ? titulo : (titulo.slice(0,70) + ' ...')
    },
     myImage(src){
      if(src.substring(0,5) == 'https'){
        var imgs = src.split(',')[0]
        var id = imgs.split('open?id=')[1]
        return `https://drive.google.com/u/0/uc?id=${id}`
      }
      else{
        return src
      }
    },
  },

});
</script>

<style scoped>


.mycard{
  width: 350px;
  max-width: 400px;
  height: 100%;
}

.nounderline{
  text-decoration: none;
}

.text-underline{
  text-decoration: underline;
}

.blurred{
  backdrop-filter: blur(20px);
}


</style>
