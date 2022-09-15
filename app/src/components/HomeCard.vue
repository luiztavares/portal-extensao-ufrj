<template>
  <q-card  class="mycard">
    <router-link v-ripple class="cursor-pointer relative-position" :to="'/curso/'+ index ">
    <q-img class='' v-if='acao["Anexe aqui uma imagem para divulgação do curso/evento, caso deseje."] != ""'  :src="acao['Anexe aqui uma imagem para divulgação do curso/evento, caso deseje.']">
    </q-img>
    <q-img class='' v-if='acao["Anexe aqui uma imagem para divulgação do curso/evento, caso deseje."] == ""'  :src="meta[acao['O que você deseja divulgar?']].imagem">
    </q-img>
      <q-card-section vertical >
        <div class="text-h6 text-black">{{dropTitle( acao['Título curto da ação de extensão, para divulgação em materiais gráficos e em redes sociais.'])}}</div>
        <div class="text-subtitle2 text-black">{{acao['O que você deseja divulgar?']}} {{acao.Modalidade}}</div>
        <div class="text-subtitle2 text-black">Início: {{acao['Período de realização - Data de Início']}}</div>
        <div class="text-subtitle2 text-black">Fim: {{acao['Período de realização - Data de Término']}}</div>
      </q-card-section>


        <!-- <q-img class='rounded-borders' v-if='vaga == true'  :src="'images/vagas'+(index%3+1)">
      <p class="q-ml-xl q-pl-sm q-mt-md q-pt-md q-pr-sm text-left text-h6" :style='"border-left: 3px solid "+ meta[acao.attributes.modalidade].corTitulo +";" + "color: white"'>
        {{ dropTitle(acao.attributes.titulo) }}
      </p>
      <p class=" q-ml-xl q-pl-sm text-left text-h7" :style='"color: "+ meta[acao.attributes.modalidade].cor'>
        {{ acao.attributes.coordenador_da_acao_de_extensao }}
      </p>

      <p class="q-ml-xl q-mt-xl q-pt-xl q-pl-sm  text-left text-h7" :style='"color: "+ meta[acao.attributes.modalidade].cor'>
        Endereço: {{ acao.attributes.endereco }}
      </p>
    </q-img> -->
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
    }
  },

});
</script>

<style scoped>

.mycard{
  width: 250px;
  max-width: 300px;
  height: 100%;
}

</style>
