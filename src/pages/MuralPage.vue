<template>
  <q-page class="maxwidth q-px-md row q-pt-xl"> mural da acao </q-page>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import { useAcoes } from 'src/stores/store';
import MyCard from 'src/components/MyCard.vue';

const acoesStore = useAcoes();
acoesStore.getAcoes();
acoesStore.getMaisAcoes();
acoesStore.getVagas();

const flagCategoria = ref(true);
const flagInscricao = ref(true);
const flagModalidade = ref(true);
</script>

<style>
.q-item__label--caption {
  color: aliceblue !important;
}
</style>
