<template>
  <my-title :text="text"></my-title>

  <div class="">
    <div style="max-width: inherit">
      <q-tabs v-model="tabs.selected" inline-label narrow-indicator align="left">
        <q-tab v-for="item in tabs.options" :class="item.classes" :name="item.name" :label="item.label" :icon="item.icon"
          :key="item.name" content-class="tabHeader" />
      </q-tabs>

      <div class="q-pt-md">
        <q-tab-panels class="outline" v-model="tabs.selected" animated transition-prev="slide-right"
          transition-next="slide-left">
          <q-tab-panel class="no-scroll" v-for="item in tabs.options" :name="item.name" :key="item.name">
            <div class="q-pa-sm texto">
              {{ item.texto }}
            </div>
            <q-btn size="lg" rounded :color="item.color" class="q-mx-xl q-mb-xl q-mt-md" :icon="item.icon" @click="
                            router.push({'name': item.name});
                            acoesStore.limparFiltros();
                            acoesStore.filters.tipo.select = item.option;
                          " :label="'Explorar ' + item.label"></q-btn>
            <vue-horizontal scroll v-if="acoesStore[item.name].length">
              <section class="q-px-md q-py-md" v-for="item in acoesStore[item.name]" :key="item.id">
                <my-card :data="item"></my-card>
              </section>
            </vue-horizontal>
            <a class="estudantes q-pl-md" v-if="item.name == 'vagas'" href="https://www.youtube.com/watch?v=pucam0lCHzI"
              target="_blank">
              Estudantes, vejam aqui tutorial sobre como obter creditação das
              suas horas de extensão
            </a>
          </q-tab-panel>
        </q-tab-panels>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import MyCard from './MyCard.vue';
import MyTitle from './MyTitle.vue';
import VueHorizontal from 'vue-horizontal';
import { useAcoes } from 'src/stores/store';
import { useRouter } from 'vue-router';
const router = useRouter();

const text = 'O que está rolando na extensão da UFRJ';
const acoesStore = useAcoes();

const tabs = ref({
  selected: 'pesquisa',
  options: [
    {
      name: 'pesquisa',
      option: [],
      label: 'Todas as ações',
      icon: 'workspaces',
      classes: 'text-blue',
      color: 'blue',
      texto:
        'A  Extensão UFRJ é um processo interdisciplinar educativo, cultural,  científico e político que   promove a interação transformadora entre a universidade e outros setores da sociedade. Ela está sob o princípio da indissociabilidade entre ensino, pesquisa e extensão, ou seja, qualquer uma dessas dimensões não existe sem a outra.',
    },
    {
      name: 'eventos',
      option: ['Evento'],
      label: 'Eventos',
      icon: 'celebration',
      classes: 'text-purple',
      color: 'purple',
      texto:
        'O evento de extensão é uma ação que promove apresentação e/ou exibição pública, livre ou com público específico, do conhecimento ou produto cultural, artístico, esportivo, científico e tecnológico desenvolvido, conservado ou reconhecido pela universidade. No Portal da Extensão, você encontra eventos gratuitos para criar novas conexões com pessoas e ideias.',
    },
    {
      name: 'cursos',
      option: ['Curso'],
      label: 'Cursos',
      icon: 'school',
      classes: 'text-orange',
      color: 'orange',
      texto:
        'Um curso de extensão é uma ação pedagógica teórica e/ou prática, com carga horária mínima de 8 horas, critérios de avaliação definidos e que é aberta à participação de pessoas sem vínculo institucional com a universidade. No Portal da Extensão, você encontra cursos presenciais ou à distância para frequentar gratuitamente e obter certificação ao final.',
    },
    {
      name: 'outros',
      label: 'Atividades e Produtos',
      option: ['Atividades e Produtos'],
      icon: 'playlist_add',
      classes: 'text-teal',
      color: 'teal',
      texto:
        'As atividades, serviços e produtos resultantes ou associados a uma ação de extensão são desenvolvidos no diálogo entre a comunidade acadêmica e outros setores da sociedade e oferecidos para toda a população. Nesta seção, você descobre palestras, consultorias, livros e outras oportunidades e materiais gratuitos, de todas as áreas de conhecimento e para todos os públicos.',
    },
    {
      name: 'vagas',
      option: ['Vaga'],
      label: 'Vagas',
      icon: 'badge',
      classes: 'text-red',
      color: 'red',
      texto:
        'As vagas de extensão são oportunidades para estudantes da UFRJ atuarem na equipe de uma ação de extensão, contribuindo para o desenvolvimento das atividades e recebendo creditação de horas (somente estudantes da graduação) e/ou certificado de participação.',
    },
  ],
});
</script>

<style>
.tabHeader>.q-tab__label {
  font-size: 20px !important;
}

.tabHeader>i {
  font-size: 24px !important;
}

.estudantes {
  font-size: 26px;
  font-weight: bold;
  color: crimson;
}

.coordenador {
  font-size: 24px;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  font-weight: 500;
}

.centro {
  font-size: 24px;
  font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande',
    'Lucida Sans Unicode', 'Geneva', Verdana, sans-serif;
  font-weight: 500;
}

.titulo {
  font-size: 36px;
  font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande',
    'Lucida Sans Unicode', 'Geneva', Verdana, sans-serif;
  font-weight: bold;
}

.texto {
  font-size: 18px;
  font-family: Tahoma, Geneva, Verdana, sans-serif;
  font-weight: 400;
}

.myimage {
  max-width: 100%;
  max-height: 100%;
  object-fit: contain;
  border-radius: 16px;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}

.enrollEmail {
  user-select: all;
}

.enrollEmail>div>div {
  overflow: unset !important;
  text-overflow: unset !important;
  white-space: break-spaces !important;
}

.v-hl-btn {
  margin: 20px !important;
}

.v-hl-btn>svg {
  width: 60px !important;
  height: 60px !important;
}
</style>
