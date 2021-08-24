<template>
    <div class="container">
        <h2 class="text-center p-2 text-white bg-info mt-5">Produk List</h2>
  <table class="table">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">ID</th>
      <th scope="col">Nama</th>
      <th scope="col">Jumlah</th>
      <th scope="col">Harga</th>
      <th scope="col">Gambar</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody v-for="produk in produks" :key="produk.id">
    <tr>
      <th scope="row">#</th>
      <td>{{produk.id}}</td>
      <td>{{produk.nama}}</td>
      <td>{{produk.jumlah}}</td>
      <td>{{produk.harga}}</td>
      <td>{{produk.image}}</td>
      <td>
      <button class="btn btn-danger btn-sm" @click.prevent="deleteProduk(produk.id)">Delete</button>
      <router-link :to="{name:'get_produks', params:{id:produk.id}}" class="btn btn-primary btn-sm">Edit</router-link>
      </td>
    </tr>
  </tbody>
</table>
    </div>
</template>

<script>
export default {
    name : 'Produk',
    created(){
        this.loadData();
    },
    methods:{
        loadData(){
            let url = this.url + '/api/getProduk';
            this.axios.get(url).then(response =>{
                this.produks = response.data
                console.log(this.produks);
            });
        },
        deleteProduk(id){
            let url = this.url + '/api/deleteProduk/' + id;
            this.axios.delete(url).then(response =>{
                  if(response.status){
                        this.loadData();
                        this.$utils.showSuccess('success',response.message);
                  }else{
                        this.$utils.showError('error',response.message);
                 }
            });
        }
        },
        mounted(){
            console.log('Produk List Mounted');
        },
        data(){
            return{
                url:document.head.querySelector('meta[name="url"]').content,
                produks:[]
            }
        }
    }

</script>

<style>

</style>