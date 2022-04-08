<template>
  <q-card  class="my-card rounded-borders">
    <router-link v-ripple class="cursor-pointer relative-position" :to="'/'+ acao.attributes.modalidade+'/' + acao.id ">
    <q-img class='rounded-borders' v-if='vaga == false'  :src="meta[acao.attributes.modalidade].imagem+(index%3+1)">
      <p class="q-ml-xl q-pl-sm q-mt-md q-pt-md q-pr-sm text-left text-h6" :style='"border-left: 3px solid "+ meta[acao.attributes.modalidade].corTitulo +";" + "color: "+ meta[acao.attributes.modalidade].corTitulo'>
        {{ dropTitle(acao.attributes.titulo) }}
      </p>
      <p class=" q-ml-xl q-pl-sm text-left text-h7" :style='"color: "+ meta[acao.attributes.modalidade].cor'>
        {{ acao.attributes.coordenador_da_acao_de_extensao }}
      </p>

      <p class="q-ml-xl q-mt-xl q-pt-xl q-pl-sm  text-left text-h7" :style='"color: "+ meta[acao.attributes.modalidade].cor'>
        Endereço: {{ acao.attributes.endereco }}
      </p>
    </q-img>
        <q-img class='rounded-borders' v-if='vaga == true'  :src="'images/vagas'+(index%3+1)">
      <p class="q-ml-xl q-pl-sm q-mt-md q-pt-md q-pr-sm text-left text-h6" :style='"border-left: 3px solid "+ meta[acao.attributes.modalidade].corTitulo +";" + "color: white"'>
        {{ dropTitle(acao.attributes.titulo) }}
      </p>
      <p class=" q-ml-xl q-pl-sm text-left text-h7" :style='"color: "+ meta[acao.attributes.modalidade].cor'>
        {{ acao.attributes.coordenador_da_acao_de_extensao }}
      </p>

      <p class="q-ml-xl q-mt-xl q-pt-xl q-pl-sm  text-left text-h7" :style='"color: "+ meta[acao.attributes.modalidade].cor'>
        Endereço: {{ acao.attributes.endereco }}
      </p>
    </q-img>
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
          imagem: "images/vagas",
          corTitulo: "rgb(255,127,46)",
          cor:"white",
        },
      },
    };
  },

  methods: {
    dropTitle(titulo){
      return titulo.lenth < 80 ? titulo : titulo.slice(0,80) + ' ...'
    }
  },

});
</script>

<style scoped>


.rounded-borders {
  border-radius: 5%;
}
</style>