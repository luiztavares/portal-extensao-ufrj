<template>
  <q-carousel
    autoplay
    infinite
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
    id="mycarousel"
  >
    <q-carousel-slide
      name="info"
      class="slideimage column reverse"
      img-src="images/Galera 2560x1080.png"
    >
      <q-img
        class="q-mb-xl maxwidth"
        position="0% 50%"
        fit="contain"
        height="40vh"
        src="images/Galera - Texto.svg"
      >
      </q-img>
    </q-carousel-slide>
    <q-carousel-slide
      name="newsletter"
      img-src="images/news1.png"
      class="row items-center no-wrap slideimage"
    >
      <q-img
        class="col maxwidth"
        height="50vh"
        position="50% 50%"
        fit="contain"
        src="images/news4.svg"
      >
      </q-img>

      <div class="q-ma-xl custom-caption absolute-bottom-right">
        <q-btn
          color="purple"
          label="Leia"
          href="https://xn--extenso-2wa.ufrj.br/index.php/80-comunica-extensao/399-comunica-ufrj"
          target="_blank"
        >
        </q-btn>
        <q-btn
          class="q-ml-xl"
          color="purple"
          label="Assine"
          href="https://mailchi.mp/pr5/assine-a-comunica-extensao"
          target="_blank"
        >
        </q-btn>
      </div>
    </q-carousel-slide>
    <q-carousel-slide
      name="podcast"
      img-src="images/imagempodcast.png"
      class="slideimage column"
    >
      <div>
        <q-img
          class="q-mt-xl"
          position="0% 100%"
          fit="contain"
          height="40vh"
          src="images/textopodcast.svg"
        >
        </q-img>
      </div>

      <div class="q-ma-xl custom-caption absolute-bottom-right">
        <q-btn
          color="purple"
          label="Ouça"
          href="https://spoti.fi/3SxZ6tC"
          target="_blank"
        >
        </q-btn>
      </div>
    </q-carousel-slide>
  </q-carousel>
</template>

<script setup>
import { ref } from 'vue';

const slide = ref('info');
</script>

<style>
#mycarousel {
  min-height: inherit;
}

.q-carousel__arrow .q-icon.notranslate.material-icons {
  font-size: 7rem;
  color: white;
}
</style>
