<template>
  <q-page-container class="">
    <q-page class="q-px-xs-xl q-px-sm-xl">
      <div class="row justify-center">
        <q-btn
          @click="scrollToElement('extensao')"
          class="col-5 q-mr-sm"
          color="red"
          label="O que é extensão"
        ></q-btn>

        <q-btn
        @click="scrollToElement('portal')"
          class="col-5"
          color="blue"
          label="O Portal da Extensão UFRJ"
        ></q-btn>

        <q-btn
        @click="scrollToElement('encontra')"
          class="q-mt-sm q-mr-sm col-5"
          color="purple"
          label="O que você encontra no Portal?"
        ></q-btn>

        <q-btn
        @click="scrollToElement('fiquepordentro')"
          class="q-mt-sm col-5"
          color="orange"
          label="Fique por dentro"
        ></q-btn>
      </div>
      <div  class="row q-py-xl justify-center">
        <q-img id="extensao" class="col-sm-12 col-md-10" src="images/oqueeh.png"></q-img>
      </div>
      <div class="row justify-end q-px-md-xl">
        <div class="col-md-9 col-xs-12 text-right">
          <q-separator class="q-mb-md" />
          <span class="text1 text-shadow-black"
            >A extensão conecta a universidade com todos os demais setores da
            sociedade.<br> São ações realizadas pela comunidade acadêmica em
            parceria e em diálogo com grupos sociais e territórios sem vínculo
            institucional com a Universidade.
          </span>
          <q-separator class="q-my-md" />
        </div>
      </div>
      <div class="text2 row q-px-md-xl">
        <div class="col-md-4 q-px-md-md">
          <p>
            <span style="color: magenta">>></span>
            <span class="text-bold"
              >Para quem não estuda nem trabalha na UFRJ,
            </span>
            a extensão oferece gratuitamente cursos, eventos, projetos,
            programas, atividades, serviços e produtos em diferentes áreas do
            conhecimento como saúde, cultura, meio ambiente, ciência e
            tecnologia.
          </p>
        </div>
        <div class="col-md-4  q-px-md-md">
          <p>
            <span style="color: magenta">>></span>
            <span class="text-bold">Para os estudantes da UFRJ, </span> a
            extensão contribui para sua formação humanista articulando os
            processos de desenvolvimento científico, tecnológico e cultural com
            práticas cidadãs.
          </p>
        </div>
        <div class="col-md-4  q-px-md-md">
          <p>
            <span style="color: magenta">>></span>
            <span class="text-bold"
              >Para professores e técnicos-administrativos da UFRJ,
            </span>
            a extensão é a dimensão da universidade que permite trocas com um
            público mais amplo, promovendo o desenvolvimento pessoal e
            profissional, bem como mantendo a produção acadêmica e a instituição
            atualizadas com as questões mais relevantes para a sociedade.
          </p>
        </div>
      </div>
    </q-page>

    <q-page id="portal" class="">
      <q-img class="col-sm-12 col-md-10" src="images/sobre-portal.png"></q-img>
      <div class="row justify-end">
        <div class="col-md-7 justify-end  col-sm-10 text-right">
          <p class="header2 text-bold text-h1 q-py-md">O PORTAL DA EXTENSÃO</p>
          <span class="text3 text-shadow-black"
            >Criado pela
            <span style="text-decoration: underline"
              >Pró-Reitoria de Extensão da UFRJ,</span
            >
            o Portal da Extensão é o principal canal de divulgação das ações de
            extensão da Universidade Federal do Rio de Janeiro, para a
            população, em geral, e para a sua própria comunidade acadêmica.
          </span>
        </div>
        <div class="col-1"></div>
      </div>

      <div class="text2 row q-px-md-xl q-py-xl ">
        <div class="col-md-6 col-sm-12 q-px-xl q-md-md text-justify">
          <p>
            O objetivo é facilitar a busca e o acesso às mais de 1500 ações de
            extensão oferecidas pela nossa universidade. No Portal, é possível
            encontrar filtros de busca por data, modalidade (presencial,
            semi-presencial ou virtual), categoria (cursos, eventos, vagas de
            extensão, bem como atividades, serviços e produtos), entre outros.
          </p>
        </div>
        <div class="col-md-6 col-sm-12 q-px-xl q-md-md text-justify">
          <p>
            Na seção de Vagas de Extensão, os alunos da UFRJ podem consultar
            quais ações estão com vagas abertas para atuação como extensionistas
            e as informações sobre os requisitos necessários para preenchê-las.
          </p>
        </div>
        <div class="col-md-6 col-sm-12 q-px-xl q-md-md text-justify">
          <p>
            Através do Portal, os coordenadores de ações de extensão podem
            solicitar a divulgação de suas ações e agendar a transmissão de
            atividades ao vivo no canal da Extensão UFRJ (YouTube).
          </p>
        </div>
        <div class="col-md-6 col-sm-12 q-px-xl q-md-md text-justify q-py-md-xl">
          <p>
            Ao lado das atividades de ensino e pesquisa, a extensão é um dos
            três pilares da rotina universitária. A extensão é uma porta aberta
            para a participação de todos e vai além dos muros da universidade!
          </p>
        </div>
      </div>
    </q-page>

    <q-page id="encontra" class="">
      <p class="header3 text-bold text-h1 q-py-md q-px-xl">
        O que você encontra no Portal?
      </p>
      <q-img class="col-sm-12 col-md-10" src="images/oqueencontra.png"></q-img>

      <div class="text2 row q-px-xl q-py-xl">
        <div class="col-md-6 col-sm-10 q-pb-md-xl q-px-md-xl">
          <p>
            <span style="color: magenta">>></span>
            <span class="text-bold"
              ><router-link to="/cursos">Cursos</router-link> </span
            ><br />Um curso de extensão é uma ação pedagógica teórica e/ou
            prática, com carga horária mínima de 8 horas, critérios de avaliação
            definidos e que é aberta à participação de pessoas sem vínculo
            institucional com a universidade. No Portal da Extensão, você
            encontra cursos presenciais ou à distância para frequentar
            gratuitamente e obter certificação ao final.
          </p>
        </div>
        <div class="col-md-6 col-sm-10 q-pb-md-xl q-px-md-xl">
          <p>
            <span style="color: magenta">>></span>
            <span class="text-bold"
              ><router-link to="/eventos">Eventos</router-link></span
            ><br />O evento de extensão é uma ação que promove apresentação e/ou
            exibição pública, livre ou com público específico, do conhecimento
            ou produto cultural, artístico, esportivo, científico e tecnológico
            desenvolvido, conservado ou reconhecido pela universidade. No Portal
            da Extensão, você encontra eventos gratuitos para criar novas
            conexões com pessoas e ideias.
          </p>
        </div>
        <div class="col-md-6 col-sm-10 q-pb-md-xl q-px-md-xl">
          <p>
            <span style="color: magenta">>></span>
            <span class="text-bold"
              ><router-link to="/cursos">Projetos</router-link></span
            ><br />Os projetos de extensão são ações promovidas pela comunidade
            acadêmica, de caráter educativo, social, cultural, científico ou
            tecnológico, que promovem a interação dialógica a partir do trabalho
            com grupos sociais e/ou territórios sem vínculo institucional com a
            universidade.
          </p>
        </div>
        <div class="col-md-6 col-sm-10 q-pb-md-xl q-px-md-xl">
          <p>
            <span style="color: magenta">>></span>
            <span class="text-bold"
              ><router-link to="/cursos">Programas</router-link></span
            ><br />Os programas articulam pelo menos três ações de extensão,
            sendo pelo menos dois projetos, com objetivos comuns ou correlatos,
            propiciando a integração de ações interdisciplinares, com
            participação de professores, alunos e técnicos de diversas unidades
            e centros da UFRJ.
          </p>
        </div>
        <div class="col-md-6 col-sm-10 q-pb-md-xl q-px-md-xl">
          <p>
            <span style="color: magenta">>></span>
            <span class="text-bold"
              ><router-link to="/atividades-e-servicos"
                >Atividades, Serviços e Produtos</router-link
              ></span
            ><br />As atividades, serviços e produtos resultantes ou associados
            a uma ação de extensão são desenvolvidos no diálogo entre a
            comunidade acadêmica e outros setores da sociedade e oferecidos para
            toda a população. Nesta seção, você descobre palestras,
            consultorias, livros e outras oportunidades e materiais gratuitos,
            de todas as áreas de conhecimento e para todos os públicos.
          </p>
        </div>
        <div class="col-md-6 col-sm-10 q-pb-md-xl q-px-md-xl">
          <p>
            <span style="color: magenta">>></span>
            <span class="text-bold"
              ><router-link to="/vagas">Vagas de extensão</router-link></span
            ><br />As vagas de extensão são oportunidades para estudantes da UFRJ atuarem na equipe de uma ação de extensão, contribuindo para o desenvolvimento das atividades e recebendo creditação de horas (somente estudantes da graduação) e/ou certificado de participação.
          </p>
        </div>
      </div>
      <p class="header2 text-bold text-h1 q-py-md q-px-xl">
        Veja aqui o Guia da Extensão para alunos da UFRJ
      </p>
      <a
        href="https://extensão.ufrj.br/images/GUIA_COMPLETO_-_revisado_28-04-2022.pdf"
        target="_blank"
        ><q-img class="col-sm-12 col-md-10" src="images/guia.png"></q-img
      ></a>

      <div class="row justify-center q-pt-md">
        <div class="col-8">
          <a href="https://www.youtube.com/watch?v=pucam0lCHzI" target="_blank">
            <q-img src="images/tutorial.png"></q-img>
          </a>
        </div>
      </div>
    </q-page>

    <q-page id="fiquepordentro" class="">

        <p class="header3 text-bold text-h1 q-pt-xl q-mt-xl q-px-xl">
        Fique por dentro
      </p>
      <div  class="row q-px-xl">
        <div  class="col q-pr-md">
          <q-img  src="images/sobre-comunica.png"></q-img>
          <p class="text4 text-bold q-pt-sm">
            Conheça a Newsletter Comunica Extensão
          </p>
          <p class="text2">
            A Comunica Extensão é uma newsletter mensal, produzida pela
            Pró-Reitoria de Extensão da UFRJ, que reúne os principais informes,
            chamadas-públicas, eventos e notícias da nossa universidade e que
            envolvem toda a comunidade extensionista.
          </p>
        </div>
        <div class="col q-pl-md">
          <q-img src="images/sobre-podcast.png"></q-img>
          <p class="text4 text-bold q-pt-sm">
            Conheça o Comunica Extensão Podcast
          </p>
          <p class="text2">
            O podcast Comunica Extensão é um programa da Pró-Reitoria de
            Extensão da UFRJ, em parceria com a Rádio UFRJ, que te ajuda a
            acompanhar as ações extensionistas da universidade. Você encontra
            novidades e entrevistas que promovem debates entre a Extensão e o
            Estado do Rio de Janeiro, com todo o seu circuito cultural,
            formativo e econômico.
          </p>
        </div>
      </div>
      <p class="header3 text-bold text-h1 q-pt-xl q-mt-xl q-px-xl">
        Veja aqui os nossos canais
      </p>
      <div class="row bg-cyan">
        <div class="col-6 q-px-xl q-py-md" v-for="icone in icones" :key="icone">
          <a target="_blank" :href="icone.url"><q-img height="120px" fit="contain" :src="icone.name"></q-img></a>
        </div>
      </div>
    </q-page>

    <q-page-scroller
      position="bottom-right"
      :scroll-offset="150"
      :offset="[18, 18]"
    >
      <q-btn fab icon="keyboard_arrow_up" color="accent" />
    </q-page-scroller>
  </q-page-container>
</template>

<script>
import { defineComponent } from "vue";
import "@quasar/extras/fontawesome-v5";
import { scroll } from "quasar";
const { getScrollTarget, setVerticalScrollPosition } = scroll;

import { useQuasar } from "quasar";

export default defineComponent({
  components: {},
  name: "Sobre",
  setup() {
    const $q = useQuasar();
  },
  data: function () {
    return {
      icones: [
        {name:"icons/icone facebook.png", url:'https://www.facebook.com/pr5ufrj/'},
        {name:"icons/icone spotfy.png",url:'https://open.spotify.com/show/7jz62j6uNvF6Fgcl7QfzGy?si=9a087323cea7487b'},
        {name:"icons/icone YT.png",url:'https://www.youtube.com/c/ExtensãoUFRJ'},
        {name:"icons/icone Twitter.png",url:'https://twitter.com/extensaoUFRJ'},
        {name:"icons/icone Instagram.png",url:'https://www.instagram.com/extensaoufrj/'},
        {name:"icons/icone Telegram.png",url:'https://t.me/extensaoufrj'},
        {name:"icons/icone WhatsApp.png",url:'https://chat.whatsapp.com/KOracPaKKuv2vEVJcItnbG'},
      ],
    };
  },
  created() {
    this.windowHeight = window.innerHeight + "px";
  },
  methods: {
    scrollToElement(id) {
      const ele = document.getElementById(id); // You need to get your element here
      console.log(id)
      const target = getScrollTarget(ele);
      const offset = ele.offsetTop -80;
      const duration = 500;
      setVerticalScrollPosition(target, offset, duration);
    },
  },
  computed: {},
  mounted() {},
});
</script>

<style scoped>
  .text1 {
    font-size: 4vw;
    line-height: 4vw;
    font-family: Arial, Helvetica, sans-serif;
    color: #f011a5;
  }

  .text2 {
    font-size: 1.9vw;
  }

  .header2 {
    font-size: 5vw;
    line-height: 5vw;
    color: #351c75;
  }

  .text3 {
    font-size: 3vw;
    line-height: 3vw;
    color: #351c75;
  }

  .text4 {
    font-size: 3vw;
    line-height: 3vw;
  }

  .header3 {
    font-size: 5vw;
    line-height: 5vw;
    color: #999999;
  }

@media screen and (max-width: 601px) {
.text1 {
  font-size: 5vw;
  line-height: 5vw;
  font-family: Arial, Helvetica, sans-serif;
  color: #f011a5;
}

.text2 {
  font-size: 2.5vw;
}

.header2 {
  font-size: 5vw;
  line-height: 5vw;
  color: #351c75;
}

.text3 {
  font-size: 3vw;
  line-height: 3vw;
  color: #351c75;
}

.text4 {
  font-size: 3vw;
  line-height: 3vw;
}

.header3 {
  font-size: 5vw;
  line-height: 5vw;
  color: #999999;
}
}


.q-carousel {
  min-height: inherit;
  min-width: inherit;
}

.rounded-borders {
  border-radius: 5%;
}

.my-card {
  min-width: 400px;
  min-height: 400px;
  max-width: 400px;
}

.text-shadow-black {
  text-shadow: 1px 1px 1px gray;
}

.slideimage {
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center;
  background-color: white;
}

.toback {
  z-index: 10;
}
</style>
