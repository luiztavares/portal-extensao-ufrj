<template>
  <q-menu touch-position context-menu>

    <q-list dense style="min-width: 100px">
      <q-item clickable v-close-popup @click="openURL(getURL())">
        <q-item-section>Abrir em nova aba</q-item-section>
      </q-item>
      <q-item clickable v-close-popup
        @click="copyToClipboard(getURL())
          .then(() => $q.notify({message: 'Link Copiado!', type: 'positive'}))
          .catch(() => $q.notify({message: 'Erro ao copiar link!', type: 'negative'}))"
      >
        <q-item-section>Copiar link</q-item-section>
      </q-item>
    </q-list>

  </q-menu>
</template>

<script setup>
  import { useRouter } from 'vue-router';
  import { useQuasar, openURL, copyToClipboard } from 'quasar'
  const router = useRouter();
  const props = defineProps(['page_name']);
  const $q = useQuasar()

  function getURL() {
    const route = router.resolve({ name: props.page_name });
    return new URL(route.href, window.location.origin).href;
  }
</script>
