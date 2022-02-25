<template>
  <div>
    <q-page class="hero">
      <q-carousel
        v-model="slide"
        transition-prev="jump-right"
        transition-next="jump-left"
        swipeable
        animated
        control-color="white"
        prev-icon="arrow_left"
        next-icon="arrow_right"
        navigation-icon="radio_button_unchecked"
        navigation
        padding
        arrows
        class="bg-purple shadow-1"
      >
        <q-carousel-slide name="style" class="row no-wrap">
          <div class="col-7 column justify-center">
            <p class="col-3 text-h1 text-white">Última Newsletter</p>
            <p class="col-2 text-h4 text-white q-pa-md">
              Acesse nossa newsletter e fique por dentro de tudo que aconteceu
              no mês
            </p>
            <q-btn
              flat
              class="col-1"
              label="Inscreva-se Aqui"
              color="green"
            ></q-btn>
          </div>
          <q-img
            id="comunica-img"
            class="col-5 rounded-borders"
            src="images/comunica-01-2022.png"
            fit="fill"
          >
          </q-img>
        </q-carousel-slide>
        <q-carousel-slide name="tv" class="column no-wrap flex-center">
          <q-icon name="live_tv" />
          <div class="q-mt-md text-center">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit
          </div>
        </q-carousel-slide>
      </q-carousel>
    </q-page>

    <q-page class="column q-pa-xl">
      <span class="col-1 text-h2">Ações em Destaque</span>
      <div class="col row q-pa-xl items-center">
        <div class="col" v-for="acao in acoes" :key="acao">
          <div>
            <q-tooltip class="text-h4 q-pa-xl q-ma-xl">
              Cursos para complementar sua formação acadêmica e cidadã O Curso
              de Extensão é responsável por garantir uma formação livre em um
              determinado tema e é oferecido tanto para o público externo,
              quanto para a universidade. Um Curso pode ser presencial ou à
              distância, teórico ou prático e ter a duração de semanas ou meses,
              a depender de cada coordenação.
            </q-tooltip>
            <q-chip
              square
              :color="acao.cor"
              text-color="white"
              icon="alarm"
              :label="acao.modalidade"
            />
          </div>
          <q-card flat class="my-card" :style="'border-color: ' + acao.cor">
            <img src="https://cdn.quasar.dev/img/mountains.jpg" />

            <q-card-section>
              <div class="text-h6">{{ acao.titulo }}</div>
              <div class="text-subtitle2">{{ acao.coordenador }}</div>
            </q-card-section>

            <q-card-section class="q-pt-none">
              {{ acao.descricao }}
            </q-card-section>
          </q-card>
        </div>
      </div>
      <q-btn class="col-1" label="Veja todas as ações"></q-btn>
    </q-page>

    <q-page class="column bg-yellow q-pa-xl">
      <span class="col-1 text-h2">Vagas em Destaque</span>
      <div class="col row q-pa-xl items-center">
        <div class="col" v-for="acao in acoes" :key="acao">
          <q-card
            flat
            vertical
            class="my-card"
            :style="'border-color: ' + acao.cor"
          >
            <img src="https://cdn.quasar.dev/img/mountains.jpg" />

            <q-card-section>
              <div class="text-h6">{{ acao.titulo }}</div>
              <div class="text-subtitle2">{{ acao.coordenador }}</div>
            </q-card-section>

            <q-card-section class="q-pt-none">
              {{ acao.descricao }}
            </q-card-section>
          </q-card>
        </div>
      </div>
      <q-btn class="col-1" label="Veja todas as vagas"></q-btn>
    </q-page>

    <q-page class="column bg-green q-pa-xl">
      <span class="col-1 text-h2">Lives em Destaque</span>
      <q-tabs class="col-1">
        <q-tab>Ao vivo</q-tab>
        <q-tab>Próximas</q-tab>
        <q-tab>Passadas</q-tab>
      </q-tabs>
      <div class="col row q-pa-xl items-center">
        <div class="col" v-for="acao in acoes" :key="acao">
          <q-card
            flat
            vertical
            class="my-card"
            :style="'border-color: ' + acao.cor"
          >
            <iframe
              width="400"
              height="315"
              src="https://www.youtube.com/embed/Xz3bMCj6BFI"
              title="YouTube video player"
              frameborder="0"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
              allowfullscreen
            ></iframe>

            <q-card-section>
              <div class="text-h6">{{ acao.titulo }}</div>
              <div class="text-subtitle2">{{ acao.coordenador }}</div>
            </q-card-section>

            <q-card-section class="q-pt-none">
              {{ acao.descricao }}
            </q-card-section>
          </q-card>
        </div>
      </div>
      <q-btn class="col-1" label="Veja todas as Lives"></q-btn>
    </q-page>
  </div>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
  name: "PageIndex",
  data: function () {
    return {
      slide: "style",
      acoes: [
        {
          titulo: "América Latina Póscolonial: estudos de caso.",
          coordenador: "CARLOS EDUARDO REBELLO DE MENDONCA",
          modalidade: "Curso",
          cor: "red",
          descricao:
            "Trata-se de curso onde a história política, social e econômica recente da América Latina será discutida a partir dos enfoques trazidos pela perspectiva dos estudos pós-coloniais e subalternistas, através da leitura de alguns clássicos e da literatura recente sobre alguns casos nacionais mais relevantes",
        },
        {
          titulo: "América Latina Póscolonial: estudos de caso.",
          coordenador: "CARLOS EDUARDO REBELLO DE MENDONCA",
          modalidade: "Evento",
          cor: "green",

          descricao:
            "Trata-se de curso onde a história política, social e econômica recente da América Latina será discutida a partir dos enfoques trazidos pela perspectiva dos estudos pós-coloniais e subalternistas, através da leitura de alguns clássicos e da literatura recente sobre alguns casos nacionais mais relevantes",
        },
        {
          titulo: "América Latina Póscolonial: estudos de caso.",
          coordenador: "CARLOS EDUARDO REBELLO DE MENDONCA",
          modalidade: "Projeto",
          cor: "blue",

          descricao:
            "Trata-se de curso onde a história política, social e econômica recente da América Latina será discutida a partir dos enfoques trazidos pela perspectiva dos estudos pós-coloniais e subalternistas, através da leitura de alguns clássicos e da literatura recente sobre alguns casos nacionais mais relevantes",
        },
      ],
    };
  },
});
</script>

<style scoped>
.hero {
  background-size: 100% 100%;
}

.q-carousel {
  min-height: inherit;
  min-width: inherit;
}

.rounded-borders {
  border-radius: 5%;
}

.my-card {
  width: 100%;
  max-width: 400px;
  border-style: outset;
}
</style>
