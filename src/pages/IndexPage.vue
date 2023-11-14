<template>
  <q-page>
    <MyCarousel></MyCarousel>
  </q-page>
  <q-page class="maxwidth q-px-md">
    <HomeFeatured></HomeFeatured>

    <div class="row q-py-xl justify-center">
      <q-img
        id="extensao"
        class="col-sm-12 col-md-10"
        src="images/oqueeh.png"
      ></q-img>
    </div>
    <div class="row justify-start reverse">
      <div class="col-md-12 col-xs-12 text-justify">
        <q-separator class="q-mb-md" />
        <span class="text1 text-shadow-black withouthhifens"
          >A extensão conecta a universidade com todos os demais setores da
          sociedade. São ações realizadas pela comunidade acadêmica em parceria
          e em diálogo com grupos sociais e territórios sem vínculo
          institucional com a Universidade.
        </span>
        <q-separator class="q-my-md" />
      </div>
    </div>
    <div class="text2 row q-py-md">
      <div class="col-md-4 q-pa-md row">
        <div class="q-pa-md shadow-2 radius16 column">
          <p class="text-justify col">
            <span style="color: magenta">>></span>
            <span class="text-bold">
              Para quem não estuda e nem trabalha na UFRJ,
            </span>
            a extensão oferece gratuitamente cursos, eventos, projetos,
            programas, atividades, serviços e produtos em diferentes áreas do
            conhecimento como saúde, cultura, meio ambiente, ciência e
            tecnologia.
          </p>
          <q-btn
            rounded
            color="primary"
            label="Oportunidades para externos"
            to="/pesquisa"
          ></q-btn>
        </div>
      </div>

      <div class="col-md-4 q-pa-md row">
        <div class="q-pa-md shadow-2 radius16 column">
          <p class="text-justify col">
            <span style="color: magenta">>></span>
            <span class="text-bold"> Para os estudantes da UFRJ, </span> a
            extensão contribui para sua formação humanista articulando os
            processos de desenvolvimento científico, tecnológico e cultural com
            práticas cidadãs.
          </p>
          <q-btn
            rounded
            color="purple"
            label="Oportunidades para estudantes da ufrj"
            to="/pesquisa"
          ></q-btn>
        </div>
      </div>

      <div class="col-md-4 q-pa-md row">
        <div class="q-pa-md shadow-2 radius16 column">
          <p class="text-justify col">
            <span style="color: magenta">>></span>
            <span class="text-bold">
              Para professores e técnicos-administrativos da UFRJ,
            </span>
            a extensão é a dimensão da universidade que permite trocas com um
            público mais amplo, promovendo o desenvolvimento pessoal e
            profissional, bem como mantendo a produção acadêmica e a instituição
            atualizadas com as questões mais relevantes para a sociedade.
          </p>
          <q-btn
            rounded
            color="teal"
            label="Divulgue suas acões"
            to="/divulga"
          ></q-btn>
        </div>
      </div>
    </div>
  </q-page>
  <q-page id="fiquepordentro" class="">
    <div class="q-px-md max1440">
      <p class="header3 text-bold text-h1 q-pt-xl q-px-md-xl">
        Fique por dentro
      </p>
      <div class="row q-px-md-xl">
        <div class="col-md-6 col-sm-12 q-pr-md text-center">
          <q-img
            class="radius16"
            src="images/sobre-comunica.png"
            max-width="500px"
          ></q-img>
          <p class="text4 text-bold q-pt-sm">
            Conheça a Newsletter Comunica Extensão
          </p>
          <p class="text2 text-center">
            A Comunica Extensão é uma newsletter mensal, produzida pela
            Pró-Reitoria de Extensão da UFRJ, que reúne os principais informes,
            chamadas-públicas, eventos e notícias da nossa universidade e que
            envolvem toda a comunidade extensionista.
          </p>
        </div>
        <div class="col-md-6 col-sm-12 q-pl-md text-center">
          <q-img
            class="radius16"
            src="images/sobre-podcast.png"
            max-width="500px"
          ></q-img>
          <p class="text4 text-bold q-pt-sm">
            Conheça o Comunica Extensão Podcast
          </p>
          <p class="text2 text-center">
            O podcast Comunica Extensão é um programa da Pró-Reitoria de
            Extensão da UFRJ, em parceria com a Rádio UFRJ, que te ajuda a
            acompanhar as ações extensionistas da universidade. Você encontra
            novidades e entrevistas que promovem debates entre a Extensão e o
            estado do Rio de Janeiro, com todo o seu circuito cultural,
            formativo e econômico.
          </p>
        </div>
      </div>
      <p class="header3 text-bold text-h1 q-pt-xl q-mt-xl q-px-md-xl">
        Veja aqui os nossos canais
      </p>
    </div>

    <div class="bg-cyan">
      <div class="row q-pa-xl q-px-xs-md maxwidth">
        <div class="col-6 q-py-md" v-for="icone in icones" :key="icone">
          <a target="_blank" :href="icone.url"
            ><q-img height="100px" fit="contain" :src="icone.name"></q-img
          ></a>
        </div>
      </div>
    </div>
    <div class="maxwidth">
      <h3 class="text-center q-py-xl">Pró-Reitorias</h3>
      <div class="row justify-center text-center" style="max-width: inherit">
        <div class="col-3 q-py-xl" v-for="item in prs" :key="item.label">
          <q-btn
            size="30px"
            round
            color="purple"
            target="blank"
            :href="item.link"
            glossy
            ><span>{{ item.label }}</span></q-btn
          >
          <p class="q-py-md text2">
            <a :href="item.link" target="_blank">{{ item.name }}</a>
          </p>
        </div>
      </div>
    </div>
  </q-page>
</template>

<script setup lang="ts">
import MyCarousel from 'src/components/MyCarousel.vue';
import HomeFeatured from 'src/components/HomeFeatured.vue';
import { ref } from 'vue';

const icones = ref([
  {
    name: 'icons/icone facebook.png',
    url: 'https://www.facebook.com/pr5ufrj/',
  },
  {
    name: 'icons/icone spotfy.png',
    url: 'https://open.spotify.com/show/7jz62j6uNvF6Fgcl7QfzGy?si=9a087323cea7487b',
  },
  { name: 'icons/icone YT.png', url: 'https://www.youtube.com/c/ExtensãoUFRJ' },
  { name: 'icons/icone Twitter.png', url: 'https://twitter.com/extensaoUFRJ' },
  {
    name: 'icons/icone Instagram.png',
    url: 'https://www.instagram.com/extensaoufrj/',
  },
  { name: 'icons/icone Telegram.png', url: 'https://t.me/extensaoufrj' },
  {
    name: 'icons/icone WhatsApp.png',
    url: 'https://chat.whatsapp.com/KOracPaKKuv2vEVJcItnbG',
  },
]);
const prs = ref([
  {
    label: 'PR1',
    name: 'Graduação',
    link: 'https://xn--graduao-2wa9a.ufrj.br/',
  },
  {
    label: 'PR2',
    name: 'Pós-Graduação e Pesquisa',
    link: 'http://pr2.ufrj.br/',
  },
  {
    label: 'PR3',
    name: 'Planejamento, Desenvolvimento e Finanças',
    link: 'https://planejamento.ufrj.br/',
  },
  {
    label: 'PR4',
    name: 'Pessoal',
    link: 'https://pessoal.ufrj.br/',
  },
  {
    label: 'PR5',
    name: 'Extensão',
    link: 'https://xn--extenso-2wa.ufrj.br/',
  },
  {
    label: 'PR6',
    name: 'Gestão e Governança',
    link: 'https://xn--gesto-dra.ufrj.br/',
  },
  {
    label: 'PR7',
    name: 'Políticas Estudantis',
    link: 'https://xn--polticasestudantis-jyb.ufrj.br/',
  },
]);
</script>

<style scoped>
.text1 {
  font-size: 48px;
  line-height: 48px;
  font-family: Arial, Helvetica, sans-serif;
  color: #f011a5;
}

.text2 {
  font-size: 20px;
}

.text4 {
  font-size: 30px;
  line-height: 30px;
}

.header3 {
  font-size: 40px;
  line-height: 40px;
  color: #999999;
}

@media screen and (max-width: 601px) {
  .text1 {
    font-size: 6vw;
    line-height: 6vw;
    font-family: Arial, Helvetica, sans-serif;
    color: #f011a5;
  }

  .text2 {
    font-size: 4.2vw;
  }

  .text4 {
    font-size: 4.5vw;
    line-height: 4.5vw;
  }

  .header3 {
    font-size: 6vw;
    line-height: 6vw;
    color: #999999;
  }
}

.text-shadow-black {
  text-shadow: 1px 1px 1px gray;
}

.max1440 {
  max-width: 1440px;
  margin: auto;
}

.withouthhifens {
  hyphens: none;
}
</style>
