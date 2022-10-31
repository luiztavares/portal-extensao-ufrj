<template>
  <q-page ref="destaque" id="destaque" class="q-pa-xs-sm q-pa-md-xl row">

      <div class="" v-if="$q.screen.lt.sm">
        <q-toolbar>
        <q-btn fab label="Filtros" color="primary"  @click="drawerLeft = !drawerLeft"   icon="filter_alt" />
        </q-toolbar>

        <q-drawer
        v-model="drawerLeft"
        show-if-above
        :breakpoint="700"
        elevated
        class=""
      >
      <q-list bordered round padding  class="">

        <q-item-label header>Modalidade</q-item-label>
        <q-item v-for='item in modalidade.items' :key='item' v-ripple>
          <q-item-section side top>
              <q-checkbox  v-model="modalidade.select" :val="item"  color='purple' />
          </q-item-section>

          <q-item-section>
            <q-item-label>{{ item }}</q-item-label>
            <q-item-label caption> </q-item-label>
          </q-item-section>
        </q-item>
      <q-separator spaced inset />

        <q-item-label header>Categoria</q-item-label>
        <q-item v-for='item in divulgacao.items' :key='item.label' v-ripple>
        <q-tooltip anchor="center right" self="center left" class="q-pl-xl  bg-purple" :offset="[10, 100]" style='max-width:500px'>
          <span class='toltiptext'>
            {{item.texto}}
            </span>
        </q-tooltip>
          <q-item-section side top>
              <q-checkbox  v-model="divulgacao.select" :val="item.label"  color='orange' />
          </q-item-section>
          <q-item-section>
            <q-item-label>{{ item.label }}</q-item-label>
            <q-item-label caption> </q-item-label>
          </q-item-section>
        </q-item>
      </q-list>
      <div
        class="q-px-sm text-h5 text-bold row"
        style="text-shadow: 3px 3px 6px #00000030"
      >
        <q-input class="col-12 q-pl-sm-none q-pl-md-xl" v-model="search" rounded outlined type="search">
          <template v-slot:append>
            <q-icon name="search" />
          </template>
        </q-input>
        <q-btn-toggle
          class="float-right"
          v-model="toggleAcoes"
          toggle-color="primary"
          flat
          :options="[
            { slot: 'one', value: 'one' },
            { slot: 'two', value: 'two' },
          ]"
        >
          <template v-slot:one>
            <div class="row items-center no-wrap">
              <q-icon name="list" />
              <div class="text-center">Lista</div>
            </div>
          </template>

          <template v-slot:two>
            <div class="row items-center no-wrap">
              <q-icon name="grid_view" />
              <div class="text-center">Grade</div>
            </div>
          </template>
        </q-btn-toggle>
      </div>
      </q-drawer>

      </div>

    <div v-if="$q.screen.gt.xs || $q.screen.sm" class="col-2">
      <q-list bordered round padding  class="fixed">


        <q-item-label header>Modalidade</q-item-label>
        <q-item v-for='item in modalidade.items' :key='item' v-ripple>
          <q-item-section side top>
              <q-checkbox  v-model="modalidade.select" :val="item"  color='purple' />
          </q-item-section>

          <q-item-section>
            <q-item-label>{{ item }}</q-item-label>
            <q-item-label caption> </q-item-label>
          </q-item-section>
        </q-item>
      <q-separator spaced inset />

        <q-item-label header>Categoria</q-item-label>
        <q-item v-for='item in divulgacao.items' :key='item.label' v-ripple>
        <q-tooltip anchor="center right" self="center left" class="q-pl-xl  bg-purple" :offset="[10, 100]" style='max-width:500px'>
          <span class='toltiptext'>
            {{item.texto}}
            </span>
        </q-tooltip>
          <q-item-section side top>
              <q-checkbox  v-model="divulgacao.select" :val="item.label"  color='orange' />
          </q-item-section>
          <q-item-section>
            <q-item-label>{{ item.label }}</q-item-label>
            <q-item-label caption> </q-item-label>
          </q-item-section>
        </q-item>
      </q-list>
    </div>
    <div   class="col-xs-12 col-sm-10">
      <div v-if="$q.screen.gt.sm || $q.screen.sm "
        class="q-px-sm text-h5 text-bold row"
        style="text-shadow: 3px 3px 6px #00000030"
      >
        <q-input class="col q-pl-xl" v-model="search" rounded outlined type="search">
          <template v-slot:append>
            <q-icon name="search" />
          </template>
        </q-input>
        <q-btn-toggle
          class="float-right"
          v-model="toggleAcoes"
          toggle-color="primary"
          flat
          :options="[
            { slot: 'one', value: 'one' },
            { slot: 'two', value: 'two' },
          ]"
        >
          <template v-slot:one>
            <div class="row items-center no-wrap">
              <q-icon name="list" />
              <div class="text-center">Lista</div>
            </div>
          </template>

          <template v-slot:two>
            <div class="row items-center no-wrap">
              <q-icon name="grid_view" />
              <div class="text-center">Grade</div>
            </div>
          </template>
        </q-btn-toggle>
         <!-- <q-btn-dropdown color="primary" label="Ordenar por">
      <q-list>
        <q-item clickable v-close-popup @click="onItemClick">
          <q-item-section>
            <q-item-label>Data de início</q-item-label>
          </q-item-section>
        </q-item>

        <q-item clickable v-close-popup @click="onItemClick">
          <q-item-section>
            <q-item-label>Data de Fim</q-item-label>
          </q-item-section>
        </q-item>

        <q-item clickable v-close-popup @click="onItemClick">
          <q-item-section>
            <q-item-label>Mais visitados</q-item-label>
          </q-item-section>
        </q-item>
      </q-list>
    </q-btn-dropdown> -->
    </div>

      <div class="row justify-center">
        <q-list v-if="toggleAcoes == 'one'" responsive class="q-px-xl ">
          <section
            class="col-auto q-pa-md"
            v-for="(projeto, index) in filteredList3"
            :key="projeto"
          >
            <home-list v-if="projeto['O que você deseja divulgar?'] == 'Curso' || projeto['O que você deseja divulgar?'] == 'Evento'" class='col' :vaga="false" :acao="projeto" :index="index">
            </home-list>
            <vagas-list v-if="projeto['O que você deseja divulgar?'] == 'Vaga para extensionista'" class='col' :vaga="false" :acao="projeto" :index="index">
            </vagas-list>
            <atividades-list v-if="projeto['O que você deseja divulgar?'] == 'Atividade & serviço'" class='col' :vaga="false" :acao="projeto" :index="index">
            </atividades-list>
          </section>
        </q-list>
        <div class="row q-px-xl justify-center" v-if="toggleAcoes == 'two'">
          <div
            class="col-* q-ma-md"
            v-for="(projeto, index) in filteredList3"
            :key="projeto"
          >
            <home-card v-if="projeto['O que você deseja divulgar?'] == 'Curso' || projeto['O que você deseja divulgar?'] == 'Evento'" class="" :vaga="false" :acao="projeto" :index="index">
            </home-card>
            <vagas-card v-if="projeto['O que você deseja divulgar?'] == 'Vaga para extensionista'" class="" :vaga="false" :acao="projeto" :index="index">
            </vagas-card>
            <atividades-card v-if="projeto['O que você deseja divulgar?'] == 'Atividade & serviço'" class="" :vaga="false" :acao="projeto" :index="index">
            </atividades-card>
          </div>
        </div>
      </div>
    </div>
  </q-page>
</template>

<script>
import { defineComponent } from "vue";
import "@quasar/extras/fontawesome-v5";
import axios from "axios";
import HomeCard from "../components/HomeCard.vue";
import HomeList from "../components/HomeList.vue";
import acoesJson from "../../public/acoes-13-05-2022.json";
import VagasList from "../components/VagasList.vue";
import VagasCard from "../components/VagasCard.vue";
import vagasJson from "../../public/vagas-13-05-2022.json";
import AtividadesCard from "../components/AtividadesCard.vue";
import AtividadesList from "../components/AtividadesList.vue";
import atividadesJson from "../../public/atividades.json";
import { ref } from "vue";

export default defineComponent({
  components: {
    HomeCard,
    HomeList,
    VagasList,
    VagasCard,
    AtividadesCard,
    AtividadesList,
  },
  name: "PageIndex",
  data: function () {
    return {
      drawerLeft: ref(false),
      search: "",
      slide: "style",
      toggleAcoes: "two",
      divulgacao: {
        items: [
          {
            label: "Curso",
            texto:
              "Um curso de extensão é uma ação pedagógica teórica e/ou prática, com carga horária mínima de 8 horas, critérios de avaliação definidos e que é aberta à participação de pessoas sem vínculo institucional com a universidade. No Portal da Extensão, você encontra cursos presenciais ou à distância para frequentar gratuitamente e obter certificação ao final.",
          },
          {
            label: "Evento",
            texto:
              "O evento de extensão é uma ação que promove apresentação e/ou exibição pública, livre ou com público específico, do conhecimento ou produto cultural, artístico, esportivo, científico e tecnológico desenvolvido, conservado ou reconhecido pela universidade. No Portal da Extensão, você encontra eventos gratuitos para criar novas conexões com pessoas e ideias.",
          },
          {
            label: "Vaga para extensionista",
            texto:
              "As vagas de extensão são oportunidades para estudantes da UFRJ atuarem na equipe de uma ação de extensão, contribuindo para o desenvolvimento das atividades e recebendo creditação de horas (somente estudantes da graduação) e/ou certificado de participação.",
          },
          {
            label: "Atividade & serviço",
            texto:
              "As atividades, serviços e produtos resultantes ou associados a uma ação de extensão são desenvolvidos no diálogo entre a comunidade acadêmica e outros setores da sociedade e oferecidos para toda a população. Nesta seção, você descobre palestras, consultorias, livros e outras oportunidades e materiais gratuitos, de todas as áreas de conhecimento e para todos os públicos.",
          },
        ],
        select: [
          "Curso",
          "Evento",
          "Vaga para extensionista",
          "Atividade & serviço",
        ],
      },
      modalidade: {
        items: ["Online", "Presencial", "Semi-Presencial"],
        select: ["Online", "Presencial", "Semi-Presencial"],
      },
      projetos: [],
      vagas: [],
      items: [...Array(20).keys()].map((i) => {
        return { title: `Item ${i}`, content: `🚀 Content ${i}` };
      }),
    };
  },
  created() {
    this.windowHeight = window.innerHeight + "px";
  },
  methods: {
    getProjetos() {
      axios.get("http://127.0.0.1:8000/home/").then((response) => {
        (this.projetos = response.data.data), console.log(this.projetos);
        this.vagas = response.data.data.slice(0, 3);
      });
    },
    getProjetosLocal() {
      var i = 0;
      var j = 0;
      var k = 0;
      for (var acao of acoesJson) {
        if (
          acao["O que você deseja divulgar?"] == "Curso" ||
          acao["O que você deseja divulgar?"] == "Evento"
        )
          this.projetos.push(acao);
      }
      for (var acao of vagasJson) {
        acao["O que você deseja divulgar?"] = "Vaga para extensionista";
        acao["Modalidade"] = ["Online", "Presencial", "Semi-Presencial"];
        this.projetos.push(acao);
      }
      for (var acao of atividadesJson) {
        acao["O que você deseja divulgar?"] = "Atividade & serviço";
        acao["Link da página da ação no SIGA"] =
          acao["Link da página da sua ação de extensão no SIGA"];
        this.projetos.push(acao);
      }
      this.projetos.sort((a, b) =>
        a["Carimbo de data/hora"] > b["Carimbo de data/hora"]
          ? 1
          : b["Carimbo de data/hora"] > a["Carimbo de data/hora"]
          ? -1
          : 0
      );

      for (var acao of this.projetos) {
        acao["id"] = acao["Link da página da ação no SIGA"]
          .split(
            "https://portal.ufrj.br/Inscricao/extensao/acaoExtensao/acao?id="
          )[1]
          .split("&cid=")[0];
        if (
          acao["O que você deseja divulgar?"] == "Curso" &&
          acao[
            "Anexe aqui uma imagem para divulgação do curso/evento, caso deseje"
          ] == ""
        ) {
          acao[
            "Anexe aqui uma imagem para divulgação do curso/evento, caso deseje"
          ] = `images/Template Curso -${i}.png`;
          i += 1;
          i = i % 3;
        }
        if (
          acao["O que você deseja divulgar?"] == "Evento" &&
          acao[
            "Anexe aqui uma imagem para divulgação do curso/evento, caso deseje"
          ] == ""
        ) {
          acao[
            "Anexe aqui uma imagem para divulgação do curso/evento, caso deseje"
          ] = `images/Template Evento -${j}.png`;
          j += 1;
          j = i % 3;
        }
        if (
          acao["Anexe aqui uma imagem para divulgação da vaga, caso deseje"] ==
          ""
        ) {
          acao[
            "Anexe aqui uma imagem para divulgação da vaga, caso deseje"
          ] = `images/Template Vagas -${k}.png`;
          k += 1;
          k = k % 3;
        }
      }

      //this.projetos = acoesJson.reverse();
    },
  },
  computed: {
    month() {
      return new Date().toLocaleString("default", { month: "long" });
    },
    filteredList() {
      return this.projetos.filter(
        (data) =>
          JSON.stringify(data)
            .toLowerCase()
            .indexOf(this.search.toLowerCase()) !== -1
      );
    },
    filteredList2() {
      return this.filteredList.filter((data) =>
        this.divulgacao.select.includes(data["O que você deseja divulgar?"])
      );
    },
    filteredList3() {
      return this.filteredList2.filter(
        (data) =>
          this.modalidade.select.some((r) => data["Modalidade"].includes(r))
        // this.modalidade.select.includes(data["Modalidade"])
      );
    },
  },
  mounted() {
    this.getProjetosLocal();
  },
});
</script>

<style scoped>
.toltiptext {
  font-size: 15px;
}
</style>
