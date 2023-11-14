import { defineStore } from 'pinia';
import axios from 'axios';
import mapper from './map.json';
import { date } from 'quasar';

function dateBrToIso(date: string) {
  if (!date) return true;
  const pattern = /(\d{2})\/(\d{2})\/(\d{4})/;
  return new Date(date.replace(pattern, '$3-$2-$1'));
}

export function tipoToIcon(name: string) {
  switch (name) {
    case 'Evento':
      return 'celebration';
    case 'Curso':
      return 'school';
    case 'Mais ações':
      return 'playlist_add';
    case 'Vaga':
      return 'badge';
    case 'apartirDeHoje':
      return 'workspaces';
  }
}

function normalizeString(str: string) {
  let r = str.toLowerCase();
  const non_asciis = {
    a: '[àáâãäå]',
    ae: 'æ',
    c: 'ç',
    e: '[èéêë]',
    i: '[ìíîï]',
    n: 'ñ',
    o: '[òóôõö]',
    oe: 'œ',
    u: '[ùúûűü]',
    y: '[ýÿ]',
  };
  for (const i in non_asciis) {
    r = r.replace(new RegExp(non_asciis[i], 'g'), i);
  }
  return r;
}

function filtraData(item, filtros) {
  const hoje = new Date();
  let dtInicio = item.dtInscricaoInicio
    ? item.dtInscricaoInicio.substring(0, 10)
    : item.dtRealizacaoInicio;
  let dtFim = item.dtInscricaoFim
    ? item.dtInscricaoFim.substring(0, 10)
    : item.dtRealizacaoFim;
  dtInicio = dateBrToIso(dtInicio);
  dtFim = dateBrToIso(dtFim);

  const abertas = hoje >= dtInicio && hoje <= dtFim;
  const embreve = hoje <= dtInicio;
  const finalizadas = hoje >= dtFim;

  if (
    filtros.includes('Abertas') &&
    filtros.includes('Em breve') &&
    filtros.includes('Finalizadas')
  )
    return true;
  else if (filtros.includes('Abertas') && filtros.includes('Em breve'))
    return abertas || embreve;
  else if (filtros.includes('Abertas') && filtros.includes('Finalizadas'))
    return abertas || finalizadas;
  else if (filtros.includes('Abertas')) return abertas;
  else if (filtros.includes('Em breve') && filtros.includes('Finalizadas'))
    return embreve || finalizadas;
  else if (filtros.includes('Em breve')) return embreve;
  else if (filtros.includes('Finalizadas')) return finalizadas;
  else return false;
}

export interface Acao {
  titulo: string;
  id: string;
  siga: string;
  timestamp: string;
  tipo: string;
  modalidade: string;
  dtRealizacaoInicio: string;
  dtRealizacaoFim: string;
  dtInscricaoInicio: string;
  dtInscricaoFim: string;
  place: string;
  enrollLink: string;
  enrollEmail: string;
  contactEmail: string;
  contactPhone: string;
  liveLink: string;
}

let i = 0;
let j = 0;
let k = 0;
let l = 0;

function getGoogleImageUrl(src: string, tipo: string) {
  if (src.substring(0, 5) == 'https') {
    const imgs = src.split(',')[0];
    const id = imgs.split('open?id=')[1];
    return `https://drive.google.com/u/0/uc?id=${id}`;
  } else {
    if (tipo == 'Curso') return `/images/template-curso-${i++ % 3}.png`;
    if (tipo == 'Evento') return `/images/template-evento-${j++ % 3}.png`;
    if (tipo == 'Vaga') return `/images/template-vaga-${k++ % 3}.png`;
    if (tipo == 'Mais ações')
      return `/images/template-atividades-${l++ % 3}.png`;
  }
}

function getAcaoId(url: string) {
  return url
    .split('https://portal.ufrj.br/Inscricao/extensao/acaoExtensao/acao?id=')[1]
    .split('&cid=')[0];
}

function mapping(data: Array<object>, map: object, tipo = '') {
  let acoes = [] as Array<Acao>;
  data.forEach((item) => {
    const novaAcao = {} as Acao;
    novaAcao.image = '';
    for (const property in item) {
      if (property in map) novaAcao[map[property]] = item[property];
    }
    if (tipo != '') novaAcao.tipo = tipo;
    novaAcao.image = getGoogleImageUrl(novaAcao.image, novaAcao.tipo);
    novaAcao.siga = novaAcao.id;
    novaAcao.id = getAcaoId(novaAcao.id);
    acoes = acoes.concat(novaAcao);
  });
  return acoes;
}

export const useAcoes = defineStore('acoes', {
  state: () => ({
    acoes: [] as Array<Acao>,
    index: {},
    current: null,
    siga: null,
    loaded: false,
    filters: {
      tipo: {
        options: [
          {
            label: 'Curso',
            value: 'Curso',
          },
          {
            label: 'Evento',
            value: 'Evento',
          },
          {
            label: 'Vaga para extensionista',
            value: 'Vaga',
          },
          {
            label: 'Mais ações',
            value: 'Mais ações',
          },
        ],
        select: [],
        default: [],
      },
      modalidade: {
        options: [
          {
            label: 'Online',
            value: 'Online',
          },
          {
            label: 'Presencial',
            value: 'Presencial',
          },
          {
            label: 'Semi-Presencial',
            value: 'Semi-Presencial',
          },
        ],
        select: [],
        default: [],
      },
      inscricoes: {
        options: [
          {
            label: 'Abertas',
            value: 'Abertas',
          },
          {
            label: 'Em breve',
            value: 'Em breve',
          },
          {
            label: 'Finalizadas',
            value: 'Finalizadas',
          },
        ],
        select: ['Abertas', 'Em breve'],
        default: ['Abertas', 'Em breve'],
      },
      pesquisa: {
        value: '',
        default: '',
      },
    },
  }),
  getters: {
    getFilters: (state) => {
      return state.getFiltersInscricao;
    },
    getFiltersSearch: (state) =>
      state.filters.pesquisa.value
        ? state.acoes.filter(
            (x) =>
              normalizeString(JSON.stringify(Object.values(x))).indexOf(
                normalizeString(state.filters.pesquisa.value)
              ) !== -1
          )
        : state.acoes,
    getFiltersTipo: (state) =>
      state.filters.tipo.select.length
        ? state.getFiltersSearch.filter((x) =>
            state.filters.tipo.select.includes(x.tipo)
          )
        : state.getFiltersSearch,
    getFiltersModalidade: (state) =>
      state.filters.modalidade.select.length
        ? state.getFiltersTipo.filter((x) =>
            state.filters.modalidade.select.includes(x.modalidade)
          )
        : state.getFiltersTipo,
    getFiltersInscricao: (state) =>
      state.filters.inscricoes.select.length
        ? state.getFiltersModalidade.filter((x) =>
            filtraData(x, state.filters.inscricoes.select)
          )
        : state.getFiltersModalidade,
    cursos: (state) => state.apartirDeHoje.filter((x) => x.tipo == 'Curso'),
    eventos: (state) => state.apartirDeHoje.filter((x) => x.tipo == 'Evento'),
    vagas: (state) => state.apartirDeHoje.filter((x) => x.tipo == 'Vaga'),
    outros: (state) =>
      state.apartirDeHoje.filter((x) => x.tipo == 'Mais ações'),
    apartirDeHoje: (state) =>
      state.acoes.filter(
        (x) =>
          dateBrToIso(x.dtRealizacaoFim) >= new Date() ||
          dateBrToIso(x.dtInscricaoFim) >= new Date()
      ),
  },
  actions: {
    limparFiltros() {
      for (const filter in this.filters) {
        this.filters[filter].select = this.filters[filter].default;
      }
    },
    async setCurrent(id, timestamp) {
      this.getDados().then(() => (this.current = this.index[id][timestamp]));
    },
    async getDados() {
      if (!this.loaded) {
        const resp1 = await axios.get(
          'https://portal.extensao.ufrj.br/php/proxy.php?url=' +
            mapper.acoes.url
        );
        const resp2 = await axios.get(
          'https://portal.extensao.ufrj.br/php/proxy.php?url=' +
            mapper.maisAcoes.url
        );
        const resp3 = await axios.get(
          'https://portal.extensao.ufrj.br/php/proxy.php?url=' +
            mapper.vagas.url
        );

        this.acoes = [...this.acoes, ...mapping(resp1.data, mapper.acoes)];
        this.acoes = [
          ...this.acoes,
          ...mapping(resp2.data, mapper.maisAcoes, 'Mais ações'),
        ];
        this.acoes = [
          ...this.acoes,
          ...mapping(resp3.data, mapper.vagas, 'Vaga'),
        ];
        for (const i in this.acoes) {
          const acao = this.acoes[i];
          if (!this.index[acao.id]) this.index[acao.id] = {};
          this.index[acao.id][acao.timestamp] = acao;
        }
        this.loaded = true;
      }
    },
  },
});
