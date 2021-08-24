<template>
   <div class="container">
        <h2 class="text-center p-2 text-white bg-info mt-5">Add Produk</h2>

        <div class="card-body">
            <div class="col-md-6 offset-md-3">
                <form id="validateForm" @submit.prevent="saveproduk" enctype="multipart/form-data" novalidate >

                    <div class="alert alert-danger" v-if="errors.length">
                        <ul class="mb-0">
                            <li v-for="(error, index) in errors" :key="index">
                                {{ error }}
                            </li>
                        </ul>
                    </div>

                    <div class="form-group">
                        <input type="text" id="nama" v-model="produk.nama" class="form-control" placeholder="Masukkan Nama Produk">
                    </div><br>

                    <div class="form-group">
                        <input type="number" id="harga" v-model="produk.harga" class="form-control" placeholder="Masukkan Harga Produk">
                    </div><br>

                    <div class="form-group">
                        <input type="number" id="jumlah" v-model="produk.jumlah" class="form-control" placeholder="Masukkan Jumlah Produk">
                    </div><br>

                     <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input" id="validatedCustomFile" v-on:change="saveimage">
                    </div><br>

                    <button class="btn btn-primary mt-4">Simpan</button>
                    
                </form>
            </div>
        </div>
   </div>
</template>

<script>
export default {
        data(){
            return{
                url:document.head.querySelector('meta[name="url"]').content,
                produk:{},
                nama:'',
                harga:'',
                jumlah:'',
                errors: []
            }
        },
        methods:{
            saveproduk(){
                this.errors = [];
                if(!this.produk.nama){
                    this.errors.push('Nama Wajib Di isi');
                }
                if(!this.produk.harga){
                    this.errors.push('Harga Wajib Di isi');
                }
                if(!this.produk.jumlah){
                    this.errors.push('Jumlah Wajib Di isi');
                }

                if(!this.errors.length){
                    let formData = new FormData();
                    formData.append('nama', this.produk.nama);
                    formData.append('harga', this.produk.harga);
                    formData.append('jumlah', this.produk.jumlah);
                    formData.append('image', this.image);

                    let url = this.url + '/api/saveProduk';
                    this.axios.post(url, formData).then((response)=>{
                        if(response.status){
                            document.getElementById("nama").value ='';
                            document.getElementById("harga").value ='';
                            document.getElementById("jumlah").value ='';
                            document.getElementById("validatedCustomFile").value ='';
                            this.$utils.showSuccess('success',response.message);
                        }else{
                            this.$utils.showError('error',response.message);
                        }
                    }).catch(error=>{
                        this.errors.push(error.response.data.error);
                    });
                }
            },
            saveimage(e){
                this.image = e.target.files[0];
                console.log(this.image);
            }
        },
        mounted:function(){
            console.log('Tambah Produk Dimuat');
        }

}
</script>

<style>

</style>