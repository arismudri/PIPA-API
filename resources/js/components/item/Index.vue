<template>
  <div class="container mt-3">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card card-default">
          <div class="card-header">ITEMS</div>

          <div class="card-body">
            <router-link :to="{ name: 'create' }" class="btn btn-md btn-success">TAMBAH POST</router-link>

            <div class="table-responsive mt-2">
              <table class="table table-hover table-bordered">
                <thead>
                  <tr>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>AKSI</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(post, index) in items" :key="post.id">
                    <td>{{ post.nama }}</td>
                    <td>{{ post.harga }}</td>
                    <td>{{ post.stok }}</td>
                    <td class="text-center">
                      <router-link
                        :to="{name: 'edit', params: { id: post.id }}"
                        class="btn btn-sm btn-primary"
                      >EDIT</router-link>
                      <button
                        @click.prevent="ItemDelete(post.id, index)"
                        class="btn btn-sm btn-danger"
                      >HAPUS</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
export default {
  data() {
    return {
      items: [],
    };
  },
  created() {
    let uri = `http://localhost:8000/api/items`;
    this.axios.get(uri).then((response) => {
      this.items = response.data.values;
    });
  },
  methods: {
    ItemDelete(id, index) {
      this.axios
        .delete(`http://localhost:8000/api/items/${id}`)
        .then((response) => {
          this.items.splice(index, 1);
        })
        .catch((error) => {
          alert("system error!");
        });
    },
  },
};
</script>