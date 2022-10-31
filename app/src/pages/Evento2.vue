<template>
<div v-if='informacoes'>

  <q-page  class="hero" >
    <q-img   height='70vh' fit='cover' src='https://pt-br.learn.canva.com/wp-content/uploads/sites/9/2020/01/evento-corporativo-1.jpg'>
    <div class="q-pa-xl window-height text-shadow-black">
    <div class='text-h6 q-pt-xl q-pl-xl'>Unidade: {{ informacoes.informacoes_da_acao_de_extensao.unidade}}</div>
    <div class='text-h6 q-pl-xl'>Responsável: {{ informacoes.informacoes_da_acao_de_extensao.coordenador_da_acao_de_extensao}}</div>
    <div class='q-mt-xl  q-pl-xl text-h3'>{{ informacoes.informacoes_da_acao_de_extensao.titulo}}</div>
    <div class='q-mt-md  q-pl-xl text-h6'>{{ informacoes.informacoes_da_acao_de_extensao.Resumo}}</div>
    </div>
    </q-img>

  </q-page>

    <q-page >
    <div class="q-pa-xl  ">
      <span class="text-h3">Objetivos:</span>
    <div class='text-h6  q-pl-xl q-pb-xl'><br> {{ informacoes.informacoes_da_acao_de_extensao.objetivos}}</div>
    <div class='text-h6' v-if='informacoes.informacoes_da_acao_de_extensao.publico_da_acao != "-"'>    <span class="text-h5 q-mt-xl">Público Alvo:</span>
  {{ informacoes.informacoes_da_acao_de_extensao.publico_da_acao}}</div>
    <!-- <div class='text-h6 '><span class='text-h5'> Carga Horária: </span>{{ informacoes.informacoes_da_acao_de_extensao.carga_horaria}} Horas</div>
    <div class='text-h6 '><span class='text-h5'> Redes: </span>{{ informacoes.informacoes_da_acao_de_extensao.links_para_redes_sociaus_e_sites}}</div>
     -->
    </div>
  </q-page>

  <q-page class='q-pa-xl bg-purple'>
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
  </q-page>
 
</div>

  
</template>

<script>
import { defineComponent, ref } from "vue";
import axios from "axios";

export default defineComponent({
  props: ["id"],
  methods: {
    getEventos() {
      const url = "http://127.0.0.1:8000/eventos/"+ this.id + '/'
      console.log(url)
      axios.get(url).then((response) => {
        (this.informacoes = response.data.data.attributes), console.log(this.informacoes);
      });
    },
    async getProjetosLocal() {
      this.informacoes = await import("../../public/" + this.id + '.json');
      this.informacoes = this.informacoes.data.attributes
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
  background-size: 100% 100%;
}
</style>
