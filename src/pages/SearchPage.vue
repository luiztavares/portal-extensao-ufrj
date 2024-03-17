<template>
  <q-page class="maxwidth q-px-md row q-pt-md">
    <div v-if="$q.screen.lt.md" class="col-xs-12 col-md-3">
      <q-drawer v-model="drawerLeft" show-if-above :breakpoint="1024" elevated class="">
        <q-list bordered padding class="radius16">
          <div class="row justify-evenly">
            <q-btn class="col-auto" color="purple" icon="filter_alt_off" @click="
      acoesStore.limparFiltros();
    drawerLeft = false;
    ">Limpar Filtros</q-btn>
            <q-btn class="col-auto" color="green" @click="drawerLeft = false"
              icon-right="arrow_right_alt">Filtrar</q-btn>
          </div>
          <div class="q-px-sm text-h5 text-bold row" style="text-shadow: 3px 3px 6px #00000030"></div>
          <q-input class="q-pa-md" v-model="acoesStore.filters.pesquisa.value" rounded outlined type="search"
            label="Pesquise aqui sua ação">
            <template v-slot:append>
              <q-icon name="search" />
            </template>
          </q-input>
          <q-expansion-item expand-separator icon="category" label="Datas"
            caption="Período de realização ou inscrição da ação" header-class="text-white bg-blue"
            expand-icon-class="text-white" v-model="flagInscricao">
            <q-card>
              <q-card-section>
                <q-item v-for="item in acoesStore.filters.inscricoes.options" :key="item.label" v-ripple>
                  <q-item-section side top>
                    <q-checkbox v-model="acoesStore.filters.inscricoes.select" :val="item.value" color="blue" />
                  </q-item-section>
                  <q-item-section>
                    <q-item-label>{{ item.label }}</q-item-label>
                    <q-item-label caption> </q-item-label>
                  </q-item-section>
                </q-item>
              </q-card-section>
            </q-card>
          </q-expansion-item>
          <q-expansion-item expand-separator icon="category" label="Categoria" caption="Tipo da ação ofertada"
            header-class="text-white bg-purple" expand-icon-class="text-white" v-model="flagCategoria">
            <q-card>
              <q-card-section>
                <q-item v-for="item in acoesStore.filters.tipo.options" :key="item.label" v-ripple>
                  <q-item-section side top>
                    <q-checkbox v-model="acoesStore.filters.tipo.select" :val="item.value" color="purple" />
                  </q-item-section>
                  <q-item-section>
                    <q-item-label>{{ item.label }}</q-item-label>
                    <q-item-label caption> </q-item-label>
                  </q-item-section>
                </q-item>
              </q-card-section>
            </q-card>
          </q-expansion-item>
          <q-expansion-item expand-separator icon="category" label="Formato" caption="Formato da ação"
            header-class="text-white bg-teal" expand-icon-class="text-white" v-model="flagModalidade">
            <q-card>
              <q-card-section>
                <q-item v-for="item in acoesStore.filters.modalidade.options" :key="item.label" v-ripple>
                  <q-item-section side top>
                    <q-checkbox v-model="acoesStore.filters.modalidade.select" :val="item.value" color="teal" />
                  </q-item-section>

                  <q-item-section>
                    <q-item-label>{{ item.value }}</q-item-label>
                    <q-item-label caption> </q-item-label>
                  </q-item-section>
                </q-item>
              </q-card-section>
            </q-card>
          </q-expansion-item>
        </q-list>
      </q-drawer>
    </div>
    <div v-if="$q.screen.gt.md || $q.screen.md" class="col-xs-12 col-md-3 q-mt-md">
      <q-list bordered padding class="radius16">
        <q-input class="q-pa-md" v-model="acoesStore.filters.pesquisa.value" rounded outlined type="search"
          label="Pesquise aqui sua ação">
          <template v-slot:append>
            <q-icon name="search" />
          </template>
        </q-input>
        <q-expansion-item expand-separator icon="category" label="Datas"
          caption="Período de realização ou inscrição da ação" header-class="text-white bg-blue"
          expand-icon-class="text-white" v-model="flagInscricao">
          <q-card>
            <q-card-section>
              <q-item v-for="item in acoesStore.filters.inscricoes.options" :key="item.label" v-ripple>
                <q-item-section side top>
                  <q-checkbox v-model="acoesStore.filters.inscricoes.select" :val="item.value" color="blue" />
                </q-item-section>
                <q-item-section>
                  <q-item-label>{{ item.label }}</q-item-label>
                  <q-item-label caption> </q-item-label>
                </q-item-section>
              </q-item>
            </q-card-section>
          </q-card>
        </q-expansion-item>
        <q-expansion-item expand-separator icon="category" label="Categoria" caption="Tipo da ação ofertada"
          header-class="text-white bg-purple" expand-icon-class="text-white" v-model="flagCategoria">
          <q-card>
            <q-card-section>
              <q-item v-for="item in acoesStore.filters.tipo.options" :key="item.label" v-ripple>
                <q-item-section side top>
                  <q-checkbox v-model="acoesStore.filters.tipo.select" :val="item.value" color="purple" />
                </q-item-section>
                <q-item-section>
                  <q-item-label>{{ item.label }}</q-item-label>
                  <q-item-label caption> </q-item-label>
                </q-item-section>
              </q-item>
            </q-card-section>
          </q-card>
        </q-expansion-item>
        <q-expansion-item expand-separator icon="category" label="Formato" caption="Formato da ação"
          header-class="text-white bg-teal" expand-icon-class="text-white" v-model="flagModalidade">
          <q-card>
            <q-card-section>
              <q-item v-for="item in acoesStore.filters.modalidade.options" :key="item.label" v-ripple>
                <q-item-section side top>
                  <q-checkbox v-model="acoesStore.filters.modalidade.select" :val="item.value" color="teal" />
                </q-item-section>

                <q-item-section>
                  <q-item-label>{{ item.value }}</q-item-label>
                  <q-item-label caption> </q-item-label>
                </q-item-section>
              </q-item>
            </q-card-section>
          </q-card>
        </q-expansion-item>
      </q-list>
    </div>
    <div class="col-xs-12 col-md-9">
      <div v-if="$q.screen.lt.md" class="flex flex-center">
        <q-btn class="col" color="blue" size="xl" icon-right="filter_alt" @click="drawerLeft = true">Mostrar
          Filtros</q-btn>
      </div>

      <div class="row q-my-md justify-center">
        <div class="row q-px-sm justify-left">
          <div class="col-* q-ma-md row" v-for="item in acoesStore.getFilters.slice(0, 50)" :key="item.tipo + item.id">
            <my-card :data="item"></my-card>
          </div>
        </div>
      </div>
    </div>
  </q-page>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import { useAcoes } from 'src/stores/store';
import MyCard from 'src/components/MyCard.vue';

const acoesStore = useAcoes();
const flagCategoria = ref(true);
const flagInscricao = ref(true);
const flagModalidade = ref(true);
const drawerLeft = ref(false);
</script>

<style>
.q-item__label--caption {
  color: aliceblue !important;
}
</style>
