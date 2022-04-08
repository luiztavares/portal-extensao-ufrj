<template>
  <q-layout view="hHh lPr fff">
    <q-header  class='bg-white' >
      <q-toolbar class="q-ma-md">
        <q-toolbar-title @click="this.$router.push('/')">
          <q-img
            fit="contain"
            height="50px"
            position="0 0"
            src="images/header.png"
          ></q-img>
        </q-toolbar-title>
        <q-btn style='border-right: 3px solid magenta;' color="white" text-color="black" flat label="Cursos" v-on:click="this.$router.push('/acoes')">
        </q-btn>
        <q-btn style='border-right: 3px solid magenta;' color="white" text-color="black" flat label="Eventos" v-on:click="this.$router.push('/acoes')">
        </q-btn>
        <q-btn style='border-right: 3px solid magenta;' color="white" text-color="black" flat label="Projetos" v-on:click="this.$router.push('/acoes')">
        </q-btn>
        <q-btn style='border-right: 3px solid magenta;' color="white" text-color="black" flat label="Atividades e Serviços" v-on:click="this.$router.push({ path: '/acoes', tab: 'cursos' })">
        </q-btn>
        <q-btn style='border-right: 3px solid magenta;' color="white" text-color="black" flat label="Vagas"> </q-btn>
        <q-btn color="white" text-color="black" flat label="Lives" v-on:click="this.$router.push('/lives')">
        </q-btn>
      </q-toolbar>
    </q-header>

    <q-page-container>
      <router-view />
    </q-page-container>
    <div elevated class="bg-white q-pa-md">
      <div class="row justify-center">
      <q-img class="col-1" fit="contain" src="images/ufrj.png"></q-img>
      <q-img class="col-1" fit='contain' src="images/siga.jpg"></q-img>
      <q-img class="col-1" fit='contain' src="images/tic.png"></q-img>
      </div>
<div class="custom text-black">
	<p style="text-align: center;"><span style="font-size: 11pt;"><a href="http://www.ufrj.br/" target="_blank" rel="noopener noreferrer">UFRJ</a>&nbsp;|&nbsp;<a href="http://www.pr1.ufrj.br/" target="_blank" rel="noopener noreferrer">Graduação</a>&nbsp;|&nbsp;<a href="http://www.pr2.ufrj.br/" target="_blank" rel="noopener noreferrer">Pós Graduação e Pesquisa</a>&nbsp;|&nbsp;<a href="http://www.pr3.ufrj.br" target="_blank" rel="noopener noreferrer">Planejamento, Desenvolvimento</a>&nbsp;|&nbsp;<a href="http://www.pr4.ufrj.br/" target="_blank" rel="noopener noreferrer">Pessoal&nbsp;</a>|&nbsp;<a href="http://www.pr6.ufrj.br" target="_blank" rel="noopener noreferrer">Gestão e Governança</a>&nbsp;| <a href="http://politicasestudantis.ufrj.br" target="_blank">Políticas Estudantis</a> |<a href="http://www.pr6.ufrj.br/" target="_blank" rel="noopener noreferrer"></a><a href="http://www.prefeitura.ufrj.br" target="_blank" rel="noopener noreferrer">Prefeitura</a></span></p>
<p style="text-align: center;"><span style="font-size: 10pt;">Praça Jorge Machado Moreira, s/nº, Cidade Universitária, Rio de Janeiro, RJ - CEP 21941-592</span></p>
<p style="text-align: center;"><span style="font-size: 10pt;">Tel. (21) 3938-0482 / (21) 3938-0494 / (21) 3938-0617 - E-mail:&nbsp;<a href="mailto:gabinetepr5@pr5.ufrj.br" target="_blank" rel="noopener noreferrer">gabinetepr5@pr5.ufrj.br</a></span></p></div>
      
      <!-- <p class="text-h6 text-center">
 Este Portal tem como objetivo informar aos estudantes, docentes, técnicos administrativos e comunidade externa das ações e serviços disponíveis e promovidos pela Pró-Reitoria de Extensão (PR-5) da Universidade Federal do Rio de Janeiro.
            </p> -->
    </div>
  </q-layout>
</template>

<script>
import { defineComponent, ref } from "vue";

export default defineComponent({
  name: "MainLayout",
  data: function () {
    return { search: "" };
  },
  components: {},
  methods: {
    scrollToAnchorPoint(refName) {
      const el = this.$refs[refName];
      el.scrollIntoView({ behavior: "smooth" });
    },
  },

  setup() {},
});
</script>

<style scoped>
.bg-white {
  background-color: white !important;
}
</style>
