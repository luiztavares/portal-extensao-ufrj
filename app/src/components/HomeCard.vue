<template>
  <q-card flat class="my-card">
    <q-img  :src="meta[acao.attributes.modalidade].imagem">
      <p class="q-ml-xl q-pl-sm q-mt-md q-pt-md q-pr-sm text-left text-h6" :style='"border-left: 3px solid "+ meta[acao.attributes.modalidade].corTitulo +";" + "color: "+ meta[acao.attributes.modalidade].corTitulo'>
        {{ acao.attributes.titulo }}
      </p>
      <p class=" q-ml-xl q-pl-sm text-left text-h7" :style='"color: "+ meta[acao.attributes.modalidade].cor'>
        {{ acao.attributes.coordenador_da_acao_de_extensao }}
      </p>

      <p class="q-ml-xl q-mt-xl q-pt-xl q-pl-sm  text-left text-h7" :style='"color: "+ meta[acao.attributes.modalidade].cor'>
        Endereço: {{ acao.attributes.endereco }}
      </p>
    </q-img>

  </q-card>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
  setup() {},

  props: ["acao"],

  data: function () {
    return {
      meta: {
        Projeto: {
          imagem: "images/Template Projetos - fundo.png",
          corTitulo: "rgb(89,16,236)",
          cor:"black",
        },
        Evento: {
          imagem: "images/Template eventos - fundo.png",
          corTitulo: "rgb(88,16,236)",
          cor:"white",
        },
        Curso: {
          imagem: "images/Template Cursos - fundo.png",
          corTitulo: "rgb(255,127,46)",
          cor:"white",
        },
      },
    };
  },

  methods: {},

});
</script>

<style scoped>

.my-card {
  width: 100%;
  min-width: 400px;
  min-height: 400px;
  border-style: outset;
}
</style>