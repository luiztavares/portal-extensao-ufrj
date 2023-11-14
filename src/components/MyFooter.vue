<template>
  <div
    elevated
    class="q-px-xl q-py-md"
    style="background-color: #0268e4; text-shadow: 3px 3px 6px #212121"
  >
    <p class="text-h6 text-center" style="color: white">
      {{ content.feedback.description }}
    </p>
    <p class="text-h7 text-center" style="color: white">
      {{ content.feedback.report }}
      <q-btn
        flat
        color="yellow"
        :label="content.feedback.reportBtn.label"
        :to="content.feedback.reportBtn.to"
      ></q-btn>
    </p>
  </div>
  <div elevated class="bg-white q-px-md">
    <div class="row justify-center">
      <q-img
        style="max-width: 800px"
        class="col-md-10 col-sm-10 col-xs-10"
        fit="contain"
        :src="content.images.maintainers"
      ></q-img>
      <a
        class="col-md-2 col-sm-2 col-xs-2"
        target="_blank"
        rel="noopener noreferrer"
        :href="content.images.qrcode.link"
        ><q-img
          style="max-width: 800px"
          fit="contain"
          :src="content.images.qrcode.imageSrc"
        ></q-img
      ></a>
    </div>
    <div class="custom text-black">
      <p style="text-align: center">
        <span style="font-size: 10pt"
          >Praça Jorge Machado Moreira, s/nº, Cidade Universitária, Rio de
          Janeiro, RJ - CEP 21941-592</span
        >
      </p>
      <p style="text-align: center">
        <span style="font-size: 10pt"
          >Tel. (21) 3938-0482 / (21) 3938-0494 / (21) 3938-0617 -
          E-mail:&nbsp;<a
            href="mailto:comunicacao@pr5.ufrj.br"
            target="_blank"
            rel="noopener noreferrer"
            >comunicacao@pr5.ufrj.br</a
          ></span
        >
      </p>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const content = ref({
  feedback: {
    description:
      'No Portal da Extensão UFRJ você fica sabendo dos cursos, eventos, atividades, produtos e serviços gratuitos oferecidos pelas ações de extensão da Universidade para todos os públicos.',
    report: 'Encontrou algum problema no Portal?',
    reportBtn: {
      label: 'Clique Aqui',
      to: { name: 'Reportar' },
    },
  },
  images: {
    maintainers: '/images/Rodape - Portal.png',
    qrcode: {
      link: '/download/qrcode.pdf',
      imageSrc: '/images/qrcode.jpeg',
    },
  },
  otherLinks: [
    { label: 'UFRJ', link: 'http://www.ufrj.br/' },
    { label: 'Graduação', link: 'http://www.pr1.ufrj.br/' },
    { label: 'Pós Graduação e Pesquisa', link: 'http://www.pr2.ufrj.br/' },
    { label: 'Planejamento, Desenvolvimento', link: 'http://www.pr3.ufrj.br' },
    { label: 'Pessoal', link: 'http://www.pr4.ufrj.br/' },
    { label: 'Gestão e Governança', link: 'http://www.pr6.ufrj.br' },
    {
      label: 'Políticas Estudantis',
      link: 'http://politicasestudantis.ufrj.br',
    },
    { label: 'Prefeitura', link: 'http://www.prefeitura.ufrj.br' },
  ],
});
</script>
