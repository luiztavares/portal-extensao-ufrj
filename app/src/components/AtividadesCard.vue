<template>
  <q-card  class="mycard">
    <router-link v-ripple class="cursor-pointer nounderline relative-position" :to="{
    path: `/atividade-e-servico/`+ acao['id'] ,
    params: {
        acao: acao
    }
    }"
    >
    <q-img ratio='1' fit='cover'  loading='loading' class='' :src="myImage(acao['Anexe aqui uma imagem para divulgação atividade/serviço/produto, caso deseje.'])">
    </q-img>
    <q-img class='' v-if='acao["Anexe aqui uma imagem para divulgação atividade/serviço/produto, caso deseje."] == ""'  :src="'images/Template/atividades' +' -'+ index%3 + '.png'">
    </q-img>
      <q-card-section vertical >
        <div class="text-h6 text-black text-underline q-pb-sm">{{dropTitle( acao['Nome curto da atividade/serviço/produto, para divulgação em materiais gráficos e em redes sociais.'])}}</div>
        <q-chip color="pink" outline :icon="acao.Modalidade == 'Online' ? 'public' : 'location_city'" >{{acao.Modalidade}}</q-chip>
      <q-chip color="green" outline  icon="paid" >Gratuito</q-chip>
        <q-chip color="teal" outline   icon="event" >Início: {{acao['Período de realização - Data de Início']}}</q-chip>
        <q-chip color="teal" outline  icon="event" >Fim: {{acao['Período de realização - Data de Término']}}</q-chip>
      </q-card-section>


        <!-- <q-img class='rounded-borders' v-if='vaga == true'  :src="'images/vagas'+(index%3+1)">
      <p class="q-ml-xl q-pl-sm q-mt-md q-pt-md q-pr-sm text-left text-h6" :style='"border-left: 3px solid "+ meta[acao.attributes.modalidade].corTitulo +";" + "color: white"'>
        {{ dropTitle(acao.attributes.titulo) }}
      </p>
      <p class=" q-ml-xl q-pl-sm text-left text-h7" :style='"color: "+ meta[acao.attributes.modalidade].cor'>
        {{ acao.attributes.coordenador_da_acao_de_extensao }}
      </p>

      <p class="q-ml-xl q-mt-xl q-pt-xl q-pl-sm  text-left text-h7" :style='"color: "+ meta[acao.attributes.modalidade].cor'>
        Endereço: {{ acao.attributes.endereco }}
      </p>
    </q-img> -->
    </router-link>
  </q-card>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
  setup() {},

  props: ["acao",'index','vaga'],

  data: function () {
    return {
      meta: {
        Projeto: {
          imagem: "images/projetos1",
          corTitulo: "rgb(89,16,236)",
          cor:"black",
        },
        Evento: {
          imagem: "images/eventos1",
          corTitulo: "rgb(88,16,236)",
          cor:"white",
        },
        Curso: {
          imagem: "images/cursos3",
          corTitulo: "rgb(255,255,0)",
          cor:"white",
        },
        Vaga: {
          imagem: "images/vagas1",
          corTitulo: "rgb(255,127,46)",
          cor:"white",
        },
      },
    };
  },

  methods: {
    dropTitle(titulo){
      return titulo.length < 70 ? titulo : (titulo.slice(0,70) + ' ...')
    },
    myImage(src){
      if(src.substring(0,5) == 'https'){
        var imgs = src.split(',')[0]
        var id = imgs.split('open?id=')[1]
        return `https://drive.google.com/u/0/uc?id=${id}`
      }
      else{
        return src
      }
    }
  },

});
</script>

<style scoped>

.mycard{
  width: 350px;
  max-width: 400px;
  height: 100%;
}
.nounderline{
  text-decoration: none;
}

.text-underline{
  text-decoration: underline;
}


</style>
