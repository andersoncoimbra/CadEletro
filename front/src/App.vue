<template>
  <div>
    <h1>Eletrodomésticos</h1>
    <div class="form">
      <input v-model="novoEletrodomestico.name" placeholder="Nome">
      <select v-model="novoEletrodomestico.marca">
        <option v-for="marca in marcas" :key="marca.id" :value="marca.nome">
          {{ marca }}
        </option>
      </select>
      <input v-model="novoEletrodomestico.price" placeholder="Preço">
      <button @click="addEletrodomestico">Adicionar</button>
    </div>
    <table>
      <thead>
        <tr>
          <th>Nome</th>
          <th>Marca</th>
          <th>Descrição</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="eletrodomestico in eletrodomesticos" :key="eletrodomestico.id">
          <td>{{ eletrodomestico.nome }}</td>
          <td>{{ getMarcaName(eletrodomestico.marca_id) }}</td>
          <td>{{ eletrodomestico.descricao }}</td>
          <td>
            <button @click="editEletrodomestico(eletrodomestico)">Editar</button>
            <button @click="deleteEletrodomestico(eletrodomestico.id)">Excluir</button>
          </td>
        </tr>
      </tbody>
    </table>
    <div v-if="editandoEletrodometico">
      <h2>Editar Eletrodoméstico</h2>
      <div class="form">
        <input v-model="editandoEletrodometico.name" placeholder="Nome">
        <select v-model="editandoEletrodometico.marca">
          <option v-for="marca in marcas" :key="marca" :value="marca">
            {{ marca }}
          </option>
        </select>
        <input v-model="editandoEletrodometico.price" placeholder="Preço">
        <button @click="saveEdits">Salvar</button>
        <button @click="cancelEdit">Cancelar</button>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      eletrodomesticos: [],
      novoEletrodomestico: {
        name: '',
        marca: '',
        price: '',
      },
      editandoEletrodometico: null,
      marcas: [],
    };
  },
  created() {
    this.fetchMarcas();
    this.fetchEletrodomesticos();
  },
  methods: {
    async fetchEletrodomesticos() {
      try {
        const response = await axios.get('/eletrodomesticos');
        this.eletrodomesticos = response.data;
      } catch (error) {
        console.error(error);
      }
    },
    async addEletrodomestico() {
      try {
        const response = await axios.post('/eletrodomesticos', this.novoEletrodomestico);
        this.eletrodomesticos.push(response.data);
        this.clearnovoEletrodomestico();
      } catch (error) {
        console.error(error);
      }
    },
    async deleteEletrodomestico(id) {
      try {
        await axios.delete(`/eletrodomesticos/${id}`);
        this.eletrodomesticos = this.eletrodomesticos.filter(
          (eletrodomestico) => eletrodomestico.id !== id
        );
      } catch (error) {
        console.error(error);
      }
    },
    editEletrodomestico(eletrodomestico) {
      this.editandoEletrodometico = { ...eletrodomestico };
    },
    async saveEdits() {
      try {
        const response = await axios.put(
          `/eletrodomesticos/${this.editandoEletrodometico.id}`,
          this.editandoEletrodometico
        );
        const index = this.eletrodomesticos.findIndex(
          (eletrodomestico) => eletrodomestico.id === this.editandoEletrodometico.id
        );
        this.eletrodomesticos.splice(index, 1, response.data);
        this.cancelEdit();
      } catch (error) {
        console.error(error);
      }
    },
    async fetchMarcas(){
      try {
        const response = await axios.get('/marcas');
        this.marcas = response.data;
      } catch (error) {
        console.error(error);
      }
    },
    getMarcaName(marcaId){
      return this.marcas.find((marca) => marca.id === marcaId).nome;
    },
    cancelEdit() {
      this.editandoEletrodometico = null;
    },
    clearnovoEletrodomestico() {
      this.novoEletrodomestico = {
        name: '',
        marca: '',
        price: '',
      };
    },
  },
};
</script>

<style>
table {
  width: 100%;
  border-collapse: collapse;
}

th,
td {
  padding: 8px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

th {
  background-color: #000000;
}

.form {
  display: flex;
  gap: 8px;
  margin-bottom: 16px;
}
</style>
