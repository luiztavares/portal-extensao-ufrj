<template>
  <q-card class="mycard zoom radius16">
    <router-link
      v-ripple
      class="cursor-pointer nounderline relative-position"
      :to="{
        name: 'acaoChildren',
        params: {
          // acao: 'ACAO LINK',
          id: data.id
        },
      }"
    >
      <div
        id="cardimagebg"
        style="border-top-left-radius: 16px; border-top-right-radius: 16px"
      >
        <q-img
          ratio="1"
          fit="contain"
          loading="lazy"
          :src="data.image"
          style="border-top-left-radius: 16px; border-top-right-radius: 16px"
        >
        </q-img>
      </div>

      <!-- <q-img ratio="1" fit="contain" loading="lazy" :src="data.image"> </q-img> -->
      <q-card-section vertical>
        <div class="card-header text-h5 text-black q-pb-sm">
          {{ data.titulo }}
        </div>

        <q-chip
          color="primary"
          outline
          :icon="tipoToIcon(data.tipo)"
          v-if="data.tipo"
          :label="data.tipo"
        ></q-chip>
        <q-chip
          v-if="data.modalidade"
          color="pink"
          outline
          :label="data.modalidade"
          :icon="data.modalidade == 'Online' ? 'public' : 'location_city'"
        ></q-chip>
        <q-chip
          v-if="data.dtRealizacaoInicio"
          color="green"
          outline
          :label="
            'Realização de ' +
            data.dtRealizacaoInicio +
            ' até ' +
            data.dtRealizacaoFim
          "
          icon="event"
        ></q-chip>
        <q-chip
          color="purple"
          outline
          icon="edit_note"
          v-if="data.dtInscricaoInicio"
          :label="
            'Inscricão de ' +
            data.dtInscricaoInicio.substring(0, 10) +
            ' até ' +
            data.dtInscricaoFim.substring(0, 10)
          "
        ></q-chip>

        <q-chip
          class="mychip"
          v-for="item in data.tags"
          :color="item.color"
          :icon="item.icon"
          outline
          :key="item.label"
          ><span class="mychipcontent">{{ item.label }}</span></q-chip
        >
      </q-card-section>
    </router-link>
  </q-card>
</template>

<script setup>
import { toRefs } from 'vue';
import { tipoToIcon } from 'stores/store.ts';

const props = defineProps({
  data: Object,
});

const { data } = toRefs(props);
</script>

<style scoped>
.mycard {
  width: 350px;
  height: 100%;
}

@media screen  and (max-width: 400px) {
  .mycard {
    width: 300px;
    height: 100%;
  }
}

.nounderline {
  text-decoration: none;
}

.mychip {
  height: auto;
}

.mychipcontent {
  white-space: break-spaces;
}

.zoom {
  transition: transform 0.2s; /* Animation */
}

.zoom:hover {
  transform: scale(
    1.05
  ); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
}

.card-header {
  font-size: 20px;
  line-height: 1.1;
}

#cardimagebg {
  background: linear-gradient(
      217deg,
      rgba(255, 0, 0, 0.3),
      rgba(255, 0, 0, 0) 70.71%
    ),
    linear-gradient(127deg, rgba(0, 255, 0, 0.3), rgba(0, 255, 0, 0) 70.71%),
    linear-gradient(336deg, rgba(0, 0, 255, 0.3), rgba(0, 0, 255, 0) 70.71%);
}
</style>
