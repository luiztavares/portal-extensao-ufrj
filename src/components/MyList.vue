<template>
  <q-card class="mycard">
    <q-card-section>
      <router-link
        v-ripple
        class="cursor-pointer relative-position"
        :to="{
          path:
            `/${acao['O que você deseja divulgar?'].toLowerCase()}/` +
            acao['id'],
          params: {
            acao: acao,
          },
        }"
      >
        <div class="text-h6 text-black q-pb-md">
          {{
            dropTitle(
              acao[
                'Título curto da ação de extensão para divulgação em materiais gráficos e em redes sociais'
              ]
            )
          }}
        </div>
      </router-link>
      <p>
        {{
          acao[
            'Descreva brevemente a ação (curso ou evento) e como será desenvolvida'
          ]
        }}
      </p>
      <q-chip
        color="primary"
        outline
        :icon="
          acao['O que você deseja divulgar?'] == 'Curso'
            ? 'school'
            : 'celebration'
        "
        >{{ acao['O que você deseja divulgar?'] }}</q-chip
      >
      <q-chip
        color="pink"
        outline
        :icon="acao.Modalidade == 'Online' ? 'public' : 'location_city'"
        >{{ acao.Modalidade }}</q-chip
      >
      <q-chip color="green" outline icon="paid">Gratuito</q-chip>
      <q-chip color="teal" outline icon="event"
        >Início: {{ acao['Período de realização (Data de Início)'] }}</q-chip
      >
      <q-chip color="teal" outline icon="event"
        >Fim: {{ acao['Período de realização (Data de Término)'] }}</q-chip
      >
      <q-chip color="orange" outline icon="people"
        >Público: {{ dropTitle(acao['Público']) }}</q-chip
      >
    </q-card-section>
  </q-card>
</template>

<script setup>


</script>
