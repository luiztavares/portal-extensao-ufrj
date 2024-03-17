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
            {{ acoesStore.current.resumo }}
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
    new Date(acoesStore.current.dtRealizacaoInicio + 'T00:00:00-0300').toLocaleDateString('pt-BR') +
    ' até ' +
    new Date(acoesStore.current.dtRealizacaoFim + 'T00:00:00-0300').toLocaleDateString('pt-BR')
    " icon="event"></q-chip>
          <q-chip size="lg" color="purple" outline icon="edit_note" v-if="acoesStore.current.dtInscricaoInicio" :label="'Inscrição de ' +
    new Date(acoesStore.current.dtInscricaoInicio + 'T00:00:00-0300').toLocaleDateString('pt-BR') +
    ' até ' +
    new Date(acoesStore.current.dtInscricaoFim + 'T00:00:00-0300').toLocaleDateString('pt-BR')
    "></q-chip>
          <br />
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

          <div v-if="acoesStore.current.remuneracao" class="coordenador q-mt-md">
            <div class="text-weight-bold">Remuneração</div>
            <div class="texto">
              {{ acoesStore.current.remuneracao }}
            </div>
          </div>

          <div v-if="acoesStore.current.liveLink" class="coordenador q-mt-md">
            Acesse:
            <div>
              <q-btn size="lg" color="teal" outline rounded icon="link" v-if="acoesStore.current.liveLink"
                :label="acoesStore.current.liveLink" :href="acoesStore.current.liveLink" target="_blank"></q-btn>
            </div>
          </div>

          <div v-if="acoesStore.current.public" class="coordenador q-mt-md">
            <div class="text-weight-bold">Público</div>
            <div class="texto">
              {{ acoesStore.current.public }}
            </div>
          </div>

          <div v-if="acoesStore.current.publicAge" class="coordenador q-mt-md">
            <div class="text-weight-bold">Faixa etária</div>
            <ul class="q-ma-none">
              <li class="texto" v-for="age in acoesStore.current.publicAge" :key="age">
                {{ age }}
              </li>
            </ul>
          </div>

          <div v-if="acoesStore.current.dateObservations || acoesStore.current.schedule" class="coordenador q-mt-md">
            <div class="text-weight-bold">Dias e horários</div>
            <div class="texto">
              <q-table class="tabelaHorarios q-mb-sm" table-header-class="bg-purple text-white"
                v-if="acoesStore.current.schedule" :rows="linhasTabelaHorarios(acoesStore.current.schedule)"
                :columns="colunasTabelaHorarios" row-key="name" hide-bottom />
              <div class="texto">
                {{ acoesStore.current.dateObservations }}
              </div>
            </div>
          </div>

          <div v-if="acoesStore.current.observations" class="coordenador q-mt-md">
            <div class="text-weight-bold">Observações gerais</div>
            <div class="texto">
              {{ acoesStore.current.observations }}
            </div>
          </div>

          <div v-if="acoesStore.current.comoCandidatar" class="coordenador q-pt-md">
            <div class="text-weight-bold">Como se candidatar</div>
            <div v-html="acoesStore.current.comoCandidatar" class="texto"></div>
            <div class="texto q-mt-sm aviso" v-if="acoesStore.current.tipo == 'Vaga'">
              <ul>
                <li>Somente estudantes com requerimento aceito no SIGA poderão creditar horas de extensão por esta ação.</li>
              </ul>
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
          </div>

          <div v-if="acoesStore.current.enrollLink ||
    acoesStore.current.contactPhone ||
    acoesStore.current.contactEmail ||
    acoesStore.current.contato
    " class="coordenador q-pt-md">
            <div class="text-weight-bold">Contatos</div>
          </div>

          <div class="texto">
            {{ acoesStore.current.contato }}
          </div>

          <q-chip size="lg" color="purple" outline icon="phone" v-if="acoesStore.current.contactPhone"
            :label="acoesStore.current.contactPhone"></q-chip>
          <q-chip size="lg" color="purple" outline icon="email" :label="acoesStore.current.contactEmail"></q-chip>

          <div class="q-pt-md q-mb-lg">
            <q-btn size="lg" color="teal" rounded icon-right="add" label="Saiba mais" :href="acoesStore.current.siga"
              target="_blank"></q-btn>
          </div>

          <div v-if="acoesStore.current.instagramLink" class="coordenador q-mt-md">
            <div class="text-weight-bold">Redes sociais</div>
            <a v-if="acoesStore.current.facebookLink" :href="acoesStore.current.facebookLink" class="fa fa-facebook"
              target="_blank"></a>
            <a v-if="acoesStore.current.twitterLink" :href="acoesStore.current.twitterLink" class="fa fa-twitter"
              target="_blank"></a>
            <a v-if="acoesStore.current.youtubeLink" :href="acoesStore.current.youtubeLink" class="fa fa-youtube"
              target="_blank"></a>
            <a v-if="acoesStore.current.instagramLink" :href="acoesStore.current.instagramLink" class="fa fa-instagram"
              target="_blank"></a>
          </div>
        </div>

        <div class="col-md-6 col-xs-12 q-mt-lg colunaImagem">
          <q-img class="myimage" :src="acoesStore.current.image"></q-img>
        </div>
      </div>
    </div>
  </q-page>
</template>

<script setup lang="ts">
import { tipoToIcon, useAcoes } from 'src/stores/store';
import { toRefs } from 'vue';

const acoesStore = useAcoes();
const props = defineProps({
  tipo: String,
  id: String,
});

const colunasTabelaHorarios = [
  {
    name: 'dias',
    label: 'Dias da semana',
    required: true,
    align: 'left',
    field: row => row.dia,
  },
  {
    name: 'horarios',
    label: 'Horários',
    required: true,
    align: 'left',
    field: row => row.horarios,
  },
];

const nomes_dias_semana = {
  domingo: 'Domingo',
  segunda: 'Segunda-feira',
  terca: 'Terça-feira',
  quarta: 'Quarta-feira',
  quinta: 'Quinta-feira',
  sexta: 'Sexta-feira',
  sabado: 'Sábado',
}

const { tipo, id } = toRefs(props);

acoesStore.getDados();
acoesStore.setCurrent(tipo.value, id.value);

function getNomeLongoTipo(tipo: string) {
  if (tipo === 'Vaga') {
    return 'Vagas para alunos de graduação da UFRJ'
  }
  return tipo;
}

function linhasTabelaHorarios(schedule) {
  const linhas = [];
  for (let chaveDia in nomes_dias_semana) {
    const dia = nomes_dias_semana[chaveDia];
    const horariosDia = schedule[chaveDia];
    if (horariosDia.inicio == null || horariosDia.inicio.length == 0) {
      continue;
    }
    const horarios = horariosDia.inicio.map((value, index) => `${value} - ${horariosDia.fim[index]}`).join('\n');
    linhas.push({ dia, horarios })
  }
  return linhas;
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
  font-size: 16px;
  font-weight: bold;
  color: crimson;
  max-width: 500px;
}

.aviso ul {
  margin: 0;
  list-style: square;
  padding-left: 20px;
}

.fa {
  padding: 20px;
  font-size: 30px;
  width: 70px;
  height: 70px;
  text-align: center;
  text-decoration: none;
  margin: 5px 5px;
  border-radius: 35px;
}

.fa:hover {
  opacity: 0.7;
}

.fa-facebook {
  background: #3B5998;
  color: white;
}

.fa-twitter {
  background: #55ACEE;
  color: white;
}

.fa-youtube {
  background: #bb0000;
  color: white;
}

.fa-instagram {
  background: #405DE6;
  color: white;
}

.tabelaHorarios {
  max-width: fit-content;
}

.tabelaHorarios .q-table td,
.tabelaHorarios .q-table th {
  font-size: 16px !important;
}

.tabelaHorarios th {
  font-weight: bold;
}

.tabelaHorarios td {
  white-space: pre-line;
}

.colunaImagem {
  max-height: 1024px;
}
</style>
