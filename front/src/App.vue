<template>
  <div>
    <h1>Eletrodomésticos</h1>
    <div class="form">
      <input v-model="novoEletrodomestico.nome" placeholder="Nome" required>
      <select v-model="novoEletrodomestico.marca_id" required>
        <option v-for="marca in marcas" :key="marca.id" :value="marca.id">
          {{ marca.nome }}
        </option>
      </select>
      <input v-model="novoEletrodomestico.tensao" placeholder="Tensão" required>
      <input v-model="novoEletrodomestico.descricao" placeholder="Descrição" required>
      <button @click="addEletrodomestico">Adicionar</button>
    </div>
    <table>
      <thead>
        <tr>
          <th>Nome</th>
          <th>Marca</th>
          <th>Tensão</th>
          <th>Descrição</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="eletrodomestico in eletrodomesticos" :key="eletrodomestico.id" placeholder="Marca">
          <td>{{ eletrodomestico.nome }}</td>
          <td>{{ getMarcaName(eletrodomestico.marca_id) }}</td>
          <td>{{ eletrodomestico.tensao }}</td>
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
        <input v-model="editandoEletrodometico.nome" placeholder="Nome">
        <select v-model="editandoEletrodometico.marca_id">
          <option v-for="marca in marcas" :key="marca.id" :value="marca.id">
            {{ marca.nome }}
          </option>
        </select>
        <input v-model="editandoEletrodometico.tensao">
        <input v-model="editandoEletrodometico.descricao" >
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
        marca_id: '',
        descricao: '',
      },
      editandoEletrodometico: null,
      marcas: [],
      errors: []
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
        
        
      }
    },
    async addEletrodomestico() {
      try {
        const response = await axios.post('/eletrodomesticos', this.novoEletrodomestico);
        this.eletrodomesticos.push(response.data);
        this.clearnovoEletrodomestico();
      } catch (error) {
        if (error.response && error.response.data && error.response.data.error) {
          this.errors = error.response.data.error;
          let msg = '';
          Object.values(this.errors).forEach((value) => {
            msg += value + '\n';
          });
          alert(msg);

        } else {
          // Exibir um erro genérico
          console.error('Ocorreu um erro ao adicionar o eletrodoméstico.');
        }
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
      if (this.marcas.length > 0) {
        const marca = this.marcas.find((marca) => marca.id === marcaId);
        return marca.nome;
      }
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
