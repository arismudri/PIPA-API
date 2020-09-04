<template>
  <div class="container mt-3">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card card-default">
          <div class="card-header">TAMBAH ITEM</div>

          <div class="card-body">
            <form @submit.prevent="ItemStore">
              <div class="form-group">
                <label>Nama</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="item.nama"
                  placeholder="Masukkan Nama"
                />
                <div v-if="validation.nama">
                  <div class="alert alert-danger mt-1" role="alert">{{ validation.nama[0] }}</div>
                </div>
              </div>

              <div class="form-group">
                <label>Harga</label>
                <input
                  class="form-control"
                  v-model="item.harga"
                  rows="5"
                  placeholder="Masukkan Harga"
                />
                <div v-if="validation.harga">
                  <div class="alert alert-danger mt-1" role="alert">{{ validation.harga[0] }}</div>
                </div>
              </div>

              <div class="form-group">
                <label>Stok</label>
                <input
                  class="form-control"
                  v-model="item.stok"
                  rows="5"
                  placeholder="Masukkan Stok"
                />
                <div v-if="validation.stok">
                  <div class="alert alert-danger mt-1" role="alert">{{ validation.stok[0] }}</div>
                </div>
              </div>

              <div class="form-group">
                <button type="submit" class="btn btn-md btn-success">SIMPAN</button>
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
  methods: {
    ItemStore() {
      let uri = "http://localhost:8000/api/items/";
      this.axios
        .post(uri, this.item)
        .then((response) => {
          this.$router.push({
            name: "items",
          });
        })
        .catch((error) => {
          this.validation = error.response.data;
        });
    },
  },
};
</script>