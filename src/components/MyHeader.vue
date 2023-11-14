<template>
  <q-header elevated class="bg-white">
    <q-toolbar class="q-ma-md">
      <q-toolbar-title
        class="cursor-pointer"
        @click="router.push({ name: 'home' })"
      >
        <q-img
          fit="contain"
          height="50px"
          position="0 0"
          :src="headerSrc"
        ></q-img>
      </q-toolbar-title>
      <div class="gt-sm">
        <q-btn
          round
          color="purple"
          @click="
            acoesStore.limparFiltros();
            router.push({ name: 'pesquisa' });
          "
          glossy
          icon="search"
        />

        <q-btn
          style="border-right: 3px solid magenta"
          color="white"
          text-color="black"
          flat
          v-for="link in links"
          :key="link.label"
          :label="link.label"
          @click="
            acoesStore.limparFiltros();
            acoesStore.filters.tipo.select = [link.option];
            router.push({ name: link.hash });
          "
          class="text-no-wrap btn"
        >
        </q-btn>
      </div>
      <div class="lt-md">
        <q-btn class="q-mr-xl" color="purple" flat round dense icon="menu">
          <q-menu class="bg-purple text-white" auto-close>
            <q-list>
              <q-item
                clickable
                flat
                :key="pesquisa"
                to="/pesquisa"
                class="text-no-wrap btn"
              >
                <q-item-section style="color: white"> Busca </q-item-section>
              </q-item>
              <q-item
                clickable
                flat
                v-for="link in links"
                :key="link.label"
                @click="
                  router.push(link.hash);
                  acoesStore.limparFiltros();
                  acoesStore.filters.tipo.select = [link.option];
                "
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
</template>

<script setup>
import { useAcoes } from 'src/stores/store';
import { ref } from 'vue';
import { useRouter } from 'vue-router';
const router = useRouter();

const acoesStore = useAcoes();

acoesStore.getDados();
const headerSrc = ref('/images/header.png');

const links = ref([
  { label: 'Eventos', hash: 'eventos', option: 'Evento' },
  { label: 'Cursos', hash: 'cursos', option: 'Curso' },
  { label: 'Atividades e Serviços', hash: 'atividades', option: 'Mais ações' },
  { label: 'Vagas de Extensão', hash: 'vagas', option: 'Vaga' },
  { label: 'Todas as Ações', hash: 'acoes', option: '' },
  { label: 'Divulgue sua Ação', hash: 'divulga', option: '' },
]);
</script>
