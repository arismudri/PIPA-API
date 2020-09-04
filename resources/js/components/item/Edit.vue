<template>
  <div class="container mt-3">
    <div class="row justify-harga-center">
      <div class="col-md-12">
        <div class="card card-default">
          <div class="card-header">EDIT ITEM</div>

          <div class="card-body">
            <form @submit.prevent="ItemUpdate">
              <div class="form-group">
                <label>Nama</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="item.nama"
                  placeholder="Masukkan Title"
                />
                <div v-if="validation.nama">
                  <div class="alert alert-danger mt-1" role="alert">{{ validation.nama[0] }}</div>
                </div>
              </div>
              <div class="form-group">
                <label>Harga</label>
                <textarea
                  class="form-control"
                  v-model="item.harga"
                  rows="5"
                  placeholder="Masukkan Konten"
                ></textarea>
                <div v-if="validation.harga">
                  <div class="alert alert-danger mt-1" role="alert">{{ validation.harga[0] }}</div>
                </div>
              </div>
              <div class="form-group">
                <label>Stok</label>
                <textarea
                  class="form-control"
                  v-model="item.stok"
                  rows="5"
                  placeholder="Masukkan Konten"
                ></textarea>
                <div v-if="validation.stok">
                  <div class="alert alert-danger mt-1" role="alert">{{ validation.stok[0] }}</div>
                </div>
              </div>

              <div class="form-group">
                <button type="submit" class="btn btn-md btn-success">UPDATE</button>
                <button type="reset" class="btn btn-md btn-danger">RESET</button>
              </div>
            </form>
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
      item: {},
      validation: [],
    };
  },
  created() {
    let uri = `http://localhost:8000/api/items/${this.$route.params.id}`;
    this.axios.get(uri).then((response) => {
      this.item = response.data.values;
    });
  },
  methods: {
    ItemUpdate() {
      let uri = `http://localhost:8000/api/items/${this.$route.params.id}`;
      this.axios
        .put(uri, this.item)
        .then((response) => {
          this.$router.push({ name: "items" });
        })
        .catch((error) => {
          this.validation = error.response.data;
        });
    },
  },
};
</script>