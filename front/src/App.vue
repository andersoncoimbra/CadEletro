<template>
  <div>
    <h1>Eletrodomésticos</h1>
    <div class="form">
      <input v-model="novoEletrodomestico.name" placeholder="Nome">
      <input v-model="novoEletrodomestico.marca" placeholder="Marca">
      <input v-model="novoEletrodomestico.price" placeholder="Preço">
      <button @click="addEletrodomestico">Adicionar</button>
    </div>
    <table>
      <thead>
        <tr>
          <th>Nome</th>
          <th>Marca</th>
          <th>Preço</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="eletrodomestico in eletrodomesticos" :key="eletrodomestico.id">
          <td>{{ eletrodomestico.name }}</td>
          <td>{{ eletrodomestico.marca }}</td>
          <td>{{ eletrodomestico.price }}</td>
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
export default {
  data() {
    return {
      eletrodomesticos: [
        { id: 1, name: 'Geladeira', marca: 'Brastemp', price: 1999.99 },
        { id: 2, name: 'Fogão', marca: 'Electrolux', price: 1299.99 },
        { id: 3, name: 'Máquina de Lavar', marca: 'Consul', price: 1599.99 },
        { id: 4, name: 'TV', marca: 'Samsung', price: 2499.99 },
      ],
      novoEletrodomestico: {
        name: '',
        marca: '',
        price: '',
      },
      editandoEletrodometico: null,
      marcas: ['Brastemp', 'Electrolux', 'Fischer', 'Samsung', 'LG'],
    };
  },
  methods: {
    addEletrodomestico() {
      const id = this.eletrodomesticos.length + 1;
      this.eletrodomesticos.push({ ...this.novoEletrodomestico, id });
      this.clearnovoEletrodomestico();
    },
    deleteEletrodomestico(id) {
      this.eletrodomesticos = this.eletrodomesticos.filter(
        (eletrodomestico) => eletrodomestico.id !== id
      );
    },
    editEletrodomestico(eletrodomestico) {
      this.editandoEletrodometico = { ...eletrodomestico };
    },
    saveEdits() {
      const index = this.eletrodomesticos.findIndex(
        (eletrodomestico) => eletrodomestico.id === this.editandoEletrodometico.id
      );
      this.eletrodomesticos.splice(index, 1, this.editandoEletrodometico);
      this.cancelEdit();
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
