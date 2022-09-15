<template>
  <q-card  class="mycard">
    <q-card-section >
      <router-link v-ripple class="cursor-pointer relative-position" :to="'/curso/'+ index ">

      <div class="text-h6 text-black q-pb-md">{{dropTitle( acao['Título curto da ação de extensão, para divulgação em materiais gráficos e em redes sociais.'])}}</div>
        </router-link>
        <p>
          {{ acao['Atribuições da vaga'] }}
        </p>
      <q-chip v-for="tipo in acao['Tipo da vaga'].replaceAll('Extensionista: ','').split(',')" :key="tipo" color="primary" outline :icon="tipo.includes('interno') ? 'school' : tipo.includes('externo') ? 'groups' : 'paid'" >{{tipo}}</q-chip>
        <q-chip color="teal" outline   icon="event" >Início: {{acao['Período de inscrições - Data de Início']}}</q-chip>
        <q-chip color="teal" outline  icon="event" >Fim: {{acao['Período de Inscrições - Data de Término']}}</q-chip>
        <q-chip color="orange" outline  icon="people" >Função da Vaga: {{dropTitle(acao['Função da vaga']) }}</q-chip>
 
    </q-card-section>

  </q-card>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
  setup() {},

  props: ["acao",'index','vaga'],

  data: function () {
    return {
      expanded: false,
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
    };
  },

  methods: {
    dropTitle(titulo){
      return titulo.length < 70 ? titulo : (titulo.slice(0,70) + ' ...')
    },
  },

});
</script>

<style scoped>

.mycard{
  height: 100%;
}

</style>
