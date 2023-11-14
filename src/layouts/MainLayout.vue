<template>
  <q-layout view="hHh lPr fff">
    <MyHeader></MyHeader>
    <q-page-container>
      <router-view />
    </q-page-container>
    <MyFooter></MyFooter>
  </q-layout>
</template>

<script setup lang="ts">
import MyHeader from 'src/components/MyHeader.vue';
import MyFooter from 'src/components/MyFooter.vue';
</script>
