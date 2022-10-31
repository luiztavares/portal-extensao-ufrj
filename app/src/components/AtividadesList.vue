<template>
  <q-card  class="mycard">
    <q-card-section >
      <router-link v-ripple class="cursor-pointer relative-position" :to="{
    path: `/atividade-e-servico/`+ acao['id'] ,
    params: {
        acao: acao
    }
    }"
    >
      <div class="text-h6 text-black q-pb-md">{{dropTitle( acao['Nome curto da atividade/serviço/produto, para divulgação em materiais gráficos e em redes sociais.'])}}</div>
        </router-link>
        <p>
          {{ acao['Descreva brevemente a atividade/serviço.'] }}
        </p>
      <q-chip color="pink" outline :icon="acao.Modalidade == 'Online' ? 'public' : 'location_city'" >{{acao.Modalidade}}</q-chip>
      <q-chip color="green" outline  icon="paid" >Gratuito</q-chip>
        <q-chip color="teal" outline   icon="event" >Início: {{acao['Período de realização - Data de Início']}}</q-chip>
        <q-chip color="teal" outline  icon="event" >Fim: {{acao['Período de realização - Data de Término']}}</q-chip>
        <q-chip color="orange" outline  icon="people" >Público: {{dropTitle(acao['Público']) }}</q-chip>
 
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
