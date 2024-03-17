import { defineStore } from 'pinia';
import axios from 'axios';
import mapper from './map.json';

function dateBrToIso(date: string) {
  if (!date) return true;
  return new Date(date + ' GMT-0300');
}

export function tipoToIcon(name: string) {
  switch (name) {
    case 'Evento':
      return 'celebration';
    case 'Curso':
      return 'school';
    case 'Atividades e Produtos':
      return 'playlist_add';
    case 'Vaga':
      return 'badge';
    case 'pesquisa':
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

function urlify(text: string) {
  if (!text) return text;
  const urlRegex =
    /(\b((https?|ftp|file):\/\/)[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/gi;
  return text.replace('www.', 'https://').replace(urlRegex, function (url) {
    return (
      '<a class="bold700" target="_blank" rel="noreferrer noopener" href="' +
      url +
      '">' +
      url +
      '</a>'
    );
  });
}

function filtraData(item, filtros) {
  const hoje = new Date();
  hoje.setHours(0, 0, 0, 0);

  let dtInicio = item.dtInscricaoInicio
    ? item.dtInscricaoInicio
    : item.dtRealizacaoInicio;
  let dtFim = item.dtInscricaoFim ? item.dtInscricaoFim : item.dtRealizacaoFim;
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
  id: string;
  id_acao: string;
  titulo: string;
  titulo_curto: string;
  unidade: string;
  centro: string;
  resumo: string;
  coordenador: string;
  siga: string;
  tipo: string;
  modalidade: string;
  public: string;
  schedule: string;
  observations: string;
  dtRealizacaoInicio: string;
  dtRealizacaoFim: string;
  dtInscricaoInicio: string;
  dtInscricaoFim: string;
  place: string;
  remuneracao: string;
  howToEnroll: string;
  enrollLink: string;
  contactEmail: string;
  contactPhone: string;
  liveLink: string;
  instagramLink: string;
  facebookLink: string;
  twitterLink: string;
  youtubeLink: string;
}

let i = 0;
let j = 0;
let k = 0;
let l = 0;

function getImageUrl(src: string, tipo: string) {
  if (src != null && src != '') {
    return (
      'https://portal.extensao.ufrj.br/formularios/wp-content/uploads/cfdb7_uploads/' +
      src
    );
  } else {
    if (tipo == 'Curso') return `/images/template-curso-${i++ % 3}.png`;
    if (tipo == 'Evento') return `/images/template-evento-${j++ % 3}.png`;
    if (tipo == 'Vaga') return `/images/template-vaga-${k++ % 3}.png`;
    if (tipo == 'Atividades e Produtos')
      return `/images/template-atividades-${l++ % 3}.png`;
  }
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
    novaAcao.description = urlify(novaAcao.description);
    novaAcao.comoCandidatar = urlify(novaAcao.comoCandidatar);
    novaAcao.image = getImageUrl(novaAcao.image, novaAcao.tipo);
    novaAcao.siga =
      'https://portal.ufrj.br/Inscricao/extensao/acaoExtensao/acao?id=' +
      novaAcao.id_acao;
    acoes = acoes.concat(novaAcao);
  });
  return acoes;
}

function acaoUnica(value: Acao, index: number, self: Array<Acao>): boolean {
  return self.find((acao) => acao.id === value.id) === value;
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
            label: 'Atividades e Produtos',
            value: 'Atividades e Produtos',
          },
        ],
        select: [],
        default: [],
      },
      modalidade: {
        options: [
          {
            label: 'Remoto',
            value: 'Remoto',
          },
          {
            label: 'Ensino à Distância',
            value: 'Ensino à Distância',
          },
          {
            label: 'Híbrido',
            value: 'Híbrido',
          },
          {
            label: 'Presencial',
            value: 'Presencial',
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
    pesquisa: (state) => state.apartirDeHoje,
    outros: (state) =>
      state.apartirDeHoje.filter((x) => x.tipo == 'Atividades e Produtos'),
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
    async setCurrent(tipo, id) {
      await this.getDados();
      this.current = this.acoes.find((a) => a.tipo === tipo && a.id === id);
    },

    async getDados() {
      if (!this.loaded) {
        await axios.get(mapper.acoes.url).then((data) => {
          this.acoes = mapping(data.data, mapper.acoes);
        });
        await axios.get(mapper.vagas.url).then((data) => {
          this.acoes = [
            ...this.acoes,
            ...mapping(data.data, mapper.vagas, 'Vaga'),
          ];
        });

        this.loaded = true;
      }
    },
  },
});
