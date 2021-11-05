/* eslint-disable */
<template>
  <div>
    <b-navbar toggleable="lg" type="dark" variant="info">
      <b-navbar-brand href="#">NavBar</b-navbar-brand>

      <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

      <b-collapse id="nav-collapse" is-nav>
        <b-navbar-nav class="ms-auto navbar-right">
          <b-nav-item href="#">Link</b-nav-item>
          <b-nav-item href="#" disabled>Disabled</b-nav-item>
        </b-navbar-nav>
      </b-collapse>
    </b-navbar>

    <div class="container pt-2 mb-4">
      <div class="d-flex mb-4" style="justify-content: right">
        <div class="p-2 bg-primary text-white rounded-top rounded-bottom">
          Criar
        </div>
      </div>
    </div>

    <div class="container pt-2 mb-4">
      <div class="d-flex mb-4" style="justify-content: right">
        <b-button @click="excluirRegistro()">Abrir modal</b-button>

        <b-modal ref="modalExcluir">
            <p> Tem certeza que deseja remover esse registro? </p>
    
            <template v-slot:modal-footer="{ hide , ok }">
              <b-button size="sm" variant="danger" @click="hide()">
                Não
              </b-button>
              <b-button size="sm" variant="primary" @click="ok()">
                Sim
              </b-button>
            </template>
        </b-modal>
      </div>
    </div>

    <div class="container pt-2 mb-4">
      <div class="d-flex mb-4" style="justify-content: right">
        <b-button @click="exibirToast()">Exibir toast</b-button>

        <b-toast id="example-toast" title="BootstrapVue" static no-auto-hide>
          Hello, world! This is a toast message.
        </b-toast>
      </div>
    </div>

    <div>
      <div class="container card pt-2 pb-2">
        <form>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Id</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="1" disabled>
          </div>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nome</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
            <label for="exampleInput">Tipo de documento</label>
            <br>
            <b-form-select id="exampleInput" size="md" class="mt-3 w-100" v-model="selected" :options="options">
            </b-form-select>
          </div>
          <div class="d-sm-block d-md-flex mb-4 button-box" style="justify-content: right">
            <button type="button" class="d-sm-block d-md-flex btn btn-danger button-box">Cancelar</button>
            <button type="submit" class="d-sm-block d-md-flex btn btn-primary button-box">Salvar</button>
          </div>
        </form>
      </div>
    </div>

    <div class="pt-4 pb-2">
      <div class="container card pt-4 pb-2">
        <table class="min-w-full border">
          <thead>
            <tr class="text-center">
              <th class="">
                <span class="">Nome</span>
              </th>
              <th class="px-6 py-3 bg-gray-50">
                <span class="">Ações</span>
              </th>
            </tr>
          </thead>
          <tbody class="">
            <tr class="bg-white pt-2 pb-2">
              <td class="text-center pt-2 pb-2">
                Abc
              </td>
              <td class="text-center pt-2 pb-2">
                <button class="inline-flex items-center btn btn-primary rounded-md button-box">
                  Edit
                </button>
                <button class="inline-flex items-center btn btn-danger rounded-md button-box">
                  Delete
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <footer class="footer mt-auto py-3 bg-light">
      <div class="container">
        <span class="text-muted">Criado para teste</span>
      </div>
    </footer>
  </div>
</template>
<script>
  // import MyForm from '../components/MyForm.vue';
  // import Ola from '../components/Ola.vue';

  export default {
    name: 'Home',
    components: {
      // MyForm
    },
    data() {
      return {
        selected: null,
        options: [
          { value: null, text: 'Selecione uma opção' },
          { value: 'a', text: 'This is First option' }
        ],
        items: [
          { age: 40, first_name: 'Dickerson', last_name: 'Macdonald' },
          { age: 21, first_name: 'Larsen', last_name: 'Shaw' },
          { age: 89, first_name: 'Geneva', last_name: 'Wilson' },
          { age: 38, first_name: 'Jami', last_name: 'Carney' }
        ],
        fields: [
          {
            key: 'first_name',
            label: 'Nome'
          },
          {
            key: 'last_name',
            label: 'Sobrenome'
          },
          {
            key: 'actions',
            label: 'Ações'
          },
        ]
      }
    },
    methods: {
      excluirRegistro() {
        this.$refs.modalExcluir.show();
      },
      exibirToast() {
        this.$bvToast.toast(`This is toast number`, {
          title: 'BootstrapVue Toast',
          autoHideDelay: 2000,
        })
      }
    }
  }
</script>
<style>
  .button-box {
    margin: 6px;
  }
  
  .modal-header > button {
    background-color: transparent;
    border: 0;
  }
</style>