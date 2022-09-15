<template>
  <q-layout view="hHh lPr fff">
    <q-header class="bg-white">
      <q-toolbar class="q-ma-md">
        <q-toolbar-title @click="this.$router.push('/')">
          <q-img
            fit="contain"
            height="50px"
            position="0 0"
            src="images/header.png"
          ></q-img>
        </q-toolbar-title>
        <div class="gt-sm">
    <q-btn round color="purple" :to="links[0].hash" glossy icon="search" />

          <q-btn
            style="border-right: 3px solid magenta"
            color="white"
            text-color="black"
            flat
            v-for="link in links"
            :key="link.label"
            :label="link.label"
            :to="link.hash"
            class="text-no-wrap btn"
          >
          </q-btn>
        </div>
        <div class="lt-md">
          <q-btn class='q-mr-xl' color="purple" flat round dense icon="menu">
            <q-menu class="bg-purple text-white" auto-close>
              <q-list >
                <q-item
                  clickable
                  flat
                  v-for="link in links"
                  :key="link.label"
                  :to="link.hash"
                  class="text-no-wrap btn"
                >
                  <q-item-section>
                    {{ link.label }}
                  </q-item-section>
                </q-item>
              </q-list>
            </q-menu>
          </q-btn>
        </div>
      </q-toolbar>
    </q-header>

    <q-page-container >
      <router-view />
    </q-page-container>
    <div elevated class="q-px-xl q-py-md" style="background-color: #0268E4; text-shadow: 3px 3px 6px #212121">

      <p class="text-h6 text-center" style="color: white">
 Este Portal tem como objetivo informar aos estudantes, docentes, técnicos administrativos e comunidade externa das ações e serviços disponíveis e promovidos pela Pró-Reitoria de Extensão (PR-5) da Universidade Federal do Rio de Janeiro.
      </p>
    </div>
    <div elevated class="bg-white q-px-md">
      <div class="row justify-center">
        <q-img class="col-1" fit="contain" src="images/ufrj.png"></q-img>
        <q-img class="col-1" fit="contain" src="images/siga.jpg"></q-img>
        <q-img class="col-1" fit="contain" src="images/tic.png"></q-img>
      </div>
      <div class="custom text-black">
        <p style="text-align: center">
          <span style="font-size: 11pt"
            ><a
              href="http://www.ufrj.br/"
              target="_blank"
              rel="noopener noreferrer"
              >UFRJ</a
            >&nbsp;|&nbsp;<a
              href="http://www.pr1.ufrj.br/"
              target="_blank"
              rel="noopener noreferrer"
              >Graduação</a
            >&nbsp;|&nbsp;<a
              href="http://www.pr2.ufrj.br/"
              target="_blank"
              rel="noopener noreferrer"
              >Pós Graduação e Pesquisa</a
            >&nbsp;|&nbsp;<a
              href="http://www.pr3.ufrj.br"
              target="_blank"
              rel="noopener noreferrer"
              >Planejamento, Desenvolvimento</a
            >&nbsp;|&nbsp;<a
              href="http://www.pr4.ufrj.br/"
              target="_blank"
              rel="noopener noreferrer"
              >Pessoal&nbsp;</a
            >|&nbsp;<a
              href="http://www.pr6.ufrj.br"
              target="_blank"
              rel="noopener noreferrer"
              >Gestão e Governança</a
            >&nbsp;|
            <a href="http://politicasestudantis.ufrj.br" target="_blank"
              >Políticas Estudantis</a
            >
            |<a
              href="http://www.pr6.ufrj.br/"
              target="_blank"
              rel="noopener noreferrer"
            ></a
            ><a
              href="http://www.prefeitura.ufrj.br"
              target="_blank"
              rel="noopener noreferrer"
              >Prefeitura</a
            ></span
          >
        </p>
        <p style="text-align: center">
          <span style="font-size: 10pt"
            >Praça Jorge Machado Moreira, s/nº, Cidade Universitária, Rio de
            Janeiro, RJ - CEP 21941-592</span
          >
        </p>
        <p style="text-align: center">
          <span style="font-size: 10pt"
            >Tel. (21) 3938-0482 / (21) 3938-0494 / (21) 3938-0617 -
            E-mail:&nbsp;<a
              href="mailto:gabinetepr5@pr5.ufrj.br"
              target="_blank"
              rel="noopener noreferrer"
              >gabinetepr5@pr5.ufrj.br</a
            ></span
          >
        </p>
      </div>

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
    return {
      links: [
        { label: "Cursos", hash: "/cursos" },
        { label: "Eventos", hash: "/eventos" },
        // { label: "Projetos", hash: "/acoes" },
        { label: "Atividades e Serviços", hash: "/acoes" },
        { label: "Vagas de Extensão", hash: "/vagas" },
        { label: "Todas as Ações", hash: "/acoes" },
        { label: "Divulge sua Ação", hash: "/divulga" },
      ],
      search: "",
    };
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

.btn{
  text-shadow: 3px 3px 6px #00000030
}

</style>
