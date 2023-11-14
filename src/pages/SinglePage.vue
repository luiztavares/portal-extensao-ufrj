<template>
  <q-page class="">
    <div class="bg-header q-py-xl q-px-md">
      <div v-if="acoesStore.current && siga" class="row maxwidth">
        <div class="col-md-6 col-xs-12 q-px-md">
          <div class="centro" v-if="siga">{{ siga.centro }}</div>
          <div class="titulo">{{ acoesStore.current.titulo }}</div>

          <div
            v-if="acoesStore.current.tipo != 'Vaga'"
            class="texto q-pl-sm q-pt-sm"
          >
            {{ acoesStore.current.description }}
          </div>
          <div
            v-if="acoesStore.current.tipo == 'Vaga'"
            class="texto q-pl-sm q-pt-sm"
          >
            {{ siga.resumo }}
          </div>
          <div class="q-pt-lg coordenador" v-if="siga">
            {{ siga.coordenador }}
          </div>
          <div class="texto q-pb-md" v-if="siga">
            {{ siga.unidade }}
          </div>

          <q-chip
            size="lg"
            color="primary"
            outline
            v-if="acoesStore.current.tipo"
            :label="acoesStore.current.tipo"
            :icon="tipoToIcon(acoesStore.current.tipo)"
          ></q-chip>
          <q-chip
            size="lg"
            v-if="acoesStore.current.modalidade"
            color="pink"
            outline
            :label="acoesStore.current.modalidade"
            :icon="
              acoesStore.current.modalidade == 'Online'
                ? 'public'
                : 'location_city'
            "
          ></q-chip>
          <q-chip
            size="lg"
            v-if="acoesStore.current.dtRealizacaoInicio"
            color="green"
            outline
            :label="
              'Realização de ' +
              acoesStore.current.dtRealizacaoInicio +
              ' até ' +
              acoesStore.current.dtRealizacaoFim
            "
            icon="event"
          ></q-chip>
          <q-chip
            size="lg"
            color="purple"
            outline
            icon="edit_note"
            v-if="acoesStore.current.dtInscricaoInicio"
            :label="
              'Inscricão de ' +
              acoesStore.current.dtInscricaoInicio.substring(0, 10) +
              ' até ' +
              acoesStore.current.dtInscricaoFim.substring(0, 10)
            "
          ></q-chip>
          <br />
          <div
            v-if="acoesStore.current.comoCandidatar"
            class="coordenador q-pt-md"
          >
            Como se inscrever:
          </div>
          <div v-if="acoesStore.current.comoCandidatar" class="texto">
            {{ acoesStore.current.comoCandidatar }}
          </div>

          <div class="coordenador q-pt-md">Contatos:</div>
          <q-btn
            class="q-py-lg q-mt-sm q-mx-md"
            color="purple"
            rounded
            size="lg"
            v-if="acoesStore.current.enrollLink"
            :href="acoesStore.current.enrollLink"
            target="_blank"
          >
            Inscrever-se</q-btn
          >
          <q-chip
            size="lg"
            color="purple"
            outline
            icon="email"
            v-if="acoesStore.current.enrollEmail"
            :label="acoesStore.current.enrollEmail"
          ></q-chip>
          <q-chip
            size="lg"
            color="purple"
            outline
            icon="phone"
            v-if="acoesStore.current.contactPhone"
            :label="acoesStore.current.contactPhone"
          ></q-chip>
          <q-chip
            size="lg"
            color="purple"
            outline
            icon="email"
            v-if="
              acoesStore.current.contactEmail != acoesStore.current.enrollEmail
            "
            :label="acoesStore.current.contactEmail"
          ></q-chip>
          <div class="texto">
            {{ acoesStore.current.contato }}
          </div>
        </div>
        <div class="col-md-6 col-xs-12">
          <q-img class="myimage" :src="acoesStore.current.image"></q-img>
        </div>
      </div>
    </div>
  </q-page>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import { tipoToIcon, useAcoes } from 'src/stores/store';
import { defineProps, toRefs } from 'vue';
import axios from 'axios';
import { copyToClipboard } from 'quasar';

const acoesStore = useAcoes();
const props = defineProps({
  id: String,
  timestamp: String,
});

const { id, timestamp } = toRefs(props);

const showing = ref(false);
acoesStore.setCurrent(id.value, timestamp.value);
let siga = ref(null);
getSigaData();

function getSigaData() {
  axios
    .get('https://portal.extensao.ufrj.br/php/infoAcao.php?id=' + id.value)
    .then((response) => {
      siga.value = response.data;
      console.log(siga);
    });
}

//console.log(minhacao);

// const minhacao = acoesStore.index[id.value][timestamp.value];
// console.log(Object.keys(acoesStore.index[id.value]).length);
</script>

<style>
.q-item__label--caption {
  color: aliceblue !important;
}

.bg-header {
  background: linear-gradient(
      217deg,
      rgba(255, 0, 0, 0.3),
      rgba(255, 0, 0, 0) 70.71%
    ),
    linear-gradient(127deg, rgba(0, 255, 0, 0.3), rgba(0, 255, 0, 0) 70.71%),
    linear-gradient(336deg, rgba(0, 0, 255, 0.3), rgba(0, 0, 255, 0) 70.71%);
  min-height: 500px;
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

.enrollEmail > div > div {
  overflow: unset !important;
  text-overflow: unset !important;
  white-space: break-spaces !important;
}
</style>
