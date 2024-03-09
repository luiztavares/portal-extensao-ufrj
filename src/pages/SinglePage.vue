<template>
  <q-page v-if="acoesStore.current" class="">
    <div class="bg-header q-py-xl q-px-md">
      <div v-if="acoesStore.current" class="row maxwidth">
        <div class="col-md-6 col-xs-12 q-px-md">
          <div class="centro">{{ acoesStore.current.centro }}</div>
          <div class="titulo">{{ acoesStore.current.titulo_curto }}</div>

          <div v-if="acoesStore.current.tipo != 'Vaga'" class="texto q-pl-sm q-pt-sm">
            <span v-html="acoesStore.current.description"></span>
          </div>
          <div v-if="acoesStore.current.tipo == 'Vaga'" class="texto q-pt-sm">
            {{ siga.resumo }}
          </div>
          <div class="q-pt-lg coordenador">
            <span class="text-weight-bold">Nome cadastrado no SIGA:</span> {{ acoesStore.current.titulo }}
          </div>
          <div class="q-pt-lg coordenador">
            <span class="text-weight-bold">Coordenação:</span> {{
              acoesStore.current.coordenador.toLowerCase().replace(/(^\w{1})|(\s+\w{1})/g, (l: string) => l.toUpperCase())
            }}
          </div>
          <div class="texto q-pb-md">
            {{ acoesStore.current.unidade }}
          </div>

          <q-chip size="lg" color="primary" outline v-if="acoesStore.current.tipo"
            :label="getNomeLongoTipo(acoesStore.current.tipo)" :icon="tipoToIcon(acoesStore.current.tipo)"></q-chip>
          <q-chip size="lg" v-if="acoesStore.current.modalidade" color="pink" outline
            :label="acoesStore.current.modalidade" :icon="acoesStore.current.modalidade == 'Remoto'
              ? 'public'
              : 'location_city'
              "></q-chip>
          <q-chip size="lg" v-if="acoesStore.current.dtRealizacaoInicio" color="green" outline :label="'Realização de ' +
            new Date(acoesStore.current.dtRealizacaoInicio).toLocaleDateString('pt-BR') +
            ' até ' +
            new Date(acoesStore.current.dtRealizacaoFim).toLocaleDateString('pt-BR')
            " icon="event"></q-chip>
          <q-chip size="lg" color="purple" outline icon="edit_note" v-if="acoesStore.current.dtInscricaoInicio" :label="'Inscricão de ' +
            new Date(acoesStore.current.dtInscricaoInicio).toLocaleDateString('pt-BR') +
            ' até ' +
            new Date(acoesStore.current.dtInscricaoFim).toLocaleDateString('pt-BR')
            "></q-chip>
          <br />
          <div v-if="acoesStore.current.comoCandidatar" class="coordenador q-pt-md">
            <div class="text-weight-bold">Como se inscrever</div>
          </div>
          <div v-html="acoesStore.current.comoCandidatar" class="texto"></div>
          <div v-if="acoesStore.current.funcao" class="coordenador q-mt-md">
            <div class="text-weight-bold">Função</div>
            <div class="texto">
              {{ acoesStore.current.funcao }}
            </div>
          </div>
          <div v-if="acoesStore.current.requisito" class="coordenador q-mt-md">
            <div class="text-weight-bold">Requisitos</div>
            <div class="texto">
              {{ acoesStore.current.requisito }}
            </div>
          </div>

          <div v-if="acoesStore.current.atribuicao" class="coordenador q-mt-md">
            <div class="text-weight-bold">Atribuições</div>
            <div class="texto">
              {{ acoesStore.current.atribuicao }}
            </div>
          </div>

          <div v-if="acoesStore.current.liveLink" class="coordenador q-mt-md">
            Acesse:
            <div>
              <q-btn size="lg" color="teal" outline rounded icon="link" v-if="acoesStore.current.liveLink"
                :label="acoesStore.current.liveLink" :href="acoesStore.current.liveLink" target="_blank"></q-btn>
            </div>
          </div>

          <div v-if="acoesStore.current.dateObservations" class="coordenador q-mt-md">
            <div class="text-weight-bold">Observações sobre dias e horários</div>
            <div class="texto">
              {{ acoesStore.current.dateObservations }}
            </div>
          </div>

          <div v-if="acoesStore.current.enrollLink || acoesStore.current.howToEnroll" class="coordenador q-mt-md">
            <div class="text-weight-bold">Inscrição</div>
            <div class="texto">
              {{ acoesStore.current.howToEnroll }}
            </div>
            <q-btn class="q-mt-sm q-mr-md" color="purple" icon-right="edit_note" rounded size="lg" label="Inscrever-se"
              v-if="acoesStore.current.enrollLink" :href="acoesStore.current.enrollLink" target="_blank">
            </q-btn>

            <div class="texto q-mt-sm aviso" v-if="acoesStore.current.tipo == 'Vaga'">
              Somente estudantes com requerimento aceito no SIGA poderão creditar horas de extensão por esta ação.
            </div>
          </div>

          <div v-if="acoesStore.current.enrollLink ||
            acoesStore.current.contactPhone ||
            acoesStore.current.contactEmail ||
            acoesStore.current.contato
            " class="coordenador q-pt-md">
            <div class="text-weight-bold">Contatos</div>
          </div>
          <q-chip size="lg" color="purple" outline icon="phone" v-if="acoesStore.current.contactPhone"
            :label="acoesStore.current.contactPhone"></q-chip>
          <q-chip size="lg" color="purple" outline icon="email" :label="acoesStore.current.contactEmail"></q-chip>

          <div class="texto">
            {{ acoesStore.current.contato }}
          </div>

          <div class="q-pt-md q-mb-lg">
            <q-btn size="lg" color="teal" rounded icon-right="add" label="Saiba mais" :href="acoesStore.current.siga"
              target="_blank"></q-btn>
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
import { toRefs } from 'vue';
import axios from 'axios';

const acoesStore = useAcoes();
const props = defineProps({
  id: String
});

const { id } = toRefs(props);

let siga = ref(null);
acoesStore.getDados();
acoesStore.setCurrent(id.value);

function getNomeLongoTipo(tipo: string) {
  if (tipo === 'Vaga') {
    return 'Vagas para alunos de graduação da UFRJ'
  }
  return tipo;
}

</script>

<style>
.q-item__label--caption {
  color: aliceblue !important;
}

.bg-header {
  background: linear-gradient(217deg,
      rgba(255, 0, 0, 0.3),
      rgba(255, 0, 0, 0) 70.71%),
    linear-gradient(127deg, rgba(0, 255, 0, 0.3), rgba(0, 255, 0, 0) 70.71%),
    linear-gradient(336deg, rgba(0, 0, 255, 0.3), rgba(0, 0, 255, 0) 70.71%);
  min-height: 500px;
}

.coordenador {
  font-size: 19px;
  font-family: Tahoma, Geneva, Verdana, sans-serif;
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

.aviso {
  font-size: 18px;
  font-weight: bold;
  color: crimson;
  max-width: 500px;
}
</style>
