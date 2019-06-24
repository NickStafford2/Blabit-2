<template>
    <div class="row">
        <a class="btn btn-success btn-block" @click="upload">Upload</a>
    </div>
</template>

<style scoped>
    img{
        max-height: 36px;
    }
</style>

<script>
    export default{

        data(){
            return {
                image: ''
            }
        },

        methods: {
            upload(){
                alert("calling axios");
                //axios.post('/memes',{image: this.image}).then(response => alert('responce from post'));
            }
        },

        created() {
            console.log('created MemeUpload');
            //alert("calling axios");

        }
    }
</script>